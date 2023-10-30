<?php
session_start();

$users=json_decode(file_get_contents('users.json'),true);
// echo $_SESSION["email"];
// echo $_SESSION["password"];

$error=false;
if(!$users[$_SESSION['email']]){  //এখানে মূলত চেক করছি এই মেইলটি $users নামক variable নাই কিনা।
    echo "email not found";
}

if (isset($_POST['email']) && isset($_POST['password'])) {
    if ($_POST['email'] == $_SESSION['email'] && $_POST['password']== $_SESSION['password']) {
        $_SESSION['loggedin'] = true;
    } else {
        $error=true;
        $_SESSION['loggedin'] = false;
    }
}

if (isset($_POST['logout'])) {
    $_SESSION['loggedin'] = false;
    session_destroy();
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Login Page</title>
</head>

<body>
    <section class="bg-gray-50 dark:bg-gray-900">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">

            <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Sign in your account
                    </h1>
                    <h3 class="text-md font-bold leading-tight tracking-tight text-green-700 md:text-md dark:text-white">

                        <?php
                        if ($_SESSION['loggedin']==true) {
                            echo "Hello Mr./Mrs. your login was success!";
                            // header('Location: update.php');
                        } else {
                            // echo sha1('rabbit');
                            echo "Hello User Please login below";
                        }
                        ?>
                    </h3>

                    <?php
                    if($error){
                        echo "<blockquote> Your Email or Password didn't Match </blockquote>";
                    }
                    if ($_SESSION['loggedin'] == false) :
                    ?>
                        <form method="POST" class="space-y-4 md:space-y-6" action="#">
                            <div>
                                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>

                                <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="example@company.com" required="">
                            </div>
                            <div>
                                <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                                <input type="password" name="password" id="password" placeholder="pssword" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                            </div>

                            <button class="w-full bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">Sign in</button>
                            <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                                Don’t have an account yet? <a href="./registration.php" class="font-medium text-primary-600 hover:underline dark:text-primary-500">Sign up</a>
                            </p>
                        </form>
                    <?php
                    else :
                    ?>

                        <form action="./registration.php ? logout=true" method="POST">
                            <input type="hidden" name="logout" value="1">
                            <button type="submit" class="bg-primary" name="submit">
                                Log Out
                            </button>

                        </form>
                    <?php
                    endif;
                    ?>
                </div>
            </div>
        </div>
    </section>
</body>

</html>