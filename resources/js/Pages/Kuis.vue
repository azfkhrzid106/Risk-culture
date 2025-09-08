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
          Kuis <span class="text-yellow-400">K3</span>
        </h1>
        <p class="text-xl md:text-2xl mb-8 animate-fade-in-up opacity-90" style="animation-delay: 0.3s">
          Uji Pengetahuan Keselamatan dan Kesehatan Kerja Anda
        </p>
        <div class="w-24 h-1 bg-yellow-400 mx-auto animate-scale-in" style="animation-delay: 0.6s"></div>
      </div>
    </section>

    <!-- Quiz Stats Section -->
    <section class="py-16 bg-gray-50" v-if="!quizStarted && !showResults">
      <div class="container mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
          <!-- Total Questions Card -->
          <div class="stats-card bg-white rounded-2xl shadow-lg p-8 text-center transform hover:scale-105 transition-all duration-300">
            <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-6 animate-bounce-in">
              <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12c0 4.418-3.582 8-8 8s-8-3.582-8-8 3.582-8 8-8 8 3.582 8 8z"></path>
              </svg>
            </div>
            <h3 class="text-2xl font-bold text-gray-800 mb-2">{{ questions.length }}</h3>
            <p class="text-gray-600">Total Pertanyaan</p>
          </div>

          <!-- Duration Card -->
          <div class="stats-card bg-white rounded-2xl shadow-lg p-8 text-center transform hover:scale-105 transition-all duration-300" style="animation-delay: 0.2s">
            <div class="w-16 h-16 bg-green-600 rounded-full flex items-center justify-center mx-auto mb-6 animate-bounce-in">
              <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3c0 4.418-3.582 8-8 8s-8-3.582-8-8 3.582-8 8-8 8 3.582 8 8z"></path>
              </svg>
            </div>
            <h3 class="text-2xl font-bold text-gray-800 mb-2">15</h3>
            <p class="text-gray-600">Menit Durasi</p>
          </div>

          <!-- Difficulty Card -->
          <div class="stats-card bg-white rounded-2xl shadow-lg p-8 text-center transform hover:scale-105 transition-all duration-300" style="animation-delay: 0.4s">
            <div class="w-16 h-16 bg-purple-600 rounded-full flex items-center justify-center mx-auto mb-6 animate-bounce-in">
              <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
              </svg>
            </div>
            <h3 class="text-2xl font-bold text-gray-800 mb-2">Menengah</h3>
            <p class="text-gray-600">Tingkat Kesulitan</p>
          </div>
        </div>

        <!-- Start Quiz Section -->
        <div class="text-center">
          <div class="max-w-2xl mx-auto mb-8">
            <h2 class="text-4xl font-bold text-gray-800 mb-6 animate-slide-in-up">Siap Memulai Kuis?</h2>
            <p class="text-lg text-gray-600 mb-8 animate-slide-in-up" style="animation-delay: 0.2s">
              Kuis ini akan menguji pemahaman Anda tentang keselamatan dan kesehatan kerja. 
              Pastikan Anda sudah siap sebelum memulai!
            </p>
            <div class="bg-blue-50 rounded-2xl p-6 mb-8 border border-blue-200">
              <h3 class="text-xl font-semibold text-blue-800 mb-4">Petunjuk Kuis:</h3>
              <ul class="text-left text-blue-700 space-y-2">
                <li class="flex items-center">
                  <svg class="w-5 h-5 mr-2 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                  </svg>
                  Pilih satu jawaban yang paling tepat untuk setiap pertanyaan
                </li>
                <li class="flex items-center">
                  <svg class="w-5 h-5 mr-2 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                  </svg>
                  Kuis terdiri dari {{ questions.length }} pertanyaan pilihan ganda
                </li>
                <li class="flex items-center">
                  <svg class="w-5 h-5 mr-2 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                  </svg>
                  Waktu yang tersedia adalah 15 menit
                </li>
                <li class="flex items-center">
                  <svg class="w-5 h-5 mr-2 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                  </svg>
                  Hasil akan ditampilkan setelah kuis selesai
                </li>
              </ul>
            </div>
          </div>
          
          <button 
            @click="startQuiz"
            class="start-btn bg-gradient-to-r from-blue-600 to-blue-700 text-white px-12 py-4 rounded-xl font-bold text-xl shadow-lg transform hover:scale-105 transition-all duration-300 hover:shadow-2xl animate-slide-in-up"
            style="animation-delay: 0.4s"
          >
            <span class="flex items-center justify-center">
              <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h1m4 0h1m-6 4h.01M21 12c0 4.418-3.582 8-8 8s-8-3.582-8-8 3.582-8 8-8 8 3.582 8 8z"></path>
              </svg>
              Mulai Kuis
            </span>
          </button>
        </div>
      </div>
    </section>

    <!-- Quiz Section -->
    <section class="py-16 bg-white" v-if="quizStarted && !showResults">
      <div class="container mx-auto px-6">
        <div class="max-w-4xl mx-auto">
          <!-- Quiz Header -->
          <div class="bg-gradient-to-r from-blue-50 to-blue-100 rounded-2xl p-6 mb-8 shadow-lg">
            <div class="flex justify-between items-center">
              <div>
                <h2 class="text-2xl font-bold text-gray-800">Pertanyaan {{ currentQuestionIndex + 1 }} dari {{ questions.length }}</h2>
                <div class="w-full bg-gray-200 rounded-full h-2 mt-3">
                  <div 
                    class="bg-blue-600 h-2 rounded-full transition-all duration-300" 
                    :style="`width: ${((currentQuestionIndex + 1) / questions.length) * 100}%`"
                  ></div>
                </div>
              </div>
              <div class="text-right">
                <div class="text-3xl font-bold text-blue-600">{{ formatTime(timeLeft) }}</div>
                <div class="text-sm text-gray-600">Waktu tersisa</div>
              </div>
            </div>
          </div>

          <!-- Current Question -->
          <div v-if="currentQuestion" class="quiz-card bg-white rounded-3xl shadow-xl p-8 md:p-12 transform hover:scale-105 transition-all duration-300">
            <h3 class="text-2xl font-bold text-gray-800 mb-8 leading-relaxed">
              {{ currentQuestion.question }}
            </h3>

            <!-- Answer Options -->
            <div class="space-y-4">
              <div 
                v-for="(option, index) in currentQuestion.options" 
                :key="index"
                class="option-card cursor-pointer p-4 rounded-xl border-2 transition-all duration-300 hover:shadow-lg"
                :class="selectedAnswer === index ? 'border-blue-500 bg-blue-50' : 'border-gray-200 hover:border-blue-300'"
                @click="selectAnswer(index)"
              >
                <div class="flex items-center">
                  <div class="w-8 h-8 rounded-full border-2 flex items-center justify-center mr-4 transition-all duration-300"
                       :class="selectedAnswer === index ? 'border-blue-500 bg-blue-500' : 'border-gray-300'">
                    <div v-if="selectedAnswer === index" class="w-3 h-3 bg-white rounded-full"></div>
                  </div>
                  <span class="text-lg text-gray-700">{{ option }}</span>
                </div>
              </div>
            </div>

            <!-- Navigation Buttons -->
            <div class="flex justify-between mt-8">
              <button 
                @click="previousQuestion"
                :disabled="currentQuestionIndex === 0"
                class="nav-btn bg-gray-500 text-white px-6 py-3 rounded-xl font-semibold transition-all duration-300 hover:bg-gray-600 disabled:opacity-50 disabled:cursor-not-allowed"
              >
                <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Sebelumnya
              </button>

              <button 
                @click="nextQuestion"
                :disabled="selectedAnswer === null"
                class="nav-btn bg-blue-600 text-white px-6 py-3 rounded-xl font-semibold transition-all duration-300 hover:bg-blue-700 disabled:opacity-50 disabled:cursor-not-allowed"
              >
                {{ currentQuestionIndex === questions.length - 1 ? 'Selesai' : 'Selanjutnya' }}
                <svg class="w-5 h-5 ml-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
              </button>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Results Section -->
    <section class="py-16 bg-gradient-to-br from-gray-50 to-gray-100" v-if="showResults">
      <div class="container mx-auto px-6">
        <div class="max-w-4xl mx-auto text-center">
          <!-- Results Header -->
          <div class="mb-12">
            <div class="w-24 h-24 mx-auto mb-6 rounded-full flex items-center justify-center animate-bounce-in"
                 :class="getScoreColor(score).bg">
              <svg class="w-12 h-12" :class="getScoreColor(score).text" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" :d="getScoreIcon(score)"></path>
              </svg>
            </div>
            <h2 class="text-4xl font-bold text-gray-800 mb-4">Hasil Kuis Anda</h2>
            <p class="text-xl text-gray-600">{{ getScoreMessage(score) }}</p>
          </div>

          <!-- Score Display -->
          <div class="results-card bg-white rounded-3xl shadow-xl p-8 md:p-12 mb-8">
            <div class="grid md:grid-cols-3 gap-8">
              <!-- Score -->
              <div class="text-center">
                <div class="text-6xl font-bold mb-2" :class="getScoreColor(score).text">{{ score }}%</div>
                <p class="text-gray-600 font-semibold">Skor Akhir</p>
              </div>

              <!-- Correct Answers -->
              <div class="text-center">
                <div class="text-6xl font-bold text-green-600 mb-2">{{ correctAnswers }}</div>
                <p class="text-gray-600 font-semibold">Jawaban Benar</p>
              </div>

              <!-- Wrong Answers -->
              <div class="text-center">
                <div class="text-6xl font-bold text-red-500 mb-2">{{ questions.length - correctAnswers }}</div>
                <p class="text-gray-600 font-semibold">Jawaban Salah</p>
              </div>
            </div>

            <!-- Performance Analysis -->
            <div class="mt-8 p-6 rounded-2xl" :class="getScoreColor(score).bg">
              <h3 class="text-2xl font-bold mb-4" :class="getScoreColor(score).text">Analisis Performa</h3>
              <p class="text-lg" :class="getScoreColor(score).text">{{ getDetailedFeedback(score) }}</p>
            </div>
          </div>

          <!-- Action Buttons -->
          <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <button 
              @click="restartQuiz"
              class="action-btn bg-blue-600 text-white px-8 py-4 rounded-xl font-bold text-lg shadow-lg transform hover:scale-105 transition-all duration-300 hover:shadow-2xl"
            >
              <svg class="w-6 h-6 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
              </svg>
              Ulangi Kuis
            </button>
            
            <button 
              class="action-btn bg-green-600 text-white px-8 py-4 rounded-xl font-bold text-lg shadow-lg transform hover:scale-105 transition-all duration-300 hover:shadow-2xl"
            >
              <svg class="w-6 h-6 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"></path>
              </svg>
              Bagikan Hasil
            </button>
          </div>
        </div>
      </div>
    </section>
  </MainLayout>
