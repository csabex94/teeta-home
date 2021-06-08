<template>
    <light-layout>
        <template #content>
            <div class="mx-auto px-5 max-w-7xl">
                <span class="block mb-5 text-xl text-center text-gray-800">Notifications</span>
            </div>

            <div class="flex items-center mb-5">

                <div v-for="notification in userNotifications.data" :key="notification.id" class="h-24 px-2 mb-3 bg-white text-gray-700 rounded-lg shadow">
                    <div class="flex items-center justify-between h-full px-2">
                        {{ notification.id }}
                        <!--<div>
                            <span v-if="task.important" class="flex items-center font-semibold text-xs text-red-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Important
                            </span>

                            <span class="font-semibold text-blue-500">{{ task.title }}</span>
                            <p class="w-56 text-xs">{{ getReducedDescription(task.description) }}</p>
                        </div>

                        <div>
                            <span v-if="task.spec_date">{{ getFormattedDate(task.spec_date) }} <span v-if="task.spec_time"> - {{ getFormattedTime(task.spec_time) }}</span></span>
                            <span v-else>Daily <span v-if="task.spec_time">- {{ getFormattedTime(task.spec_time) }}</span></span>

                            <span class="block text-sm text-blue-500" v-if="task.remind_before_option && task.remind_before_value && task.remind_before_value != 'Remind me before'">
                            Remind before: {{ task.remind_before_value }} {{ task.remind_before_option }}
                        </span>
                        </div>
                    -->
                    </div>
                </div>

            </div>
        </template>
    </light-layout>
</template>

<script>
import LightLayout from '@/Layouts/LightLayout';
import {debounce} from "lodash/function";

export default {
    components: {
        LightLayout
    },
    props: {
        notifications: Object
    },
    data() {
        return {
            userNotifications: this.notifications
        }
    },
    mounted() {
        window.addEventListener('scroll', debounce((e) => {
            let pixelsFromBotton = document.documentElement.offsetHeight - document.documentElement.scrollTop;

            if (pixelsFromBotton < 200) {
                axios.get(this.userNotifications.next_page_url).then(response => {
                    this.userNotifications = {
                        ...response.data,
                        data: [...this.notifications.data, ...response.data.data]
                    }
                });
            }
        },200));
    }
}

</script>