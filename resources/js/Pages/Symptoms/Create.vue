<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, useForm } from '@inertiajs/vue3'
import InputError from '@/Components/InputError.vue'
import InputLabel from '@/Components/InputLabel.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import TextInput from '@/Components/TextInput.vue'
import Breadcrumbs from '@/Components/Breadcrumbs.vue'
import SecondaryButton from '@/Components/SecondaryButton.vue'

const form = useForm({
  name: ''
})

const submit = () => {
  form.post(route('symptoms.store'), {
    preserveScroll: true,
    onSuccess: () => form.reset('name')
  })
}
</script>

<template>
  <Head title="Symptoms" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">Create Symptoms</h2>
      <Breadcrumbs
        :current_name="'Create Symptoms'"
        :parent_name="'Symptoms'"
        :parent_url="'symptoms.index'"
      />
    </template>

    <div class="py-12">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="max-w-2xl overflow-hidden bg-white p-4 shadow-sm sm:rounded-lg dark:bg-gray-800">
          <form
            class="space-y-6"
            @submit.prevent="submit"
          >
            <div>
              <InputLabel
                for="name"
                value="Name"
              />

              <TextInput
                id="name"
                type="text"
                class="mt-1 block w-full"
                :error="form.errors.name"
                v-model="form.name"
                required
                autocomplete
              />

              <InputError
                class="mt-2"
                :message="form.errors.name"
              />
            </div>
            <div class="flex items-center gap-4">
              <PrimaryButton
                type="submit"
                :processing="form.processing"
                :disabled="form.processing"
                >Save</PrimaryButton
              >
              <SecondaryButton :href="route('symptoms.index')">Cancel</SecondaryButton>
            </div>
          </form>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
