<template>
    <jet-form-section @submitted="updateProfileInformation">
        <template #form>
            <!-- Profile Photo -->
           
            <div class="flex sm:flex-row flex-col">
                <!-- DNI -->
                <div class="sm:w-2/4 w-4/5 m-1 self-center">
                    <jet-label for="id" value="DNI" />
                    <jet-input id="id" type="number" class="mt-1 block w-full" v-model="form.id" autocomplete="id" />
                    <jet-input-error :message="form.errors.id" class="mt-2" />
                </div>
                <!-- Name -->
                <div class="sm:w-2/4 w-4/5 m-1 self-center">
                    <jet-label for="name" value="Name" />
                    <jet-input id="name" type="text" class="mt-1 block w-full" v-model="form.name"
                        autocomplete="name" />
                    <jet-input-error :message="form.errors.name" class="mt-2" />
                </div>
            </div>

            <!-- Address -->
            <div class="w-4/5 m-1 self-center">
                <jet-label for="address" value="Dirección" />
                <jet-input id="address" type="text" class="mt-1 block w-full" v-model="form.address"
                    autocomplete="address" />
                <jet-input-error :message="form.errors.address" class="mt-2" />
            </div>
            <!-- Phone -->
            <div class="w-4/5 m-1 self-center">
                <jet-label for="phone_number" value="Teléfono" />
                <jet-input id="phone_number" type="number" class="mt-1 block w-full" v-model="form.phone_number"
                    autocomplete="phone_number" />
                <jet-input-error :message="form.errors.phone_number" class="mt-2" />
            </div>

            <!-- Email -->
            <div class="w-4/5 m-1 self-center">
                <jet-label for="email" value="Email" />
                <jet-input id="email" type="email" class="mt-1 block w-full" v-model="form.email" />
                <jet-input-error :message="form.errors.email" class="mt-2" />
            </div>
        </template>

        <template #actions>
            <jet-action-message :on="form.recentlySuccessful" class="mr-3">
                Actualizado.
            </jet-action-message>

            <jet-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Actualizar
            </jet-button>
        </template>
    </jet-form-section>
</template>

<script>
import { defineComponent } from 'vue'
import JetButton from '@/Jetstream/Button.vue'
import JetFormSection from '@/Jetstream/FormSection.vue'
import JetInput from '@/Jetstream/Input.vue'
import JetInputError from '@/Jetstream/InputError.vue'
import JetLabel from '@/Jetstream/Label.vue'
import JetActionMessage from '@/Jetstream/ActionMessage.vue'
import JetSecondaryButton from '@/Jetstream/SecondaryButton.vue'

export default defineComponent({
    components: {
        JetActionMessage,
        JetButton,
        JetFormSection,
        JetInput,
        JetInputError,
        JetLabel,
        JetSecondaryButton,
    },

    props: ['user'],

    data() {
        return {
            form: this.$inertia.form({
                _method: 'PUT',
                id: this.user.id,
                name: this.user.name,
                address: this.user.address,
                phone_number: this.user.phone_number,
                email: this.user.email,
                photo: null,
            }),

            photoPreview: null,
        }
    },

    methods: {
        updateProfileInformation() {
            if (this.$refs.photo) {
                this.form.photo = this.$refs.photo.files[0]
            }

            this.form.post(route('user-profile-information.update'), {
                errorBag: 'updateProfileInformation',
                preserveScroll: true,
                onSuccess: () => (this.clearPhotoFileInput()),
            });
        },

        selectNewPhoto() {
            this.$refs.photo.click();
        },

        updatePhotoPreview() {
            const photo = this.$refs.photo.files[0];

            if (!photo) return;

            const reader = new FileReader();

            reader.onload = (e) => {
                this.photoPreview = e.target.result;
            };

            reader.readAsDataURL(photo);
        },

        deletePhoto() {
            this.$inertia.delete(route('current-user-photo.destroy'), {
                preserveScroll: true,
                onSuccess: () => {
                    this.photoPreview = null;
                    this.clearPhotoFileInput();
                },
            });
        },

        clearPhotoFileInput() {
            if (this.$refs.photo?.value) {
                this.$refs.photo.value = null;
            }
        },
    },
})
</script>