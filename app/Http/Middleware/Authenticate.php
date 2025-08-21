<?php
namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            session()->flash('need_login', 'Silakan login terlebih dahulu untuk mengakses halaman ini.');
            return route('login'); // sesuaikan jika loginmu pakai nama route lain
        }
    }


}
