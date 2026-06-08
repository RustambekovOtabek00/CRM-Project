import {defineStore} from "pinia";
import {computed, ref} from "vue";
import {authorizedClient} from "@/api/axios.js";

export const useChangeCompanyStore = defineStore('changeCompany', () => {
    const isLoading = ref(false);
    const isChanged = ref(false);

    const changeCompany = async (data, id) => {
        try {
            isLoading.value = true;
            await authorizedClient.patch(`/companies/${id}`, data);
            isChanged.value = true;
        } catch (error) {
            console.log(error);
        } finally {
            isLoading.value = false;
            setTimeout(() => isChanged.value = false, 3000);
        }
    }

    return {
        changeCompany,
        isLoading: computed(() => isLoading.value),
        isChanged: computed(() => isChanged.value),
    }
})