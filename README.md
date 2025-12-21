# OTP Input

A one-time password input component for Laravel applications. Individual digit inputs for verification codes. Works with Livewire and Vue 3.

## Installation

```bash
composer require mrshanebarron/otp-input
```

## Livewire Usage

### Basic Usage

```blade
<livewire:sb-otp-input wire:model="code" />
```

### Custom Length

```blade
<livewire:sb-otp-input wire:model="code" :length="4" />
```

### Livewire Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `wire:model` | string | `''` | Complete OTP value |
| `length` | number | `6` | Number of digits |
| `input-class` | string | `'border-gray-300'` | Input styling |

## Vue 3 Usage

### Setup

```javascript
import { SbOtpInput } from './vendor/sb-otp-input';
app.component('SbOtpInput', SbOtpInput);
```

### Basic Usage

```vue
<template>
  <SbOtpInput v-model="code" @complete="handleComplete" />
</template>

<script setup>
import { ref } from 'vue';

const code = ref('');

const handleComplete = (otp) => {
  console.log('OTP entered:', otp);
  verifyCode(otp);
};
</script>
```

### 4-Digit PIN

```vue
<template>
  <div class="text-center">
    <h2 class="text-xl font-bold mb-4">Enter PIN</h2>
    <SbOtpInput
      v-model="pin"
      :length="4"
      @complete="verifyPin"
    />
  </div>
</template>
```

### Verification Form Example

```vue
<template>
  <div class="max-w-md mx-auto p-8 bg-white rounded-lg shadow">
    <h2 class="text-2xl font-bold text-center mb-2">Verification</h2>
    <p class="text-gray-600 text-center mb-6">
      Enter the 6-digit code sent to your phone
    </p>

    <SbOtpInput
      v-model="code"
      @complete="verify"
      input-class="border-blue-300"
    />

    <p v-if="error" class="text-red-500 text-center mt-4">{{ error }}</p>

    <button
      @click="resend"
      class="w-full mt-6 text-blue-600 hover:underline text-sm"
    >
      Didn't receive code? Resend
    </button>
  </div>
</template>

<script setup>
import { ref } from 'vue';

const code = ref('');
const error = ref('');

const verify = async (otp) => {
  try {
    await api.verifyOTP(otp);
    // Redirect on success
  } catch (e) {
    error.value = 'Invalid code. Please try again.';
    code.value = '';
  }
};

const resend = async () => {
  await api.resendOTP();
  error.value = '';
};
</script>
```

### Vue Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `modelValue` | String | `''` | Complete OTP value |
| `length` | Number | `6` | Number of input boxes |
| `inputClass` | String | `'border-gray-300'` | Additional input classes |

### Events

| Event | Payload | Description |
|-------|---------|-------------|
| `update:modelValue` | `string` | Value changed |
| `complete` | `string` | All digits entered |

## Keyboard Behavior

| Key | Action |
|-----|--------|
| `0-9` | Enter digit, auto-advance |
| `Backspace` | Clear and go back |
| `←` | Move to previous input |
| `→` | Move to next input |
| `Paste` | Auto-fill from clipboard |

## Features

- **Auto-Advance**: Focus moves to next input automatically
- **Paste Support**: Paste full code to auto-fill
- **Backspace Navigation**: Goes to previous on empty backspace
- **Arrow Keys**: Navigate between inputs
- **Numeric Only**: Filters non-numeric characters
- **Auto-Select**: Selects digit on focus
- **Complete Event**: Fires when all digits entered

## Styling

Uses Tailwind CSS:
- Large centered digits
- Focus ring highlight
- Equal-width inputs
- Customizable border color

## Requirements

- PHP 8.1+
- Laravel 10, 11, or 12
- Tailwind CSS 3.x

## License

MIT License
