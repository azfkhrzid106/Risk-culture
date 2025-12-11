<template>
  <MainLayout>
    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-blue-600 via-blue-700 to-blue-800 text-white py-20 overflow-hidden">
      <!-- Background animated shapes -->
      <div class="absolute inset-0 opacity-10">
        <div class="floating-shape absolute top-10 left-10 w-20 h-20 bg-white rounded-full"></div>
        <div class="floating-shape absolute top-32 right-20 w-16 h-16 bg-white rounded-lg rotate-45" style="animation-delay: 0.5s"></div>
        <div class="floating-shape absolute bottom-20 left-1/4 w-12 h-12 bg-white rounded-full" style="animation-delay: 1s"></div>
        <div class="floating-shape absolute bottom-32 right-1/3 w-24 h-24 bg-white rounded-lg rotate-12" style="animation-delay: 1.5s"></div>
      </div>
      
      <div class="container mx-auto px-6 text-center relative z-10">
        <h1 class="text-5xl md:text-6xl font-bold mb-6 animate-fade-in-up">
          <span class="text-yellow-400">Download</span> Center
        </h1>
        <p class="text-xl md:text-2xl mb-8 animate-fade-in-up opacity-90" style="animation-delay: 0.3s">
          Unduh dokumen, panduan, dan file penting sistem SRM INALUM
        </p>
        <div class="w-24 h-1 bg-yellow-400 mx-auto animate-scale-in" style="animation-delay: 0.6s"></div>
      </div>
    </section>

    <!-- Stats Section - Only Total Files -->
    <section class="py-12 bg-gray-50">
      <div class="container mx-auto px-6">
        <div class="flex justify-center">
          <div class="text-center animate-slide-in-up">
            <div class="text-4xl font-bold text-blue-600 mb-2">{{ files.length }}</div>
            <div class="text-gray-600">Total File Tersedia</div>
          </div>
        </div>
      </div>
    </section>

    <!-- Search Section - Simplified -->
    <section class="py-8 bg-white">
      <div class="container mx-auto px-6">
        <div class="max-w-2xl mx-auto">
          <div class="relative">
            <input 
              v-model="searchTerm"
              type="text" 
              placeholder="Cari file atau dokumen..."
              class="w-full pl-12 pr-4 py-3 border-2 border-gray-300 rounded-xl focus:border-blue-500 focus:outline-none transition-all duration-300"
            >
            <svg class="absolute left-4 top-3.5 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
            <button 
              v-if="searchTerm" 
              @click="clearSearch"
              class="absolute right-4 top-3.5 w-5 h-5 text-gray-400 hover:text-gray-600"
            >
              <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
              </svg>
            </button>
          </div>
        </div>
      </div>
    </section>

    <!-- Loading State -->
    <section v-if="loading" class="py-16 bg-gray-50">
      <div class="container mx-auto px-6">
        <div class="text-center">
          <div class="inline-block animate-spin rounded-full h-16 w-16 border-b-2 border-blue-600"></div>
          <p class="mt-4 text-gray-600">Memuat file...</p>
        </div>
      </div>
    </section>

    <!-- Downloads Section -->
    <section v-else class="py-16 bg-gray-50">
      <div class="container mx-auto px-6">

        <!-- No Files Found -->
        <div v-if="filteredFiles.length === 0 && !loading" class="text-center py-16">
          <div class="w-24 h-24 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-6">
            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
          </div>
          <h3 class="text-2xl font-bold text-gray-600 mb-4">Tidak ada file ditemukan</h3>
          <p class="text-gray-500 mb-6">
            {{ searchTerm ? 'Coba kata kunci lain untuk pencarian' : 'Belum ada file yang tersedia' }}
          </p>
          <button 
            v-if="searchTerm" 
            @click="clearSearch" 
            class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition-colors"
          >
            Reset Pencarian
          </button>
        </div>

        <!-- Files List -->
        <div v-else>
          <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-gray-800 animate-slide-in-up">
              File Downloads
            </h2>
            <p v-if="searchTerm" class="text-gray-600 mt-2">
              Menampilkan hasil pencarian untuk "<span class="font-semibold">{{ searchTerm }}</span>"
            </p>
          </div>
          
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div 
              v-for="file in filteredFiles" 
              :key="file.id"
              class="download-card bg-white rounded-2xl shadow-lg p-6 hover:shadow-2xl transition-all duration-300 transform hover:scale-105"
              :class="{ 'new-file': isNewFile(file.created_at) }"
            >
              <!-- File Header -->
              <div class="flex items-start mb-4">
                <div class="w-14 h-14 rounded-xl flex items-center justify-center mr-4 flex-shrink-0" :class="getFileTypeClass(file.filename || file.name)">
                  <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                  </svg>
                </div>
                <div class="flex-1 min-w-0">
                  <h3 class="font-bold text-gray-800 mb-2 line-clamp-2">{{ file.name || file.title || 'Unnamed File' }}</h3>
                  <p class="text-gray-600 text-sm mb-3 line-clamp-2">{{ file.description || 'Tidak ada deskripsi tersedia' }}</p>
                </div>
              </div>

              <!-- File Info -->
              <div class="flex items-center justify-between text-xs text-gray-500 mb-4 bg-gray-50 rounded-lg p-3">
                <div class="flex items-center space-x-3">
                  <span class="px-2 py-1 rounded-full text-white text-xs font-semibold" :class="getFileTypeClass(file.filename || file.name)">
                    {{ getFileExtension(file.filename || file.name) }}
                  </span>
                  <span class="font-medium">{{ formatFileSize(file.size || file.file_size) }}</span>
                </div>
                <span class="text-right">{{ formatDate(file.updated_at || file.created_at) }}</span>
              </div>

              <!-- Download Button -->
              <button 
                @click="downloadFile(file)"
                :disabled="downloading === file.id"
                class="download-btn w-full py-3 px-4 rounded-xl font-semibold transition-all duration-300 flex items-center justify-center bg-gradient-to-r from-blue-600 to-blue-700 text-white hover:from-blue-700 hover:to-blue-800 disabled:opacity-50"
              >
                <svg v-if="downloading === file.id" class="w-5 h-5 mr-2 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                </svg>
                <svg v-else class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                {{ downloading === file.id ? 'Mengunduh...' : 'Download File' }}
              </button>


            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Help Section -->
    <section class="py-16 bg-gradient-to-br from-gray-50 to-gray-100">
      <div class="container mx-auto px-6">
        <div class="max-w-4xl mx-auto text-center">
          <div class="bg-white rounded-3xl shadow-xl p-8 md:p-12">
            <div class="w-20 h-20 bg-gradient-to-br from-blue-600 to-blue-700 rounded-full flex items-center justify-center mx-auto mb-8">
              <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
              </svg>
            </div>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-6">Butuh Bantuan?</h2>
            <p class="text-xl text-gray-600 mb-8 leading-relaxed">
              Jika Anda mengalami kesulitan dalam mendownload file atau tidak dapat menemukan dokumen yang Anda cari, 
              jangan ragu untuk menghubungi tim support kami.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
              <a href="/kontak" class="bg-gradient-to-r from-blue-600 to-blue-700 text-white px-8 py-4 rounded-xl font-semibold hover:from-blue-700 hover:to-blue-800 transition-all duration-300 transform hover:scale-105 inline-flex items-center justify-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
                Hubungi Kami
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>
  </MainLayout>
