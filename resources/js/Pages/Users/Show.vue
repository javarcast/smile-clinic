<script setup>

import { Head, Link } from "@inertiajs/inertia-vue3";
import UserTableDetails from "@/Components/UserTableDetails.vue";
import DashboardLayout from "@/Layouts/DashboardLayout.vue";

const props = defineProps(['UserShow']);

</script>

<template>
    <DashboardLayout>
      <div class="md:col-span-4 mt-1">
        <h2 class="text-2xl md:text-3xl text-slate-800 font-bold">Información de Usuario</h2>
        <hr class="my-6" />
        <div class="mt-4 bg-slate-50 shadow-lg rounded-sm border border-slate-200 relative px-4 py-4 content-table-details">
          
            <user-table-details :UserShow="UserShow" />
            <div class="btn-opt mt-8">
              <Link
                class="btn-primary btn-black"
                :href="route('usuarios.index')"
              >
                Volver</Link
              >
            </div>
          
        </div>
      </div>
    </DashboardLayout>
</template>

