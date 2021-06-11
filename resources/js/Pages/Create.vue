<template>
    <light-layout>
        <template #content>
            <div class="my-12 w-full">

                <!-- Create Task Head -->
                <div @click="toggleCreateTaskForm" class="w-full mb-5 h-16 flex items-center justify-between rounded-md shadow bg-white px-5 hover:text-blue-500 cursor-pointer">
                    <div class="h-full flex items-center text-gray-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                        <span class="text-base font-semibold">Create New Task</span>
                    </div>

                    <svg v-if="!showCreateTaskForm" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 cursor-pointer" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 13l-7 7-7-7m14-8l-7 7-7-7" />
                    </svg>

                    <svg v-if="showCreateTaskForm" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 cursor-pointer" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 11l7-7 7 7M5 19l7-7 7 7" />
                    </svg>
                </div>

                <!-- Create Task Form -->
                <div v-if="showCreateTaskForm" class="mx-auto mb-5 lg:px-6">
                    <create-task :date="date" />
                </div>

                <!-- Create Event Head -->
                <div @click="toggleCreateEventForm" class="w-full mb-5 h-16 flex items-center justify-between rounded-md shadow bg-white px-5 hover:text-blue-500 cursor-pointer">
                    <div class="h-full flex items-center text-gray-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fillRule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clipRule="evenodd" />
                        </svg>
                        <span class="text-base font-semibold">Create New Event</span>
                    </div>

                    <svg v-if="!showCreateEventForm" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 cursor-pointer" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 13l-7 7-7-7m14-8l-7 7-7-7" />
                    </svg>

                    <svg v-if="showCreateEventForm" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 cursor-pointer" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 11l7-7 7 7M5 19l7-7 7 7" />
                    </svg>
                </div>

                <!-- Create Event Form -->
                <div v-if="showCreateEventForm" class="mx-auto mb-5 lg:px-6">
                    <create :date="date" />
                </div>

                <!-- Create Personal Stuff Head -->
                <div @click="toggleCreatePersonalStuffForm" class="w-full mb-5 h-16 flex items-center justify-between rounded-md shadow bg-white px-5 hover:text-blue-500 cursor-pointer">
                    <div class="h-full flex items-center text-gray-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <span class="text-base font-semibold">Create Personal Stuff</span>
                    </div>

                    <svg v-if="!showCreatePersonalForm" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 cursor-pointer" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 13l-7 7-7-7m14-8l-7 7-7-7" />
                    </svg>

                    <svg  v-if="showCreatePersonalForm" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 cursor-pointer" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 11l7-7 7 7M5 19l7-7 7 7" />
                    </svg>
                </div>

                <!-- Create Personal Stuff Form -->
                <div v-if="showCreatePersonalForm" class="mx-auto mb-5 lg:px-6">
                    <create-personal />
                </div>
            </div>
        </template>
    </light-layout>
</template>

<script>
import LightLayout from '@/Layouts/LightLayout';
import JetFormSection from '@/Jetstream/FormSection';
import JetLabel from '@/Jetstream/Label';
import JetInput from '@/Jetstream/Input';
import JetInputError from '@/Jetstream/InputError';
import JetActionMessage from '@/Jetstream/ActionMessage';
import JetButton from '@/Jetstream/Button';
import JetCheckbox from '@/Jetstream/Checkbox';

import CreateTask from '@/Pages/CreateTask';
import Create from '@/Pages/Events/Create';
import CreatePersonal from '@/Pages/Personal/Create';
import flatPickr from 'vue-flatpickr-component';

export default {
    components: {
        LightLayout,
        JetFormSection,
        JetLabel,
        JetInput,
        JetInputError,
        JetActionMessage,
        JetButton,
        JetCheckbox,
        flatPickr,
        CreateTask,
        Create,
        CreatePersonal
    },
    props: {
      show: String,
      date: String
    },
    data() {
        return {
            showCreateTaskForm: false,
            showCreateEventForm: false,
            showCreatePersonalForm: false,
        }
    },
    methods: {
        toggleCreateTaskForm() {
            console.log(this.showCreateTaskForm);
            this.showCreateTaskForm = !this.showCreateTaskForm;
        },
        toggleCreateEventForm() {
            console.log(this.showCreateEventForm)
            this.showCreateEventForm = !this.showCreateEventForm;
        },
        toggleCreatePersonalStuffForm() {
            console.log(this.showCreatePersonalForm);
            this.showCreatePersonalForm = !this.showCreatePersonalForm;
        }
    },
    mounted() {
        if (this.show === 'create-task') {
            this.showCreateTaskForm = true;
        }
        if (this.show === 'create-event') {
            this.showCreateEventForm = true;
        }
        if (this.show === 'create-stuff') {
            this.showCreatePersonalForm = true;
        }
    }
}
</script>

