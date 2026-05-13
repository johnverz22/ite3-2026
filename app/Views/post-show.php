<h1><?= htmlspecialchars($post['title']) ?></h1>
<p style="color: var(--primary);">Slug: <?= htmlspecialchars($post['slug']) ?></p>

<div style="margin-top: 2rem; margin-bottom: 2rem;">
    <p><?= nl2br(htmlspecialchars($post['content'])) ?></p>
</div>

<small>Posted on: <?= $post['created_at'] ?></small>

<hr>
<a href="/ite3/home">Back to Home</a>
