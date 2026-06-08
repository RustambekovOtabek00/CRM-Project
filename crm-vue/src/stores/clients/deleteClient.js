import {defineStore} from "pinia";
import {authorizedClient} from "@/api/axios.js";

export const useDeleteClientStore = defineStore('deleteClient', () => {
    const deleteClient = async (id) => {
        try {
            return await authorizedClient.delete(`/clients/${id}`);
        } catch (error) {
            console.log(error);
        }
    }

    return {
        deleteClient,
    }
})