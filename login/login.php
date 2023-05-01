<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel='stylesheet' href="styleOfLogin.css">
</head>

<body>

        <!-- checking email and password -->
        <?php
            include '../db/users.php';
            $error='';

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $email = $_POST['email'];
                $password = $_POST['password'];
                $email_found = false;


                // cheking email pattern in php
                    if (!empty($email) && !empty($password) && strlen($password) >= 6) {
                        $atIndex = strpos($email, '@');
                        $dotIndex = strrpos($email, '.');
                        
                        if ($atIndex >= 1 || $dotIndex >= $atIndex + 2 || $dotIndex + 1 < strlen($email)) {
                            foreach ($users as $user) {
                                if ($user['email'] == $email && empty($error)) {
                                    $email_found = true;
                                    if ($user['password'] == $password) {
                                        header("Location: ../index.php");
                                    } else {
                                        $error .= "Invalid password";
                                    }
                                    break;
                                }
                            }
            
                            if (!$email_found && empty($error)) {
                                $error .= "User not found";
                            }  
                        }
                    }
            }
        ?>



        <form action="login.php" method="POST" id="myForm">
            <h2>Login</h2>
            <div>
                Login:
                <input type="text" id="email" name="email">
                <p id="emailError" class='error'></p>
            </div>
            <div>
                Password:
                <input type="password" id="password" name="password">
                <p id="passError" class='error'></p>
            </div>
            <input type="button" onclick="formCheck()" value="Login" class='button'>
            <p class='error'>
            <!-- error message -->
            <?php
                if(isset($error)){
                    echo $error;
                }
                ?>
            </p>
        </form>
        
        <script>
            //cheking pattern in js
            function checkLogin() {
                const loginInput = document.getElementById('email');
                const errorText = document.getElementById('emailError');
                if (loginInput.value !== '') {
                    const atIndex = loginInput.value.indexOf('@');
                    const dotIndex = loginInput.value.lastIndexOf('.');

                    if (atIndex < 1 || dotIndex < atIndex + 2 || dotIndex + 1 >= loginInput.value.length) {
                        errorText.textContent = 'Invalid login';
                        return false;
                    } else {
                        errorText.textContent = '';
                        return true;
                    }

                } else {
                    errorText.textContent = '';
                    return false;
                }
            }


            function checkPass() {
                const passInput = document.getElementById('password');
                const errorPass = document.getElementById('passError');
                if (passInput.value !== '') {
                    if (passInput.value.length < 6) {
                        errorPass.textContent = "at least 6 characters";
                        return false;
                    } else {
                        errorPass.textContent = '';
                        return true;
                    }
                } else {
                    errorPass.textContent = '';
                    return false;
                }
            }

            function formCheck() {
                if (checkLogin() && checkPass()) {
                    document.getElementById('myForm').submit();
                }    
            }

            const loginInput = document.getElementById('email');
            loginInput.addEventListener('input', checkLogin);

            const passInput = document.getElementById('password');
            passInput.addEventListener('input', checkPass);
            
        </script>
</body>
</html>