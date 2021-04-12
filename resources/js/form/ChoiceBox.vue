<template>
  <div>
    <div
      v-for="(option,index) in options"
      :key="option.text"
      class="flex px-2 py-1 mb-1 border rounded"
    >
      <div class="flex items-center w-6">
        <input
          type="radio"
          :id="`${option.value}-${index}`"
          @change="$emit('input', $event.target.value)"
          :value="option.value"
          :checked="option.value === value"
        />
      </div>
      <label class="flex w-full pl-1" :for="`${option.value}-${index}`">
        <div class="w-3/4">
          <div><span  class="capitalize">{{option.label}}</span> visa</div>
          <a href="#" class="z-10 text-gray-600 text-xs underline">details</a>
        </div>
        <div class=" text-right">
          <div>{{option.pricing}}</div>
          <a href="#" class="z-10 text-gray-600 text-xs underline">pricing?</a>
        </div>
      </label>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    value: { type: String, required: false, default: () => "" },
    options: { type: Array, required: true }
  }
};
</script>