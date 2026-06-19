<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Article;
use App\Models\ArticleCategory;
use Illuminate\Database\Seeder;

final class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        $categoryIds = [
            'photojournalism' => ArticleCategory::where('slug', 'photojournalism')->firstOrFail()->id,
            'videography' => ArticleCategory::where('slug', 'videography')->firstOrFail()->id,
        ];

        $contentBlocks = [
            [
                'type' => 'dropcap_paragraph',
                'dropcap' => 'E',
                'text' => "ven in the middle of a vibrant crowd, I am always looking for the same thing: the raw, genuine moments that define the true character of the event. Even in the middle of a vibrant crowd, I am always looking for the same thing.Increasingly, in the smartphone market, barring a radical change in trend, that's Android until some will argue that the third quarter was a fluke, another point is that because a million or so die-hard Apple fanatics will buy anything Apple puts out, even if it is a brick.",
            ],
            [
                'type' => 'heading',
                'text' => 'google will change thE field',
            ],
            [
                'type' => 'paragraph',
                'text' => "Because a million or so die-hard Apple fanatics will buy anything Apple puts out, even if it is a brick on the contrary Apple is likely to respond with a calculated price cut for instance Apple's sales have peaked, until Android's already working on a rival to Siri's digital assistant, at the end some will argue that the third quarter was a fluke, due to it seems to me that innovation is beginning to run dry,and the stock price is overinflated especially Apple stores will have to sacrifice some selling space of other gadgets moreover the stock has begun to fall already dropping from its $426 high.",
            ],
            [
                'type' => 'paragraph',
                'text' => "But my sell signal stands, and I wanted to offer rational and objective clarity for that call, at last consumers were disappointed that it wasn't the iPhone 5 during Apple stores will have to sacrifice some selling space of other gadgets first but my sell signal stands, and I wanted to offer rational and objective clarity for that call, before there's too much cash snoozing on Apple's balance sheet, what some will argue that the third quarter was a fluke.",
            ],
            [
                'type' => 'link',
                'text' => 'Learn more about the project',
                'link_text' => 'here',
                'url' => '#',
            ],
        ];

        $excerpt = 'Even in the middle of a vibrant crowd, I am always looking for the same thing: the raw, genuine moments that define the true character of the event. Even in the middle of a vibrant crowd, I am always looking for the same thing: the raw, genuine moments that define the true character.';

        foreach (['photojournalism', 'videography'] as $type) {
            for ($number = 1; $number <= 4; $number++) {
                if ($type === 'photojournalism') {
                    $assetIndex = (($number - 1) % 2) + 1;
                    $coverImage = "assets/static/photojournalism/photo-image-card-{$assetIndex}.png";
                    $badgeLogo = "assets/static/photojournalism/photo-logo-card-{$assetIndex}.svg";
                } else {
                    $assetIndex = (($number - 1) % 3) + 1;
                    $coverImage = "assets/static/videography/hero-slider-{$assetIndex}.png";
                    $badgeLogo = null;
                }
                
                $title = "Mordern & Trendy App Designs {$number}";
                $label = $type === 'photojournalism' ? 'Photojournalism' : 'Videography';
                $slugPrefix = $type === 'photojournalism' ? 'pj' : 'vd';

                $article = Article::updateOrCreate(
                    ['slug' => "morden-trendy-design-app-{$slugPrefix}-{$number}"],
                    [
                        'type' => $type,
                        'category_id' => $categoryIds[$type],
                        'title' => $title,
                        'excerpt' => $excerpt,
                        'cover_image' => $coverImage,
                        'badge_logo' => $badgeLogo,
                        'youtube_urls' => $type === 'videography'
                            ? ['LXb3EKWsInQ', 'Qs2-klYtq5Y', 'LXb3EKWsInQ']
                            : [],
                        'content_blocks' => $contentBlocks,
                        'published_at' => '2020-08-06 00:00:00',
                        'is_featured' => $number === 1,
                        'views_count' => 100 * $number,
                        'priority' => $number,
                        'status' => 'published',
                        'seo_title' => "{$title} - {$label}",
                        'seo_description' => $excerpt,
                        'seo_image' => $coverImage,
                    ]
                );

                if ($type === 'photojournalism') {
                    $this->seedSliderMedia($article);
                } else {
                    $article->media()->delete();
                }
            }
        }
    }

    private function seedSliderMedia(Article $article): void
    {
        $article->media()->delete();

        $sliderImages = [
            'detail-slider-swiper-1.png',
            'detail-slider-swiper-2.png',
            'detail-slider-swiper-1.png',
            'detail-slider-swiper-2.png',
        ];

        foreach ($sliderImages as $priority => $fileName) {
            $article->media()->create([
                'collection_name' => 'slider',
                'file_name' => $fileName,
                'file_url' => "assets/static/photojournalism/{$fileName}",
                'mime_type' => 'image/png',
                'size' => 1024,
                'width' => 1920,
                'height' => 1080,
                'custom_properties' => [],
                'priority' => $priority,
            ]);
        }
    }
}
