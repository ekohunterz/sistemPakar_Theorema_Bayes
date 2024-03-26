<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, useForm } from '@inertiajs/vue3'
import InputRange from '@/Components/InputRange.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import Breadcrumbs from '@/Components/Breadcrumbs.vue'
import SecondaryButton from '@/Components/SecondaryButton.vue'

const props = defineProps({
  rules: Array,
  disease: Object,
  symptoms: Array
})

const form = useForm({
  weight: props.symptoms.map((symptom) => {
    // Cek apakah gejala ada dalam aturan
    const rule = props.rules.find((rule) => rule.symptom_id === symptom.id)
    return {
      id: symptom.id,
      name: symptom.name,
      checked: rule ? true : false,
      weight: rule ? rule.weight : 0 // Jika gejala ada dalam aturan, gunakan nilai probabilitas dari aturan, jika tidak, gunakan 0
    }
  })
})

const submit = () => {
  form.post(route('diseases.rules', props.disease.id), {
    preserveScroll: true
  })
}
</script>

<template>
  <Head title="Rules" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">Rules: {{ disease.name }}</h2>
      <Breadcrumbs
        :current_name="'Rules'"
        :parent_name="'Diseases'"
        :parent_url="'diseases.index'"
      />
    </template>

    <div class="py-12">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white p-4 shadow-sm sm:rounded-lg dark:bg-gray-800">
          <form
            class="space-y-6"
            @submit.prevent="submit"
          >
            <div>
              <table class="table w-full text-left text-sm text-gray-500 dark:text-gray-400">
                <thead class="bg-gray-50 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-400">
                  <tr>
                    <th
                      scope="col"
                      class="px-6 py-3"
                    >
                      Symptom
                    </th>
                    <th
                      scope="col"
                      class="px-6 py-3"
                    >
                      weight
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <tr
                    v-for="(symptom, index) in form.weight"
                    :key="index"
                    class="hover border-b bg-white dark:border-gray-700 dark:bg-gray-800"
                  >
                    <td class="px-6 py-4">
                      <div class="form-control">
                        <label class="cursor-pointer space-x-3">
                          <input
                            v-model="symptom.checked"
                            type="checkbox"
                            class="checkbox"
                            :value="symptom.id"
                          />
                          <span class="label-text">{{ symptom.name }}</span>
                        </label>
                      </div>
                    </td>
                    <td class="px-6 py-4">
                      <InputRange v-model="symptom.weight" />
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="flex items-center gap-4">
              <PrimaryButton
                type="submit"
                :processing="form.processing"
                :disabled="form.processing"
                >Save</PrimaryButton
              >
              <SecondaryButton :href="route('diseases.index')">Cancel</SecondaryButton>
            </div>
          </form>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
