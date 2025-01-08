<?php
// Check for success message in the URL
$showMessage = false; // Initialize the variable
if (isset($_GET['message']) && $_GET['message'] === 'success') {
    $showMessage = true;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login and Register</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background: #ffffff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
            width: 400px;
        }
        .container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        .success-message {
            background-color: #d4edda;
            color: #155724;
            padding: 10px;
            border: 1px solid #c3e6cb;
            border-radius: 5px;
            text-align: center;
            margin-bottom: 15px;
            display: none;
        }
        .tab {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .tab button {
            flex: 1;
            padding: 12px;
            background-color: #e7e7e7;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }
        .tab button.active {
            background-color: #007BFF;
            color: #ffffff;
        }
        .form-container {
            display: none;
        }
        .form-container.active {
            display: block;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }
        .form-group input:focus {
            border-color: #007BFF;
            outline: none;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }
        .submit-button {
            width: 100%;
            padding: 12px;
            background-color: #007BFF;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }
        .submit-button:hover {
            background-color: #0056b3;
        }
        .error {
            color: red;
            text-align: center;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

    <div class="container">
    <?php if ($showMessage): ?>
        <div id="successMessage" class="success-message">
            Registration successful! Please login.
        </div>
    <?php endif; ?>
        <div class="tab">
            <button id="loginTab" class="active">Login</button>
            <button id="registerTab">Register</button>
        </div>

        <div id="loginForm" class="form-container active">
            <h2>Login</h2>
            <div id="login-error-message" class="error"></div>
            <form method="POST" action="login.php">
                <div class="form-group">
                    <label for="login-username">Username:</label>
                    <input type="text" id="login-username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="login-password">Password:</label>
                    <input type="password" id="login-password" name="password" required>
                </div>
                <button type="submit" class="submit-button">Login</button>
            </form>
        </div>

        <div id="registerForm" class="form-container">
            <h2>Register</h2>
            <div id="register-error-message" class="error"></div>
            <form method="POST" action="register.php">
                <div class="form-group">
                    <label for="register-fullname">Full Name:</label>
                    <input type="text" id="register-fullname" name="fullname" required>
                </div>
                <div class="form-group">
                    <label for="register-dob">Date of Birth:</label>
                    <input type="date" id="register-dob" name="dob" required>
                </div>
                <div class="form-group">
                    <label for="register-address">Address:</label>
                    <input type="text" id="register-address" name="address" required>
                </div>
                <div class="form-group">
                    <label for="register-username">Username:</label>
                    <input type="text" id="register-username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="register-password">Password:</label>
                    <input type="password" id="register-password" name="password" required>
                </div>
                <div class="form-group">
                    <label for="register-email">Email:</label>
                    <input type="email" id="register-email" name="email" required>
                </div>
                <button type="submit" class="submit-button">Register</button>
            </form>
        </div>
    </div>

    <script>
        // Show the success message if it exists
        const successMessage = document.getElementById('successMessage');
        if (successMessage) {
            successMessage.style.display = 'block';

            // Remove the message after 3 seconds
            setTimeout(() => {
                successMessage.style.display = 'none';

                // Remove the query parameter from the URL
                const url = new URL(window.location.href);
                url.searchParams.delete('message');
                window.history.replaceState(null, '', url);
            }, 3000);
        }

        const loginTab = document.getElementById('loginTab');
        const registerTab = document.getElementById('registerTab');
        const loginForm = document.getElementById('loginForm');
        const registerForm = document.getElementById('registerForm');

        loginTab.addEventListener('click', () => {
            loginTab.classList.add('active');
            registerTab.classList.remove('active');
            loginForm.classList.add('active');
            registerForm.classList.remove('active');
        });

        registerTab.addEventListener('click', () => {
            registerTab.classList.add('active');
            loginTab.classList.remove('active');
            registerForm.classList.add('active');
            loginForm.classList.remove('active');
        });

        const loginFormElement = document.querySelector('#loginForm form');
        loginFormElement.addEventListener('submit', function(event) {
            const username = document.getElementById('login-username').value;
            const password = document.getElementById('login-password').value;

            if (username === '' || password === '') {
                event.preventDefault();
                document.getElementById('login-error-message').textContent = 'All fields are required.';
            }
        });

        const registerFormElement = document.querySelector('#registerForm form');
        registerFormElement.addEventListener('submit', function(event) {
            const fullname = document.getElementById('register-fullname').value;
            const dob = document.getElementById('register-dob').value;
            const address = document.getElementById('register-address').value;
            const username = document.getElementById('register-username').value;
            const password = document.getElementById('register-password').value;
            const email = document.getElementById('register-email').value;

            if (fullname === '' || dob === '' || address === '' || username === '' || password === '' || email === '') {
                event.preventDefault();
                document.getElementById('register-error-message').textContent = 'All fields are required.';
            }
        });
    </script>
</body>
</html>
