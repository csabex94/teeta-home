<template>
    <light-layout>
        <template #content>
            <div class="px-5 max-w-7xl mx-auto">
                <span class="block mb-5 text-xl text-gray-800 text-center">Friends</span>
            </div>
            

            <div class="w-full max-w-screen-xl mx-auto px-6">
                <div class="flex items-left p-4 px-3 py-10">
                    <div class="w-full max-w-md mx-2">
                        <div class="bg-white shadow-md rounded-lg px-3 py-2 mb-4">
                            <div class="block text-gray-700 text-lg font-semibold mt-2 py-2 px-2">
                                Friend List
                            </div>
                                
                            <div class="py-3 text-sm">
                                
                                <div @click="activate(friend.id); openFriendsActionBar()" v-for="(friend, index) in friends" :index="index" :key="friend.id" :class="{ activeFriend: active_el == friend.id }" class="flex justify-start cursor-pointer text-gray-700 hover:text-blue-400 hover:bg-blue-100 rounded-md px-2 py-2 my-2">
                                    <span v-if="friend.pivot.accepted" class="bg-green-400 h-2 w-2 m-2 rounded-full"></span>
                                    <span v-else class="bg-red-400 h-2 w-2 m-2 rounded-full"></span>
                                    <div class="flex-grow font-medium px-2">@{{ friend.username }}</div>
                                    <div v-if="friend.pivot.accepted" class="text-sm font-normal text-gray-500 tracking-wide"></div>
                                    <div v-else class="text-sm font-normal text-gray-500 tracking-wide">Pending</div>
                                </div>

                            </div>
                            <div v-if="showFriendsActions" class="block bg-gray-200 text-sm text-right py-2 px-3 -mx-3 -mb-2 rounded-b-lg">
                                <button class="hover:text-gray-600 text-gray-500 font-bold py-2 px-4" @click="closeFriendsActionBar">
                                    Cancel
                                </button>
                                <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" @click="deleteFriend(active_el)">
                                    Remove
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="w-full max-w-md mx-2">
                        <div class="bg-white shadow-md rounded-lg px-3 py-2 mb-4">
                            <div class="block text-gray-700 text-lg font-semibold py-2 px-2">
                                Collaborations
                            </div>

                            <div class="py-3 text-sm">

                                <div class="max-w-lg w-full rounded-lg shadow-lg p-4">
                                    <h3 class="font-semibold text-lg text-gray-700 tracking-wide"><a href="#">First Task</a></h3>
                                    <p class="text-gray-500 my-1">
                                        <i>Assigned: @vladvoda, @stefanvoda</i>
                                    </p>
                                    <p class="text-gray-500 my-2">
                                        Complete the first task together
                                    </p>
                                    <div>
                                        <button class="uppercase font-semibold tracking-wide bg-blue-100 text-blue-700 px-4 py-2 rounded-lg mt-2 focus:outline-none hover:bg-blue-200">Test</button>
                                    </div>
                                </div>

                            </div>

                            <div class="py-3 text-sm">

                                <div class="max-w-lg w-full rounded-lg shadow-lg p-4">
                                    <h3 class="font-semibold text-lg text-gray-700 tracking-wide"><a href="#">First Event</a></h3>
                                    <p class="text-gray-500 my-1">
                                        <i>Assigned: @vladvoda, @eduardcristea</i>
                                    </p>
                                    <p class="text-gray-500 my-2">
                                        Complete the first event together
                                    </p>
                                    <div>
                                        <button class="uppercase font-semibold tracking-wide bg-blue-100 text-blue-700 px-4 py-2 rounded-lg mt-2 focus:outline-none hover:bg-blue-200">Test</button>
                                    </div>
                                </div>
                                
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
import Multiselect from '@vueform/multiselect';
import _ from 'lodash';

export default {
    components: {
        LightLayout,
        JetInput,
        JetDangerButton,
        JetSecondaryButton,
        JetButton,
        JetLabel,
        Multiselect
    },
    data() {
      return {
          searchQuery: "",
          selectedUser: "",
          showFriendsActions: false,
          activeFriend: false,
          active_el: -1,
          friend_id: ""
      }
    },
    props: {
        friends: Array,
        users: Array
    },
    methods: {
        /*searchForFriend: _.debounce(function() {
            this.$inertia.visit(route('friends.show', { search: this.searchQuery }), {
                _method: 'GET',
                preserveState: true,
                preserveScroll: true,
                //resetOnSuccess: false,
                onSuccess: (value) => {
                    console.log(value);
                }
            })
        }, 400),*/
        handleKeyDown(event) {
            if (event.key === 'Enter') {
                this.searchForFriend();
            }
        },
        clearSearchInput() {
            this.searchQuery = "";
        },
        openFriendsActionBar() {
            this.showFriendsActions = true;
        },
        closeFriendsActionBar() {
            this.showFriendsActions = false;
        },
        activate(el) {
            this.active_el = el;
        },
        getReducedDescription(text) {
            if (text.length > 80) {
                return text.substr(0, 80) + " ..."
            } else {
                return text
            }
        },
        sendFriendRequest() {
            
        },
        deleteFriend(user) {
            this.$inertia.delete(route('friends.delete',{id: user}),{
                preserveState: false,
                preserveScroll: false,
                onSuccess: () => {
                    this.friends.reset();
                }
            });
        }
    },
    watch: {
        
    },
}
</script>

<style>
.activeFriend {
    --tw-bg-opacity: 1;
    background-color: rgba(219, 234, 254, var(--tw-bg-opacity));
}
</style>