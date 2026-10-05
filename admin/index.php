<?php
require_once __DIR__ . '/includes/header.php';

// Fetch quick stats
$stats = [
    'Menu Items' => $pdo->query("SELECT COUNT(*) FROM menu_items")->fetchColumn(),
    'Gallery Images' => $pdo->query("SELECT COUNT(*) FROM gallery_images")->fetchColumn(),
    'Events' => $pdo->query("SELECT COUNT(*) FROM events")->fetchColumn(),
    'Reviews' => $pdo->query("SELECT COUNT(*) FROM reviews")->fetchColumn()
];
?>

<div class="mb-8">
    <h1 class="text-3xl font-bold text-gray-800">Dashboard</h1>
    <p class="text-gray-500 mt-2">Welcome to your website administration panel.</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <?php foreach ($stats as $label => $count): ?>
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex items-center justify-between">
        <div>
            <p class="text-sm font-medium text-gray-500 uppercase tracking-wider"><?= $label ?></p>
            <p class="text-3xl font-bold text-gray-800 mt-2"><?= $count ?></p>
        </div>
        <div class="w-12 h-12 bg-[#D4AF37]/10 text-[#D4AF37] rounded-lg flex items-center justify-center text-2xl">
            <?php 
                $icon = 'ti-file';
                if ($label == 'Menu Items') $icon = 'ti-tools-kitchen-2';
                if ($label == 'Gallery Images') $icon = 'ti-photo';
                if ($label == 'Events') $icon = 'ti-calendar-event';
                if ($label == 'Reviews') $icon = 'ti-star';
            ?>
            <i class="ti <?= $icon ?>"></i>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="px-6 py-5 border-b border-gray-100 bg-gray-50">
        <h3 class="text-lg font-semibold text-gray-800">Quick Actions</h3>
    </div>
    <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-4">
        <a href="site_settings.php" class="flex items-center gap-4 p-4 border border-gray-200 rounded-lg hover:border-[#D4AF37] hover:shadow-md transition">
            <div class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center text-gray-600">
                <i class="ti ti-settings text-xl"></i>
            </div>
            <div>
                <h4 class="font-semibold text-gray-800">Update Phone/Email</h4>
                <p class="text-sm text-gray-500">Change contact details across the site.</p>
            </div>
        </a>
        <a href="page_content.php" class="flex items-center gap-4 p-4 border border-gray-200 rounded-lg hover:border-[#D4AF37] hover:shadow-md transition">
            <div class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center text-gray-600">
                <i class="ti ti-edit text-xl"></i>
            </div>
            <div>
                <h4 class="font-semibold text-gray-800">Edit Text Content</h4>
                <p class="text-sm text-gray-500">Modify headings and paragraphs.</p>
            </div>
        </a>
    </div>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
