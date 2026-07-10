const initialiseFaqAccordions = () => {
  const accordions = document.querySelectorAll('[data-faq-accordion]');

  accordions.forEach((accordion) => {
    const items = Array.from(accordion.querySelectorAll('[data-faq-item]'));

    const closeItem = (item) => {
      const trigger = item.querySelector('[data-faq-trigger]');
      const panel = item.querySelector('[data-faq-panel]');
      const plus = item.querySelector('[data-faq-plus]');

      trigger?.setAttribute('aria-expanded', 'false');
      panel?.classList.add('hidden');

      plus?.classList.remove('scale-y-0');
      plus?.classList.add('scale-y-100');
    };

    const openItem = (item) => {
      const trigger = item.querySelector('[data-faq-trigger]');
      const panel = item.querySelector('[data-faq-panel]');
      const plus = item.querySelector('[data-faq-plus]');

      trigger?.setAttribute('aria-expanded', 'true');
      panel?.classList.remove('hidden');

      plus?.classList.remove('scale-y-100');
      plus?.classList.add('scale-y-0');
    };

    items.forEach((item) => {
      const trigger = item.querySelector('[data-faq-trigger]');

      trigger?.addEventListener('click', () => {
        const isOpen = trigger.getAttribute('aria-expanded') === 'true';

        items.forEach(closeItem);

        if (!isOpen) {
          openItem(item);
        }
      });
    });
  });
};

if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', initialiseFaqAccordions);
} else {
  initialiseFaqAccordions();
}

const initialiseReviewsSliders = () => {
  const sliders = document.querySelectorAll('[data-reviews-slider]');

  sliders.forEach((slider) => {
    const track = slider.querySelector('[data-reviews-track]');
    const slides = Array.from(slider.querySelectorAll('[data-review-slide]'));
    const previousButton = slider.querySelector('[data-reviews-prev]');
    const nextButton = slider.querySelector('[data-reviews-next]');
    const dots = Array.from(slider.querySelectorAll('[data-reviews-dot]'));

    if (!track || slides.length === 0) {
      return;
    }

    let currentIndex = 0;
    let visibleSlides = 1;
    let maximumIndex = 0;

    const getVisibleSlides = () => {
      return window.matchMedia('(min-width: 768px)').matches ? 2 : 1;
    };

    const updateDotStates = () => {
      dots.forEach((dot, index) => {
        const marker = dot.querySelector('[data-reviews-dot-marker]');

        const isActive = index === currentIndex;

        dot.setAttribute('aria-current', isActive ? 'true' : 'false');

        marker?.classList.toggle('opacity-0', !isActive);
        marker?.classList.toggle('opacity-100', isActive);
      });
    };

    const updateSlider = () => {
      visibleSlides = getVisibleSlides();
      maximumIndex = Math.max(slides.length - visibleSlides, 0);
      currentIndex = Math.min(currentIndex, maximumIndex);

      const slideWidth = 100 / visibleSlides;

      track.style.transform = `translateX(-${currentIndex * slideWidth}%)`;

      updateDotStates();

      previousButton?.toggleAttribute('disabled', currentIndex === 0);

      nextButton?.toggleAttribute('disabled', currentIndex === maximumIndex);

      previousButton?.classList.toggle('opacity-40', currentIndex === 0);

      nextButton?.classList.toggle('opacity-40', currentIndex === maximumIndex);
    };

    previousButton?.addEventListener('click', () => {
      currentIndex = Math.max(currentIndex - 1, 0);
      updateSlider();
    });

    nextButton?.addEventListener('click', () => {
      currentIndex = Math.min(currentIndex + 1, maximumIndex);

      updateSlider();
    });

    dots.forEach((dot, index) => {
      dot.addEventListener('click', () => {
        currentIndex = Math.min(index, maximumIndex);
        updateSlider();
      });
    });

    let resizeTimer;

    window.addEventListener('resize', () => {
      window.clearTimeout(resizeTimer);

      resizeTimer = window.setTimeout(() => {
        updateSlider();
      }, 150);
    });

    updateSlider();
  });
};

if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', initialiseReviewsSliders);
} else {
  initialiseReviewsSliders();
}
