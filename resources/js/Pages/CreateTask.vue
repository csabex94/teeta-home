<template>
            <div class="mx-auto max-w-7xl lg:px-6">
                <jet-form-section @submitted="createTask">

                <template #title>
                    <h1 class="text-2xl text-gray-800">Create New Task</h1>
                </template>

                <template #description>
                    <p class="text-gray-800 mt-4">
                        <b>Daily *</b>
                        <br>
                        <ul class="mt-2"><li>- The created task will appear everyday on the dashboard</li></ul>
                        <br>
                        <b>Remind Before *</b>
                        <br>
                        <ul class="mt-2"><li>- Specify a custom reminder</li></ul>
                        <br>
                        <b>Email *</b>
                        <br>
                        <ul class="mt-2"><li>- Receive email notifications</li></ul>
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
                            class="w-full mt-2 border-gray-300 rounded-md shadow-sm focus:border-gray-400 focus:ring focus:ring-gray-300 focus:ring-opacity-50"
                            name="description"
                            id="description"
                            v-model="form.description"
                            rows="6"></textarea>
                        <jet-input-error :message="form.errors.description" class="mt-2" />
                    </div>

                    <div class="flex items-center text-gray-800 justify-between col-span-6">
                        <div class="flex items-center text-sm font-medium">Daily <jet-checkbox v-model="form.daily" class="ml-2" /></div>
                        <div v-if="!form.daily" class="flex items-center text-sm font-medium">Remind Before <jet-checkbox v-model="showRemindOptions" class="ml-2" /></div>
                        <div class="flex items-center text-sm font-medium">Email<jet-checkbox v-model="form.push_email" class="ml-2" /></div>
                    </div>

                    <div class="grid grid-cols-2 col-span-6 gap-8">
                        <div v-if="!form.daily" class="relative w-full">
                            <flat-pickr
                                v-model="form.spec_date"
                                :config="flatPickrConfig"
                                class="w-full border-gray-300 rounded-md shadow-sm cursor-pointer focus:border-gray-400 focus:ring focus:ring-gray-500 focus:ring-opacity-50"
                                placeholder="Specify date"
                                name="spec_date"
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
                        </div>
                        <div class="relative w-full">
                            <flat-pickr
                                v-model="form.spec_time"
                                :config="flatPickrConfigTime"
                                class="w-full border-gray-300 rounded-md shadow-sm cursor-pointer focus:border-gray-400 focus:ring focus:ring-gray-500 focus:ring-opacity-50"
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
                        </div>
                    </div>

                    <div v-if="showRemindOptions" class="grid grid-cols-2 col-span-6 gap-8">
                        <select
                            v-model="form.remind_before_option"
                            class="w-full text-gray-500 border-gray-300 rounded-md shadow-sm appearance-none cursor-pointer focus:border-gray-400 focus:ring focus:ring-gray-500 focus:ring-opacity-50">
                            <option>Remind me before</option>
                            <option value="minutes">Minutes</option>
                            <option value="hours">Hours</option>
                            <option value="days">Days</option>
                            <option value="weeks">Weeks</option>
                            <option value="months">Months</option>
                        </select>
                        <jet-input
                            type="number"
                            class="w-full"
                            v-model="form.remind_before_value"
                            :placeholder="getBeforeValuePlaceholder()"
                            v-if="form.remind_before_option === 'minutes' || form.remind_before_option === 'hours' || form.remind_before_option === 'days' || form.remind_before_option === 'weeks' || form.remind_before_option === 'months'"
                        />
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

<script>
import AppLayout from '@/Layouts/AppLayout'
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
                description: "",
                daily: false,
                push_email: false,
                spec_date: "",
                remind_before_value: "",
                remind_before_option: "Remind me before",
                spec_time: ""
            }),
            showRemindOptions: false,
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
        }
    },
    methods: {
        openCalendarOnIconClick() {
            this.$refs.specDate.fp.toggle();
        },
        createTask() {
            this.form.post(route('create.task.post'),{
                onSuccess: () => {
                    this.form.daily = false;
                    this.form.push_email = false;
                    this.showRemindOptions = false;
                    this.form.reset();
                }
            });
        },
        getBeforeValuePlaceholder() {
            switch (this.form.remind_before_option) {
                case "minutes":
                    return "Specify minutes"
                case "hours":
                    return "Specify hours"
                case "days":
                    return "Specify days"
                case "weeks":
                    return "Specify weeks"
                case "months":
                    return "Specify months"
            }
        },
        clearCalendarInput() {
            this.form.spec_date = "";
        },
        clearTimeInput() {
            this.form.spec_time = "";
        }
    },
    computed: {
        daily() {
            return this.form.daily
        }
    },
    watch: {
        daily(value) {
            if (value === true) {
                this.showRemindOptions = false;
            }
        }
    }
}
</script>

