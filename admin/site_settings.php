<?php
require_once __DIR__ . '/includes/auth.php';

$message = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['settings']) && is_array($_POST['settings'])) {
        try {
            $pdo->beginTransaction();
            $stmt = $pdo->prepare("UPDATE site_settings SET setting_value = ? WHERE setting_key = ?");
            
            foreach ($_POST['settings'] as $key => $value) {
                // Check if a file was uploaded for this setting
                if (isset($_FILES['setting_upload']['error'][$key]) && $_FILES['setting_upload']['error'][$key] === UPLOAD_ERR_OK) {
                    $upload_dir = __DIR__ . '/../assets/files/'; // generic directory for settings files
                    if (!is_dir($upload_dir)) {
                        mkdir($upload_dir, 0755, true);
                    }
                    $filename = time() . '_' . preg_replace("/[^a-zA-Z0-9.\-_]/", "", basename($_FILES['setting_upload']['name'][$key]));
                    $target_file = $upload_dir . $filename;
                    
                    if (move_uploaded_file($_FILES['setting_upload']['tmp_name'][$key], $target_file)) {
                        $value = 'assets/files/' . $filename;
                    }
                }
                $stmt->execute([$value, $key]);
            }
            
            $pdo->commit();
            $message = "Settings updated successfully!";
        } catch (PDOException $e) {
            $pdo->rollBack();
            $message = "Error updating settings: " . $e->getMessage();
        }
    }
}

// Fetch all settings
$stmt = $pdo->query("SELECT * FROM site_settings ORDER BY setting_key");
$settings = $stmt->fetchAll(PDO::FETCH_ASSOC);

require_once __DIR__ . '/includes/header.php';
?>

<div class="mb-8 flex items-center justify-between">
    <div>
        <h1 class="text-3xl font-bold text-gray-800">Site Settings</h1>
        <p class="text-gray-500 mt-2">Manage global information like contact details and social links.</p>
    </div>
</div>

<?php if ($message): ?>
    <div class="mb-6 p-4 rounded-lg <?= strpos($message, 'Error') === false ? 'bg-green-100 text-green-700 border border-green-200' : 'bg-red-100 text-red-700 border border-red-200' ?>">
        <?= htmlspecialchars($message) ?>
    </div>
<?php endif; ?>

<div class="bg-white rounded-xl shadow-sm border border-gray-100">
    <form method="POST" action="" enctype="multipart/form-data">
        <div class="p-6 md:p-8 space-y-6">
            <?php foreach ($settings as $setting): ?>
                <div class="flex flex-col md:flex-row md:items-center gap-2 md:gap-6 border-b border-gray-50 pb-6 last:border-0 last:pb-0">
                    <div class="md:w-1/3">
                        <label class="block text-sm font-semibold text-gray-700 mb-1">
                            <?= ucwords(str_replace('_', ' ', $setting['setting_key'])) ?>
                        </label>
                        <p class="text-xs text-gray-500 font-mono"><?= htmlspecialchars($setting['setting_key']) ?></p>
                    </div>
                    <div class="md:w-2/3">
                        <?php 
                        $is_file = false;
                        $lower_key = strtolower($setting['setting_key']);
                        if (strpos($lower_key, 'pdf') !== false || strpos($lower_key, 'file') !== false || strpos($lower_key, 'menu_link') !== false || strpos($lower_key, 'logo') !== false || strpos($lower_key, 'image') !== false || strpos($lower_key, 'icon') !== false) {
                            $is_file = true;
                        }
                        
                        if ($is_file): ?>
                            <div class="space-y-2">
                                <input type="text" name="settings[<?= htmlspecialchars($setting['setting_key']) ?>]" value="<?= htmlspecialchars($setting['setting_value']) ?>" class="w-full bg-white border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#D4AF37] focus:border-transparent">
                                <div class="mt-2">
                                    <label class="block text-xs font-medium text-gray-500 mb-1">Upload to replace file (optional)</label>
                                    <input type="file" name="setting_upload[<?= htmlspecialchars($setting['setting_key']) ?>]" accept=".pdf,image/*" class="w-full bg-gray-50 border border-gray-200 rounded-lg px-3 py-1 text-sm focus:outline-none focus:ring-2 focus:ring-[#D4AF37]">
                                </div>
                            </div>
                        <?php elseif (strlen($setting['setting_value']) > 100): ?>
                            <textarea name="settings[<?= htmlspecialchars($setting['setting_key']) ?>]" rows="3" class="w-full bg-white border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#D4AF37] focus:border-transparent"><?= htmlspecialchars($setting['setting_value']) ?></textarea>
                        <?php else: ?>
                            <input type="text" name="settings[<?= htmlspecialchars($setting['setting_key']) ?>]" value="<?= htmlspecialchars($setting['setting_value']) ?>" class="w-full bg-white border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#D4AF37] focus:border-transparent">
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 rounded-b-xl flex justify-end">
            <button type="submit" class="bg-[#1C1A18] hover:bg-[#2A2623] text-white px-6 py-2 rounded-lg font-medium transition flex items-center gap-2">
                <i class="ti ti-device-floppy"></i> Save Settings
            </button>
        </div>
    </form>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
