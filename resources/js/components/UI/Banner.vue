<template>
  <q-banner
      :style="styles_by_type"
      class="border-radius-md flex content-center"
  >
    <template v-if="type === 'positive'" v-slot:avatar>
      <q-icon name="task_alt" color="positive" size="30px"/>
    </template>
    <template v-if="type === 'info'" v-slot:avatar>
      <q-icon name="o_info" color="primary" size="30px"/>
    </template>
    <template v-else-if="type === 'warning'" v-slot:avatar>
      <q-icon name="warning_amber" color="warning" size="30px"/>
    </template>
    <template v-else-if="type === 'danger'" v-slot:avatar>
      <q-icon name="error_outline" color="negative" size="30px"/>
    </template>
    <div class="banner__text">
      <slot/>
    </div>
  </q-banner>
</template>

<script>
export default {
  name: "Banner",
  props: {
    type: String,
  },
  computed: {
    styles_by_type() {
      switch (this.type) {
        case 'positive':
          return "background-color: #72F3AE52"
        case 'info':
          return "background-color: #d2e9fc"
        case 'warning':
          return "background-color: #f9f2dc"
        case 'danger':
          return "background-color: #f8d7da"
      }
    }
  }
}
</script>

<style scoped>
@media screen and (max-width: 599.99px) {
  .q-banner {
    padding: 10px 16px;
  }
}

.banner__text {
  color: #4A5568;
  line-height: 1.5
}
</style>