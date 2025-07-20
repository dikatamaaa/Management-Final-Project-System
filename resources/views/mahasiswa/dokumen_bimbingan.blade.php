<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Dashboard - Brand</title>
    <link rel="stylesheet" href="{{ asset('/storage/assets/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto&amp;display=swap">
    <link rel="stylesheet" href="{{ asset('/storage/assets/fonts/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/storage/assets/fonts/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/storage/assets/fonts/fontawesome5-overrides.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/storage/assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.css" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        :root {
            --primary-color: #881d1d;
            --primary-darker: #6e1717;
            --primary-lighter: #a83232;
            --sidebar-text: rgba(255, 255, 255, 0.8);
            --sidebar-text-active: #ffffff;
            --secondary-color: #f8f9fa;
            --font-family: 'Poppins', sans-serif;
        }
        body {
            font-family: var(--font-family);
            background-color: var(--secondary-color);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        #wrapper {
            display: flex;
            min-height: 100vh;
            flex: 1;
        }
        .sidebar {
            background: var(--primary-color) !important;
            transition: all 0.3s ease;
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            z-index: 1000;
            width: 250px;
            overflow-y: auto;
            overflow-x: hidden;
        }
        .sidebar .sidebar-brand {
            height: 60px;
            transition: background-color 0.2s ease;
        }
        .sidebar .sidebar-brand:hover {
           /* background-color: var(--primary-darker); */
        }
        .sidebar .sidebar-brand-icon img {
            transition: transform 0.3s ease;
        }
        .sidebar .sidebar-brand:hover .sidebar-brand-icon img {
            transform: scale(1.1) rotate(3deg);
        }
        hr.sidebar-divider {
            border-top: 1px solid rgba(255, 255, 255, 0.15);
        }
        .sidebar .nav-item {
            position: relative;
        }
        .sidebar .nav-item .nav-link {
            color: var(--sidebar-text);
            font-weight: 500;
            padding: 0.9rem 1.25rem;
            transition: all 0.2s ease-in-out;
            border-left: 4px solid transparent;
        }
        .sidebar .nav-item .nav-link:hover {
            color: var(--sidebar-text-active);
            background-color: var(--primary-darker);
            border-left-color: var(--primary-lighter);
        }
        .sidebar .nav-item.active .nav-link,
        .sidebar .nav-link.active {
            color: var(--sidebar-text-active);
            font-weight: 600;
            background-color: var(--primary-darker);
            border-left-color: #ffffff;
        }
        .sidebar .nav-item .nav-link i {
            font-size: 1em;
            width: 24px;
            text-align: center;
            margin-right: 0.75rem;
        }
        .sidebar .dropdown-menu {
            background-color: var(--primary-lighter);
            border: none;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }
        .sidebar .dropdown-item {
            color: var(--sidebar-text);
            padding: 0.6rem 1.5rem;
            transition: background-color 0.2s ease;
        }
        .sidebar .dropdown-item:hover, .sidebar .dropdown-item:focus {
            background-color: var(--primary-darker);
            color: var(--sidebar-text-active);
        }
        .sidebar .dropdown-item i {
            margin-right: 0.5rem;
        }
        .card {
            border-radius: 16px;
            box-shadow: 0 2px 16px 0 rgba(0,0,0,0.07);
            border: none;
            margin-bottom: 2rem;
        }
        .card-header {
            background: #f8fafc;
            border-radius: 16px 16px 0 0;
            font-weight: 700;
            font-size: 1.15rem;
            color: #1e293b;
            border-bottom: 1.5px solid #e5e7eb;
        }
        .table th, .table td {
            padding: 0.55rem 0.7rem;
            vertical-align: middle;
            border-top: none;
            border-bottom: 1.5px solid #e5e7eb;
            background: transparent;
        }
        .table thead th {
            background: #f1f5f9;
            font-weight: 600;
            border-bottom: 2px solid #d1d5db;
        }
        .table-striped > tbody > tr:nth-of-type(odd) {
            --bs-table-accent-bg: #f8fafc;
        }
        .badge {
            border-radius: 8px;
            font-size: 0.85em;
            padding: 0.35em 0.7em;
            font-weight: 500;
            letter-spacing: 0.01em;
        }
        .badge.bg-success {
            background: #4ade80 !important;
            color: #065f46 !important;
        }
        .badge.bg-danger {
            background: #f87171 !important;
            color: #7f1d1d !important;
        }
        .badge.bg-warning {
            background: #facc15 !important;
            color: #92400e !important;
        }
        .badge.bg-dark {
            background: #334155 !important;
            color: #fff !important;
        }
        .badge.bg-primary {
            background: #60a5fa !important;
            color: #1e3a8a !important;
        }
        .badge.bg-info {
            background: #38bdf8 !important;
            color: #0369a1 !important;
        }
        
        /* Badge Dokumen Styling - Biru */
        .badge-dokumen {
            background: linear-gradient(135deg, #3b82f6, #1d4ed8) !important;
            color: white !important;
            font-weight: 600;
            padding: 0.5em 1em;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(59, 130, 246, 0.3);
        }
        
        .badge-dokumen:hover {
            background: linear-gradient(135deg, #2563eb, #1e40af) !important;
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(59, 130, 246, 0.4);
            transition: all 0.2s ease;
        }
        
        /* Badge Bimbingan Styling - Hijau */
        .badge-bimbingan {
            background: linear-gradient(135deg, #22c55e, #16a34a) !important;
            color: white !important;
            font-weight: 600;
            padding: 0.5em 1em;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(34, 197, 94, 0.3);
        }
        
        .badge-bimbingan:hover {
            background: linear-gradient(135deg, #16a34a, #15803d) !important;
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(34, 197, 94, 0.4);
            transition: all 0.2s ease;
        }
        .btn {
            border-radius: 7px !important;
            font-size: 0.97em;
            font-weight: 500;
            transition: background 0.18s, box-shadow 0.18s;
            box-shadow: 0 2px 8px 0 rgba(37,99,235,0.07);
        }
        .btn-primary, .btn-success, .btn-danger, .btn-warning, .btn-info {
            border: none;
        }
        .btn-primary {
            background: #2563eb;
        }
        .btn-primary:hover {
            background: #1d4ed8;
        }
        .btn-success {
            background: #22c55e;
        }
        .btn-success:hover {
            background: #16a34a;
        }
        .btn-danger {
            background: #ef4444;
        }
        .btn-danger:hover {
            background: #b91c1c;
        }
        .btn-warning {
            background: #facc15;
            color: #92400e;
        }
        .btn-warning:hover {
            background: #eab308;
            color: #78350f;
        }
        .btn-info {
            background: #38bdf8;
            color: #0369a1;
        }
        .btn-info:hover {
            background: #0ea5e9;
            color: #075985;
        }
        .btn-sm {
            padding: 0.32em 1.1em;
            font-size: 0.93em;
        }
        .clickable-row {
            cursor: pointer;
            transition: background 0.18s;
        }
        .clickable-row:hover {
            background: #f1f5f9 !important;
        }
        .table-responsive {
            margin-bottom: 0.5rem;
        }
        
        /* Footer styling */
        .sticky-footer {
            position: sticky;
            bottom: 0;
            width: 100%;
            padding: 1rem 0;
            border-top: 1px solid #e5e7eb;
            background: #ffffff;
            box-shadow: 0 -2px 10px rgba(0,0,0,0.05);
            margin-top: auto;
            z-index: 100;
            flex-shrink: 0;
        }
        
        /* Ensure content wrapper takes full height */
        #content-wrapper {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin-left: 250px;
        }
        
        /* Make content area flexible */
        #content {
            flex: 1 0 auto;
            display: flex;
            flex-direction: column;
        }
        
        /* Container for main content */
        .container-fluid {
            flex: 1 0 auto;
        }
        
        /* Ensure main content area takes available space */
        .main-content {
            flex: 1 0 auto;
            min-height: 0;
        }
        @media (max-width: 768px) {
            .sidebar {
                width: 280px;
                transform: translateX(-100%);
            }
            .sidebar.show {
                transform: translateX(0);
            }
            #content-wrapper {
                margin-left: 0 !important;
                width: 100% !important;
                min-height: 100vh;
            }
            .sticky-footer {
                margin-top: auto;
                position: sticky;
                bottom: 0;
            }
            .table th, .table td {
                padding: 0.45rem 0.3rem;
                font-size: 0.98em;
            }
            .btn-sm {
                font-size: 0.91em;
                padding: 0.28em 0.7em;
            }
            .card-header {
                font-size: 1.01rem;
            }
        }
        

        
        /* Button Styling for Dokumen & Bimbingan */
        .btn-primary {
            background: linear-gradient(135deg, #881d1d 0%, #a83232 100%);
            border: none;
            border-radius: 8px;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            font-size: 0.95em;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(136,29,29,0.2);
        }
        
        .btn-primary:hover {
            background: linear-gradient(135deg, #6e1717 0%, #881d1d 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(136,29,29,0.3);
        }
        
        .btn-primary:disabled {
            background: #9ca3af;
            transform: none;
            box-shadow: none;
            cursor: not-allowed;
        }
        
        .btn-outline-primary {
            border: 2px solid #3b82f6;
            color: #3b82f6;
            border-radius: 8px;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            font-size: 0.95em;
            transition: all 0.3s ease;
            background: transparent;
        }
        
        .btn-outline-primary:hover {
            background: #3b82f6;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(59,130,246,0.3);
        }
        
        /* Modal and Offcanvas Styling */
        .modal-dialog {
            max-width: 90%;
        }
        
        .modal-xl {
            max-width: 1140px;
        }
        
        .modal-backdrop {
            z-index: 1040;
        }
        
        .modal {
            z-index: 1050;
        }
        
        .offcanvas-backdrop {
            z-index: 1040;
            background-color: rgba(0, 0, 0, 0.5);
        }
        
        .offcanvas {
            z-index: 1050;
        }
        
        .offcanvas-log-bimbingan {
            z-index: 1051;
        }
        
        /* Guidance Modal Styling */
        .guidance-modal {
            z-index: 1060;
        }
        
        .guidance-modal .modal-backdrop {
            z-index: 1055;
            background-color: rgba(0, 0, 0, 0.6);
        }
        
        .guidance-modal .modal-dialog {
            max-width: 600px;
        }
        
        .guidance-modal .modal-content {
            border-radius: 16px;
            border: none;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            overflow: hidden;
        }
        
        .guidance-modal .modal-header {
            padding: 1.5rem;
            border-bottom: none;
        }
        
        .modal-icon {
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.2em;
        }
        
        .guidance-modal .modal-body {
            padding: 2rem;
        }
        
        .guidance-modal .modal-footer {
            padding: 1.5rem;
            border-top: 1px solid #e2e8f0;
            background: #f8fafc;
        }
        
        /* Content Styling */
        .materi-content, .catatan-content {
            min-height: 200px;
        }
        
        .content-text {
            background: #f8fafc;
            border-radius: 12px;
            padding: 1.5rem;
            border-left: 4px solid #881d1d;
            line-height: 1.6;
            color: #374151;
            font-size: 1em;
        }
        
        .rejection-reason, .feedback-content {
            display: flex;
            align-items: flex-start;
            gap: 1rem;
            background: #f8fafc;
            border-radius: 12px;
            padding: 1.5rem;
            border-left: 4px solid;
        }
        
        .rejection-reason {
            border-left-color: #ef4444;
        }
        
        .feedback-content {
            border-left-color: #3b82f6;
        }
        
        .reason-icon, .feedback-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5em;
            flex-shrink: 0;
        }
        
        .reason-icon {
            background: #fee2e2;
            color: #dc2626;
        }
        
        .feedback-icon {
            background: #dbeafe;
            color: #2563eb;
        }
        
        .reason-text h6, .feedback-text h6 {
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 0.75rem;
            font-size: 1.1em;
        }
        
        .reason-text p, .feedback-text p {
            color: #374151;
            line-height: 1.6;
            margin: 0;
            font-size: 1em;
        }
        
        .empty-content {
            text-align: center;
            padding: 3rem 2rem;
            color: #94a3b8;
        }
        
        .empty-content i {
            font-size: 3em;
            margin-bottom: 1rem;
            opacity: 0.5;
        }
        
        .empty-content p {
            font-size: 1.1em;
            margin: 0;
        }
        
        /* Document Modal Styling */
        .document-modal {
            z-index: 1060;
        }
        
        .document-modal .modal-backdrop {
            z-index: 1055;
            background-color: rgba(0, 0, 0, 0.6);
        }
        
        /* Ensure modal content is clickable */
        .document-modal .modal-content {
            position: relative;
            z-index: 1061;
        }
        
        .document-modal .modal-dialog {
            position: relative;
            z-index: 1061;
        }
        
        .document-modal .modal-dialog {
            max-width: 1000px;
        }
        
        .document-modal .modal-content {
            border-radius: 16px;
            border: none;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            overflow: hidden;
            pointer-events: auto;
        }
        
        .document-modal .modal-content * {
            pointer-events: auto;
        }
        
        .document-modal .modal-header {
            padding: 1.5rem;
            border-bottom: none;
        }
        
        .document-modal .modal-body {
            padding: 0;
        }
        
        .document-modal .modal-footer {
            padding: 1.5rem;
            border-top: 1px solid #e2e8f0;
            background: #f8fafc;
        }
        
        /* Document Log Container */
        .document-log-container {
            padding: 1.5rem;
            max-height: calc(80vh - 200px);
            overflow-y: auto;
            scrollbar-width: thin;
            scrollbar-color: #cbd5e1 #f1f5f9;
        }
        
        .document-log-container::-webkit-scrollbar {
            width: 6px;
        }
        
        .document-log-container::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 3px;
        }
        
        .document-log-container::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 3px;
        }
        
        .document-log-container::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
        
        /* Document Card Styling */
        .document-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            margin-bottom: 1.5rem;
            border: 1px solid #e2e8f0;
            overflow: hidden;
            transition: all 0.3s ease;
        }
        
        .document-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 16px rgba(0,0,0,0.12);
        }
        
        .document-header {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            padding: 1.25rem;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .document-number {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #881d1d 0%, #a83232 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 1.1em;
            flex-shrink: 0;
        }
        
        .document-info {
            flex: 1;
        }
        
        .document-title {
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 0.25rem;
            font-size: 1.1em;
        }
        
        .document-subtitle {
            color: #64748b;
            margin: 0;
            font-size: 0.9em;
        }
        
        .document-actions {
            flex-shrink: 0;
        }
        
        .document-details {
            padding: 1.25rem;
        }
        
        /* Document Link Styling */
        .document-link {
            color: #3b82f6;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s ease;
        }
        
        .document-link:hover {
            color: #1d4ed8;
            text-decoration: underline;
        }
        
        /* Offcanvas Log Bimbingan Styling */
        .offcanvas-log-bimbingan {
            width: 90vw !important;
            max-width: 1200px;
            height: 90vh !important;
            top: 5vh !important;
            left: 50% !important;
            transform: translateX(-50%) !important;
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            transition: all 0.3s ease;
        }
        
        .offcanvas-log-bimbingan.show {
            transform: translateX(-50%) translateY(0) !important;
        }
        
        .offcanvas-log-bimbingan:not(.show) {
            transform: translateX(-50%) translateY(-100%) !important;
        }
        
        .bg-gradient-primary {
            background: linear-gradient(135deg, #881d1d 0%, #a83232 100%);
        }
        
        .offcanvas-icon {
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.2em;
        }
        
        .guidance-log-container {
            padding: 1.5rem;
            max-height: calc(90vh - 120px);
            overflow-y: auto;
            scrollbar-width: thin;
            scrollbar-color: #cbd5e1 #f1f5f9;
        }
        
        .guidance-log-container::-webkit-scrollbar {
            width: 6px;
        }
        
        .guidance-log-container::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 3px;
        }
        
        .guidance-log-container::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 3px;
        }
        
        .guidance-log-container::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
        
        .guidance-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            margin-bottom: 1.5rem;
            border: 1px solid #e2e8f0;
            overflow: hidden;
            transition: all 0.3s ease;
        }
        
        .guidance-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 16px rgba(0,0,0,0.12);
        }
        
        .guidance-header {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            padding: 1.25rem;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .guidance-number {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #881d1d 0%, #a83232 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 1.1em;
            flex-shrink: 0;
        }
        
        .guidance-info {
            flex: 1;
        }
        
        .guidance-title {
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 0.25rem;
            font-size: 1.1em;
        }
        
        .guidance-subtitle {
            color: #64748b;
            margin: 0;
            font-size: 0.9em;
        }
        
        .guidance-status {
            flex-shrink: 0;
        }
        
        .status-badge {
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.85em;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .status-pending {
            background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
            color: #92400e;
        }
        
        .status-accepted {
            background: linear-gradient(135deg, #dcfce7 0%, #bbf7d0 100%);
            color: #166534;
        }
        
        .status-rejected {
            background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
            color: #991b1b;
        }
        
        .status-completed {
            background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
            color: #1e40af;
        }
        
        .guidance-details {
            padding: 1.25rem;
        }
        
        .detail-row {
            display: flex;
            align-items: center;
            padding: 0.75rem 0;
            border-bottom: 1px solid #f1f5f9;
        }
        
        .detail-row:last-child {
            border-bottom: none;
        }
        
        .detail-label {
            width: 120px;
            font-weight: 600;
            color: #374151;
            font-size: 0.9em;
            flex-shrink: 0;
        }
        
        .detail-value {
            flex: 1;
            color: #1e293b;
            font-size: 0.9em;
        }
        
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
        }
        
        .empty-icon {
            font-size: 4em;
            color: #cbd5e1;
            margin-bottom: 1.5rem;
        }
        
        .empty-title {
            color: #64748b;
            font-weight: 600;
            font-size: 1.3em;
            margin-bottom: 0.75rem;
        }
        
        .empty-description {
            color: #94a3b8;
            font-size: 1em;
            line-height: 1.6;
            max-width: 400px;
            margin: 0 auto;
        }
        
        .table-responsive {
            overflow-x: auto;
        }
        
        .table th, .table td {
            white-space: nowrap;
            min-width: 100px;
        }
        
        .table th:first-child, .table td:first-child {
            min-width: 50px;
        }
        
        .table th:last-child, .table td:last-child {
            min-width: 120px;
        }
        
        /* Ensure body doesn't get stuck */
        body.modal-open {
            overflow: hidden;
            padding-right: 0 !important;
        }
        
        body.offcanvas-open {
            overflow: hidden;
            padding-right: 0 !important;
        }
        
        /* Ensure modal elements are interactive */
        .modal.show {
            pointer-events: auto !important;
        }
        
        .modal.show .modal-content {
            pointer-events: auto !important;
        }
        
        .modal.show .modal-content * {
            pointer-events: auto !important;
        }
        
        /* Prevent any overlay from blocking interactions */
        .modal-backdrop {
            pointer-events: none;
        }
        
        .modal-backdrop + .modal {
            pointer-events: auto;
        }
        
        /* Responsive Design for Log Bimbingan */
        @media (max-width: 768px) {
            .offcanvas-log-bimbingan {
                width: 95vw !important;
                height: 95vh !important;
                top: 2.5vh !important;
            }
            
            .guidance-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.75rem;
            }
            
            .guidance-status {
                align-self: flex-start;
            }
            
            .detail-row {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.5rem;
            }
            
            .detail-label {
                width: auto;
                font-size: 0.85em;
            }
            
            .detail-value {
                font-size: 0.85em;
            }
            
            .guidance-log-container {
                padding: 1rem;
                max-height: calc(95vh - 120px);
            }
            
            .guidance-card {
                margin-bottom: 1rem;
            }
            
            /* Mobile Modal Styling */
            .guidance-modal .modal-dialog {
                max-width: 95vw;
                margin: 1rem auto;
            }
            
            .guidance-modal .modal-body {
                padding: 1.5rem;
            }
            
            .guidance-modal .modal-header {
                padding: 1.25rem;
            }
            
            .guidance-modal .modal-footer {
                padding: 1.25rem;
            }
            
            .rejection-reason, .feedback-content {
                flex-direction: column;
                text-align: center;
            }
            
            .reason-icon, .feedback-icon {
                margin: 0 auto 1rem auto;
            }
            
            /* Mobile Document Modal Styling */
            .document-modal .modal-dialog {
                max-width: 95vw;
                margin: 1rem auto;
            }
            
            .document-modal .modal-header {
                padding: 1.25rem;
            }
            
            .document-modal .modal-footer {
                padding: 1.25rem;
            }
            
            .document-log-container {
                padding: 1rem;
                max-height: calc(80vh - 180px);
            }
            
            .document-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.75rem;
            }
            
            .document-actions {
                align-self: flex-start;
            }
            
            .document-card {
                margin-bottom: 1rem;
            }
        }
        
        @media (min-width: 768px) {
            .offcanvas-log-bimbingan {
                width: 90vw !important;
                max-width: 1200px;
            }
        }
    </style>
