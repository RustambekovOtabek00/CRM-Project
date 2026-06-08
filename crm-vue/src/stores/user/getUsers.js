import {defineStore} from "pinia";
import {computed, reactive} from "vue";
import {authorizedClient} from "@/api/axios.js";

export const useGetUsersStore = defineStore('users', () => {
    const state = reactive({
        users: {
            all: [],
            total: 0
        },
        isLoading: false
    })

    const fetchUsers = async (url = '') => {
        try {
            state.isLoading = true;
            const { data } = await authorizedClient.get('/users' + url);
            state.users.all = data.member;
            state.users.total = data.totalItems;
        }
        catch (error) {
            console.log(error);
        }
        finally {
            state.isLoading = false;
        }
    }

    return {
        fetchUsers,
        users: computed(() => state.users),
        isLoading: computed(() => state.isLoading)
    }
})