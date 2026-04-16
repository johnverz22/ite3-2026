<h1>Edit Post</h1>
<form action="/ite3/post/update" method="POST">
    <input type="hidden" name="id" value="<?= $post['id'] ?>">
    <div>
        <label>Title:</label><br>
        <input type="text" name="title" value="<?= htmlspecialchars($post['title']) ?>" required>
    </div>
    <br>
    <div>
        <label>Content:</label><br>
        <textarea name="content" rows="5" required><?= htmlspecialchars($post['content']) ?></textarea>
    </div>
    <br>
    <button type="submit">Update Post</button>
</form>

<hr>
<a href="/ite3/home">Cancel</a>