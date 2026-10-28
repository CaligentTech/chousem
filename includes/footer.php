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
<style>
    :root {
        --mora-brass: #AA8243;
        --mora-candle: #F2E7D4;
        --mora-espresso: #30201B;
    }
    .mora-kicker {
        font-size: 10px;
        line-height: 1;
        letter-spacing: .2em;
        text-transform: uppercase;
        font-weight: 700;
    }
    .mora-menu-link {
        transition: color .25s ease, border-color .25s ease;
    }
    .mora-menu-link:hover {
        color: #C76D4D !important;
        border-color: #C76D4D !important;
    }
</style>
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
                    <p data-kid="2-3-1-2-1-2-3" data-name="location line"><?= e($s['address_line2'] ?? 'Behind IBN Batuta Mall, Dubai') ?></p>
                    <?php
                    $map_q = rawurlencode($s['map_query'] ?? 'C House Milano Cafe & Restaurant Jebel Ali Village Dubai');
                    $lat = trim($s['map_lat'] ?? '');
                    $lng = trim($s['map_lng'] ?? '');
                    $has_ll = ($lat !== '' && $lng !== '');
                    $google_url = $s['google_maps_url'] ?? 'https://maps.app.goo.gl/4eRoVnKG8e34B3jo7?g_st=ic';
                    $waze_url   = $s['waze_url'] ?? ($has_ll ? 'https://waze.com/ul?ll=' . $lat . ',' . $lng . '&navigate=yes' : 'https://waze.com/ul?q=' . rawurlencode('C House Milano Cafe and Restaurant Jebel Ali Dubai') . '&navigate=yes');
                    $apple_url  = $s['apple_maps_url'] ?? ($has_ll ? 'https://maps.apple.com/?daddr=' . $lat . ',' . $lng . '&dirflg=d' : 'https://maps.apple.com/?daddr=' . rawurlencode('C House Milano Cafe & Restaurant Jebel Ali Dubai') . '&dirflg=d');
                    ?>
                    <div class="relative mt-4 w-fit" id="footer-directions-wrap">
                        <button onclick="document.getElementById('footer-directions-menu').classList.toggle('hidden')" class="mora-menu-link inline-flex items-center gap-1.5 border-b border-[var(--mora-candle)]/35 pb-1 text-[11px] uppercase tracking-[.12em]" type="button">
                            Directions <i class="ti ti-arrow-up-right ml-1"></i>
                        </button>
                        <div id="footer-directions-menu" class="hidden absolute left-0 top-full mt-2 z-50 bg-[#1a1a1a] border border-[var(--mora-candle)]/20 rounded-xl overflow-hidden shadow-xl min-w-[180px]">
                            <a class="flex items-center gap-2.5 px-4 py-3 text-[11px] uppercase tracking-[.12em] text-[var(--mora-candle)]/80 hover:bg-white/10 hover:text-white transition-colors" href="<?= e($google_url) ?>" rel="noreferrer" target="_blank">
                                <i class="ti ti-brand-google-maps text-base"></i> Google Maps
                            </a>
                            <a class="flex items-center gap-2.5 px-4 py-3 text-[11px] uppercase tracking-[.12em] text-[var(--mora-candle)]/80 hover:bg-white/10 hover:text-white transition-colors border-t border-[var(--mora-candle)]/10" href="<?= e($waze_url) ?>" rel="noreferrer" target="_blank">
                                <i class="ti ti-navigation text-base"></i> Waze
                            </a>
                            <a class="flex items-center gap-2.5 px-4 py-3 text-[11px] uppercase tracking-[.12em] text-[var(--mora-candle)]/80 hover:bg-white/10 hover:text-white transition-colors border-t border-[var(--mora-candle)]/10" href="<?= e($apple_url) ?>" rel="noreferrer" target="_blank">
                                <i class="ti ti-brand-apple text-base"></i> Apple Maps
                            </a>
                        </div>
                    </div>
                    <script>
                        document.addEventListener('click', function(e) {
                            const wrap = document.getElementById('footer-directions-wrap');
                            const menu = document.getElementById('footer-directions-menu');
                            if (wrap && menu && !wrap.contains(e.target)) menu.classList.add('hidden');
                        });
                    </script>
                </div>
            </div>
            <div data-kid="2-3-1-2-2" data-name="footer explore column">
                <p class="mora-kicker text-[var(--mora-brass)]" data-kid="2-3-1-2-2-1" data-name="explore kicker text">
                    Explore
                </p>
                <div class="mt-5 grid gap-3 leading-6 text-[var(--mora-candle)]/68" data-kid="2-3-1-2-2-2"
                    data-name="explore links list">
                    <a class="mora-menu-link w-fit" href="menu">Menu</a>
                    <a class="mora-menu-link w-fit" href="about">About</a>
                    <a class="mora-menu-link w-fit" href="bar">Bar</a>
                    <a class="mora-menu-link w-fit" href="experience">Experience</a>
                    <a class="mora-menu-link w-fit" href="gallery">Gallery</a>
                    <a class="mora-menu-link w-fit" href="contact">Contact</a>
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
                        <a class="mora-menu-link w-fit" data-kid="2-3-1-2-3-2-2" data-name="phone link" href="tel:+971522185569">+971 52 218 5569</a> / 
                        <a class="mora-menu-link w-fit" data-kid="2-3-1-2-3-2-2" data-name="phone link" href="tel:+971504603469">+971 50 460 3469</a>
                    </span>
                    <a class="mora-menu-link w-fit" href="mailto:<?= e($s['email'] ?? 'hello@chouse.ae') ?>"><?= e($s['email'] ?? 'hello@chouse.ae') ?></a>
                </div>
            </div>
        </div>
        <div class="flex flex-col gap-3 border-t border-[var(--mora-candle)]/25 pt-6 text-[11px] uppercase tracking-[.14em] text-[var(--mora-candle)]/75 sm:flex-row sm:items-center sm:justify-between"
            data-kid="2-3-1-3">
            <span data-kid="2-3-1-3-1">&copy; <?= date('Y') ?> <?= e($s['site_name'] ?? 'C HOUSE') ?>. All rights reserved.</span>
            <span data-kid="2-3-1-3-2"><?= e($s['footer_advice'] ?? 'Reservations recommended for dinner') ?></span>
        </div>
    </div>
</footer>