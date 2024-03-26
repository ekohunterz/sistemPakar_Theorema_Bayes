<script setup>
import { Head, Link, router } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import Breadcrumbs from '@/Components/Breadcrumbs.vue'
import SelectedSymptoms from '../Consults/Partials/SelectedSymptoms.vue'
import RelatedDiseases from '../Consults/Partials/RelatedDiseases.vue'
import DefineEvidence from '../Consults/Partials/DefineEvidence.vue'
import CalculateProbability from '../Consults/Partials/CalculateProbability.vue'
import CalculateProbE from '../Consults/Partials/CalculateProbE.vue'
import CalculateProbHE from '../Consults/Partials/CalculateProbHE.vue'
import TotalBayes from '../Consults/Partials/TotalBayes.vue'
import Conclusion from '../Consults/Partials/Conclusion.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'

const props = defineProps({
  selectedSymptoms: Object,
  relatedDiseases: Object,
  relatedSymptoms: Object,
  totalProbability: Object,
  totalProbabilities_H: Object,
  totalProbE: Object,
  totalProbabilitiesHE: Object,
  totalBayes: Object,
  result: Object
})

const print = () => {
  router.get(route('pdf.export', { id: props.result.id }))
}
</script>

<template>
  <Head title="Result Detail" />
  <AuthenticatedLayout>
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">Result Detail</h2>
      <Breadcrumbs
        parent_name="Results"
        parent_url="results.index"
        current_name="Detail"
      />
    </template>
    <div class="py-12">
      <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 gap-6">
          <div class="space-y-3 overflow-hidden bg-white p-6 shadow-sm sm:rounded-lg dark:bg-gray-800">
            <h2 class="font-light leading-tight">Selected Symptoms</h2>
            <SelectedSymptoms :selectedSymptoms="selectedSymptoms" />
          </div>
          <div class="space-y-3 overflow-hidden bg-white p-6 shadow-sm sm:rounded-lg dark:bg-gray-800">
            <h2 class="font-light leading-tight">Related Diseases</h2>
            <RelatedDiseases :relatedDiseases="relatedDiseases" />
          </div>
        </div>
        <div class="space-y-3 overflow-hidden bg-white p-6 shadow-sm sm:rounded-lg dark:bg-gray-800">
          <h2 class="font-light leading-tight">Defines the probability value of each evidence</h2>
          <DefineEvidence
            :relatedSymptoms="relatedSymptoms"
            :totalProbability="totalProbability"
            :relatedDiseases="relatedDiseases"
            :selected-symptoms="selectedSymptoms"
          />
        </div>

        <div class="space-y-3 overflow-hidden bg-white p-6 shadow-sm sm:rounded-lg dark:bg-gray-800">
          <h2 class="font-light leading-tight">Calculated Probability Value P(Hi)</h2>
          <CalculateProbability
            :totalProbabilities_H="totalProbabilities_H"
            :relatedSymptoms="relatedSymptoms"
            :totalProbability="totalProbability"
            :relatedDiseases="relatedDiseases"
            :selected-symptoms="selectedSymptoms"
          />
        </div>
        <div class="space-y-3 overflow-hidden bg-white p-6 shadow-sm sm:rounded-lg dark:bg-gray-800">
          <h2 class="font-light leading-tight">Calculated Probability Value P(E|Hi)</h2>
          <CalculateProbE
            :totalProbabilities_H="totalProbabilities_H"
            :relatedSymptoms="relatedSymptoms"
            :totalProbability="totalProbability"
            :totalProbE="totalProbE"
            :relatedDiseases="relatedDiseases"
          />
        </div>
        <div class="space-y-3 overflow-hidden bg-white p-6 shadow-sm sm:rounded-lg dark:bg-gray-800">
          <h2 class="font-light leading-tight">Calculated Probability Value P(Hi|E)</h2>
          <CalculateProbHE
            :totalProbabilities_H="totalProbabilities_H"
            :relatedSymptoms="relatedSymptoms"
            :totalProbability="totalProbability"
            :totalProbE="totalProbE"
            :totalProbabilitiesHE="totalProbabilitiesHE"
            :relatedDiseases="relatedDiseases"
            :selected-symptoms="selectedSymptoms"
          />
        </div>
        <div class="space-y-3 overflow-hidden bg-white p-6 shadow-sm sm:rounded-lg dark:bg-gray-800">
          <h2 class="font-light leading-tight">Calculated Total Bayes</h2>
          <TotalBayes
            :totalProbabilities_H="totalProbabilities_H"
            :relatedSymptoms="relatedSymptoms"
            :totalProbability="totalProbability"
            :totalProbE="totalProbE"
            :totalProbabilitiesHE="totalProbabilitiesHE"
            :totalBayes="totalBayes"
          />
        </div>
        <div class="space-y-3 overflow-hidden bg-white p-6 shadow-sm sm:rounded-lg dark:bg-gray-800">
          <h2 class="font-light leading-tight">Conclusion</h2>
          <Conclusion :totalBayes="totalBayes" />
          <div class="mt-3 flex justify-center gap-3">
            <Link
              class="btn btn-outline btn-sm"
              :href="route('results.index')"
              >Back</Link
            >
            <PrimaryButton @click="print">Print</PrimaryButton>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
