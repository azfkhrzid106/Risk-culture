<template>
  <MainLayout>
    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-blue-50 via-white to-red-50 py-16 md:py-24">
      <div class="container mx-auto px-4 relative">
        <div class="max-w-6xl mx-auto text-center">
          <h1 class="font-bold text-gray-900 mb-8 leading-tight">
            <span class="block text-4xl md:text-6xl mb-4">Selamat Datang di</span>
            <span class="block bg-gradient-to-r from-blue-600 to-red-600 bg-clip-text text-transparent text-4xl md:text-6xl">
              SMELTER-RISK MANAGEMENT SYSTEM
            </span>
          </h1>
          
          <div class="max-w-3xl mx-auto mb-12">
            <p class="text-gray-600 text-lg md:text-xl mb-6 leading-relaxed">
              Sistem Informasi Risiko Kerja untuk mendukung
            </p>
            <p class="font-semibold text-blue-700 text-xl md:text-2xl">
              Inalum Risk Culture
            </p>
          </div>
          
          <!-- CTA Buttons -->
          <div class="flex flex-col sm:flex-row justify-center gap-4 mb-16">
            <Link href="/profil"
              class="inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-white bg-gradient-to-r from-blue-600 to-blue-700 rounded-xl hover:from-blue-700 hover:to-blue-800 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
              <svg class="mr-3 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
              </svg>
              Pelajari Lebih Lanjut
            </Link>
            
            <Link href="/video"
              class="inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-blue-700 bg-white border-2 border-blue-600 rounded-xl hover:bg-blue-50 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
              <svg class="mr-3 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h1.586a1 1 0 01.707.293l2.414 2.414a1 1 0 00.707.293H15M9 10V9a2 2 0 012-2h2a2 2 0 012 2v1m-4 0V8a1 1 0 011-1h2a1 1 0 011 1v2"/>
              </svg>
              Video Edukasi
            </Link>
          </div>
          
          <!-- Stats Cards -->
          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-shadow duration-300">
              <div class="w-16 h-16 bg-blue-100 rounded-xl flex items-center justify-center mx-auto mb-6">
                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
              </div>
              <h3 class="text-xl font-semibold text-gray-900 mb-4">Management Risiko</h3>
              <p class="text-gray-600 leading-relaxed"></p>
            </div>
            
            <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-shadow duration-300">
              <div class="w-16 h-16 bg-green-100 rounded-xl flex items-center justify-center mx-auto mb-6">
                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                </svg>
              </div>
              <h3 class="text-xl font-semibold text-gray-900 mb-4">Top Risk Perusahaan</h3>
              <p class="text-gray-600 leading-relaxed"></p>
            </div>
            
            <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-shadow duration-300 sm:col-span-2 lg:col-span-1">
              <div class="w-16 h-16 bg-red-100 rounded-xl flex items-center justify-center mx-auto mb-6">
                <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                </svg>
              </div>
              <h3 class="text-xl font-semibold text-gray-900 mb-4">Risk Culture</h3>
              <p class="text-gray-600 leading-relaxed"></p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Featured News Carousel -->
    <section v-if="featuredNews.length > 0" class="py-16 bg-gray-50">
      <div class="container mx-auto px-4">
        <div class="text-center mb-12">
          <h2 class="text-4xl font-bold text-gray-900 mb-4">Berita Utama</h2>
          <div class="w-32 h-1 bg-gradient-to-r from-blue-600 to-red-600 mx-auto rounded-full mb-6"></div>
          <p class="text-xl text-gray-600 max-w-3xl mx-auto">
            Informasi terkini mengenai keselamatan dan kesehatan kerja di lingkungan INALUM
          </p>
        </div>
        
        <div class="max-w-6xl mx-auto">
          <div class="relative bg-white rounded-3xl shadow-xl overflow-hidden">
            <div class="relative h-96 md:h-[32rem]">
              <!-- Slides -->
              <div v-for="(news, index) in featuredNews" :key="news.id" 
                   :class="['absolute inset-0 transition-all duration-700 ease-in-out', 
                           index === currentSlide ? 'opacity-100' : 'opacity-0']">
                
                <div class="relative w-full h-full">
                  <img v-if="news.image_url" 
                       :src="news.image_url" 
                       :alt="news.title" 
                       class="w-full h-full object-cover"
                       @error="handleImageError">
                  
                  <div v-else class="w-full h-full bg-gradient-to-br from-blue-200 to-blue-300 flex items-center justify-center">
                    <div class="text-center text-blue-800">
                      <svg class="w-24 h-24 mx-auto mb-4 opacity-60" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"/>
                      </svg>
                      <p class="text-2xl font-medium">{{ news.title }}</p>
                    </div>
                  </div>
                </div>
                
                <!-- Overlay -->
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent">
                  <div class="absolute bottom-0 left-0 right-0 p-8 md:p-12">
                    <div class="max-w-4xl">
                      <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold bg-white/20 backdrop-blur text-white border border-white/30 mb-6">
                        {{ getCategoryName(news.category) }}
                      </span>
                      <h3 class="text-3xl md:text-5xl font-bold text-white mb-6 leading-tight">{{ news.title }}</h3>
                      <p class="text-lg md:text-xl text-gray-100 line-clamp-3 mb-6 leading-relaxed opacity-90">
                        {{ news.content.substring(0, 200) }}...
                      </p>
                      <div class="flex items-center text-sm text-gray-300">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 002 2z"/>
                        </svg>
                        {{ formatDate(news.created_at) }}
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              
              <!-- Navigation -->
              <button v-if="featuredNews.length > 1"
                      @click="previousSlide"
                      class="absolute left-6 top-1/2 transform -translate-y-1/2 bg-white/20 backdrop-blur hover:bg-white/30 text-white p-4 rounded-full transition-all duration-300 shadow-lg z-10">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
              </button>
              
              <button v-if="featuredNews.length > 1"
                      @click="nextSlide"
                      class="absolute right-6 top-1/2 transform -translate-y-1/2 bg-white/20 backdrop-blur hover:bg-white/30 text-white p-4 rounded-full transition-all duration-300 shadow-lg z-10">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
              </button>
              
              <!-- Indicators -->
              <div v-if="featuredNews.length > 1" class="absolute bottom-8 left-1/2 transform -translate-x-1/2 flex space-x-3 z-10">
                <button v-for="(news, index) in featuredNews" :key="index"
                        @click="goToSlide(index)"
                        :class="['transition-all duration-300 rounded-full',
                                index === currentSlide 
                                  ? 'w-12 h-3 bg-white' 
                                  : 'w-3 h-3 bg-white/50 hover:bg-white/80']">
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Latest News Section -->
    <section class="py-16 bg-white">
      <div class="container mx-auto px-4">
        <div class="text-center mb-16">
          <h2 class="text-4xl font-bold text-gray-900 mb-4">Informasi Terkini</h2>
          <div class="w-32 h-1 bg-gradie3nt-to-r from-blue-600 to-red-600 mx-auto rounded-full mb-8"></div>
          <p class="text-xl text-gray-600 max-w-4xl mx-auto leading-relaxed">
            Dapatkan update terbaru mengenai kebijakan, prosedur, dan informasi penting seputar keselamatan dan kesehatan kerja
          </p>
        </div>
        
        <div v-if="activeNews.length > 0" class="max-w-7xl mx-auto">
          <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
            <article v-for="news in activeNews" :key="news.id" 
                     class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden border hover:border-blue-200 transform hover:-translate-y-2">
              
              <!-- Image Section -->
              <div class="relative h-64 bg-gradient-to-br from-gray-100 to-gray-200">
                <img v-if="news.image_url" 
                     :src="news.image_url" 
                     :alt="news.title" 
                     class="w-full h-full object-cover hover:scale-105 transition-transform duration-700"
                     @error="handleImageError">
                
                <div v-else class="w-full h-full bg-gradient-to-br from-blue-100 to-blue-200 flex items-center justify-center">
                  <div class="text-center text-blue-400">
                    <svg class="w-20 h-20 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <p class="text-lg font-medium">Artikel Berita</p>
                  </div>
                </div>
                
                <!-- Category Badge -->
                <div class="absolute top-6 left-6">
                  <span :class="['inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold backdrop-blur border shadow-lg', getCategoryBadgeClass(news.category)]">
                    {{ getCategoryName(news.category) }}
                  </span>
                </div>
              </div>
              
              <!-- Content Section -->
              <div class="p-8">
                <h3 class="text-xl font-bold text-gray-900 mb-4 line-clamp-2 hover:text-blue-700 transition-colors duration-300 leading-tight">
                  {{ news.title }}
                </h3>
                <p class="text-gray-600 line-clamp-3 mb-8 leading-relaxed">{{ news.content }}</p>
                
                <!-- Footer -->
                <div class="flex justify-between items-center pt-6 border-t border-gray-100">
                  <div class="flex items-center text-sm text-gray-500">
                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 002 2z"/>
                    </svg>
                    {{ formatDate(news.created_at) }}
                  </div>
                  <button @click="readMore(news)" 
                          class="inline-flex items-center text-blue-600 hover:text-blue-800 font-semibold transition-colors duration-300">
                    <span>Baca Selengkapnya</span>
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                  </button>
                </div>
              </div>
            </article>
          </div>
        </div>
        
        <!-- Empty State -->
        <div v-else class="text-center py-20">
          <div class="max-w-lg mx-auto">
            <div class="w-32 h-32 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-8">
              <svg class="w-16 h-16 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                      d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
              </svg>
            </div>
            <h3 class="text-2xl font-semibold text-gray-900 mb-6">Belum Ada Informasi Terkini</h3>
            <p class="text-lg text-gray-500 leading-relaxed">
              Informasi keselamatan dan kesehatan kerja akan segera tersedia untuk mendukung Inalum Safety Culture.
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- Modal -->
    <div v-if="showModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4" @click="closeModal">
      <div class="bg-white rounded-3xl max-w-4xl w-full max-h-[90vh] overflow-hidden relative" @click.stop>
        <!-- Close button -->
        <button @click="closeModal" class="absolute top-6 right-6 text-gray-500 hover:text-gray-700 z-10">
          <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
          </svg>
        </button>
        
        <!-- Modal content -->
        <div class="overflow-y-auto max-h-[90vh]">
          <!-- Header Image -->
          <div class="relative h-80">
            <img v-if="selectedNews?.image_url" 
                 :src="selectedNews.image_url" 
                 :alt="selectedNews.title" 
                 class="w-full h-full object-cover">
            
            <div v-else class="w-full h-full bg-gradient-to-br from-blue-200 via-green-200 to-red-200 flex items-center justify-center">
              <div class="text-center">
                <h3 class="text-4xl font-bold text-gray-800 mb-4">{{ selectedNews?.title }}</h3>
                <p class="text-xl text-gray-600">{{ selectedNews?.category === 'info' ? 'HUT ke-50 PT Indonesia Asahan Aluminium' : 'Dokumentasi Kegiatan K3' }}</p>
                <div class="w-32 h-1 bg-blue-500 mx-auto mt-4"></div>
              </div>
            </div>
            
            <!-- Category badge -->
            <div class="absolute top-6 left-6">
              <span :class="['inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold backdrop-blur border shadow-lg', getCategoryBadgeClass(selectedNews?.category)]">
                {{ getCategoryName(selectedNews?.category) }}
              </span>
            </div>
          </div>
          
          <!-- Content -->
          <div class="p-8">
            <div class="mb-6">
              <h2 class="text-3xl font-bold text-gray-900 mb-4">{{ selectedNews?.title }}</h2>
              <div class="flex items-center text-gray-500 text-sm mb-6">
                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11zM7 10h5v5H7z"/>
                </svg>
                <span class="mr-4">{{ formatDate(selectedNews?.created_at) }}</span>
                
                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                </svg>
                <span>Dokumentasi Kegiatan K3</span>
              </div>
            </div>
            
            <div class="prose max-w-none text-gray-700 leading-relaxed">
              <p class="text-lg mb-6">{{ selectedNews?.content }}</p>
              
              <!-- Additional content for modal -->
              <div class="bg-gray-50 rounded-xl p-6 mb-6">
                <h4 class="font-semibold text-gray-900 mb-3">Informasi Tambahan:</h4>
                <ul class="space-y-2 text-sm">
                  <li class="flex items-center">
                    <svg class="w-4 h-4 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                    Mengutamakan keselamatan dalam setiap aktivitas
                  </li>
                  <li class="flex items-center">
                    <svg class="w-4 h-4 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                    Mendukung budaya keselamatan INALUM
                  </li>
                  <li class="flex items-center">
                    <svg class="w-4 h-4 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                    Peningkatan kesadaran K3 berkelanjutan
                  </li>
                </ul>
              </div>
              
              <div class="border-t pt-6">
                <p class="text-sm text-gray-500 mb-4">
                  Artikel ini merupakan bagian dari komitmen PT Indonesia Asahan Aluminium dalam membangun budaya keselamatan dan kesehatan kerja yang berkelanjutan.
                </p>
                <div class="flex items-center justify-between">
                  <div class="flex items-center space-x-4">
                    <button class="inline-flex items-center text-blue-600 hover:text-blue-800 text-sm">
                      <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M15 8a3 3 0 10-2.977-2.63l-4.94 2.47a3 3 0 100 4.319l4.94 2.47a3 3 0 10.895-1.789l-4.94-2.47a3.027 3.027 0 000-.74l4.94-2.47C13.456 7.68 14.19 8 15 8z"/>
                      </svg>
                      Bagikan
                    </button>
                    <button class="inline-flex items-center text-gray-600 hover:text-gray-800 text-sm">
                      <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M5 4a2 2 0 012-2h6a2 2 0 012 2v14l-5-2.5L5 18V4z"/>
                      </svg>
                      Simpan
                    </button>
                  </div>
                  <span class="text-xs text-gray-400">ID: {{ selectedNews?.id }}</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </MainLayout>
