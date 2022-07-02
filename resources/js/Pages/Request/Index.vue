<template>
  <DashboardLayout>
    <div class="md:col-span-4 mt-1">
      <h2 class="text-2xl md:text-3xl text-slate-800 font-bold">
        Solicitudes de Citas Médicas
      </h2>
      <hr class="my-6" />
      <div
        class="flex justify-center table-col"
      >
      <appointment-request-table-list :requests="requests"/>

       
      </div>
    </div>
  </DashboardLayout>
</template>

<script setup>
    import DashboardLayout from "@/Layouts/DashboardLayout.vue";
    import AppointmentRequestTableList from "@/Components/AppointmentRequestTableList.vue";
    import { ref, provide, watch } from "vue";

    const props = defineProps(['requests'])
    const title = ref("Solicitudes");
    provide("title", title);
</script>