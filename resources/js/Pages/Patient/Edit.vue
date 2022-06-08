<script setup>

import { Link, useForm } from "@inertiajs/inertia-vue3";
import { ref, provide} from "vue";
import DashboardLayout from "@/Layouts/DashboardLayout.vue";
    
    const title = ref("Editar Paciente");
    provide("title", title);

   

</script>

<template>
    <DashboardLayout>
      <div class="md:col-span-4 mt-1">
        <h2 class="text-2xl md:text-3xl text-slate-800 font-bold">Editar Usuario</h2>
        <hr class="my-6" />
        <div class="mt-4 bg-slate-50 shadow-lg rounded-sm border border-slate-200 relative px-4 py-4">
          <form @submit.prevent="submit" class="create-user">
              <span>aqui va los campos del formulario editar paciente</span>
            <!-- <div class="container-input">
              <label class="block font-medium text-sm text-gray-700"
                >Nombre</label
              >
              <input
                type="text"
                v-model="form.name"
                required
                class="form-input w-full rounded bg-slate-50"
              />
            </div> -->
        
           
            
            <div class="btn-opt">
              <button class="btn-primary btn-black mr-2">
                Actualizar
              </button>
              <Link
                class="btn-primary btn-white shadow-lg ml-2"
                :href="route('pacientes.index')"
              >
                Cancelar</Link
              >
            </div>
          </form>
        </div>
      </div>
    </DashboardLayout>  

</template>

