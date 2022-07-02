<template>    
    <dashboard-layout>
        <div class="main__cards m-3 p-3">
            <div class="card flex flex-col justify-around">
                <i class="far fa-user fa-2x text-lightblue" aria-hidden="true"></i>
                <div class="card_inner">
                    <p class="text-primary-p">Número de Pacientes</p>
                    <span class="font-bold text-title">XXX</span>
                </div>
            </div>
            <div class="card flex flex-col justify-around">
                <i class="far fa-calendar-alt fa-2x text-red" aria-hidden="true"></i>
                <div class="card_inner">
                    <p class="text-primary-p nCita">Número de Citas Registradas</p>
                    <span class="font-bold text-title">XXXX</span>
                </div>
            </div>
            <div class="card flex flex-col justify-around">
                <i class="fas fa-user-md fa-2x text-green-600" aria-hidden="true"></i>
                <div class="card_inner">
                    <p class="text-primary-p">Número de Odontólogos</p>
                    <span class="font-bold text-title">XXXX</span>
                </div>
            </div>
        </div>
        <div class="flex flex-wrap justify-end items-center mb-4">
            <div class="grid mr-2  ">
              <span class="text-xs text-gray-400"> Fecha Inicio</span>
              <input
                :max="dateEnd"
                type="date"
                class="form-input rounded-md shadow-sm"
                v-model="dateStart"
              />
            </div>
            <div class="grid ">
              <span class="text-xs text-gray-400"> Fecha Fin</span>
              <input
                :max="dateEnd"
                type="date"
                class="form-input rounded-md shadow-sm"
                v-model="dateEnd"
              />
              
            </div>
            <button @click="searchDate" class="bg-blue-500
                hover:bg-blue-700
                md:h-1/2
                rounded-md
                text-white
                font-bold
                ml-2
                py-2
                mr-4
                mt-4
                px-4"><i class="fas fa-search"></i></button>
        </div>
        <div class="charts p-3">
            <div class="charts__right__title flex items-center justify-between">
                <div>
                    <h2 class="text-2xl md:text-3xl text-slate-800 font-bold">Tratamientos mas solicitados</h2>
                    <apexchart
                    title="Tratamientos más solicitados"
                    width="600"
                    type="bar"
                    :options="chartOptions"
                    :series="series"
                    ></apexchart>
                </div>
            </div>
           
           
            <div class="charts__right__title flex items-center justify-between">
                <div>
                    <h2 class="text-2xl md:text-3xl text-slate-800 font-bold">Citas por dia</h2>
                    <apexchart
                    title="Citas por día"
                    width="600"
                    type="area"
                    :options="areaOptions"
                    :series="areaSeries"
                    ></apexchart>
                </div>
            </div>
        </div>
    </dashboard-layout>
</template>

<script>
import { defineComponent } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import DashboardLayout from "@/Layouts/DashboardLayout.vue";
import VueApexCharts from "vue3-apexcharts";

export default defineComponent({
  components: {
    AppLayout,
    Head,
    Link,
    DashboardLayout,
    apexchart: VueApexCharts,
  },
  props: {
    
  },
  watch: {
    q: function (value) {
      
    },
  },
  data: function() {
    return {
      chartOptions: {
        chart: {
          id: "vuechart-example",
        },
        xaxis: {
          categories: [1991, 1992, 1993, 1994, 1995, 1996, 1997, 1998],
        },
      },
      series: [
        {
          name: "series-1",
          data: [30, 40, 35, 50, 49, 60, 70, 91],
        },
      ],
      areaOptions: {
        chart: {
          id: "vuechart-example",
        },
        xaxis: {
          categories: [1991, 1992, 1993, 1994, 1995, 1996, 1997, 1998],
        },
      },
      areaSeries: [
        {
          name: "series-1",
          data: [30, 40, 35, 50, 49, 60, 70, 91],
        },
      ],
      
    };
  },
});
</script>