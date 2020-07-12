<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Setting;

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
        config([
            'global' => Setting::all([
                'name','value'
            ])
            ->keyBy('name')
            ->transform(function ($setting) {
                return $setting->value;
            })
            ->toArray()
        ]);
    }
}
