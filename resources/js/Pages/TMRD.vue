<template>
  <MainLayout>
    <div class="maintenance-container">
      <div class="maintenance-content">
        <!-- Icon/Logo -->
        <div class="maintenance-icon">
          <svg width="120" height="120" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M12 2L2 7L12 12L22 7L12 2Z" stroke="#3B82F6" stroke-width="2" stroke-linejoin="round"/>
            <path d="M2 17L12 22L22 17" stroke="#3B82F6" stroke-width="2" stroke-linejoin="round"/>
            <path d="M2 12L12 17L22 12" stroke="#3B82F6" stroke-width="2" stroke-linejoin="round"/>
          </svg>
        </div>

        <!-- Judul -->
        <h1 class="maintenance-title">
          Sedang Dalam Pemeliharaan
        </h1>

        <!-- Deskripsi -->
        <p class="maintenance-description">
          Sistem SMELTER RISK MANAGEMENT sedang menjalani pemeliharaan terjadwal 
          untuk meningkatkan kinerja dan keamanan. Kami mohon maaf atas ketidaknyamanan ini.
        </p>



        <!-- Status -->
        <div class="maintenance-status">
          <div class="status-indicator"></div>
          <span>Status: Maintenance Aktif</span>
        </div>
      </div>
    </div>
  </MainLayout>
</template>

<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
</script>

<style scoped>
.maintenance-container {
  min-height: 70vh;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 2rem;
  background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
}

.maintenance-content {
  text-align: center;
  max-width: 500px;
  background: white;
  padding: 3rem 2rem;
  border-radius: 16px;
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
  border: 1px solid #e2e8f0;
}

.maintenance-icon {
  margin-bottom: 2rem;
  display: flex;
  justify-content: center;
}

.maintenance-title {
  font-size: 2rem;
  font-weight: 700;
  color: #1e293b;
  margin-bottom: 1rem;
  line-height: 1.2;
}

.maintenance-description {
  font-size: 1.1rem;
  color: #64748b;
  line-height: 1.6;
  margin-bottom: 2rem;
}

.maintenance-info {
  display: flex;
  flex-direction: column;
  gap: 1rem;
  margin-bottom: 2rem;
  padding: 1.5rem;
  background: #f8fafc;
  border-radius: 12px;
  border-left: 4px solid #3b82f6;
}

.info-item {
  display: flex;
  align-items: center;
  gap: 0.75rem;
  font-size: 0.95rem;
  color: #475569;
}

.maintenance-status {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 0.75rem;
  margin-bottom: 2rem;
  padding: 0.75rem 1.5rem;
  background: #fef3c7;
  border-radius: 8px;
  color: #92400e;
  font-weight: 500;
}

.status-indicator {
  width: 8px;
  height: 8px;
  background: #f59e0b;
  border-radius: 50%;
  animation: pulse 2s infinite;
}

.progress-container {
  margin-top: 1rem;
}

.progress-bar {
  width: 100%;
  height: 6px;
  background: #e2e8f0;
  border-radius: 3px;
  overflow: hidden;
  margin-bottom: 0.5rem;
}

.progress-fill {
  height: 100%;
  background: linear-gradient(90deg, #3b82f6, #06b6d4);
  border-radius: 3px;
  width: 65%;
  animation: progress 3s ease-in-out infinite;
}

.progress-text {
  font-size: 0.875rem;
  color: #64748b;
}

@keyframes pulse {
  0%, 100% { opacity: 1; }
  50% { opacity: 0.5; }
}

@keyframes progress {
  0% { width: 45%; }
  50% { width: 75%; }
  100% { width: 65%; }
}

/* Responsive */
@media (max-width: 640px) {
  .maintenance-container {
    padding: 1rem;
  }
  
  .maintenance-content {
    padding: 2rem 1.5rem;
  }
  
  .maintenance-title {
    font-size: 1.75rem;
  }
  
  .maintenance-info {
    padding: 1rem;
  }
  
  .info-item {
    font-size: 0.9rem;
  }
}
</style>