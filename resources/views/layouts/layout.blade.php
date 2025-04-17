    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SocialNest - @yield('title', 'Home')</title>
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
        <script src="https://cdn.tailwindcss.com"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
        <style>
            body {
                    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            }
            .active-tab {
                color: #1877F2;
                border-bottom: 3px solid #1877F2;
            }
            .nav-item:hover {
                background-color: #F0F2F5;
                border-radius: 8px;
            }
            .post-input:focus {
                outline: none;
            }

            /* Mobile menu animation */
            .mobile-menu {
                transition: transform 0.3s ease-in-out;
                transform: translateX(-100%);
            }
            .mobile-menu.active {
                transform: translateX(0);
            }

            /* Overlay for mobile menu */
            .menu-overlay {
                background-color: rgba(0, 0, 0, 0.5);
                opacity: 0;
                visibility: hidden;
                transition: opacity 0.3s ease-in-out;
            }
            .menu-overlay.active {
                opacity: 1;
                visibility: visible;
            }
        </style>
        @stack('styles')
    </head>
    <body class="bg-gray-100">

    @include('partials.header')

    <!-- Main Content -->
    <div class="w-full lg:w-3/5 lg:ml-[20%] p-4">
        @yield('content')
    </div>

    @include('partials.footer')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mobile menu functionality
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const closeMenuButton = document.getElementById('close-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');
            const menuOverlay = document.getElementById('menu-overlay');

            function openMobileMenu() {
                mobileMenu.classList.add('active');
                menuOverlay.classList.add('active');
                document.body.style.overflow = 'hidden'; // Prevent scrolling
            }

            function closeMobileMenu() {
                mobileMenu.classList.remove('active');
                menuOverlay.classList.remove('active');
                document.body.style.overflow = 'auto'; // Re-enable scrolling
            }

            mobileMenuButton.addEventListener('click', openMobileMenu);
            closeMenuButton.addEventListener('click', closeMobileMenu);
            menuOverlay.addEventListener('click', closeMobileMenu);

            // Navigation item click handler
            const navItems = document.querySelectorAll('.nav-item');
            navItems.forEach(item => {
                item.addEventListener('click', function() {
                    // For mobile: close the menu when a navigation item is clicked
                    if (window.innerWidth < 1024) {
                        closeMobileMenu();
                    }

                    // You could add active state handling here
                    navItems.forEach(nav => nav.classList.remove('active'));
                    this.classList.add('active');
                });
            });

            // Tab navigation functionality
            const tabButtons = document.querySelectorAll('.flex.space-x-12 button');
            tabButtons.forEach(button => {
                button.addEventListener('click', function() {
                    tabButtons.forEach(btn => {
                        btn.classList.remove('active-tab');
                        btn.classList.add('text-gray-500');
                    });
                    this.classList.add('active-tab');
                    this.classList.remove('text-gray-500');
                });
            });

            // Like, comment, share button interactions
            const actionButtons = document.querySelectorAll('.flex.justify-between.text-gray-500 button');
            actionButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Toggle active state
                    this.classList.toggle('text-blue-500');

                    // If this is a like button, you could increment/decrement the count
                    if (this.querySelector('.fa-thumbs-up')) {
                        const likeText = this.querySelector('span');
                        const currentText = likeText.textContent;
                        const match = currentText.match(/Like \((\d+)\)/);

                        if (match) {
                            const currentCount = parseInt(match[1]);
                            const isLiked = this.classList.contains('text-blue-500');
                            const newCount = isLiked ? currentCount + 1 : currentCount - 1;
                            likeText.textContent = `Like (${newCount})`;
                        }
                    }
                });
            });

            // Post input focus effect
            const postInput = document.querySelector('.post-input');
            postInput.addEventListener('focus', function() {
                this.parentElement.classList.add('ring-2', 'ring-blue-300');
            });

            postInput.addEventListener('blur', function() {
                this.parentElement.classList.remove('ring-2', 'ring-blue-300');
            });

            // Window resize handler for mobile menu
            window.addEventListener('resize', function() {
                if (window.innerWidth >= 1024 && mobileMenu.classList.contains('active')) {
                    closeMobileMenu();
                }
            });
        });
    </script>
    @stack('scripts')
    </body>
    </html>
