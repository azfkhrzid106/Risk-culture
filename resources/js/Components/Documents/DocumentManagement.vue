<!-- resources/js/Components/Documents/DocumentManagement.vue -->
<template>
  <section>
    <div class="flex justify-between items-center mb-6">
      <h1 class="text-3xl font-bold text-gray-900">Kelola Dokumen</h1>
      <button @click="handleShowForm" class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors">
        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
        </svg>
        Upload Dokumen
      </button>
    </div>

    <!-- Document Filters -->
    <DocumentFilters 
      v-model:searchQuery="searchQuery"
      v-model:selectedCategory="selectedCategory"
      @clear="clearFilters"
      @filter-applied="handleFilterApplied"
    />

    <!-- Document Form -->
    <DocumentForm 
      v-if="showForm"
      :editing-document="editingDocument"
      :is-loading="isLoading"
      @save="saveDocument"
      @cancel="handleCancelForm"
      @form-reset="handleFormReset"
    />

    <!-- Documents Grid -->
    <DocumentGrid
      :documents="paginatedDocuments"
      :filtered-length="filteredDocuments.length"
      :is-loading="isGridLoading"
      @edit="editDocument"
      @delete="deleteDocument"
      @view="handleViewDocument"
      @download="handleDownloadDocument"
    />

    <!-- Document Pagination -->
    <div v-if="totalPages > 1" class="bg-white rounded-xl shadow-sm p-4">
      <div class="flex justify-between items-center">
        <span class="text-sm text-gray-700">
          {{ ((currentPage - 1) * perPage) + 1 }} - {{ Math.min(currentPage * perPage, filteredDocuments.length) }} dari {{ filteredDocuments.length }}
        </span>
        <div class="flex space-x-2">
          <button @click="goToPage(currentPage - 1)" :disabled="currentPage === 1"
                  class="px-3 py-1 bg-gray-100 text-gray-700 rounded disabled:opacity-50 hover:bg-gray-200 transition-colors">
            Sebelumnya
          </button>
          <button v-for="page in visiblePages" :key="page" @click="goToPage(page)"
                  :class="['px-3 py-1 rounded transition-colors', 
                          page === currentPage ? 'bg-purple-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200']">
            {{ page }}
          </button>
          <button @click="goToPage(currentPage + 1)" :disabled="currentPage === totalPages"
                  class="px-3 py-1 bg-gray-100 text-gray-700 rounded disabled:opacity-50 hover:bg-gray-200 transition-colors">
            Selanjutnya
          </button>
        </div>
      </div>
    </div>

    <!-- Loading State -->
    <div v-if="isGridLoading" class="flex justify-center items-center py-8">
      <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-purple-600"></div>
      <span class="ml-3 text-gray-600">Memuat dokumen...</span>
    </div>

    <!-- Empty State -->
    <div v-if="!isGridLoading && filteredDocuments.length === 0 && props.documents.length > 0" 
         class="text-center py-12 bg-white rounded-xl shadow-sm">
      <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
      </svg>
      <p class="text-gray-500 text-lg mb-2">Tidak ada dokumen ditemukan</p>
      <p class="text-gray-400">Coba ubah filter atau kata kunci pencarian</p>
      <button @click="clearFilters" class="mt-4 px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors">
        Reset Filter
      </button>
    </div>
  </section>
</template>

<script setup>
import { ref, computed, watch } from 'vue';
import { router } from '@inertiajs/vue3';
import DocumentFilters from './DocumentFilters.vue';
import DocumentForm from './DocumentForm.vue';
import DocumentGrid from './DocumentGrid.vue';

const props = defineProps({
  documents: { type: Array, default: () => [] },
  perPage: { type: Number, default: 6 }
});

const emit = defineEmits(['showNotification']);

// State
const showForm = ref(false);
const editingDocument = ref(null);
const isLoading = ref(false);
const isGridLoading = ref(false);
const currentPage = ref(1);
const searchQuery = ref('');
const selectedCategory = ref('all');

// Computed
const filteredDocuments = computed(() => {
  let filtered = [...(props.documents || [])];
  
  if (searchQuery.value) {
    const term = searchQuery.value.toLowerCase();
    filtered = filtered.filter(doc => 
      (doc.title || doc.name || '').toLowerCase().includes(term) || 
      (doc.description || '').toLowerCase().includes(term) ||
      (doc.file_name || '').toLowerCase().includes(term)
    );
  }
  
  if (selectedCategory.value !== 'all') {
    filtered = filtered.filter(doc => (doc.category || 'general') === selectedCategory.value);
  }
  
  return filtered;
});

const paginatedDocuments = computed(() => {
  const start = (currentPage.value - 1) * props.perPage;
  return filteredDocuments.value.slice(start, start + props.perPage);
});

const totalPages = computed(() => {
  return Math.ceil(filteredDocuments.value.length / props.perPage);
});

const visiblePages = computed(() => {
  const pages = [];
  const maxVisible = 5;
  const current = currentPage.value;
  const total = totalPages.value;
  
  let start = Math.max(1, current - Math.floor(maxVisible / 2));
  let end = Math.min(total, start + maxVisible - 1);
  
  if (end - start + 1 < maxVisible) {
    start = Math.max(1, end - maxVisible + 1);
  }
  
  for (let i = start; i <= end; i++) {
    pages.push(i);
  }
  
  return pages;
});

// Watch for filter changes to reset pagination
watch([searchQuery, selectedCategory], () => {
  currentPage.value = 1;
});

