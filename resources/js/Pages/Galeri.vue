<template>
  <MainLayout>
    <!-- Hero Section dengan animasi -->
    <section class="relative bg-gradient-to-br from-blue-600 via-blue-700 to-blue-800 text-white py-20 overflow-hidden">
      <!-- Background animated shapes -->
      <div class="absolute inset-0 opacity-10">
        <div class="floating-shape absolute top-10 left-10 w-20 h-20 bg-white rounded-full"></div>
        <div class="floating-shape absolute top-32 right-20 w-16 h-16 bg-white rounded-lg rotate-45" style="animation-delay: 0.5s"></div>
        <div class="floating-shape absolute bottom-20 left-1/4 w-12 h-12 bg-white rounded-full" style="animation-delay: 1s"></div>
        <div class="floating-shape absolute bottom-32 right-1/3 w-24 h-24 bg-white rounded-lg rotate-12" style="animation-delay: 1.5s"></div>
      </div>
      
      <div class="container mx-auto px-6 text-center relative z-10">
        <h1 class="text-5xl md:text-6xl font-bold mb-6 animate-fade-in-up">
          Galeri <span class="text-yellow-400">Foto</span>
        </h1>
        <p class="text-xl md:text-2xl mb-8 animate-fade-in-up opacity-90" style="animation-delay: 0.3s">
          Dokumentasi Kegiatan Keselamatan dan Kesehatan Kerja PT Indonesia Asahan Aluminium
        </p>
        <div class="w-24 h-1 bg-yellow-400 mx-auto animate-scale-in" style="animation-delay: 0.6s"></div>
      </div>
    </section>

    <!-- Stats Section -->
    <section class="py-16 bg-gradient-to-r from-gray-50 to-gray-100">
      <div class="container mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
          <!-- Total Photos Card -->
          <div class="stats-card bg-white rounded-2xl shadow-lg p-8 text-center transform hover:scale-105 transition-all duration-300">
            <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-6 animate-bounce-in">
              <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
              </svg>
            </div>
            <h3 class="text-2xl font-bold text-gray-800 mb-2">{{ newsItems.length }}</h3>
            <p class="text-gray-600">Total Foto</p>
          </div>

          <!-- Categories Card -->
          <div class="stats-card bg-white rounded-2xl shadow-lg p-8 text-center transform hover:scale-105 transition-all duration-300" style="animation-delay: 0.2s">
            <div class="w-16 h-16 bg-green-600 rounded-full flex items-center justify-center mx-auto mb-6 animate-bounce-in">
              <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
              </svg>
            </div>
            <h3 class="text-2xl font-bold text-gray-800 mb-2">K3</h3>
            <p class="text-gray-600">Kategori Utama</p>
          </div>

          <!-- Quality Card -->
          <div class="stats-card bg-white rounded-2xl shadow-lg p-8 text-center transform hover:scale-105 transition-all duration-300" style="animation-delay: 0.4s">
            <div class="w-16 h-16 bg-purple-600 rounded-full flex items-center justify-center mx-auto mb-6 animate-bounce-in">
              <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
              </svg>
            </div>
            <h3 class="text-2xl font-bold text-gray-800 mb-2">HD</h3>
            <p class="text-gray-600">Kualitas Gambar</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Gallery Grid Section -->
    <section class="py-16 bg-white">
      <div class="container mx-auto px-6">
        <div class="text-center mb-12">
          <h2 class="text-4xl font-bold text-gray-800 mb-4 animate-slide-in-up">Koleksi Dokumentasi</h2>
          <p class="text-xl text-gray-600 animate-slide-in-up" style="animation-delay: 0.2s">
            Lihat berbagai kegiatan dan implementasi sistem K3 di lapangan
          </p>
        </div>

        <!-- Gallery Grid -->
        <div v-if="newsItems.length > 0" class="grid gap-8 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
          <div
            v-for="(item, index) in newsItems"
            :key="item.id"
            class="gallery-card group relative overflow-hidden rounded-2xl shadow-lg transition-all duration-500 hover:shadow-2xl cursor-pointer transform hover:scale-105"
            :style="`animation-delay: ${index * 0.1}s`"
            @click="openModal(item)"
          >
            <!-- Image Container -->
            <div class="relative h-64 bg-gradient-to-br from-gray-100 to-gray-200 overflow-hidden">
              <img
                :src="item.image_url || '/images/no-image.jpg'"
                :alt="item.title"
                class="w-full h-full object-cover transition-all duration-700 group-hover:scale-110 group-hover:rotate-1"
                @error="handleImageError"
                loading="lazy"
              />
              
              <!-- Gradient Overlay -->
              <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300"></div>
              
              <!-- View Button -->
              <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300">
                <div class="bg-white/20 backdrop-blur-sm rounded-full p-4 transform scale-75 group-hover:scale-100 transition-transform duration-300">
                  <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                  </svg>
                </div>
              </div>
              
              <!-- Title Overlay -->
              <div class="absolute bottom-0 left-0 right-0 p-6 text-white transform translate-y-full group-hover:translate-y-0 transition-transform duration-300">
                <h3 class="text-lg font-bold leading-tight mb-2">{{ item.title }}</h3>
                <p class="text-sm opacity-90">Klik untuk melihat detail</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Empty State -->
        <div v-else class="text-center py-16">
          <div class="w-24 h-24 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-6">
            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
          </div>
          <h3 class="text-2xl font-bold text-gray-800 mb-4">Belum Ada Foto</h3>
          <p class="text-gray-600 max-w-md mx-auto">
            Dokumentasi foto kegiatan K3 akan segera ditambahkan. Pantau terus halaman ini untuk update terbaru.
          </p>
        </div>
      </div>
    </section>

    <!-- Modal Lightbox -->
    <Transition name="modal">
      <div
        v-if="selectedImage"
        class="fixed inset-0 bg-black/90 flex items-center justify-center z-50 p-4"
        @click.self="closeModal"
      >
        <div class="relative max-w-5xl w-full">
          <!-- Close Button -->
          <button
            class="absolute -top-12 right-0 text-white text-4xl hover:text-red-400 transition-colors duration-300 z-10"
            @click="closeModal"
          >
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
          </button>
          
          <!-- Image -->
          <div class="bg-white rounded-2xl overflow-hidden shadow-2xl">
            <img
              :src="selectedImage.image_url"
              :alt="selectedImage.title"
              class="w-full max-h-[70vh] object-contain"
            />
            
            <!-- Image Info -->
            <div class="p-6 bg-gradient-to-r from-blue-50 to-blue-100">
              <h3 class="text-2xl font-bold text-gray-800 mb-2">{{ selectedImage.title }}</h3>
              <div class="flex items-center text-gray-600">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                <span>Dokumentasi Kegiatan K3</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </Transition>
  </MainLayout>
