<script setup>
import { ref } from 'vue';
import { Head, usePage, useForm } from '@inertiajs/vue3';
import Header from '@/Components/Header.vue';

const { props } = usePage();
const question = props.question;

// Form to add an answer
const form = useForm({
  answer_text: '',
  is_correct: false,
});

const submitAnswer = () => {
  form.post(route('answers.store', question.id), {
    onSuccess: () => form.reset(),
  });
};

// Delete an answer
const deleteAnswer = (id) => {
  if (confirm("Are you sure you want to delete this answer?")) {
    useForm().delete(route('answers.destroy', id));
  }
};
</script>

<template>
  <Head title="Manage Answers" />

  <div class="min-h-screen bg-gray-100">
    <Header />

    <div class="max-w-4xl mx-auto py-10 px-6 bg-white rounded-lg shadow-md">
      <h1 class="text-2xl font-bold mb-6">Manage Answers for "{{ question.question_text }}"</h1>

      <!-- Add Answer Form -->
      <form @submit.prevent="submitAnswer" class="mb-6">
        <div>
          <label class="block text-gray-700">Answer</label>
          <input v-model="form.answer_text" type="text" class="w-full p-2 border rounded" required />
        </div>
        <div class="mt-2">
          <input v-model="form.is_correct" type="checkbox" /> Mark as Correct Answer
        </div>
        <button type="submit" class="mt-3 bg-blue-600 text-white px-4 py-2 rounded-lg">
          Add Answer
        </button>
      </form>

      <!-- List Answers -->
      <ul v-if="question.answers.length > 0" class="space-y-4">
        <li v-for="answer in question.answers" :key="answer.id" class="border p-3 rounded-md flex justify-between">
          <span :class="{'text-green-600 font-bold': answer.is_correct}">{{ answer.answer_text }}</span>
          <button @click="deleteAnswer(answer.id)" class="text-red-600 hover:underline">
            Delete
          </button>
        </li>
      </ul>

      <p v-else class="text-gray-500 text-center mt-4">No answers added yet.</p>
    </div>
  </div>
</template>
