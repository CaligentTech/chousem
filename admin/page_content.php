<?php
require_once __DIR__ . '/includes/header.php';

$message = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['content']) && is_array($_POST['content'])) {
        try {
            $pdo->beginTransaction();
            $stmt = $pdo->prepare("UPDATE page_content SET content_value = ? WHERE id = ?");
            
            foreach ($_POST['content'] as $id => $value) {
                // Check if a file was uploaded for this field
                if (isset($_FILES['image_upload']['error'][$id]) && $_FILES['image_upload']['error'][$id] === UPLOAD_ERR_OK) {
                    $upload_dir = __DIR__ . '/../gallery/';
                    if (!is_dir($upload_dir)) {
                        mkdir($upload_dir, 0755, true);
                    }
                    $filename = time() . '_' . preg_replace("/[^a-zA-Z0-9.\-_]/", "", basename($_FILES['image_upload']['name'][$id]));
                    $target_file = $upload_dir . $filename;
                    
                    if (move_uploaded_file($_FILES['image_upload']['tmp_name'][$id], $target_file)) {
                        $value = 'gallery/' . $filename;
                    }
                }
                $stmt->execute([$value, $id]);
            }
            
            $pdo->commit();
            $message = "Page content updated successfully!";
        } catch (PDOException $e) {
            $pdo->rollBack();
            $message = "Error updating content: " . $e->getMessage();
        }
    }
}

// Fetch all page content grouped by page and section
$stmt = $pdo->query("SELECT * FROM page_content ORDER BY page, section, content_key");
$all_content = $stmt->fetchAll(PDO::FETCH_ASSOC);

$grouped_content = [];
foreach ($all_content as $row) {
    $grouped_content[$row['page']][$row['section']][] = $row;
}
?>

<div class="mb-8 flex items-center justify-between">
    <div>
        <h1 class="text-3xl font-bold text-gray-800">Page Content</h1>
        <p class="text-gray-500 mt-2">Manage text sections across different pages.</p>
    </div>
</div>

<?php if ($message): ?>
    <div class="mb-6 p-4 rounded-lg <?= strpos($message, 'Error') === false ? 'bg-green-100 text-green-700 border border-green-200' : 'bg-red-100 text-red-700 border border-red-200' ?>">
        <?= htmlspecialchars($message) ?>
    </div>
<?php endif; ?>

<form method="POST" action="" enctype="multipart/form-data">
    <div class="space-y-8">
        <?php foreach ($grouped_content as $page => $sections): ?>
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 bg-[#1C1A18] text-white">
                    <h2 class="text-xl font-bold uppercase tracking-wider">Page: <?= htmlspecialchars($page) ?></h2>
                </div>
                
                <div class="p-6 md:p-8 space-y-8">
                    <?php foreach ($sections as $section => $items): ?>
                        <div class="border-b border-gray-100 pb-8 last:border-0 last:pb-0">
                            <h3 class="text-lg font-semibold text-[#D4AF37] mb-4 border-l-4 border-[#D4AF37] pl-3">Section: <?= htmlspecialchars($section) ?></h3>
                            
                            <div class="space-y-4 pl-4">
                                <?php foreach ($items as $item): ?>
                                    <div class="flex flex-col md:flex-row md:items-start gap-2 md:gap-6">
                                        <div class="md:w-1/3 pt-2">
                                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                                <?= ucwords(str_replace('_', ' ', $item['content_key'])) ?>
                                            </label>
                                            <p class="text-xs text-gray-400 font-mono"><?= htmlspecialchars($item['content_key']) ?></p>
                                        </div>
                                        <div class="md:w-2/3">
                                            <?php 
                                            $is_image = false;
                                            $lower_key = strtolower($item['content_key']);
                                            if (strpos($lower_key, 'image') !== false || strpos($lower_key, 'img') !== false || strpos($lower_key, 'banner') !== false || strpos($lower_key, 'bg') !== false || strpos($lower_key, 'background') !== false || strpos($lower_key, 'photo') !== false) {
                                                $is_image = true;
                                            }
                                            
                                            if ($is_image): ?>
                                                <div class="space-y-2">
                                                    <input type="text" name="content[<?= $item['id'] ?>]" value="<?= htmlspecialchars($item['content_value']) ?>" class="w-full bg-white border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#D4AF37] focus:border-transparent">
                                                    <div class="mt-2">
                                                        <label class="block text-xs font-medium text-gray-500 mb-1">Upload to replace image (optional)</label>
                                                        <input type="file" name="image_upload[<?= $item['id'] ?>]" accept="image/*,.pdf" class="w-full bg-gray-50 border border-gray-200 rounded-lg px-3 py-1 text-sm focus:outline-none focus:ring-2 focus:ring-[#D4AF37]">
                                                    </div>
                                                </div>
                                            <?php elseif (strlen($item['content_value']) > 80 || strpos($item['content_value'], "\n") !== false): ?>
                                                <textarea name="content[<?= $item['id'] ?>]" rows="4" class="w-full bg-white border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#D4AF37] focus:border-transparent"><?= htmlspecialchars($item['content_value']) ?></textarea>
                                            <?php else: ?>
                                                <input type="text" name="content[<?= $item['id'] ?>]" value="<?= htmlspecialchars($item['content_value']) ?>" class="w-full bg-white border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#D4AF37] focus:border-transparent">
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="fixed bottom-0 left-0 right-0 md:left-64 p-4 pb-8 md:pb-4 bg-white border-t border-gray-200 shadow-lg flex justify-end z-20">
        <button type="submit" class="bg-[#D4AF37] hover:bg-[#B3932E] text-black font-bold px-8 py-3 rounded-lg shadow-md transition flex items-center gap-2">
            <i class="ti ti-device-floppy"></i> Save All Changes
        </button>
    </div>
    
    <!-- Spacing for fixed footer -->
    <div class="h-20"></div>
</form>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
