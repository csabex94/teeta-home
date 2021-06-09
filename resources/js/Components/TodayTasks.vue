<template>
    <div class="mb-4 mx-0  xl:mr-4">
        <div class="shadow-lg rounded-2xl  bg-white dark:bg-gray-700 w-full">
            <div class="font-bold text-md  rounded-t-2xl border-b shadow border-gray-100 flex items-center justify-between p-4 text-black dark:text-white">
                <div>
                    <span v-if="isTodayDate()" @click="setListToUncompleted" :class="markCurrentCompletedList()" class="text-gray-500 cursor-pointer hover:text-blue-500">
                        Today's Tasks ({{ uncompletedTasks() }})
                    </span>
                    <span v-else class="text-blue-500">{{ formatDate() }} <span class="text-gray-600">Tasks</span></span>
                </div>
                <div>
                    <span
                        v-if="isTodayDate()"
                        @click="setListToCompleted"
                        class="text-gray-500 cursor-pointer hover:text-blue-500 dark:text-gray-300 dark:text-white ml-2"
                        :class="markCurrentUncompletedList()"
                    >Completed Tasks ({{ completedTasks.length }}) </span>
                </div>
                <inertia-link :href="route('create', { show: 'create-task', date: formatDate(date) })" class="flex items-center bg-blue-500 text-white py-1 cursor-pointer rounded-md shadow px-2">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd">
                        </path>
                    </svg>
                    Add
                </inertia-link>
            </div>
            <div class="overflow-y-scroll rounded-b-2xl height">
                <ul v-if="taskListType === 'uncompleted'">
                    <li v-if="uncompletedTasks() > 0" v-for="task in getUncompletedTasks()" :key="task.id">
                        <today-task-component :task="task" />
                    </li>
                    <span v-else class="block text-center text-gray-500 font-semibold text-lg mt-5">No tasks.</span>
                </ul>
                <ul v-if="taskListType === 'completed' && isTodayDate()">
                    <li v-if="completedTasks.length > 0" v-for="task in completedTasks" :key="task.id">
                        <today-task-component :task="task" />
                    </li>
                    <span v-else class="block text-center text-gray-500 font-semibold text-lg mt-5">No completed tasks yet.</span>
                </ul>
            </div>

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
        date: Object,
        completedTasks: Array,
        taskListType: String
    },
    methods: {
        isTodayDate() {
           return moment(this.date).format("D MMMM YYYY") === moment().format("D MMMM YYYY");
        },
        formatDate() {
            return moment(this.date).format("DD MMMM YYYY");
        },
        uncompletedTasks() {
            return this.tasks.filter(task => {
                if (!task.completed) {
                    return task;
                }
            }).length;
        },
        setListToCompleted() {
            this.$emit('listType', 'completed')
        },
        setListToUncompleted() {
            this.$emit('listType', 'uncompleted')
        },
        markCurrentCompletedList() {
            if (this.taskListType === 'uncompleted') {
                return "text-blue-500"
            }
        },
        markCurrentUncompletedList() {
            if (this.taskListType === 'completed') {
                return "text-blue-500"
            }
        },
        getUncompletedTasks() {
            return this.tasks.filter(task => {
                if (!task.completed) {
                    return task;
                }
            })
        },

    }
}
</script>

<style>
/* width */
.height::-webkit-scrollbar {
    width: 6px;
}

/* Track */
.height::-webkit-scrollbar-track {
    background: #f1f1f1;
}

/* Handle */
.height::-webkit-scrollbar-thumb {
    background: #3B82F6;
    border-radius: 25px;
}

/* Handle on hover */
.height::-webkit-scrollbar-thumb:hover {
    background: #555;
}
.height {
    height: 385px;
    max-height: 385px;
}
</style>

