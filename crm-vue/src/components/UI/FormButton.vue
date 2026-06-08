<script setup>
defineProps({
    isLoading: {
        type: Boolean,
        default: false
    }
})

defineEmits(['accept'])
</script>

<template>
    <button
        @click="$emit('accept')"
        :disabled="isLoading"
        class="grid px-8 py-2 text-white rounded-lg transition-all place-content-center"
        :class="{'bg-my-blue cursor-not-allowed ': isLoading, 'bg-blue-500 hover:bg-blue-600 active:bg-blue-700 cursor-pointer': !isLoading}"
        type="submit"
    >
        <slot v-if="!isLoading" />
        <svg v-else class="text-black text-2xl animate-spin" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
            <path clip-rule="evenodd" d="M12 19C15.866 19 19 15.866 19 12C19 8.13401 15.866 5 12 5C8.13401 5 5 8.13401 5 12C5 15.866 8.13401 19 12 19ZM12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" fill="currentColor" fill-rule="evenodd" opacity="0.2"/>
            <path d="M2 12C2 6.47715 6.47715 2 12 2V5C8.13401 5 5 8.13401 5 12H2Z" fill="currentColor"/>
        </svg>
    </button>
</template>
