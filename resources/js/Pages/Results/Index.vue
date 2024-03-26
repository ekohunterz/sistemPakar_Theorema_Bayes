<script setup>
import Breadcrumbs from '@/Components/Breadcrumbs.vue'
import Pagination from '@/Components/Pagination.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import TextInput from '@/Components/TextInput.vue'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, router } from '@inertiajs/vue3'
import { ref } from 'vue'
import { watchDebounced } from '@vueuse/core'
import Alert from '@/Components/Alert.vue'
import DataList from './Partials/DataList.vue'
import VueDatePicker from '@vuepic/vue-datepicker'
import '@vuepic/vue-datepicker/dist/main.css'

const props = defineProps({
  results: Object,
  filters: {
    type: Object,
    default: () => ({})
  }
})

const search = ref(props.filters.search || '')
const month = ref({
  month: props.filters.month || new Date(),
  year: props.filters.year || new Date()
})

const exports = () => {
  router.get(
    route(
      'pdf',
      { month: month.value.month, year: month.value.year },
      {
        preserveState: true,
        preserveScroll: true
      }
    )
  )
}

watchDebounced(
  [search, month],
  (value) => {
    const [searchValue, monthValue] = value
    router.get(
      route(
        'results.index',
        { month: monthValue.month, year: monthValue.year, search: searchValue },
        {
          preserveState: true,
          preserveScroll: true
        }
      )
    )
  },
  { debounce: 300, maxWait: 1000 }
)
</script>

<template>
  <Head title="Results" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">Results</h2>
      <Breadcrumbs current_name="Results" />
    </template>

    <div class="py-12">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
          <div class="flex items-center justify-between p-6 text-gray-900 dark:text-gray-100">
            <TextInput
              v-model="search"
              placeholder="Search..."
              autofocus
            />

            <div class="flex items-center gap-3">
              <VueDatePicker
                v-model="month"
                placeholder="Select Month"
                auto-position
                month-picker
                @cleared="month = { month: null, year: null }"
                auto-apply
              />

              <PrimaryButton @click="exports">Export</PrimaryButton>
            </div>
          </div>

          <div class="space-y-4 p-6 text-gray-900 dark:text-gray-100">
            <Alert
              v-if="$page.props.flash.message"
              :message="$page.props.flash.message"
            />
            <DataList :results="results.data" />
            <div class="mt-4">
              <Pagination
                :from="results.from"
                :to="results.to"
                :total="results.total"
                :links="results.links"
              />
            </div>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
