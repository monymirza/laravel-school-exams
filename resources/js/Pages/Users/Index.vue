<script setup>
import { ref } from 'vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import Header from "@/Components/Header.vue";

defineProps({
  users: Array,
  roles: Array,
});

const form = useForm({
  name: '',
  email: '',
  password: '',
  role: '',
});

function submitUser() {
  form.post(route('users.store'), {
    onSuccess: () => form.reset(),
  });
}
</script>

<template>
  <Header />
  <Head title="Manage Users" />

  <div class="max-w-4xl mx-auto py-10">
    <h1 class="text-2xl font-bold mb-6">Manage Users</h1>

    <div class="bg-white p-6 rounded-lg shadow">
      <h2 class="text-lg font-semibold mb-4">Add User</h2>

      <form @submit.prevent="submitUser">
        <div class="mb-4">
          <label class="block text-gray-700">Name</label>
          <input v-model="form.name" type="text" class="w-full p-2 border rounded" required />
        </div>

        <div class="mb-4">
          <label class="block text-gray-700">Email</label>
          <input v-model="form.email" type="email" class="w-full p-2 border rounded" required />
        </div>

        <div class="mb-4">
          <label class="block text-gray-700">Password</label>
          <input v-model="form.password" type="password" class="w-full p-2 border rounded" required />
        </div>

        <div class="mb-4">
          <label class="block text-gray-700">Role</label>
          <select v-model="form.role" class="w-full p-2 border rounded" required>
            <option v-for="role in roles" :key="role.id" :value="role.name">
              {{ role.name.charAt(0).toUpperCase() + role.name.slice(1) }}
            </option>
          </select>
        </div>

        <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg">
          Add User
        </button>
      </form>
    </div>

    <h2 class="text-lg font-semibold mt-8 mb-4">Existing Users</h2>
    <table class="w-full bg-white shadow rounded-lg">
      <thead>
      <tr class="bg-gray-100 text-left">
        <th class="p-3">Name</th>
        <th class="p-3">Email</th>
        <th class="p-3">Role</th>
      </tr>
      </thead>
      <tbody>
      <tr v-for="user in users" :key="user.id" class="border-b">
        <td class="p-3">{{ user.name }}</td>
        <td class="p-3">{{ user.email }}</td>
        <td class="p-3">{{ user.role }}</td>
      </tr>
      </tbody>
    </table>
  </div>
</template>
