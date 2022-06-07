<template>
    <dashboard-layout>
        {{$treatments}}
      <div class="md:col-span-4 mt-1">
        <div class="shadow bg-white md:rounded-md p-4">
          <div class="flex justify-between treatment-options">
            <input
              type="text"
              class="form-input rounded-md shadow-sm"
              placeholder="Buscar..."
              v-model="q"
            />

            <Link v-if="$page.props.user.rol_id===1"
              :href="route('tratamientos.create')"
              class="bg-blue-500 text-white font-bold p-2 mx-4 rounded"
              ><i class="far fa-user"></i> Crear Tratamiento</Link
            >
          </div>

          <hr class="my-6" />
          <div class="flex flex-col justify-center treatment-table-container">
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
