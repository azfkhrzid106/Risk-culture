<template>
  <div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50">
    <!-- Mobile Sidebar -->
    <div v-if="showSidebar" class="fixed inset-0 z-50 lg:hidden">
      <div class="fixed inset-0 bg-black/50" @click="showSidebar = false"></div>
      <div class="fixed left-0 top-0 h-full w-80 bg-white shadow-2xl">
        <div class="p-4 bg-blue-600 text-white">
          <h2 class="text-lg font-bold">K3-INALUM Admin</h2>
          <button @click="showSidebar = false" class="absolute top-4 right-4">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
          </button>
        </div>
        <nav class="p-4 space-y-2">
          <button @click="activeTab = 'dashboard'; showSidebar = false" 
                  :class="['w-full text-left px-4 py-2 rounded-lg', activeTab === 'dashboard' ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-50']">
            Dashboard
          </button>
          <button @click="activeTab = 'news'; showSidebar = false"
                  :class="['w-full text-left px-4 py-2 rounded-lg', activeTab === 'news' ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-50']">
            Kelola Berita
          </button>
          <button @click="activeTab = 'documents'; showSidebar = false"
                  :class="['w-full text-left px-4 py-2 rounded-lg', activeTab === 'documents' ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-50']">
            Kelola Dokumen
          </button>
        </nav>
        <div class="absolute bottom-4 left-4 right-4">
          <button @click="logout" class="w-full px-4 py-2 bg-red-50 text-red-600 rounded-lg">Logout</button>
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
        <button @click="activeTab = 'dashboard'" 
                :class="['w-full text-left px-4 py-3 rounded-xl font-medium', activeTab === 'dashboard' ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-50']">
          <svg class="w-5 h-5 inline mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"/>
          </svg>
          Dashboard
        </button>
        
        <button @click="activeTab = 'news'"
                :class="['w-full text-left px-4 py-3 rounded-xl font-medium', activeTab === 'news' ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-50']">
          <svg class="w-5 h-5 inline mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
          </svg>
          Kelola Berita
          <span class="ml-auto bg-blue-100 text-blue-700 text-xs px-2 py-1 rounded-full">{{ props.newsItems.length }}</span>
        </button>
        
        <button @click="activeTab = 'documents'"
                :class="['w-full text-left px-4 py-3 rounded-xl font-medium', activeTab === 'documents' ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-50']">
          <svg class="w-5 h-5 inline mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
          </svg>
          Kelola Dokumen
          <span class="ml-auto bg-purple-100 text-purple-700 text-xs px-2 py-1 rounded-full">{{ dashboardStats.docsTotal }}</span>
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
        <button @click="logout" class="w-full px-4 py-3 bg-red-50 text-red-600 rounded-xl font-medium hover:bg-red-100">
          <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
          </svg>
          Logout
        </button>
      </div>
    </aside>

    <!-- Main Content -->
    <main class="lg:ml-80">
      <!-- Mobile Header -->
      <header class="lg:hidden bg-white shadow-sm px-4 py-3 sticky top-0 z-40">
        <div class="flex items-center justify-between">
          <button @click="showSidebar = true" class="p-2 rounded-lg text-gray-600 hover:bg-gray-100">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
          </button>
          <h1 class="font-semibold text-gray-900">K3-INALUM Admin</h1>
          <div class="w-8 h-8 bg-blue-500 rounded-full"></div>
        </div>
      </header>

      <div class="p-6">
        <!-- Dashboard -->
        <section v-if="activeTab === 'dashboard'">
          <h1 class="text-3xl font-bold text-gray-900 mb-6">Dashboard Overview</h1>
          
          <!-- Stats Cards -->
          <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">
            <div class="bg-white p-6 rounded-xl shadow-sm">
              <div class="flex items-center justify-between">
                <div>
                  <p class="text-sm text-gray-600">Total Berita</p>
                  <p class="text-2xl font-bold text-gray-900">{{ dashboardStats.newsTotal }}</p>
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
                  <p class="text-2xl font-bold text-green-600">{{ dashboardStats.newsActive }}</p>
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
                  <p class="text-2xl font-bold text-purple-600">{{ dashboardStats.docsTotal }}</p>
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
                  <p class="text-2xl font-bold text-yellow-600">{{ dashboardStats.newsInactive }}</p>
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
              <button @click="showForm = true; activeTab = 'news'" class="p-4 bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow">
                <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mb-3">
                  <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                  </svg>
                </div>
                <p class="text-sm font-medium text-gray-900">Tambah Berita</p>
              </button>
              
              <button @click="showDocumentForm = true; activeTab = 'documents'" class="p-4 bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow">
                <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center mb-3">
                  <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                  </svg>
                </div>
                <p class="text-sm font-medium text-gray-900">Upload Dokumen</p>
              </button>
              
              <button @click="activeTab = 'news'" class="p-4 bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow">
                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mb-3">
                  <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                  </svg>
                </div>
                <p class="text-sm font-medium text-gray-900">Lihat Semua</p>
              </button>
              
              <button @click="clearFilters" class="p-4 bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow">
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

        <!-- News Management -->
        <section v-if="activeTab === 'news'">
          <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-900">Kelola Berita</h1>
            <button @click="showForm = true" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
              <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
              </svg>
              Tambah Berita
            </button>
          </div>
          
          <!-- Filters -->
          <div class="bg-white rounded-xl shadow-sm p-4 mb-6">
            <div class="flex flex-col lg:flex-row gap-4">
              <div class="flex-1">
                <input v-model="searchQuery" type="text" placeholder="Cari berita..." 
                       class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
              </div>
              <select v-model="selectedCategory" class="px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                <option value="all">Semua Kategori</option>
                <option value="info">Informasi</option>
                <option value="safety">Keselamatan</option>
                <option value="announcement">Pengumuman</option>
                <option value="event">Event</option>
              </select>
              <button @click="clearFilters" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200">
                Reset
              </button>
            </div>
          </div>

          <!-- News Form -->
          <div v-if="showForm" class="bg-white rounded-xl shadow-lg p-6 mb-6">
            <div class="flex justify-between items-center mb-4">
              <h2 class="text-xl font-semibold">{{ editingNews ? 'Edit Berita' : 'Tambah Berita' }}</h2>
              <button @click="resetNewsForm" class="text-gray-400 hover:text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
              </button>
            </div>
            
            <form @submit.prevent="saveNews" class="space-y-4">
              <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                <div class="lg:col-span-2">
                  <label class="block text-sm font-medium text-gray-700 mb-1">Judul</label>
                  <input v-model="newsForm.title" type="text" required 
                         class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                </div>
                
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                  <select v-model="newsForm.category" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                    <option value="info">Informasi</option>
                    <option value="safety">Keselamatan</option>
                    <option value="announcement">Pengumuman</option>
                    <option value="event">Event</option>
                  </select>
                </div>
                
                <div class="flex items-center">
                  <label class="flex items-center cursor-pointer">
                    <input v-model="newsForm.is_active" type="checkbox" class="sr-only">
                    <div :class="['w-12 h-6 rounded-full transition-colors', newsForm.is_active ? 'bg-green-500' : 'bg-gray-300']">
                      <div :class="['w-5 h-5 bg-white rounded-full shadow transform transition-transform mt-0.5', newsForm.is_active ? 'translate-x-6' : 'translate-x-0.5']"></div>
                    </div>
                    <span class="ml-3 text-sm font-medium text-gray-700">{{ newsForm.is_active ? 'Aktif' : 'Draft' }}</span>
                  </label>
                </div>
              </div>
              
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Konten</label>
                <textarea v-model="newsForm.content" rows="4" required 
                         class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 resize-none"></textarea>
              </div>
              
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Gambar</label>
                <div v-if="!imagePreview" class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center cursor-pointer hover:border-blue-400" @click="$refs.imageInput.click()">
                  <input ref="imageInput" type="file" @change="handleImageChange" accept="image/*" class="hidden">
                  <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                  </svg>
                  <p class="text-sm text-gray-500">Klik untuk upload gambar</p>
                </div>
                <div v-else class="relative">
                  <img :src="imagePreview" alt="Preview" class="w-full h-48 object-cover rounded-lg">
                  <button type="button" @click="imagePreview = null; newsForm.image = null" 
                          class="absolute top-2 right-2 bg-red-500 text-white rounded-full w-8 h-8 flex items-center justify-center hover:bg-red-600">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                  </button>
                </div>
              </div>
              
              <div class="flex gap-3">
                <button type="submit" :disabled="isLoading" 
                        class="flex-1 px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 disabled:opacity-50">
                  {{ isLoading ? 'Menyimpan...' : (editingNews ? 'Update' : 'Simpan') }}
                </button>
                <button type="button" @click="resetNewsForm" 
                        class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200">
                  Batal
                </button>
              </div>
            </form>
          </div>

          <!-- News Grid -->
          <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 mb-6">
            <div v-for="news in paginatedNews" :key="news.id" class="bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-md transition-shadow">
              <div class="aspect-video relative">
                <img v-if="news.image_url" :src="news.image_url" alt="" class="w-full h-full object-cover">
                <div v-else class="w-full h-full bg-gray-200 flex items-center justify-center">
                  <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                  </svg>
                </div>
                
                <div class="absolute top-2 right-2">
                  <span :class="['px-2 py-1 rounded-full text-xs font-medium', news.is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800']">
                    {{ news.is_active ? 'Aktif' : 'Draft' }}
                  </span>
                </div>
                
                <div class="absolute top-2 left-2">
                  <span :class="['px-2 py-1 rounded-full text-xs font-medium', {
                    'bg-blue-100 text-blue-800': news.category === 'info',
                    'bg-red-100 text-red-800': news.category === 'safety',
                    'bg-yellow-100 text-yellow-800': news.category === 'announcement',
                    'bg-green-100 text-green-800': news.category === 'event'
                  }]">
                    {{ categoryLabels[news.category] }}
                  </span>
                </div>
              </div>
              
              <div class="p-4">
                <h3 class="font-semibold text-gray-900 mb-2 line-clamp-2">{{ news.title }}</h3>
                <p class="text-sm text-gray-600 mb-4 line-clamp-3">{{ news.content }}</p>
                
                <div class="flex justify-between text-xs text-gray-500 mb-4">
                  <span>{{ new Date(news.created_at).toLocaleDateString() }}</span>
                </div>
                
                <div class="flex space-x-2">
                  <button @click="editNews(news)" 
                          class="flex-1 px-3 py-2 bg-blue-50 text-blue-700 text-sm rounded-lg hover:bg-blue-100">
                    Edit
                  </button>
                  <button @click="deleteNews(news.id)" 
                          class="flex-1 px-3 py-2 bg-red-50 text-red-700 text-sm rounded-lg hover:bg-red-100">
                    Hapus
                  </button>
                </div>
              </div>
            </div>
          </div>

          <!-- Pagination -->
          <div v-if="totalPages > 1" class="bg-white rounded-xl shadow-sm p-4">
            <div class="flex justify-between items-center">
              <span class="text-sm text-gray-700">
                {{ ((currentPage - 1) * perPage) + 1 }} - {{ Math.min(currentPage * perPage, filteredNews.length) }} dari {{ filteredNews.length }}
              </span>
              <div class="flex space-x-2">
                <button @click="goToPage(currentPage - 1)" :disabled="currentPage === 1"
                        class="px-3 py-1 bg-gray-100 text-gray-700 rounded disabled:opacity-50">
                  Sebelumnya
                </button>
                <button v-for="page in Math.min(5, totalPages)" :key="page" @click="goToPage(page)"
                        :class="['px-3 py-1 rounded', page === currentPage ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700']">
                  {{ page }}
                </button>
                <button @click="goToPage(currentPage + 1)" :disabled="currentPage === totalPages"
                        class="px-3 py-1 bg-gray-100 text-gray-700 rounded disabled:opacity-50">
                  Selanjutnya
                </button>
              </div>
            </div>
          </div>
        </section>

        <!-- Documents Management -->
        <section v-if="activeTab === 'documents'">
          <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-900">Kelola Dokumen</h1>
            <button @click="showDocumentForm = true" class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700">
              <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
              </svg>
              Upload Dokumen
            </button>
          </div>

          <!-- Document Filters -->
          <div class="bg-white rounded-xl shadow-sm p-4 mb-6">
            <div class="flex flex-col lg:flex-row gap-4">
              <div class="flex-1">
                <input v-model="searchQuery" type="text" placeholder="Cari dokumen..." 
                       class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
              </div>
              <select v-model="selectedCategory" class="px-4 py-2 border rounded-lg focus:ring-2 focus:ring-purple-500">
                <option value="all">Semua Kategori</option>
                <option value="general">Umum</option>
                <option value="policy">Kebijakan</option>
                <option value="manual">Manual</option>
                <option value="safety">Keselamatan</option>
              </select>
              <button @click="clearFilters" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200">
                Reset
              </button>
            </div>
          </div>

          <!-- Document Form -->
          <div v-if="showDocumentForm" class="bg-white rounded-xl shadow-lg p-6 mb-6">
            <div class="flex justify-between items-center mb-4">
              <h2 class="text-xl font-semibold">{{ editingDocument ? 'Edit Dokumen' : 'Upload Dokumen' }}</h2>
              <button @click="resetDocumentForm" class="text-gray-400 hover:text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
              </button>
            </div>
            
            <form @submit.prevent="saveDocument" class="space-y-4">
              <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-1">Judul Dokumen *</label>
                  <input v-model="documentForm.title" type="text" required 
                         class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-purple-500">
                </div>
                
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                  <select v-model="documentForm.category" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-purple-500">
                    <option value="general">Umum</option>
                    <option value="policy">Kebijakan</option>
                    <option value="manual">Manual</option>
                    <option value="safety">Keselamatan</option>
                  </select>
                </div>
              </div>
              
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                <textarea v-model="documentForm.description" rows="3" placeholder="Masukkan deskripsi dokumen..."
                         class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-purple-500 resize-none"></textarea>
              </div>
              
              <div v-if="!editingDocument">
                <label class="block text-sm font-medium text-gray-700 mb-1">File Dokumen *</label>
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center cursor-pointer hover:border-purple-400" @click="$refs.fileInput.click()">
                  <input ref="fileInput" type="file" @change="handleFileChange" 
                         accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx" class="hidden">
                  <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                  </svg>
                  <p class="text-sm text-gray-500">Klik untuk upload file</p>
                  <p class="text-xs text-gray-400 mt-1">PDF, DOC, XLS, PPT (Max 10MB)</p>
                  
                  <div v-if="documentForm.file" class="mt-4 inline-flex items-center px-3 py-1 bg-green-100 text-green-800 rounded-lg text-sm">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4"/>
                    </svg>
                    {{ documentForm.file.name }}
                  </div>
                </div>
              </div>
              
              <div v-if="editingDocument" class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                <div class="flex items-start">
                  <svg class="w-5 h-5 text-blue-500 mt-0.5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                  </svg>
                  <div>
                    <p class="text-sm font-medium text-blue-800">Mode Edit</p>
                    <p class="text-sm text-blue-700 mt-1">Anda sedang mengedit dokumen. File tidak perlu diupload ulang kecuali ingin mengganti dengan file baru.</p>
                  </div>
                </div>
              </div>
              
              <div class="flex gap-3">
                <button type="submit" :disabled="isLoading" 
                        class="flex-1 px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 disabled:opacity-50">
                  {{ isLoading ? 'Menyimpan...' : (editingDocument ? 'Update Dokumen' : 'Upload Dokumen') }}
                </button>
                <button type="button" @click="resetDocumentForm" 
                        class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200">
                  Batal
                </button>
              </div>
            </form>
          </div>

          <!-- Documents Grid -->
          <div v-if="filteredDocuments.length > 0" class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 mb-6">
            <div v-for="doc in paginatedDocuments" :key="doc.id" class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition-shadow">
              <div class="flex items-start mb-4">
                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                  <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                  </svg>
                </div>
                <div class="flex-1 min-w-0">
                  <h3 class="font-semibold text-gray-900 mb-1 line-clamp-2">{{ doc.title || doc.name || 'Untitled' }}</h3>
                  
                  <div class="mb-2">
                    <span :class="['px-2 py-1 rounded-full text-xs font-medium', getCategoryBadgeClass(doc.category || 'general')]">
                      {{ categoryLabels[doc.category || 'general'] }}
                    </span>
                  </div>
                  
                  <p v-if="doc.description && doc.description.trim()" class="text-sm text-gray-600 mb-2 line-clamp-2">{{ doc.description }}</p>
                  <p v-else class="text-sm text-gray-500 italic mb-2">Tidak ada deskripsi</p>
                </div>
              </div>
              
              <div class="flex items-center justify-between text-xs text-gray-500 mb-4 bg-gray-50 rounded p-2">
                <span class="bg-purple-100 text-purple-700 px-2 py-1 rounded font-medium">
                  {{ getFileExtension(doc.filename || doc.name) }}
                </span>
                <span>{{ formatFileSize(doc.size || doc.file_size) }}</span>
              </div>
              
              <div class="flex space-x-2">
                <button @click="editDocument(doc)" 
                        class="flex-1 px-3 py-2 bg-blue-50 text-blue-700 text-sm rounded-lg hover:bg-blue-100">
                  Edit
                </button>
                <button @click="deleteDocument(doc.id)" 
                        class="flex-1 px-3 py-2 bg-red-50 text-red-700 text-sm rounded-lg hover:bg-red-100">
                  Hapus
                </button>
                <a :href="`/download/${doc.id}`" target="_blank"
                   class="flex-1 px-3 py-2 bg-green-50 text-green-700 text-sm rounded-lg hover:bg-green-100 text-center">
                  Download
                </a>
              </div>
            </div>
          </div>
          
          <div v-else class="bg-white rounded-xl shadow-sm p-12 text-center">
            <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            <h3 class="text-lg font-medium text-gray-900 mb-2">{{ selectedCategory === 'all' ? 'Belum ada dokumen' : 'Tidak ada dokumen untuk kategori ini' }}</h3>
            <p class="text-gray-600 mb-4">{{ selectedCategory === 'all' ? 'Upload dokumen pertama untuk memulai' : 'Coba kategori lain atau upload dokumen baru' }}</p>
            <button @click="showDocumentForm = true" class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700">
              Upload Dokumen
            </button>
          </div>

          <!-- Document Pagination -->
          <div v-if="totalPages > 1" class="bg-white rounded-xl shadow-sm p-4">
            <div class="flex justify-between items-center">
              <span class="text-sm text-gray-700">
                {{ ((currentPage - 1) * perPage) + 1 }} - {{ Math.min(currentPage * perPage, filteredDocuments.length) }} dari {{ filteredDocuments.length }}
              </span>
              <div class="flex space-x-2">
                <button @click="goToPage(currentPage - 1)" :disabled="currentPage === 1"
                        class="px-3 py-1 bg-gray-100 text-gray-700 rounded disabled:opacity-50">
                  Sebelumnya
                </button>
                <button v-for="page in Math.min(5, totalPages)" :key="page" @click="goToPage(page)"
                        :class="['px-3 py-1 rounded', page === currentPage ? 'bg-purple-600 text-white' : 'bg-gray-100 text-gray-700']">
                  {{ page }}
                </button>
                <button @click="goToPage(currentPage + 1)" :disabled="currentPage === totalPages"
                        class="px-3 py-1 bg-gray-100 text-gray-700 rounded disabled:opacity-50">
                  Selanjutnya
                </button>
              </div>
            </div>
          </div>
        </section>
      </div>
    </main>

    <!-- Notifications -->
    <div class="fixed top-4 right-4 z-50 space-y-2 max-w-sm">
      <div v-for="notification in notifications" :key="notification.id" 
           class="bg-white rounded-lg shadow-lg border p-4 transform transition-all">
        <div class="flex items-start space-x-3">
          <div :class="['w-6 h-6 rounded-full flex items-center justify-center', {
            'bg-green-100': notification.type === 'success',
            'bg-red-100': notification.type === 'error',
            'bg-blue-100': notification.type === 'info',
            'bg-yellow-100': notification.type === 'warning'
          }]">
            <svg class="w-4 h-4" :class="{
              'text-green-600': notification.type === 'success',
              'text-red-600': notification.type === 'error',
              'text-blue-600': notification.type === 'info',
              'text-yellow-600': notification.type === 'warning'
            }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path v-if="notification.type === 'success'" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
              <path v-else-if="notification.type === 'error'" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
              <path v-else stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
          </div>
          
          <div class="flex-1 min-w-0">
            <p class="text-sm font-medium text-gray-900">{{ notification.message }}</p>
          </div>
          
          <button @click="removeNotification(notification.id)" class="text-gray-400 hover:text-gray-600">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, watch, computed, onMounted } from 'vue';
