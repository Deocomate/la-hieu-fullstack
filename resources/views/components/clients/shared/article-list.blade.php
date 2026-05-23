@php
    $list = $articles ?? [1, 2, 3, 4];
    $defaultDescription =
        'Even in the middle of a vibrant crowd, I am always looking for the same thing: the raw, genuine moments that define the true character of the event. Even in the middle of a vibrant crowd, I am always looking for the same thing: the raw, genuine moments that define the true character.';
@endphp

<section class="photojournalism-list-card-contain-section w-full max-w-[1320px] mx-auto pb-[50px] md:pb-20">
    <div class="w-full flex flex-col md:gap-[25px]">
        @foreach ($list as $index => $item)
            @php
                $bgColor = $index === 0 ? 'rgba(250, 250, 250, 1)' : 'transparent';
                $isSwapped = $index % 2 !== 0;
                $assetIndex = ($index % 2) + 1;
                $fallbackImage = asset('client/assets/static/photojournalism/photo-image-card-' . $assetIndex . '.png');
                $fallbackLogo = asset('client/assets/static/photojournalism/photo-logo-card-' . $assetIndex . '.svg');
                $hasData = is_array($item) || is_object($item);
            @endphp

            <x-clients.shared.article-card :bg-color="$bgColor" :is-swapped="$isSwapped"
                :image="$hasData ? data_get($item, 'image', $fallbackImage) : $fallbackImage"
                :logo="$hasData ? data_get($item, 'logo', $fallbackLogo) : $fallbackLogo"
                :category="$hasData ? data_get($item, 'category', 'Uncategorized') : 'Uncategorized'"
                :title="$hasData ? data_get($item, 'title', 'Mordern & Trendy App Designs ' . ($index + 1)) : 'Mordern & Trendy App Designs ' . ($index + 1)"
                :description="$hasData ? data_get($item, 'description', $defaultDescription) : $defaultDescription"
                :date="$hasData ? data_get($item, 'date', 'August 6, 2020') : 'August 6, 2020'" />
        @endforeach
    </div>

    <div class="w-full flex justify-center mt-12 lg:mt-16 px-4" data-aos="fade-up">
        @include('components.clients.pagination')
    </div>
</section>
