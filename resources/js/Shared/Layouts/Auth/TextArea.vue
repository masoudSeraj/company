<script setup>
import { onMounted, ref } from 'vue';

defineProps({
    modelValue: String,
});

defineEmits(['update:modelValue']);

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <textarea
        ref="input"
        class="tw-border-gray-300 dark:tw-border-gray-700 dark:tw-bg-gray-900 dark:tw-text-gray-300 focus:tw-border-indigo-500 dark:tw-focus:border-indigo-600 focus:tw-ring-indigo-500 dark:focus:tw-ring-indigo-600 tw-rounded-md tw-shadow-sm"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
    >
    </textarea>
</template>
