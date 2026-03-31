<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>DevBlog CMS</title>
    <style>
        body { font-family: sans-serif; line-height: 1.6; padding: 20px; }
        nav { margin-bottom: 20px; border-bottom: 1px solid #ccc; padding-bottom: 10px; }
        nav a { margin-right: 15px; text-decoration: none; color: blue; }
    </style>
</head>
<body>
    <nav>
        <a href="/ite3/home">Home</a>
        <a href="/ite3/post/create">Create Post</a>
    </nav>

    <main>
        <?php echo $content; ?>
    </main>

    <footer>
        <p>&copy; <?php echo date('Y'); ?> DevBlog CMS - Capstone Model</p>
    </footer>
</body>
</html>