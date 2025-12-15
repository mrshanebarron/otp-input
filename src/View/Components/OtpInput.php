<?php

namespace MrShaneBarron\OtpInput\View\Components;

use Illuminate\View\Component;

class OtpInput extends Component
{
    public function __construct()
    {
        //
    }

    public function render()
    {
        return view('sb-otp-input::components.otp-input');
    }
}
