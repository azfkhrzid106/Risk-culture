<template>
  <MainLayout>
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50">
      <!-- Header Section -->
      <div class="bg-white shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div class="py-6">
            <div class="flex items-center space-x-3">
              <div class="flex-shrink-0">
                <div class="w-12 h-12 bg-blue-500 rounded-xl flex items-center justify-center">
                  <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h1m4 0h1m-7 4h12m-6-2a9 9 0 110-18 9 9 0 010 18z"/>
                  </svg>
                </div>
              </div>
              <div>
                <h1 class="text-3xl font-bold text-gray-900">Galeri Video</h1>
                <p class="text-gray-600">Platform Video Manajemen Risiko</p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Video Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
          <div v-for="video in videos" :key="video.id" class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
            <div class="relative">
              <video 
                :poster="video.thumbnail" 
                class="w-full h-56 object-cover group-hover:scale-105 transition-transform duration-500"
                preload="metadata"
              >
                <source :src="video.src" type="video/mp4">
                Browser Anda tidak mendukung video HTML5.
              </video>
              
              <!-- Play Overlay -->
              <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300">
                <button @click="playVideo(video)" class="bg-white bg-opacity-95 rounded-full p-5 hover:bg-opacity-100 transition-all transform hover:scale-110 shadow-lg">
                  <svg class="w-10 h-10 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"/>
                  </svg>
                </button>
              </div>
              
              <!-- Duration Badge -->
              <div class="absolute bottom-3 right-3 bg-black bg-opacity-80 text-white text-sm px-3 py-1 rounded-full font-medium">
                {{ video.duration }}
              </div>
            </div>
            
            <div class="p-8">
              <div class="mb-3">
                <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-semibold bg-blue-100 text-blue-800">
                  {{ getCategoryName(video.category) }}
                </span>
              </div>
              
              <h3 class="text-xl font-bold text-gray-900 mb-4 group-hover:text-blue-600 transition-colors leading-tight">
                {{ video.title }}
              </h3>
              
              <p class="text-gray-600 mb-6 leading-relaxed">
                {{ video.description }}
              </p>
              
              <div class="flex items-center justify-between pt-6 border-t border-gray-100">
                <div class="flex items-center text-gray-500">
                  <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                  </svg>
                  <span class="font-medium">{{ video.views }} views</span>
                </div>
                
                <button @click="downloadVideo(video)" class="flex items-center text-blue-600 hover:text-blue-800 font-semibold transition-colors">
                  <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                  </svg>
                  Download
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Video Modal -->
      <div v-if="currentVideo" class="fixed inset-0 bg-black bg-opacity-80 flex items-center justify-center z-50 p-4">
        <div class="bg-white rounded-2xl max-w-5xl w-full max-h-[90vh] overflow-hidden shadow-2xl">
          <div class="flex items-center justify-between p-6 border-b border-gray-200">
            <div>
              <h3 class="text-xl font-bold text-gray-900">{{ currentVideo.title }}</h3>
              <p class="text-gray-600 mt-1">{{ getCategoryName(currentVideo.category) }}</p>
            </div>
            <button @click="closeVideo" class="text-gray-400 hover:text-gray-600 transition-colors">
              <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
              </svg>
            </button>
          </div>
          
          <div class="p-6">
            <video 
              controls 
              autoplay 
              class="w-full h-auto max-h-96 rounded-lg"
              @loadedmetadata="onVideoLoaded"
            >
              <source :src="currentVideo.src" type="video/mp4">
              Browser Anda tidak mendukung video HTML5.
            </video>
            
            <div class="mt-6 p-4 bg-gray-50 rounded-xl">
              <h4 class="font-semibold text-gray-900 mb-2">Deskripsi Video</h4>
              <p class="text-gray-700 leading-relaxed">{{ currentVideo.description }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </MainLayout>
</template>

<script setup>
import { ref } from 'vue';
import MainLayout from '@/Layouts/MainLayout.vue';

const currentVideo = ref(null);

// Data 3 video statis - Ganti dengan video Anda
const videos = ref([
  {
  id: 1,
  title: 'Pentingnya Menggunakan APD di Area Kerja',
  description: 'Video ini menjelaskan langkah-langkah tepat dalam menggunakan Alat Pelindung Diri (APD) untuk mencegah risiko kecelakaan kerja dan meningkatkan keselamatan di lingkungan smelter.',
  category: 'Risk Moment', // safety, training, atau maintenance
  duration: '01:19',
  thumbnail: '/storage/thumbnails/video1.jpg', // Path thumbnail Anda
  src: '/storage/videos/video1.mp4' // Path MP4 Anda
  },
  {
  id: 2,
  title: 'Prosedur Evakuasi Darurat dengan Aman',
  description: 'Materi ini memberikan panduan praktis tentang cara melakukan evakuasi ketika terjadi keadaan darurat di area kerja, termasuk jalur evakuasi dan titik kumpul.',
  category: 'Risk Moment', // safety, training, atau maintenance
  duration: '01:17',
  thumbnail: '/storage/thumbnails/video1.jpg', // Path thumbnail Anda
 src: '/storage/videos/video2.mp4' // Path MP4 Anda
  },
  {
  id: 3,
  title: 'Mengenali Potensi Bahaya di Tempat Kerja',
  description: 'Video ini membantu pekerja mengenali potensi bahaya, seperti tumpahan bahan kimia atau area berisiko tinggi, agar dapat mengambil tindakan pencegahan sebelum terjadi kecelakaan.',
  category: 'Risk Moment', // safety, training, atau maintenance
  duration: '01:29',
  thumbnail: '/storage/thumbnails/video1.jpg', // Path thumbnail Anda
 src: '/storage/videos/video3.mp4' // Path MP4 Anda
  },
]);

// Methods
const playVideo = (video) => {
  currentVideo.value = video;
};

const closeVideo = () => {
  currentVideo.value = null;
};

const downloadVideo = (video) => {
  const link = document.createElement('a');
  link.href = video.src;
  link.download = `${video.title}.mp4`;
  link.click();
};

const onVideoLoaded = (event) => {
  console.log('Video loaded:', event.target.duration);
};

const getCategoryName = (category) => {
  const categories = {
    'safety': 'Keselamatan',
    'training': 'Pelatihan',
    'maintenance': 'Maintenance'
  };
  return categories[category] || category;
};
</script>