</template>

<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import { ref, computed, onMounted } from 'vue';
import { usePage } from '@inertiajs/vue3';

// Get data from Inertia props
const page = usePage();

// Define props
const props = defineProps({
  files: {
    type: Array,
    default: () => []
  }
});

// Reactive data
const files = ref(props.files || []);
const searchTerm = ref('');
const loading = ref(false);
const downloading = ref(null);

// Computed properties
const filteredFiles = computed(() => {
  let result = files.value;

  // Filter by search term
  if (searchTerm.value) {
    const term = searchTerm.value.toLowerCase();
    result = result.filter(file => 
      (file.name || '').toLowerCase().includes(term) || 
      (file.filename || '').toLowerCase().includes(term) ||
      (file.description || '').toLowerCase().includes(term)
    );
  }

  return result;
});

// Methods
const downloadFile = async (file) => {
  downloading.value = file.id;
  
  try {
    // Update download count via API first (optional)
    try {
      await fetch(`/api/downloads/${file.id}`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
        }
      });
    } catch (trackError) {
      console.warn('Failed to track download:', trackError);
    }

    // Download file using the Laravel route
    window.location.href = `/download/${file.id}`;

    // Update download count in UI
    const fileIndex = files.value.findIndex(f => f.id === file.id);
    if (fileIndex !== -1) {
      files.value[fileIndex].download_count = (files.value[fileIndex].download_count || 0) + 1;
    }

  } catch (error) {
    console.error('Download error:', error);
    alert('Gagal mendownload file. Silakan coba lagi.');
  } finally {
    downloading.value = null;
  }
};

const clearSearch = () => {
  searchTerm.value = '';
};

const isNewFile = (createdAt) => {
  const daysDiff = Math.floor((Date.now() - new Date(createdAt)) / (1000 * 60 * 60 * 24));
  return daysDiff <= 7; // File dianggap baru jika < 7 hari
};

