<template>
    <app-layout-new :today="today" :eventList="eventList" :taskList="taskList">
        <template #content>
           <div class="w-full">
               <calendar @data="setData" :allTasks="allTasks" :allEvents="allEvents" />
           </div>
        </template>
    </app-layout-new>
</template>

<script>
    import AppLayoutNew from '@/Pages/AppLayoutNew'
    import JetCheckbox from '@/Jetstream/Checkbox';
    import TodayTasks from '@/Components/TodayTasks';
    import UpcomingTasks from "@/Components/UpcomingTasks";
    import DailyEvents from "@/Components/DailyEvents";
    import JetSectionBorder from '@/Jetstream/SectionBorder';
    import Calendar from "@/Components/Calendar";
    import moment from 'moment';

    export default {
        components: {
            AppLayoutNew,
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
