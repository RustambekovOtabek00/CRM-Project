import {defineStore} from "pinia";
import {authorizedClient} from "@/api/axios.js";

export const useDeleteUserStore = defineStore('deleteUser', () => {
    const deleteUser = async (id) => {
        try {
            return await authorizedClient.delete(`/users/${id}`);
        } catch (error) {
            console.log(error);
        }
    }

    return {
        deleteUser,
    }
})