<template>
  <DashboardLayout>
    <div class="md:col-span-4 mt-1">
      <h2 class="text-2xl md:text-3xl text-slate-800 font-bold">
        Solicitar Cita Médica
      </h2>
      <hr class="my-6" />
      <div
        class="
          flex
          justify-center
          mt-4
          bg-slate-50
          shadow-lg
          rounded-sm
          border border-slate-200
          relative
          px-4
          py-4
        "
      >
        <form @submit.prevent="submit" class="reqiest-appoint flex flex-wrap w-2/3">
          <div class="w-full flex flex-wrap">
            <div class="container-input w-full mb-4">
              <label class="block font-medium text-sm text-gray-700">Descripción</label>
              <textarea
                id="description"
                rows="4"
                required
                v-model="form.description"
                class="form-input w-full rounded bg-slate-50"
                autocomplete="Descripción"
              />
            </div>
            <div class="container-input w-full mb-4">
              <label class="block font-medium text-sm text-gray-700"
                >Fecha</label
              >
              <input
                id="date_appointment"
                type="date" 
                :min="currentDate"
                v-model="form.date_appointment"
                required
                class="form-input w-full rounded bg-slate-50"
              />
            </div>
            
          </div>
          <div class="btn-opt mt-8">
            <button class="btn-primary btn-black mr-2">Enviar</button>
            <Link
              class="btn-primary btn-white shadow-lg ml-2"
              :href="route('dashboard')"
            >
              Cancelar</Link
            >
          </div>
        </form>
      </div>
    </div>
  </DashboardLayout>
</template>

<script setup>
    import { Link, useForm } from "@inertiajs/inertia-vue3";
    import DashboardLayout from "@/Layouts/DashboardLayout.vue";
    import { ref, provide} from "vue";
    const title = ref("Crear Solicitud");
    provide("title", title);
    const props = defineProps(["user", 'currentDate']);

    const form = useForm({
      description: "",
      date_appointment: "",
      client_id: props.user.id,
    });

    const submit = () => {

      form.post(route("solicitudes.store"), {
        onFinish: () => form.reset("description", "date_appointment"),
      });
    };

</script>