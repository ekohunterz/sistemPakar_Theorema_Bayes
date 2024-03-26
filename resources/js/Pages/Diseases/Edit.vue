<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, router, useForm } from '@inertiajs/vue3'
import InputError from '@/Components/InputError.vue'
import InputLabel from '@/Components/InputLabel.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import TextInput from '@/Components/TextInput.vue'
import Breadcrumbs from '@/Components/Breadcrumbs.vue'
import SecondaryButton from '@/Components/SecondaryButton.vue'

const props = defineProps({
  disease: Object
})

const form = useForm({
  _method: 'put',
  name: props.disease.name,
  description: props.disease.description,
  solution: props.disease.solution,
  image: null
})

const submit = () => {
  router.post(route('diseases.update', props.disease.id), form)
}
</script>

<template>
  <Head title="Edit Disease" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">Edit Disease</h2>
      <Breadcrumbs
        :current_name="'Edit Disease'"
        :parent_name="'Disease'"
        :parent_url="'diseases.index'"
      />
    </template>

    <div class="py-12">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white p-4 shadow-sm sm:rounded-lg dark:bg-gray-800">
          <form
            class="grid grid-cols-1 gap-6 md:grid-cols-2"
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
            <div>
              <InputLabel
                for="description"
                value="Description"
              />

              <textarea
                id="description"
                v-model="form.description"
                class="textarea textarea-bordered w-full"
              />

              <InputError
                class="mt-2"
                :message="form.errors.description"
              />
            </div>

            <div>
              <InputLabel
                for="solution"
                value="Solution"
              />

              <textarea
                id="solution"
                v-model="form.solution"
                class="textarea textarea-bordered w-full"
              />

              <InputError
                class="mt-2"
                :message="form.errors.solution"
              />
            </div>
            <div>
              <InputLabel
                for="image"
                value="Image"
              />

              <input
                id="image"
                type="file"
                class="file-input file-input-bordered w-full max-w-xs"
                @input="form.image = $event.target.files[0]"
              />

              <InputError
                class="mt-2"
                :message="form.errors.image"
              />
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
