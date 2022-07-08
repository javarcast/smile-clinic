<template>
    <DashboardLayout>
        <div class="md:col-span-4 mt-1">
            <div class="flex justify-between">
                <h2 class="text-2xl md:text-3xl text-slate-800 font-bold mb-0.5">Citas</h2>
                <div class="flex justify-evenly gap-x-1">
                    <input v-if="$page.props.user.role_id === 1" type="text" class="form-input rounded-md shadow-sm"
                        placeholder="Buscar ..." v-model="q" />
                    <input v-if="$page.props.user.role_id === 2" type="text" class="form-input rounded-md shadow-sm" placeholder="Buscar Paciente..."
                        v-model="q" />
                         <input v-if="$page.props.user.role_id === 3" type="text" class="form-input rounded-md shadow-sm" placeholder="Buscar Doctor..."
                        v-model="q" />
                    <label class="flex items-center block text-left">
                        <span class="text-gray-700 pr-1">Buscar Fecha</span>
                        <input type="date" class="form-input rounded-md shadow-sm" placeholder="Buscar Fecha"
                            v-model="fecha" />
                    </label>
                    <Link v-if="$page.props.user.role_id === 1" :href="route('citas.create')" class="btn-primary btn-black"><i
                        class="fa-solid fa-plus"></i>
                    Crear Cita</Link>
                    
                </div>
            </div>
            <div>
                <hr class="my-6" />
                <div class="flex flex-col justify-center">
                    <table-list-appointment :appointments="appointments.data" />
                    <pagination  :links="appointments.links" />
                </div>
            </div>

        </div>
    </DashboardLayout>
</template>
<script>
import { defineComponent } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import TableListAppointment from "@/Components/TableListAppointment.vue";
import DashboardLayout from "@/Layouts/DashboardLayout.vue";
import Pagination from "@/Components/Pagination.vue";

export default defineComponent({
    components: {
        AppLayout,
        Head,
        Link,
        TableListAppointment,
        DashboardLayout,
        Pagination
    },
    props: {
        appointments: Array,
    },
    watch: {
        fecha(fecha) {
            let aux;
            aux = this.q + "." + fecha;
            this.$inertia.replace(this.route("citas.index", { aux }));
        },
        q(valor) {
            let aux;
            aux = valor + "." + this.fecha;
            this.$inertia.replace(this.route("citas.index", { aux }));
        }
    },
    data() {
        return {
            q: "",
            fecha: "",
        };
    },
});
</script>
