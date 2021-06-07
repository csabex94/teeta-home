<template>
    <app-layout :today="today" :eventList="eventList" :taskList="taskList">
        <template #content>
           <div>
               <div class="w-full">
                    <calendar @data="setData" :allTasks="allTasks" :allEvents="allEvents" />
                </div>

                <div class="grid grid-cols-2 mt-16">
                    <today-tasks :tasks="tasks" :date="today" />
                    <daily-events :events="events" />
                </div>
           </div>
        </template>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import JetCheckbox from '@/Jetstream/Checkbox';
    import TodayTasks from '@/Components/TodayTasks';
    import UpcomingTasks from "@/Components/UpcomingTasks";
    import DailyEvents from "@/Components/DailyEvents";
    import JetSectionBorder from '@/Jetstream/SectionBorder';
    import Calendar from "@/Components/Calendar";
    import moment from 'moment';

    export default {
        components: {
            AppLayout,
            JetCheckbox,
            TodayTasks,
            UpcomingTasks,
            Calendar,
            DailyEvents,
            JetSectionBorder,
        },
        props: {
          tasks: Array,
          upcomingTasks: Array,
          allTasks: Array,
          allEvents: Array,
          events: Array
        },
        data() {
          return {
              taskList: this.tasks,
              eventList: this.events,
              importantList: null,
              today: null
          }
        },
        methods: {
            setData(value) {
                this.taskList = value.todayTasks;
                this.eventList = value.todayEvents;
                this.today = value.day;
            }
        },
        mounted() {
            this.today = moment();
        },

    }
</script>
