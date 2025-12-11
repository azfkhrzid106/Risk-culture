<template>
  <MainLayout>
    <!-- Hero Section -->
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
          Tim <span class="text-yellow-400">SRM</span> Kami
        </h1>
        <p class="text-xl md:text-2xl mb-8 animate-fade-in-up opacity-90" style="animation-delay: 0.3s">
          Bertemu dengan Tim Keselamatan dan Kesehatan Kerja PT Indonesia Asahan Aluminium
        </p>
        <div class="w-24 h-1 bg-yellow-400 mx-auto animate-scale-in" style="animation-delay: 0.6s"></div>
      </div>
    </section>


    <!-- Contact Person -->
    <section class="py-16 bg-white">
      <div class="container mx-auto px-6">
        <div class="max-w-2xl mx-auto">
          <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-gray-800 mb-4 animate-slide-in-up">Hubungi Contact Person SRM</h2>
          </div>

          <!-- Single Contact Person Card -->
          <div class="contact-person-card bg-white rounded-2xl shadow-xl overflow-hidden transform hover:scale-105 transition-all duration-300 animate-slide-in-up" style="animation-delay: 0.4s">
            <div class="relative">
              <div class="h-64 bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center">
                <div class="w-32 h-32 bg-white rounded-full flex items-center justify-center">
                  <svg class="w-16 h-16 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                  </svg>
                </div>
              </div>
              <div class="absolute top-6 right-6 bg-yellow-400 text-blue-800 px-4 py-2 rounded-full text-sm font-bold">
                CP SRM
              </div>
            </div>
            <div class="p-8">
              <h3 class="text-2xl font-bold text-gray-800 mb-2">Debin Norman Siallagan</h3>
              <p class="text-blue-600 font-semibold mb-6 text-lg">Analys Smelter Risk Management</p>
              
              <div class="space-y-4 mb-8">
                <div class="flex items-center text-gray-600">
                  <svg class="w-5 h-5 mr-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                  </svg>
                  <span class="text-base">debin.siallagan@inalum.id</span>
                </div>
                <div class="flex items-center text-gray-600">
                  <svg class="w-5 h-5 mr-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                  </svg>
                  <span class="text-base">+62 852-6190-8942</span>
                </div>
                <div class="flex items-center text-gray-600">
                  <svg class="w-5 h-5 mr-4 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                  </svg>
                  <span class="text-base">Gedung Utama Lantai 7</span>
                </div>
                <div class="flex items-center text-gray-600">
                  <svg class="w-5 h-5 mr-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                  </svg>
                  <span class="text-base">Kuala Tanjung, Sumatera Utara</span>
                </div>
              </div>
              
              <div class="border-t-2 border-gray-100 pt-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                  <div>
                    <p class="text-sm text-gray-500 mb-2 font-semibold">Jam Kerja:</p>
                    <p class="text-base text-gray-700 font-medium">Senin - Jumat</p>
                    <p class="text-base text-gray-700">08:00 - 16:00 WIB</p>
                  </div>
                  <div>
                    <p class="text-sm text-gray-500 mb-2 font-semibold">Response Time:</p>
                    <p class="text-base text-green-600 font-semibold">< 2 Jam</p>
                    <p class="text-sm text-gray-500">Untuk urusan mendesak</p>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </section>

  

   

  </MainLayout>
</template>

<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import { onMounted } from 'vue';

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
  document.querySelectorAll('.contact-person-card, .quick-info-card, .safety-tip, .animate-slide-in-up').forEach(el => {
    observer.observe(el);
  });
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

@keyframes pulse {
  0%, 100% {
    transform: scale(1);
  }
  50% {
    transform: scale(1.05);
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

/* Card effects */
.contact-person-card {
  opacity: 0;
  transform: translateY(30px);
  transition: all 0.6s ease;
}

.contact-person-card.animate-visible {
  opacity: 1;
  transform: translateY(0);
}

.contact-person-card:hover {
  transform: translateY(-8px) scale(1.02);
  box-shadow: 0 25px 50px rgba(0,0,0,0.15);
}

.quick-info-card {
  opacity: 0;
  transform: translateY(20px);
  transition: all 0.5s ease;
}

.quick-info-card.animate-visible {
  opacity: 1;
  transform: translateY(0);
}

.quick-info-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 15px 30px rgba(0,0,0,0.1);
}

.safety-tip {
  opacity: 0;
  transform: translateY(20px);
  transition: all 0.5s ease;
}

.safety-tip.animate-visible {
  opacity: 1;
  transform: translateY(0);
}

.safety-tip:hover {
  transform: translateY(-3px);
  box-shadow: 0 10px 25px rgba(0,0,0,0.1);
}

/* Gradient hover effects */
.contact-person-card:hover .bg-gradient-to-br {
  background: linear-gradient(135deg, var(--tw-gradient-from), var(--tw-gradient-to));
  animation: pulse 2s infinite;
}

/* Badge animations */
.contact-person-card:hover .absolute.top-4.right-4 {
  animation: pulse 1.5s infinite;
}

/* Icon hover effects */
.contact-person-card:hover svg {
  transform: scale(1.1);
  transition: transform 0.3s ease;
}

/* Responsive adjustments */
@media (max-width: 768px) {
  .animate-fade-in-up,
  .animate-slide-in-up {
    animation-delay: 0s !important;
  }
  
  .contact-person-card,
  .quick-info-card,
  .safety-tip {
    animation-delay: 0s !important;
  }
}

/* Performance optimizations */
.contact-person-card,
.quick-info-card,
.safety-tip,
.animate-slide-in-up {
  will-change: transform, opacity;
}

/* Emergency card special styling */
.contact-person-card:nth-child(4) {
  border: 2px solid #fee2e2;
}

.contact-person-card:nth-child(4):hover {
  border-color: #fca5a5;
  box-shadow: 0 25px 50px rgba(239, 68, 68, 0.15);
}

/* Medical card special styling */
.contact-person-card:nth-child(6) {
  border: 2px solid #f0fdfa;
}

.contact-person-card:nth-child(6):hover {
  border-color: #5eead4;
  box-shadow: 0 25px 50px rgba(20, 184, 166, 0.15);
}
</style>