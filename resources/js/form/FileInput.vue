<template>
    <input
        type="file"
        ref="upload"
        class="block"
        accept=".jpg,.png,.jpeg"
        @change="$emit('update', $event.target.files[0])"
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
  },
};
</script>
