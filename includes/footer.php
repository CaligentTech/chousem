<?php

/** @var array<string, mixed> $s */
if (!isset($s) || !is_array($s)) {
    if (file_exists(__DIR__ . '/db.php') && file_exists(__DIR__ . '/functions.php')) {
        require_once __DIR__ . '/db.php';
        require_once __DIR__ . '/functions.php';
        $s = isset($pdo) ? get_all_settings($pdo) : [];
    } else {
        $s = [];
    }
}
if (!function_exists('e')) {
    function e($str)
    {
        return htmlspecialchars((string)($str ?? ''), ENT_QUOTES, 'UTF-8');
    }
}
?>
<!-- FOOTER (shared partial) -->
<footer class="bg-black px-5 py-6 text-[var(--mora-candle)] sm:px-8 lg:px-10 lg:py-8" data-kid="2-3"
    data-name="main page footer">
    <div class="mx-auto max-w-[1360px]" data-kid="2-3-1" data-name="footer wrapper">
        <div class="flex flex-col gap-6 border-b border-[var(--mora-candle)]/25 pb-8 lg:flex-row lg:items-end lg:justify-between"
            data-kid="2-3-1-1" data-name="footer header grid">
            <div data-kid="2-3-1-1-1" data-name="footer brand container">
                <div class="flex items-center" data-kid="2-3-1-1-1-1" data-name="brand name title">
                    <img src="gallery/logo.webp" class="h-16 sm:h-24 lg:h-28 w-auto object-contain -ml-4 lg:-ml-6"
                        alt="Logo">
                    <div class="mora-serif text-[clamp(2.5rem,5vw,4rem)] leading-[.9] tracking-[-.05em] ml-2">
                        C HOUSE
                    </div>
                </div>
                <p class="mt-5 text-[10px] font-semibold uppercase tracking-[.24em] text-[var(--mora-candle)]/58"
                    data-kid="2-3-1-1-1-2" data-name="brand subtitle">
                    Italian bistro · bar · lounge
                </p>
            </div>
        </div>
        <div class="grid gap-12 py-8 text-sm sm:grid-cols-2 lg:grid-cols-[1.3fr_.8fr_1fr]" data-kid="2-3-1-2"
            data-name="footer links grid">
            <div data-kid="2-3-1-2-1" data-name="footer visit column">
                <p class="mora-kicker text-[var(--mora-brass)]" data-kid="2-3-1-2-1-1" data-name="visit kicker text">
                    Visit
                </p>
                <div class="mt-5 leading-7 text-[var(--mora-candle)]/68" data-kid="2-3-1-2-1-2"
                    data-name="visit content list">
                    <p data-kid="2-3-1-2-1-2-1" data-name="address line 1"><?= e($s['address_line1'] ?? 'H Rd, Jebel Ali Recreation Club') ?></p>
                    <p data-kid="2-3-1-2-1-2-2" data-name="hours line"><?= e($s['hours_weekday'] ?? 'Sun - Thu 12:00PM - 00:00AM') ?> &amp; <?= e($s['hours_weekend'] ?? 'Fri-Sat 12:00PM - 2:00AM') ?></p>
                    <p data-kid="2-3-1-2-1-2-3" data-name="location line"><?= e($s['address_line2'] ?? 'Behind IBN Batuta Mall, Dubai') ?></p>
                    <a class="mora-menu-link mt-4 inline-block border-b border-[var(--mora-candle)]/35 pb-1 text-[11px] uppercase tracking-[.12em]"
                        data-kid="2-3-1-2-1-2-4" data-name="directions link"
                        href="https://www.google.com/maps/search/?api=1&amp;query=Jebel+Ali+Recreation+Club+Dubai"
                        rel="noreferrer" target="_blank">
                        Directions
                        <i aria-hidden="true" class="ti ti-arrow-up-right ml-1" data-kid="2-3-1-2-1-2-4-1"></i>
                    </a>
                </div>
            </div>
            <div data-kid="2-3-1-2-2" data-name="footer explore column">
                <p class="mora-kicker text-[var(--mora-brass)]" data-kid="2-3-1-2-2-1" data-name="explore kicker text">
                    Explore
                </p>
                <div class="mt-5 grid gap-3 leading-6 text-[var(--mora-candle)]/68" data-kid="2-3-1-2-2-2"
                    data-name="explore links list">
                    <a class="mora-menu-link w-fit" href="menu.php">Menu</a>
                    <a class="mora-menu-link w-fit" href="about.php">About</a>
                    <a class="mora-menu-link w-fit" href="bar.php">Bar experience</a>
                    <a class="mora-menu-link w-fit" href="experience.php">Experience</a>
                    <a class="mora-menu-link w-fit" href="gallery.php">Gallery</a>
                    <a class="mora-menu-link w-fit" href="contact.php">Private celebrations</a>
                </div>
            </div>
            <div data-kid="2-3-1-2-3" data-name="footer social column">
                <p class="mora-kicker text-[var(--mora-brass)]" data-kid="2-3-1-2-3-1" data-name="social kicker text">
                    Keep in touch
                </p>
                <div class="mt-5 grid gap-3 leading-6 text-[var(--mora-candle)]/68" data-kid="2-3-1-2-3-2"
                    data-name="social links list">
                    <a class="mora-menu-link w-fit" href="https://www.facebook.com/chouseuae/" rel="noreferrer" target="_blank">Facebook</a>
                    <a class="mora-menu-link w-fit" href="<?= e($s['instagram_url'] ?? 'https://www.instagram.com/chouseuae/') ?>" rel="noreferrer" target="_blank">
                        Instagram
                        <i aria-hidden="true" class="ti ti-instagram ml-1"></i>
                    </a>
                    <span class="inline-flex flex-wrap items-center gap-1">
                        <a class="mora-menu-link w-fit" href="<?= e($s['phone_link'] ?? 'tel:+971522185569') ?>"><?= e($s['phone_numbers'] ?? '052 218 5569 / 050 460 3469 / (04) 880 3320') ?></a>
                    </span>
                    <a class="mora-menu-link w-fit" href="mailto:<?= e($s['email'] ?? 'hello@chouse.ae') ?>"><?= e($s['email'] ?? 'hello@chouse.ae') ?></a>
                </div>
            </div>
        </div>
        <div class="flex flex-col gap-3 border-t border-[var(--mora-candle)]/25 pt-6 text-[10px] uppercase tracking-[.14em] text-[var(--mora-candle)]/52 sm:flex-row sm:items-center sm:justify-between"
            data-kid="2-3-1-3">
            <span data-kid="2-3-1-3-1"><?= e($s['footer_copyright'] ?? '© C HOUSE Dubai') ?></span>
            <span data-kid="2-3-1-3-2"><?= e($s['footer_advice'] ?? 'Reservations recommended for dinner') ?></span>
        </div>
    </div>
</footer>