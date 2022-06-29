<template>
  <table v-if="medicaments.length >0" class="bg-white shadow-lg rounded-sm border border-slate-200 relative w-56">
    <thead class="text-xs font-semibold uppercase text-slate-500 bg-slate-50 border-t border-b border-slate-200">
      <tr>
        <th class="border hidden md-table-cell px-4 py-2">Medicamentos</th>
      </tr>
    </thead>
    <tbody>

      <tr v-for="(medicament) in medicaments" :key="medicament.name">
        <td class="border hidden md-table-cell px-4 py-2 text-center">
          {{ medicament.name }}
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
    medicaments: Object
  },
  methods: {
    
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
