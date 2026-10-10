<?php
require_once __DIR__ . '/admin/includes/db.php';
require_once __DIR__ . '/admin/includes/functions.php';
$s = get_all_settings($pdo);
$categories_drinks = get_categories($pdo, 'bar_drinks');
$categories_food = get_categories($pdo, 'bar_food');
$happy_hour = get_offers($pdo, 'happy_hour');
$bundles = get_offers($pdo, 'bundle');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <title>C HOUSE - Bar Menu</title>
  <link rel="preload" as="image" href="gallery/drinks/DSC05172.webp" />
  <style>
    @import url('https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=Manrope:wght@300;400;500;600;700&display=swap');

    :root {
      --mora-clay: #A84F37;
      --mora-terracotta: #C76D4D;
      --mora-olive: #29372D;
      --mora-espresso: #30201B;
      --mora-stone: #B7A48E;
      --mora-parchment: #E7D8C0;
      --mora-brass: #AA8243;
      --mora-candle: #F2E7D4;
    }

    body {
      font-family: 'Manrope', sans-serif;
      background: var(--mora-parchment);
      color: var(--mora-espresso);
      scroll-behavior: smooth;
      overflow-x: hidden;
    }

    #mora-page .mora-text-action:hover {
      color: var(--mora-clay);
    }

    .mora-serif {
      font-family: 'DM Serif Display', Georgia, serif;
    }

    .mora-menu-link:hover {
      color: #C76D4D;
      border-color: #C76D4D;
    }

    .menu-item {
      border-bottom: 1px dashed rgba(48, 32, 27, 0.2);
      transition: all 0.3s ease;
    }

    .menu-item:hover {
      border-bottom-color: var(--mora-clay);
      transform: translateX(4px);
    }

    .menu-price {
      color: var(--mora-clay);
      font-weight: 600;
      white-space: nowrap;
      margin-left: 10px;
    }

    .menu-section {
      opacity: 0;
      transform: translateY(20px);
      animation: fadeUp 0.8s ease forwards;
    }

    @keyframes fadeUp {
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
  </style>
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Icons -->
  <link href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont/tabler-icons.min.css" rel="stylesheet" />
</head>

<body>
  <header aria-label="Primary navigation"
    class="absolute inset-x-0 top-0 z-50 pt-6 px-5 sm:px-8 lg:px-12 text-[#f5e6c8]">
    <div class="mx-auto flex h-[72px] max-w-[1360px] items-center justify-center relative">
      <div class="absolute left-0 flex items-center">
        <a aria-label="home" class="flex items-center text-[#f5e6c8] gap-4" href="index.html">
          <img src="gallery/logo.webp" class="h-28 w-auto object-contain -ml-4" alt="Logo">
          <span class="font-sans text-[32px] tracking-[0.2em] font-light">C HOUSE</span>
        </a>
      </div>
      <nav aria-label="Main links"
        class="hidden items-center gap-1 rounded-full bg-black/30 px-3 py-1.5 lg:flex backdrop-blur-md border border-white/10">
        <a class="flex items-center gap-1.5 rounded-full px-4 py-2 text-[13px] tracking-widest uppercase text-gray-200 transition-colors hover:bg-white/10 hover:text-white"
          href="index.php">Home</a>
        <a class="flex items-center gap-1.5 rounded-full px-4 py-2 text-[13px] tracking-widest uppercase text-gray-200 transition-colors hover:bg-white/10 hover:text-white"
          href="menu.php">Menu</a>
        <a class="flex items-center gap-1.5 rounded-full px-4 py-2 text-[13px] tracking-widest uppercase text-gray-200 transition-colors hover:bg-white/10 hover:text-white"
          href="about.php">About</a>
        <a class="flex items-center gap-1.5 rounded-full px-4 py-2 text-[13px] tracking-widest uppercase text-white bg-white/20 transition-colors"
          href="bar.php">Bar</a>
        <a class="flex items-center gap-1.5 rounded-full px-4 py-2 text-[13px] tracking-widest uppercase text-gray-200 transition-colors hover:bg-white/10 hover:text-white"
          href="experience.php">Experience</a> <a class="flex items-center gap-1.5 rounded-full px-4 py-2 text-[13px] tracking-widest uppercase text-gray-200 transition-colors hover:bg-white/10 hover:text-white"
          href="gallery.php">Gallery</a>
        <a class="flex items-center gap-1.5 rounded-full px-4 py-2 text-[13px] tracking-widest uppercase text-gray-200 transition-colors hover:bg-white/10 hover:text-white"
          href="contact.php">Contact</a>
      </nav>
      <button id="mobile-menu-button" aria-expanded="false" class="lg:hidden absolute right-0 flex items-center justify-center p-2 text-[#f5e6c8]">
        <i class="ti ti-menu-2 text-2xl"></i>
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
        <a class="text-[13px] tracking-widest uppercase text-white/80 py-2 border-b border-white/10"
          href="./gallery.php">Gallery</a>
        <a class="text-[13px] tracking-widest uppercase text-white/80 py-2 border-b border-white/10"
          href="./contact.php">Contact</a>
      </nav>
    </div>
  </header>

  <main>
    <!-- Hero Header -->
    <section class="relative pt-24 pb-12 px-5 bg-black text-[#f5e6c8] flex flex-col items-center justify-center">
      <div class="absolute inset-0 z-0">
        <img alt="Bar menu hero" class="h-full w-full object-cover opacity-30" decoding="async"
          src="gallery/drinks/DSC05172.webp" />
        <div class="absolute inset-0 bg-gradient-to-t from-black via-black/50 to-transparent"></div>
      </div>
      <div class="relative z-10 text-center max-w-3xl mx-auto">
        <p class="text-[10px] uppercase tracking-[.2em] text-[#AA8243] font-bold mb-4"><?= e(get_content($pdo, 'bar', 'hero', 'kicker')) ?: 'C HOUSE Selection' ?></p>
        <h1 class="mora-serif text-5xl md:text-7xl mb-6"><?= e(get_content($pdo, 'bar', 'hero', 'heading')) ?: 'The Bar' ?></h1>
        <p class="text-sm md:text-base text-gray-300 tracking-wide font-light mb-10"><?= e(get_content($pdo, 'bar', 'hero', 'description')) ?: 'Explore our curated Bar Food Menu and signature drinks.' ?></p>
        <a href="<?= !empty($s['bar_menu_pdf']) ? e($s['bar_menu_pdf']) : './assets/C-House-Indo-Chinese-Menu.pdf' ?>" download="C_House_Bar_Food_Menu.pdf"
          class="inline-flex items-center gap-2 rounded-full bg-[#AA8243] px-8 py-3 text-sm tracking-widest uppercase text-white transition-colors hover:bg-white hover:text-black font-semibold shadow-lg">
          <i class="ti ti-download text-lg"></i> Download Bar Food Menu
        </a>
      </div>
    </section>

    <!-- SPECIAL OFFERS SECTION -->
    <section class="py-16 px-5 lg:px-12 bg-[#30201B] text-[#f5e6c8]">
      <div class="max-w-[1360px] mx-auto grid grid-cols-1 md:grid-cols-2 gap-12 lg:gap-16">
        <div>
          <h3 class="mora-serif text-4xl mb-2 text-[#AA8243]"><?= e(get_content($pdo, 'bar', 'happy_hour', 'heading')) ?: 'Happy Hour' ?></h3>
          <p class="text-sm text-gray-400 mb-8 font-light uppercase tracking-widest"><?= e(get_content($pdo, 'bar', 'happy_hour', 'subtitle')) ?: 'Sun - Thu 12 PM - 8 PM | Fri - Sat 12 PM - 7 PM' ?></p>
          <div class="flex flex-col gap-5">
            <?php foreach ($happy_hour as $item): ?>
              <div class="flex justify-between items-baseline pb-3 border-b border-white/10">
                <span class="text-lg text-white"><?= e($item['title']) ?></span>
                <span class="text-[#AA8243] font-bold ml-4"><?= e($item['price_text']) ?></span>
              </div>
            <?php endforeach; ?>
          </div>
        </div>

        <div>
          <h3 class="mora-serif text-4xl mb-2 text-[#AA8243]"><?= e(get_content($pdo, 'bar', 'bundles', 'heading')) ?: 'Bundles & Offers' ?></h3>
          <p class="text-sm text-gray-400 mb-8 font-light uppercase tracking-widest"><?= e(get_content($pdo, 'bar', 'bundles', 'subtitle')) ?: 'Unbeatable Value' ?></p>
          <div class="flex flex-col gap-6">
            <?php foreach ($bundles as $item): ?>
              <div class="flex flex-col pb-4 border-b border-white/10">
                <span class="text-xl font-medium text-white mb-1"><?= e($item['title']) ?></span>
                <span class="text-sm text-gray-300"><?= e($item['description']) ?></span>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </section>

    <!-- Drinks Menu Section -->
    <section class="py-16 px-5 lg:px-12 max-w-[1360px] mx-auto border-b border-[var(--mora-espresso)]/20">
      <div class="text-center mb-16">
        <h2 class="mora-serif text-5xl mb-4"><?= e(get_content($pdo, 'bar', 'drinks_menu', 'heading')) ?></h2>
        <p class="text-[13px] uppercase tracking-[.15em] text-[var(--mora-clay)] font-bold"><?= e(get_content($pdo, 'bar', 'drinks_menu', 'subtitle')) ?></p>
      </div>

      <div class="grid grid-cols-1 lg:grid-cols-2 gap-x-24 gap-y-16">

        <!-- C HOUSE ORIGINALS -->
        <?php foreach ($categories_drinks as $cat):
          $items = get_menu_items($pdo, $cat['id']);
        ?>
          <div class="menu-section">
            <h2 class="mora-serif text-4xl mb-2"><?= e($cat['name']) ?></h2>
            <?php if ($cat['subtitle']): ?>
              <p class="text-[11px] uppercase tracking-[.15em] text-[var(--mora-clay)] mb-8 font-bold"><?= e($cat['subtitle']) ?></p>
            <?php endif; ?>
            <div class="flex flex-col gap-5">
              <?php foreach ($items as $item): ?>
                <div class="menu-item flex flex-col pb-2">
                  <div class="flex justify-between items-baseline mb-1">
                    <span class="text-lg"><?= e($item['name']) ?></span>
                    <span class="menu-price"><?= e($item['price']) ?></span>
                  </div>
                  <?php if ($item['description']): ?>
                    <p class="text-[13px] text-gray-600 font-light"><?= e($item['description']) ?></p>
                  <?php endif; ?>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        <?php endforeach; ?>


      </div>
    </section>

    <!-- Food Menu Content -->
    <section class="py-16 px-5 lg:px-12 max-w-[1360px] mx-auto">
      <div class="text-center mb-16">
        <h2 class="mora-serif text-5xl mb-4"><?= e(get_content($pdo, 'bar', 'food_menu', 'heading')) ?: 'Bar Food Menu' ?></h2>
        <p class="text-[13px] uppercase tracking-[.15em] text-[var(--mora-clay)] font-bold"><?= e(get_content($pdo, 'bar', 'food_menu', 'kicker')) ?: 'Indian & Oriental Favourites' ?></p>
      </div>
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-x-24 gap-y-16">
        <?php foreach ($categories_food as $cat):
          $items = get_menu_items($pdo, $cat['id']);
        ?>
          <div class="menu-section">
            <h2 class="mora-serif text-4xl mb-2"><?= e($cat['name']) ?></h2>
            <?php if ($cat['subtitle']): ?>
              <p class="text-[11px] uppercase tracking-[.15em] text-[var(--mora-clay)] mb-8 font-bold"><?= e($cat['subtitle']) ?></p>
            <?php endif; ?>
            <div class="flex flex-col gap-5">
              <?php foreach ($items as $item): ?>
                <div class="menu-item flex flex-col pb-2">
                  <div class="flex justify-between items-baseline mb-1">
                    <span class="text-lg"><?= e($item['name']) ?></span>
                    <span class="menu-price"><?= e($item['price']) ?></span>
                  </div>
                  <?php if ($item['description']): ?>
                    <p class="text-[13px] text-gray-600 font-light leading-relaxed"><?= e($item['description']) ?></p>
                  <?php endif; ?>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        <?php endforeach; ?>
      </div>

      <div class="mt-12 pt-8 border-t border-[var(--mora-espresso)]/20 text-center text-sm font-semibold opacity-70">
        <?= e(get_content($pdo, 'bar', 'disclaimer', 'text')) ?: 'Prices are in AED and include 5% VAT and 7% Municipality Fee.' ?> <br>
        <?= e(get_content($pdo, 'bar', 'disclaimer', 'text2')) ?: 'Kindly inform your server of any food allergies or dietary preferences before placing your order.' ?> <br>
        <span class="font-normal text-gray-600 mt-2 block"><?= e(get_content($pdo, 'bar', 'disclaimer', 'legend')) ?: "(*) Chef's Signature Dish &nbsp;|&nbsp; (V) Vegetarian &nbsp;|&nbsp; (NV) Non-Vegetarian &nbsp;|&nbsp; (S) Seafood" ?></span>
      </div>
    </section>

  </main>
  <?php include __DIR__ . '/includes/footer.php'; ?>
  <a href="https://wa.me/971522185569?text=Hello%2C%20I%20would%20like%20to%20make%20a%20reservation." target="_blank"
    class="fixed bottom-6 right-6 lg:bottom-10 lg:right-10 z-50 bg-[#30201B] text-[#f5e6c8] border border-[#f5e6c8]/20 w-14 h-14 rounded-full flex items-center justify-center shadow-[0_8px_30px_rgb(0,0,0,0.3)] hover:bg-[#f5e6c8] hover:text-[#30201B] hover:scale-110 transition-all duration-300">
    <i class="ti ti-brand-whatsapp text-2xl"></i>
  </a>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
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
  </script>
</body>

</html>