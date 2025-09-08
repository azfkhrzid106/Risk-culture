<template>
  <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 via-white to-indigo-100 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
      <!-- Header Card -->
      <div class="bg-white rounded-xl shadow-lg p-8 border border-gray-100">
        <!-- Logo/Icon -->
        <div class="text-center mb-6">
          <div class="mx-auto h-16 w-16 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-full flex items-center justify-center mb-4">
            <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
            </svg>
          </div>
          <h2 class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
            K3-inalum
          </h2>
          <p class="text-sm text-gray-500 mt-1">Admin Panel Login</p>
        </div>

        <div class="text-center mb-6">
          <h3 class="text-xl font-semibold text-gray-800">
            Selamat Datang Kembali
          </h3>
          <p class="text-sm text-gray-600 mt-1">Masuk ke akun admin Anda</p>
        </div>

        <!-- Form -->
        <form class="space-y-5" @submit.prevent="submit">
          <!-- Email Field -->
          <div class="space-y-1">
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                </svg>
              </div>
              <input
                id="email"
                v-model="form.email"
                type="email"
                placeholder="Masukkan email Anda"
                class="input-field pl-10"
                autocomplete="username"
                maxlength="100"
                @input="clearError('email')"
              />
            </div>
            <div v-if="form.errors.email" class="text-red-500 text-sm flex items-center">
              <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
              </svg>
              {{ form.errors.email }}
            </div>
          </div>

          <!-- Password Field -->
          <div class="space-y-1">
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
              </div>
              <input
                id="password"
                v-model="form.password"
                :type="showPassword ? 'text' : 'password'"
                placeholder="Masukkan password Anda"
                class="input-field pl-10 pr-12"
                autocomplete="current-password"
                maxlength="72"
                @input="clearError('password')"
              />
              <!-- Toggle Password Visibility -->
              <button
                type="button"
                class="absolute inset-y-0 right-0 pr-3 flex items-center"
                @click="togglePasswordVisibility"
              >
                <svg v-if="!showPassword" class="h-5 w-5 text-gray-400 hover:text-gray-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                </svg>
                <svg v-else class="h-5 w-5 text-gray-400 hover:text-gray-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"/>
                </svg>
              </button>
            </div>
            
            <div v-if="form.errors.password" class="text-red-500 text-sm flex items-center">
              <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
              </svg>
              {{ form.errors.password }}
            </div>

            <!-- Password Strength Indicator -->
            <div v-if="form.password.length > 0" class="mt-2">
              <div class="flex items-center space-x-2">
                <div class="flex-1">
                  <div class="bg-gray-200 rounded-full h-2">
                    <div 
                      class="h-2 rounded-full transition-all duration-300"
                      :class="passwordStrengthBarClass"
                      :style="{ width: passwordStrengthWidth + '%' }"
                    ></div>
                  </div>
                </div>
                <span class="text-xs font-medium" :class="passwordStrengthClass">
                  {{ passwordStrengthText }}
                </span>
              </div>
            </div>
          </div>

          <!-- Remember Me -->
          <div class="flex items-center justify-between">
            <label class="flex items-center cursor-pointer">
              <div class="relative">
                <input 
                  v-model="form.remember" 
                  type="checkbox" 
                  class="sr-only"
                />
                <div class="w-5 h-5 border-2 border-gray-300 rounded transition-colors" :class="form.remember ? 'bg-blue-600 border-blue-600' : 'bg-white'">
                  <svg v-if="form.remember" class="w-3 h-3 text-white absolute top-0.5 left-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                  </svg>
                </div>
              </div>
              <span class="ml-3 text-sm text-gray-700 font-medium">Ingat saya</span>
            </label>

          </div>

          <!-- Submit Button -->
          <div class="pt-2">
            <button 
              type="submit" 
              class="btn-primary"
              :disabled="form.processing"
            >
              <span v-if="form.processing" class="loader mr-2"></span>
              <svg v-if="!form.processing" class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
              </svg>
              {{ form.processing ? 'Memproses...' : 'Masuk' }}
            </button>
          </div>
        </form>

        <!-- Global Error -->
        <div
          v-if="$page.props.errors.auth"
          class="mt-4 bg-red-50 border-l-4 border-red-400 p-4 rounded-r-md"
        >
          <div class="flex">
            <svg class="h-5 w-5 text-red-400 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <p class="text-sm text-red-700">
              {{ $page.props.errors.auth }}
            </p>
          </div>
        </div>

        <!-- Back to Home -->
        <div class="text-center mt-6 pt-4 border-t border-gray-100">
          <Link 
            href="/" 
            class="inline-flex items-center text-blue-600 hover:text-blue-800 text-sm font-medium transition-colors group"
          >
            <svg class="h-4 w-4 mr-1 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali ke Beranda
          </Link>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { useForm, Link } from '@inertiajs/vue3';
