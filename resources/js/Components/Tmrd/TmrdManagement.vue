<!-- resources/js/Components/Tmrd/TmrdManagement.vue -->
<template>
  <div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
      <div>
        <h2 class="text-2xl font-bold text-gray-900">Kelola TMRD</h2>
        <p class="text-gray-600 mt-1">Task Management Risk Documentation - Sistem Informasi Risiko Kerja</p>
      </div>
      <button
        @click="showForm = true"
        class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors"
      >
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
        </svg>
        Tambah TMRD Baru
      </button>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
      <div class="bg-white rounded-lg p-4 shadow-sm border border-gray-200">
        <div class="flex items-center">
          <div class="p-2 bg-blue-100 rounded-lg">
            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
          </div>
          <div class="ml-4">
            <p class="text-sm font-medium text-gray-600">Total TMRD</p>
            <p class="text-2xl font-bold text-gray-900">{{ tmrdItems.length }}</p>
          </div>
        </div>
      </div>

      <div class="bg-white rounded-lg p-4 shadow-sm border border-gray-200">
        <div class="flex items-center">
          <div class="p-2 bg-yellow-100 rounded-lg">
            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
          </div>
          <div class="ml-4">
            <p class="text-sm font-medium text-gray-600">Pending</p>
            <p class="text-2xl font-bold text-gray-900">{{ pendingCount }}</p>
          </div>
        </div>
      </div>

      <div class="bg-white rounded-lg p-4 shadow-sm border border-gray-200">
        <div class="flex items-center">
          <div class="p-2 bg-green-100 rounded-lg">
            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
          </div>
          <div class="ml-4">
            <p class="text-sm font-medium text-gray-600">Completed</p>
            <p class="text-2xl font-bold text-gray-900">{{ completedCount }}</p>
          </div>
        </div>
      </div>

      <div class="bg-white rounded-lg p-4 shadow-sm border border-gray-200">
        <div class="flex items-center">
          <div class="p-2 bg-purple-100 rounded-lg">
            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
          </div>
          <div class="ml-4">
            <p class="text-sm font-medium text-gray-600">Pegawai Aktif</p>
            <p class="text-2xl font-bold text-gray-900">{{ uniqueEmployeesCount }}</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
      <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-2">Pencarian</label>
          <input
            v-model="filters.search"
            type="text"
            placeholder="Cari nama, NIP, atau kegiatan..."
            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
          >
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Kegiatan</label>
          <select
            v-model="filters.jenisKegiatan"
            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
          >
            <option value="">Semua Jenis</option>
            <option value="Safety Meeting">Safety Meeting</option>
            <option value="Risk Assessment">Risk Assessment</option>
            <option value="Training">Training</option>
            <option value="Audit">Audit</option>
            <option value="Lainnya">Lainnya</option>
          </select>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
          <select
            v-model="filters.status"
            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
          >
            <option value="">Semua Status</option>
            <option value="pending">Pending</option>
            <option value="in_progress">In Progress</option>
            <option value="completed">Completed</option>
          </select>
        </div>
        <div class="flex items-end">
          <button
            @click="clearFilters"
            class="w-full px-3 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors"
          >
            Reset Filter
          </button>
        </div>
      </div>
    </div>

    <!-- TMRD List -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
      <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pegawai</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kegiatan</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal & Waktu</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
              <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            <tr v-for="item in filteredTmrdItems" :key="item.id" class="hover:bg-gray-50">
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                  <div class="flex-shrink-0 h-10 w-10">
                    <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                      <span class="text-sm font-medium text-blue-600">{{ getInitials(item.nama) }}</span>
                    </div>
                  </div>
                  <div class="ml-4">
                    <div class="text-sm font-medium text-gray-900">{{ item.nama }}</div>
                    <div class="text-sm text-gray-500">NIP: {{ item.nip }}</div>
                  </div>
                </div>
              </td>
              <td class="px-6 py-4">
                <div class="text-sm text-gray-900 font-medium">{{ item.judul_kegiatan }}</div>
                <div class="text-sm text-gray-500">{{ item.jenis_kegiatan }}</div>
                <div class="text-xs text-gray-400 mt-1">{{ item.tugas }}</div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                <div>{{ formatDate(item.tanggal) }}</div>
                <div class="text-gray-500">{{ item.waktu }}</div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <span :class="getStatusClass(item.status)" class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full">
                  {{ getStatusText(item.status) }}
                </span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                <div class="flex items-center justify-end space-x-2">
                  <button
                    @click="viewDetail(item)"
                    class="text-blue-600 hover:text-blue-900 p-1 rounded"
                    title="Lihat Detail"
                  >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                  </button>
                  <button
                    @click="editTmrd(item)"
                    class="text-indigo-600 hover:text-indigo-900 p-1 rounded"
                    title="Edit"
                  >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                  </button>
                  <button
                    @click="updateStatus(item)"
                    class="text-green-600 hover:text-green-900 p-1 rounded"
                    title="Update Status"
                  >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                  </button>
                  <button
                    @click="deleteTmrd(item)"
                    class="text-red-600 hover:text-red-900 p-1 rounded"
                    title="Hapus"
                  >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                  </button>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Empty State -->
      <div v-if="filteredTmrdItems.length === 0" class="text-center py-12">
        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
        </svg>
        <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada data TMRD</h3>
        <p class="mt-1 text-sm text-gray-500">Mulai dengan membuat dokumentasi TMRD pertama.</p>
        <div class="mt-6">
          <button
            @click="showForm = true"
            class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors"
          >
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Tambah TMRD Baru
          </button>
        </div>
      </div>
    </div>

    <!-- Form Modal -->
    <TmrdForm
      v-if="showForm"
      :tmrd="selectedTmrd"
      @close="closeForm"
      @submit="handleSubmit"
    />

    <!-- Detail Modal -->
    <TmrdDetailModal
      v-if="showDetailModal"
      :tmrd="selectedTmrd"
      @close="showDetailModal = false"
    />
  </div>
