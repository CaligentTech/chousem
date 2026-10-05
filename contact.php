<?php
require_once __DIR__ . '/admin/includes/db.php';
require_once __DIR__ . '/admin/includes/functions.php';
$s = get_all_settings($pdo);
$contact_content = get_page_content($pdo, 'contact');
?>
<!DOCTYPE html>
<html lang="en" class="bg-[#EBDDCB] overscroll-none">

<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <title>Contact Us &mdash; C HOUSE &middot; Italian Bistro &middot; Bar &middot; Lounge</title>
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
  <div class="w-full">
    <header aria-label="Primary navigation" class="relative z-50 pt-6 px-5 sm:px-8 lg:px-12 text-[#30201B]">
      <div class="mx-auto flex h-[72px] max-w-[1360px] items-center justify-between relative">

        <!-- Logo & Brand Name -->
        <div class="flex items-center">
          <a aria-label="home" class="flex items-center gap-3 text-[#30201B]" href="./index.php">
            <img src="gallery/logo.webp" class="h-28 w-auto object-contain -ml-4 logo-dark-brown" alt="C HOUSE Logo" />
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
            href="menu.php">Menu</a>
          <a class="flex items-center gap-1.5 rounded-full px-4 py-2 text-[13px] tracking-widest uppercase text-[#30201B]/80 transition-colors hover:bg-[#30201B]/15 hover:text-[#30201B]"
            href="./about.php">About</a>
          <a class="flex items-center gap-1.5 rounded-full px-4 py-2 text-[13px] tracking-widest uppercase text-[#30201B]/80 transition-colors hover:bg-[#30201B]/15 hover:text-[#30201B]"
            href="bar.php">Bar</a>
          <a class="flex items-center gap-1.5 rounded-full px-4 py-2 text-[13px] tracking-widest uppercase text-[#30201B]/80 transition-colors hover:bg-[#30201B]/15 hover:text-[#30201B]"
            href="./experience.php">Experience</a>
          <a class="flex items-center gap-1.5 rounded-full px-4 py-2 text-[13px] tracking-widest uppercase text-[#30201B]/80 transition-colors hover:bg-[#30201B]/15 hover:text-[#30201B]"
            href="./gallery.php">Gallery</a>
          <a class="flex items-center gap-1.5 rounded-full px-4 py-2 text-[13px] tracking-widest uppercase bg-[#30201B] text-[#EBDDCB] font-semibold shadow-sm"
            href="./contact.php" aria-current="page">Contact</a>
        </nav>

        <!-- Right: Reserve a Table Button -->
        <div class="hidden lg:flex items-center gap-4">
          <a href="./contact.php"
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
          <a class="text-[13px] tracking-widest uppercase text-white/80 py-2 border-b border-white/10"
            href="./gallery.php">Gallery</a>
          <a class="text-[13px] tracking-widest uppercase text-white py-2 border-b border-white/10 font-semibold"
            href="./contact.php">Contact</a>
          <a href="./contact.php"
            class="mt-2 flex items-center justify-center gap-2 bg-white text-black text-[13px] font-semibold rounded-full py-3">
            Reserve a Table <i class="ti ti-arrow-up-right"></i>
          </a>
        </nav>
      </div>
    </header>

    <section
      class="w-full max-w-[1360px] mx-auto px-5 sm:px-8 lg:px-12 py-16 grid grid-cols-1 lg:grid-cols-2 gap-10 items-start">

      <!-- LEFT: Keep your existing info block exactly as it is -->
      <div>
        <h1 class="mora-serif text-5xl sm:text-6xl text-[#30201B] mb-6"><?= e($contact_content['hero']['heading'] ?? 'Find the long table.') ?></h1>
        <!-- your existing C HOUSE address, hours, phone, email, Get Directions/Reserve links go here unchanged -->
        <div class="mx-auto grid max-w-[1360px] gap-14 lg:grid-cols-[.75fr_1.25fr] lg:gap-16" data-kid="2-2-8-1"
          data-name="contact grid container">
          <div class="mora-reveal is-visible" data-kid="2-2-8-1-1" data-name="contact info block" data-reveal="">

            <div class="mt-4 border-y border-[var(--mora-espresso)]/28 py-7 text-sm leading-7" data-kid="2-2-8-1-1-3"
              data-name="contact details list">
              <p class="flex items-start gap-3" data-kid="2-2-8-1-1-3-1" data-name="contact location">
                <i aria-hidden="true" class="ti ti-map-pin mt-1 text-base text-[var(--mora-clay)]"
                  data-kid="2-2-8-1-1-3-1-1" data-name="location pin icon">
                </i>
                <span data-kid="2-2-8-1-1-3-1-2" data-name="location address block">
                  <strong class="font-semibold" data-kid="2-2-8-1-1-3-1-2-1" data-name="location company name">
                    C HOUSE
                  </strong>
                  <br data-kid="2-2-8-1-1-3-1-2-2" data-name="line break" />
                  <?= e($s['address_line1'] ?? 'H Rd, Jebel Ali Recreation Club, Jebel Ali Village') ?>
                  <br data-kid="2-2-8-1-1-3-1-2-3" data-name="location address lines" />
                  <?= e($s['address_line2'] ?? 'Behind IBN Batuta Mall, Dubai') ?>
                </span>
              </p>
              <p class="mt-6 flex items-start gap-3" data-kid="2-2-8-1-1-3-2" data-name="contact hours">
                <i aria-hidden="true" class="ti ti-clock mt-1 text-base text-[var(--mora-clay)]"
                  data-kid="2-2-8-1-1-3-2-1" data-name="clock icon">
                </i>
                <span data-kid="2-2-8-1-1-3-2-2" data-name="hours block">
                  <strong class="font-semibold" data-kid="2-2-8-1-1-3-2-2-1" data-name="hours title">
                    Hours Of Operations
                  </strong>
                  <br data-kid="2-2-8-1-1-3-2-2-2" data-name="line break" />
                  <?php if (!empty($s['hours_weekday']) && !empty($s['hours_weekend'])): ?>
                    <?= e($s['hours_weekday']) ?> &amp; <?= e($s['hours_weekend']) ?>
                  <?php elseif (!empty($s['hours_weekday'])): ?>
                    <?= e($s['hours_weekday']) ?>
                  <?php else: ?>
                    Sun - Thu 12:00PM - 00:00AM &amp; Fri-Sat 12:00PM - 2:00AM
                  <?php endif; ?>
                </span>
              </p>
              <p class="mt-6 flex items-start gap-3" data-kid="2-2-8-1-1-3-3" data-name="contact methods">
                <i aria-hidden="true" class="ti ti-phone mt-1 text-base text-[var(--mora-clay)]"
                  data-kid="2-2-8-1-1-3-3-1" data-name="phone icon">
                </i>
                <span data-kid="2-2-8-1-1-3-3-2" data-name="methods block">
                  <?php if (!empty($s['phone_numbers'])):
                    $phones = array_map('trim', preg_split('/[,|\/]/', $s['phone_numbers']));
                  ?>
                    <span class="inline-flex flex-wrap items-center gap-x-1 gap-y-1">
                      <?php foreach ($phones as $idx => $phone):
                        $cleanPhone = preg_replace('/[^0-9+]/', '', $phone);
                      ?>
                        <?php if ($idx > 0): ?>/ <?php endif; ?>
                      <a class="border-b border-[var(--mora-espresso)]/50 pb-1 focus-visible:outline-2 focus-visible:outline-[var(--mora-espresso)] focus-visible:outline-offset-4"
                        data-kid="2-2-8-1-1-3-3-2-1" data-name="phone link" href="tel:<?= e($cleanPhone) ?>"><?= e($phone) ?></a>
                    <?php endforeach; ?>
                    </span>
                  <?php else: ?>
                    <span class="inline-flex flex-wrap items-center gap-x-1 gap-y-1"><a class="border-b border-[var(--mora-espresso)]/50 pb-1 focus-visible:outline-2 focus-visible:outline-[var(--mora-espresso)] focus-visible:outline-offset-4"
                        data-kid="2-2-8-1-1-3-3-2-1" data-name="phone link" href="tel:+971522185569">052 218 5569</a> / <a class="border-b border-[var(--mora-espresso)]/50 pb-1 focus-visible:outline-2 focus-visible:outline-[var(--mora-espresso)] focus-visible:outline-offset-4"
                        data-kid="2-2-8-1-1-3-3-2-1" data-name="phone link" href="tel:+971504603469">050 460 3469</a> / <a class="border-b border-[var(--mora-espresso)]/50 pb-1 focus-visible:outline-2 focus-visible:outline-[var(--mora-espresso)] focus-visible:outline-offset-4"
                        data-kid="2-2-8-1-1-3-3-2-1" data-name="phone link" href="tel:+97148803320">(04) 880 3320</a></span>
                  <?php endif; ?>
                  <br data-kid="2-2-8-1-1-3-3-2-2" data-name="line break" />
                  <a class="border-b border-[var(--mora-espresso)]/50 pb-1 focus-visible:outline-2 focus-visible:outline-[var(--mora-espresso)] focus-visible:outline-offset-4"
                    data-kid="2-2-8-1-1-3-3-2-3" data-name="email link" href="mailto:<?= e($s['email'] ?? 'hello@chouse.ae') ?>">
                    <?= e($s['email'] ?? 'hello@chouse.ae') ?>
                  </a>
                </span>
              </p>
            </div>
            <!-- ADD MESSAGE US BUTTON HERE -->
            <div class="mt-6">
              <p class="text-[10px] uppercase tracking-[.16em] text-[var(--mora-espresso)]/60 mb-2">
                WhatsApp</p>
              <p class="text-sm mb-3"><?= e($s['whatsapp_display'] ?? '+971 52 218 5569') ?></p>
              <a href="https://wa.me/<?= e($s['whatsapp_number'] ?? '971522185569') ?>?text=Hello%2C%20I%20would%20like%20to%20make%20a%20reservation."
                target="_blank"
                class="inline-flex items-center gap-2 bg-[#30201B] text-[#f5e6c8] px-5 py-3 rounded-full font-semibold text-sm hover:bg-[#f5e6c8] hover:text-[#30201B] border border-[#30201B] transition-colors shadow-sm">
                <i class="ti ti-brand-whatsapp text-lg"></i>
                Message Us
              </a>
            </div>

            <div class="mt-8 flex flex-wrap gap-x-7 gap-y-5" data-kid="2-2-8-1-1-4"
              data-name="contact buttons container">
              <a class="mora-text-action text-[10px] font-bold uppercase tracking-[.16em] focus-visible:outline-2 focus-visible:outline-[var(--mora-espresso)] focus-visible:outline-offset-4 transition-colors duration-200 hover:text-[#AA8243]"
                data-kid="2-2-8-1-1-4-1" data-name="directions link"
                href="<?= e($s['google_maps_link'] ?? 'https://www.google.com/maps/search/?api=1&query=Jebel+Ali+Recreation+Club+Dubai') ?>"
                rel="noreferrer" target="_blank">
                Get directions
                <i aria-hidden="true" class="ti ti-arrow-up-right text-sm" data-kid="2-2-8-1-1-4-1-1"
                  data-name="arrow-up-right icon">
                </i>
              </a>
              <button
                class="mora-text-action text-[10px] font-bold uppercase tracking-[.16em] focus-visible:outline-2 focus-visible:outline-[var(--mora-espresso)] focus-visible:outline-offset-4 transition-colors duration-200 hover:text-[#AA8243]"
                data-kid="2-2-8-1-1-4-2" data-name="reserve button" data-open-reservation="" type="button">
                Reserve a table
                <i aria-hidden="true" class="ti ti-arrow-up-right text-sm" data-kid="2-2-8-1-1-4-2-1"
                  data-name="arrow-up-right icon">
                </i>
              </button>
            </div>
          </div>
        </div>
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
    <?php include __DIR__ . '/includes/footer.php'; ?>
    <script>
      function switchCategory(cat) {
        // Hide all panels
        const panels = document.querySelectorAll('.contact-panel');
        panels.forEach(p => p.classList.add('hidden'));

        // Show selected panel
        const targetPanel = document.getElementById('contact-' + cat);
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

      // Check URL for form submission status
      const urlParams = new URLSearchParams(window.location.search);
      const status = urlParams.get('status');

      if (status === 'success') {
        document.getElementById('form-success').classList.remove('hidden');
        // Optional: scroll to the message
        document.getElementById('form-success').scrollIntoView({
          behavior: 'smooth',
          block: 'center'
        });
      } else if (status === 'error') {
        document.getElementById('form-error').classList.remove('hidden');
        document.getElementById('form-error').scrollIntoView({
          behavior: 'smooth',
          block: 'center'
        });
      }
    </script>
  </div>
  <a href="https://wa.me/971522185569?text=Hello%2C%20I%20would%20like%20to%20make%20a%20reservation." target="_blank"
    class="fixed bottom-6 right-6 lg:bottom-10 lg:right-10 z-50 bg-[#30201B] text-[#f5e6c8] border border-[#f5e6c8]/20 w-14 h-14 rounded-full flex items-center justify-center shadow-[0_8px_30px_rgb(0,0,0,0.3)] hover:bg-[#f5e6c8] hover:text-[#30201B] hover:scale-110 transition-all duration-300">
    <i class="ti ti-brand-whatsapp text-2xl"></i>
  </a>
</body>

</html>