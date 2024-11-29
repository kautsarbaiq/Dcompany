<?php
include_once($_SERVER['DOCUMENT_ROOT'] . "/utils/functions.php");

$users = query("SELECT users.id, users.username, users.nik, users.name, users.phone_number, users.role_id, roles.name as role_name
    FROM users 
    JOIN roles ON users.role_id = roles.id");

$roles = query("SELECT * FROM roles");

?>

<div class="flex justify-center items-center min-h-screen">
    <div class="w-full max-w-4xl">
        <div class="pb-4 flex justify-end">
            <!-- Modal toggle -->
            <button data-modal-target="crud-modal" data-modal-toggle="crud-modal" class="block text-white bg-gray-700 hover:bg-gray-600 focus:ring-4 focus:outline-none focus:ring-gray-500 font-medium rounded-lg text-sm px-5 py-2.5 text-center" type="button">
                Add user
            </button>

            <!-- Main modal -->
            <div id="crud-modal" tabindex="-1" aria-hidden="true" class="hidden fixed top-0 right-0 left-0 z-50 flex justify-center items-center w-full h-full bg-gray-900 bg-opacity-75">
                <div class="relative w-full max-w-2xl">
                    <!-- Modal content -->
                    <div class="bg-gray-800 text-gray-200 rounded-lg shadow-lg p-6">
                        <!-- Modal header -->
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold">
                                User Data
                            </h3>
                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-700 hover:text-white rounded-lg text-sm w-8 h-8 flex justify-center items-center" data-modal-toggle="crud-modal">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <form method="post">
                            <div class="grid gap-4 mb-4 grid-cols-2">
                                <div>
                                    <label for="nik" class="block mb-2 text-sm font-medium text-gray-400">NIK</label>
                                    <input type="text" name="nik" class="bg-gray-700 border border-gray-600 text-gray-300 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5" placeholder="1294012094712">
                                </div>
                                <div>
                                    <label for="username" class="block mb-2 text-sm font-medium text-gray-400">Username</label>
                                    <input type="text" name="username" class="bg-gray-700 border border-gray-600 text-gray-300 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5" placeholder="johndoe">
                                </div>
                                <div>
                                    <label for="name" class="block mb-2 text-sm font-medium text-gray-400">Name</label>
                                    <input type="text" name="name" class="bg-gray-700 border border-gray-600 text-gray-300 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5" placeholder="John Doe">
                                </div>
                                <div>
                                    <label for="phone_number" class="block mb-2 text-sm font-medium text-gray-400">Phone</label>
                                    <input type="text" name="phone_number" class="bg-gray-700 border border-gray-600 text-gray-300 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5" placeholder="628124123">
                                </div>
                                <div>
                                    <label for="role_id" class="block mb-2 text-sm font-medium text-gray-400">Role</label>
                                    <select name="role_id" class="bg-gray-700 border border-gray-600 text-gray-300 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5">
                                        <option selected disabled>Select Role</option>
                                        <?php foreach ($roles as $role) : ?>
                                            <option value="<?= $role['id'] ?>">
                                                <?= ucwords($role['name']) ?>
                                            </option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                                <div>
                                    <label for="password" class="block mb-2 text-sm font-medium text-gray-400">Password</label>
                                    <input minlength="1" type="password" name="password" class="bg-gray-700 border border-gray-600 text-gray-300 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5" placeholder="**************">
                                </div>
                                <div>
                                    <label for="password_confirm" class="block mb-2 text-sm font-medium text-gray-400">Password Confirmation</label>
                                    <input minlength="1" type="password" name="password_confirm" class="bg-gray-700 border border-gray-600 text-gray-300 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5" placeholder="**************">
                                </div>
                            </div>
                            <div class="flex justify-end">
                                <button name="submit" type="submit" class="text-white bg-gray-700 hover:bg-gray-600 focus:ring-4 focus:outline-none focus:ring-gray-500 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                    Submit
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Table -->
        <table class="w-full text-sm text-left text-gray-300 bg-gray-800 rounded-lg">
            <thead class="text-xs text-white uppercase bg-gray-900">
                <tr>
                    <th scope="col" class="px-6 py-3">No.</th>
                    <th scope="col" class="px-6 py-3">NIK</th>
                    <th scope="col" class="px-6 py-3">Name</th>
                    <th scope="col" class="px-6 py-3">Phone Number</th>
                    <th scope="col" class="px-6 py-3">Role</th>
                    <th scope="col" class="px-6 py-3">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($users)) : ?>
                    <tr>
                        <td colspan="6" class="bg-gray-700 px-6 py-4 text-center text-white">No Data Available</td>
                    </tr>
                <?php else :
                    $no = 1;
                ?>
                    <?php foreach ($users as $user) : ?>
                        <tr class="bg-gray-800 border-b hover:bg-gray-700 text-gray-200">
                            <td class="px-6 py-4 font-bold"><?= $no++ ?></td>
                            <td class="px-6 py-4"><?= $user['nik'] ?></td>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-200"><?= $user['name'] ?></th>
                            <td class="px-6 py-4"><?= $user['phone_number'] ?></td>
                            <td class="px-6 py-4"><?= $user['role_name'] ?></td>
                            <td class="px-6 py-4 flex space-x-2">
                                <a data-modal-target="edit-modal-<?= $user['id'] ?>" data-modal-toggle="edit-modal-<?= $user['id'] ?>" href="#" class="font-medium text-white hover:underline">Edit</a>
                                <div id="edit-modal-<?= $user['id'] ?>" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative p-4 w-full max-w-2xl max-h-full">
                                        <!-- Modal content -->
                                        <div class="relative bg-white rounded-lg shadow-lg transition-shadow duration-300 ease-in-out">
                                            <!-- Modal header -->
                                            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t bg-gray-100">
                                                <h3 class="text-lg font-semibold text-gray-800">
                                                    Edit User
                                                </h3>
                                                <button type="button" class="text-gray-500 bg-transparent hover:bg-gray-200 hover:text-gray-600 rounded-full p-2.5 inline-flex justify-center items-center" data-modal-toggle="edit-modal-<?= $user['id'] ?>">
                                                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                    </svg>
                                                    <span class="sr-only">Close modal</span>
                                                </button>
                                            </div>
                                            <!-- Modal body -->
                                            <form class="p-4 md:p-5" method="post">
                                                <input type="hidden" name="id" value="<?= $user['id'] ?>">
                                                <div class="grid gap-6 mb-4 grid-cols-2 md:grid-cols-4">
                                                    <div class="col-span-2">
                                                        <label for="nik" class="block mb-2 text-sm font-medium text-gray-600">NIK</label>
                                                        <input type="text" value="<?= $user['nik'] ?>" readonly name="nik" class="bg-gray-50 border border-gray-300 text-black text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3" placeholder="1294012094712">
                                                    </div>
                                                    <div class="col-span-2">
                                                        <label for="username" class="block mb-2 text-sm font-medium text-gray-600">Username</label>
                                                        <input type="text" value="<?= $user['username'] ?>" name="username" class="bg-gray-50 border border-gray-300 text-black text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3" placeholder="johndoe">
                                                    </div>
                                                    <div class="col-span-2">
                                                        <label for="name" class="block mb-2 text-sm font-medium text-gray-600">Name</label>
                                                        <input type="text" value="<?= $user['name'] ?>" name="name" class="bg-gray-50 border border-gray-300 text-black text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3" placeholder="John Doe">
                                                    </div>
                                                    <div class="col-span-1">
                                                        <label for="phone_number" class="block mb-2 text-sm font-medium text-gray-600">Phone</label>
                                                        <input type="text" value="<?= $user['phone_number'] ?>" name="phone_number" class="bg-gray-50 border border-gray-300 text-black text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3" placeholder="628124123">
                                                    </div>
                                                    <div class="col-span-1">
                                                        <label for="role_id" class="block mb-2 text-sm font-medium text-gray-600">Role</label>
                                                        <select name="role_id" class="bg-gray-50 border border-gray-300 text-black text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3">
                                                            <option selected disabled>Select Role</option>
                                                            <?php foreach ($roles as $role) : ?>
                                                                <option value="<?= $role['id'] ?>" <?= $role['id'] == $user['role_id'] ? 'selected' : '' ?>>
                                                                    <?= ucwords($role['name']) ?>
                                                                </option>
                                                            <?php endforeach ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-span-1">
                                                        <label for="old_password" class="block mb-2 text-sm font-medium text-gray-600">Old Password</label>
                                                        <input minlength="8" type="password" name="old_password" class="bg-gray-50 border border-gray-300 text-black text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3" placeholder="**************">
                                                    </div>
                                                    <div class="col-span-1">
                                                        <label for="password" class="block mb-2 text-sm font-medium text-gray-600">Password</label>
                                                        <input minlength="8" type="password" name="password" class="bg-gray-50 border border-gray-300 text-black text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3" placeholder="**************">
                                                    </div>
                                                    <div class="col-span-2">
                                                        <label for="password_confirm" class="block mb-2 text-sm font-medium text-gray-600">Password Confirmation</label>
                                                        <input minlength="8" type="password" name="password_confirm" class="bg-gray-50 border border-gray-300 text-black text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3" placeholder="**************">
                                                    </div>
                                                </div>
                                                <div class="flex justify-end mt-4">
                                                    <button name="update" type="submit" class="text-white inline-flex items-center bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-6 py-3 text-center">
                                                        <svg class="mr-2 -ms-1 w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                                            <path fill-rule="evenodd" d="M9 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4H7Zm8-1a1 1 0 0 1 1-1h1v-1a1 1 0 1 1 2 0v1h1a1 1 0 1 1 0 2h-1v1a1 1 0 1 1-2 0v-1h-1a1 1 0 0 1-1-1Z" clip-rule="evenodd" />
                                                        </svg>
                                                        Submit
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <a href="#" onclick="confirmDelete('users_delete', 'user_id',<?= $user['id'] ?>)" class="font-medium text-red-400 hover:underline">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                <?php endif ?>
            </tbody>
        </table>
    </div>
</div>

<?php
if (isset($_POST['submit'])) {
    handleFormSubmit($_POST, 'users', 'add');
}

if (isset($_POST['update'])) {
    handleFormSubmit($_POST, 'users', 'update');
}
?>