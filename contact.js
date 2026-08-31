// Smooth scrolling voor navigatie (later uit te breiden)
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
  anchor.addEventListener('click', function (e) {
    if (this.getAttribute('href') !== '#') {
      e.preventDefault();
      const target = document.querySelector(this.getAttribute('href'));
      if (target) {
        target.scrollIntoView({
          behavior: 'smooth'
        });
      }
    }
  });
});

// Tailwind script (voor dynamic classes indien nodig)
console.log("PB Promotions - Website loaded successfully");

// Search toggle
const searchBtn = document.getElementById('searchBtn');
const searchWrapper = document.getElementById('searchInputWrapper');
const searchInput = document.getElementById('searchInput');

let isSearchOpen = false;

searchBtn.addEventListener('click', () => {
  isSearchOpen = !isSearchOpen;
  
  if (isSearchOpen) {
    searchWrapper.classList.remove('hidden');
    searchWrapper.classList.add('flex');
    searchInput.focus();
  } else {
    searchWrapper.classList.add('hidden');
    searchWrapper.classList.remove('flex');
  }
});

// Sluit zoekbalk als je ergens anders klikt
document.addEventListener('click', (e) => {
  if (!searchContainer.contains(e.target)) {
    searchWrapper.classList.add('hidden');
    searchWrapper.classList.remove('flex');
    isSearchOpen = false;
  }
});