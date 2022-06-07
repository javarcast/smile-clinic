<template>
    <div class="step-line" v-show="flag == 0">
        <div class="step step-on">1</div>
        <div class="line"></div>
        <div class="step">2</div>
        <div class="line"></div>
        <div class="step">3</div>
    </div>
    <div class="step-line" v-show="flag == 1">
        <div class="step">1</div>
        <div class="line"></div>
        <div class="step step-on">2</div>
        <div class="line"></div>
        <div class="step">3</div>
    </div>
    <p class="title-register">Crea tu Cuenta SmileClinic</p>
    <form @submit.prevent="submit" class="registro-container">
        <div class="container1" v-show="flag == 0">
            <div>
                <jet-label for="id" value="DNI" />
                <jet-input id="id" type="text" class="mt-1 block w-full" v-model="form.id" required autofocus
                    autocomplete="id" />
            </div>
            <div>
                <jet-label for="name" value="Nombre" />
                <jet-input id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus
                    autocomplete="name" />
            </div>
            <div>
                <jet-label for="phone_number" value="N Telefono" />
                <jet-input id="phone_number" type="number" class="mt-1 block w-full" v-model="form.phone_number" required autofocus
                    autocomplete="phone_number" />
            </div>
            <div>
                <jet-label for="address" value="Direccion" />
                <jet-input id="address" type="number" class="mt-1 block w-full" v-model="form.address" required autofocus
                    autocomplete="address" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <Link :href="route('login')" class="underline text-sm text-gray-600 hover:text-gray-900">
                Ya estas Registrado?
                </Link>

                <jet-button @click="steps(1)" class="ml-4" :class="{ 'opacity-25': form.processing }">
                    Siguiente Paso
                </jet-button>
            </div>
        </div>
        <div class="container2" v-show="flag == 1">
            <div>
                <jet-label for="email" value="Email" />
                <jet-input id="email" type="text" class="mt-1 block w-full" v-model="form.email" required autofocus
                    autocomplete="email" />
            </div>
            <div class="mt-4">
                <jet-label for="password" value="Password" />
                <jet-input id="password" type="password" class="mt-1 block w-full" v-model="form.password" required
                    autocomplete="new-password" />
            </div>
            <div class="mt-4">
                <jet-label for="password_confirmation" value="Confirma Password" />
                <jet-input id="password_confirmation" type="password" class="mt-1 block w-full"
                    v-model="form.password_confirmation" required autocomplete="new-password" />
            </div>
            <div class="flex items-center justify-end mt-4">
                <Link :href="route('login')" class="underline text-sm text-gray-600 hover:text-gray-900">
                Ya estas Registrado?
                </Link>
                <jet-button class="ml-4" @click="steps(-1)" :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing">
                    Atras
                </jet-button>
                <jet-button class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Siguiente Paso
                </jet-button>
            </div>
        </div>
    </form>
</template>

<script>
import { defineComponent } from 'vue'
import JetRegistroContainer from '@/Jetstream/RegistroContainer.vue'
import JetRegistroContainerImagen from '@/Jetstream/RegistroContainerImagen.vue'
import JetButton from '@/Jetstream/Button.vue'
import JetInput from '@/Jetstream/Input.vue'
import JetCheckbox from '@/Jetstream/Checkbox.vue'
import JetLabel from '@/Jetstream/Label.vue'
import JetValidationErrors from '@/Jetstream/ValidationErrors.vue'
import { Head, Link, useForm, } from '@inertiajs/inertia-vue3';

export default defineComponent({
    components: {
        Head,
        JetRegistroContainer,
        JetRegistroContainerImagen,
        JetButton,
        JetInput,
        JetCheckbox,
        JetLabel,
        JetValidationErrors,
        Link,
    },

    data() {
        return {
            form: this.$inertia.form({
                id: '',
                name: '',
                email: '',
                phone_number: '',
                address: '',
                password: '',
                password_confirmation: '',
                terms: false,
            }),
            flag: 0,
        }
    },

    methods: {
        submit() {
            this.form.post(this.route('register'), {
                onFinish: () => this.form.reset('password', 'password_confirmation'),
            })
        },
        steps(value) {
            if (this.form.name !== "" && this.form.lastName !== "" && this.form.dni !== "") {
                this.flag += value;
            }
        }
    }
});
</script>


