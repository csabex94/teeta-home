<template>
 
        <div class="mb-4">
            <div class="shadow-lg w-full rounded-2xl p-4 bg-white dark:bg-gray-700">
                <div class="w-full">
                    <div class="w-full rounded">
                        <div class="flex items-center justify-between mb-4">
                            <div class="text-left font-bold text-xl text-black dark:text-white">
                                Dec 2021
                            </div>
                            <div class="flex space-x-4">
                                <button class="p-2 rounded-full bg-blue-500 text-white">
                                    <svg width="15" height="15" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill="currentColor" d="M13.83 19a1 1 0 0 1-.78-.37l-4.83-6a1 1 0 0 1 0-1.27l5-6a1 1 0 0 1 1.54 1.28L10.29 12l4.32 5.36a1 1 0 0 1-.78 1.64z">
                                        </path>
                                    </svg>
                                </button>
                                <button class="p-2 rounded-full bg-blue-500 text-white">
                                    <svg width="15" height="15" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill="currentColor" d="M10 19a1 1 0 0 1-.64-.23a1 1 0 0 1-.13-1.41L13.71 12L9.39 6.63a1 1 0 0 1 .15-1.41a1 1 0 0 1 1.46.15l4.83 6a1 1 0 0 1 0 1.27l-5 6A1 1 0 0 1 10 19z">
                                        </path>
                                    </svg>
                                </button>
                            </div>
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
                                        Tur
                                    </th>
                                    <th class="py-3 px-2 md:px-3 ">
                                        Fri
                                    </th>
                                    <th class="py-3 px-2 md:px-3 ">
                                        Sat
                                    </th>
                                </tr>
                                <tr v-for="(week, i) in currentMonth" :key="i" class="text-gray-400 dark:text-gray-500">
                                    <td v-for="(day, i) in week.days" :key="i" :class="markCurrentDay(day)">
                                        {{ day.date() }}
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

    export default {
        data() {
            return {
                currentMonth: null,
                months: null,
                today: moment(),
            }
        },
        methods: {
            markCurrentDay(day) {
                if (day.month() === this.today.month()) {
                    return "text-gray-800 py-3 px-2 md:px-3  text-center dark:text-gray-500"
                } else {
                    return "text-gray-300 py-3 px-2 md:px-3  text-center dark:text-gray-500"
                }
            },
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
