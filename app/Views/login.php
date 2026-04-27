<h1>Admin Login</h1>
<p>Please enter your credentials to access the dashboard.</p>

<form action="/ite3/login" method="POST" style="max-width: 400px;">
    <div style="margin-bottom: 1rem;">
        <label>Username:</label><br>
        <input type="text" name="username" style="width: 100%; padding: 0.5rem;" required>
    </div>
    
    <div style="margin-bottom: 1rem;">
        <label>Password:</label><br>
        <input type="password" name="password" style="width: 100%; padding: 0.5rem;" required>
    </div>

    <button type="submit" class="btn">Login</button>
</form>
