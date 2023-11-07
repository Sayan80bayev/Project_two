<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel='stylesheet' href="styleOfLogin.css">
</head>

<body>
        <?php
            session_start();
            $errors = $_SESSION["errors"] ?? [];
            $status = $_SESSION["status"] ?? null;
        ?>
        <form action="login.php" method="POST" id="myForm">
            <h2>Login</h2>
            <div>
                Login:
                <input type="text" id="email" name="email">
                <p id="emailError" class='error'></p>
                <?php
                if ($status == 'error' && isset($errors['login']))
                    echo "<p class='text-danger'>{$errors['login']}</p>";
                ?>
            </div>
            <div>
                Password:
                <input type="password" id="password" name="password">
                <p id="passError" class='error'></p>
                <?php
                if ($status == 'error' && isset($errors['password']))
                    echo "<p class='text-danger'>{$errors['password']}</p>";
                ?>
            </div>
            <div class="facebook">
                <img src="../images/Facebook.png" alt="">
                <p>Sign with Facebook</p>
            </div>
            <div class="google">
                <img src="../images/Google.png" alt="">
                <p>Sign with Google</p>
            </div>
            <input type="button" onclick="formCheck()" value="Login" class='button'>
            <p class='error'>
            <!-- error message -->
            <p style="margin: 0 70px;">Haven't registered yet? -> <a href="#">click here</a></p>
        </form>
        <?php
            unset($_SESSION['errors']);
            unset($_SESSION['status']);
        ?>
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
                        errorPass.textContent = "At least 6 characters";
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