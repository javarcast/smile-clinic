<template>
    <div v-if="Object.keys(errors).length" role="alert">
        <div class="bg-red-500 text-white font-bold rounded-t px-4 py-2">
            Ha ocurrido un error:
        </div>
        <div class="border border-t-0 border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700">
            <ul>
                <div v-for="(error, index) in errors" :key="index">
                        <li>{{ error }}</li>
                </div>
            </ul>
        </div>
    </div>
</template>

<script>
export default {
    name:'FormErrores',
    props:{
        errors: Object,
    }
}
</script>