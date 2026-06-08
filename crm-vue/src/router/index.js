import {createRouter, createWebHistory} from 'vue-router'
import {defineAsyncComponent} from "vue";

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
        {
            path: '/',
            name: 'users',
            component: ()=> import('../views/UsersView.vue'),
            meta: {
                layout: defineAsyncComponent(() => import('@/layouts/DefaultLayout.vue'))
            },
        },
        {
            path: '/companies',
            name: 'companies',
            component: ()=> import('../views/CompaniesView.vue'),
            meta: {
                layout: defineAsyncComponent(() => import('@/layouts/DefaultLayout.vue'))
            },
        },
        {
            path: '/clients',
            name: 'clients',
            component: ()=> import('../views/ClientsView.vue'),
            meta: {
                layout: defineAsyncComponent(() => import('@/layouts/DefaultLayout.vue'))
            },
        },
        {
            path: '/settings',
            name: 'settings',
            component: () => import('../views/ClientsView.vue'),
            meta: {
                layout: defineAsyncComponent(() => import('@/layouts/DefaultLayout.vue'))
            }
        },
        {
            path: '/login',
            name: 'login',
            component: ()=> import('../views/LoginView.vue'),
            meta: {
                layout: defineAsyncComponent(() => import('@/layouts/BlankLayout.vue'))
            },
        },
        {
            path: '/signup',
            name: 'signup',
            component: ()=> import('../views/LoginView.vue'),
            meta: {
                layout: defineAsyncComponent(() => import('@/layouts/BlankLayout.vue'))
            },
        },
    ],
})

export default router
