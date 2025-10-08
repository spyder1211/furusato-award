<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsApproved
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        // 管理者は承認チェックをスキップ
        if ($user && $user->role === 'admin') {
            return $next($request);
        }

        // 承認されていない場合は承認待ちページにリダイレクト
        if ($user && !$user->is_approved) {
            return redirect()->route('pending-approval')
                ->with('warning', 'アカウントは承認待ちです。承認されるまでお待ちください。');
        }

        return $next($request);
    }
}
