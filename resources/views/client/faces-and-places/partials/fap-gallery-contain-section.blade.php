{{-- resources/views/client/faces-and-places/partials/fap-gallery-contain-section.blade.php --}}
@php
    $galleryAlbums = [
        [
            'title' => 'FLYCAM',
            'viewAlbumUrl' => '#',
            'description' =>
                'Because a million or so die-hard Apple fanatics will buy anything Apple puts out, even if it is a brick on the contrary Apple is likely to respond with a calculated price cut for instance Apple’s sales have peaked, until Android’s already working on a rival to Siri’s digital assistant',
            'images' => [
                'faces-and-places-1.png',
                'faces-and-places-2.png',
                'faces-and-places-3.png',
                'faces-and-places-4.png',
                'faces-and-places-5.png',
                'faces-and-places-6.png',
                'faces-and-places-7.png',
                'faces-and-places-8.png',
                'faces-and-places-9.png',
            ],
        ],
        [
            'title' => 'NATURE & LANDSCAPE',
            'viewAlbumUrl' => '#',
            'description' =>
                'Because a million or so die-hard Apple fanatics will buy anything Apple puts out, even if it is a brick on the contrary Apple is likely to respond with a calculated price cut for instance Apple’s sales have peaked, until Android’s already working on a rival to Siri’s digital assistant',
            'images' => [
                'faces-and-places-10.png',
                'faces-and-places-11.png',
                'faces-and-places-12.png',
                'faces-and-places-13.png',
                'faces-and-places-14.png',
                'faces-and-places-15.png',
                'faces-and-places-16.png',
                'faces-and-places-17.png',
                'faces-and-places-18.png',
            ],
        ],
        [
            'title' => 'FACES',
            'viewAlbumUrl' => '#',
            'description' =>
                'Because a million or so die-hard Apple fanatics will buy anything Apple puts out, even if it is a brick on the contrary Apple is likely to respond with a calculated price cut for instance Apple’s sales have peaked, until Android’s already working on a rival to Siri’s digital assistant',
            'images' => [
                'faces-and-places-19.png',
                'faces-and-places-1.png',
                'faces-and-places-3.png',
                'faces-and-places-5.png',
                'faces-and-places-7.png',
                'faces-and-places-9.png',
                'faces-and-places-11.png',
                'faces-and-places-13.png',
                'faces-and-places-15.png',
            ],
        ],
        [
            'title' => 'ANIMALS',
            'viewAlbumUrl' => '#',
            'description' =>
                'Because a million or so die-hard Apple fanatics will buy anything Apple puts out, even if it is a brick on the contrary Apple is likely to respond with a calculated price cut for instance Apple’s sales have peaked, until Android’s already working on a rival to Siri’s digital assistant',
            'images' => [
                'faces-and-places-2.png',
                'faces-and-places-4.png',
                'faces-and-places-6.png',
                'faces-and-places-8.png',
                'faces-and-places-10.png',
                'faces-and-places-12.png',
                'faces-and-places-14.png',
                'faces-and-places-16.png',
                'faces-and-places-18.png',
            ],
        ],
    ];
@endphp

<section class="w-full bg-white px-4 pb-16 lg:pb-[100px] flex flex-col items-center">
    <!-- Vòng lặp kết xuất từng album con thông qua component fap-gallery-item -->
    <div class="w-full flex flex-col gap-12 lg:gap-[80px]">
        @foreach ($galleryAlbums as $album)
            @include('client.faces-and-places.partials.fap-gallery-item', [
                'title' => $album['title'],
                'viewAlbumUrl' => $album['viewAlbumUrl'],
                'description' => $album['description'],
                'images' => $album['images'],
            ])
        @endforeach
    </div>
</section>
