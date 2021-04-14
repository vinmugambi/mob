<template>
    <div>
        <input
            type="date"
            :value="date"
            @change="update($event.target.value, 'date')"
            required
        />
        <input
            type="time"
            :value="time"
            @change="update($event.target.value, 'time')"
            required
        />
    </div>
</template>

<script>
export default {
    props: ["value", "error"],
    computed: {
        dateVal() {
            return this.value ? new Date(this.value) : new Date();
        },
        date() {
            var day = this.dateVal.getDate().toString().padStart(2, "0");
            var month = (1 + this.dateVal.getMonth())
                .toString()
                .padStart(2, "0");

            return this.dateVal.getFullYear() + "-" + month + "-" + day;
        },
        time() {
            var hour = this.dateVal.getHours().toString().padStart(2, "0");
            var minute = this.dateVal.getMinutes().toString().padStart(2, "0");
            return hour + ":" + minute;
        },
    },
    methods: {
        update(value, key) {
            console.log(value, key);
            if (key === "date") {
                this.$emit("update", `${value}T${this.time}`);
            } else {
                this.$emit("update", `${this.date}T${value}`);
            }
        },
    },
};
</script>
