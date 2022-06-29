<template>
          <table class="mt-2 w-11/12 p-5 ml-2 divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th
                  scope="col"
                  class="
                    px-6
                    py-3
                    text-left text-xs
                    font-medium
                    text-gray-500
                    uppercase
                    tracking-wider
                    w-9/12
                  "
                >
                  Tratamiento
                </th>
                <th
                  scope="col"
                  class="
                    px-6
                    py-3
                    text-left text-xs
                    font-medium
                    text-gray-500
                    uppercase
                    tracking-wider
                    w-3/12
                  "
                >
                  Cantidad
                </th>
                <th
                  scope="col"
                  class="
                    px-6
                    py-3
                    text-left text-xs
                    font-medium
                    text-gray-500
                    uppercase
                    tracking-wider
                    w-3/12
                  "
                >
                  Precio
                </th>
                <th
                  scope="col"
                  class="
                    px-6
                    py-3
                    text-left text-xs
                    font-medium
                    text-gray-500
                    uppercase
                    tracking-wider
                    w-3/12
                  "
                >
                  Total
                </th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              
              <tr v-for="treatment in treatmentsSelected" :key="treatment.id">
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="ml-4">
                      <div class="text-sm font-medium text-gray-900">
                        {{treatment.name}}
                      </div>
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <input  v-model="treatment.count" min="1" value="1" class="border border-gray-300 w-20 rounded" type="number" name="count">
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm text-gray-500">${{ treatment.price}}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm text-gray-500"> {{totalTreatments(treatment.count*treatment.price) }}</div>
                </td>
              </tr>
              
            </tbody>
            <tfoot class="bg-gray-50">
                <tr>
                    <td colspan="3" scope="col"
                  class="
                    px-6
                    py-3
                    text-left text-s
                    font-medium
                    text-gray-700
                    uppercase
                    tracking-wider
                  ">Total</td>
                    <td  scope="col"
                  class="
                    px-6
                    py-3
                    text-left text-s
                    font-medium
                    text-gray-700
                    uppercase
                    tracking-wider
                    w-9/12
                  ">${{ totalPre }}</td>
                </tr>
            </tfoot>   
          </table>
</template>

<script setup>
  import { defineComponent,  computed, ref} from "vue";
  const props = defineProps(["treatmentsSelected"]);

  
  const valueCount = ref('');
  let total = 0;
  const totalTreatments = computed ( () => {
    return data => {
      console.log(data);
      return `${data}`;
    }
  });

  const totalPre = computed ( () => {
      total  = 0;
      props.treatmentsSelected.forEach(treatment => {
        total += (parseInt(treatment.price) * parseInt(treatment.count))
      });
  
      return total;

  });
</script>
