<script setup>
import SecondaryButton from '@/Components/SecondaryButton.vue'
import DangerButton from '@/Components/DangerButton.vue'
import { router } from '@inertiajs/vue3'
import PrimaryButton from '@/Components/PrimaryButton.vue'

defineProps({
  diseases: Object
})

const destroy = (id) => {
  if (confirm('Are you sure you want to delete this disease?')) {
    router.delete(route('diseases.destroy', id))
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
          Description
        </th>

        <th
          scope="col"
          class="px-6 py-3"
        >
          Solution
        </th>
        <th
          scope="col"
          class="px-6 py-3"
        >
          Image
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
        v-for="disease in diseases"
        :key="disease.id"
        class="hover border-b bg-white dark:border-gray-700 dark:bg-gray-800"
      >
        <td
          scope="row"
          class="whitespace-nowrap px-6 py-4 font-medium text-gray-900 dark:text-white"
        >
          {{ disease.name }}
        </td>
        <td class="px-6 py-4">
          {{ disease.description }}
        </td>
        <td class="px-6 py-4">
          {{ disease.solution }}
        </td>
        <td class="px-6 py-4">
          <img
            :src="disease.image ?? 'https://via.placeholder.com/150'"
            class="w-24"
          />
        </td>
        <td class="px-6 py-4">
          <div class="flex space-x-2">
            <PrimaryButton
              :href="route('diseases.rules', disease.id)"
              size="sm"
              >Rules</PrimaryButton
            >
            <SecondaryButton
              :href="route('diseases.edit', disease.id)"
              size="sm"
              >Edit</SecondaryButton
            >
            <DangerButton
              @click="destroy(disease.id)"
              size="sm"
              >Delete</DangerButton
            >
          </div>
        </td>
      </tr>
    </tbody>
  </table>
</template>
