@php
    $list = $articles ?? collect();
    $defaultDescription =
        'Even in the middle of a vibrant crowd, I am always looking for the same thing: the raw, genuine moments that define the true character of the event.';
@endphp

<section class="photojournalism-list-card-contain-section w-full max-w-[1320px] mx-auto pb-[50px] md:pb-20">
    <div class="w-full flex flex-col md:gap-[25px]">
        @forelse ($list as $index => $item)
            @php
                $bgColor = $index === 0 ? 'rgba(250, 250, 250, 1)' : 'transparent';
                $isSwapped = $index % 2 !== 0;
                $assetIndex = ($index % 2) + 1;
                $fallbackImage = asset('client/assets/static/photojournalism/photo-image-card-' . $assetIndex . '.png');
                $fallbackLogo = asset('client/assets/static/photojournalism/photo-logo-card-' . $assetIndex . '.svg');
                $routeName = $item->type === 'videography' ? 'videography.show' : 'photojournalism.show';
                $publishedDate = $item->published_at?->format('F j, Y') ?? '';
            @endphp

            <a href="{{ route($routeName, $item->slug) }}" class="block">
                <x-clients.shared.article-card :bg-color="$bgColor" :is-swapped="$isSwapped"
                    :image="\App\Support\ClientImage::url($item->cover_image, $fallbackImage)"
                    :logo="\App\Support\ClientImage::url($item->badge_logo, $fallbackLogo)"
                    :category="$item->category->name ?? 'Uncategorized'"
                    :title="$item->title"
                    :description="$item->excerpt ?: $defaultDescription"
                    :date="$publishedDate" />
            </a>
        @empty
            <div class="w-full py-16 px-6 text-center">
                <p class="font-be-vietnam text-body-16-norm font-light text-black/60">
                    No published articles yet.
                </p>
            </div>
        @endforelse
    </div>

    @if (method_exists($list, 'links') && $list->hasPages())
        <div class="w-full flex justify-center mt-12 lg:mt-16 px-4" data-aos="fade-up">
            {{ $list->links('components.clients.pagination') }}
        </div>
    @endif
</section>
