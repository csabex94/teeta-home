<template>
    <light-layout>
        <template #content>
            <div class="px-5 max-w-7xl mx-auto">
                <span class="block mb-5 text-xl text-gray-800 text-center">Friends</span>
            </div>
            

            <div class="w-full max-w-screen-xl mx-auto px-6">
                <div class="flex items-left p-4 px-3 py-10">
                    <div class="w-full max-w-md">
                        <div class="bg-white shadow-md rounded-lg px-3 py-2 mb-4">
                            <div class="block text-gray-700 text-lg font-semibold py-2 px-2">
                                Friend List
                            </div>

                            <div class="flex items-center mb-5">
                                <div class="w-full relative flex items-center">
                                    <jet-input @keydown="handleKeyDown" v-model="searchQuery" type="text" name="search" placeholder="Search friend" class="w-full" />
                                    <svg
                                        @click="clearSearchInput"
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5 cursor-pointer absolute text-gray-500 right-10 bottom-3"
                                        viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path
                                            fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <svg @click="searchForFriend" xmlns="http://www.w3.org/2000/svg" class="h-5 cursor-pointer bottom-3 absolute right-2 text-gray-500 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </div>
                            </div>

                            <div class="py-3 text-sm">
                                
                                <div v-for="friend in friends" :key="friend.id" class="flex justify-start cursor-pointer text-gray-700 hover:text-blue-400 hover:bg-blue-100 rounded-md px-2 py-2 my-2">
                                    <span v-if="friend.accepted" class="bg-green-400 h-2 w-2 m-2 rounded-full"></span>
                                    <span v-else class="bg-red-400 h-2 w-2 m-2 rounded-full"></span>
                                    <div class="flex-grow font-medium px-2">{{ friend.username }}</div>
                                    <div class="text-sm font-normal text-gray-500 tracking-wide">Team</div>
                                </div>

                            </div>
                            <div class="block bg-gray-200 text-sm text-right py-2 px-3 -mx-3 -mb-2 rounded-b-lg">
                                <button class="hover:text-gray-600 text-gray-500 font-bold py-2 px-4">
                                    Cancel
                                </button>
                                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    Invite
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            </template>
    </light-layout>    
</template>

<script>

import LightLayout from '@/Layouts/LightLayout'
import JetInput from '@/Jetstream/Input';
import JetDangerButton from '@/Jetstream/DangerButton';
import JetSecondaryButton from '@/Jetstream/SecondaryButton';
import JetButton from '@/Jetstream/Button';
import JetLabel from '@/Jetstream/Label';
import _ from 'lodash';

export default {
    components: {
        LightLayout,
        JetInput,
        JetDangerButton,
        JetSecondaryButton,
        JetButton,
        JetLabel
    },
    data() {
      return {
          searchQuery: "",
          friends: ""
      }
    },
    props: {
        friends: Array
    },
    methods: {
        clearSearchInput() {
            this.searchQuery = "";
        }
    },
    watch: {
        searchQuery(value) {
            this.searchForFriend();
        }
    },
}
</script>