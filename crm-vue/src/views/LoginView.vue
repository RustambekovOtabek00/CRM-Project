<script setup>
import FormInput from "@/components/UI/FormInput.vue";
import FormButton from "@/components/UI/FormButton.vue";
import {useAuthorizationStore} from "@/stores/user/authorization.js";
import {reactive} from "vue";
import {useRouter} from "vue-router";

const authStore = useAuthorizationStore();
const router = useRouter();

const userData = reactive({
    email: "",
    password: "",
});

const auth = async () => {
    await authStore.auth(userData);
    router.push({ name: 'users' });
}

</script>

<template>
    <div class="min-h-dvh grid place-content-center">
        <form @submit.prevent="auth" class="flex flex-col max-w-100 w-full sm:min-w-100 gap-5 bg-gray-400 p-10 rounded-2xl text-white">
            <h2 class="text-center text-2xl font-medium">Kirish</h2>
            <FormInput v-model="userData.email" label-name="Email" placeholder="email kiriting..."/>
            <FormInput v-model="userData.password" input-type="password" label-name="Parol" placeholder="parol kiriting..."/>
            <FormButton :isLoading="authStore.isLoading">Kirish</FormButton>

            <div class="flex justify-center">
                <p>
                    Don't have an account?
                    <RouterLink :to="{ name: 'signup' }">Register</RouterLink>
                </p>
            </div>
        </form>
    </div>
</template>
