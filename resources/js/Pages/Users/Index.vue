<script setup>
import { ref, provide, watch } from "vue";
import DashboardLayout from "@/Layouts/DashboardLayout.vue";
import { Link } from "@inertiajs/inertia-vue3";
import { Inertia } from '@inertiajs/inertia';
import UserTableList from "@/Components/UserTableList.vue";

const title = ref("Usuarios");
provide("title", title);

const props = defineProps(["users" , "message" ]);
const q = ref('');
watch(q, () => {
  Inertia.replace(route("usuarios.index", { q: q.value }));
});
</script>

<template>
  <DashboardLayout>
    <div class="md:col-span-4 mt-1">
      <div class="flex justify-between col-mobile">
        <h2 class="text-2xl md:text-3xl text-slate-800 font-bold">Usuarios</h2>
        <h3 class="text-1xl md:text-1xl text-slate-800 font-bold">{{ message }}</h3>
        <div class="flex">
          <input type="text" class="form-input rounded mr-2" placeholder="Buscar..." v-model="q" />

          <Link :href="route('usuarios.create')" class="btn-primary btn-black">
          <i class="far fa-user mr-2"></i> Crear Usuario
          </Link>
        </div>
      </div>

      <div>
        <hr class="my-6" />
        <div class="flex flex-col justify-center mt-4 table-col">
          <user-table-list :users="users" />
        </div>
      </div>
    </div>
  </DashboardLayout>
</template>
