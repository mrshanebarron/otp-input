<?php

namespace MrShaneBarron\otp-input;

use Illuminate\Support\ServiceProvider;
use MrShaneBarron\otp-input\Livewire\otp-input;
use MrShaneBarron\otp-input\View\Components\otp-input as Bladeotp-input;
use Livewire\Livewire;

class otp-inputServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/sb-otp-input.php', 'sb-otp-input');
    }

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'sb-otp-input');

        Livewire::component('sb-otp-input', otp-input::class);

        $this->loadViewComponentsAs('ld', [
            Bladeotp-input::class,
        ]);

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/sb-otp-input.php' => config_path('sb-otp-input.php'),
            ], 'sb-otp-input-config');

            $this->publishes([
                __DIR__ . '/../resources/views' => resource_path('views/vendor/sb-otp-input'),
            ], 'sb-otp-input-views');
        }
    }
}
