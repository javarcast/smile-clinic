<template>
  <table class="bg-white shadow-lg rounded-sm border border-slate-200 relative">
    <thead class="text-xs font-semibold uppercase text-slate-500 bg-slate-50 border-t border-b border-slate-200">
      <tr>
        <th class="border hidden md-table-cell px-4 py-2">ID</th>
        <th class="border px-4 py-2">DNI</th>
        <th class="border px-4 py-2">Paciente</th>
        <th class="border hidden md-table-cell px-4 py-2">Fecha</th>
        <th class="border px-4 py-2" colspan="3"> Acciones</th>
      </tr>
    </thead>
    <tbody>

      <tr v-for="(history) in histories" :key="history.id">
        <td class="border hidden md-table-cell px-4 py-2 text-center">
          {{ history.id }}
        </td>
        <td class="border px-4 py-2 text-center">
          {{ history.pacienteID}}
        </td>
        <td class="border px-4 py-2 text-center">
          {{ history.paciente}}
        </td>
        <td class="px-4  hidden md-table-cell border py-2 text-center">
            {{ history.fecha}}
        </td>
        <td class="px-4 py-2 border text-center">
          <Link :href="route('historial.show', history.id)"><i class="far fa-eye text-green-600"></i> </Link>
        </td>
        <td v-if="$page.props.user.role_id===1" class="px-4 py-2 border">
          <Link  :href="route('historial.edit', history.id)"><i class="fas fa-edit text-blue-600"></i> </Link>
        </td>
        <td v-if="$page.props.user.role_id===1" class="px-4 py-2 border">
          <a  href="#" @click.prevent="destroy(history.id)"><i class="fas fa-trash-alt text-red-600"></i></a>
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
    histories: Object
  },
  methods: {
    // formatCurrency(price) {
    //     return new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD', currencyDisplay: 'narrowSymbol'}).format(price);
    // }
    destroy(id){
      if (confirm("¿Desea Eliminar?")) {
        this.$inertia.delete(this.route("historial.destroy", id));
      }
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
