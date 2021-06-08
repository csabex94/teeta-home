<template>
    <div class="mb-4 mx-0 xl:mr-4">
        <div class="shadow-lg rounded-2xl bg-white dark:bg-gray-700 w-full">
            <p class="font-bold text-md p-4 text-black dark:text-white">
                <span class="text-blue-500">
                    Today's Tasks
                </span>
                <span class="text-sm text-gray-500 dark:text-gray-300 dark:text-white ml-2">
                    ({{ tasks.length }})
                </span>
            </p>
            <ul>
                <li v-for="task in tasks" :key="task.id" class="flex h-20 items-center dark:text-gray-200 justify-between py-3 border-t-2 border-gray-100 dark:border-gray-800">
                    <div class="flex flex-col items-start mx-4 justify-start text-sm">
                        <span class="font-semibold">
                            {{ task.title }} <span v-if="task.spec_time"> - {{ formatTime(task.spec_time) }}</span>
                        </span>
                        <span class="text-xs text-blue-500" v-if="task.remind_before_option && task.remind_before_value">Remind before: {{ task.remind_before_value }} {{ task.remind_before_option }}</span>
                        <span class="text-xs text-gray-600">{{ task.description }}</span>
                    </div>
                    <custom-check-box @click="toggleCheckbox" :checked="checkbox" />
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
import flatPickr from 'vue-flatpickr-component';
import moment from 'moment';

export default {
    components: {
      JetCheckbox,
      JetDialogModal,
      JetSecondaryButton,
      JetInput,
      JetLabel,
      JetButton,
      flatPickr,
      CustomCheckBox
    },
    props: {
        tasks: Array,
    },
    data() {
      return {
          showTaskDescription: false,
          task: null,
          checkbox: false
      }
    },
    methods: {
        toggleCheckbox() {
            this.checkbox = !this.checkbox;
        },
        formatTime(time) {
            return moment(time,'h:mm:ss').format('HH:mm A');
        }
    }
}
</script>

