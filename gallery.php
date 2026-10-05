<?php
require_once __DIR__ . '/admin/includes/db.php';
require_once __DIR__ . '/admin/includes/functions.php';
$s = get_all_settings($pdo);
$food_images = get_gallery($pdo, 'food');
$drink_images = get_gallery($pdo, 'drink');
$ambience_images = get_gallery($pdo, 'ambience');
?>

<!DOCTYPE html>
<html lang="en" class="bg-[#EBDDCB] overscroll-none">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Gallery &mdash; C HOUSE &middot; Italian Bistro &middot; Bar &middot; Lounge</title>
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
            color: #30201B !important;
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
    </style>
</head>

<body class="bg-[#EBDDCB] text-[#30201B] overflow-x-hidden min-h-screen flex flex-col justify-between">

    <!-- TOP HEADER / NAVBAR -->
    <div class="w-full">
        <header aria-label="Primary navigation" class="relative z-50 pt-6 px-5 sm:px-8 lg:px-12 text-[#30201B]">
            <div class="mx-auto flex h-[72px] max-w-[1360px] items-center justify-between relative">

                <!-- Logo & Brand Name -->
                <div class="flex items-center">
                    <a aria-label="home" class="flex items-center gap-3 text-[#30201B]" href="./index.php">
                        <img src="gallery/logo.webp" class="h-28 w-auto object-contain -ml-4 logo-dark-brown"
                            alt="C HOUSE Logo" />
                        <span class="font-sans text-[32px] tracking-[0.2em] font-light text-[#30201B]">C
                            HOUSE</span>
                    </a>
                </div>

                <!-- Center Floating Navigation Pill -->
                <nav aria-label="Main links"
                    class="hidden items-center gap-1 rounded-full bg-[#30201B]/10 px-3 py-1.5 lg:flex backdrop-blur-md border border-[#30201B]/15 shadow-sm">
                    <a class="flex items-center gap-1.5 rounded-full px-4 py-2 text-[13px] tracking-widest uppercase text-[#30201B]/80 transition-colors hover:bg-[#30201B]/15 hover:text-[#30201B]"
                        href="./index.php">Home</a>
                    <a class="flex items-center gap-1.5 rounded-full px-4 py-2 text-[13px] tracking-widest uppercase text-[#30201B]/80 transition-colors hover:bg-[#30201B]/15 hover:text-[#30201B]"
                        href="./menu.php">Menu</a>
                    <a class="flex items-center gap-1.5 rounded-full px-4 py-2 text-[13px] tracking-widest uppercase text-[#30201B]/80 transition-colors hover:bg-[#30201B]/15 hover:text-[#30201B]"
                        href="./about.php">About</a>
                    <a class="flex items-center gap-1.5 rounded-full px-4 py-2 text-[13px] tracking-widest uppercase text-[#30201B]/80 transition-colors hover:bg-[#30201B]/15 hover:text-[#30201B]"
                        href="./bar.php">Bar</a> <a
                        class="flex items-center gap-1.5 rounded-full px-4 py-2 text-[13px] tracking-widest uppercase text-[#30201B]/80 transition-colors hover:bg-[#30201B]/15 hover:text-[#30201B]"
                        href="./experience.php">Experience</a> <a
                        class="flex items-center gap-1.5 rounded-full px-4 py-2 text-[13px] tracking-widest uppercase bg-[#30201B] text-[#EBDDCB] font-semibold shadow-sm"
                        href="./gallery.php" aria-current="page">Gallery</a>
                    <a class="flex items-center gap-1.5 rounded-full px-4 py-2 text-[13px] tracking-widest uppercase text-[#30201B]/80 transition-colors hover:bg-[#30201B]/15 hover:text-[#30201B]"
                        href="./contact.php">Contact</a>
                </nav>

                <!-- Right: Reserve a Table Button -->
                <div class="hidden lg:flex items-center gap-4">
                    <a mora-menu-link w-fit data-kid="2-3-1-2-2-2-1" href="./contact.php"
                        class="flex items-center gap-2.5 bg-white text-[#30201B] text-[13px] font-semibold tracking-wide rounded-full px-7 py-3 hover:bg-[#5C3D2E] hover:text-white transition-colors shadow-md border border-[#30201B]/10">
                        <span>Reserve a Table</span>
                        <i class="ti ti-arrow-up-right text-base"></i>
                    </a>
                </div>

                <!-- Mobile Menu Toggle Button -->
                <button id="mobile-menu-btn"
                    class="lg:hidden flex items-center justify-center w-10 h-10 border border-[#30201B]/30 rounded-full text-[#30201B] backdrop-blur-sm bg-white/40"
                    aria-label="Open menu" type="button">
                    <i class="ti ti-menu-2 text-xl"></i>
                </button>

            </div>

            <!-- Mobile Dropdown Menu -->
            <div id="mobile-menu"
                class="hidden lg:hidden mt-4 mx-auto max-w-[1360px] bg-black/90 backdrop-blur-xl border border-white/10 rounded-2xl p-6 shadow-2xl relative z-50">
                <nav class="flex flex-col gap-3">
                    <a class="text-[13px] tracking-widest uppercase text-white/80 py-2 border-b border-white/10"
                        href="./index.php">Home</a>
                    <a class="text-[13px] tracking-widest uppercase text-white/80 py-2 border-b border-white/10"
                        href="menu.php">Menu</a>
                    <a class="text-[13px] tracking-widest uppercase text-white/80 py-2 border-b border-white/10"
                        href="./about.php">About</a>
                    <a class="text-[13px] tracking-widest uppercase text-white/80 py-2 border-b border-white/10"
                        href="bar.php">Bar</a>
                    <a class="text-[13px] tracking-widest uppercase text-white/80 py-2 border-b border-white/10"
                        href="./experience.php">Experience</a>
                    <a class="text-[13px] tracking-widest uppercase text-white py-2 border-b border-white/10 font-semibold"
                        href="./gallery.php">Gallery</a>
                    <a class="text-[13px] tracking-widest uppercase text-white/80 py-2 border-b border-white/10"
                        href="./contact.php">Contact</a>
                    <a href="./contact.php"
                        class="mt-2 flex items-center justify-center gap-2 bg-white text-black text-[13px] font-semibold rounded-full py-3">
                        Reserve a Table <i class="ti ti-arrow-up-right"></i>
                    </a>
                </nav>
            </div>
        </header>

        <!-- TITLE SECTION -->
        <div class="pt-6 pb-2 text-center px-4">
            <div class="inline-block relative">
                <h1 class="mora-serif text-5xl sm:text-6xl md:text-7xl text-[#30201B] tracking-tight pb-3">
                    Gallery
                </h1>
                <div class="h-[2px] w-20 bg-[#AA8243]/60 mx-auto"></div>
            </div>

            <!-- CATEGORY TABS (Food, Drink, Ambience) -->
            <div class="flex justify-center items-center gap-8 sm:gap-12 mt-4">
                <button id="tab-food" onclick="switchCategory('food')"
                    class="tab-btn tab-active font-serif mora-serif text-xl sm:text-2xl text-[#30201B] transition-all duration-200">
                    Food
                </button>
                <button id="tab-drink" onclick="switchCategory('drink')"
                    class="tab-btn font-serif mora-serif text-xl sm:text-2xl text-[#30201B]/60 hover:text-[#30201B] transition-all duration-200">
                    Drink
                </button>
                <button id="tab-ambience" onclick="switchCategory('ambience')"
                    class="tab-btn font-serif mora-serif text-xl sm:text-2xl text-[#30201B]/60 hover:text-[#30201B] transition-all duration-200">
                    Ambience
                </button>
            </div>
        </div>
    </div>

    <!-- GALLERY PHOTO GRID -->
    <main class="w-full max-w-[1360px] mx-auto px-5 sm:px-8 lg:px-12 pt-2 pb-10 flex-grow">

        <!-- FOOD GALLERY -->
        <div id="gallery-food" class="gallery-panel">
            <div class="columns-1 sm:columns-2 lg:columns-3 gap-6 sm:gap-8 w-full">
                <?php foreach ($food_images as $img): ?>
                    <?php if ($img['media_type'] === 'image'): ?>
                        <div class="mb-6 sm:mb-8 break-inside-avoid overflow-hidden rounded-md shadow-sm border border-[#30201B]/10 bg-[#dfcfbd]">
                            <img src="<?= e($img['image_path']) ?>" alt="<?= e($img['alt_text']) ?>"
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
                    <h1 class="mora-serif text-3xl sm:text-4xl md:text-5xl lg:text-[44px] xl:text-[52px] font-bold text-[#30201B] tracking-tight leading-tight">
                        <?= e(get_content($pdo, 'gallery', 'food', 'video_tagline')) ?>
                    </h1>
                </div>
            </div>
        </div>

        <!-- DRINK GALLERY -->
        <div id="gallery-drink" class="gallery-panel hidden">
            <div class="columns-1 sm:columns-2 lg:columns-3 gap-6 sm:gap-8 w-full">
                <?php foreach ($drink_images as $img): ?>
                    <?php if ($img['media_type'] === 'image'): ?>
                        <div class="mb-6 sm:mb-8 break-inside-avoid overflow-hidden rounded-md shadow-sm border border-[#30201B]/10 bg-[#dfcfbd]">
                            <img src="<?= e($img['image_path']) ?>" alt="<?= e($img['alt_text']) ?>"
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
                    <h1 class="mora-serif text-3xl sm:text-4xl md:text-5xl lg:text-[44px] xl:text-[52px] font-bold text-[#30201B] tracking-tight leading-tight">
                        <?= e(get_content($pdo, 'gallery', 'drink', 'video_tagline')) ?>
                    </h1>
                </div>
            </div>
        </div>

        <!-- AMBIENCE GALLERY -->
        <div id="gallery-ambience" class="gallery-panel hidden">
            <div class="columns-1 sm:columns-2 lg:columns-3 gap-6 sm:gap-8 w-full">
                <?php foreach ($ambience_images as $img): ?>
                    <?php if ($img['media_type'] === 'image'): ?>
                        <div class="mb-6 sm:mb-8 break-inside-avoid overflow-hidden rounded-md shadow-sm border border-[#30201B]/10 bg-[#dfcfbd]">
                            <img src="<?= e($img['image_path']) ?>" alt="<?= e($img['alt_text']) ?>"
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
                    <h1 class="mora-serif text-3xl sm:text-4xl md:text-5xl lg:text-[44px] xl:text-[52px] font-bold text-[#30201B] tracking-tight leading-tight">
                        <?= e(get_content($pdo, 'gallery', 'ambience', 'video_tagline')) ?>
                    </h1>
                </div>
            </div>
        </div>

    </main>

    <div class="pt-6 pb-2 text-center px-4">
        <div class="inline-block relative">
            <h1 class="cambria text-5xl sm:text-2xl md:text-xl text-[#30201B] tracking-tight pb-0">
                INSTAGRAM
            </h1>
            <div class="h-[2px] w-20 bg-[#AA8243]/60 mx-auto"></div>
            <h1 class="cambria text-5xl sm:text-2xl md:text-4xl text-[#30201B] tracking-tight pb-0"><b>
                    @chouseuae
                </b></h1>
            <div class="h-[2px] w-20 bg-[#AA8243]/60 mx-auto"></div>
        </div>
    </div>

    <!-- FOOTER -->
    <?php include __DIR__ . '/includes/footer.php'; ?>

    <!-- SCRIPT FOR TABS & MOBILE MENU -->
    <script>
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
                btn.classList.add('text-[#30201B]/60');
            });

            const activeBtn = document.getElementById('tab-' + cat);
            if (activeBtn) {
                activeBtn.classList.add('tab-active');
                activeBtn.classList.remove('text-[#30201B]/60');
            }
        }

        // Mobile menu toggle
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        if (mobileMenuBtn && mobileMenu) {
            mobileMenuBtn.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });
        }
    </script>
    <a href="https://wa.me/971522185569?text=Hello%2C%20I%20would%20like%20to%20make%20a%20reservation." target="_blank"
        class="fixed bottom-6 right-6 lg:bottom-10 lg:right-10 z-50 bg-[#30201B] text-[#f5e6c8] border border-[#f5e6c8]/20 w-14 h-14 rounded-full flex items-center justify-center shadow-[0_8px_30px_rgb(0,0,0,0.3)] hover:bg-[#f5e6c8] hover:text-[#30201B] hover:scale-110 transition-all duration-300">
        <i class="ti ti-brand-whatsapp text-2xl"></i>
    </a>
</body>

</html>