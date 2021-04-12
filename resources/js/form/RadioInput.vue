<template>
  <div>
    <div v-for="(option,index) in options" :key="option.text" class="pl-1">
      <input
        type="radio"
        :id="`${option.value}-${index}`"
        @change="$emit('input', $event.target.value)"
        :value="option.value"
        :checked="option.value === value"
      />
      <label class="pl-1" :for="`${option.value}-${index}`">{{
        option.text
      }}</label>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    value: { type: String, required: false, default: () => "" },
    options: { type: Array, required: true}
  }
};
</script>