import { router, usePage } from '@inertiajs/vue3';

// Props
const props = defineProps({
  newsItems: Array,
  documents: Array,
  flash: Object
});

// State
const activeTab = ref('dashboard');
const showForm = ref(false);
const showDocumentForm = ref(false);
const editingNews = ref(null);
const editingDocument = ref(null);
const isLoading = ref(false);
const showSidebar = ref(false);

// Forms
const newsForm = ref({
  title: '', content: '', category: 'info', is_active: true, image: null
});

const documentForm = ref({
  title: '', description: '', category: 'general', file: null
});

// UI State
const imagePreview = ref(null);
const notifications = ref([]);
const currentPage = ref(1);
const searchQuery = ref('');
const selectedCategory = ref('all');
const perPage = 6;

// Flash handling
const page = usePage();
watch(() => page.props.flash, (newFlash) => {
  if (newFlash?.success) showNotification('success', newFlash.success);
  if (newFlash?.error) showNotification('error', newFlash.error);
});

// Notifications
function showNotification(type, message, duration = 5000) {
  const id = Date.now() + Math.random();
  notifications.value.push({ id, type, message, timestamp: new Date() });
  setTimeout(() => removeNotification(id), duration);
}

function removeNotification(id) {
  notifications.value = notifications.value.filter(n => n.id !== id);
}