</template>

<script setup>
import { ref, reactive, onMounted, onUnmounted } from 'vue'
import MainLayout from '@/Layouts/MainLayout.vue'

// Quiz state
const quizStarted = ref(false)
const showResults = ref(false)
const currentQuestionIndex = ref(0)
const selectedAnswer = ref(null)
const userAnswers = ref([])
const timeLeft = ref(900) // 15 minutes in seconds
const timer = ref(null)

// Quiz data
const questions = ref([
  {
    question: "Apa kepanjangan dari K3?",
    options: [
      "Keamanan, Kesehatan, dan Keselamatan",
      "Keselamatan dan Kesehatan Kerja", 
      "Kebersihan, Kesehatan, dan Keamanan",
      "Ketertiban, Keamanan, dan Kesehatan"
    ],
    correct: 1
  },
  {
    question: "Warna apakah yang digunakan untuk tanda peringatan bahaya?",
    options: [
      "Hijau",
      "Biru", 
      "Kuning",
      "Merah"
    ],
    correct: 3
  },
  {
    question: "APD singkatan dari?",
    options: [
      "Alat Pelindung Diri",
      "Alat Pemadam Darurat",
      "Alat Pengaman Dasar",
      "Alat Penyelamat Dini"
    ],
    correct: 0
  },
  {
    question: "Berapa derajat maksimal kemiringan tangga yang aman?",
    options: [
      "60 derajat",
      "75 derajat",
      "90 derajat",
      "45 derajat"
    ],
    correct: 1
  },
  {
    question: "Apa yang harus dilakukan pertama kali saat terjadi kebakaran?",
    options: [
      "Memadamkan api",
      "Menyelamatkan barang berharga",
      "Membunyikan alarm dan mengevakuasi",
      "Memanggil pemadam kebakaran"
    ],
    correct: 2
  }
])

