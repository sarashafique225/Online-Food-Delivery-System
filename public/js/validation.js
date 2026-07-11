function validateRegistrationForm() {
    let isValid = true;

    // Clear previous errors
    document.querySelectorAll('.error-msg').forEach(el => el.textContent = '');

    const name = document.getElementById('name').value.trim();
    const email = document.getElementById('email').value.trim();
    const password = document.getElementById('password').value;

    if(name.length < 3) {
        document.getElementById('name-error').textContent = 'Name must be at least 3 characters';
        isValid = false;
    }
    if(!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
        document.getElementById('email-error').textContent = 'Enter a valid email address';
        isValid = false;
    }
    if(password.length < 8) {
        document.getElementById('password-error').textContent = 'Password must be 8+ characters';
        isValid = false;
    }
    return isValid;
}
