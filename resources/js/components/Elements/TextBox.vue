<!-- <template>
  <div class="control-group">
    <label v-if="isLabelNotEmpty" class="label-light">{{ label }}</label>
    <input
      v-model="value"
      :type="type"
      class="text-box"
      :id="id"
      :placeholder="placeholder"
      :required="required"
      :max="maxDate"
      @input="$emit('update:modelValue', $event.target.value)"
    />
  </div>
  <p
    v-if="isErrorMessageNotEmpty"
    class="help-block text-danger text-right"
    style="margin-top: -1rem"
  >
    {{ errorMessage }}
  </p>
</template>

<script>
export default {
  props: {
    modelValue: {
      type: String,
      default: "",
    },
    id: {
      type: String,
      default: "text-input",
    },
    type: {
      type: String,
      default: "text",
    },
    placeholder: {
      type: String,
      default: "",
    },
    required: {
      type: Boolean,
      default: false,
    },
    label: { type: String, default: "" },
    errorMessage: { type: String, default: "" },
  },
  computed: {
    value: {
      get() {
        return this.modelValue;
      },
      set(value) {
        this.$emit("update:modelValue", value);
      },
    },
    maxDate() {
      const today = new Date();
      today.setDate(today.getDate() + 1);
      const formattedDate = today.toISOString().split("T")[0];
      return formattedDate;
    },
    minTime() {
      return "08:00";
    },
    maxTime() {
      return "16:00";
    },
    isLabelNotEmpty() {
      return this.label.trim() !== "";
    },
    isErrorMessageNotEmpty() {
      return this.errorMessage.trim() !== "";
    },
  },
};
</script> -->

<template>
    <div class="control-group">
        <label v-if="isLabelNotEmpty" class="label-light">{{ label }}</label>
        <input
            v-model="internalValue"
            :type="type"
            class="text-box"
            :id="id"
            :placeholder="placeholder"
            :required="required"
            :max="maxDate"
            @input="onInput"
        />
    </div>
    <p
        v-if="isErrorMessageNotEmpty"
        class="help-block text-danger text-right"
        style="margin-top: -1rem"
    >
        {{ errorMessage }}
    </p>
</template>

<script>
export default {
    props: {
        modelValue: {
            type: String,
            default: "",
        },
        id: {
            type: String,
            default: "text-input",
        },
        type: {
            type: String,
            default: "text",
        },
        placeholder: {
            type: String,
            default: "",
        },
        required: {
            type: Boolean,
            default: false,
        },
        label: {
            type: String,
            default: "",
        },
        errorMessage: {
            type: String,
            default: "",
        },
        prefix: {
            type: String,
            default: "",
        },
    },
    computed: {
        internalValue: {
            get() {
                return this.prefix + this.modelValue;
            },
            set(value) {
                const newValue = value.startsWith(this.prefix)
                    ? value.slice(this.prefix.length)
                    : value;
                this.$emit("update:modelValue", newValue);
            },
        },
        maxDate() {
            const today = new Date();
            today.setDate(today.getDate() + 1);
            const formattedDate = today.toISOString().split("T")[0];
            return formattedDate;
        },
        isLabelNotEmpty() {
            return this.label.trim() !== "";
        },
        isErrorMessageNotEmpty() {
            return this.errorMessage.trim() !== "";
        },
        isPrefixNotEmpty() {
            return this.prefix.trim() !== "";
        },
    },
    methods: {
        onInput(event) {
            const inputValue = event.target.value;
            if (!inputValue.startsWith(this.prefix)) {
                event.target.value = this.prefix + inputValue;
            }
            this.$emit(
                "update:modelValue",
                inputValue.slice(this.prefix.length)
            );
        },
    },
};
</script>

<style scoped>
.text-box {
    flex: 6;
    display: block;
    margin-bottom: 0.5rem;
    height: calc(1.5em + 0.75rem + 2px);
    padding: 0.375rem 0.75rem;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #495057;
    background-color: var(--yellow-light-box);
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: 5px;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

@media (prefers-reduced-motion: reduce) {
    .text-box {
        transition: none;
    }
}

.text-box::-ms-expand {
    background-color: transparent;
    border: 0;
}

.text-box:-moz-focusring {
    color: transparent;
    text-shadow: 0 0 0 #495057;
}

.text-box:focus {
    color: #495057;
    background-color: var(--yellow-light-box);
    border-color: #a3e851;
    outline: 0;
    box-shadow: 0 0 0 0.2rem rgba(107, 189, 13, 0.25);
}

.text-box::placeholder {
    color: #6c757d;
    opacity: 1;
}

.text-box:disabled,
.text-box[readonly] {
    background-color: #e9ecef;
    opacity: 1;
}

input[type="date"].text-box,
input[type="time"].text-box,
input[type="datetime-local"].text-box,
input[type="month"].text-box {
    appearance: none;
}

select.text-box:focus::-ms-value {
    color: #495057;
    background-color: var(--yellow-light-box);
}

.text-box-file,
.text-box-range {
    display: block;
    width: 100%;
}

.text-box-plaintext {
    display: block;
    width: 100%;
    padding: 0.375rem 0;
    margin-bottom: 0;
    font-size: 1rem;
    line-height: 1.5;
    color: #666666;
    background-color: transparent;
    border: solid transparent;
    border-width: 1px 0;
}

.text-box-plaintext.text-box-sm,
.text-box-plaintext.text-box-lg {
    padding-right: 0;
    padding-left: 0;
}

.text-box-sm {
    height: calc(1.5em + 0.5rem + 2px);
    padding: 0.25rem 0.5rem;
    font-size: 0.875rem;
    line-height: 1.5;
    border-radius: 0.2rem;
}

.text-box-lg {
    height: calc(1.5em + 1rem + 2px);
    padding: 0.5rem 1rem;
    font-size: 1.25rem;
    line-height: 1.5;
    border-radius: 0.3rem;
}

select.text-box[size],
select.text-box[multiple] {
    height: auto;
}

textarea.text-box {
    height: auto;
}

.was-validated .text-box:valid,
.text-box.is-valid {
    border-color: #28a745;
    padding-right: calc(1.5em + 0.75rem);
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8' viewBox='0 0 8 8'%3e%3cpath fill='%2328a745' d='M2.3 6.73L.6 4.53c-.4-1.04.46-1.4 1.1-.8l1.1 1.4 3.4-3.8c.6-.63 1.6-.27 1.2.7l-4 4.6c-.43.5-.8.4-1.1.1z'/%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right calc(0.375em + 0.1875rem) center;
    background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
}

.was-validated .text-box:valid:focus,
.text-box.is-valid:focus {
    border-color: #28a745;
    box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
}

.was-validated textarea.text-box:valid,
textarea.text-box.is-valid {
    padding-right: calc(1.5em + 0.75rem);
    background-position: top calc(0.375em + 0.1875rem) right
        calc(0.375em + 0.1875rem);
}

.was-validated .text-box:invalid,
.text-box.is-invalid {
    border-color: #dc3545;
    padding-right: calc(1.5em + 0.75rem);
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='none' stroke='%23dc3545' viewBox='0 0 12 12'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right calc(0.375em + 0.1875rem) center;
    background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
}

.was-validated .text-box:invalid:focus,
.text-box.is-invalid:focus {
    border-color: #dc3545;
    box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
}

.was-validated textarea.С:invalid,
textarea.text-box.is-invalid {
    padding-right: calc(1.5em + 0.75rem);
    background-position: top calc(0.375em + 0.1875rem) right
        calc(0.375em + 0.1875rem);
}
</style>
