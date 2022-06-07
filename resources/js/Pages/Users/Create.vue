<script setup>
    import { Head, Link, useForm,  } from '@inertiajs/inertia-vue3';
    import DashboardLayout from "@/Layouts/DashboardLayout.vue";
    import { ref, provide, watch } from "vue";
    import JetValidationErrors from '@/Jetstream/ValidationErrors.vue';
    import JetButton from '@/Jetstream/Button.vue';
    import JetInput from '@/Jetstream/Input.vue';
    import JetCheckbox from '@/Jetstream/Checkbox.vue';
    import JetLabel from '@/Jetstream/Label.vue';

    const form = useForm({
        id: '',
        name: '',
        email: '',
        phone_number: '',
        address: '',
        password: '',
        password_confirmation: '',
        role_id: -1,
    });

    const getIDNumber = () => {
    form.id = parseInt(form.id);
}

    const props = defineProps(["roles"]);


    const  submit =  () => {

        getIDNumber();
         form.post(route('usuarios.store'), {
            onFinish: () => form.reset('password', 'password_confirmation'),
        });
    };

</script>
<template>
  <DashboardLayout>
    <div class="md:col-span-4 mt-1">
      <div class="shadow bg-white md:rounded-md p-4">


        <form @submit.prevent="submit">
          <div>
            <label class="block font-medium text-sm text-gray-700">DNI</label>
            <input
              id="id"
              type="text"
              v-model="form.id"
              required
              class="form-input w-full rounded-md shadow-sm"
              autocomplete="DNI"
            />
          </div>
          <div>
            <label class="block font-medium text-sm text-gray-700"
              >Nombre</label
            >
            <input

              id="name"
              type="text"
              v-model="form.name"
              required
              class="form-input w-full rounded-md shadow-sm"

            />
          </div>
          <div>
            <label class="block font-medium text-sm text-gray-700">Email</label>
            <input

              type="email"
              id="email"
              v-model="form.email"
              required
              class="form-input w-full rounded-md shadow-sm"
            />
          </div>
          <div>
            <label class="block font-medium text-sm text-gray-700"
              >Nro. Telefonico</label
            >
            <input
              type="text"
              id="phone_number"
              v-model="form.phone_number"
              required
              class="form-input w-full rounded-md shadow-sm"
            />
          </div>
          <div>
            <label class="block font-medium text-sm text-gray-700"
              >Dirección</label
            >
            <input
              type="text"
              id="address"
              v-model="form.address"
              required
              class="form-input w-full rounded-md shadow-sm"
            />
          </div>
          <div>
            <label class="block font-medium text-sm text-gray-700"
              >Contraseña</label
            >
            <input
              type="password"
              id="password"
              v-model="form.password"
              required
              class="form-input w-full rounded-md shadow-sm"
            />
          </div>
          <div>
            <label class="block font-medium text-sm text-gray-700"
              >Confirma contraseña</label
            >
            <input
              type="password"
              v-model="form.password_confirmation"
              id="password_confirmation"
              required
              class="form-input w-full rounded-md shadow-sm"
            />
          </div>
          <div>

            <label class="block text-left w-full">
              <span class="text-gray-700">Rol</span>
              <select
                required
                v-model="form.role_id"
                class="form-select block w-full mt-1"
              >
                <option selected value="-1">Selecciona un Rol</option>
                <option v-for="rol in roles" :key="rol.id" :value="rol.id">
                  {{ rol.name }}
                </option>
              </select>
            </label>
          </div>

           <div v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature" class="mt-4">
                <JetLabel for="terms">
                    <div class="flex items-center">
                        <JetCheckbox id="terms" v-model:checked="form.terms" name="terms" />

                        <div class="ml-2">
                            I agree to the <a target="_blank" :href="route('terms.show')" class="underline text-sm text-gray-600 hover:text-gray-900">Terms of Service</a> and <a target="_blank" :href="route('policy.show')" class="underline text-sm text-gray-600 hover:text-gray-900">Privacy Policy</a>
                        </div>
                    </div>
                </JetLabel>
            </div>



         <button
              class="
                bg-blue-500
                hover:bg-blue-700
                rounded-md
                text-white
                font-bold
                mt-2
                py-2
                px-4
              "
            >
              Crear
            </button>
          <Link
            class="
              bg-gray-200
              w-1/12
              hover:bg-blue-700 hover:text-white
              rounded-md
              text-black
              mt-2
              ml-2
              py-2
              px-4
            "
            :href="route('usuarios.index')"
          >
            Cancelar</Link
          >
        </form>
      </div>
    </div>
  </DashboardLayout>
</template>
