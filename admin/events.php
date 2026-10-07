<?php
require_once __DIR__ . '/includes/auth.php';

$message = '';

// Handle toggling active status
if (isset($_GET['toggle']) && isset($_GET['id'])) {
    $stmt = $pdo->prepare("UPDATE events SET is_active = NOT is_active WHERE id = ?");
    $stmt->execute([$_GET['id']]);
    header("Location: events.php");
    exit;
}

// Handle Form Submission (Add/Edit)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && $_POST['action'] === 'save') {
        $id = $_POST['id'] ?? '';
        $title = $_POST['title'] ?? '';
        $description = $_POST['description'] ?? '';
        $schedule_text = $_POST['schedule_text'] ?? '';
        $image_path = $_POST['image_path'] ?? '';
        $sort_order = $_POST['sort_order'] ?? 0;
        
        // Handle file upload
        if (isset($_FILES['image_upload']) && $_FILES['image_upload']['error'] === UPLOAD_ERR_OK) {
            $upload_dir = __DIR__ . '/../gallery/events/';
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0755, true);
            }
            $filename = time() . '_' . preg_replace("/[^a-zA-Z0-9.\-_]/", "", basename($_FILES['image_upload']['name']));
            $target_file = $upload_dir . $filename;
            
            if (move_uploaded_file($_FILES['image_upload']['tmp_name'], $target_file)) {
                $image_path = 'gallery/events/' . $filename;
            }
        }
        
        try {
            if ($id) {
                $stmt = $pdo->prepare("UPDATE events SET title=?, description=?, schedule_text=?, image_path=?, sort_order=? WHERE id=?");
                $stmt->execute([$title, $description, $schedule_text, $image_path, $sort_order, $id]);
                $message = "Event updated successfully.";
            } else {
                $stmt = $pdo->prepare("INSERT INTO events (title, description, schedule_text, image_path, sort_order, is_active) VALUES (?, ?, ?, ?, ?, 1)");
                $stmt->execute([$title, $description, $schedule_text, $image_path, $sort_order]);
                $message = "Event added successfully.";
            }
        } catch (PDOException $e) {
            $message = "Error: " . $e->getMessage();
        }
    }
}

// Fetch events
$stmt = $pdo->query("SELECT * FROM events ORDER BY sort_order");
$events = $stmt->fetchAll(PDO::FETCH_ASSOC);

$edit_item = null;
if (isset($_GET['edit'])) {
    $stmt = $pdo->prepare("SELECT * FROM events WHERE id = ?");
    $stmt->execute([$_GET['edit']]);
    $edit_item = $stmt->fetch(PDO::FETCH_ASSOC);
}

require_once __DIR__ . '/includes/header.php';
?>

<div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
    <div>
        <h1 class="text-3xl font-bold text-gray-800">Weekly Events</h1>
        <p class="text-gray-500 mt-2">Manage the events shown on the Experience page.</p>
    </div>
    <?php if (!isset($_GET['add']) && !isset($_GET['edit'])): ?>
    <a href="events.php?add=1" class="bg-[#1C1A18] text-white px-4 py-2 rounded-lg font-medium hover:bg-[#2A2623] transition flex items-center gap-2">
        <i class="ti ti-plus"></i> Add New Event
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
        <h2 class="text-xl font-bold mb-4"><?= $edit_item ? 'Edit Event' : 'Add New Event' ?></h2>
        <form method="POST" action="events.php" enctype="multipart/form-data">
            <input type="hidden" name="action" value="save">
            <input type="hidden" name="id" value="<?= $edit_item['id'] ?? '' ?>">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Event Title</label>
                    <input type="text" name="title" value="<?= htmlspecialchars($edit_item['title'] ?? ($edit_item['name'] ?? '')) ?>" class="w-full bg-white border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#D4AF37]" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Schedule Text (e.g. Every Friday)</label>
                    <input type="text" name="schedule_text" value="<?= htmlspecialchars($edit_item['schedule_text'] ?? '') ?>" class="w-full bg-white border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#D4AF37]">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Image Path</label>
                    <input type="text" name="image_path" value="<?= htmlspecialchars($edit_item['image_path'] ?? '') ?>" class="w-full bg-white border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#D4AF37]">
                    <p class="text-xs text-gray-500 mt-1">Leave as is, or upload a file below.</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Upload New Image (Optional)</label>
                    <input type="file" name="image_upload" accept="image/*" class="w-full bg-white border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#D4AF37]">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <textarea name="description" rows="3" class="w-full bg-white border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#D4AF37]"><?= htmlspecialchars($edit_item['description'] ?? '') ?></textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Sort Order (0, 1, 2...)</label>
                    <input type="number" name="sort_order" value="<?= htmlspecialchars($edit_item['sort_order'] ?? '0') ?>" class="w-full bg-white border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#D4AF37]">
                </div>
            </div>
            
            <div class="flex gap-4">
                <button type="submit" class="bg-[#D4AF37] hover:bg-[#B3932E] text-black font-bold px-6 py-2 rounded-lg transition">Save Event</button>
                <a href="events.php" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium px-6 py-2 rounded-lg transition">Cancel</a>
            </div>
        </form>
    </div>
<?php endif; ?>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-200">
                    <th class="py-3 px-6 text-xs font-medium text-gray-500 uppercase tracking-wider">Image</th>
                    <th class="py-3 px-6 text-xs font-medium text-gray-500 uppercase tracking-wider">Title & Info</th>
                    <th class="py-3 px-6 text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="py-3 px-6 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                <?php foreach ($events as $item): ?>
                <tr class="hover:bg-gray-50 transition">
                    <td class="py-3 px-6">
                        <div class="w-16 h-16 bg-gray-200 rounded overflow-hidden">
                            <img src="../<?= htmlspecialchars($item['image_path']) ?>" alt="Preview" class="w-full h-full object-cover" onerror="this.src='https://via.placeholder.com/64?text=Img'">
                        </div>
                    </td>
                    <td class="py-3 px-6">
                        <p class="font-medium text-gray-800"><?= htmlspecialchars($item['title'] ?? ($item['name'] ?? '')) ?></p>
                        <p class="text-xs text-[#D4AF37] font-semibold mt-1"><?= htmlspecialchars($item['schedule_text']) ?></p>
                        <?php if ($item['description']): ?>
                            <p class="text-xs text-gray-500 truncate max-w-xs mt-1"><?= htmlspecialchars($item['description']) ?></p>
                        <?php endif; ?>
                    </td>
                    <td class="py-3 px-6">
                        <?php if ($item['is_active']): ?>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Active</span>
                        <?php else: ?>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">Hidden</span>
                        <?php endif; ?>
                    </td>
                    <td class="py-3 px-6 text-right whitespace-nowrap text-sm font-medium">
                        <a href="events.php?edit=<?= $item['id'] ?>" class="text-[#D4AF37] hover:text-[#B3932E] mr-3">Edit</a>
                        <a href="events.php?toggle=1&id=<?= $item['id'] ?>" class="text-gray-500 hover:text-gray-800">
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
