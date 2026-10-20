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

function get_chouse_instagram_posts() {
    $cache_file = __DIR__ . '/admin/cache_ig_feed.json';
    $cache_time = 3600; // 1 hour

    if (file_exists($cache_file) && (time() - filemtime($cache_file) < $cache_time)) {
        $cached = @json_decode(file_get_contents($cache_file), true);
        if (!empty($cached) && is_array($cached)) {
            return $cached;
        }
    }

    $default_posts = [
        [
            'link' => 'https://www.instagram.com/reel/DeqlmOsOQct/',
            'image' => 'https://scontent-cdg4-2.cdninstagram.com/v/t51.71878-15/852725471_4538923356345782_7863023545887054648_n.jpg?stp=dst-jpg_e35_tt6&_nc_cat=101&ccb=7-5&_nc_sid=18de74&efg=eyJlZmdfdGFnIjoiQ0xJUFMuYmVzdF9pbWFnZV91cmxnZW4uQzMifQ%3D%3D&_nc_ohc=NLIwKNvuezIQ7kNvwGUEslw&_nc_oc=Adr4OoWSN9B2bmjq3rXGu3jJ2Ojpf9C121Iy0jLYmFZlUwGIZA5DL4acaDLdu3qTezglAL1DzZm3mdnIRmGUeX5s&_nc_zt=23&_nc_ht=scontent-cdg4-2.cdninstagram.com&edm=ANo9K5cEAAAA&_nc_gid=SXuLv_0QOKGvGt-GP5RcRw&_nc_tpa=Q5bMBQIH_kBt44MMfi6mf8StES2e-sb6UHXrXlSv8ZkycV-Oy1mS8PnPXP2l32zqMlAo_nq3WN5hQixOcA&oh=00_AQMv1Tg22XeSS1ubetlr_5TV3o0ewyGP-c4BQbvmPpKmOw&oe=6ADCBB51',
            'alt' => 'C HOUSE Milano - Flying Burgers'
        ],
        [
            'link' => 'https://www.instagram.com/p/DeoXWEnDVle/',
            'image' => 'https://scontent-cdg4-2.cdninstagram.com/v/t39.30808-6/854712631_122130428157381623_4004513519184365506_n.jpg?stp=dst-jpg_e35_tt6&_nc_cat=107&ccb=7-5&_nc_sid=18de74&efg=eyJlZmdfdGFnIjoiRkVFRC5iZXN0X2ltYWdlX3VybGdlbi5DMyJ9&_nc_ohc=llTJqvbHtKgQ7kNvwGWBlGP&_nc_oc=Ado9BqW-d-0ouzoiEJHVbgwEMkG3uwGlq8jasSeffLFNGO4EM5lVXZ5Y877XK8xgPDeHpIg_2vssRFub3RmcUO2e&_nc_zt=23&_nc_ht=scontent-cdg4-2.cdninstagram.com&edm=ANo9K5cEAAAA&_nc_gid=SXuLv_0QOKGvGt-GP5RcRw&_nc_tpa=Q5bMBQIw0faj_dukY4IEVuGXPwJxi7AXsuWf9Hwje3aSu87CkzaIrcaZU0dejhfgkLF2za4LOZDsBW2SqQ&oh=00_AQNtmA8hc69T9rJxtESuanUCwwFrVIQEQwHcnQn5jdJKwQ&oe=6ADC8F2E',
            'alt' => 'C HOUSE Milano - Classic Lasagna'
        ],
        [
            'link' => 'https://www.instagram.com/p/DejtHY4lhkB/',
            'image' => 'https://scontent-cdg6-1.cdninstagram.com/v/t39.30808-6/853231502_122130135579381623_1241564370730763250_n.jpg?stp=dst-jpg_e35_tt6&_nc_cat=105&ccb=7-5&_nc_sid=18de74&efg=eyJlZmdfdGFnIjoiRkVFRC5iZXN0X2ltYWdlX3VybGdlbi5DMyJ9&_nc_ohc=usYE7ItPLjsQ7kNvwFRmJpr&_nc_oc=AdqM39mn53c_84nfs_hYbPAW2TSTku3-Ok-Yd0MJHbcgutamxKj_TdEj0mc1GDYlCpzNSO2jiGS3wjYdKybQ82tx&_nc_zt=23&_nc_ht=scontent-cdg6-1.cdninstagram.com&edm=ANo9K5cEAAAA&_nc_gid=SXuLv_0QOKGvGt-GP5RcRw&_nc_tpa=Q5bMBQKoqp9nJDuccRq5YKYJiGxhryxOcD706pBKSIB1ugQIQrui8LLEuStfEkWhc91OUqf_SRX9rag7Xg&oh=00_AQNQavOS5P8oKmSxLFK2K3xcbyoZeCJ2T43so4hd0ge1tg&oe=6ADCBCD9',
            'alt' => 'C HOUSE Milano - Stacked Burger'
        ],
        [
            'link' => 'https://www.instagram.com/p/DeeqJh0G7Ee/',
            'image' => 'https://scontent-cdg4-3.cdninstagram.com/v/t39.30808-6/849605589_122129798913381623_5723555336399791931_n.jpg?stp=dst-jpg_e35_tt6&_nc_cat=111&ccb=7-5&_nc_sid=18de74&efg=eyJlZmdfdGFnIjoiRkVFRC5iZXN0X2ltYWdlX3VybGdlbi5DMyJ9&_nc_ohc=xUMmfd7N-DYQ7kNvwGoNaVH&_nc_oc=AdrZ8Jo-LsLroMhxNLUn47UTWVg8yOsuz3VCRox2EeylLMScnZHtRWasx6Sq2NtYk0nNoLDhhZojkUPNl7CezZDA&_nc_zt=23&_nc_ht=scontent-cdg4-3.cdninstagram.com&edm=ANo9K5cEAAAA&_nc_gid=SXuLv_0QOKGvGt-GP5RcRw&_nc_tpa=Q5bMBQJhNQ2pfVtpWgWQfN1rM_dYBRf637kgXPEk1chEU2NQS2TN81QKb1L62LJSWt5iRrm-zGpRGekpgQ&oh=00_AQNHsPqw-j0ixUx-YzDeE7xZyrsEWgInhgEUY5qeyi99nA&oe=6ADCC391',
            'alt' => 'C HOUSE Milano - Evening Dining'
        ],
        [
            'link' => 'https://www.instagram.com/p/DeZSoifAAUQ/',
            'image' => 'https://scontent-cdg4-2.cdninstagram.com/v/t39.30808-6/809876394_122124695721381623_891921924004349362_n.jpg?stp=dst-jpg_e35_tt6&_nc_cat=101&ccb=7-5&_nc_sid=18de74&efg=eyJlZmdfdGFnIjoiRkVFRC5iZXN0X2ltYWdlX3VybGdlbi5DMyJ9&_nc_ohc=gYfXqgdfnJIQ7kNvwGc2a9D&_nc_oc=Adp3HPF7lPcyQeO8fdsx-wxtb9X4A3dG8pKc6Ayu01z6noNBmLZBTmCX64LusIOHEN8qfWmIEPYHVtCv5WFSgswT&_nc_zt=23&_nc_ht=scontent-cdg4-2.cdninstagram.com&edm=ANo9K5cEAAAA&_nc_gid=SXuLv_0QOKGvGt-GP5RcRw&_nc_tpa=Q5bMBQICKlQXMK3ZgAxkW_PkuJ2On1OcAYWHhrFBxzh7bnERnMsw8O6KADvVxiOlkeGggEwUqRHKqvzj7g&oh=00_AQPWHpufDlDvPb-Ysqu1_rtGeVf8fl3mNDcr8LBNoN8M3g&oe=6ADC8FC7',
            'alt' => 'C HOUSE Milano - Nachos Grande'
        ],
        [
            'link' => 'https://www.instagram.com/reel/DeUJ8JTOLE5/',
            'image' => 'https://scontent-cdg6-1.cdninstagram.com/v/t51.71878-15/844394516_28930067916618114_4247661399530995559_n.jpg?stp=dst-jpg_e35_tt6&_nc_cat=106&ccb=7-5&_nc_sid=18de74&efg=eyJlZmdfdGFnIjoiQ0xJUFMuYmVzdF9pbWFnZV91cmxnZW4uQzMifQ%3D%3D&_nc_ohc=hka4XwT217EQ7kNvwHXu4-Z&_nc_oc=AdqkNZJQn6Nq6xyrOuGBlY4hPsy4oYRB758gR31LEAwodJMeuIIlRCrur7usiKRAvKe31YGyemNILSdkPw8aqYm5&_nc_zt=23&_nc_ht=scontent-cdg6-1.cdninstagram.com&edm=ANo9K5cEAAAA&_nc_gid=SXuLv_0QOKGvGt-GP5RcRw&_nc_tpa=Q5bMBQKCRigVh7uf_xKRb02gcqaLzPNjkrSPHTQmugeeNpL4LHlkjvfLhbBNQP-IYnK9fwoV_AwVNQhRBQ&oh=00_AQObctScbS2fUm1O80nlMxGeVk0c_m4Z4LtCJT2M6A3V6w&oe=6ADC8CD7',
            'alt' => 'C HOUSE Milano - Signature Cocktail'
        ],
        [
            'link' => 'https://www.instagram.com/reel/DeO_hj2j1IL/',
            'image' => 'https://scontent-cdg4-1.cdninstagram.com/v/t51.82787-15/840873754_18140891644677997_5750442986992468663_n.jpg?stp=dst-jpg_e35_tt6&_nc_cat=104&ccb=7-5&_nc_sid=18de74&efg=eyJlZmdfdGFnIjoiQ0xJUFMuYmVzdF9pbWFnZV91cmxnZW4uQzMifQ%3D%3D&_nc_ohc=j7dSchDUFPgQ7kNvwFdjx7B&_nc_oc=Adpty_C_eMCpl6jx1nPkH4dZvN58TSev_PUDXgyZiJaW7OlUMTHJ3eQnEW_wIh68sNYs2P58REV0LkpvnFRoX5xQ&_nc_zt=23&_nc_ht=scontent-cdg4-1.cdninstagram.com&edm=ANo9K5cEAAAA&_nc_gid=SXuLv_0QOKGvGt-GP5RcRw&_nc_tpa=Q5bMBQLDscbnKk4XtHjRrConMEA2DilDVoe_H3X4RB82_NJM_-tsEN73if3zA0x1zSOvzYanAzXOCYsBaA&oh=00_AQOfi2TA02Oa_8W4wX-VY9U7lZSOPz28ncmW8U2dtAA12w&oe=6ADC9076',
            'alt' => 'C HOUSE Milano - Mixology & Dining'
        ],
        [
            'link' => 'https://www.instagram.com/reel/DeJ1sI3OFXu/',
            'image' => 'https://scontent-cdg4-1.cdninstagram.com/v/t51.71878-15/838403591_1636731787812634_8896308091769563565_n.jpg?stp=dst-jpg_e35_tt6&_nc_cat=102&ccb=7-5&_nc_sid=18de74&efg=eyJlZmdfdGFnIjoiQ0xJUFMuYmVzdF9pbWFnZV91cmxnZW4uQzMifQ%3D%3D&_nc_ohc=y8RPAaI6eq0Q7kNvwG_pnn1&_nc_oc=Adra08wSOa43dzRAqGVNNMfZrwi6-xlh7kuS3RGas0ZCO-ti4zR1oRQrhMvXoWeLU1xlKK5fFACq-Zwjg4nIVYW2&_nc_zt=23&_nc_ht=scontent-cdg4-1.cdninstagram.com&edm=ANo9K5cEAAAA&_nc_gid=SXuLv_0QOKGvGt-GP5RcRw&_nc_tpa=Q5bMBQJPTM4BksIwn7UywFNG1N6lFQx4MH29ZTyZ5LQUpOer97md99kr1u5BJzT6rpNTU30JdHU6rUdaPQ&oh=00_AQP7wDhBoQ3b0-gxoWhReGnuBubkFGTjzbTnyOpni28TOA&oe=6ADCAAC2',
            'alt' => 'C HOUSE Milano - Truffle Burger'
        ],
    ];

    $ctx = stream_context_create([
        'http' => [
            'timeout' => 3,
            'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36'
        ]
    ]);
    $html = @file_get_contents('https://feed.chouse.ae/?page_id=7&v=3', false, $ctx);
    if ($html) {
        $parsed = [];
        if (preg_match_all('/<div[^>]+class=[\x27\"][^\x27\"]*sbi_item[^\x27\"]*[\x27\"][^>]*>(.*?)<\/div>\s*<\/div>/is', $html, $matches)) {
            foreach ($matches[0] as $block) {
                $link = '';
                $img = '';
                $alt = 'C HOUSE Instagram Post';
                if (preg_match('/<a[^>]+href=[\x27\"]([^\x27\"]+)[\x27\"]/i', $block, $m)) {
                    $link = $m[1];
                }
                if (preg_match('/data-full-res=[\x27\"]([^\x27\"]+)[\x27\"]/i', $block, $m)) {
                    $img = $m[1];
                }
                if (preg_match('/<img[^>]+alt=[\x27\"]([^\x27\"]*)[\x27\"]/i', $block, $m)) {
                    $alt = html_entity_decode($m[1], ENT_QUOTES | ENT_HTML5, 'UTF-8');
                }
                if ($link && $img) {
                    $parsed[] = [
                        'link' => $link,
                        'image' => $img,
                        'alt' => mb_substr($alt, 0, 80)
                    ];
                }
            }
        }
        if (!empty($parsed)) {
            @file_put_contents($cache_file, json_encode($parsed, JSON_PRETTY_PRINT));
            return $parsed;
        }
    }

    return $default_posts;
}
$ig_posts = get_chouse_instagram_posts();
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

        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        .ig-first-card {
            margin-left: 1rem;
        }
        @media (min-width: 640px) {
            .ig-first-card {
                margin-left: 1.5rem;
            }
        }
        @media (min-width: 1024px) {
            .ig-first-card {
                margin-left: max(2rem, calc((100vw - 1360px) / 2 + 2rem));
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
            <picture>
                <source media="(min-width: 768px)" srcset="gallery/gallery-hero-desktop.webp?v=3">
                <img alt="Gallery hero" class="h-full w-full object-cover opacity-30" decoding="async"
                    src="gallery/ambience15.webp" />
            </picture>
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/45 to-transparent"></div>
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

    <!-- INSTAGRAM / FOLLOW US SECTION -->
    <section class="w-full pt-8 sm:pt-12 pb-12 sm:pb-16 overflow-hidden">
        <!-- Header: FOLLOW US & Instagram Profile Badge -->
        <div class="w-full max-w-[1360px] mx-auto px-4 sm:px-6 lg:px-8 mb-6 sm:mb-8">
            <div class="flex items-center justify-between gap-4">
                <h2 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-[#30201B] tracking-tight font-sans">
                    FOLLOW US
                </h2>
                <a href="https://www.instagram.com/chouseuae/" target="_blank" rel="noopener noreferrer"
                    class="flex items-center gap-2.5 sm:gap-3 group hover:opacity-85 transition-opacity">
                    <!-- Instagram Gradient Icon -->
                    <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-[12px] bg-gradient-to-tr from-[#f9ce34] via-[#ee2a7b] to-[#6228d7] flex items-center justify-center text-white shadow-sm shrink-0">
                        <svg class="w-5 h-5 text-white fill-current" viewBox="0 0 24 24">
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                        </svg>
                    </div>
                    <!-- Profile details -->
                    <div class="flex flex-col text-left leading-tight">
                        <span class="text-xs sm:text-sm font-bold text-[#30201B] tracking-tight group-hover:text-[#AA8243] transition-colors">
                            C HOUSE Milano
                        </span>
                        <span class="text-[11px] sm:text-xs text-[#30201B]/70 font-medium">
                            @chouseuae
                        </span>
                    </div>
                </a>
            </div>
        </div>

        <!-- Carousel Container with Smooth Arrow Controls (Edge-to-Edge) -->
        <div class="relative w-full group/carousel">
            <!-- Left Arrow Button (Desktop) -->
            <button id="ig-scroll-left" aria-label="Scroll left"
                class="hidden md:flex absolute left-4 lg:left-8 top-1/2 -translate-y-1/2 z-20 w-11 h-11 rounded-full bg-white/95 text-[#30201B] shadow-xl border border-black/10 items-center justify-center opacity-0 group-hover/carousel:opacity-100 transition-opacity duration-300 hover:bg-[#30201B] hover:text-white">
                <i class="ti ti-chevron-left text-xl"></i>
            </button>

            <!-- Cards Track (Edge-to-Edge with padding on first card only) -->
            <div id="ig-carousel-track"
                class="flex gap-4 sm:gap-6 overflow-x-auto no-scrollbar scroll-smooth snap-x snap-mandatory py-2 w-full">
                <?php foreach ($ig_posts as $index => $post): ?>
                <a href="<?= htmlspecialchars($post['link']) ?>" target="_blank" rel="noopener noreferrer"
                    class="<?= $index === 0 ? 'ig-first-card ' : '' ?><?= $index === count($ig_posts) - 1 ? 'mr-4 sm:mr-6 lg:mr-8 ' : '' ?>relative shrink-0 snap-start w-[240px] sm:w-[270px] md:w-[290px] h-[390px] sm:h-[440px] md:h-[470px] rounded-[22px] overflow-hidden group shadow-md hover:shadow-2xl transition-all duration-300 select-none block bg-neutral-900 border border-[#30201B]/10">
                    <img src="<?= htmlspecialchars($post['image']) ?>" alt="<?= htmlspecialchars($post['alt']) ?>"
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out" loading="lazy">
                </a>
                <?php endforeach; ?>
            </div>

            <!-- Right Arrow Button (Desktop) -->
            <button id="ig-scroll-right" aria-label="Scroll right"
                class="hidden md:flex absolute right-4 lg:right-8 top-1/2 -translate-y-1/2 z-20 w-11 h-11 rounded-full bg-white/95 text-[#30201B] shadow-xl border border-black/10 items-center justify-center opacity-0 group-hover/carousel:opacity-100 transition-opacity duration-300 hover:bg-[#30201B] hover:text-white">
                <i class="ti ti-chevron-right text-xl"></i>
            </button>
        </div>
    </section>

    <!-- FOOTER -->
    <?php include __DIR__ . '/includes/footer.php'; ?>

    <!-- SCRIPT FOR TABS, MOBILE MENU & CAROUSEL -->
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

            // Instagram Carousel scroll controls
            const igTrack = document.getElementById('ig-carousel-track');
            const igPrev = document.getElementById('ig-scroll-left');
            const igNext = document.getElementById('ig-scroll-right');
            if (igTrack && igPrev && igNext) {
                igPrev.addEventListener('click', () => {
                    igTrack.scrollBy({ left: -320, behavior: 'smooth' });
                });
                igNext.addEventListener('click', () => {
                    igTrack.scrollBy({ left: 320, behavior: 'smooth' });
                });
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