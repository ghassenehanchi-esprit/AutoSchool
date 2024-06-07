<?php

namespace App\Providers;

use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (!Admin::where('email', 'admin@admin.com')->exists()) {
            // Create admin user
            Admin::create([
            'name'=>'admin',
                'email' => 'admin@admin.com',

                'password' => Hash::make('admin'), // Change 'password' to desired password
            ]);
        }
    }
}
