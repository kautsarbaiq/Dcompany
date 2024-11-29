<?php
include_once($_SERVER['DOCUMENT_ROOT'] . "/utils/functions.php");
$reports = query("SELECT reports.*, users.name as user_name FROM reports 
                    JOIN users ON reports.user_id = users.id ORDER BY created_at ASC");
header('refresh:3;Content-Type: text/html; charset=UTF-8');
?>

<div class="flex justify-center">
    <div class=" mt-28  max-w-6xl w-full grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Main Content Cards -->
        <?php if (empty($reports)) : ?>
            <h1 class="font-bold text-3xl text-black text-center">Data kosong</h1>
        <?php else : ?>
            <?php foreach ($reports as $report) : 
                $report['content'] = html_entity_decode(html_entity_decode(strval($report['content'])));
            ?>
                <div class="border border-gray-300 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 h-fit mb-4 bg-white dark:bg-gray-800">
                    <a href="index.php?page=detail&id=<?= $report['id'] ?>" class="block h-full">
                        <div class="h-full flex flex-col">
                            <?php if ($report['thumbnail']): ?>
                                <img class="rounded-t-lg w-full h-48 object-cover" alt="<?= $report['thumbnail'] ?>" src="<?= "../assets/upload/" . $report['thumbnail'] ?>" />
                            <?php endif; ?>
                            <div class="p-5 flex-grow flex flex-col">
                                <div class="flex items-center mb-2">
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-800 dark:text-gray-200 truncate"><?= $report['user_name'] ?></p>
                                        <p class="text-xs text-gray-500 truncate dark:text-gray-400"><?= $report['created_at'] ?></p>
                                    </div>
                                </div>
                                <h5 class="mb-2 text-xl font-bold text-gray-700 dark:text-white"><?= $report['title'] ?></h5>
                                <p class="text-gray-700 dark:text-gray-300 line-clamp-3"><?= $report['content'] ?></p>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>
