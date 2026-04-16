# 🎮 Phase 4: Controllers & View Engines (Refactoring and Forms)

In this phase, we clean up our logic by introducing a **Base Controller** and implement **Form Handling** to create new data.

## 1. The Base Controller (`app/Controllers/Controller.php`)
As our app grows, every controller will need a `render()` method. Instead of copying and pasting it into every controller, we move it to a "Parent" class.
* **Inheritance:** `PostController extends Controller`.
* **DRY (Don't Repeat Yourself):** We write the logic once, and every controller gets it for free.

## 2. Dynamic Views
We are no longer using "Lorem Ipsum" or fake data.
* **Fetching:** The Controller asks the Model for database rows.
* **Looping:** In `home.php`, we use a `foreach` loop to display every post found in the database.
* **Security:** We use `htmlspecialchars()` to prevent **XSS (Cross-Site Scripting)** attacks.

## 3. Handling POST Requests
To add new data, we move from `GET` (viewing) to `POST` (sending).
* **The Route:** We added `$router->post('post/store', ...)` to handle form submissions.
* **The Model:** Added a `create()` method that uses a **Prepared Statement** to safely insert data.
* **The Redirect:** After saving, we use `header('Location: ...')` to send the user back to the homepage. This prevents the "Form Resubmission" error if the user refreshes the page.

---

## 🛠️ Student Checklist: Form Implementation
1.  **Refactor:** Move your `render` method to `app/Controllers/Controller.php`.
2.  **Update View:** In `home.php`, replace your static list with a `foreach` loop.
3.  **Create Form:** In `post-create.php`, ensure your `<form>` tag has `method="POST"` and `action="/ite3/post/store"`.
4.  **Test:** Try adding a post! If it doesn't show up, check your SQL `INSERT` statement in the `Post` model.

---

## ⚠️ Common Troubleshooting
* **Undefined Variable $posts:** Ensure you are passing `'posts' => $posts` in your controller's `render()` method.
* **404 on Store:** Did you register the route in `index.php` using `$router->post` instead of `$router->get`?
* **Empty Database:** If you haven't run the SQL from Phase 3, you won't see anything on the home page.

---

# 🛣️ Phase 5: Routing Refactor

We moved our routes out of `public/index.php` and into `app/routes.php`.

## Why Separate Routes?
*   **Cleaner index.php:** Your entry point should only handle bootstrapping (loading the app).
*   **The Switchboard Pattern:** `app/routes.php` acts as a clear map of every URL your site supports. It’s easier for multiple developers to work on the same project when the routes are in one dedicated file.

## Current Registered Routes:
1.  `GET /home` -> Home Page (Lists all posts)
2.  `GET /post/create` -> The Post Creation Form
3.  `POST /post/store` -> Logic that saves the post to the DB

