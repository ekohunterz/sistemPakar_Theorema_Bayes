<script setup>
import Breadcrumbs from '@/Components/Breadcrumbs.vue'
import Pagination from '@/Components/Pagination.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import TextInput from '@/Components/TextInput.vue'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, router } from '@inertiajs/vue3'
import { ref } from 'vue'
import { watchDebounced } from '@vueuse/core'
import DataList from './Partials/DataList.vue'
import Alert from '@/Components/Alert.vue'

const props = defineProps({
  symptoms: Object,
  filters: {
    type: Object,
    default: () => ({})
  }
})

const search = ref(props.filters.search || '')

watchDebounced(
  search,
  (value) => {
    router.get(
      route(
        'symptoms.index',
        { search: value },
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
  <Head title="Symptoms" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">Symptoms</h2>
      <Breadcrumbs current_name="Symptoms" />
    </template>

    <div class="py-12">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
          <div class="flex justify-between p-6 text-gray-900 dark:text-gray-100">
            <TextInput
              v-model="search"
              placeholder="Search..."
              autofocus
            />
            <PrimaryButton :href="route('symptoms.create')">Add</PrimaryButton>
          </div>
          <div class="space-y-4 p-6 text-gray-900 dark:text-gray-100">
            <Alert
              v-if="$page.props.flash.message"
              :message="$page.props.flash.message"
            />
            <DataList :symptoms="symptoms.data" />
            <div class="mt-4">
              <Pagination
                :from="symptoms.from"
                :to="symptoms.to"
                :total="symptoms.total"
                :links="symptoms.links"
              />
            </div>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
