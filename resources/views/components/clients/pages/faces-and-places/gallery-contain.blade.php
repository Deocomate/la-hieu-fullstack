<section class="w-full bg-white pb-[50px] lg:pb-[100px] flex flex-col items-center">
    <div class="w-full flex flex-col">
        @foreach ($albums as $index => $album)
            <div @class([
                'w-full group card-section-hover-surface',
                'pt-[30px] lg:pt-[50px]' => $index === 0,
                'pt-[50px] lg:pt-[80px]' => $index > 0,
            ])>
                <div class="w-full px-[30px] md:px-4">
                    <x-clients.pages.faces-and-places.gallery-item
                        :title="$album->title"
                        :view-album-url="route('faces-and-places.show', $album->slug)"
                        :description="$album->description"
                        :images="$album->media->pluck('file_url')->map(fn ($path) => \App\Support\ClientImage::url($path))"
                        :gallery-id="'fap-' . $album->slug"
                        :lightbox-images="\App\Support\GalleryImage::fromMediaCollection($album->media, $album->title)"
                    />
                </div>
            </div>
        @endforeach
    </div>
</section>
