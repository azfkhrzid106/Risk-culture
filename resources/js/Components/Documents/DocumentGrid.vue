<!-- resources/js/Components/Documents/DocumentGrid.vue -->
<template>
  <div v-if="documents.length > 0" class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 mb-6">
    <div 
      v-for="doc in documents" 
      :key="doc.id" 
      class="group relative bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden border border-white/20 hover:-translate-y-1"
    >
      <!-- Gradient Overlay -->
      <div class="absolute inset-0 bg-gradient-to-br from-purple-500/5 via-transparent to-blue-500/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
      
      <div class="relative p-6">
        <!-- Header with Icon -->
        <div class="flex items-start mb-4">
          <div class="relative">
            <div class="w-14 h-14 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center mr-4 flex-shrink-0 shadow-lg group-hover:scale-110 transition-transform duration-300">
              <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
              </svg>
            </div>
            <!-- Pulse effect -->
            <div class="absolute inset-0 bg-purple-500 rounded-xl opacity-0 group-hover:opacity-20 group-hover:animate-ping"></div>
          </div>
          
          <div class="flex-1 min-w-0">
            <h3 class="font-bold text-gray-900 mb-2 line-clamp-2 text-lg group-hover:text-purple-600 transition-colors">
              {{ doc.title || doc.name || 'Untitled' }}
            </h3>
            
            <div class="mb-3">
              <span :class="['inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold shadow-sm', getCategoryBadgeClass(doc.category || 'general')]">
                <span class="w-1.5 h-1.5 rounded-full mr-2 animate-pulse" :class="getCategoryDotClass(doc.category || 'general')"></span>
                {{ categoryLabels[doc.category || 'general'] }}
              </span>
            </div>
            
            <p v-if="doc.description && doc.description.trim()" class="text-sm text-gray-600 mb-2 line-clamp-2 leading-relaxed">
              {{ doc.description }}
            </p>
            <p v-else class="text-sm text-gray-400 italic mb-2">Tidak ada deskripsi</p>
          </div>
        </div>
        
        <!-- File Info -->
        <div class="flex items-center justify-between text-xs mb-5 bg-gradient-to-r from-purple-50 to-blue-50 rounded-xl p-3 border border-purple-100/50">
          <span class="bg-gradient-to-r from-purple-600 to-purple-700 text-white px-3 py-1.5 rounded-lg font-bold shadow-sm">
            {{ getFileExtension(doc.filename || doc.name) }}
          </span>
          <span class="text-gray-600 font-medium">{{ formatFileSize(doc.size || doc.file_size) }}</span>
        </div>
        
        <!-- Action Buttons -->
        <div class="flex space-x-2">
          <button 
            @click="$emit('edit', doc)" 
            class="flex-1 px-4 py-2.5 bg-gradient-to-r from-blue-500 to-blue-600 text-white text-sm font-medium rounded-xl hover:from-blue-600 hover:to-blue-700 transform hover:scale-105 transition-all duration-200 shadow-md hover:shadow-lg flex items-center justify-center space-x-1"
          >
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
            </svg>
            <span>Edit</span>
          </button>
          
          <button 
            @click="$emit('delete', doc.id)" 
            class="flex-1 px-4 py-2.5 bg-gradient-to-r from-red-500 to-red-600 text-white text-sm font-medium rounded-xl hover:from-red-600 hover:to-red-700 transform hover:scale-105 transition-all duration-200 shadow-md hover:shadow-lg flex items-center justify-center space-x-1"
          >
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
            </svg>
            <span>Hapus</span>
          </button>
          
          <a 
            :href="`/download/${doc.id}`" 
            target="_blank"
            class="flex-1 px-4 py-2.5 bg-gradient-to-r from-green-500 to-green-600 text-white text-sm font-medium rounded-xl hover:from-green-600 hover:to-green-700 transform hover:scale-105 transition-all duration-200 shadow-md hover:shadow-lg flex items-center justify-center space-x-1"
          >
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
            </svg>
            <span>Download</span>
          </a>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Empty State -->
  <div v-else class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg p-16 text-center border border-white/20">
    <div class="max-w-md mx-auto">
      <!-- Animated Icon -->
      <div class="relative inline-block mb-6">
        <div class="absolute inset-0 bg-purple-500 rounded-full blur-2xl opacity-20 animate-pulse"></div>
        <svg class="relative mx-auto h-24 w-24 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
        </svg>
      </div>
      
      <h3 class="text-2xl font-bold text-gray-900 mb-3 bg-gradient-to-r from-purple-600 to-blue-600 bg-clip-text text-transparent">
        {{ filteredLength === 0 ? 'Belum ada dokumen' : 'Tidak ada dokumen untuk kategori ini' }}
      </h3>
      <p class="text-gray-600 text-lg">
        {{ filteredLength === 0 ? 'Upload dokumen pertama untuk memulai' : 'Coba kategori lain atau upload dokumen baru' }}
      </p>
    </div>
  </div>
</template>

<script setup>
defineProps({
  documents: {
    type: Array,
    required: true
  },
  filteredLength: {
    type: Number,
    default: 0
  }
});

defineEmits(['edit', 'delete', 'upload']);

const categoryLabels = {
  general: 'Umum',
  policy: 'Kebijakan',
  manual: 'Manual',
  safety: 'Keselamatan'
};

function getCategoryBadgeClass(category) {
  const classes = {
    general: 'bg-gradient-to-r from-gray-100 to-gray-200 text-gray-800 border border-gray-300',
    policy: 'bg-gradient-to-r from-blue-100 to-blue-200 text-blue-800 border border-blue-300',
    manual: 'bg-gradient-to-r from-green-100 to-green-200 text-green-800 border border-green-300',
    safety: 'bg-gradient-to-r from-red-100 to-red-200 text-red-800 border border-red-300'
  };
  return classes[category] || 'bg-gradient-to-r from-gray-100 to-gray-200 text-gray-800 border border-gray-300';
}

function getCategoryDotClass(category) {
  const classes = {
    general: 'bg-gray-600',
    policy: 'bg-blue-600',
    manual: 'bg-green-600',
    safety: 'bg-red-600'
  };
  return classes[category] || 'bg-gray-600';
}

function getFileExtension(filename) {
  if (!filename) return 'FILE';
  return filename.split('.').pop()?.toUpperCase() || 'FILE';
}

function formatFileSize(bytes) {
  if (!bytes) return 'Unknown';
  const sizes = ['B', 'KB', 'MB', 'GB'];
  const i = Math.floor(Math.log(bytes) / Math.log(1024));
  return Math.round(bytes / Math.pow(1024, i) * 100) / 100 + ' ' + sizes[i];
}
</script>

<style scoped>
.line-clamp-2 {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
</style>