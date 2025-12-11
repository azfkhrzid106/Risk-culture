<!-- resources/js/Pages/Dashboard.vue -->
<template>
  <div class="min-h-screen bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50 relative overflow-hidden">
    <!-- Animated Background Elements -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
      <div class="absolute -top-40 -right-40 w-96 h-96 bg-purple-300 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob"></div>
      <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-blue-300 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-2000"></div>
      <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-pink-300 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-4000"></div>
    </div>

    <!-- Sidebar -->
    <Sidebar
      :show-sidebar="showSidebar"
      :active-tab="activeTab"
      :news-count="newsItems?.length || 0"
      :documents-count="documents?.length || 0"
      :tmrd-count="tmrdItems?.length || 0"
      @close-sidebar="showSidebar = false"
      @change-tab="activeTab = $event"
      @logout="logout"
    />

    <!-- Main Content -->
    <main class="lg:ml-80 relative z-10">
      <!-- Mobile Header -->
      <MobileHeader @toggle-sidebar="showSidebar = true" />

      <div class="p-6 animate-fade-in">
        <!-- Dashboard Overview -->
        <DashboardOverview
          v-if="activeTab === 'dashboard'"
          :stats="dashboardStats"
          @add-news="showNewsForm"
          @upload-document="showDocumentForm"
          @add-tmrd="showTmrdForm"
          @view-news="activeTab = 'news'"
          @view-documents="activeTab = 'documents'"
          @view-tmrd="activeTab = 'tmrd'"
          @clear-filters="clearFilters"
        />

        <!-- News Management -->
        <NewsManagement
          v-if="activeTab === 'news'"
          :news-items="newsItems"
          @show-notification="showNotification"
        />

        <!-- Document Management -->
        <DocumentManagement
          v-if="activeTab === 'documents'"
          :documents="documents"
          @show-notification="showNotification"
        />

        <!-- TMRD Management -->
        <TmrdManagement
          v-if="activeTab === 'tmrd'"
          :tmrd-items="tmrdItems"
          @show-notification="showNotification"
        />
      </div>
    </main>

    <!-- Notifications -->
    <NotificationToast
      :notifications="notifications"
      @remove-notification="removeNotification"
    />
  </div>
</template>

<script setup>
import { ref, computed, watch } from 'vue';
import { router, usePage } from '@inertiajs/vue3';

// Components
import Sidebar from '@/Layouts/Sidebar.vue';
import MobileHeader from '@/Layouts/MobileHeader.vue';
import NotificationToast from '@/Layouts/NotificationToast.vue';
import DashboardOverview from '@/Components/Dashboard/DashboardOverview.vue';
import NewsManagement from '@/Components/News/NewsManagement.vue';
import DocumentManagement from '@/Components/Documents/DocumentManagement.vue';
import TmrdManagement from '@/Components/Tmrd/TmrdManagement.vue';

// Composables
import { useNotifications } from '@/Composables/useNotifications.js';

// Props - FIXED: Hapus required, tambah default values
const props = defineProps({
  newsItems: { type: Array, default: () => [] },
  documents: { type: Array, default: () => [] },
  tmrdItems: { type: Array, default: () => [] },
  flash: Object
});

// State
const activeTab = ref('dashboard');
const showSidebar = ref(false);

// Notifications
const { 
  notifications, 
  showNotification, 
  removeNotification 
} = useNotifications();

// Flash message handling
const page = usePage();
watch(() => page.props?.flash, (newFlash) => {
  if (newFlash?.success) showNotification('success', newFlash.success);
  if (newFlash?.error) showNotification('error', newFlash.error);
}, { immediate: true });

// Dashboard statistics - FIXED: Tambah safe access
const dashboardStats = computed(() => {
  const newsTotal = props.newsItems?.length || 0;
  const newsActive = props.newsItems?.filter(n => n.is_active)?.length || 0;
  const docsTotal = props.documents?.length || 0;
  const tmrdTotal = props.tmrdItems?.length || 0;
  const tmrdActive = props.tmrdItems?.filter(t => t.is_active)?.length || 0;
  
  return {
    newsTotal,
    newsActive,
    docsTotal,
    tmrdTotal,
    tmrdActive,
    newsInactive: newsTotal - newsActive,
    tmrdInactive: tmrdTotal - tmrdActive,
    categories: {
      info: props.newsItems?.filter(n => n.category === 'info')?.length || 0,
      safety: props.newsItems?.filter(n => n.category === 'safety')?.length || 0,
      announcement: props.newsItems?.filter(n => n.category === 'announcement')?.length || 0,
      event: props.newsItems?.filter(n => n.category === 'event')?.length || 0
    },
    tmrdCategories: {
      maintenance: props.tmrdItems?.filter(t => t.type === 'maintenance')?.length || 0,
      inspection: props.tmrdItems?.filter(t => t.type === 'inspection')?.length || 0,
      repair: props.tmrdItems?.filter(t => t.type === 'repair')?.length || 0,
      development: props.tmrdItems?.filter(t => t.type === 'development')?.length || 0
    }
  };
});

// Methods
function showNewsForm() {
  activeTab.value = 'news';
  // Emit event or trigger form show in NewsManagement component
}

function showDocumentForm() {
  activeTab.value = 'documents';
  // Emit event or trigger form show in DocumentManagement component
}

function showTmrdForm() {
  activeTab.value = 'tmrd';
  // Emit event or trigger form show in TmrdManagement component
}

function clearFilters() {
  showNotification('success', 'Filter dibersihkan!');
  // Additional filter clearing logic if needed
}

function logout() {
  if (confirm('Yakin logout?')) {
    router.post(route('logout'));
  }
}
</script>

<style scoped>
@keyframes blob {
  0%, 100% {
    transform: translate(0, 0) scale(1);
  }
  33% {
    transform: translate(30px, -50px) scale(1.1);
  }
  66% {
    transform: translate(-20px, 20px) scale(0.9);
  }
}

.animate-blob {
  animation: blob 7s infinite;
}

.animation-delay-2000 {
  animation-delay: 2s;
}

.animation-delay-4000 {
  animation-delay: 4s;
}

@keyframes fade-in {
  from {
    opacity: 0;
    transform: translateY(10px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.animate-fade-in {
  animation: fade-in 0.5s ease-out;
}
</style>