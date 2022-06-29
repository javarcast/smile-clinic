<template>
    <DashboardLayout>
        <div class="md:col-span-4 mt-1">
            <h2 class="text-2xl md:text-3xl text-slate-800 font-bold">
                Agregar Cita
            </h2>
            <hr class="my-6" />
            <div class="shadow bg-white md:rounded-md p-4">
                <form-errors :errors="errors"></form-errors>
                <form @submit.prevent="submit">
                    <div class="flex justify-between">
                        <label class="block text-left w-full">
                            <span class="text-gray-700">Paciente</span>
                            <select v-model="form.patient_id"
                                class="form-select block w-full mt-1 rounded-md shadow-sm">
                                <option selected value="">Selecciona Paciente</option>
                                <option v-for="patient in patients" :key="patient.id" :value="patient.id">
                                    {{ patient.name }}
                                </option>
                            </select>
                        </label>

                        <label class="block text-left w-full">
                            <span class="text-gray-700">Doctor</span>
                            <select v-model="form.dentist_id"
                                class="form-select block w-full mt-1 rounded-md shadow-sm">
                                <option selected value="">Selecciona Doctor</option>
                                <option v-for="dentist in dentists" :key="dentist.id" :value="dentist.id">
                                    {{ dentist.id }}
                                </option>
                            </select>
                        </label>
                    </div>
                    <br />
                    <div class="flex justify-between">
                        <div class="w-full">
                            <label class="block font-medium text-sm text-gray-700">Fecha</label>
                            <input type="date" v-model="form.date" :min="currentDate"
                                class="form-input w-full rounded-md shadow-sm" />
                        </div>

                        <div class="w-full">
                            <label class="block font-medium text-sm text-gray-700">Hora</label>
                            <input type="time" v-model="form.time" class="form-input w-full rounded-md shadow-sm" />
                        </div>
                    </div>
                    <br />
                    <div class="flex md:flex-row justify-between sm:flex-col">
                        <label class=" block text-left">
                            <span class="text-gray-700">Tratamiento</span>
                            <select v-model="form.treatment_id" class="form-select block mt-1 rounded-md shadow-sm"
                                @click="showPrice">
                                <option selected value="">Selecciona un Tratamiento</option>
                                <option v-for="treatment in treatments" :key="treatment.id" :value="
                                    treatment.id +
                                    '_' +
                                    treatment.price +
                                    '_' +
                                    treatment.name
                                ">
                                    {{ treatment.name }}
                                </option>
                            </select>
                        </label>
                        <div>
                            <label class="block text-left">
                                <span class="text-gray-700">Observación</span></label>
                            <input type="text" v-model="form.observation"
                                class="form-input mt-1 rounded-md shadow-sm" />
                        </div>
                        <div>
                            <label class="block text-left">
                                <span class="text-gray-700">Precio</span></label>
                            <input type="text" disabled v-model="form.price"
                                class="form-input mt-1 rounded-md shadow-sm" />
                        </div>
                        <input type="button" class="
                  bg-gray-200
                  w-1/12
                  hover:bg-blue-700 hover:text-white
                  rounded-md
                  text-black
                  mt-2
                  ml-2
                  py-2
                  px-4
                " @click="agregar" value="Agregar" />
                    </div>
                    <br /><br />
                    <table class="w-full text-center">
                        <thead>
                            <tr>
                                <th class="border px-4 py-2">Tratamiento</th>
                                <th class="border md-table-cell px-4 py-2">Observación</th>
                                <th class="border d-table-cell px-4 py-2">Costo Unitario</th>
                                <th class="border px-4 py-2" colspan="3">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="lis in form.list" :key="lis.treatment_id">
                                <td class="border px-4 py-2">
                                    {{ lis.treatment_name }}
                                </td>
                                <td class="border px-4 py-2">
                                    {{ lis.observation }}
                                </td>
                                <td class="border px-4 py-2">
                                    {{ lis.price }}
                                </td>
                                <td class="border px-4 py-2">
                                    <input type="button" class="
                        bg-gray-200
                        w-1/12
                        hover:bg-blue-700 hover:text-white
                        rounded-md
                        text-black text-center
                        mt-2
                        ml-2
                        py-2
                        px-4
                      " @click="eliminar(lis.observation)" value="X" />
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <th>TOTAL: {{ form.total }}</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tfoot>
                    </table>

                    <button class="
                bg-blue-500
                hover:bg-blue-700
                rounded-md
                text-white
                font-bold
                mt-2
                py-2
                px-4
              ">
                        Crear
                    </button>
                    <Link class="
                bg-gray-200
                w-1/12
                hover:bg-blue-700 hover:text-white
                rounded-md
                text-black
                mt-2
                ml-2
                py-2
                px-4
              " :href="route('citas.index')">
                    Cancelar</Link>
                </form>
            </div>
        </div>
    </DashboardLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link } from "@inertiajs/inertia-vue3";
import FormErrors from "@/Components/FormErrors.vue";
import DashboardLayout from "@/Layouts/DashboardLayout.vue";
export default {
    components: {
        AppLayout,
        Link,
        FormErrors,
        DashboardLayout,
    },
    data() {
        return {
            form: {
                patient_id: "",
                dentist_id: "",
                treatment_id: "",
                date: "",
                time: "",
                price: "",
                observation: "",
                total: 0,
                list: [],
            },
        };
    },
    methods: {
        submit() {
            this.$inertia.post(this.route("citas.store"), { ...this.form });
        },
        showPrice() {
            let aux;
            aux = this.form.treatment_id.split("_");
            if (aux[1] >= 0) {
                this.form.price = aux[1];
            } else {
                this.form.observation = "";
                this.form.price = "";
            }
        },

        agregar() {
            let nombre, idtratamiento, aux;
            let precio = 0;

            aux = this.form.treatment_id.split("_");

            idtratamiento = aux[0];
            precio = aux[1];
            nombre = aux[2];

            if (this.form.observation != "" && precio > 0) {
                this.form.list.push({
                    treatment_id: idtratamiento,
                    treatment_name: nombre,
                    observation: this.form.observation,
                    price: precio,
                });
                this.form.total += parseFloat(precio);
                this.form.treatment_id = "";
                this.form.price = "";
                this.form.observation = "";
            } else {
                if (this.form.observation == "") {
                    alert("Observación Invalida");
                }
            }
        },
        eliminar(position) {
            let cont = 0;

            for (let index = 0; index < this.form.list.length; index++) {
                if (this.form.list[index].observation === position) {
                    cont = index;
                }
            }
            this.form.total -=
                parseFloat(this.form.list[cont].price);
            this.form.list.splice(cont, 1);
        },
    },
    props: {
        patients: Array,
        dentists: Array,
        treatments: Array,
        currentDate: Object,
        errors: Object,
    },
};
</script>
