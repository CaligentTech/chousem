<?php
require_once __DIR__ . '/includes/auth.php';

$message = '';

// Handle toggling active status
if (isset($_GET['toggle']) && isset($_GET['id'])) {
    $stmt = $pdo->prepare("UPDATE menu_categories SET is_active = NOT is_active WHERE id = ?");
    $stmt->execute([$_GET['id']]);
    header("Location: categories.php");
    exit;
}

// Handle Form Submission (Add/Edit)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && $_POST['action'] === 'save') {
        $id = $_POST['id'] ?? '';
        $menu_type = $_POST['menu_type'] ?? 'food';
        $name = $_POST['name'] ?? '';
        $subtitle = $_POST['subtitle'] ?? '';
        $sort_order = $_POST['sort_order'] ?? 0;
        
        try {
            if ($id) {
                $stmt = $pdo->prepare("UPDATE menu_categories SET menu_type=?, name=?, subtitle=?, sort_order=? WHERE id=?");
                $stmt->execute([$menu_type, $name, $subtitle, $sort_order, $id]);
                $message = "Category updated successfully.";
            } else {
                $stmt = $pdo->prepare("INSERT INTO menu_categories (menu_type, name, subtitle, sort_order, is_active) VALUES (?, ?, ?, ?, 1)");
                $stmt->execute([$menu_type, $name, $subtitle, $sort_order]);
                $message = "Category added successfully.";
            }
        } catch (PDOException $e) {
            $message = "Error: " . $e->getMessage();
        }
    }
}

// Fetch categories
$stmt = $pdo->query("SELECT * FROM menu_categories ORDER BY menu_type, sort_order");
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

$edit_item = null;
if (isset($_GET['edit'])) {
    $stmt = $pdo->prepare("SELECT * FROM menu_categories WHERE id = ?");
    $stmt->execute([$_GET['edit']]);
    $edit_item = $stmt->fetch(PDO::FETCH_ASSOC);
}

require_once __DIR__ . '/includes/header.php';
?>

<div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
    <div>
        <h1 class="text-3xl font-bold text-gray-800">Menu Categories</h1>
        <p class="text-gray-500 mt-2">Create and organize sections for the restaurant and bar menus.</p>
    </div>
    <?php if (!isset($_GET['add']) && !isset($_GET['edit'])): ?>
    <a href="categories.php?add=1" class="bg-[#1C1A18] text-white px-4 py-2 rounded-lg font-medium hover:bg-[#2A2623] transition flex items-center gap-2">
        <i class="ti ti-plus"></i> Add New Category
    </a>
    <?php endif; ?>
</div>

<?php if ($message): ?>
    <div class="mb-6 p-4 rounded-lg <?= strpos($message, 'Error') === false ? 'bg-green-100 text-green-700 border border-green-200' : 'bg-red-100 text-red-700 border border-red-200' ?>">
        <?= htmlspecialchars($message) ?>
    </div>
<?php endif; ?>

<?php if (isset($_GET['add']) || isset($_GET['edit'])): ?>
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-8">
        <h2 class="text-xl font-bold mb-4"><?= $edit_item ? 'Edit Category' : 'Add New Category' ?></h2>
        <form method="POST" action="categories.php">
            <input type="hidden" name="action" value="save">
            <input type="hidden" name="id" value="<?= $edit_item['id'] ?? '' ?>">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Menu Page</label>
                    <select name="menu_type" class="w-full bg-white border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#D4AF37]" required>
                        <option value="food" <?= ($edit_item['menu_type'] ?? '') == 'food' ? 'selected' : '' ?>>Main Restaurant Menu</option>
                        <option value="bar_drinks" <?= ($edit_item['menu_type'] ?? '') == 'bar_drinks' ? 'selected' : '' ?>>Bar Page - Drinks</option>
                        <option value="bar_food" <?= ($edit_item['menu_type'] ?? '') == 'bar_food' ? 'selected' : '' ?>>Bar Page - Food</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Category Name</label>
                    <input type="text" name="name" value="<?= htmlspecialchars($edit_item['name'] ?? '') ?>" class="w-full bg-white border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#D4AF37]" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Subtitle (Optional description)</label>
                    <input type="text" name="subtitle" value="<?= htmlspecialchars($edit_item['subtitle'] ?? '') ?>" class="w-full bg-white border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#D4AF37]">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Sort Order (0, 1, 2...)</label>
                    <input type="number" name="sort_order" value="<?= htmlspecialchars($edit_item['sort_order'] ?? '0') ?>" class="w-full bg-white border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#D4AF37]">
                </div>
            </div>
            
            <div class="flex gap-4">
                <button type="submit" class="bg-[#D4AF37] hover:bg-[#B3932E] text-black font-bold px-6 py-2 rounded-lg transition">Save Category</button>
                <a href="categories.php" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium px-6 py-2 rounded-lg transition">Cancel</a>
            </div>
        </form>
    </div>
<?php endif; ?>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-200">
                    <th class="py-3 px-6 text-xs font-medium text-gray-500 uppercase tracking-wider">Category Name</th>
                    <th class="py-3 px-6 text-xs font-medium text-gray-500 uppercase tracking-wider">Page / Type</th>
                    <th class="py-3 px-6 text-xs font-medium text-gray-500 uppercase tracking-wider">Subtitle</th>
                    <th class="py-3 px-6 text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="py-3 px-6 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                <?php foreach ($categories as $item): ?>
                <tr class="hover:bg-gray-50 transition">
                    <td class="py-3 px-6">
                        <p class="font-medium text-gray-800"><?= htmlspecialchars($item['name']) ?></p>
                    </td>
                    <td class="py-3 px-6">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                            <?= htmlspecialchars(ucwords(str_replace('_', ' ', $item['menu_type']))) ?>
                        </span>
                    </td>
                    <td class="py-3 px-6">
                        <p class="text-xs text-gray-500 truncate max-w-xs"><?= htmlspecialchars($item['subtitle']) ?></p>
                    </td>
                    <td class="py-3 px-6">
                        <?php if ($item['is_active']): ?>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Active</span>
                        <?php else: ?>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">Hidden</span>
                        <?php endif; ?>
                    </td>
                    <td class="py-3 px-6 text-right whitespace-nowrap text-sm font-medium">
                        <a href="categories.php?edit=<?= $item['id'] ?>" class="text-[#D4AF37] hover:text-[#B3932E] mr-3">Edit</a>
                        <a href="categories.php?toggle=1&id=<?= $item['id'] ?>" class="text-gray-500 hover:text-gray-800">
                            <?= $item['is_active'] ? 'Hide' : 'Show' ?>
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
