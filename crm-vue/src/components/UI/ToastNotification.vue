<script setup>
defineProps({
    message: {
        type: String,
        required: true,
    }
})
</script>

<template>
    <div class="fixed inset-x-0 z-10 grid place-content-center">
        <div class="flex items-center gap-4 rounded-sm bg-[#34D47E] px-6 py-3 mt-12">
            <svg width="23" height="23" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="11.5" cy="11.5" r="11.5" fill="white"/>
                <path d="M17.9524 7.80957L10.6191 15.1429L7.28577 11.8096" stroke="#2ED47A" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <h3 class="text-white text-sm">{{ message }}</h3>
        </div>
    </div>

</template>
