<template>
    <DashboardLayout>
        <div class="md:col-span-4 mt-1">
            <h2 class="text-2xl md:text-3xl text-slate-800 font-bold title-cal">Calculadora</h2>
            <div class="flex justify-between calculator">
                <div class="w-1/3 pr-4 calculator-col">
                    <div class="flex justify-between">
                      <h3 class="text-2xl md:text-xl text-slate-800 font-bold  mb-4">Tratamientos</h3>
                      <!-- <input
                        type="text"
                        class="form-input rounded w-1/3 h-8"
                        placeholder="Buscar..."
                        v-model="q"
                      /> -->
                    </div>
                    
                    <div class="list-treatment">
                        <div v-for="treatment in treatments" :key="treatment.id" class="item-trearment  mb-4" >
                            <label  class="flex items-center w-full p-3 bg-gray-50 cursor-pointer">
                                <input @click="getEmitClick(treatment.id)"  class="text-blue-900 w-6 h-6 mr-2 focus:ring-grenn-300 focus:ring-opacity-25 border border-gray-300 rounded" type="checkbox" />
                                <span class="w-2/3 mr-4">{{treatment.name}}</span>
                                <!-- <div class="w-1/3">
                                    <input v-model="count" min="1" class="border border-gray-300 w-20 rounded" type="number" name="count">
                                </div> -->
                            </label>
                        </div>

                    </div>
                </div>
                <div class="w-2/3 pl-4 calculator-col ">
                    <h3 class="text-2xl md:text-xl text-slate-800 font-bold text-left  mb-4">Presupuesto</h3>
                     <div class="table-col">
                      <facture-table  :treatmentsSelected="getTreatments"></facture-table>
                    </div>
                </div>
            </div>
        </div>
    </DashboardLayout>
</template>

<script setup>
    import { defineComponent, ref, computed } from "vue";
    import DashboardLayout from "@/Layouts/DashboardLayout.vue";
    import FactureTable from '@/Components/FactureTable.vue';
    import { Inertia } from '@inertiajs/inertia';

    const props = defineProps(["treatments"]);
    const treatmentsSelected = ref([]);
    const total = 0;

    const getEmitClick = (data) =>{
 
      if(treatmentsSelected.value.find(treatment => treatment.id == data)){

          treatmentsSelected.value = treatmentsSelected.value.filter(
            treatment => treatment.id !==data
          );
      }else{

        const treatmentSelected = props.treatments.find( treatment => treatment.id == data );
        treatmentSelected.count = 1;
        treatmentsSelected.value.push(treatmentSelected);

      }
    };

    const getTreatments = computed(() => {
      return treatmentsSelected.value;
      
    });

    const totalAmount = computed( () => {
    
      return parseInt(0);
    });

    
</script>