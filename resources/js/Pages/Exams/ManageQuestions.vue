<script setup>
import { ref } from 'vue';
import { Head, usePage, useForm, Link } from '@inertiajs/vue3';
import Header from '@/Components/Header.vue';

const { props } = usePage();
const exam = props.exam;

// Form to add a new question
const form = useForm({
  question_text: '',
});

const submitQuestion = () => {
  form.post(route('exams.questions.store', exam.id), {
    onSuccess: () => form.reset(),
  });
};

// Delete a question
const deleteQuestion = (id) => {
  if (confirm("Are you sure you want to delete this question?")) {
    useForm().delete(route('questions.destroy', id));
  }
};
</script>

<template>
  <Head title="Manage Questions" />

  <div class="min-h-screen bg-gray-100">
    <Header />

    <div class="max-w-4xl mx-auto py-10 px-6 bg-white rounded-lg shadow-md">
      <h1 class="text-2xl font-bold mb-6">{{ exam.title }} - Manage Questions</h1>

      <!-- Add Question Form -->
      <form @submit.prevent="submitQuestion" class="mb-6">
        <div>
          <label class="block text-gray-700">Question</label>
          <input v-model="form.question_text" type="text" class="w-full p-2 border rounded" required />
        </div>
        <button type="submit" class="mt-3 bg-blue-600 text-white px-4 py-2 rounded-lg">
          Add Question
        </button>
      </form>

      <!-- List Questions -->
      <ul v-if="exam.questions.length > 0" class="space-y-4">
        <li v-for="question in exam.questions" :key="question.id" class="border p-3 rounded-md">
          <div class="flex justify-between">
            <span class="text-gray-800">{{ question.question_text }}</span>
            <button @click="deleteQuestion(question.id)" class="text-red-600 hover:underline">
              Delete
            </button>
          </div>

          <!-- Manage Answers -->
          <Link :href="route('exams.answers', question.id)" class="text-blue-600 hover:underline">
            Manage Answers →
          </Link>
        </li>
      </ul>

      <p v-else class="text-gray-500 text-center mt-4">No questions added yet.</p>
    </div>
  </div>
</template>
