<?php

session_start();

$usersFile = 'users.json'; //এই নামে ফাইল তৈরি হাবে।

// এবার আমি উপরের ফাইলটি আছেকিনা তা চেক করব। যদি থাকে তবে এককাজ করব, আর না থাকলে অন্য কাজ করব।
$users = file_exists($usersFile) ? json_decode(file_get_contents($usersFile), true) : [];

// এই function টি পরের একটি কাজের জন্য ঘোষণা করা হলো।
function saveUsers($users, $file)
{
    file_put_contents($file, json_encode($users, JSON_PRETTY_PRINT));
}

// রেজিষ্ট্রেশন ফরম input field হ্যান্ডলিং
if (isset($_POST['registration'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];


    //Validaton;
    if (empty($username) || empty($email) || empty($password)) {
        $errorMsg = 'Please fill all the field.';
    } else {
        if (isset($users[$email])) {
            $errorMsg = "Email allready exists.";
        } else {
            $users[$email] = [
                'username' => $username,
                'password' => $password,
                'role' => ''
            ];

            saveUsers($users, $usersFile);

            // এখানে session এর মাধ্যমে email টাকে update page এ নিয়ে যাওয়া হচ্ছে।
            $_SESSION['email'] = $email;
            $_SESSION['password'] = $password;
            header('Location: login.php'); // এর মাধ্যমে page লিংক করা হচ্ছে।
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Registration Page</title>
</head>

<body>
    <section class="bg-gray-50 dark:bg-gray-900">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">

            <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Create your account
                    </h1>

                    <?php // for error Massage showing
                    echo $errorMsg;
                    ?>

                    <form method="POST" class="space-y-4 md:space-y-6" action="#">
                        <div>
                            <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
                            <input type="text" name="username" id="username" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Your username">
                        </div>

                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
                            <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@company.com">
                        </div>

                        <div>
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                            <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>

                        <button type="submit" name="registration" value="Registration" class="w-full bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">Create an account</button>

                        <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                            Already have an account? <a href="./login.php" class="font-medium text-primary-600 hover:underline dark:text-primary-500">Login here</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>

</html>