</head>

<body id="page-top">
    <div id="wrapper">
        <nav class="navbar align-items-start sidebar sidebar-dark accordion p-0 navbar-dark">
            <div class="container-fluid d-flex flex-column p-0">
                <a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
                    <div class="sidebar-brand-icon">
                        <img class="img-fluid" src="{{ asset('storage/assets/img/Logo/TAKU_White.png') }}" width="100px" alt="Logo TAKU">
                    </div>
                </a>
                <hr class="sidebar-divider my-0">
                <ul class="navbar-nav text-light" id="accordionSidebar">
                    <li class="nav-item">
                        <a class="nav-link" href="/mahasiswa/beranda"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/mahasiswa/daftar_topik"><i class="far fa-file-alt"></i><span>Daftar Topik</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/mahasiswa/template_laporan"><i class="fas fa-file-word"></i><span>Template Laporan</span></a>
                    </li>                    
                    <li class="nav-item">
                        <a class="nav-link" href="/mahasiswa/pembimbing-dua"><i class="fas fa-users"></i><span>Pembimbing 2</span></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link active" href="/mahasiswa/dokumen-bimbingan"><i class="fas fa-comments"></i><span>Bimbingan</span></a>
                    </li>
                    <li class="nav-item mt-auto">
                        <hr class="sidebar-divider my-0">
                        <a class="nav-link" href="/mahasiswa/profil"><i class="fas fa-user"></i><span>Profil</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/logout"><i class="fas fa-sign-out-alt"></i><span>Keluar</span></a>
                    </li>
                </ul>
                <div class="text-center d-none d-md-inline">
                    <button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button>
                </div>
            </div>
        </nav>
        
        <div class="d-flex flex-column" id="content-wrapper" style="margin-left: 225px;">
            <div id="content">
                <nav class="navbar navbar-expand bg-white shadow mb-4 topbar static-top navbar-light">
                    <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle me-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                        <ul class="navbar-nav flex-nowrap ms-auto">
                            <li class="nav-item dropdown no-arrow mx-1">
                                <div class="nav-item dropdown no-arrow">
                                    <a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#">
                                        <span class="badge bg-danger badge-counter">
                                            {{ Auth::guard('mahasiswa')->user()->unreadNotifications->count() }}
                                        </span>
                                        <i class="fas fa-bell fa-fw"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end dropdown-list animated--grow-in">
                                        <h6 class="dropdown-header">Alerts Center</h6>
                                        @forelse (Auth::guard('mahasiswa')->user()->notifications as $notif)
                                            <a class="dropdown-item d-flex align-items-center" href="#">
                                                <div class="me-3">
                                                    <div class="bg-warning icon-circle">
                                                        <i class="fas fa-exclamation-triangle text-white"></i>
                                                    </div>
                                                </div>
                                                <div>
                                                    <span class="small text-gray-500">{{ $notif->created_at->format('d M Y H:i') }}</span>
                                                    <p>{{ $notif->data['pesan'] }}</p>
                                                </div>
                                            </a>
                                        @empty
                                            <a class="dropdown-item text-center small text-gray-500" href="#">Tidak ada notifikasi</a>
                                        @endforelse
                                        <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                                    </div>
                                </div>
                            </li>
                            <div class="d-none d-sm-block topbar-divider"></div>
                            <li class="nav-item dropdown no-arrow">
                                <div class="nav-item dropdown no-arrow">
                                    <a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#">
                                        <span class="d-none d-lg-inline me-2 text-gray-600 small">{{ Auth::guard('mahasiswa')->user()->nama_pengguna }}</span>
                                        <span class="badge rounded-pill me-2" style="background: #881d1d;">Mahasiswa</span>
                                        <img class="border rounded-circle img-profile" src="{{ asset('/storage/assets/img/avatars/'.(Auth::guard('mahasiswa')->user()->foto ?? 'default.jpg')) }}">
                                    </a>
                                    <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in">
                                        <a class="dropdown-item" href="/mahasiswa/profil">
                                            <i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Profil
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="/logout">
                                            <i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Keluar
                                        </a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>

                <div class="container-fluid main-content">
