<template>
  <div class="min-h-screen flex flex-col justify-between font-sans bg-gradient-to-br from-gray-50 to-gray-100 text-gray-800">
    <!-- Navbar -->
    <header class="sticky top-0 z-50 backdrop-blur-md bg-gradient-to-r from-blue-600 to-blue-700 text-white shadow-lg border-b border-blue-500/20">
      <nav class="container mx-auto px-4 py-3 flex items-center justify-between gap-4">
        <!-- Logo -->
        <div class="leading-tight text-sm flex-shrink-0">
          <div class="font-bold text-lg flex items-center gap-2">
            <div class="w-8 h-8 bg-white/10 rounded-lg flex items-center justify-center">
              <svg class="w-5 h-5 text-yellow-300" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
              </svg>
            </div>
            <span>INFO<span class="text-yellow-300">K3</span></span>
          </div>
          <div class="text-xs text-white/80 ml-10">PT INDONESIA ASAHAN ALUMINIUM</div>
        </div>

        <!-- Desktop Menu -->
        <div class="hidden lg:flex space-x-6 text-sm items-center flex-grow justify-center">
          <Link v-for="item in menu" :key="item.label" :href="item.href"
            :class="[$page.url.startsWith(item.href) ? 'text-yellow-300 font-semibold border-b-2 border-yellow-300' : 'hover:text-yellow-300 hover:border-b-2 hover:border-yellow-300/50', 'transition-all duration-200 px-3 py-2 whitespace-nowrap border-b-2 border-transparent']">
            {{ item.label }}
          </Link>
          <!-- Dropdown -->
          <div class="relative group">
            <span class="hover:text-yellow-300 cursor-pointer transition-all duration-200 px-3 py-2 whitespace-nowrap border-b-2 border-transparent hover:border-yellow-300/50 flex items-center gap-1">
              Safety Obs 
              <svg class="w-4 h-4 transition-transform group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
              </svg>
            </span>
            <div class="absolute z-10 invisible group-hover:visible opacity-0 group-hover:opacity-100 transition-all duration-200 transform translate-y-2 group-hover:translate-y-0">
              <div class="bg-white text-gray-800 rounded-xl shadow-xl mt-2 w-48 py-2 right-0 border border-gray-200">
                <Link href="/observation/form" class="flex items-center gap-3 px-4 py-3 text-sm hover:bg-blue-50 hover:text-blue-700 transition-colors">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                  </svg>
                  Form Observation
                </Link>
                <Link href="/observation/report" class="flex items-center gap-3 px-4 py-3 text-sm hover:bg-blue-50 hover:text-blue-700 transition-colors">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                  </svg>
                  Report Observation
                </Link>
              </div>
            </div>
          </div>
        </div>

        <!-- Date Time & Login -->
        <div class="flex items-center gap-4 flex-shrink-0">
          <div class="hidden md:flex items-center gap-2 text-sm font-medium text-white/90 bg-white/10 px-4 py-2 rounded-lg backdrop-blur-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <span class="whitespace-nowrap">{{ currentDateTime }}</span>
          </div>
          <Link href="/login"
            class="hidden md:inline-flex items-center gap-2 bg-white text-blue-600 px-5 py-2.5 text-sm rounded-lg hover:bg-gray-50 transition-all duration-200 shadow-md hover:shadow-lg font-medium">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
            </svg>
            Login
          </Link>
          <button @click.stop="toggleMobileMenu" class="lg:hidden focus:outline-none p-2 rounded-lg hover:bg-white/10 transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="white" viewBox="0 0 24 24" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round"
                :d="isMobileMenuOpen ? 'M6 18L18 6M6 6l12 12' : 'M4 6h16M4 12h16M4 18h16'" />
            </svg>
          </button>
        </div>
      </nav>

      <!-- Mobile Menu -->
      <transition 
        enter-active-class="transition-all duration-300 ease-out"
        enter-from-class="opacity-0 transform -translate-y-2"
        enter-to-class="opacity-100 transform translate-y-0"
        leave-active-class="transition-all duration-200 ease-in"
        leave-from-class="opacity-100 transform translate-y-0"
        leave-to-class="opacity-0 transform -translate-y-2">
        <div v-if="isMobileMenuOpen"
          class="fixed inset-0 h-screen bg-white text-gray-800 z-40 lg:hidden">
          <div class="flex flex-col h-full">
            <!-- Mobile Header -->
            <div class="flex items-center justify-between p-6 border-b border-gray-200 bg-gradient-to-r from-blue-600 to-blue-700 text-white">
              <div class="font-bold text-lg">
                INFO<span class="text-yellow-300">K3</span>
              </div>
              <button @click="toggleMobileMenu" class="p-2 hover:bg-white/10 rounded-lg transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
              </button>
            </div>
            
            <!-- Mobile Menu Content -->
            <div class="flex-1 overflow-y-auto p-6">
              <div class="space-y-4">
                <!-- Main Menu Items -->
                <div class="space-y-2">
                  <Link v-for="item in menu" :key="item.label" :href="item.href" 
                    class="flex items-center gap-3 p-3 rounded-lg hover:bg-blue-50 hover:text-blue-700 transition-colors text-gray-700 font-medium" 
                    @click="closeMenu">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                    {{ item.label }}
                  </Link>
                </div>
                
                <!-- Safety Observation Section -->
                <div class="pt-6 border-t border-gray-200">
                  <div class="flex items-center gap-2 font-semibold text-gray-800 mb-4">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Safety Observation
                  </div>
                  <div class="space-y-2 ml-7">
                    <Link href="/observation/form" 
                      class="block p-3 text-sm text-blue-700 hover:bg-blue-50 rounded-lg transition-colors font-medium" 
                      @click="closeMenu">
                      Form Observation
                    </Link>
                    <Link href="/observation/report" 
                      class="block p-3 text-sm text-blue-700 hover:bg-blue-50 rounded-lg transition-colors font-medium" 
                      @click="closeMenu">
                      Report Observation
                    </Link>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- Mobile Footer -->
            <div class="p-6 border-t border-gray-200 bg-gray-50">
              <div class="mb-4 text-sm text-gray-600 text-center">
                {{ currentDateTime }}
              </div>
              <Link href="/login"
                class="flex items-center justify-center gap-2 bg-gradient-to-r from-blue-600 to-blue-700 text-white px-6 py-3 rounded-lg hover:from-blue-700 hover:to-blue-800 text-sm transition-all duration-200 shadow-lg font-medium">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                </svg>
                Login ke Sistem
              </Link>
            </div>
          </div>
        </div>
      </transition>

      <!-- Breaking News -->
      <div v-if="breakingNews.isActive && breakingNews.title"
        class="bg-gradient-to-r from-red-500 to-red-600 text-white py-3 px-4 text-sm border-t border-red-400/20">
        <div class="container mx-auto flex items-center gap-3">
          <div class="flex-shrink-0 bg-white/20 p-2 rounded-full">
            <svg class="w-4 h-4 text-white animate-pulse" fill="currentColor" viewBox="0 0 24 24">
              <path d="M11 11V5a1 1 0 011-1h1.586a1 1 0 01.707.293l5.414 5.414A1 1 0 0120 10.414V19a1 1 0 01-1 1h-8a1 1 0 01-1-1v-1" />
            </svg>
          </div>
          <span class="font-bold">BREAKING NEWS:</span>
          <span class="flex-1 truncate">{{ breakingNews.title }}</span>
        </div>
      </div>
    </header>

    <!-- Slot for Page Content -->
    <main class="flex-grow">
      <slot />
    </main>

    <!-- Footer -->
    <footer class="bg-gradient-to-r from-gray-800 to-gray-900 text-white">
      <div class="container mx-auto px-4 py-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
          <!-- Company Info -->
          <div class="space-y-4">
            <div class="flex items-center gap-2">
              <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                </svg>
              </div>
              <span class="font-bold text-lg">INFO<span class="text-yellow-300">K3</span></span>
            </div>
            <p class="text-gray-300 text-sm leading-relaxed">
              Sistem Informasi Keselamatan dan Kesehatan Kerja PT Indonesia Asahan Aluminium
            </p>
          </div>
          
          <!-- Quick Links -->
          <div class="space-y-4">
            <h3 class="font-semibold text-lg">Quick Links</h3>
            <div class="grid grid-cols-2 gap-2 text-sm">
              <Link href="/profil" class="text-gray-300 hover:text-white transition-colors">Profil</Link>
              <Link href="/download" class="text-gray-300 hover:text-white transition-colors">Download</Link>
              <Link href="/galeri" class="text-gray-300 hover:text-white transition-colors">Galeri</Link>
              <Link href="/kontak" class="text-gray-300 hover:text-white transition-colors">Kontak</Link>
            </div>
          </div>
          
          <!-- Contact Info -->
          <div class="space-y-4">
            <h3 class="font-semibold text-lg">Kontak Kami</h3>
            <div class="space-y-2 text-sm text-gray-300">
              <div class="flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                <span>Kuala Tanjung, Sumatera Utara</span>
              </div>
              <div class="flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                <span>info@inalum.id</span>
              </div>
            </div>
          </div>
        </div>
        
        <!-- Copyright -->
        <div class="border-t border-gray-700 mt-8 pt-6 text-center text-sm text-gray-400">
          <p>&copy; 2025 K3-INALUM — Sistem Keselamatan dan Kesehatan Kerja. Semua Hak Dilindungi.</p>
        </div>
      </div>
    </footer>
  </div>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';

