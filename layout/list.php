<?php
include_once($_SERVER['DOCUMENT_ROOT'] . "/utils/functions.php");
$user_id = $_SESSION['user_id'];
$role_name = $_SESSION['role_name'];
if ($role_name !== 'masyarakat') {
    $reports = query("SELECT reports.*, users.name FROM reports JOIN users ON users.id = reports.user_id");
} else {
    $reports = query(
        "SELECT reports.*, users.name FROM reports JOIN users ON users.id = reports.user_id"
    );
}

// var_dump($reports); die();

?>
<div class="col-span-12 mt-5">
    <div class="grid gap-2 grid-cols-1 lg:grid-cols-1">
        <div class="bg-white p-4 shadow-lg rounded-lg">
            <h1 class="font-bold text-base">Report list</h1>
            <div class="mt-4">
                <div class="flex flex-col">
                    <div class="-my-2 overflow-x-auto">
                        <div class="py-2 align-middle inline-block min-w-full">
                            <div
                                class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg bg-white">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead>
                                        <tr>
                                            <th
                                                class="px-6 py-3 bg-gray-50 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                                <div class="flex cursor-pointer">
                                                    <span class="mr-2">No</span>
                                                </div>
                                            </th>
                                            <th
                                                class="px-6 py-3 bg-gray-50 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                                <div class="flex cursor-pointer">
                                                    <span class="mr-2">Sender</span>
                                                </div>
                                            </th>
                                            <th
                                                class="px-6 py-3 bg-gray-50 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                                <div class="flex cursor-pointer">
                                                    <span class="mr-2">Title</span>
                                                </div>
                                            </th>
                                            <th
                                                class="px-6 py-3 bg-gray-50 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                                <div class="flex cursor-pointer">
                                                    <span class="mr-2">Created at</span>
                                                </div>
                                            </th>
                                            <th
                                                class="px-6 py-3 bg-gray-50 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                                <div class="flex cursor-pointer">
                                                    <span class="mr-2">Status</span>
                                                </div>
                                            </th>
                                            <th
                                                class="px-6 py-3 bg-gray-50 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                                <div class="flex cursor-pointer">
                                                    <span class="mr-2">Action</span>
                                                </div>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        <?php if (empty($reports)) : ?>
                                            <tr>
                                                <td colspan="6" class="bg-blue-400 px-6 py-4 text-center text-white">
                                                    Tidak ada laporan
                                                </td>
                                            </tr>
                                        <?php else :
                                            $no = 1;
                                        ?>
                                            <?php foreach ($reports as $report): ?>
                                                <tr>
                                                    <td
                                                        class="px-6 py-4 whitespace-no-wrap text-sm leading-5">
                                                        <p> <?= $no++ ?></p>
                                                    </td>
                                                    <td
                                                        class="px-6 py-4 whitespace-no-wrap text-sm leading-5">
                                                        <p><?= $report['name'] ?></p>
                                                    </td>
                                                    <td
                                                        class="px-6 py-4 whitespace-no-wrap text-sm leading-5">
                                                        <p><?= $report['title'] ?></p>
                                                    </td>
                                                    <td
                                                        class="px-6 py-4 whitespace-no-wrap text-sm leading-5">
                                                        <p><?= $report['created_at'] ?></p>
                                                    </td>
                                                    <td
                                                        class="px-6 py-4 whitespace-no-wrap text-sm leading-5">
                                                        <p><?= $report['status'] == 0 ? "Not Solved" : "Solved" ?></p>
                                                    </td>
                                                    <td
                                                        class="px-6 py-4 whitespace-no-wrap text-sm leading-5">
                                                        <div class="flex space-x-4">
                                                            <a href="#" class="text-blue-500 hover:text-blue-600">
                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                    class="w-5 h-5 mr-1"
                                                                    fill="none" viewBox="0 0 24 24"
                                                                    stroke="currentColor">
                                                                    <path stroke-linecap="round"
                                                                        stroke-linejoin="round"
                                                                        stroke-width="2"
                                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                                </svg>
                                                                <p>Edit</p>
                                                            </a>
                                                            <a href="#" class="text-red-500 hover:text-red-600">
                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                    class="w-5 h-5 mr-1 ml-3"
                                                                    fill="none" viewBox="0 0 24 24"
                                                                    stroke="currentColor">
                                                                    <path stroke-linecap="round"
                                                                        stroke-linejoin="round"
                                                                        stroke-width="2"
                                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                                </svg>
                                                                <p>Delete</p>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach ?>
                                        <?php endif ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>