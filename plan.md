## Plan: PHP Blog Architecture Improvement Strategy

Your project follows a solid MVC foundation but has architectural inconsistencies and critical security gaps. This plan prioritizes quick wins and foundational improvements for a scalable, secure application.

### Phase 1: Critical Security & Functionality Fixes (Start Here)
1. **Complete Authentication** - Implement actual login validation and session tracking in [AuthController](src/Controllers/AuthController.php)
2. **Fix XSS Vulnerability** - Add `htmlspecialchars()` escaping in all view templates
3. **Implement CSRF Protection** - Add token generation/validation to forms
4. **Add Authorization Checks** - Verify users can only edit/delete their own posts in [PostController](src/Controllers/PostController.php)

### Phase 2: Improve Code Organization
1. **Extract Validation Layer** - Create `src/Validators/` directory with `UserValidator`, `PostValidator` classes to centralize validation rules
2. **Create Base Model Class** - Define contract for `findById()`, `create()`, `update()`, `delete()` in `src/Models/BaseModel.php`
3. **Standardize Database Queries** - Use consistent placeholder style (all named or all positional) across [UserModel](src/Models/UserModel.php) and [PostModel](src/Models/PostModel.php)
4. **Implement View Abstraction** - Create `View` class instead of raw `require` statements to prevent variable scope pollution

### Phase 3: Refactor Error Handling & Logging
1. **Create Exception Hierarchy** - `ValidationException`, `NotFoundException`, `AuthenticationException` in `src/Exceptions/`
2. **Unify Error Handling** - Replace scattered `die()`, return-false, and redirect patterns with consistent exception throwing
3. **Add Logging Service** - Simple file-based logger in `src/Services/LoggerService.php`

### Phase 4: Dependency Injection & Routing
1. **Build Simple DI Container** - `src/Config/ServiceContainer.php` to manage object instantiation instead of hardcoding in `public/index.php`
2. **Improve Router** - Make [Router.php](src/Config/Router.php) extract URL parameters (e.g., `/post/{id}`) instead of requiring pre-calculation

### Further Considerations
1. **Which phase matters most?** If shipping quickly is priority → Phase 1 (security). If refactoring existing code → Phase 2 (organization).
2. **Testing strategy?** Current code resists unit testing; address after Phase 2 separation of concerns.
3. **Database migrations?** Add schema versioning only if planning frequent schema changes; currently static schema works.2