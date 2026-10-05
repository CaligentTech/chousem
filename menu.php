<?php
require_once __DIR__ . '/admin/includes/db.php';
require_once __DIR__ . '/admin/includes/functions.php';
$s = get_all_settings($pdo);
$categories = get_categories($pdo, 'food');
?>
<!DOCTYPE html>
<html lang="en" class="bg-[#1C1A18] overscroll-none">

<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <title>C HOUSE - Menu</title>
  <link rel="preload" as="image" href="gallery/food.webp" />
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

    .mora-serif {
      font-family: 'DM Serif Display', Georgia, serif;
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
        <a aria-label="home" class="flex items-center text-[#f5e6c8] gap-4" href="index.php">
          <img src="gallery/logo.webp" class="h-28 w-auto object-contain -ml-4" alt="Logo">
          <span class="font-sans text-[32px] tracking-[0.2em] font-light">C HOUSE</span>
        </a>
      </div>
      <nav aria-label="Main links"
        class="hidden items-center gap-1 rounded-full bg-black/30 px-3 py-1.5 lg:flex backdrop-blur-md border border-white/10">
        <a class="flex items-center gap-1.5 rounded-full px-4 py-2 text-[13px] tracking-widest uppercase text-gray-200 transition-colors hover:bg-white/10 hover:text-white"
          href="./index.php">Home</a>
        <a class="flex items-center gap-1.5 rounded-full px-4 py-2 text-[13px] tracking-widest uppercase text-white bg-white/20 transition-colors"
          href="menu.php">Menu</a>
        <a class="flex items-center gap-1.5 rounded-full px-4 py-2 text-[13px] tracking-widest uppercase text-gray-200 transition-colors hover:bg-white/10 hover:text-white"
          href="about.php">About</a>
        <a class="flex items-center gap-1.5 rounded-full px-4 py-2 text-[13px] tracking-widest uppercase text-gray-200 transition-colors hover:bg-white/10 hover:text-white"
          href="bar.php">Bar</a>
        <a class="flex items-center gap-1.5 rounded-full px-4 py-2 text-[13px] tracking-widest uppercase text-gray-200 transition-colors hover:bg-white/10 hover:text-white"
          href="experience.php">Experience</a> <a
          class="flex items-center gap-1.5 rounded-full px-4 py-2 text-[13px] tracking-widest uppercase text-gray-200 transition-colors hover:bg-white/10 hover:text-white"
          href="gallery.php">Gallery</a>
        <a class="flex items-center gap-1.5 rounded-full px-4 py-2 text-[13px] tracking-widest uppercase text-gray-200 transition-colors hover:bg-white/10 hover:text-white"
          href="contact.php">Contact</a>
      </nav>
      <button id="mobile-menu-button" aria-expanded="false"
        class="lg:hidden absolute right-0 flex items-center justify-center p-2 text-[#f5e6c8]">
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
        <img alt="Menu hero" class="h-full w-full object-cover opacity-30" decoding="async"
          src="gallery/food.webp" />
        <div class="absolute inset-0 bg-gradient-to-t from-black via-black/50 to-transparent"></div>
      </div>
      <div class="relative z-10 text-center max-w-3xl mx-auto">
        <p class="text-[10px] uppercase tracking-[.2em] text-[#AA8243] font-bold mb-4"><?= e(get_content($pdo, 'menu', 'hero', 'kicker')) ?></p>
        <h1 class="mora-serif text-5xl md:text-7xl mb-6"><?= e(get_content($pdo, 'menu', 'hero', 'heading')) ?></h1>
        <p class="text-sm md:text-base text-gray-300 tracking-wide font-light mb-10"><?= e(get_content($pdo, 'menu', 'hero', 'description')) ?></p>
        <a href="<?= e($s['food_menu_pdf']) ?>" download="C_House_Food_Menu.pdf"
          class="inline-flex items-center gap-2 rounded-full bg-[#AA8243] px-8 py-3 text-sm tracking-widest uppercase text-white transition-colors hover:bg-white hover:text-black font-semibold shadow-lg">
          <i class="ti ti-download text-lg"></i> Download PDF Menu
        </a>
      </div>
    </section>

    <!-- Menu Content -->
    <section class="py-12 px-5 lg:px-12 max-w-[1360px] mx-auto">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-x-24 gap-y-16">
        <?php foreach ($categories as $cat):
          $items = get_menu_items($pdo, $cat['id']);
        ?>
        <div class="menu-section">
          <?php
          $category_images = [
              'Antipasti' => 'gallery/calamari-fritti.webp',
              'Primi' => 'gallery/fettuccine-alfredo.webp'
          ];
          if (isset($category_images[$cat['name']])): ?>
            <div class="relative mb-2 flex items-center justify-between">
              <h2 class="mora-serif text-4xl mb-0"><?= e($cat['name']) ?></h2>
              <img src="<?= e($category_images[$cat['name']]) ?>" alt="<?= e($cat['name']) ?>" class="absolute right-0 top-1/2 -translate-y-1/2 w-28 md:w-32 lg:w-40 object-contain pointer-events-none z-10">
            </div>
          <?php else: ?>
            <h2 class="mora-serif text-4xl mb-2"><?= e($cat['name']) ?></h2>
          <?php endif; ?>
          <?php if ($cat['subtitle']): ?>
            <p class="text-[11px] uppercase tracking-[.15em] text-[var(--mora-clay)] mb-8 font-bold"><?= e($cat['subtitle']) ?></p>
          <?php endif; ?>
          <div class="flex flex-col gap-5">
            <?php foreach ($items as $item): ?>
              <div class="menu-item flex justify-between items-baseline pb-2">
                <span class="text-lg">
                  <?= e($item['name']) ?>
                  <?= $item['dietary_tag'] ? ' (' . e($item['dietary_tag']) . ')' : '' ?>
                </span>
                <span class="menu-price"><?= e($item['price']) ?></span>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      <?php endforeach; ?>
      </div>

      <div class="mt-12 pt-8 border-t border-[var(--mora-espresso)]/20 text-center text-sm font-semibold opacity-70">
        <p><?= e(get_content($pdo, 'menu', 'disclaimer', 'text')) ?></p> <br>
        <span class="font-normal text-gray-600 mt-2 block">(V) Vegetarian &nbsp;|&nbsp; (NV) Non-Vegetarian
          &nbsp;|&nbsp; (S) Seafood &nbsp;|&nbsp; (P) Prawns</span>
      </div>
    </section>

  </main>
  <!-- FOOTER SPACING -->
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