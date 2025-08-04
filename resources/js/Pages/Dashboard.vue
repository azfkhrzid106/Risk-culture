<script setup>
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';

// Props dari Controller
const props = defineProps({
  newsItems: Array,
  breakingNews: Object
});

// State
const activeTab = ref('news'); // Set default ke news untuk testing
const showForm = ref(false);
const editingNews = ref(null);
const form = ref({
  title: '',
  content: '',
  category: 'info',
  is_active: true,
  image: null
});

// Image preview
const imagePreview = ref(null);

// Breaking News Form
const breakingForm = ref({
  title: props.breakingNews?.title || '',
  isActive: props.breakingNews?.isActive || false
});

// Handle file selection
function handleImageChange(event) {
  const file = event.target.files[0];
  console.log('File selected:', file); // Debug log
  
  if (file) {
    // Validate file type
    const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
    if (!allowedTypes.includes(file.type)) {
      alert('Format file tidak didukung. Gunakan JPG, PNG, atau GIF.');
      event.target.value = '';
      return;
    }
    
    // Validate file size (10MB)
    if (file.size > 10 * 1024 * 1024) {
      alert('Ukuran file terlalu besar. Maksimal 10MB.');
      event.target.value = '';
      return;
    }
    
    form.value.image = file;
    
    // Create preview
    const reader = new FileReader();
    reader.onload = (e) => {
      imagePreview.value = e.target.result;
      console.log('Preview created'); // Debug log
    };
    reader.readAsDataURL(file);
  }
}

// Remove image
function removeImage() {
  form.value.image = null;
  imagePreview.value = null;
  // Reset file input
  const fileInput = document.querySelector('input[type="file"]');
  if (fileInput) fileInput.value = '';
}

// ✅ Tambah / Update Berita
function saveNews() {
  console.log('Saving news...', form.value); // Debug log
  
  // Create FormData for file upload
  const formData = new FormData();
  formData.append('title', form.value.title);
  formData.append('content', form.value.content);
  formData.append('category', form.value.category);
  formData.append('is_active', form.value.is_active ? '1' : '0');
  
  if (form.value.image) {
    formData.append('image', form.value.image);
    console.log('Image attached to form data'); // Debug log
  }

  // Debug: Log form data contents
  for (let pair of formData.entries()) {
    console.log(pair[0] + ': ' + pair[1]);
  }

  if (editingNews.value) {
    // For PUT request with file, we need to use POST with _method
    formData.append('_method', 'PUT');
    router.post(route('news.update', editingNews.value.id), formData, {
      forceFormData: true,
      onSuccess: () => {
        resetForm();
        alert('Berita berhasil diperbarui!');
      },
      onError: (errors) => {
        console.error('Update errors:', errors);
        alert('Error: ' + JSON.stringify(errors));
      }
    });
  } else {
    router.post(route('news.store'), formData, {
      forceFormData: true,
      onSuccess: () => {
        resetForm();
        alert('Berita berhasil ditambahkan!');
      },
      onError: (errors) => {
        console.error('Store errors:', errors);
        alert('Error: ' + JSON.stringify(errors));
      }
    });
  }
}

// ✅ Hapus Berita
function deleteNews(id) {
  if (confirm('Yakin ingin menghapus berita ini?')) {
    router.delete(route('news.destroy', id), {
      onSuccess: () => alert('Berita berhasil dihapus!')
    });
  }
}

// ✅ Edit Berita
function editNews(news) {
  editingNews.value = news;
  form.value = { 
    title: news.title,
    content: news.content,
    category: news.category,
    is_active: news.is_active,
    image: null
  };
  
  // Set preview if news has image
  if (news.image_url) {
    imagePreview.value = news.image_url;
  }
  
  showForm.value = true;
}

// ✅ Reset Form
function resetForm() {
  form.value = { 
    title: '', 
    content: '', 
    category: 'info', 
    is_active: true,
    image: null
  };
  imagePreview.value = null;
  editingNews.value = null;
  showForm.value = false;
  
  // Reset file input
  const fileInput = document.querySelector('input[type="file"]');
  if (fileInput) fileInput.value = '';
}

