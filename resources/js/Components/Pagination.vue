<script setup>
import { Link } from '@inertiajs/vue3'

defineProps({
  from: {
    type: Number,
    default: 1
  },
  to: {
    type: Number,
    default: 1
  },
  total: {
    type: Number,
    default: 1
  },
  links: {
    type: Array
  }
})
</script>

<template>
  <div class="flex flex-col items-center">
    <!-- Help text -->
    <span class="text-sm text-gray-700 dark:text-gray-400">
      Showing
      <span class="font-semibold text-gray-900 dark:text-white">{{ from }}</span>
      to
      <span class="font-semibold text-gray-900 dark:text-white">{{ to }}</span>
      of
      <span class="font-semibold text-gray-900 dark:text-white">{{ total }}</span>
      Entries
    </span>
    <!-- Buttons -->
    <div class="xs:mt-0 mt-2 inline-flex">
      <template
        v-for="(link, p) in links"
        :key="p"
      >
        <div
          v-if="link.url === null"
          class="mb-1 mr-1 rounded border px-4 py-3 text-sm leading-4 text-gray-400"
          v-html="link.label"
        />
        <Link
          preserve-scroll
          v-else
          class="mb-1 mr-1 rounded border px-4 py-3 text-sm leading-4 hover:bg-blue-700/80 focus:border-indigo-500/25 focus:text-indigo-500"
          :class="{ 'bg-blue-700 text-white': link.active }"
          :href="link.url"
          v-html="link.label"
        />
      </template>
    </div>
  </div>
</template>
