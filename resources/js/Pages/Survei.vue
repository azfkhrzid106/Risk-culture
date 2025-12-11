<template>
  <MainLayout>
    <div class="survey-container">
      <!-- Header Section -->
      <div class="survey-header">
        <div class="header-left">
          <h1 class="survey-title">
            Executive Summary - <span class="highlight">Risk Culture Survey</span> 2023 - INALUM
          </h1>
        </div>
        <div class="header-right">
          <div class="mindid-logo"></div>
        </div>
      </div>

      <!-- Main Dashboard -->
      <div class="dashboard-grid">
        <!-- Left Panel: Statistics -->
        <div class="stats-panel">
          <!-- Header Icon -->
          <div class="stats-header">
            <div class="header-icon">
              <svg width="60" height="60" viewBox="0 0 24 24" fill="none">
                <path d="M9 11l3 3L22 4" stroke="#10b981" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11" stroke="#3b82f6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
            </div>
            <h2 class="stats-title">Survey Statistics</h2>
          </div>

          <!-- Statistics Content -->
          <div class="stats-content">
            <div class="stat-item">
              <span class="stat-label">Jumlah Pegawai</span>
              <span class="stat-value">516</span>
            </div>
            <div class="stat-item">
              <span class="stat-label">Target Sampling</span>
              <span class="stat-value">221</span>
            </div>
            <div class="stat-item">
              <span class="stat-label">Jumlah Responden</span>
              <span class="stat-value primary">512</span>
            </div>
            <div class="stat-item">
              <span class="stat-label">Rasio Partisipasi</span>
              <span class="stat-value">231<span class="unit">%</span></span>
            </div>
            <div class="stat-item">
              <span class="stat-label">Responden</span>
              <div class="responden-levels">
                <span class="level">BOD-2</span>
                <span class="level">BOD-3</span>
                <span class="level">BOD-4</span>
              </div>
            </div>
            <div class="stat-result">
              <span class="result-label">Hasil Survey</span>
              <div class="result-badge">
                <span class="result-value">Good</span>
                <span class="result-score">(Weighted Average: 4.85)</span>
              </div>
            </div>
          </div>
        </div>

        <!-- Right Panel: Circular Chart -->
        <div class="diagram-panel">
          <div class="chart-container">
            <Doughnut :data="chartData" :options="chartOptions" />
          </div>
        </div>
      </div>

      <!-- Modal Detail -->
      <div v-if="showModal" class="modal-overlay" @click="closeModal">
        <div class="modal-content" @click.stop>
          <button class="modal-close" @click="closeModal">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
              <path d="M18 6L6 18M6 6l12 12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            </svg>
          </button>
          
          <div class="modal-header">
            <div class="modal-icon">
              <svg width="48" height="48" viewBox="0 0 24 24" fill="none">
                <circle cx="12" cy="12" r="10" stroke="#3b82f6" stroke-width="2"/>
                <path d="M12 6v6l4 2" stroke="#3b82f6" stroke-width="2" stroke-linecap="round"/>
              </svg>
            </div>
            <h3 class="modal-title">Detail Dimensi</h3>
          </div>

          <div class="modal-body">
            <div class="detail-item">
              <span class="detail-label">Nama Dimensi:</span>
              <span class="detail-value">{{ selectedDimension.name }}</span>
            </div>
            <div class="detail-item">
              <span class="detail-label">Kategori:</span>
              <span class="detail-value">{{ selectedDimension.category }}</span>
            </div>
            <div class="detail-item">
              <span class="detail-label">Skor:</span>
              <span class="detail-score" :class="getScoreClass(selectedDimension.score)">
                {{ selectedDimension.score }}
              </span>
            </div>
            <div class="detail-item">
              <span class="detail-label">Status:</span>
              <span class="detail-badge" :class="getStatusClass(selectedDimension.score)">
                {{ getStatus(selectedDimension.score) }}
              </span>
            </div>
            <div class="detail-description">
              <p>{{ selectedDimension.description }}</p>
            </div>
          </div>

          <div class="modal-footer">
            <button class="btn-close-single" @click="closeModal">
              Tutup
            </button>
          </div>
        </div>
      </div>

      <!-- Rating Scale -->
      <div class="rating-scale">
        <div class="scale-item scale-1">
          <div class="scale-number">1</div>
          <div class="scale-label">Review Suggested</div>
        </div>
        <div class="scale-item scale-2">
          <div class="scale-number">2</div>
        </div>
        <div class="scale-item scale-3">
          <div class="scale-number">3.20</div>
          <div class="scale-label">Caution</div>
        </div>
        <div class="scale-item scale-4">
          <div class="scale-number">4.80</div>
          <div class="scale-label">Good</div>
        </div>
        <div class="scale-item scale-5">
          <div class="scale-number">5.59</div>
          <div class="scale-label">Strong</div>
        </div>
        <div class="scale-item scale-6">
          <div class="scale-number">6</div>
        </div>
      </div>
    </div>
  </MainLayout>
