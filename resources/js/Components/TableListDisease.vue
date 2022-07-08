<template>
  <div v-if="diseases.length > 0">
    <table v-if="getDiseases(diseases)" class="bg-white shadow-lg rounded-sm border border-slate-200 relative w-56">
      <thead class="text-xs font-semibold uppercase text-slate-500 bg-slate-50 border-t border-b border-slate-200">
        <tr>
          <th class="border hidden md-table-cell px-4 py-2">Enfermedades</th>
        </tr>
      </thead>
      <tbody>

        <tr v-for="(disease) in diseases" :key="disease.enfermedad">
          <td v-if="disease.tipoEnfer == 2" class="border hidden md-table-cell px-4 py-2 text-center">
            {{ disease.enfermedad }}
          </td>
        </tr>
      </tbody>
    </table>
  </div>

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
    diseases: Object
  },
  methods: {
    getDiseases(aux) {

      var bandera = false;

      for (let index = 0; index < aux.length; index++) {
        if (aux[index]['tipoEnfer'] == 2) {
          bandera = true;
          break;
        }
      }
      return bandera;
    }
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
