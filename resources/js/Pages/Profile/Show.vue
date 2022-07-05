<template>
    <div class="flex h-screen overflow-hidden">

        <!-- Content area -->
        <div class="relative flex flex-col flex-1 overflow-y-auto overflow-x-hidden bg-slate-100">
            <Header />
            <div class="max-w-7xl mx-auto py-10 ">
                <div class="flex">
                    <div class="pb-12 pt-0 w-full">
                        <div class="max-w-full mx-auto">
                            <div class="grid grid-cols-4 gap-2">
                                <div class="sm:h-auto col-span-1 opcion-perfil menuDashboard ">
                                    <!-- Sidebar header -->
                                    <div class="flex justify-between mt-5 ml-5 mb-10 pr-3 sm:px-2 truncate">
                                        <!-- Logo -->
                                        <Link :href="'/dashboard'" class="flex logo-dashboard">
                                        <img src="../../../../public/images/logo3.png" alt="icon logo" class="icon-logo">
                                        <img src="../../../../public/images/logo.png" alt="text logo"
                                            class="text-logo  lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">
                                        </Link>
                                    </div>
                                    <ul class="flex flex-col mt-5 ps-2">
                                        <li class="flex justify-between m-5 pr-3 sm:px-2 mt-6 mb-6 truncate">
                                            <Link :href="'/dashboard'" class="flex  items-end ml-1">
                                            <img src="../../../../public/images/dashboard.png" alt="icon users"
                                                class="icon-sidebar">
                                            <span
                                                class="text-sm text-sc-white font-medium ml-3  lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Dashboard</span>
                                            </Link>
                                        </li>
                                        <li class="m-3 ">
                                            <button class="text-left w-full text-white p-3 my-0 mx-auto "
                                                @click="vista(0)"><i
                                                    class="px-2 fa-solid fa-user text-light fa-lg mr-3"></i><span
                                                    class="sm:contents hidden">Editar
                                                    Perfil</span></button>
                                        </li>
                                        <li class="m-3">
                                            <button class="text-left text-white p-3 mb-2"
                                                @click="vista(1)"><i
                                                    class="px-2 fa-solid fa-unlock-keyhole text-light fa-lg mr-3"></i><span
                                                    class="sm:contents hidden">Cambiar Contraseña</span></button>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-span-3"
                                    v-if="$page.props.jetstream.canUpdateProfileInformation && this.q == 0">
                                    <update-profile-information-form :user="$page.props.user" />
                                    <jet-section-border />
                                </div>
                                <div class="col-span-3" v-if="$page.props.jetstream.canUpdatePassword && this.q == 1">
                                    <update-password-form class="mt-10 sm:mt-0" />

                                    <jet-section-border />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div>

    </div>
</template>

<script>
import { defineComponent } from 'vue'
import AppLayout from "@/Layouts/AppLayout.vue";
import DashboardLayout from "@/Layouts/DashboardLayout.vue";
import DeleteUserForm from '@/Pages/Profile/Partials/DeleteUserForm.vue'
import JetSectionBorder from '@/Jetstream/SectionBorder.vue'
import LogoutOtherBrowserSessionsForm from '@/Pages/Profile/Partials/LogoutOtherBrowserSessionsForm.vue'
import TwoFactorAuthenticationForm from '@/Pages/Profile/Partials/TwoFactorAuthenticationForm.vue'
import UpdatePasswordForm from '@/Pages/Profile/Partials/UpdatePasswordForm.vue'
import UpdateProfileInformationForm from '@/Pages/Profile/Partials/UpdateProfileInformationForm.vue'
import { Link } from "@inertiajs/inertia-vue3";
import Header from '../../Components/Header.vue';
export default defineComponent({
    props: ['sessions'],

    components: {
        AppLayout,
        Link,
        Header,
        DeleteUserForm,
        JetSectionBorder,
        LogoutOtherBrowserSessionsForm,
        TwoFactorAuthenticationForm,
        UpdatePasswordForm,
        DashboardLayout,
        UpdateProfileInformationForm,
    },
    data() {
        return {
            q: 0,
        };
    },
    methods: {
        vista(valor) {
            this.q = valor;
        },
    },
})
</script>
