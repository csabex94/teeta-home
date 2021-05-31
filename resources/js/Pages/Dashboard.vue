<template>
    <app-layout>
        <template #content>
           <div class="w-full">
                <calendar :allTasks="allTasks" :allEvents="allEvents" />
                <div class="grid w-full mx-auto grid-cols-2 gap-4 pr-5">
                    <daily-events :events="events" />
                    <today-tasks :tasks="tasks" />
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

    import Calendar from "@/Components/Calendar";
    import moment from 'moment';


    export default {
        components: {
            AppLayout,
            JetCheckbox,
            TodayTasks,
            UpcomingTasks,
            Calendar,
            DailyEvents
        },
        props: {
          tasks: Array,
          upcomingTasks: Array,
          allTasks: Array,
          allEvents: Array,
          events: Array
        }
    }
</script>
