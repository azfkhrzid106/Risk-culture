<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import { computed, ref, onMounted } from 'vue';
import { Link } from '@inertiajs/vue3';

// Props dari Laravel
const props = defineProps({
  newsItems: Array,
  breakingNews: Object
});

// State untuk carousel
const currentSlide = ref(0);

// Filter hanya berita aktif
const activeNews = computed(() => {
  console.log('All news items:', props.newsItems); // Debug
  return props.newsItems ? props.newsItems.filter(n => n.is_active) : [];
});

// Berita dengan gambar untuk carousel hero
const featuredNews = computed(() => {
  const withImages = activeNews.value.filter(news => {
    console.log('News item:', news.title, 'Image URL:', news.image_url); // Debug
    return news.image_url && news.image_url !== null;
  });
  console.log('Featured news with images:', withImages); // Debug
  return withImages.slice(0, 5);
});

// Format tanggal
function formatDate(date) {
  if (!date) return '';
  return new Date(date).toLocaleDateString('id-ID', {
    day: 'numeric',
    month: 'long',
    year: 'numeric'
  });
}

// Get category badge class
function getCategoryBadgeClass(category) {
  const classes = {
    'info': 'bg-blue-50 text-blue-700 border border-blue-200',
    'safety': 'bg-red-50 text-red-700 border border-red-200',
    'announcement': 'bg-yellow-50 text-yellow-700 border border-yellow-200',
    'event': 'bg-green-50 text-green-700 border border-green-200'
  };
  return classes[category] || 'bg-gray-50 text-gray-700 border border-gray-200';
}

// Get category name
function getCategoryName(category) {
  const names = {
    'info': 'Informasi',
    'safety': 'Keselamatan',
    'announcement': 'Pengumuman',
    'event': 'Event'
  };
  return names[category] || category;
}

// Auto-scroll carousel
let carouselInterval = null;

onMounted(() => {
  if (featuredNews.value.length > 1) {
    carouselInterval = setInterval(() => {
      currentSlide.value = (currentSlide.value + 1) % featuredNews.value.length;
    }, 5000);
  }
});

// Manual slide change
function goToSlide(index) {
  currentSlide.value = index;
  // Reset interval
  if (carouselInterval) {
    clearInterval(carouselInterval);
    if (featuredNews.value.length > 1) {
      carouselInterval = setInterval(() => {
        currentSlide.value = (currentSlide.value + 1) % featuredNews.value.length;
      }, 5000);
    }
  }
}

// Check if image exists
function handleImageError(event) {
  console.log('Image load error:', event.target.src);
  event.target.style.display = 'none';
  event.target.nextElementSibling.style.display = 'flex';
}

function handleImageLoad(event) {
  console.log('Image loaded successfully:', event.target.src);
}
</script>

