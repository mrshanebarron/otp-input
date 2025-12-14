<template>
  <div class="flex gap-2">
    <input
      v-for="(_, index) in length"
      :key="index"
      ref="inputRefs"
      type="text"
      maxlength="1"
      :value="digits[index]"
      @input="handleInput($event, index)"
      @keydown="handleKeydown($event, index)"
      @paste="handlePaste"
      @focus="$event.target.select()"
      :class="['w-12 h-14 text-center text-2xl font-semibold border-2 rounded-lg transition-colors focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none', inputClass]"
      inputmode="numeric"
      pattern="[0-9]*"
    >
  </div>
</template>

<script>
import { ref, watch, nextTick } from 'vue';

export default {
  name: 'SbOtpInput',
  props: {
    modelValue: { type: String, default: '' },
    length: { type: Number, default: 6 },
    inputClass: { type: String, default: 'border-gray-300' }
  },
  emits: ['update:modelValue', 'complete'],
  setup(props, { emit }) {
    const inputRefs = ref([]);
    const digits = ref(Array(props.length).fill(''));

    watch(() => props.modelValue, (val) => {
      digits.value = val.split('').slice(0, props.length);
      while (digits.value.length < props.length) digits.value.push('');
    }, { immediate: true });

    const updateValue = () => {
      const value = digits.value.join('');
      emit('update:modelValue', value);
      if (value.length === props.length) emit('complete', value);
    };

    const focusInput = (index) => {
      nextTick(() => {
        if (inputRefs.value[index]) inputRefs.value[index].focus();
      });
    };

    const handleInput = (e, index) => {
      const value = e.target.value.replace(/[^0-9]/g, '');
      digits.value[index] = value.slice(-1);
      updateValue();
      if (value && index < props.length - 1) focusInput(index + 1);
    };

    const handleKeydown = (e, index) => {
      if (e.key === 'Backspace') {
        if (!digits.value[index] && index > 0) {
          focusInput(index - 1);
        }
        digits.value[index] = '';
        updateValue();
      }
      if (e.key === 'ArrowLeft' && index > 0) focusInput(index - 1);
      if (e.key === 'ArrowRight' && index < props.length - 1) focusInput(index + 1);
    };

    const handlePaste = (e) => {
      e.preventDefault();
      const text = e.clipboardData?.getData('text')?.replace(/[^0-9]/g, '') || '';
      const chars = text.split('').slice(0, props.length);
      chars.forEach((char, i) => { digits.value[i] = char; });
      updateValue();
      focusInput(Math.min(chars.length, props.length - 1));
    };

    return { inputRefs, digits, handleInput, handleKeydown, handlePaste };
  }
};
</script>
