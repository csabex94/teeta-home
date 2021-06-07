<template>
    <inertia-link :href="href" :class="classes">
        <slot></slot>
    </inertia-link>
</template>

<script>
    export default {
        props: ['href', 'active'],

        computed: {
            classes() {
                return this.active
                ? 'w-full mx-3 h-full flex items-center justify-center text-xs text-green-400 transition-colors duration-150 cursor-pointer hover:text-green-400 font-medium leading-5 focus:outline-none focus:border-indigo-700 transition'
                : 'w-full mx-3 h-full flex items-center justify-center text-xs  text-gray-200 transition-colors duration-150 cursor-pointer hover:text-green-400 font-medium leading-5 hover:text-green-400 focus:outline-none focus:text-green-400 transition'
            }
        }
    }
</script>
