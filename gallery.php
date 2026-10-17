<?php
require_once __DIR__ . '/admin/includes/db.php';
require_once __DIR__ . '/admin/includes/functions.php';
$s = get_all_settings($pdo);
$food_images = get_gallery($pdo, 'food');
$drink_images = get_gallery($pdo, 'drink');
$ambience_images = get_gallery($pdo, 'ambience');

function fix_image_path($path) {
    if (empty($path)) return '';
    return preg_replace('/Ambiance\s*(\d+)\.jpg\.(webp|jpeg)/i', 'ambience-$1.$2', $path);
}
?>

<!DOCTYPE html>
<html lang="en" class="bg-[#EBDDCB] overscroll-none">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Gallery &mdash; C HOUSE &middot; Italian Bistro &middot; Bar &middot; Lounge</title>
    <?php include __DIR__ . '/includes/head-icons.php'; ?>
    <meta name="description"
        content="Gallery of C HOUSE &mdash; Italian Bistro, Bar &amp; Lounge in Dubai Jebel Ali." />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=Manrope:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont/tabler-icons.min.css" rel="stylesheet" />

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        :root {
            --mora-espresso: #30201B;
            --mora-clay: #EBDDCB;
            --mora-olive: #393E2B;
            --mora-brass: #AA8243;
            --mora-candle: #F2E7D4;
        }

        body {
            font-family: 'Manrope', sans-serif;
            background-color: #AA8243;
            color: #30201B;
        }

        .mora-serif {
            font-family: 'DM Serif Display', Georgia, serif;
        }

        .mora-kicker {
            font-size: 10px;
            line-height: 1;
            letter-spacing: .2em;
            text-transform: uppercase;
            font-weight: 700;
        }

        .tab-active {
            color: #f5e6c8 !important;
            position: relative;
        }

        .tab-active::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            right: 0;
            height: 2px;
            background-color: #AA8243;
            border-radius: 2px;
        }

        .logo-dark-brown {
            filter: brightness(0) sepia(1) hue-rotate(-50deg) saturate(4) brightness(0.65);
        }

        .mora-menu-link {
            transition: color .25s ease, border-color .25s ease;
        }

        .mora-menu-link:hover {
            color: #C76D4D;
            border-color: #C76D4D;
        }

        #instagram-feed-iframe {
            height: 480px;
            background: transparent;
        }
        @media (min-width: 400px) {
            #instagram-feed-iframe {
                height: 520px;
            }
        }
        @media (min-width: 500px) {
            #instagram-feed-iframe {
                height: 600px;
            }
        }
        @media (min-width: 768px) {
            #instagram-feed-iframe {
                height: 380px;
            }
        }
    </style>
</head>

