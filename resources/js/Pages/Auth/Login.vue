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
              <!-- button go back to  -->
                <Link  href="/" >
                    <img class="go-back-to" src="../../../images/go-back-to.png" alt="">
                </Link>
            </div>
          </div>          

          <div class="max-w-sm mx-auto px-4 py-8">
            <!-- Logo -->
            <JetAuthenticationCardLogo />
            
            <h1 class="text-3xl text-slate-800 font-bold mb-6 text-center sc-black">Bienvenido a Smile<span>Clinic</span></h1>
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
                    <div class="flex items-center justify-end mt-4">
                        <!-- <Link v-if="canResetPassword" :href="route('password.request')" class="underline text-sm text-gray-600 hover:text-gray-900">
                            ¿Olvidó su contraseña?
                        </Link> -->

                        <button class="btn-primary btn-black" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Ingresar
                        </button>
                    </div>
                </div>
            </form>
            <!-- Footer -->
            <div class="pt-5 mt-6 border-t border-slate-200">
              <div class="text-sm">
                ¿No tienes una cuenta? 
                <Link  :href="route('register')" class="ml-4 text-sm text-gray-700 underline">
                    Regístrate
                </Link>
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