</template>

<script setup>
import { ref, computed } from 'vue';
import MainLayout from '@/Layouts/MainLayout.vue';
import { Doughnut } from 'vue-chartjs';
import {
  Chart as ChartJS,
  ArcElement,
  Tooltip,
  Legend
} from 'chart.js';

// Register Chart.js components
ChartJS.register(ArcElement, Tooltip, Legend);

// Modal state
const showModal = ref(false);
const selectedDimension = ref({
  name: '',
  category: '',
  score: 0,
  description: ''
});

// Data dimensi lengkap
const dimensionsData = {
  'Manajemen Kinerja': { category: 'Outer Ring', score: 4.76, description: 'Kemampuan organisasi dalam mengelola dan meningkatkan kinerja karyawan secara efektif.' },
  'Tingkat Pemahaman': { category: 'Outer Ring', score: 4.93, description: 'Tingkat pemahaman karyawan terhadap visi, misi, dan tujuan organisasi.' },
  'Toleransi': { category: 'Outer Ring', score: 4.97, description: 'Kemampuan organisasi dalam menerima perbedaan dan mendorong inklusivitas.' },
  'Komunikasi': { category: 'Outer Ring', score: 4.84, description: 'Efektivitas komunikasi internal dan eksternal dalam organisasi.' },
  'Kepercayaan Diri': { category: 'Outer Ring', score: 4.97, description: 'Tingkat kepercayaan diri karyawan dalam menjalankan tugas dan tanggung jawab.' },
  'Keterbukaan': { category: 'Outer Ring', score: 4.77, description: 'Keterbukaan organisasi terhadap masukan, kritik, dan saran dari karyawan.' },
  'Operational': { category: 'Middle Ring', score: 4.76, description: 'Efektivitas operasional dalam menjalankan proses bisnis sehari-hari.' },
  'Transparency': { category: 'Middle Ring', score: 4.84, description: 'Transparansi dalam pengambilan keputusan dan penyampaian informasi.' },
  'Acknowledgement': { category: 'Middle Ring', score: 4.82, description: 'Pengakuan terhadap kontribusi dan pencapaian karyawan.' },
  'Responsiveness': { category: 'Middle Ring', score: 4.90, description: 'Kecepatan dan ketepatan respon terhadap perubahan dan kebutuhan.' },
  'Respect': { category: 'Inner Ring', score: 4.84, description: 'Rasa hormat dan penghargaan antar karyawan dalam lingkungan kerja.' },
  'Kepatuhan terhadap Aturan': { category: 'Inner Ring', score: 4.96, description: 'Tingkat kepatuhan terhadap aturan, kebijakan, dan prosedur organisasi.' },
  'Kerja sama': { category: 'Inner Ring', score: 4.73, description: 'Kolaborasi dan kerja sama tim dalam mencapai tujuan bersama.' },
  'Kecepatan Respon': { category: 'Inner Ring', score: 5.02, description: 'Kecepatan dalam merespon situasi, masalah, atau peluang yang muncul.' },
  'Tingkat Kesadaran': { category: 'Inner Ring', score: 4.90, description: 'Kesadaran karyawan terhadap risiko dan dampak dari tindakan mereka.' },
  'Memberikan Pendapat': { category: 'Inner Ring', score: 4.71, description: 'Keterbukaan karyawan dalam memberikan pendapat dan ide-ide baru.' }
};

