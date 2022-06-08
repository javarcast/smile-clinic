<template>
  <table>

    <tbody>
        <tr>
            <th class="border px-4 py-2"> ID</th>
            <td class="border px-4 py-2">{{ treatment.id }}</td>
        </tr>
        <tr>
            <th class="border px-4 py-2"> Nombre</th>
            <td class="border px-4 py-2">{{ treatment.name }}</td>
        </tr>
        <tr>
            <th class="border px-4 py-2"> Descripcion</th>
            <td class="border px-4 py-2">{{ treatment.description }}</td>
        </tr>
        
        <tr>
            <th class="border px-4 py-2"> Precio</th>
            <td class="border px-4 py-2">{{ treatment.price }}</td>
        </tr>
    </tbody>
  </table>
</template>
<script>
import { defineComponent } from "vue";
export default defineComponent({
  props: {
    treatment: Object,
  },
});
</script>
