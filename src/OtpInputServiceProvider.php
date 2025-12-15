<?php

namespace MrShaneBarron\OtpInput;

use Illuminate\Support\ServiceProvider;
use MrShaneBarron\OtpInput\Livewire\OtpInput;
use MrShaneBarron\OtpInput\View\Components\OtpInput as BladeOtpInput;

class OtpInputServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/sb-otp-input.php', 'sb-otp-input');
    }

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'sb-otp-input');

        if (class_exists(\Livewire\Livewire::class)) {
            \Livewire\Livewire::component('sb-otp-input', OtpInput::class);
        }

        $this->loadViewComponentsAs('ld', [
            BladeOtpInput::class,
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
