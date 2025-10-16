<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageUploadController extends Controller
{
    /**
     * Tiptapエディター用の画像アップロード
     */
    public function uploadEditorImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,jpg,png,gif,webp|max:2048',
        ]);

        try {
            $path = $request->file('image')->store('editor-images', 'public');

            return response()->json([
                'success' => true,
                'url' => asset('storage/' . $path),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => '画像のアップロードに失敗しました',
            ], 500);
        }
    }
}