// Computed properties
const currentQuestion = ref(null)
const correctAnswers = ref(0)
const score = ref(0)

// Methods
const startQuiz = () => {
  quizStarted.value = true
  currentQuestionIndex.value = 0
  selectedAnswer.value = null
  userAnswers.value = []
  currentQuestion.value = questions.value[0]
  startTimer()
}

const startTimer = () => {
  timer.value = setInterval(() => {
    if (timeLeft.value > 0) {
      timeLeft.value--
    } else {
      finishQuiz()
    }
  }, 1000)
}

const selectAnswer = (index) => {
  selectedAnswer.value = index
}

const nextQuestion = () => {
  // Save current answer
  userAnswers.value[currentQuestionIndex.value] = selectedAnswer.value

  if (currentQuestionIndex.value === questions.value.length - 1) {
    finishQuiz()
  } else {
    currentQuestionIndex.value++
    currentQuestion.value = questions.value[currentQuestionIndex.value]
    selectedAnswer.value = userAnswers.value[currentQuestionIndex.value] || null
  }
}

const previousQuestion = () => {
  // Save current answer
  userAnswers.value[currentQuestionIndex.value] = selectedAnswer.value

  if (currentQuestionIndex.value > 0) {
    currentQuestionIndex.value--
    currentQuestion.value = questions.value[currentQuestionIndex.value]
    selectedAnswer.value = userAnswers.value[currentQuestionIndex.value] || null
  }
}

