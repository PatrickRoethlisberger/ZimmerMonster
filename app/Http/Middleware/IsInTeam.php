<?php

namespace App\Http\Middleware;

use App\Models\TouristAssociation;
use Closure;
use Illuminate\Http\Request;

class IsInTeam
{
    /**
     * Run the request filter.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  array  $teamtypes
     * @return mixed
     */
    public function handle($request, Closure $next, ...$teamtypes)
    {

        // If teamtypes is empty fill with all available teamtypes
        if(empty($teamtypes)) {
            $teamtypes = ['admin', 'touristassociation', 'hotel'];
        }

        if ( ! $request->user() || empty($request->user()->team) || ! in_array($request->user()->team->type, $teamtypes)) {
            return abort(403, 'FORBIDDEN');
        }

        return $next($request);
    }
}
