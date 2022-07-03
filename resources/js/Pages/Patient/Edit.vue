<script setup>
import { Link, useForm } from "@inertiajs/inertia-vue3";
import { ref, provide, onMounted } from "vue";
import DashboardLayout from "@/Layouts/DashboardLayout.vue";
import FormErrors from "@/Components/FormErrors.vue";

const title = ref("Editar Paciente");
provide("title", title);
const props = defineProps(["users", "patient", "errors"]);
const form = useForm({
  dni: "",
  name: "",
  phone_number: "",
  email: "",
  user_id: "",
});

onMounted(() => {
  form.dni = props.patient.dni;
  form.name = props.patient.name;
  form.phone_number = props.patient.phone_number;
  form.email = props.patient.email;
  form.user_id = props.patient.user_id;
});

const getIDNumber = () => {
  form.dni = parseInt(form.dni);
};

const submit = () => {
  getIDNumber();
  form.put(route("pacientes.update", props.patient.id), {});
};
</script>

<template>
  <DashboardLayout>
    <div class="md:col-span-4 mt-1">
      <h2 class="text-2xl md:text-3xl text-slate-800 font-bold">
        Editar Paciente
      </h2>
      <hr class="my-6" />
      <form-errors :errors="errors"></form-errors>
      <div
        class="
          flex
          justify-center
          mt-4
          bg-slate-50
          shadow-lg
          rounded-sm
          border border-slate-200
          relative
          px-4
          py-4
        "
      >
        <form @submit.prevent="submit" class="flex flex-wrap w-2/3">
          <div class="w-full flex flex-wrap">
            <div class="container-input w-1/2 pr-4">
              <label class="block font-medium text-sm text-gray-700">DNI</label>
              <input
                id="id"
                type="text"
                v-model="form.dni"
                class="form-input w-full rounded bg-slate-50"
                autocomplete="DNI"
              />
            </div>
            <div class="container-input w-1/2 pl-4">
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
            <div class="container-input mt-2 w-1/2 pr-4">
              <label class="block font-medium text-sm text-gray-700"
                >Email</label
              >
              <input
                type="email"
                id="email"
                v-model="form.email"
                class="form-input w-full rounded bg-slate-50"
              />
            </div>
            <div class="container-input mt-2 w-1/2 pl-4">
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
            <div class="container-input mt-2 w-full">
              <label class="block font-medium text-sm text-gray-700"
                >Usuario</label
              >
              <select
                class="w-full"
                v-model="form.user_id"
                name="user_id"
                id="user_id"
              >
                <option value="">Seleccione un usuario</option>
                <option
                  :selected="user.id === patient.user_id"
                  v-for="user in users"
                  :key="user.id"
                  :value="user.id"
                >
                  {{ user.name }}
                </option>
              </select>
            </div>
          </div>

          <div class="btn-opt mt-8">
            <button class="btn-primary btn-black mr-2">Actualizar</button>
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

