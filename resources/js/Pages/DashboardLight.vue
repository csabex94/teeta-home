<template>
    <light-layout>
        <template #content>
            <div class="pr-2 pl-2 md:pt-0 md:pr-0 md:pl-0">
                <div class="flex flex-col flex-wrap sm:flex-row ">
                    <div class="w-full sm:w-1/2 xl:w-1/2">
                        <today-tasks @listType="setTaskListType" :tasks="taskList" :completedTasks="completedTasks" :date="today" :taskListType="taskListType" />
                        <daily-events @listType="setEventListType" :events="eventList" :completedEvents="completedEvents" :date="today" :eventListType="eventListType" />
                    </div>

                   <div class="w-full sm:w-1/2 md:w-1/2">
                        <calendar-mini @data="setData" :allTasks="allTasks" :allEvents="allEvents" />
                        <personal-stuff />
                   </div>
                </div>
            </div>
        </template>
    </light-layout>
</template>

<script>
    import LightLayout from '@/Layouts/LightLayout';
    import CalendarMini from '@/Components/CalendarMini'
    import PersonalStuff from '@/Components/PersonalStuff';
    import TodayTasks from "@/Components/TodayTasks";
    import DailyEvents from "@/Components/DailyEvents";

    import moment from 'moment';

    export default {
        components: {
            LightLayout,
            CalendarMini,
            PersonalStuff,
            TodayTasks,
            DailyEvents
        },
        props: {
            tasks: Array,
            upcomingTasks: Array,
            allTasks: Array,
            allEvents: Array,
            events: Array,
            completedTasks: Array,
            completedEvents: Array
        },
        data() {
            return {
                taskList: this.allTasks,
                eventList: this.allEvents,
                importantList: null,
                today: moment(),
                taskListType: 'uncompleted',
                eventListType: 'uncompleted'
            }
        },
        methods: {
            setData(value) {
                this.today = value.day;
                this.taskList = value.todayTasks ? value.todayTasks : this.tasks;
                this.eventList = value.todayEvents ? value.todayEvents : this.events;
                this.taskListType = 'uncompleted';
                this.eventListType = 'uncompleted';
            },
            setTaskListType(value) {
                this.taskListType = value;
            },
            setEventListType(value) {
                this.eventListType = value;
            }
        },
    }
</script>

