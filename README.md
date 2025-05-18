## Informasi update 18 Mei 2025

List Update.
- Pembelian (Simpan, ubah, hapus)
- Penjualan (Simpan, hapus)
- Middleware cek login

Yang belum
- Cetak PDF
- Filter per Tanggal

## Cara buat middleware
Jalankan perintah berikut
```
php artisan make:middleware CekLogin
```
Buka kernel.php dan tambahkan kode berikut
```
protected $middlewareAliases = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'auth.session' => \Illuminate\Session\Middleware\AuthenticateSession::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
        'signed' => \App\Http\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        'ceklogin' => \App\Http\Middleware\CekLogin::class,
    ];
```

Lalu buka file `CekLogin.php` dan tambahkan kode berikut
```
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CekLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->session()->has('namayangmasuk') && !$request->session()->has('idyangmasuk')) {
            return redirect('login');
        }
        return $next($request);
    }
}
```

Terkahir cek LoginController dan cek bagian session