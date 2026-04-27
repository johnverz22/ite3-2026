# 🏗️ Phase 10: The Service Layer Pattern

In this phase, we refactor our application to support more complex business logic by introducing **Services**.

## 1. Why use a Service Layer?
As applications grow, **Controllers** often become cluttered with logic that doesn't belong there.
- **Controller's Job:** Receive request, talk to Service, return View.
- **Service's Job:** Perform calculations, generate slugs, send emails, process payments.
- **Model's Job:** Execute SQL queries.

## 2. Feature: Auto-Generated Slugs
We no longer just store a title and content. Every post now has a **Slug** (a URL-safe version of the title).
- **Automation:** The user types a title, and our `PostService` automatically converts it (e.g., "Hello World!" -> "hello-world").
- **Consistency:** By centralizing this logic in a Service, we ensure that slugs are always formatted the same way across the entire site.

## 3. The Refactoring Flow
1. **Model:** We update the `Post` model to accept a `slug` parameter in `create()` and `update()`.
2. **Service:** We create `PostService::generateSlug()` to handle the string manipulation.
3. **Controller:** We call the service in the `store()` method to get the slug before passing it to the model.

---

## 🛠️ Student Checklist: Architectural Refactoring
1.  **Modularize:** Create the `app/Services` directory.
2.  **Decouple:** Remove any "logic" (like string manipulation) from your `PostController`.
3.  **Validate:** Ensure that every new post has a valid slug in the database.
4.  **UX:** Use the slug in your URLs (Advanced: e.g., `/ite3/post/my-first-post` instead of `/ite3/post/5`).
