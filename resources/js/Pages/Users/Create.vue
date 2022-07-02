<script setup>
import { Link, useForm } from "@inertiajs/inertia-vue3";
import { ref, provide} from "vue";
import DashboardLayout from "@/Layouts/DashboardLayout.vue";
import JetValidationErrors from "@/Jetstream/ValidationErrors.vue";
import JetButton from "@/Jetstream/Button.vue";
import JetInput from "@/Jetstream/Input.vue";
import JetCheckbox from "@/Jetstream/Checkbox.vue";
import JetLabel from "@/Jetstream/Label.vue";
const title = ref("Agregar Usuario");
provide("title", title);

const form = useForm({
  id: "",
  name: "",
  email: "",
  phone_number: "",
  address: "",
  password: "",
  password_confirmation: "",
  specialty_id: -1,
  role_id: -1,
  terms: false,
});

const getIDNumber = () => {
  form.id = parseInt(form.id);
};

const props = defineProps(["roles", "specialties", 'errors']);

const submit = () => {
  getIDNumber();
  form.post(route("usuarios.store"), {
    onFinish: () => form.reset("password", "password_confirmation"),
  });
};
</script>
<template>
  <DashboardLayout>
    <div class="md:col-span-4 mt-1">
      <h2 class="text-2xl md:text-3xl text-slate-800 font-bold">Agregar Usuario</h2>
      <hr class="my-6" />
      <div class="mt-4 bg-slate-50 shadow-lg rounded-sm border border-slate-200 relative px-4 py-4">
        <form @submit.prevent="submit" class="create-user">
          <div class="container-input">
            <label class="block font-medium text-sm text-gray-700">DNI</label>
            <input
              id="id"
              type="text"
              v-model="form.id"
              required
              class="form-input w-full rounded bg-slate-50"
              autocomplete="DNI"
            />
          </div>
          <div class="container-input">
            <label class="block font-medium text-sm text-gray-700"
              >Nombre</label
            >
            <input
              id="name"
              type="text"
              v-model="form.name"
              required
              class="form-input w-full rounded bg-slate-50"
            />
          </div>
          <div class="container-input">
            <label class="block font-medium text-sm text-gray-700">Email</label>
            <input
              type="email"
              id="email"
              v-model="form.email"
              required
              class="form-input w-full rounded bg-slate-50"
            />
          </div>
          <div class="container-input">
            <label class="block font-medium text-sm text-gray-700"
              >Nro. Telefonico</label
            >
            <input
              type="text"
              id="phone_number"
              v-model="form.phone_number"
              required
              class="form-input w-full rounded bg-slate-50"
            />
          </div>
          <div class="container-input">
            <label class="block font-medium text-sm text-gray-700"
              >Dirección</label
            >
            <input
              type="text"
              id="address"
              v-model="form.address"
              required
              class="form-input w-full rounded bg-slate-50"
            />
          </div>
          <div class="container-input">
            <label class="block text-left w-full">
              <span class="text-gray-700">Rol</span>
              <select
                required
                v-model="form.role_id"
                class="form-input w-full rounded bg-slate-50"
              >
                <option selected value="-1">Selecciona un Rol</option>
                <option v-for="rol in roles" :key="rol.id" :value="rol.id">
                  {{ rol.name }}
                </option>
              </select>
            </label>
          </div>
          <div class="container-input">
            <label class="block font-medium text-sm text-gray-700"
              >Contraseña</label
            >
            <input
              type="password"
              id="password"
              v-model="form.password"
              required
              class="form-input w-full rounded bg-slate-50"
            />
          </div>
          <div class="container-input">
            <label class="block font-medium text-sm text-gray-700"
              >Confirma contraseña</label
            >
            <input
              type="password"
              v-model="form.password_confirmation"
              id="password_confirmation"
              required
              class="form-input w-full rounded bg-slate-50"
            />
          </div>
          <div v-if="form.role_id === 2" class="container-input">
            <label class="block text-left w-full">
              <span class="text-gray-700">Especialidad del Odontologo</span>
              <select
                required
                v-model="form.specialty_id"
                class="form-input w-full rounded bg-slate-50"
              >
                <option selected value="-1">Selecciona una Especialidad</option>
                <option v-for="specialty in specialties" :key="specialty.id" :value="specialty.id">
                  {{ specialty.name }}
                </option>
              </select>
            </label>
          </div>

          <div
            v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature"
            class="mt-4"
          >
            <JetLabel for="terms">
              <div class="flex items-center">
                <JetCheckbox
                  id="terms"
                  v-model:checked="form.terms"
                  name="terms"
                />

                <div class="ml-2">
                  I agree to the
                  <a
                    target="_blank"
                    :href="route('terms.show')"
                    class="underline text-sm text-gray-600 hover:text-gray-900"
                    >Terms of Service</a
                  >
                  and
                  <a
                    target="_blank"
                    :href="route('policy.show')"
                    class="underline text-sm text-gray-600 hover:text-gray-900"
                    >Privacy Policy</a
                  >
                </div>
              </div>
            </JetLabel>
          </div>

          <div class="btn-opt">
            <button class="btn-primary btn-black mr-2">
              Crear
            </button>
            <Link
              class="btn-primary btn-white shadow-lg ml-2"
              :href="route('usuarios.index')"
            >
              Cancelar</Link
            >
          </div>

        </form>
      </div>
    </div>
  </DashboardLayout>
</template>