// Dashboard stats
const dashboardStats = computed(() => {
  const newsTotal = props.newsItems.length;
  const newsActive = props.newsItems.filter(n => n.is_active).length;
  const docsTotal = props.documents?.length || 0;
  
  return {
    newsTotal, newsActive, docsTotal,
    newsInactive: newsTotal - newsActive,
    categories: {
      info: props.newsItems.filter(n => n.category === 'info').length,
      safety: props.newsItems.filter(n => n.category === 'safety').length,
      announcement: props.newsItems.filter(n => n.category === 'announcement').length,
      event: props.newsItems.filter(n => n.category === 'event').length
    }
  };
});

// Filtered data
const filteredNews = computed(() => {
  let filtered = [...props.newsItems];
  if (searchQuery.value) {
    const term = searchQuery.value.toLowerCase();
    filtered = filtered.filter(item => 
      item.title.toLowerCase().includes(term) || 
      item.content.toLowerCase().includes(term)
    );
  }
  if (selectedCategory.value !== 'all') {
    filtered = filtered.filter(item => item.category === selectedCategory.value);
  }
  return filtered;
});

const filteredDocuments = computed(() => {
  let filtered = [...(props.documents || [])];
  if (searchQuery.value) {
    const term = searchQuery.value.toLowerCase();
    filtered = filtered.filter(doc => 
      (doc.title || doc.name || '').toLowerCase().includes(term) || 
      (doc.description || '').toLowerCase().includes(term)
    );
  }
  if (selectedCategory.value !== 'all') {
    filtered = filtered.filter(doc => (doc.category || 'general') === selectedCategory.value);
  }
  return filtered;
});

