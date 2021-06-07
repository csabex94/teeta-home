<template>

    <main class="w-full p-5 h-full min-h-screen gap-8 bg-gray-100 grid grid-cols-5">

        <div class="col-span-1">
            <jet-sidebar />
        </div>

        <div class="col-span-4">
            <jet-header />
            <div class="mt-5 w-full mx-auto max-w-7xl sm:px-6 lg:px-8">
                <slot name="content"></slot>
            </div>
        </div>

    </main>
</template>

<script>
import JetDropdown from '@/Jetstream/Dropdown';
import JetDropdownLink from '@/Jetstream/DropdownLink';
import JetSidebarLink from '@/Jetstream/SidebarLink';
import JetSidebar from '@/Jetstream/Sidebar';
import JetHeader from '@/Jetstream/Header';

export default {
    components: {
        JetDropdown,
        JetDropdownLink,
        JetSidebarLink,
        JetSidebar,
        JetHeader
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
    }
}
</script>


