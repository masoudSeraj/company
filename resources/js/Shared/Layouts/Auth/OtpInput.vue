<script setup>
import { ref, watch } from 'vue';
const props = defineProps({
  fields: Number,
})

const data = ref([]);
const firstInputEl = ref(null);
const emit = defineEmits(['update:modelValue']);

watch(
  () => data,
  (newVal) => {
    if (
      newVal.value != '' &&
      newVal.value.length === props.fields &&
      !newVal.value.includes('')
    ) {
      emit('update:modelValue', Number(newVal.value.join('')));
    } else {
      emit('update:modelValue', null);
    }
  },
  { deep: true }
);

const handleOtpInput = (e) => {
  if (e.data && e.target.nextElementSibling) {
    e.target.nextElementSibling.focus();
  } else if (e.data == null && e.target.previousElementSibling) {
    e.target.previousElementSibling.focus();
  }
};

const handlePaste = (e) => {
  const pasteData = e.clipboardData.getData('text');
  let nextEl = firstInputEl.value[0].nextElementSibling;
  for (let i = 1; i < pasteData.length; i++) {
    if (nextEl) {
      data.value[i] = pasteData[i];
      nextEl = nextEl.nextElementSibling;
    }
  }
};

// 123456
</script>

<template>
  <div dir="ltr" class="tw-flex tw-justify-around tw-w-full tw-otp" @input="handleOtpInput">
    <template v-for="field in fields" :key="field">
      <input
        v-model="data[field - 1]"
        ref="firstInputEl"
        type="text"
        maxlength="1"
        class="tw-w-10 tw-h-10 tw-text-center tw-border tw-rounded"
        @paste="field === 1 && handlePaste($event)"
      />
    </template>
  </div>
</template>
