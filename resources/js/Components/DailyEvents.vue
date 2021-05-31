<template>
    <div class="w-full h-full">
        <span class="mb-5 text-xl flex items-center justify-center text-gray-200">Today's <p class="text-green-400 ml-2">Events</p></span>
        <span v-if="events.length <= 0" class="block text-sm text-center text-gray-200">Not events for today.</span>

        <div v-for="event in events" :key="event.id" class="h-24 px-2 mb-2 text-white bg-gray-700 rounded-md shadow-lg">
            <div class="flex items-center justify-between h-full px-2">
                <div>
                    <span class="font-semibold text-green-400">{{ event.title }}<span v-if="event.spec_time"> - {{ getFormattedTime(event.spec_time) }}</span></span>
                    <p class="text-xs">{{ getReducedDescription(event.description) }}</p>
                </div>
                <div class="flex items-center">

                    <div class="flex flex-col items-center cursor-pointer hover:text-green-400">
                        <jet-checkbox />
                    </div>
                </div>
            </div>
        </div>

        <jet-dialog-modal :show="showTaskDescription" >
            <template #title>
                {{ task.title }}
                <span v-if="event.spec_date"> - {{ getFormattedDate(event.spec_date) }} | {{ getFormattedTime(event.spec_time) }}</span>
                <span v-else> - Daily</span>
            </template>
            <template #content>{{ event.description }}</template>
            <template #footer><jet-secondary-button >Close</jet-secondary-button></template>
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
        events: Array
    },
    data() {
        return {
            showTaskDescription: false,
            event: null
        }
    },
    methods: {
        getReducedDescription(text) {
            if (text.length > 80) {
                return text.substr(0, 80) + " ..."
            } else {
                return text
            }
        },

        getFormattedDate(date) {
            return  moment(date).format('dddd, MMMM Do YYYY')
        },
        getFormattedTime(time) {
            return moment(time,'h:mm:ss').format('HH:mm A');
        },
    }
}
</script>