<body class="bg-[#EBDDCB] text-[#30201B] overflow-x-hidden min-h-screen flex flex-col justify-between">

    <!-- TOP HEADER / NAVBAR -->
    <header id="site-header" aria-label="Primary navigation"
        class="fixed inset-x-0 top-0 z-50 pt-3 pb-3 px-5 sm:px-8 lg:px-12 text-[#f5e6c8] transition-all duration-300">
        <div class="mx-auto flex h-[72px] max-w-[1360px] items-center justify-between relative">
            <div class="flex items-center">
                <a aria-label="home" class="flex items-center text-[#f5e6c8] gap-4" href="./">
                    <img src="gallery/logo.webp" class="h-28 w-auto object-contain -ml-4" alt="C HOUSE Logo">
                    <span class="font-sans text-[32px] tracking-[0.2em] font-light">C HOUSE</span>
                </a>
            </div>
            <nav aria-label="Main links"
                class="hidden items-center gap-1 rounded-full bg-black/30 px-3 py-1.5 lg:flex backdrop-blur-md border border-white/10">
                <a class="flex items-center gap-1.5 rounded-full px-4 py-2 text-[13px] tracking-widest uppercase text-gray-200 transition-colors hover:bg-white/10 hover:text-white"
                    href="./">Home</a>
                <a class="flex items-center gap-1.5 rounded-full px-4 py-2 text-[13px] tracking-widest uppercase text-gray-200 transition-colors hover:bg-white/10 hover:text-white"
                    href="menu">Menu</a>
                <a class="flex items-center gap-1.5 rounded-full px-4 py-2 text-[13px] tracking-widest uppercase text-gray-200 transition-colors hover:bg-white/10 hover:text-white"
                    href="about">About</a>
                <a class="flex items-center gap-1.5 rounded-full px-4 py-2 text-[13px] tracking-widest uppercase text-gray-200 transition-colors hover:bg-white/10 hover:text-white"
                    href="bar">Bar</a>
                <a class="flex items-center gap-1.5 rounded-full px-4 py-2 text-[13px] tracking-widest uppercase text-gray-200 transition-colors hover:bg-white/10 hover:text-white"
                    href="experience">Experience</a>
                <a class="flex items-center gap-1.5 rounded-full px-4 py-2 text-[13px] tracking-widest uppercase text-white bg-white/20 transition-colors"
                    href="gallery">Gallery</a>
                <a class="flex items-center gap-1.5 rounded-full px-4 py-2 text-[13px] tracking-widest uppercase text-gray-200 transition-colors hover:bg-white/10 hover:text-white"
                    href="contact">Contact</a>
            </nav>

            <div class="hidden lg:flex items-center gap-4">
                <a href="contact"
                    class="flex items-center gap-2.5 bg-white text-[#30201B] text-[13px] font-semibold tracking-wide rounded-full px-7 py-3 hover:bg-[#5C3D2E] hover:text-white transition-colors shadow-md border border-[#30201B]/10">
                    <span>Reserve a Table</span>
                    <i class="ti ti-arrow-up-right text-base"></i>
                </a>
            </div>

            <button id="mobile-menu-button" aria-expanded="false" class="lg:hidden flex items-center justify-center p-2 text-[#f5e6c8]" aria-label="Open menu">
                <i class="ti ti-menu-2 text-2xl"></i>
            </button>
        </div>

        <!-- Mobile Dropdown Menu -->
        <div id="mobile-menu"
            class="hidden lg:hidden mt-4 mx-auto max-w-[1360px] bg-black/90 backdrop-blur-xl border border-white/10 rounded-2xl p-6 shadow-2xl relative z-50">
            <nav class="flex flex-col gap-3">
                <a class="text-[13px] tracking-widest uppercase text-white/80 py-2 border-b border-white/10"
                    href="./">Home</a>
                <a class="text-[13px] tracking-widest uppercase text-white/80 py-2 border-b border-white/10"
                    href="menu">Menu</a>
                <a class="text-[13px] tracking-widest uppercase text-white/80 py-2 border-b border-white/10"
                    href="about">About</a>
                <a class="text-[13px] tracking-widest uppercase text-white/80 py-2 border-b border-white/10"
                    href="bar">Bar</a>
                <a class="text-[13px] tracking-widest uppercase text-white/80 py-2 border-b border-white/10"
                    href="experience">Experience</a>
                <a class="text-[13px] tracking-widest uppercase text-white py-2 border-b border-white/10 font-semibold"
                    href="gallery">Gallery</a>
                <a class="text-[13px] tracking-widest uppercase text-white/80 py-2 border-b border-white/10"
                    href="contact">Contact</a>
                <a href="contact"
                    class="mt-2 flex items-center justify-center gap-2 bg-white text-black text-[13px] font-semibold rounded-full py-3">
                    Reserve a Table <i class="ti ti-arrow-up-right"></i>
                </a>
            </nav>
        </div>
    </header>

    <!-- Hero Header -->
    <section class="relative min-h-[480px] pt-24 pb-12 px-5 bg-black text-[#f5e6c8] flex flex-col items-center">
        <div class="absolute inset-0 z-0">
            <img alt="Gallery hero" class="h-full w-full object-cover" decoding="async"
                src="gallery/ambience15.webp" />
            <div class="absolute inset-0 bg-gradient-to-b from-black/50 via-black/10 to-black/40"></div>
        </div>
        <div class="relative z-10 text-center max-w-3xl mx-auto pt-16">
            <div class="inline-block relative mb-6 pt-[31px]">
                <h1 class="mora-serif text-[#f5e6c8] text-5xl md:text-7xl tracking-tight pb-3 drop-shadow-lg">
                    Gallery
                </h1>
                <div class="h-[2px] w-20 bg-[#AA8243] mx-auto"></div>
            </div>

            <!-- CATEGORY TABS (Food, Drink, Ambience) -->
            <div class="flex justify-center items-center gap-8 sm:gap-12 mt-10 sm:mt-2">
                <button id="tab-food" onclick="switchCategory('food')"
                    class="tab-btn tab-active font-serif mora-serif text-xl sm:text-2xl text-[#f5e6c8] transition-all duration-200">
                    Food
                </button>
                <button id="tab-drink" onclick="switchCategory('drink')"
                    class="tab-btn font-serif mora-serif text-xl sm:text-2xl text-[#f5e6c8]/60 hover:text-[#f5e6c8] transition-all duration-200">
                    Drink
                </button>
                <button id="tab-ambience" onclick="switchCategory('ambience')"
                    class="tab-btn font-serif mora-serif text-xl sm:text-2xl text-[#f5e6c8]/60 hover:text-[#f5e6c8] transition-all duration-200">
                    Ambience
                </button>
            </div>
        </div>
    </section>

    <!-- GALLERY PHOTO GRID -->
    <main class="w-full max-w-[1360px] mx-auto px-5 sm:px-8 lg:px-12 pt-10 pb-16 flex-grow">

        <!-- FOOD GALLERY -->
        <div id="gallery-food" class="gallery-panel">
            <div class="columns-1 sm:columns-2 lg:columns-3 gap-6 sm:gap-8 w-full">
                <?php foreach ($food_images as $img): ?>
                    <?php if ($img['media_type'] === 'image'): ?>
                        <div class="mb-6 sm:mb-8 break-inside-avoid overflow-hidden rounded-md shadow-sm border border-[#30201B]/10 bg-[#dfcfbd]">
                            <img src="<?= e(fix_image_path($img['image_path'])) ?>" alt="<?= e($img['alt_text']) ?>"
                                class="w-full h-auto object-cover hover:scale-105 transition-transform duration-500"
                                loading="lazy" />
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>

            <!-- Food tab statement -->
            <p class="text-center text-[#30201B]/70 mt-8 mb-6 max-w-2xl mx-auto text-xl"><b><i>
                        <?= e(get_content($pdo, 'gallery', 'food', 'statement')) ?></i></b>
            </p>

            <?php
            $food_video = null;
            foreach ($food_images as $img) {
                if ($img['media_type'] === 'video') {
                    $food_video = $img;
                    break;
                }
            }
            ?>

            <!-- VIDEO & STATEMENT ROW -->
            <div class="col-span-full grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center mt-2">
                <div class="lg:col-span-5 overflow-hidden rounded-md shadow-sm border border-[#30201B]/10 bg-[#dfcfbd]">
                    <?php if ($food_video): ?>
                        <video src="<?= e($food_video['image_path']) ?>"
                            class="w-full h-[420px] sm:h-[480px] lg:h-[520px] object-cover" controls muted loop autoplay
                            playsinline></video>
                    <?php endif; ?>
                </div>
                <div class="lg:col-span-7 flex items-center justify-center lg:justify-start lg:pl-10 xl:pl-16 px-4">
                    <h2 class="mora-serif text-3xl sm:text-4xl md:text-5xl lg:text-[44px] xl:text-[52px] font-bold text-[#30201B] tracking-tight leading-tight">
                        <?= e(get_content($pdo, 'gallery', 'food', 'video_tagline')) ?>
                    </h2>
                </div>
            </div>
        </div>

        <!-- DRINK GALLERY -->
        <div id="gallery-drink" class="gallery-panel hidden">
            <div class="columns-1 sm:columns-2 lg:columns-3 gap-6 sm:gap-8 w-full">
                <?php foreach ($drink_images as $img): ?>
                    <?php if ($img['media_type'] === 'image'): ?>
                        <div class="mb-6 sm:mb-8 break-inside-avoid overflow-hidden rounded-md shadow-sm border border-[#30201B]/10 bg-[#dfcfbd]">
                            <img src="<?= e(fix_image_path($img['image_path'])) ?>" alt="<?= e($img['alt_text']) ?>"
                                class="w-full h-auto object-cover hover:scale-105 transition-transform duration-500"
                                loading="lazy" />
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>

            <p class="text-center text-[#30201B]/70 mt-8 mb-6 max-w-2xl mx-auto text-xl"><b><i>
                        <?= e(get_content($pdo, 'gallery', 'drink', 'statement')) ?></i></b>
            </p>

            <?php
            $drink_video = null;
            foreach ($drink_images as $img) {
                if ($img['media_type'] === 'video') {
                    $drink_video = $img;
                    break;
                }
            }
            ?>

            <div class="col-span-full grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center mt-2">
                <div class="lg:col-span-5 overflow-hidden rounded-md shadow-sm border border-[#30201B]/10 bg-[#dfcfbd]">
                    <?php if ($drink_video): ?>
                        <video src="<?= e($drink_video['image_path']) ?>"
                            class="w-full h-[420px] sm:h-[480px] lg:h-[520px] object-cover" controls muted loop autoplay
                            playsinline></video>
                    <?php endif; ?>
                </div>
                <div class="lg:col-span-7 flex items-center justify-center lg:justify-start lg:pl-10 xl:pl-16 px-4">
                    <h2 class="mora-serif text-3xl sm:text-4xl md:text-5xl lg:text-[44px] xl:text-[52px] font-bold text-[#30201B] tracking-tight leading-tight">
                        <?= e(get_content($pdo, 'gallery', 'drink', 'video_tagline')) ?>
                    </h2>
                </div>
            </div>
        </div>

        <!-- AMBIENCE GALLERY -->
        <div id="gallery-ambience" class="gallery-panel hidden">
            <div class="columns-1 sm:columns-2 lg:columns-3 gap-6 sm:gap-8 w-full">
                <?php foreach ($ambience_images as $img): ?>
                    <?php if ($img['media_type'] === 'image'): ?>
                        <div class="mb-6 sm:mb-8 break-inside-avoid overflow-hidden rounded-md shadow-sm border border-[#30201B]/10 bg-[#dfcfbd]">
                            <img src="<?= e(fix_image_path($img['image_path'])) ?>" alt="<?= e($img['alt_text']) ?>"
                                class="w-full h-auto object-cover hover:scale-105 transition-transform duration-500"
                                loading="lazy" />
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>

            <p class="text-center text-[#30201B]/70 mt-8 mb-6 max-w-2xl mx-auto text-xl"><b><i>
                        <?= e(get_content($pdo, 'gallery', 'ambience', 'statement')) ?></i></b>
            </p>

            <?php
            $ambience_video = null;
            foreach ($ambience_images as $img) {
                if ($img['media_type'] === 'video') {
                    $ambience_video = $img;
                    break;
                }
            }
            ?>

            <div class="col-span-full grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center mt-2">
                <div class="lg:col-span-5 overflow-hidden rounded-md shadow-sm border border-[#30201B]/10 bg-[#dfcfbd]">
                    <?php if ($ambience_video): ?>
                        <video src="<?= e($ambience_video['image_path']) ?>"
                            class="w-full h-[420px] sm:h-[480px] lg:h-[520px] object-cover" controls muted loop autoplay
                            playsinline></video>
                    <?php endif; ?>
                </div>
                <div class="lg:col-span-7 flex items-center justify-center lg:justify-start lg:pl-10 xl:pl-16 px-4">
                    <h2 class="mora-serif text-3xl sm:text-4xl md:text-5xl lg:text-[44px] xl:text-[52px] font-bold text-[#30201B] tracking-tight leading-tight">
                        <?= e(get_content($pdo, 'gallery', 'ambience', 'video_tagline')) ?>
                    </h2>
                </div>
            </div>
        </div>

    </main>

    <div class="pt-6 pb-2 text-center px-4">
        <div class="inline-block relative">
            <h2 class="cambria text-base sm:text-lg md:text-xl text-[#30201B] tracking-wider pb-0">
                INSTAGRAM
            </h2>
            <div class="h-[2px] w-16 sm:w-20 bg-[#AA8243]/60 mx-auto"></div>
            <h2 class="cambria text-2xl sm:text-3xl md:text-4xl text-[#30201B] tracking-tight pb-0"><b>
                    @chouseuae
                </b></h2>
            <div class="h-[2px] w-16 sm:w-20 bg-[#AA8243]/60 mx-auto"></div>
        </div>
    </div>

    <!-- INSTAGRAM FEED IFRAME -->
    <div class="w-full max-w-[1360px] mx-auto px-4 sm:px-6 lg:px-8 pb-8 pt-4">
        <iframe id="instagram-feed-iframe"
                src="https://feed.chouse.ae/?page_id=7" 
                class="w-full border-0 overflow-hidden" 
                loading="lazy"
                scrolling="no"
                title="C HOUSE Instagram Feed">
        </iframe>
    </div>

    <!-- FOOTER -->
    <?php include __DIR__ . '/includes/footer.php'; ?>

    <!-- SCRIPT FOR TABS & MOBILE MENU -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const siteHeader = document.getElementById('site-header');
            if (siteHeader) {
                const syncHeader = () => {
                    const on = window.scrollY > 24;
                    siteHeader.classList.toggle('bg-black/80', on);
                    siteHeader.classList.toggle('backdrop-blur-md', on);
                    siteHeader.classList.toggle('shadow-lg', on);
                };
                syncHeader();
                window.addEventListener('scroll', syncHeader, {
                    passive: true
                });
            }

            const menu = document.getElementById('mobile-menu');
            const menuButton = document.getElementById('mobile-menu-button');
            if (menu && menuButton) {
                menuButton.addEventListener('click', () => {
                    menu.classList.toggle('hidden');
                    menuButton.setAttribute('aria-expanded', !menu.classList.contains('hidden'));
                });
                menu.querySelectorAll('a').forEach((link) => link.addEventListener('click', () => {
                    menu.classList.add('hidden');
                    menuButton.setAttribute('aria-expanded', 'false');
                }));
            }
        });

        function switchCategory(cat) {
            // Hide all panels
            const panels = document.querySelectorAll('.gallery-panel');
            panels.forEach(p => p.classList.add('hidden'));

            // Show selected panel
            const targetPanel = document.getElementById('gallery-' + cat);
            if (targetPanel) {
                targetPanel.classList.remove('hidden');
            }

            // Update button styles
            const buttons = document.querySelectorAll('.tab-btn');
            buttons.forEach(btn => {
                btn.classList.remove('tab-active');
                btn.classList.add('text-[#f5e6c8]/60');
            });

            const activeBtn = document.getElementById('tab-' + cat);
            if (activeBtn) {
                activeBtn.classList.add('tab-active');
                activeBtn.classList.remove('text-[#f5e6c8]/60');
            }
        }
    </script>
    <a aria-label="Chat with us on WhatsApp" rel="noopener" href="https://wa.me/971522185569?text=Hello%2C%20I%20would%20like%20to%20make%20a%20reservation." target="_blank"
        class="fixed bottom-6 right-6 lg:bottom-10 lg:right-10 z-50 bg-[#30201B] text-[#f5e6c8] border border-[#f5e6c8]/20 w-14 h-14 rounded-full flex items-center justify-center shadow-[0_8px_30px_rgb(0,0,0,0.3)] hover:bg-[#f5e6c8] hover:text-[#30201B] hover:scale-110 transition-all duration-300">
        <i class="ti ti-brand-whatsapp text-2xl"></i>
    </a>
</body>

</html>