const $page = usePage();

const isMobileMenuOpen = ref(false);
const breakingNews = ref({ title: '', isActive: false });
const currentDateTime = ref('');
let dateTimeInterval = null;

const menu = [
  { label: 'Beranda', href: '/' },
  { label: 'Profil', href: '/profil' },
  { label: 'Download', href: '/download' },
  { label: 'Galeri Foto', href: '/galeri' },
  { label: 'Kuis K3', href: '/kuis' },
  { label: 'Kontak SSM Safety', href: '/kontak' },
  { label: 'Survei', href: '/survey' },
];

const toggleMobileMenu = () => (isMobileMenuOpen.value = !isMobileMenuOpen.value);
const closeMenu = () => (isMobileMenuOpen.value = false);

// Date & Time
const updateDateTime = () => {
  const now = new Date();
  const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
  const months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'];
  const day = days[now.getDay()];
  const date = now.getDate();
  const month = months[now.getMonth()];
  const year = now.getFullYear();
  const hours = String(now.getHours()).padStart(2, '0');
  const minutes = String(now.getMinutes()).padStart(2, '0');
  const seconds = String(now.getSeconds()).padStart(2, '0');
  currentDateTime.value = `${day}, ${date} ${month} ${year}, ${hours}:${minutes}:${seconds} WIB`;
};

onMounted(() => {
  updateDateTime();
  dateTimeInterval = setInterval(updateDateTime, 1000);
  // Note: Removed localStorage usage as it's not supported in Claude.ai artifacts
  // In actual implementation, you can restore this functionality
  // const savedBreaking = localStorage.getItem('breakingNews');
  // if (savedBreaking) breakingNews.value = JSON.parse(savedBreaking);
});

onUnmounted(() => {
  if (dateTimeInterval) clearInterval(dateTimeInterval);
});
</script>

<style scoped>
/* Custom scrollbar */
::-webkit-scrollbar {
  width: 6px;
}

::-webkit-scrollbar-track {
  background: #f1f5f9;
}

::-webkit-scrollbar-thumb {
  background: #cbd5e1;
  border-radius: 3px;
}

::-webkit-scrollbar-thumb:hover {
  background: #94a3b8;
}
</style>