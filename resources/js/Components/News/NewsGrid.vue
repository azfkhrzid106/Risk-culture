<!-- resources/js/Components/News/NewsGrid.vue -->
<template>
  <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 mb-6">
    <div
      v-for="news in newsItems"
      :key="news.id"
      class="bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-md transition-shadow"
    >
      <!-- Gambar -->
      <div class="aspect-video relative">
        <img
          v-if="news.image_path"
          :src="news.image_path ? `/storage/${news.image_path}` : null"
          alt=""
          class="w-full h-full object-cover"
        >
        <div
          v-else
          class="w-full h-full bg-gray-200 flex items-center justify-center"
        >
          <svg
            class="w-12 h-12 text-gray-400"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"
            />
          </svg>
        </div>

        <!-- Badge status -->
        <div class="absolute top-2 right-2">
          <span
            :class="[
              'px-2 py-1 rounded-full text-xs font-medium',
              news.is_active
                ? 'bg-green-100 text-green-800'
                : 'bg-gray-100 text-gray-800'
            ]"
          >
            {{ news.is_active ? 'Aktif' : 'Draft' }}
          </span>
        </div>

        <!-- Badge kategori -->
        <div class="absolute top-2 left-2">
          <span
            :class="[
              'px-2 py-1 rounded-full text-xs font-medium',
              getCategoryBadgeClass(news.category)
            ]"
          >
            {{ categoryLabels[news.category] ?? 'Umum' }}
          </span>
        </div>
      </div>

      <!-- Konten -->
      <div class="p-4">
        <h3 class="font-semibold text-gray-900 mb-2 line-clamp-2">
          {{ news.title }}
        </h3>
        <p class="text-sm text-gray-600 mb-4 line-clamp-3">
          {{ news.content }}
        </p>

        <div class="flex justify-between text-xs text-gray-500 mb-4">
          <span>{{ formatDate(news.created_at) }}</span>
        </div>

        <div class="flex space-x-2">
          <button
            @click="$emit('edit', news)"
            class="flex-1 px-3 py-2 bg-blue-50 text-blue-700 text-sm rounded-lg hover:bg-blue-100"
          >
            Edit
          </button>
          <button
            @click="$emit('delete', news.id)"
            class="flex-1 px-3 py-2 bg-red-50 text-red-700 text-sm rounded-lg hover:bg-red-100"
          >
            Hapus
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
const props = defineProps({
  newsItems: {
    type: Array,
    required: true
  }
})

defineEmits(['edit', 'delete'])

const categoryLabels = {
  info: 'Informasi',
  safety: 'Keselamatan',
  announcement: 'Pengumuman',
  event: 'Event'
}

function getCategoryBadgeClass(category) {
  const classes = {
    info: 'bg-blue-100 text-blue-800',
    safety: 'bg-red-100 text-red-800',
    announcement: 'bg-yellow-100 text-yellow-800',
    event: 'bg-green-100 text-green-800'
  }
  return classes[category] || 'bg-gray-100 text-gray-800'
}

function formatDate(dateString) {
  return new Date(dateString).toLocaleDateString('id-ID')
}
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
