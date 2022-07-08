<template>
  <table class="bg-white shadow-lg rounded-sm border border-slate-200 relative w-full">
    <thead class="text-xs font-semibold uppercase text-slate-500 bg-slate-50 border-t border-b border-slate-200">
        <tr >
            <th class="px-2 w-1/5 first:pl-5 last:pr-5 py-4  text-left font-semibold">Nombre del Paciente</th>
            <th class="px-2 w-2/5 first:pl-5 last:pr-5 py-4  text-left font-semibold">Descripción</th>
            <th class="px-2 w-1/5 first:pl-5 last:pr-5 py-4  text-left font-semibold">Estatus</th>
            <th class="px-2 w-1/5 first:pl-5 last:pr-5 py-4  text-center font-semibold" colspan="3"> Acciones</th>
        </tr>
    </thead>
    <tbody>

    <tr v-for="request in props.requests" :key="request.id" class="border-t border-b border-slate-200">
      <td class="px-2 first:pl-5 last:pr-5 py-4 text-left w-1/5">
        {{ request.user.name }}
      </td>
      <td class="px-2 first:pl-5 last:pr-5 py-4  text-left w-2/5">
        {{ request.description }}
      </td>
      <td class="px-2 first:pl-5 last:pr-5 py-4  text-left w-1/5">
        
        {{ request.status ? 'Completada' : 'Pendiente'}} 
      </td>
      <td class="px-2 first:pl-5 last:pr-5 py-4  text-center">
        <Link :href="route('solicitudes.show', request.id)"><i class="far fa-eye text-green-600"></i> </Link>
      </td>
      <td class="px-2 first:pl-5 last:pr-5 py-4  text-center">
        <Link :href="route('solicitudes.edit',  request.id)"> <i class="fas fa-edit text-blue-600"></i> </Link>
      </td>
    </tr>
    </tbody>
  </table>
</template>

<script setup>
import { defineProps } from "vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import { Inertia} from "@inertiajs/inertia";


const props = defineProps(['requests'])


</script>