const formatFileSize = (bytes) => {
  if (!bytes) return 'Unknown';
  
  const sizes = ['Bytes', 'KB', 'MB', 'GB'];
  const i = Math.floor(Math.log(bytes) / Math.log(1024));
  return Math.round(bytes / Math.pow(1024, i) * 100) / 100 + ' ' + sizes[i];
};

const formatDate = (dateString) => {
  if (!dateString) return 'Unknown';
  
  const date = new Date(dateString);
  return date.toLocaleDateString('id-ID', {
    year: 'numeric',
    month: 'short',
    day: 'numeric'
  });
};

const getFileExtension = (filename) => {
  if (!filename) return 'FILE';
  const ext = filename.split('.').pop();
  return ext ? ext.toUpperCase() : 'FILE';
};

const getFileTypeClass = (filename) => {
  const ext = getFileExtension(filename).toLowerCase();
  const typeMap = {
    pdf: 'bg-red-500',
    doc: 'bg-blue-600',
    docx: 'bg-blue-600',
    xls: 'bg-green-600',
    xlsx: 'bg-green-600',
    ppt: 'bg-orange-500',
    pptx: 'bg-orange-500',
    txt: 'bg-gray-600',
    jpg: 'bg-purple-500',
    jpeg: 'bg-purple-500',
    png: 'bg-purple-500',
    gif: 'bg-purple-500',
    zip: 'bg-yellow-600',
    rar: 'bg-yellow-600'
  };
  
  return typeMap[ext] || 'bg-gray-500';
};

// Component lifecycle
onMounted(() => {
  console.log('Download page loaded with', files.value.length, 'files');
});
</script>

<style scoped>
/* Animation keyframes */
@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translateY(30px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

@keyframes slideInUp {
  from {
    opacity: 0;
    transform: translateY(50px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

@keyframes scaleIn {
  from {
    opacity: 0;
    transform: scaleX(0);
  }
  to {
    opacity: 1;
    transform: scaleX(1);
  }
}

@keyframes floating {
  0%, 100% {
    transform: translateY(0px) rotate(0deg);
  }
  33% {
    transform: translateY(-10px) rotate(5deg);
  }
  66% {
    transform: translateY(-5px) rotate(-5deg);
  }
}

/* Animation classes */
.animate-fade-in-up {
  animation: fadeInUp 0.8s ease-out forwards;
  opacity: 0;
}

.animate-slide-in-up {
  animation: slideInUp 0.8s ease-out forwards;
  opacity: 0;
}

.animate-scale-in {
  animation: scaleIn 0.6s ease-out forwards;
  opacity: 0;
}

.floating-shape {
  animation: floating 6s ease-in-out infinite;
}

/* Card animations and effects */
.download-card {
  opacity: 0;
  transform: translateY(30px);
  transition: all 0.6s ease;
  animation: slideInUp 0.6s ease-out forwards;
}

.download-card:hover {
  transform: translateY(-5px) scale(1.02);
  box-shadow: 0 20px 40px rgba(0,0,0,0.1);
}

.download-btn {
  position: relative;
  overflow: hidden;
}

.download-btn:before {
  content: '';
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
  transition: left 0.5s;
}

.download-btn:hover:before {
  left: 100%;
}

/* New file badge animation */
@keyframes pulse-new {
  0% {
    box-shadow: 0 0 0 0 rgba(34, 197, 94, 0.7);
  }
  70% {
    box-shadow: 0 0 0 10px rgba(34, 197, 94, 0);
  }
  100% {
    box-shadow: 0 0 0 0 rgba(34, 197, 94, 0);
  }
}

.new-file {
  position: relative;
}

.new-file:before {
  content: 'BARU';
  position: absolute;
  top: -8px;
  right: -8px;
  background: linear-gradient(135deg, #22c55e, #16a34a);
  color: white;
  padding: 4px 8px;
  border-radius: 12px;
  font-size: 10px;
  font-weight: bold;
  animation: pulse-new 2s infinite;
  z-index: 10;
  box-shadow: 0 2px 4px rgba(34, 197, 94, 0.3);
}

/* Text utilities */
.line-clamp-2 {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

/* Responsive design */
@media (max-width: 768px) {
  .download-card {
    margin-bottom: 1rem;
  }
  
  .animate-fade-in-up,
  .animate-slide-in-up {
    animation-delay: 0s !important;
  }
  
  .new-file:before {
    font-size: 9px;
    padding: 3px 6px;
  }
}

@media (max-width: 640px) {
  .grid-cols-1 {
    gap: 1rem;
  }
}
</style>