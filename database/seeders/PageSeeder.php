<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;

final class PageSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            [
                'key' => 'home',
                'title' => 'Home',
                'hero_title' => "Welcome to La Hieu Photography website!",
                'hero_subtitle' => 'Professional Photographer',
                'hero_description' => "Step into the journey I have been on. It all started back in 2009, chasing wild, untouched landscapes with nothing but a bike, a backpack, and a camera. Somewhere along those dusty roads, my passion quietly became my life's work. Today, whether I'm in the middle of vibrant events or out on the field trips, my heart belongs to raw human stories captured through both lens and motion. Connecting with different lives, telling their truths. I am truly living my dream.",
                'hero_bg_text' => 'LA HIEU',
                'hero_images' => [
                    'hero_banner' => 'assets/static/home/hero-image.png',
                    'signature_logo' => 'assets/static/home/hero-logo.svg',
                ],
                'content' => [
                    'event' => [
                        'title' => 'Event photography',
                        'description' => 'Even in the middle of a vibrant crowd, I am always looking for the same thing: the raw, unscripted moments that define the true character of the event',
                        'bg_image' => 'assets/static/home/event-photography-background.jpg',
                    ],
                    'faces' => [
                        'title' => 'faces & places',
                        'description' => 'This collection is a visual diary of the roads I have traveled and the people I have met. More than just coordinates or portraits, these images preserve the raw, real emotions of a specific fraction in time.',
                        'gallery_images' => array_map(
                            fn (int $number): string => "assets/static/home/faces-and-places-{$number}.png",
                            range(1, 19)
                        ),
                    ],
                    'photojournalism' => [
                        'title' => 'photojournalism',
                        'description' => 'Out in the field, there is no script. It is simply about stepping into different lives, listening quietly, and documenting their truths exactly as they unfold. Some days bring the quiet joy of a simple connection, while others carry the heavy weight of silent struggles. Yet, every moment is a humbling privilege to witness',
                        'desktop_bg' => 'assets/static/home/photojournalism-background.png',
                        'mobile_bg_slides' => array_map(
                            fn (int $number): array => ['image' => "assets/static/home/photojournalism-image-{$number}.png"],
                            range(1, 5)
                        ),
                    ],
                    'videography' => [
                        'title' => 'Videography',
                        'description' => 'Creating a moving video is about capturing moments that resonate deeply. It highlights the beauty of real life, showing how genuine connections and raw imperfections make a story truly perfect.',
                        'slides' => array_map(
                            fn (int $number): string => "assets/static/home/videography-{$number}.png",
                            range(1, 5)
                        ),
                    ],
                    'partners' => [
                        'title' => "I don't walk this road alone\nMeet the partners who let me capture their journey",
                    ],
                ],
                'seo_title' => 'Home - La Hieu Photography',
                'seo_description' => 'Welcome to La Hieu Photography website.',
                'seo_image' => 'assets/static/home/hero-image.png',
            ],
            [
                'key' => 'about',
                'title' => 'About',
                'hero_title' => 'Hello,',
                'hero_subtitle' => "I'm La Hieu,\na professional photographer\nbased in Hanoi.",
                'hero_description' => 'Rooted in my love for backpacking, I am naturally drawn to authentic connections. What truly drives my lens is the people: I am constantly seeking those candid moments - the unguarded joy in a crowd, the quiet focus of someone hard at work, or the deep, unwritten stories etched into the faces of locals.',
                'hero_bg_text' => 'ABOUT ME',
                'hero_images' => [
                    'about_image' => 'assets/static/about/about.png',
                    'signature_logo' => 'assets/static/about/logo.svg',
                ],
                'content' => [
                    'intro' => 'Professional photographer based in Hanoi.',
                ],
                'seo_title' => 'About me - La Hieu Photography',
                'seo_description' => 'Rooted in my love for backpacking, I am naturally drawn to authentic connections.',
                'seo_image' => 'assets/static/about/about.png',
            ],
            [
                'key' => 'contact',
                'title' => 'Contact',
                'hero_title' => 'contact',
                'hero_subtitle' => "Let's connect",
                'hero_description' => "I'm always ready for the next journey\nLet's talk about yours",
                'hero_bg_text' => 'CONTACT',
                'hero_images' => [
                    'contact_image' => 'assets/static/contact/contact-main-image.png',
                    'signature_logo' => 'assets/static/contact/logo.svg',
                ],
                'content' => [
                    'phone' => '090 2222 876',
                    'email' => 'pvduchieu@gmail.com',
                    'social' => 'lahieuphotography',
                ],
                'seo_title' => 'Contact - La Hieu Photography',
                'seo_description' => "I'm always ready for the next journey. Let's talk about yours.",
                'seo_image' => 'assets/static/contact/contact-main-image.png',
            ],
            [
                'key' => 'event-photos',
                'title' => 'Event Photos',
                'hero_title' => 'Event Photos',
                'hero_subtitle' => 'Unposed emotions. The true pulse of the event',
                'hero_description' => 'Even in the middle of a vibrant crowd, I am always looking for the same thing: the raw, genuine moments that define the true character of the event',
                'hero_bg_text' => 'EVENT PHOTOS',
                'hero_images' => [],
                'content' => [
                    'section' => 'Event photography gallery',
                ],
                'seo_title' => 'Event Photos - La Hieu Photography',
                'seo_description' => 'Even in the middle of a vibrant crowd, I am always looking for raw, genuine event moments.',
                'seo_image' => 'assets/static/home/event-photography-1.png',
            ],
            [
                'key' => 'faces-and-places',
                'title' => 'Faces & Places',
                'hero_title' => 'FACES AND PLACES',
                'hero_subtitle' => 'A visual diary of roads, people, and places',
                'hero_description' => 'This collection is a visual diary of the roads I have traveled and the people I have met.',
                'hero_bg_text' => 'FACES & PLACES',
                'hero_images' => [],
                'content' => [
                    'section' => 'Faces and places gallery',
                ],
                'seo_title' => 'Faces & Places - La Hieu Photography',
                'seo_description' => 'A visual diary of the roads traveled and the people met.',
                'seo_image' => 'assets/static/faces-and-places/faces-and-places-1.png',
            ],
            [
                'key' => 'photojournalism',
                'title' => 'Photojournalism',
                'hero_title' => 'PHOTOJOURNALISM',
                'hero_subtitle' => 'Unposed emotions. The true pulse of the event',
                'hero_description' => 'Out in the field, there is no script. It is simply about stepping into different lives, listening quietly, and documenting their truths exactly as they unfold.',
                'hero_bg_text' => 'PHOTOJOURNALISM',
                'hero_images' => [],
                'content' => [
                    'section' => 'Photojournalism articles',
                ],
                'seo_title' => 'Photojournalism - La Hieu Photography',
                'seo_description' => 'Out in the field, there is no script. Documenting truths exactly as they unfold.',
                'seo_image' => 'assets/static/photojournalism/photo-image-card-1.png',
            ],
            [
                'key' => 'videography',
                'title' => 'Videography',
                'hero_title' => 'VIDEOGRAPHY',
                'hero_subtitle' => 'Motion stories shaped from real moments',
                'hero_description' => 'Creating a moving video is about capturing moments that resonate deeply.',
                'hero_bg_text' => 'VIDEOGRAPHY',
                'hero_images' => [],
                'content' => [
                    'section' => 'Videography articles',
                ],
                'seo_title' => 'Videography - La Hieu Photography',
                'seo_description' => 'Creating a moving video is about capturing moments that resonate deeply.',
                'seo_image' => 'assets/static/home/videography-1.png',
            ],
        ];

        foreach ($pages as $page) {
            Page::updateOrCreate(['key' => $page['key']], $page);
            Cache::forget("page.{$page['key']}");
        }
    }
}
