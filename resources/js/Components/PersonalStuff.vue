<template>
    <div class="mb-4 mx-0 xl:mr-4">
        <div class="shadow-lg height rounded-2xl bg-white dark:bg-gray-700 w-full">
            <div class="font-bold border-b flex items-center justify-between border-gray-100 p text-md p-4 text-black dark:text-white">
                <div>
                    <span v-if="isTodayDate()">
                         Personal Stuff - Today
                    </span>
                    <span v-else>Personal Stuff - {{ formatDate() }}</span>
                    <span class="text-sm text-gray-500 dark:text-gray-300 dark:text-white ml-2">
                        (2)
                    </span>
                </div>

                <inertia-link :href="route('create', {show: 'create-stuff'})" class="flex items-center bg-gray-500 text-white py-1 cursor-pointer rounded-md shadow px-2">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd">
                        </path>
                    </svg>
                    Add
                </inertia-link>
            </div>
        </div>
    </div>
</template>

<script>
    import moment from "moment";

    export default {
        data() {
            return {
                date: moment()
            }
        },
        methods: {
            isTodayDate() {
                return moment(this.date).format("D MMMM YYYY") === moment().format("D MMMM YYYY");
            },
            formatDate() {
                return moment(this.date).format("DD MMMM YYYY");
            }
        }
    }
</script>

