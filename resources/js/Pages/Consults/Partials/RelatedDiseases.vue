<script setup>
defineProps({
  relatedDiseases: Object
})
</script>

<template>
  <table class="table w-full text-left text-sm text-gray-500 dark:text-gray-400">
    <thead class="bg-gray-50 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-400">
      <tr>
        <th
          scope="col"
          class="px-6 py-3"
        >
          Name
        </th>
      </tr>
    </thead>
    <tbody>
      <tr
        v-for="(disease, index) in relatedDiseases"
        :key="index"
        class="hover border-b bg-white dark:border-gray-700 dark:bg-gray-800"
      >
        <td class="px-6 py-4">{{ disease.name }}</td>
      </tr>
    </tbody>
  </table>
</template>
