<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head } from '@inertiajs/vue3'
import StatsCard from '@/Components/StatsCard.vue'
import IconDisease from '@/Components/Icons/IconDisease.vue'
import IconMedic from '@/Components/Icons/IconMedic.vue'
import IconReport from '@/Components/Icons/IconReport.vue'
import { Pie } from 'vue-chartjs'
import { Chart as ChartJS, ArcElement, Tooltip, Legend, Title, CategoryScale, LinearScale } from 'chart.js'

ChartJS.register(Title, Tooltip, Legend, ArcElement, CategoryScale, LinearScale)

const props = defineProps({
  diseasesCount: Number,
  symptomsCount: Number,
  resultsCount: Number,
  caseResults: Object
})

const setRandomColor = () => {
  const letters = '0123456789ABCDEF'
  let color = '#'
  for (let i = 0; i < 6; i++) {
    color += letters[Math.floor(Math.random() * 16)]
  }
  return color
}

const chartData = {
  labels: Object.keys(props.caseResults),
  datasets: [
    {
      label: 'Case Results',
      backgroundColor: Object.keys(props.caseResults).map(() => setRandomColor()),
      data: Object.values(props.caseResults)
    }
  ]
}

const chartOptions = {
  responsive: true,
  maintainAspectRatio: false
}
</script>

<template>
  <Head title="Dashboard" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">Dashboard</h2>
    </template>

    <div class="py-12">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
          <div class="p-6 text-gray-900 flex flex-wrap dark:text-gray-100">
            <StatsCard
              title="Diseases"
              :value="diseasesCount"
              color="bg-secondary"
              ><template #icon><IconMedic size="28" /> </template
            ></StatsCard>
            <StatsCard
              title="Symptoms"
              :value="symptomsCount"
              color="bg-primary"
            >
              <template #icon><IconDisease size="28" /> </template>
            </StatsCard>
            <StatsCard
              title="Cases"
              :value="resultsCount"
              color="bg-accent"
            >
              <template #icon><IconReport size="28" /> </template>
            </StatsCard>
          </div>
          <div class="p-6 w-1/2 mx-auto">
            <Pie
              id="my-chart-id"
              :options="chartOptions"
              :data="chartData"
            />
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
