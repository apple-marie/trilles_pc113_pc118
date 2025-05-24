<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Login</title>
    <link rel="stylesheet" href="login.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container col-md-3 mt-5">
    <div class="login-container">
        <h2 class="login-title text-center">Login</h2>

        <!-- Login Form -->
        <form id="loginForm">

            <!-- Email Field -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required placeholder="Enter your email">
            </div>

            <!-- Password Field -->
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required placeholder="Enter your password">
            </div>

            <!-- Error Message -->
            <p id="errorMessage" class="text-danger text-center"></p>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary w-100">Login</button>

            <!-- Forgot Password Link -->
            <div class="text-center mt-3">
                <a href="forgot_password.php">Forgot Password?</a>
            </div>

            <!-- Signup Link -->
            <p class="text-center mt-3">
                Don't have an account? <a href="">Sign up</a>
            </p>
        </form>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.getElementById('loginForm').addEventListener('submit', function(e){
        e.preventDefault();
        
        localStorage.removeItem('token');
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;

        fetch('http://127.0.0.1:8000/api/users/login', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify({email, password})
        })
        .then(response => response.json())
        .then(data => {
            if (data.token) {
                localStorage.setItem('token', data.token);
                window.location.href = 'dashboard.php';
            } else {
                document.getElementById('errorMessage').textContent = data.message || 'Login failed';
                console.log('Login failed:', data);
            }
        })
        .catch(error => {
            document.getElementById('errorMessage').textContent = 'An error occurred';
            console.error('Error:', error);
        });
    });
</script>

</body>
</html>