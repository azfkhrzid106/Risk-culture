<!-- resources/js/Components/News/NewsForm.vue -->
<template>
  <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
    <div class="flex justify-between items-center mb-4">
      <h2 class="text-xl font-semibold">{{ editingNews ? 'Edit Berita' : 'Tambah Berita' }}</h2>
      <button @click="$emit('cancel')" class="text-gray-400 hover:text-gray-600">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
        </svg>
      </button>
    </div>
    
    <form @submit.prevent="handleSubmit" class="space-y-4">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
        <div class="lg:col-span-2">
          <label class="block text-sm font-medium text-gray-700 mb-1">Judul</label>
          <input 
            v-model="form.title" 
            type="text" 
            required 
            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500"
          >
        </div>
        
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
          <select v-model="form.category" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
            <option value="info">Informasi</option>
            <option value="safety">Keselamatan</option>
            <option value="announcement">Pengumuman</option>
            <option value="event">Event</option>
          </select>
        </div>
        
        <div class="flex items-center">
          <label class="flex items-center cursor-pointer">
            <input v-model="form.is_active" type="checkbox" class="sr-only">
            <div :class="['w-12 h-6 rounded-full transition-colors', form.is_active ? 'bg-green-500' : 'bg-gray-300']">
              <div :class="['w-5 h-5 bg-white rounded-full shadow transform transition-transform mt-0.5', form.is_active ? 'translate-x-6' : 'translate-x-0.5']"></div>
            </div>
            <span class="ml-3 text-sm font-medium text-gray-700">{{ form.is_active ? 'Aktif' : 'Draft' }}</span>
          </label>
        </div>
      </div>
      
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Konten</label>
        <textarea 
          v-model="form.content" 
          rows="4" 
          required 
          class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 resize-none"
        ></textarea>
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
          <button type="button" @click="removeImage" 
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
        <button type="button" @click="$emit('cancel')" 
                class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200">
          Batal
        </button>
      </div>
    </form>
  </div>
</template>

<script setup>
import { ref, reactive, watch } from 'vue';

const props = defineProps({
  editingNews: Object,
  isLoading: { type: Boolean, default: false }
});

const emit = defineEmits(['save', 'cancel', 'showNotification']);

// Form state
const form = reactive({
  title: '',
  content: '',
  category: 'info',
  is_active: true,
  image: null
});

const imagePreview = ref(null);

// Watch for editing news changes
watch(() => props.editingNews, (news) => {
  if (news) {
    form.title = news.title;
    form.content = news.content;
    form.category = news.category;
    form.is_active = news.is_active;
    form.image = null;
    imagePreview.value = news.image_url || null;
  } else {
    resetForm();
  }
}, { immediate: true });

function handleImageChange(event) {
  const file = event.target.files[0];
  if (!file) return;
  
  if (!['image/jpeg', 'image/png', 'image/jpg', 'image/gif'].includes(file.type)) {
    emit('showNotification', 'error', 'Format tidak didukung! Gunakan JPG, PNG, atau GIF');
    return;
  }
  if (file.size > 5 * 1024 * 1024) {
    emit('showNotification', 'error', 'Ukuran maksimal 5MB!');
    return;
  }
  
  form.image = file;
  const reader = new FileReader();
  reader.onload = (e) => { imagePreview.value = e.target.result; };
  reader.readAsDataURL(file);
}

function removeImage() {
  imagePreview.value = null;
  form.image = null;
}

function handleSubmit() {
  if (!form.title.trim() || !form.content.trim()) {
    emit('showNotification', 'error', 'Judul dan konten wajib diisi!');
    return;
  }
  
  const formData = new FormData();
  formData.append('title', form.title);
  formData.append('content', form.content);
  formData.append('category', form.category);
  formData.append('is_active', form.is_active ? '1' : '0');
  if (form.image) formData.append('image', form.image);
  
  emit('save', formData);
}

function resetForm() {
  form.title = '';
  form.content = '';
  form.category = 'info';
  form.is_active = true;
  form.image = null;
  imagePreview.value = null;
}
</script>