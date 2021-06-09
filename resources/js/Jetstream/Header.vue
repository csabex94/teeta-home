<template>
    <header class="shadow-lg  bg-white dark:bg-gray-700 items-center h-16 rounded-2xl z-40">
        <div class="relative z-20 flex flex-col justify-center h-full px-3 mx-auto flex-center">
            <div class="relative items-center pl-1 flex w-full lg:max-w-68 sm:pr-2 sm:ml-0">
                <div class="container relative left-0 z-50 flex w-3/4 h-auto">
                    <div class="text-gray-600 font-bold flex items-center text-lg">
                        Today: <p class="text-blue-500 ml-3"> {{ today() }}</p>
                    </div>
                </div>
                <div v-clickoutside="closeNotifications" class="relative p-1 flex items-center justify-end w-1/4 ml-5 mr-4 sm:mr-0 sm:right-auto">
                    <div class="relative">
                        <div @click="showNotification = !showNotification" class="mr-5 relative p-2 shadow-lg rounded-full cursor-pointer text-blue-600">
                        <button class="focus:outline-none px-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg> 
                            <span class="absolute bg-red-500 px-1 text-xs rounded-full top-0 right-2 text-white" v-if="$page.props.unreadNotificationsCount !== 0">{{ $page.props.unreadNotificationsCount }}</span>
                            <span class="absolute bg-red-500 px-1 text-xs rounded-full top-0 right-2 text-white" v-else>0</span>
                        </button>
                        </div>
                        

                        <div class="inset-0 h-full w-full z-10"></div>

                        <div v-if="showNotification" class="absolute right-0 mt-2 bg-white rounded-md shadow-lg overflow-hidden z-20" style="width:20rem;">
                            <div class="py-2">
                                <a href="#" class="flex items-center px-4 py-3 border-b hover:bg-gray-100 -mx-2">
                                    <img class="h-8 w-8 rounded-full object-cover mx-1" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=334&q=80" alt="avatar">
                                    <p class="text-gray-600 text-sm mx-2">
                                        <span class="font-bold" href="#">Sara Salah</span> replied on the <span class="font-bold text-blue-500" href="#">Upload Image</span> artical . 2m
                                    </p>
                                </a>
                                <a href="#" class="flex items-center px-4 py-3 border-b hover:bg-gray-100 -mx-2">
                                    <img class="h-8 w-8 rounded-full object-cover mx-1" src="https://images.unsplash.com/photo-1531427186611-ecfd6d936c79?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=634&q=80" alt="avatar">
                                    <p class="text-gray-600 text-sm mx-2">
                                        <span class="font-bold" href="#">Slick Net</span> start following you . 45m
                                    </p>
                                </a>
                                <a href="#" class="flex items-center px-4 py-3 border-b hover:bg-gray-100 -mx-2">
                                    <img class="h-8 w-8 rounded-full object-cover mx-1" src="https://images.unsplash.com/photo-1450297350677-623de575f31c?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=334&q=80" alt="avatar">
                                    <p class="text-gray-600 text-sm mx-2">
                                        <span class="font-bold" href="#">Jane Doe</span> Like Your reply on <span class="font-bold text-blue-500" href="#">Test with TDD</span> artical . 1h
                                    </p>
                                </a>
                                <a href="#" class="flex items-center px-4 py-3 hover:bg-gray-100 -mx-2">
                                    <img class="h-8 w-8 rounded-full object-cover mx-1" src="https://images.unsplash.com/photo-1580489944761-15a19d654956?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=398&q=80" alt="avatar">
                                    <p class="text-gray-600 text-sm mx-2">
                                        <span class="font-bold" href="#">Abigail Bennett</span> start following you . 3h
                                    </p>
                                </a>
                            </div>
                            <a :href="route('notifications.show')" class="block bg-gray-800 text-white text-center font-bold py-2">See all notifications</a>
                        </div>

                    </div>

                    <jet-dropdown>
                        <template #trigger>
                            <div class="flex cursor-pointer items-center relative ">
                                <img alt="profil" :src="returnProfilePhoto()" class="mx-auto shadow-lg object-cover rounded-full h-10 w-10 "/>
                                <span class="mx-2 text-gray-700 text-xs font-bold">{{ $page.props.user.name }}</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-700" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </template>
                        <template #content>
                            <jet-dropdown-link :href="route('profile.show')">Profile</jet-dropdown-link>
                            <form @submit.prevent="logout">
                                <jet-dropdown-link as="button">
                                    Logout
                                </jet-dropdown-link>
                            </form>
                        </template>
                    </jet-dropdown>
                </div>
            </div>
        </div>
    </header>
</template>

<script>
import JetDropdown from '@/Jetstream/Dropdown';
import JetDropdownLink from '@/Jetstream/DropdownLink';
import moment from 'moment'

export default {
    components: {
        JetDropdown,
        JetDropdownLink
    },
    data() {
        return {
            showNotification: false,
            notifications: ""
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
        logout() {
            this.$inertia.post(route('logout'));
        },
        today() {
            return moment().format('D MMMM YYYY');
        },
        openNotifications() {
            this.showNotification = true;
        },
        closeNotifications() {
            this.showNotification = false;
        }
    },
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
}
</script>

<style scoped>

</style>
