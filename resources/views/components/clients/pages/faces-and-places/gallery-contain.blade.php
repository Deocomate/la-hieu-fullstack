<section class="w-full bg-white pb-[50px] lg:pb-[100px] flex flex-col items-center">
    <div class="w-full flex flex-col">
        @foreach ($albums as $index => $album)
            <div @class([
                'w-full group card-section-hover-surface',
                'pt-[30px] lg:pt-[50px]' => $index === 0,
                'pt-[50px] lg:pt-[80px]' => $index > 0,
            ])>
                <div class="w-full px-[30px] md:px-4">
                    @include('client.faces-and-places.partials.fap-gallery-item', [
                        'title' => $album->title,
                        'viewAlbumUrl' => route('faces-and-places.show', $album->slug),
                        'description' => $album->description,
                        'images' => $album->media->pluck('file_url')->map(fn ($path) => \App\Support\ClientImage::url($path)),
                        'galleryId' => 'fap-' . $album->slug,
                        'lightboxImages' => \App\Support\GalleryImage::fromMediaCollection($album->media, $album->title),
                    ])
                </div>
            </div>
        @endforeach
    </div>
</section>
