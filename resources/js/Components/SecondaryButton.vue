<script setup>
import { Link } from '@inertiajs/vue3'
import { computed } from 'vue'

const props = defineProps({
  type: {
    type: String,
    default: 'button'
  },
  disabled: {
    type: Boolean,
    default: false
  },
  processing: {
    type: Boolean,
    default: false
  },
  href: {
    type: String,
    default: null,
    required: false
  },
  size: {
    type: String,
    default: 'sm'
  }
})

const baseClass = computed(() => `btn btn-${props.size} btn-outline `)
</script>

<template>
  <Link
    v-if="href"
    :href="href"
    :class="baseClass"
  >
    <slot />
  </Link>

  <button
    v-else
    :type="type"
    :class="baseClass"
    :disabled="disabled"
  >
    <span
      v-if="processing"
      class="loading loading-spinner"
      role="status"
    ></span>
    <slot />
  </button>
</template>
