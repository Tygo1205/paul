document.addEventListener('DOMContentLoaded', () => {
  // Smooth scrolling voor navigatie (later uit te breiden)
  const anchorLinks = document.querySelectorAll('a[href^="#"]');
  anchorLinks.forEach(anchor => {
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


  // Mobile nav toggle
  const mobileMenuButton = document.getElementById('mobileMenuButton');
  const mobileNav = document.getElementById('mobileNav');
  if (mobileMenuButton && mobileNav) {
    mobileMenuButton.addEventListener('click', () => {
      const isExpanded = mobileMenuButton.getAttribute('aria-expanded') === 'true';
      mobileMenuButton.setAttribute('aria-expanded', String(!isExpanded));
      mobileNav.setAttribute('aria-hidden', String(isExpanded));
      mobileNav.classList.toggle('open');
    });
  }

  // Search toggle
  const searchBtn = document.getElementById('searchBtn');
  const searchWrapper = document.getElementById('searchInputWrapper');
  const searchInput = document.getElementById('searchInput');

  let isSearchOpen = false;

  if (searchBtn && searchWrapper) {
    searchBtn.addEventListener('click', () => {
      isSearchOpen = !isSearchOpen;
      
      if (isSearchOpen) {
        searchWrapper.classList.remove('hidden');
        searchWrapper.classList.add('flex');
        searchInput?.focus();
      } else {
        searchWrapper.classList.add('hidden');
        searchWrapper.classList.remove('flex');
      }
    });
  }

  // Sluit zoekbalk als je ergens anders klikt
  const searchContainer = document.getElementById('searchContainer');
  if (searchContainer) {
    document.addEventListener('click', (e) => {
      if (!searchContainer.contains(e.target)) {
        searchWrapper?.classList.add('hidden');
        searchWrapper?.classList.remove('flex');
        isSearchOpen = false;
      }
    });
  }
});