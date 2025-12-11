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
          Profil <span class="text-yellow-400">SRM</span>
        </h1>
        <p class="text-xl md:text-2xl mb-8 animate-fade-in-up opacity-90" style="animation-delay: 0.3s">
          Sistem Manajemen Risiko PT Indonesia Asahan Aluminium
        </p>
        <div class="w-24 h-1 bg-yellow-400 mx-auto animate-scale-in" style="animation-delay: 0.6s"></div>
      </div>
    </section>

    <!-- About SRM Section -->
    <section class="py-16 bg-gray-50">
      <div class="container mx-auto px-6">
        <div class="max-w-4xl mx-auto">
          <div class="about-card bg-white rounded-3xl shadow-xl p-8 md:p-12 transform hover:scale-105 transition-all duration-500 animate-slide-in-up">
            <div class="flex items-center mb-8">
              <div class="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center mr-6 animate-bounce-in">
                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m0-4h.01M21 12c0 4.418-3.582 8-8 8s-8-3.582-8-8 3.582-8 8-8 8 3.582 8 8z" />
                </svg>
              </div>
              <h2 class="text-4xl font-bold text-gray-800">Tentang SRM</h2>
            </div>
            <p class="text-gray-600 leading-relaxed text-lg">
              Smelter Risk Management (SRM) adalah platform yang mengintegrasikan pemantauan risiko, pelaporan insiden,
              dan edukasi Risiko secara digital. Sistem ini membantu memastikan lingkungan kerja yang aman, produktif, dan
              sesuai regulasi keselamatan dengan teknologi terdepan dan pendekatan yang komprehensif.
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- Vision & Mission Section -->
    <section class="py-16 bg-white">
      <div class="container mx-auto px-6">
        <div class="text-center mb-12">
          <h2 class="text-4xl font-bold text-gray-800 mb-4 animate-slide-in-up">Visi & Misi</h2>
          <p class="text-xl text-gray-600 animate-slide-in-up" style="animation-delay: 0.2s">
            Fondasi dan arah pengembangan sistem manajemen risiko terpadu
          </p>
        </div>

        <div class="grid md:grid-cols-2 gap-8 max-w-6xl mx-auto">
          <!-- Vision Card -->
          <div class="vision-card bg-gradient-to-br from-blue-50 via-white to-blue-50 shadow-xl rounded-3xl p-8 transform hover:scale-105 transition-all duration-500 border border-blue-100">
            <div class="flex items-center mb-6">
              <div class="w-12 h-12 bg-blue-600 rounded-2xl flex items-center justify-center mr-4 animate-bounce-in">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                  <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                </svg>
              </div>
              <h3 class="text-3xl font-bold text-gray-800">Visi</h3>
            </div>
            <p class="text-gray-700 leading-relaxed text-lg">
              Menjadi sistem manajemen risiko terdepan yang memastikan keselamatan kerja di seluruh lini operasi 
              PT Indonesia Asahan Aluminium dengan standar internasional dan inovasi berkelanjutan.
            </p>
          </div>

          <!-- Mission Card -->
          <div class="mission-card bg-gradient-to-br from-green-50 via-white to-green-50 shadow-xl rounded-3xl p-8 transform hover:scale-105 transition-all duration-500 border border-green-100" style="animation-delay: 0.2s">
            <div class="flex items-center mb-6">
              <div class="w-12 h-12 bg-green-600 rounded-2xl flex items-center justify-center mr-4 animate-bounce-in">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
              </div>
              <h3 class="text-3xl font-bold text-gray-800">Misi</h3>
            </div>
            <ul class="space-y-4 text-gray-700">
              <li class="flex items-start text-lg">
                <span class="w-2 h-2 bg-green-500 rounded-full mr-3 mt-3 flex-shrink-0"></span>
                <span>Mengidentifikasi dan menganalisis risiko yang dapat memengaruhi pencapaian tujuan organisasi di seluruh tingkat kegiatan dan proses bisnis.</span>
              </li>
              <li class="flex items-start text-lg">
                <span class="w-2 h-2 bg-green-500 rounded-full mr-3 mt-3 flex-shrink-0"></span>
                <span>Mengembangkan kebijakan, prosedur, dan kerangka kerja manajemen risiko yang selaras dengan strategi dan tata kelola organisasi.</span>
              </li>
              <li class="flex items-start text-lg">
                <span class="w-2 h-2 bg-green-500 rounded-full mr-3 mt-3 flex-shrink-0"></span>
                <span>Melakukan pemantauan dan evaluasi berkala terhadap profil risiko, efektivitas pengendalian, serta kepatuhan terhadap peraturan dan kebijakan internal.</span>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </section>

    <!-- Statistics Section -->
    <section class="py-16 bg-gradient-to-br from-gray-50 to-gray-100">
      <div class="container mx-auto px-6">
        <div class="text-center mb-12">
          <h2 class="text-4xl font-bold text-gray-800 mb-4 animate-slide-in-up">Statistik Risiko</h2>
          <p class="text-xl text-gray-600 animate-slide-in-up" style="animation-delay: 0.2s">
            Capaian dan kinerja sistem manajemen risiko kami
          </p>
        </div>

        <div class="grid md:grid-cols-3 gap-8 max-w-5xl mx-auto">
          <!-- Workers Statistics -->
          <div class="stats-card bg-white shadow-xl rounded-3xl p-8 text-center transform hover:scale-105 transition-all duration-500 border-t-4 border-blue-500">
            <div class="w-20 h-20 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center mx-auto mb-6 animate-bounce-in shadow-lg">
              <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m3 5.197v1z"/>
              </svg>
            </div>
            <p class="text-6xl font-bold text-blue-600 mb-4 counter-number">{{ counters.pekerja.toLocaleString() }}</p>
            <p class="text-gray-600 font-semibold text-lg">Pekerja Terlibat</p>
            <p class="text-gray-500 text-sm mt-2">Aktif dalam program Risk Culture</p>
          </div>

          <!-- Incidents Statistics -->
          <div class="stats-card bg-white shadow-xl rounded-3xl p-8 text-center transform hover:scale-105 transition-all duration-500 border-t-4 border-green-500" style="animation-delay: 0.2s">
            <div class="w-20 h-20 bg-gradient-to-br from-green-400 to-green-600 rounded-full flex items-center justify-center mx-auto mb-6 animate-bounce-in shadow-lg">
              <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
              </svg>
            </div>
            <p class="text-6xl font-bold text-green-600 mb-4 counter-number">{{ counters.insiden.toLocaleString() }}</p>
            <p class="text-gray-600 font-semibold text-lg">Insiden Ditangani</p>
            <p class="text-gray-500 text-sm mt-2">Resolusi cepat & efektif</p>
          </div>

          <!-- Training Statistics -->
          <div class="stats-card bg-white shadow-xl rounded-3xl p-8 text-center transform hover:scale-105 transition-all duration-500 border-t-4 border-yellow-500" style="animation-delay: 0.4s">
            <div class="w-20 h-20 bg-gradient-to-br from-yellow-400 to-yellow-600 rounded-full flex items-center justify-center mx-auto mb-6 animate-bounce-in shadow-lg">
              <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
              </svg>
            </div>
            <p class="text-6xl font-bold text-yellow-600 mb-4 counter-number">{{ counters.pelatihan.toLocaleString() }}</p>
            <p class="text-gray-600 font-semibold text-lg">Sosialisasi Risk Management</p>
            <p class="text-gray-500 text-sm mt-2">Program edukasi berkualitas</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Organizational Structure Section -->
    <section class="py-16 bg-white">
      <div class="container mx-auto px-6">
        <div class="max-w-6xl mx-auto">
          <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-gray-800 mb-4 animate-slide-in-up">Struktur Organisasi</h2>
            <p class="text-xl text-gray-600 animate-slide-in-up" style="animation-delay: 0.2s">
              Tim profesional yang berdedikasi untuk keselamatan kerja
            </p>
          </div>

          <div class="org-card bg-white shadow-xl rounded-3xl p-8 md:p-12 transform hover:scale-105 transition-all duration-500 animate-slide-in-up" style="animation-delay: 0.4s">
            <div class="flex items-center mb-8">
              <div class="w-16 h-16 bg-purple-100 rounded-2xl flex items-center justify-center mr-6 animate-bounce-in">
                <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
              </div>
              <div>
                <h3 class="text-3xl font-bold text-gray-800 mb-2">Tim Manajemen</h3>
                <p class="text-gray-600">Struktur organisasi yang terkoordinasi dengan baik</p>
              </div>
            </div>
            
            <p class="text-gray-600 mb-8 text-lg leading-relaxed">
              Struktur organisasi SRM terdiri dari berbagai divisi yang saling berkoordinasi demi kelancaran 
              penerapan manajemen risiko dengan standar internasional dan praktik terbaik industri.
            </p>
            
            <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-2xl p-6 border-2 border-dashed border-gray-200 hover:border-blue-300 transition-colors duration-300">
              <img 
                src="/images/struktur.png" 
                alt="Struktur Organisasi SRM" 
                class="rounded-xl shadow-lg w-full object-contain max-h-96 mx-auto hover:scale-105 transition-transform duration-300"
                loading="lazy"
              >
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Features Highlight Section -->
    <section class="py-16 bg-gradient-to-br from-blue-50 to-indigo-50">
      <div class="container mx-auto px-6">
        <div class="text-center mb-12">
          <h2 class="text-4xl font-bold text-gray-800 mb-4 animate-slide-in-up">Keunggulan SRM</h2>
          <p class="text-xl text-gray-600 animate-slide-in-up" style="animation-delay: 0.2s">
            Fitur-fitur unggulan yang mendukung keselamatan kerja optimal
          </p>
        </div>

        <div class="grid md:grid-cols-3 gap-8 max-w-6xl mx-auto">
          <!-- Real-time Monitoring -->
          <div class="feature-card bg-white rounded-2xl shadow-lg p-8 text-center transform hover:scale-105 transition-all duration-300">
            <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-6 animate-bounce-in">
              <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
              </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-800 mb-4">Monitoring Real-time</h3>
            <p class="text-gray-600 leading-relaxed">Pemantauan kondisi keselamatan secara langsung dan berkelanjutan</p>
          </div>

          <!-- Digital Reporting -->
          <div class="feature-card bg-white rounded-2xl shadow-lg p-8 text-center transform hover:scale-105 transition-all duration-300" style="animation-delay: 0.2s">
            <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6 animate-bounce-in">
              <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
              </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-800 mb-4">Pelaporan Digital</h3>
            <p class="text-gray-600 leading-relaxed">Sistem pelaporan insiden yang cepat, akurat, dan terintegrasi</p>
          </div>

          <!-- Analytics Dashboard -->
          <div class="feature-card bg-white rounded-2xl shadow-lg p-8 text-center transform hover:scale-105 transition-all duration-300" style="animation-delay: 0.4s">
            <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-6 animate-bounce-in">
              <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
              </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-800 mb-4">Analytics Dashboard</h3>
            <p class="text-gray-600 leading-relaxed">Dashboard analitik untuk insight mendalam dan pengambilan keputusan</p>
          </div>
        </div>
      </div>
    </section>
  </MainLayout>
