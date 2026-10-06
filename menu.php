<?php
require_once __DIR__ . '/admin/includes/db.php';
require_once __DIR__ . '/admin/includes/functions.php';
$s = get_all_settings($pdo);
$categories = get_categories($pdo, 'food');

/*
 * Build the grid cells.
 * The original HTML puts some categories together in ONE grid cell
 * (Zuppe + Fries, Secondi + Griglia, Dolci + Non Alcohol Sips).
 * Categories sharing the same `group_no` go into the same cell.
 * If `group_no` is empty/missing, each category gets its own cell.
 */
$groups = [];
foreach ($categories as $cat) {
  $key = !empty($cat['group_no']) ? 'g' . $cat['group_no'] : 'c' . $cat['id'];
  $groups[$key][] = $cat;
}
$groups = array_values($groups);
?>
<!DOCTYPE html>
<html lang="en" class="bg-[#1C1A18] overscroll-none">

<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <title>C HOUSE - Menu</title>
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
          href="experience.php">Experience</a>
        <a class="flex items-center gap-1.5 rounded-full px-4 py-2 text-[13px] tracking-widest uppercase text-gray-200 transition-colors hover:bg-white/10 hover:text-white"
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
        <a class="text-[13px] tracking-widest uppercase text-white/80 py-2 border-b border-white/10" href="./index.php">Home</a>
        <a class="text-[13px] tracking-widest uppercase text-white/80 py-2 border-b border-white/10" href="menu.php">Menu</a>
        <a class="text-[13px] tracking-widest uppercase text-white/80 py-2 border-b border-white/10" href="./about.php">About</a>
        <a class="text-[13px] tracking-widest uppercase text-white/80 py-2 border-b border-white/10" href="bar.php">Bar</a>
        <a class="text-[13px] tracking-widest uppercase text-white/80 py-2 border-b border-white/10" href="./experience.php">Experience</a>
        <a class="text-[13px] tracking-widest uppercase text-white/80 py-2 border-b border-white/10" href="./gallery.php">Gallery</a>
        <a class="text-[13px] tracking-widest uppercase text-white/80 py-2 border-b border-white/10" href="./contact.php">Contact</a>
      </nav>
    </div>
  </header>

  <main>
    <!-- Hero Header -->
    <section class="relative pt-24 pb-12 px-5 bg-black text-[#f5e6c8] flex flex-col items-center justify-center">
      <div class="absolute inset-0 z-0">
        <img alt="Menu hero" class="h-full w-full object-cover opacity-30" decoding="async" loading="lazy"
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

        <?php foreach ($groups as $gi => $group): ?>
          <div class="menu-section" style="animation-delay: <?= number_format(($gi + 1) * 0.1, 1) ?>s">

            <?php foreach ($group as $ci => $cat):
              $items = get_menu_items($pdo, $cat['id']);
              $hasImage = !empty($cat['image']);
            ?>
              <?php if ($hasImage): ?>
                <div class="relative mb-2 flex items-center justify-between">
                  <h2 class="mora-serif text-4xl mb-0"><?= e($cat['name']) ?></h2>
                  <img src="<?= e($cat['image']) ?>" alt="<?= e($cat['name']) ?>"
                    class="absolute right-0 top-1/2 -translate-y-1/2 w-28 md:w-32 lg:w-40 object-contain pointer-events-none z-10">
                </div>
              <?php else: ?>
                <h2 class="mora-serif text-4xl mb-2 <?= $ci > 0 ? 'mt-12' : '' ?>"><?= e($cat['name']) ?></h2>
              <?php endif; ?>

              <p class="text-[11px] uppercase tracking-[.15em] text-[var(--mora-clay)] mb-8 font-bold"><?= e($cat['subtitle'] ?? '') ?></p>

              <div class="flex flex-col gap-5">
                <?php foreach ($items as $item): ?>
                  <div class="menu-item flex justify-between items-baseline pb-2">
                    <span class="text-lg"><?= e($item['name']) ?><?= !empty($item['dietary_tag']) ? ' (' . e($item['dietary_tag']) . ')' : '' ?></span>
                    <span class="menu-price"><?= e($item['price']) ?></span>
                  </div>
                <?php endforeach; ?>
              </div>
            <?php endforeach; ?>

          </div>
        <?php endforeach; ?>

        <!-- Drinks block (still static: shakes, brews, refreshments) -->
        <div class="menu-section lg:col-span-2 grid grid-cols-1 md:grid-cols-3 gap-12 mt-12 pt-12 border-t border-[var(--mora-espresso)]/20"
          style="animation-delay: 0.7s">
          <div>
            <h3 class="mora-serif text-2xl mb-6">Rich & Creamy Shakes</h3>
            <div class="flex flex-col gap-4">
              <div class="menu-item flex justify-between items-baseline pb-2"><span class="text-base">Nutella Ferrero Shake</span><span class="menu-price">48</span></div>
              <div class="menu-item flex justify-between items-baseline pb-2"><span class="text-base">Lotus Milkshake</span><span class="menu-price">48</span></div>
              <div class="menu-item flex justify-between items-baseline pb-2"><span class="text-base text-[14px]">Vanilla / Strawberry / Chocolate</span><span class="menu-price">40</span></div>
            </div>

            <h3 class="mora-serif text-2xl mb-6 mt-10">Hot & Chilled Brews</h3>
            <div class="flex flex-col gap-4">
              <div class="menu-item flex justify-between items-baseline pb-2"><span class="text-base text-[14px]">Iced Tea (Peach / Lemon / Passion Fruit)</span><span class="menu-price">38</span></div>
              <div class="menu-item flex justify-between items-baseline pb-2"><span class="text-base text-[14px]">Flavored Iced / Blended Coffee</span><span class="menu-price">39</span></div>
              <div class="menu-item flex justify-between items-baseline pb-2"><span class="text-base">Cappuccino / Café Latte</span><span class="menu-price">35</span></div>
              <div class="menu-item flex justify-between items-baseline pb-2"><span class="text-base">Hot Chocolate</span><span class="menu-price">38</span></div>
              <div class="menu-item flex justify-between items-baseline pb-2"><span class="text-base">Masala Chai</span><span class="menu-price">20</span></div>
              <div class="menu-item flex justify-between items-baseline pb-2"><span class="text-base">Espresso (Single / Double)</span><span class="menu-price">20 / 30</span></div>
            </div>
          </div>

          <div class="md:col-span-2">
            <h3 class="mora-serif text-2xl mb-6">Cooling Refreshments</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-12 gap-y-4">
              <div class="menu-item flex justify-between items-baseline pb-2"><span class="text-base">RedBull</span><span class="menu-price">35</span></div>
              <div class="menu-item flex justify-between items-baseline pb-2"><span class="text-base text-[14px]">Fresh Juice / Organic Coconut Water</span><span class="menu-price">32</span></div>
              <div class="menu-item flex justify-between items-baseline pb-2"><span class="text-base">Traditional Lassi (Sweet / Salted)</span><span class="menu-price">30</span></div>
              <div class="menu-item flex justify-between items-baseline pb-2"><span class="text-base">Butter Milk (Chaas)</span><span class="menu-price">28</span></div>
              <div class="menu-item flex justify-between items-baseline pb-2"><span class="text-base text-[13px]">Pepsi, Diet Pepsi, 7up, Mirinda, Soda, Tonic</span><span class="menu-price">19</span></div>
              <div class="menu-item flex justify-between items-baseline pb-2"><span class="text-base">Still Water (S) or (L)</span><span class="menu-price">18 / 28</span></div>
              <div class="menu-item flex justify-between items-baseline pb-2"><span class="text-base">Sparkling Water (S) or (L)</span><span class="menu-price">28 / 38</span></div>
            </div>
          </div>
        </div>

      </div><!-- /grid -->

      <div class="mt-12 pt-8 border-t border-[var(--mora-espresso)]/20 text-center text-sm font-semibold opacity-70">
        <?= e(get_content($pdo, 'menu', 'disclaimer', 'text')) ?> <br>
        <span class="font-normal text-gray-600 mt-2 block">(V) Vegetarian &nbsp;|&nbsp; (NV) Non-Vegetarian
          &nbsp;|&nbsp; (S) Seafood &nbsp;|&nbsp; (P) Prawns</span>
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