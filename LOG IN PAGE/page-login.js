document.getElementById('togglePassword').addEventListener('click', function () {
    const passwordField = document.getElementById('password');
    if (passwordField.type === 'password') {
        passwordField.type = 'text';
        this.textContent = 'Hide';
    } else {
        passwordField.type = 'password';
        this.textContent = 'Show';
    }
});

document.getElementById('loginForm').addEventListener('submit', function (event) {
    event.preventDefault();
    const role = document.getElementById('role').value;
    const password = document.getElementById('password').value;

    // Example password validation (replace with actual validation)
    const credentials = {
        uvics: 'uvicsPassword',
        choir: 'choirPassword',
        senatbem: 'senatbemPassword',
        mapala: 'mapalaPassword',
        uls: 'ulsPassword',
        ikmapap: 'ikmapapPassword',
        FEKON: 'fekonPassword',
        UK: 'ukPassword'
    };

    if (password === credentials[role]) {
        window.location.href = `${role}-editor.html`;
    } else {
        alert('Invalid password. Please try again.');
    }
});
