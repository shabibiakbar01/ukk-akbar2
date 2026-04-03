<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Carbon\Carbon; // Tambahkan ini untuk mengatur bahasa pada tanggal

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Set locale Carbon ke Bahasa Indonesia
        Carbon::setLocale('id');

        // Set locale aplikasi secara runtime ke Bahasa Indonesia
        config(['app.locale' => 'id']);

        // Set zona waktu ke Asia/Jakarta agar jam tidak selisih
        date_default_timezone_set('Asia/Jakarta');
    }
}
