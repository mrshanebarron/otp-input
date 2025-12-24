<?php

namespace MrShaneBarron\OtpInput\Livewire;

use Livewire\Component;

class OtpInput extends Component
{
    public string $value = '';
    public int $length = 6;
    public string $type = 'number';
    public bool $autofocus = false;
    public bool $disabled = false;

    public function mount(
        string $value = '',
        int $length = 6,
        string $type = 'number',
        bool $autofocus = false,
        bool $disabled = false
    ): void {
        $this->value = $value;
        $this->length = $length;
        $this->type = $type;
        $this->autofocus = $autofocus;
        $this->disabled = $disabled;
    }

    public function render()
    {
        return view('sb-otp-input::livewire.otp-input');
    }
}
