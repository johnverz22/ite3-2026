<h1>Create a New Post</h1>

<form action="/ite3/post/store" method="POST">
    <div>
        <label for="title">Title:</label><br>
        <input type="text" id="title" name="title" required>
    </div>
    <br>
    <div>
        <label for="content">Content:</label><br>
        <textarea id="content" name="content" rows="5" required></textarea>
    </div>
    <br>
    <button type="submit">Publish Post</button>
</form>

<hr>
<a href="/ite3/home">Back to Home</a>