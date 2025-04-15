<template>
  <header class="bg-white shadow-md py-4 px-6">
    <div class="container mx-auto flex justify-between items-center">
      <h1 class="text-xl font-bold text-gray-800">
        <a href="/">School Exams System</a>
      </h1>

      <nav>
        <ul class="flex space-x-4">
          <li v-if="$page.props.auth.user">
            <Link :href="route('dashboard')" class="text-gray-700 hover:text-gray-900">
              Dashboard
            </Link>
          </li>
          <li v-else>
            <Link :href="route('login')" class="text-gray-700 hover:text-gray-900">
              Login
            </Link>
          </li>
        </ul>
      </nav>
    </div>
  </header>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
</script>