<template>
  <MainLayout>
    <!-- Hero Section with Improved Responsive Design -->
    <section class="relative bg-gradient-to-br from-blue-50 via-white to-red-50 overflow-hidden">
      <!-- Responsive padding with consistent spacing -->
      <div class="py-12 sm:py-16 md:py-20 lg:py-24 xl:py-28">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-5">
          <div class="absolute inset-0 hero-pattern"></div>
        </div>
        
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 xl:px-12 relative z-10">
          <div class="max-w-7xl mx-auto text-center">
            <!-- Main Heading with Better Responsive Typography -->
            <div class="mb-8 sm:mb-10 md:mb-12 lg:mb-14">
              <h1 class="font-bold text-gray-900 mb-4 sm:mb-6 leading-tight">
                <!-- Mobile: text-3xl, Tablet: text-4xl, Desktop: text-5xl, Large: text-6xl -->
                <span class="block text-3xl sm:text-4xl md:text-5xl lg:text-6xl xl:text-7xl">
                  Selamat Datang di
                </span>
                <span class="relative block mt-2 sm:mt-3 md:mt-4">
                  <span class="bg-gradient-to-r from-blue-600 via-blue-700 to-red-600 bg-clip-text text-transparent text-3xl sm:text-4xl md:text-5xl lg:text-6xl xl:text-7xl">
                    K3-INALUM
                  </span>
                  <div class="absolute -bottom-1 sm:-bottom-2 md:-bottom-3 left-1/2 transform -translate-x-1/2 w-3/4 sm:w-4/5 md:w-full h-1 sm:h-1.5 md:h-2 bg-gradient-to-r from-blue-600 to-red-600 rounded-full animate-pulse opacity-75"></div>
                </span>
              </h1>
              
              <!-- Subtitle with Better Line Height and Spacing -->
              <div class="max-w-4xl mx-auto px-2 sm:px-4">
                <p class="text-gray-600 leading-relaxed mb-6 sm:mb-8 text-base sm:text-lg md:text-xl lg:text-2xl">
                  Sistem Informasi Keselamatan dan Kesehatan Kerja untuk mendukung
                </p>
                <p class="font-semibold text-blue-700 relative text-lg sm:text-xl md:text-2xl lg:text-3xl">
                  Inalum Safety Culture
                  <div class="absolute -bottom-1 left-1/2 transform -translate-x-1/2 w-3/4 h-0.5 sm:h-1 bg-blue-300 rounded-full"></div>
                </p>
              </div>
            </div>
            
            <!-- CTA Buttons with Consistent Sizing -->
            <div class="mb-12 sm:mb-16 md:mb-20">
              <div class="flex flex-col sm:flex-row justify-center items-stretch sm:items-center gap-4 sm:gap-6 max-w-2xl mx-auto px-4">
                <Link href="/pelajari"
                  class="group flex-1 sm:flex-none inline-flex items-center justify-center px-6 sm:px-8 md:px-10 py-3 sm:py-4 md:py-5 text-base sm:text-lg md:text-xl font-semibold text-white bg-gradient-to-r from-blue-600 to-blue-700 border border-transparent rounded-xl sm:rounded-2xl hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1 min-h-[48px] sm:min-h-[56px] md:min-h-[64px]">
                  <svg class="mr-2 sm:mr-3 w-5 sm:w-6 h-5 sm:h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                  </svg>
                  <span class="truncate">Pelajari Lebih Lanjut</span>
                  <svg class="ml-2 sm:ml-3 w-5 sm:w-6 h-5 sm:h-6 group-hover:translate-x-1 transition-transform flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                  </svg>
                </Link>
                
                <Link href="/video"
                  class="group flex-1 sm:flex-none inline-flex items-center justify-center px-6 sm:px-8 md:px-10 py-3 sm:py-4 md:py-5 text-base sm:text-lg md:text-xl font-semibold text-blue-700 bg-white border-2 border-blue-600 rounded-xl sm:rounded-2xl hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1 min-h-[48px] sm:min-h-[56px] md:min-h-[64px]">
                  <svg class="mr-2 sm:mr-3 w-5 sm:w-6 h-5 sm:h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h1.586a1 1 0 01.707.293l2.414 2.414a1 1 0 00.707.293H15M9 10V9a2 2 0 012-2h2a2 2 0 012 2v1m-4 0V8a1 1 0 011-1h2a1 1 0 011 1v2"/>
                  </svg>
                  <span class="truncate">Video Edukasi</span>
                </Link>
              </div>
            </div>
            
            <!-- Stats Cards with Improved Grid and Spacing -->
            <div class="max-w-6xl mx-auto px-4">
              <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8 md:gap-10">
                <!-- Card 1 -->
                <div class="bg-white/90 backdrop-blur-sm rounded-2xl sm:rounded-3xl p-6 sm:p-8 md:p-10 shadow-lg border border-white/20 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 hover:scale-105">
                  <div class="flex items-center justify-center w-14 sm:w-16 md:w-20 h-14 sm:h-16 md:h-20 bg-blue-100 rounded-xl sm:rounded-2xl mb-4 sm:mb-6 mx-auto">
                    <svg class="w-7 sm:w-8 md:w-10 h-7 sm:h-8 md:h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                  </div>
                  <h3 class="text-lg sm:text-xl md:text-2xl font-semibold text-gray-900 mb-3 sm:mb-4">Keselamatan Kerja</h3>
                  <p class="text-gray-600 text-sm sm:text-base md:text-lg leading-relaxed">Prioritas utama dalam setiap aktivitas</p>
                </div>
                
                <!-- Card 2 -->
                <div class="bg-white/90 backdrop-blur-sm rounded-2xl sm:rounded-3xl p-6 sm:p-8 md:p-10 shadow-lg border border-white/20 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 hover:scale-105">
                  <div class="flex items-center justify-center w-14 sm:w-16 md:w-20 h-14 sm:h-16 md:h-20 bg-green-100 rounded-xl sm:rounded-2xl mb-4 sm:mb-6 mx-auto">
                    <svg class="w-7 sm:w-8 md:w-10 h-7 sm:h-8 md:h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                    </svg>
                  </div>
                  <h3 class="text-lg sm:text-xl md:text-2xl font-semibold text-gray-900 mb-3 sm:mb-4">Kesehatan Kerja</h3>
                  <p class="text-gray-600 text-sm sm:text-base md:text-lg leading-relaxed">Menjaga kesehatan pekerja secara berkelanjutan</p>
                </div>
                
                <!-- Card 3 - Full width on mobile and tablet, normal on desktop -->
                <div class="bg-white/90 backdrop-blur-sm rounded-2xl sm:rounded-3xl p-6 sm:p-8 md:p-10 shadow-lg border border-white/20 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 hover:scale-105 sm:col-span-2 lg:col-span-1">
                  <div class="flex items-center justify-center w-14 sm:w-16 md:w-20 h-14 sm:h-16 md:h-20 bg-red-100 rounded-xl sm:rounded-2xl mb-4 sm:mb-6 mx-auto">
                    <svg class="w-7 sm:w-8 md:w-10 h-7 sm:h-8 md:h-10 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                    </svg>
                  </div>
                  <h3 class="text-lg sm:text-xl md:text-2xl font-semibold text-gray-900 mb-3 sm:mb-4">Safety Culture</h3>
                  <p class="text-gray-600 text-sm sm:text-base md:text-lg leading-relaxed">Budaya keselamatan yang terintegrasi</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Main Content Container -->
    <div class="bg-white">
      <!-- Featured News Carousel with Improved Responsive Heights -->
      <section v-if="featuredNews.length > 0" class="py-12 sm:py-16 md:py-20 lg:py-24">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 xl:px-12">
          <!-- Section Header with Better Spacing -->
          <div class="text-center mb-10 sm:mb-12 md:mb-16 lg:mb-20">
            <h2 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 mb-4 sm:mb-6 md:mb-8">Berita Utama</h2>
            <div class="w-20 sm:w-24 md:w-32 lg:w-40 h-1 sm:h-1.5 md:h-2 bg-gradient-to-r from-blue-600 to-red-600 mx-auto rounded-full mb-4 sm:mb-6 md:mb-8"></div>
            <p class="text-base sm:text-lg md:text-xl lg:text-2xl text-gray-600 max-w-4xl mx-auto px-4 leading-relaxed">
              Informasi terkini mengenai keselamatan dan kesehatan kerja di lingkungan INALUM
            </p>
          </div>
          
          <div class="max-w-7xl mx-auto">
            <div class="relative bg-white rounded-3xl sm:rounded-[2rem] md:rounded-[2.5rem] shadow-xl sm:shadow-2xl overflow-hidden border border-gray-100">
              <!-- Responsive carousel height -->
              <div class="relative h-80 sm:h-96 md:h-[28rem] lg:h-[32rem] xl:h-[36rem]">
                <!-- Slides -->
                <div v-for="(news, index) in featuredNews" :key="news.id" 
                     :class="['absolute inset-0 transition-all duration-1000 ease-in-out', 
                             index === currentSlide ? 'opacity-100 scale-100' : 'opacity-0 scale-105']">
                  
                  <!-- Image with error handling -->
                  <img :src="news.image_url" 
                       :alt="news.title" 
                       class="w-full h-full object-cover"
                       @error="handleImageError"
                       @load="handleImageLoad"
                       style="display: block;">
                  
                  <!-- Fallback when image fails to load -->
                  <div class="w-full h-full bg-gradient-to-br from-blue-100 via-blue-200 to-blue-300 flex items-center justify-center" 
                       style="display: none;">
                    <div class="text-center text-blue-800">
                      <div class="bg-white/20 backdrop-blur-sm rounded-3xl p-6 sm:p-8 md:p-12 max-w-lg mx-4">
                        <svg class="w-16 sm:w-20 md:w-24 lg:w-32 h-16 sm:h-20 md:h-24 lg:h-32 mx-auto mb-4 sm:mb-6 md:mb-8 opacity-60" fill="currentColor" viewBox="0 0 24 24">
                          <path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"/>
                        </svg>
                        <p class="text-lg sm:text-xl md:text-2xl lg:text-3xl font-medium">{{ news.title }}</p>
                      </div>
                    </div>
                  </div>
                  
                  <!-- Enhanced Overlay with Responsive Content -->
                  <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/40 to-transparent">
                    <div class="absolute bottom-0 left-0 right-0 p-6 sm:p-8 md:p-10 lg:p-12 xl:p-16">
                      <div class="max-w-5xl">
                        <div class="mb-4 sm:mb-6 md:mb-8">
                          <span :class="['inline-flex items-center px-4 sm:px-6 py-2 sm:py-3 rounded-full text-sm sm:text-base md:text-lg font-semibold backdrop-blur-sm bg-white/90', getCategoryBadgeClass(news.category).replace('bg-', 'text-')]">
                            {{ getCategoryName(news.category) }}
                          </span>
                        </div>
                        <h3 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl xl:text-6xl font-bold text-white mb-4 sm:mb-6 md:mb-8 leading-tight">{{ news.title }}</h3>
                        <p class="text-base sm:text-lg md:text-xl lg:text-2xl text-gray-100 line-clamp-3 mb-4 sm:mb-6 md:mb-8 leading-relaxed opacity-90">{{ news.content.substring(0, 250) }}...</p>
                        <div class="flex items-center text-sm sm:text-base md:text-lg text-gray-300">
                          <svg class="w-5 sm:w-6 md:w-7 h-5 sm:h-6 md:h-7 mr-2 sm:mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 002 2z"></path>
                          </svg>
                          {{ formatDate(news.created_at) }}
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                
                <!-- Enhanced Navigation Arrows -->
                <button v-if="featuredNews.length > 1"
                        @click="goToSlide((currentSlide - 1 + featuredNews.length) % featuredNews.length)"
                        class="absolute left-4 sm:left-6 md:left-8 top-1/2 transform -translate-y-1/2 bg-white/20 backdrop-blur-sm hover:bg-white/30 text-white p-3 sm:p-4 md:p-5 lg:p-6 rounded-full transition-all duration-300 shadow-lg hover:shadow-xl hover:scale-110 z-10">
                  <svg class="w-5 sm:w-6 md:w-7 lg:w-8 h-5 sm:h-6 md:h-7 lg:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                  </svg>
                </button>
                
                <button v-if="featuredNews.length > 1"
                        @click="goToSlide((currentSlide + 1) % featuredNews.length)"
                        class="absolute right-4 sm:right-6 md:right-8 top-1/2 transform -translate-y-1/2 bg-white/20 backdrop-blur-sm hover:bg-white/30 text-white p-3 sm:p-4 md:p-5 lg:p-6 rounded-full transition-all duration-300 shadow-lg hover:shadow-xl hover:scale-110 z-10">
                  <svg class="w-5 sm:w-6 md:w-7 lg:w-8 h-5 sm:h-6 md:h-7 lg:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                  </svg>
                </button>
                
                <!-- Enhanced Carousel Indicators -->
                <div v-if="featuredNews.length > 1" class="absolute bottom-6 sm:bottom-8 md:bottom-10 left-1/2 transform -translate-x-1/2 flex space-x-3 sm:space-x-4 z-10">
                  <button v-for="(news, index) in featuredNews" :key="index"
                          @click="goToSlide(index)"
                          :class="['transition-all duration-300 rounded-full border-2 border-white/50',
                                  index === currentSlide ? 'w-8 sm:w-10 md:w-12 lg:w-16 h-3 sm:h-4 bg-white border-white' : 'w-3 sm:w-4 h-3 sm:h-4 bg-white/30 hover:bg-white/60']">
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Informasi Terkini with Improved Card Grid -->
      <section class="py-12 sm:py-16 md:py-20 lg:py-24 bg-gray-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 xl:px-12">
          <!-- Section Header with Consistent Spacing -->
          <div class="text-center mb-12 sm:mb-16 md:mb-20 lg:mb-24">
            <h2 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 mb-4 sm:mb-6 md:mb-8">Informasi Terkini</h2>
            <div class="w-20 sm:w-24 md:w-32 lg:w-40 h-1 sm:h-1.5 md:h-2 bg-gradient-to-r from-blue-600 to-red-600 mx-auto rounded-full mb-6 sm:mb-8 md:mb-10"></div>
            <p class="text-base sm:text-lg md:text-xl lg:text-2xl text-gray-600 max-w-4xl mx-auto leading-relaxed px-4">
              Dapatkan update terbaru mengenai kebijakan, prosedur, dan informasi penting seputar keselamatan dan kesehatan kerja
            </p>
          </div>
          
          <div v-if="activeNews.length > 0" class="max-w-7xl mx-auto">
            <!-- Improved responsive grid with better breakpoints -->
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8 sm:gap-10 md:gap-12">
              <article v-for="news in activeNews" :key="news.id" 
                       class="group bg-white rounded-3xl sm:rounded-[2rem] shadow-lg hover:shadow-2xl transition-all duration-500 overflow-hidden border border-gray-100 hover:border-blue-200 transform hover:-translate-y-2 hover:scale-[1.02]">
                <!-- Image Section with Consistent Height -->
                <div class="relative h-56 sm:h-64 md:h-60 lg:h-64 xl:h-56 bg-gradient-to-br from-gray-100 to-gray-200 overflow-hidden">
                  <img v-if="news.image_url" 
                       :src="news.image_url" 
                       :alt="news.title" 
                       class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                       @error="handleImageError"
                       @load="handleImageLoad"
                       style="display: block;">
                  
                  <!-- Fallback for missing images -->
                  <div v-if="!news.image_url" 
                       class="w-full h-full bg-gradient-to-br from-blue-50 to-blue-100 flex items-center justify-center">
                    <div class="text-center text-blue-400">
                      <svg class="w-16 sm:w-20 md:w-24 h-16 sm:h-20 md:h-24 mx-auto mb-3 sm:mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                              d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                        </path>
                      </svg>
                      <p class="text-base sm:text-lg font-medium">Artikel Berita</p>
                    </div>
                  </div>
                  
                  <!-- Category Badge -->
                  <div class="absolute top-4 sm:top-5 md:top-6 left-4 sm:left-5 md:left-6 z-10">
                    <span :class="['inline-flex items-center px-3 sm:px-4 md:px-5 py-1.5 sm:py-2 md:py-2.5 rounded-full text-xs sm:text-sm md:text-base font-semibold backdrop-blur-sm', getCategoryBadgeClass(news.category)]">
                      {{ getCategoryName(news.category) }}
                    </span>
                  </div>
                  
                  <!-- Overlay gradient -->
                  <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                </div>
                
                <!-- Content Section with Better Spacing -->
                <div class="p-6 sm:p-8 md:p-10">
                  <h3 class="text-lg sm:text-xl md:text-2xl font-bold text-gray-900 mb-4 sm:mb-5 md:mb-6 line-clamp-2 group-hover:text-blue-700 transition-colors leading-tight">
                    {{ news.title }}
                  </h3>
                  <p class="text-sm sm:text-base md:text-lg text-gray-600 line-clamp-3 mb-6 sm:mb-8 leading-relaxed">{{ news.content }}</p>
                  
                  <!-- Footer with Better Responsive Layout -->
                  <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center pt-6 sm:pt-8 border-t border-gray-100 space-y-4 sm:space-y-0">
                    <div class="flex items-center text-sm sm:text-base text-gray-500 order-2 sm:order-1">
                      <svg class="w-4 sm:w-5 h-4 sm:h-5 mr-2 sm:mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 002 2z"></path>
                      </svg>
                      <span class="truncate">{{ formatDate(news.created_at) }}</span>
                    </div>
                    <button class="inline-flex items-center text-blue-600 hover:text-blue-800 text-sm sm:text-base md:text-lg font-semibold transition-all duration-200 group-hover:translate-x-1 transform order-1 sm:order-2 self-start sm:self-auto">
                      <span class="truncate">Baca Selengkapnya</span>
                      <svg class="w-4 sm:w-5 h-4 sm:h-5 ml-2 sm:ml-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                      </svg>
                    </button>
                  </div>
                </div>
              </article>
            </div>
          </div>
          
          <!-- Enhanced Empty State with Better Responsive Design -->
          <div v-else class="text-center py-20 sm:py-24 md:py-28 lg:py-32">
            <div class="max-w-lg mx-auto px-4">
              <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-full w-24 sm:w-28 md:w-32 lg:w-36 xl:w-40 h-24 sm:h-28 md:h-32 lg:h-36 xl:h-40 flex items-center justify-center mx-auto mb-8 sm:mb-10 md:mb-12">
                <svg class="w-12 sm:w-14 md:w-16 lg:w-18 xl:w-20 h-12 sm:h-14 md:h-16 lg:h-18 xl:h-20 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                  </path>
                </svg>
              </div>
              <h3 class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-semibold text-gray-900 mb-4 sm:mb-6 md:mb-8">Belum Ada Informasi Terkini</h3>
              <p class="text-base sm:text-lg md:text-xl text-gray-500 mb-8 sm:mb-10 md:mb-12 leading-relaxed">
                Informasi keselamatan dan kesehatan kerja akan segera tersedia untuk mendukung Inalum Safety Culture.
              </p>
              <div class="flex justify-center">
                <div class="animate-pulse flex space-x-2 sm:space-x-3">
                  <div class="w-3 sm:w-4 h-3 sm:h-4 bg-blue-400 rounded-full animate-bounce"></div>
                  <div class="w-3 sm:w-4 h-3 sm:h-4 bg-blue-400 rounded-full animate-bounce" style="animation-delay: 0.1s"></div>
                  <div class="w-3 sm:w-4 h-3 sm:h-4 bg-blue-400 rounded-full animate-bounce" style="animation-delay: 0.2s"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </MainLayout>
