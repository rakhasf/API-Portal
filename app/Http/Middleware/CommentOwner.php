<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CommentOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        $comment = Comment::findOrFail($request->id);
        
        if ($comment->user_id != $user->id){
            return respone()->json([
                'message' => 'data not found'
            ], 404);
        }

        return $next($request);
    }
}