@php
    $kelompokSaya = \App\Models\Kelompok::where('nim', Auth::guard('mahasiswa')->user()->nim)->first();
    $bolehKumpul = false;
    $dokumenKelompok = collect();
    $dokumenKelompokList = collect();
    $bimbinganKelompok = collect();
    if ($kelompokSaya) {
        $judul = $kelompokSaya->judul;
        $kuota = \App\Models\DaftarTopik::where('judul', $judul)->first()->kuota ?? 99;
        $statusTopik = \App\Models\DaftarTopik::where('judul', $judul)->first()->status ?? null;
        $jumlahAnggota = \App\Models\Kelompok::where('judul', $judul)->count();
        if (($statusTopik === 'Proposal' || $statusTopik === 'TA') || ($jumlahAnggota >= $kuota && $statusTopik === 'Full')) {
            $bolehKumpul = true;
        }
        $nims = \App\Models\Kelompok::where('judul', $judul)->pluck('nim');
        $dokumenKelompok = \App\Models\DokumenMahasiswa::whereIn('nim', $nims)->orderByDesc('created_at')->get();
        $anggotaNama = \App\Models\Kelompok::where('judul', $judul)->pluck('nama_anggota','nim');
        $dokumenKelompokList = \App\Models\DokumenMahasiswa::whereIn('nim', $nims)->orderBy('judul')->get();
        $bimbinganKelompok = \App\Models\Bimbingan::whereIn('nim', $nims)->orderByDesc('created_at')->get();
    }