const finishQuiz = () => {
  // Save final answer
  if (selectedAnswer.value !== null) {
    userAnswers.value[currentQuestionIndex.value] = selectedAnswer.value
  }

  // Calculate results
  correctAnswers.value = 0
  userAnswers.value.forEach((answer, index) => {
    if (answer === questions.value[index].correct) {
      correctAnswers.value++
    }
  })

  score.value = Math.round((correctAnswers.value / questions.value.length) * 100)

  // Clear timer
  if (timer.value) {
    clearInterval(timer.value)
  }

  // Show results
  quizStarted.value = false
  showResults.value = true
}

const restartQuiz = () => {
  showResults.value = false
  quizStarted.value = false
  currentQuestionIndex.value = 0
  selectedAnswer.value = null
  userAnswers.value = []
  timeLeft.value = 900
  correctAnswers.value = 0
  score.value = 0
  
  if (timer.value) {
    clearInterval(timer.value)
  }
}

const formatTime = (seconds) => {
  const mins = Math.floor(seconds / 60)
  const secs = seconds % 60
  return `${mins.toString().padStart(2, '0')}:${secs.toString().padStart(2, '0')}`
}

const getScoreColor = (score) => {
  if (score >= 80) return { bg: 'bg-green-100', text: 'text-green-600' }
  if (score >= 60) return { bg: 'bg-yellow-100', text: 'text-yellow-600' }
  return { bg: 'bg-red-100', text: 'text-red-600' }
}

const getScoreIcon = (score) => {
  if (score >= 80) return "M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
  if (score >= 60) return "M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5l-6.928-12c-.77-.833-2.02-.833-2.79 0l-6.928 12c-.77.833.192 2.5 1.732 2.5z"
  return "M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2c0 4.418-3.582 8-8 8s-8-3.582-8-8 3.582-8 8-8 8 3.582 8 8z"
}

const getScoreMessage = (score) => {
  if (score >= 80) return "Luar Biasa! Pengetahuan K3 Anda sangat baik!"
  if (score >= 60) return "Bagus! Masih ada room untuk improvement."
  return "Perlu Belajar Lagi. Jangan menyerah!"
}

const getDetailedFeedback = (score) => {
  if (score >= 80) {
    return "Anda memiliki pemahaman yang excellent tentang K3. Terus pertahankan dan terapkan pengetahuan ini di tempat kerja untuk menciptakan lingkungan yang lebih aman."
  }
  if (score >= 60) {
    return "Pemahaman K3 Anda cukup baik, namun masih ada beberapa area yang perlu diperbaiki. Pelajari kembali materi yang belum dikuasai untuk meningkatkan skor."
  }
  return "Pemahaman K3 Anda masih perlu ditingkatkan. Disarankan untuk mempelajari kembali materi K3 secara menyeluruh dan mengikuti pelatihan tambahan."
}

onMounted(() => {
  // Initialize intersection observer for animations
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

  // Observe elements
  setTimeout(() => {
    document.querySelectorAll('.stats-card, .quiz-card, .results-card, .animate-slide-in-up').forEach(el => {
      observer.observe(el);
    });
  }, 100);
})

