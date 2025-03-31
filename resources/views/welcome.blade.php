<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SocialNest - Connect with Friends</title>
    <style>
        /* Font import and global reset */
        @import url('https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap');

        /* Global reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Quicksand', sans-serif;
        }

        /* Body styling */
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: #000;
        }

        /* Branding styles */
        .brand-container {
            position: absolute;
            top: 30px;
            left: 30px;
            display: flex;
            align-items: center;
            z-index: 1001;
        }

        .brand-logo {
            width: 40px;
            height: 40px;
            margin-right: 10px;
        }

        .brand-name {
            color: #1877f2;
            font-size: 1.8em;
            font-weight: 700;
            text-shadow: 0 0 10px rgba(24, 119, 242, 0.5);
        }

        /* Section styles */
        section {
            position: absolute;
            width: 100vw;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 2px;
            flex-wrap: wrap;
            overflow: hidden;
        }

        /* Animated gradient effect */
        section::before {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            background: linear-gradient(#000, #1877f2, #000);
            animation: animate 5s linear infinite;
        }

        /* Animation keyframes */
        @keyframes animate {
            0% {
                transform: translateY(-100%);
            }
            100% {
                transform: translateY(100%);
            }
        }

        /* Styling for individual spans */
        section span {
            position: relative;
            display: block;
            width: calc(6.25vw - 2px);
            height: calc(6.25vw - 2px);
            background: #181818;
            z-index: 2;
            transition: 1.5s;
        }

        section span:hover {
            background: #1877f2;
            transition: 0s;
        }

        /* Sign-in and sign-up form styles */
        .form-container {
            position: absolute;
            width: 400px;
            background: #222;
            z-index: 1000;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.9);
        }

        .content {
            position: relative;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            gap: 30px;
        }

        .content h2 {
            font-size: 2em;
            color: #1877f2;
            text-transform: uppercase;
        }

        .form {
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .inputBox {
            position: relative;
            width: 100%;
        }

        .inputBox input {
            position: relative;
            width: 100%;
            background: #333;
            border: none;
            outline: none;
            padding: 25px 10px 7.5px;
            border-radius: 4px;
            color: #fff;
            font-weight: 500;
            font-size: 1em;
        }

        .inputBox i {
            position: absolute;
            left: 0;
            padding: 15px 10px;
            font-style: normal;
            color: #aaa;
            transition: 0.5s;
            pointer-events: none;
        }

        .inputBox input:focus ~ i,
        .inputBox input:valid ~ i {
            transform: translateY(-7.5px);
            font-size: 0.8em;
            color: #fff;
        }

        .links {
            position: relative;
            width: 100%;
            display: flex;
            justify-content: space-between;
        }

        .links a {
            color: #fff;
            text-decoration: none;
            font-size: 0.9em;
        }

        .links a:nth-child(2) {
            color: #1877f2;
            font-weight: 600;
        }

        .inputBox input[type="submit"] {
            padding: 10px;
            background: #1877f2;
            color: #fff;
            font-weight: 600;
            font-size: 1.2em;
            letter-spacing: 0.05em;
            cursor: pointer;
        }

        input[type="submit"]:active {
            opacity: 0.8;
        }

        /* Signup form styles */
        #signup-container {
            display: none;
        }

        .dob-container {
            display: flex;
            gap: 8px;
        }

        .dob-container select {
            flex: 1;
            padding: 8px;
            background: #333;
            border: none;
            border-radius: 4px;
            color: #fff;
        }

        .gender-container {
            display: flex;
            gap: 8px;
        }

        .gender-option {
            flex: 1;
            padding: 8px;
            background: #333;
            border: none;
            border-radius: 4px;
            color: #fff;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .policy-text {
            font-size: 0.75em;
            color: #aaa;
        }

        .policy-text a {
            color: #1877f2;
            text-decoration: none;
        }

        .signup-btn {
            text-align: center;
            margin-top: 15px;
        }

        .signup-btn button,
        .signup-btn input[type="submit"] {
            background: #00a400;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            font-weight: 600;
            cursor: pointer;
        }

        /* Media queries for responsive design */
        @media (max-width: 900px) {
            section span {
                width: calc(10vw - 2px);
                height: calc(10vw - 2px);
            }
        }

        @media (max-width: 600px) {
            section span {
                width: calc(20vw - 2px);
                height: calc(20vw - 2px);
            }

            .form-container {
                width: 90%;
            }

            .brand-container {
                top: 20px;
                left: 20px;
            }

            .brand-name {
                font-size: 1.5em;
            }
        }
    </style>
