<template>
    <app-layout>
        <template #content>
           <div>
               <calendar />
               <div class="w-full grid grid-cols-2 gap-4">
                   <today-tasks :tasks="tasks" />
                   <upcoming-tasks :upcomingTasks="upcomingTasks" />
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

    import Calendar from "@/Components/Calendar";
    import moment from 'moment';


    export default {
        components: {
            AppLayout,
            JetCheckbox,
            TodayTasks,
            UpcomingTasks,
            Calendar
        },
        props: {
          tasks: Array,
          upcomingTasks: Array
        },
        data() {
            return {
                months: null,
                currentMonth: null,
            }
        },
        mounted() {
            this.currentMonth = moment.months()[moment().month()];
            this.months = moment.months();
        },
    }
</script>
