<script setup>
defineProps({
  relatedSymptoms: Object,
  totalProbability: Object,
  totalProbabilities_H: Object,
  totalProbE: Object,
  totalProbabilitiesHE: Object,
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
        <th class="border px-4 py-2">Probability</th>
        <th class="border px-4 py-2">Result</th>
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
          <td class="border px-4 py-2">({{ value.weight }}*{{ totalProbabilities_H[value.disease_id][value.symptom_id].toFixed(2) }}) / {{ totalProbE[value.disease_id].toFixed(2) }}</td>

          <td class="border px-4 py-2">
            {{ totalProbabilitiesHE[value.disease_id][value.symptom_id].toFixed(2) }}
          </td>
        </tr>
      </template>
    </tbody>
  </table>
</template>
