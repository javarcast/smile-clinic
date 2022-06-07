<script setup>
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import JetAuthenticationCard from '@/Jetstream/AuthenticationCard.vue';
import JetAuthenticationCardLogo from '@/Jetstream/AuthenticationCardLogo.vue';
import JetButton from '@/Jetstream/Button.vue';
import JetInput from '@/Jetstream/Input.vue';
import JetCheckbox from '@/Jetstream/Checkbox.vue';
import JetLabel from '@/Jetstream/Label.vue';
import JetValidationErrors from '@/Jetstream/ValidationErrors.vue';

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.transform(data => ({
        ...data,
        remember: form.remember ? 'on' : '',
    })).post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <Head title="Log in" />

    <div class="relative flex">

      <!-- Content -->
      <div class="w-full md:w-1/2">
        <div class="min-h-screen h-full flex flex-col after:flex-1">

          <div class="flex-1">
            <div class="flex items-center justify-between h-16 px-4 sm:px-6 lg:px-8">
              <!-- Logo -->
              <router-link class="block" to="/">
                <svg width="32" height="32" viewBox="0 0 32 32">
                  <defs>
                    <linearGradient x1="28.538%" y1="20.229%" x2="100%" y2="108.156%" id="logo-a">
                      <stop stop-color="#A5B4FC" stop-opacity="0" offset="0%" />
                      <stop stop-color="#A5B4FC" offset="100%" />
                    </linearGradient>
                    <linearGradient x1="88.638%" y1="29.267%" x2="22.42%" y2="100%" id="logo-b">
                      <stop stop-color="#38BDF8" stop-opacity="0" offset="0%" />
                      <stop stop-color="#38BDF8" offset="100%" />
                    </linearGradient>
                  </defs>
                  <rect fill="#6366F1" width="32" height="32" rx="16" />
                  <path d="M18.277.16C26.035 1.267 32 7.938 32 16c0 8.837-7.163 16-16 16a15.937 15.937 0 01-10.426-3.863L18.277.161z" fill="#4F46E5" />
                  <path d="M7.404 2.503l18.339 26.19A15.93 15.93 0 0116 32C7.163 32 0 24.837 0 16 0 10.327 2.952 5.344 7.404 2.503z" fill="url(#logo-a)" />
                  <path d="M2.223 24.14L29.777 7.86A15.926 15.926 0 0132 16c0 8.837-7.163 16-16 16-5.864 0-10.991-3.154-13.777-7.86z" fill="url(#logo-b)" />
                </svg>
              </router-link>
            </div>
          </div>          

          <div class="max-w-sm mx-auto px-4 py-8">
           
            <JetAuthenticationCardLogo />
            
            <h1 class="text-3xl text-slate-800 font-bold mb-6 text-center sc-blue">Bienvenido a Smile<span>Clinic</span></h1>
            <JetValidationErrors class="mb-4" />
            <!-- Form -->
            <form @submit.prevent="submit">
                <div class="space-y-4">
                    <div>
                    <input
                        id="email"
                        v-model="form.email"
                        type="email"
                        placeholder="Email "
                        class="form-input w-full"
                        required
                        autofocus
                    />
                    </div>
                    <div>
                        <input
                            id="password"
                            v-model="form.password"
                            type="password"
                            placeholder="Contraseña"
                            class="mt-1 block w-full"
                            required
                            autocomplete="current-password"
                        />
                    </div>
                    <div class="block mt-4">
                        <label class="flex items-center">
                            <JetCheckbox v-model:checked="form.remember" name="remember" />
                            <span class="ml-2 text-sm text-gray-600">Recuérdame</span>
                        </label>
                    </div>
                    <div class="flex items-center justify-between mt-4">
                        <Link v-if="canResetPassword" :href="route('password.request')" class="underline text-sm text-gray-600 hover:text-gray-900">
                            ¿Olvidó su contraseña?
                        </Link>

                        <button class="btn-primary btn-blck" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Ingresar
                        </button>
                    </div>
                </div>
            </form>
            <!-- Footer -->
            <div class="pt-5 mt-6 border-t border-slate-200">
              <div class="text-sm">
                ¿No tienes una cuenta? <router-link class="font-medium text-indigo-500 hover:text-indigo-600" to="/signup">Regístrate</router-link>
              </div>
              
            </div>
          </div>

        </div>
      </div>

      <!-- Image -->
      <div class="hidden md:block absolute top-0 bottom-0 right-0 md:w-1/2 form-image" aria-hidden="true">
        <img class="object-cover object-center w-full h-full" src="../../../images/cover.jpg" width="760" height="1024" alt="Authentication" />
        <!-- <img class="absolute top-1/2 left-0 transform -translate-x-1/2 w-3/12 hidden lg:block" src="../../../images/tooth.png" width="218" height="224" alt="Authentication decoration" /> -->
      </div>

    </div>
     
</template>
