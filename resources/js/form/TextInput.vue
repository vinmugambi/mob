<template>
  <input
    type="text"
    :class="error ? 'border border-red-300' : 'border'"
    class="block w-full py-1 px-2 rounded appearance-none focus:outline-none focus:border-primary-400"
    :value="value"
    @change="$emit('update', $event.target.value)"
  />
</template>


<script>
export default {
  props: {
    value: {
      default: () => "",
      type: String
    },
    error: {
      type: Boolean,
      default: () => false
    }
  }
};
</script>

