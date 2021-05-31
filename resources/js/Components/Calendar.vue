<template>

    <div class="w-full mx-auto mb-24 pr-5 calendar-wrapper">
        <div class="flex flex-col items-start sidebar">

            <div class="py-8 mx-auto">
                <h2 class="mb-32 text-2xl font-bold text-gray-400">{{ moment.year() }}</h2>
                <div
                    :class="markCurrentMonth(i)"
                    @click="changeMonth(i)"
                    class="flex justify-start mb-5 text-lg font-semibold text-gray-200 cursor-pointer hover:text-green-400"
                    v-for="(month, i) in months" :key="i"
                >{{ month }}</div>
            </div>
        </div>
        <div class="content">
            <div class="flex mt-8 header">
                <h2 class="py-2 mr-5 text-gray-200 ">Event Type</h2>
                <div class="flex items-center justify-around ">
                    <div class="flex items-center mx-12 text-gray-200">
                        <svg class="w-6 h-6 text-red-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                        <span class="text-xs">Important</span>
                    </div>
                    <div class="flex items-center mx-12 text-gray-200">
                        <svg class="w-6 h-6 text-green-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                        <span class="text-xs">Event</span>
                    </div>
                    <div class="flex items-center mx-12 text-gray-200">
                        <svg class="w-6 h-6 text-indigo-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd"></path></svg>
                        <span class="text-xs">Task</span>
                    </div>
                </div>
            </div>
            <div class="mt-8 calendar">
                <div class="grid grid-cols-2">
                    <h2 class="text-xl text-gray-200">Calendar</h2>
                    <h3 class="text-xl text-green-400">{{ today.format("MMMM") }} {{ moment.year() }}</h3>
                </div>
                <div class="grid grid-cols-7 my-5 text-sm font-semibold text-center text-gray-400">
                    <span>Sunday</span>
                    <span>Monday</span>
                    <span>Tuesday</span>
                    <span>Wednesday</span>
                    <span>Thursday</span>
                    <span>Friday</span>
                    <span>Saturday</span>
                </div>

                <div v-for="(week, i) in currentMonth" :key="i">
                    <div class="grid h-28 grid-cols-7">
                        <div :class="markCurrentDay(day)" class="w-full h-full flex flex-col justify-around pt-2 px-2 border border-gray-500" v-for="(day, i) in week.days" :key="i">
                            <p class="flex justify-end text-lg">
                                {{ day.date() }}
                            </p>

                            <div class="flex items-center h-full">
                                <div v-if="getImportants(day) > 0" class="relative">
                                    <svg class="w-8 h-10 text-red-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                                    <span class="absolute infoPositionImportant bg-gray-600 rounded-full px-1 text-gray-200">{{ getEventsForDate(day) }}</span>
                                </div>

                                <div v-if="getEventsForDate(day) > 0" class="relative">
                                    <svg class="h-12 w-8 text-green-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                                    <span class="absolute infoPositionEvent bg-gray-600 rounded-full px-1 text-gray-200">{{ getEventsForDate(day) }}</span>
                                </div>
                                <div v-if="getTasksForDate(day) > 0" class="relative">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-indigo-500" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd" />
                                    </svg>
                                    <span class="absolute infoPosition bg-gray-600 rounded-full px-1 text-gray-200">{{ getTasksForDate(day) }}</span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
import moment from 'moment';

export default {


    props: {
        allTasks: Array,
        allEvents: Array
    },
    data() {
        return {
            currentMonth: null,
            today: moment(),
            months: null,
            moment: moment(),
            year: moment().year(),
            selectedMonth: moment().month()
        }
    },
    methods: {
        markCurrentDay(day) {
            if (this.moment.date() === day.date() && this.moment.month() === day.month()) {
                return "bg-gray-200 text-gray-700 font-semibold"
            }
            if (day.month() === this.today.month()) {
                return "text-gray-200"
            } else {
                return "opacity-50 text-gray-300"
            }
        },
        changeMonth(month) {
            this.selectedMonth = month;
            let calendar = [];
            this.today = moment(`${this.year}, ${month + 1}`);
            let startDay = this.today.clone().startOf('month').startOf('week');
            let endDay = this.today.clone().endOf('month').endOf('week');

            let date = startDay.clone().subtract(1, 'day');

            while (date.isBefore(endDay, 'day')) {
                calendar.push({
                    days: Array(7).fill(0).map(() => date.add(1, 'day').clone())
                });
            }
            this.currentMonth = calendar;
        },
        markCurrentMonth(i) {
            if (i === this.selectedMonth) {
                return "text-green-400"
            }
        },
        getTasksForDate(day) {
            let specDateTasks = [];

            this.allTasks.filter(task => {
               if (task.spec_date) {
                   if(day.format('YYYY-MM-DD') === moment(task.spec_date).format('YYYY-MM-DD')) {
                       specDateTasks.push(task);
                   }
               }
               if (task.daily) specDateTasks.push(task);
            });
            return specDateTasks.length;
        },
        getEventsForDate(day) {
            let specDateEvents = [];

            this.allEvents.filter(event => {
               if (event.spec_date) {
                   if (day.format('YYYY-MM-DD') === moment(event.spec_date).format('YYYY-MM-DD')) {
                       specDateEvents.push(event);
                   }
               }
               if (event.daily) specDateEvents.push(event);
            });
            return specDateEvents.length;
        },
        getImportants(day) {
            let importants = [];

            this.allEvents.filter(event => {
               if (event.important) {
                   if (day.format('YYYY-MM-DD') === moment(event.spec_date).format('YYYY-MM-DD')) {
                       importants.push(event);
                   }
               }
            });
            return importants.length;
        }
    },
    mounted() {
        const calendar = [];
        const today = moment();
        const startDay = today.clone().startOf('month').startOf('week');
        const endDay = today.clone().endOf('month').endOf('week');

        let date = startDay.clone().subtract(1, 'day');

        while (date.isBefore(endDay, 'day')) {
            calendar.push({
                days: Array(7).fill(0).map(() => date.add(1, 'day').clone())
            });
        }
        this.currentMonth = calendar;
        this.months = moment.months();
    },
}
</script>

<style>
.calendar-wrapper {
    display: grid;
    grid-template-columns: 20% 1fr 1fr 1fr 1fr;
    grid-template-areas: "sidebar cont cont cont" "sidebar cont cont cont" "sidebar cont cont cont";
}
.sidebar {
    grid-area: sidebar;
    grid-column: 1 / 2;
}
.content {
    grid-area: cont;
    grid-column: 2 / -1;
}
.header {
    grid-area: header;
}
.calendar {
    grid-area: calendar;
}
.infoPosition {
    top: -20px;
    left: -2px;
    font-weight: 600;
}
.infoPositionEvent {
    top: -12px;
    left: -2px;
    font-weight: 600;
}
.infoPositionImportant {
    top: -15px;
    left: -2px;
    font-weight: 600;
}
</style>

