# AI Agent Reminder: Do Not Interrupt `php artisan serve`

## Important

**Never** kill or interrupt a running `php artisan serve` process when performing AI agent tasks.

### Why This Matters

- `php artisan serve` provides the development server for Laravel applications
- Interrupting it causes the server to stop, requiring manual restart
- This breaks the user's workflow and delays development
- The AI agent should be aware of running processes and avoid actions that terminate them

### Guidelines

1. **Check for running processes** before starting any task that might affect the terminal/process environment
2. **Avoid** sending signals or commands that could terminate the PHP development server
3. **Be cautious** with commands that modify `.env`, configuration files, or restart processes
4. **Ask the user** if unsure whether a task might interfere with their development environment
5. **Preserve** any running `php artisan serve` process unless explicitly asked to stop it

### How to Check

If you need to verify whether `php artisan serve` is running, you can check the process list, but the safest approach is to simply assume it might be running and act accordingly.

---

*This reminder was added because the AI agent previously interrupted a running `php artisan serve` process. Please keep this in mind for all future interactions.*