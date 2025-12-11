<!-- resources/js/Components/Tmrd/TmrdForm.vue -->
<template>
  <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50">
    <div class="bg-white rounded-lg shadow-xl max-w-4xl w-full max-h-[90vh] overflow-y-auto">
      <!-- Header -->
      <div class="flex justify-between items-center p-6 border-b border-gray-200">
        <div>
          <h3 class="text-lg font-semibold text-gray-900">
            {{ isEdit ? 'Edit TMRD' : 'Tambah TMRD Baru' }}
          </h3>
          <p class="text-sm text-gray-600 mt-1">
            {{ isEdit ? 'Perbarui informasi TMRD' : 'Form TMRD - Task Management Risk Documentation' }}
          </p>
        </div>
        <button
          @click="$emit('close')"
          class="text-gray-400 hover:text-gray-600 transition-colors"
        >
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
          </svg>
        </button>
      </div>

      <!-- Form -->
      <form @submit.prevent="handleSubmit" class="p-6">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
          <!-- Data Pegawai Section -->
          <div class="lg:col-span-2">
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
              <div class="flex items-center mb-3">
                <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                <h4 class="text-lg font-semibold text-blue-900">Data Pegawai</h4>
              </div>
              
              <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- NIP -->
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-2">
                    NIP <span class="text-red-500">*</span>
                  </label>
                  <input
                    v-model="form.nip"
                    type="text"
                    placeholder="Ketik NIP untuk mencari..."
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    :class="{ 'border-red-500': errors.nip }"
                    required
                  >
                  <p class="text-xs text-gray-500 mt-1">Format: 8-10 digit NIP pegawai</p>
                  <p v-if="errors.nip" class="text-red-500 text-sm mt-1">{{ errors.nip }}</p>
                </div>

                <!-- Nama -->
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-2">
                    Nama <span class="text-red-500">*</span>
                  </label>
                  <input
                    v-model="form.nama"
                    type="text"
                    placeholder="Nama lengkap pegawai"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    :class="{ 'border-red-500': errors.nama }"
                    required
                  >
                  <p v-if="errors.nama" class="text-red-500 text-sm mt-1">{{ errors.nama }}</p>
                </div>

                <!-- Tugas -->
                <div class="md:col-span-2">
                  <label class="block text-sm font-medium text-gray-700 mb-2">
                    Tugas <span class="text-red-500">*</span>
                  </label>
                  <input
                    v-model="form.tugas"
                    type="text"
                    placeholder="Deskripsi tugas/jabatan"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    :class="{ 'border-red-500': errors.tugas }"
                    required
                  >
                  <p v-if="errors.tugas" class="text-red-500 text-sm mt-1">{{ errors.tugas }}</p>
                </div>
              </div>
            </div>
          </div>

          <!-- Kegiatan Manajemen Risiko Section -->
          <div class="lg:col-span-2">
            <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6">
              <div class="flex items-center mb-3">
                <svg class="w-5 h-5 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <h4 class="text-lg font-semibold text-green-900">Kegiatan Manajemen Risiko</h4>
              </div>

              <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Jenis Kegiatan -->
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-2">
                    Jenis Kegiatan <span class="text-red-500">*</span>
                  </label>
                  <select
                    v-model="form.jenis_kegiatan"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    :class="{ 'border-red-500': errors.jenis_kegiatan }"
                    required
                  >
                    <option value="">Pilih jenis kegiatan</option>
                    <option value="Safety Meeting">Safety Meeting</option>
                    <option value="Risk Assessment">Risk Assessment</option>
                    <option value="Training">Training</option>
                    <option value="Audit">Audit</option>
                    <option value="Inspeksi">Inspeksi</option>
                    <option value="Investigation">Investigation</option>
                    <option value="Lainnya">Lainnya</option>
                  </select>
                  <p v-if="errors.jenis_kegiatan" class="text-red-500 text-sm mt-1">{{ errors.jenis_kegiatan }}</p>
                </div>

                <!-- Status -->
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-2">
                    Status
                  </label>
                  <select
                    v-model="form.status"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                  >
                    <option value="pending">Pending</option>
                    <option value="in_progress">In Progress</option>
                    <option value="completed">Completed</option>
                  </select>
                </div>

                <!-- Judul Kegiatan -->
                <div class="md:col-span-2">
                  <label class="block text-sm font-medium text-gray-700 mb-2">
                    Judul Kegiatan <span class="text-red-500">*</span>
                  </label>
                  <textarea
                    v-model="form.judul_kegiatan"
                    rows="3"
                    placeholder="Deskripsi lengkap kegiatan yang akan dilakukan"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 resize-none"
                    :class="{ 'border-red-500': errors.judul_kegiatan }"
                    required
                  ></textarea>
                  <p v-if="errors.judul_kegiatan" class="text-red-500 text-sm mt-1">{{ errors.judul_kegiatan }}</p>
                </div>
              </div>
            </div>
          </div>

          <!-- Jadwal Section -->
          <div class="lg:col-span-2">
            <div class="bg-purple-50 border border-purple-200 rounded-lg p-4">
              <div class="flex items-center mb-3">
                <svg class="w-5 h-5 text-purple-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                <h4 class="text-lg font-semibold text-purple-900">Jadwal Kegiatan</h4>
              </div>

              <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Tanggal -->
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-2">
                    Tanggal <span class="text-red-500">*</span>
                  </label>
                  <input
                    v-model="form.tanggal"
                    type="date"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    :class="{ 'border-red-500': errors.tanggal }"
                    required
                  >
                  <p v-if="errors.tanggal" class="text-red-500 text-sm mt-1">{{ errors.tanggal }}</p>
                </div>

                <!-- Waktu -->
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-2">
                    Waktu <span class="text-red-500">*</span>
                  </label>
                  <input
                    v-model="form.waktu"
                    type="time"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    :class="{ 'border-red-500': errors.waktu }"
                    required
                  >
                  <p v-if="errors.waktu" class="text-red-500 text-sm mt-1">{{ errors.waktu }}</p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Form Actions -->
        <div class="flex justify-end space-x-3 mt-8 pt-6 border-t border-gray-200">
          <button
            type="button"
            @click="$emit('close')"
            class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
          >
            Batal
          </button>
          <button
            type="submit"
            :disabled="isSubmitting"
            class="px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 disabled:opacity-50 disabled:cursor-not-allowed"
          >
            <span v-if="isSubmitting" class="flex items-center">
              <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
              </svg>
              {{ isEdit ? 'Memperbarui...' : 'Menyimpan...' }}
            </span>
            <span v-else>
              {{ isEdit ? 'Perbarui TMRD' : 'Simpan TMRD' }}
            </span>
          </button>
        </div>
      </form>
    </div>
  </div>
