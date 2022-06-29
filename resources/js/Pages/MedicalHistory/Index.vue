<script>
import { defineComponent } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import TableListHistory from "@/Components/TableListHistory.vue";
import DashboardLayout from "@/Layouts/DashboardLayout.vue";

export default defineComponent({
  components: {
    AppLayout,
    Head,
    Link,
    TableListHistory,
    DashboardLayout,
  },
  props: {
    histories: Array,
  },
  watch: {
    q: function (value) {
      this.$inertia.replace(this.route("historial.index", { q: value }));
    },
  },
  data() {
    return {
      q: "",
    };
  },
});
</script>

<template>
  <DashboardLayout>
    <div class="md:col-span-4 mt-1">
        <div class="flex justify-between treatment-options">
          <h2 class="text-2xl md:text-3xl text-slate-800 font-bold">Historial</h2>
          <div class="flex">
            <input type="text" class="form-input rounded mr-2" placeholder="Buscar..." v-model="q" />
            <Link :href="route('historial.create')" class="btn-primary btn-black"><i class="fa-solid fa-plus"></i>
            Crear Historial</Link>
          </div>

        </div>
        <div>
          <hr class="my-6" />
          <div class="flex flex-col justify-center mt-4">
            <table-list-history :histories="histories.data" />
          </div>
        </div>
    </div>
  </DashboardLayout>
</template>


