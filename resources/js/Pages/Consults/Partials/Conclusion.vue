<script setup>
defineProps({
  totalBayes: Object
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
          Disease
        </th>
        <th
          scope="col"
          class="px-6 py-3"
        >
          Probability
        </th>
        <th
          scope="col"
          class="px-6 py-3"
        >
          Percentage
        </th>
      </tr>
    </thead>
    <tbody>
      <tr
        v-for="(disease, index) in totalBayes"
        :key="index"
        class="hover border-b bg-white dark:border-gray-700 dark:bg-gray-800"
      >
        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">{{ disease.name }}</td>
        <td class="px-6 py-4">{{ disease.result.toFixed(2) }}</td>
        <td class="px-6 py-4">{{ (disease.result * 100).toFixed(2) }}%</td>
      </tr>
    </tbody>
  </table>
  <p>
    The higher result is <span class="font-bold">{{ totalBayes[0].name }}</span> with a value of <span class="font-bold">{{ totalBayes[0].result.toFixed(2) }}</span>
  </p>
  <p>
    Solution : <span class="font-bold">{{ totalBayes[0].solution }}</span>
  </p>
</template>
