<template>
  <table class="bg-white shadow-lg rounded-sm border border-slate-200 relative">
    <thead class="text-xs font-semibold uppercase text-slate-500 bg-slate-50 border-t border-b border-slate-200">
        <tr >
            <th class="px-2 first:pl-5 last:pr-5 py-4 whitespace-nowrap text-left font-semibold">DNI</th>
            <th class="px-2 first:pl-5 last:pr-5 py-4 whitespace-nowrap text-left font-semibold" >Nombre</th>
            <th class="px-2 first:pl-5 last:pr-5 py-4 whitespace-nowrap text-left font-semibold">Email</th>
            <th class="px-2 first:pl-5 last:pr-5 py-4 whitespace-nowrap text-center font-semibold" colspan="3"> Acciones</th>
        </tr>
    </thead>
    <tbody>

    <tr v-for="patient in props.patients" :key="patient.id" class="border-t border-b border-slate-200">
      <td class="px-2 first:pl-5 last:pr-5 py-4 whitespace-nowrap text-left">
        {{ patient.id }}
      </td>
      <td class="px-2 first:pl-5 last:pr-5 py-4 whitespace-nowrap text-left">
        {{ patient.name }}
      </td>
      <td class="px-2 first:pl-5 last:pr-5 py-4 whitespace-nowrap text-left">
        {{ patient.email }}
      </td>
      <td class="px-2 first:pl-5 last:pr-5 py-4 whitespace-nowrap text-center">
        <Link :href="route('pacientes.show', patient.id)"> <i class="far fa-eye text-green-600"></i> </Link>
      </td>
      <td class="px-2 first:pl-5 last:pr-5 py-4 whitespace-nowrap text-center">
        <Link :href="route('pacientes.edit', patient.id)"> <i class="fas fa-edit text-blue-600"></i> </Link>
      </td>
      <td class="px-2 first:pl-5 last:pr-5 py-4 whitespace-nowrap text-center">
        <a href="#" @click.prevent="destroy(patient.id)"> <i class="fas fa-trash-alt text-red-600"></i></a>
      </td>
    </tr>
    </tbody>
  </table>
</template>

<script setup>
import { defineProps } from "vue";
import { Link } from "@inertiajs/inertia-vue3";
import { Inertia } from '@inertiajs/inertia';

const props = defineProps(['patients']);

const destroy = (id) => {
    console.log(id);
  if(confirm('¿Desea Eliminar?')){
    Inertia.delete(route('pacientes.destroy', id));
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
