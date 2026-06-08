import {defineStore} from "pinia";
import {computed, reactive} from "vue";
import {authorizedClient} from "@/api/axios.js";

export const useGetCompaniesStore = defineStore('companies', () => {
    const state = reactive({
        companies: {
            all: [],
            total: 0
        },
        isLoading: false
    })

    const fetchCompanies = async (url = '') => {
        try {
            state.isLoading = true;
            const { data } = await authorizedClient.get('/companies' + url);
            state.companies.all = data.member;
            state.companies.total = data.totalItems;
        }
        catch (error) {
            console.log(error);
        }
        finally {
            state.isLoading = false;
        }
    }

    return {
        fetchCompanies,
        companies: computed(() => state.companies),
        isLoading: computed(() => state.isLoading)
    }
})