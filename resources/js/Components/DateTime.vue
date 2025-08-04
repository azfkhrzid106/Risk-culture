<template>
  <div class="text-sm text-gray-500 font-semibold text-center">
    {{ waktuSekarang }}
  </div>
</template>

<script setup>
import { ref, onMounted, onBeforeUnmount } from 'vue'

const waktuSekarang = ref('')

function updateWaktu() {
  const now = new Date()
  const formatter = new Intl.DateTimeFormat('id-ID', {
    weekday: 'long',
    day: '2-digit',
    month: 'long',
    year: 'numeric',
    hour: '2-digit',
    minute: '2-digit',
    second: '2-digit',
    timeZone: 'Asia/Jakarta',
    hour12: false,
  })
  waktuSekarang.value = formatter.format(now) + ' WIB'
}

let interval = null

onMounted(() => {
  updateWaktu()
  interval = setInterval(updateWaktu, 1000)
})

onBeforeUnmount(() => {
  clearInterval(interval)
})
</script>
