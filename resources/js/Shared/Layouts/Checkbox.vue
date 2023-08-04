<script setup>
    const emit = defineEmits(['update:check']);
    defineProps([
        'check',
        'checkValue',
        'label',
        'checked'
    ])
</script>
<template>
    <div class="tw-flex tw-items-end">
        <!-- <q-checkbox 
            true-value
            :model-value="check"
            @update:model-value="(value) =>{
                 emit('update:check', value);
            }"
            :val="checkValue"
            :label="label"
        >
            <slot></slot>
        </q-checkbox> -->


        <label
            class="tw-relative tw-flex tw-cursor-pointer tw-items-center tw-rounded-full tw-p-3"
            data-ripple-dark="true"
        >
            <input
                :value="check"
                @input="(event) => emit('update:check', event.target.checked)"
                type="checkbox"
                class="before:tw-content[''] tw-peer tw-relative tw-h-5 tw-w-5 tw-cursor-pointer tw-appearance-none tw-rounded-md tw-border tw-border-blue-gray-200 tw-transition-all before:tw-absolute before:tw-top-2/4 before:tw-left-2/4 before:tw-block before:tw-h-12 before:tw-w-12 before:tw--translate-y-2/4 before:tw--translate-x-2/4 before:tw-rounded-full before:tw-bg-blue-gray-500 before:tw-opacity-0 before:tw-transition-opacity checked:tw-border-pink-500 checked:tw-bg-pink-500 checked:before:tw-bg-pink-500"
                :checked="checked"
            />

            <slot></slot>
        </label>

    </div>

</template>