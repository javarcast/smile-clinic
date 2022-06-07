<script setup>
import { ref, provide, watch } from "vue";
import DashboardLayout from "@/Layouts/DashboardLayout.vue";
import { Link } from "@inertiajs/inertia-vue3";
import TableList from "@/Components/TableList.vue";

const title = ref("Usuarios");
provide("title", title);

const props = defineProps(["users"]);
const q = "";
watch(q, () => {
  this.$inertia.replace(this.route("usuarios.index", { q: value }));
});
</script>

<template>
  <DashboardLayout>
    <div class="md:col-span-4 mt-1">
      <div class="shadow bg-white md:rounded-md p-4">
        <div class="flex justify-between">
          <input
            type="text"
            class="form-input rounded-md shadow-sm"
            placeholder="Buscar..."
            v-model="q"
          />

          <Link
            :href="route('usuarios.create')"
            class="bg-blue-500 text-white font-bold p-2 mx-4 rounded"
            ><i class="far fa-user"></i> Crear Usuario</Link
          >
        </div>

        <hr class="my-6" />
        <div class="flex flex-col justify-center">
          <table-list :users="users" />
        </div>
      </div>
    </div>
  </DashboardLayout>
</template>
