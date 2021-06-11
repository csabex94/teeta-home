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
        showNotification(data) {
            const notification = new Notification(data.title, {
                body: data.description,
                icon: '/logo-get',
            });
            notification.onclick = function(e){
                e.preventDefault();
                window.open('http://localhost:8000');
            }
        }
    },
    mounted() {
        Pusher.logToConsole = true;
        const pusher = new Pusher('2b171450eff5f8bd267e', {
            cluster: 'eu'
        });
        const channel = pusher.subscribe('my-channel');
        if (Notification.permission === 'granted') {
            channel.bind('my-event', (data) => {
                this.showNotification(data)
            });
        }
        if (Notification.permission === 'default') {
            Notification.requestPermission().then(permission => {
                if (permission === 'granted') {
                    channel.bind('my-event', (data) => {
                        this.showNotification(data)
                    });
                }
            });
        }
    }
}
</script>


