<template>
    <DashboardLayout>
        <div class="md:col-span-4 mt-1">
            <h2 class="text-2xl md:text-3xl text-slate-800 font-bold">
                Agregar Historia
            </h2>
             <hr class="my-6" />
            <div class="shadow bg-white md:rounded-md p-4">
                <form-errors :errors="errors"></form-errors>
                <form @submit.prevent="submit" enctype="multipart/form-data">
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
                    </div>
                    <br />
                    <div class="flex md:flex-row justify-between sm:flex-col">
                        <div>
                            <label class="block text-left">
                                <span class="text-gray-700">Add Radiografia</span>
                            </label>
                            <input type="file" ref="files" accept="image/*"
                                class="form-input mt-1 rounded-md shadow-sm" />
                        </div>
                        <div>
                            <label class="block text-left">
                                <span class="text-gray-700">Tipo</span></label>
                            <select v-model="form.tipo" class="form-select block w-full mt-1 rounded-md shadow-sm">
                                <option selected value="">Selecciona Tipo</option>
                                <option value="panoramica">Panoramica</option>
                                <option value="periapical">Periapical</option>
                            </select>
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
                                <th class="border px-4 py-2">Radiografia</th>
                                <th class="border md-table-cell px-4 py-2">Tipo</th>
                                <th class="border px-4 py-2" colspan="2">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(ima, index) in form.imagenes" :key="index">
                                <td class="border px-4 py-2">
                                    <!-- <img src="{{ lis.radiograph_id }}" alt="elol"> -->
                                    {{ ima.name }}
                                </td>
                                <td class="border px-4 py-2">
                                    {{ form.type[index] }}
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
                      " @click="eliminar(index)" value="X" />
                                </td>
                            </tr>
                        </tbody>
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
              " :href="route('historial.index')">
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
                pirate: 0,
                patient_id: "",
                imagenes: [],
                tipo: "",
                type: [],
            },
        };
    },
    methods: {
        submit() {
            this.$inertia.post(this.route("historial.store"), { ...this.form });
        },
        agregar() {
            if (this.$refs.files.value != "" && this.form.tipo != "") {
                console.log(this.$refs.files.files[0].size);
                this.form.imagenes.push(this.$refs.files.files[0]);
                this.form.type.push(this.form.tipo);
                this.$refs.files.value = "";
                this.form.tipo = "";
            }
            if (this.$refs.files.value == "") {
                console.log("tipo vacio");
            }
        },
        eliminar(position) {

            this.form.imagenes.splice(position, 1);
            this.form.type.splice(position, 1);
        },
    },
    props: {
        patients: Array,
        doctors: Array,
        treatments: Array,
        currentDate: Object,
        errors: Object,
    },
};
</script>
