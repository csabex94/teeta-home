<template>
    <div class="w-full h-full">
        <span class="mb-5 text-xl flex items-center justify-center text-gray-200">Today's <p class="text-green-400 ml-2">Tasks</p></span>
        <span v-if="tasks.length <= 0" class="block text-center text-sm text-gray-200">Not tasks for today.</span>

        <div v-for="task in tasks" :key="task.id" class="h-24 px-2 mb-2 text-white bg-gray-700 rounded-md shadow-lg">
            <div class="flex items-center justify-between h-full px-2">
                <div>
                    <span class="font-semibold text-green-400">{{ task.title }}<span v-if="task.spec_time"> - {{ getFormattedTime(task.spec_time) }}</span></span>
                    <p class="text-xs">{{ getReducedDescription(task.description) }}</p>
                </div>
                <div class="flex items-center">

                    <div class="flex flex-col items-center cursor-pointer hover:text-green-400">
                        <jet-checkbox  @change="completeTask(task.id)" />
                    </div>
                </div>
            </div>
        </div>

        <jet-dialog-modal :show="showTaskDescription" @close="closeDescriptionModal">
            <template #title>
                {{ task.title }}
                <span v-if="task.spec_date"> - {{ getFormattedDate(task.spec_date) }} | {{ getFormattedTime(task.spec_time) }}</span>
                <span v-else> - Daily</span>
            </template>
            <template #content>{{ task.description }}</template>
            <template #footer><jet-secondary-button @click="closeDescriptionModal">Close</jet-secondary-button></template>
        </jet-dialog-modal>

    </div>
</template>

<script>
import JetCheckbox from '@/Jetstream/Checkbox';
import JetDialogModal from '@/Jetstream/DialogModal';
import JetSecondaryButton from '@/Jetstream/SecondaryButton';
import JetLabel from '@/Jetstream/Label';
import JetInput from '@/Jetstream/Input';
import JetButton from '@/Jetstream/Button';
import flatPickr from 'vue-flatpickr-component';
import moment from "moment";

export default {
    components: {
      JetCheckbox,
      JetDialogModal,
      JetSecondaryButton,
      JetInput,
      JetLabel,
      JetButton,
      flatPickr
    },
    props: {
        tasks: Array,
        date: String
    },
    data() {
      return {
          showTaskDescription: false,
          task: null
      }
    },
    methods: {
        completeTask(taskId) {
            this.$inertia.put(route('complete.task', { taskId: taskId }, {
                onSuccess: () => {}
            }))
        },
        getReducedDescription(text) {
            if (text.length > 80) {
                return text.substr(0, 80) + " ..."
            } else {
                return text
            }
        },
        openDescriptionModal(task) {
            this.task = task;
            this.showTaskDescription = true;
        },
        closeDescriptionModal() {
            this.task = null;
            this.showTaskDescription = false;
        },
        getFormattedDate(date) {
            return  moment(date).format('dddd, MMMM Do YYYY')
        },
        getFormattedTime(time) {
            return moment(time,'h:mm:ss').format('HH:mm A');
        },
        checkForToday() {
            return this.date;
        }
    }
}
</script>

