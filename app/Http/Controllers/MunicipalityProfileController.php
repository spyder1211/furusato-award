<?php

namespace App\Http\Controllers;

use App\Models\MunicipalityProfile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MunicipalityProfileController extends Controller
{
    /**
     * 首長プロフィール一覧（フィルター・ページネーション対応）
     */
    public function index(Request $request)
    {
        $query = MunicipalityProfile::with('user');

        // 都道府県フィルター
        if ($request->filled('prefecture')) {
            $query->where('prefecture', $request->prefecture);
        }

        // 人口規模フィルター
        if ($request->filled('population_min')) {
            $query->where('population', '>=', $request->population_min);
        }
        if ($request->filled('population_max')) {
            $query->where('population', '<=', $request->population_max);
        }

        // 得意分野フィルター（部分一致）
        if ($request->filled('expertise')) {
            $query->where('expertise', 'like', '%' . $request->expertise . '%');
        }

        // 承認済みユーザーのみ表示
        $query->whereHas('user', function ($q) {
            $q->where('is_approved', true)
              ->where('role', 'municipality');
        });

        // ページネーション（20件/ページ）
        $profiles = $query->latest()->paginate(20);

        // 都道府県リスト（フィルター用）
        $prefectures = MunicipalityProfile::distinct()->pluck('prefecture')->sort()->values();

        return view('municipalities.index', compact('profiles', 'prefectures'));
    }

    /**
     * 首長プロフィール詳細
     */
    public function show($id)
    {
        $profile = MunicipalityProfile::with('user')->findOrFail($id);

        // 承認済みユーザーかチェック
        if (!$profile->user->is_approved) {
            abort(404);
        }

        // 既にオファーを送信済みかチェック
        $alreadyOffered = false;
        if (Auth::check() && Auth::user()->role === 'municipality') {
            $alreadyOffered = Auth::user()
                ->sentMunicipalityOffers()
                ->where('receiver_id', $profile->user_id)
                ->exists();
        }

        return view('municipalities.show', compact('profile', 'alreadyOffered'));
    }

    /**
     * 自分のプロフィール編集フォーム
     */
    public function edit()
    {
        $user = Auth::user();

        // 首長アカウントのみアクセス可能
        if ($user->role !== 'municipality') {
            abort(403, '首長アカウントのみアクセス可能です');
        }

        $profile = $user->municipalityProfile ?? new MunicipalityProfile(['user_id' => $user->id]);

        return view('municipalities.edit', compact('profile'));
    }

    /**
     * プロフィール更新
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        // 首長アカウントのみアクセス可能
        if ($user->role !== 'municipality') {
            abort(403, '首長アカウントのみアクセス可能です');
        }

        $validated = $request->validate([
            'prefecture' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'population' => 'required|numeric|min:0',
            'characteristics' => 'nullable|string',
            'election_count' => 'required|integer|min:1',
            'birthplace' => 'nullable|string|max:255',
            'university' => 'nullable|string|max:255',
            'philosophy' => 'nullable|string',
            'expertise' => 'nullable|string',
            'furusato_tax_amount' => 'required|integer|min:0',
        ]);

        $profile = $user->municipalityProfile;

        if ($profile) {
            $profile->update($validated);
        } else {
            $validated['user_id'] = $user->id;
            MunicipalityProfile::create($validated);
        }

        return redirect()->route('municipalities.edit')
            ->with('success', 'プロフィールを更新しました');
    }
}
