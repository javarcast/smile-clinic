<script setup>
    import { ref } from 'vue'
    import Sidebar from '../Components/Sidebar.vue'
    import Header from '../Components/Header.vue'
    import AppLayout from '@/Layouts/AppLayout.vue';
    import NotifyProcess from '@/Components/NotifyProcess.vue';
    const sidebarOpen = ref(false)
</script>
<template>
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <Sidebar :sidebarOpen="sidebarOpen" @close-sidebar="sidebarOpen = false"  />

         <!-- Content area -->
        <div class="relative flex flex-col flex-1 overflow-y-auto overflow-x-hidden bg-slate-100">
            <Header />
            <main class="main-content px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
                <notify-process v-if="$page.props.flash.status" :status="$page.props.flash.status"></notify-process>
                <slot/>
            </main>
        </div>
    </div>
</template>
