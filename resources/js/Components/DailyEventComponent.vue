<template>
    <div :class="highlightCompleted()" class="flex h-20 items-center dark:text-gray-200 justify-between hover:bg-gray-100 py-3 border-b-2 border-gray-100 dark:border-gray-800">
        <div class="flex flex-col items-start mx-4 justify-start text-sm">
            <span class="font-semibold" :class="lineTroughEvent()">
                {{ event.title }} <span v-if="event.spec_time" :class="lineTroughEvent()"> - {{ formatTime(event.spec_time) }}</span>
            </span>
            <span class="text-xs text-green-400" :class="lineTroughEvent()" v-if="event.remind_before_option && event.remind_before_value">Remind before: {{ event.remind_before_value }} {{ event.remind_before_option }}</span>
            <span class="text-xs text-gray-600" :class="lineTroughEvent()">{{ event.description }}</span>
        </div>
        <custom-check-box @click="toggleCheckbox" :checked="checkbox" />
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
            checkbox: false
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
            if (this.checkbox) {
                return "line-through"
            }
        },
        highlightCompleted() {
            if (this.event.completed) return "bg-gray-100"
        }
    }
}
</script>
