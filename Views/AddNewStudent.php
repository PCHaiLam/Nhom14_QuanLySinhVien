<?php 
session_start();
require_once __DIR__ . '/../config/db.php';
?>
<?php include_once __DIR__ . "/../layout/header.php"; ?>
<body>
    <div class="m-4 w-full mx-2 min-h-[520px] ">
    <button onclick="window.history.back()" class="px-3 py-2 bg-gray-400">Quay lại</button>
    <h1>add new page</h1>
    </div>
</body>
<?php include_once __DIR__ . "/../layout/footer.php"; ?>
