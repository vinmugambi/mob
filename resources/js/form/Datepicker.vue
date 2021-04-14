<template>
    <!-- <date-time-picker
        v-model="date"
        :lowerLimit="minDate"
        inputFormat="dd-MM-yyyy"
    ></date-time-picker> -->
      <o-datetimepicker v-model="date" inline></o-datetimepicker>

</template>

<script>
import { Datetimepicker } from "@oruga-ui/oruga";
export default {
    props: ["value", "error"],
    components: { Datetimepicker },
    computed: {
        date: {
            get() {
                return this.value || new Date();
            },
            set(value) {
                this.$emit("update", value);
            },
        },
    },
};
</script>
