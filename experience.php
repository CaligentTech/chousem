<?php
require_once __DIR__ . '/admin/includes/db.php';
require_once __DIR__ . '/admin/includes/functions.php';
$s = get_all_settings($pdo);
$experience_content = get_page_content($pdo, 'experience');
$events = get_events($pdo);
?>
<!DOCTYPE html>
<html lang="en" class="bg-[#1C1A18] overscroll-none">

<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <title>Experience & Events &mdash; C HOUSE &middot; Italian Bistro &middot; Bar &middot; Lounge</title>
  <meta name="description" content="Live entertainment, special events, and the nightlife experience at C HOUSE." />
  <link rel="preload" as="image" href="<?= e($experience_content['hero']['image'] ?? 'gallery/exp_hero.webp') ?>" />

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
      margin: 0;
      padding: 0;
      background-color: #000;
      color: #fff;
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
  </style>
</head>

<body class="bg-black text-white overflow-x-hidden">

  <!-- HERO CONTAINER -->
  <div class="relative min-h-[70svh] w-full flex flex-col justify-between overflow-hidden">
    <!-- BACKGROUND IMAGE -->
    <div class="absolute inset-0 z-0">
      <img src="<?= e($experience_content['hero']['image'] ?? 'gallery/exp_hero.webp') ?>" alt="C HOUSE Experience"
        class="h-full w-full object-cover object-center opacity-60" />
      <div class="absolute inset-0 bg-gradient-to-b from-black/80 via-black/40 to-black"></div>
    </div>

    <!-- NAVBAR -->
    <header aria-label="Primary navigation" class="relative z-50 pt-6 px-5 sm:px-8 lg:px-12 text-white">
      <div class="mx-auto flex h-[72px] max-w-[1360px] items-center justify-between relative">
        <div class="flex items-center">
          <a aria-label="home" class="flex items-center gap-3 text-white" href="./index.php">
            <img src="gallery/logo.webp" class="h-28 w-auto object-contain -ml-4" alt="C HOUSE Logo" />
            <span class="font-sans text-[32px] tracking-[0.2em] font-light text-white">C HOUSE</span>
          </a>
        </div>

        <nav aria-label="Main links"
          class="hidden items-center gap-1 rounded-full bg-black/40 px-3 py-1.5 lg:flex backdrop-blur-md border border-white/10 shadow-lg">
          <a class="flex items-center gap-1.5 rounded-full px-4 py-2 text-[13px] tracking-widest uppercase text-gray-200 transition-colors hover:bg-white/10 hover:text-white"
            href="./index.php">Home</a>
          <a class="flex items-center gap-1.5 rounded-full px-4 py-2 text-[13px] tracking-widest uppercase text-gray-200 transition-colors hover:bg-white/10 hover:text-white"
            href="./menu.php">Menu</a>
          <a class="flex items-center gap-1.5 rounded-full px-4 py-2 text-[13px] tracking-widest uppercase text-gray-200 transition-colors hover:bg-white/10 hover:text-white"
            href="./about.php">About</a>
          <a class="flex items-center gap-1.5 rounded-full px-4 py-2 text-[13px] tracking-widest uppercase text-gray-200 transition-colors hover:bg-white/10 hover:text-white"
            href="./bar.php">Bar</a>
          <a class="flex items-center gap-1.5 rounded-full px-4 py-2 text-[13px] tracking-widest uppercase bg-white/20 text-white font-semibold"
            href="./experience.php" aria-current="page">Experience</a>
          <a class="flex items-center gap-1.5 rounded-full px-4 py-2 text-[13px] tracking-widest uppercase text-gray-200 transition-colors hover:bg-white/10 hover:text-white"
            href="./gallery.php">Gallery</a>
          <a class="flex items-center gap-1.5 rounded-full px-4 py-2 text-[13px] tracking-widest uppercase text-gray-200 transition-colors hover:bg-white/10 hover:text-white"
            href="./contact.php">Contact</a>
        </nav>

        <div class="hidden lg:flex items-center gap-4">
          <a href="./contact.php"
            class="flex items-center gap-2.5 bg-white text-[#30201B] text-[13px] font-semibold tracking-wide rounded-full px-7 py-3 hover:bg-[#5C3D2E] hover:text-white transition-colors shadow-md border border-[#30201B]/10">
            <span>Reserve a Table</span>
            <i class="ti ti-arrow-up-right text-base"></i>
          </a>
        </div>

        <button id="mobile-menu-btn"
          class="lg:hidden flex items-center justify-center w-10 h-10 border border-white/30 rounded-full text-white backdrop-blur-sm bg-black/30"
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
          <a class="text-[13px] tracking-widest uppercase text-white py-2 border-b border-white/10 font-semibold"
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

    <main class="relative z-10 flex-1 flex flex-col items-center justify-center px-5 py-16 text-center">
      <p class="text-[11px] uppercase tracking-[.25em] text-[#AA8243] font-bold mb-6"><?= e($experience_content['hero']['kicker'] ?? ($experience_content['hero']['subtitle'] ?? 'Live the moment')) ?></p>
      <h1
        class="mora-serif text-white text-5xl sm:text-7xl lg:text-[7rem] font-normal tracking-tight uppercase leading-[0.9] drop-shadow-2xl">
        <?= e($experience_content['hero']['heading'] ?? 'The Experience') ?>
      </h1>
      <p class="mt-8 text-sm sm:text-base text-gray-300 max-w-2xl font-light leading-relaxed">
        <?= e($experience_content['hero']['description'] ?? 'From pulsating live bands to intimate acoustic sets and themed event nights. C HOUSE transforms from a relaxed bistro by day into a vibrant social destination by night.') ?>
      </p>
    </main>
  </div>

  <!-- UPCOMING EVENTS SECTION -->
  <section class="bg-[#111] py-20 px-6 sm:px-12 lg:px-20 border-t border-white/10">
    <div class="mx-auto max-w-[1360px]">
      <div class="flex flex-col lg:flex-row lg:items-end justify-between mb-16 gap-8">
        <div>
          <h2 class="mora-serif text-4xl sm:text-6xl text-white mb-4"><?= e($experience_content['weekly_events']['heading'] ?? ($experience_content['events']['heading'] ?? 'Weekly Events')) ?></h2>
          <p class="text-gray-400 font-light max-w-lg"><?= e($experience_content['weekly_events']['description'] ?? ($experience_content['events']['description'] ?? 'Join us every week for our signature themed nights featuring live entertainment and exclusive offers.')) ?></p>
        </div>
        <a href="./contact.php"
          class="inline-flex items-center gap-2 text-[#AA8243] hover:text-white transition-colors uppercase tracking-widest text-xs font-bold border-b border-[#AA8243] hover:border-white pb-1 w-fit">
          <?= e($experience_content['events']['cta_text'] ?? 'Book your table') ?> <i class="ti ti-arrow-up-right text-lg"></i>
        </a>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php if (!empty($events)): ?>
          <?php foreach ($events as $event): ?>
            <div
              class="group relative bg-black rounded-[2rem] overflow-hidden border border-white/5 hover:border-white/20 transition-colors">
              <div class="aspect-[4/5] sm:aspect-auto sm:h-64 overflow-hidden relative">
                <img src="<?= e($event['image_path'] ?? ($event['image'] ?? '')) ?>" alt="<?= e($event['title'] ?? ($event['name'] ?? 'Event')) ?>"
                  class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" />
                <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent"></div>
              </div>
              <div class="p-8 relative z-10 -mt-12">
                <?php
                $event_badge = $event['schedule_text'] ?? '';
                if (!empty($event_badge)):
                ?>
                  <div
                    class="bg-[#AA8243] text-white text-[10px] font-bold uppercase tracking-widest py-1.5 px-4 rounded-full inline-block mb-4">
                    <?= e($event_badge) ?>
                  </div>
                <?php endif; ?>
                <h3 class="mora-serif text-3xl mb-3 text-white"><?= e($event['title'] ?? ($event['name'] ?? '')) ?></h3>
                <p class="text-gray-400 text-sm font-light mb-6"><?= e($event['description'] ?? '') ?></p>
              </div>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <!-- Fallback Event 1 -->
          <div
            class="group relative bg-black rounded-[2rem] overflow-hidden border border-white/5 hover:border-white/20 transition-colors">
            <div class="aspect-[4/5] sm:aspect-auto sm:h-64 overflow-hidden relative">
              <img src="./gallery/drinks/Beverage.webp" alt="Ladies Night"
                class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" />
              <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent"></div>
            </div>
            <div class="p-8 relative z-10 -mt-12">
              <div
                class="bg-[#AA8243] text-white text-[10px] font-bold uppercase tracking-widest py-1.5 px-4 rounded-full inline-block mb-4">
                Every Tuesday</div>
              <h3 class="mora-serif text-3xl mb-3 text-white">Ladies Privilege</h3>
              <p class="text-gray-400 text-sm font-light mb-6">3 House Drinks or Cocktails per guest and 25% Off all
                starters from 8:00 PM to 11:30 PM.</p>
            </div>
          </div>

          <!-- Fallback Event 2 -->
          <div
            class="group relative bg-black rounded-[2rem] overflow-hidden border border-white/5 hover:border-white/20 transition-colors">
            <div class="aspect-[4/5] sm:aspect-auto sm:h-64 overflow-hidden relative">
              <img src="./gallery/ambience/Ambiance%205.jpg.webp" alt="Live Music"
                class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" />
              <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent"></div>
            </div>
            <div class="p-8 relative z-10 -mt-12">
              <div
                class="bg-[#AA8243] text-white text-[10px] font-bold uppercase tracking-widest py-1.5 px-4 rounded-full inline-block mb-4">
                Friday & Saturday</div>
              <h3 class="mora-serif text-3xl mb-3 text-white">Live Acoustics</h3>
              <p class="text-gray-400 text-sm font-light mb-6">Unwind to the soulful tunes of our resident acoustic bands
                while enjoying the perfect weekend atmosphere.</p>
            </div>
          </div>

          <!-- Fallback Event 3 -->
          <div
            class="group relative bg-black rounded-[2rem] overflow-hidden border border-white/5 hover:border-white/20 transition-colors">
            <div class="aspect-[4/5] sm:aspect-auto sm:h-64 overflow-hidden relative">
              <img src="./gallery/special-drinks.webp" alt="Happy Hour"
                class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" />
              <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent"></div>
            </div>
            <div class="p-8 relative z-10 -mt-12">
              <div
                class="bg-[#AA8243] text-white text-[10px] font-bold uppercase tracking-widest py-1.5 px-4 rounded-full inline-block mb-4">
                Daily</div>
              <h3 class="mora-serif text-3xl mb-3 text-white">Sundowners</h3>
              <p class="text-gray-400 text-sm font-light mb-6">Enjoy extended happy hour pricing on our signature
                cocktails and draught beers as the sun sets.</p>
            </div>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </section>

  <!-- SEASONAL MENUS & CURRENT OFFERS -->
  <section class="bg-black py-20 px-6 sm:px-12 lg:px-20 border-t border-white/10" id="current-offers">
    <div class="mx-auto max-w-[1360px]">
      <div class="flex flex-col lg:flex-row lg:items-end justify-between mb-16 gap-8">
        <div>
          <h2 class="mora-serif text-4xl sm:text-6xl text-white mb-4"><?= e($experience_content['seasonal_offers']['heading'] ?? ($experience_content['offers']['heading'] ?? ($experience_content['seasonal']['heading'] ?? 'Seasonal Menus & Offers'))) ?></h2>
          <p class="text-gray-400 font-light max-w-lg"><?= e($experience_content['seasonal_offers']['description'] ?? ($experience_content['offers']['description'] ?? ($experience_content['seasonal']['description'] ?? "Discover our chef's seasonal creations and limited-time promotions."))) ?></p>
        </div>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Seasonal Menu -->
        <div
          class="group flex flex-col sm:flex-row bg-[#111] rounded-[2rem] overflow-hidden border border-white/5 hover:border-white/20 transition-colors">
          <div class="w-full sm:w-2/5 aspect-[4/5] sm:aspect-auto sm:min-h-full overflow-hidden relative shrink-0">
            <img src="<?= e($experience_content['seasonal_offers']['card_1_image'] ?? ($experience_content['seasonal_menu']['image'] ?? ($experience_content['seasonal']['card_1_image'] ?? './gallery/pasta.webp'))) ?>" alt="<?= e($experience_content['seasonal_offers']['card_1_title'] ?? ($experience_content['seasonal_menu']['heading'] ?? ($experience_content['seasonal_menu']['title'] ?? 'Summer Truffle Menu'))) ?>"
              class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" />
          </div>
          <div class="p-8 sm:w-3/5 flex flex-col justify-center">
            <div
              class="bg-[#AA8243] text-white text-[10px] font-bold uppercase tracking-widest py-1.5 px-4 rounded-full inline-block mb-4 w-fit">
              <?= e($experience_content['seasonal_offers']['card_1_tag'] ?? ($experience_content['seasonal_menu']['tag'] ?? ($experience_content['seasonal']['card_1_tag'] ?? 'Seasonal Special'))) ?></div>
            <h3 class="mora-serif text-3xl mb-3 text-white"><?= e($experience_content['seasonal_offers']['card_1_title'] ?? ($experience_content['seasonal_menu']['heading'] ?? ($experience_content['seasonal_menu']['title'] ?? 'Summer Truffle Menu'))) ?></h3>
            <p class="text-gray-400 text-sm font-light mb-6"><?= e($experience_content['seasonal_offers']['card_1_desc'] ?? ($experience_content['seasonal_offers']['card_1_description'] ?? ($experience_content['seasonal_menu']['description'] ?? 'Experience the rich, earthy flavors of summer truffles incorporated into our classic Italian dishes. Available for a limited time only.'))) ?></p>
            <a href="<?= e($experience_content['seasonal_offers']['card_1_link'] ?? ($experience_content['seasonal_menu']['link'] ?? './menu.php')) ?>"
              class="inline-flex items-center gap-2 text-white hover:text-[#AA8243] transition-colors uppercase tracking-widest text-xs font-bold w-fit">
              <?= e($experience_content['seasonal_offers']['card_1_link_text'] ?? ($experience_content['seasonal_menu']['link_text'] ?? 'View Menu')) ?> <i class="ti ti-arrow-right text-lg"></i>
            </a>
          </div>
        </div>

        <!-- Current Offer -->
        <div
          class="group flex flex-col sm:flex-row bg-[#111] rounded-[2rem] overflow-hidden border border-white/5 hover:border-white/20 transition-colors">
          <div class="w-full sm:w-2/5 aspect-[4/5] sm:aspect-auto sm:min-h-full overflow-hidden relative shrink-0">
            <img src="<?= e($experience_content['seasonal_offers']['card_2_image'] ?? ($experience_content['business_lunch']['image'] ?? ($experience_content['seasonal']['card_2_image'] ?? './gallery/food/DSC05118.webp'))) ?>" alt="<?= e($experience_content['seasonal_offers']['card_2_title'] ?? ($experience_content['business_lunch']['heading'] ?? ($experience_content['business_lunch']['title'] ?? 'Business Lunch'))) ?>"
              class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" />
          </div>
          <div class="p-8 sm:w-3/5 flex flex-col justify-center">
            <div
              class="bg-[#AA8243] text-white text-[10px] font-bold uppercase tracking-widest py-1.5 px-4 rounded-full inline-block mb-4 w-fit">
              <?= e($experience_content['seasonal_offers']['card_2_tag'] ?? ($experience_content['business_lunch']['tag'] ?? ($experience_content['seasonal']['card_2_tag'] ?? 'Current Offer'))) ?></div>
            <h3 class="mora-serif text-3xl mb-3 text-white"><?= e($experience_content['seasonal_offers']['card_2_title'] ?? ($experience_content['business_lunch']['heading'] ?? ($experience_content['business_lunch']['title'] ?? 'Business Lunch'))) ?></h3>
            <p class="text-gray-400 text-sm font-light mb-6"><?= e($experience_content['seasonal_offers']['card_2_desc'] ?? ($experience_content['seasonal_offers']['card_2_description'] ?? ($experience_content['business_lunch']['description'] ?? 'A two-course Italian feast designed for your midday break. Perfect for client meetings or a quick escape from the office.'))) ?></p>
            <a href="<?= e($experience_content['seasonal_offers']['card_2_link'] ?? ($experience_content['business_lunch']['link'] ?? ($s['reservation_link'] ?? './contact.php'))) ?>"
              class="inline-flex items-center gap-2 text-white hover:text-[#AA8243] transition-colors uppercase tracking-widest text-xs font-bold w-fit">
              <?= e($experience_content['seasonal_offers']['card_2_link_text'] ?? ($experience_content['business_lunch']['link_text'] ?? 'Book a Table')) ?> <i class="ti ti-arrow-right text-lg"></i>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- FEATURE BANNER -->
  <section class="relative py-32 px-5 text-center flex flex-col items-center justify-center overflow-hidden">
    <div class="absolute inset-0 z-0">
      <img src="<?= e($experience_content['private_events']['image'] ?? ($experience_content['banner']['image'] ?? ($experience_content['cta']['image'] ?? 'gallery/cta_dining.webp'))) ?>" alt="<?= e($experience_content['private_events']['heading'] ?? 'Private Events & Gatherings') ?>" class="w-full h-full object-cover" />
      <div class="absolute inset-0 bg-[#30201B]/80 backdrop-blur-sm"></div>
    </div>
    <div class="relative z-10 max-w-4xl mx-auto">
      <h2 class="mora-serif text-5xl sm:text-7xl text-white mb-6"><?= e($experience_content['private_events']['heading'] ?? ($experience_content['private_celebrations']['heading'] ?? ($experience_content['banner']['heading'] ?? ($experience_content['cta']['heading'] ?? 'Private Events & Gatherings')))) ?></h2>
      <p class="text-lg text-[#F2E7D4]/80 font-light mb-10"><?= e($experience_content['private_events']['description'] ?? ($experience_content['private_celebrations']['description'] ?? ($experience_content['banner']['description'] ?? ($experience_content['cta']['description'] ?? "Looking for the perfect venue for your next celebration?\n        Whether it's a birthday, corporate event, or a casual get-together, our team will make it unforgettable.")))) ?></p>
      <a href="<?= e($experience_content['private_events']['button_link'] ?? ($experience_content['banner']['button_link'] ?? ($experience_content['cta']['button_link'] ?? ($s['reservation_link'] ?? './contact.php')))) ?>"
        class="inline-flex items-center gap-2 bg-white text-black font-semibold rounded-full px-8 py-4 hover:bg-[#AA8243] hover:text-white transition-colors">
        <?= e($experience_content['private_events']['button_text'] ?? ($experience_content['banner']['button_text'] ?? ($experience_content['cta']['button_text'] ?? 'Inquire Now'))) ?> <i class="ti ti-arrow-up-right"></i>
      </a>
    </div>
  </section>

  <!-- FOOTER SPACING -->
  <?php include __DIR__ . '/includes/footer.php'; ?>

  <a href="https://wa.me/971522185569?text=Hello%2C%20I%20would%20like%20to%20make%20a%20reservation." target="_blank"
    class="fixed bottom-6 right-6 lg:bottom-10 lg:right-10 z-50 bg-[#30201B] text-[#f5e6c8] border border-[#f5e6c8]/20 w-14 h-14 rounded-full flex items-center justify-center shadow-[0_8px_30px_rgb(0,0,0,0.3)] hover:bg-[#f5e6c8] hover:text-[#30201B] hover:scale-110 transition-all duration-300">
    <i class="ti ti-brand-whatsapp text-2xl"></i>
  </a>

  <script>
    const menuBtn = document.getElementById('mobile-menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');

    if (menuBtn && mobileMenu) {
      menuBtn.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
        menuBtn.setAttribute('aria-expanded', !mobileMenu.classList.contains('hidden'));
      });
    }
  </script>
</body>

</html>