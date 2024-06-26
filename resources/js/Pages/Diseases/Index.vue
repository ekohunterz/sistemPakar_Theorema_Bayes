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

const props = defineProps({
  diseases: Object,
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
        'diseases.index',
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
  <Head title="Diseases" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">Diseases</h2>
      <Breadcrumbs current_name="Diseases" />
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
            <PrimaryButton :href="route('diseases.create')">Add</PrimaryButton>
          </div>
          <div class="space-y-4 p-6 overflow-auto text-gray-900 dark:text-gray-100">
            <Alert
              v-if="$page.props.flash.message"
              :message="$page.props.flash.message"
            />
            <DataList :diseases="diseases.data" />
            <div class="mt-4">
              <Pagination
                :from="diseases.from"
                :to="diseases.to"
                :total="diseases.total"
                :links="diseases.links"
              />
            </div>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
