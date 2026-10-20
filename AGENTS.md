# AGENTS.md

## Running the app (Base44 sandbox)

    docker compose -f docker-compose.base44.yml up -d --build

Laravel 8 served from the cloned source on host port **3000**; `/` redirects to the
students list (`/students`). `db` is MySQL 8; the one-shot `migrate` service runs
`composer install` + `php artisan migrate` and `web` waits for it to finish.

Live editing: `php artisan serve` interprets PHP per request, so edits to routes,
controllers and Blade views show up on the next page load — no watcher or restart.
Composer dependencies install into the bind-mounted `vendor/` at container startup
(never baked into the image), so `composer.json`/`composer.lock` changes need a
`docker compose -f docker-compose.base44.yml restart web`.

## Non-obvious findings

- **Front-end assets are committed build output.** `public/css/app.css` and
  `public/js/app.js` are checked in, so the app renders without running Laravel Mix.
  Do not `npm install` for a normal setup: the toolchain is Mix 5 + `node-sass@5`, which
  cannot build on modern Node images (needs Node 14). Rebuild assets only if
  `resources/js` or `resources/sass` change.
- **`artisan serve` must run with `--no-reload`.** Without it, Laravel unsets every
  variable it finds in the process environment before spawning the server process, which
  silently drops all configuration injected through `env_file` (APP_KEY, DB_*, APP_URL)
  and makes every page fail with "No application encryption key has been specified."
- **APP_KEY is generated in the sandbox, not taken from the placeholder secret.** Laravel
  only accepts a 16- or 32-byte key (`base64:...`, as produced by
  `php artisan key:generate --show`); the platform placeholder is a generic random string
  and is rejected. The `web` startup command therefore keeps a valid development key in the
  `app-key` volume and only falls back to it when the `APP_KEY` in the secrets file is not
  in `base64:` form — a real key supplied through the dashboard wins and survives restarts.
- **Compose interpolates `$` inside command strings.** Shell variables in a compose
  `command:`/`healthcheck:` must be escaped as `$$KEY` or compose replaces them with the
  (empty) host-side value — this cost the first version of the healthcheck and startup script.
- **No `.env` file is used in the sandbox.** Configuration arrives as real environment
  variables: non-secret defaults in `.env.base44-defaults`, secrets (APP_KEY) from
  `/run/base44/app.env`, both wired through compose `env_file` (secrets last so they win).
  Laravel's `env()` reads the process environment, so nothing copies `.env.example`.
- **URL generation is proxy-sensitive.** The preview reaches the app over public HTTPS
  while the container speaks plain HTTP, so `AppServiceProvider::boot()` forces
  `URL::forceRootUrl(config('app.url'))` + `URL::forceScheme('https')` *only* when
  `BASE44_PREVIEW_MODE` is exactly `"1"`. With the variable unset, behaviour is unchanged.
- `TrustHosts` is commented out in `app/Http/Kernel.php`, so the proxy's `Host` header is
  accepted as-is — no host allowlist to maintain.
- Database: migrations create `students`, `lecturers`, `degrees`, `courses` and the pivot
  tables (`degree_student`, `degree_lecturer`, `course_degree`); `DatabaseSeeder` is empty,
  and the "enrolled" pages only show rows when pivot records exist.
- Existing dead code left untouched (not needed to run): `/students/index` renders a
  missing view (`students.blade.php`), the `create/show/edit/update/store` actions of the
  resource controllers are empty stubs, and `StudentController::boot()` never runs.
- **`public/js/app.js` is a broken build artifact: leave it non-executing.**
  The committed bundle was built from a failed compile — the `resources/sass/app.scss`
  module is baked in as an error module (its line 11 imports
  `~node_modules/font-awesome/scss/font-awesome.scss`, a path that does not resolve), so
  merely *executing* it throws `Module build failed … SassError: Can't find stylesheet to
  import` in the console even though the page renders. `layout.blade.php` therefore keeps
  `type="text/js"` on the `js/app.js` tag, which makes the browser skip it entirely; no
  page needs jQuery. Fixing this properly means rebuilding the assets on Node 14
  (Mix 5 + node-sass@5) with that import corrected to `~font-awesome/scss/font-awesome.scss`.
  CSS and fonts are unaffected — `public/css/app.css` is a complete, working build.
- The students page used to pull DataTables from a CDN before any jQuery existed and then
  call `$('.table-data').DataTable()` on a selector that is absent from the markup. That
  block was dead code and the source of the `$ is not defined` console error, so it was
  removed; the table renders exactly as before (sorting/search were never active).
- The tables are not responsive (8 columns, no `.table-responsive` wrapper), so the page
  scrolls sideways on phone-width viewports.

## Verification

- `curl -fsS http://localhost:3000/students | grep -i 'Students Enrolled'`
- `docker compose -f docker-compose.base44.yml ps` — `web` and `db` healthy.
- A handful of demo students/degrees/courses/lecturers was inserted once through a
  throwaway script (in `/tmp`, not the repo); reset with
  `docker compose -f docker-compose.base44.yml exec web php artisan migrate:fresh --seed`.
