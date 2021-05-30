<template>
    <app-layout>
        <template #content>
           <div class="w-full">
                <calendar :allTasks="allTasks" />
                <div class="grid w-full grid-cols-2 gap-4">
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
    import Calendar from '@/Components/Calendar';

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
          upcomingTasks: Array,
          allTasks: Array
        }
    }
</script>
