<?php

namespace App\Http\Middleware\Access;

use App\Accessors\ProjectAccessor;
use App\Models\Project;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Class CheckProjectOwner
 * @package App\Http\Middleware\Access
 */
class CheckProjectOwner
{
    /**
     * Project accessor instance
     * @var ProjectAccessor
     */
    protected $accessor;

    /**
     * CheckProjectOwner constructor.
     * @param ProjectAccessor $accessor
     */
    public function __construct(ProjectAccessor $accessor)
    {
        $this->accessor = $accessor;
    }

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param  Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /**
         * @var User $user
         */
        $user = auth()->user();
        /**
         * @var Project $project
         */
        $project = $request->route('project');

        if (!$this->accessor->check($user, $project)) {
            abort(Response::HTTP_FORBIDDEN);
        }

        $next = $next($request);
        return $next;
    }
}
