<script setup>
import SecondaryButton from '@/Components/SecondaryButton.vue'
import DangerButton from '@/Components/DangerButton.vue'
import { router } from '@inertiajs/vue3'

defineProps({
  symptoms: Object
})

const destroy = (id) => {
  if (confirm('Are you sure you want to delete this symptom?')) {
    router.delete(route('symptoms.destroy', id))
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
          class="px-6 py-3 text-center"
        >
          Action
        </th>
      </tr>
    </thead>
    <tbody>
      <tr
        v-for="symptom in symptoms"
        :key="symptom.id"
        class="hover border-b bg-white dark:border-gray-700 dark:bg-gray-800"
      >
        <td
          scope="row"
          class="whitespace-nowrap px-6 py-4 font-medium text-gray-900 dark:text-white"
        >
          {{ symptom.name }}
        </td>

        <td class="px-6 py-4">
          <div class="flex space-x-2 justify-center">
            <SecondaryButton
              :href="route('symptoms.edit', symptom.id)"
              size="sm"
              >Edit</SecondaryButton
            >
            <DangerButton
              @click="destroy(symptom.id)"
              size="sm"
              >Delete</DangerButton
            >
          </div>
        </td>
      </tr>
    </tbody>
  </table>
</template>
