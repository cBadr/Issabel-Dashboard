<!DOCTYPE html>
<html lang="<?php echo $_SESSION['lang'] ?? 'ar'; ?>" dir="<?php echo ($_SESSION['lang'] ?? 'ar') == 'ar' ? 'rtl' : 'ltr'; ?>">
<head>
    <meta charset="UTF-8">
    <title><?php echo $lang['template_settings']; ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background-color: #f3f4f6; }
    </style>
</head>
<body class="p-8">
    <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-lg p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800"><?php echo $lang['template_settings']; ?></h1>
            <a href="index.php" class="text-blue-500 hover:underline"><i class="fas fa-arrow-left"></i> <?php echo $lang['dashboard']; ?></a>
        </div>

        <!-- Upload Section -->
        <div class="mb-8 p-4 border-2 border-dashed border-gray-300 rounded-lg text-center">
            <h2 class="text-lg font-semibold mb-2"><?php echo $lang['upload_template']; ?></h2>
            <form action="index.php?url=template/upload" method="POST" enctype="multipart/form-data">
                <input type="file" name="template_zip" accept=".zip" required class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 mb-4">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">
                    <i class="fas fa-cloud-upload-alt"></i> Upload
                </button>
            </form>
        </div>

        <!-- Templates List -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <?php foreach ($templates as $tpl): ?>
            <div class="border rounded-lg p-4 relative <?php echo $tpl['active'] ? 'ring-2 ring-blue-500 bg-blue-50' : 'bg-gray-50'; ?>">
                <div class="flex justify-between items-start mb-2">
                    <h3 class="font-bold text-lg capitalize"><?php echo $tpl['name']; ?></h3>
                    <?php if ($tpl['active']): ?>
                        <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded">Active</span>
                    <?php endif; ?>
                </div>
                
                <div class="flex gap-2 mt-4">
                    <?php if (!$tpl['active']): ?>
                        <a href="index.php?url=template/activate/<?php echo $tpl['name']; ?>" class="flex-1 bg-green-500 text-white text-center py-1 rounded text-sm hover:bg-green-600">Activate</a>
                    <?php endif; ?>
                    
                    <?php if ($tpl['name'] != 'default'): ?>
                        <a href="index.php?url=template/delete/<?php echo $tpl['name']; ?>" class="flex-1 bg-red-500 text-white text-center py-1 rounded text-sm hover:bg-red-600" onclick="return confirm('Are you sure?')">Delete</a>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
