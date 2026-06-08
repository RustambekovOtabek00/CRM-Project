import {defineStore} from "pinia";
import {computed, ref} from "vue";
import {authorizedClient} from "@/api/axios.js";

export const useAddCompanyStore = defineStore('addCompany', () => {
    const isLoading = ref(false);

    const addCompany = async (data) => {
        try {
            isLoading.value = true;
            await authorizedClient.post('/companies', data);
        } catch (error) {
            console.log(error);
        } finally {
            isLoading.value = false;
        }
    }

    return {
        addCompany,
        isLoading: computed(() => isLoading.value),
    }
})