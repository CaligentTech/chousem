<?php
require_once __DIR__ . '/auth.php';
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - C House</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@2.36.0/tabler-icons.min.css">
    <style>
        body { font-family: 'Manrope', sans-serif; background-color: #f3f4f6; }
    </style>
</head>
<body class="flex h-[100dvh] overflow-hidden relative">
    <!-- Mobile Backdrop -->
    <div id="sidebar-backdrop" class="fixed inset-0 bg-black/50 z-40 hidden md:hidden transition-opacity opacity-0"></div>
    
    <!-- Sidebar -->
    <aside id="admin-sidebar" class="w-64 bg-[#1C1A18] text-gray-300 flex-col absolute inset-y-0 left-0 transform -translate-x-full md:relative md:translate-x-0 transition-transform duration-200 ease-in-out z-50 flex shadow-2xl md:shadow-none">
        <div class="h-16 flex items-center px-6 border-b border-[#3A3633]">
            <span class="text-xl font-bold text-white tracking-wide">C HOUSE <span class="text-[#D4AF37]">ADMIN</span></span>
        </div>
        <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
            <a href="index.php" class="flex items-center gap-3 px-3 py-2 rounded-lg <?= $current_page == 'index.php' ? 'bg-[#D4AF37] text-black font-semibold' : 'hover:bg-[#2A2623] hover:text-white' ?>">
                <i class="ti ti-dashboard text-xl"></i> Dashboard
            </a>
            <a href="page_content.php" class="flex items-center gap-3 px-3 py-2 rounded-lg <?= $current_page == 'page_content.php' ? 'bg-[#D4AF37] text-black font-semibold' : 'hover:bg-[#2A2623] hover:text-white' ?>">
                <i class="ti ti-file-text text-xl"></i> Page Content
            </a>
            <a href="site_settings.php" class="flex items-center gap-3 px-3 py-2 rounded-lg <?= $current_page == 'site_settings.php' ? 'bg-[#D4AF37] text-black font-semibold' : 'hover:bg-[#2A2623] hover:text-white' ?>">
                <i class="ti ti-settings text-xl"></i> Site Settings
            </a>
            <a href="categories.php" class="flex items-center gap-3 px-3 py-2 rounded-lg <?= $current_page == 'categories.php' ? 'bg-[#D4AF37] text-black font-semibold' : 'hover:bg-[#2A2623] hover:text-white' ?>">
                <i class="ti ti-category text-xl"></i> Menu Categories
            </a>
            <a href="menu_items.php" class="flex items-center gap-3 px-3 py-2 rounded-lg <?= $current_page == 'menu_items.php' ? 'bg-[#D4AF37] text-black font-semibold' : 'hover:bg-[#2A2623] hover:text-white' ?>">
                <i class="ti ti-tools-kitchen-2 text-xl"></i> Menu Items
            </a>
            <a href="gallery.php" class="flex items-center gap-3 px-3 py-2 rounded-lg <?= $current_page == 'gallery.php' ? 'bg-[#D4AF37] text-black font-semibold' : 'hover:bg-[#2A2623] hover:text-white' ?>">
                <i class="ti ti-photo text-xl"></i> Gallery
            </a>
            <a href="events.php" class="flex items-center gap-3 px-3 py-2 rounded-lg <?= $current_page == 'events.php' ? 'bg-[#D4AF37] text-black font-semibold' : 'hover:bg-[#2A2623] hover:text-white' ?>">
                <i class="ti ti-calendar-event text-xl"></i> Events
            </a>
            <a href="offers.php" class="flex items-center gap-3 px-3 py-2 rounded-lg <?= $current_page == 'offers.php' ? 'bg-[#D4AF37] text-black font-semibold' : 'hover:bg-[#2A2623] hover:text-white' ?>">
                <i class="ti ti-ticket text-xl"></i> Offers & Bundles
            </a>
            <a href="reviews.php" class="flex items-center gap-3 px-3 py-2 rounded-lg <?= $current_page == 'reviews.php' ? 'bg-[#D4AF37] text-black font-semibold' : 'hover:bg-[#2A2623] hover:text-white' ?>">
                <i class="ti ti-message-star text-xl"></i> Reviews
            </a>
        </nav>
        <div class="p-4 border-t border-[#3A3633]">
            <a href="logout.php" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-red-500/10 hover:text-red-500 transition">
                <i class="ti ti-logout text-xl"></i> Logout
            </a>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 flex flex-col overflow-hidden">
        <header class="h-16 bg-white shadow-sm flex items-center justify-between px-6 z-10 md:justify-end">
            <button id="mobile-menu-btn" class="md:hidden text-gray-600 focus:outline-none">
                <i class="ti ti-menu-2 text-2xl"></i>
            </button>
            <div class="flex items-center gap-4">
                <span class="text-sm font-medium text-gray-600">Logged in as <?= htmlspecialchars($_SESSION['admin_username'] ?? 'Admin') ?></span>
                <div class="w-8 h-8 rounded-full bg-[#1C1A18] text-[#D4AF37] flex items-center justify-center font-bold">
                    <?= strtoupper(substr($_SESSION['admin_username'] ?? 'A', 0, 1)) ?>
                </div>
            </div>
        </header>
        <div class="flex-1 overflow-y-auto p-6 pb-24 md:p-8 md:pb-8">
