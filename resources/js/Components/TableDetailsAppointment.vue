<template>
    <div class="flex flex-col">
        <div class="flex">
            <label class="block text-left w-full">
                <span class="text-gray-700">Paciente</span>
                <input type="text" disabled class="block w-full mt-1 rounded-md shadow-sm border-gray-200"
                    :value="appointment.patient.name" />
            </label>

            <label class="block text-left w-full">
                <span class="text-gray-700">Doctor</span>
                <input type="text" disabled class="form-select block w-full mt-1 rounded-md shadow-sm border-gray-200 "
                    :value="appointment.dentist.id" />
            </label>
        </div>
        <div class="flex justify-between text-center">
            <label class="block text-left w-3/12">
                <span class="text-gray-700">Fecha</span>
                <input type="text" disabled class="block w-full mt-1 rounded-md shadow-sm border-gray-200 text-center"
                    :value="appointment.date" />
            </label>

            <label class="block text-left w-3/12">
                <span class="text-gray-700">Hora</span>
                <input type="text" disabled class="form-select block w-full mt-1 rounded-md shadow-sm border-gray-200 "
                    :value="appointment.hour" />
            </label>
            <label class="block text-left w-3/12">
                <span class="text-gray-700">Estatus</span>
                <input type="text" disabled class="form-select block w-full mt-1 rounded-md shadow-sm border-gray-200"
                    :value="appointment.state.name" />
            </label>
        </div>
    </div>
    <br>
    <table>
        <thead>
            <tr>
                <th class="border px-4 py-2">Tratamiento</th>
                <th class="border md-table-cell px-4 py-2">Cantidad</th>
                <th class="border d-table-cell px-4 py-2">Costo Unitario</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="appT in appTrea" :key="appT.treatment_id">
                <td class="border px-4 py-2">
                    {{ appT.treatment_name }}
                </td>
                <td class="border md-table-cell px-3 py-2">
                    {{ appT.observation }}
                </td>
                <td class="px-4 md-table-cell border py-2">
                    {{ appT.price}}
                </td>
            </tr>

        </tbody>
        <tfoot>
            <tr class="px-4 md-table-cell border py-5 text-center font-black">
                Total: {{ appointment.total }}
            </tr>
            <tr></tr>
            <tr></tr>
        </tfoot>
    </table>
    <br>
</template>

<script>
import { defineComponent } from "vue";
export default defineComponent({
    props: {
        appointment: Object,
        appTrea: Array,
    },
});
</script>