</template>

<script setup>
import { ref, reactive, computed, onMounted } from 'vue';

// Props
const props = defineProps({
  tmrd: {
    type: Object,
    default: null
  }
});

// Emits
const emit = defineEmits(['close', 'submit']);

// State
const isSubmitting = ref(false);
const errors = reactive({});

// Form data
const form = reactive({
  nip: '',
  nama: '',
  tugas: '',
  jenis_kegiatan: '',
  judul_kegiatan: '',
  tanggal: '',
  waktu: '',
  status: 'pending'
});

// Computed
const isEdit = computed(() => props.tmrd?.id != null);

// Lifecycle
onMounted(() => {
  if (props.tmrd) {
    Object.keys(form).forEach(key => {
      if (props.tmrd[key] !== undefined) {
        form[key] = props.tmrd[key];
      }
    });
  } else {
    // Set default date to today
    const today = new Date();
    form.tanggal = today.toISOString().split('T')[0];
    form.waktu = '08:00';
  }
});

// Methods
function clearErrors() {
  Object.keys(errors).forEach(key => {
    delete errors[key];
  });
}

function validateForm() {
  clearErrors();
  let isValid = true;

  // Required field validation
  const requiredFields = {
    nip: 'NIP wajib diisi',
    nama: 'Nama wajib diisi',
    tugas: 'Tugas wajib diisi',
    jenis_kegiatan: 'Jenis kegiatan wajib dipilih',
    judul_kegiatan: 'Judul kegiatan wajib diisi',
    tanggal: 'Tanggal wajib diisi',
    waktu: 'Waktu wajib diisi'
  };

  Object.entries(requiredFields).forEach(([field, message]) => {
    if (!form[field] || form[field].trim() === '') {
      errors[field] = message;
      isValid = false;
    }
  });

  // NIP validation (8-10 digits)
  if (form.nip && !/^\d{8,10}$/.test(form.nip)) {
    errors.nip = 'NIP harus berupa 8-10 digit angka';
    isValid = false;
  }

  // Date validation (tidak boleh masa lalu untuk kegiatan baru)
  if (form.tanggal && !isEdit.value) {
    const selectedDate = new Date(form.tanggal);
    const today = new Date();
    today.setHours(0, 0, 0, 0);
    
    if (selectedDate < today) {
      errors.tanggal = 'Tanggal tidak boleh masa lalu';
      isValid = false;
    }
  }

  return isValid;
}

// Di bagian handleSubmit function, tambahkan identifier
function handleSubmit() {
  if (!validateForm()) {
    return;
  }

  isSubmitting.value = true;

  // Create form data with source identifier
  const formData = { 
    ...form,
    source: 'form_tmrd', // Identifier untuk menandakan data berasal dari form
    created_via: 'official_form' // Additional identifier
  };

  // Emit submit event
  emit('submit', formData);

  // Reset submitting state after a delay
  setTimeout(() => {
    isSubmitting.value = false;
  }, 2000);
}
</script>