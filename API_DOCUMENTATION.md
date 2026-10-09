# 📖 Laravel Backend API Documentation

API Base URL: `http://127.0.0.1:8000/api`

---

## 🛠️ General Headers

For all API requests, include the following HTTP headers:

| Header | Value | Description |
| :--- | :--- | :--- |
| `Accept` | `application/json` | Ensures JSON response format |
| `Content-Type` | `application/json` | Required for `POST`, `PUT`, `PATCH` requests |
| `Authorization` | `Bearer {your_token_here}` | Required for protected endpoints |

---

## 🟢 1. System Health Check

### `GET /health`
Returns system status, environment details, and database connectivity state.

**Response `200 OK`**:
```json
{
  "success": true,
  "message": "API Health Status Check",
  "data": {
    "status": "healthy",
    "app_name": "Laravel",
    "environment": "local",
    "php_version": "8.2.28",
    "laravel": "12.x",
    "database": "OK",
    "timestamp": "2026-10-08T21:25:00+00:00"
  }
}
```

---

## 🔐 2. Authentication Endpoints

### `POST /v1/auth/register`
Register a new user account and obtain an API access token.

**Request Body**:
```json
{
  "name": "John Doe",
  "email": "john@example.com",
  "phone": "+6281234567890",
  "password": "password123",
  "password_confirmation": "password123"
}
```

**Response `201 Created`**:
```json
{
  "success": true,
  "message": "User registered successfully",
  "data": {
    "user": {
      "id": 1,
      "name": "John Doe",
      "email": "john@example.com",
      "phone": "+6281234567890",
      "avatar": null,
      "role": "user",
      "role_label": "Standard User",
      "is_active": true,
      "email_verified_at": null,
      "created_at": "2026-10-08T21:25:00Z",
      "updated_at": "2026-10-08T21:25:00Z"
    },
    "access_token": "1|token_string_here",
    "token_type": "Bearer"
  }
}
```

---

### `POST /v1/auth/login`
Authenticate existing user and obtain Bearer token.

**Request Body**:
```json
{
  "email": "admin@boilerplate.com",
  "password": "password123"
}
```

**Response `200 OK`**:
```json
{
  "success": true,
  "message": "Login successful",
  "data": {
    "user": {
      "id": 1,
      "name": "Super Administrator",
      "email": "admin@boilerplate.com",
      "phone": "+6281234567890",
      "role": "admin",
      "role_label": "Administrator",
      "is_active": true
    },
    "access_token": "2|token_string_here",
    "token_type": "Bearer"
  }
}
```

---

### `GET /v1/auth/me` *(Protected)*
Fetch profile data for the authenticated user.

**Response `200 OK`**:
```json
{
  "success": true,
  "message": "User profile retrieved successfully",
  "data": {
    "id": 1,
    "name": "Super Administrator",
    "email": "admin@boilerplate.com",
    "phone": "+6281234567890",
    "role": "admin",
    "role_label": "Administrator",
    "is_active": true
  }
}
```

---

### `PUT /v1/auth/profile` *(Protected)*
Update logged-in user profile attributes.

**Request Body**:
```json
{
  "name": "Super Admin Updated",
  "phone": "+6281234567899"
}
```

---

### `PUT /v1/auth/change-password` *(Protected)*
Change password for currently authenticated user.

**Request Body**:
```json
{
  "current_password": "password123",
  "new_password": "newpassword123",
  "new_password_confirmation": "newpassword123"
}
```

---

### `POST /v1/auth/logout` *(Protected)*
Revoke current active token.

**Response `200 OK`**:
```json
{
  "success": true,
  "message": "Logged out successfully",
  "data": null
}
```

---

## 👥 3. User Management Endpoints *(Protected)*

### `GET /v1/users`
List users with pagination, keyword search, role filtering, and sorting.

**Query Parameters**:
- `page` (int, default: 1)
- `per_page` (int, default: 15, max: 100)
- `search` (string, optional) - searches in `name`, `email`, `phone`
- `role` (string, optional: `admin` | `user`)
- `is_active` (boolean, optional: `true` | `false`)
- `sort_by` (string, optional: `id` | `name` | `email` | `created_at`)
- `sort_dir` (string, optional: `asc` | `desc`)

**Response `200 OK`**:
```json
{
  "success": true,
  "message": "Users list retrieved successfully",
  "data": [
    {
      "id": 1,
      "name": "Super Administrator",
      "email": "admin@boilerplate.com",
      "phone": "+6281234567890",
      "role": "admin",
      "role_label": "Administrator",
      "is_active": true
    }
  ],
  "meta": {
    "current_page": 1,
    "last_page": 2,
    "per_page": 10,
    "total": 17
  },
  "links": {
    "first": "...",
    "last": "...",
    "prev": null,
    "next": "..."
  }
}
```

---

### `POST /v1/users`
Create a new user.

---

### `GET /v1/users/{id}`
Retrieve user details by ID.

---

### `PUT /v1/users/{id}`
Update user details by ID.

---

### `DELETE /v1/users/{id}`
Delete a user and revoke all their tokens.

---

## ⚠️ Standardized Error Response Format

### Validation Error `422 Unprocessable Entity`
```json
{
  "success": false,
  "message": "The given data was invalid.",
  "errors": {
    "email": [
      "The email has already been taken."
    ]
  }
}
```

### Unauthorized `401 Unauthorized`
```json
{
  "success": false,
  "message": "Unauthenticated"
}
```

### Forbidden `403 Forbidden`
```json
{
  "success": false,
  "message": "Access forbidden"
}
```

### Not Found `404 Not Found`
```json
{
  "success": false,
  "message": "The requested endpoint or resource was not found."
}
```
