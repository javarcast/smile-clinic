<template>
    <Head title="SmileClinic" />
    <div class="home">
        <img class="img-logo-home" src="../../../images/Logo-home.svg" alt="Logo-home" />
        <h2 class="text-gray-200 mb-6 home_p1 text-center">
            Contamos con un prestigioso equipo de especialistas en todas las
            áreas de la odontología, altamente calificados, idóneos y
            competitivos.
        </h2>
        <h2 class="text-gray-200 home_p2 text-center">
            Nuestra meta es hacer de la odontología una experiencia placentera y
            de primera calidad, orientada a preservar y rehabilitar la salud
            oral, en un marco de seguridad y satisfacción para los pacientes,
            con un talento humano competitivo.
        </h2>
        <div class="home_buttons ">
            <!-- <button :href="route('login')" class="home-button btn-primary">Iniciar Sesión</button> -->
            <Link :href="route('login')" class="home-button btn-primary">Iniciar Sesión</Link>
            <Link :href="route('register')" class="home-button btn-primary">Registrate</Link>
        </div>
    </div>
</template>
<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3';
defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
});
</script>
