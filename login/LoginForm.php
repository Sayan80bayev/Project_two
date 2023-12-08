<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="icon" type="image/svg+xml" href="http://localhost/project_two/images/gamepad-solid.svg">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel='stylesheet' href="http://localhost/project_two/css/styleOfLogin.css">
</head>

<body>
    <form action="http://localhost/project_two/login/login.php" method="POST" id="myForm">
        <?php
            session_start();
            $errors = $_SESSION["errors"] ?? [];
            $status = $_SESSION["status"] ?? null;
            
            // Display status message based on session status
            if (isset($_SESSION["message"]) && $status =='error') {
                echo '<p style="color:red;">'. $_SESSION["message"] .'</p>';
            } elseif(isset($_SESSION["message"]) && $status =='success') {
                echo '<p style="color:green;">'. $_SESSION['message'] .'</p>';
            }
        ?>

        <h2>Login</h2>
        <div class='form-group'>
            <!-- Login input -->
            Login:
            <input type="text" class='form-control' id="email" name="email">
            <p id="emailError" class='error'></p>
            <?php
                // Display login error message
                if ($status == 'error' && isset($errors['login']))
                    echo "<p class='text-danger'>{$errors['login']}</p>";
            ?>
        </div>
        <div class='form-group'>
            <!-- Password input -->
            Password:
            <input type="password" class='form-control' id="password" name="password">
            <p id="passError" class='error'></p>
            <?php
                // Display password error message
                if ($status == 'error' && isset($errors['password']))
                    echo "<p class='text-danger'>{$errors['password']}</p>";
            ?>
        </div>
        <input type="button" onclick="formCheck()" value="Login" class='button'>
        <p class='error'>
            <!-- Additional information -->
            <p style="margin: 0 70px; width: 100%">Haven't registered yet? <a href="../register/registerform.php ">click here</a></p>
    </form>

    <?php
        // Clear session variables
        unset($_SESSION['errors']);
        unset($_SESSION['status']);
        unset($_SESSION['message']);
    ?>

    <script>
        // Checking pattern in JavaScript
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

        // Event listeners for input changes
        const loginInput = document.getElementById('email');
        loginInput.addEventListener('input', checkLogin);

        const passInput = document.getElementById('password');
        passInput.addEventListener('input', checkPass);
    </script>
</body>

</html>
