<script setup>
import { ref, provide, watch } from "vue";
import DashboardLayout from "@/Layouts/DashboardLayout.vue";
import { Link } from "@inertiajs/inertia-vue3";

const title = ref("Pacientes");
provide("title", title);

const props = defineProps(["pacientes"]);
const q = "";
watch(q, () => {
  this.$inertia.replace(this.route("pacientes.index", { q: value }));
});
</script>

<template>
  <DashboardLayout>
    <div class="md:col-span-4 mt-1">
      <div class="flex justify-between">
        <h2 class="text-2xl md:text-3xl text-slate-800 font-bold">Usuarios</h2>
        <div class="flex">
          <input
            type="text"
            class="form-input rounded mr-2"
            placeholder="Buscar..."
            v-model="q"
          />

          <Link
            :href="route('pacientes.create')"
            class="btn-primary btn-black"
            >
              <i class="far fa-user mr-2"></i> Crear Usuario
            </Link>
        </div>
      </div>
      
      <div>
        <hr class="my-6" />
        <div class="flex flex-col justify-center mt-4">
         <span>aqui va la tabla de pacientes</span>
        </div>
      </div>
    </div>
  </DashboardLayout>
</template>