</template>

<script setup>
import MainLayout from '@/Layouts/MainLayout.vue'
import { computed, ref, onMounted, onUnmounted } from 'vue'
import { Link, router } from '@inertiajs/vue3'

const props = defineProps({
  newsItems: Array,
  breakingNews: Object
})             

const currentSlide = ref(0)
let carouselInterval = null

// Filter active news
const activeNews = computed(() => {
  return props.newsItems ? props.newsItems.filter(n => n.is_active) : []
})

// Featured news with images for carousel
const featuredNews = computed(() => {
  return activeNews.value.filter(news => news.image_url).slice(0, 5)
})

// Format date
function formatDate(date) {
  if (!date) return ''
  return new Date(date).toLocaleDateString('id-ID', {
    day: 'numeric',
    month: 'long',
    year: 'numeric'
  })
}

// Get category badge class
function getCategoryBadgeClass(category) {
  const classes = {
    'info': 'bg-blue-50 text-blue-700 border-blue-200',
    'safety': 'bg-red-50 text-red-700 border-red-200',
    'announcement': 'bg-yellow-50 text-yellow-700 border-yellow-200',
    'event': 'bg-green-50 text-green-700 border-green-200'
  }
  return classes[category] || 'bg-gray-50 text-gray-700 border-gray-200'
}