// Functions untuk modal
const closeModal = () => {
  showModal.value = false;
};

const getStatus = (score) => {
  if (score >= 5.59) return 'Strong';
  if (score >= 4.80) return 'Good';
  if (score >= 3.20) return 'Caution';
  return 'Review Suggested';
};

const getScoreClass = (score) => {
  if (score >= 5.59) return 'score-strong';
  if (score >= 4.80) return 'score-good';
  if (score >= 3.20) return 'score-caution';
  return 'score-review';
};

const getStatusClass = (score) => {
  if (score >= 5.59) return 'badge-strong';
  if (score >= 4.80) return 'badge-good';
  if (score >= 3.20) return 'badge-caution';
  return 'badge-review';
};

// Data untuk chart
const chartData = computed(() => ({
  labels: [
    'Manajemen Kinerja',
    'Tingkat Pemahaman', 
    'Toleransi',
    'Komunikasi',
    'Kepercayaan Diri',
    'Keterbukaan',
    'Operational',
    'Transparency',
    'Acknowledgement',
    'Responsiveness',
    'Respect',
    'Kepatuhan terhadap Aturan',
    'Kerja sama',
    'Kecepatan Respon',
    'Tingkat Kesadaran',
    'Memberikan Pendapat'
  ],
  datasets: [
    // Outer Ring
    {
      label: 'Outer Ring',
      data: [4.76, 4.93, 4.97, 4.84, 4.97, 4.77, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
      backgroundColor: [
        '#eab308', // Kuning
        '#84cc16', // Lime
        '#22c55e', // Green
        '#10b981', // Emerald
        '#84cc16', // Lime
        '#eab308', // Kuning
      ],
      borderWidth: 3,
      borderColor: '#ffffff',
      weight: 1,
      spacing: 2
    },
    // Middle Ring
    {
      label: 'Middle Ring',
      data: [0, 0, 0, 0, 0, 0, 4.76, 4.84, 4.82, 4.90, 0, 0, 0, 0, 0, 0],
      backgroundColor: [
        'transparent',
        'transparent',
        'transparent',
        'transparent',
        'transparent',
        'transparent',
        '#fbbf24', // Yellow
        '#a3e635', // Lime
        '#4ade80', // Green
        '#86efac', // Light green
      ],
      borderWidth: 3,
      borderColor: '#ffffff',
      weight: 0.8,
      spacing: 2
    },
    // Inner Ring
    {
      label: 'Inner Ring',
      data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 4.84, 4.96, 4.73, 5.02, 4.90, 4.71],
      backgroundColor: [
        'transparent',
        'transparent',
        'transparent',
        'transparent',
        'transparent',
        'transparent',
        'transparent',
        'transparent',
        'transparent',
        'transparent',
        '#fde047', // Light yellow
        '#bef264', // Lime
        '#86efac', // Green
        '#a3e635', // Lime
        '#fde047', // Yellow
        '#eab308', // Dark yellow
      ],
      borderWidth: 3,
      borderColor: '#ffffff',
      weight: 0.6,
      spacing: 2
    }
  ]
}));

