<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import Breadcrumbs from '@/Components/Breadcrumbs.vue'
import SelectedSymptoms from './Partials/SelectedSymptoms.vue'
import RelatedDiseases from './Partials/RelatedDiseases.vue'
import DefineEvidence from './Partials/DefineEvidence.vue'
import CalculateProbability from './Partials/CalculateProbability.vue'
import CalculateProbE from './Partials/CalculateProbE.vue'
import CalculateProbHE from './Partials/CalculateProbHE.vue'
import TotalBayes from './Partials/TotalBayes.vue'
import Conclusion from './Partials/Conclusion.vue'
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
  name: String,
  phone: Number
})

const form = useForm({
  selected_symptoms: Object.keys(props.selectedSymptoms).map((key) => props.selectedSymptoms[key].id),
  name: props.name,
  phone: props.phone,
  result: props.totalBayes[0].result,
  disease_id: props.totalBayes[0].id
})

const submit = () => {
  form.post(route('consults.store'), { preserveState: true })
}
</script>

<template>
  <Head title="Consults" />
  <AuthenticatedLayout>
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">Consults</h2>
      <Breadcrumbs current_name="Consults" />
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
          <Conclusion
            :totalBayes="totalBayes"
            @submit="submit"
          />
          <div class="mt-3 flex justify-center gap-3">
            <Link
              class="btn btn-outline btn-sm"
              :href="route('consults.index')"
              >Back</Link
            >
            <PrimaryButton
              size="sm"
              @click="submit"
              >Save</PrimaryButton
            >
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