// ✅ Update Breaking News
function saveBreakingNews() {
  router.post(route('breaking.update'), breakingForm.value, {
    onSuccess: () => alert('Breaking news diperbarui!')
  });
}

// ✅ Logout
function logout() {
  if (confirm('Yakin ingin logout?')) {
    router.post(route('logout'));
  }
}
</script>

<template>
  <div class="flex flex-col md:flex-row min-h-screen bg-gray-100">
    <!-- Sidebar -->
    <aside class="w-full md:w-64 bg-blue-700 text-white flex flex-col">
      <div class="p-4 text-center border-b border-blue-600">
        <h2 class="text-xl font-bold">K3-INALUM</h2>
        <p class="text-sm">Admin Panel</p>
      </div>
      <nav class="flex-1 p-4 space-y-2">
        <button @click="activeTab = 'dashboard'" :class="activeTab === 'dashboard' ? 'bg-blue-600' : ''" class="w-full text-left p-3 rounded hover:bg-blue-600 transition-colors">Dashboard</button>
        <button @click="activeTab = 'news'" :class="activeTab === 'news' ? 'bg-blue-600' : ''" class="w-full text-left p-3 rounded hover:bg-blue-600 transition-colors">Kelola Berita</button>
        <button @click="activeTab = 'breaking'" :class="activeTab === 'breaking' ? 'bg-blue-600' : ''" class="w-full text-left p-3 rounded hover:bg-blue-600 transition-colors">Breaking News</button>
      </nav>
      <div class="p-4 border-t border-blue-600">
        <button @click="logout" class="bg-red-600 hover:bg-red-700 w-full py-2 rounded transition-colors">Logout</button>
      </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-6">
      <!-- Dashboard -->
      <section v-if="activeTab === 'dashboard'" class="space-y-6">
        <h1 class="text-3xl font-bold mb-4">Dashboard</h1>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
          <div class="bg-white p-6 rounded-lg shadow-md text-center">
            <h3 class="text-gray-600">Total Berita</h3>
            <p class="text-3xl font-bold text-blue-600">{{ props.newsItems.length }}</p>
          </div>
          <div class="bg-white p-6 rounded-lg shadow-md text-center">
            <h3 class="text-gray-600">Berita Aktif</h3>
            <p class="text-3xl font-bold text-green-600">{{ props.newsItems.filter(n => n.is_active).length }}</p>
          </div>
          <div class="bg-white p-6 rounded-lg shadow-md text-center">
            <h3 class="text-gray-600">Breaking News</h3>
            <p class="text-3xl font-bold text-red-600">{{ props.breakingNews?.title ? '1' : '0' }}</p>
          </div>
        </div>
      </section>

      <!-- Kelola Berita -->
      <section v-if="activeTab === 'news'" class="space-y-6">
        <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
          <h1 class="text-2xl font-bold">Kelola Berita</h1>
          <button @click="showForm = true" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors">+ Tambah Berita</button>
        </div>

        <!-- Form -->
        <div v-if="showForm" class="bg-white p-6 rounded-lg shadow-md">
          <h2 class="text-xl font-semibold mb-4">{{ editingNews ? 'Edit Berita' : 'Tambah Berita' }}</h2>
          <form @submit.prevent="saveNews" class="space-y-4">
            <!-- Title -->
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Judul Berita</label>
              <input v-model="form.title" type="text" placeholder="Masukkan judul berita" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
            </div>

            <!-- Content -->
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Konten Berita</label>
              <textarea v-model="form.content" placeholder="Masukkan konten berita" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" rows="5" required></textarea>
            </div>

            <!-- Category -->
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
              <select v-model="form.category" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <option value="info">Informasi</option>
                <option value="safety">Keselamatan</option>
                <option value="announcement">Pengumuman</option>
                <option value="event">Event</option>
              </select>
            </div>

            <!-- Image Upload -->
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Gambar Berita</label>
              <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-gray-400 transition-colors">
                <div class="space-y-1 text-center w-full">
                  <div v-if="!imagePreview">
                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                      <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <div class="flex text-sm text-gray-600 justify-center">
                      <label class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                        <span>Upload gambar</span>
                        <input @change="handleImageChange" type="file" accept="image/*" class="sr-only">
                      </label>
                      <p class="pl-1">atau drag and drop</p>
                    </div>
                    <p class="text-xs text-gray-500">PNG, JPG, JPEG, GIF up to 10MB</p>
                  </div>
                  
                  <!-- Image Preview -->
                  <div v-else class="relative">
                    <img :src="imagePreview" alt="Preview" class="mx-auto h-32 w-32 object-cover rounded-lg">
                    <button type="button" @click="removeImage" class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs hover:bg-red-600">
                      ×
                    </button>
                    <div class="mt-2">
                      <label class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500">
                        <span>Ganti gambar</span>
                        <input @change="handleImageChange" type="file" accept="image/*" class="sr-only">
                      </label>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Active Status -->
            <div class="flex items-center">
              <input v-model="form.is_active" type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
              <label class="ml-2 block text-sm text-gray-900">Aktifkan Berita</label>
            </div>

            <!-- Buttons -->
            <div class="flex flex-col md:flex-row gap-3 pt-4">
              <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg transition-colors">
                {{ editingNews ? 'Update Berita' : 'Simpan Berita' }}
              </button>
              <button type="button" @click="resetForm" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg transition-colors">
                Batal
              </button>
            </div>
          </form>
        </div>

        <!-- List -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
          <div class="overflow-x-auto">
            <table class="w-full text-sm">
              <thead class="bg-gray-50">
                <tr>
                  <th class="p-4 text-left font-medium text-gray-500 uppercase tracking-wider">Gambar</th>
                  <th class="p-4 text-left font-medium text-gray-500 uppercase tracking-wider">Judul</th>
                  <th class="p-4 text-left font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                  <th class="p-4 text-left font-medium text-gray-500 uppercase tracking-wider">Status</th>
                  <th class="p-4 text-left font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                <tr v-for="news in props.newsItems" :key="news.id" class="hover:bg-gray-50">
                  <td class="p-4">
                    <div v-if="news.image_url" class="w-16 h-16">
                      <img :src="news.image_url" :alt="news.title" class="w-full h-full object-cover rounded-lg">
                    </div>
                    <div v-else class="w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center">
                      <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                      </svg>
                    </div>
                  </td>
                  <td class="p-4">
                    <div class="text-sm font-medium text-gray-900">{{ news.title }}</div>
                    <div class="text-sm text-gray-500">{{ news.content.substring(0, 100) }}...</div>
                  </td>
                  <td class="p-4">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium capitalize"
                          :class="{
                            'bg-blue-100 text-blue-800': news.category === 'info',
                            'bg-red-100 text-red-800': news.category === 'safety',
                            'bg-yellow-100 text-yellow-800': news.category === 'announcement',
                            'bg-green-100 text-green-800': news.category === 'event'
                          }">
                      {{ news.category }}
                    </span>
                  </td>
                  <td class="p-4">
                    <span :class="news.is_active ? 'text-green-600 bg-green-100' : 'text-red-600 bg-red-100'" 
                          class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium">
                      {{ news.is_active ? 'Aktif' : 'Nonaktif' }}
                    </span>
                  </td>
                  <td class="p-4">
                    <div class="flex space-x-2">
                      <button @click="editNews(news)" class="text-blue-600 hover:text-blue-800 font-medium">Edit</button>
                      <button @click="deleteNews(news.id)" class="text-red-600 hover:text-red-800 font-medium">Hapus</button>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </section>

      <!-- Breaking News -->
      <section v-if="activeTab === 'breaking'" class="space-y-4">
        <h1 class="text-2xl font-bold">Breaking News</h1>
        <form @submit.prevent="saveBreakingNews" class="bg-white p-6 rounded-lg shadow-md space-y-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Judul Breaking News</label>
            <input v-model="breakingForm.title" type="text" placeholder="Masukkan judul breaking news" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
          </div>
          <div class="flex items-center">
            <input v-model="breakingForm.isActive" type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
            <label class="ml-2 block text-sm text-gray-900">Tampilkan Breaking News</label>
          </div>
          <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition-colors">Update Breaking News</button>
        </form>
      </section>
    </main>
  </div>
</template>