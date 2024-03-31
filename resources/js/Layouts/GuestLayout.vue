<script setup>
import { Link } from '@inertiajs/vue3'
</script>

<template>
  <div class="flex min-h-screen flex-col items-center bg-gray-100 pt-6 sm:justify-center sm:pt-0 dark:bg-gray-900">
    <div>
      <Link href="/">
        <h1 class="font-mono text-xl font-bold text-gray-800 dark:text-gray-200 capitalize">Bayes' theorem expert system</h1>
      </Link>
    </div>

    <div class="mt-6 w-full overflow-hidden bg-white px-6 py-4 shadow-md sm:max-w-md sm:rounded-lg dark:bg-gray-800">
      <slot />
    </div>
  </div>
</template>