@endphp

<div class="d-sm-flex justify-content-between align-items-center mb-4">
    <h3 class="text-dark mb-0">Dokumen & Bimbingan</h3>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="card shadow">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h5 class="text-dark m-0 fw-bold">
                        <i class="fas fa-upload me-2" style="color: #881d1d;"></i>
                        Pengumpulan Dokumen
                    </h5>
                    <span class="badge badge-dokumen">{{ $dokumenKelompok->count() }} Dokumen</span>
                </div>
                <div class="card-body">
                    @if(!$kelompokSaya)
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            Anda belum memiliki kelompok. Tidak dapat mengumpulkan dokumen.
                        </div>
                    @elseif(!$bolehKumpul)
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>
                            Dokumen hanya dapat dikumpulkan jika kelompok Anda sudah <strong>penuh</strong> dan status topik <strong>Full</strong> atau <strong>Proposal</strong> atau <strong>TA</strong>.
                        </div>
                    @endif
                    
                    <form action="{{ route('mahasiswa.store_dokumen') }}" method="POST" @if(!$bolehKumpul) style="pointer-events:none;opacity:0.6;" @endif>
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Nama atau Judul Dokumen</label>
                            <input type="text" name="judul" class="form-control" required maxlength="255" @if(!$bolehKumpul) disabled @endif>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Link Dokumen (Google Drive, OneDrive, Dropbox, SharePoint)</label>
                            <input type="url" name="link" class="form-control" required @if(!$bolehKumpul) disabled @endif>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <button class="btn btn-primary" type="submit" @if(!$bolehKumpul) disabled @endif>
                                <i class="fas fa-upload me-2"></i>
                                Submit
                            </button>
                            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#logDokumenModal">
                                <i class="fas fa-history me-2"></i>
                                Lihat Log Dokumen
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-lg-6 mb-4">
            <div class="card shadow">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h5 class="text-dark m-0 fw-bold">
                        <i class="fas fa-comments me-2" style="color: #881d1d;"></i>
                        Pengajuan Bimbingan
                    </h5>
                    <span class="badge badge-bimbingan">{{ $bimbinganKelompok->count() }} Bimbingan</span>
                </div>
                <div class="card-body">
                    @if(!$kelompokSaya)
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            Anda belum memiliki kelompok. Tidak dapat mengajukan bimbingan.
                        </div>
                    @endif
                    
                    <form action="{{ route('mahasiswa.store_bimbingan') }}" method="POST" @if(!$kelompokSaya) style="pointer-events:none;opacity:0.6;" @endif>
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Pilih Dokumen Terkait</label>
                            <select id="selectDokumen" name="dokumen_terkait" class="form-select">
                                <option value="">-- Pilih Dokumen Terkait --</option>
                                @foreach($dokumenKelompokList as $dok)
                                    <option value="{{ $dok->id }}">{{ $dok->judul }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Topik Bimbingan</label>
                            <input type="text" name="judul" id="judulBimbingan" class="form-control" required maxlength="255">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Pilih Pembimbing</label>
                            <select name="pembimbing" class="form-select" required @if(!$kelompokSaya) disabled @endif>
                                <option value="1">Pembimbing 1{{ $pembimbingSatu ? ' ('.$pembimbingSatu.')' : '' }}</option>
                                <option value="2" @if(!$pembimbingDua || $statusPembimbingDua!=='accepted') disabled @endif>
                                    Pembimbing 2{{ $pembimbingDua ? ' ('.$pembimbingDua.')' : '' }}
                                </option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Waktu yang Diusulkan</label>
                            <input type="text" id="jadwalBimbingan" name="jadwal" class="form-control" required @if(!$kelompokSaya) disabled @endif>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Materi yang Akan Dibahas</label>
                            <textarea name="catatan" class="form-control" @if(!$kelompokSaya) disabled @endif></textarea>
                        </div>
                                                <div class="d-flex align-items-center gap-2">
                            <button class="btn btn-primary" type="submit" @if(!$kelompokSaya) disabled @endif>
                                <i class="fas fa-paper-plane me-2"></i>
                                Ajukan Bimbingan
                            </button>
                            <button type="button" class="btn btn-outline-primary" data-bs-toggle="offcanvas" data-bs-target="#offcanvasLogBimbingan">
                                <i class="fas fa-history me-2"></i>
                                Lihat Log Bimbingan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@if(session('success'))
<script>Swal.fire({icon:'success',title:'Berhasil',text:'{{ session('success') }}',showConfirmButton:false,timer:2000});</script>
@endif
@if(session('error'))
<script>Swal.fire({icon:'error',title:'Gagal',text:'{{ session('error') }}',showConfirmButton:false,timer:2000});</script>
@endif
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
flatpickr("#jadwalBimbingan", {
    enableTime: true,
    dateFormat: "Y-m-d H:i",
    time_24hr: true
});
</script>


<!-- Log Dokumen Modal -->
<div class="modal fade document-modal" id="logDokumenModal" tabindex="-1" aria-labelledby="logDokumenModalLabel" aria-hidden="true" data-bs-backdrop="static">
  <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header bg-gradient-primary">
        <div class="d-flex align-items-center">
          <div class="modal-icon me-3">
            <i class="fas fa-file-alt"></i>
      </div>
          <div>
            <h5 class="modal-title text-white mb-0" id="logDokumenModalLabel">Log Dokumen</h5>
            <small class="text-white-50">Riwayat pengumpulan dokumen kelompok Anda</small>
          </div>
        </div>
        <button type="button" class="btn-close btn-close-white" onclick="closeModal('logDokumenModal')" aria-label="Close"></button>
      </div>
      <div class="modal-body p-0">
        @if($dokumenKelompok->count() > 0)
          <div class="document-log-container">
            @foreach($dokumenKelompok as $i => $d)
              <div class="document-card">
                <div class="document-header">
                  <div class="document-number">{{ $i+1 }}</div>
                  <div class="document-info">
                    <h6 class="document-title">{{ $d->judul }}</h6>
                    <p class="document-subtitle">{{ $anggotaNama[$d->nim] ?? '-' }}</p>
                  </div>
                  <div class="document-actions">
                    <a href="{{ $d->link }}" target="_blank" class="btn btn-outline-primary btn-sm">
                      <i class="fas fa-external-link-alt me-1"></i>Lihat Dokumen
                    </a>
                  </div>
                </div>
                
                <div class="document-details">
                  <div class="detail-row">
                    <div class="detail-label">
                      <i class="fas fa-calendar-alt me-2"></i>Tanggal Upload
                    </div>
                    <div class="detail-value">{{ $d->created_at->format('d M Y, H:i') }}</div>
                  </div>
                  
                  <div class="detail-row">
                    <div class="detail-label">
                      <i class="fas fa-link me-2"></i>Link Dokumen
                    </div>
                    <div class="detail-value">
                      <a href="{{ $d->link }}" target="_blank" class="document-link">
                        <i class="fas fa-external-link-alt me-1"></i>{{ Str::limit($d->link, 50) }}
                      </a>
                    </div>
                  </div>
                  
                  <div class="detail-row">
                    <div class="detail-label">
                      <i class="fas fa-user me-2"></i>Pengunggah
                    </div>
                    <div class="detail-value">{{ $anggotaNama[$d->nim] ?? '-' }}</div>
                  </div>
                  
                  <div class="detail-row">
                    <div class="detail-label">
                      <i class="fas fa-cog me-2"></i>Aksi
                    </div>
                    <div class="detail-value">
                        <form action="{{ route('mahasiswa.hapus_dokumen', $d->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin hapus dokumen ini?')">
                            @csrf
                            @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger btn-sm">
                          <i class="fas fa-trash me-1"></i>Hapus Dokumen
                        </button>
                        </form>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        @else
          <div class="empty-state">
            <div class="empty-icon">
              <i class="fas fa-file-upload"></i>
            </div>
            <h5 class="empty-title">Belum Ada Dokumen</h5>
            <p class="empty-description">Anda belum mengunggah dokumen. Mulai dengan mengunggah dokumen pertama Anda.</p>
          </div>
        @endif
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" onclick="closeModal('logDokumenModal')">
          <i class="fas fa-times me-2"></i>Tutup
        </button>
      </div>
    </div>
  </div>
</div>

<!-- Offcanvas Log Bimbingan -->
<div class="offcanvas offcanvas-top offcanvas-log-bimbingan" tabindex="-1" id="offcanvasLogBimbingan" aria-labelledby="offcanvasLogBimbinganLabel">
  <div class="offcanvas-header bg-gradient-primary">
    <div class="d-flex align-items-center">
      <div class="offcanvas-icon me-3">
        <i class="fas fa-history"></i>
  </div>
      <div>
        <h5 class="offcanvas-title text-white mb-0" id="offcanvasLogBimbinganLabel">Log Bimbingan</h5>
        <small class="text-white-50">Riwayat pengajuan bimbingan kelompok Anda</small>
      </div>
    </div>
    <button type="button" class="btn-close btn-close-white" onclick="closeOffcanvas('offcanvasLogBimbingan')" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body p-0">
    @if($bimbinganKelompok->count() > 0)
      <div class="guidance-log-container">
        @foreach($bimbinganKelompok as $i => $b)
          <div class="guidance-card">
            <div class="guidance-header">
              <div class="guidance-number">{{ $i+1 }}</div>
              <div class="guidance-info">
                <h6 class="guidance-title">{{ $b->judul }}</h6>
                <p class="guidance-subtitle">{{ $anggotaNama[$b->nim] ?? '-' }}</p>
              </div>
              <div class="guidance-status">
                @if($b->status=='pending')
                  <span class="status-badge status-pending">
                    <i class="fas fa-clock me-1"></i>Pending
                  </span>
                @elseif($b->status=='accepted')
                  <span class="status-badge status-accepted">
                    <i class="fas fa-check me-1"></i>Accepted
                  </span>
                @elseif($b->status=='rejected')
                  <span class="status-badge status-rejected">
                    <i class="fas fa-times me-1"></i>Rejected
                  </span>
                @elseif($b->status=='selesai')
                  <span class="status-badge status-completed">
                    <i class="fas fa-flag-checkered me-1"></i>Selesai
                  </span>
                @endif
              </div>
            </div>
            
            <div class="guidance-details">
              <div class="detail-row">
                <div class="detail-label">
                  <i class="fas fa-user-tie me-2"></i>Pembimbing
                </div>
                <div class="detail-value">{{ $b->pembimbing == '1' ? 'Pembimbing 1' : 'Pembimbing 2' }}</div>
              </div>
              
              <div class="detail-row">
                <div class="detail-label">
                  <i class="fas fa-calendar-alt me-2"></i>Jadwal
                </div>
                <div class="detail-value">{{ \Carbon\Carbon::parse($b->jadwal)->format('d M Y, H:i') }}</div>
              </div>
              
              <div class="detail-row">
                <div class="detail-label">
                  <i class="fas fa-sticky-note me-2"></i>Materi
                </div>
                <div class="detail-value">
                  <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalMateri{{ $b->id }}">
                    <i class="fas fa-eye me-1"></i>Lihat Materi
                    </button>
                </div>
              </div>
              
              <div class="detail-row">
                <div class="detail-label">
                  <i class="fas fa-comment me-2"></i>Catatan
                </div>
                <div class="detail-value">
                    @if($b->status=='rejected')
                    <button class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalCatatanPembimbing{{ $b->id }}">
                      <i class="fas fa-exclamation-triangle me-1"></i>Lihat Alasan
                        </button>
                    @elseif($b->kritik_saran && $b->status!='rejected')
                    <button class="btn btn-outline-info btn-sm" data-bs-toggle="modal" data-bs-target="#modalCatatanPembimbing{{ $b->id }}">
                      <i class="fas fa-lightbulb me-1"></i>Lihat Catatan
                        </button>
                    @else
                    <span class="text-muted">-</span>
                    @endif
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    @else
      <div class="empty-state">
        <div class="empty-icon">
          <i class="fas fa-comments"></i>
        </div>
        <h5 class="empty-title">Belum Ada Bimbingan</h5>
        <p class="empty-description">Anda belum mengajukan bimbingan. Mulai dengan mengajukan bimbingan pertama Anda.</p>
      </div>
    @endif
  </div>
</div>

<!-- Modal untuk setiap bimbingan, diletakkan di luar tabel agar Bootstrap modal berfungsi -->
@foreach($bimbinganKelompok as $b)
    <!-- Modal Materi Bimbingan -->
        <div class="modal fade guidance-modal" id="modalMateri{{ $b->id }}" tabindex="-1" aria-labelledby="modalMateriLabel{{ $b->id }}" aria-hidden="true" data-bs-backdrop="static">
            <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                    <div class="modal-header bg-gradient-primary">
                        <div class="d-flex align-items-center">
                            <div class="modal-icon me-3">
                                <i class="fas fa-sticky-note"></i>
                            </div>
                            <div>
                                <h5 class="modal-title text-white mb-0" id="modalMateriLabel{{ $b->id }}">Materi Bimbingan</h5>
                                <small class="text-white-50">{{ $b->judul }}</small>
                            </div>
                        </div>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                        <div class="materi-content">
                            @if($b->catatan)
                                <div class="content-text">
                                    {{ $b->catatan }}
                                </div>
                            @else
                                <div class="empty-content">
                                    <i class="fas fa-file-alt"></i>
                                    <p>Tidak ada materi yang dibahas</p>
                                </div>
                            @endif
                        </div>
                </div>
                <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times me-2"></i>Tutup
                        </button>
                </div>
            </div>
        </div>
    </div>
        
    <!-- Modal Catatan Pembimbing -->
        <div class="modal fade guidance-modal" id="modalCatatanPembimbing{{ $b->id }}" tabindex="-1" aria-labelledby="modalCatatanPembimbingLabel{{ $b->id }}" aria-hidden="true" data-bs-backdrop="static">
            <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                    <div class="modal-header bg-gradient-primary">
                        <div class="d-flex align-items-center">
                            <div class="modal-icon me-3">
                                <i class="fas fa-comment"></i>
                            </div>
                            <div>
                                <h5 class="modal-title text-white mb-0" id="modalCatatanPembimbingLabel{{ $b->id }}">
                                    @if($b->status=='rejected') 
                                        <i class="fas fa-exclamation-triangle me-2"></i>Alasan Penolakan
                                    @else 
                                        <i class="fas fa-lightbulb me-2"></i>Catatan Pembimbing
                                    @endif
                    </h5>
                                <small class="text-white-50">{{ $b->judul }}</small>
                            </div>
                        </div>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                        <div class="catatan-content">
                    @if($b->status=='rejected')
                                <div class="rejection-reason">
                                    <div class="reason-icon">
                                        <i class="fas fa-times-circle"></i>
                                    </div>
                                    <div class="reason-text">
                                        <h6>Alasan Penolakan:</h6>
                                        <p>{{ $b->alasan_tolak ?? 'Tidak ada alasan yang diberikan' }}</p>
                                    </div>
                                </div>
                    @elseif($b->kritik_saran && $b->status!='rejected')
                                <div class="feedback-content">
                                    <div class="feedback-icon">
                                        <i class="fas fa-lightbulb"></i>
                                    </div>
                                    <div class="feedback-text">
                                        <h6>Catatan Pembimbing:</h6>
                                        <p>{{ $b->kritik_saran }}</p>
                                    </div>
                                </div>
                    @else
                                <div class="empty-content">
                                    <i class="fas fa-comment-slash"></i>
                                    <p>Tidak ada catatan dari pembimbing</p>
                                </div>
                    @endif
                        </div>
                </div>
                <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times me-2"></i>Tutup
                        </button>
                </div>
            </div>
        </div>
    </div>
@endforeach
<style>
/* Page Header Styling */
.page-header {
    background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
    border-radius: 16px;
    padding: 2rem;
    border: 1px solid #e2e8f0;
    margin-bottom: 2rem;
}

.page-icon {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #881d1d 0%, #a83232 100%);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.5em;
    box-shadow: 0 4px 12px rgba(136,29,29,0.2);
}

.page-header h3 {
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 0.5rem;
}

.page-header p {
    color: #64748b;
    font-size: 1em;
    line-height: 1.5;
}

/* Card Styling */
.document-card, .guidance-card {
    border-radius: 16px;
    border: none;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
    overflow: hidden;
}

.document-card:hover, .guidance-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.12);
}

