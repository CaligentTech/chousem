<?php
require_once __DIR__ . '/admin/includes/db.php';
require_once __DIR__ . '/admin/includes/functions.php';
$s = get_all_settings($pdo);
$contact_content = get_page_content($pdo, 'contact');

$phones = function_exists('format_phones') ? format_phones($s['phone_numbers'] ?? '') : [];
if (empty($phones)) {
  $phones = [
    ['display' => '+971 52 218 5569', 'tel' => '+971522185569'],
    ['display' => '+971 50 460 3469', 'tel' => '+971504603469'],
    ['display' => '+971 4 880 3320', 'tel' => '+97148803320'],
  ];
}
?>
<!DOCTYPE html>
<html lang="en" class="bg-[#EBDDCB] overscroll-none">

<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <title>Contact Us &mdash; C HOUSE &middot; Italian Bistro &middot; Bar &middot; Lounge</title>
  <?php include __DIR__ . '/includes/head-icons.php'; ?>
  <meta name="description" content="Contacts of C HOUSE &mdash; Italian Bistro, Bar &amp; Lounge in Dubai Jebel Ali." />

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

    select option {
      color: #30201B;
      background-color: #F2E7D4;
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
  <header id="site-header" aria-label="Primary navigation"
    class="fixed inset-x-0 top-0 z-50 pt-3 pb-3 px-5 sm:px-8 lg:px-12 text-[#f5e6c8] transition-all duration-300">
    <div class="mx-auto flex h-[72px] max-w-[1360px] items-center justify-between relative">

      <!-- Logo & Brand Name -->
      <div class="flex items-center">
        <a aria-label="home" class="flex items-center text-[#f5e6c8] gap-4" href="./">
          <img src="gallery/logo.webp" class="h-28 w-auto object-contain -ml-4" alt="C HOUSE Logo" />
          <span class="font-sans text-[32px] tracking-[0.2em] font-light">C HOUSE</span>
        </a>
      </div>

      <!-- Center Floating Navigation Pill -->
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
        <a class="flex items-center gap-1.5 rounded-full px-4 py-2 text-[13px] tracking-widest uppercase text-gray-200 transition-colors hover:bg-white/10 hover:text-white"
          href="gallery">Gallery</a>
        <a class="flex items-center gap-1.5 rounded-full px-4 py-2 text-[13px] tracking-widest uppercase text-white bg-white/20 transition-colors"
          href="contact" aria-current="page">Contact</a>
      </nav>

      <!-- Right: Reserve a Table Button -->
      <div class="hidden lg:flex items-center gap-4">
        <a href="contact"
          class="flex items-center gap-2.5 bg-white text-[#30201B] text-[13px] font-semibold tracking-wide rounded-full px-7 py-3 hover:bg-[#5C3D2E] hover:text-white transition-colors shadow-md border border-[#30201B]/10">
          <span>Reserve a Table</span>
          <i class="ti ti-arrow-up-right text-base"></i>
        </a>
      </div>

      <!-- Mobile Menu Toggle Button -->
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
        <a class="text-[13px] tracking-widest uppercase text-white/80 py-2 border-b border-white/10"
          href="gallery">Gallery</a>
        <a class="text-[13px] tracking-widest uppercase text-white py-2 border-b border-white/10 font-semibold"
          href="contact">Contact</a>
        <a href="contact"
          class="mt-2 flex items-center justify-center gap-2 bg-white text-black text-[13px] font-semibold rounded-full py-3">
          Reserve a Table <i class="ti ti-arrow-up-right"></i>
        </a>
      </nav>
    </div>
  </header>

  <main class="flex-grow">
    <!-- Hero Header -->
    <section class="relative min-h-[480px] pt-24 pb-12 px-5 bg-black text-[#f5e6c8] flex flex-col items-center text-center">
      <div class="absolute inset-0 z-0">
        <img alt="Contact hero" class="h-full w-full object-cover opacity-30" decoding="async"
          src="gallery/restaurant.webp" />
        <div class="absolute inset-0 bg-gradient-to-t from-black via-black/50 to-transparent"></div>
      </div>
      <div class="relative z-10 text-center max-w-3xl mx-auto pt-16">
        <p class="text-[10px] uppercase tracking-[.2em] text-[#AA8243] font-bold mb-4"><?= e(get_content($pdo, 'contact', 'hero', 'kicker')) ?: 'Reservations & Enquiries' ?></p>
        <h1 class="mora-serif text-[#f5e6c8] text-5xl md:text-7xl mb-6">Contact Us</h1>
      </div>
    </section>

    <section
      class="w-full max-w-[1360px] mx-auto px-5 sm:px-8 lg:px-12 py-16 grid grid-cols-1 lg:grid-cols-2 gap-10 items-start">

      <!-- LEFT: Info block -->
      <div>
        <h2 class="mora-serif text-4xl sm:text-5xl text-[#30201B] mb-6">Find the long table.</h2>

        <div class="mt-4 border-y border-[#30201B]/20 py-7 text-sm leading-7 space-y-6">
          <div>
            <strong class="font-semibold block text-[#30201B]">C HOUSE</strong>
            <p class="text-[#30201B]/80 mt-1">
              <?= e($s['address_line1'] ?? 'H Rd, Jebel Ali Recreation Club, Jebel Ali Village') ?><br>
              <?= e($s['address_line2'] ?? 'Behind Ibn Battuta Mall, Dubai') ?>
            </p>
          </div>

          <div>
            <strong class="font-semibold block text-[#30201B]">Opening Hours</strong>
            <p class="text-[#30201B]/80 mt-1">
              <?php if (!empty($s['hours_weekday']) || !empty($s['hours_weekend'])): ?>
                <?php if (!empty($s['hours_weekday'])): ?><?= e($s['hours_weekday']) ?><br><?php endif; ?>
                <?php if (!empty($s['hours_weekend'])): ?><?= e($s['hours_weekend']) ?><?php endif; ?>
              <?php else: ?>
                Sun - Thu: 12:00 PM - 12:00 AM (Midnight)<br>Fri - Sat: 12:00 PM - 2:00 AM
              <?php endif; ?>
            </p>
          </div>

          <div class="space-y-1">
            <?php foreach ($phones as $idx => $ph): ?>
              <div>
                <a class="border-b border-[#30201B]/40 pb-0.5 hover:text-[#AA8243] transition-colors" href="tel:<?= e($ph['tel']) ?>"><?= e($ph['display']) ?></a>
                <?php if ($idx < count($phones) - 1): ?><span aria-hidden="true" class="text-[#30201B]/40 ml-1">/</span><?php endif; ?>
              </div>
            <?php endforeach; ?>
            <div class="pt-0.5">
              <a class="border-b border-[#30201B]/40 pb-0.5 hover:text-[#AA8243] transition-colors" href="mailto:<?= e($s['email'] ?? 'hello@chouse.ae') ?>">
                <?= e($s['email'] ?? 'hello@chouse.ae') ?>
              </a>
            </div>
          </div>
        </div>

        <div class="mt-6">
          <p class="text-[10px] uppercase tracking-[.16em] text-[#30201B]/60 mb-2 font-bold">WhatsApp</p>
          <p class="text-sm font-medium mb-3 text-[#30201B]"><?= e($s['whatsapp_display'] ?? '+971 52 218 5569') ?></p>
          <a href="https://wa.me/<?= e($s['whatsapp_number'] ?? '971522185569') ?>?text=Hello%2C%20I%20would%20like%20to%20make%20a%20reservation."
            target="_blank"
            class="inline-flex items-center gap-2 bg-[#30201B] text-[#f5e6c8] px-6 py-3 rounded-full font-semibold text-sm hover:bg-[#AA8243] hover:text-white border border-[#30201B] transition-colors shadow-sm">
            <i class="ti ti-brand-whatsapp text-lg"></i>
            Message Us
          </a>
        </div>

        <div class="mt-8">
          <?php
          $c_map_q = rawurlencode($s['map_query'] ?? 'C House Milano Cafe & Restaurant Jebel Ali Village Dubai');
          $c_lat = trim($s['map_lat'] ?? '');
          $c_lng = trim($s['map_lng'] ?? '');
          $c_has_ll = ($c_lat !== '' && $c_lng !== '');
          $c_google = $s['google_maps_url'] ?? $s['google_maps_link'] ?? 'https://maps.app.goo.gl/4eRoVnKG8e34B3jo7?g_st=ic';
          $c_waze   = $s['waze_url'] ?? ($c_has_ll ? 'https://waze.com/ul?ll=' . $c_lat . ',' . $c_lng . '&navigate=yes' : 'https://waze.com/ul?q=' . rawurlencode('C House Milano Cafe and Restaurant Jebel Ali Dubai') . '&navigate=yes');
          $c_apple  = $s['apple_maps_url'] ?? ($c_has_ll ? 'https://maps.apple.com/?daddr=' . $c_lat . ',' . $c_lng . '&dirflg=d' : 'https://maps.apple.com/?daddr=' . rawurlencode('C House Milano Cafe & Restaurant Jebel Ali Dubai') . '&dirflg=d');
          ?>
          <div class="relative inline-block" id="contact-directions-wrap">
            <button onclick="document.getElementById('contact-directions-menu').classList.toggle('hidden')" class="mora-text-action text-[11px] font-bold uppercase tracking-[.16em] inline-flex items-center gap-1.5 focus-visible:outline-2 focus-visible:outline-[#30201B] focus-visible:outline-offset-4 transition-colors duration-200 hover:text-[#AA8243]" type="button">
              <span>Get directions</span>
              <i aria-hidden="true" class="ti ti-arrow-up-right text-sm"></i>
            </button>
            <div id="contact-directions-menu" class="hidden absolute left-0 top-full mt-2 z-50 bg-white border border-[#30201B]/15 rounded-xl overflow-hidden shadow-xl min-w-[180px]">
              <a class="flex items-center gap-2.5 px-4 py-3 text-[11px] uppercase tracking-[.12em] text-[#30201B]/80 hover:bg-[#f5f0e8] hover:text-[#30201B] transition-colors" href="<?= e($c_google) ?>" rel="noreferrer" target="_blank">
                <i class="ti ti-brand-google-maps text-base"></i> Google Maps
              </a>
              <a class="flex items-center gap-2.5 px-4 py-3 text-[11px] uppercase tracking-[.12em] text-[#30201B]/80 hover:bg-[#f5f0e8] hover:text-[#30201B] transition-colors border-t border-[#30201B]/10" href="<?= e($c_waze) ?>" rel="noreferrer" target="_blank">
                <i class="ti ti-navigation text-base"></i> Waze
              </a>
              <a class="flex items-center gap-2.5 px-4 py-3 text-[11px] uppercase tracking-[.12em] text-[#30201B]/80 hover:bg-[#f5f0e8] hover:text-[#30201B] transition-colors border-t border-[#30201B]/10" href="<?= e($c_apple) ?>" rel="noreferrer" target="_blank">
                <i class="ti ti-brand-apple text-base"></i> Apple Maps
              </a>
            </div>
          </div>
        </div>

        <script>
          document.addEventListener('click', function(e) {
            const wrap = document.getElementById('contact-directions-wrap');
            const menu = document.getElementById('contact-directions-menu');
            if (wrap && menu && !wrap.contains(e.target)) menu.classList.add('hidden');
          });
        </script>
      </div>

      <!-- RIGHT: Floating form card (replaces the map) -->
      <div class="bg-[#30201B] text-[#F2E7D4] rounded-2xl shadow-2xl p-8 sm:p-10">
        <h2 class="mora-serif text-3xl mb-2">Reserve or Enquire</h2>
        <p class="text-[#F2E7D4]/60 text-sm mb-8">Tell us what you're looking for and we'll get back to you.</p>

        <!-- Acknowledgement Messages (Hidden by default) -->
        <div id="form-success"
          class="hidden bg-green-500/20 border border-green-500/50 text-green-200 p-4 rounded-lg mb-6">
          <p class="font-semibold text-sm">✓ Message sent successfully!</p>
          <p class="text-xs opacity-80 mt-1">We will get back to you shortly.</p>
        </div>
        <div id="form-error" class="hidden bg-red-500/20 border border-red-500/50 text-red-200 p-4 rounded-lg mb-6">
          <p class="font-semibold text-sm">✕ Something went wrong.</p>
          <p class="text-xs opacity-80 mt-1">Please try again or contact us directly.</p>
        </div>

        <form id="contactForm" class="space-y-5" action="send-email.php" method="POST">

          <div>
            <label class="block text-xs uppercase tracking-wide mb-2">Name *</label>
            <input type="text" name="name" required placeholder="Your name"
              class="w-full bg-[#F2E7D4]/10 border border-[#F2E7D4]/20 rounded-lg px-4 py-3 text-sm placeholder-[#F2E7D4]/40 focus:outline-none focus:border-[#AA8243]">
          </div>

          <div>
            <label class="block text-xs uppercase tracking-wide mb-2">Email *</label>
            <input type="email" name="email" required placeholder="you@example.com"
              class="w-full bg-[#F2E7D4]/10 border border-[#F2E7D4]/20 rounded-lg px-4 py-3 text-sm placeholder-[#F2E7D4]/40 focus:outline-none focus:border-[#AA8243]">
          </div>

          <div>
            <label class="block text-xs uppercase tracking-wide mb-2">Phone Number *</label>
            <input type="tel" name="phone" required placeholder="+971 ..."
              class="w-full bg-[#F2E7D4]/10 border border-[#F2E7D4]/20 rounded-lg px-4 py-3 text-sm placeholder-[#F2E7D4]/40 focus:outline-none focus:border-[#AA8243]">
          </div>

          <div>
            <label class="block text-xs uppercase tracking-wide mb-2">What can we help with?</label>
            <select name="service"
              class="w-full bg-[#F2E7D4]/10 border border-[#F2E7D4]/20 rounded-lg px-4 py-3 text-sm focus:outline-none focus:border-[#AA8243]">
              <option value="">Select an option</option>
              <option value="reservation">Table Reservation</option>
              <option value="private-event">Private Celebration</option>
              <option value="general">General Enquiry</option>
            </select>
          </div>

          <div>
            <label class="block text-xs uppercase tracking-wide mb-2">Message *</label>
            <textarea name="message" rows="4" required placeholder="Tell us what you need..."
              class="w-full bg-[#F2E7D4]/10 border border-[#F2E7D4]/20 rounded-lg px-4 py-3 text-sm placeholder-[#F2E7D4]/40 focus:outline-none focus:border-[#AA8243] resize-y"></textarea>
          </div>

          <button type="submit"
            class="w-full bg-[#AA8243] text-[#30201B] font-semibold uppercase text-xs tracking-widest py-4 rounded-lg hover:bg-[#F2E7D4] transition-colors mt-4">
            Send Message →
          </button>

        </form>
      </div>

    </section>
  </main>

  <?php include __DIR__ . '/includes/footer.php'; ?>

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

      // Check URL for form submission status
      const urlParams = new URLSearchParams(window.location.search);
      const status = urlParams.get('status');

      if (status === 'success') {
        const successEl = document.getElementById('form-success');
        if (successEl) {
          successEl.classList.remove('hidden');
          successEl.scrollIntoView({
            behavior: 'smooth',
            block: 'center'
          });
        }
      } else if (status === 'error') {
        const errorEl = document.getElementById('form-error');
        if (errorEl) {
          errorEl.classList.remove('hidden');
          errorEl.scrollIntoView({
            behavior: 'smooth',
            block: 'center'
          });
        }
      }
    });
  </script>
  <a aria-label="Chat with us on WhatsApp" rel="noopener" href="https://wa.me/971522185569?text=Hello%2C%20I%20would%20like%20to%20make%20a%20reservation." target="_blank"
    class="fixed bottom-6 right-6 lg:bottom-10 lg:right-10 z-50 bg-[#30201B] text-[#f5e6c8] border border-[#f5e6c8]/20 w-14 h-14 rounded-full flex items-center justify-center shadow-[0_8px_30px_rgb(0,0,0,0.3)] hover:bg-[#f5e6c8] hover:text-[#30201B] hover:scale-110 transition-all duration-300">
    <i class="ti ti-brand-whatsapp text-2xl"></i>
  </a>
</body>

</html>