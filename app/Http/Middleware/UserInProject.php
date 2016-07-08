<?php

namespace App\Http\Middleware;

use Closure;
use App\Repos\Contracts\Project;

class UserInProject
{
    private $repo;

    public function __construct(Project $repo)
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
    public function handle($request, Closure $next)
    {
        $user = $request->user();
        $project = $this->repo->findOrFail($request->route('projects'));

        if (
            !$user
            || !$this->repo->isUserInProject($request->user(), $project)
        ) {
            abort(403);
        }

        return $next($request);
    }
}
