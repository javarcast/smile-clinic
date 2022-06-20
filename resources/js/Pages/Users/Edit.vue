<script setup>

import { Link, useForm } from "@inertiajs/inertia-vue3";
import { ref, provide} from "vue";
import DashboardLayout from "@/Layouts/DashboardLayout.vue";

    const title = ref("Editar Usuario");
    provide("title", title);

    const props = defineProps(["roles", "UserShow"]);

    const form = useForm({
        name: props.UserShow.name,
        id: props.UserShow.id,
        phone_number: props.UserShow.phone_number.replace(/[^0-9]/g, ''),
        address: props.UserShow.address,
        email: props.UserShow.email,
        role_id: props.UserShow.role_id,
        password: null,
        password_confirmation: null,
    })

    const submit = () => {
      form.put(route("usuarios.update", props.UserShow.id), {
            onFinish: () => form.reset("password", "password_confirmation"),
        });
    }

</script>

<template>
    <DashboardLayout>
      <div class="md:col-span-4 mt-1">
        <h2 class="text-2xl md:text-3xl text-slate-800 font-bold">Editar Usuario</h2>
        <hr class="my-6" />
        <div class="mt-4 bg-slate-50 shadow-lg rounded-sm border border-slate-200 relative px-4 py-4">
          <form @submit.prevent="submit" class="create-user">
            <div class="container-input">
              <label class="block font-medium text-sm text-gray-700"
                >Nombre</label
              >
              <input
                type="text"
                v-model="form.name"
                required
                class="form-input w-full rounded bg-slate-50"
              />
            </div>
            <div class="container-input">
              <label class="block font-medium text-sm text-gray-700"
                >Nro. Telefonico</label
              >
              <input
                type="text"
                v-model="form.phone_number"
                required
                class="form-input w-full rounded bg-slate-50"
              />
            </div>
            <div class="container-input">
              <label class="block font-medium text-sm text-gray-700">DNI</label>
              <input
                type="text"
                v-model="form.id"
                required
                class="form-input w-full rounded  bg-slate-50"
              />
            </div>
            <div class="container-input">
              <label class="block text-left w-full">
                <span class="text-gray-700">Rol</span>
                <select
                  required
                  v-model="form.role_id"
                  class="form-input w-full rounded bg-slate-50"
                >
                  <option selected value="-1">Selecciona un Rol</option>
                  <option v-for="rol in roles" :key="rol.id" :value="rol.id">
                    {{ rol.name }}
                  </option>
                </select>
              </label>
            </div>
            <div class="container-input">
              <label class="block font-medium text-sm text-gray-700"
                >Dirección</label
              >
              <input
                type="text"
                v-model="form.address"
                required
                class="form-input w-full rounded bg-slate-50"
              />
            </div>
            <div class="container-input">
              <label class="block font-medium text-sm text-gray-700">Email</label>
              <input
                type="email"
                v-model="form.email"
                required
                class="form-input w-full rounded bg-slate-50"
              />
            </div>
            <div class="container-input">
              <label class="block font-medium text-sm text-gray-700"
                >Contraseña</label
              >
              <input
                type="password"
                v-model="form.password"
                class="form-input w-full rounded bg-slate-50"
                autocomplete="new-password"
              />
            </div>
            <div class="container-input">
              <label class="block font-medium text-sm text-gray-700"
                >Confirmar Contraseña</label
              >
              <input
                type="password"
                v-model="form.password_confirmation"
                class="form-input mb-4 w-full rounded-md shadow-sm bg-slate-50"
                autocomplete="new-password"
              />
            </div>
            <div class="btn-opt">
              <button class="btn-primary btn-black mr-2">
                Actualizar
              </button>
              <Link
                class="btn-primary btn-white shadow-lg ml-2"
                :href="route('usuarios.index')"
              >
                Cancelar</Link
              >
            </div>
          </form>
        </div>
      </div>
    </DashboardLayout>

</template>

