# 🛡️ Admin Panel API Documentation
**Project:** Laravel 12 Admin Backend
**Last Updated:** 2025-12-27
**Base URL:** `http://127.0.0.1:8000/api`

---

## 1. Authentication & Account Recovery (Public)
*No Bearer Token required for these endpoints.*

| Endpoint          | Method | Required Fields          | Notes                                                 |
| :---              | :---   | :---                     | :---                                                  |
| `/login`          | `POST` | `email`,`password`       | Throttled (5 attempts/min). Returns `plainTextToken`. |
| `/forgot-password`| `POST` | `email`                  | Sends a reset link/code to the user's email.          |
| `/reset-password` | `POST` | `token`,`email`,`password` | Uses the email token to set a new password.         |

---

## 2. Profile Management (Authenticated)
*Header Required: `Authorization: Bearer {token}`*
*Header Required: `Accept: application/json`*

| Endpoint             | Method| Fields | Purpose                                                       |
| :---                 | :---  | :---   | :---                                                          |
| `/user`              | `GET` | None   | Returns the authenticated Admin's profile data.               |
| `/admin/update`      | `PUT` | `name`,`email`,`address`,`contact_no` | Updates text-based details.    |
| `/admin/update-image`| `POST`| `image`(File) | Updates profile picture (`form-data` required).        |
| `/admin/logout`      | `POST`| None   | Deletes the current token (revokes session).                  |

---

## 3. Administrative Management (Super Admin Only)
*Header Required: `Authorization: Bearer {token}`*
*Middleware: `super_admin`*

| Endpoint      | Method| Params | Description |
| :---          | :---  | :--- | :--- |
| `/admin/list` | `GET` | `?search={query}` | Lists all admins. Searches by **name**, **email**, or **address**. |
| `/admin/delete/{id}`| `DELETE` | `id` (URL) | Deletes admin account. Logic ensures Super Admins can't be deleted by regulars. |

---

## ⚙️ Core System Logic (Technical Notes)

### Middleware: `IsSuperAdmin`
- **Location:** `app/Http/Middleware/IsSuperAdmin.php`
- **Alias:** `super_admin`
- **Logic:** Checks if `auth()->user()->role === 'super_admin'`. Returns `403 Forbidden` if the check fails.

### Data Formatting: `AdminResource`
- All admin data is transformed via `AdminResource`.
- Includes a formatted date: `created_at->format('Y-m-d')`.

### File Storage
- **Images:** Stored in `storage/app/public/admins/`.
- **Access:** Run `php artisan storage:link` to access via `http://127.0.0.1:8000/storage/admins/filename`.