const paginatedNews = computed(() => {
  const start = (currentPage.value - 1) * perPage;
  return filteredNews.value.slice(start, start + perPage);
});

const paginatedDocuments = computed(() => {
  const start = (currentPage.value - 1) * perPage;
  return filteredDocuments.value.slice(start, start + perPage);
});

const totalPages = computed(() => {
  const items = activeTab.value === 'news' ? filteredNews.value : filteredDocuments.value;
  return Math.ceil(items.length / perPage);
});

// News CRUD
function handleImageChange(event) {
  const file = event.target.files[0];
  if (!file) return;
  
  if (!['image/jpeg', 'image/png', 'image/jpg', 'image/gif'].includes(file.type)) {
    showNotification('error', 'Format tidak didukung! Gunakan JPG, PNG, atau GIF');
    return;
  }
  if (file.size > 5 * 1024 * 1024) {
    showNotification('error', 'Ukuran maksimal 5MB!');
    return;
  }
  
  newsForm.value.image = file;
  const reader = new FileReader();
  reader.onload = (e) => { imagePreview.value = e.target.result; };
  reader.readAsDataURL(file);
  showNotification('success', 'Gambar dipilih');
}

function saveNews() {
  if (!newsForm.value.title.trim() || !newsForm.value.content.trim()) {
    showNotification('error', 'Judul dan konten wajib diisi!');
    return;
  }
  
  isLoading.value = true;
  const formData = new FormData();
  formData.append('title', newsForm.value.title);
  formData.append('content', newsForm.value.content);
  formData.append('category', newsForm.value.category);
  formData.append('is_active', newsForm.value.is_active ? '1' : '0');
  if (newsForm.value.image) formData.append('image', newsForm.value.image);
  
  const url = editingNews.value ? route('news.update', editingNews.value.id) : route('news.store');
  if (editingNews.value) formData.append('_method', 'PUT');
  
  router.post(url, formData, {
    forceFormData: true,
    onFinish: () => { isLoading.value = false; },
    onSuccess: () => {
      resetNewsForm();
      showNotification('success', editingNews.value ? 'Artikel diperbarui!' : 'Artikel dibuat!');
    },
    onError: () => showNotification('error', 'Gagal menyimpan artikel!')
  });
}

