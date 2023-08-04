<script setup>
    const emit = defineEmits(['update:select']);
    const props = defineProps([
        'select',
        'options',
        'label'
    ])
</script>
<template>
    <div class="tw-flex tw-items-end">
    <q-select 
        standout 
        :options="props.options" 
        label="Swipe"
        @update:model-value="(value) =>{
            emit('update:select', value);
        }"
        />

    </div>
</template>