<template>
  <div class="min-h-screen flex flex-col justify-between font-sans bg-gradient-to-br from-sky-50 via-blue-50 to-cyan-50 text-gray-700">
    <!-- Navbar -->
    <header class="sticky top-0 z-50 backdrop-blur-md bg-gradient-to-r from-sky-400 via-blue-500 to-cyan-500 text-white shadow-xl border-b border-sky-300/30">
      <nav class="container mx-auto px-4 py-3">
        <div class="flex items-center justify-between gap-4 w-full">
         <!-- Logo Section -->
<div class="leading-tight text-sm flex-shrink-0">
  <div class="font-bold text-lg flex items-center gap-2">
    <!-- Ganti SVG dengan gambar -->
    <div class="w-10 h-10 rounded-xl overflow-hidden flex items-center justify-center bg-white/15 backdrop-blur-sm">
      <img src="/images/logo.png"  alt="Logo SRM" class="w-full h-full object-contain" />
    </div>
    <span class="hidden sm:inline">SMELTER<span class="text-cyan-200"> RISK MANAGEMENT</span></span>
    <span class="sm:hidden">SMELTER<span class="text-cyan-200"> RISK MANAGEMENT</span></span>
  </div>
</div>


          <!-- Desktop Menu - Centered with proper flex -->
          <div class="hidden lg:flex flex-1 justify-center">
            <div class="flex items-center space-x-1 text-sm">
              <Link v-for="item in menu" :key="item.label" :href="item.href"
                :class="[
                  isActiveRoute(item.href) 
                    ? 'text-cyan-200 font-semibold border-b-2 border-cyan-200 bg-white/15' 
                    : 'hover:text-cyan-200 hover:border-b-2 hover:border-cyan-200/50 hover:bg-white/10 text-white', 
                  'transition-all duration-300 ease-in-out px-3 py-2.5 whitespace-nowrap border-b-2 border-transparent text-center rounded-t-xl flex-shrink-0'
                ]">
                {{ item.label }}
              </Link>
              
              <!-- Dropdown -->
              <div class="relative group flex-shrink-0">
                <span class="hover:text-cyan-200 hover:bg-white/10 cursor-pointer transition-all duration-200 px-3 py-2.5 whitespace-nowrap border-b-2 border-transparent hover:border-cyan-200/50 flex items-center gap-1 rounded-t-xl">
                  Safety Obs 
                  <svg class="w-4 h-4 transition-transform group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                  </svg>
                </span>
                <div class="absolute z-10 invisible group-hover:visible opacity-0 group-hover:opacity-100 transition-all duration-200 transform translate-y-2 group-hover:translate-y-0">
                  <div class="bg-white text-gray-700 rounded-2xl shadow-2xl mt-2 w-52 py-3 right-0 border border-sky-100">
                    <Link href="/observation/form" class="flex items-center gap-3 px-5 py-3 text-sm hover:bg-sky-50 hover:text-sky-700 transition-colors rounded-xl mx-2">
                      <svg class="w-4 h-4 text-sky-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                      </svg>
                      Form Observatio
                    </Link>
                    <Link href="/observation/report" class="flex items-center gap-3 px-5 py-3 text-sm hover:bg-sky-50 hover:text-sky-700 transition-colors rounded-xl mx-2">
                      <svg class="w-4 h-4 text-sky-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                      </svg>
                      Report Observation
                    </Link>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Date Time & Login -->
          <div class="flex items-center gap-2 flex-shrink-0">
            <!-- Date Time - Hide on small screens -->
            <div class="hidden xl:flex items-center gap-2 text-sm font-medium text-white/95 bg-white/15 px-3 py-2 rounded-xl backdrop-blur-sm border border-white/10">
              <svg class="w-4 h-4 text-cyan-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
              </svg>
              <span class="whitespace-nowrap text-xs">{{ currentDateTime }}</span>
            </div>
            
            <!-- Login Button -->
            <Link href="/login"
              class="hidden md:inline-flex items-center gap-2 bg-gradient-to-r from-cyan-400 to-sky-400 text-sky-900 px-4 py-2 text-sm rounded-xl hover:from-cyan-300 hover:to-sky-300 transition-all duration-200 shadow-lg hover:shadow-xl font-semibold">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
              </svg>
              <span class="hidden lg:inline">Login</span>
            </Link>
            
            <!-- Mobile Menu Button - PERBAIKAN UTAMA: Gunakan block instead of flex, dan pastikan visible di mobile -->
            <button 
              @click.stop="toggleMobileMenu" 
              class="lg:hidden block focus:outline-none p-2 rounded-xl hover:bg-white/15 transition-colors"
              :class="{ 'bg-white/20': isMobileMenuOpen }">
              <svg class="w-6 h-6" fill="none" stroke="white" viewBox="0 0 24 24" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                  :d="isMobileMenuOpen ? 'M6 18L18 6M6 6l12 12' : 'M4 6h16M4 12h16M4 18h16'" />
              </svg>
            </button>
          </div>
        </div>
      </nav>

      <!-- Mobile Menu - PERBAIKAN: Fixed positioning dan z-index tinggi -->
      <div v-if="isMobileMenuOpen"
        class="fixed inset-0 bg-white text-gray-700 z-[9999] lg:hidden overflow-y-auto">
        <div class="flex flex-col h-full">
          <!-- Mobile Header -->
          <div class="flex items-center justify-between p-6 border-b border-sky-200 bg-gradient-to-r from-sky-400 via-blue-500 to-cyan-500 text-white">
            <div class="font-bold text-lg">
              SMELTER<span class="text-cyan-200"> RISK MANAGEMENT</span>
            </div>
            <button @click="toggleMobileMenu" class="p-2 hover:bg-white/15 rounded-xl transition-colors">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
              </svg>
            </button>
          </div>
          
          <!-- Mobile Menu Content -->
          <div class="flex-1 overflow-y-auto p-6 bg-gradient-to-b from-sky-50 to-cyan-50">
            <div class="space-y-4">
              <!-- Main Menu Items -->
              <div class="space-y-2">
                <Link v-for="item in menu" :key="item.label" :href="item.href" 
                  :class="[
                    isActiveRoute(item.href) 
                      ? 'bg-sky-100 text-sky-700 font-semibold border-l-4 border-sky-500 shadow-sm' 
                      : 'text-gray-700 hover:bg-sky-50 hover:text-sky-700',
                    'flex items-center gap-3 p-4 rounded-xl transition-all duration-200 font-medium'
                  ]" 
                  @click="closeMenu">
                  <svg class="w-5 h-5 text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                  </svg>
                  {{ item.label }}
                </Link>
              </div>
              
              <!-- Safety Observation Section -->
              <div class="pt-6 border-t border-sky-200">
                <div class="flex items-center gap-2 font-semibold text-sky-800 mb-4">
                  <svg class="w-5 h-5 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                  </svg>
                  Safety Observation
                </div>
                <div class="space-y-2 ml-7">
                  <Link href="/observation/form" 
                    :class="[
                      isActiveRoute('/observation/form') 
                        ? 'bg-sky-100 text-sky-700 font-semibold shadow-sm' 
                        : 'text-sky-700 hover:bg-sky-50',
                      'block p-3 text-sm rounded-xl transition-colors font-medium'
                    ]" 
                    @click="closeMenu">
                    Form Observation
                  </Link>
                  <Link href="/observation/report" 
                    :class="[
                      isActiveRoute('/observation/report') 
                        ? 'bg-sky-100 text-sky-700 font-semibold shadow-sm' 
                        : 'text-sky-700 hover:bg-sky-50',
                      'block p-3 text-sm rounded-xl transition-colors font-medium'
                    ]" 
                    @click="closeMenu">
                    Report Observation
                  </Link>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Mobile Footer -->
          <div class="p-6 border-t border-sky-200 bg-gradient-to-r from-sky-50 to-cyan-50">
            <div class="mb-4 text-sm text-sky-600 text-center font-medium">
              {{ currentDateTime }}
            </div>
            <Link href="/login"
              class="flex items-center justify-center gap-2 bg-gradient-to-r from-sky-500 to-cyan-500 text-white px-6 py-3 rounded-xl hover:from-sky-600 hover:to-cyan-600 text-sm transition-all duration-200 shadow-lg font-medium"
              @click="closeMenu">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
              </svg>
              Login ke Sistem
            </Link>
          </div>
        </div>
      </div>

    </header>

    <!-- Slot for Page Content -->
    <main class="flex-grow min-h-[60vh] bg-gradient-to-b from-white via-sky-25 to-cyan-25">
      <div class="container mx-auto px-4 py-8">
        <slot />
      </div>
    </main>

    <!-- Footer -->
