<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Dosen;
use App\Models\Template;
use App\Models\Mahasiswa;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Notifications\PenambahanTemplateDokumen;

class AdminController extends Controller
{

    /**
     * Menampilkan Jumlah Data Mahasiswa
     */
    public function JumlahData() : View {
        $JumlahDataMahasiswa = Mahasiswa::count();
        $JumlahDataDosen = Dosen::count();
        return view('admin.beranda',compact('JumlahDataMahasiswa', 'JumlahDataDosen'));
    }

    /**
     * Menambahkan Data Dokumen Template
     */
    public function TambahDataDokumenTemplate(Request $request) : RedirectResponse {
        // Validasi Form
        $validasi = Validator::make($request->all(), [
            'nama_dokumen' => ['required', 'string', 'max:255'],
            'template_dokumen' => [
                'required',
                'url',
                function ($attribute, $value, $fail) {
                    $allowed = [
                        'drive.google.com',
                        'onedrive.live.com',
                        'dropbox.com',
                        'telkomuniversityofficial-my.sharepoint.com'
                    ];
                    $found = false;
                    foreach ($allowed as $domain) {
                        if (strpos($value, $domain) !== false) {
                            $found = true;
                            break;
                        }
                    }
                    if (!$found) {
                        $fail('Link hanya boleh dari Google Drive, OneDrive, Dropbox, atau SharePoint Telkom University!');
                    }
                }
            ],
        ],[
            'nama_dokumen.required' => 'Nama Dokumen Wajib Diisi!',
            'template_dokumen.required' => 'Link Template Dokumen Wajib Diisi!',
            'template_dokumen.url' => 'Link harus berupa URL yang valid!',
        ]);

        if ($validasi->fails()) {
            return redirect()->back()->withErrors($validasi)->with(['error' => 'Gagal Menambahkan Data!']);
        }

        // Cek apakah link sudah ada di database
        if (Template::where('template_dokumen', $request->template_dokumen)->exists()) {
            return back()->withErrors(['template_dokumen' => 'Link sudah pernah diinput.'])->with(['error' => 'Gagal Menambahkan Data!']);
        }

        // Create Data Template Dokumen
        $template = Template::create([
            'nama_dokumen' => $request->nama_dokumen,
            'template_dokumen' => $request->template_dokumen,
        ]);

        $admin = auth()->guard('admin')->user();
        Admin::all()->each(fn($admin) => $admin->notify(new PenambahanTemplateDokumen($template)));
        
        // Redirect ke Halaman Template Dokumen
        return redirect('admin/template_dokumen')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * Menampilkan Data Dokumen Template
     */
    public function MenampilkanDataDokumenTemplate() : View {
        $menampilkanDataTemplateDokumen = Template::all();
        return view('admin.template_dokumen', compact('menampilkanDataTemplateDokumen'));
    }

    /**
     * Hapus Data Dokumen Template
     */
    public function HapusDataDokumenTemplate($id) : RedirectResponse {
        // Get Data Template by ID
        $template = Template::findOrFail($id);

        // Hapus File
        Storage::delete('dokumen_template/' . $template->template_dokumen);
        $template->delete();

        // Kembali ke Halaman template_dokumen
        return redirect('/admin/template_dokumen')->with(['success' => 'Data Berhasil Dihapus!']);
    }
    
    /**
     * Edit Data Dokumen Template
     */
    public function EditDataDokumenTemplate(Request $request, $id) : RedirectResponse {
        // Validasi Form
        try {
            $request->validateWithBag('edit'.$id, [
                'nama_dokumen_'.$id => ['required', 'string', 'max:255'],
                'template_dokumen_'.$id => [
                    'required',
                    'url',
                    function ($attribute, $value, $fail) {
                        $allowed = [
                            'drive.google.com',
                            'onedrive.live.com',
                            'dropbox.com',
                            'telkomuniversityofficial-my.sharepoint.com'
                        ];
                        $found = false;
                        foreach ($allowed as $domain) {
                            if (strpos($value, $domain) !== false) {
                                $found = true;
                                break;
                            }
                        }
                        if (!$found) {
                            $fail('Link hanya boleh dari Google Drive, OneDrive, Dropbox, atau SharePoint Telkom University!');
                        }
                    }
                ],
            ],[
                'nama_dokumen_'.$id.'.required' => 'Nama Dokumen Wajib Diisi!',
                'template_dokumen_'.$id.'.required' => 'Link Template Dokumen Wajib Diisi!',
                'template_dokumen_'.$id.'.url' => 'Link harus berupa URL yang valid!',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors(), 'edit'.$id)->with(['error' => 'Gagal Diperbarui!']);
        }

        // Get Template by ID
        $template = Template::findOrFail($id);

        // Cek apakah link sudah ada di database (kecuali data ini sendiri)
        if (Template::where('template_dokumen', $request->{'template_dokumen_'.$id})->where('id', '!=', $id)->exists()) {
            return back()->withErrors(['template_dokumen_'.$id => 'Link sudah pernah diinput.'])->with(['error' => 'Gagal Diperbarui!']);
        }

        // Perbarui link dan nama dokumen
        $template->update([
            'nama_dokumen' => $request->{'nama_dokumen_'.$id},
            'template_dokumen' => $request->{'template_dokumen_'.$id},
        ]);

        // Redirect ke Template Dokumen
        return redirect('admin/template_dokumen')->with(['success' => 'Data Berhasil Diperbarui!']);
    }

    /**
     * Notifikasi Sudah Dibaca
     */
    public function SudahDibaca(Request $request) {
        $admin = auth()->guard('admin')->user();
        $admin->unreadNotifications->markAsRead();

        return back()->with(['success' => 'Notifikasi Sudah Dibaca Semua!']);
    }

    /**
     * Notifikasi Hapus Semua
     */
    public function HapusSemua(Request $request) {
        $admin = auth()->guard('admin')->user();
        $admin->notifications->each->delete();

        return back()->with(['success' => 'Notifikasi Berhasil Dihapus!']);
    }

    /**
     * Menambahkan Data Dosen Pembimbing
     */
    public function TambahDataDosen(Request $request) : RedirectResponse {
        // Validasi Form
        $validasi = Validator::make($request->all(),[
            'nip' => 'required|numeric|digits_between:8,20|unique:dosen,nip',
            'kode_dosen' => 'required|regex:/^[A-Za-z]+$/|max:3|unique:dosen,kode_dosen',
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:dosen,email',
            'no_hp' => 'required|numeric|digits_between:10,15|unique:dosen,no_hp',
            'nama_pengguna' => 'required|regex:/^[A-Za-z0-9]+$/|min:5|max:50|unique:dosen,nama_pengguna',
            'kata_sandi' => 'required|string|min:8',
        ],[
            'nip.required' => 'NIP Wajib Diisi!',
            'nip.digits_between' => 'NIP Minimal Harus 8 Sampai 20 Digit',
            'nip.unique' => 'NIP Sudah Terpakai, Silahkan Coba Lagi!',
            'kode_dosen.required' => 'Kode Dosen Wajib Diisi!',
            'kode_dosen.regex' => 'Kode Dosen Harus Berjenis Huruf Saja',
            'kode_dosen.max' => 'Kode Dosen Harus 3 Digit Huruf',
            'kode_dosen.unique' => 'Kode Dosen Sudah Terpakai, Silahkan Coba Lagi!',
            'nama.required' => 'Nama Wajib Diisi!',
            'email.required' => 'Email Wajib Diisi!',
            'email.unique' => 'Email Sudah Terpakai, Silahkan Coba Lagi!',
            'no_hp.required' => 'No Handphone Wajib Diisi!',
            'no_hp.digits_between' => 'No Handphone Minimal 10 Digit Sampai 15 Digit',
            'no_hp.unique' => 'No Handphone Sudah Terpakai, Silahkan Coba Lagi!',
            'nama_pengguna.required' => 'Nama Pengguna Wajib Diisi!',
            'nama_pengguna.min' => 'Nama Pengguna Minimal 5 Karakter',
            'nama_pengguna.max' => 'Nama Pengguna Maksimal 50 Karakter',
            'nama_pengguna.regex' => 'Nama Pengguna Haya Boleh Mengandung Huruf dan Angka',
            'nama_pengguna.unique' => 'Nama Pengguna Sudah Terpakai, Silahkan Coba Lagi!',
            'kata_sandi.required' => 'Kata Sandi Wajib Diisi!',
            'kata_sandi.min' => 'Kata Sandi Minimal 8 Karakter',
        ]);

        if ($validasi->fails()) {
            return redirect()->back()->withErrors($validasi)->with(['error' => 'Gagal Menambahkan Data!']);
        }

        // Cek apakah nama Pengguna sudah ada di database
        if (Admin::where('nama_pengguna', $request->nama_pengguna)->exists()) {
            return back()->withErrors(['nama_pengguna' => 'Nama Pengguna Sudah Ada, Silahkan Coba Lagi'])->with(['error' => 'Gagal Menambahkan Data!']);
        }
        if (Mahasiswa::where('nama_pengguna', $request->nama_pengguna)->exists()) {
            return back()->withErrors(['nama_pengguna' => 'Nama Pengguna Sudah Ada, Silahkan Coba Lagi'])->with(['error' => 'Gagal Menambahkan Data!']);
        }
        if (Dosen::where('nama_pengguna', $request->nama_pengguna)->exists()) {
            return back()->withErrors(['nama_pengguna' => 'Nama Pengguna Sudah Ada, Silahkan Coba Lagi'])->with(['error' => 'Gagal Menambahkan Data!']);
        }

        // Simpan Data Dosen
        $dosen = Dosen::create([
            'foto' => null,
            'nip' => $request->nip,
            'kode_dosen' => $request->kode_dosen,
            'nama' => $request->nama,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'nama_pengguna' => $request->nama_pengguna,
            'kata_sandi' => Hash::make($request->kata_sandi),
            'role' => 'dosen',
        ]);

        // Redirect ke Halaman Dosen
        return redirect('admin/dosen')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * Menampilkan Data Dosen
     */
    public function MenampilkanDataDosen() : View {
        $menampilkanDataDosen = Dosen::all();
        return view('admin.dosen', compact('menampilkanDataDosen'));
    }

    /**
     * Edit Data Dosen
     */
    public function EditDataDosen(Request $request, $id) : RedirectResponse {
        // Validasi Form
        $validasi = Validator::make($request->all(), [
            'nip_'.$id => 'required|numeric|digits_between:8,20|unique:dosen,nip,'.$id.',id',
            'kode_dosen_'.$id => 'required|regex:/^[A-Za-z]+$/|max:3|unique:dosen,kode_dosen,'.$id.',id',
            'nama_'.$id => 'required|string|max:255',
            'email_'.$id => 'required|email|max:255|unique:dosen,email,'.$id.',id',
            'no_hp_'.$id => 'required|numeric|digits_between:10,15|unique:dosen,no_hp,'.$id.',id',
            'nama_pengguna_'.$id => 'required|regex:/^[A-Za-z0-9]+$/|min:5|max:50|unique:dosen,nama_pengguna,'.$id.',id',
        ],[
            'nip_'.$id.'.required' => 'NIP Wajib Diisi!',
            'nip_'.$id.'.digits_between' => 'NIP Minimal Harus 8 Sampai 20 Digit',
            'nip_'.$id.'.unique' => 'NIP Sudah Terpakai, Silahkan Coba Lagi!',
            'kode_dosen_'.$id.'.required' => 'Kode Dosen Wajib Diisi!',
            'kode_dosen_'.$id.'.regex' => 'Kode Dosen Harus Berjenis Huruf Saja',
            'kode_dosen_'.$id.'.max' => 'Kode Dosen Harus 3 Digit Huruf',
            'kode_dosen_'.$id.'.unique' => 'Kode Dosen Sudah Terpakai, Silahkan Coba Lagi!',
            'nama_'.$id.'.required' => 'Nama Wajib Diisi!',
            'email_'.$id.'.required' => 'Email Wajib Diisi!',
            'email_'.$id.'.unique' => 'Email Sudah Terpakai, Silahkan Coba Lagi!',
            'no_hp_'.$id.'.required' => 'No Handphone Wajib Diisi!',
            'no_hp_'.$id.'.digits_between' => 'No Handphone Minimal 10 Digit Sampai 15 Digit',
            'no_hp_'.$id.'.unique' => 'No Handphone Sudah Terpakai, Silahkan Coba Lagi!',
            'nama_pengguna_'.$id.'.required' => 'Nama Pengguna Wajib Diisi!',
            'nama_pengguna_'.$id.'.min' => 'Nama Pengguna Minimal 5 Karakter',
            'nama_pengguna_'.$id.'.max' => 'Nama Pengguna Maksimal 50 Karakter',
            'nama_pengguna_'.$id.'.regex' => 'Nama Pengguna Haya Boleh Mengandung Huruf dan Angka',
            'nama_pengguna_'.$id.'.unique' => 'Nama Pengguna Sudah Terpakai, Silahkan Coba Lagi!',
        ]);

        if ($validasi->fails()) {
            return redirect()->back()->withErrors($validasi)->with(['error' => 'Gagal Diperbarui!']);
        }

        // Cek apakah nama Pengguna sudah ada di database
        if (Admin::where('nama_pengguna', $request->nama_pengguna)->exists()) {
            return back()->withErrors(['nama_pengguna_'.$id => 'Nama Pengguna Sudah Ada, Silahkan Coba Lagi'])->with(['error' => 'Gagal Menambahkan Data!']);
        }
        if (Mahasiswa::where('nama_pengguna', $request->nama_pengguna)->exists()) {
            return back()->withErrors(['nama_pengguna_'.$id => 'Nama Pengguna Sudah Ada, Silahkan Coba Lagi'])->with(['error' => 'Gagal Menambahkan Data!']);
        }
        if (Dosen::where('nama_pengguna', $request->nama_pengguna)->exists()) {
            return back()->withErrors(['nama_pengguna_'.$id => 'Nama Pengguna Sudah Ada, Silahkan Coba Lagi'])->with(['error' => 'Gagal Menambahkan Data!']);
        }

        // Get Dosen by ID
        $dosen = Dosen::findOrFail($id);

        // Perbarui Data Dosen
        $dosen->update([
            'nip' => $request->input('nip_'.$id),
            'kode_dosen' => $request->input('kode_dosen_'.$id),
            'nama' => $request->input('nama_'.$id),
            'email' => $request->input('email_'.$id),
            'no_hp' => $request->input('no_hp_'.$id),
            'nama_pengguna' => $request->input('nama_pengguna_'.$id),
        ]);

        // Redirect ke Halaman Dosen
        return redirect('/admin/dosen')->with(['success' => 'Data Berhasil Diperbarui!']);
    }

    /**
     * Hapus Data Dosen
     */
    public function HapusDataDosen($id) : RedirectResponse {
        // Get Dosen by ID
        $dosen = Dosen::findOrFail($id);

        // Hapus Data Dosen
        $dosen->delete();

        // Kembali ke Halaman Dosen
        return redirect('/admin/dosen')->with(['success' => 'Data Behasil Dihapus!']);
    }

    /**
     * Ganti Kata Sandi Dosen
     */
    public function GantiKataSandiDosen(Request $request, $id) : RedirectResponse {
        // Validasi Form
        $validasi = Validator::make($request->all(), [
            'kata_sandi_baru_'.$id => 'required|min:8',
            'konfirmasi_kata_sandi_'.$id => 'required|same:kata_sandi_baru_'.$id,
        ],[
            'kata_sandi_baru_'.$id.'.required' => 'Kata Sandi Baru Wajib Diisi!',
            'kata_sandi_baru_'.$id.'.min' => 'Kata Sandi Baru Minimal 8 Karakter',
            'konfirmasi_kata_sandi_'.$id.'.required' => 'Konfirmasi Kata Sandi Wajib Diisi!',
            'konfirmasi_kata_sandi_'.$id.'.same' => 'Konfirmasi Kata Sandi Harus Sama Dengan Kata Sandi Baru',
        ]);

        if ($validasi->fails()) {
            return redirect()->back()->withErrors($validasi)->with(['error' => 'Kata Sandi Gagal Diperbarui!']);
        }

        // Get Dosen by ID
        $dosen = Dosen::findOrFail($id);

        // Cek Apakah Kata Sandi Baru Sama Dengan Yang Lama
        if (Hash::check($request->input('kata_sandi_baru_'.$id), $dosen->kata_sandi)) {
            return back()->withErrors(['kata_sandi_baru_'.$id => 'Kata Sandi Baru Harus Berbeda Dengan Kata Sandi Saat Ini!'])->with(['error' => 'Kata Sandi Gagal Diperbarui!']);
        }

        // Perbarui Kata Sandi
        $dosen->update([
            'kata_sandi' => Hash::make($request->input('kata_sandi_baru_'.$id))
        ]);

        return redirect('/admin/dosen')->with(['success' => 'Kata Sandi Berhasil Diperbarui']);
    }

    /**
     * Menambahkan Data Mahasiswa
     */

     public function TambahDataMahasiswa(Request $request) : RedirectResponse {
        // Validasi Form
        $validasi = Validator::make($request->all(), [
            'nim' => 'required|numeric|digits_between:8,12|unique:mahasiswa,nim',
            'nama' => 'required|string|max:255',
            'kelas' => 'required',
            'program_studi' => 'required',
            'fakultas' => 'required',
            'angkatan' => 'required',
            'email' => 'required|email|max:255|unique:mahasiswa,email',
            'no_hp' => 'required|numeric|digits_between:10,15|unique:mahasiswa,no_hp',
            'nama_pengguna' => 'required|regex:/^[A-Za-z0-9]+$/|min:5|max:50|unique:mahasiswa,nama_pengguna',
            'kata_sandi' => 'required|string|min:8',
        ],[
            'nim.required' => 'NIM Wajib Diisi!',
            'nim.digits_between' => 'NIM Minimal Harus 8 Sampai 12 Digit',
            'nim.unique' => 'NIM Sudah Terpakai, Silahkan Coba Lagi!',
            'nama.required' => 'Nama Wajib Diisi!',
            'kelas.required' => 'Kelas Wajib Diisi!',
            'program_studi.required' => 'Program Studi Wajib Diisi!',
            'fakultas.required' => 'Fakultas Wajib Diisi!',
            'angkatan.required' => 'Angkatan Wajib Diisi!',
            'email.required' => 'Email Wajib Diisi!',
            'email.unique' => 'Email Sudah Terpakai, Silahkan Coba Lagi!',
            'no_hp.required' => 'No Handphone Wajib Diisi!',
            'no_hp.digits_between' => 'No Handphone Minimal 10 Digit Sampai 15 Digit',
            'no_hp.unique' => 'No Handphone Sudah Terpakai, Silahkan Coba Lagi!',
            'nama_pengguna.required' => 'Nama Pengguna Wajib Diisi!',
            'nama_pengguna.min' => 'Nama Pengguna Minimal 5 Karakter',
            'nama_pengguna.max' => 'Nama Pengguna Maksimal 50 Karakter',
            'nama_pengguna.regex' => 'Nama Pengguna Haya Boleh Mengandung Huruf dan Angka',
            'nama_pengguna.unique' => 'Nama Pengguna Sudah Terpakai, Silahkan Coba Lagi!',
            'kata_sandi.required' => 'Kata Sandi Wajib Diisi!',
            'kata_sandi.min' => 'Kata Sandi Minimal 8 Karakter',
        ]);

        if ($validasi->fails()) {
            return redirect()->back()->withErrors($validasi)->with(['error' => 'Gagal Menambahkan Data!']);
        }

        // Cek apakah nama Pengguna sudah ada di database
        if (Admin::where('nama_pengguna', $request->nama_pengguna)->exists()) {
            return back()->withErrors(['nama_pengguna' => 'Nama Pengguna Sudah Ada, Silahkan Coba Lagi'])->with(['error' => 'Gagal Menambahkan Data!']);
        }
        if (Mahasiswa::where('nama_pengguna', $request->nama_pengguna)->exists()) {
            return back()->withErrors(['nama_pengguna' => 'Nama Pengguna Sudah Ada, Silahkan Coba Lagi'])->with(['error' => 'Gagal Menambahkan Data!']);
        }
        if (Dosen::where('nama_pengguna', $request->nama_pengguna)->exists()) {
            return back()->withErrors(['nama_pengguna' => 'Nama Pengguna Sudah Ada, Silahkan Coba Lagi'])->with(['error' => 'Gagal Menambahkan Data!']);
        }

        // Simpan Data Mahasiswa
        $mahasiswa = Mahasiswa::create([
            'foto' => null,
            'nim' => $request->nim,
            'nama' => $request->nama,
            'kelas' => $request->kelas,
            'program_studi' => $request->program_studi,
            'fakultas' => $request->fakultas,
            'angkatan' => $request->angkatan,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'nama_pengguna' => $request->nama_pengguna,
            'kata_sandi' => Hash::make($request->kata_sandi),
            'role' => 'mahasiswa',
        ]);

        return redirect('admin/mahasiswa')->with(['success' => 'Data Berhasil Disimpan!']);
     }

     /**
      * Menampilkan Data Mahasiswa
      */
      public function MenampilkanDataMahasiswa() : View {
        $menampilkanDataMahasiswa = Mahasiswa::all();
        return view('admin.mahasiswa', compact('menampilkanDataMahasiswa'));
      }

      /**
       * Edit Data Mahasiswa
       */
      public function EditDataMahasiswa(Request $request, $id) : RedirectResponse {
        // Validasi Form
        $validasi = Validator::make($request->all(), [
            'nim_'.$id => 'required|numeric|digits_between:8,12|unique:mahasiswa,nim,'.$id.',id',
            'nama_'.$id => 'required|string|max:255',
            'kelas_'.$id => 'required',
            'program_studi_'.$id => 'required',
            'fakultas_'.$id => 'required',
            'angkatan_'.$id => 'required',
            'email_'.$id => 'required|email|max:255|unique:mahasiswa,email,'.$id.',id',
            'no_hp_'.$id => 'required|numeric|digits_between:10,15|unique:mahasiswa,no_hp,'.$id.',id',
            'nama_pengguna_'.$id => 'required|regex:/^[A-Za-z0-9]+$/|min:5|max:50|unique:mahasiswa,nama_pengguna,'.$id.',id',
        ],[
            'nim_'.$id.'.required' => 'NIM Wajib Diisi!',
            'nim_'.$id.'.digits_between' => 'NIM Minimal Harus 8 Sampai 12 Digit',
            'nim_'.$id.'.unique' => 'NIM Sudah Terpakai, Silahkan Coba Lagi!',
            'nama_'.$id.'.required' => 'Nama Wajib Diisi!',
            'kelas_'.$id.'.required' => 'Kelas Wajib Diisi!',
            'program_studi_'.$id.'.required' => 'Program Studi Wajib Diisi!',
            'fakultas_'.$id.'.required' => 'Fakultas Wajib Diisi!',
            'angkatan_'.$id.'.required' => 'Angkatan Wajib Diisi!',
            'email_'.$id.'.required' => 'Email Wajib Diisi!',
            'email_'.$id.'.unique' => 'Email Sudah Terpakai, Silahkan Coba Lagi!',
            'no_hp_'.$id.'.required' => 'No Handphone Wajib Diisi!',
            'no_hp_'.$id.'.digits_between' => 'No Handphone Minimal 10 Digit Sampai 15 Digit',
            'no_hp_'.$id.'.unique' => 'No Handphone Sudah Terpakai, Silahkan Coba Lagi!',
            'nama_pengguna_'.$id.'.required' => 'Nama Pengguna Wajib Diisi!',
            'nama_pengguna_'.$id.'.min' => 'Nama Pengguna Minimal 5 Karakter',
            'nama_pengguna_'.$id.'.max' => 'Nama Pengguna Maksimal 50 Karakter',
            'nama_pengguna_'.$id.'.regex' => 'Nama Pengguna Haya Boleh Mengandung Huruf dan Angka',
            'nama_pengguna_'.$id.'.unique' => 'Nama Pengguna Sudah Terpakai, Silahkan Coba Lagi!',
        ]);

        if ($validasi->fails()) {
            return redirect()->back()->withErrors($validasi)->with(['error' => 'Gagal Menambahkan Data!']);
        }

        // Cek apakah nama Pengguna sudah ada di database
        if (Admin::where('nama_pengguna', $request->nama_pengguna)->exists()) {
            return back()->withErrors(['nama_pengguna_'.$id => 'Nama Pengguna Sudah Ada, Silahkan Coba Lagi'])->with(['error' => 'Gagal Menambahkan Data!']);
        }
        if (Mahasiswa::where('nama_pengguna', $request->nama_pengguna)->exists()) {
            return back()->withErrors(['nama_pengguna_'.$id => 'Nama Pengguna Sudah Ada, Silahkan Coba Lagi'])->with(['error' => 'Gagal Menambahkan Data!']);
        }
        if (Dosen::where('nama_pengguna', $request->nama_pengguna)->exists()) {
            return back()->withErrors(['nama_pengguna_'.$id => 'Nama Pengguna Sudah Ada, Silahkan Coba Lagi'])->with(['error' => 'Gagal Menambahkan Data!']);
        }

        // Get Dosen by ID
        $mahasiswa = Mahasiswa::findOrFail($id);

        // Perbarui Data Dosen
        $mahasiswa->update([
            'nim' => $request->input('nim_'.$id),
            'nama' => $request->input('nama_'.$id),
            'kelas' => $request->input('kelas_'.$id),
            'program_studi' => $request->input('program_studi_'.$id),
            'fakultas' => $request->input('fakultas_'.$id),
            'angkatan' => $request->input('angkatan_'.$id),
            'email' => $request->input('email_'.$id),
            'no_hp' => $request->input('no_hp_'.$id),
            'nama_pengguna' => $request->input('nama_pengguna_'.$id),
        ]);

        // Redirect ke Halaman Mahasiswa
        return redirect('/admin/mahasiswa')->with(['success' => 'Data Berhasil Diperbarui!']);
      }

      /**
       * Hapus Data Mahasiswa
       */
      public function HapusDataMahasiswa($id) : RedirectResponse {
        // Get Mahasiswa by ID
        $mahasiswa = Mahasiswa::findOrFail($id);

        // Hapus Data Mahasiswa
        $mahasiswa->delete();

        // Kembali ke Halaman Mahasiswa
        return redirect('/admin/mahasiswa')->with(['success' => 'Data Behasil Dihapus!']);
    }

        /**
     * Ganti Kata Sandi Mahasiswa
     */
    public function GantiKataSandiMahasiswa(Request $request, $id) : RedirectResponse {
        // Validasi Form
        $validasi = Validator::make($request->all(), [
            'kata_sandi_baru_'.$id => 'required|min:8',
            'konfirmasi_kata_sandi_'.$id => 'required|same:kata_sandi_baru_'.$id,
        ],[
            'kata_sandi_baru_'.$id.'.required' => 'Kata Sandi Baru Wajib Diisi!',
            'kata_sandi_baru_'.$id.'.min' => 'Kata Sandi Baru Minimal 8 Karakter',
            'konfirmasi_kata_sandi_'.$id.'.required' => 'Konfirmasi Kata Sandi Wajib Diisi!',
            'konfirmasi_kata_sandi_'.$id.'.same' => 'Konfirmasi Kata Sandi Harus Sama Dengan Kata Sandi Baru',
        ]);

        if ($validasi->fails()) {
            return redirect()->back()->withErrors($validasi)->with(['error' => 'Kata Sandi Gagal Diperbarui!']);
        }

        // Get Mahasiswa by ID
        $mahasiswa = Mahasiswa::findOrFail($id);

        // Cek Apakah Kata Sandi Baru Sama Dengan Yang Lama
        if (Hash::check($request->input('kata_sandi_baru_'.$id), $mahasiswa->kata_sandi)) {
            return back()->withErrors(['kata_sandi_baru_'.$id => 'Kata Sandi Baru Harus Berbeda Dengan Kata Sandi Saat Ini!'])->with(['error' => 'Kata Sandi Gagal Diperbarui!']);
        }

        // Perbarui Kata Sandi
        $mahasiswa->update([
            'kata_sandi' => Hash::make($request->input('kata_sandi_baru_'.$id))
        ]);

        return redirect('/admin/mahasiswa')->with(['success' => 'Kata Sandi Berhasil Diperbarui']);
    }

    /**
     * Edit Foto Admin
     */
    public function EditFotoAdmin(Request $request, $id) : RedirectResponse {
        // Validasi Form
        $validasi = Validator::make($request->all(), [
            'image' => 'required|mimes:png,jpg,jpeg|max:16384',
        ],[
            'image.required' => 'Foto Wajib Diisi!',
            'image.mimes' => 'Jenis Foto Harus PNG, JPG, atau JPEG',
            'image.max' => 'Ukuran Foto Maksimal 16MB',
        ]);

        if ($validasi->fails()) {
            return redirect()->back()->withErrors($validasi)->with(['error' => 'Gagal Menambahkan Data!']);
        }

        //get Admin by ID
        $admin = Admin::findOrFail($id);

        // Upload Image
        $image = $request->file('image');
        $image->storeAs('assets/img/avatars/'. $image->hashName());

        // Hapus Foto Sebelumnya
        Storage::delete('assets/img/avatars/'.$admin->image);

        // Update Foto Admin
        $admin->update([
            'image' => $image->hashName()
        ]);

        return redirect('/admin/profil')->with(['success' => 'Foto Berhasil Diperbarui']);
    }

    /**
     * Ganti Kata Sandi Admin
     */
    public function GantiKataSandiAdmin(Request $request, $id) : RedirectResponse {
        // Validasi input
        $validasi = Validator::make($request->all(), [
            'kata_sandi_lama' => 'required|min:8',
            'kata_sandi_baru' => 'required|min:8|different:kata_sandi_lama',
            'konfirmasi_kata_sandi' => 'required|same:kata_sandi_baru',
        ], [
            'kata_sandi_lama.required' => 'Kata Sandi Lama Wajib Diisi!',
            'kata_sandi_lama.min' => 'Kata Sandi Lama Minimal 8 Karakter',
            'kata_sandi_baru.required' => 'Kata Sandi Baru Wajib Diisi!',
            'kata_sandi_baru.min' => 'Kata Sandi Baru Minimal 8 karakter',
            'kata_sandi_baru.different' => 'Kata Sandi Baru Harus Berbeda Dengan Yang Lama',
            'konfirmasi_kata_sandi.required' => 'Konfirmasi Kata Sandi Wajib Diisi!',
            'konfirmasi_kata_sandi.same' => 'Konfirmasi Kata Sandi Tidak Sama',
        ]);

        if ($validasi->fails()) {
            return redirect()->back()->withErrors($validasi)->with(['error' => 'Gagal Menambahkan Data!']);
        }

        //get Admin by ID
        $admin = Admin::findOrFail($id);

        // Cek Apakah Kata Sandi Baru Sama Dengan Yang Lama
        if (Hash::check($request->input('kata_sandi_baru'), $admin->kata_sandi)) {
            return back()->withErrors(['kata_sandi_baru' => 'Kata Sandi Baru Harus Berbeda Dengan Kata Sandi Saat Ini!'])->with(['error' => 'Kata Sandi Gagal Diperbarui!']);
        }

        // Verifikasi Kata Sandi Lama
        if (!Hash::check($request->kata_sandi_lama, $admin->kata_sandi)) {
            return back()->withErrors(['kata_sandi_lama' => 'Kata Sandi Lama Tidak Sesuai!'])->with(['error' => 'Kata Sandi Gagal Diperbarui!']);
        }

        // Perbarui Kata Sandi
        $admin->update([
            'kata_sandi' => Hash::make($request->kata_sandi_baru)
        ]);

        return redirect('/admin/profil')->with(['success' => 'Kata Sandi Berhasil Diperbarui']);
    }
}
