<template>
    <div class="w-full h-full rounded-md">
        <span class="block mb-5 text-xl text-center text-gray-200">Upcoming Tasks</span>

        <div class="h-24 px-4 text-white bg-gray-700 rounded-md shadow-lg">
            <div class="flex items-center justify-between h-full">
                <div>
                    <span class="font-semibold text-green-400">Task Title</span>
                    <p class="text-xs">Task Description</p>
                </div>
                <span class="flex flex-col justify-center h-full text-xs text-white">2021 May 29, 12:30</span>
                <jet-checkbox />
            </div>
        </div>
    </div>
</template>

<script>
import JetCheckbox from '@/Jetstream/Checkbox';

export default {
    components: {
        JetCheckbox
    },
    props: {
        upcomingTasks: Array
    }
}
</script>

