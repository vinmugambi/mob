<template>
    <datepicker
        v-model="date"
        :lowerLimit="minDate"
        inputFormat="dd-MM-yyyy"
    ></datepicker>
</template>

<script>
import Datepicker from "vue3-datepicker";

export default {
    components: { Datepicker },
    props: ["value", "error"],
    computed: {
        date: {
            get() {
                return this.value || new Date();
            },
            set(value) {
                this.$emit("update", value)
            },
        },
    },
    data() {
        return {
            minDate: new Date(),
        };
    },
};
</script>
