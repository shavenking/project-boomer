<?php

namespace App\Http\Middleware;

use Closure;

class Role
{
    private $repo;

    public function __construct(\App\Repos\Contracts\Project $repo)
    {
        $this->repo = $repo;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        $user = $request->user();
        $project = $this->repo->findOrFail($request->route('projects'));

        if (!$user) {
            abort(403);
        }

        if ('*' !== $role && $this->repo->isRole($user, $project, $role)) {
            return $next($request);
        }

        if ('*' === $role && $this->repo->isUserInProject($user, $project)) {
            return $next($request);
        }

        abort(403);
    }
}
