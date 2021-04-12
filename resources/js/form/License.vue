<template>
  <validate rules="checked" v-slot="{ errors }">
    <input-label label="Licence agreement" input-id="licence-agreement" />
    <div id="licence-agreement">
      <p class="text-xs text-gray-600">
        I have read the
        <a class="underline" href="#">End user licence agreement</a> and
        <a class="underline" href="#">Privacy policy</a>
      </p>
      <input
        type="checkbox"
        id="accept"
        v-model="checked"
        true-value="yes"
        false-value="no"
      />
      <label class="pl-1" for="accept"
        >I accept the agreement and privacy policy</label
      >
      <span class="block h-4 text-xs text-red-700">{{ errors[0] }}</span>
    </div>
  </validate>
</template>

<script>
import { computed } from "vue";
import { ValidationProvider as Validate, extend } from "vee-validate";

import InputLabel from "./InputLabel.vue";

extend("checked", {
  validate: value => value === "yes",
  message: () => "Accept the licence agreement to continue"
});
export default {
  components: { InputLabel, Validate },
  props: {
    value: {
      type: String,
      default: () => false
    }
  },
  setup(props, { emit }) {
    const checked = computed({
      get: () => props.value,
      set: value => emit("input", { accept: value })
    });

    return {
      checked
    };
  }
};
</script>

