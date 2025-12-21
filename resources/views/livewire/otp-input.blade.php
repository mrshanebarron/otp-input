<div
    x-data="{
        otp: @entangle('value'),
        length: {{ $this->length }},
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
    style="display: flex; gap: 8px;"
>
    @for($i = 0; $i < $this->length; $i++)
        <input
            type="{{ $this->type === 'number' ? 'tel' : 'text' }}"
            inputmode="{{ $this->type === 'number' ? 'numeric' : 'text' }}"
            maxlength="1"
            @if($this->autofocus && $i === 0) autofocus @endif
            @if($this->disabled) disabled @endif
            x-on:input="handleInput({{ $i }}, $event)"
            x-on:keydown="handleKeydown({{ $i }}, $event)"
            x-on:paste="handlePaste($event)"
            style="width: 48px; height: 56px; text-align: center; font-size: 20px; font-weight: 600; border: 1px solid #d1d5db; border-radius: 8px; outline: none; transition: border-color 0.2s, box-shadow 0.2s;"
            onfocus="this.style.borderColor='#3b82f6'; this.style.boxShadow='0 0 0 3px rgba(59,130,246,0.2)';"
            onblur="this.style.borderColor='#d1d5db'; this.style.boxShadow='none';"
        >
    @endfor
</div>
