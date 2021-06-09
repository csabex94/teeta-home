<template>
    <div class="mb-4 mx-0 xl:mr-4">
        <div class="shadow-lg rounded-2xl bg-white dark:bg-gray-700 w-full">
            <div class="font-bold shadow border-b rounded-t-2xl flex items-center justify-between border-gray-100 p text-md p-4 text-black dark:text-white">
                <div>
                    <span v-if="isTodayDate()" @click="setListToUncompleted" :class="markCurrentCompletedList()" class="text-gray-500 cursor-pointer hover:text-green-400">
                        Today's Events ({{ uncompletedEvents() }})
                    </span>
                    <span v-else class="text-green-400">{{ formatDate() }} <span class="text-gray-600">Events</span></span>
                </div>
                <div>
                    <span
                        v-if="isTodayDate()"
                        @click="setListToCompleted"
                        class="text-gray-500 cursor-pointer hover:text-green-400 dark:text-gray-300 dark:text-white ml-2"
                        :class="markCurrentUncompletedList()"
                    >Completed Events ({{ completedEvents.length }}) </span>
                </div>

                <inertia-link :href="route('create', {show: 'create-event', date: formatDate(date)})" class="flex items-center bg-green-400 text-white py-1 cursor-pointer rounded-md shadow px-2">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd">
                        </path>
                    </svg>
                    Add
                </inertia-link>
            </div>
            <div class="eventHeight rounded-2xl overflow-y-scroll">
                <ul v-if="eventListType === 'uncompleted'">
                    <li v-if="uncompletedEvents() > 0" v-for="event in getUncompletedEvents()" :key="event.id">
                        <daily-event-component :event="event" />
                    </li>
                    <span v-else class="block text-center text-gray-500 font-semibold text-lg mt-5">No events.</span>
                </ul>
                <ul v-if="eventListType === 'completed' && isTodayDate()">
                    <li v-if="completedEvents.length > 0" v-for="event in completedEvents" :key="event.id">
                        <daily-event-component :event="event" />
                    </li>
                    <span v-else class="block text-center text-gray-500 font-semibold text-lg mt-5">No completed events yet.</span>
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
import DailyEventComponent from "@/Components/DailyEventComponent";
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
        CustomCheckBox,
        DailyEventComponent
    },
    props: {
        events: Array,
        date: Object,
        completedEvents: Array,
        eventListType: String
    },
    data() {
        return {
            event: null,
            checkbox: false
        }
    },
    methods: {
        isTodayDate() {
            return moment(this.date).format("D MMMM YYYY") === moment().format("D MMMM YYYY");
        },
        formatDate() {
            return moment(this.date).format("DD MMMM YYYY");
        },
        setListToCompleted() {
            this.$emit('listType', 'completed')
        },
        setListToUncompleted() {
            this.$emit('listType', 'uncompleted')
        },
        uncompletedEvents() {
            return this.events.filter(event => {
                if (!event.completed) {
                    return event;
                }
            }).length;
        },
        markCurrentCompletedList() {
            if (this.eventListType === 'uncompleted') {
                return "text-green-400"
            }
        },
        markCurrentUncompletedList() {
            if (this.eventListType === 'completed') {
                return "text-green-400"
            }
        },
        getUncompletedEvents() {
            return this.events.filter(event => {
                if (!event.completed) {
                    return event;
                }
            })
        },
    }
}
</script>

<style>
/* width */
.eventHeight::-webkit-scrollbar {
    width: 6px;
}

/* Track */
.eventHeight::-webkit-scrollbar-track {
    background: #f1f1f1;
}

/* Handle */
.eventHeight::-webkit-scrollbar-thumb {
    background: #34D399;
    border-radius: 25px;
}

/* Handle on hover */
.eventHeight::-webkit-scrollbar-thumb:hover {
    background: #555;
}
.eventHeight {
    height: 385px;
    max-height: 385px;
}
</style>
