<?php

namespace MrShaneBarron\OtpInput\Livewire;

use Livewire\Component;
use Livewire\Attributes\Modelable;

class OtpInput extends Component
{
    #[Modelable]
    public string $value = '';
    
    public int $length = 6;
    public string $type = 'text';
    public bool $autofocus = true;
    public bool $disabled = false;

    public function mount(
        string $value = '',
        int $length = 6,
        string $type = 'text',
        bool $autofocus = true,
        bool $disabled = false
    ): void {
        $this->value = $value;
        $this->length = $length;
        $this->type = $type;
        $this->autofocus = $autofocus;
        $this->disabled = $disabled;
    }

    public function updatedValue(): void
    {
        if (strlen($this->value) === $this->length) {
            $this->dispatch('otp-complete', code: $this->value);
        }
    }

    public function render()
    {
        return view('sb-otp-input::livewire.otp-input');
    }
}
