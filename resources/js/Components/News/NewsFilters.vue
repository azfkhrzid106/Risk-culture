<!-- resources/js/Components/News/NewsFilters.vue -->
<template>
  <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-6">
    <div class="flex flex-col lg:flex-row gap-4">
      <!-- Search Input dengan Icon -->
      <div class="flex-1 relative">
        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
          <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
          </svg>
        </div>
        <input 
          :value="search" 
          @input="$emit('update:search', $event.target.value)"
          type="text" 
          placeholder="Cari judul atau konten berita..." 
          class="w-full pl-12 pr-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all placeholder:text-gray-400"
        >
        <!-- Clear Search Button -->
        <button
          v-if="search"
          @click="$emit('update:search', '')"
          class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-gray-600"
        >
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
          </svg>
        </button>
      </div>

      <!-- Category Dropdown -->
      <div class="lg:w-64 relative">
        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
          <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
          </svg>
        </div>
        <select 
          :value="category" 
          @change="$emit('update:category', $event.target.value)"
          class="w-full pl-12 pr-10 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 appearance-none bg-white transition-all cursor-pointer"
        >
          <option value="">Semua Kategori</option>
          <option value="info">📘 Informasi</option>
          <option value="safety">🛡️ Keselamatan</option>
          <option value="announcement">📢 Pengumuman</option>
          <option value="event">🎉 Event</option>
        </select>
        <!-- Custom Arrow Icon -->
        <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
          <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
          </svg>
        </div>
      </div>

      <!-- Reset Button -->
      <button 
        @click="$emit('reset')" 
        class="px-6 py-3 bg-gray-50 hover:bg-gray-100 text-gray-700 rounded-xl font-medium transition-all flex items-center gap-2 group border border-gray-200"
      >
        <svg class="w-5 h-5 transition-transform group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
        </svg>
        <span class="hidden lg:inline">Reset</span>
      </button>
    </div>

    <!-- Active Filters Display (jika ada filter aktif) -->
    <div v-if="search || category" class="mt-4 flex flex-wrap gap-2 items-center">
      <span class="text-sm text-gray-500 font-medium">Filter aktif:</span>
      
      <!-- Search Filter Chip -->
      <div v-if="search" class="inline-flex items-center gap-2 px-3 py-1.5 bg-indigo-50 text-indigo-700 rounded-lg text-sm font-medium">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
        </svg>
        "{{ search }}"
        <button 
          @click="$emit('update:search', '')"
          class="hover:bg-indigo-100 rounded p-0.5 transition-colors"
        >
          <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
          </svg>
        </button>
      </div>

      <!-- Category Filter Chip -->
      <div v-if="category" class="inline-flex items-center gap-2 px-3 py-1.5 bg-purple-50 text-purple-700 rounded-lg text-sm font-medium">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
        </svg>
        {{ getCategoryLabel(category) }}
        <button 
          @click="$emit('update:category', '')"
          class="hover:bg-purple-100 rounded p-0.5 transition-colors"
        >
          <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
          </svg>
        </button>
      </div>

      <!-- Clear All -->
      <button
        @click="$emit('reset')"
        class="text-sm text-gray-500 hover:text-gray-700 underline ml-2"
      >
        Hapus semua
      </button>
    </div>
  </div>
</template>

<script setup>
defineProps({
  search: { type: String, default: '' },
  category: { type: String, default: '' }
})

defineEmits(['update:search', 'update:category', 'reset'])

const categoryLabels = {
  info: 'Informasi',
  safety: 'Keselamatan',
  announcement: 'Pengumuman',
  event: 'Event'
}

function getCategoryLabel(cat) {
  return categoryLabels[cat] || cat
}
</script>

<style scoped>
/* Custom select arrow removal untuk berbagai browser */
select {
  background-image: none;
}

select::-ms-expand {
  display: none;
}

/* Focus ring yang lebih smooth */
input:focus,
select:focus {
  outline: none;
  box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
}

/* Smooth transitions */
button,
input,
select {
  transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
}
</style>