<h1>Welcome to the Blog</h1>
<p>This content is being loaded from the database!</p>

<a href="/ite3/post/create">Add New Post</a>

<hr>

<?php if (empty($posts)): ?>
    <p>No posts found.</p>
<?php else: ?>
    <ul>
        <?php foreach ($posts as $post): ?>
            <li>
                <strong><?= htmlspecialchars($post['title']) ?></strong>
                <p><?= htmlspecialchars($post['content']) ?></p>
                <small>Posted on: <?= $post['created_at'] ?></small>
            </li>
            <hr>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>