function editNews(news) {
  editingNews.value = news;
  newsForm.value = {
    title: news.title, content: news.content, 
    category: news.category, is_active: news.is_active, image: null
  };
  imagePreview.value = news.image_url || null;
  showForm.value = true;
}

function deleteNews(id) {
  if (confirm('Yakin hapus artikel ini?')) {
    router.delete(route('news.destroy', id), {
      onSuccess: () => showNotification('success', 'Artikel dihapus!'),
      onError: () => showNotification('error', 'Gagal menghapus!')
    });
  }
}

function resetNewsForm() {
  newsForm.value = { title: '', content: '', category: 'info', is_active: true, image: null };
  imagePreview.value = null;
  editingNews.value = null;
  showForm.value = false;
}

// Document CRUD
function handleFileChange(event) {
  const file = event.target.files[0];
  if (!file) return;
  
  const allowedTypes = [
    'application/pdf', 'application/msword', 
    'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
    'application/vnd.ms-excel', 
    'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
    'application/vnd.ms-powerpoint',
    'application/vnd.openxmlformats-officedocument.presentationml.presentation'
  ];
  
  if (!allowedTypes.includes(file.type)) {
    showNotification('error', 'Format tidak didukung! Gunakan PDF, DOC, XLS, atau PPT');
    return;
  }
  if (file.size > 10 * 1024 * 1024) {
    showNotification('error', 'Ukuran maksimal 10MB!');
    return;
  }
  
  documentForm.value.file = file;
  showNotification('success', `File ${file.name} dipilih`);
}