<footer class="bg-gradient-to-r from-slate-700 via-gray-800 to-slate-800 text-white">
  <div class="container mx-auto px-4 py-8">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
      
      <!-- Company Info -->
      <div class="space-y-4">
        <!-- Logo dan Nama -->
        <div class="flex items-center gap-3">
          <div class="w-10 h-10 rounded-xl overflow-hidden flex items-center justify-center bg-white/15 backdrop-blur-sm">
            <img src="/images/logo.png" alt="Logo SRM" class="w-full h-full object-contain" />
          </div>
          <span class="font-bold text-lg">
          SMELTER<span class="text-cyan-300"> RISK-MANAGEMENT</span>
          </span>
        </div>

        <!-- Deskripsi -->
        <p class="text-gray-300 text-sm leading-relaxed">
          Platform Yang Mengintegrasikan Pemantauan Risiko PT Indonesia Asahan Aluminium
        </p>
      </div>

          
          <!-- Quick Links -->
          <div class="space-y-4">
            <h3 class="font-semibold text-lg text-sky-300">Quick Links</h3>
            <div class="grid grid-cols-2 gap-2 text-sm">
              <Link href="/profil" class="text-gray-300 hover:text-sky-300 transition-colors">Profil</Link>
              <Link href="/download" class="text-gray-300 hover:text-sky-300 transition-colors">Download</Link>
              <Link href="/galeri" class="text-gray-300 hover:text-sky-300 transition-colors">Galeri</Link>
              <Link href="/kontak" class="text-gray-300 hover:text-sky-300 transition-colors">Kontak</Link>
            </div>
          </div>
          
          <!-- Contact Info -->
          <div class="space-y-4">
            <h3 class="font-semibold text-lg text-sky-300">Kontak Kami</h3>
            <div class="space-y-2 text-sm text-gray-300">
              <div class="flex items-center gap-2">
                <svg class="w-4 h-4 text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                <span>Kuala Tanjung, Sumatera Utara</span>
              </div>
              <div class="flex items-center gap-2">
                <svg class="w-4 h-4 text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                <span>srm@inalum.id</span>
              </div>
            </div>
          </div>
        </div>
        
        <!-- Copyright -->
        <div class="border-t border-gray-600 mt-8 pt-6 text-center text-sm text-gray-400">
          <p>&copy; 2025 K3-INALUM — Platform Yang Mengintegrasikan Pemantauan Risiko. Semua Hak Dilindungi.</p>
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
  { label: 'Kontak SRM', href: '/kontak' },
  { label: 'Survei', href: '/survei' },
];