.document-card .card-header, .guidance-card .card-header {
    background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
    border-bottom: 2px solid #e2e8f0;
    padding: 1.5rem;
}

.document-card .card-header h5, .guidance-card .card-header h5 {
    color: #1e293b;
    font-size: 1.1em;
}

/* Status Messages */
.status-message {
    margin-bottom: 1.5rem;
}

.status-card {
    display: flex;
    align-items: flex-start;
    padding: 1.25rem;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    border: 1px solid;
}

.status-warning-card {
    background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
    border-color: #f59e0b;
}

.status-info-card {
    background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
    border-color: #3b82f6;
}

.status-icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 1rem;
    flex-shrink: 0;
}

.status-warning-card .status-icon {
    background: #f59e0b;
    color: white;
}

.status-info-card .status-icon {
    background: #3b82f6;
    color: white;
}

.status-icon i {
    font-size: 1.1em;
}

.status-content h6 {
    font-weight: 600;
    margin-bottom: 0.5rem;
    color: #1e293b;
}

.status-content p {
    color: #64748b;
    margin: 0;
    line-height: 1.5;
    font-size: 0.95em;
}

/* Form Styling */
.form-group {
    margin-bottom: 1.5rem;
}

.form-label {
    display: flex;
    align-items: center;
    font-weight: 600;
    color: #374151;
    margin-bottom: 0.75rem;
    font-size: 0.95em;
}

