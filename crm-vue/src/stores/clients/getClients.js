import {defineStore} from "pinia";
import {computed, reactive} from "vue";
import {authorizedClient} from "@/api/axios.js";

export const useGetClientsStore = defineStore('clients', () => {
    const state = reactive({
        clients: {
            all: [],
            total: 0
        },
        isLoading: false
    })

    const fetchClients = async (url = '') => {
        try {
            state.isLoading = true;
            const { data } = await authorizedClient.get('/clients' + url);
            state.clients.all = data.member;
            state.clients.total = data.totalItems;
        }
        catch (error) {
            console.log(error);
        }
        finally {
            state.isLoading = false;
        }
    }

    return {
        fetchClients,
        clients: computed(() => state.clients),
        isLoading: computed(() => state.isLoading)
    }
})