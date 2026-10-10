<?php
require_once __DIR__ . '/admin/includes/db.php';
require_once __DIR__ . '/admin/includes/functions.php';
$s = get_all_settings($pdo);
$about_content = get_page_content($pdo, 'about');
$reviews = get_reviews($pdo);
?>

<!DOCTYPE html>
<html lang="en" class="bg-[#1C1A18] overscroll-none">

<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <title>About Us &mdash; C HOUSE &middot; Italian Bistro &middot; Bar &middot; Lounge</title>
  <meta name="description" content="About C HOUSE &mdash; Italian Bistro, Bar &amp; Lounge in Dubai Jebel Ali." />

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
    body {
      font-family: 'Manrope', sans-serif;
      margin: 0;
      padding: 0;
      background-color: #000;
      color: #fff;
    }

    #mora-page .mora-text-action:hover {
      color: var(--mora-clay);
    }

    #mora-page a:hover,
    #mora-page button:hover {
      text-decoration-color: #AA8243 !important;
      color: #AA8243;
    }

    .mora-serif {
      font-family: 'DM Serif Display', Georgia, serif;
    }

    /* A-07: auto-scrolling review row */
    .review-marquee {
      -webkit-mask-image: linear-gradient(to right, transparent, #000 8%, #000 92%, transparent);
      mask-image: linear-gradient(to right, transparent, #000 8%, #000 92%, transparent);
    }

    .review-track {
      animation: review-scroll 45s linear infinite;
    }

    .review-marquee:hover .review-track {
      animation-play-state: paused;
    }

    @keyframes review-scroll {
      from {
        transform: translateX(0);
      }

      to {
        transform: translateX(-50%);
      }
    }

    @media (prefers-reduced-motion: reduce) {
      .review-track {
        animation: none;
      }

      .review-marquee {
        overflow-x: auto;
      }
    }

    .mora-menu-link:hover {
      color: #C76D4D;
      border-color: #C76D4D;
    }
  </style>
</head>

<body class="bg-black text-white overflow-x-hidden">

  <!-- HERO CONTAINER -->
  <div class="relative min-h-[55svh] w-full flex flex-col justify-between overflow-hidden">

    <!-- BACKGROUND IMAGE -->
    <div class="absolute inset-0 z-0">
      <img src="<?= e($about_content['hero']['image'] ?? 'gallery/about-hero.webp') ?>" alt="C HOUSE Outdoor Terrace"
        class="h-full w-full object-cover object-center" />
      <!-- Subtle Dark Overlay for Crisp Contrast -->
      <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-black/25 to-black/65"></div>
    </div>

    <!-- NAVBAR (MATCHING INDEX.HTML WITH ROUND WHITE RESERVE BUTTON) -->
    <header id="site-header" aria-label="Primary navigation" class="fixed top-0 inset-x-0 z-50 pt-3 pb-3 px-5 sm:px-8 lg:px-12 text-white transition-all duration-300">
      <div class="mx-auto flex h-[72px] max-w-[1360px] items-center justify-between relative">

        <!-- Logo & Brand Name -->
        <div class="flex items-center">
          <a aria-label="home" class="flex items-center gap-3 text-white" href="./index.php">
            <img src="gallery/logo.webp" class="h-28 w-auto object-contain -ml-4" alt="C HOUSE Logo" />
            <span class="font-sans text-[32px] tracking-[0.2em] font-light text-white">C HOUSE</span>
          </a>
        </div>

        <!-- Center Floating Navigation Pill (from index.html) -->
        <nav aria-label="Main links"
          class="hidden items-center gap-1 rounded-full bg-black/40 px-3 py-1.5 lg:flex backdrop-blur-md border border-white/10 shadow-lg">
          <a class="flex items-center gap-1.5 rounded-full px-4 py-2 text-[13px] tracking-widest uppercase text-gray-200 transition-colors hover:bg-white/10 hover:text-white"
            href="./index.php">Home</a>
          <a class="flex items-center gap-1.5 rounded-full px-4 py-2 text-[13px] tracking-widest uppercase text-gray-200 transition-colors hover:bg-white/10 hover:text-white"
            href="./menu.php">Menu</a>
          <a class="flex items-center gap-1.5 rounded-full px-4 py-2 text-[13px] tracking-widest uppercase bg-white/20 text-white font-semibold"
            href="./about.php" aria-current="page">About</a>
          <a class="flex items-center gap-1.5 rounded-full px-4 py-2 text-[13px] tracking-widest uppercase text-gray-200 transition-colors hover:bg-white/10 hover:text-white"
            href="./bar.php">Bar</a>
          <a class="flex items-center gap-1.5 rounded-full px-4 py-2 text-[13px] tracking-widest uppercase text-gray-200 transition-colors hover:bg-white/10 hover:text-white"
            href="./experience.php">Experience</a> <a
            class="flex items-center gap-1.5 rounded-full px-4 py-2 text-[13px] tracking-widest uppercase text-gray-200 transition-colors hover:bg-white/10 hover:text-white"
            href="./gallery.php">Gallery</a>
          <a class="flex items-center gap-1.5 rounded-full px-4 py-2 text-[13px] tracking-widest uppercase text-gray-200 transition-colors hover:bg-white/10 hover:text-white"
            href="./contact.php">Contact</a>
        </nav>

        <!-- Right: Reserve a Table Button (Round edges, White Background) -->
        <div class="hidden lg:flex items-center gap-4">
          <a href="./contact.php"
            class="flex items-center gap-2.5 bg-white text-[#30201B] text-[13px] font-semibold tracking-wide rounded-full px-7 py-3 hover:bg-[#5C3D2E] hover:text-white transition-colors shadow-md border border-[#30201B]/10">
            <span>Reserve a Table</span>
            <i class="ti ti-arrow-up-right text-base"></i>
          </a>
        </div>

        <!-- Mobile Menu Toggle Button -->
        <button id="mobile-menu-btn"
          class="lg:hidden flex items-center justify-center w-10 h-10 border border-white/30 rounded-full text-white backdrop-blur-sm bg-black/30"
          aria-label="Open menu" type="button">
          <i class="ti ti-menu-2 text-xl"></i>
        </button>

      </div>

      <!-- Mobile Dropdown Menu -->
      <div id="mobile-menu"
        class="hidden lg:hidden mt-4 mx-auto max-w-[1360px] bg-black/90 backdrop-blur-xl border border-white/10 rounded-2xl p-6 shadow-2xl">
        <nav class="flex flex-col gap-3">
          <a class="text-[13px] tracking-widest uppercase text-white/80 py-2 border-b border-white/10"
            href="./index.php">Home</a>
          <a class="text-[13px] tracking-widest uppercase text-white/80 py-2 border-b border-white/10"
            href="menu.php">Menu</a>
          <a class="text-[13px] tracking-widest uppercase text-white py-2 border-b border-white/10 font-semibold"
            href="./about.php">About</a>
          <a class="text-[13px] tracking-widest uppercase text-white/80 py-2 border-b border-white/10"
            href="bar.php">Bar</a>
          <a class="text-[13px] tracking-widest uppercase text-white/80 py-2 border-b border-white/10"
            href="./experience.php">Experience</a>
          <a class="text-[13px] tracking-widest uppercase text-white/80 py-2 border-b border-white/10"
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

    <!-- CENTER HERO CONTENT: ABOUT US IN BIG WHITE LETTERS -->
    <main class="relative z-10 flex-1 flex items-center justify-center px-5 pt-36 pb-10 text-center">
      <h1 class="mora-serif text-white text-5xl md:text-7xl font-normal tracking-tight leading-tight select-none drop-shadow-2xl">
        <?= e($about_content['hero']['heading'] ?? 'About Us') ?>
      </h1>
    </main>

    <!-- Bottom Spacing Anchor -->
    <div class="relative z-10 pb-4 sm:pb-6"></div>

  </div>

  <!-- OUR STORY SECTION -->
  <section class="bg-white text-[#30201B] py-12 sm:py-16 lg:py-20 px-6 sm:px-12 lg:px-20">
    <div class="mx-auto max-w-[1360px] grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-16 items-center">

      <!-- Left Column: Heading and Paragraph -->
      <div class="lg:col-span-6 flex flex-col justify-center pr-0 lg:pr-4">
        <h2 class="mora-serif text-4xl sm:text-5xl lg:text-[56px] font-normal text-[#30201B] tracking-tight leading-tight mb-6 sm:mb-8">
          <?= e($about_content['story']['heading']) ?>
        </h2>
        <p class="text-base sm:text-[17px] text-[#4a3e39] leading-[1.85] font-normal">
          <?= e($about_content['story']['paragraph']) ?>
        </p>
      </div>

      <!-- Right Column: Picture with Rounded Corners -->
      <div class="lg:col-span-6 w-full flex justify-center lg:justify-end">
        <div class="w-full overflow-hidden rounded-[24px] sm:rounded-[28px] shadow-xl">
          <img src="<?= e($about_content['story']['image']) ?>" alt="C HOUSE Night View"
            class="w-full h-[320px] sm:h-[400px] lg:h-[440px] object-cover object-center" />
        </div>

      </div>
    </div>
  </section>

  <!-- WHAT MAKES US SPECIAL SECTION -->
  <section class="bg-white text-[#30201B] py-10 sm:py-12 lg:py-16 px-6 sm:px-12 lg:px-20 border-t border-[#30201B]/10"
    id="what-makes-us-special">
    <div class="mx-auto max-w-[1360px] grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">

      <!-- Left Column: Carousel (3 Images) -->
      <div class="lg:col-span-6 w-full">
        <div
          class="relative h-[380px] sm:h-[450px] lg:h-[490px] w-full overflow-hidden rounded-[24px] sm:rounded-[28px] shadow-2xl bg-neutral-900 group"
          id="special-carousel">

          <!-- Slide 1: Dining -->
          <div class="special-slide absolute inset-0 transition-opacity duration-700 ease-in-out opacity-100 z-10"
            data-idx="0">
            <img src="<?= e($about_content['special']['slide_1_image']) ?>" alt="Premium Dining Experience at C HOUSE"
              class="h-full w-full object-cover object-center" />
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
            <div class="absolute bottom-6 left-6 right-6 text-white z-10">
              <span
                class="text-[10px] uppercase tracking-[.2em] text-[#F2E7D4] font-bold bg-white/15 backdrop-blur-md px-3 py-1 rounded-full border border-white/20 inline-block mb-2"><?= e($about_content['special']['slide_1_tag']) ?></span>
              <h3 class="mora-serif text-2xl sm:text-3xl text-white font-medium"><?= e($about_content['special']['slide_1_title']) ?></h3>
              <p class="text-xs sm:text-sm text-gray-200 mt-1 max-w-md leading-relaxed"><?= e($about_content['special']['slide_1_desc']) ?></p>
            </div>
          </div>

          <!-- Slide 2: Drinks -->
          <div
            class="special-slide absolute inset-0 transition-opacity duration-700 ease-in-out opacity-0 pointer-events-none z-0"
            data-idx="1">
            <img src="<?= e($about_content['special']['slide_2_image']) ?>" alt="Premium Dining Experience at C HOUSE"
              class="h-full w-full object-cover object-center" />
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
            <div class="absolute bottom-6 left-6 right-6 text-white z-10">
              <span
                class="text-[10px] uppercase tracking-[.2em] text-[#F2E7D4] font-bold bg-white/15 backdrop-blur-md px-3 py-1 rounded-full border border-white/20 inline-block mb-2"><?= e($about_content['special']['slide_2_tag']) ?></span>
              <h3 class="mora-serif text-2xl sm:text-3xl text-white font-medium"><?= e($about_content['special']['slide_2_title']) ?>
              </h3>
              <p class="text-xs sm:text-sm text-gray-200 mt-1 max-w-md leading-relaxed"><?= e($about_content['special']['slide_2_desc']) ?></p>
            </div>
          </div>

          <!-- Slide 3: Terrace -->
          <div
            class="special-slide absolute inset-0 transition-opacity duration-700 ease-in-out opacity-0 pointer-events-none z-0"
            data-idx="2">
            <img src="<?= e($about_content['special']['slide_3_image']) ?>" alt="Premium Dining Experience at C HOUSE"
              class="h-full w-full object-cover object-center" />
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
            <div class="absolute bottom-6 left-6 right-6 text-white z-10">
              <span
                class="text-[10px] uppercase tracking-[.2em] text-[#F2E7D4] font-bold bg-white/15 backdrop-blur-md px-3 py-1 rounded-full border border-white/20 inline-block mb-2"><?= e($about_content['special']['slide_3_tag']) ?></span>
              <h3 class="mora-serif text-2xl sm:text-3xl text-white font-medium"><?= e($about_content['special']['slide_3_title']) ?></h3>
              <p class="text-xs sm:text-sm text-gray-200 mt-1 max-w-md leading-relaxed"><?= e($about_content['special']['slide_3_desc']) ?></p>
            </div>
          </div>

          <!-- Carousel Controls -->
          <button id="special-prev"
            class="absolute left-4 top-1/2 -translate-y-1/2 z-20 w-11 h-11 rounded-full bg-black/50 hover:bg-[#A84F37] text-white border border-white/20 flex items-center justify-center transition-all backdrop-blur-sm shadow-lg focus:outline-none"
            aria-label="Previous slide">
            <i class="ti ti-chevron-left text-xl"></i>
          </button>
          <button id="special-next"
            class="absolute right-4 top-1/2 -translate-y-1/2 z-20 w-11 h-11 rounded-full bg-black/50 hover:bg-[#A84F37] text-white border border-white/20 flex items-center justify-center transition-all backdrop-blur-sm shadow-lg focus:outline-none"
            aria-label="Next slide">
            <i class="ti ti-chevron-right text-xl"></i>
          </button>

          <!-- Dots -->
          <div class="absolute bottom-4 left-1/2 -translate-x-1/2 z-20 flex items-center gap-2" id="special-dots">
            <button class="special-dot h-1.5 rounded-full transition-all duration-300 w-7 bg-white" data-index="0"
              aria-label="Slide 1"></button>
            <button class="special-dot h-1.5 rounded-full transition-all duration-300 w-2 bg-white/40 hover:bg-white/70"
              data-index="1" aria-label="Slide 2"></button>
            <button class="special-dot h-1.5 rounded-full transition-all duration-300 w-2 bg-white/40 hover:bg-white/70"
              data-index="2" aria-label="Slide 3"></button>
          </div>

        </div>
      </div>

      <!-- Right Column: Matter & 4 Vertical Dropdown Buttons -->
      <div class="lg:col-span-6 flex flex-col justify-center">
        <h2 class="mora-serif text-3xl sm:text-4xl lg:text-[46px] font-normal text-[#30201B] tracking-tight leading-tight mb-3">
          <?= e($about_content['special']['heading']) ?>
        </h2>
        <p class="text-base sm:text-[16px] text-[#4a3e39] leading-relaxed font-normal mb-8">
          <?= e($about_content['special']['intro']) ?>
        </p>

        <!-- 4 Vertical Dropdown Accordion Buttons -->
        <div class="flex flex-col gap-3.5 w-full" id="special-accordion">

          <!-- Dropdown 1 -->
          <div class="accordion-item rounded-xl border border-[#30201B]/12 overflow-hidden transition-all duration-300">
            <button
              class="accordion-header w-full flex items-center justify-between px-6 py-4 text-left font-semibold text-sm sm:text-base tracking-wide uppercase transition-colors bg-[#C76D4D] text-white"
              type="button">
              <span><?= e($about_content['special']['accordion_1_title']) ?></span>
              <i class="ti ti-chevron-down text-lg transition-transform duration-300 transform rotate-180"></i>
            </button>
            <div
              class="accordion-content px-6 py-4 bg-[#FAF7F2] text-[#4a3e39] text-sm leading-relaxed border-t border-[#30201B]/10">
              <p><?= e($about_content['special']['accordion_1_content']) ?></p>
            </div>
          </div>

          <!-- Dropdown 2 -->
          <div class="accordion-item rounded-xl border border-[#30201B]/12 overflow-hidden transition-all duration-300">
            <button
              class="accordion-header w-full flex items-center justify-between px-6 py-4 text-left font-semibold text-sm sm:text-base tracking-wide uppercase transition-colors bg-[#F5F2EB] text-[#30201B] hover:bg-[#EFE9DF]"
              type="button">
              <span><?= e($about_content['special']['accordion_2_title']) ?></span>
              <i class="ti ti-chevron-down text-lg transition-transform duration-300"></i>
            </button>
            <div
              class="accordion-content hidden px-6 py-4 bg-[#FAF7F2] text-[#4a3e39] text-sm leading-relaxed border-t border-[#30201B]/10">
              <p><?= e($about_content['special']['accordion_2_content']) ?></p>
            </div>
          </div>

          <!-- Dropdown 3 -->
          <div class="accordion-item rounded-xl border border-[#30201B]/12 overflow-hidden transition-all duration-300">
            <button
              class="accordion-header w-full flex items-center justify-between px-6 py-4 text-left font-semibold text-sm sm:text-base tracking-wide uppercase transition-colors bg-[#F5F2EB] text-[#30201B] hover:bg-[#EFE9DF]"
              type="button">
              <span><?= e($about_content['special']['accordion_3_title']) ?></span>
              <i class="ti ti-chevron-down text-lg transition-transform duration-300"></i>
            </button>
            <div
              class="accordion-content hidden px-6 py-4 bg-[#FAF7F2] text-[#4a3e39] text-sm leading-relaxed border-t border-[#30201B]/10">
              <p><?= e($about_content['special']['accordion_3_content']) ?></p>
            </div>
          </div>

          <!-- Dropdown 4 -->
          <div class="accordion-item rounded-xl border border-[#30201B]/12 overflow-hidden transition-all duration-300">
            <button
              class="accordion-header w-full flex items-center justify-between px-6 py-4 text-left font-semibold text-sm sm:text-base tracking-wide uppercase transition-colors bg-[#F5F2EB] text-[#30201B] hover:bg-[#EFE9DF]"
              type="button">
              <span><?= e($about_content['special']['accordion_4_title']) ?></span>
              <i class="ti ti-chevron-down text-lg transition-transform duration-300"></i>
            </button>
            <div
              class="accordion-content hidden px-6 py-4 bg-[#FAF7F2] text-[#4a3e39] text-sm leading-relaxed border-t border-[#30201B]/10">
              <p><?= e($about_content['special']['accordion_4_content']) ?></p>
            </div>
          </div>

        </div>

      </div>

    </div>
  </section>

  <!-- STATS STRIP -->
  <div class="bg-[#4A2E1B] text-[#F2E7D4] py-14 sm:py-16 px-6 sm:px-12 lg:px-20 border-t border-black/20">
    <div class="mx-auto max-w-[1360px] grid grid-cols-1 sm:grid-cols-3 gap-8 sm:gap-6 text-center items-center">

      <!-- Stat 1 -->
      <div class="flex flex-col items-center">
        <span class="mora-serif text-5xl sm:text-6xl lg:text-7xl font-bold text-white tracking-normal leading-none">
          <span class="stat-counter" data-value="<?= e($about_content['stats']['stat_1_value']) ?>"><?= e($about_content['stats']['stat_1_value']) ?></span>
        </span>
        <p class="mt-3 text-xs sm:text-sm uppercase tracking-[.18em] text-[#F2E7D4]/80 font-medium">
          <?= e($about_content['stats']['stat_1_label']) ?>
        </p>
      </div>

      <!-- Stat 2 -->
      <div class="flex flex-col items-center sm:border-x sm:border-white/15 px-4">
        <span class="mora-serif text-5xl sm:text-6xl lg:text-7xl font-bold text-white tracking-normal leading-none">
          <span class="stat-counter" data-value="<?= e($about_content['stats']['stat_2_value']) ?>"><?= e($about_content['stats']['stat_2_value']) ?></span>
        </span>
        <p class="mt-3 text-xs sm:text-sm uppercase tracking-[.18em] text-[#F2E7D4]/80 font-medium">
          <?= e($about_content['stats']['stat_2_label']) ?>
        </p>
      </div>

      <!-- Stat 3 -->
      <div class="flex flex-col items-center">
        <span class="mora-serif text-5xl sm:text-6xl lg:text-7xl font-bold text-white tracking-normal leading-none">
          <span class="stat-counter" data-value="<?= e($about_content['stats']['stat_3_value']) ?>"><?= e($about_content['stats']['stat_3_value']) ?></span>
        </span>
        <p class="mt-3 text-xs sm:text-sm uppercase tracking-[.18em] text-[#F2E7D4]/80 font-medium">
          <?= e($about_content['stats']['stat_3_label']) ?>
        </p>
      </div>

    </div>
  </div>

  <!-- WHAT OUR CUSTOMERS SAY SECTION (REVIEWS) -->
  <section class="bg-white text-[#30201B] py-12 sm:py-16 lg:py-20 px-6 sm:px-12 lg:px-20 border-b border-[#30201B]/10"
    id="customer-reviews">
    <div class="mx-auto max-w-[1240px]">

      <!-- Section Header -->
      <div class="text-center mb-14 sm:mb-16">
        <h2
          class="mora-serif text-3xl sm:text-4xl lg:text-[46px] font-normal text-[#30201B] tracking-tight leading-tight mb-3">
          What our Customer's say
        </h2>
        <p class="text-sm sm:text-base text-[#4a3e39]/80 max-w-xl mx-auto font-normal">
          Real experiences, unforgettable nights, and memories made at C HOUSE.
        </p>
      </div>

      <!-- Reviews: single auto-scrolling row (cards glide in from the right and out to the left) -->
      <div class="review-marquee overflow-hidden -mx-6 sm:-mx-12 lg:-mx-20">
        <div class="review-track flex w-max">
          <?php for ($pass = 0; $pass < 2; $pass++): ?>
            <div class="flex gap-6 pr-6" <?= $pass ? 'aria-hidden="true"' : '' ?>>
              <?php foreach ($reviews as $review): ?>
                <div class="review-card relative w-[300px] sm:w-[380px] shrink-0 p-7 rounded-2xl bg-[#FAF8F5] border border-[#30201B]/8 flex flex-col justify-between shadow-sm">
                  <div class="relative">
                    <p class="text-[15px] text-[#4a3e39] leading-relaxed relative z-10 font-normal">
                      &ldquo;<?= e($review['review_text']) ?>&rdquo;
                    </p>
                  </div>
                  <div class="mt-6 pt-5 border-t border-[#30201B]/8 flex flex-col items-start">
                    <div class="flex items-center gap-1 text-amber-500 text-base mb-1.5">
                      <?php for ($i = 1; $i <= 5; $i++): ?>
                        <i class="ti ti-star-filled <?= $i > $review['star_rating'] ? 'text-gray-300' : '' ?>"></i>
                      <?php endfor; ?>
                    </div>
                    <span class="font-bold text-base text-[#30201B] tracking-wide"><?= e($review['reviewer_name']) ?></span>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          <?php endfor; ?>
        </div>
      </div>

    </div>
  </section>

  <!-- Footer section same as homepage -->
  <?php include __DIR__ . '/includes/footer.php'; ?>

  <!-- Mobile Menu Toggle & Interactive Features Script -->
  <script>
    // Mobile menu toggle
    const menuBtn = document.getElementById('mobile-menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    if (menuBtn && mobileMenu) {
      menuBtn.addEventListener('click', () => {
        const isOpen = !mobileMenu.classList.contains('hidden');
        mobileMenu.classList.toggle('hidden', isOpen);
        menuBtn.querySelector('i').className = isOpen ? 'ti ti-menu-2 text-xl' : 'ti ti-x text-xl';
        menuBtn.setAttribute('aria-label', isOpen ? 'Open menu' : 'Close menu');
      });
    }

    // Sticky header background after scrolling
    const siteHeader = document.getElementById('site-header');
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

    // Stats count-up: "10K+" -> number 10, suffix "K+"; "95%" -> 95, "%"
    (function initCounters() {
      const els = document.querySelectorAll('.stat-counter');
      els.forEach((el) => {
        const m = el.dataset.value.trim().match(/^([\d.,]+)(.*)$/);
        if (!m) return;
        el.dataset.target = m[1].replace(/,/g, '');
        el.dataset.suffix = m[2];
        el.innerHTML = '<span class="stat-num">0</span><span class="stat-suffix ml-1.5">' + m[2] + '</span>';
      });
      const run = (el) => {
        const target = parseFloat(el.dataset.target);
        const num = el.querySelector('.stat-num');
        if (isNaN(target) || !num) return;
        if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
          num.textContent = target;
          return;
        }
        const t0 = performance.now(),
          dur = 3500;
        const tick = (t) => {
          const p = Math.min((t - t0) / dur, 1);
          num.textContent = Math.round(target * (1 - Math.pow(1 - p, 3)));
          if (p < 1) requestAnimationFrame(tick);
        };
        requestAnimationFrame(tick);
      };
      if (!('IntersectionObserver' in window)) {
        els.forEach(run);
        return;
      }
      const io = new IntersectionObserver((entries) => {
        entries.forEach((en) => {
          if (en.isIntersecting) {
            run(en.target);
            io.unobserve(en.target);
          }
        });
      }, {
        threshold: 0.4
      });
      els.forEach((el) => io.observe(el));
    })();

    // Special Section Carousel Logic
    (function initSpecialCarousel() {
      const slides = document.querySelectorAll('.special-slide');
      const dots = document.querySelectorAll('.special-dot');
      const prevBtn = document.getElementById('special-prev');
      const nextBtn = document.getElementById('special-next');
      const carousel = document.getElementById('special-carousel');

      if (!slides.length || !carousel) return;

      let current = 0;
      const total = slides.length;
      let timer = null;

      function goTo(idx) {
        current = (idx + total) % total;
        slides.forEach((s, i) => {
          if (i === current) {
            s.classList.remove('opacity-0', 'pointer-events-none', 'z-0');
            s.classList.add('opacity-100', 'z-10');
          } else {
            s.classList.remove('opacity-100', 'z-10');
            s.classList.add('opacity-0', 'pointer-events-none', 'z-0');
          }
        });
        dots.forEach((d, i) => {
          if (i === current) {
            d.classList.remove('w-2', 'bg-white/40');
            d.classList.add('w-7', 'bg-white');
          } else {
            d.classList.remove('w-7', 'bg-white');
            d.classList.add('w-2', 'bg-white/40');
          }
        });
      }

      function startAuto() {
        stopAuto();
        timer = setInterval(() => goTo(current + 1), 4500);
      }

      function stopAuto() {
        if (timer) {
          clearInterval(timer);
          timer = null;
        }
      }

      if (prevBtn) prevBtn.addEventListener('click', () => {
        goTo(current - 1);
        startAuto();
      });
      if (nextBtn) nextBtn.addEventListener('click', () => {
        goTo(current + 1);
        startAuto();
      });
      dots.forEach((dot, i) => dot.addEventListener('click', () => {
        goTo(i);
        startAuto();
      }));

      carousel.addEventListener('mouseenter', stopAuto);
      carousel.addEventListener('mouseleave', startAuto);
      carousel.addEventListener('touchstart', stopAuto, {
        passive: true
      });
      carousel.addEventListener('touchend', startAuto, {
        passive: true
      });

      goTo(0);
      startAuto();
    })();

    // Accordion Dropdowns Logic
    (function initAccordion() {
      const items = document.querySelectorAll('#special-accordion .accordion-item');
      items.forEach((item) => {
        const header = item.querySelector('.accordion-header');
        const content = item.querySelector('.accordion-content');
        const chevron = header.querySelector('i');

        header.addEventListener('click', () => {
          const isExpanded = !content.classList.contains('hidden');

          // Close all
          items.forEach(otherItem => {
            const otherHeader = otherItem.querySelector('.accordion-header');
            const otherContent = otherItem.querySelector('.accordion-content');
            const otherChevron = otherHeader.querySelector('i');

            otherContent.classList.add('hidden');
            otherChevron.classList.remove('rotate-180');
            otherHeader.classList.remove('bg-[#C76D4D]', 'text-white');
            otherHeader.classList.add('bg-[#F5F2EB]', 'text-[#30201B]');
          });

          // Toggle current
          if (!isExpanded) {
            content.classList.remove('hidden');
            chevron.classList.add('rotate-180');
            header.classList.remove('bg-[#F5F2EB]', 'text-[#30201B]');
            header.classList.add('bg-[#C76D4D]', 'text-white');
          }
        });
      });
    })();
  </script>

  <a aria-label="Chat with us on WhatsApp" rel="noopener" href="https://wa.me/971522185569?text=Hello%2C%20I%20would%20like%20to%20make%20a%20reservation." target="_blank"
    class="fixed bottom-6 right-6 lg:bottom-10 lg:right-10 z-50 bg-[#30201B] text-[#f5e6c8] border border-[#f5e6c8]/20 w-14 h-14 rounded-full flex items-center justify-center shadow-[0_8px_30px_rgb(0,0,0,0.3)] hover:bg-[#f5e6c8] hover:text-[#30201B] hover:scale-110 transition-all duration-300">
    <i class="ti ti-brand-whatsapp text-2xl"></i>
  </a>
</body>

</html>