// Function to check if route is active
const isActiveRoute = (href) => {
  const currentUrl = $page.url;
  
  // Special case for home page
  if (href === '/') {
    return currentUrl === '/' || currentUrl === '';
  }
  
  // For other routes, check exact match or if current URL starts with href followed by a slash or query
  return currentUrl === href || 
         currentUrl.startsWith(href + '/') || 
         currentUrl.startsWith(href + '?');
};

const toggleMobileMenu = () => {
  isMobileMenuOpen.value = !isMobileMenuOpen.value;
  // Prevent body scroll when menu is open
  if (isMobileMenuOpen.value) {
    document.body.style.overflow = 'hidden';
  } else {
    document.body.style.overflow = '';
  }
};

const closeMenu = () => {
  isMobileMenuOpen.value = false;
  document.body.style.overflow = '';
};

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
});

onUnmounted(() => {
  if (dateTimeInterval) clearInterval(dateTimeInterval);
  // Cleanup: restore body scroll
  document.body.style.overflow = '';
});
</script>

<style scoped>
/* Custom scrollbar with light blue theme */
::-webkit-scrollbar {
  width: 6px;
}

::-webkit-scrollbar-track {
  background: #e0f2fe;
}

::-webkit-scrollbar-thumb {
  background: #7dd3fc;
  border-radius: 3px;
}

