<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue'
import DiseaseCard from '@/Components/DiseaseCard.vue'
import { Head, Link } from '@inertiajs/vue3'

defineProps({
  canLogin: {
    type: Boolean
  },
  canRegister: {
    type: Boolean
  },
  laravelVersion: {
    type: String,
    required: true
  },
  phpVersion: {
    type: String,
    required: true
  },
  diseases: Object
})
</script>

<template>
  <Head title="Welcome" />

  <div
    class="bg-dots-darker flex flex-col dark:bg-dots-lighter relative min-h-screen bg-gray-100 bg-center selection:bg-red-500 selection:text-white sm:flex sm:items-center sm:justify-center dark:bg-gray-900"
  >
    <div
      v-if="canLogin"
      class="p-6 space-x-4 text-end sm:fixed sm:right-0 sm:top-0"
    >
      <Link
        v-if="$page.props.auth.user"
        :href="route('dashboard')"
        class="font-semibold text-gray-600 hover:text-gray-900 focus:rounded-sm focus:outline focus:outline-2 focus:outline-red-500 dark:text-gray-400 dark:hover:text-white"
        >Dashboard</Link
      >

      <template v-else>
        <Link
          :href="route('login')"
          class="font-semibold text-gray-600 hover:text-gray-900 focus:rounded-sm focus:outline focus:outline-2 focus:outline-red-500 dark:text-gray-400 dark:hover:text-white"
          >Log in</Link
        >

        <Link
          v-if="canRegister"
          :href="route('register')"
          class="font-semibold text-gray-600 hover:text-gray-900 focus:rounded-sm focus:outline focus:outline-2 focus:outline-red-500 dark:text-gray-400 dark:hover:text-white"
          >Register</Link
        >
      </template>
    </div>

    <div class="hero min-h-[70vh] bg-base-200">
      <div class="hero-content w-full text-center">
        <div class="max-w-md">
          <h1 class="text-5xl font-bold">Expert System Bayes</h1>
          <p class="py-6">Expert System Bayes is an open source project to calculate the probability of disease based on symptoms and evidence in the real world.</p>
          <PrimaryButton
            :href="route('login')"
            size="lg"
            >Get Started</PrimaryButton
          >
        </div>
      </div>
    </div>
    <div class="mb-12 space-y-6">
      <div class="text-2xl font-bold">Diseases Information</div>
      <div class="flex flex-wrap gap-6">
        <DiseaseCard
          v-for="disease in diseases"
          :key="disease.id"
          :disease="disease"
        />
      </div>
    </div>
  </div>
</template>

<style>
.bg-dots-darker {
  background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}
@media (prefers-color-scheme: dark) {
  .dark\:bg-dots-lighter {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
  }
}
</style>
