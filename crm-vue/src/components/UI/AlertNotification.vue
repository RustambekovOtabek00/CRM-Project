<script setup>
defineProps({
    message: {
        type: String,
        required: true,
    }
})

const model = defineModel();
const emit = defineEmits(['deleteFunction']);

const deleteFunction = () => {
    emit('deleteFunction');
}
</script>

<template>
    <div v-if="model" class="fixed inset-x-0 z-10 grid place-content-center">
        <div class="flex items-center bg-white gap-12 my-shadow rounded-sm px-6 py-4 mt-8.5">
            <h3 class="">{{ message }}</h3>
            <div class="flex gap-5 text-white">
                <button @click="deleteFunction" class="bg-[#F7685B] rounded-xs py-2 px-10 cursor-pointer">Ha</button>
                <button @click="model = false" class="bg-[#34D47E] rounded-xs py-2 px-9 cursor-pointer">Yo'q</button>
            </div>
        </div>
    </div>
</template>
