<template>
  <div>
    <v-dialog width="700" max-height="500" v-model="dialog">
      <template v-slot:activator="{ props }">
        <v-btn color="green" v-bind="props"> Register Mobile </v-btn>
      </template>
      <v-card>
        <form @submit.prevent="submit">
          <v-text-field
            v-model="brand.value.value"
            :error-messages="brand.errorMessage.value"
            label="Brand"
          ></v-text-field>

          <v-text-field
            v-model="model.value.value"
            :error-messages="model.errorMessage.value"
            label="Model"
          ></v-text-field>

          <v-text-field
            v-model="os.value.value"
            :error-messages="email.errorMessage.value"
            label="E-mail"
          ></v-text-field>

          <v-text-field
            v-model="releaseDate.value.value"
            :error-messages="releaseDate.errorMessage.value"
            label="Release Date"
          ></v-text-field>

          <v-checkbox
            v-model="isNew.value.value"
            :error-messages="isNew.errorMessage.value"
            value="1"
            label="IsNew"
            type="checkbox"
          ></v-checkbox>

          <v-btn class="me-4" type="submit"> submit </v-btn>

          <v-btn @click="toggle"> clear </v-btn>
        </form>
      </v-card>
    </v-dialog>
  </div>
</template>

<script>
import { useField, useForm } from "vee-validate";
export default {
  props: {
    toggleDialogue: {
      required: true,
      type: Function,
    },
  },
  setup(props) {
    const { handleSubmit } = useForm({
      validationSchema: {
        brand(value) {
          if (value.length < 1) {
            return "Brand must be defined";
          }
        },
        model(value) {
          if (value.length < 1) {
            return "Model must be defined";
          }
        },
        releaseDate(value) {
          let pattern = /^[1-9]\d{3}\/(0[1-9]|1[0-2])$/;
          if (!new RegExp(pattern).test(value)) {
            return "Date must be in the format of YYYY-MM";
          }
        },
      },
    });

    const brand = useField("brand");
    const model = useField("model");
    const releaseDate = useField("releaseDate");
    const isNew = useField("isNew");

    return {
      brand,
      model,
      releaseDate,
      isNew,
      handleSubmit,
      toggle: props.toggleDialogue,
    };
  },
};
</script>

<style scoped>
.buttons {
  display: flex;
  justify-content: space-between;
}
</style>
