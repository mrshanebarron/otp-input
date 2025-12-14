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
        $this->mergeConfigFrom(__DIR__ . '/../config/ld-otp-input.php', 'ld-otp-input');
    }

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'ld-otp-input');

        Livewire::component('ld-otp-input', otp-input::class);

        $this->loadViewComponentsAs('ld', [
            Bladeotp-input::class,
        ]);

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/ld-otp-input.php' => config_path('ld-otp-input.php'),
            ], 'ld-otp-input-config');

            $this->publishes([
                __DIR__ . '/../resources/views' => resource_path('views/vendor/ld-otp-input'),
            ], 'ld-otp-input-views');
        }
    }
}
