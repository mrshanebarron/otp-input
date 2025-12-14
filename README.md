# Laravel Design OTP Input

OTP/2FA code input boxes for Laravel. Supports Livewire, Blade, and Vue 3.

## Installation

```bash
composer require mrshanebarron/otp-input
```


## Usage

### Livewire Component

```blade
<livewire:ld-otp-input />
```

### Blade Component

```blade
<x-ld-otp-input />
```

## Configuration

Publish the config file:

```bash
php artisan vendor:publish --tag=ld-otp-input-config
```

## Customization

### Publishing Views

```bash
php artisan vendor:publish --tag=ld-otp-input-views
```

## License

MIT
