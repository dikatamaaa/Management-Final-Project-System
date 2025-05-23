<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class PembimbingDuaNotification extends Notification
{
    use Queueable;
    public $status;
    public $alasan;
    public $namaDosen;

    public function __construct($status, $namaDosen, $alasan = null)
    {
        $this->status = $status;
        $this->alasan = $alasan;
        $this->namaDosen = $namaDosen;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        if ($this->status === 'accepted') {
            return [
                'pesan' => 'Permintaan pembimbing dua ke ' . $this->namaDosen . ' diterima.',
                'status' => 'accepted',
            ];
        } else {
            return [
                'pesan' => 'Permintaan pembimbing dua ke ' . $this->namaDosen . ' ditolak. Alasan: ' . $this->alasan,
                'status' => 'rejected',
                'alasan' => $this->alasan,
            ];
        }
    }
} 