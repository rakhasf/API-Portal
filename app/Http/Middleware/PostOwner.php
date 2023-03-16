<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PostOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $currentUser = Auth::user();
        $post = Post::findOrFail($request->id);

        if ($post -> author != $currentUser->id) {
            return response()->json([
                'message' => 'data not found'
            ], 404);

            return repsonse()->json($currentUser);
        }

        return $next($request);
    }
}
