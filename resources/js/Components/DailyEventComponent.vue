<template>
    <div :class="highlightCompleted()" class="flex h-20 items-center dark:text-gray-200 justify-between py-3 border-b-2 border-gray-100 dark:border-gray-800">
        <div class="flex flex-col items-start mx-4 justify-start text-sm">
            <span v-if="currentEvent.important" class="flex items-center font-semibold text-xs text-red-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Important
            </span>
            <span class="font-semibold" :class="lineTroughEvent()">
                {{ currentEvent.title }} <span v-if="currentEvent.spec_time" :class="lineTroughEvent()"> - {{ formatTime(currentEvent.spec_time) }}</span>
            </span>
            <span class="text-xs text-blue-500" :class="lineTroughEvent()" v-if="currentEvent.remind_before_option && currentEvent.remind_before_value">Remind before: {{ currentEvent.remind_before_value }} {{ currentEvent.remind_before_option }}</span>
            <span class="text-xs text-gray-600" :class="lineTroughEvent()">{{ currentEvent.description }}</span>
        </div>
        <custom-check-box @click="toggleCheckbox" :status="status" :checked="checkbox" />
    </div>
</template>

<script>
import CustomCheckBox from "@/Jetstream/CustomCheckBox";
import moment from "moment";

export default {
    components: {
        CustomCheckBox,
    },
    props: {
        event: Object
    },
    data() {
        return {
            checkbox: false,
            currentEvent: this.event,
            status: null
        }
    },
    methods: {
        toggleCheckbox() {
            this.checkbox = !this.checkbox;
        },
        formatTime(time) {
            return moment(time,'h:mm:ss').format('HH:mm A');
        },
        lineTroughEvent() {
            if (this.currentEvent.completed) {
                return "line-through"
            }
        },
        highlightCompleted() {
            if (this.event.completed) return "bg-gray-100"
        },
        completeEvent() {
            if (!this.currentEvent.completed && ((moment(this.currentEvent.spec_date).format("D MMM YYYY") === moment().format("D MMM YYYY")) || this.currentEvent.daily)) {
                this.$inertia.get(route('complete.event', {eventId: this.currentEvent.id}), {
                    onSuccess: () => {}
                })
            } else {
                this.checkbox = false;
            }
        }
    },
    watch: {
        checkbox(value) {
            if (value === true && this.status !== 'completed') {
                this.completeEvent();
            }
        }
    },
    mounted() {
        if (this.event.completed) {
            this.status = 'completed';
        }
    }
}
</script>
