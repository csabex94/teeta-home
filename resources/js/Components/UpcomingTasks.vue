<template>
    <div class="w-full h-full rounded-md">
        <span class="block mb-5 text-xl text-gray-500 text-center">Upcoming Tasks</span>

        <div class="rounded-md shadow-lg text-white  bg-gray-700 px-4 py-4">
            <div class="flex items-center justify-between">
                <div>
                    <span class="font-semibold">Task Title</span>
                    <p class="text-xs">Task Description</p>
                </div>
                <span class="text-xs h-full flex flex-col justify-start text-white">2021 May 29, 12:30</span>
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