function saveDocument() {
  console.log('Saving document...', {
    editing: editingDocument.value,
    form: documentForm.value
  });
  
  if (!documentForm.value.title.trim()) {
    showNotification('error', 'Judul dokumen wajib diisi!');
    return;
  }
  if (!editingDocument.value && !documentForm.value.file) {
    showNotification('error', 'File wajib dipilih untuk dokumen baru!');
    return;
  }

  isLoading.value = true;
  const formData = new FormData();
  
  // Pastikan data terkirim dengan benar
  formData.append('title', documentForm.value.title.trim());
  formData.append('description', documentForm.value.description || '');
  formData.append('category', documentForm.value.category || 'general');
  
  // Untuk edit, tambahkan ID
  if (editingDocument.value) {
    formData.append('id', editingDocument.value.id);
  }
  
  if (documentForm.value.file) {
    formData.append('file', documentForm.value.file);
  }

  const url = editingDocument.value 
    ? route('files.update', editingDocument.value.id) 
    : route('files.store');
  
  if (editingDocument.value) {
    formData.append('_method', 'PUT');
  }

  // Debug log
  console.log('Request details:', {
    url,
    editing: !!editingDocument.value,
    id: editingDocument.value?.id
  });

  router.post(url, formData, {
    forceFormData: true,
    onFinish: () => { 
      isLoading.value = false; 
      console.log('Request finished');
    },
    onSuccess: (response) => {
      console.log('Success response:', response);
      resetDocumentForm();
      showNotification('success', editingDocument.value ? 'Dokumen berhasil diperbarui!' : 'Dokumen berhasil diupload!');
      
      // Refresh data setelah sukses
      router.reload({ only: ['documents'] });
    },
    onError: (errors) => {
      console.error('Save document errors:', errors);
      const errorMessage = errors.message || Object.values(errors).flat().join(', ') || 'Terjadi kesalahan';
      showNotification('error', 'Gagal menyimpan dokumen! ' + errorMessage);
    }
  });
}

