import PhotoSwipeLightbox from 'https://cdn.jsdelivr.net/npm/photoswipe@5/dist/photoswipe-lightbox.esm.min.js';
import PhotoSwipe from 'https://cdn.jsdelivr.net/npm/photoswipe@5/dist/photoswipe.esm.min.js';

const thumbStrip = document.getElementById('gallery-thumb-strip');
const thumbScroll = document.getElementById('gallery-thumb-scroll');
const counter = document.getElementById('gallery-counter');

let activeLightbox = null;
let currentImages = [];

function prefersReducedMotion() {
    return window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
}

function buildDataSource(images) {
    return images.map((image) => ({
        src: image.src,
        width: Number(image.width) || 1920,
        height: Number(image.height) || 1280,
        alt: image.alt || '',
    }));
}

function renderThumbs(images, activeIndex) {
    if (!thumbScroll || !counter) {
        return;
    }

    thumbScroll.innerHTML = images
        .map(
            (image, index) => `
                <button
                    type="button"
                    class="gallery-thumb-btn shrink-0 w-14 h-14 md:w-16 md:h-16 overflow-hidden border-2 border-transparent transition-opacity rounded-sm"
                    data-thumb-index="${index}"
                    aria-label="View image ${index + 1}"
                    aria-current="${index === activeIndex ? 'true' : 'false'}"
                >
                    <img src="${image.thumb || image.src}" alt="" class="w-full h-full object-cover" loading="lazy" />
                </button>
            `,
        )
        .join('');

    counter.textContent = `${activeIndex + 1} / ${images.length}`;

    thumbScroll.querySelectorAll('[data-thumb-index]').forEach((button) => {
        const index = Number(button.dataset.thumbIndex);
        button.classList.toggle('is-active', index === activeIndex);

        button.addEventListener('click', () => {
            if (activeLightbox?.pswp) {
                activeLightbox.pswp.goTo(index);
            }
        });
    });

    const activeThumb = thumbScroll.querySelector(`[data-thumb-index="${activeIndex}"]`);
    if (activeThumb) {
        activeThumb.scrollIntoView({
            behavior: prefersReducedMotion() ? 'auto' : 'smooth',
            block: 'nearest',
            inline: 'center',
        });
    }
}

function showThumbStrip() {
    thumbStrip?.classList.add('is-visible');
}

function hideThumbStrip() {
    thumbStrip?.classList.remove('is-visible');
    if (thumbScroll) {
        thumbScroll.innerHTML = '';
    }
    if (counter) {
        counter.textContent = '';
    }
}

function openGallery(images, startIndex = 0) {
    if (!images?.length) {
        return;
    }

    currentImages = images;
    const dataSource = buildDataSource(images);
    const index = Math.min(Math.max(startIndex, 0), dataSource.length - 1);

    if (activeLightbox) {
        activeLightbox.destroy();
        activeLightbox = null;
    }

    const lightbox = new PhotoSwipeLightbox({
        dataSource,
        pswpModule: PhotoSwipe,
        index,
        bgOpacity: 0.95,
        padding: { top: 40, bottom: 140, left: 12, right: 12 },
        showHideAnimationType: prefersReducedMotion() ? 'none' : 'fade',
        zoom: false,
        initialZoomLevel: 'fit',
        secondaryZoomLevel: 'fit',
        maxZoomLevel: 1,
    });

    lightbox.on('afterInit', () => {
        showThumbStrip();
        renderThumbs(currentImages, lightbox.pswp.currIndex);

        lightbox.pswp.on('change', () => {
            renderThumbs(currentImages, lightbox.pswp.currIndex);
        });
    });

    lightbox.on('close', () => {
        hideThumbStrip();
        activeLightbox = null;
    });

    lightbox.init();
    lightbox.loadAndOpen(index);
    activeLightbox = lightbox;
}

document.addEventListener('click', (event) => {
    const trigger = event.target.closest('[data-gallery-index]');

    if (!trigger) {
        return;
    }

    const gallery = trigger.closest('[data-gallery]');

    if (!gallery?.dataset.galleryImages) {
        return;
    }

    event.preventDefault();

    try {
        const images = JSON.parse(gallery.dataset.galleryImages);
        const startIndex = Number(trigger.dataset.galleryIndex) || 0;
        openGallery(images, startIndex);
    } catch (error) {
        console.warn('Gallery lightbox: invalid gallery data', error);
    }
});
