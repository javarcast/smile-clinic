<template>
  <table>
    <thead>
        <tr >
            <th class="border px-4 py-2" >Nombre</th>
            <th class="border hidden md-table-cell  px-4 py-2">Email</th>
            <th class="border hidden md-table-cell px-4 py-2">Nro. Telefonico</th>
            <th class="border px-4 py-2" colspan="3"> Acciones</th>
        </tr>
    </thead>
    <tbody>

    <tr v-for="user in props.users" :key="user.id">
      <td class="border px-4 py-2">
        {{ user.name }}
      </td>
      <td class="border hidden md-table-cell px-4 py-2">
        {{ user.email }}
      </td>
      <td class="px-4  hidden md-table-cell border py-2">
        {{ user.phone_number }}
      </td>
      <td class="px-4 py-2 border">
        <Link :href="route('usuarios.show', user.id)"> <i class="far fa-eye text-green-600"></i> </Link>
      </td>
      <td class="px-4 py-2 border">
        <Link :href="route('usuarios.edit', user.id)"> <i class="fas fa-edit text-blue-600"></i> </Link>
      </td>
      <td class="px-4 py-2 border">
        <a href="#" @click.prevent="destroy(user.id)"> <i class="fas fa-trash-alt text-red-600"></i></a>
      </td>
    </tr>
    </tbody>
  </table>
</template>

<script setup>
import { defineProps } from "vue";
import { Head, Link } from "@inertiajs/inertia-vue3";

  
const props = defineProps(['users'])

const destroy = (id) => {
  if(confirm('¿Desea Eliminar?')){
    this.$inertia.delete(this.route('usuarios.destroy',id));
  }
}

</script>

<style scoped>
  @media (min-width: 768px) {
    .md-table-cell{
      display: table-cell;
    }
  }
</style>