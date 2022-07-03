<script setup>

  const props = defineProps(["UserShow"]);
  
</script>
<template>
  <table class="w-full table-details" >
    <tbody>
        <tr class="container-table">
            <th class="border px-4 py-2"> Nombre</th>
            <td class="border px-4 py-2">{{ UserShow.name }}</td>
        </tr>
        <tr class="container-table">
            <th class="border px-4 py-2"> Nro. Telefonico</th>
            <td class="border px-4 py-2">{{ UserShow.phone_number }}</td>
        </tr>
        <tr class="container-table">
            <th class="border px-4 py-2"> DNI</th>
            <td class="border px-4 py-2">{{ UserShow.id }}</td>
        </tr>
        <tr class="container-table">
            <th class="border px-4 py-2"> Dirección</th>
            <td class="border px-4 py-2">{{ UserShow.address }}</td>
        </tr>
        <tr v-if="UserShow.email"  class="container-table">
          <th class="border px-4 py-2"> Email</th>
          <td class="border px-4 py-2">{{ UserShow.email}}</td>
        </tr>
        <tr class="container-table">
          <th class="border px-4 py-2"> Rol</th>
          <td class="border px-4 py-2">{{ UserShow.role.name }}</td>
        </tr>
    </tbody>
  </table>
</template>