.form-label i {
    color: #881d1d;
    margin-right: 0.5rem;
    width: 16px;
    text-align: center;
}

.modern-input, .modern-select, .modern-textarea {
    border: 2px solid #e2e8f0;
    border-radius: 8px;
    padding: 0.75rem 1rem;
    font-size: 0.95em;
    transition: all 0.3s ease;
    background: #ffffff;
}

.modern-input:focus, .modern-select:focus, .modern-textarea:focus {
    border-color: #881d1d;
    box-shadow: 0 0 0 3px rgba(136, 29, 29, 0.1);
    outline: none;
}

.modern-textarea {
    resize: vertical;
    min-height: 100px;
}

.input-group-text {
    background: #f8fafc;
    border: 2px solid #e2e8f0;
    border-right: none;
    color: #64748b;
    font-size: 0.9em;
}

.input-group .modern-input {
    border-left: none;
}

.form-text {
    font-size: 0.85em;
    color: #64748b;
    margin-top: 0.5rem;
}

/* Form Actions */
.form-actions {
    display: flex;
    gap: 1rem;
    margin-top: 2rem;
    flex-wrap: wrap;
}

.btn-submit {
    background: linear-gradient(135deg, #881d1d 0%, #a83232 100%);
    border: none;
    border-radius: 8px;
    padding: 0.75rem 1.5rem;
    font-weight: 600;
    font-size: 0.95em;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(136,29,29,0.2);
    flex: 1;
    min-width: 200px;
}

.btn-submit:hover {
    background: linear-gradient(135deg, #6e1717 0%, #881d1d 100%);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(136,29,29,0.3);
}

.btn-submit:disabled {
    background: #9ca3af;
    transform: none;
    box-shadow: none;
    cursor: not-allowed;
}

.btn-log {
    border: 2px solid #3b82f6;
    color: #3b82f6;
    border-radius: 8px;
    padding: 0.75rem 1.5rem;
    font-weight: 600;
    font-size: 0.95em;
    transition: all 0.3s ease;
    background: transparent;
    flex: 1;
    min-width: 200px;
}

.btn-log:hover {
    background: #3b82f6;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(59,130,246,0.3);
}

/* Badge Styling */
.badge {
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-weight: 600;
    font-size: 0.85em;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.badge.bg-primary {
    background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%) !important;
}

.badge.bg-success {
    background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%) !important;
}

/* Responsive Design */
@media (max-width: 768px) {
    .page-header {
        padding: 1.5rem;
        text-align: center;
    }
    
    .page-icon {
        margin: 0 auto 1rem auto;
    }
    
    .form-actions {
        flex-direction: column;
    }
    
    .btn-submit, .btn-log {
        flex: none;
        width: 100%;
    }
    
    .status-card {
        flex-direction: column;
        text-align: center;
    }
    
    .status-icon {
        margin: 0 auto 1rem auto;
    }
    
    .card-header {
        flex-direction: column;
        gap: 1rem;
        text-align: center;
    }
}

@media (min-width: 768px) {
    .offcanvas-log-bimbingan {
        width: 80vw !important;
        max-width: 100vw;
    }
}
</style>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('/storage/assets/js/script.js') }}"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
<script>
        // Sidebar toggle functionality
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebarToggleTop = document.getElementById('sidebarToggleTop');
            const sidebar = document.querySelector('.sidebar');
            const contentWrapper = document.getElementById('content-wrapper');
            
            function toggleSidebar() {
                sidebar.classList.toggle('show');
                if (window.innerWidth <= 768) {
                    contentWrapper.style.marginLeft = sidebar.classList.contains('show') ? '280px' : '0';
                }
            }
            
            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', toggleSidebar);
            }
            
            if (sidebarToggleTop) {
                sidebarToggleTop.addEventListener('click', toggleSidebar);
            }
            
            // Close sidebar when clicking outside on mobile
            document.addEventListener('click', function(event) {
                if (window.innerWidth <= 768 && sidebar.classList.contains('show')) {
                    if (!sidebar.contains(event.target) && !sidebarToggleTop.contains(event.target)) {
                        sidebar.classList.remove('show');
                        contentWrapper.style.marginLeft = '0';
                    }
                }
            });
            
            // Initialize Bootstrap components
            if (typeof bootstrap !== 'undefined') {
                // Initialize all modals
                const modals = document.querySelectorAll('.modal');
                modals.forEach(modal => {
                    new bootstrap.Modal(modal);
                });
                
                // Initialize all offcanvas
                const offcanvasElements = document.querySelectorAll('.offcanvas');
                offcanvasElements.forEach(offcanvas => {
                    new bootstrap.Offcanvas(offcanvas);
                });
            }
        });
        
        // Modal and Offcanvas event handlers
        document.addEventListener('DOMContentLoaded', function() {
            // Log Dokumen Modal
            const logDokumenBtn = document.querySelector('[data-bs-target="#logDokumenModal"]');
            if (logDokumenBtn) {
                logDokumenBtn.addEventListener('click', function() {
                    const modalElement = document.getElementById('logDokumenModal');
                    if (modalElement) {
                        // Ensure modal is properly initialized
                        let modal = bootstrap.Modal.getInstance(modalElement);
                        if (!modal) {
                            modal = new bootstrap.Modal(modalElement, {
                                backdrop: 'static',
                                keyboard: true
                            });
                        }
                        modal.show();
                        
                        // Ensure modal content is clickable
                        setTimeout(() => {
                            modalElement.style.pointerEvents = 'auto';
                            const modalContent = modalElement.querySelector('.modal-content');
                            if (modalContent) {
                                modalContent.style.pointerEvents = 'auto';
                            }
                        }, 100);
                    }
                });
            }
            
            // Log Bimbingan Offcanvas
            const logBimbinganBtn = document.querySelector('[data-bs-target="#offcanvasLogBimbingan"]');
            if (logBimbinganBtn) {
                logBimbinganBtn.addEventListener('click', function() {
                    const offcanvasElement = document.getElementById('offcanvasLogBimbingan');
                    const offcanvas = new bootstrap.Offcanvas(offcanvasElement);
                    offcanvas.show();
                });
            }
            
            // Handle modal close events
            const logDokumenModal = document.getElementById('logDokumenModal');
            if (logDokumenModal) {
                logDokumenModal.addEventListener('hidden.bs.modal', function() {
                    // Remove any remaining backdrop
                    const backdrops = document.querySelectorAll('.modal-backdrop');
                    backdrops.forEach(backdrop => {
                        backdrop.remove();
                    });
                    
                    // Remove modal-open class from body
                    document.body.classList.remove('modal-open');
                    document.body.style.paddingRight = '';
                    
                    // Ensure content is visible
                    document.body.style.overflow = '';
                });
            }
            
            // Handle offcanvas close events
            const logBimbinganOffcanvas = document.getElementById('offcanvasLogBimbingan');
            if (logBimbinganOffcanvas) {
                logBimbinganOffcanvas.addEventListener('hidden.bs.offcanvas', function() {
                    // Remove any remaining backdrop
                    const backdrops = document.querySelectorAll('.offcanvas-backdrop');
                    backdrops.forEach(backdrop => {
                        backdrop.remove();
                    });
                    
                    // Remove offcanvas-open class from body
                    document.body.classList.remove('offcanvas-open');
                    document.body.style.paddingRight = '';
                    
                    // Ensure content is visible
                    document.body.style.overflow = '';
                });
            }
        });
        
        // Global modal and offcanvas management
        // Handle backdrop clicks
        document.addEventListener('click', function(event) {
            if (event.target.classList.contains('modal-backdrop')) {
                const modal = event.target.nextElementSibling;
                if (modal && modal.classList.contains('modal')) {
                    closeModal(modal.id);
                }
            }
            
            if (event.target.classList.contains('offcanvas-backdrop')) {
                const offcanvas = event.target.nextElementSibling;
                if (offcanvas && offcanvas.classList.contains('offcanvas')) {
                    closeOffcanvas(offcanvas.id);
                }
            }
        });
        
        document.addEventListener('hidden.bs.modal', function (event) {
            // Clean up modal backdrop
            const backdrops = document.querySelectorAll('.modal-backdrop');
            backdrops.forEach(backdrop => {
                backdrop.remove();
            });
            
            // Clean up body classes and styles
            document.body.classList.remove('modal-open');
            document.body.style.paddingRight = '';
            document.body.style.overflow = '';
            
            // Ensure content wrapper is visible
            const contentWrapper = document.getElementById('content-wrapper');
            if (contentWrapper) {
                contentWrapper.style.display = 'flex';
                contentWrapper.style.flexDirection = 'column';
            }
        });
        
