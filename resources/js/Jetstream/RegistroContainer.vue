<template>
    <div id="body-container" class="min-h-screen flex sm:justify-center pt-6 sm:pt-0 bg-red-400">
        <div class="w-2/4">
            <div class="w-full sm:max-w-md my-0 mx-auto px-6 py-4 bg-white overflow-hidden sm:rounded-lg">
                <slot />
            </div>
        </div>
        <div class="w-2/4 body-container-left">
            <div>
                <slot name="imagen" />
            </div>
        </div>
    </div>
</template>
