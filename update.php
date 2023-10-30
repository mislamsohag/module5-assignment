<?php
session_start();

$users = json_decode(file_get_contents('users.json'), true);

echo $_SESSION["email"];
if (!$users[$_SESSION['email']]) {  //এখানে মূলত চেক করছি এই মেইলটি $users নামক variable নাই কিনা।
    echo "email not found";
}


if (isset($_POST['update_role'])) {
    $user_email = $_SESSION['email'];
    $new_role = $_POST['role'];

    if (isset($users[$user_email])) {
        $users[$user_email]['role'] = $new_role;
        file_put_contents('users.json', json_encode($users, JSON_PRETTY_PRINT));
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Role Update</title>
</head>

<body>
    <section class="bg-gray-50 dark:bg-gray-900">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">

            <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Role Update
                    </h1>

                    <form method="POST" class="space-y-4 md:space-y-6" action="#">
                        <div>
                            <input type="text" name="role" id="role" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Type username" required="">
                        </div>
                        <button type="submit" name="update_role" class="w-full bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">Role Update</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>

</html>