</template>

<script setup>
import { ref, computed, defineEmits } from 'vue';
import { router } from '@inertiajs/vue3';
import TmrdForm from './TmrdForm.vue';

// Props
const props = defineProps({
  tmrdItems: {
    type: Array,
    default: () => []
  }
});

// Emits
const emit = defineEmits(['show-notification']);

// State
const showForm = ref(false);
const showDetailModal = ref(false);
const selectedTmrd = ref(null);

// Filters
const filters = ref({
  search: '',
  jenisKegiatan: '',
  status: ''
});

// Computed
const pendingCount = computed(() => 
  props.tmrdItems.filter(item => item.status === 'pending').length
);

const completedCount = computed(() => 
  props.tmrdItems.filter(item => item.status === 'completed').length
);

const uniqueEmployeesCount = computed(() => {
  const uniqueNips = new Set(props.tmrdItems.map(item => item.nip));
  return uniqueNips.size;
});

const filteredTmrdItems = computed(() => {
  let filtered = props.tmrdItems;

  if (filters.value.search) {
    const searchTerm = filters.value.search.toLowerCase();
    filtered = filtered.filter(item =>
      item.nama.toLowerCase().includes(searchTerm) ||
      item.nip.toLowerCase().includes(searchTerm) ||
      item.judul_kegiatan.toLowerCase().includes(searchTerm) ||
      item.jenis_kegiatan.toLowerCase().includes(searchTerm)
    );
  }

  if (filters.value.jenisKegiatan) {
    filtered = filtered.filter(item => item.jenis_kegiatan === filters.value.jenisKegiatan);
  }

  if (filters.value.status) {
    filtered = filtered.filter(item => item.status === filters.value.status);
  }

  return filtered;
});

// Methods
function getInitials(name) {
  return name
    .split(' ')
    .map(word => word.charAt(0))
    .join('')
    .toUpperCase()
    .substring(0, 2);
}

function formatDate(dateString) {
  const date = new Date(dateString);
  return date.toLocaleDateString('id-ID', {
    day: 'numeric',
    month: 'short',
    year: 'numeric'
  });
}

function getStatusClass(status) {
  const classes = {
    'pending': 'bg-yellow-100 text-yellow-800',
    'in_progress': 'bg-blue-100 text-blue-800',
    'completed': 'bg-green-100 text-green-800'
  };
  return classes[status] || 'bg-gray-100 text-gray-800';
}

function getStatusText(status) {
  const texts = {
    'pending': 'Pending',
    'in_progress': 'In Progress',
    'completed': 'Completed'
  };
  return texts[status] || status;
}

function viewDetail(tmrd) {
  selectedTmrd.value = tmrd;
  showDetailModal.value = true;
}

function editTmrd(tmrd) {
  selectedTmrd.value = { ...tmrd };
  showForm.value = true;
}

function updateStatus(tmrd) {
  const statuses = ['pending', 'in_progress', 'completed'];
  const currentIndex = statuses.indexOf(tmrd.status);
  const nextIndex = (currentIndex + 1) % statuses.length;
  const newStatus = statuses[nextIndex];

  router.put(route('tmrd.update', tmrd.id), {
    ...tmrd,
    status: newStatus
  }, {
    onSuccess: () => {
      emit('show-notification', 'success', `Status berhasil diubah ke ${getStatusText(newStatus)}`);
    },
    onError: () => {
      emit('show-notification', 'error', 'Gagal mengubah status');
    }
  });
}

function deleteTmrd(tmrd) {
  if (confirm(`Yakin ingin menghapus TMRD "${tmrd.judul_kegiatan}"?`)) {
    router.delete(route('tmrd.destroy', tmrd.id), {
      onSuccess: () => {
        emit('show-notification', 'success', 'TMRD berhasil dihapus');
      },
      onError: () => {
        emit('show-notification', 'error', 'Gagal menghapus TMRD');
      }
    });
  }
}

function closeForm() {
  showForm.value = false;
  selectedTmrd.value = null;
}

function handleSubmit(data) {
  if (selectedTmrd.value?.id) {
    // Update existing TMRD
    router.put(route('tmrd.update', selectedTmrd.value.id), data, {
      onSuccess: () => {
        emit('show-notification', 'success', 'TMRD berhasil diperbarui');
        closeForm();
      },
      onError: () => {
        emit('show-notification', 'error', 'Gagal memperbarui TMRD');
      }
    });
  } else {
    // Create new TMRD
    router.post(route('tmrd.store'), data, {
      onSuccess: () => {
        emit('show-notification', 'success', 'TMRD berhasil ditambahkan');
        closeForm();
      },
      onError: () => {
        emit('show-notification', 'error', 'Gagal menambahkan TMRD');
      }
    });
  }
}

function clearFilters() {
  filters.value = {
    search: '',
    jenisKegiatan: '',
    status: ''
  };
  emit('show-notification', 'success', 'Filter berhasil direset');
}
</script>