<template>
    <table class="bg-white shadow-lg rounded-sm border border-slate-200 relative">
        <thead class="text-xs font-semibold uppercase text-slate-500 bg-slate-50 border-t border-b border-slate-200">
            <tr>
                <th class="border hidden md-table-cell px-4 py-2">Fecha</th>
                <th class="border hidden md-table-cell px-4 py-2">Radiografías</th>
                <th class="border hidden md-table-cell px-4 py-2">Tipo</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(radiograph) in radiographs" :key="radiograph.radio">
                <td class="border hidden md-table-cell px-4 py-2 text-center">
                    {{ radiograph.fecha }}
                </td>
                <td class="border hidden md-table-cell px-4 py-2 text-center flex flex-row">
                    <img v-bind:src="radiograph.url" v-bind:alt="radiograph.name" class="w-28 my-0 mx-auto">
                    <a v-bind:href="radiograph.url" target="_blank" class="btn-primary inline-block mt-1"><i
                            class="far fa-eye text-green-600"></i></a>
                </td>
                <td class="border hidden md-table-cell px-4 py-2 text-center">
                    {{ radiograph.type }}
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
        radiographs: Object
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
