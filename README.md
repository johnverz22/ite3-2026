# ✅ Phase 9: Input Validation & Helpers

In this phase, we add a layer of protection to our forms to ensure data integrity and improve user experience.

## 1. The Validator Helper
We've introduced a **Helper Class** located in `app/Helpers/Validator.php`. Helpers are "Utility" classes that provide static methods for common tasks.
- **Static Methods:** You don't need to instantiate the class (`new Validator`). You just call `Validator::required()`.
- **Reusability:** The same validation rules can be used in the `PostController`, `AuthController`, or any future controller.

## 2. Error Feedback Loop
A good application never leaves the user guessing.
1. **The Guard:** The Controller uses the Helper to check inputs.
2. **The Halt:** If a check fails, the Controller skips the Database call.
3. **The Feedback:** The Controller passes an `$errors` array back to the View.
4. **The UI:** The View checks for errors and highlights them for the user.

## 3. Sanitization vs. Validation
- **Validation:** "Is this data in the right format?" (e.g., Is the title empty?)
- **Sanitization:** "Is this data safe to display?" (We already handle this using `htmlspecialchars()` in our views).

---

## 🛠️ Student Checklist: Quality Control
1.  **Centralize:** Move all "empty check" logic into the `Validator` class.
2.  **Integrate:** Update `PostController@store` to use the new Validator.
3.  **UI Feedback:** Ensure every required field has a corresponding error display in the HTML form.
4.  **UX Polish:** Ensure the user doesn't lose their valid input if only one field has an error (Advanced).
