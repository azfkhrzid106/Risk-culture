// resources/js/Composables/useNotifications.js
import { ref } from 'vue';

export function useNotifications() {
  const notifications = ref([]);

  function showNotification(type, message, duration = 5000) {
    const id = Date.now() + Math.random();
    const notification = {
      id,
      type,
      message,
      timestamp: new Date()
    };
    
    notifications.value.push(notification);
    
    // Auto remove after duration
    setTimeout(() => {
      removeNotification(id);
    }, duration);
  }

  function removeNotification(id) {
    const index = notifications.value.findIndex(n => n.id === id);
    if (index > -1) {
      notifications.value.splice(index, 1);
    }
  }

  function clearAllNotifications() {
    notifications.value = [];
  }

  // Convenience methods
  const showSuccess = (message, duration) => showNotification('success', message, duration);
  const showError = (message, duration) => showNotification('error', message, duration);
  const showInfo = (message, duration) => showNotification('info', message, duration);
  const showWarning = (message, duration) => showNotification('warning', message, duration);

  return {
    notifications,
    showNotification,
    removeNotification,
    clearAllNotifications,
    showSuccess,
    showError,
    showInfo,
    showWarning
  };
}