</template>

<script setup>
import { reactive, onMounted } from 'vue'
import MainLayout from '@/Layouts/MainLayout.vue'

// Reactive data for counters
const counters = reactive({
  pekerja: 0,
  insiden: 0,
  pelatihan: 0
})

// Counter animation function
const animateCounter = (key, target, duration = 2500) => {
  let startValue = 0
  const increment = target / (duration / 16) // 60fps
  
  const counter = setInterval(() => {
    startValue += increment
    if (startValue >= target) {
      counters[key] = target
      clearInterval(counter)
    } else {
      counters[key] = Math.floor(startValue)
    }
  }, 16)
}

// Initialize counters on component mount
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
        
        // Trigger counter animation when stats section is visible
        if (entry.target.classList.contains('stats-card')) {
          setTimeout(() => animateCounter('pekerja', 350), 100);
          setTimeout(() => animateCounter('insiden', 120), 300);
          setTimeout(() => animateCounter('pelatihan', 45), 500);
        }
      }
    });
  }, observerOptions);

  // Observe semua elemen dengan class animasi
  document.querySelectorAll('.stats-card, .about-card, .vision-card, .mission-card, .org-card, .feature-card, .animate-slide-in-up').forEach(el => {
    observer.observe(el);
  });
})
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

@keyframes counterAnimation {
  from {
    transform: scale(1.2);
    opacity: 0.5;
  }
  to {
    transform: scale(1);
    opacity: 1;
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

/* Cards */
.about-card,
.vision-card,
.mission-card,
.stats-card,
.org-card,
.feature-card {
  opacity: 0;
  transform: translateY(50px) scale(0.95);
  transition: all 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
}

.about-card.animate-visible,
.vision-card.animate-visible,
.mission-card.animate-visible,
.stats-card.animate-visible,
.org-card.animate-visible,
.feature-card.animate-visible {
  opacity: 1;
  transform: translateY(0) scale(1);
}

/* Hover effects */
.about-card:hover,
.vision-card:hover,
.mission-card:hover,
.org-card:hover {
  transform: translateY(-10px) scale(1.02);
  box-shadow: 0 25px 50px rgba(0,0,0,0.15);
}

.stats-card:hover {
  transform: translateY(-15px) scale(1.05);
  box-shadow: 0 30px 60px rgba(0,0,0,0.2);
}

.feature-card:hover {
  transform: translateY(-8px) scale(1.02);
  box-shadow: 0 20px 40px rgba(0,0,0,0.12);
}

/* Counter number animation */
.counter-number {
  animation: counterAnimation 0.5s ease-out;
}

/* Gradient text effects */
.stats-card .counter-number {
  background: linear-gradient(45deg, currentColor, rgba(0,0,0,0.8));
  -webkit-background-clip: text;
  background-clip: text;
}

/* Responsive adjustments */
@media (max-width: 768px) {
  .animate-fade-in-up,
  .animate-slide-in-up {
    animation-delay: 0s !important;
  }
  
  .about-card,
  .vision-card,
  .mission-card,
  .stats-card,
  .org-card,
  .feature-card {
    animation-delay: 0s !important;
  }
}

/* Performance optimizations */
.about-card,
.vision-card,
.mission-card,
.stats-card,
.org-card,
.feature-card,
.animate-slide-in-up {
  will-change: transform, opacity;
}

/* Custom scrollbar */
::-webkit-scrollbar {
  width: 8px;
}

::-webkit-scrollbar-track {
  background: #f1f1f1;
  border-radius: 4px;
}

::-webkit-scrollbar-thumb {
  background: linear-gradient(to bottom, #3b82f6, #1d4ed8);
  border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
  background: linear-gradient(to bottom, #1d4ed8, #1e40af);
}

/* Loading states untuk images */
img {
  transition: all 0.3s ease;
}

img:hover {
  filter: brightness(1.05);
}
</style>