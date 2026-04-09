<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use App\Settings;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $settings = null;
        try {
            if (Schema::hasTable('settings')) {
                $settings = Settings::query()->first();
            }
        } catch (\Throwable $e) {
        }
        if (!$settings) {
            $fallback = new Settings();
            $fallback->title = 'Career Preference';
            $fallback->description = '';
            $fallback->favicon = '';
            $fallback->logo = '';
            $fallback->gacode = '';
            $settings = $fallback;
        }
        View::share('settings', $settings);
    }
}
