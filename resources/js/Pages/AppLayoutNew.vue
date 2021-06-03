<template>
    <div class="dashboard-wrapper relative bg-gray-800">

        <div class="left-side">
            <div class="header z-30 fixed top-0 left-0 shadow bg-gray-700 flex items-center justify-between">
                <!-- Logo -->
                <div class="flex items-center px-5 h-full">
                    <p class="text-2xl font-semibold text-green-500">Teeta</p>
                </div>
                <!-- Links -->
                <div class="flex items-center justify-around w-full px-5">
                    <inertia-link class="h-full inline-flex items-center justify-center w-full text-xs text-white transition-colors duration-150 cursor-pointer hover:text-green-500"
                                  :href="route('dashboard')">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        <span class="ml-2">DASHBOARD</span>
                    </inertia-link>
                    <inertia-link :href="route('tasks')" class="h-full justify-center inline-flex items-center w-full text-xs text-gray-500 transition-colors duration-150 cursor-pointer hover:text-yellow-400">
                        <span
                            class="inline-flex items-center font-semibold text-white hover:text-green-400">
                          <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                            </svg>
                            <span class="ml-2">TASKS</span>
                        </span>
                    </inertia-link>
                    <inertia-link :href="route('create.task')" class="h-full inline-flex justify-center items-center justify-center w-full text-xs text-gray-500 transition-colors duration-150 cursor-pointer hover:text-yellow-400">
                        <span
                            class="inline-flex items-center text-xs font-semibold text-white hover:text-green-400">
                         <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                            <span class="ml-2">CREATE TASK</span>
                        </span>
                    </inertia-link>
                    <inertia-link :href="route('events.show')" class="h-full inline-flex items-center justify-center w-full text-xs text-gray-500 transition-colors duration-150 cursor-pointer hover:text-yellow-400">
                        <span
                            class="inline-flex items-center text-xs font-semibold text-white hover:text-green-400">
                          <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span class="ml-2">EVENTS</span>
                        </span>
                    </inertia-link>
                    <inertia-link :href="route('events.create')" class="h-full inline-flex items-center justify-center w-full text-xs text-gray-500 transition-colors duration-150 cursor-pointer hover:text-yellow-400">
                        <span class="inline-flex items-center text-xs font-semibold text-white hover:text-green-400">
                         <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                             <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd">
                             </path>
                         </svg>
                            <span class="ml-2">CREATE EVENT</span>
                        </span>
                    </inertia-link>
                    <inertia-link :href="route('profile.show')" class="h-full inline-flex items-center justify-center w-full text-xs text-gray-500 transition-colors duration-150 cursor-pointer hover:text-yellow-400">
                        <span class="inline-flex items-center text-xs font-semibold text-white hover:text-green-400">
                         <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                          <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd" />
                        </svg>
                            <span class="ml-2">PROFILE</span>
                        </span>
                    </inertia-link>
                </div>

                <!-- User Avatar -->
                <div class="flex items-center pr-5 h-full justify-center">
                    <img class="object-cover w-10 h-8 shadow mr-1  rounded-full"
                         :src="returnProfilePhoto()" alt="no-avatar">
                    <p class="w-24  text-sm font-semibold text-center text-gray-200">
                        {{ $page.props.user.name }}
                    </p>
                </div>
            </div>

            <!-- Content(Calendar, etc..) -->

            <div class="pb-10 pr-5 mt-16 mb-4 content">
                <flash-messages></flash-messages>
                <slot name="content"></slot>
            </div>

        </div>

        <!-- Right Side(Events, Tasks) -->
        <div class="right-side fixed mt-20 bg-gray-700 shadow">
            <div class="flex flex-col">
                <div class="grid grid-cols-2 h-20 w-full">
                    <span @click="setListing('events')" class="w-full cursor-pointer h-full flex items-center text-sm text-green-400 font-bold justify-center">
                        <span class="relative">Events <div v-if="selectedListing === 'events'" class="w-8 absolute -bottom-1 h-1 left-2 bg-green-400" /></span>
                    </span>
                    <span @click="setListing('tasks')" class="w-full cursor-pointer h-full  flex items-center text-sm text-indigo-400 font-bold justify-center">
                        <span class="relative">Tasks <div v-if="selectedListing === 'tasks'" class="w-8 absolute -bottom-1 h-1 right-0 bg-indigo-400" /></span>
                    </span>
                </div>
                <!-- Tasks List -->
                <div v-if="selectedListing === 'tasks'">
                    <span class="mb-5 text-xl flex items-center justify-center text-gray-200">Today's <p class="text-indigo-400 ml-2">Tasks</p></span>
                    <span v-if="taskList && taskList.length <= 0" class="block text-center text-sm text-gray-200">Not tasks for today.</span>

                    <div v-for="task in getTasks()" :key="task.id" class="h-24 px-2 mx-5 mb-2 text-white bg-gray-800 rounded-md shadow-lg">
                        <div class="flex items-center justify-between h-full px-2">
                            <div>
                                <span class="font-semibold text-indigo-400">{{ task.title }}<span v-if="task.spec_time"> - {{ getFormattedTime(task.spec_time) }}</span></span>
                                <p class="text-xs">{{ getReducedDescription(task.description) }}</p>
                            </div>
                            <div class="flex items-center">

                                <div class="flex flex-col items-center cursor-pointer hover:text-green-400">
                                    <jet-checkbox  />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Events List -->
                <div v-if="selectedListing === 'events'">
                    <span class="mb-5 text-xl flex items-center justify-center text-gray-200">Today's <p class="text-green-400 ml-2">Events</p></span>
                    <span v-if="eventList && eventList.length <= 0" class="block text-sm text-center text-gray-200">Not events for today.</span>

                    <div v-for="event in getEvents()" :key="event.id" class="h-24 px-2 mb-2 mx-5 text-white bg-gray-800 rounded-md shadow-lg">
                        <div class="flex items-center justify-between h-full px-2">
                            <div>
                                <span class="font-semibold text-green-400">{{ event.title }}<span v-if="event.spec_time"> - {{ getFormattedTime(event.spec_time) }}</span></span>
                                <p class="text-xs">{{ getReducedDescription(event.description) }}</p>
                            </div>
                            <div class="flex items-center">

                                <div class="flex flex-col items-center cursor-pointer hover:text-green-400">
                                    <jet-checkbox />
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

