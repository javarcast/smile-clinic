<script setup>
    import { ref } from 'vue'
    import Sidebar from '../Components/Sidebar.vue'
    import Header from '../Components/Header.vue'
    import AppLayout from '@/Layouts/AppLayout.vue';

    const sidebarOpen = ref(false)
</script>
<template>
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <Sidebar :sidebarOpen="sidebarOpen" @close-sidebar="sidebarOpen = false"  />

         <!-- Content area -->
        <div class="relative flex flex-col flex-1 overflow-y-auto overflow-x-hidden">
            <Header />
            <main>
                <slot/>
            </main>
        </div>
    </div>
</template>