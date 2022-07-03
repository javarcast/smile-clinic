<script setup>
import { ref, provide} from "vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import DashboardLayout from "@/Layouts/DashboardLayout.vue";
import PatientTableDetails from "@/Components/PatientTableDetails.vue";

const props = defineProps(['patient']);
const title = ref("Ver Paciente");
provide("title", title);

</script>

<template>
    <DashboardLayout>
      <div class="md:col-span-4 mt-1">
        <h2 class="text-2xl md:text-3xl text-slate-800 font-bold">Información de Paciente</h2>
        <hr class="my-6" />
        <div class="mt-4 bg-slate-50 shadow-lg rounded-sm border border-slate-200 relative px-4 py-4 content-table-details">

           <patient-table-details :patient="patient" />
            <div class="btn-opt mt-8">
              <Link
                class="btn-primary btn-black"
                :href="route('pacientes.index')"
              >
                Volver</Link
              >
            </div>

        </div>
      </div>
    </DashboardLayout>
</template>

