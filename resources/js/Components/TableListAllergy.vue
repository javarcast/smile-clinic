<template>
  <div v-if="allergies.length > 0">
    <table v-if="getAllergies(allergies)" class="bg-white shadow-lg rounded-sm border border-slate-200 relative w-56">
      <thead class="text-xs font-semibold uppercase text-slate-500 bg-slate-50 border-t border-b border-slate-200">
        <tr>
          <th class="border hidden md-table-cell px-4 py-2">Alergias</th>
        </tr>
      </thead>
      <tbody>

        <tr v-for="(allergy) in allergies" :key="allergy.enfermedad">
          <td v-if="allergy.tipoEnfer == 1" class="border hidden md-table-cell px-4 py-2 text-center">
            {{ allergy.enfermedad }}
          </td>
        </tr>
        <tr v-if="!allergies">No posee Alergias</tr>
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
    allergies: Object
  },
  methods: {
    getAllergies(aux) {

      var bandera = false;

      for (let index = 0; index < aux.length; index++) {
        if (aux[index]['tipoEnfer'] == 1) {
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
