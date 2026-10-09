# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

### Added

- Continuous Integration (CI) configuration readiness.

## [0.1.0] - 2026-10-08

### Added

- **Authentication Module**:
  - User registration (`POST /api/v1/auth/register`) with automatic Sanctum token issuance.
  - User login (`POST /api/v1/auth/login`) with credential validation and Bearer token generation.
  - User logout (`POST /api/v1/auth/logout`) with token revocation.
  - Current profile retrieval (`GET /api/v1/auth/me`).

- **User Management Module**:
  - User CRUD endpoints (`GET /api/v1/users`, `GET /api/v1/users/{id}`, `POST /api/v1/users`, `PUT /api/v1/users/{id}`, `DELETE /api/v1/users/{id}`).
  - Role filtering (`admin`, `user`) and keyword search capabilities on user listing.
  - Pagination support with standardized meta output.

- **Architecture & Core Utilities**:
  - Service-Repository pattern implementation (`AuthService`, `UserService`).
  - Standardized JSON API response structure via `ApiResponseTrait`.
  - Request validation using Form Request DTOs (`RegisterRequest`, `LoginRequest`, `StoreUserRequest`, `UpdateUserRequest`).
  - `UserRole` Enum with backed string values and casting on `User` model.
  - Global exception handling in `bootstrap/app.php` with custom JSON formatting for validation and HTTP errors.

- **Security & Middleware**:
  - Laravel Sanctum authentication guard configuration.
  - `EnsureUserIsAdmin` middleware for restricting administrative endpoints.
  - `ForceJsonResponse` middleware to ensure all incoming API requests receive standard JSON responses.
  - Password hashing with `bcrypt`.

- **Infrastructure & High-Performance Support**:
  - FrankenPHP and Laravel Octane integration support.
  - Single-binary Docker setup with `Dockerfile` and `docker-compose.yml`.
  - `Makefile` shortcuts for setup, server start, testing, and container management.

- **Testing & Documentation**:
  - Feature test suite using PHPUnit for Authentication (`AuthTest`) and User CRUD (`UserTest`).
  - Comprehensive API documentation (`API_DOCUMENTATION.md`).
  - Postman Collection (`postman_collection.json`) for API testing.
