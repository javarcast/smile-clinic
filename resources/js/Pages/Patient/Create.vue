<script setup>
import { Link, useForm } from "@inertiajs/inertia-vue3";
import { ref, provide, onMounted, computed } from "vue";
import DashboardLayout from "@/Layouts/DashboardLayout.vue";
import JetValidationErrors from "@/Jetstream/ValidationErrors.vue";
import JetButton from "@/Jetstream/Button.vue";
import JetInput from "@/Jetstream/Input.vue";
import JetCheckbox from "@/Jetstream/Checkbox.vue";
import JetLabel from "@/Jetstream/Label.vue";
import { isReturnStatement } from "@babel/types";
const title = ref("Agregar Paciente");
provide("title", title);

const form = useForm({
  dni: "",
  name: "",
  phone_number: "",
  email: "",
  user_id: "",
  medicaments: [],
  diseases: [],
});

const allergyItem = ref("");
const diseaseItem = ref("");
const medicamentItem = ref("");

const props = defineProps(["users", "medicaments", "diseases", "errors"]);

const getAllergies = computed(() => {
  return props.diseases.filter(
    (item) => item.disease_type_id === 1 && !form.diseases.includes(item.id)
  );
});

const getDiseases = computed(() => {
  return props.diseases.filter(
    (item) => item.disease_type_id === 2 && !form.diseases.includes(item.id)
  );
});

const getMedicaments = computed(() => {
  return props.medicaments.filter(
    (item) => !form.medicaments.includes(item.id)
  );
});

const getDiseaseType = (id) => {
  const item = props.diseases.find((item) => item.id === id);

  if (item.disease_type_id === 1) {
    return "Alergias";
  }

  return "Enfermedad";
};

const getDiseaseName = (id) => {
  return props.diseases.find((item) => item.id === id).name;
};

const getMedicamentName = (id) => {
  return props.medicaments.find((item) => item.id === id).name;
};

const getIDNumber = () => {
  form.id = parseInt(form.id);
};

const addAllergy = () => {
  if (allergyItem.value !== "") {
    form.diseases.push(allergyItem.value);
    allergyItem.value = "";
  }
};

const addDisease = () => {
  if (diseaseItem.value !== "") {
    form.diseases.push(diseaseItem.value);
    diseaseItem.value = "";
  }
};

const addMedicament = () => {
  if (medicamentItem.value !== "") {
    form.medicaments.push(medicamentItem.value);
    medicamentItem.value = "";
  }
};

const removeDisease = (id) => {
  form.diseases = form.diseases.filter((item) => item !== id);
};

const removeMedicament = (id) => {
  form.medicaments = form.medicaments.filter((item) => item !== id);
};

const showMedicalInfo = computed(() => {
  return form.medicaments.length > 0 || form.diseases.length > 0;
});

