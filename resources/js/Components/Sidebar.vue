<template>
  <div>

    <!-- Sidebar -->
    <div
      id="sidebar"
      ref="sidebar"
      class="flex flex-col absolute z-40 left-0  'translate-x-0' top-0 lg:static lg:left-auto lg:top-auto lg:translate-x-0 transform h-screen overflow-y-scroll lg:overflow-y-auto no-scrollbar w-64 lg:w-20 lg:sidebar-expanded:!w-64 2xl:!w-64 shrink-0 bg-sc-blue p-4 transition-all duration-200 ease-in-out"
      
    >

      <!-- Sidebar header -->
      <div class="flex justify-between mb-10 pr-3 sm:px-2 truncate">
        <!-- Logo -->
          <Link :href="'/dashboard'" class="flex logo-dashboard">
            <img src="../../../public/images/logo3.png" alt="icon logo" class="icon-logo">
            <img src="../../../public/images/logo.png" alt="text logo" class="text-logo lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">
        </Link>
      </div>

      <!-- Links -->
      <div>
        <!-- Pages group -->

        <div >
          <ul class="m-0" v-if="$page.props.user.role_id===1">
            <li  class="flex justify-between pr-3 sm:px-2 mt-6 mb-6 truncate">
              <Link :href="'/dashboard'" class="flex  items-end">
                <img src="../../../public/images/dashboard.png" alt="icon users" class="icon-sidebar">
                <span class="text-sm text-sc-white font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Dashboard</span>
              </Link>
            </li>
            <li class="flex justify-between pr-3 sm:px-2 mt-6 mb-6 truncate">
              <Link :href="route('usuarios.index')" class="flex items-end sidebar-link">
                <img src="../../../public/images/users.png" alt="icon users" class="icon-sidebar">
                <span class="text-sm text-sc-white font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Usuarios</span>
              </Link>
            </li>
            <li class="flex justify-between pr-3 sm:px-2 mt-6 mb-6 truncate">
              <Link :href="route('pacientes.index')" class="flex items-end">
                <img src="../../../public/images/pacientes.png" alt="icon users" class="icon-sidebar">
                <span class="text-sm text-sc-white font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Pacientes</span>
              </Link>
            </li>
            <li class="flex justify-between pr-3 sm:px-2 mt-6 mb-6 truncate" >
              <Link :href="route('tratamientos.index')" class="flex  items-end">
                <img src="../../../public/images/tratamientos.png" alt="icon users" class="icon-sidebar">
                <span class="text-sm text-sc-white font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Tratamientos</span>
              </Link>
            </li>
            <li class="flex justify-between pr-3 sm:px-2 mt-6 mb-6 truncate">
              <Link :href="route('solicitudes.index')" class="flex  items-end">
                <img src="../../../public/images/cita-medica.png" alt="icon users" class="icon-sidebar">
                <span class="text-sm text-sc-white font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Solicitudes Cita Medicas</span>
              </Link>
            </li>

            <li v-if="$page.props.user.role_id===1" class="flex justify-between pr-3 sm:px-2 mt-6 mb-6 truncate">
              <Link :href="route('estadisticas.index')" class="flex  items-end">
                <img src="../../../public/images/stadistics-icon.png" alt="icon stadistics" class="icon-sidebar">
                <span class="text-sm text-sc-white font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Estadisticas</span>
              </Link>
            </li>

            <li  class="flex justify-between pr-3 sm:px-2 mt-6 mb-6 truncate">
              <Link :href="route('citas.index')" class="flex  items-end">
                <img src="../../../public/images/cita.png" alt="icon users" class="icon-sidebar">
                <span class="text-sm text-sc-white font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Citas</span>
              </Link>
            </li>
            <li  class="flex justify-between pr-3 sm:px-2 mt-6 mb-6 truncate">
              <Link :href="route('historial.index')" class="flex  items-end">
                <img src="../../../public/images/history.png" alt="icon users" class="icon-sidebar">
                <span class="text-sm text-sc-white font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Historias Clínicas</span>
              </Link>
            </li>
            <li class="flex justify-between pr-3 sm:px-2 mt-6 mb-6 truncate">
              <Link :href="route('calculadora')" class="flex  items-end">
                <img src="../../../public/images/calculadora.png" alt="icon users" class="icon-sidebar">
                <span class="text-sm text-sc-white font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Calculadora</span>
              </Link>
            </li>
            
          </ul>
          <ul class="m-0" v-if="$page.props.user.role_id===2">
            <li  class="flex justify-between pr-3 sm:px-2 mt-6 mb-6 truncate">
              <Link :href="'/dashboard'" class="flex  items-end">
                <img src="../../../public/images/dashboard.png" alt="icon users" class="icon-sidebar">
                <span class="text-sm text-sc-white font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Dashboard</span>
              </Link>
            </li>
            <li  class="flex justify-between pr-3 sm:px-2 mt-6 mb-6 truncate">
              <Link :href="route('citas.index')" class="flex  items-end">
                <img src="../../../public/images/agenda.png" alt="icon users" class="icon-sidebar">
                <span class="text-sm text-sc-white font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Agenda</span>
              </Link>
            </li>
            <li  class="flex justify-between pr-3 sm:px-2 mt-6 mb-6 truncate">
              <Link :href="route('historial.index')" class="flex  items-end">
                <img src="../../../public/images/history.png" alt="icon users" class="icon-sidebar">
                <span class="text-sm text-sc-white font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Historias Clínicas</span>
              </Link>
            </li>
          </ul>
          <ul class="m-0" v-if="$page.props.user.role_id===3">
            <li  class="flex justify-between pr-3 sm:px-2 mt-6 mb-6 truncate">
              <Link :href="'/dashboard'" class="flex  items-end">
                <img src="../../../public/images/dashboard.png" alt="icon users" class="icon-sidebar">
                <span class="text-sm text-sc-white font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Dashboard</span>
              </Link>
            </li>
            <li  class="flex justify-between pr-3 sm:px-2 mt-6 mb-6 truncate">
              <Link :href="route('solicitudes.create')" class="flex  items-end">
                <img src="../../../public/images/cita-medica.png" alt="icon users" class="icon-sidebar">
                <span class="text-sm text-sc-white font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Solicitar Citas Medicas</span>
              </Link>
            </li>
            <li  class="flex justify-between pr-3 sm:px-2 mt-6 mb-6 truncate">
              <Link :href="route('citas.index')" class="flex  items-end">
                <img src="../../../public/images/cita.png" alt="icon users" class="icon-sidebar">
                <span class="text-sm text-sc-white font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Citas</span>
              </Link>
            </li>
            <li  class="flex justify-between pr-3 sm:px-2 mt-6 mb-6 truncate">
              <Link :href="route('historial.index')" class="flex  items-end">
                <img src="../../../public/images/history.png" alt="icon users" class="icon-sidebar">
                <span class="text-sm text-sc-white font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Historias Clínicas</span>
              </Link>
            </li>


            <!-- first link -->

          </ul>

        </div>

      </div>

      <!-- Expand / collapse button -->
      <div class="pt-3 hidden lg:inline-flex 2xl:hidden justify-end mt-auto">
        <div class="px-3 py-2">
          <button @click.prevent="sidebarExpanded = !sidebarExpanded">
            <span class="sr-only">Expand / collapse sidebar</span>
            <svg class="w-6 h-6 fill-current sidebar-expanded:rotate-180" viewBox="0 0 24 24">
              <path class="text-slate-400" d="M19.586 11l-5-5L16 4.586 23.414 12 16 19.414 14.586 18l5-5H7v-2z" />
              <path class="text-slate-600" d="M3 23H1V1h2z" />
            </svg>
          </button>
        </div>
      </div>

    </div>

  </div>

</template>
<script setup>
  import { ref, watch, onMounted } from 'vue'
  import { Link } from "@inertiajs/inertia-vue3";

  const props = defineProps(['sidebarOpen'])

  const sidebarExpanded = ref(true);

   onMounted(() => {
      document.querySelector('body').classList.add('sidebar-expanded');
    })

    watch(sidebarExpanded, () => {

      if (sidebarExpanded.value) {
        document.querySelector('body').classList.add('sidebar-expanded')
      } else {
        document.querySelector('body').classList.remove('sidebar-expanded')
      }

    })


</script>
