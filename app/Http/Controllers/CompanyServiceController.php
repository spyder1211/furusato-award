<?php

namespace App\Http\Controllers;

use App\Models\CompanyService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyServiceController extends Controller
{
    /**
     * 公開サービス一覧（全ユーザー閲覧可能）
     */
    public function publicIndex(Request $request)
    {
        $query = CompanyService::with(['user.companyProfile', 'category'])
            ->where('status', 'published');

        // カテゴリフィルター
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        $services = $query->latest()->paginate(20)->withQueryString();

        // カテゴリ一覧（有効なもののみ）
        $categories = \App\Models\Category::active()->ordered()->get();

        return view('services.index', compact('services', 'categories'));
    }

    /**
     * サービス詳細表示（全ユーザー閲覧可能）
     */
    public function show($id)
    {
        $service = CompanyService::with(['user.companyProfile', 'category'])
            ->where('status', 'published')
            ->findOrFail($id);

        $user = Auth::user();

        // 自治体アカウントの場合、既にオファー済みかチェック
        $alreadyOffered = false;
        if ($user && $user->role === 'municipality') {
            $alreadyOffered = \App\Models\CompanyOffer::where('service_id', $service->id)
                ->where('municipality_user_id', $user->id)
                ->exists();
        }

        return view('services.show', compact('service', 'alreadyOffered'));
    }

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
            ->with('category')
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

        // カテゴリ一覧（有効なもののみ）
        $categories = \App\Models\Category::active()->ordered()->get();

        return view('companies.services.create', compact('categories'));
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
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string|max:3000',
            'case_studies' => 'nullable|string|max:2000',
            'strengths' => 'nullable|string|max:2000',
            'status' => 'required|in:draft,published',
        ], [
            'title.required' => 'タイトルを入力してください',
            'category_id.required' => 'カテゴリを選択してください',
            'category_id.exists' => '選択されたカテゴリは存在しません',
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

        $service = CompanyService::with('category')->findOrFail($id);

        // 自分の投稿のみ編集可能
        if ($service->user_id !== $user->id) {
            abort(403, '他のユーザーの投稿は編集できません');
        }

        // カテゴリ一覧（有効なもののみ）
        $categories = \App\Models\Category::active()->ordered()->get();

        return view('companies.services.edit', compact('service', 'categories'));
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
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string|max:3000',
            'case_studies' => 'nullable|string|max:2000',
            'strengths' => 'nullable|string|max:2000',
            'status' => 'required|in:draft,published',
        ], [
            'title.required' => 'タイトルを入力してください',
            'category_id.required' => 'カテゴリを選択してください',
            'category_id.exists' => '選択されたカテゴリは存在しません',
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
