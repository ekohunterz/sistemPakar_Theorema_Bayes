<script setup>
import { Link } from '@inertiajs/vue3'

defineProps({
  parent_name: String,
  parent_url: String,
  current_name: String
})
</script>

<template>
  <div class="breadcrumbs text-sm">
    <ul>
      <li><Link :href="route('dashboard')">Dashboard</Link></li>
      <li v-if="parent_name">
        <Link :href="route(parent_url)">{{ parent_name }}</Link>
      </li>
      <li>
        <span>{{ current_name }}</span>
      </li>
    </ul>
  </div>
</template>
