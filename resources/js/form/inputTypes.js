import SelectBox from "./SelectBox.vue";
import RadioInput from "./RadioInput.vue";
import TextInput from "./TextInput.vue";
import FileInput from "./FileInput.vue";
import CheckBox from "./CheckBox.vue";
import TextArea from "./TextArea.vue"
import Datepicker from "./Datepicker.vue"

const INPUT_MAP = {
  select: SelectBox,
  radio: RadioInput,
  text: TextInput,
  file: FileInput,
  checkbox: CheckBox,
  textarea: TextArea,
  date: Datepicker
};

export function mapInput(type) {
  return INPUT_MAP[type];
}
