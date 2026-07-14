import { animate, stagger } from 'animejs';

const errorInputs = document.querySelectorAll('.has-error');
if (errorInputs.length > 0) {
    animate(errorInputs, {
        x: [
            { to: -8, duration: 60, ease: 'linear' },
            { to: 8, duration: 60, ease: 'linear' },
            { to: -8, duration: 60, ease: 'linear' },
            { to: 8, duration: 60, ease: 'linear' },
            { to: 0, duration: 60, ease: 'linear' }
        ],
        delay: stagger(100, { start: 200 })
    });
}

const errorMessages = document.querySelectorAll('.error-message');
if (errorMessages.length > 0) {
    animate(errorMessages, {
        opacity: [0, 1],
        y: [-10, 0],
        duration: 400,
        delay: stagger(100, { start: 300 }),
        ease: 'outQuad'
    });
}

// Client-side validation to prevent reload on empty fields
const registerForm = document.querySelector('form');
if (registerForm) {
    registerForm.addEventListener('submit', function(e) {
        let hasError = false;
        
        // Remove existing frontend errors
        document.querySelectorAll('.frontend-error').forEach(el => el.remove());
        document.querySelectorAll('.has-error').forEach(el => {
            el.classList.remove('has-error', '!border-error', '!shadow-[0_0_0_1px_#ba1a1a]');
        });

        const name = document.getElementById('name');
        const email = document.getElementById('email');
        const password = document.getElementById('password');
        const passwordConfirmation = document.getElementById('password_confirmation');

        if (name && !name.value.trim()) {
            showError(name, 'Full Name is required.');
            hasError = true;
        }

        if (email && !email.value.trim()) {
            showError(email, 'Email Address is required.');
            hasError = true;
        }

        if (password && !password.value.trim()) {
            showError(password, 'Password is required.');
            hasError = true;
        }

        if (passwordConfirmation && !passwordConfirmation.value.trim()) {
            showError(passwordConfirmation, 'Please repeat your password.');
            hasError = true;
        } else if (password && passwordConfirmation && password.value !== passwordConfirmation.value) {
            showError(passwordConfirmation, 'Passwords do not match.');
            hasError = true;
        }

        if (hasError) {
            e.preventDefault(); // Stop form submission
            
            const newErrorInputs = document.querySelectorAll('.has-error');
            if (newErrorInputs.length > 0) {
                animate(newErrorInputs, {
                    x: [
                        { to: -8, duration: 60, ease: 'linear' },
                        { to: 8, duration: 60, ease: 'linear' },
                        { to: -8, duration: 60, ease: 'linear' },
                        { to: 8, duration: 60, ease: 'linear' },
                        { to: 0, duration: 60, ease: 'linear' }
                    ],
                    delay: stagger(100)
                });
            }

            const newErrorMessages = document.querySelectorAll('.frontend-error');
            if (newErrorMessages.length > 0) {
                animate(newErrorMessages, {
                    opacity: [0, 1],
                    y: [-10, 0],
                    duration: 400,
                    delay: stagger(100),
                    ease: 'outQuad'
                });
            }
        }
    });
}

function showError(input, message) {
    input.classList.add('has-error', '!border-error', '!shadow-[0_0_0_1px_#ba1a1a]');
    
    const errorDiv = document.createElement('div');
    errorDiv.className = 'error-message frontend-error text-error text-sm mt-2 flex items-center gap-1 font-medium opacity-0';
    errorDiv.innerHTML = `<span class="material-symbols-outlined text-[16px]">error</span> ${message}`;
    
    input.parentElement.appendChild(errorDiv);
}
