<script setup>
defineProps({
  disease: Object
})
</script>

<template>
  <div class="card w-72 bg-base-100 shadow-xl">
    <figure>
      <img
        :src="disease.image ?? 'https://via.placeholder.com/150'"
        :alt="disease.name"
        class="w-full h-48 object-cover"
      />
    </figure>
    <div class="card-body">
      <h2 class="card-title">
        {{ disease.name }}
      </h2>
      <p>{{ disease.description }}</p>
    </div>
  </div>
</template>
