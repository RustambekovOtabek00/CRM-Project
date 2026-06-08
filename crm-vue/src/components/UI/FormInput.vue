<script setup>
defineProps({
    labelName: {
        type: String,
        required: true
    },
    inputType: {
        type: String,
        default: 'text'
    },
    placeholder: {
        type: String,
        default: 'Type here...'
    },
})

const text = defineModel()
</script>

<template>
    <div class="flex flex-col gap-2 text-sm">
        <label>{{ labelName }}</label>
        <input
            class="px-2.5 py-2 rounded-md placeholder:text-my-gray outline-none border border-gray-300 focus:bg-my-blue/20 focus:border-my-blue"
            :type="inputType"
            v-model="text"
            :placeholder
        >
    </div>
</template>