</template>

<style scoped>
/* Custom background pattern with responsive sizing */
.hero-pattern {
  background-image: radial-gradient(circle at 1px 1px, rgba(0,0,0,0.08) 1px, transparent 0);
  background-size: 24px 24px;
}

@media (min-width: 640px) {
  .hero-pattern {
    background-size: 30px 30px;
  }
}

@media (min-width: 1024px) {
  .hero-pattern {
    background-size: 36px 36px;
  }
}

/* Improved line clamping */
.line-clamp-2 {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
  line-height: 1.5;
}

.line-clamp-3 {
  display: -webkit-box;
  -webkit-line-clamp: 3;
  -webkit-box-orient: vertical;
  overflow: hidden;
  line-height: 1.6;
}

/* Enhanced smooth scrolling */
html {
  scroll-behavior: smooth;
}

/* Improved scrollbar styling */
::-webkit-scrollbar {
  width: 8px;
}

::-webkit-scrollbar-track {
  background: #f1f5f9;
  border-radius: 4px;
}

::-webkit-scrollbar-thumb {
  background: linear-gradient(180deg, #3b82f6, #ef4444);
  border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
  background: linear-gradient(180deg, #2563eb, #dc2626);
}

/* Responsive image loading */
img {
  transition: opacity 0.3s ease-in-out, transform 0.3s ease-in-out;
}

img[src=""] {
  opacity: 0;
}

/* Enhanced focus states for better accessibility */
button:focus-visible,
a:focus-visible {
  outline: 3px solid #3b82f6;
  outline-offset: 2px;
  border-radius: 8px;
}

/* Better hover states with media queries */
@media (hover: hover) and (pointer: fine) {
  .hover\:scale-\[1\.02\]:hover {
    transform: scale(1.02);
  }
  
  .hover\:-translate-y-2:hover {
    transform: translateY(-0.5rem);
  }
  
  .hover\:scale-105:hover {
    transform: scale(1.05);
  }
  
  .group:hover .group-hover\:scale-110 {
    transform: scale(1.1);
  }
  
  .group:hover .group-hover\:translate-x-1 {
    transform: translateX(0.25rem);
  }
}

/* Disable problematic hover effects on touch devices */
@media (hover: none) and (pointer: coarse) {
  .hover\:-translate-y-2:hover {
    transform: none;
  }
  
  .hover\:scale-105:hover {
    transform: none;
  }
  
  .group:hover .group-hover\:scale-110 {
    transform: none;
  }
}

/* Enhanced mobile-first responsive breakpoints */
@media (max-width: 374px) {
  .container {
    padding-left: 1rem;
    padding-right: 1rem;
  }
  
  /* Smaller text sizes for very small screens */
  .text-3xl {
    font-size: 1.5rem;
    line-height: 2rem;
  }
  
  .text-4xl {
    font-size: 1.75rem;
    line-height: 2.25rem;
  }
}

/* Tablet-specific optimizations */
@media (min-width: 768px) and (max-width: 1023px) {
  .grid-cols-1.md\:grid-cols-2 {
    grid-template-columns: repeat(2, minmax(0, 1fr));
  }
}

/* Large desktop optimizations */
@media (min-width: 1920px) {
  .max-w-7xl {
    max-width: 96rem;
  }
  
  .container {
    max-width: 1920px;
  }
}

/* High DPI display optimizations */
@media (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi) {
  .hero-pattern {
    background-size: 20px 20px;
  }
  
  @media (min-width: 640px) {
    .hero-pattern {
      background-size: 25px 25px;
    }
  }
  
  @media (min-width: 1024px) {
    .hero-pattern {
      background-size: 30px 30px;
    }
  }
}

/* Touch-friendly button sizing */
@media (max-width: 768px) {
  button, 
  .group,
  a[class*="inline-flex"] {
    min-height: 48px;
    min-width: 48px;
  }
}

/* Improved animation performance */
@media (prefers-reduced-motion: reduce) {
  * {
    animation-duration: 0.01ms !important;
    animation-iteration-count: 1 !important;
    transition-duration: 0.01ms !important;
  }
}

/* Dark mode support (if needed) */
@media (prefers-color-scheme: dark) {
  /* Add dark mode styles here if needed */
}

/* Print optimizations */
@media print {
  .shadow-lg,
  .shadow-xl,
  .shadow-2xl {
    box-shadow: none !important;
  }
  
  .bg-gradient-to-r,
  .bg-gradient-to-br {
    background: #ffffff !important;
    color: #000000 !important;
  }
  
  .text-white {
    color: #000000 !important;
  }
  
  .bg-blue-600,
  .bg-red-600 {
    background: #000000 !important;
  }
}

/* Container query support for modern browsers */
@supports (container-type: inline-size) {
  .responsive-container {
    container-type: inline-size;
  }
  
  @container (max-width: 640px) {
    .container-responsive {
      font-size: 0.875rem;
    }
  }
}

/* Aspect ratio utilities for consistent image sizing */
.aspect-ratio-16-9 {
  aspect-ratio: 16 / 9;
}

.aspect-ratio-4-3 {
  aspect-ratio: 4 / 3;
}

/* Custom utilities for better responsive design */
.text-responsive {
  font-size: clamp(1rem, 2.5vw, 1.5rem);
}

.heading-responsive {
  font-size: clamp(1.5rem, 5vw, 4rem);
}

.spacing-responsive {
  padding: clamp(1rem, 4vw, 3rem);
}

/* Enhanced button states */
.btn-primary {
  @apply bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1;
}

.btn-secondary {
  @apply bg-white text-blue-700 border-2 border-blue-600 hover:bg-blue-50 font-semibold py-3 px-6 rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1;
}

/* Loading states */
.loading-pulse {
  animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}

@keyframes pulse {
  0%, 100% {
    opacity: 1;
  }
  50% {
    opacity: .5;
  }
}

/* Intersection observer animation classes */
.fade-in-up {
  opacity: 0;
  transform: translateY(30px);
  transition: opacity 0.6s ease-out, transform 0.6s ease-out;
}

.fade-in-up.visible {
  opacity: 1;
  transform: translateY(0);
}

.fade-in-scale {
  opacity: 0;
  transform: scale(0.95);
  transition: opacity 0.6s ease-out, transform 0.6s ease-out;
}

.fade-in-scale.visible {
  opacity: 1;
  transform: scale(1);
}
</style>