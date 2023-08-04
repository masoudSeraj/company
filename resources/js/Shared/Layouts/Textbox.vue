<script setup>
    const emit = defineEmits(['update:text']);
    defineProps([
        'text',
        'label',
        'bgColor'
    ])
</script>
<template>
    <div class="tw-flex tw-items-center">
        <q-input filled standout="!tw-bg-organization-yellow-900 text-white"
        v-bind="$attrs" 
        class="tw-w-full"
        :bg-color="bgColor ?? 'amber-13'"
        input-class="tw-w-full"
        :label="label"
        :model-value="text"
        @update:model-value="(value) =>{
            emit('update:text', value);
        }"
        
        >
            <template v-slot:prepend>
                <slot name="icon">
                </slot>
            </template>

            <template v-slot:append>
                <slot name="button"></slot>
            </template>
    </q-input>
        
    </div>
</template>