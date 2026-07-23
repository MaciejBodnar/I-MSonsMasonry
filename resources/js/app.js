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

const bindSwipeNavigation = (element, goPrevious, goNext) => {
  if (!(element instanceof HTMLElement)) {
    return;
  }

  let startX = 0;
  let startY = 0;
  let currentX = 0;
  let pointerId = null;
  let isDragging = false;

  element.style.touchAction = 'pan-y';

  const resetSwipe = () => {
    startX = 0;
    startY = 0;
    currentX = 0;
    pointerId = null;
    isDragging = false;
  };

  element.addEventListener('pointerdown', (event) => {
    const target = event.target;

    if (
      target instanceof Element &&
      target.closest('button, a, [data-carousel-control]')
    ) {
      return;
    }

    if (event.pointerType === 'mouse' && event.button !== 0) {
      return;
    }

    startX = event.clientX;
    startY = event.clientY;
    currentX = event.clientX;
    pointerId = event.pointerId;
    isDragging = true;

    element.setPointerCapture(pointerId);
  });

  element.addEventListener('pointermove', (event) => {
    if (!isDragging || event.pointerId !== pointerId) {
      return;
    }

    currentX = event.clientX;

    const deltaX = currentX - startX;
    const deltaY = event.clientY - startY;

    if (Math.abs(deltaX) > Math.abs(deltaY) && event.cancelable) {
      event.preventDefault();
    }
  });

  element.addEventListener('pointerup', (event) => {
    if (!isDragging || event.pointerId !== pointerId) {
      return;
    }

    const deltaX = currentX - startX;
    const deltaY = event.clientY - startY;
    const threshold = 45;

    const isHorizontalSwipe =
      Math.abs(deltaX) > Math.abs(deltaY) && Math.abs(deltaX) >= threshold;

    if (isHorizontalSwipe) {
      if (deltaX < 0) {
        goNext();
      } else {
        goPrevious();
      }
    }

    resetSwipe();
  });

  element.addEventListener('pointercancel', resetSwipe);
  element.addEventListener('lostpointercapture', resetSwipe);
};

const initialiseReviewsSliders = () => {
  const sliders = document.querySelectorAll('[data-reviews-slider]');

  sliders.forEach((slider) => {
    const track = slider.querySelector('[data-reviews-track]');
    const slides = Array.from(slider.querySelectorAll('[data-review-slide]'));

    const previousButton = slider.querySelector('[data-reviews-prev]');
    const nextButton = slider.querySelector('[data-reviews-next]');
    const previousButtonMobile = slider.querySelector(
      '[data-reviews-prev-mobile]',
    );
    const nextButtonMobile = slider.querySelector('[data-reviews-next-mobile]');

    if (!track || slides.length === 0) {
      return;
    }

    let currentIndex = 0;
    let visibleSlides = 1;
    let maximumIndex = 0;

    const getVisibleSlides = () => {
      return window.matchMedia('(min-width: 1024px)').matches ? 2 : 1;
    };

    const updateButtons = () => {
      const isAtStart = currentIndex === 0;
      const isAtEnd = currentIndex === maximumIndex;

      [previousButton, previousButtonMobile].forEach((button) => {
        if (!button) return;
        button.disabled = isAtStart;
      });

      [nextButton, nextButtonMobile].forEach((button) => {
        if (!button) return;
        button.disabled = isAtEnd;
      });
    };

    const updateSlider = () => {
      visibleSlides = getVisibleSlides();
      maximumIndex = Math.max(slides.length - visibleSlides, 0);
      currentIndex = Math.min(currentIndex, maximumIndex);

      const slideWidth = 100 / visibleSlides;

      track.style.transform = `translateX(-${currentIndex * slideWidth}%)`;

      updateButtons();
    };

    const goPrevious = () => {
      currentIndex = Math.max(currentIndex - 1, 0);
      updateSlider();
    };

    const goNext = () => {
      currentIndex = Math.min(currentIndex + 1, maximumIndex);
      updateSlider();
    };

    previousButton?.addEventListener('click', goPrevious);
    nextButton?.addEventListener('click', goNext);
    previousButtonMobile?.addEventListener('click', goPrevious);
    nextButtonMobile?.addEventListener('click', goNext);
    bindSwipeNavigation(track, goPrevious, goNext);

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

const initialiseMobileMenu = () => {
  const mobileMenu = document.querySelector('[data-mobile-menu]');
  const mobileMenuButton = document.querySelector('[data-mobile-menu-button]');

  if (!mobileMenu || !mobileMenuButton) {
    return;
  }

  const closeMobileMenu = () => {
    mobileMenu.classList.add('hidden');
    mobileMenuButton.setAttribute('aria-expanded', 'false');
  };

  mobileMenu
    .querySelectorAll('.menu-item-has-children')
    .forEach((menuItem) => {
      const parentLink = menuItem.querySelector(':scope > [data-menu-parent]');
      const submenu = menuItem.querySelector(':scope > .sub-menu');

      if (!parentLink || !submenu) {
        return;
      }

      submenu.hidden = true;
      parentLink.setAttribute('aria-expanded', 'false');

      parentLink.addEventListener('click', (event) => {
        event.preventDefault();

        const isOpen = menuItem.classList.toggle('is-open');

        parentLink.setAttribute('aria-expanded', String(isOpen));
        submenu.hidden = !isOpen;
      });
    });

  mobileMenuButton.addEventListener('click', () => {
    const isHidden = mobileMenu.classList.toggle('hidden');

    mobileMenuButton.setAttribute('aria-expanded', String(!isHidden));
  });

  mobileMenu.addEventListener('click', (event) => {
    if (event.target.closest('a:not([data-menu-parent])')) {
      closeMobileMenu();
    }
  });

  document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape') {
      closeMobileMenu();
    }
  });
};