// Get category name
function getCategoryName(category) {
  const names = {
    'info': 'Informasi',
    'safety': 'Keselamatan',
    'announcement': 'Pengumuman',
    'event': 'Event'
  }
  return names[category] || category
}

// Carousel functions
function nextSlide() {
  currentSlide.value = (currentSlide.value + 1) % featuredNews.value.length
  restartCarousel()
}

function previousSlide() {
  currentSlide.value = (currentSlide.value - 1 + featuredNews.value.length) % featuredNews.value.length
  restartCarousel()
}

function goToSlide(index) {
  currentSlide.value = index
  restartCarousel()
}

function startCarousel() {
  if (featuredNews.value.length > 1) {
    carouselInterval = setInterval(() => {
      currentSlide.value = (currentSlide.value + 1) % featuredNews.value.length
    }, 5000)
  }
}

function stopCarousel() {
  if (carouselInterval) {
    clearInterval(carouselInterval)
    carouselInterval = null
  }
}

function restartCarousel() {
  stopCarousel()
  setTimeout(startCarousel, 3000)
}

// Modal state
const showModal = ref(false)
const selectedNews = ref(null)

// Read more function
function readMore(news) {
  selectedNews.value = news
  showModal.value = true
}

function closeModal() {
  showModal.value = false
  selectedNews.value = null
}

// Handle image error
function handleImageError(event) {
  event.target.style.display = 'none'
  const fallback = event.target.nextElementSibling
  if (fallback) {
    fallback.style.display = 'flex'
  }
}

onMounted(() => {
  startCarousel()
})

onUnmounted(() => {
  stopCarousel()
})
</script>

<style scoped>
.line-clamp-2 {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

.line-clamp-3 {
  display: -webkit-box;
  -webkit-line-clamp: 3;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

/* Smooth transitions */
.transition-all {
  transition-property: all;
}

/* Responsive improvements */
@media (max-width: 640px) {
  .container {
    padding-left: 1rem;
    padding-right: 1rem;
  }
}
</style>