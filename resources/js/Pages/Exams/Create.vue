<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import Header from '@/Components/Header.vue';

const form = useForm({
  title: '',
  description: '',
});

const submitExam = () => {
  form.post(route('exams.store'), {
    onSuccess: () => form.reset(),
  });
};
</script>

<template>
  <Head title="Create Exam" />

  <div class="min-h-screen bg-gray-100">
    <Header />

    <div class="max-w-4xl mx-auto py-10 px-6 bg-white rounded-lg shadow-md">
      <h1 class="text-2xl font-bold mb-6">Create Exam</h1>

      <form @submit.prevent="submitExam">
        <div class="mb-4">
          <label class="block text-gray-700">Title</label>
          <input v-model="form.title" type="text" class="w-full p-2 border rounded" required />
        </div>

        <div class="mb-4">
          <label class="block text-gray-700">Description</label>
          <textarea v-model="form.description" class="w-full p-2 border rounded"></textarea>
        </div>

        <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg">
          Create Exam
        </button>
      </form>
    </div>
  </div>
</template>