onUnmounted(() => {
  if (timer.value) {
    clearInterval(timer.value)
  }
})
</script>

<style scoped>
/* Animasi keyframes - sama dengan file sebelumnya */
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

/* Cards Animation */
.stats-card,
.quiz-card,
.results-card {
  opacity: 0;
  transform: translateY(50px) scale(0.95);
  transition: all 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
}

.stats-card.animate-visible,
.quiz-card.animate-visible,
.results-card.animate-visible {
  opacity: 1;
  transform: translateY(0) scale(1);
}

/* Hover Effects */
.stats-card:hover {
  transform: translateY(-10px) scale(1.02);
  box-shadow: 0 25px 50px rgba(0,0,0,0.15);
}

.quiz-card:hover {
  transform: translateY(-5px) scale(1.01);
  box-shadow: 0 30px 60px rgba(0,0,0,0.15);
}

.results-card:hover {
  transform: translateY(-8px) scale(1.02);
  box-shadow: 0 25px 50px rgba(0,0,0,0.12);
}

/* Button Styles */
.start-btn:hover,
.action-btn:hover {
  background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
  transform: translateY(-2px) scale(1.05);
  box-shadow: 0 15px 30px rgba(59, 130, 246, 0.4);
}

.nav-btn:hover:not(:disabled) {
  transform: translateY(-2px);
  box-shadow: 0 8px 20px rgba(0,0,0,0.2);
}

/* Option Cards */
.option-card {
  position: relative;
  overflow: hidden;
}

.option-card::before {
  content: '';
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, transparent, rgba(59, 130, 246, 0.1), transparent);
  transition: left 0.5s;
}

.option-card:hover::before {
  left: 100%;
}

/* Timer Animation */
.timer-warning {
  animation: pulse 1s infinite;
  color: #ef4444 !important;
}

/* Progress Bar Animation */
.progress-bar {
  transition: width 0.3s ease-in-out;
  background: linear-gradient(90deg, #3b82f6, #1d4ed8);
}

/* Score Display Animation */
.score-display {
  animation: bounceIn 1s ease-out;
}

/* Responsive Design */
@media (max-width: 768px) {
  .animate-fade-in-up,
  .animate-slide-in-up {
    animation-delay: 0s !important;
  }
  
  .stats-card,
  .quiz-card,
  .results-card {
    animation-delay: 0s !important;
  }

  .quiz-card,
  .results-card {
    padding: 1.5rem !important;
  }

  .option-card {
    padding: 1rem !important;
  }
}

/* Performance Optimizations */
.stats-card,
.quiz-card,
.results-card,
.option-card,
.animate-slide-in-up {
  will-change: transform, opacity;
}

/* Loading State */
.loading {
  opacity: 0.6;
  pointer-events: none;
}

/* Success/Error States */
.success-state {
  border-color: #10b981 !important;
  background-color: #ecfdf5 !important;
}

.error-state {
  border-color: #ef4444 !important;
  background-color: #fef2f2 !important;
}

/* Custom Scrollbar */
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

/* Print Styles */
@media print {
  .floating-shape,
  .start-btn,
  .nav-btn,
  .action-btn {
    display: none !important;
  }
  
  .quiz-card,
  .results-card {
    box-shadow: none !important;
    border: 1px solid #e5e7eb !important;
  }
}

/* High Contrast Mode Support */
@media (prefers-contrast: high) {
  .option-card {
    border-width: 3px !important;
  }
  
  .stats-card,
  .quiz-card,
  .results-card {
    border: 2px solid #374151 !important;
  }
}

/* Reduced Motion Support */
@media (prefers-reduced-motion: reduce) {
  .animate-fade-in-up,
  .animate-slide-in-up,
  .animate-scale-in,
  .animate-bounce-in,
  .floating-shape {
    animation: none !important;
    opacity: 1 !important;
    transform: none !important;
  }
  
  .stats-card,
  .quiz-card,
  .results-card,
  .option-card {
    transition: none !important;
  }
}

/* Focus States for Accessibility */
.option-card:focus,
.start-btn:focus,
.nav-btn:focus,
.action-btn:focus {
  outline: 3px solid #3b82f6;
  outline-offset: 2px;
}

/* Dark Mode Support (jika diperlukan nanti) */
@media (prefers-color-scheme: dark) {
  /* Dark mode styles bisa ditambahkan di sini */
}
</style>