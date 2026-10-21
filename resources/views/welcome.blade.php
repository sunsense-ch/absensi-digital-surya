<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Absensi Digital') }} — SMKN 1 Maja</title>

    <style>
      :root{
        --primary:#404E3B; --primary-dark:#2C362A; --secondary:#7B9669;
        --accent:#BAC8B1; --muted:#6C8480; --surface:#E6E6E6; --surface-white:#FBFBFA;
        --line:#DCE3D8;
      }
      *{box-sizing:border-box;}
      body{margin:0;font-family:-apple-system,Segoe UI,Roboto,Poppins,sans-serif;background:var(--surface);color:var(--primary-dark);}
      a{text-decoration:none;}

      .hero{
        min-height:100vh;display:flex;flex-direction:column;align-items:center;justify-content:center;
        padding:32px 20px;text-align:center;
      }
      .brand-mark{
        width:56px;height:56px;border-radius:14px;background:var(--primary);color:#fff;
        display:flex;align-items:center;justify-content:center;font-weight:700;font-size:20px;margin-bottom:18px;
      }
      .hero h1{font-size:26px;color:var(--primary);margin:0 0 8px;}
      .hero p.subtitle{font-size:14px;color:var(--muted);margin:0 0 30px;max-width:420px;}

      .actions{display:flex;gap:10px;flex-wrap:wrap;justify-content:center;margin-bottom:40px;}
      .btn{border:none;border-radius:8px;padding:11px 22px;font-size:13.5px;font-weight:600;cursor:pointer;display:inline-block;}
      .btn-primary{background:var(--secondary);color:#fff;}
      .btn-primary:hover{background:var(--primary);}
      .btn-outline{background:#fff;color:var(--primary);border:1px solid var(--line);}
      .btn-outline:hover{border-color:var(--secondary);color:var(--secondary);}

      .features{display:grid;grid-template-columns:repeat(3,1fr);gap:14px;max-width:720px;width:100%;}
      .feature{background:var(--surface-white);border:1px solid var(--line);border-radius:12px;padding:18px 14px;text-align:left;}
      .feature .dot{width:8px;height:8px;border-radius:50%;background:var(--secondary);margin-bottom:10px;}
      .feature h3{font-size:13.5px;color:var(--primary);margin:0 0 4px;}
      .feature p{font-size:12px;color:var(--muted);margin:0;line-height:1.5;}

      .footer-note{margin-top:36px;font-size:11.5px;color:var(--muted);}

      @media (max-width:640px){
        .features{grid-template-columns:1fr;}
      }
    </style>
</head>
<body>

<div class="hero">
    <div class="brand-mark">AD</div>
    <h1>Sistem Absensi Digital</h1>
    <p class="subtitle">
        SMK Negeri 1 Maja, Kabupaten Majalengka. Absensi berbasis QR Code dinamis
        yang tervalidasi lokasi dan waktu secara otomatis.
    </p>

    <div class="actions">
        @auth
            <a href="{{ auth()->user()->role === 'admin' ? route('admin.dashboard') : route('siswa.dashboard') }}" class="btn btn-primary">
                Buka Dashboard
            </a>
        @else
            <a href="{{ route('login') }}" class="btn btn-primary">Masuk</a>
            @if(Route::has('register'))
                <a href="{{ route('register') }}" class="btn btn-outline">Daftar Akun Siswa</a>
            @endif
        @endauth
    </div>

    <div class="features">
        <div class="feature">
            <div class="dot"></div>
            <h3>QR Token Harian</h3>
            <p>Setiap lokasi punya token unik yang berganti otomatis tiap hari, mencegah QR dipakai berulang.</p>
        </div>
        <div class="feature">
            <div class="dot"></div>
            <h3>Validasi Server</h3>
            <p>Keputusan sah/tidaknya absensi ditentukan sepenuhnya oleh server, bukan oleh aplikasi siswa.</p>
        </div>
        <div class="feature">
            <div class="dot"></div>
            <h3>Terhubung Data Siswa</h3>
            <p>Setiap akun terhubung ke data siswa asli, sehingga identitas tercatat otomatis saat scan.</p>
        </div>
    </div>

    <p class="footer-note">&copy; {{ date('Y') }} SMKN 1 Maja &middot; Absensi Digital</p>
</div>

</body>
</html>
