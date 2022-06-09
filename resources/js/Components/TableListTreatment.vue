<template>
  <table>
    <thead>
      <tr>
        <th class="border hidden md-table-cell px-4 py-2">ID</th>
        <th class="border px-4 py-2">Nombre</th>
        <th class="border hidden md-table-cell px-4 py-2">Descripcion</th>
        <th class="border hidden md-table-cell px-4 py-2">Precio</th>
        <th class="border px-4 py-2" colspan="3"> Acciones</th>
      </tr>
    </thead>
    <tbody>

      <tr v-for="(treatment) in treatments" :key="treatment.id">
        <td class="border hidden md-table-cell px-4 py-2 text-center">
          {{ treatment.id }}
        </td>
        <td class="border px-4 py-2">
          {{ treatment.name }}
        </td>
        <td class="px-4  hidden md-table-cell border py-2">
          {{ treatment.description }}
        </td>
        <td class="px-4  hidden md-table-cell border py-2 text-center">
          {{ treatment.price }}
        </td>
        <td class="px-4 py-2 border text-center">
          <Link :href="route('tratamientos.show', treatment.id)"><i class="far fa-eye text-green-600"></i> </Link>
        </td>
        <td  class="px-4 py-2 border">
          <Link :href="route('tratamientos.edit', treatment.id)"><i class="fas fa-edit text-blue-600"></i> </Link>
        </td>
        <td  class="px-4 py-2 border">
          <a href="#" @click.prevent="destroy(treatment.id)"><i class="fas fa-trash-alt text-red-600"></i></a>
        </td>
      </tr>
    </tbody>
  </table>
</template>

<script>
import { defineComponent } from "vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
export default defineComponent({
  components: {
    Head,
    Link,
  },
  props: {
    treatments: Object
  },
  methods: {
    /*destroy(id){
      if(confirm('¿Desea ?')){
        this.$inertia.delete(this.route('tratamiento.destroy',id));
      }
    }*/
  }
});
</script>

<style scoped>
@media (min-width: 768px) {
  .md-table-cell {
    display: table-cell;
  }
}
</style>
