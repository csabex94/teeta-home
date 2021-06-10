<template>

        <div class="mb-4">
            <div class="shadow-lg w-full rounded-2xl p-4 bg-white dark:bg-gray-700">
                <div class="w-full">
                    <div class="w-full rounded">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center space-x-4">
                                <button @click="decrementYear" class="p-2 rounded-full bg-blue-500 text-white">
                                    <svg width="15" height="15" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill="currentColor" d="M13.83 19a1 1 0 0 1-.78-.37l-4.83-6a1 1 0 0 1 0-1.27l5-6a1 1 0 0 1 1.54 1.28L10.29 12l4.32 5.36a1 1 0 0 1-.78 1.64z">
                                        </path>
                                    </svg>
                                </button>
                                <span class="text-lg font-semibold text-gray-700">{{ currentYear }}</span>
                                <button @click="incrementYear" class="p-2 rounded-full bg-blue-500 text-white">
                                    <svg width="15" height="15" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill="currentColor" d="M10 19a1 1 0 0 1-.64-.23a1 1 0 0 1-.13-1.41L13.71 12L9.39 6.63a1 1 0 0 1 .15-1.41a1 1 0 0 1 1.46.15l4.83 6a1 1 0 0 1 0 1.27l-5 6A1 1 0 0 1 10 19z">
                                        </path>
                                    </svg>
                                </button>
                            </div>

                            <!-- Calendar Month dropdown -->
                            <div class="flex items-center">
                                <button @click="decrementMonth" class="p-2 rounded-full bg-blue-500 text-white">
                                    <svg width="15" height="15" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill="currentColor" d="M13.83 19a1 1 0 0 1-.78-.37l-4.83-6a1 1 0 0 1 0-1.27l5-6a1 1 0 0 1 1.54 1.28L10.29 12l4.32 5.36a1 1 0 0 1-.78 1.64z">
                                        </path>
                                    </svg>
                                </button>
                                <div v-clickoutside="closeMonthsList" class="relative mx-2 inline-block text-left">
                                    <button @click="openMonthsList" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none" aria-expanded="true" aria-haspopup="true">
                                        {{ selectedMonth }}
                                        <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </button>

                                    <div v-if="showMonthsList" class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                                        <span
                                            v-for="(month, i) in months"
                                            :key="i"
                                            @click="changeMonth(month, i)"
                                            :class="markCurrentMonth(i)"
                                        >
                                            {{ month }}
                                        </span>
                                    </div>
                                </div>
                                <button @click="incrementMonth" class="p-2 rounded-full bg-blue-500 text-white">
                                    <svg width="15" height="15" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill="currentColor" d="M10 19a1 1 0 0 1-.64-.23a1 1 0 0 1-.13-1.41L13.71 12L9.39 6.63a1 1 0 0 1 .15-1.41a1 1 0 0 1 1.46.15l4.83 6a1 1 0 0 1 0 1.27l-5 6A1 1 0 0 1 10 19z">
                                        </path>
                                    </svg>
                                </button>
                            </div>
                            <!-- Calendar Month dropdown -->

                            <span @click="setCalendar" class="border cursor-pointer hover:bg-gray-100 text-sm py-2 px-3 rounded-md flex items-center border-gray-300">
                                Today
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2 text-gray-700" viewBox="0 0 20 20" fill="currentColor">
                                  <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd" />
                                </svg>
                            </span>

                        </div>
                        <div class="mx-2">
                            <table class="w-full dark:text-white">
                                <tr>
                                    <th class="py-3 px-2 md:px-3 ">
                                        Sun
                                    </th>
                                    <th class="py-3 px-2 md:px-3 ">
                                        Mon
                                    </th>
                                    <th class="py-3 px-2 md:px-3 ">
                                        Tue
                                    </th>
                                    <th class="py-3 px-2 md:px-3 ">
                                        Wed
                                    </th>
                                    <th class="py-3 px-2 md:px-3 ">
                                        Thu
                                    </th>
                                    <th class="py-3 px-2 md:px-3 ">
                                        Fri
                                    </th>
                                    <th class="py-3 px-2 md:px-3 ">
                                        Sat
                                    </th>
                                </tr>
                                <tr v-for="(week, i) in currentMonth" :key="i">
                                    <td class="py-3 px-2 md:px-3 " v-for="(day, i) in week.days" :key="i">
                                        <span
                                            @click="changeDay(day)"
                                            class="p-2 rounded-md flex cursor-pointer hover:bg-gray-700 hover:text-white items-center justify-center"
                                            :class="markCurrentDay(day)"
                                        >{{ day.date() }}</span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</template>

