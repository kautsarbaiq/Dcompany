<?php
$id = htmlspecialchars($_GET['id']);
$report = query("SELECT reports.*, users.name as user_name FROM reports
                 JOIN users ON reports.user_id = users.id
                 WHERE reports.id='$id'
                 ");
$report = $report[0];
?>

<div class="flex justify-center py-12 bg-gray-50">
    <div class=" mt-28 max-w-4xl w-full bg-white shadow-xl rounded-lg overflow-hidden">
        <!-- Report Content -->
        <div class="relative">
            <img class="w-full h-80 object-cover" src="<?= "/assets/upload/" . $report['thumbnail'] ?>" alt="Report Thumbnail">
            <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent"></div>
        </div>

        <div class="p-6">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <p class="text-sm text-gray-500"><?= $report['user_name'] ?></p>
                    <p class="text-xs text-gray-400"><?= $report['created_at'] ?></p>
                </div>
                <div class="text-xl font-semibold text-gray-800"><?= $report['title'] ?></div>
            </div>

            <p class="text-gray-600 text-lg"><?= html_entity_decode(strval($report['content'])) ?></p>
        </div>

        <!-- Comments Section -->
        <div class="border-t-2 border-gray-200 mt-12">
            <h1 class="text-3xl font-bold text-center text-gray-900 py-6">Comments</h1>

            <!-- New Comment Section -->
            <div class="px-6 pb-6 border-b-2 border-gray-200">
                <textarea id="editor" class="w-full h-32 border border-gray-300 rounded-lg p-4 resize-none" placeholder="Type your comment here..."></textarea>
                <div class="flex justify-end mt-4">
                    <button type="submit" class="bg-blue-500 px-6 py-2 text-white rounded-lg hover:bg-blue-600">Submit</button>
                </div>
            </div>

            <!-- Existing Comments -->
            <div class="space-y-6">
                <!-- Comment 1 -->
                <div class="px-6 py-4 border-b-2 border-gray-100">
                    <div class="flex items-center justify-between mb-2">
                        <h2 class="text-lg font-semibold text-gray-900">Brad Adams</h2>
                        <small class="text-sm text-gray-600">22h ago</small>
                    </div>
                    <p class="text-gray-700 text-sm">Lorem ipsum, dolor sit amet conse. Saepe optio minus rem dolor sit amet!</p>
                    <div class="flex mt-3 space-x-4 text-gray-600 text-sm">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                            <span>12</span>
                        </div>
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z" />
                            </svg>
                            <span>8</span>
                        </div>
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                            </svg>
                            <span>Share</span>
                        </div>
                    </div>
                </div>
                <!-- Repeat for other comments as necessary -->
            </div>
        </div>
    </div>
</div>
