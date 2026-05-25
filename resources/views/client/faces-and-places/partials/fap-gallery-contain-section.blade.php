<section class="w-full bg-white px-[30px] md:px-4 pb-[50px] lg:pb-[100px] flex flex-col items-center">
    <div class="w-full flex flex-col gap-[50px] lg:gap-[80px]">
        @foreach ($albums as $album)
            @include('client.faces-and-places.partials.fap-gallery-item', [
                'title' => $album->title,
                'viewAlbumUrl' => route('faces-and-places.show', $album->slug),
                'description' => $album->description,
                'images' => $album->media->pluck('file_url')->map(fn ($path) => \App\Support\ClientImage::url($path)),
            ])
        @endforeach
    </div>
</section>
