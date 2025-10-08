<?php

namespace App\Http\Controllers;

use App\Models\CompanyProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyProfileController extends Controller
{
    /**
     * マイページ（プロフィール編集フォーム表示）
     */
    public function edit()
    {
        $user = Auth::user();

        // 企業アカウントのみアクセス可能
        if ($user->role !== 'company') {
            abort(403, '企業アカウントのみアクセス可能です');
        }

        // プロフィールが存在しない場合は作成
        $profile = $user->companyProfile ?? new CompanyProfile(['user_id' => $user->id]);

        return view('companies.profile.edit', compact('profile'));
    }

    /**
     * プロフィール更新
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        // 企業アカウントのみアクセス可能
        if ($user->role !== 'company') {
            abort(403, '企業アカウントのみアクセス可能です');
        }

        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'description' => 'required|string|max:2000',
            'services' => 'required|string|max:2000',
        ], [
            'company_name.required' => '企業名を入力してください',
            'description.required' => '事業概要を入力してください',
            'services.required' => '提供可能なサービス・技術を入力してください',
        ]);

        // プロフィールが存在しない場合は作成、存在する場合は更新
        $user->companyProfile()->updateOrCreate(
            ['user_id' => $user->id],
            $validated
        );

        return redirect()->route('companies.profile.edit')
            ->with('success', 'プロフィールを更新しました');
    }
}