import { computed, ref } from 'vue';

const form = useForm({
  email: '',
  password: '',
  remember: false
});

const showPassword = ref(false);

// Toggle password visibility
function togglePasswordVisibility() {
  showPassword.value = !showPassword.value;
}

// Password Strength Logic
const passwordStrengthText = computed(() => {
  if (form.password.length < 6) return 'Lemah';
  if (form.password.length < 10) return 'Sedang';
  if (form.password.length < 12) return 'Kuat';
  return 'Sangat Kuat';
});

const passwordStrengthClass = computed(() => {
  if (form.password.length < 6) return 'text-red-500';
  if (form.password.length < 10) return 'text-yellow-500';
  if (form.password.length < 12) return 'text-blue-500';
  return 'text-green-500';
});

const passwordStrengthBarClass = computed(() => {
  if (form.password.length < 6) return 'bg-red-500';
  if (form.password.length < 10) return 'bg-yellow-500';
  if (form.password.length < 12) return 'bg-blue-500';
  return 'bg-green-500';
});

const passwordStrengthWidth = computed(() => {
  if (form.password.length < 6) return 25;
  if (form.password.length < 10) return 50;
  if (form.password.length < 12) return 75;
  return 100;
});

function clearError(field) {
  form.errors[field] = null;
}

function submit() {
  // Clear previous errors
  form.clearErrors();

  // Simple validation
  if (!form.email) {
    form.setError('email', 'Email wajib diisi');
    return;
  }
  if (!/\S+@\S+\.\S+/.test(form.email)) {
    form.setError('email', 'Format email tidak valid');
    return;
  }
  if (!form.password) {
    form.setError('password', 'Password wajib diisi');
    return;
  }
  if (form.password.length < 6) {
    form.setError('password', 'Password minimal 6 karakter');
    return;
  }

  form.post('/login');
}
</script>

<style scoped>
.input-field {
  @apply appearance-none relative block w-full px-3 py-3 border border-gray-300 
  placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none focus:ring-2 
  focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition-all duration-200
  bg-gray-50 focus:bg-white hover:bg-white shadow-sm;
}

.btn-primary {
  @apply w-full flex justify-center items-center py-3 px-4 border border-transparent 
  text-sm font-semibold rounded-lg text-white bg-gradient-to-r from-blue-600 to-indigo-600
  hover:from-blue-700 hover:to-indigo-700 focus:outline-none focus:ring-2 
  focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 shadow-md
  hover:shadow-lg transform hover:-translate-y-0.5 disabled:opacity-50 
  disabled:cursor-not-allowed disabled:transform-none disabled:shadow-md;
}

.loader {
  border: 2px solid rgba(255, 255, 255, 0.3);
  border-top: 2px solid #fff;
  border-radius: 50%;
  width: 16px;
  height: 16px;
  animation: spin 0.8s linear infinite;
}

@keyframes spin {
  to {
    transform: rotate(360deg);
  }
}

/* Smooth transitions for all interactive elements */
* {
  transition: all 0.2s ease-in-out;
}
</style>