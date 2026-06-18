<div id="gallery-thumb-strip"
    class="fixed bottom-0 left-0 right-0 z-[100001] pointer-events-none bg-gradient-to-t from-black/80 via-black/50 to-transparent pt-8">
    <div class="pointer-events-auto px-4 pb-2">
        <div id="gallery-thumb-scroll" class="flex gap-2 overflow-x-auto justify-start md:justify-center max-w-[1200px] mx-auto py-2">
        </div>
        <p id="gallery-counter" class="text-white/70 text-center text-sm pb-3 font-be-vietnam" aria-live="polite"></p>
    </div>
</div>

@push('scripts')
    <script type="module" src="{{ asset('client/assets/js/gallery-lightbox.js') }}"></script>
@endpush
