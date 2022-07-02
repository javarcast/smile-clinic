<template>
  <div class="charts__right">
    <div class="charts__right__title flex items-center justify-between">
      <div>
        <h1>{{title}}</h1>
        <p>{{subtitle}}</p>
      </div>
    </div>
    <apexchart :type="typecharts" :options="options" :series="series"></apexchart>
  </div>
</template>

<script>
import { defineComponent } from "vue";
import VueApexCharts from "vue3-apexcharts";

export default defineComponent({
  components: {
    VueApexCharts,
  },
  props: {
    names: Array,
    values: Array,
    title: String,
    subtitle: String,
    typecharts: String,
  },
  data: function() {
    return {
      chartOptions: {
        chart: {
          id: "citasdia",
        },
        xaxis: {
          categories: [1991, 1992, 1993, 1994, 1995, 1996, 1997, 1998],
        },
        stroke: {
          curve: "smooth",
        },
      },
      series: [
        {
          name: "Citas por dia",
          data: [30, 40, 35, 50, 49, 60, 70, 91],
        },
      ],
    };
  },
});
</script>
