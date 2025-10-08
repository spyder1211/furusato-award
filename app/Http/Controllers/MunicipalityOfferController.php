<?php

namespace App\Http\Controllers;

use App\Models\MunicipalityOffer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class MunicipalityOfferController extends Controller
{
    /**
     * オファー送信
     */
    public function store(Request $request)
    {
        $sender = Auth::user();

        // 首長アカウントのみアクセス可能
        if ($sender->role !== 'municipality') {
            abort(403, '首長アカウントのみオファーを送信できます');
        }

        $validated = $request->validate([
            'receiver_id' => [
                'required',
                'exists:users,id',
                // 自分自身へのオファー防止
                Rule::notIn([$sender->id]),
            ],
            'message' => 'nullable|string|max:1000',
        ], [
            'receiver_id.not_in' => '自分自身にオファーを送ることはできません',
        ]);

        // 受信者が首長アカウントか確認
        $receiver = User::findOrFail($validated['receiver_id']);
        if ($receiver->role !== 'municipality') {
            return back()->withErrors(['receiver_id' => 'オファー先は首長アカウントである必要があります']);
        }

        // 重複チェック（データベースのユニーク制約でも保護）
        $exists = MunicipalityOffer::where('sender_id', $sender->id)
            ->where('receiver_id', $validated['receiver_id'])
            ->exists();

        if ($exists) {
            return back()->withErrors(['receiver_id' => 'すでにオファーを送信済みです']);
        }

        // オファー作成
        $offer = MunicipalityOffer::create([
            'sender_id' => $sender->id,
            'receiver_id' => $validated['receiver_id'],
            'message' => $validated['message'] ?? null,
            'status' => 'pending',
        ]);

        // TODO: メール通知（次のステップで実装）
        // - 受信者への通知
        // - 管理者への通知

        return redirect()->route('municipalities.show', $validated['receiver_id'])
            ->with('success', 'オファーを送信しました');
    }

    /**
     * 送信したオファー一覧
     */
    public function sent()
    {
        $user = Auth::user();

        // 首長アカウントのみアクセス可能
        if ($user->role !== 'municipality') {
            abort(403, '首長アカウントのみアクセス可能です');
        }

        $offers = $user->sentMunicipalityOffers()
            ->with(['receiver.municipalityProfile'])
            ->latest()
            ->paginate(20);

        return view('municipalities.offers.sent', compact('offers'));
    }

    /**
     * 受信したオファー一覧
     */
    public function received()
    {
        $user = Auth::user();

        // 首長アカウントのみアクセス可能
        if ($user->role !== 'municipality') {
            abort(403, '首長アカウントのみアクセス可能です');
        }

        $offers = $user->receivedMunicipalityOffers()
            ->with(['sender.municipalityProfile'])
            ->latest()
            ->paginate(20);

        return view('municipalities.offers.received', compact('offers'));
    }
}
