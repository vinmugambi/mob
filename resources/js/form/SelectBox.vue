<template>
  <div class="block relative">
    <select :value="value" @input="$emit('input', $event.target.value)">
      <option value class="text-gray-500">{{ placeholder }}</option>
      <option
        v-for="(option, index) in options"
        :key="`${option.value}-${index}`"
        >{{ option.text }}</option
      >
    </select>
    <div
      class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700"
    >
      <svg
        class="fill-current h-4 w-4"
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 20 20"
      >
        <path
          d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"
        />
      </svg>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    value: {
      type: String,
      required: false
    },
    options: { type: Array, required: true },
    placeholder: { type: String, required: false, default: () => "Select" }
  }
};
</script>
// <style lang="postcss">
// select {
//   @apply block w-full border  px-2 py-1  appearance-none text-gray-700 rounded tracking-tighter;
// }
// select:focus {
//   @apply outline-none border-primary-400;
// }
// select{
//   background-image: linear-gradient(to bottom, #ffffff 0%,#e5e5e5 100%);
// }

// </style>