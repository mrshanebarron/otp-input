<div
    x-data="{
        otp: @entangle('value'),
        length: {{ $length }},
        inputs: [],
        init() {
            this.inputs = this.$refs.container.querySelectorAll('input');
        },
        handleInput(index, e) {
            const value = e.target.value;
            if (value.length > 1) {
                e.target.value = value[0];
            }
            this.updateOtp();
            if (value && index < this.length - 1) {
                this.inputs[index + 1].focus();
            }
        },
        handleKeydown(index, e) {
            if (e.key === 'Backspace' && !e.target.value && index > 0) {
                this.inputs[index - 1].focus();
            }
        },
        handlePaste(e) {
            e.preventDefault();
            const paste = e.clipboardData.getData('text').slice(0, this.length);
            paste.split('').forEach((char, i) => {
                if (this.inputs[i]) {
                    this.inputs[i].value = char;
                }
            });
            this.updateOtp();
            const lastIndex = Math.min(paste.length, this.length) - 1;
            if (this.inputs[lastIndex]) {
                this.inputs[lastIndex].focus();
            }
        },
        updateOtp() {
            this.otp = Array.from(this.inputs).map(i => i.value).join('');
        }
    }"
    x-ref="container"
    class="flex gap-2"
>
    @for($i = 0; $i < $length; $i++)
        <input
            type="{{ $type === 'number' ? 'tel' : 'text' }}"
            inputmode="{{ $type === 'number' ? 'numeric' : 'text' }}"
            maxlength="1"
            @if($autofocus && $i === 0) autofocus @endif
            @if($disabled) disabled @endif
            x-on:input="handleInput({{ $i }}, $event)"
            x-on:keydown="handleKeydown({{ $i }}, $event)"
            x-on:paste="handlePaste($event)"
            class="w-12 h-14 text-center text-xl font-semibold border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition-all disabled:bg-gray-100 disabled:cursor-not-allowed"
        >
    @endfor
</div>
