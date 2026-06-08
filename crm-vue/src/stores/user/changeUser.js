import {defineStore} from "pinia";
import {computed, ref} from "vue";
import {authorizedClient} from "@/api/axios.js";

export const useChangeUserStore = defineStore('changeUser', () => {
    const isLoading = ref(false);
    const isChanged = ref(false);

    const changeUser = async (data, id) => {
        try {
            isLoading.value = true;
            await authorizedClient.patch(`/users/update?id=${id}`, data);
            isChanged.value = true;
        } catch (error) {
            console.log(error);
        } finally {
            isLoading.value = false;
            setTimeout(() => isChanged.value = false, 3000);
        }
    }

    return {
        changeUser,
        isLoading: computed(() => isLoading.value),
        isChanged: computed(() => isChanged.value),
    }
})