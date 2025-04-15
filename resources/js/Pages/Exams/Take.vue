<script setup>
import { ref } from 'vue';
import { Head, usePage, useForm } from '@inertiajs/vue3';
import Header from '@/Components/Header.vue';

const { props } = usePage();
const exam = props.exam;

// Store student answers
const form = useForm({
  answers: {},
});

// Submit Exam
const submitExam = () => {
  form.post(route('exams.submit', exam.id), {
    onSuccess: () => alert('Exam submitted successfully!'),
  });
};
</script>

<template>
  <Head :title="exam.title" />

  <div class="min-h-screen bg-gray-100">
    <Header />

    <div class="max-w-4xl mx-auto py-10 px-6 bg-white rounded-lg shadow-md">
      <h1 class="text-2xl font-bold mb-6">{{ exam.title }}</h1>
      <p class="text-gray-700">{{ exam.description }}</p>

      <form @submit.prevent="submitExam" class="mt-6">
        <div v-for="(question, index) in exam.questions" :key="index" class="mb-4">
          <label class="block text-gray-700 font-semibold">{{ question.question_text }}</label>
          <div v-for="answer in question.answers" :key="answer.id" class="mt-2">
            <input
                type="radio"
                :name="'question_' + question.id"
                :value="answer.id"
                v-model="form.answers[question.id]"
            />
            <span class="ml-2">{{ answer.answer_text }}</span>
          </div>
        </div>

        <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg">
          Submit Exam
        </button>
      </form>
    </div>
  </div>
</template>
