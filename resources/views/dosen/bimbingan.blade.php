<!DOCTYPE html>
<html data-bs-theme="light" lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Bimbingan Mahasiswa - TAKU</title>
    <link rel="stylesheet" href="{{ asset('/storage/assets/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto&amp;display=swap">
    <link rel="stylesheet" href="{{ asset('/storage/assets/fonts/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/storage/assets/fonts/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/storage/assets/fonts/fontawesome5-overrides.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/storage/assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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
        }
        #wrapper {
            display: flex;
        }
        .sidebar {
            background: var(--primary-color) !important;
            transition: width 0.3s ease;
        }
        .sidebar .sidebar-brand {
            height: 60px;
            transition: background-color 0.2s ease;
        }
        .sidebar .sidebar-brand:hover {
            background-color: var(--primary-darker);
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
        @media (max-width: 768px) {
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
        
        /* Modern UI Styling */
        :root {
            --primary-gradient: linear-gradient(135deg, #881d1d 0%, #a83232 100%);
            --secondary-gradient: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            --success-gradient: linear-gradient(135deg, #dcfce7 0%, #bbf7d0 100%);
            --warning-gradient: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
            --danger-gradient: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
            --info-gradient: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        /* Enhanced Card Styling */
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: var(--shadow-md);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            overflow: hidden;
            margin-bottom: 0;
        }
        
        /* Section spacing */
        .section-spacing {
            margin-bottom: 4rem;
        }
        
        .section-spacing:last-child {
            margin-bottom: 0;
        }

        .card:hover {
            box-shadow: var(--shadow-lg);
            transform: translateY(-1px);
        }

        .card-header {
            background: var(--secondary-gradient);
            border-bottom: 1px solid #e2e8f0;
            padding: 0.75rem 1.25rem;
            font-weight: 600;
            color: #1e293b;
            border-radius: 16px 16px 0 0;
        }

        /* Modern Filter Section */
        .filter-section {
            background: white;
            border-radius: 20px;
            box-shadow: var(--shadow-lg);
            border: 1px solid #f1f5f9;
            overflow: hidden;
        }

        .filter-section .card-header {
            background: var(--primary-gradient);
            color: white;
            border: none;
        }

        .filter-section .card-header h6 {
            margin: 0;
            font-weight: 600;
            font-size: 1.1rem;
        }

        .filter-section .card-body {
            padding: 1.5rem;
        }

        /* Enhanced Form Controls */
        .form-control, .form-select {
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            padding: 0.5rem 0.75rem;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            background: #f8fafc;
        }

        .form-control:focus, .form-select:focus {
            border-color: #881d1d;
            box-shadow: 0 0 0 3px rgba(136, 29, 29, 0.1);
            background: white;
        }

        .form-label {
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.25rem;
            font-size: 0.85rem;
        }

        /* Modern Buttons */
        .btn {
            border-radius: 8px;
            font-weight: 600;
            padding: 0.5rem 1rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: none;
            position: relative;
            overflow: hidden;
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }

        .btn:hover::before {
            left: 100%;
        }

        .btn-outline-primary {
            border: 2px solid #881d1d;
            color: #881d1d;
            background: transparent;
        }

        .btn-outline-primary:hover {
            background: #881d1d;
            color: white;
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        .btn-outline-secondary {
            border: 2px solid #6b7280;
            color: #6b7280;
            background: transparent;
        }

        .btn-outline-secondary:hover {
            background: #6b7280;
            color: white;
            transform: translateY(-2px);
        }

        .btn-outline-success {
            border: 2px solid #22c55e;
            color: #22c55e;
            background: transparent;
        }

        .btn-outline-success:hover {
            background: #22c55e;
            color: white;
            transform: translateY(-2px);
        }

        .btn-outline-info {
            border: 2px solid #38bdf8;
            color: #38bdf8;
            background: transparent;
        }

        .btn-outline-info:hover {
            background: #38bdf8;
            color: white;
            transform: translateY(-2px);
        }

        /* Enhanced Summary Cards */
        .summary-card {
            background: white;
            border-radius: 12px;
            box-shadow: var(--shadow-md);
            border: none;
            transition: all 0.3s ease;
            overflow: hidden;
            position: relative;
            height: 100%;
            min-height: 80px;
            margin-bottom: 1rem;
        }
        
        /* Header Layout Improvements */
        .header-section {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            border-radius: 12px;
            padding: 2rem;
            margin-bottom: 4rem;
            border: 1px solid #e2e8f0;
        }
        
        .page-title-compact {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 0;
            line-height: 1.2;
        }
        
        /* Additional spacing for header section */
        .header-section .row {
            margin-bottom: 0;
        }
        
        .header-section .row:last-child {
            margin-bottom: 0;
        }
        
        /* Extra spacing for summary cards row */
        .header-section .row:has(.summary-card) {
            margin-bottom: 2rem;
        }
        
        /* Alternative for browsers that don't support :has() */
        .summary-cards-row {
            margin-bottom: 2rem !important;
        }

        .summary-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--primary-gradient);
        }

        .summary-card.border-left-warning::before {
            background: linear-gradient(90deg, #f59e0b, #fbbf24);
        }

        .summary-card.border-left-success::before {
            background: linear-gradient(90deg, #22c55e, #4ade80);
        }

        .summary-card.border-left-info::before {
            background: linear-gradient(90deg, #38bdf8, #60a5fa);
        }

        .summary-card.border-left-primary::before {
            background: var(--primary-gradient);
        }
        
        /* Enhanced Summary Card Styling */
        .summary-card {
            position: relative;
            overflow: hidden;
        }
        
        .summary-card::after {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, transparent, rgba(255,255,255,0.1), transparent);
            transform: rotate(45deg);
            transition: all 0.6s ease;
            opacity: 0;
        }
        
        .summary-card:hover::after {
            opacity: 1;
            transform: rotate(45deg) translate(50%, 50%);
        }
        
        .summary-card .card-body {
            position: relative;
            z-index: 1;
        }
        
        .summary-card .bg-warning.bg-opacity-10,
        .summary-card .bg-success.bg-opacity-10,
        .summary-card .bg-info.bg-opacity-10,
        .summary-card .bg-primary.bg-opacity-10 {
            transition: all 0.3s ease;
        }
        
        .summary-card:hover .bg-warning.bg-opacity-10,
        .summary-card:hover .bg-success.bg-opacity-10,
        .summary-card:hover .bg-info.bg-opacity-10,
        .summary-card:hover .bg-primary.bg-opacity-10 {
            transform: scale(1.1);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }

        .summary-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-xl);
        }

        .summary-card .card-body {
            padding: 1.5rem;
        }

        /* Enhanced Statistics Cards */
        .stats-card {
            background: white;
            border-radius: 20px;
            box-shadow: var(--shadow-md);
            border: none;
            overflow: hidden;
        }

        .stats-item {
            background: white;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            padding: 0.75rem;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .stats-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: var(--secondary-gradient);
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: -1;
        }

        .stats-item:hover {
            transform: translateY(-4px) scale(1.02);
            box-shadow: var(--shadow-lg);
            border-color: #881d1d;
        }

        .stats-item:hover::before {
            opacity: 1;
        }

        .stats-item.active-stat {
            background: var(--primary-gradient);
            color: white;
            transform: scale(1.05);
            box-shadow: var(--shadow-xl);
            border-color: #881d1d;
        }

        .stats-item.active-stat .fw-bold,
        .stats-item.active-stat small {
            color: white !important;
        }

        /* Enhanced Table Styling */
        .table {
            border-radius: 16px;
            overflow: hidden;
            box-shadow: var(--shadow-md);
        }

        .table thead th {
            background: var(--secondary-gradient);
            border: none;
            padding: 0.75rem;
            font-weight: 600;
            color: #374151;
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 0.05em;
        }

        .table tbody tr {
            transition: all 0.3s ease;
            border: none;
        }

        .table tbody tr:hover {
            background: #f8fafc;
            transform: scale(1.005);
        }

        .table tbody td {
            padding: 0.75rem;
            border: none;
            border-bottom: 1px solid #f1f5f9;
            vertical-align: middle;
        }
        
        /* Compact Table Styling */
        .compact-table tbody td {
            padding: 0.4rem 0.5rem;
            font-size: 0.85rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 0;
        }
        
        .compact-table .btn-sm {
            padding: 0.2rem 0.4rem;
            font-size: 0.75rem;
            white-space: nowrap;
        }
        
        .compact-table th {
            white-space: nowrap;
            font-size: 0.8rem;
            font-weight: 600;
        }
        
        /* Table column specific styling */
        .compact-table td:nth-child(1) { /* # column */
            text-align: center;
            font-weight: 600;
        }
        
        .compact-table td:nth-child(6) { /* Jadwal column */
            font-size: 0.8rem;
        }
        
        .compact-table td:nth-child(7) { /* Status column */
            text-align: center;
        }
        
        .compact-table td:nth-child(8) { /* Dokumen column */
            max-width: 120px;
        }
        
        .compact-table td:nth-child(9),
        .compact-table td:nth-child(10),
        .compact-table td:nth-child(11) { /* Action columns */
            text-align: center;
        }
        
        /* Text truncation for long content */
        .compact-table td {
            position: relative;
        }
        
        .compact-table td[title] {
            cursor: help;
        }
        
        /* Tooltip for truncated text */
        .compact-table td:hover::after {
            content: attr(title);
            position: absolute;
            bottom: 100%;
            left: 50%;
            transform: translateX(-50%);
            background: #333;
            color: white;
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
            font-size: 0.75rem;
            white-space: nowrap;
            z-index: 1000;
            pointer-events: none;
        }

        /* Enhanced Badge Styling */
        .badge {
            border-radius: 20px;
            padding: 0.5rem 1rem;
            font-weight: 600;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .badge.bg-success {
            background: var(--success-gradient) !important;
            color: #166534 !important;
        }

        .badge.bg-warning {
            background: var(--warning-gradient) !important;
            color: #92400e !important;
        }

        .badge.bg-danger {
            background: var(--danger-gradient) !important;
            color: #991b1b !important;
        }

        .badge.bg-info {
            background: var(--info-gradient) !important;
            color: #1e40af !important;
        }

        /* Enhanced Grouping Styling */
        .kelompok-header {
            background: var(--primary-gradient);
            color: white;
            padding: 1.5rem;
            border-radius: 20px;
            margin-bottom: 1.5rem;
            box-shadow: var(--shadow-lg);
            position: relative;
            overflow: hidden;
        }

        .kelompok-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="white" opacity="0.1"/><circle cx="75" cy="75" r="1" fill="white" opacity="0.1"/><circle cx="50" cy="10" r="0.5" fill="white" opacity="0.1"/><circle cx="10" cy="60" r="0.5" fill="white" opacity="0.1"/><circle cx="90" cy="40" r="0.5" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
        }

        .kelompok-header h5 {
            margin: 0;
            font-weight: 700;
            font-size: 1.25rem;
            position: relative;
            z-index: 1;
        }

        .kelompok-header .badge {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(10px);
            position: relative;
            z-index: 1;
        }

        .kelompok-progress {
            background: white;
            border-radius: 16px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            border-left: 4px solid #881d1d;
            box-shadow: var(--shadow-md);
        }

        .progress-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
            padding: 0.5rem 0;
        }

        .progress-item:last-child {
            margin-bottom: 0;
        }

        .progress-label {
            font-weight: 600;
            color: #374151;
            font-size: 0.95rem;
        }

        .progress-value {
            font-weight: 700;
            color: #881d1d;
            font-size: 1.1rem;
        }

        /* Enhanced Empty State */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            background: white;
            border-radius: 20px;
            box-shadow: var(--shadow-md);
        }

        .empty-state i {
            font-size: 4rem;
            margin-bottom: 1.5rem;
            opacity: 0.3;
            color: #881d1d;
        }

        .empty-state h5 {
            color: #374151;
            margin-bottom: 1rem;
            font-weight: 600;
            font-size: 1.25rem;
        }

        .empty-state p {
            color: #6b7280;
            margin: 0 0 2rem 0;
            font-size: 1rem;
        }

        /* Enhanced Row Highlighting */
        .table-row-highlight {
            background: var(--warning-gradient) !important;
            border-left: 4px solid #f59e0b;
            position: relative;
        }

        .table-row-highlight::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(90deg, transparent, rgba(245, 158, 11, 0.1), transparent);
            animation: shimmer 2s infinite;
        }

        @keyframes shimmer {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
        }

        /* Enhanced Bimbingan States */
        .bimbingan-new {
            background: var(--warning-gradient);
            border-left: 4px solid #f59e0b;
            position: relative;
        }

        .bimbingan-new::after {
            content: 'NEW';
            position: absolute;
            top: 0.5rem;
            right: 0.5rem;
            background: #f59e0b;
            color: white;
            padding: 0.25rem 0.5rem;
            border-radius: 8px;
            font-size: 0.7rem;
            font-weight: 600;
        }

        .bimbingan-urgent {
            background: var(--danger-gradient);
            border-left: 4px solid #ef4444;
            position: relative;
        }

        .bimbingan-urgent::after {
            content: 'URGENT';
            position: absolute;
            top: 0.5rem;
            right: 0.5rem;
            background: #ef4444;
            color: white;
            padding: 0.25rem 0.5rem;
            border-radius: 8px;
            font-size: 0.7rem;
            font-weight: 600;
        }

        /* Enhanced Tooltip */
        .tooltip-inner {
            background: var(--primary-gradient);
            color: white;
            border-radius: 12px;
            padding: 0.75rem 1rem;
            font-weight: 500;
            box-shadow: var(--shadow-lg);
        }

        .tooltip.bs-tooltip-top .tooltip-arrow::before {
            border-top-color: #881d1d;
        }

        /* Responsive Enhancements */
        @media (max-width: 768px) {
            .card-header {
                padding: 0.75rem;
            }
            
            .filter-section .card-body {
                padding: 1rem;
            }
            
            .summary-card .card-body {
                padding: 0.75rem;
            }
            
            .table thead th,
            .table tbody td {
                padding: 0.5rem 0.25rem;
                font-size: 0.8rem;
            }
            
            .btn {
                padding: 0.5rem 1rem;
                font-size: 0.85rem;
            }
            
            .compact-table .btn-sm {
                padding: 0.15rem 0.3rem;
                font-size: 0.7rem;
            }
        }
        
        @media (max-width: 576px) {
            .summary-card .card-body {
                padding: 1rem;
            }
            
            .summary-cards-row {
                margin-bottom: 1.5rem !important;
            }
            
            .summary-card .h4 {
                font-size: 1.25rem;
            }
            
            .filter-section .card-body {
                padding: 0.75rem;
            }
            
            .stats-item {
                padding: 0.5rem;
            }
            
            .header-section {
                padding: 1.5rem;
                margin-bottom: 3rem;
            }
            
            .page-title-compact {
                font-size: 1.25rem;
            }
            
            .section-spacing {
                margin-bottom: 3rem;
            }
        }

        /* Additional Utility Classes */
        .text-xs {
            font-size: 0.75rem;
        }
        
        .text-gray-300 {
            color: #d1d5db !important;
        }
        
        .text-gray-800 {
            color: #1f2937 !important;
        }

        .border-left-warning {
            border-left: 4px solid #f59e0b !important;
        }
        
        .border-left-success {
            border-left: 4px solid #22c55e !important;
        }
        
        .border-left-info {
            border-left: 4px solid #38bdf8 !important;
        }
        
        .border-left-primary {
            border-left: 4px solid #881d1d !important;
        }

        /* Loading Animation */
        .loading-shimmer {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
        }

        @keyframes loading {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
        }

        /* Click Animation */
        .clicked-row {
            animation: clickPulse 0.3s ease-out;
        }

        @keyframes clickPulse {
            0% { transform: scale(1); }
            50% { transform: scale(0.98); }
            100% { transform: scale(1); }
        }

        /* Enhanced Button Animations */
        .btn:active {
            transform: scale(0.95);
        }

        /* Smooth Transitions */
        * {
            transition: all 0.2s ease;
        }

        /* Enhanced Focus States */
        .form-control:focus,
        .form-select:focus,
        .btn:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(136, 29, 29, 0.1);
        }

        /* Dynamic Modal Styling */
        #dynamicModalContainer .modal {
            z-index: 1055 !important;
        }
        
        #dynamicModalContainer .modal-backdrop {
            z-index: 1050 !important;
        }
        
        #dynamicModalContainer .modal-content {
            border: none;
            border-radius: 16px;
            box-shadow: var(--shadow-xl);
        }
        
        #dynamicModalContainer .modal-header {
            background: var(--secondary-gradient);
            border-bottom: 1px solid #e2e8f0;
            border-radius: 16px 16px 0 0;
        }
        
        #dynamicModalContainer .modal-body {
            padding: 1.5rem;
        }
        
        #dynamicModalContainer .modal-footer {
            border-top: 1px solid #e2e8f0;
            padding: 1rem 1.5rem;
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
                    <a class="nav-link" href="/dosen/beranda"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/dosen/daftar_topik"><i class="far fa-file-alt"></i><span>Daftar Topik</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/dosen/template_laporan"><i class="fas fa-file-word"></i><span>Template Laporan</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/dosen/pembimbing-dua"><i class="fas fa-user-friends"></i><span>Pembimbing Dua</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link active" href="/dosen/bimbingan"><i class="fas fa-file-word"></i><span>Bimbingan</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/dosen/penilaian-kelompok"><i class="fas fa-pencil-alt"></i><span>Penilaian Kelompok</span></a>
                </li>
                <li class="nav-item mt-auto">
                    <hr class="sidebar-divider my-0">
                    <a class="nav-link" href="/dosen/profil"><i class="fas fa-user"></i><span>Profil</span></a>
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

    <div class="d-flex flex-column" id="content-wrapper">
        <div id="content">
            <nav class="navbar navbar-expand bg-white shadow mb-4 topbar static-top navbar-light">
                <div class="container-fluid">
                    <button class="btn btn-link d-md-none rounded-circle me-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                    <ul class="navbar-nav flex-nowrap ms-auto">
                        <li class="nav-item dropdown no-arrow mx-1">
                            <div class="nav-item dropdown no-arrow">
                                <a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#">
                                    <span class="badge bg-danger badge-counter">{{ Auth::guard('dosen')->user()->unreadNotifications ? Auth::guard('dosen')->user()->unreadNotifications->count() : 0 }}</span>
                                    <i class="fas fa-bell fa-fw"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-list animated--grow-in">
                                    <h6 class="dropdown-header">Alerts Center</h6>
                                    @php $notifs = Auth::guard('dosen')->user()->notifications ?? []; @endphp
                                    @forelse ($notifs as $notif)
                                        <a class="dropdown-item d-flex align-items-center" href="#">
                                            <div class="me-3">
                                                <div class="bg-warning icon-circle">
                                                    <i class="fas fa-exclamation-triangle text-white"></i>
                                                </div>
                                            </div>
                                            <div>
                                                <span class="small text-gray-500">{{ $notif->created_at->format('d M Y H:i') }}</span>
                                                <p>{{ $notif->data['pesan'] ?? '' }}</p>
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
                            <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><span class="d-none d-lg-inline me-2 text-gray-600 small">{{ Auth::guard('dosen')->user()->nama_pengguna }}</span><span class="badge rounded-pill me-2" style="background: #881d1d;">Dosen</span><img class="border rounded-circle img-profile" src="{{ asset('/storage/assets/img/avatars/'.(Auth::guard('dosen')->user()->foto ?? 'default.jpg')) }}"></a>
                                <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in"><a class="dropdown-item" href="/dosen/profil"><i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Profil</a>
                                    <div class="dropdown-divider"></div><a class="dropdown-item" href="/logout"><i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Keluar</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="container-fluid">
                <!-- Header Section -->
                <div class="header-section section-spacing">
                    <div class="row align-items-center">
                        <div class="col-lg-4">
                            <h2 class="page-title-compact">Daftar Pengajuan Bimbingan</h2>
                            @php
                                $pendingCount = collect($bimbinganList)->where('status', 'pending')->count();
                            @endphp
                            @if($pendingCount > 0)
                                <div class="alert alert-warning alert-dismissible fade show py-2 mt-2" role="alert">
                                    <i class="fas fa-exclamation-triangle me-2"></i>
                                    <strong>Perhatian!</strong> Ada {{ $pendingCount }} pengajuan bimbingan yang masih pending.
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif
                        </div>
                    
                    <!-- Summary Cards -->
                    <div class="col-lg-8">
                        @php
                            $totalBimbingan = count($bimbinganList);
                            $pendingCount = collect($bimbinganList)->where('status', 'pending')->count();
                            $acceptedCount = collect($bimbinganList)->where('status', 'accepted')->count();
                            $rejectedCount = collect($bimbinganList)->where('status', 'rejected')->count();
                            $selesaiCount = collect($bimbinganList)->where('status', 'selesai')->count();
                        @endphp
                        <div class="row g-3 summary-cards-row">
                            <div class="col-md-3 col-sm-6">
                                <div class="card summary-card border-left-warning h-100">
                                    <div class="card-body py-2">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1">
                                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pending</div>
                                                <div class="h4 mb-0 font-weight-bold text-gray-800">{{ $pendingCount }}</div>
                                            </div>
                                            <div class="ms-2">
                                                <div class="bg-warning bg-opacity-10 rounded-circle p-2">
                                                    <i class="fas fa-clock text-warning"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="card summary-card border-left-success h-100">
                                    <div class="card-body py-2">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1">
                                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Accepted</div>
                                                <div class="h4 mb-0 font-weight-bold text-gray-800">{{ $acceptedCount }}</div>
                                            </div>
                                            <div class="ms-2">
                                                <div class="bg-success bg-opacity-10 rounded-circle p-2">
                                                    <i class="fas fa-check text-success"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="card summary-card border-left-info h-100">
                                    <div class="card-body py-2">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1">
                                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Selesai</div>
                                                <div class="h4 mb-0 font-weight-bold text-gray-800">{{ $selesaiCount }}</div>
                                            </div>
                                            <div class="ms-2">
                                                <div class="bg-info bg-opacity-10 rounded-circle p-2">
                                                    <i class="fas fa-flag-checkered text-info"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="card summary-card border-left-primary h-100">
                                    <div class="card-body py-2">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Kelompok</div>
                                                <div class="h4 mb-0 font-weight-bold text-gray-800">{{ collect($bimbinganList)->map(function($b) use ($kelompokJudulList) { return $kelompokJudulList[$b->nim] ?? 'Unknown'; })->unique()->count() }}</div>
                                            </div>
                                            <div class="ms-2">
                                                <div class="bg-primary bg-opacity-10 rounded-circle p-2">
                                                    <i class="fas fa-users text-primary"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                
                <!-- Filter dan Statistik -->
                <div class="row section-spacing">
                    <div class="col-lg-7">
                        <div class="card filter-section">
                            <div class="card-header py-2">
                                <h6 class="m-0 fw-bold">
                                    <i class="fas fa-filter me-2"></i>Filter & Pencarian
                                </h6>
                            </div>
                            <div class="card-body py-3">
                                <div class="row g-2">
                                    <div class="col-md-6 mb-2">
                                        <label class="form-label fw-bold mb-1">Filter Kelompok:</label>
                                        <select class="form-select form-select-sm" id="filterKelompok">
                                            <option value="">Semua Kelompok</option>
                                            @php
                                                $uniqueKelompok = collect($bimbinganList)->map(function($b) use ($kelompokJudulList) {
                                                    return $kelompokJudulList[$b->nim] ?? 'Kelompok Tidak Diketahui';
                                                })->unique()->values();
                                            @endphp
                                            @foreach($uniqueKelompok as $judul)
                                                <option value="{{ $judul }}">{{ $judul }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label class="form-label fw-bold mb-1">Filter Status:</label>
                                        <select class="form-select form-select-sm" id="filterStatus">
                                            <option value="">Semua Status</option>
                                            <option value="pending">Pending</option>
                                            <option value="accepted">Accepted</option>
                                            <option value="rejected">Rejected</option>
                                            <option value="selesai">Selesai</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label class="form-label fw-bold mb-1">Filter Pembimbing:</label>
                                        <select class="form-select form-select-sm" id="filterPembimbing">
                                            <option value="">Semua Pembimbing</option>
                                            <option value="1">Pembimbing 1</option>
                                            <option value="2">Pembimbing 2</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label class="form-label fw-bold mb-1">Cari Mahasiswa:</label>
                                        <input type="text" class="form-control form-control-sm" id="searchMahasiswa" placeholder="Nama mahasiswa...">
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-12">
                                        <button class="btn btn-outline-secondary btn-sm me-2" id="resetFilter">
                                            <i class="fas fa-refresh me-1"></i>Reset Filter
                                        </button>
                                        <button class="btn btn-outline-primary btn-sm me-2" id="toggleGrouping">
                                            <i class="fas fa-layer-group me-1"></i>Kelompokkan per Topik
                                        </button>
                                        <button class="btn btn-outline-success btn-sm" id="exportData">
                                            <i class="fas fa-download me-1"></i>Export Data
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="card stats-card">
                            <div class="card-header py-2">
                                <h6 class="m-0 fw-bold">
                                    <i class="fas fa-chart-pie me-2"></i>Statistik Bimbingan
                                </h6>
                            </div>
                            <div class="card-body py-3">
                                <div class="row text-center g-2">
                                    <div class="col-6 mb-2">
                                        <div class="stats-item" data-status="pending">
                                            <div class="fw-bold text-warning fs-5">{{ $pendingCount }}</div>
                                            <small class="text-muted fw-semibold">Pending</small>
                                        </div>
                                    </div>
                                    <div class="col-6 mb-2">
                                        <div class="stats-item" data-status="accepted">
                                            <div class="fw-bold text-success fs-5">{{ $acceptedCount }}</div>
                                            <small class="text-muted fw-semibold">Accepted</small>
                                        </div>
                                    </div>
                                    <div class="col-6 mb-2">
                                        <div class="stats-item" data-status="rejected">
                                            <div class="fw-bold text-danger fs-5">{{ $rejectedCount }}</div>
                                            <small class="text-muted fw-semibold">Rejected</small>
                                        </div>
                                    </div>
                                    <div class="col-6 mb-2">
                                        <div class="stats-item" data-status="selesai">
                                            <div class="fw-bold text-info fs-5">{{ $selesaiCount }}</div>
                                            <small class="text-muted fw-semibold">Selesai</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center mt-2">
                                    <small class="text-muted">Total: {{ $totalBimbingan }} bimbingan</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card section-spacing">
                    <div class="card-header py-2">
                        <h6 class="m-0 fw-bold">
                            <i class="fas fa-table me-2"></i>Daftar Bimbingan
                        </h6>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0 compact-table" id="bimbinganTable">
                            <thead>
                                <tr>
                                    <th width="3%">#</th>
                                    <th width="12%">Nama Mahasiswa</th>
                                    <th width="15%">Judul Topik</th>
                                    <th width="12%">Topik Bimbingan</th>
                                    <th width="10%">Pembimbing</th>
                                    <th width="10%">Jadwal</th>
                                    <th width="8%">Status</th>
                                    <th width="10%">Dokumen</th>
                                    <th width="10%">Materi</th>
                                    <th width="10%">Catatan</th>
                                    <th width="10%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse($bimbinganList as $i => $b)
                                @php
                                    $isUrgent = $b->status == 'pending' && $b->created_at->diffInDays(now()) > 3;
                                    $isNew = $b->status == 'pending' && $b->created_at->diffInHours(now()) < 24;
                                @endphp
                                <tr class="{{ $isNew ? 'bimbingan-new' : ($isUrgent ? 'bimbingan-urgent' : '') }}" 
                                    data-bs-toggle="tooltip" 
                                    data-bs-placement="top" 
                                    title="{{ $isNew ? 'Bimbingan baru (dibuat hari ini)' : ($isUrgent ? 'Bimbingan urgent (pending lebih dari 3 hari)' : '') }}">
                                    <td>{{ $i+1 }}</td>
                                    <td title="{{ $mahasiswaNama[$b->nim] ?? $b->nim }}">{{ $mahasiswaNama[$b->nim] ?? $b->nim }}</td>
                                    <td title="{{ $kelompokJudulList[$b->nim] ?? '-' }}">{{ $kelompokJudulList[$b->nim] ?? '-' }}</td>
                                    <td title="{{ $b->judul }}">{{ $b->judul }}</td>
                                    <td>{{ $b->pembimbing == '1' ? 'Pembimbing 1' : 'Pembimbing 2' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($b->jadwal)->format('d-m-Y H:i') }}</td>
                                    <td>
                                        @if($b->status=='pending')<span class="badge bg-warning text-dark">Pending</span>@endif
                                        @if($b->status=='accepted')<span class="badge bg-success">Accepted</span>@endif
                                        @if($b->status=='rejected')<span class="badge bg-danger">Rejected</span>@endif
                                        @if($b->status=='selesai')<span class="badge bg-info text-dark">Selesai</span>@endif
                                    </td>
                                    <td>
                                        @if($b->dokumen_terkait)
                                            @if($b->dokumenTerkait)
                                                <a href="{{ $b->dokumenTerkait->link }}" target="_blank">{{ $b->dokumenTerkait->judul }}</a>
                                            @else
                                                -
                                            @endif
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        <button class="btn btn-primary btn-sm view-materi-btn" data-bimbingan-id="{{ $b->id }}" data-catatan="{{ $b->catatan ?? '-' }}">
                                            Lihat Materi
                                        </button>
                                    </td>
                                    <td>
                                        @if($b->status=='accepted' || $b->status=='selesai')
                                            <button class="btn btn-info btn-sm masukan-btn" data-bimbingan-id="{{ $b->id }}" data-kritik-saran="{{ $b->kritik_saran }}" data-action-url="{{ route('dosen.bimbingan.kritik_saran', $b->id) }}">Masukan</button>
                                        @elseif($b->status=='rejected')
                                            <button type="button" class="btn btn-danger btn-sm alasan-tolak-btn" data-bimbingan-id="{{ $b->id }}" data-alasan-tolak="{{ $b->alasan_tolak }}">
                                                Lihat Alasan
                                            </button>
                                        @endif
                                    </td>
                                    <td>
                                        @if($b->status=='pending')
                                            <form action="{{ route('dosen.bimbingan.acc', $b->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                <button class="btn btn-success btn-sm" type="submit">ACC</button>
                                            </form>
                                            <button class="btn btn-danger btn-sm reject-btn" data-bimbingan-id="{{ $b->id }}" data-action-url="{{ route('dosen.bimbingan.reject', $b->id) }}">Reject</button>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="9" class="text-center">Tidak ada pengajuan bimbingan</td></tr>
                            @endforelse
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Dynamic Modal Container -->
        <div id="dynamicModalContainer"></div>
        
        <footer class="bg-white sticky-footer">
            <div class="container my-auto">
                <div class="text-center my-auto copyright"><span>Copyright © TAKU 2025</span></div>
            </div>
        </footer>
    </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
</div>
<script src="{{ asset('/storage/assets/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('/storage/assets/js/theme.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>

<script>
$(document).ready(function() {
    let isGrouped = false;
    let originalTableContent = '';
    
    // Simpan konten tabel asli
    originalTableContent = $('#bimbinganTable tbody').html();
    
    // Filter berdasarkan kelompok
    $('#filterKelompok').on('change', function() {
        applyFilters();
    });
    
    // Filter berdasarkan status
    $('#filterStatus').on('change', function() {
        applyFilters();
    });
    
    // Filter berdasarkan pembimbing
    $('#filterPembimbing').on('change', function() {
        applyFilters();
    });
    
    // Pencarian mahasiswa
    $('#searchMahasiswa').on('keyup', function() {
        applyFilters();
    });
    
    // Reset filter
    $('#resetFilter').on('click', function() {
        $('#filterKelompok').val('');
        $('#filterStatus').val('');
        $('#filterPembimbing').val('');
        $('#searchMahasiswa').val('');
        
        // Hapus highlight dari stats
        $('.stats-item').removeClass('active-stat');
        
        // Tampilkan semua data
        if (originalTableContent) {
            $('#bimbinganTable tbody').html(originalTableContent);
            $('#bimbinganTable tbody tr').show().removeClass('table-row-highlight');
        } else {
            // Jika originalTableContent tidak ada, reload halaman
            location.reload();
        }
        

    });
    
    // Toggle grouping
    $('#toggleGrouping').on('click', function() {
        isGrouped = !isGrouped;
        if (isGrouped) {
            $(this).html('<i class="fas fa-list me-1"></i>Tampilkan Semua');
            groupByKelompok();
        } else {
            $(this).html('<i class="fas fa-layer-group me-1"></i>Kelompokkan per Topik');
            showAllData();
        }
    });
    
        function applyFilters() {
        const kelompokFilter = $('#filterKelompok').val().toLowerCase();
        const statusFilter = $('#filterStatus').val().toLowerCase();
        const pembimbingFilter = $('#filterPembimbing').val();
        const searchFilter = $('#searchMahasiswa').val().toLowerCase();
        
        let visibleCount = 0;
        
        // Jika semua filter kosong, tampilkan semua data
        if (!kelompokFilter && !statusFilter && !pembimbingFilter && !searchFilter) {
            // Kembalikan data asli jika ada empty state
            if ($('#bimbinganTable tbody .empty-state').length > 0) {
                $('#bimbinganTable tbody').html(originalTableContent);
            }
            $('#bimbinganTable tbody tr').show().removeClass('table-row-highlight');
            return;
        }
        
        // Pastikan data asli ada sebelum filter
        if ($('#bimbinganTable tbody .empty-state').length > 0) {
            $('#bimbinganTable tbody').html(originalTableContent);
            console.log('Restored original content from empty state');
        }
        
        $('#bimbinganTable tbody tr').each(function() {
            const row = $(this);
            
            // Skip kelompok header rows
            if (row.hasClass('kelompok-header-row')) {
                return;
            }
            
            const kelompok = row.find('td:eq(2)').text().toLowerCase(); // Judul Topik
            const statusBadge = row.find('td:eq(6) .badge');
            const status = statusBadge.text().toLowerCase(); // Status
            const pembimbing = row.find('td:eq(4)').text(); // Pembimbing
            const mahasiswa = row.find('td:eq(1)').text().toLowerCase(); // Nama Mahasiswa
            
            let show = true;
            
            // Filter berdasarkan kelompok
            if (kelompokFilter && kelompokFilter !== 'semua kelompok' && !kelompok.includes(kelompokFilter)) {
                show = false;
            }
            
            // Filter berdasarkan status
            if (statusFilter && statusFilter !== 'semua status') {
                let statusMatch = false;
                if (statusFilter === 'pending' && status === 'pending') statusMatch = true;
                if (statusFilter === 'accepted' && status === 'accepted') statusMatch = true;
                if (statusFilter === 'rejected' && status === 'rejected') statusMatch = true;
                if (statusFilter === 'selesai' && status === 'selesai') statusMatch = true;
                
                if (!statusMatch) {
                    show = false;
                }
            }
            
            // Filter berdasarkan pembimbing
            if (pembimbingFilter && pembimbingFilter !== '') {
                const pembimbingText = pembimbingFilter === '1' ? 'Pembimbing 1' : 'Pembimbing 2';
                if (pembimbing !== pembimbingText) {
                    show = false;
                }
            }
            
            // Filter berdasarkan pencarian mahasiswa
            if (searchFilter && !mahasiswa.includes(searchFilter)) {
                show = false;
            }
            
            if (show) {
                row.show();
                row.addClass('table-row-highlight');
                visibleCount++;
            } else {
                row.hide();
                row.removeClass('table-row-highlight');
            }
        });
        
        // Update empty state hanya jika tidak ada data yang visible
        if (visibleCount === 0) {
            console.log('No data visible, showing empty state');
            updateEmptyState();
        } else {
            console.log('Data visible:', visibleCount, 'rows');
            // Hapus empty state jika ada data yang visible
            $('#bimbinganTable tbody .empty-state').parent().parent().remove();
        }
 

    }
    
    function groupByKelompok() {
        const kelompokData = {};
        
        // Gunakan data asli jika tidak ada data yang visible
        let rowsToProcess = $('#bimbinganTable tbody tr:visible').not('.kelompok-header-row');
        if (rowsToProcess.length === 0) {
            rowsToProcess = $('#bimbinganTable tbody tr').not('.kelompok-header-row');
        }
        
        rowsToProcess.each(function() {
            const row = $(this);
            const kelompok = row.find('td:eq(2)').text(); // Judul Topik
            const status = row.find('td:eq(6) .badge').text(); // Status
            
            if (!kelompokData[kelompok]) {
                kelompokData[kelompok] = {
                    rows: [],
                    stats: {
                        pending: 0,
                        accepted: 0,
                        rejected: 0,
                        selesai: 0,
                        total: 0
                    }
                };
            }
            
            kelompokData[kelompok].rows.push(row.clone());
            kelompokData[kelompok].stats.total++;
            
            if (status === 'Pending') kelompokData[kelompok].stats.pending++;
            else if (status === 'Accepted') kelompokData[kelompok].stats.accepted++;
            else if (status === 'Rejected') kelompokData[kelompok].stats.rejected++;
            else if (status === 'Selesai') kelompokData[kelompok].stats.selesai++;
        });
        
        let groupedHTML = '';
        
        Object.keys(kelompokData).forEach(kelompok => {
            const data = kelompokData[kelompok];
            const stats = data.stats;
            
            groupedHTML += `
                <tr class="kelompok-header-row">
                    <td colspan="11">
                        <div class="kelompok-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5><i class="fas fa-users me-2"></i>${kelompok}</h5>
                                <div>
                                    <span class="badge me-1">Total: ${stats.total}</span>
                                    <span class="badge bg-warning me-1">Pending: ${stats.pending}</span>
                                    <span class="badge bg-success me-1">Accepted: ${stats.accepted}</span>
                                    <span class="badge bg-danger me-1">Rejected: ${stats.rejected}</span>
                                    <span class="badge bg-info">Selesai: ${stats.selesai}</span>
                                </div>
                            </div>
                        </div>
                        <div class="kelompok-progress">
                            <div class="progress-item">
                                <span class="progress-label">Progress Bimbingan:</span>
                                <span class="progress-value">${Math.round((stats.accepted + stats.selesai) / stats.total * 100)}%</span>
                            </div>
                            <div class="progress-item">
                                <span class="progress-label">Bimbingan Selesai:</span>
                                <span class="progress-value">${stats.selesai} dari ${stats.total}</span>
                            </div>
                            <div class="progress-item">
                                <div class="progress" style="height: 8px;">
                                    <div class="progress-bar bg-success" style="width: ${Math.round(stats.selesai / stats.total * 100)}%"></div>
                                    <div class="progress-bar bg-warning" style="width: ${Math.round(stats.accepted / stats.total * 100)}%"></div>
                                    <div class="progress-bar bg-danger" style="width: ${Math.round(stats.rejected / stats.total * 100)}%"></div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            `;
            
            data.rows.forEach(row => {
                groupedHTML += row.prop('outerHTML');
            });
        });
        
        $('#bimbinganTable tbody').html(groupedHTML);
    }
    
    function showAllData() {
        if (originalTableContent) {
            $('#bimbinganTable tbody').html(originalTableContent);
            // Reset semua filter
            $('#filterKelompok').val('');
            $('#filterStatus').val('');
            $('#filterPembimbing').val('');
            $('#searchMahasiswa').val('');
            // Hapus highlight dari stats
            $('.stats-item').removeClass('active-stat');
            // Tampilkan semua row
            $('#bimbinganTable tbody tr').show().removeClass('table-row-highlight');
        } else {
            // Jika originalTableContent tidak ada, reload halaman
            location.reload();
        }
    }
    
    function updateEmptyState() {
        const visibleRows = $('#bimbinganTable tbody tr:visible').not('.kelompok-header-row').length;
        
        if (visibleRows === 0) {
            if ($('#bimbinganTable tbody .empty-state').length === 0) {
                $('#bimbinganTable tbody').html(`
                    <tr>
                        <td colspan="11">
                            <div class="empty-state">
                                <i class="fas fa-search"></i>
                                <h5>Tidak Ada Data</h5>
                                <p>Tidak ada bimbingan yang sesuai dengan filter yang dipilih.</p>
                                <button class="btn btn-outline-primary btn-sm" onclick="$('#resetFilter').click()">
                                    <i class="fas fa-refresh me-1"></i>Reset Filter
                                </button>
                            </div>
                        </td>
                    </tr>
                `);
            }
        }
    }
    

    
    // Export Data
    $('#exportData').on('click', function() {
        exportToCSV();
    });
    
    // Inisialisasi
    // Simpan konten asli dan tampilkan semua data
    originalTableContent = $('#bimbinganTable tbody').html();
    
    // Debug: Pastikan data asli tersimpan
    console.log('Original content saved, length:', originalTableContent.length);
    console.log('Total rows in original:', $(originalTableContent).find('tr').length);
    
    // Cleanup yang tidak diperlukan lagi karena sudah menggunakan dropdown
    
    // Pastikan semua row terlihat di awal dengan animasi
    setTimeout(function() {
        $('#bimbinganTable tbody tr').each(function(index) {
            $(this).delay(index * 50).fadeIn(300).removeClass('table-row-highlight');
        });
    }, 100);
    

    
    
    
    // Mark bimbingan as viewed when clicked
    $('#bimbinganTable tbody').on('click', 'tr', function() {
        $(this).removeClass('bimbingan-new bimbingan-urgent');
        
        // Add click animation
        $(this).addClass('clicked-row');
        setTimeout(() => {
            $(this).removeClass('clicked-row');
        }, 300);
    });
    
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
    
    // Auto-refresh untuk bimbingan baru (setiap 30 detik)
    setInterval(function() {
        // Bisa ditambahkan AJAX call untuk refresh data
        // console.log('Checking for new bimbingan...');
    }, 30000);
    

    
    // Clickable stats
    $('.stats-item').on('click', function() {
        const status = $(this).data('status');
        $('#filterStatus').val(status);
        applyFilters();
        
        // Highlight the clicked stat
        $('.stats-item').removeClass('active-stat');
        $(this).addClass('active-stat');
    });
    
    // Dynamic Modal Management
    let currentModal = null;
    
    // View Materi Button Handler
    $(document).on('click', '.view-materi-btn', function(e) {
        e.preventDefault();
        e.stopPropagation();
        
        const bimbinganId = $(this).data('bimbingan-id');
        const catatan = $(this).data('catatan');
        
        // Cleanup existing modal
        cleanupModal();
        
        // Create modal HTML
        const modalHTML = `
            <div class="modal fade" id="modalCatatan${bimbinganId}" tabindex="-1" aria-labelledby="modalCatatanLabel${bimbinganId}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalCatatanLabel${bimbinganId}">Materi Bimbingan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            ${catatan}
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>
        `;
        
        // Add modal to container
        $('#dynamicModalContainer').html(modalHTML);
        
        // Show modal
        currentModal = new bootstrap.Modal(document.getElementById(`modalCatatan${bimbinganId}`));
        currentModal.show();
        
        // Add cleanup on hidden
        $(`#modalCatatan${bimbinganId}`).on('hidden.bs.modal', function() {
            cleanupModal();
        });
    });
    
    // Masukan Button Handler
    $(document).on('click', '.masukan-btn', function(e) {
        e.preventDefault();
        e.stopPropagation();
        
        const bimbinganId = $(this).data('bimbingan-id');
        const kritikSaran = $(this).data('kritik-saran');
        const actionUrl = $(this).data('action-url');
        
        // Cleanup existing modal
        cleanupModal();
        
        // Create modal HTML
        const modalHTML = `
            <div class="modal fade" id="modalMasukan${bimbinganId}" tabindex="-1" aria-labelledby="modalMasukanLabel${bimbinganId}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="${actionUrl}" method="POST">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalMasukanLabel${bimbinganId}">Masukan</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <textarea name="kritik_saran" class="form-control" rows="5" required>${kritikSaran}</textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button class="btn btn-info" type="submit">Kirim</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        `;
        
        // Add modal to container
        $('#dynamicModalContainer').html(modalHTML);
        
        // Show modal
        currentModal = new bootstrap.Modal(document.getElementById(`modalMasukan${bimbinganId}`));
        currentModal.show();
        
        // Add cleanup on hidden
        $(`#modalMasukan${bimbinganId}`).on('hidden.bs.modal', function() {
            cleanupModal();
        });
    });
    
    // Alasan Tolak Button Handler
    $(document).on('click', '.alasan-tolak-btn', function(e) {
        e.preventDefault();
        e.stopPropagation();
        
        const bimbinganId = $(this).data('bimbingan-id');
        const alasanTolak = $(this).data('alasan-tolak');
        
        // Cleanup existing modal
        cleanupModal();
        
        // Create modal HTML
        const modalHTML = `
            <div class="modal fade" id="modalAlasanTolak${bimbinganId}" tabindex="-1" aria-labelledby="modalAlasanTolakLabel${bimbinganId}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalAlasanTolakLabel${bimbinganId}">Alasan Penolakan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <span class="text-danger">${alasanTolak}</span>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>
        `;
        
        // Add modal to container
        $('#dynamicModalContainer').html(modalHTML);
        
        // Show modal
        currentModal = new bootstrap.Modal(document.getElementById(`modalAlasanTolak${bimbinganId}`));
        currentModal.show();
        
        // Add cleanup on hidden
        $(`#modalAlasanTolak${bimbinganId}`).on('hidden.bs.modal', function() {
            cleanupModal();
        });
    });
    
    // Reject Button Handler
    $(document).on('click', '.reject-btn', function(e) {
        e.preventDefault();
        e.stopPropagation();
        
        const bimbinganId = $(this).data('bimbingan-id');
        const actionUrl = $(this).data('action-url');
        
        // Cleanup existing modal
        cleanupModal();
        
        // Create modal HTML
        const modalHTML = `
            <div class="modal fade" id="modalTolak${bimbinganId}" tabindex="-1" aria-labelledby="modalTolakLabel${bimbinganId}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="${actionUrl}" method="POST">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalTolakLabel${bimbinganId}">Alasan Penolakan</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <textarea name="alasan_tolak" class="form-control" required></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-danger">Tolak</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        `;
        
        // Add modal to container
        $('#dynamicModalContainer').html(modalHTML);
        
        // Show modal
        currentModal = new bootstrap.Modal(document.getElementById(`modalTolak${bimbinganId}`));
        currentModal.show();
        
        // Add cleanup on hidden
        $(`#modalTolak${bimbinganId}`).on('hidden.bs.modal', function() {
            cleanupModal();
        });
    });
    
    // Cleanup function
    function cleanupModal() {
        if (currentModal) {
            currentModal.dispose();
            currentModal = null;
        }
        $('#dynamicModalContainer').empty();
        $('.modal-backdrop').remove();
        $('body').removeClass('modal-open');
    }
    

});



function exportToCSV() {
    const visibleRows = $('#bimbinganTable tbody tr:visible');
    let csvContent = "data:text/csv;charset=utf-8,";
    
    // Header
    csvContent += "No,Nama Mahasiswa,Judul Topik,Topik Bimbingan,Pembimbing,Jadwal,Status,Dokumen,Materi Bimbingan,Catatan Dosen\n";
    
    // Data
    visibleRows.each(function(index) {
        const row = $(this);
        const no = index + 1;
        const nama = row.find('td:eq(1)').text().replace(/,/g, ';');
        const judul = row.find('td:eq(2)').text().replace(/,/g, ';');
        const topik = row.find('td:eq(3)').text().replace(/,/g, ';');
        const pembimbing = row.find('td:eq(4)').text().replace(/,/g, ';');
        const jadwal = row.find('td:eq(5)').text().replace(/,/g, ';');
        const status = row.find('td:eq(6) .badge').text().replace(/,/g, ';');
        const dokumen = row.find('td:eq(7)').text().replace(/,/g, ';');
        const materi = 'Lihat Materi';
        const catatan = 'Masukan';
        
        csvContent += `${no},${nama},${judul},${topik},${pembimbing},${jadwal},${status},${dokumen},${materi},${catatan}\n`;
    });
    
    const encodedUri = encodeURI(csvContent);
    const link = document.createElement("a");
    link.setAttribute("href", encodedUri);
    link.setAttribute("download", "daftar_bimbingan_" + new Date().toISOString().split('T')[0] + ".csv");
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}
</script>
</body>
</html> 