// Konfigurasi chart
const chartOptions = computed(() => ({
  responsive: true,
  maintainAspectRatio: true,
  cutout: '30%',
  plugins: {
    legend: {
      display: false
    },
    tooltip: {
      enabled: true,
      backgroundColor: 'rgba(0, 0, 0, 0.8)',
      padding: 12,
      titleColor: '#ffffff',
      bodyColor: '#ffffff',
      borderColor: '#3b82f6',
      borderWidth: 2,
      displayColors: true,
      callbacks: {
        label: function(context) {
          const label = context.label || '';
          const value = context.parsed || 0;
          if (value > 0) {
            return `${label}: ${value.toFixed(2)}`;
          }
          return null;
        }
      }
    }
  },
  onHover: (event, activeElements) => {
    event.native.target.style.cursor = activeElements.length > 0 ? 'pointer' : 'default';
  },
  onClick: (event, activeElements) => {
    if (activeElements.length > 0) {
      const element = activeElements[0];
      const label = chartData.value.labels[element.index];
      const value = element.element.$context.parsed;
      
      if (value > 0 && dimensionsData[label]) {
        selectedDimension.value = {
          name: label,
          category: dimensionsData[label].category,
          score: dimensionsData[label].score.toFixed(2),
          description: dimensionsData[label].description
        };
        showModal.value = true;
      }
    }
  }
}));
</script>

<style scoped>
.survey-container {
  min-height: 70vh;
  padding: 2rem;
  background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
}

.survey-header {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  margin-bottom: 2rem;
  padding: 1.5rem;
  background: white;
  border-radius: 12px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
}

.survey-title {
  font-size: 1.75rem;
  font-weight: 700;
  color: #1e3a8a;
  line-height: 1.3;
}

.survey-title .highlight {
  font-style: italic;
  color: #3b82f6;
}

