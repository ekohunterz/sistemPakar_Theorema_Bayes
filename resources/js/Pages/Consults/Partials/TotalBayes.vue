<script setup>
defineProps({
  relatedSymptoms: Object,
  totalProbability: Object,
  totalProbabilities_H: Object,
  totalProbE: Object,
  totalProbabilitiesHE: Object,
  totalBayes: Object
})
</script>

<template>
  <table class="table w-full text-left text-sm text-gray-500 dark:text-gray-400">
    <thead class="bg-gray-50 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-400">
      <tr>
        <th class="border px-4 py-2">Diseases</th>
        <th class="border px-4 py-2">Proccess</th>
        <th class="border px-4 py-2">Result</th>
      </tr>
    </thead>
    <tbody>
      <tr
        v-for="(value, rowIndex) in totalBayes"
        :key="rowIndex"
      >
        <td class="border px-4 py-2">{{ value.name }}</td>

        <td class="border px-4 py-2">
          <template
            v-for="(symptom, symptomIndex) in relatedSymptoms[value.id]"
            :key="symptomIndex"
          >
            <div class="inline">
              ({{ symptom.weight }} * {{ totalProbabilitiesHE[value.id][symptom.symptom_id].toFixed(2) }}) <span v-if="symptomIndex !== relatedSymptoms[value.id].length - 1">+</span>
            </div>
          </template>
        </td>
        <td class="border px-4 py-2">
          {{ value.result.toFixed(2) }}
        </td>
      </tr>
    </tbody>
  </table>
</template>