<script>
    import moment from 'moment';
    import JetDropdown from '@/Jetstream/Dropdown';

    export default {
        directives: {
            clickoutside: {
                beforeMount: (el, binding) => {
                    el.clickOutsideEvent = event => {
                        // here I check that click was outside the el and his children
                        if (!(el === event.target || el.contains(event.target))) {
                            // and if it did, call method provided in attribute value
                            binding.value();
                        }
                    };
                    document.addEventListener("click", el.clickOutsideEvent);
                },
                unmounted: el => {
                    document.removeEventListener("click", el.clickOutsideEvent);
                },
            },
        },
        components: {
            JetDropdown
        },
        props: {
          allTasks: Array,
          allEvents: Array
        },
        data() {
            return {
                currentMonth: null,
                months: null,
                today: moment(),
                selectedMonth: moment().month(),
                currentYear: moment().year(),
                showMonthsList: false,
                selectedDate: null,
                selectedDateMonth: null,
                selectedMonthIndex: moment().month()
            }
        },
        methods: {
            markCurrentDay(day) {
                // Selected Date
                if (day.date() === this.selectedDate && this.selectedDateMonth === this.months[day.month()]) {
                    return "text-center bg-gray-800 text-white rounded-md shadow"
                }
                // Current Day
                if ((moment().date() === day.date() && moment().month() === day.month()) && moment().year() === day.year()) {
                    return "text-center bg-blue-500 text-white rounded-md shadow"
                }
                // Current Week
                if (moment().week() === day.week() && moment().year() === day.year()) {
                    return "text-center bg-gray-200 text-gray-800 rounded-md shadow";
                }
                // Current Month
                if (this.selectedMonth === this.months[day.month()]) {
                    return "text-center text-gray-800"
                }
                return "text-center text-gray-300"
            },
            changeMonth(month, i) {
                this.selectedMonthIndex = i;
                this.selectedMonth = month;
                let calendar = [];
                const today = moment(`${this.currentYear}, ${month}`);
                let startDay = today.clone().startOf('month').startOf('week');
                let endDay = today.clone().endOf('month').endOf('week');
                let date = startDay.clone().subtract(1, 'day');
                while (date.isBefore(endDay, 'day')) {
                    calendar.push({
                        days: Array(7).fill(0).map(() => date.add(1, 'day').clone())
                    });
                }
                this.currentMonth = calendar;
                this.showMonthsList = false;
            },
            markCurrentMonth(monthIndex) {
                if (this.months[monthIndex] === this.selectedMonth) {
                    return "bg-gray-100 text-gray-900 cursor-pointer hover:bg-gray-100 hover:text-gray-900 text-gray-700 block px-4 py-2 text-sm"
                } else {
                    return "cursor-pointer hover:bg-gray-100 hover:text-gray-900 text-gray-700 block px-4 py-2 text-sm"
                }
            },
            openMonthsList() {
                this.showMonthsList = true;
            },
            closeMonthsList() {
                this.showMonthsList = false;
            },
            getCurrentMonthName() {
                return moment().format('MMMM');
            },
            incrementYear() {
                this.currentYear++;
                this.changeMonth(moment().format('MMMM'));
                this.selectedMonth = moment().format("MMMM");
            },
            decrementYear() {
                this.currentYear--;
                this.changeMonth(moment().format('MMMM'));
                this.selectedMonth = moment().format("MMMM");
            },
            incrementMonth() {
                if (this.selectedMonthIndex + 1 <= 11) {
                    this.selectedMonthIndex++;
                    this.selectedMonth = this.months[this.selectedMonthIndex];
                    this.changeMonth(this.selectedMonth, this.selectedMonthIndex);
                } else {
                    this.currentYear++;
                    this.selectedMonthIndex = 0;
                    this.selectedMonth = this.months[this.selectedMonthIndex];
                    this.changeMonth(this.selectedMonth, this.selectedMonthIndex);
                }
            },
            decrementMonth() {
                if (this.selectedMonthIndex - 1 >= 0) {
                    this.selectedMonthIndex--;
                    this.selectedMonth = this.months[this.selectedMonthIndex];
                    this.changeMonth(this.selectedMonth);
                } else {
                    this.currentYear--;
                    this.selectedMonthIndex = 11;
                    this.selectedMonth = this.months[this.selectedMonthIndex];
                    this.changeMonth(this.selectedMonth);
                }
            },
            setCalendar() {
                this.currentYear = moment().year();
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
                this.selectedMonth = moment().format("MMMM");
                this.selectedDate = moment().date();
                this.selectedDateMonth = null;
                this.selectedMonthIndex = moment().month();
                let todayTasks = this.allTasks.filter(task => {
                    if (task.spec_date) {
                        if(moment().format('YYYY-MM-DD') === moment(task.spec_date).format('YYYY-MM-DD')) {
                            return task;
                        }
                    }
                    if (task.daily) return task;
                });
                let todayEvents = this.allEvents.filter(event => {
                    if (event.spec_date) {
                        if (moment().format('YYYY-MM-DD') === moment(event.spec_date).format('YYYY-MM-DD')) {
                            return event;
                        }
                    }
                    if (event.daily) return event;
                });
                this.$emit('data', {todayTasks, todayEvents, day: moment()});
            },
            changeDay(day) {
                if (moment(day).format("D MMM YYYY") === moment().format("D MMM YYYY")) {
                    this.setCalendar()
                } else {
                    this.selectedDate = day.date();
                    this.selectedDateMonth = this.months[day.month()];
                    this.changeMonth(this.months[day.month()])
                    let todayTasks = this.allTasks.filter(task => {
                        if (task.spec_date && !task.completed) {
                            if(day.format('YYYY-MM-DD') === moment(task.spec_date).format('YYYY-MM-DD')) {
                                return task;
                            }
                        }
                        if (task.daily && !task.completed) {
                            if (moment().format("D MMM YYYY") === moment(day).format("D MMM YYYY")) {
                                return task;
                            }
                        }
                    });
                    let todayEvents = this.allEvents.filter(event => {
                        if (event.spec_date) {
                            if (day.format('YYYY-MM-DD') === moment(event.spec_date).format('YYYY-MM-DD')) {
                                return event;
                            }
                        }
                        if (event.daily) {
                            if (moment().format("D MMM YYYY") === moment(day).format("D MMM YYYY")) {
                                return event;
                            }
                        }
                    });
                    this.$emit('data', {todayTasks, todayEvents, day: moment(day)});
                }
            }
        },
        mounted() {
            this.setCalendar();
        },
    }
</script>
