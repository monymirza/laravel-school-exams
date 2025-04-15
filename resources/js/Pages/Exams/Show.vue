<script setup>
import { Head, Link, usePage } from '@inertiajs/vue3';
import Header from '@/Components/Header.vue';

// Get the exam data from the backend
const { props } = usePage();
</script>

<template>
  <Head :title="props.exam.title" />

  <div class="min-h-screen bg-gray-100">
    <Header />

    <div class="max-w-4xl mx-auto py-10 px-6 bg-white rounded-lg shadow-md">
      <h1 class="text-2xl font-bold mb-6">{{ props.exam.title }}</h1>
      <p class="text-gray-700">{{ props.exam.description }}</p>

      <div class="mt-6">
        <Link :href="route('exams.index')" class="text-blue-600 hover:underline">
          ← Back to Exams
        </Link>
      </div>
    </div>
  </div>
</template>
