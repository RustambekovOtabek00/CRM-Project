<script setup>
import FormInput from "@/components/UI/FormInput.vue";
import FormButton from "@/components/UI/FormButton.vue";
import {useGetCompaniesStore} from "@/stores/company/getCompanies.js";

defineProps({
    title: {
        type: String,
        required: true
    },
    isClient: {
        type: Boolean,
        required: false
    },
    isLoading: {
        type: Boolean,
        required: false
    }
})
const companiesStore = useGetCompaniesStore();
const isOpenedModal = defineModel('isOpenedModal');
const data = defineModel('data');
const emit  = defineEmits(['addOrChange']);

companiesStore.fetchCompanies();

const clear = () => {
    data.value.name = "";
    data.value.email = "";
    data.value.password = "";
    data.value.company = "";
}

const handleSubmit = () => {
    emit("addOrChange", data);
}
</script>

<template>
    <div v-if="isOpenedModal" @click.self="isOpenedModal = false; clear()" class="fixed inset-0 z-10 grid place-content-center">
        <div class="my-shadow max-w-100 w-full sm:min-w-100">
            <div class="border-b-2 border-gray-200 bg-white px-6 py-5">
                <h3 class="text-sm text-center font-semibold">{{ title }}</h3>
            </div>
            <div class="flex flex-col bg-white gap-5 py-4 px-6">
                <FormInput v-model="data.name" label-name="Ism"/>
                <FormInput v-model="data.email" label-name="Email"/>
                <FormInput v-model="data.password" label-name="Parol"/>
                <div v-if="isClient" class="flex flex-col gap-2 text-sm">
                    <label for="company">Company</label>
                    <select v-model="data.company" class="px-2.5 py-2 rounded-md outline-none border border-gray-300 focus:border-my-blue" name="company" id="company">
                        <option disabled selected value="">Tanlash</option>
                        <option v-for="company in companiesStore.companies.all" :key="company.id" :value="company['@id']">
                            {{ company.name }}
                        </option>
                    </select>
                </div>

                <FormButton :is-loading @accept="handleSubmit(); clear(); isOpenedModal = false">Qo'shish</FormButton>
            </div>
        </div>
    </div>
</template>