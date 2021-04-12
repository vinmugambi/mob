<template>
    <textarea
        :class="error ? 'border border-red-300' : 'border'"
        class="block w-full py-1 px-2 rounded focus:outline-none focus:border-primary-400"
        :value="value"
        rows="5"
        cols="33"
        @change="$emit('update', $event.target.value)"
    ></textarea>
</template>

<script>
export default {
    props: {
        value: {
            default: () => "",
            type: String,
        },
        error: {
            type: Boolean,
            default: () => false,
        },
    },
};
</script>
