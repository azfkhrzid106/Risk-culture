<!-- resources/js/Components/News/NewsManagement.vue -->
<template>
  <section class="space-y-6">
    <div class="flex justify-between items-center mb-4">
      <div class="flex-1">
 <NewsFilters
     v-model:search="filters.search"
     v-model:category="filters.category"
     @reset="resetFilters"
   />
      </div>

      <div class="ml-4">
        <button @click="openNewForm"
                class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700">
          + Tambah Berita
        </button>
      </div>
    </div>

    <!-- Form tambah / edit berita -->
    <NewsForm
      v-if="showForm"
      :editing-news="editingNews"
      :is-loading="isLoading"
      @save="saveNews"
      @cancel="resetForm"
      @showNotification="showNotification"
    />

    <!-- Grid berita -->
    <NewsGrid
      :news-items="paginatedNews"
      @edit="editNews"
      @delete="deleteNews"
    />

    <!-- Pagination sederhana -->
    <div v-if="totalPages > 1" class="bg-white rounded-xl shadow-sm p-4">
      <div class="flex justify-between items-center">
        <span class="text-sm text-gray-700">
          {{ ((currentPage - 1) * perPage) + 1 }} - {{ Math.min(currentPage * perPage, filteredList.length) }} dari {{ filteredList.length }}
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
</template>

<script setup>
import { ref, computed } from 'vue'
import { router, usePage } from '@inertiajs/vue3'
import NewsFilters from './NewsFilters.vue'
import NewsGrid from './NewsGrid.vue'
import NewsForm from './NewsForm.vue'

const props = defineProps({
  newsItems: { type: Array, default: () => [] },
  perPage: { type: Number, default: 6 }
})

const emit = defineEmits(['showNotification'])

// STATE
const filters = ref({ search: '', category: '' })
const showForm = ref(false)
const editingNews = ref(null)
const isLoading = ref(false)
const currentPage = ref(1)
const perPage = props.perPage

// FIXED: Fallback data dengan safe access
const page = usePage()
const allNews = computed(() => {
  // Prioritas: props.newsItems (jika ada data), lalu page.props, lalu []
  if (props.newsItems && props.newsItems.length) return props.newsItems
  
  // Safe access ke Inertia page props
  const pageProps = page.props?.value || {}
  return pageProps.newsItems || pageProps.news || []
})

// FILTERED LIST
const filteredList = computed(() => {
  const list = [...allNews.value]
  const term = filters.value.search ? filters.value.search.toLowerCase() : ''
  return list.filter(n => {
    const matchesSearch = term ? (n.title || '').toLowerCase().includes(term) || (n.content || '').toLowerCase().includes(term) : true
    const matchesCategory = filters.value.category ? (n.category === filters.value.category) : true
    return matchesSearch && matchesCategory
  })
})

// PAGINATION
const totalPages = computed(() => Math.max(1, Math.ceil(filteredList.value.length / perPage)))
const paginatedNews = computed(() => {
  const start = (currentPage.value - 1) * perPage
  return filteredList.value.slice(start, start + perPage)
})

function goToPage(pageNum) {
  if (pageNum >= 1 && pageNum <= totalPages.value) currentPage.value = pageNum
}

// ACTIONS
function resetFilters() {
  filters.value.search = ''
  filters.value.category = ''
  currentPage.value = 1
  showNotification('success', 'Filter dibersihkan!')
}

function openNewForm() {
  editingNews.value = null
  showForm.value = true
}

function editNews(news) {
  editingNews.value = news
  showForm.value = true
}

function resetForm() {
  editingNews.value = null
  showForm.value = false
  isLoading.value = false
}

function saveNews(formData) {
  isLoading.value = true
  const url = editingNews.value ? `/admin/news/${editingNews.value.id}` : '/admin/news'

  if (editingNews.value) formData.append('_method', 'PUT')

  router.post(url, formData, {
    forceFormData: true,
    onFinish: () => { isLoading.value = false },
    onSuccess: () => {
      resetForm()
      showNotification('success', editingNews.value ? 'Berita berhasil diperbarui!' : 'Berita berhasil ditambahkan!')
      // reload props (sesuaikan key sesuai backend-mu)
      router.reload({ only: ['newsItems', 'news'] })
    },
    onError: (errors) => {
      const msg = errors?.message || Object.values(errors || {}).flat().join(', ') || 'Terjadi kesalahan'
      showNotification('error', 'Gagal menyimpan berita: ' + msg)
    } 
  })
}

function deleteNews(id) {
  if (!confirm('Yakin ingin menghapus berita ini?')) return
  router.delete(`/admin/news/${id}`, {
    onSuccess: () => {
      showNotification('success', 'Berita dihapus!')
      router.reload({ only: ['newsItems', 'news'] })
    },
    onError: () => showNotification('error', 'Gagal menghapus berita!')
  })
}

function showNotification(type, message) {
  // kirim ke parent jika ada listener
  try { emit('showNotification', type, message) } catch(e) {}
  // fallback visible feedback
  console.log(`${type.toUpperCase()}: ${message}`)
}
</script>