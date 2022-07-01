<template>

    <Head title="Register" />
   
    <jet-registro-container>
 <div class="flex items-center justify-between -ml-6 h-16 ">
        <!-- button go back to  -->
        <Link href="/">
        <img class="go-back-to" src="../../../images/go-back-to.png" alt="">
        </Link>
    </div>
        <jet-validation-errors class="mb-4" />

        <form-register-1 />

        <template #imagen>
            <jet-registro-container-imagen />
        </template>
    </jet-registro-container>
</template>

<script>
import { defineComponent } from 'vue'
import JetRegistroContainer from '@/Jetstream/RegistroContainer.vue'
import FormRegister1 from "@/Components/FormRegister1.vue";
import JetRegistroContainerImagen from '@/Jetstream/RegistroContainerImagen.vue'
import JetButton from '@/Jetstream/Button.vue'
import JetInput from '@/Jetstream/Input.vue'
import JetCheckbox from '@/Jetstream/Checkbox.vue'
import JetLabel from '@/Jetstream/Label.vue'
import JetValidationErrors from '@/Jetstream/ValidationErrors.vue'
import { Head, Link } from '@inertiajs/inertia-vue3';

export default defineComponent({
    components: {
        Head,
        JetRegistroContainer,
        JetRegistroContainerImagen,
        FormRegister1,
        JetButton,
        JetInput,
        JetCheckbox,
        JetLabel,
        JetValidationErrors,
        Link,
    },

    data() {
        return {

        }
    },

    methods: {

    }
})
</script>
