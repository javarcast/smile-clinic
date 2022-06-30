<template>
  <dashboard-layout>
    <div class="md:col-span-4 mt-1">
      <div class="shadow bg-white md:rounded-md p-4">
        <form-errors :errors="errors"></form-errors>
        <form @submit.prevent="submit" class="flex flex-col items-center">
          <label for="name" class="w-3/5 block font-medium text-sm text-gray-700 my-3">Nombre
            <input :class="{ error: isActive, 'text-danger': hasError }" type="text" v-model="form.name" required
              class="form-input w-full rounded-md shadow-sm block" id="name" />
          </label>

          <label for="description" class="w-3/5 block font-medium text-sm text-gray-700 mb-3">Descripción
            <input type="text" v-model="form.description" required class="form-input w-full rounded-md shadow-sm"
              id="description" />
          </label>

          <label for="price" class="w-3/5 block font-medium text-sm text-gray-700 mb-3">Precio
            <input type="number" v-model="form.price" required class="form-input w-full rounded-md shadow-sm" id="price"/>
          </label>

          <div class="btn-opt">
            <button class="btn-primary btn-black mr-2">
              Crear
            </button>
            <Link class="btn-primary btn-white shadow-lg ml-2" :href="route('tratamientos.index')">
            Cancelar</Link>
          </div>
        </form>
      </div>
    </div>
  </dashboard-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link } from "@inertiajs/inertia-vue3";
import FormErrors from "@/Components/FormErrors.vue";
import DashboardLayout from "@/Layouts/DashboardLayout.vue";
export default {
  components: {
    AppLayout,
    Link,
    FormErrors,
    DashboardLayout,
  },
  data() {
    return {
      form: {
        name: "",
        description: "",
        price: ""
      },
    };
  },
  methods: {
    submit() {
      this.$inertia.post(this.route("tratamientos.store"), { ...this.form });
    },
  },
  props: {
    errors: Object,
  },
};
</script>
