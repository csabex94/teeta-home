<template>

    <main class="w-full p-5 h-full min-h-screen gap-8 bg-gray-100 grid grid-cols-5">

        <div class="col-span-1">
            <jet-sidebar />
        </div>

        <div class="col-span-4">
            <jet-header />
            <div class="mt-5 w-full mx-auto">
                <flash-messages></flash-messages>
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
import FlashMessages from '@/Components/FlashMessages';

export default {
    components: {
        JetDropdown,
        JetDropdownLink,
        JetSidebarLink,
        JetSidebar,
        JetHeader,
        FlashMessages
    },
    created() {
        /*let channel = Echo.channel('my-channel');
        channel.listen('.my-event', function(data) {
            alert(data);
        });
        window.Echo.channel('App.Models.User.${this.$page.props.user.id}').notification((notification => {
            console.log(notification);
            switch(notification.type) {
                case 'App\\Notifications\\TaskList':
                    this.$page.props.unreadNotificationsCount++;
                    break;
                
            }
        }));*/
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

    },
    mounted() {
        Pusher.logToConsole = true;

        var pusher = new Pusher('2b171450eff5f8bd267e', {
            cluster: 'eu'
        });

        var channel = pusher.subscribe('my-channel');
        channel.bind('my-event', function(data) {
            //app.messages.push(JSON.stringify(data));
            console.log(JSON.stringify(data));
        });
    }
}
</script>

    