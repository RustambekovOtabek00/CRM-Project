import {defineStore} from "pinia";
import {computed, ref} from "vue";
import {authorizedClient} from "@/api/axios.js";

export const useAddClientStore = defineStore('addClient', () => {
    const isLoading = ref(false);

    const addClient = async (data) => {
        try {
            isLoading.value = true;
            await authorizedClient.post('/clients', data);
        } catch (error) {
            console.log(error);
        } finally {
            isLoading.value = false;
        }
    }

    return {
        addClient,
        isLoading: computed(() => isLoading.value),
    }
})