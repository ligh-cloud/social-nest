<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SocialNest - Connect with Friends</title>
    <link rel="icon" href="{{ asset('Images/Logo.png') }}" type="image/png">

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
            overflow-x: hidden;
        }

        /* Branding styles */
        .brand-container {
            position: absolute;
            top: 30px;
            left: 30px;
            display: flex;
            align-items: center;
            z-index: 1001;
            transition: transform 0.3s ease;
        }

        .brand-container:hover {
            transform: scale(1.05);
        }

        .brand-logo {
            width: 40px;
            height: 40px;
            margin-right: 10px;
            filter: drop-shadow(0 0 8px rgba(24, 119, 242, 0.6));
        }

        .brand-name {
            color: #1877f2;
            font-size: 1.8em;
            font-weight: 700;
            text-shadow: 0 0 10px rgba(24, 119, 242, 0.5);
            letter-spacing: -0.5px;
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
            border-radius: 1px;
        }

        section span:hover {
            background: #1877f2;
            transition: 0s;
            box-shadow: 0 0 10px #1877f2, 0 0 20px #1877f2;
        }

        /* Sign-in and sign-up form styles */
        .form-container {
            position: absolute;
            width: 400px;
            background: rgba(34, 34, 34, 0.95);
            z-index: 1000;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.9), 0 0 20px rgba(24, 119, 242, 0.4);
            backdrop-filter: blur(5px);
            transition: all 0.5s ease;
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
            letter-spacing: 1px;
            text-shadow: 0 0 8px rgba(24, 119, 242, 0.3);
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
            border-radius: 6px;
            color: #fff;
            font-weight: 500;
            font-size: 1em;
            transition: all 0.3s;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.2);
        }

        .inputBox input:focus {
            box-shadow: 0 0 5px rgba(24, 119, 242, 0.5);
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
            transition: color 0.3s, transform 0.3s;
        }

        .links a:hover {
            color: #1877f2;
            transform: translateY(-2px);
        }

        .links a:nth-child(2) {
            color: #1877f2;
            font-weight: 600;
        }

        .inputBox input[type="submit"] {
            padding: 12px;
            background: #1877f2;
            color: #fff;
            font-weight: 600;
            font-size: 1.2em;
            letter-spacing: 0.05em;
            cursor: pointer;
            transition: all 0.3s;
            border-radius: 6px;
            text-transform: uppercase;
        }

        .inputBox input[type="submit"]:hover {
            background: #0a5dc7;
            box-shadow: 0 5px 15px rgba(24, 119, 242, 0.5);
            transform: translateY(-2px);
        }

        input[type="submit"]:active {
            opacity: 0.8;
            transform: translateY(0);
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
            padding: 10px;
            background: #333;
            border: none;
            border-radius: 6px;
            color: #fff;
            cursor: pointer;
            transition: all 0.3s;
        }

        .dob-container select:hover {
            background: #3a3a3a;
        }

        .gender-container {
            display: flex;
            gap: 8px;
        }

        .gender-option {
            flex: 1;
            padding: 10px;
            background: #333;
            border: none;
            border-radius: 6px;
            color: #fff;
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
            transition: all 0.3s;
        }

        .gender-option:hover {
            background: #3a3a3a;
        }

        .policy-text {
            font-size: 0.75em;
            color: #aaa;
            line-height: 1.4;
        }

        .policy-text a {
            color: #1877f2;
            text-decoration: none;
            transition: all 0.3s;
        }

        .policy-text a:hover {
            text-decoration: underline;
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
            padding: 12px 20px;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .signup-btn button:hover,
        .signup-btn input[type="submit"]:hover {
            background: #008f00;
            box-shadow: 0 5px 15px rgba(0, 164, 0, 0.5);
            transform: translateY(-2px);
        }

        /* Form transition animation */
        @keyframes formFadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .form-container.active {
            animation: formFadeIn 0.5s forwards;
        }

        /* Social media icons */
        .social-icons {
            display: flex;
            gap: 15px;
            margin-top: 20px;
            justify-content: center;
        }

        .social-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
            font-size: 1.2em;
            transition: all 0.3s;
        }

        .social-icon:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }

        .facebook { background: #1877f2; }
        .twitter { background: #1da1f2; }
        .google { background: #db4437; }

        /* OR divider */
        .divider {
            display: flex;
            align-items: center;
            text-align: center;
            color: #aaa;
            width: 100%;
            margin: 10px 0;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #444;
        }

        .divider::before {
            margin-right: 10px;
        }

        .divider::after {
            margin-left: 10px;
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
                padding: 30px 20px;
            }

            .brand-container {
                top: 20px;
                left: 20px;
            }

            .brand-name {
                font-size: 1.5em;
            }

            .content h2 {
                font-size: 1.6em;
            }
        }

        /* Accessibility improvements */
        .sr-only {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            white-space: nowrap;
            border-width: 0;
        }

        /* Password strength indicator */
        .password-strength {
            height: 5px;
            width: 100%;
            background: #333;
            margin-top: 5px;
            border-radius: 3px;
            overflow: hidden;
            display: none;
        }

        .strength-meter {
            height: 100%;
            width: 0;
            transition: width 0.3s, background 0.3s;
        }

        .weak { background: #ff4747; width: 33%; }
        .medium { background: #ffd600; width: 66%; }
        .strong { background: #00c853; width: 100%; }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
<!-- SocialNest Branding -->
<div class="brand-container">
    <img src="{{ asset('image/logo1.png') }}" alt="SocialNest Logo" class="brand-logo">
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
    <div id="login-container" class="form-container active">
        <div class="content">
            <h2>Welcome Back</h2>
            <form action="/login" method="POST" class="form">
                @csrf
                <div class="inputBox">
                    <input type="text" id="login-email" name="email" required>
                    <i>Email or phone number</i>
                </div>
                <div class="inputBox">
                    <input type="password" id="login-password" name="password" required>
                    <i>Password</i>
                </div>
                <div class="links">
                    <a href="#">Forgot Password</a>
                    <a href="#" id="show-signup-btn">Create Account</a>
                </div>
                <div class="inputBox">
                    <input type="submit" value="Login">
                </div>

                <div class="divider">OR</div>

                <div class="social-icons">
                    <a href="#" class="social-icon facebook" aria-label="Login with Facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="social-icon twitter" aria-label="Login with Twitter">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="social-icon google" aria-label="Login with Google">
                        <i class="fab fa-google"></i>
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Signup Form -->
    <div id="signup-container" class="form-container">
        <div class="content">
            <h2>Join SocialNest</h2>
            <form action="{{route('register')}}" method="POST" class="form">
                @csrf
                <div class="inputBox">
                    <input type="text" id="first-name" name="name" required>
                    <i>First Name</i>
                </div>
                <div class="inputBox">
                    <input type="text" id="last-name" name="lastName" required>
                    <i>Last Name</i>
                </div>
                <div class="inputBox">
                    <input type="text" id="signup-email" name="email" required>
                    <i>Email or Phone</i>
                </div>
                <div class="inputBox">
                    <input type="password" id="signup-password" name="password" required>
                    <i>New Password</i>
                    <div class="password-strength">
                        <div class="strength-meter"></div>
                    </div>
                </div>

                <p style="color: #aaa; font-size: 0.9em;">Date of Birth</p>
                <div class="dob-container">
                    <select id="day" name="day" aria-label="Day"></select>
                    <select id="month" name="month" aria-label="Month"></select>
                    <select id="year" name="year" aria-label="Year"></select>
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
            </form>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Form toggle functionality with animations
        const loginContainer = document.getElementById('login-container');
        const signupContainer = document.getElementById('signup-container');
        const showSignupBtn = document.getElementById('show-signup-btn');
        const showLoginBtn = document.getElementById('show-login-btn');

        showSignupBtn.addEventListener('click', function(e) {
            e.preventDefault();
            loginContainer.style.display = 'none';
            loginContainer.classList.remove('active');
            signupContainer.style.display = 'flex';
            setTimeout(() => {
                signupContainer.classList.add('active');
            }, 10);
        });

        showLoginBtn.addEventListener('click', function(e) {
            e.preventDefault();
            signupContainer.style.display = 'none';
            signupContainer.classList.remove('active');
            loginContainer.style.display = 'flex';
            setTimeout(() => {
                loginContainer.classList.add('active');
            }, 10);
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

        // Password strength indicator
        const passwordInput = document.getElementById('signup-password');
        const strengthIndicator = document.querySelector('.password-strength');
        const strengthMeter = document.querySelector('.strength-meter');

        passwordInput.addEventListener('input', function() {
            const password = this.value;

            if (password.length === 0) {
                strengthIndicator.style.display = 'none';
                return;
            }

            strengthIndicator.style.display = 'block';

            // Simple password strength logic
            let strength = 0;

            // Length check
            if (password.length >= 8) strength += 1;

            // Character variety checks
            if (/[A-Z]/.test(password)) strength += 1;
            if (/[0-9]/.test(password)) strength += 1;
            if (/[^A-Za-z0-9]/.test(password)) strength += 1;

            // Update strength meter
            strengthMeter.className = 'strength-meter';
            if (strength <= 1) {
                strengthMeter.classList.add('weak');
            } else if (strength <= 3) {
                strengthMeter.classList.add('medium');
            } else {
                strengthMeter.classList.add('strong');
            }
        });

        // Background animation enhancements
        const spans = document.querySelectorAll('section span');

        spans.forEach(span => {
            // Random delay for background span animations
            span.style.transitionDelay = `${Math.random() * 2}s`;

            // Add subtle pulsing effect to some spans
            if (Math.random() > 0.8) {
                span.style.animation = `pulse ${2 + Math.random() * 3}s infinite alternate`;
            }
        });
    });

    // Add pulse animation
    document.head.insertAdjacentHTML('beforeend', `
        <style>
            @keyframes pulse {
                0% { opacity: 0.3; }
                100% { opacity: 0.8; }
            }
        </style>
    `);
</script>
</body>
</html>