if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', initialiseMobileMenu);
} else {
  initialiseMobileMenu();
}

const initialiseGalleryPage = () => {
  const galleryPage = document.querySelector('[data-gallery-page]');

  if (!galleryPage) {
    return;
  }

  const dataElement = galleryPage.querySelector('[data-gallery-data]');
  const mainImage = galleryPage.querySelector('[data-gallery-main-image]');
  const counter = galleryPage.querySelector('[data-gallery-counter]');
  const previousButton = galleryPage.querySelector('[data-gallery-prev]');
  const nextButton = galleryPage.querySelector('[data-gallery-next]');
  const swipeArea = galleryPage.querySelector('[data-gallery-swipe-area]');

  const thumbnails = Array.from(
    galleryPage.querySelectorAll('[data-gallery-thumbnail]'),
  );

  if (!dataElement || !mainImage || !counter) {
    return;
  }

  let images = [];

  try {
    images = JSON.parse(dataElement.textContent);
  } catch (error) {
    console.error('Unable to parse gallery data.', error);
    return;
  }

  if (!Array.isArray(images) || images.length === 0) {
    return;
  }

  let currentIndex = 0;
  let imageChangeTimer = null;

  const updateThumbnailStates = () => {
    thumbnails.forEach((thumbnail, index) => {
      const isActive = index === currentIndex;

      const overlay = thumbnail.querySelector(
        '[data-gallery-thumbnail-overlay]',
      );

      thumbnail.setAttribute('aria-current', isActive ? 'true' : 'false');

      thumbnail.classList.toggle('ring-2', isActive);
      thumbnail.classList.toggle('ring-primary', isActive);
      thumbnail.classList.toggle('grayscale-0', isActive);
      thumbnail.classList.toggle('grayscale', !isActive);

      overlay?.classList.toggle('opacity-0', isActive);
    });
  };

  const updateGallery = () => {
    const image = images[currentIndex];

    if (!image) {
      return;
    }

    window.clearTimeout(imageChangeTimer);

    mainImage.classList.add('opacity-0');

    imageChangeTimer = window.setTimeout(() => {
      mainImage.src = image.url;
      mainImage.alt = image.alt || '';
      mainImage.classList.remove('opacity-0');
    }, 150);

    counter.textContent = `${currentIndex + 1} / ${images.length}`;

    updateThumbnailStates();
  };

  const showPreviousImage = () => {
    currentIndex = currentIndex === 0 ? images.length - 1 : currentIndex - 1;

    updateGallery();
  };

  const showNextImage = () => {
    currentIndex = currentIndex === images.length - 1 ? 0 : currentIndex + 1;

    updateGallery();
  };

  thumbnails.forEach((thumbnail) => {
    thumbnail.addEventListener('click', () => {
      const index = Number(thumbnail.dataset.galleryThumbnail);

      if (!Number.isInteger(index) || !images[index]) {
        return;
      }

      currentIndex = index;
      updateGallery();

      swipeArea?.scrollIntoView({
        behavior: 'smooth',
        block: 'center',
      });
    });
  });

  previousButton?.addEventListener('click', showPreviousImage);
  nextButton?.addEventListener('click', showNextImage);

  document.addEventListener('keydown', (event) => {
    if (event.key === 'ArrowLeft') {
      showPreviousImage();
    }

    if (event.key === 'ArrowRight') {
      showNextImage();
    }
  });

  if (swipeArea instanceof HTMLElement) {
    let startX = 0;
    let startY = 0;
    let currentX = 0;
    let pointerId = null;
    let isDragging = false;

    swipeArea.style.touchAction = 'pan-y';

    const resetSwipe = () => {
      startX = 0;
      startY = 0;
      currentX = 0;
      pointerId = null;
      isDragging = false;
    };

    swipeArea.addEventListener('pointerdown', (event) => {
      const target = event.target;

      /*
       * Do not start swiping when an arrow or another control
       * inside the slider is pressed.
       */
      if (
        target instanceof Element &&
        target.closest('button, a, [data-gallery-control]')
      ) {
        return;
      }

      if (event.pointerType === 'mouse' && event.button !== 0) {
        return;
      }

      startX = event.clientX;
      startY = event.clientY;
      currentX = event.clientX;
      pointerId = event.pointerId;
      isDragging = true;

      swipeArea.setPointerCapture(pointerId);
    });

    swipeArea.addEventListener('pointermove', (event) => {
      if (!isDragging || event.pointerId !== pointerId) {
        return;
      }

      currentX = event.clientX;

      const deltaX = currentX - startX;
      const deltaY = event.clientY - startY;

      if (Math.abs(deltaX) > Math.abs(deltaY)) {
        event.preventDefault();
      }
    });

    swipeArea.addEventListener('pointerup', (event) => {
      if (!isDragging || event.pointerId !== pointerId) {
        return;
      }

      const deltaX = currentX - startX;
      const deltaY = event.clientY - startY;
      const threshold = 50;

      const isHorizontalSwipe =
        Math.abs(deltaX) > Math.abs(deltaY) && Math.abs(deltaX) >= threshold;

      if (isHorizontalSwipe) {
        if (deltaX < 0) {
          showNextImage();
        } else {
          showPreviousImage();
        }
      }

      resetSwipe();
    });

    swipeArea.addEventListener('pointercancel', resetSwipe);
    swipeArea.addEventListener('lostpointercapture', resetSwipe);
  }

  updateGallery();
};

