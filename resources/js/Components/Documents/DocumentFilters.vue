<!-- resources/js/Components/Documents/DocumentFilters.vue -->
<template>
  <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg p-6 mb-6 border border-white/20">
    <div class="flex flex-col lg:flex-row gap-4">
      <!-- Search Input -->
      <div class="flex-1 relative group">
        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
          <svg class="h-5 w-5 text-gray-400 group-focus-within:text-purple-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
          </svg>
        </div>
        <input 
          :value="searchQuery" 
          @input="updateSearch"
          type="text" 
          placeholder="Cari dokumen berdasarkan judul atau deskripsi..." 
          class="w-full pl-12 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-200 bg-white/50 backdrop-blur-sm hover:border-purple-300"
        >
      </div>
      
      <!-- Category Select -->
      <div class="relative group">
        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
          <svg class="h-5 w-5 text-gray-400 group-focus-within:text-purple-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
          </svg>
        </div>
        <select 
          :value="selectedCategory" 
          @change="updateCategory"
          class="pl-12 pr-10 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-200 bg-white/50 backdrop-blur-sm appearance-none cursor-pointer hover:border-purple-300 font-medium"
        >
          <option value="all">🗂️ Semua Kategori</option>
          <option value="general">📄 Umum</option>
          <option value="policy">📋 Kebijakan</option>
          <option value="manual">📖 Manual</option>
          <option value="safety">🛡️ Keselamatan</option>
        </select>
        <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
          <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
          </svg>
        </div>
      </div>
      
      <!-- Reset Button -->
      <button 
        @click="$emit('clear')" 
        class="px-6 py-3 bg-gradient-to-r from-gray-100 to-gray-200 text-gray-700 rounded-xl hover:from-gray-200 hover:to-gray-300 transition-all duration-200 font-medium flex items-center space-x-2 border-2 border-gray-300 hover:border-gray-400 transform hover:scale-105 shadow-sm hover:shadow-md"
      >
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
        </svg>
        <span>Reset</span>
      </button>
    </div>
    
    <!-- Active Filters Display -->
    <div v-if="searchQuery || selectedCategory !== 'all'" class="mt-4 flex items-center flex-wrap gap-2">
      <span class="text-sm text-gray-600 font-medium">Filter aktif:</span>
      
      <span v-if="searchQuery" class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-800 border border-purple-200">
        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
        </svg>
        "{{ searchQuery }}"
      </span>
      
      <span v-if="selectedCategory !== 'all'" class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800 border border-blue-200">
        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
        </svg>
        {{ getCategoryLabel(selectedCategory) }}
      </span>
    </div>
  </div>
</template>

<script setup>
defineProps({
  searchQuery: String,
  selectedCategory: String
});

const emit = defineEmits(['update:searchQuery', 'update:selectedCategory', 'clear']);

function updateSearch(event) {
  emit('update:searchQuery', event.target.value);
}

function updateCategory(event) {
  emit('update:selectedCategory', event.target.value);
}

function getCategoryLabel(category) {
  const labels = {
    general: 'Umum',
    policy: 'Kebijakan',
    manual: 'Manual',
    safety: 'Keselamatan'
  };
  return labels[category] || category;
}
</script>