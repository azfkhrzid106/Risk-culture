<!-- resources/js/Components/Dashboard/DashboardOverview.vue -->
<template>
  <section>
    <h1 class="text-3xl font-bold text-gray-900 mb-6">Dashboard Overview</h1>
    
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">
      <div class="bg-white p-6 rounded-xl shadow-sm">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-sm text-gray-600">Total Berita</p>
            <p class="text-2xl font-bold text-gray-900">{{ stats.newsTotal }}</p>
          </div>
          <div class="p-3 bg-blue-100 rounded-lg">
            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
            </svg>
          </div>
        </div>
      </div>
      
      <div class="bg-white p-6 rounded-xl shadow-sm">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-sm text-gray-600">Berita Aktif</p>
            <p class="text-2xl font-bold text-green-600">{{ stats.newsActive }}</p>
          </div>
          <div class="p-3 bg-green-100 rounded-lg">
            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
          </div>
        </div>
      </div>
      
      <div class="bg-white p-6 rounded-xl shadow-sm">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-sm text-gray-600">Total Dokumen</p>
            <p class="text-2xl font-bold text-purple-600">{{ stats.docsTotal }}</p>
          </div>
          <div class="p-3 bg-purple-100 rounded-lg">
            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
          </div>
        </div>
      </div>
      
      <div class="bg-white p-6 rounded-xl shadow-sm">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-sm text-gray-600">Draft</p>
            <p class="text-2xl font-bold text-yellow-600">{{ stats.newsInactive }}</p>
          </div>
          <div class="p-3 bg-yellow-100 rounded-lg">
            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Quick Actions -->
    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl p-6">
      <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>
      <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <button @click="$emit('addNews')" class="p-4 bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow">
          <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mb-3">
            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
            </svg>
          </div>
          <p class="text-sm font-medium text-gray-900">Tambah Berita</p>
        </button>
        
        <button @click="$emit('uploadDocument')" class="p-4 bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow">
          <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center mb-3">
            <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
            </svg>
          </div>
          <p class="text-sm font-medium text-gray-900">Upload Dokumen</p>
        </button>
        
        <button @click="$emit('viewNews')" class="p-4 bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow">
          <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mb-3">
            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
            </svg>
          </div>
          <p class="text-sm font-medium text-gray-900">Lihat Semua</p>
        </button>
        
        <button @click="$emit('clearFilters')" class="p-4 bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow">
          <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center mb-3">
            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
            </svg>
          </div>
          <p class="text-sm font-medium text-gray-900">Refresh</p>
        </button>
      </div>
    </div>
  </section>
</template>

<script setup>
defineProps({
  stats: {
    type: Object,
    required: true,
    default: () => ({
      newsTotal: 0,
      newsActive: 0,
      docsTotal: 0,
      newsInactive: 0
    })
  }
});

defineEmits(['addNews', 'uploadDocument', 'viewNews', 'clearFilters']);
</script>