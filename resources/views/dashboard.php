<!DOCTYPE html>
<html lang="<?php echo $langCode; ?>" dir="<?php echo $langCode == 'ar' ? 'rtl' : 'ltr'; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $lang['app_name']; ?></title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom Styles -->
    <style>
        /* خلفية ديناميكية (Dynamic Background) */
        body {
            background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab);
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
            height: 100vh;
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        @keyframes gradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .glass-panel {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        }

        .card-hover:hover {
            transform: translateY(-5px);
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.3);
        }
    </style>
    <!-- Template Specific Styles -->
    <?php if (file_exists(ROOT_PATH . "/public/templates/$currentTemplate/style.css")): ?>
        <link rel="stylesheet" href="templates/<?php echo $currentTemplate; ?>/style.css">
    <?php endif; ?>
</head>
<body class="text-white">

    <!-- Navbar -->
    <nav class="glass-panel m-4 p-4 flex justify-between items-center">
        <div class="flex items-center gap-4">
            <i class="fas fa-headset text-3xl"></i>
            <h1 class="text-2xl font-bold"><?php echo $lang['app_name']; ?></h1>
        </div>
        <div class="flex gap-4 items-center">
            <a href="?lang=<?php echo $langCode == 'ar' ? 'en' : 'ar'; ?>" class="bg-white/20 px-4 py-2 rounded hover:bg-white/40 transition">
                <i class="fas fa-language"></i> <?php echo $lang['switch_lang']; ?>
            </a>
            <div class="flex items-center gap-2">
                <img src="https://ui-avatars.com/api/?name=Admin&background=random" class="w-10 h-10 rounded-full border-2 border-white">
                <span>Admin</span>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mx-auto p-4 grid grid-cols-1 md:grid-cols-4 gap-6">
        
        <!-- Sidebar -->
        <aside class="glass-panel p-6 col-span-1 h-fit">
            <ul class="space-y-4">
                <li>
                    <a href="#" class="block p-3 rounded bg-white/10 hover:bg-white/30 transition flex items-center gap-3">
                        <i class="fas fa-tachometer-alt"></i> <?php echo $lang['dashboard']; ?>
                    </a>
                </li>
                <li>
                    <a href="#" class="block p-3 rounded hover:bg-white/20 transition flex items-center gap-3">
                        <i class="fas fa-phone"></i> <?php echo $lang['extensions']; ?>
                    </a>
                </li>
                <li>
                    <a href="#" class="block p-3 rounded hover:bg-white/20 transition flex items-center gap-3">
                        <i class="fas fa-users"></i> <?php echo $lang['queues']; ?>
                    </a>
                </li>
                <li>
                    <a href="#" class="block p-3 rounded hover:bg-white/20 transition flex items-center gap-3">
                        <i class="fas fa-chart-bar"></i> <?php echo $lang['reports']; ?>
                    </a>
                </li>
                <li>
                    <a href="#" class="block p-3 rounded hover:bg-white/20 transition flex items-center gap-3">
                        <i class="fas fa-cogs"></i> <?php echo $lang['settings']; ?>
                    </a>
                </li>
            </ul>

            <!-- Template Manager Mini -->
            <div class="mt-8 border-t border-white/20 pt-4">
                <div class="flex justify-between items-center mb-2">
                    <h3 class="font-bold"><?php echo $lang['template_settings']; ?></h3>
                    <a href="index.php?url=template/index" class="text-xs bg-white/20 px-2 py-1 rounded hover:bg-white/40"><i class="fas fa-cog"></i> Manage</a>
                </div>
                <form method="POST" action="index.php">
                    <select name="template" class="w-full p-2 rounded bg-white/20 border-none text-white focus:ring-2 focus:ring-white">
                        <option value="default" <?php echo $currentTemplate == 'default' ? 'selected' : ''; ?>>Default</option>
                        <option value="dark" <?php echo $currentTemplate == 'dark' ? 'selected' : ''; ?>>Dark Mode</option>
                        <option value="light" <?php echo $currentTemplate == 'light' ? 'selected' : ''; ?>>Light Mode</option>
                    </select>
                    <button type="submit" name="change_template" class="mt-2 w-full bg-blue-500/50 hover:bg-blue-600/50 py-1 rounded transition">
                        Apply
                    </button>
                </form>
            </div>
        </aside>

        <!-- Dashboard Stats -->
        <main class="col-span-1 md:col-span-3 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- Stat Card 1 -->
            <div class="glass-panel p-6 card-hover flex flex-col items-center justify-center">
                <i class="fas fa-phone-volume text-4xl mb-2 text-green-300"></i>
                <h3 class="text-xl font-bold"><?php echo $stats['active_calls']; ?></h3>
                <p class="text-sm opacity-80">Active Calls</p>
            </div>
            <!-- Stat Card 2 -->
            <div class="glass-panel p-6 card-hover flex flex-col items-center justify-center">
                <i class="fas fa-user-clock text-4xl mb-2 text-yellow-300"></i>
                <h3 class="text-xl font-bold"><?php echo $stats['waiting_calls']; ?></h3>
                <p class="text-sm opacity-80">Waiting Calls</p>
            </div>
            <!-- Stat Card 3 -->
            <div class="glass-panel p-6 card-hover flex flex-col items-center justify-center">
                <i class="fas fa-headset text-4xl mb-2 text-blue-300"></i>
                <h3 class="text-xl font-bold"><?php echo $stats['agents_online']; ?></h3>
                <p class="text-sm opacity-80">Agents Online</p>
            </div>
            <!-- Stat Card 4 -->
            <div class="glass-panel p-6 card-hover flex flex-col items-center justify-center">
                <i class="fas fa-history text-4xl mb-2 text-purple-300"></i>
                <h3 class="text-xl font-bold"><?php echo $stats['total_calls_today']; ?></h3>
                <p class="text-sm opacity-80">Total Calls Today</p>
            </div>

            <!-- Recent Activity / Chart Area -->
            <div class="glass-panel col-span-1 md:col-span-2 lg:col-span-4 p-6 mt-4">
                <h3 class="text-xl font-bold mb-4">Live Call Center Activity</h3>
                <div class="h-64 bg-white/10 rounded flex items-center justify-center">
                    <p class="opacity-50">Interactive Chart Placeholder (Chart.js or ApexCharts)</p>
                </div>
            </div>
        </main>
    </div>

    <!-- Footer -->
    <footer class="text-center p-6 mt-8 text-white/60 text-sm glass-panel mx-4 mb-4">
        <p><?php echo $lang['copyright']; ?></p>
        <div class="flex justify-center gap-4 mt-2">
            <a href="https://facebook.com/waseleg" target="_blank" class="hover:text-white"><i class="fab fa-facebook"></i> waseleg</a>
            <a href="https://t.me/waseleg" target="_blank" class="hover:text-white"><i class="fab fa-telegram"></i> waseleg</a>
            <span><i class="fas fa-phone"></i> 01016966066</span>
        </div>
    </footer>

</body>
</html>
