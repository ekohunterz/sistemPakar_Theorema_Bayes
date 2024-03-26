<script setup>
defineProps({
  relatedSymptoms: Object,
  totalProbability: Object,
  relatedDiseases: Object,
  selectedSymptoms: Object
})
</script>

<template>
  <table class="table w-full text-left text-sm text-gray-500 dark:text-gray-400">
    <thead class="bg-gray-50 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-400">
      <tr>
        <th class="border px-4 py-2">Diseases</th>
        <th class="border px-4 py-2">Symptoms</th>
        <th class="border px-4 py-2">Weight</th>
        <th class="border px-4 py-2">Total</th>
      </tr>
    </thead>
    <tbody>
      <template
        v-for="(symptomGroup, index) in relatedSymptoms"
        :key="index"
      >
        <tr
          v-for="(value, rowIndex) in symptomGroup"
          :key="rowIndex"
        >
          <template v-if="rowIndex === 0">
            <td
              :rowspan="symptomGroup.length"
              class="border px-4 py-2"
            >
              {{ relatedDiseases[value.disease_id].name }}
            </td>
          </template>
          <td class="border px-4 py-2">{{ selectedSymptoms[value.symptom_id].name }}</td>
          <td class="border px-4 py-2">{{ value.weight }}</td>
          <template v-if="rowIndex === 0">
            <td
              class="border px-4 py-2"
              :rowspan="symptomGroup.length"
            >
              {{ totalProbability[value.disease_id].toFixed(2) }}
            </td>
          </template>
        </tr>
      </template>
    </tbody>
  </table>
</template>
