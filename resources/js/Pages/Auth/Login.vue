<template>
  <div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
      <div class="text-center">
        <h2 class="text-3xl font-extrabold text-gray-900 mb-2">K3-inalum</h2>
        <p class="text-sm text-gray-600">Admin Panel Login</p>
      </div>
      <h2 class="text-center text-2xl font-bold text-gray-900 mt-4">Masuk ke akun Anda</h2>

      <!-- Form -->
      <form class="mt-8 space-y-6" @submit.prevent="submit">
        <div class="rounded-md shadow-sm -space-y-px">
          <div>
            <input v-model="form.email" type="email" placeholder="Email" class="input" />
            <div v-if="form.errors.email" class="text-red-500 text-sm mt-1">{{ form.errors.email }}</div>
          </div>
          <div>
            <input v-model="form.password" type="password" placeholder="Password" class="input" />
            <div v-if="form.errors.password" class="text-red-500 text-sm mt-1">{{ form.errors.password }}</div>
          </div>
        </div>

        <div class="flex items-center justify-between">
          <label class="flex items-center">
            <input v-model="form.remember" type="checkbox" class="mr-2" />
            <span class="text-sm text-gray-700">Ingat saya</span>
          </label>
        </div>

        <div>
          <button type="submit" class="btn" :disabled="form.processing">
            {{ form.processing ? 'Memproses...' : 'Masuk' }}
          </button>
        </div>
      </form>

      <!-- Error global -->
      <div v-if="$page.props.errors.auth" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative text-sm">
        {{ $page.props.errors.auth }}
      </div>

      <div class="text-center mt-4">
        <Link href="/" class="text-blue-600 hover:text-blue-800 text-sm">← Kembali ke Beranda</Link>
      </div>
    </div>
  </div>
</template>

<script setup>
import { useForm, Link } from '@inertiajs/vue3';

const form = useForm({
  email: '',
  password: '',
  remember: false
});

function submit() {
  form.post('/login');
}
</script>

<style scoped>
.input {
  @apply appearance-none rounded relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm mb-2;
}
.btn {
  @apply w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700;
}
</style>
