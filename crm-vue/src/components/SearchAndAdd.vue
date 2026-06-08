<script setup>
import SearchInput from "@/components/UI/SearchInput.vue";
import FormButton from "@/components/UI/FormButton.vue";

defineProps({
    name: {
        type: String,
        required: true
    },
})

const queryFilters = defineModel('queryFilters');
const isOpenedModal = defineModel('isOpenedModal');
const emit = defineEmits(['send']);

const clear = () => {
    queryFilters.value.name = '';
    queryFilters.value.email = '';
    emit('send');
}
</script>

<template>
    <div class="flex h-fit w-full items-center justify-end bg-white px-3 py-2.5 mb-10">
        <button @click="isOpenedModal = true" class="px-3.5 py-3 rounded-sm text-white text-sm font-semibold bg-blue-500 hover:bg-blue-600 active:bg-blue-700 cursor-pointer">
            {{ name }} qo'shish
        </button>
    </div>
    <div class="grid grid-cols-12 gap-4 w-full mb-4">
        <SearchInput @send="emit('send')" v-model="queryFilters.name" class="col-span-6 lg:col-span-5 xl:col-span-4 2xl:col-span-3" :name/>
        <SearchInput @send="emit('send')" v-model="queryFilters.email" class="col-span-6 lg:col-span-5 xl:col-span-4 2xl:col-span-3" name="Email"/>
        <FormButton @click="clear()" class="col-span-3 lg:col-span-2">Tozalash</FormButton>
    </div>
</template>
