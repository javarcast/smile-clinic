<script setup>
import { Link, useForm } from "@inertiajs/inertia-vue3";
import { ref, provide} from "vue";
import DashboardLayout from "@/Layouts/DashboardLayout.vue";
import JetValidationErrors from "@/Jetstream/ValidationErrors.vue";
import JetButton from "@/Jetstream/Button.vue";
import JetInput from "@/Jetstream/Input.vue";
import JetCheckbox from "@/Jetstream/Checkbox.vue";
import JetLabel from "@/Jetstream/Label.vue";
const title = ref("Agregar Paciente");
provide("title", title);

const form = useForm({
    dni: '',
    name: '',
    phone_number: '',
    email: '',
    user_id: '',
});

const props = defineProps(['users', 'medicaments', 'diseases']);

const getIDNumber = () => {
  form.id = parseInt(form.id);
};

const submit = () => {
    getIDNumber();
  form.post(route("pacientes.store"), {
    onFinish: () => form.reset("id", "name"),
  });
};
</script>
<template>
  <DashboardLayout>
    <div class="md:col-span-4 mt-1">
      <h2 class="text-2xl md:text-3xl text-slate-800 font-bold">Agregar Paciente</h2>
      <hr class="my-6" />
      <div class="mt-4 bg-slate-50 shadow-lg rounded-sm border border-slate-200 relative px-4 py-4">
        <form @submit.prevent="submit" class="create-paciente">
            <div class="container-input">
            <label class="block font-medium text-sm text-gray-700">DNI</label>
            <input
              id="id"
              type="text"
              v-model="form.dni"
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

              class="form-input w-full rounded bg-slate-50"
            />
          </div>
          <div class="container-input">
            <label class="block font-medium text-sm text-gray-700"
              >Usuario</label
            >
            <select v-model="form.user_id" name="user_id" id="user_id">
                <option value="">Seleccione un usuario</option>
                <option v-for="user in users" :key="user.id" :value="user.id">{{user.name}}</option>
            </select>
          </div>
          <div class="btn-opt">
            <button class="btn-primary btn-black mr-2">
              Crear
            </button>
            <Link
              class="btn-primary btn-white shadow-lg ml-2"
              :href="route('pacientes.index')"
            >
              Cancelar</Link
            >
          </div>

        </form>
      </div>
    </div>
  </DashboardLayout>
</template>