.mindid-logo {
  font-size: 1.5rem;
  font-weight: 700;
  color: #dc2626;
  padding: 0.5rem 1rem;
  background: linear-gradient(135deg, #fee2e2, #fecaca);
  border-radius: 8px;
}

.dashboard-grid {
  display: grid;
  grid-template-columns: 1fr 1.5fr;
  gap: 2rem;
  margin-bottom: 2rem;
}

/* Left Panel: Statistics */
.stats-panel {
  background: white;
  border-radius: 16px;
  padding: 2rem;
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
  border: 1px solid #e2e8f0;
}

.stats-header {
  text-align: center;
  margin-bottom: 2rem;
  padding-bottom: 1.5rem;
  border-bottom: 2px solid #e2e8f0;
}

.header-icon {
  width: 80px;
  height: 80px;
  margin: 0 auto 1rem;
  background: linear-gradient(135deg, #dbeafe, #bfdbfe);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  box-shadow: 0 4px 12px rgba(59, 130, 246, 0.2);
}

.stats-title {
  font-size: 1.5rem;
  font-weight: 700;
  color: #1e3a8a;
  margin: 0;
}

.stats-content {
  display: flex;
  flex-direction: column;
  gap: 1rem;
}

.stat-item {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 0.75rem 0;
  border-bottom: 1px dashed #e2e8f0;
}

.stat-label {
  font-size: 0.95rem;
  color: #64748b;
  font-weight: 500;
}

.stat-value {
  font-size: 1.5rem;
  font-weight: 700;
  color: #1e293b;
}

.stat-value.primary {
  color: #3b82f6;
}

.stat-value .unit {
  font-size: 1rem;
  margin-left: 2px;
}

.responden-levels {
  display: flex;
  gap: 0.5rem;
}

.level {
  padding: 0.25rem 0.75rem;
  background: #dbeafe;
  color: #1e40af;
  border-radius: 6px;
  font-size: 0.85rem;
  font-weight: 600;
}

.stat-result {
  margin-top: 1rem;
  padding: 1.5rem;
  background: linear-gradient(135deg, #10b981, #059669);
  border-radius: 12px;
  text-align: center;
}

.result-label {
  display: block;
  font-size: 0.9rem;
  color: rgba(255, 255, 255, 0.9);
  margin-bottom: 0.5rem;
  font-weight: 500;
}

.result-badge {
  display: flex;
  flex-direction: column;
  gap: 0.25rem;
}

.result-value {
  font-size: 2rem;
  font-weight: 800;
  color: white;
}

.result-score {
  font-size: 0.85rem;
  color: rgba(255, 255, 255, 0.9);
}

/* Right Panel: Chart */
.diagram-panel {
  background: white;
  border-radius: 16px;
  padding: 2rem;
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
  border: 1px solid #e2e8f0;
  display: flex;
  align-items: center;
  justify-content: center;
}

.chart-container {
  width: 100%;
  max-width: 500px;
  position: relative;
}

/* Rating Scale */
.rating-scale {
  display: grid;
  grid-template-columns: repeat(6, 1fr);
  background: white;
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
  border: 1px solid #e2e8f0;
}

.scale-item {
  padding: 1.5rem 1rem;
  text-align: center;
  position: relative;
  transition: transform 0.3s ease;
}

.scale-item:hover {
  transform: translateY(-2px);
}

.scale-1 {
  background: linear-gradient(180deg, #dc2626, #b91c1c);
  color: white;
}

.scale-2 {
  background: linear-gradient(180deg, #ea580c, #c2410c);
  color: white;
}

.scale-3 {
  background: linear-gradient(180deg, #eab308, #ca8a04);
  color: white;
}

.scale-4 {
  background: linear-gradient(180deg, #84cc16, #65a30d);
  color: white;
}

.scale-5 {
  background: linear-gradient(180deg, #3b82f6, #2563eb);
  color: white;
}

.scale-6 {
  background: linear-gradient(180deg, #6366f1, #4f46e5);
  color: white;
}

.scale-number {
  font-size: 1.25rem;
  font-weight: 700;
  margin-bottom: 0.5rem;
}

.scale-label {
  font-size: 0.9rem;
  font-weight: 600;
  opacity: 0.95;
}

/* Responsive */
@media (max-width: 1200px) {
  .dashboard-grid {
    grid-template-columns: 1fr;
  }
}

@media (max-width: 768px) {
  .survey-container {
    padding: 1rem;
  }
  
  .survey-header {
    flex-direction: column;
    gap: 1rem;
  }
  
  .survey-title {
    font-size: 1.5rem;
  }
  
  .dashboard-grid {
    gap: 1rem;
  }
  
  .stats-panel,
  .diagram-panel {
    padding: 1.5rem;
  }
  
  .stats-title {
    font-size: 1.25rem;
  }
  
  .header-icon {
    width: 60px;
    height: 60px;
  }
  
  .header-icon svg {
    width: 40px;
    height: 40px;
  }
  
  .stat-value {
    font-size: 1.25rem;
  }
  
  .rating-scale {
    grid-template-columns: repeat(3, 1fr);
  }
  
  .scale-item {
    padding: 1rem 0.5rem;
  }
  
  .scale-number {
    font-size: 1rem;
  }
  
  .scale-label {
    font-size: 0.75rem;
  }
}

@media (max-width: 480px) {
  .survey-title {
    font-size: 1.25rem;
  }
  
  .stats-title {
    font-size: 1.1rem;
  }
  
  .rating-scale {
    grid-template-columns: repeat(2, 1fr);
  }
}

/* Modal Styles */
.modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba(0, 0, 0, 0.6);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 1000;
  backdrop-filter: blur(4px);
  animation: fadeIn 0.2s ease;
}

@keyframes fadeIn {
  from { opacity: 0; }
  to { opacity: 1; }
}

.modal-content {
  background: white;
  border-radius: 16px;
  width: 90%;
  max-width: 500px;
  box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
  position: relative;
  animation: slideUp 0.3s ease;
  max-height: 90vh;
  overflow-y: auto;
}

@keyframes slideUp {
  from {
    transform: translateY(20px);
    opacity: 0;
  }
  to {
    transform: translateY(0);
    opacity: 1;
  }
}

.modal-close {
  position: absolute;
  top: 1rem;
  right: 1rem;
  background: #f1f5f9;
  border: none;
  border-radius: 8px;
  width: 36px;
  height: 36px;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition: all 0.2s ease;
  color: #64748b;
}

.modal-close:hover {
  background: #e2e8f0;
  color: #1e293b;
  transform: rotate(90deg);
}

.modal-header {
  text-align: center;
  padding: 2rem 2rem 1rem;
  border-bottom: 2px solid #e2e8f0;
}

.modal-icon {
  width: 80px;
  height: 80px;
  margin: 0 auto 1rem;
  background: linear-gradient(135deg, #dbeafe, #bfdbfe);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  animation: pulse 2s infinite;
}

@keyframes pulse {
  0%, 100% {
    transform: scale(1);
    box-shadow: 0 4px 12px rgba(59, 130, 246, 0.2);
  }
  50% {
    transform: scale(1.05);
    box-shadow: 0 8px 24px rgba(59, 130, 246, 0.3);
  }
}

.modal-title {
  font-size: 1.75rem;
  font-weight: 700;
  color: #1e3a8a;
  margin: 0;
}

.modal-body {
  padding: 2rem;
}

.detail-item {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 1rem 0;
  border-bottom: 1px dashed #e2e8f0;
}

.detail-item:last-of-type {
  border-bottom: none;
}

.detail-label {
  font-size: 0.95rem;
  color: #64748b;
  font-weight: 600;
}

.detail-value {
  font-size: 1.1rem;
  font-weight: 700;
  color: #1e293b;
}

.detail-score {
  font-size: 2rem;
  font-weight: 800;
  padding: 0.5rem 1rem;
  border-radius: 8px;
}

.score-strong {
  background: linear-gradient(135deg, #3b82f6, #2563eb);
  color: white;
}

.score-good {
  background: linear-gradient(135deg, #84cc16, #65a30d);
  color: white;
}

.score-caution {
  background: linear-gradient(135deg, #eab308, #ca8a04);
  color: white;
}

.score-review {
  background: linear-gradient(135deg, #dc2626, #b91c1c);
  color: white;
}

.detail-badge {
  padding: 0.5rem 1rem;
  border-radius: 8px;
  font-size: 0.9rem;
  font-weight: 700;
}

.badge-strong {
  background: #dbeafe;
  color: #1e40af;
}

.badge-good {
  background: #dcfce7;
  color: #15803d;
}

.badge-caution {
  background: #fef3c7;
  color: #92400e;
}

.badge-review {
  background: #fee2e2;
  color: #991b1b;
}

.detail-description {
  margin-top: 1.5rem;
  padding: 1.5rem;
  background: #f8fafc;
  border-radius: 12px;
  border-left: 4px solid #3b82f6;
}

.detail-description p {
  color: #475569;
  line-height: 1.6;
  margin: 0;
}

.modal-footer {
  padding: 1.5rem 2rem;
  border-top: 2px solid #e2e8f0;
  display: flex;
  justify-content: center;
}

.btn-close-single {
  padding: 0.75rem 2.5rem;
  border-radius: 8px;
  font-weight: 600;
  font-size: 0.95rem;
  cursor: pointer;
  transition: all 0.2s ease;
  border: none;
  background: #f1f5f9;
  color: #64748b;
  min-width: 150px;
}

.btn-close-single:hover {
  background: #e2e8f0;
  color: #1e293b;
  transform: translateY(-2px);
}

@media (max-width: 640px) {
  .modal-content {
    width: 95%;
    margin: 1rem;
  }
  
  .modal-header {
    padding: 1.5rem 1.5rem 1rem;
  }
  
  .modal-body {
    padding: 1.5rem;
  }
  
  .modal-footer {
    flex-direction: column;
    padding: 1rem 1.5rem;
  }
  
  .btn-close-single {
    width: 100%;
  }
  
  .modal-title {
    font-size: 1.5rem;
  }
  
  .detail-score {
    font-size: 1.5rem;
  }
}
</style>