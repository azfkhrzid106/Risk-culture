<!-- resources/js/Components/Layout/Sidebar.vue -->
<template>
  <div>
    <!-- Mobile Sidebar -->
    <div v-if="showSidebar" class="fixed inset-0 z-50 lg:hidden">
      <div class="fixed inset-0 bg-black/50" @click="emit('closeSidebar')"></div>
      <div class="fixed left-0 top-0 h-full w-80 bg-white shadow-2xl">
        <div class="p-4 bg-blue-600 text-white relative">
          <h2 class="text-lg font-bold">K3-INALUM Admin</h2>
          <button @click="emit('closeSidebar')" class="absolute top-4 right-4">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
          </button>
        </div>
        <nav class="p-4 space-y-2">
          <button @click="handleTabChange('dashboard')" 
                  :class="getTabClass('dashboard')">
            Dashboard
          </button>
          <button @click="handleTabChange('news')"
                  :class="getTabClass('news')">
            Kelola Berita
          </button>
          <button @click="handleTabChange('documents')"
                  :class="getTabClass('documents')">
            Kelola Dokumen
          </button>
          <button @click="handleTabChange('tmrd')"
                  :class="getTabClass('tmrd')">
            Kelola TMRD
          </button>
        </nav>
        <div class="absolute bottom-4 left-4 right-4">
          <button @click="emit('logout')" class="w-full px-4 py-2 bg-red-50 text-red-600 rounded-lg">
            Logout
          </button>
        </div>
      </div>
    </div>

    <!-- Desktop Sidebar -->
    <aside class="hidden lg:flex lg:flex-col lg:w-80 lg:fixed lg:inset-y-0 bg-white shadow-xl">
      <div class="p-6 bg-gradient-to-r from-blue-600 to-indigo-600 text-white">
        <h2 class="text-xl font-bold">K3-INALUM Admin</h2>
        <p class="text-sm opacity-90">Dashboard Panel</p>
      </div>
      
      <nav class="flex-1 p-4 space-y-2">
        <button @click="handleTabChange('dashboard')" 
                :class="getTabClass('dashboard', true)">
          <svg class="w-5 h-5 inline mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"/>
          </svg>
          Dashboard
        </button>
        
        <button @click="handleTabChange('news')"
                :class="getTabClass('news', true)">
          <svg class="w-5 h-5 inline mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
          </svg>
          Kelola Berita
          <span class="ml-auto bg-blue-100 text-blue-700 text-xs px-2 py-1 rounded-full">{{ newsCount }}</span>
        </button>
        
        <button @click="handleTabChange('documents')"
                :class="getTabClass('documents', true)">
          <svg class="w-5 h-5 inline mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
          </svg>
          Kelola Dokumen
          <span class="ml-auto bg-purple-100 text-purple-700 text-xs px-2 py-1 rounded-full">{{ documentsCount }}</span>
        </button>

        <!-- MENU BARU: Kelola TMRD -->
        <button @click="handleTabChange('tmrd')"
                :class="getTabClass('tmrd', true)">
          <svg class="w-5 h-5 inline mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
          </svg>
          Kelola TMRD
          <span class="ml-auto bg-green-100 text-green-700 text-xs px-2 py-1 rounded-full">{{ tmrdCount }}</span>
        </button>
      </nav>
      
      <div class="p-4">
        <div class="mb-4 p-3 bg-gray-50 rounded-lg">
          <div class="flex items-center space-x-3">
            <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center text-white text-sm font-semibold">A</div>
            <div>
              <p class="text-sm font-medium text-gray-900">Admin User</p>
              <p class="text-xs text-gray-500">Administrator</p>
            </div>
          </div>
        </div>
        <button @click="emit('logout')" class="w-full px-4 py-3 bg-red-50 text-red-600 rounded-xl font-medium hover:bg-red-100">
          <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
          </svg>
          Logout
        </button>
      </div>
    </aside>
  </div>
</template>

<script setup>
// ambil props
const { showSidebar, activeTab, newsCount, documentsCount, tmrdCount } = defineProps({
  showSidebar: { type: Boolean, required: true },
  activeTab: { type: String, required: true },
  newsCount: { type: Number, default: 0 },
  documentsCount: { type: Number, default: 0 },
  tmrdCount: { type: Number, default: 0 } // TAMBAHAN: prop untuk count TMRD
})

// emit events
const emit = defineEmits(['closeSidebar', 'changeTab', 'logout'])

function handleTabChange(tab) {
  emit('changeTab', tab)
  emit('closeSidebar')
}

function getTabClass(tab, isDesktop = false) {
  const baseClass = isDesktop 
    ? 'w-full text-left px-4 py-3 rounded-xl font-medium flex items-center gap-2'
    : 'w-full text-left px-4 py-2 rounded-lg'

  const activeClass = activeTab === tab 
    ? 'bg-blue-50 text-blue-700' 
    : 'text-gray-600 hover:bg-gray-50'

  return [baseClass, activeClass]
}
</script>