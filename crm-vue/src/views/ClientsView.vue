<script setup>
import SearchAndAdd from "@/components/SearchAndAdd.vue";
import ModalWindow from "@/components/ModalWindow.vue";
import ToastNotification from "@/components/UI/ToastNotification.vue";
import {reactive, ref} from "vue";
import {useGetClientsStore} from "@/stores/clients/getClients.js";
import {useAddClientStore} from "@/stores/clients/addClient.js";
import {useChangeClientStore} from "@/stores/clients/changeClient.js";
import {useDeleteClientStore} from "@/stores/clients/deleteClient.js";
import AlertNotification from "@/components/UI/AlertNotification.vue";

const clientsStore = useGetClientsStore()
const addClientStore = useAddClientStore();
const changeClientStore = useChangeClientStore();
const deleteClientStore = useDeleteClientStore();
const isOpenedModalAdd = ref(false);
const isOpenedModalChange = ref(false);
const isOpenedModalDelete = ref(false);
const toastNotification = ref(false);
const currentUserId = ref(0);

const queryFilters = reactive({
    query: '?page=1',
    name: '',
    email: '',
})

const clientData = reactive({
    name: '',
    email: '',
    password: '',
    company: ''
})

clientsStore.fetchClients(queryFilters.query);

const addClient = async (data) => {
    await addClientStore.addClient({...data.value});
    await clientsStore.fetchClients(queryFilters.query);
}

const changeClient = async (data) => {
    await changeClientStore.changeClient({...data.value}, currentUserId.value);
    await clientsStore.fetchClients(queryFilters.query);

    currentUserId.value = 0;
    toastNotification.value = changeClientStore.isChanged;

    setTimeout(() => toastNotification.value = false, 3000);
}

const deleteClient = async () => {
    await deleteClientStore.deleteClient(currentUserId.value);
    await clientsStore.fetchClients(queryFilters.query);

    isOpenedModalDelete.value = false;
    currentUserId.value = 0;
}

const search = () => {
    queryFilters.query = '?page=1';

    if (queryFilters.name) {
        queryFilters.query += `&name=${queryFilters.name}`;
    }

    if (queryFilters.email) {
        queryFilters.query += `&email=${queryFilters.email}`;
    }

    clientsStore.fetchClients( queryFilters.query);
}

// GPT. Sababi chiroyli yozib berdi
function timeAgo(date) {
    const now = new Date();
    const past = new Date(date);

    const diff = Math.floor((now - past) / 1000); // sekund

    if (diff < 60) return `${diff} soniya oldin`;
    if (diff < 3600) return `${Math.floor(diff / 60)} daqiqa oldin`;
    if (diff < 86400) return `${Math.floor(diff / 3600)} soat oldin`;
    if (diff < 2592000) return `${Math.floor(diff / 86400)} kun oldin`;

    return past.toLocaleDateString();
}
</script>

