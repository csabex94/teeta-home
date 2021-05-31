<template>
    <app-layout>
        <template #content>
           <div class="w-full">
               <div class="mx-auto">
                   <div class="grid grid-cols-2 my-10 gap-4">
                       <daily-events :date="today" :events="eventList" />
                       <today-tasks :date="today" :tasks="taskList" />
                   </div>
               </div>
                <calendar @data="setData" :allTasks="allTasks" :allEvents="allEvents" />

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
            JetSectionBorder
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
                this.today = `${value.day.year()} ${value.day.month()} ${value.day.date()}`
            }
        },
        mounted() {
            this.today = moment().format('YYYY MMMM d');
        },

    }
</script>
