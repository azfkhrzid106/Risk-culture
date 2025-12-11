<template>
  <div>
    <h2 class="text-xl font-bold mb-4">Daftar TMRD (Data dari Form Resmi)</h2>

    <div v-if="loading">Loading data...</div>

    <div v-else>
      <!-- Filter Info -->
      <div class="bg-blue-50 border border-blue-200 rounded-lg p-3 mb-4">
        <p class="text-sm text-blue-800">
          <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
          </svg>
          Menampilkan hanya data yang diinput melalui Form TMRD resmi
        </p>
      </div>

      <!-- Data Table/List -->
      <div v-if="tmrdList.length > 0" class="grid gap-4">
        <div 
          v-for="item in tmrdList" 
          :key="item.id"
          class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm"
        >
          <div class="flex justify-between items-start">
            <div class="flex-1">
              <h3 class="font-semibold text-gray-900">{{ item.nama }}</h3>
              <p class="text-sm text-gray-600">NIP: {{ item.nip }}</p>
              <p class="text-sm text-gray-600 mt-1">{{ item.judul_kegiatan }}</p>
              <div class="flex items-center mt-2 space-x-4">
                <span class="text-xs px-2 py-1 rounded-full" 
                      :class="getStatusClass(item.status)">
                  {{ formatStatus(item.status) }}
                </span>
                <span class="text-xs text-gray-500">
                  {{ formatDate(item.tanggal) }} - {{ item.waktu }}
                </span>
              </div>
            </div>
            <div class="flex items-center space-x-2">
              <!-- View button -->
              <button 
                @click="viewDetail(item)"
                class="text-blue-600 hover:text-blue-800"
                title="Lihat Detail"
              >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                </svg>
              </button>
              <!-- Status update button (only for pending/in_progress) -->
              <button 
                v-if="item.status !== 'completed'"
                @click="updateStatus(item)"
                class="text-green-600 hover:text-green-800"
                title="Update Status"
              >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
              </button>
            </div>
          </div>
        </div>
      </div>

      <!-- Empty State -->
      <div v-else class="text-center py-12">
        <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
        </svg>
        <h3 class="text-lg font-medium text-gray-900 mb-2">Belum Ada Data TMRD</h3>
        <p class="text-gray-500">Data akan muncul setelah diinput melalui Form TMRD</p>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";

const tmrdList = ref([]);
const loading = ref(true);

onMounted(async () => {
  await fetchTmrdData();
});

async function fetchTmrdData() {
  try {
    loading.value = true;
    // Tambahkan parameter untuk filter hanya data dari form
    const response = await axios.get("/api/tmrd", {
      params: {
        source: 'form_tmrd' // Filter hanya data dari form
      }
    });
    tmrdList.value = response.data.data || [];
  } catch (error) {
    console.error("Gagal ambil data TMRD:", error);
    tmrdList.value = [];
  } finally {
    loading.value = false;
  }
}

function getStatusClass(status) {
  const classes = {
    'pending': 'bg-yellow-100 text-yellow-800',
    'in_progress': 'bg-blue-100 text-blue-800', 
    'completed': 'bg-green-100 text-green-800'
  };
  return classes[status] || 'bg-gray-100 text-gray-800';
}

function formatStatus(status) {
  const statuses = {
    'pending': 'Pending',
    'in_progress': 'In Progress',
    'completed': 'Completed'
  };
  return statuses[status] || status;
}

function formatDate(date) {
  if (!date) return '';
  return new Date(date).toLocaleDateString('id-ID', {
    year: 'numeric',
    month: 'short', 
    day: 'numeric'
  });
}

function viewDetail(item) {
  // Implement view detail logic
  console.log('View detail:', item);
}

async function updateStatus(item) {
  try {
    const newStatus = item.status === 'pending' ? 'in_progress' : 'completed';
    
    const response = await axios.put(`/api/tmrd/${item.id}/status`, {
      status: newStatus
    });
    
    if (response.data.success) {
      // Update local data
      const index = tmrdList.value.findIndex(t => t.id === item.id);
      if (index !== -1) {
        tmrdList.value[index].status = newStatus;
      }
    }
  } catch (error) {
    console.error('Gagal update status:', error);
    alert('Gagal mengupdate status');
  }
}
</script>