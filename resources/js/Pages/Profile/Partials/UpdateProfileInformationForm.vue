<template>
    <jet-form-section @submitted="updateProfileInformation">
        <template #form>
            <!-- Profile Photo -->
            <div class="items-center flex flex-col" v-if="$page.props.jetstream.managesProfilePhotos">
                <!-- Profile Photo File Input -->
                <input type="file" class="hidden" ref="photo" @change="updatePhotoPreview">

                <!-- Current Profile Photo -->
                <div class="mt-2" v-show="!photoPreview">
                    <img :src="user.profile_photo_url" :alt="user.name" class="rounded-full h-20 w-20 object-cover">
                </div>

                <!-- New Profile Photo Preview -->
                <div class="mt-2" v-show="photoPreview">
                    <span class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                        :style="'background-image: url(\'' + photoPreview + '\');'">
                    </span>
                </div>

                <jet-secondary-button class="mt-2" type="button" @click.prevent="selectNewPhoto">
                    Selecciona una Foto
                </jet-secondary-button>

                <jet-secondary-button type="button" class="mt-2" @click.prevent="deletePhoto"
                    v-if="user.profile_photo_path">
                    Eliminar Foto
                </jet-secondary-button>

                <jet-input-error :message="form.errors.photo" class="mt-2" />
            </div>
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