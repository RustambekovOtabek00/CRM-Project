import {defineStore} from "pinia";
import {authorizedClient} from "@/api/axios.js";

export const useDeleteCompanyStore = defineStore('deleteCompany', () => {
    const deleteCompany = async (id) => {
        try {
            return await authorizedClient.delete(`/companies/${id}`);
        } catch (error) {
            console.log(error);
        }
    }

    return {
        deleteCompany,
    }
})