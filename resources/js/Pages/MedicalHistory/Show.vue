<template>
    <dashboard-layout>
        <div class="md:col-span-4 mt-1">
            <div class="shadow bg-white md:rounded-md p-4">
                <div class="flex justify-center gap-x-0.5">
                    <table-list-medicament :medicaments="medicaments.data" />
                    <table-list-allergy :allergies="diseases.data" />
                    <table-list-disease :diseases="diseases.data" />
                   
                </div>
                <div class="flex flex-col mt-5">
                     <table-list-radiograph :radiographs="radiographs.data" />
                </div>
                <div class="flex justify-center">
                    <Link class=" my-2 btn-primary btn-black" :href="route('historial.index')">
                    Volver</Link>
                </div>
            </div>
        </div>
    </dashboard-layout>

</template>
<script>
import { defineComponent } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import TableListMedicament from "@/Components/TableListMedicament.vue";
import TableListDisease from "@/Components/TableListDisease.vue";
import TableListAllergy from "@/Components/TableListAllergy.vue";
import TableListRadiograph from "@/Components/TableListRadiograph.vue";
import DashboardLayout from "@/Layouts/DashboardLayout.vue";

export default defineComponent({
    components: {
        AppLayout,
        Head,
        TableListMedicament,
        TableListDisease,
        TableListAllergy,
        TableListRadiograph,
        Link,
        DashboardLayout,
    },
    props: {
        medicaments: Array,
        diseases: Array,
        radiographs: Array,
    },
});
</script>