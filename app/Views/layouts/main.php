<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DevBlog CMS</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet">
    <!-- External Assets -->
    <link rel="stylesheet" href="/ite3/css/style.css">
</head>
<body>
    <nav>
        <a href="/ite3/home" class="logo">DevBlog CMS</a>
        <div>
            <a href="/ite3/home">Home</a>
            <a href="/ite3/post/create">Create Post</a>
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="/ite3/logout" style="color: #ef4444;">Logout (<?= $_SESSION['username'] ?>)</a>
            <?php else: ?>
                <a href="/ite3/login">Login</a>
            <?php endif; ?>
        </div>
    </nav>

    <div class="container">
        <main>
            <?php echo $content; ?>
        </main>

        <footer>
            <p>&copy; <?php echo date('Y'); ?> DevBlog CMS - Capstone Model</p>
        </footer>
    </div>

    <!-- External JS -->
    <script src="/ite3/js/app.js"></script>
</body>
</html>