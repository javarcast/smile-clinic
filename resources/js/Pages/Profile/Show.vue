<template>
    <app-layout title="Perfil">
        <!-- <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Configurar Cuenta
            </h2>
        </template> -->

        <div>
            <div class="max-w-7xl mx-auto py-10 ">
                <div class="flex">
                    <div class="pb-12 pt-0 w-full">
                        <div class="max-w-full mx-auto">
                            <div class="grid grid-cols-4 gap-2">
                                <div class="sm:h-auto col-span-1 opcion-perfil menuDashboard ">
                                    <ul class="flex flex-col mt-5 ps-2">
                                        <li class="m-3 mt-10">
                                            <button class="text-left w-full text-white p-3 my-0 mx-auto sidebar-link" @click="vista(0)"><i class="px-2 fa-solid fa-user text-light fa-lg mr-3"></i><span class="sm:contents hidden">Editar
                                                Perfil</span></button>
                                        </li>
                                        <li class="m-3">
                                            <button class="text-left text-white p-3 mb-2 sidebar-link" @click="vista(1)"><i class="px-2 fa-solid fa-unlock-keyhole text-light fa-lg mr-3"></i><span class="sm:contents hidden">Cambiar Contraseña</span></button>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-span-3" v-if="$page.props.jetstream.canUpdateProfileInformation && this.q == 0">
                                    <update-profile-information-form :user="$page.props.user" />
                                    <jet-section-border />
                                </div>
                                <div  class="col-span-3" v-if="$page.props.jetstream.canUpdatePassword && this.q == 1">
                                    <update-password-form class="mt-10 sm:mt-0" />

                                    <jet-section-border />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import { defineComponent } from 'vue'
import AppLayout from '@/Layouts/AppLayout.vue'
import DeleteUserForm from '@/Pages/Profile/Partials/DeleteUserForm.vue'
import JetSectionBorder from '@/Jetstream/SectionBorder.vue'
import LogoutOtherBrowserSessionsForm from '@/Pages/Profile/Partials/LogoutOtherBrowserSessionsForm.vue'
import TwoFactorAuthenticationForm from '@/Pages/Profile/Partials/TwoFactorAuthenticationForm.vue'
import UpdatePasswordForm from '@/Pages/Profile/Partials/UpdatePasswordForm.vue'
import UpdateProfileInformationForm from '@/Pages/Profile/Partials/UpdateProfileInformationForm.vue'

export default defineComponent({
    props: ['sessions'],

    components: {
        AppLayout,
        DeleteUserForm,
        JetSectionBorder,
        LogoutOtherBrowserSessionsForm,
        TwoFactorAuthenticationForm,
        UpdatePasswordForm,
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
