<script setup>
defineProps({
  title: String,
  value: [Number, String],
  color: {
    type: String,
    default: 'bg-indigo-500'
  }
})
</script>

<template>
  <div class="w-full mt-6 px-6 sm:w-1/2 xl:w-1/3 sm:mt-0">
    <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-slate-100">
      <div
        class="p-3 text-white rounded-full bg-opacity-75"
        :class="color"
      >
        <slot name="icon"></slot>
      </div>

      <div class="mx-5">
        <h4 class="text-2xl font-semibold text-gray-700">{{ value }}</h4>
        <div class="text-gray-500">{{ title }}</div>
      </div>
    </div>
  </div>
</template>
