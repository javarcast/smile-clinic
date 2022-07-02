<script setup>
  import { ref, provide} from "vue";
  import { Head, Link } from "@inertiajs/inertia-vue3";
  import AppointmentRequestTableDetails from "@/Components/AppointmentRequestTableDetails.vue";
  import DashboardLayout from "@/Layouts/DashboardLayout.vue";

  const props = defineProps(['appointment_request']);
  const title = ref("Ver Solicitud");
  provide("title", title);


</script>
<template>
    <DashboardLayout>
      <div class="md:col-span-4 mt-1">
        <h2 class="text-2xl md:text-3xl text-slate-800 font-bold">Información de la Solicitud</h2>
        <hr class="my-6" />
        <div class="mt-4 bg-slate-50 shadow-lg rounded-sm border border-slate-200 relative px-4 py-4 content-table-details">
          
            <appointment-request-table-details :appointment_request="appointment_request" />
            <div class="btn-opt mt-8">
              <Link
                class="btn-primary btn-black"
                :href="route('solicitudes.index')"
              >
                Volver</Link
              >
            </div>
          
        </div>
      </div>
    </DashboardLayout>
</template>




