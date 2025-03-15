<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SocialNest</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .socialnest-blue {
            background-color: #1877f2;
        }
        .socialnest-green {
            background-color: #00a400;
        }
        .signup-container {
            display: none;
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen">
<div class="container mx-auto py-8 px-4">
    <div class="max-w-5xl mx-auto flex flex-col items-center md:flex-row md:items-start justify-between gap-8">
        <!-- Left Content Section -->
        <div class="md:max-w-md flex flex-col items-center md:items-start">
            <img src="{{ asset('images/logo.jpg') }}" alt="SocialNest Logo" class="w-24 mb-2">
            <h1 class="text-2xl md:text-3xl text-center md:text-left font-normal text-gray-800 mt-4">
                SocialNest helps you connect and share with the people in your life.
            </h1>
        </div>

        <!-- Login Form Container -->
        <div id="login-container" class="login-container max-w-sm w-full">
            <div class="bg-white p-4 rounded-lg shadow-md">
                <form id="login-form">
                    <input type="text" placeholder="Email address or phone number" class="w-full mb-3 px-4 py-3 border border-gray-300 rounded-md text-gray-700">
                    <input type="password" placeholder="Password" class="w-full mb-3 px-4 py-3 border border-gray-300 rounded-md text-gray-700">
                    <button type="submit" class="w-full socialnest-blue text-white py-2 px-4 rounded-md font-bold text-xl">Log in</button>
                </form>
                <div class="text-center mt-4 mb-4">
                    <a href="#" class="text-blue-500 text-sm hover:underline">Forgotten password?</a>
                </div>
                <hr class="my-4">
                <div class="text-center">
                    <button id="show-signup-btn" class="socialnest-green text-white py-2 px-4 rounded-md font-bold text-lg">Create new account</button>
                </div>
            </div>
            <div class="text-center mt-4">
                <p class="text-sm"><a href="#" class="font-bold">Create a Page</a> for a celebrity, brand or business.</p>
            </div>
        </div>


        <div id="signup-container" class="signup-container max-w-md w-full">
            <div class="bg-white p-4 rounded-lg shadow-md">
                <div class="text-center mb-4">
                    <h2 class="text-2xl font-bold">Create a new account</h2>
                    <p class="text-gray-600">It's quick and easy.</p>
                </div>
                <hr class="mb-4">
                <form id="signup-form">
                    <div class="flex gap-2 mb-3">
                        <input type="text" placeholder="First name" class="w-1/2 px-3 py-2 border border-gray-300 rounded-md">
                        <input type="text" placeholder="Surname" class="w-1/2 px-3 py-2 border border-gray-300 rounded-md">
                    </div>
                    <input type="text" placeholder="Mobile number or email address" class="w-full mb-3 px-3 py-2 border border-gray-300 rounded-md">
                    <input type="password" placeholder="New password" class="w-full mb-3 px-3 py-2 border border-gray-300 rounded-md">

                    <div class="mb-3">
                        <label class="block text-gray-600 text-sm mb-1">Date of birth</label>
                        <div class="flex gap-2">
                            <select id="day" class="w-1/3 px-3 py-2 border border-gray-300 rounded-md"></select>
                            <select id="month" class="w-1/3 px-3 py-2 border border-gray-300 rounded-md"></select>
                            <select id="year" class="w-1/3 px-3 py-2 border border-gray-300 rounded-md"></select>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-600 text-sm mb-1">Gender</label>
                        <div class="flex gap-2">
                            <label class="w-1/2 border border-gray-300 rounded-md px-3 py-2 flex items-center justify-between">
                                <span>Female</span>
                                <input type="radio" name="gender" value="female" class="ml-2">
                            </label>
                            <label class="w-1/2 border border-gray-300 rounded-md px-3 py-2 flex items-center justify-between">
                                <span>Male</span>
                                <input type="radio" name="gender" value="male" class="ml-2">
                            </label>
                        </div>
                    </div>

                    <p class="text-xs text-gray-500 mb-4">
                        People who use our service may have uploaded your contact information to Facebook.
                        <a href="#" class="text-blue-500">Learn more</a>
                    </p>

                    <p class="text-xs text-gray-500 mb-4">
                        By clicking Sign Up, you agree to our
                        <a href="#" class="text-blue-500">Terms</a>,
                        <a href="#" class="text-blue-500">Privacy Policy</a> and
                        <a href="#" class="text-blue-500">Cookies Policy</a>.
                        You may receive SMS notifications from us and can opt out at any time.
                    </p>

                    <div class="text-center">
                        <button type="submit" class="socialnest-green text-white py-2 px-12 rounded-md font-bold text-lg">Sign Up</button>
                    </div>
                </form>
                <div class="text-center mt-4">
                    <a href="#" id="show-login-btn" class="text-blue-500 hover:underline">Already have an account?</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer Section -->
<footer class="mt-8 text-center">
    <div class="max-w-5xl mx-auto px-4">
        <div class="mb-2 flex flex-wrap justify-center gap-x-3 text-xs text-gray-600">
            <a href="#">English (UK)</a>
            <a href="#">Français (France)</a>
            <a href="#">العربية</a>
            <a href="#">ภาษาไทย</a>
            <a href="#">Español (España)</a>
            <a href="#">Italiano</a>
            <a href="#">Deutsch</a>
            <a href="#">Português (Brasil)</a>
            <a href="#">हिन्दी</a>
            <a href="#">中文(简体)</a>
            <a href="#">日本語</a>
            <button class="border border-gray-300 px-1">+</button>
        </div>

        <hr class="my-2">



        <div class="mt-4 text-xs text-gray-600">
            <p>social nest © 2025</p>
        </div>
    </div>
</footer>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const loginContainer = document.getElementById('login-container');
        const signupContainer = document.getElementById('signup-container');
        const showSignupBtn = document.getElementById('show-signup-btn');
        const showLoginBtn = document.getElementById('show-login-btn');

        // Switch to signup form
        showSignupBtn.addEventListener('click', function() {
            loginContainer.style.display = 'none';
            signupContainer.style.display = 'block';
        });

        // Switch to login form
        showLoginBtn.addEventListener('click', function() {
            signupContainer.style.display = 'none';
            loginContainer.style.display = 'block';
        });

        // Handle login form submission
        document.getElementById('login-form').addEventListener('submit', function(e) {
            e.preventDefault();
            // Add login form handling logic here
            console.log('Login form submitted');
        });

        // Handle signup form submission
        document.getElementById('signup-form').addEventListener('submit', function(e) {
            e.preventDefault();
            // Add signup form handling logic here
            console.log('Signup form submitted');
        });
    });

    //date :
    document.addEventListener("DOMContentLoaded", function () {
        const daySelect = document.getElementById("day");
        const monthSelect = document.getElementById("month");
        const yearSelect = document.getElementById("year");

        // Populate days (1 to 31)
        for (let i = 1; i <= 31; i++) {
            let option = document.createElement("option");
            option.value = i;
            option.textContent = i;
            daySelect.appendChild(option);
        }

        // Populate months (January to December)
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

        // Populate years (1900 to current year)
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
