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



const submit = () => {
 
};
</script>
<template>
  <DashboardLayout>
    <div class="md:col-span-4 mt-1">
      <h2 class="text-2xl md:text-3xl text-slate-800 font-bold">Agregar Paciente</h2>
      <hr class="my-6" />
      <div class="mt-4 bg-slate-50 shadow-lg rounded-sm border border-slate-200 relative px-4 py-4">
        <form @submit.prevent="submit" class="create-paciente">
            <span>aqui va los campos del formulario de registro de pacientes</span>
          <!-- <div class="container-input">
            <label class="block font-medium text-sm text-gray-700">DNI</label>
            <input
              id="id"
              type="text"
              v-model="form.id"
              required
              class="form-input w-full rounded bg-slate-50"
              autocomplete="DNI"
            />
          </div> -->
         

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