document.addEventListener('hidden.bs.offcanvas', function (event) {
            // Clean up offcanvas backdrop
            const backdrops = document.querySelectorAll('.offcanvas-backdrop');
            backdrops.forEach(backdrop => {
                backdrop.remove();
            });
            
            // Clean up body classes and styles
            document.body.classList.remove('offcanvas-open');
            document.body.style.paddingRight = '';
            document.body.style.overflow = '';
            
            // Ensure content wrapper is visible
            const contentWrapper = document.getElementById('content-wrapper');
            if (contentWrapper) {
                contentWrapper.style.display = 'flex';
                contentWrapper.style.flexDirection = 'column';
            }
        });
        
        document.addEventListener('shown.bs.modal', function (event) {
            // Ensure proper z-index for modal
            const modal = event.target;
            modal.style.zIndex = '1050';
            
            // Ensure backdrop is properly positioned
            const backdrop = document.querySelector('.modal-backdrop');
            if (backdrop) {
                backdrop.style.zIndex = '1040';
            }
        });
        
document.addEventListener('shown.bs.offcanvas', function (event) {
            // Ensure proper z-index for offcanvas
            const offcanvas = event.target;
            offcanvas.style.zIndex = '1050';
            
            // Ensure backdrop is properly positioned
            const backdrop = document.querySelector('.offcanvas-backdrop');
            if (backdrop) {
                backdrop.style.zIndex = '1040';
            }
        });
        
        // Manual close functions
        function closeModal(modalId) {
            const modalElement = document.getElementById(modalId);
            if (modalElement) {
                const modal = bootstrap.Modal.getInstance(modalElement);
                if (modal) {
                    modal.hide();
                } else {
                    // Fallback: manually hide modal
                    modalElement.classList.remove('show');
                    modalElement.style.display = 'none';
                    modalElement.style.visibility = 'hidden';
                    
                    // Remove backdrop
                    const backdrops = document.querySelectorAll('.modal-backdrop');
                    backdrops.forEach(backdrop => backdrop.remove());
                    
                    // Clean up body
                    document.body.classList.remove('modal-open');
                    document.body.style.paddingRight = '';
                    document.body.style.overflow = '';
                    
                    // Reset pointer events
                    modalElement.style.pointerEvents = '';
                    const modalContent = modalElement.querySelector('.modal-content');
                    if (modalContent) {
                        modalContent.style.pointerEvents = '';
                    }
                }
            }
        }
        
        function closeOffcanvas(offcanvasId) {
            const offcanvasElement = document.getElementById(offcanvasId);
            if (offcanvasElement) {
                const offcanvas = bootstrap.Offcanvas.getInstance(offcanvasElement);
                if (offcanvas) {
                    offcanvas.hide();
                } else {
                    // Fallback: manually hide offcanvas
                    offcanvasElement.classList.remove('show');
                    offcanvasElement.style.visibility = 'hidden';
                    
                    // Remove backdrop
                    const backdrops = document.querySelectorAll('.offcanvas-backdrop');
                    backdrops.forEach(backdrop => backdrop.remove());
                    
                    // Clean up body
                    document.body.classList.remove('offcanvas-open');
                    document.body.style.paddingRight = '';
                    document.body.style.overflow = '';
                }
            }
        }
        
                // Debug: Check if Bootstrap is loaded
        window.addEventListener('load', function() {
            if (typeof bootstrap === 'undefined') {
                console.error('Bootstrap is not loaded!');
            } else {
                console.log('Bootstrap loaded successfully');
            }
        });
        
        // Ensure all modal buttons are clickable
        document.addEventListener('DOMContentLoaded', function() {
            // Handle all buttons inside document modal
            document.addEventListener('click', function(event) {
                if (event.target.closest('.document-modal')) {
                    // Ensure the clicked element is interactive
                    event.target.style.pointerEvents = 'auto';
                    
                    // If it's a button or link, ensure it's clickable
                    if (event.target.tagName === 'BUTTON' || event.target.tagName === 'A' || event.target.closest('button') || event.target.closest('a')) {
                        event.stopPropagation();
                    }
                }
            });
            
            // Handle form submissions in modal
            document.addEventListener('submit', function(event) {
                if (event.target.closest('.document-modal')) {
                    // Ensure form submission works
                    event.stopPropagation();
                }
            });
        });
        
        // Guidance Modal Event Handlers
        document.addEventListener('DOMContentLoaded', function() {
            // Handle guidance modal events
            const guidanceModals = document.querySelectorAll('.guidance-modal');
            
            guidanceModals.forEach(modal => {
                modal.addEventListener('show.bs.modal', function() {
                    // Ensure backdrop is properly created
                    const backdrop = document.createElement('div');
                    backdrop.className = 'modal-backdrop fade show';
                    backdrop.style.zIndex = '1055';
                    backdrop.style.backgroundColor = 'rgba(0, 0, 0, 0.6)';
                    document.body.appendChild(backdrop);
                    
                    // Add modal-open class to body
                    document.body.classList.add('modal-open');
                    document.body.style.paddingRight = '0';
                });
                
                modal.addEventListener('hidden.bs.modal', function() {
                    // Remove backdrop
                    const backdrops = document.querySelectorAll('.modal-backdrop');
                    backdrops.forEach(backdrop => backdrop.remove());
                    
                    // Remove modal-open class from body
                    document.body.classList.remove('modal-open');
                    document.body.style.paddingRight = '';
                });
                
                // Handle backdrop click to close modal
                modal.addEventListener('click', function(event) {
                    if (event.target === modal) {
                        const modalInstance = bootstrap.Modal.getInstance(modal);
                        if (modalInstance) {
                            modalInstance.hide();
                        }
                    }
                });
            });
            
            // Handle document modal events
            const documentModals = document.querySelectorAll('.document-modal');
            
            documentModals.forEach(modal => {
                modal.addEventListener('show.bs.modal', function() {
                    // Ensure backdrop is properly created
                    const backdrop = document.createElement('div');
                    backdrop.className = 'modal-backdrop fade show';
                    backdrop.style.zIndex = '1055';
                    backdrop.style.backgroundColor = 'rgba(0, 0, 0, 0.6)';
                    document.body.appendChild(backdrop);
                    
                    // Add modal-open class to body
                    document.body.classList.add('modal-open');
                    document.body.style.paddingRight = '0';
                    
                    // Ensure modal is clickable
                    modal.style.pointerEvents = 'auto';
                    const modalContent = modal.querySelector('.modal-content');
                    if (modalContent) {
                        modalContent.style.pointerEvents = 'auto';
                    }
                });
                
                modal.addEventListener('hidden.bs.modal', function() {
                    // Remove backdrop
                    const backdrops = document.querySelectorAll('.modal-backdrop');
                    backdrops.forEach(backdrop => backdrop.remove());
                    
                    // Remove modal-open class from body
                    document.body.classList.remove('modal-open');
                    document.body.style.paddingRight = '';
                    document.body.style.overflow = '';
                    
                    // Reset pointer events
                    modal.style.pointerEvents = '';
                    const modalContent = modal.querySelector('.modal-content');
                    if (modalContent) {
                        modalContent.style.pointerEvents = '';
                    }
                });
                
                // Handle backdrop click to close modal
                modal.addEventListener('click', function(event) {
                    if (event.target === modal) {
                        const modalInstance = bootstrap.Modal.getInstance(modal);
                        if (modalInstance) {
                            modalInstance.hide();
                        }
                    }
                });
                
                // Prevent event bubbling on modal content
                const modalContent = modal.querySelector('.modal-content');
                if (modalContent) {
                    modalContent.addEventListener('click', function(event) {
                        event.stopPropagation();
                    });
                }
            });
        });
</script>
</body>
</html> 