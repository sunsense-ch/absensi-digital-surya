<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Absensi Digital') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
      :root{
        --primary:#404E3B; --primary-dark:#2C362A; --secondary:#7B9669;
        --accent:#BAC8B1; --muted:#6C8480; --surface:#E6E6E6; --surface-white:#FBFBFA;
        --success:#6B8F71; --danger:#B23A2E; --line:#DCE3D8;
      }
      *{box-sizing:border-box;}
      body{margin:0;font-family:-apple-system,Segoe UI,Roboto,Poppins,sans-serif;background:var(--surface);color:var(--primary-dark);}
      a{text-decoration:none;color:var(--secondary);}
      a:hover{color:var(--primary);}

      .guest-wrap{min-height:100vh;display:flex;flex-direction:column;align-items:center;justify-content:center;padding:24px;}
      .brand-mark{
        width:52px;height:52px;border-radius:13px;background:var(--primary);color:#fff;
        display:flex;align-items:center;justify-content:center;font-weight:700;font-size:18px;margin-bottom:16px;
      }
      .guest-title{font-size:14px;color:var(--muted);margin:0 0 22px;text-align:center;}
      .guest-card{
        width:100%;max-width:380px;background:var(--surface-white);border:1px solid var(--line);
        border-radius:14px;padding:26px 24px;
      }

      .field label{display:block;font-size:12.5px;font-weight:600;color:var(--primary-dark);margin:0 0 6px;}
      .field{margin-bottom:16px;}
      .field input{
        width:100%;padding:10px 12px;border:1px solid var(--line);border-radius:8px;font-size:13.5px;
        background:var(--surface-white);
      }
      .field input:focus{outline:none;border-color:var(--secondary);box-shadow:0 0 0 2px rgba(123,150,105,.15);}
      .field .error{display:block;font-size:11.5px;color:var(--danger);margin-top:5px;}
      .field-inline{display:flex;align-items:center;gap:7px;margin-bottom:16px;}
      .field-inline input{width:auto;}
      .field-inline label{font-size:12.5px;color:var(--muted);margin:0;}

      .btn{border:none;border-radius:8px;padding:10px 16px;font-size:13.5px;font-weight:600;cursor:pointer;width:100%;}
      .btn-primary{background:var(--secondary);color:#fff;}
      .btn-primary:hover{background:var(--primary);}

      .row-between{display:flex;align-items:center;justify-content:space-between;margin-bottom:18px;}
      .link-small{font-size:12px;}

      .status-msg{background:#E3EBE0;color:var(--success);border:1px solid #CFE0CA;border-radius:8px;padding:9px 12px;font-size:12.5px;margin-bottom:16px;}

      .guest-footer{margin-top:20px;font-size:11.5px;color:var(--muted);text-align:center;}
    </style>
</head>
<body>
    <div class="guest-wrap">
        <a href="/" style="text-decoration:none;">
            <div class="brand-mark">AD</div>
        </a>
        <p class="guest-title">Sistem Absensi Digital — SMKN 1 Maja</p>

        <div class="guest-card">
            {{ $slot }}
        </div>

        <p class="guest-footer">&copy; {{ date('Y') }} SMKN 1 Maja</p>
    </div>
</body>
</html>
