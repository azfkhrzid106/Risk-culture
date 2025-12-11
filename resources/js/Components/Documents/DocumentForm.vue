<!-- resources/js/Components/Documents/DocumentForm.vue -->
<template>
  <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
    <div class="flex justify-between items-center mb-4">
      <h2 class="text-xl font-semibold">{{ editingDocument ? 'Edit Dokumen' : 'Upload Dokumen' }}</h2>
      <button @click="$emit('cancel')" class="text-gray-400 hover:text-gray-600">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
        </svg>
      </button>
    </div>
    
    <form @submit.prevent="handleSubmit" class="space-y-4">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Judul Dokumen *</label>
          <input 
            v-model="form.title" 
            type="text" 
            required 
            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-purple-500"
          >
        </div>
        
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
          <select v-model="form.category" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-purple-500">
            <option value="general">Umum</option>
            <option value="policy">Kebijakan</option>
            <option value="manual">Manual</option>
            <option value="safety">Keselamatan</option>
          </select>
        </div>
      </div>
      
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
        <textarea 
          v-model="form.description" 
          rows="3" 
          placeholder="Masukkan deskripsi dokumen..."
          class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-purple-500 resize-none"
        ></textarea>
      </div>
      
      <div v-if="!editingDocument">
        <label class="block text-sm font-medium text-gray-700 mb-1">File Dokumen *</label>
        <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center cursor-pointer hover:border-purple-400" @click="$refs.fileInput.click()">
          <input 
            ref="fileInput" 
            type="file" 
            @change="handleFileChange" 
            accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.csv,.txt,.zip,.rar,.7z,.jpg,.jpeg,.png,.gif,.webp" 
            class="hidden"
          >
          <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
          </svg>
          <p class="text-sm text-gray-500">Klik untuk upload file</p>
          <p class="text-xs text-gray-400 mt-1">PDF, Word, Excel, PowerPoint, Gambar, ZIP (Max 10MB)</p>
          
          <div v-if="form.file" class="mt-4 inline-flex items-center px-3 py-1 bg-green-100 text-green-800 rounded-lg text-sm">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4"/>
            </svg>
            {{ form.file.name }} ({{ formatFileSize(form.file.size) }})
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
  editingDocument: Object,
  isLoading: { type: Boolean, default: false }
});

const emit = defineEmits(['save', 'cancel', 'showNotification']);

// Form state
const form = reactive({
  title: '',
  description: '',
  category: 'general',
  file: null
});

// Watch for editing document changes
watch(() => props.editingDocument, (doc) => {
  if (doc) {
    form.title = doc.title || doc.name || '';
    form.description = doc.description || '';
    form.category = doc.category || 'general';
    form.file = null;
  } else {
    resetForm();
  }
}, { immediate: true });

function handleFileChange(event) {
  const file = event.target.files[0];
  if (!file) return;
  
  // ✅ DAFTAR MIME TYPE LENGKAP
  const allowedTypes = [
    // PDF
    'application/pdf',
    
    // Microsoft Word
    'application/msword', // .doc
    'application/vnd.openxmlformats-officedocument.wordprocessingml.document', // .docx
    
    // Microsoft Excel
    'application/vnd.ms-excel', // .xls
    'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', // .xlsx
    
    // Microsoft PowerPoint
    'application/vnd.ms-powerpoint', // .ppt
    'application/vnd.openxmlformats-officedocument.presentationml.presentation', // .pptx
    
    // Archive
    'application/zip',
    'application/x-rar-compressed',
    'application/x-7z-compressed',
    
    // Images
    'image/jpeg',
    'image/jpg', 
    'image/png',
    'image/gif',
    'image/webp',
    
    // Text
    'text/plain',
    'text/csv'
  ];
  
  // ✅ VALIDASI DENGAN EXTENSION SEBAGAI FALLBACK
  const fileName = file.name.toLowerCase();
  const allowedExtensions = [
    '.pdf', '.doc', '.docx', '.xls', '.xlsx', 
    '.ppt', '.pptx', '.zip', '.rar', '.7z',
    '.jpg', '.jpeg', '.png', '.gif', '.webp',
    '.txt', '.csv'
  ];
  
  const hasValidExtension = allowedExtensions.some(ext => fileName.endsWith(ext));
  const hasValidMimeType = allowedTypes.includes(file.type);
  
  if (!hasValidMimeType && !hasValidExtension) {
    emit('showNotification', 'error', 'Format file tidak didukung! Gunakan PDF, DOC, XLS, PPT, ZIP, atau gambar');
    event.target.value = ''; // Reset input
    return;
  }
  
  // ✅ VALIDASI UKURAN FILE (10MB)
  const maxSize = 10 * 1024 * 1024; // 10MB dalam bytes
  if (file.size > maxSize) {
    emit('showNotification', 'error', `Ukuran file terlalu besar! Maksimal 10MB (File Anda: ${formatFileSize(file.size)})`);
    event.target.value = ''; // Reset input
    return;
  }
  
  form.file = file;
  emit('showNotification', 'success', `File ${file.name} berhasil dipilih (${formatFileSize(file.size)})`);
}

function formatFileSize(bytes) {
  if (bytes === 0) return '0 Bytes';
  
  const k = 1024;
  const sizes = ['Bytes', 'KB', 'MB', 'GB'];
  const i = Math.floor(Math.log(bytes) / Math.log(k));
  
  return Math.round((bytes / Math.pow(k, i)) * 100) / 100 + ' ' + sizes[i];
}

function handleSubmit() {
  if (!form.title.trim()) {
    emit('showNotification', 'error', 'Judul dokumen wajib diisi!');
    return;
  }
  if (!props.editingDocument && !form.file) {
    emit('showNotification', 'error', 'File wajib dipilih untuk dokumen baru!');
    return;
  }

  const formData = new FormData();
  formData.append('title', form.title.trim());
  formData.append('description', form.description || '');
  formData.append('category', form.category || 'general');
  
  if (props.editingDocument) {
    formData.append('id', props.editingDocument.id);
  }
  
  if (form.file) {
    formData.append('file', form.file);
  }

  emit('save', formData);
}

function resetForm() {
  form.title = '';
  form.description = '';
  form.category = 'general';
  form.file = null;
}
</script>