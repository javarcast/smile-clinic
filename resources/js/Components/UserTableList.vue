<template>
  <table class="bg-white shadow-lg rounded-sm border border-slate-200 relative">
    <thead class="text-xs font-semibold uppercase text-slate-500 bg-slate-50 border-t border-b border-slate-200">
        <tr >
            <th class="px-2 first:pl-5 last:pr-5 py-4 whitespace-nowrap text-left font-semibold" >Nombre</th>
            <th class="px-2 first:pl-5 last:pr-5 py-4 whitespace-nowrap text-left font-semibold">Email</th>
            <th class="px-2 first:pl-5 last:pr-5 py-4 whitespace-nowrap text-left font-semibold">Nro. Telefonico</th>
            <th class="px-2 first:pl-5 last:pr-5 py-4 whitespace-nowrap text-center font-semibold" colspan="3"> Acciones</th>
        </tr>
    </thead>
    <tbody>

    <tr v-for="user in props.users" :key="user.id" class="border-t border-b border-slate-200">
      <td class="px-2 first:pl-5 last:pr-5 py-4 whitespace-nowrap text-left">
        {{ user.name }}
      </td>
      <td class="px-2 first:pl-5 last:pr-5 py-4 whitespace-nowrap text-left">
        {{ user.email }}
      </td>
      <td class="px-2 first:pl-5 last:pr-5 py-4 whitespace-nowrap text-left">
        {{ user.phone_number }}
      </td>
      <td class="px-2 first:pl-5 last:pr-5 py-4 whitespace-nowrap text-center">
        <Link :href="route('usuarios.show', user.id)"> <i class="far fa-eye text-green-600"></i> </Link>
      </td>
      <td class="px-2 first:pl-5 last:pr-5 py-4 whitespace-nowrap text-center">
        <Link :href="route('usuarios.edit', user.id)"> <i class="fas fa-edit text-blue-600"></i> </Link>
      </td>
      <td class="px-2 first:pl-5 last:pr-5 py-4 whitespace-nowrap text-center">
        <a href="#" @click.prevent="destroy(user.id)"> <i class="fas fa-trash-alt text-red-600"></i></a>
      </td>
    </tr>
    </tbody>
  </table>
</template>

<script setup>
import { defineProps } from "vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import { Inertia} from "@inertiajs/inertia";

  
const props = defineProps(['users'])

const destroy = (id) => {
  if(confirm('¿Desea Eliminar?')){
    Inertia.delete(route('usuarios.destroy',id));
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