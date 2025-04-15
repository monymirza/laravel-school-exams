<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import Header from "@/Components/Header.vue";

const form = useForm({
  email: '',
  password: '',
});

function submitLogin() {
  form.post(route('login'));
}
</script>

<template>
  <Header />

  <div class="min-h-screen bg-gray-100 flex flex-col items-center justify-center">
    <div class="w-full max-w-md bg-white shadow-md rounded-lg p-8">
      <h2 class="text-2xl font-bold text-center mb-6">Login</h2>

      <form @submit.prevent="submitLogin">
        <div class="mb-4">
          <label for="email" class="block text-gray-700 font-semibold mb-1">Email</label>
          <input
              v-model="form.email"
              type="email"
              id="email"
              class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-200"
              required
          />
        </div>

        <div class="mb-4">
          <label for="password" class="block text-gray-700 font-semibold mb-1">Password</label>
          <input
              v-model="form.password"
              type="password"
              id="password"
              class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-200"
              required
          />
        </div>

        <button
            type="submit"
            class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition"
            :disabled="form.processing"
        >
          Login
        </button>
      </form>
    </div>
  </div>
</template>
