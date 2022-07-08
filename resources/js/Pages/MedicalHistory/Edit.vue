<template>
    <DashboardLayout>
        <div class="md:col-span-4 mt-1">
            <h2 class="text-2xl md:text-3xl text-slate-800 font-bold">Editar Historial</h2>
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
                  
                  hover:bg-blue-700 hover:text-white
                  rounded-md
                  text-black
                  mt-2
                  ml-2
                  py-2
                  px-4
                " @click="agregar" value="Agregar Radiografia" />
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
                            <tr v-for="(ima, index) in form.imagenes.data" :key="index">
                                <td class="border px-4 py-2">
                                    <img v-bind:src="ima.url" v-bind:alt="ima.name" class="w-28 my-0 mx-auto">
                                </td>
                                <td class="border px-4 py-2">
                                    {{ ima.type }}
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
                        Actualizar
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
    props: {
        radiographs: Array,
        patients: Array,
        history: Object,
        errors: Array,

    },
    data() {
        return {
            form: {
                historia_id: this.history.id,
                pirate: 1,
                patient_id: this.history.patient_id,
                imagenes: this.radiographs,
                tipo: "",
                prueba: "hola",
                files: [],
                type: [],
                filesDeleted: [],
            },
        };
    },
    methods: {
        submit() {
            this.$inertia.post(this.route("historial.store"), { ...this.form });
        },
        agregar() {

            if (this.$refs.files.value != "" && this.form.tipo != "") {
                this.form.imagenes.data.push({
                    name: this.$refs.files.files[0].name,
                    url: '/images/radiografias/' + this.$refs.files.files[0].name,
                    type: this.form.tipo,
                    size: this.$refs.files.files[0].size,
                });
                this.form.type.push(this.form.tipo);
                this.form.files.push(this.$refs.files.files[0]);
                this.$refs.files.value = "";
                this.form.tipo = "";
            }
        },
        eliminar(position) {
            var aux = -1;
            this.form.filesDeleted.push(this.form.imagenes.data[position].name);
            for (let index = 0; index < this.form.files.length; index++) {

                if (this.form.files[index].name == this.form.imagenes.data[position].name) {
                    aux = index;

                }
            }
            if (aux >= 0) {
                this.form.type.splice(aux, 1);
                this.form.files.splice(aux, 1);
                console.log("reciente eliminada");
            }
            this.form.imagenes.data.splice(position, 1);

        },
    },
};
</script>