import moment from "moment";
import FlashMessages from "@/Components/FlashMessages";

export default {
    components: {
        FlashMessages
    },
    props: {
      eventList: Array,
      taskList: Array,
      today: String
    },
    data() {
      return {
          selectedListing: "tasks",
          events: null,
          tasks: null
      }
    },
    methods: {
        returnProfilePhoto() {
            if (this.$page.props.user.profile_photo_path) {
                return "/storage/"+this.$page.props.user.profile_photo_path
            } else {
                return this.$page.props.user.profile_photo_url
            }
        },
        setListing(type) {
            this.selectedListing = type
        },
        getReducedDescription(text) {
            if (text.length > 80) {
                return text.substr(0, 80) + " ..."
            } else {
                return text
            }
        },
        getFormattedTime(time) {
            return moment(time,'h:mm:ss').format('HH:mm A');
        },
        getEvents() {
            if (!this.eventList || this.eventList.length <= 0 && this.$page.component !== "Dashboard") {
                return this.$page.props.todayEvents;
            } else {
                return this.eventList;
            }
        },
        getTasks() {
            if (!this.taskList || this.taskList.length <= 0  && this.$page.component !== "Dashboard") {
                return this.$page.props.todayTasks;
            } else {
                return this.taskList;
            }
        }
    },
}
</script>

<style scoped>
.dashboard-wrapper {
    width: 100%;
    height: 100%;
    min-height: 100vh;
    display: grid;
    grid-template-columns: 1fr 1fr 1fr 1fr;
}
.left-side {
    grid-column: 1 / 4;
    height: 100%;
    width: 100%;
}
.right-side {
    grid-column: 4 / 5;
    height: calc(100% - 5rem);
    width: 25%;
    right: 0;
}
.header {
    width: 100%;
    height: 5rem;
}
</style>