const submit = () => {
  getIDNumber();
  form.post(route("pacientes.store"), {
    onFinish: () => form.reset("id", "name"),
  });
};
</script>
<template>
  <DashboardLayout>
    <div class="md:col-span-4 mt-1">
      <h2 class="text-2xl md:text-3xl text-slate-800 font-bold">
        Agregar Paciente
      </h2>
      <hr class="my-6" />
      <div class="
          flex
          mt-4
          bg-slate-50
          shadow-lg
          rounded-sm
          border border-slate-200
          relative
          px-4
          py-4
        ">
        <form @submit.prevent="submit" class="create-paciente flex flex-wrap">
          <div class="w-2/3 flex flex-wrap pr-10 create-paciente-col">
            <div class="container-input w-1/2 pr-4">
              <label class="block font-medium text-sm text-gray-700">DNI</label>
              <input id="id" type="text" v-model="form.dni" class="form-input w-full rounded bg-slate-50"
                autocomplete="DNI" />
            </div>
            <div class="container-input w-1/2 pl-4">
              <label class="block font-medium text-sm text-gray-700">Nombre</label>
              <input id="name" type="text" v-model="form.name" required class="form-input w-full rounded bg-slate-50" />
            </div>
            <div class="container-input mt-2 w-1/2 pr-4">
              <label class="block font-medium text-sm text-gray-700">Email</label>
              <input type="email" id="email" v-model="form.email" class="form-input w-full rounded bg-slate-50" />
            </div>
            <div class="container-input mt-2 w-1/2 pl-4">
              <label class="block font-medium text-sm text-gray-700">Nro. Telefonico</label>
              <input type="text" id="phone_number" v-model="form.phone_number"
                class="form-input w-full rounded bg-slate-50" />
            </div>
            <div class="container-input mt-2 w-full">
              <label class="block font-medium text-sm text-gray-700"
                >Usuario</label
              >
              <select
                class="w-full"
                v-model="form.user_id"
                name="user_id"
                id="user_id"
              >
                <option value="">Seleccione un usuario</option>
                <option v-for="user in users" :key="user.id" :value="user.id">
                  {{ user.name }}
                </option>
              </select>
            </div>
            <div v-if="showMedicalInfo" class="w-full mt-6">
              <table class="w-full">
                <thead class="text-left">
                  <tr>
                    <th>Nombre</th>
                    <th>Tipo</th>
                    <th class="text-center">action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="disease in form.diseases" :key="disease">
                    <td>{{ getDiseaseName(disease) }}</td>
                    <td>{{ getDiseaseType(disease) }}</td>
                    <td class="flex justify-center items-center">
                      <button @click.prevent="removeDisease(disease)">
                        <i class="fas fa-trash-alt text-red-600"></i>
                      </button>
                    </td>
                  </tr>
                  <tr v-for="medicament in form.medicaments" :key="medicament">
                    <td>{{ getMedicamentName(medicament) }}</td>
                    <td>Medicamento</td>
                    <td class="flex justify-center items-center">
                      <button @click.prevent="removeMedicament(medicament)">
                        <i class="fas fa-trash-alt text-red-600"></i>
                      </button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

          <div class="w-1/3 flex flex-col items-center create-paciente-col">
            <div
              class="p-2 rounded bg-gray-200 w-full"
              v-show="getDiseases.length > 0"
            >
              <h3 class="mb-2 text-lg">Enfermedades</h3>
              <div class="flex">
                <select
                  v-model="diseaseItem"
                  class="text-xs w-64 rounded border border-gray-300"
                  name=""
                  id=""
                >
                  <option value="">Selecciona una enfermedad</option>
                  <option
                    v-for="disease in getDiseases"
                    :key="disease.id"
                    :value="disease.id"
                  >
                    {{ disease.name }}
                  </option>
                </select>
                <button
                  @click.prevent="addDisease()"
                  class="ml-2 text-white bg-black h-8 w-8 rounded-full"
                >
                  <i class="fas fa-plus"></i>
                </button>
              </div>
            </div>
            <div
              class="p-2 rounded bg-gray-200 w-full"
              v-show="getAllergies.length > 0"
            >
              <h3 class="mb-2 text-lg">Alergias</h3>
              <div class="flex">
                <select
                  v-model="allergyItem"
                  class="text-xs w-64 rounded border border-gray-300"
                  name=""
                  id=""
                >
                  <option value="">Selecciona una alergia</option>
                  <option
                    v-for="allergy in getAllergies"
                    :key="allergy.id"
                    :value="allergy.id"
                  >
                    {{ allergy.name }}
                  </option>
                </select>
                <button
                  @click.prevent="addAllergy()"
                  class="ml-2 text-white bg-black h-8 w-8 rounded-full"
                >
                  <i class="fas fa-plus"></i>
                </button>
              </div>
            </div>

            <div
              class="p-2 rounded bg-gray-200 w-full"
              v-show="getMedicaments.length > 0"
            >
              <h3 class="mb-2 text-lg">Medicamentos</h3>
              <div class="flex">
                <select
                  v-model="medicamentItem"
                  class="text-xs w-64 rounded border border-gray-300"
                  name=""
                  id=""
                >
                  <option value="">Selecciona un medicamento</option>
                  <option
                    v-for="medicament in getMedicaments"
                    :key="medicament.id"
                    :value="medicament.id"
                  >
                    {{ medicament.name }}
                  </option>
                </select>
                <button
                  @click.prevent="addMedicament()"
                  class="ml-2 text-white bg-black h-8 w-8 rounded-full"
                >
                  <i class="fas fa-plus"></i>
                </button>
              </div>
            </div>
          </div>
          <div class="btn-opt mt-8">
            <button class="btn-primary btn-black mr-2">Crear</button>
            <Link class="btn-primary btn-white shadow-lg ml-2" :href="route('pacientes.index')">
            Cancelar</Link>
          </div>
        </form>
      </div>
    </div>
  </DashboardLayout>
</template>
