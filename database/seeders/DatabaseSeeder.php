<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        // Tạo Super Admin
        User::firstOrCreate(
            ['email' => env('ADMIN_EMAIL', 'admin@lahieu.com')],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password'),
                'role' => 'super_admin',
            ]
        );

        // Tạo Admin thường để test phân quyền
        User::firstOrCreate(
            ['email' => 'staff@lahieu.com'],
            [
                'name' => 'Admin Staff',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        // ==========================================
        // 1. SETTINGS SEEDER
        // ==========================================
        DB::table('settings')->insert([
            ['group' => 'contact', 'key' => 'contact_phone', 'value' => '090 2222 876', 'created_at' => $now, 'updated_at' => $now],
            ['group' => 'contact', 'key' => 'contact_email', 'value' => 'pvduchieu@gmail.com', 'created_at' => $now, 'updated_at' => $now],
            ['group' => 'social', 'key' => 'social_instagram', 'value' => 'lahieuphotography', 'created_at' => $now, 'updated_at' => $now],
            ['group' => 'footer', 'key' => 'footer_author_name', 'value' => 'Nguyễn Đức Hiếu', 'created_at' => $now, 'updated_at' => $now],
            ['group' => 'footer', 'key' => 'footer_quote', 'value' => "I'm always ready for the next journey\nLet’s talk about yours", 'created_at' => $now, 'updated_at' => $now],
        ]);

        // ==========================================
        // 2. PAGES SEEDER
        // ==========================================
        DB::table('pages')->insert([
            [
                'key' => 'home',
                'title' => 'Home',
                'hero_title' => "Welcome to \nLa Hieu Photography website!",
                'hero_subtitle' => null,
                'hero_description' => "Step into the journey I have been on. It all started back in 2009, chasing wild, untouched landscapes with nothing but a bike, a backpack, and a camera. Somewhere along those dusty roads, my passion quietly became my life's work. Today, whether I’m in the middle of vibrant events or out on the field trips, my heart belongs to raw human stories captured through both lens and motion. Connecting with different lives, telling their truths. I am truly living my dream.",
                'hero_bg_text' => null,
                'hero_images' => json_encode(['client/assets/static/home/hero-image.png']),
                'content' => json_encode([
                    'event_photography_desc' => 'Even in the middle of a vibrant crowd, I am always looking for the same thing: the raw, unscripted moments that define the true character of the event',
                    'faces_places_desc' => "This collection is a visual diary of the roads I have traveled and the people\nI have met. More than just coordinates or portraits, these images preserve\nthe raw, real emotions of a specific fraction in time.",
                    'photojournalism_desc' => "Out in the field, there is no script. It is simply about stepping into different lives, listening quietly, and documenting their truths exactly as they unfold. Some days bring the quiet joy of a simple connection, while others carry the heavy weight of silent struggles. Yet, every moment is a humbling privilege to witness",
                    'videography_desc' => "Creating a moving video is about capturing moments that resonate deeply.\nIt highlights the beauty of real life, showing how genuine connections\nand raw imperfections make a story truly perfect.",
                    'partners_desc' => "I don't walk this road alone\nMeet the partners who let me capture their journey"
                ]),
                'created_at' => $now, 'updated_at' => $now
            ],
            [
                'key' => 'about',
                'title' => 'About',
                'hero_title' => "Hello,",
                'hero_subtitle' => "I’m La Hieu,\na professional photographer\nbased in Hanoi.",
                'hero_description' => "Rooted in my love for backpacking, I am naturally drawn to authentic connections. What truly drives my lens is the people:\nI am constantly seeking those candid moments - the unguarded joy in a crowd, the quiet focus of someone hard at work, or the deep, unwritten stories etched into the faces of locals.",
                'hero_bg_text' => null,
                'hero_images' => json_encode(['client/assets/static/about/about.png']),
                'content' => null,
                'created_at' => $now, 'updated_at' => $now
            ],
            [
                'key' => 'contact',
                'title' => 'Contact',
                'hero_title' => 'contact',
                'hero_subtitle' => null,
                'hero_description' => "I'm always ready for the next journey\nLet’s talk about yours",
                'hero_bg_text' => null,
                'hero_images' => json_encode(['client/assets/static/contact/contact-main-image.png']),
                'content' => null,
                'created_at' => $now, 'updated_at' => $now
            ],
            [
                'key' => 'event-photos',
                'title' => 'Event Photos',
                'hero_title' => 'Event Photos',
                'hero_subtitle' => 'Unposed emotions. The true pulse of the event',
                'hero_description' => 'Even in the middle of a vibrant crowd, I am always looking for the same thing: the raw, genuine moments that define the true character of the event',
                'hero_bg_text' => 'EVENT PHOTOS',
                'hero_images' => null,
                'content' => null,
                'created_at' => $now, 'updated_at' => $now
            ]
        ]);

        // ==========================================
        // 3. EVENT ALBUMS & MEDIA SEEDER
        // ==========================================
        $eventsData = [
            [
                'title' => 'P4G Vietnam Summit',
                'slug' => 'p4g-vietnam-summit',
                'event_date' => '2019-06-16',
                'hero_bg_text' => 'EVENT PHOTOS',
                'cover_image' => 'client/assets/static/home/event-photography-1.png',
                'images' => [1, 2, 3, 4, 5, 6, 7, 8]
            ],
            [
                'title' => 'Goeth: The Gem',
                'slug' => 'goeth-the-gem',
                'event_date' => '2020-08-08',
                'hero_bg_text' => 'EVENT PHOTOS',
                'cover_image' => 'client/assets/static/home/event-photography-2.png',
                'images' => [9, 10, 11, 12, 13, 14, 15]
            ],
            [
                'title' => 'La Hieu Project',
                'slug' => 'la-hieu-project',
                'event_date' => '2021-01-01',
                'hero_bg_text' => 'EVENT PHOTOS',
                'cover_image' => 'client/assets/static/home/event-photography-3.png',
                'images' => [16, 17, 18, 19, 1, 3, 6]
            ]
        ];

        foreach ($eventsData as $i => $event) {
            $eventId = DB::table('event_albums')->insertGetId([
                'title' => $event['title'],
                'slug' => $event['slug'],
                'event_date' => $event['event_date'],
                'hero_bg_text' => $event['hero_bg_text'],
                'cover_image' => $event['cover_image'],
                'is_featured' => true,
                'priority' => $i,
                'created_at' => $now,
                'updated_at' => $now
            ]);

            // Add media gallery
            foreach ($event['images'] as $key => $imgId) {
                DB::table('media')->insert([
                    'model_type' => 'App\Models\EventAlbum',
                    'model_id' => $eventId,
                    'collection_name' => 'gallery',
                    'file_name' => "gallery-{$imgId}.png",
                    'file_url' => "client/assets/static/event-photo/gallery-{$imgId}.png",
                    'priority' => $key,
                    'created_at' => $now, 'updated_at' => $now
                ]);
            }
        }

        // ==========================================
        // 4. FACES & PLACES ALBUMS & MEDIA SEEDER
        // ==========================================
        $fapDesc = "Because a million or so die-hard Apple fanatics will buy anything Apple puts out, even if it is a brick on the contrary Apple is likely to respond with a calculated price cut for instance Apple’s sales have peaked, until Android’s already working on a rival to Siri’s digital assistant";
        
        $fapData = [
            ['title' => 'FLYCAM', 'images' => [1,2,3,4,5,6,7,8,9]],
            ['title' => 'NATURE & LANDSCAPE', 'images' => [10,11,12,13,14,15,16,17,18]],
            ['title' => 'FACES', 'images' => [19,1,3,5,7,9,11,13,15]],
            ['title' => 'ANIMALS', 'images' => [2,4,6,8,10,12,14,16,18]],
        ];

        foreach ($fapData as $i => $fap) {
            $fapId = DB::table('faces_places_albums')->insertGetId([
                'title' => $fap['title'],
                'slug' => Str::slug($fap['title']),
                'description' => $fapDesc,
                'hero_bg_text' => 'FACES & PLACES',
                'cover_image' => "client/assets/static/faces-and-places/faces-and-places-{$fap['images'][0]}.png",
                'priority' => $i,
                'created_at' => $now, 'updated_at' => $now
            ]);

            foreach ($fap['images'] as $key => $imgId) {
                DB::table('media')->insert([
                    'model_type' => 'App\Models\FacesPlacesAlbum',
                    'model_id' => $fapId,
                    'collection_name' => 'gallery',
                    'file_name' => "faces-and-places-{$imgId}.png",
                    'file_url' => "client/assets/static/faces-and-places/faces-and-places-{$imgId}.png",
                    'priority' => $key,
                    'created_at' => $now, 'updated_at' => $now
                ]);
            }
        }

        // ==========================================
        // 5. ARTICLE CATEGORIES SEEDER
        // ==========================================
        $categoryId = DB::table('article_categories')->insertGetId([
            'name' => 'Uncategorized',
            'slug' => 'uncategorized',
            'created_at' => $now, 'updated_at' => $now
        ]);

        // ==========================================
        // 6. ARTICLES (PHOTOJOURNALISM & VIDEOGRAPHY)
        // ==========================================
        $articleContentBlocks = json_encode([
            [
                'type' => 'dropcap_paragraph',
                'dropcap' => 'E',
                'text' => "ven in the middle of a vibrant crowd, I am always looking for the same thing: the raw, genuine moments that define the true character of the event. Even in the middle of a vibrant crowd, I am always looking for the same thing.Increasingly, in the smartphone market, barring a radical change in trend, that's Android until some will argue that the third quarter was a fluke, another point is that because a million or so die-hard Apple fanatics will buy anything Apple puts out, even if it is a brick."
            ],
            [
                'type' => 'heading',
                'text' => 'google will change thE field'
            ],
            [
                'type' => 'paragraph',
                'text' => "Because a million or so die-hard Apple fanatics will buy anything Apple puts out, even if it is a brick on the contrary Apple is likely to respond with a calculated price cut for instance Apple's sales have peaked, until Android's already working on a rival to Siri's digital assistant, at the end some will argue that the third quarter was a fluke, due to it seems to me that innovation is beginning to run dry,and the stock price is overinflated especially Apple stores will have to sacrifice some selling space of other gadgets moreover the stock has begun to fall already dropping from its $426 high."
            ],
            [
                'type' => 'paragraph',
                'text' => "But my sell signal stands, and I wanted to offer rational and objective clarity for that call, at last consumers were disappointed that it wasn't the iPhone 5 during Apple stores will have to sacrifice some selling space of other gadgets first but my sell signal stands, and I wanted to offer rational and objective clarity for that call, before there's too much cash snoozing on Apple's balance sheet, what some will argue that the third quarter was a fluke."
            ],
            [
                'type' => 'link',
                'text' => 'Learn more about the project ',
                'link_text' => 'here',
                'url' => '#'
            ]
        ]);

        $defaultExcerpt = "Even in the middle of a vibrant crowd, I am always looking for the same thing: the raw, genuine moments that define the true character of the event. Even in the middle of a vibrant crowd, I am always looking for the same thing: the raw, genuine moments that define the true character.";

        // --- Photojournalism Articles ---
        for ($i = 1; $i <= 4; $i++) {
            $assetIndex = ($i % 2 === 0) ? 1 : 2; // Khớp logic isSwapped trong view
            $pjId = DB::table('articles')->insertGetId([
                'type' => 'photojournalism',
                'category_id' => $categoryId,
                'title' => "Morden trendy & design app {$i}",
                'slug' => "morden-trendy-design-app-pj-{$i}",
                'excerpt' => $defaultExcerpt,
                'cover_image' => "client/assets/static/photojournalism/photo-image-card-{$assetIndex}.png",
                'badge_logo' => "client/assets/static/photojournalism/photo-logo-card-{$assetIndex}.svg",
                'youtube_urls' => null,
                'content_blocks' => $articleContentBlocks,
                'published_at' => Carbon::create(2020, 8, 6)->toDateTimeString(),
                'created_at' => $now, 'updated_at' => $now
            ]);

            // Thêm media slider cho Photojournalism detail
            $pjSliders = ['detail-slider-swiper-1.png', 'detail-slider-swiper-2.png', 'detail-slider-swiper-1.png', 'detail-slider-swiper-2.png'];
            foreach ($pjSliders as $k => $slider) {
                DB::table('media')->insert([
                    'model_type' => 'App\Models\Article',
                    'model_id' => $pjId,
                    'collection_name' => 'slider',
                    'file_name' => $slider,
                    'file_url' => "client/assets/static/photojournalism/{$slider}",
                    'priority' => $k,
                    'created_at' => $now, 'updated_at' => $now
                ]);
            }
        }

        // --- Videography Articles ---
        for ($i = 1; $i <= 4; $i++) {
            $assetIndex = ($i % 2 === 0) ? 1 : 2;
            DB::table('articles')->insert([
                'type' => 'videography',
                'category_id' => $categoryId,
                'title' => "Morden trendy & design app {$i}",
                'slug' => "morden-trendy-design-app-vd-{$i}",
                'excerpt' => $defaultExcerpt,
                'cover_image' => "client/assets/static/photojournalism/photo-image-card-{$assetIndex}.png",
                'badge_logo' => "client/assets/static/photojournalism/photo-logo-card-{$assetIndex}.svg",
                'youtube_urls' => json_encode(['LXb3EKWsInQ', 'Qs2-klYtq5Y', 'LXb3EKWsInQ']),
                'content_blocks' => $articleContentBlocks,
                'published_at' => Carbon::create(2020, 8, 6)->toDateTimeString(),
                'created_at' => $now, 'updated_at' => $now
            ]);
        }

        // ==========================================
        // 7. HOMEPAGE COMPONENTS (PARTNERS & SOCIAL)
        // ==========================================
        // Partners
        for ($i = 1; $i <= 4; $i++) {
            DB::table('partners')->insert([
                'name' => "Partner {$i}",
                'logo_image' => "client/assets/static/home/partner-{$i}.png",
                'link_url' => '#',
                'priority' => $i,
                'created_at' => $now, 'updated_at' => $now
            ]);
        }

        // Social Feeds (Follow me on instagram)
        for ($i = 1; $i <= 5; $i++) {
            DB::table('social_feeds')->insert([
                'platform' => 'instagram',
                'image_url' => "client/assets/static/home/follow-me-{$i}.png",
                'post_url' => '#',
                'priority' => $i,
                'created_at' => $now, 'updated_at' => $now
            ]);
        }
    }
}