</template>

<script setup>
import { ref, onMounted } from "vue";
import MainLayout from "@/Layouts/MainLayout.vue";

const props = defineProps({
  newsItems: {
    type: Array,
    default: () => [],
  },
});

const selectedImage = ref(null);

const handleImageError = (event) => {
  event.target.src = "/images/no-image.jpg";
};

const openModal = (item) => {
  selectedImage.value = item;
  document.body.style.overflow = 'hidden';
};

const closeModal = () => {
  selectedImage.value = null;
  document.body.style.overflow = 'auto';
};

onMounted(() => {
  // Intersection Observer untuk animasi saat scroll
  const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
  };

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('animate-visible');
      }
    });
  }, observerOptions);

  // Observe semua elemen dengan class animasi
  document.querySelectorAll('.gallery-card, .stats-card, .animate-slide-in-up').forEach(el => {
    observer.observe(el);
  });

  // Keyboard navigation untuk modal
  const handleKeydown = (e) => {
    if (e.key === 'Escape' && selectedImage.value) {
      closeModal();
    }
  };

  document.addEventListener('keydown', handleKeydown);

  // Cleanup
  return () => {
    document.removeEventListener('keydown', handleKeydown);
  };
});
</script>

<style scoped>
/* Animasi keyframes */
@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translateY(30px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

@keyframes slideInUp {
  from {
    opacity: 0;
    transform: translateY(50px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

@keyframes scaleIn {
  from {
    opacity: 0;
    transform: scaleX(0);
  }
  to {
    opacity: 1;
    transform: scaleX(1);
  }
}

@keyframes bounceIn {
  0% {
    opacity: 0;
    transform: scale(0.3);
  }
  50% {
    transform: scale(1.05);
  }
  70% {
    transform: scale(0.9);
  }
  100% {
    opacity: 1;
    transform: scale(1);
  }
}

@keyframes floating {
  0%, 100% {
    transform: translateY(0px) rotate(0deg);
  }
  33% {
    transform: translateY(-10px) rotate(5deg);
  }
  66% {
    transform: translateY(-5px) rotate(-5deg);
  }
}

/* Classes animasi */
.animate-fade-in-up {
  animation: fadeInUp 0.8s ease-out forwards;
  opacity: 0;
}

.animate-slide-in-up {
  animation: slideInUp 0.8s ease-out forwards;
  opacity: 0;
}

.animate-scale-in {
  animation: scaleIn 0.6s ease-out forwards;
  opacity: 0;
}

.animate-bounce-in {
  animation: bounceIn 0.8s ease-out forwards;
  opacity: 0;
}

.floating-shape {
  animation: floating 6s ease-in-out infinite;
}

/* Gallery Cards */
.gallery-card {
  opacity: 0;
  transform: translateY(50px) scale(0.9);
  transition: all 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
}

.gallery-card.animate-visible {
  opacity: 1;
  transform: translateY(0) scale(1);
}

.gallery-card:hover {
  transform: translateY(-10px) scale(1.02);
  box-shadow: 0 25px 50px rgba(0,0,0,0.15);
}

/* Stats Cards */
.stats-card {
  opacity: 0;
  transform: translateY(30px);
  transition: all 0.6s ease;
}

.stats-card.animate-visible {
  opacity: 1;
  transform: translateY(0);
}

.stats-card:hover {
  transform: translateY(-10px) scale(1.02);
  box-shadow: 0 20px 40px rgba(0,0,0,0.1);
}

/* Modal Transitions */
.modal-enter-active, .modal-leave-active {
  transition: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
}

.modal-enter-from, .modal-leave-to {
  opacity: 0;
  transform: scale(0.8);
}

.modal-enter-to, .modal-leave-from {
  opacity: 1;
  transform: scale(1);
}

/* Responsive adjustments */
@media (max-width: 768px) {
  .animate-fade-in-up,
  .animate-slide-in-up {
    animation-delay: 0s !important;
  }
  
  .gallery-card,
  .stats-card {
    animation-delay: 0s !important;
  }

  .gallery-card {
    height: 240px;
  }
}

/* Performance optimizations */
.gallery-card,
.stats-card,
.animate-slide-in-up {
  will-change: transform, opacity;
}

/* Custom scrollbar untuk modal */
.modal-content::-webkit-scrollbar {
  width: 8px;
}

.modal-content::-webkit-scrollbar-track {
  background: #f1f1f1;
  border-radius: 4px;
}

.modal-content::-webkit-scrollbar-thumb {
  background: #888;
  border-radius: 4px;
}

.modal-content::-webkit-scrollbar-thumb:hover {
  background: #555;
}
</style>