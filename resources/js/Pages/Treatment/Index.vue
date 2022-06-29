<template>
  <dashboard-layout>
    <div class="md:col-span-4 mt-1">
        <div class="flex justify-between treatment-options">
          <h2 class="text-2xl md:text-3xl text-slate-800 font-bold">Tratamientos</h2>
          <div class="flex">
            <input type="text" class="form-input rounded mr-2" placeholder="Buscar..." v-model="q" />
            <Link :href="route('tratamientos.create')" class="btn-primary btn-black"><i class="fa-solid fa-plus"></i>
            Crear Tratamiento</Link>
          </div>

        </div>
        <div>
          <hr class="my-6" />
          <div class="flex flex-col justify-center mt-4">
            <table-list-treatment :treatments="treatments.data" />
          </div>
        </div>
    </div>
  </dashboard-layout>
</template>

<script>
import { defineComponent } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import TableListTreatment from "@/Components/TableListTreatment.vue";
import DashboardLayout from "@/Layouts/DashboardLayout.vue";

export default defineComponent({
  components: {
    AppLayout,
    Head,
    Link,
    TableListTreatment,
    DashboardLayout,
  },
  props: {
    treatments: Array,
  },
  watch: {
    q: function (value) {
      this.$inertia.replace(this.route("tratamientos.index", { q: value }));
    },
  },
  data() {
    return {
      q: "",
    };
  },
});
</script>
