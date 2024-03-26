<script setup>
import InputError from '@/Components/InputError.vue'
import InputLabel from '@/Components/InputLabel.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import TextInput from '@/Components/TextInput.vue'
import { Head, useForm } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import Breadcrumbs from '@/Components/Breadcrumbs.vue'

defineProps({
  symptoms: Object
})

const form = useForm({
  name: '',
  phone: '',
  selectedSymptoms: []
})

const submit = () => {
  form.post(route('consults.diagnose'), { preserveState: true })
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
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white p-6 shadow-sm sm:rounded-lg dark:bg-gray-800">
          <form @submit.prevent="submit">
            <div class="grid grid-cols-2 gap-6">
              <div>
                <InputLabel
                  for="name"
                  value="Name"
                />

                <TextInput
                  id="name"
                  type="text"
                  class="mt-1 block w-full"
                  v-model="form.name"
                  required
                  autofocus
                />

                <InputError
                  class="mt-2"
                  :message="form.errors.name"
                />
              </div>

              <div>
                <InputLabel
                  for="phone"
                  value="Phone"
                />

                <TextInput
                  id="phone"
                  type="number"
                  class="mt-1 block w-full"
                  v-model="form.phone"
                  required
                  autocomplete="current-phone"
                />

                <InputError
                  class="mt-2"
                  :message="form.errors.phone"
                />
              </div>
            </div>
            <div class="mt-4 space-y-2">
              <InputLabel value="Select Symptoms" />
              <div class="grid grid-cols-2 gap-3">
                <label
                  class="flex items-center"
                  v-for="symptom in symptoms"
                  :key="symptom.id"
                >
                  <input
                    type="checkbox"
                    name="remember[]"
                    class="checkbox checkbox-sm"
                    v-model="form.selectedSymptoms"
                    :value="symptom.id"
                  />
                  <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ symptom.name }}</span>
                </label>
              </div>
              <InputError
                class="mt-2"
                :message="form.errors.selectedSymptoms"
              />
            </div>

            <div class="mt-4 flex items-center justify-end">
              <PrimaryButton
                class="ms-4"
                :processing="form.processing"
                type="submit"
                :disabled="form.processing"
              >
                Submit
              </PrimaryButton>
            </div>
          </form>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
