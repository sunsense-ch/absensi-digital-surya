<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Absensi Digital') }}</title>

    <!-- Vite / Tailwind tetap dimuat untuk kompatibilitas komponen Breeze (modal, dropdown, dsb) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
      :root{
        --primary:#404E3B; --primary-dark:#2C362A; --secondary:#7B9669;
        --accent:#BAC8B1; --muted:#6C8480; --surface:#E6E6E6; --surface-white:#FBFBFA;
        --success:#6B8F71; --warning:#D9A441; --danger:#B23A2E; --line:#DCE3D8;
      }
      *{box-sizing:border-box;}
      body{margin:0;font-family:-apple-system,Segoe UI,Roboto,Poppins,sans-serif;background:var(--surface);color:var(--primary-dark);}
      a{text-decoration:none;color:inherit;}

      .app{display:flex;min-height:100vh;}
      .sidebar{
        width:230px;background:var(--primary);color:#fff;flex-shrink:0;
        display:flex;flex-direction:column;position:fixed;top:0;bottom:0;left:0;
        transition:transform .25s ease;z-index:40;
      }
      .sidebar .brand{padding:20px 18px;font-weight:700;font-size:14px;color:var(--accent);border-bottom:1px solid rgba(255,255,255,.08);}
      .sidebar .brand small{display:block;font-weight:400;font-size:10.5px;color:#C9D6C2;margin-top:2px;}
      .nav{flex:1;padding:12px 10px;overflow-y:auto;font-size:13px;}
      .nav-item{
        display:flex;align-items:center;gap:9px;padding:9px 12px;border-radius:9px;
        color:#D6E0D1;cursor:pointer;margin-bottom:2px;
      }
      .nav-item:hover{background:var(--primary-dark);color:#fff;}
      .nav-item.active{background:var(--secondary);color:#fff;font-weight:600;}
      .nav-item .dot{width:6px;height:6px;border-radius:50%;background:var(--accent);flex-shrink:0;}
      .sidebar .logout{padding:14px 18px;border-top:1px solid rgba(255,255,255,.08);font-size:12px;color:#C9D6C2;cursor:pointer;background:none;border-left:none;border-right:none;border-bottom:none;width:100%;text-align:left;}
      .sidebar .logout:hover{color:#fff;}

      .main{flex:1;margin-left:230px;display:flex;flex-direction:column;transition:margin .25s ease;}
      .topbar{
        background:var(--surface-white);border-bottom:1px solid var(--line);
        padding:14px 24px;display:flex;align-items:center;justify-content:space-between;
        position:sticky;top:0;z-index:20;
      }
      .topbar h1, .topbar h2{margin:0;font-size:17px;font-weight:600;color:var(--primary);}
      .topbar .right{display:flex;align-items:center;gap:12px;}
      .avatar{width:32px;height:32px;border-radius:50%;background:var(--secondary);display:flex;align-items:center;justify-content:center;color:#fff;font-size:12px;font-weight:700;}
      .hamburger{display:none;background:none;border:none;font-size:20px;color:var(--primary);cursor:pointer;}

      .content{padding:24px;}

      .card{background:var(--surface-white);border:1px solid var(--line);border-radius:13px;padding:18px;}
      .grid-4{display:grid;grid-template-columns:repeat(4,1fr);gap:14px;}
      .stat b{display:block;font-size:24px;color:var(--primary);}
      .stat span{font-size:12px;color:var(--muted);}
      .toolbar{display:flex;justify-content:space-between;align-items:center;gap:10px;margin-bottom:14px;flex-wrap:wrap;}
      .search{background:var(--surface);border:1px solid var(--line);border-radius:8px;padding:8px 12px;font-size:12.5px;color:var(--muted);flex:1;max-width:260px;}
      .btn{border:none;border-radius:8px;padding:9px 14px;font-size:12.5px;font-weight:600;cursor:pointer;}
      .btn-primary{background:var(--secondary);color:#fff;}
      .btn-primary:hover{background:var(--primary);}
      .btn-outline{background:#fff;color:var(--primary);border:1px solid var(--line);}

      table{width:100%;border-collapse:collapse;font-size:13px;}
      th{text-align:left;color:var(--muted);font-weight:600;font-size:11.5px;text-transform:uppercase;letter-spacing:.3px;padding:9px 8px;border-bottom:1px solid var(--line);}
      td{padding:9px 8px;border-bottom:1px solid #EFF3EC;}
      tr:last-child td{border-bottom:none;}
      .av{width:24px;height:24px;border-radius:50%;background:var(--accent);display:inline-block;margin-right:8px;vertical-align:middle;}
      .badge{padding:3px 9px;border-radius:20px;font-size:11px;font-weight:600;}
      .badge.ok{background:#E3EBE0;color:var(--success);}
      .badge.warn{background:#FBEDD2;color:var(--warning);}
      .badge.danger{background:#F5DEDA;color:var(--danger);}
      .icon-btn{background:none;border:none;cursor:pointer;color:var(--muted);font-size:13px;padding:3px 5px;}
      .icon-btn:hover{color:var(--primary);}

      .section-title{font-size:14px;font-weight:600;color:var(--primary);margin:0 0 12px;}

      .empty-state{padding:32px 8px;text-align:center;color:var(--muted);font-size:13px;}
      .empty-state a{color:var(--secondary);font-weight:600;}

      .field label{display:block;font-size:12.5px;font-weight:600;color:var(--primary-dark);margin:14px 0 6px;}
      .field input, .field select{
        width:100%;padding:9px 11px;border:1px solid var(--line);border-radius:8px;font-size:13px;background:var(--surface-white);
      }
      .field small{display:block;font-size:11px;color:var(--muted);margin-top:4px;}
      .field .error{display:block;font-size:11.5px;color:var(--danger);margin-top:4px;}
      .form-actions{display:flex;gap:8px;margin-top:18px;}

      .flash-success{
        background:#E3EBE0;color:var(--success);border:1px solid #CFE0CA;border-radius:8px;
        padding:10px 14px;font-size:12.5px;font-weight:500;margin-bottom:14px;
      }

      @media print{
        .sidebar, .topbar, .hamburger, .no-print{display:none !important;}
        .main{margin-left:0 !important;}
        body{background:#fff !important;}
        .content{padding:0 !important;}
        .card{border:none !important;}
      }

      @media (max-width: 860px){
        .sidebar{transform:translateX(-100%);}
        .sidebar.open{transform:translateX(0);}
        .main{margin-left:0;}
        .hamburger{display:block;}
        .grid-4{grid-template-columns:repeat(2,1fr);}
      }
    </style>
</head>
<body>

<div class="app">

    <aside class="sidebar" id="sidebar">
        <div class="brand">
            Sistem Absensi Digital
            <small>{{ auth()->user()->role === 'admin' ? 'Web Admin' : 'Portal Siswa' }}</small>
        </div>

        <nav class="nav">
            <a href="{{ route('dashboard') }}" class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <span class="dot"></span>Dashboard
            </a>

            @if(auth()->user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <span class="dot"></span>Dashboard Admin
                </a>
                <a href="{{ route('admin.classes.index') }}" class="nav-item {{ request()->routeIs('admin.classes.*') ? 'active' : '' }}">
                    <span class="dot"></span>Data Kelas
                </a>
                <a href="{{ route('admin.students.index') }}" class="nav-item {{ request()->routeIs('admin.students.*') ? 'active' : '' }}">
                    <span class="dot"></span>Data Siswa
                </a>
                <a href="{{ route('admin.qr-locations.index') }}" class="nav-item {{ request()->routeIs('admin.qr-locations.*') ? 'active' : '' }}">
                    <span class="dot"></span>Lokasi QR
                </a>
            @endif

            @if(auth()->user()->role === 'siswa')
                <a href="{{ route('siswa.dashboard') }}" class="nav-item {{ request()->routeIs('siswa.dashboard') ? 'active' : '' }}">
                    <span class="dot"></span>Dashboard Siswa
                </a>
            @endif

            <a href="{{ route('profile.edit') }}" class="nav-item {{ request()->routeIs('profile.edit') ? 'active' : '' }}">
                <span class="dot"></span>Profil Saya
            </a>
        </nav>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout">Keluar</button>
        </form>
    </aside>

    <div class="main">
        <div class="topbar">
            <div style="display:flex;align-items:center;gap:10px;">
                <button class="hamburger" onclick="document.getElementById('sidebar').classList.toggle('open')">&#9776;</button>
                {{ $header ?? '' }}
            </div>
            <div class="right">
                <span style="font-size:12.5px;color:var(--muted);">{{ Auth::user()->name }}</span>
                <div class="avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
            </div>
        </div>

        <div class="content">
            {{ $slot }}
        </div>
    </div>
</div>

</body>
</html>