::-webkit-scrollbar-thumb:hover {
  background: #38bdf8;
}

/* Enhanced transitions for navbar items */
.transition-all {
  transition-property: all;
  transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
}

/* Ensure proper color inheritance */
nav a:not(.active) {
  color: inherit;
}

/* Custom classes for light blue theme */
.bg-sky-25 {
  background-color: #f8fafc;
}

.bg-cyan-25 {
  background-color: #ecfeff;
}

/* PERBAIKAN CSS UNTUK MOBILE */
/* Ensure mobile button is always visible */
@media (max-width: 1023px) {
  .lg\\:hidden {
    display: block !important;
  }
  
  /* Force hamburger button to be visible on mobile */
  button.lg\\:hidden {
    display: flex !important;
    align-items: center;
    justify-content: center;
    width: 44px;
    height: 44px;
    min-width: 44px;
    flex-shrink: 0;
  }
}

/* Responsive navbar adjustments - Improved for symmetry */
@media (max-width: 1600px) {
  .hidden.lg\\:flex .flex {
    gap: 0.125rem;
  }
  
  .hidden.lg\\:flex a,
  .hidden.lg\\:flex span {
    font-size: 0.8rem;
    padding: 0.625rem 0.625rem;
  }
}

@media (max-width: 1400px) {
  .hidden.lg\\:flex .flex {
    gap: 0.0625rem;
  }
  
  .hidden.lg\\:flex a,
  .hidden.lg\\:flex span {
    font-size: 0.75rem;
    padding: 0.5rem 0.5rem;
  }
}

@media (max-width: 1200px) {
  .hidden.lg\\:flex a,
  .hidden.lg\\:flex span {
    font-size: 0.7rem;
    padding: 0.5rem 0.375rem;
  }
}

/* Mobile specific fixes */
@media (max-width: 768px) {
  /* Navbar container padding */
  .container.mx-auto {
    padding-left: 1rem;
    padding-right: 1rem;
  }
  
  /* Navbar flex adjustments */
  nav .flex.items-center.justify-between {
    gap: 0.5rem;
  }
  
  /* Hamburger button specific styling */
  .lg\\:hidden.block {
    display: flex !important;
    align-items: center;
    justify-content: center;
    padding: 0.5rem;
    border-radius: 0.75rem;
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(8px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    transition: all 0.2s ease-in-out;
    min-width: 44px;
    min-height: 44px;
  }
  
  .lg\\:hidden.block:hover {
    background: rgba(255, 255, 255, 0.15);
    transform: scale(1.05);
  }
  
  .lg\\:hidden.block:active {
    transform: scale(0.95);
  }
}

/* Ensure main content takes proper height */
main {
  min-height: calc(100vh - 200px);
}

/* Improved container centering */
.container.mx-auto {
  width: 100%;
  max-width: 1400px;
}

/* Light blue gradient utilities */
.gradient-light-blue {
  background: linear-gradient(135deg, #e0f2fe 0%, #bae6fd 50%, #7dd3fc 100%);
}

.text-gradient-blue {
  background: linear-gradient(135deg, #0ea5e9, #0284c7);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

/* Fix for mobile overlay */
.fixed.inset-0 {
  position: fixed !important;
  top: 0 !important;
  left: 0 !important;
  right: 0 !important;
  bottom: 0 !important;
  width: 100vw !important;
  height: 100vh !important;
  max-height: 100vh !important;
}
</style>