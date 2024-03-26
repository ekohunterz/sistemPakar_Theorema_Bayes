<script setup>
import { ref } from 'vue'

defineProps({
  message: {
    type: String
  }
})

const isShow = ref(true)
</script>

<template>
  <div
    v-if="isShow"
    role="alert"
    class="alert alert-success"
  >
    <svg
      xmlns="http://www.w3.org/2000/svg"
      class="size-6 shrink-0 stroke-current"
      fill="none"
      viewBox="0 0 24 24"
    >
      <path
        stroke-linecap="round"
        stroke-linejoin="round"
        stroke-width="2"
        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
      />
    </svg>
    <span>{{ message }}</span>
    <svg
      @click="isShow = false"
      xmlns="http://www.w3.org/2000/svg"
      class="size-6 shrink-0 stroke-current"
      fill="none"
      viewBox="0 0 24 24"
    >
      <path
        stroke-linecap="round"
        stroke-linejoin="round"
        stroke-width="2"
        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"
      />
    </svg>
    <span class="sr-only">Dismiss</span>
  </div>
</template>
