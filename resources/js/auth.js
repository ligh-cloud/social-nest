document.addEventListener('DOMContentLoaded', function() {
    // Create background spans
    const section = document.querySelector('section');
    for(let i = 0; i < 200; i++) {
        const span = document.createElement('span');
        section.appendChild(span);
    }

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
    if (passwordInput) {
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
    }

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

    // Alert functionality
    setupAlerts();
});

// Function to get URL parameters (for query string flash messages)
function getUrlParam(name) {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get(name);
}

// Function to show alert
function showAlert(message, type) {
    const alertContainer = document.getElementById('alert-container');
    const alertBox = document.getElementById('alert-box');
    const alertIcon = document.getElementById('alert-icon');
    const alertMessage = document.getElementById('alert-message');

    // Set message
    alertMessage.textContent = message;

    // Set style based on type
    if (type === 'success') {
        alertBox.style.backgroundColor = '#4CAF50';
        alertBox.style.color = 'white';
        alertIcon.className = 'fas fa-check-circle';
    } else if (type === 'error') {
        alertBox.style.backgroundColor = '#F44336';
        alertBox.style.color = 'white';
        alertIcon.className = 'fas fa-exclamation-circle';
    } else if (type === 'warning') {
        alertBox.style.backgroundColor = '#FF9800';
        alertBox.style.color = 'white';
        alertIcon.className = 'fas fa-exclamation-triangle';
    } else if (type === 'info') {
        alertBox.style.backgroundColor = '#2196F3';
        alertBox.style.color = 'white';
        alertIcon.className = 'fas fa-info-circle';
    }

    // Show alert
    alertContainer.style.display = 'block';

    // Auto hide after 5 seconds
    setTimeout(hideAlert, 5000);
}

function hideAlert() {
    const alertContainer = document.getElementById('alert-container');
    alertContainer.style.animation = 'slideUp 0.3s ease-out forwards';
    setTimeout(() => {
        alertContainer.style.display = 'none';
        alertContainer.style.animation = '';
    }, 300);
}

function setupAlerts() {
    // Check for Laravel flash messages in the page

    // Option 1: Check for message in session (Laravel stores flash data in HTML)
    const sessionMessage = document.getElementById('session-message');
    const sessionError = document.getElementById('session-error');

    if (sessionMessage && sessionMessage.value) {
        showAlert(sessionMessage.value, 'success');
    }

    if (sessionError && sessionError.value) {
        showAlert(sessionError.value, 'error');
    }

    // Option 2: Check for Laravel flash message passed as JSON
    // This works with Laravel's response()->json(['message' => 'Success'])
    if (typeof laravelFlashMessage !== 'undefined' && laravelFlashMessage) {
        showAlert(laravelFlashMessage, 'success');
    }

    if (typeof laravelFlashError !== 'undefined' && laravelFlashError) {
        showAlert(laravelFlashError, 'error');
    }

    // Option 3: Check for message in URL
    // For redirect()->with('message', 'text')->withInput() cases
    const urlMessage = getUrlParam('message');
    if (urlMessage) {
        showAlert(decodeURIComponent(urlMessage), 'success');
    }

    const urlError = getUrlParam('error');
    if (urlError) {
        showAlert(decodeURIComponent(urlError), 'error');
    }
}

// Make hideAlert globally accessible
window.hideAlert = hideAlert;