</head>
<body>
<!-- SocialNest Branding -->
<div class="brand-container">
    <img src="logo.png" alt="SocialNest Logo" class="brand-logo">
    <div class="brand-name">SocialNest</div>
</div>

<section>
    <!-- Creating 200 spans for background animation effect -->
    <script>
        for(let i = 0; i < 200; i++) {
            document.write('<span></span>');
        }
    </script>

    <!-- Login Form -->
    <div id="login-container" class="form-container">
        <div class="content">
            <h2>Sign In</h2>
            <div class="form">
                <div class="inputBox">
                    <input type="text" required>
                    <i>Email or phone number</i>
                </div>
                <div class="inputBox">
                    <input type="password" required>
                    <i>Password</i>
                </div>
                <div class="links">
                    <a href="#">Forgot Password</a>
                    <a href="#" id="show-signup-btn">Create Account</a>
                </div>
                <div class="inputBox">
                    <input type="submit" value="Login">
                </div>
            </div>
        </div>
    </div>

    <!-- Signup Form -->
    <div id="signup-container" class="form-container">
        <div class="content">
            <h2>Create Account</h2>
            <div class="form">
                <div class="inputBox">
                    <input type="text" required>
                    <i>First Name</i>
                </div>
                <div class="inputBox">
                    <input type="text" required>
                    <i>Last Name</i>
                </div>
                <div class="inputBox">
                    <input type="text" required>
                    <i>Email or Phone</i>
                </div>
                <div class="inputBox">
                    <input type="password" required>
                    <i>New Password</i>
                </div>

                <p style="color: #aaa; font-size: 0.9em;">Date of Birth</p>
                <div class="dob-container">
                    <select id="day"></select>
                    <select id="month"></select>
                    <select id="year"></select>
                </div>

                <p style="color: #aaa; font-size: 0.9em;">Gender</p>
                <div class="gender-container">
                    <label class="gender-option">
                        <span>Female</span>
                        <input type="radio" name="gender" value="female">
                    </label>
                    <label class="gender-option">
                        <span>Male</span>
                        <input type="radio" name="gender" value="male">
                    </label>
                </div>

                <p class="policy-text">
                    By clicking Sign Up, you agree to our <a href="#">Terms</a>,
                    <a href="#">Privacy Policy</a> and <a href="#">Cookies Policy</a>.
                    You may receive SMS notifications from us and can opt out at any time.
                </p>

                <div class="signup-btn">
                    <input type="submit" value="Sign Up">
                </div>

                <div class="links" style="justify-content: center; margin-top: 10px;">
                    <a href="#" id="show-login-btn">Already have an account?</a>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Form toggle functionality
        const loginContainer = document.getElementById('login-container');
        const signupContainer = document.getElementById('signup-container');
        const showSignupBtn = document.getElementById('show-signup-btn');
        const showLoginBtn = document.getElementById('show-login-btn');

        showSignupBtn.addEventListener('click', function(e) {
            e.preventDefault();
            loginContainer.style.display = 'none';
            signupContainer.style.display = 'flex';
        });

        showLoginBtn.addEventListener('click', function(e) {
            e.preventDefault();
            signupContainer.style.display = 'none';
            loginContainer.style.display = 'flex';
        });

        // Populate date of birth selectors
        const daySelect = document.getElementById("day");
        const monthSelect = document.getElementById("month");
        const yearSelect = document.getElementById("year");

        // Populate days
        for (let i = 1; i <= 31; i++) {
            let option = document.createElement("option");
            option.value = i;
            option.textContent = i;
            daySelect.appendChild(option);
        }

        // Populate months
        const months = [
            "January", "February", "March", "April", "May", "June",
            "July", "August", "September", "October", "November", "December"
        ];
        months.forEach((month, index) => {
            let option = document.createElement("option");
            option.value = index + 1;
            option.textContent = month;
            monthSelect.appendChild(option);
        });

        // Populate years
        const currentYear = new Date().getFullYear();
        for (let i = currentYear; i >= 1900; i--) {
            let option = document.createElement("option");
            option.value = i;
            option.textContent = i;
            yearSelect.appendChild(option);
        }
    });
</script>
</body>
</html>
