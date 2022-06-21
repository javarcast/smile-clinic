<script setup>

  const props = defineProps(["patient"]);

</script>
<template>
  <table class="w-full table-details" >
    <tbody>
        <tr class="container-table">
            <th class="border px-4 py-2"> Nombre</th>
            <td class="border px-4 py-2">{{ patient.name }}</td>
        </tr>
        <tr class="container-table">
            <th class="border px-4 py-2"> Nro. Telefonico</th>
            <td class="border px-4 py-2">{{ patient.phone_number }}</td>
        </tr>
        <tr class="container-table">
            <th class="border px-4 py-2"> DNI</th>
            <td class="border px-4 py-2">{{ patient.dni }}</td>
        </tr>
        <tr v-if="patient.email"  class="container-table">
          <th class="border px-4 py-2"> Email</th>
          <td class="border px-4 py-2">{{ patient.email}}</td>
        </tr>
        <tr class="container-table">
          <th class="border px-4 py-2"> user</th>
          <td class="border px-4 py-2">{{ patient.user }}</td>
        </tr>
    </tbody>
  </table>
</template>


