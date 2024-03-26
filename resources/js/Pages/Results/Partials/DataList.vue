<script setup>
import SecondaryButton from '@/Components/SecondaryButton.vue'
import DangerButton from '@/Components/DangerButton.vue'
import dayjs from 'dayjs'
import { router } from '@inertiajs/vue3'

defineProps({
  results: Object
})

const destroy = (id) => {
  if (confirm('Are you sure you want to delete this result?')) {
    router.delete(route('results.destroy', id))
  }
}
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
        <th
          scope="col"
          class="px-6 py-3"
        >
          Phone
        </th>
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
          Date
        </th>
        <th
          scope="col"
          class="px-6 py-3"
        >
          Action
        </th>
      </tr>
    </thead>
    <tbody>
      <tr
        v-for="result in results"
        :key="result.id"
        class="hover border-b bg-white dark:border-gray-700 dark:bg-gray-800"
      >
        <td
          scope="row"
          class="whitespace-nowrap px-6 py-4 font-medium text-gray-900 dark:text-white"
        >
          {{ result.name }}
        </td>
        <td class="px-6 py-4">
          {{ result.phone }}
        </td>
        <td class="px-6 py-4">
          {{ result.disease.name }}
        </td>

        <td class="px-6 py-4">
          {{ dayjs(result.created_at).format('DD MMM YYYY') }}
        </td>
        <td class="px-6 py-4">
          <div class="flex space-x-2">
            <SecondaryButton :href="route('results.show', result.id)">Detail</SecondaryButton>
            <DangerButton
              @click="destroy(result.id)"
              size="sm"
              >Delete</DangerButton
            >
          </div>
        </td>
      </tr>
    </tbody>
  </table>
</template>
