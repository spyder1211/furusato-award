<?php

namespace App\Http\Controllers;

use App\Mail\CompanyOfferNotification;
use App\Models\CompanyOffer;
use App\Models\CompanyService;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CompanyOfferController extends Controller
{
    /**
     * オファー送信（自治体→企業）
     */
    public function store(Request $request)
    {
        $sender = Auth::user();

        // 自治体アカウントのみアクセス可能
        if ($sender->role !== 'municipality') {
            abort(403, '自治体アカウントのみオファーを送信できます');
        }

        $validated = $request->validate([
            'service_id' => 'required|exists:company_services,id',
            'message' => 'nullable|string|max:1000',
        ]);

        // サービス情報取得
        $service = CompanyService::with('user')->findOrFail($validated['service_id']);

        // 公開されているサービスのみオファー可能
        if ($service->status !== 'published') {
            return back()->withErrors(['service_id' => 'このサービスにはオファーを送信できません']);
        }

        // 重複チェック（データベースのユニーク制約でも保護）
        $exists = CompanyOffer::where('service_id', $validated['service_id'])
            ->where('municipality_user_id', $sender->id)
            ->exists();

        if ($exists) {
            return back()->withErrors(['service_id' => 'すでにオファーを送信済みです']);
        }

        // オファー作成
        $offer = CompanyOffer::create([
            'service_id' => $validated['service_id'],
            'municipality_user_id' => $sender->id,
            'message' => $validated['message'] ?? null,
            'status' => 'pending',
        ]);

        // メール通知
        try {
            // 企業（受信者）への通知
            Mail::to($service->user->email)->send(new CompanyOfferNotification($offer, false));

            // 管理者への通知
            $admins = User::where('role', 'admin')->get();
            foreach ($admins as $admin) {
                Mail::to($admin->email)->send(new CompanyOfferNotification($offer, true));
            }
        } catch (\Exception $e) {
            // メール送信エラーは記録するが、オファー作成は成功として扱う
            \Log::error('メール送信エラー: ' . $e->getMessage());
        }

        return redirect()->route('services.show', $validated['service_id'])
            ->with('success', 'オファーを送信しました');
    }

    /**
     * 送信したオファー一覧（自治体側）
     */
    public function sent()
    {
        $user = Auth::user();

        // 自治体アカウントのみアクセス可能
        if ($user->role !== 'municipality') {
            abort(403, '自治体アカウントのみアクセス可能です');
        }

        $offers = $user->companyOffers()
            ->with(['companyService.user.companyProfile'])
            ->latest()
            ->paginate(20);

        return view('companies.offers.sent', compact('offers'));
    }

    /**
     * 受信したオファー一覧（企業側）
     */
    public function received()
    {
        $user = Auth::user();

        // 企業アカウントのみアクセス可能
        if ($user->role !== 'company') {
            abort(403, '企業アカウントのみアクセス可能です');
        }

        // 自分の企業サービスに対するオファーを取得
        $offers = CompanyOffer::whereHas('companyService', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->with(['companyService', 'municipality.municipalityProfile'])
            ->latest()
            ->paginate(20);

        return view('companies.offers.received', compact('offers'));
    }
}
