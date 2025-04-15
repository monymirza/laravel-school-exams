<script setup>
import { Head, Link, usePage } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

// Get user role and available exams from Laravel
const { props } = usePage();
</script>

<template>
  <Head title="Dashboard" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">Dashboard</h2>
    </template>

    <div class="py-12">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

          <!-- Superadmin Section -->
          <div v-if="props.userRole === 'superadmin'" class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-lg font-bold text-gray-700 mb-4">User Management</h3>
            <p class="text-gray-600">Manage Teachers and Students.</p>
            <Link
                :href="route('users.index')"
                class="block mt-4 bg-blue-600 text-white px-4 py-2 rounded-lg text-center hover:bg-blue-700"
            >
              Manage Users
            </Link>
          </div>

          <!-- Teacher Section -->
          <div v-if="props.userRole === 'teacher'" class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-lg font-bold text-gray-700 mb-4">Exam Management</h3>
            <p class="text-gray-600">Create and manage exams for students.</p>
            <Link
                :href="route('exams.index')"
                class="block mt-4 bg-green-600 text-white px-4 py-2 rounded-lg text-center hover:bg-green-700"
            >
              Manage Exams
            </Link>
          </div>

          <!-- Student Section -->
          <div v-if="props.userRole === 'student'" class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-lg font-bold text-gray-700 mb-4">Exam History</h3>
            <p class="text-gray-600">Your past exam results.</p>

            <div v-if="props.examHistory.length > 0" class="mt-4 space-y-3">
              <div v-for="exam in props.examHistory" :key="exam.id" class="border p-3 rounded-md">
                <h4 class="text-md font-semibold">{{ exam.exam.title }}</h4>
                <p class="text-sm text-gray-500">Score: {{ exam.score }}%</p>
              </div>
            </div>

            <p v-else class="text-gray-500 text-center mt-4">No exams taken yet.</p>
          </div>

        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
