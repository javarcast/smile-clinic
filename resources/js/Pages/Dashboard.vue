<script setup>
    import { provide, ref } from 'vue';
    import DashboardLayout from '@/Layouts/DashboardLayout.vue';
    import Welcome from '@/Jetstream/Welcome.vue';

    const title = ref('Dasboard');
    provide('title', title);
</script>

<template>
    <DashboardLayout>
       <h1>hola mundo</h1>
    </DashboardLayout>
</template>
