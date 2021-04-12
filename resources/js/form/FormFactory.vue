<template>
    <div class="pt-2">
        <div class="pb-4" v-for="field in fields" :key="field.model">
            <div>
                <input-label
                    v-if="field.label"
                    :label="field.label"
                    :input-id="safeId(field)"
                />
                <p v-if="field.help" class="text-xs text-gray-600">
                    {{ field.help }}
                </p>
                <component
                    :is="mapInput(field.component)"
                    v-bind="bindAttrs(field)"
                    :id="safeId(field)"
                    @update="update(field.model, $event)"
                    :value="value[field.model]"
                    :options="!!field.choices ? field.choices : null"
                />
            </div>
        </div>
    </div>
</template>

<script lang="js">
import { computed, defineComponent} from "vue";

import inputLabel from "./InputLabel.vue";
import {mapInput} from "../form/inputTypes.js";


export default defineComponent({
  props: {
    schema: { type: Object, required: true },
    value: { type: Object, required: true },
    shared: { type: Object }
  },
  components: { inputLabel},
  setup(props, { emit }) {
    const fields = computed(() => {
      let fields = [];
      for (let model in props.schema) {
        fields.push({ ...props.schema[model], model });
      }
      return fields;
    });

    function safeId(field){
      return field.model.replace(/\s+/g, "-");
    }

    function bindAttrs(field) {
      return {...field.attrs, name: [field.model]};
    }

    function update(property, value) {
      emit("update", {
        [property]: value
      });
    }

    return {
      fields,
      bindAttrs,
      update,
      safeId,
      mapInput
    };
  }
});
</script>
