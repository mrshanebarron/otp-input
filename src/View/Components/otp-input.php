<?php

namespace MrShaneBarron\otp-input\View\Components;

use Illuminate\View\Component;

class otp-input extends Component
{
    public function __construct()
    {
        //
    }

    public function render()
    {
        return view('ld-otp-input::components.otp-input');
    }
}
