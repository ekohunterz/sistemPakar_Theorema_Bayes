<script setup>
import { onMounted, ref } from 'vue'

const model = defineModel({
  type: [String, Object, Number, null],
  required: true
})

const input = ref(null)

onMounted(() => {
  if (input.value.hasAttribute('autofocus')) {
    input.value.focus()
  }
})

defineProps({
  size: {
    type: String,
    default: 'sm'
  },
  error: {
    type: String,
    default: null
  }
})

defineExpose({ focus: () => input.value.focus() })
</script>

<template>
  <input
    class="input input-bordered"
    :class="`input-${size}` + (error ? ' input-error' : '')"
    v-model="model"
    ref="input"
  />
</template>
