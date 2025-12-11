// resources/js/Composables/useFiltersAndPagination.js
import { ref, computed } from 'vue';

export function useFiltersAndPagination(items, perPage = 6) {
  const currentPage = ref(1);
  const searchQuery = ref('');
  const selectedCategory = ref('all');

  // Filtered items based on search and category
  const filteredItems = computed(() => {
    let filtered = [...items.value];
    
    // Search filter
    if (searchQuery.value) {
      const term = searchQuery.value.toLowerCase();
      filtered = filtered.filter(item => {
        const searchableFields = [
          item.title, 
          item.name, 
          item.content, 
          item.description
        ].filter(Boolean);
        
        return searchableFields.some(field => 
          field.toLowerCase().includes(term)
        );
      });
    }
    
    // Category filter
    if (selectedCategory.value !== 'all') {
      filtered = filtered.filter(item => 
        item.category === selectedCategory.value
      );
    }
    
    return filtered;
  });

  // Paginated items
  const paginatedItems = computed(() => {
    const start = (currentPage.value - 1) * perPage;
    return filteredItems.value.slice(start, start + perPage);
  });

  // Total pages
  const totalPages = computed(() => {
    return Math.ceil(filteredItems.value.length / perPage);
  });

  // Pagination info
  const paginationInfo = computed(() => {
    const start = ((currentPage.value - 1) * perPage) + 1;
    const end = Math.min(currentPage.value * perPage, filteredItems.value.length);
    const total = filteredItems.value.length;
    
    return { start, end, total };
  });

  // Methods
  function goToPage(page) {
    if (page >= 1 && page <= totalPages.value) {
      currentPage.value = page;
    }
  }

  function nextPage() {
    if (currentPage.value < totalPages.value) {
      currentPage.value++;
    }
  }

  function previousPage() {
    if (currentPage.value > 1) {
      currentPage.value--;
    }
  }

  function clearFilters() {
    searchQuery.value = '';
    selectedCategory.value = 'all';
    currentPage.value = 1;
  }

  function updateSearch(query) {
    searchQuery.value = query;
    currentPage.value = 1; // Reset to first page when searching
  }

  function updateCategory(category) {
    selectedCategory.value = category;
    currentPage.value = 1; // Reset to first page when changing category
  }

  // Reset page when filters change
  function resetPage() {
    currentPage.value = 1;
  }

  return {
    // State
    currentPage,
    searchQuery,
    selectedCategory,
    
    // Computed
    filteredItems,
    paginatedItems,
    totalPages,
    paginationInfo,
    
    // Methods
    goToPage,
    nextPage,
    previousPage,
    clearFilters,
    updateSearch,
    updateCategory,
    resetPage
  };
}