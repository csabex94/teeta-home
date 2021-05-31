<template>
    <app-layout>
        <template #content>

            <div class="py-10 mx-auto max-w-7xl lg:px-6">
                <jet-form-section @submitted="store">

                <template #title>
                    <h1 class="text-2xl text-gray-200">Create New Event</h1>
                </template>

                <template #description>
                    <p class="text-gray-200">
                        
                    </p>
                </template>

                <template #form>

                    <div class="col-span-6">
                        <jet-label for="title" value="Title" />
                        <jet-input id="title" type="text" class="block w-full mt-1" v-model="form.title" autocomplete="title" />
                        <jet-input-error :message="form.errors.title" class="mt-2" />
                    </div>

                    <div class="col-span-6">
                        <jet-label for="description" value="Description" />
                        <textarea
                            class="w-full mt-2 border-gray-300 rounded-md shadow-sm focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50"
                            name="description"
                            id="description"
                            v-model="form.description"
                            rows="6"></textarea>
                        <jet-input-error :message="form.errors.description" class="mt-2" /> 
                    </div>

                    <div class="relative grid grid-cols-2 col-span-6 gap-8">
                        <div class="relative w-full">
                            <jet-label for="date" value="Specify Date" />
                            <flat-pickr
                                v-model="form.date"
                                :config="flatPickrConfig"
                                class="w-full border-gray-300 rounded-md shadow-sm cursor-pointer focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50 mt-1"
                                name="date"
                                ref="specDate"
                            />

                            <svg
                                @click="clearCalendarInput()"
                                xmlns="http://www.w3.org/2000/svg"
                                class="absolute w-5 h-5 text-gray-500 cursor-pointer right-10 bottom-3"
                                viewBox="0 0 20 20"
                                fill="currentColor">
                                <path
                                    fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                    clip-rule="evenodd" />
                            </svg>

                            <svg
                                @click="openCalendarOnIconClick"
                                xmlns="http://www.w3.org/2000/svg"
                                class="absolute w-6 h-6 text-gray-500 cursor-pointer right-2 bottom-3"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <jet-input-error :message="form.errors.date" class="mt-2" />
                        </div>
                        <div class="relative w-full">
                            <jet-label for="spec_time" value="Select Time" />
                            <flat-pickr
                                v-model="form.spec_time"
                                :config="flatPickrConfigTime"
                                class="w-full border-gray-300 rounded-md shadow-sm cursor-pointer focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50"
                                placeholder="Specify time"
                                name="spec_time"
                                ref="specTime"
                            />

                            <svg
                                @click="clearTimeInput()"
                                xmlns="http://www.w3.org/2000/svg"
                                class="absolute w-5 h-5 text-gray-500 cursor-pointer right-10 bottom-3"
                                viewBox="0 0 20 20"
                                fill="currentColor">
                                <path
                                    fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                    clip-rule="evenodd" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="absolute w-6 h-6 text-gray-500 cursor-pointer right-2 bottom-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <jet-input-error :message="form.errors.spec_time" class="mt-2" /> 
                        </div>
                    </div>

                </template>

                <template #actions>
                    <jet-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Save
                    </jet-button>

                    <jet-action-message :on="form.recentlySuccessful" class="ml-3">
                        Saved.
                    </jet-action-message>
                </template>

            </jet-form-section>
            </div>

        </template>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import JetFormSection from '@/Jetstream/FormSection';
import JetLabel from '@/Jetstream/Label';
import JetInput from '@/Jetstream/Input';
import JetInputError from '@/Jetstream/InputError';
import JetActionMessage from '@/Jetstream/ActionMessage';
import JetButton from '@/Jetstream/Button';
import JetCheckbox from '@/Jetstream/Checkbox';
import flatPickr from 'vue-flatpickr-component';

export default {
    components: {
        AppLayout,
        JetFormSection,
        JetLabel,
        JetInput,
        JetInputError,
        JetActionMessage,
        JetButton,
        JetCheckbox,
        flatPickr
    },
    data() {
        return {
            form: this.$inertia.form({
                title: "",
                date: "",
                description: "",
                spec_time: ""
            }),
            flatPickrConfig: {
                altFormat: 'M j, Y',
                altInput: true,
                dateFormat: 'Y-m-d',
            },
            flatPickrConfigTime: {
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
            },
            showSpecDateCalendar: false,
            showRemindOptions: false,
        }
    },
    mounted() {
        flatpickr("#date", { wrap: true })
    },
    methods:{
        openCalendarOnIconClick() {
            this.$refs.specDate.fp.toggle();
        },
        clearCalendarInput() {
            this.form.date = ""; 
        },
        clearTimeInput() {
            this.form.spec_time = "";
        },
        store() {
            this.form.post(route('events.store'), {
                onSuccess: () => {
                    this.form.title = false;
                    this.form.description = false;
                    this.form.date = false;
                    this.form.spec_time = false;
                    this.form.reset();
                }
            });
        }
    }
}
</script>

<style>

</style>
