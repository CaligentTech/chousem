<?php
require_once __DIR__ . '/includes/header.php';

$message = '';

// Handle toggling active status
if (isset($_GET['toggle']) && isset($_GET['id'])) {
    $stmt = $pdo->prepare("UPDATE reviews SET is_active = NOT is_active WHERE id = ?");
    $stmt->execute([$_GET['id']]);
    header("Location: reviews.php");
    exit;
}

// Handle Form Submission (Add/Edit)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && $_POST['action'] === 'save') {
        $id = $_POST['id'] ?? '';
        $reviewer_name = $_POST['reviewer_name'] ?? '';
        $review_text = $_POST['review_text'] ?? '';
        $star_rating = $_POST['star_rating'] ?? 5;
        $sort_order = $_POST['sort_order'] ?? 0;
        
        try {
            if ($id) {
                $stmt = $pdo->prepare("UPDATE reviews SET reviewer_name=?, review_text=?, star_rating=?, sort_order=? WHERE id=?");
                $stmt->execute([$reviewer_name, $review_text, $star_rating, $sort_order, $id]);
                $message = "Review updated successfully.";
            } else {
                $stmt = $pdo->prepare("INSERT INTO reviews (reviewer_name, review_text, star_rating, sort_order, is_active) VALUES (?, ?, ?, ?, 1)");
                $stmt->execute([$reviewer_name, $review_text, $star_rating, $sort_order]);
                $message = "Review added successfully.";
            }
        } catch (PDOException $e) {
            $message = "Error: " . $e->getMessage();
        }
    }
}

// Fetch reviews
$stmt = $pdo->query("SELECT * FROM reviews ORDER BY sort_order");
$reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);

$edit_item = null;
if (isset($_GET['edit'])) {
    $stmt = $pdo->prepare("SELECT * FROM reviews WHERE id = ?");
    $stmt->execute([$_GET['edit']]);
    $edit_item = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
    <div>
        <h1 class="text-3xl font-bold text-gray-800">Customer Reviews</h1>
        <p class="text-gray-500 mt-2">Manage the testimonials shown on the About page.</p>
    </div>
    <?php if (!isset($_GET['add']) && !isset($_GET['edit'])): ?>
    <a href="reviews.php?add=1" class="bg-[#1C1A18] text-white px-4 py-2 rounded-lg font-medium hover:bg-[#2A2623] transition flex items-center gap-2">
        <i class="ti ti-plus"></i> Add New Review
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
        <h2 class="text-xl font-bold mb-4"><?= $edit_item ? 'Edit Review' : 'Add New Review' ?></h2>
        <form method="POST" action="reviews.php">
            <input type="hidden" name="action" value="save">
            <input type="hidden" name="id" value="<?= $edit_item['id'] ?? '' ?>">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Reviewer Name</label>
                    <input type="text" name="reviewer_name" value="<?= htmlspecialchars($edit_item['reviewer_name'] ?? '') ?>" class="w-full bg-white border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#D4AF37]" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Star Rating (1-5)</label>
                    <input type="number" name="star_rating" min="1" max="5" value="<?= htmlspecialchars($edit_item['star_rating'] ?? '5') ?>" class="w-full bg-white border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#D4AF37]" required>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Review Text</label>
                    <textarea name="review_text" rows="3" class="w-full bg-white border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#D4AF37]" required><?= htmlspecialchars($edit_item['review_text'] ?? '') ?></textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Sort Order (0, 1, 2...)</label>
                    <input type="number" name="sort_order" value="<?= htmlspecialchars($edit_item['sort_order'] ?? '0') ?>" class="w-full bg-white border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#D4AF37]">
                </div>
            </div>
            
            <div class="flex gap-4">
                <button type="submit" class="bg-[#D4AF37] hover:bg-[#B3932E] text-black font-bold px-6 py-2 rounded-lg transition">Save Review</button>
                <a href="reviews.php" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium px-6 py-2 rounded-lg transition">Cancel</a>
            </div>
        </form>
    </div>
<?php endif; ?>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-200">
                    <th class="py-3 px-6 text-xs font-medium text-gray-500 uppercase tracking-wider">Reviewer</th>
                    <th class="py-3 px-6 text-xs font-medium text-gray-500 uppercase tracking-wider">Rating</th>
                    <th class="py-3 px-6 text-xs font-medium text-gray-500 uppercase tracking-wider">Review Text</th>
                    <th class="py-3 px-6 text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="py-3 px-6 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                <?php foreach ($reviews as $item): ?>
                <tr class="hover:bg-gray-50 transition">
                    <td class="py-3 px-6">
                        <p class="font-medium text-gray-800"><?= htmlspecialchars($item['reviewer_name']) ?></p>
                    </td>
                    <td class="py-3 px-6">
                        <div class="flex text-[#D4AF37]">
                            <?php for($i=1; $i<=5; $i++): ?>
                                <i class="ti <?= $i <= $item['star_rating'] ? 'ti-star-filled' : 'ti-star text-gray-300' ?>"></i>
                            <?php endfor; ?>
                        </div>
                    </td>
                    <td class="py-3 px-6">
                        <p class="text-xs text-gray-600 truncate max-w-sm" title="<?= htmlspecialchars($item['review_text']) ?>">
                            "<?= htmlspecialchars($item['review_text']) ?>"
                        </p>
                    </td>
                    <td class="py-3 px-6">
                        <?php if ($item['is_active']): ?>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Active</span>
                        <?php else: ?>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">Hidden</span>
                        <?php endif; ?>
                    </td>
                    <td class="py-3 px-6 text-right whitespace-nowrap text-sm font-medium">
                        <a href="reviews.php?edit=<?= $item['id'] ?>" class="text-[#D4AF37] hover:text-[#B3932E] mr-3">Edit</a>
                        <a href="reviews.php?toggle=1&id=<?= $item['id'] ?>" class="text-gray-500 hover:text-gray-800">
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
