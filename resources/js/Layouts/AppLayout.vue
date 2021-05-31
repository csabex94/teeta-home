<template>
    <div class="flex h-screen bg-gray-800">

        <!-- Desktop sidebar -->
        <aside class="z-30 flex-shrink-0 hidden w-56 pl-2 border-r border-gray-200 overflow-y-auto bg-gray-800 md:block">
            <div>
                <div class="text-white">
                    <div class="flex p-2 bg-gray-800">
                        <div class="flex items-end px-2 py-3">
                            <p class="text-2xl font-semibold text-green-500">TEETA</p><p class="italic font-semibold ">Reminder</p>
                        </div>
                    </div>
                    <div class="flex justify-center">
                        <div class="">
                            <img class="object-cover w-24 h-24 mr-2 border-4 border-green-400 rounded-full sm:block"
                                 :src="returnProfilePhoto()" alt="no-avatar">
                            <p class="w-24 pt-2 text-base font-bold text-center text-gray-400">
                                {{ $page.props.user.name }}
                            </p>
                        </div>
                    </div>
                    <div>
                        <ul class="mt-6 leading-10">
                            <li class="relative px-2 py-1 ">
                                <inertia-link class="inline-flex items-center w-full text-sm font-semibold text-white transition-colors duration-150 cursor-pointer hover:text-green-500"
                                   :href="route('dashboard')">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                         viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                    </svg>
                                    <span class="ml-4">DASHBOARD</span>
                                </inertia-link>
                            </li>
                            <li class="relative px-2 py-1">
                                <inertia-link :href="route('tasks')" class="inline-flex items-center justify-between w-full text-base font-semibold text-gray-500 transition-colors duration-150 cursor-pointer hover:text-yellow-400">
                                    <span
                                        class="inline-flex items-center text-sm font-semibold text-white hover:text-green-400">
                                      <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                                        </svg>
                                        <span class="ml-4">TASKS</span>
                                    </span>
                                </inertia-link>
                            </li>
                            <li class="relative px-2 py-1">
                                <inertia-link :href="route('create.task')" class="inline-flex items-center justify-between w-full text-base font-semibold text-gray-500 transition-colors duration-150 cursor-pointer hover:text-yellow-400">
                                    <span
                                        class="inline-flex items-center text-sm font-semibold text-white hover:text-green-400">
                                     <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                        <span class="ml-4">CREATE TASK</span>
                                    </span>
                                </inertia-link>
                            </li>
                            <li class="relative px-2 py-1">
                                <inertia-link :href="route('events.show')" class="inline-flex items-center justify-between w-full text-base font-semibold text-gray-500 transition-colors duration-150 cursor-pointer hover:text-yellow-400">
                                    <span
                                        class="inline-flex items-center text-sm font-semibold text-white hover:text-green-400">
                                      <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <span class="ml-4">EVENTS</span>
                                    </span>
                                </inertia-link>
                            </li>
                            <li class="relative px-2 py-1">
                                <inertia-link :href="route('events.create')" class="inline-flex items-center justify-between w-full text-base font-semibold text-gray-500 transition-colors duration-150 cursor-pointer hover:text-yellow-400">
                                    <span class="inline-flex items-center text-sm font-semibold text-white hover:text-green-400">
                                     <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                         <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd">
                                         </path>
                                     </svg>
                                        <span class="ml-4">CREATE EVENT</span>
                                    </span>
                                </inertia-link>
                            </li>
                            <li class="relative px-2 py-1">
                                <inertia-link :href="route('profile.show')" class="inline-flex items-center justify-between w-full text-base font-semibold text-gray-500 transition-colors duration-150 cursor-pointer hover:text-yellow-400">
                                    <span class="inline-flex items-center text-sm font-semibold text-white hover:text-green-400">
                                     <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 20 20" fill="currentColor">
                                      <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd" />
                                    </svg>
                                        <span class="ml-4">PROFILE</span>
                                    </span>
                                </inertia-link>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </aside>

        <div class="flex flex-col w-full h-full overflow-y-auto">
            <header class="fixed top-0 border-b border-gray-200 right-0 z-20 flex items-center w-full px-5 py-4 bg-gray-800 h-18">
                <div class="w-full" />

                <div class="flex items-center justify-center h-10 mr-5 text-green-400 bg-white rounded-full cursor-pointer w-11 hover:bg-green-400 hover:text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                </div>

                <div @click="logout" class="flex items-center justify-center h-10 text-green-400 bg-white rounded-full cursor-pointer w-11 hover:bg-green-400 hover:text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                </div>

            </header>
            <main class="flex-grow mt-16">
                <div class="pb-10 mt-5 mb-4 ">
                    <slot name="content"></slot>
                </div>
            </main>
        </div>
    </div>
</template>

<script>
    import JetApplicationMark from '@/Jetstream/ApplicationMark'
    import JetBanner from '@/Jetstream/Banner'
    import JetDropdown from '@/Jetstream/Dropdown'
    import JetDropdownLink from '@/Jetstream/DropdownLink'
    import JetNavLink from '@/Jetstream/NavLink'
    import JetResponsiveNavLink from '@/Jetstream/ResponsiveNavLink'
    //import FlashMessages from '@/Shared/FlashMessages'

    export default {
        components: {
            JetApplicationMark,
            JetBanner,
            JetDropdown,
            JetDropdownLink,
            JetNavLink,
            JetResponsiveNavLink,
            //FlashMessages
        },

        data() {
            return {
                showingNavigationDropdown: false,
            }
        },

        methods: {
            switchToTeam(team) {
                this.$inertia.put(route('current-team.update'), {
                    'team_id': team.id
                }, {
                    preserveState: false
                })
            },

            logout() {
                this.$inertia.post(route('logout'));
            },
            returnProfilePhoto() {
                if (this.$page.props.user.profile_photo_path) {
                    return "/storage/"+this.$page.props.user.profile_photo_path
                } else {
                    return this.$page.props.user.profile_photo_url
                }
            }
        }
    }
</script>

