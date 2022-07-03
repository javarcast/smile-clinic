<script setup>

import { Link, useForm } from "@inertiajs/inertia-vue3";
import { ref, provide} from "vue";
import DashboardLayout from "@/Layouts/DashboardLayout.vue";

    const title = ref("Editar Solicitud");
    provide("title", title);

    const props = defineProps(["appointment_request"]);
  
    const form = useForm({
        description: props.appointment_request.description,
        date_appointment: props.appointment_request.date_appointment,
        client_id: props.appointment_request.client_id,
        status: props.appointment_request.status,
    })

    const submit = () => {
      form.put(route("solicitudes.update", props.appointment_request.id));
    }

</script>

<template>
    <DashboardLayout>
      <div class="md:col-span-4 mt-1">
        <h2 class="text-2xl md:text-3xl text-slate-800 font-bold">Editar Usuario</h2>
        <hr class="my-6" />
        <div class="flex justify-center mt-4 bg-slate-50 shadow-lg rounded-sm border border-slate-200 relative px-4 py-4">
          <form @submit.prevent="submit" class="flex flex-wrap w-2/3 col-edit">
            <div class="w-full flex flex-wrap">
              <div class="container-input w-full mb-4">
                <label class="block font-medium text-sm text-gray-700"
                  >Nombre del Paciente</label
                >
                <input
                  type="text"
                  v-model="props.appointment_request.user.name"
                  required
                  class="form-input w-full rounded bg-slate-50"
                  readonly
                />
              </div>
              <div class="container-input w-full mb-4">
                <label class="block font-medium text-sm text-gray-700"
                  >Descripción</label
                >
                <textarea
                  rows="4"
                  v-model="form.description"
                  required
                  class="form-input w-full rounded bg-slate-50"
                  readonly
                />
              </div>
              <div class="container-input w-full mb-4">
                <label class="block font-medium text-sm text-gray-700">Fecha Cita</label>
                <input
                  type="text"
                  v-model="form.date_appointment"
                  required
                  class="form-input w-full rounded  bg-slate-50"
                  readonly
                />
              </div>
              <div class="container-input w-full mb-4">
                <label class="block text-left w-full">
                  <span class="text-gray-700">Estatus</span>
                  <select
                    required
                    v-model="form.status"
                    class="form-input w-full rounded bg-slate-50"
                  >
                    <option selected value="-1">Selecciona un Estatus</option>
                    <option value="0">Pendiente</option>
                    <option value="1">Completada</option>
                  </select>
                </label>
              </div>
              <div class="btn-opt">
                <button class="btn-primary btn-black mr-2">
                  Actualizar
                </button>
                <Link
                  class="btn-primary btn-white shadow-lg ml-2"
                  :href="route('solicitudes.index')"
                >
                  Cancelar</Link
                >
              </div>
            </div>
          </form>
        </div>
      </div>
    </DashboardLayout>

</template>

