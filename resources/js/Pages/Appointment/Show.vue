<template>
    <DashboardLayout>
        <div class="md:col-span-4 mt-1">
            <div class="shadow bg-white md:rounded-md p-4">
                <h2 class="text-2xl md:text-3xl text-slate-800 font-bold">Información de Cita</h2>
                <hr class="my-6" />
                <div class="flex flex-col justify-center">
                    <table-details-appointment :appointment="appointment" :appTrea="appTrea" />
                    <div class="flex justify-center">
                        <Link class="
                  bg-gray-200
                  w-1/12
                  hover:bg-blue-700 hover:text-white
                  rounded-md
                  text-black
                  mt-2
                  py-2
                  px-4
                " :href="route('citas.index')">
                        Volver</Link>
                    </div>
                </div>
            </div>
        </div>
    </DashboardLayout>
</template>

<script>
import { defineComponent } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import TableDetailsAppointment from "@/Components/TableDetailsAppointment.vue";
import DashboardLayout from "@/Layouts/DashboardLayout.vue";
export default defineComponent({
    components: {
        AppLayout,
        Head,
        TableDetailsAppointment,
        Link,
        DashboardLayout,
    },
    props: {
        appointment: Object,
        appTrea: Array,
    },
});
</script>