<template>
    <section class="flex flex-col w-full">
        <SearchAndAdd v-model:is-opened-modal="isOpenedModalAdd" @send="search" v-model:query-filters="queryFilters" name="Mijoz"/>
        <div class="bg-white rounded-md ">
            <table class="w-full">
                <thead>
                <tr class="text-my-gray border-b border-gray-200">
                    <th class="px-6 xl:px-16 py-3.5 text-left text-sm font-medium uppercase tracking-wider">Foydalanuvchilar</th>
                    <th class="px-6 py-3.5 text-left text-sm font-medium uppercase tracking-wider">Email</th>
                    <th class="px-6 py-3.5 text-left text-sm font-medium uppercase tracking-wider">Companiya</th>
                    <th class="px-6 py-3.5 text-left text-sm font-medium uppercase tracking-wider">Parol</th>
                    <th class="px-6 py-3.5 text-left text-sm font-medium uppercase tracking-wider">So’ngi faollik</th>
                    <th class="px-6 py-3.5 text-left text-sm font-medium uppercase tracking-wider"></th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 overflow-scroll">
                <tr v-for="client in clientsStore.clients.all" :key="client.id" class="text-my-blue-gray">
                    <td class="px-6 xl:px-16 py-4 whitespace-nowrap text-gray-800 flex gap-3">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_1_2883)">
                                <path d="M9.99951 11.6724C11.2099 11.6724 13.0664 11.981 14.6021 12.5962C15.3693 12.9036 16.0124 13.2709 16.4526 13.6772C16.8879 14.079 17.0776 14.4715 17.0776 14.8608V17.0776H2.92236V14.8608C2.92243 14.4715 3.11205 14.0791 3.54736 13.6772C3.98759 13.2709 4.63069 12.9036 5.39795 12.5962C6.93338 11.9811 8.78913 11.6724 9.99951 11.6724ZM9.99951 2.92236C11.7615 2.92236 13.1888 4.34893 13.189 6.11084C13.189 7.87285 11.7615 9.30029 9.99951 9.30029C8.2377 9.30006 6.81104 7.87271 6.81104 6.11084C6.81115 4.34907 8.23777 2.9226 9.99951 2.92236Z" stroke="#C2CFE0" stroke-width="1.4"/>
                            </g>
                            <defs>
                                <clipPath id="clip0_1_2883">
                                    <rect width="20" height="20" fill="white"/>
                                </clipPath>
                            </defs>
                        </svg>
                        <span>{{ client.name }}</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm ">{{ client.email }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm ">{{ client.company.name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm ">{{ client.password }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm ">{{ timeAgo(client.lastSeen) }}</td>
                    <td class="px-6 py-4 flex gap-6">
                        <button @click="isOpenedModalChange = true; currentUserId = client.id" class="cursor-pointer">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_1_989)">
                                    <path d="M2.5 14.375V17.5H5.625L14.8417 8.28334L11.7167 5.15834L2.5 14.375ZM17.2583 5.86667C17.5833 5.54167 17.5833 5.01667 17.2583 4.69167L15.3083 2.74167C14.9833 2.41667 14.4583 2.41667 14.1333 2.74167L12.6083 4.26667L15.7333 7.39167L17.2583 5.86667Z" fill="#2ED47A"/>
                                </g>
                                <defs>
                                    <clipPath id="clip0_1_989">
                                        <rect width="20" height="20" fill="white"/>
                                    </clipPath>
                                </defs>
                            </svg>
                        </button>
                            <button @click="isOpenedModalDelete = true; currentUserId = client.id" class="cursor-pointer">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_1_1019)">
                                    <path d="M4.99984 15.8333C4.99984 16.75 5.74984 17.5 6.6665 17.5H13.3332C14.2498 17.5 14.9998 16.75 14.9998 15.8333V5.83333H4.99984V15.8333ZM15.8332 3.33333H12.9165L12.0832 2.5H7.9165L7.08317 3.33333H4.1665V5H15.8332V3.33333Z" fill="#F7685B"/>
                                </g>
                                <defs>
                                    <clipPath id="clip0_1_1019">
                                        <rect width="20" height="20" fill="white"/>
                                    </clipPath>
                                </defs>
                            </svg>
                        </button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </section>

    <ModalWindow
        @add-or-change="addClient"
        v-model:data="clientData"
        :is-loading="addClientStore.isLoading"
        :is-client="true"
        v-model:is-opened-modal="isOpenedModalAdd"
        title="Mijoz qo'shish"
    />
    <ModalWindow
        @add-or-change="changeClient"
        v-model:data="clientData"
        :is-loading="changeClientStore.isLoading"
        :is-client="true"
        v-model:is-opened-modal="isOpenedModalChange"
        title="O'zgartirish"
    />

    <ToastNotification v-if="toastNotification" message="Ma'lumotlar muvaffaqqiyatli o'zgartirildi"/>
    <AlertNotification @deleteFunction="deleteClient" v-model="isOpenedModalDelete" message="Rostan ham o’chirilsinmi ?"/>
</template>
