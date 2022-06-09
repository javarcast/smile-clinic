<script setup>
    import { provide, ref } from 'vue';
    import DashboardLayout from '@/Layouts/DashboardLayout.vue';
    import Welcome from '@/Jetstream/Welcome.vue';

    const title = ref('Dasboard');
    provide('title', title);
</script>

<template>
    <DashboardLayout>
        <div class="flex justify-center">
            <img src="../../../public/images/smileclinic.jpeg" alt="">
        </div>
       
    </DashboardLayout>
</template>
