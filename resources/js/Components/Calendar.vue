<template>
    <div class="w-full mx-auto mb-4 calendar-wrapper">
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
                        <div class="w-4 h-4 mr-2 bg-red-400 rounded-full" />
                        <span class="text-xs">Important</span>
                    </div>
                    <div class="flex items-center mx-12 text-gray-200">
                        <div class="w-4 h-4 mr-2 bg-green-400 rounded-full" />
                        <span class="text-xs">Event</span>
                    </div>
                    <div class="flex items-center mx-12 text-gray-200">
                        <div class="w-4 h-4 mr-2 bg-indigo-400 rounded-full" />
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
                    <span>Tursday</span>
                    <span>Friday</span>
                    <span>Saturday</span>
                </div>

                <div v-for="(week, i) in currentMonth" :key="i">
                    <div class="grid h-24 grid-cols-7">
                        <div :class="markCurrentDay(day)" class="w-full h-full p-2 border border-gray-500" v-for="(day, i) in week.days" :key="i">
                            <p class="flex justify-end text-lg">{{ day.date() }}</p>
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
        allTasks: Array
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
        console.log(moment(moment.months()[0]))
    },
    
}
</script>

<style>
.calendar-wrapper {
    display: grid;
    grid-template-columns: 25% 1fr 1fr 1fr 1fr;
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
</style>