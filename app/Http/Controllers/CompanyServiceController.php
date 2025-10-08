<?php

namespace App\Http\Controllers;

use App\Models\CompanyService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyServiceController extends Controller
{
    /**
     * 自分の投稿サービス一覧
     */
    public function index()
    {
        $user = Auth::user();

        // 企業アカウントのみアクセス可能
        if ($user->role !== 'company') {
            abort(403, '企業アカウントのみアクセス可能です');
        }

        $services = $user->companyServices()
            ->latest()
            ->paginate(20);

        return view('companies.services.index', compact('services'));
    }

    /**
     * 新規投稿フォーム
     */
    public function create()
    {
        $user = Auth::user();

        // 企業アカウントのみアクセス可能
        if ($user->role !== 'company') {
            abort(403, '企業アカウントのみアクセス可能です');
        }

        return view('companies.services.create');
    }

    /**
     * サービス投稿
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        // 企業アカウントのみアクセス可能
        if ($user->role !== 'company') {
            abort(403, '企業アカウントのみアクセス可能です');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|in:観光振興,子育て支援,DX推進,インフラ整備,地域活性化,環境・エネルギー,その他',
            'description' => 'required|string|max:3000',
            'case_studies' => 'nullable|string|max:2000',
            'strengths' => 'nullable|string|max:2000',
            'status' => 'required|in:draft,published',
        ], [
            'title.required' => 'タイトルを入力してください',
            'category.required' => 'カテゴリを選択してください',
            'description.required' => 'サービス・技術の詳細を入力してください',
            'status.required' => '公開ステータスを選択してください',
        ]);

        $service = $user->companyServices()->create($validated);

        return redirect()->route('companies.services.index')
            ->with('success', 'サービスを投稿しました');
    }

    /**
     * 編集フォーム
     */
    public function edit($id)
    {
        $user = Auth::user();

        // 企業アカウントのみアクセス可能
        if ($user->role !== 'company') {
            abort(403, '企業アカウントのみアクセス可能です');
        }

        $service = CompanyService::findOrFail($id);

        // 自分の投稿のみ編集可能
        if ($service->user_id !== $user->id) {
            abort(403, '他のユーザーの投稿は編集できません');
        }

        return view('companies.services.edit', compact('service'));
    }

    /**
     * サービス更新
     */
    public function update(Request $request, $id)
    {
        $user = Auth::user();

        // 企業アカウントのみアクセス可能
        if ($user->role !== 'company') {
            abort(403, '企業アカウントのみアクセス可能です');
        }

        $service = CompanyService::findOrFail($id);

        // 自分の投稿のみ更新可能
        if ($service->user_id !== $user->id) {
            abort(403, '他のユーザーの投稿は更新できません');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|in:観光振興,子育て支援,DX推進,インフラ整備,地域活性化,環境・エネルギー,その他',
            'description' => 'required|string|max:3000',
            'case_studies' => 'nullable|string|max:2000',
            'strengths' => 'nullable|string|max:2000',
            'status' => 'required|in:draft,published',
        ], [
            'title.required' => 'タイトルを入力してください',
            'category.required' => 'カテゴリを選択してください',
            'description.required' => 'サービス・技術の詳細を入力してください',
            'status.required' => '公開ステータスを選択してください',
        ]);

        $service->update($validated);

        return redirect()->route('companies.services.index')
            ->with('success', 'サービスを更新しました');
    }

    /**
     * サービス削除
     */
    public function destroy($id)
    {
        $user = Auth::user();

        // 企業アカウントのみアクセス可能
        if ($user->role !== 'company') {
            abort(403, '企業アカウントのみアクセス可能です');
        }

        $service = CompanyService::findOrFail($id);

        // 自分の投稿のみ削除可能
        if ($service->user_id !== $user->id) {
            abort(403, '他のユーザーの投稿は削除できません');
        }

        $service->delete();

        return redirect()->route('companies.services.index')
            ->with('success', 'サービスを削除しました');
    }
}
