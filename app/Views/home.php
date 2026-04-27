<h1>Welcome to the Blog</h1>
<p>Modernized UI with external assets.</p>

<div style="margin-top: 2rem;">
<?php if (empty($posts)): ?>
    <p>No posts found.</p>
<?php else: ?>
    <ul>
        <?php foreach ($posts as $post): ?>
            <li>
                <strong><?= htmlspecialchars($post['title']) ?></strong>
                <p><?= htmlspecialchars($post['content']) ?></p>
                <small>Posted on: <?= $post['created_at'] ?></small>
                
                <div class="actions">
                    <a href="/ite3/post/edit/<?= $post['id'] ?>">Edit</a>
                    <a href="/ite3/post/delete/<?= $post['id'] ?>" class="delete" onclick="return confirm('Are you sure?')">Delete</a>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
</div>