if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', initialiseGalleryPage);
} else {
  initialiseGalleryPage();
}

const initialiseHomeGallerySliders = () => {
  document.querySelectorAll('[data-home-gallery-slider]').forEach((slider) => {
    const track = slider.querySelector('[data-home-gallery-track]');
    const slides = Array.from(
      slider.querySelectorAll('[data-home-gallery-slide]'),
    );
    const previousButton = slider.querySelector('[data-home-gallery-prev]');
    const nextButton = slider.querySelector('[data-home-gallery-next]');

    if (!track || slides.length === 0) {
      return;
    }

    let currentIndex = 0;

    const updateSlider = () => {
      currentIndex = Math.min(Math.max(currentIndex, 0), slides.length - 1);

      track.style.transform = `translateX(-${currentIndex * 100}%)`;

      if (previousButton) {
        previousButton.disabled = currentIndex === 0;
      }

      if (nextButton) {
        nextButton.disabled = currentIndex === slides.length - 1;
      }
    };

    previousButton?.addEventListener('click', () => {
      currentIndex -= 1;
      updateSlider();
    });

    nextButton?.addEventListener('click', () => {
      currentIndex += 1;
      updateSlider();
    });
    bindSwipeNavigation(
      track,
      () => {
        currentIndex -= 1;
        updateSlider();
      },
      () => {
        currentIndex += 1;
        updateSlider();
      },
    );

    updateSlider();
  });
};

if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', initialiseHomeGallerySliders);
} else {
  initialiseHomeGallerySliders();
}
