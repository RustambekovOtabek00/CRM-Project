import {defineStore} from "pinia";
import {computed, ref} from "vue";
import {authorizedClient} from "@/api/axios.js";

export const useAddUserStore = defineStore('addUser', () => {
    const isLoading = ref(false);

    const addUser = async (data) => {
        try {
            isLoading.value = true;
            await authorizedClient.post('/users', data);
        } catch (error) {
            console.log(error);
        } finally {
            isLoading.value = false;
        }
    }

    return {
        addUser,
        isLoading: computed(() => isLoading.value),
    }
})