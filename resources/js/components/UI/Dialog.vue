<template>
  <q-dialog
      :model-value="show"
      @update:model-value="(v) => $emit('update:show', v)"
      @before-show="$emit('beforeShow')"
  >
    <q-card style="min-width: 360px">
      <q-card-section class="flex no-wrap">
        <div class="text-h6">
          <slot name="header"/>
        </div>
      </q-card-section>
      <q-separator v-if="!no_separation"/>
      <q-card-section style="max-height: 65vh" class="scroll" :style="no_separation ? 'padding-top: 8px; padding-bottom: 6px' : null">
        <slot name="body"/>
      </q-card-section>
      <q-separator v-if="!no_separation"/>
      <q-card-section class="flex" >
        <q-space/>
          <template v-if="$slots.actions">
              <q-btn
                      label="Закрыть"
                      no-caps
                      class="q-mr-xs"
                      flat
                      v-close-popup
              />
              <slot name="actions"/>
          </template>
          <template v-else>
              <q-btn
                      label="Закрыть"
                      no-caps
                      class="bg-soft-grey"
                      unelevated
                      v-close-popup
              />
          </template>
      </q-card-section>
    </q-card>
  </q-dialog>
</template>

<script>
export default {
  props: ['show', 'no_separation'],
}
</script>

<style scoped>
.q-card__section--vert {
  padding: 16px 20px;
}
</style>