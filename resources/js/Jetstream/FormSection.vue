<template>
    <div class="">
        <div class="mt-0 col-span-2 ">
            <form @submit.prevent="$emit('submitted')">
                <div class="px-4 py-5 bg-white sm:p-6 shadow"
                    :class="hasActions ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md'">
                    <div class="flex flex-col gap-6 justify-center items-center">
                        <slot name="form"></slot>
                    </div>
                </div>

                <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md"
                    v-if="hasActions">
                    <slot name="actions"></slot>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import { defineComponent } from 'vue'


export default defineComponent({
    emits: ['submitted'],

    components: {
    },

    computed: {
        hasActions() {
            return !!this.$slots.actions
        }
    }
})
</script>
