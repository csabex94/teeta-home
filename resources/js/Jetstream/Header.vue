<template>
    <header class="shadow-lg  bg-white dark:bg-gray-700 items-center h-16 rounded-2xl z-40">
        <div class="relative z-20 flex flex-col justify-center h-full px-3 mx-auto flex-center">
            <div class="relative items-center pl-1 flex w-full lg:max-w-68 sm:pr-2 sm:ml-0">
                <div class="container relative left-0 z-50 flex w-3/4 h-auto">
                    <div class="text-gray-600 font-bold flex items-center text-lg">
                        Today: <p class="text-blue-500 ml-3"> {{ today() }}</p>
                    </div>
                </div>
                <div class="relative p-1 flex items-center justify-end w-1/4 ml-5 mr-4 sm:mr-0 sm:right-auto">
                    <div class="mr-5 relative p-2 shadow-lg rounded-full cursor-pointer text-blue-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                        <span class="absolute bg-red-500 px-1 text-xs rounded-full top-0 right-2 text-white" v-if="$page.props.unreadNotificationsCount !== 0">{{ $page.props.unreadNotificationsCount }}</span>
                        <span class="absolute bg-red-500 px-1 text-xs rounded-full top-0 right-2 text-white" v-else></span>
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
        }
    }
}
</script>

<style scoped>

</style>
