<template>
    <div class="mb-4 mx-0 xl:mr-4">
        <div class="shadow-lg rounded-2xl height bg-white dark:bg-gray-700 w-full">
            <div class="font-bold text-md border-b border-gray-100 flex items-center justify-between p-4 text-black dark:text-white">
                <div>
                    <span v-if="isTodayDate()" class="text-blue-500">
                        Today's <span class="text-gray-600">Tasks</span>
                    </span>
                    <span v-else class="text-blue-500">{{ formatDate() }} <span class="text-gray-600">Tasks</span></span>
                    <span class="text-sm text-gray-500 dark:text-gray-300 dark:text-white ml-2">
                        ({{ tasks.length }})
                    </span>
                </div>
                <inertia-link :href="route('create', { show: 'create-task' })" class="flex items-center bg-blue-500 text-white py-1 cursor-pointer rounded-md shadow px-2">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd">
                        </path>
                    </svg>
                    Add
                </inertia-link>
            </div>
            <ul>
                <li v-for="task in tasks" :key="task.id">
                    <today-task-component :task="task" />
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
import JetCheckbox from '@/Jetstream/Checkbox';
import JetDialogModal from '@/Jetstream/DialogModal';
import JetSecondaryButton from '@/Jetstream/SecondaryButton';
import JetLabel from '@/Jetstream/Label';
import JetInput from '@/Jetstream/Input';
import JetButton from '@/Jetstream/Button';
import CustomCheckBox from "@/Jetstream/CustomCheckBox";
import TodayTaskComponent from "@/Components/TodayTaskComponent";
import moment from 'moment';
import flatPickr from 'vue-flatpickr-component';

export default {
    components: {
      JetCheckbox,
      JetDialogModal,
      JetSecondaryButton,
      JetInput,
      JetLabel,
      JetButton,
      flatPickr,
      CustomCheckBox,
      TodayTaskComponent
    },
    props: {
        tasks: Array,
        date: Object
    },
    methods: {
        isTodayDate() {
           return moment(this.date).format("D MMMM YYYY") === moment().format("D MMMM YYYY");
        },
        formatDate() {
            return moment(this.date).format("DD MMMM YYYY");
        }
    }
}
</script>

<style>
    .height {
        height: 455px;
    }
</style>
