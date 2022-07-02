<template>
  <table class="w-full table-details" >
    <tbody>
        <tr class="container-table">
            <th class="border px-4 py-2 w-1/3"> Nombre del Paciente</th>
            <td class="border px-4 py-2 w-2/3">{{ appointment_request.user.name }}</td>
        </tr>
        <tr class="container-table">
            <th class="border px-4 py-2 w-1/3"> Descripción</th>
            <td class="border px-4 py-2 w-2/3">{{ appointment_request.description }}</td>
        </tr>
        <tr class="container-table">
            <th class="border px-4 py-2 w-1/3"> Fecha</th>
            <td class="border px-4 py-2 w-2/3">{{ appointment_request.date_appointment }}</td>
        </tr>
        <tr class="container-table">
            <th class="border px-4 py-2 w-1/3"> Estatus</th>
            <td class="border px-4 py-2 w-2/3">{{ appointment_request.status ? 'Procesada' : 'No Procesada' }}</td>
        </tr>
    </tbody>
  </table>
</template>

<script setup>
  import { defineProps } from "vue";
  const props = defineProps(["appointment_request"]);

</script>


