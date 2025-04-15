<script setup>
import { ref, onMounted } from 'vue';
import { Head, Link, usePage, useForm } from '@inertiajs/vue3';
import Header from '@/Components/Header.vue';

// Get authenticated user role from Inertia props
const { props } = usePage();
const exams = ref(props.exams || []);

// Form for creating an exam
const form = useForm({
  title: '',
  description: '',
});

const submitExam = () => {
  form.post(route('exams.store'), {
    onSuccess: () => {
      exams.value.push({ title: form.title }); // Add new exam to list
      form.reset();
    },
  });
};
</script>

<template>
  <Head title="Exams" />

  <div class="min-h-screen bg-gray-100">
    <!-- Common Header -->
    <Header />

    <div class="max-w-6xl mx-auto py-10 px-6">
      <h1 class="text-3xl font-bold text-gray-800 mb-6">Manage Exams</h1>

      <!-- Create Exam Button (Visible Only to Teachers) -->
      <div v-if="props.userRole === 'teacher'" class="mb-6">
        <Link
            :href="route('exams.create')"
            class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 transition inline-block"
        >
          + Create Exam
        </Link>
      </div>

      <!-- Exam List -->
      <div v-if="exams.length > 0" class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-lg font-semibold text-gray-700 mb-4">Your Exams</h2>

        <ul class="divide-y divide-gray-200">
          <li v-for="exam in exams" :key="exam.id" class="py-4 flex justify-between">
            <span class="text-gray-800">{{ exam.title }}</span>
            <Link
                :href="route('exams.show', exam.id)"
                class="text-blue-600 hover:underline"
            >
              View
            </Link>
          </li>
        </ul>
      </div>

      <div v-else class="text-gray-500 text-center mt-6">
        No exams available.
      </div>
    </div>
  </div>
</template>
