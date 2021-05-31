<template>
    <div>

    </div>
</template>

<script>
import moment from 'moment';

export default {
    data() {
        return {
            months: null,
            currentMonth: null,
            days: null,
            daysOfMonth: []
        }
    },
    created() {
        this.currentMonth = moment.months()[moment().month()];
        this.months = moment.months();
        this.days = moment().daysInMonth();
    },
    mounted() {
       while(this.days) {

       }
    }
}
</script>
