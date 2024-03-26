<script setup>
import { onMounted, ref } from 'vue'

const model = defineModel({
  type: [String, Number],
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
  <div>
    <input
      type="range"
      min="0"
      max="1"
      step="0.01"
      v-model="model"
      ref="input"
      class="range"
      :class="`range-${size}` + (error ? ' range-error' : '')"
    />

    <label
      for="probability"
      class="w-full text-center"
    >
      {{ model }}
    </label>
  </div>
</template>
