@props(['name', 'id' => null, 'value' => '', 'required' => false, 'rows' => 8, 'placeholder' => ''])

@php
    $id = $id ?? $name;
    $editorId = 'editor-' . $id;
    $toolbarId = 'toolbar-' . $editorId;
@endphp

<div class="tiptap-editor">
    <!-- ツールバー -->
    <div id="{{ $toolbarId }}" class="tiptap-toolbar">
        <button type="button" data-action="bold" title="太字">
            <strong>B</strong>
        </button>
        <button type="button" data-action="italic" title="イタリック">
            <em>I</em>
        </button>
        <button type="button" data-action="strike" title="取り消し線">
            <s>S</s>
        </button>
        <button type="button" data-action="h1" title="見出し1">
            H1
        </button>
        <button type="button" data-action="h2" title="見出し2">
            H2
        </button>
        <button type="button" data-action="h3" title="見出し3">
            H3
        </button>
        <button type="button" data-action="bulletList" title="箇条書きリスト">
            •
        </button>
        <button type="button" data-action="orderedList" title="番号付きリスト">
            1.
        </button>
        <button type="button" data-action="link" title="リンク">
            🔗
        </button>
        <button type="button" data-action="image" title="画像">
            🖼️
        </button>
        <button type="button" data-action="blockquote" title="引用">
            "
        </button>
        <button type="button" data-action="hr" title="水平線">
            ―
        </button>
        <button type="button" data-action="undo" title="元に戻す">
            ↶
        </button>
        <button type="button" data-action="redo" title="やり直し">
            ↷
        </button>
    </div>

    <!-- エディターコンテンツエリア -->
    <div id="{{ $editorId }}" class="tiptap-content"></div>

    <!-- 隠しinput（フォーム送信用） -->
    <input type="hidden" name="{{ $name }}" id="{{ $id }}" value="{{ old($name, $value) }}" {{ $required ? 'required' : '' }}>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const initialContent = document.getElementById('{{ $id }}').value;
        window.initTiptapEditor('{{ $editorId }}', '{{ $id }}', initialContent);
    });
</script>