function editDocument(doc) {
  editingDocument.value = doc;
  documentForm.value = {
    title: doc.title || doc.name || '',
    description: doc.description || '',
    category: doc.category || 'general',
    file: null
  };
  showDocumentForm.value = true;
}

function deleteDocument(id) {
  if (confirm('Yakin hapus dokumen ini?')) {
    router.delete(route('files.destroy', id), {
      onSuccess: () => showNotification('success', 'Dokumen dihapus!'),
      onError: () => showNotification('error', 'Gagal menghapus!')
    });
  }
}

function resetDocumentForm() {
  documentForm.value = { title: '', description: '', category: 'general', file: null };
  editingDocument.value = null;
  showDocumentForm.value = false;
}

// Utilities
function goToPage(page) {
  if (page >= 1 && page <= totalPages.value) currentPage.value = page;
}

function clearFilters() {
  searchQuery.value = '';
  selectedCategory.value = 'all';
  currentPage.value = 1;
  showNotification('success', 'Filter dibersihkan!');
}

function logout() {
  if (confirm('Yakin logout?')) router.post(route('logout'));
}

// Category labels
const categoryLabels = {
  // News categories
  info: 'Informasi', 
  safety: 'Keselamatan', 
  announcement: 'Pengumuman', 
  event: 'Event',
  // Document categories
  general: 'Umum', 
  policy: 'Kebijakan', 
  manual: 'Manual'
};

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

function getCategoryBadgeClass(category) {
  const classes = {
    general: 'bg-gray-100 text-gray-800',
    policy: 'bg-blue-100 text-blue-800',
    manual: 'bg-green-100 text-green-800',
    safety: 'bg-red-100 text-red-800'
  };
  return classes[category] || 'bg-gray-100 text-gray-800';
}

// Watch for tab changes to reset filters
watch(activeTab, () => {
  currentPage.value = 1;
});
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
</style>