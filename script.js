document.addEventListener('DOMContentLoaded', function() {
    const container = document.getElementById('container');
    const registerBtn = document.getElementById('register');
    const loginBtn = document.getElementById('login');

    registerBtn.addEventListener('click', () => {
        container.classList.add("active");
    });

    loginBtn.addEventListener('click', () => {
        container.classList.remove("active");
    });

    document.getElementById('sign-up-form').addEventListener('submit', function(event) {
        event.preventDefault();
        const name = this.querySelector('input[placeholder="Name"]').value;
        const email = this.querySelector('input[placeholder="Email"]').value;
        const password = this.querySelector('input[placeholder="Password"]').value;

        const users = JSON.parse(localStorage.getItem('users')) || [];
        const userExists = users.some(user => user.email === email);

        if (!userExists) {
            users.push({ name, email, password, ads: [] });
            localStorage.setItem('users', JSON.stringify(users));
            window.location.href = "dashboard.html"; // استبدل بالرابط الفعلي لصفحة لوحة التحكم
        } else {
            alert('This email is already registered. Please sign in.');
        }
    });

    document.getElementById('sign-in-form').addEventListener('submit', function(event) {
        event.preventDefault();
        const email = this.querySelector('input[placeholder="Email"]').value;
        const password = this.querySelector('input[placeholder="Password"]').value;

        const users = JSON.parse(localStorage.getItem('users')) || [];
        const user = users.find(user => user.email === email && user.password === password);

        if (user) {
            window.location.href = "dashboard.html"; // استبدل بالرابط الفعلي لصفحة لوحة التحكم
        } else {
            alert('Invalid email or password. Please try again.');
        }
    });
});
