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

const PLACEHOLDER_WIDTH = 1600;
const PLACEHOLDER_HEIGHT = 1067;

function resolveDimensions(image, trigger, index, startIndex) {
    if (index === startIndex && trigger) {
        const thumbImg = trigger.querySelector('img');

        if (thumbImg?.naturalWidth && thumbImg?.naturalHeight) {
            return {
                width: thumbImg.naturalWidth,
                height: thumbImg.naturalHeight,
            };
        }
    }

    const width = Number(image.width);
    const height = Number(image.height);

    if (width > 0 && height > 0) {
        return { width, height };
    }

    return {
        width: PLACEHOLDER_WIDTH,
        height: PLACEHOLDER_HEIGHT,
    };
}

function heightFitZoomLevel(zoomLevelObject) {
    const { elementSize, panAreaSize, fit } = zoomLevelObject;

    if (!elementSize?.y || !panAreaSize?.y) {
        return fit ?? 1;
    }

    return panAreaSize.y / elementSize.y;
}

function buildDataSource(images, startIndex = 0, trigger = null) {
    return images.map((image, index) => {
        const { width, height } = resolveDimensions(image, trigger, index, startIndex);

        return {
            src: image.src,
            width,
            height,
            alt: image.alt || '',
        };
    });
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

function openGallery(images, startIndex = 0, trigger = null) {
    if (!images?.length) {
        return;
    }

    currentImages = images;
    const index = Math.min(Math.max(startIndex, 0), images.length - 1);
    const dataSource = buildDataSource(images, index, trigger);

    if (activeLightbox) {
        activeLightbox.destroy();
        activeLightbox = null;
    }

    const lightbox = new PhotoSwipeLightbox({
        dataSource,
        pswpModule: PhotoSwipe,
        index,
        bgOpacity: 0.95,
        padding: { top: 24, bottom: 140, left: 12, right: 12 },
        showHideAnimationType: prefersReducedMotion() ? 'none' : 'fade',
        zoom: false,
        initialZoomLevel: heightFitZoomLevel,
        secondaryZoomLevel: heightFitZoomLevel,
        maxZoomLevel: heightFitZoomLevel,
    });

    lightbox.on('contentLoad', (event) => {
        const { content } = event;

        if (content.type !== 'image') {
            return;
        }

        event.preventDefault();

        const image = new Image();

        image.onload = () => {
            content.width = image.naturalWidth;
            content.height = image.naturalHeight;
            content.element = image;
            content.onLoaded();
        };

        image.onerror = () => {
            content.onLoaded();
        };

        image.src = content.data.src;
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
        openGallery(images, startIndex, trigger);
    } catch (error) {
        console.warn('Gallery lightbox: invalid gallery data', error);
    }
});
