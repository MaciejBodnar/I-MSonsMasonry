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
const initialiseCategoryGallery = () => {
  const galleryPage = document.querySelector('[data-gallery-page]');

  if (!galleryPage) {
    return;
  }

  const viewer = galleryPage.querySelector('[data-gallery-viewer]');
  const dataElement = galleryPage.querySelector('[data-gallery-data]');
  const title = galleryPage.querySelector('[data-gallery-title]');
  const mainImage = galleryPage.querySelector('[data-gallery-main-image]');
  const counter = galleryPage.querySelector('[data-gallery-counter]');
  const previousButton = galleryPage.querySelector('[data-gallery-prev]');
  const nextButton = galleryPage.querySelector('[data-gallery-next]');
  const closeButton = galleryPage.querySelector('[data-gallery-close]');

  if (!viewer || !dataElement || !title || !mainImage || !counter) {
    return;
  }

  let galleryData = [];

  try {
    galleryData = JSON.parse(dataElement.textContent);
  } catch (error) {
    console.error('Unable to parse gallery data.', error);
    return;
  }

  let activeCategory = null;
  let activeImageIndex = 0;

  const getImages = () => activeCategory?.images ?? [];

  const updateMainImage = () => {
    const images = getImages();
    const image = images[activeImageIndex];

    if (!image) {
      mainImage.removeAttribute('src');
      mainImage.alt = '';
      counter.textContent = '0 / 0';
      return;
    }

    mainImage.classList.add('opacity-0');

    window.setTimeout(() => {
      mainImage.src = image.url;
      mainImage.alt = image.alt || activeCategory.title || '';
      mainImage.classList.remove('opacity-0');
    }, 150);

    counter.textContent = `${activeImageIndex + 1} / ${images.length}`;
  };

  const openCategory = (
    categoryIndex,
    updateHash = true,
    scrollToViewer = true,
  ) => {
    const category = galleryData[categoryIndex];

    if (!category || !category.images?.length) {
      return;
    }

    activeCategory = category;
    activeImageIndex = 0;

    title.textContent = category.title;
    viewer.classList.remove('hidden');

    updateMainImage();

    if (updateHash) {
      history.pushState(null, '', `#${category.slug}`);
    }

    if (scrollToViewer) {
      viewer.scrollIntoView({
        behavior: 'smooth',
        block: 'start',
      });
    }
  };

  const closeGallery = () => {
    viewer.classList.add('hidden');

    activeCategory = null;
    activeImageIndex = 0;

    history.pushState(
      null,
      '',
      `${window.location.pathname}${window.location.search}`,
    );
  };

  const showPreviousImage = () => {
    const images = getImages();

    if (!images.length) {
      return;
    }

    activeImageIndex =
      activeImageIndex === 0 ? images.length - 1 : activeImageIndex - 1;

    updateMainImage();
  };

  const showNextImage = () => {
    const images = getImages();

    if (!images.length) {
      return;
    }

    activeImageIndex =
      activeImageIndex === images.length - 1 ? 0 : activeImageIndex + 1;

    updateMainImage();
  };

  const openFromHash = (scrollToViewer = false) => {
    const slug = window.location.hash.replace('#', '');

    if (!slug) {
      viewer.classList.add('hidden');
      activeCategory = null;
      return;
    }

    const categoryIndex = galleryData.findIndex(
      (category) => category.slug === slug,
    );

    if (categoryIndex !== -1) {
      openCategory(categoryIndex, false, scrollToViewer);
    }
  };

  galleryPage.querySelectorAll('[data-gallery-category]').forEach((button) => {
    button.addEventListener('click', () => {
      const categoryIndex = Number(button.dataset.galleryCategory);

      openCategory(categoryIndex);
    });
  });

  previousButton?.addEventListener('click', showPreviousImage);

  nextButton?.addEventListener('click', showNextImage);

  closeButton?.addEventListener('click', closeGallery);

  window.addEventListener('hashchange', () => {
    openFromHash(true);
  });

  document.addEventListener('keydown', (event) => {
    if (!activeCategory) {
      return;
    }

    if (event.key === 'ArrowLeft') {
      showPreviousImage();
    }

    if (event.key === 'ArrowRight') {
      showNextImage();
    }

    if (event.key === 'Escape') {
      closeGallery();
    }
  });

  openFromHash(false);
};

if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', initialiseCategoryGallery);
} else {
  initialiseCategoryGallery();
}

const initialiseHeaderNavigation = () => {
  const dialog = document.querySelector('[data-services-dialog]');

  const dialogOpenButtons = document.querySelectorAll(
    '[data-services-dialog-open]',
  );

  const dialogCloseButton = document.querySelector(
    '[data-services-dialog-close]',
  );

  const mobileMenuButton = document.querySelector('[data-mobile-menu-button]');

  const mobileMenu = document.querySelector('[data-mobile-menu]');

  let lastFocusedElement = null;

  const openServicesDialog = () => {
    if (!(dialog instanceof HTMLDialogElement)) {
      return;
    }

    lastFocusedElement = document.activeElement;

    if (!dialog.open) {
      dialog.showModal();
    }

    mobileMenu?.classList.add('hidden');
    mobileMenuButton?.setAttribute('aria-expanded', 'false');

    document.documentElement.classList.add('overflow-hidden');
  };

  const closeServicesDialog = () => {
    if (!(dialog instanceof HTMLDialogElement)) {
      return;
    }

    if (dialog.open) {
      dialog.close();
    }
  };

  dialogOpenButtons.forEach((button) => {
    button.addEventListener('click', (event) => {
      event.preventDefault();
      openServicesDialog();
    });
  });

  dialogCloseButton?.addEventListener('click', closeServicesDialog);

  dialog?.addEventListener('close', () => {
    document.documentElement.classList.remove('overflow-hidden');

    if (lastFocusedElement instanceof HTMLElement) {
      lastFocusedElement.focus();
    }
  });

  dialog?.addEventListener('click', (event) => {
    if (!(dialog instanceof HTMLDialogElement)) {
      return;
    }

    const bounds = dialog.getBoundingClientRect();

    const clickedOutside =
      event.clientX < bounds.left ||
      event.clientX > bounds.right ||
      event.clientY < bounds.top ||
      event.clientY > bounds.bottom;

    if (clickedOutside) {
      closeServicesDialog();
    }
  });

  mobileMenuButton?.addEventListener('click', () => {
    const isOpen = mobileMenuButton.getAttribute('aria-expanded') === 'true';

    mobileMenuButton.setAttribute('aria-expanded', String(!isOpen));

    mobileMenu?.classList.toggle('hidden', isOpen);
  });
};

if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', initialiseHeaderNavigation);
} else {
  initialiseHeaderNavigation();
}