// Methods
function handleShowForm() {
  showForm.value = true;
  emit('showNotification', 'info', 'Form upload dokumen dibuka');
}

function saveDocument(formData) {
  isLoading.value = true;
  const isEdit = !!editingDocument.value;
  const url = isEdit 
    ? route('files.update', editingDocument.value.id) 
    : route('files.store');
  
  if (isEdit) {
    formData.append('_method', 'PUT');
  }

  // Show loading notification
  emit('showNotification', 'info', isEdit ? 'Memperbarui dokumen...' : 'Mengupload dokumen...');

  router.post(url, formData, {
    forceFormData: true,
    onStart: () => {
      isGridLoading.value = true;
    },
    onFinish: () => { 
      isLoading.value = false;
      isGridLoading.value = false;
    },
    onSuccess: (page) => {
      resetDocumentForm();
      const successMessage = isEdit ? 'Dokumen berhasil diperbarui!' : 'Dokumen berhasil diupload!';
      emit('showNotification', 'success', successMessage);
      
      // Reload documents data
      router.reload({ 
        only: ['documents'],
        onSuccess: () => {
          emit('showNotification', 'success', 'Data dokumen diperbarui');
        }
      });
    },
    onError: (errors) => {
      console.error('Document save error:', errors);
      const errorMessage = errors.message || 
                          Object.values(errors).flat().join(', ') || 
                          'Terjadi kesalahan saat menyimpan dokumen';
      emit('showNotification', 'error', 'Gagal menyimpan dokumen! ' + errorMessage);
    }
  });
}

function editDocument(doc) {
  editingDocument.value = doc;
  showForm.value = true;
  emit('showNotification', 'info', `Mengedit dokumen: ${doc.title || doc.name || 'Tanpa nama'}`);
}

function deleteDocument(id) {
  const document = props.documents.find(doc => doc.id === id);
  const documentName = document ? (document.title || document.name || 'Tanpa nama') : 'dokumen';
  
  if (confirm(`Yakin ingin menghapus dokumen "${documentName}"? Tindakan ini tidak dapat dibatalkan.`)) {
    isGridLoading.value = true;
    emit('showNotification', 'info', 'Menghapus dokumen...');
    
    router.delete(route('files.destroy', id), {
      onFinish: () => {
        isGridLoading.value = false;
      },
      onSuccess: () => {
        emit('showNotification', 'success', `Dokumen "${documentName}" berhasil dihapus!`);
        
        // Adjust current page if needed
        const newTotalPages = Math.ceil((filteredDocuments.value.length - 1) / props.perPage);
        if (currentPage.value > newTotalPages && newTotalPages > 0) {
          currentPage.value = newTotalPages;
        }
      },
      onError: (errors) => {
        console.error('Document delete error:', errors);
        const errorMessage = errors.message || 'Terjadi kesalahan saat menghapus dokumen';
        emit('showNotification', 'error', 'Gagal menghapus dokumen! ' + errorMessage);
      }
    });
  }
}

function handleViewDocument(doc) {
  emit('showNotification', 'info', `Membuka dokumen: ${doc.title || doc.name || 'Tanpa nama'}`);
  // Add logic to view/preview document
}

function handleDownloadDocument(doc) {
  emit('showNotification', 'info', `Mengunduh dokumen: ${doc.title || doc.name || 'Tanpa nama'}`);
  // Add download logic here
  try {
    // Assuming there's a download route
    window.open(route('files.download', doc.id), '_blank');
    setTimeout(() => {
      emit('showNotification', 'success', 'Unduhan dimulai!');
    }, 500);
  } catch (error) {
    emit('showNotification', 'error', 'Gagal mengunduh dokumen!');
  }
}

function handleCancelForm() {
  const wasEditing = !!editingDocument.value;
  resetDocumentForm();
  const message = wasEditing ? 'Edit dokumen dibatalkan' : 'Upload dokumen dibatalkan';
  emit('showNotification', 'info', message);
}

function handleFormReset() {
  emit('showNotification', 'info', 'Form telah direset');
}

function resetDocumentForm() {
  editingDocument.value = null;
  showForm.value = false;
}

function goToPage(page) {
  if (page >= 1 && page <= totalPages.value && page !== currentPage.value) {
    const oldPage = currentPage.value;
    currentPage.value = page;
    emit('showNotification', 'success', `Pindah ke halaman ${page} dari ${totalPages.value}`);
  }
}

function clearFilters() {
  const hadFilters = searchQuery.value || selectedCategory.value !== 'all';
  
  searchQuery.value = '';
  selectedCategory.value = 'all';
  currentPage.value = 1;
  
  if (hadFilters) {
    emit('showNotification', 'success', 'Filter berhasil dibersihkan!');
  } else {
    emit('showNotification', 'info', 'Filter sudah dalam keadaan bersih');
  }
}

function handleFilterApplied(filterType) {
  let message = '';
  switch(filterType) {
    case 'search':
      message = `Pencarian diterapkan: "${searchQuery.value}"`;
      break;
    case 'category':
      message = `Filter kategori: ${selectedCategory.value}`;
      break;
    case 'both':
      message = 'Filter pencarian dan kategori diterapkan';
      break;
    default:
      message = 'Filter diterapkan';
  }
  emit('showNotification', 'info', message);
}

// Lifecycle
// Show initial load notification if needed
if (props.documents.length > 0) {
  setTimeout(() => {
    emit('showNotification', 'success', `${props.documents.length} dokumen dimuat`);
  }, 100);
}
</script>