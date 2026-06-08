import {defineStore} from "pinia";
import {computed, ref} from "vue";
import {authorizedClient} from "@/api/axios.js";

export const useChangeClientStore = defineStore('changeClient', () => {
    const isLoading = ref(false);
    const isChanged = ref(false);

    const changeClient = async (data, id) => {
        try {
            isLoading.value = true;
            await authorizedClient.patch(`/clients/${id}`, data);
            isChanged.value = true;
        } catch (error) {
            console.log(error);
        } finally {
            isLoading.value = false;
            setTimeout(() => isChanged.value = false, 3000);
        }
    }

    return {
        changeClient,
        isLoading: computed(() => isLoading.value),
        isChanged: computed(() => isChanged.value),
    }
})