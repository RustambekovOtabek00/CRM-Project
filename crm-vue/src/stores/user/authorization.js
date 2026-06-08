import {defineStore} from "pinia";
import axios from "axios";
import {ref} from "vue";

export const useAuthorizationStore = defineStore('UseAuthorizationStore', () => {
    const isLoading = ref(false);

    const auth = async authData => {
        try {
            isLoading.value = true;
            const response = await axios.post('http://localhost:9999/api/users/auth', authData);

            localStorage.setItem('token', response.data.token);
        }
        catch (error) {
            console.log(error);
            throw error;
        }
        finally {
            isLoading.value = false;
        }
    }

    return {
        auth,
        isLoading
    };
})
