import { Editor } from '@tiptap/core'
import StarterKit from '@tiptap/starter-kit'
import Link from '@tiptap/extension-link'
import TextAlign from '@tiptap/extension-text-align'
import Image from '@tiptap/extension-image'

export function initTiptapEditor(elementId, hiddenInputId, initialContent = '') {
    const element = document.getElementById(elementId)
    const hiddenInput = document.getElementById(hiddenInputId)

    if (!element) {
        console.error(`Element with id "${elementId}" not found`)
        return null
    }

    const editor = new Editor({
        element: element,
        extensions: [
            StarterKit,
            Link.configure({
                openOnClick: false,
                HTMLAttributes: {
                    class: 'text-blue-600 underline',
                },
            }),
            TextAlign.configure({
                types: ['heading', 'paragraph'],
            }),
            Image.configure({
                inline: true,
                HTMLAttributes: {
                    class: 'editor-image',
                },
            }),
        ],
        content: initialContent,
        editorProps: {
            attributes: {
                class: 'prose prose-sm max-w-none focus:outline-none min-h-[200px] px-4 py-3',
            },
        },
        onUpdate: ({ editor }) => {
            if (hiddenInput) {
                hiddenInput.value = editor.getHTML()
            }
        },
    })

    // ツールバーのボタンイベントを設定
    setupToolbar(editor, elementId)

    return editor
}

function setupToolbar(editor, editorId) {
    const toolbarId = `toolbar-${editorId}`
    const toolbar = document.getElementById(toolbarId)

    if (!toolbar) return

    // 太字
    const boldBtn = toolbar.querySelector('[data-action="bold"]')
    if (boldBtn) {
        boldBtn.addEventListener('click', () => {
            editor.chain().focus().toggleBold().run()
        })
    }

    // イタリック
    const italicBtn = toolbar.querySelector('[data-action="italic"]')
    if (italicBtn) {
        italicBtn.addEventListener('click', () => {
            editor.chain().focus().toggleItalic().run()
        })
    }

    // 取り消し線
    const strikeBtn = toolbar.querySelector('[data-action="strike"]')
    if (strikeBtn) {
        strikeBtn.addEventListener('click', () => {
            editor.chain().focus().toggleStrike().run()
        })
    }

    // 見出し1
    const h1Btn = toolbar.querySelector('[data-action="h1"]')
    if (h1Btn) {
        h1Btn.addEventListener('click', () => {
            editor.chain().focus().toggleHeading({ level: 1 }).run()
        })
    }

    // 見出し2
    const h2Btn = toolbar.querySelector('[data-action="h2"]')
    if (h2Btn) {
        h2Btn.addEventListener('click', () => {
            editor.chain().focus().toggleHeading({ level: 2 }).run()
        })
    }

    // 見出し3
    const h3Btn = toolbar.querySelector('[data-action="h3"]')
    if (h3Btn) {
        h3Btn.addEventListener('click', () => {
            editor.chain().focus().toggleHeading({ level: 3 }).run()
        })
    }

    // 箇条書きリスト
    const bulletListBtn = toolbar.querySelector('[data-action="bulletList"]')
    if (bulletListBtn) {
        bulletListBtn.addEventListener('click', () => {
            editor.chain().focus().toggleBulletList().run()
        })
    }

    // 番号付きリスト
    const orderedListBtn = toolbar.querySelector('[data-action="orderedList"]')
    if (orderedListBtn) {
        orderedListBtn.addEventListener('click', () => {
            editor.chain().focus().toggleOrderedList().run()
        })
    }

    // リンク
    const linkBtn = toolbar.querySelector('[data-action="link"]')
    if (linkBtn) {
        linkBtn.addEventListener('click', () => {
            const url = window.prompt('URL を入力してください:')
            if (url) {
                editor.chain().focus().setLink({ href: url }).run()
            }
        })
    }

    // 引用
    const blockquoteBtn = toolbar.querySelector('[data-action="blockquote"]')
    if (blockquoteBtn) {
        blockquoteBtn.addEventListener('click', () => {
            editor.chain().focus().toggleBlockquote().run()
        })
    }

    // 水平線
    const hrBtn = toolbar.querySelector('[data-action="hr"]')
    if (hrBtn) {
        hrBtn.addEventListener('click', () => {
            editor.chain().focus().setHorizontalRule().run()
        })
    }

    // 元に戻す
    const undoBtn = toolbar.querySelector('[data-action="undo"]')
    if (undoBtn) {
        undoBtn.addEventListener('click', () => {
            editor.chain().focus().undo().run()
        })
    }

    // やり直し
    const redoBtn = toolbar.querySelector('[data-action="redo"]')
    if (redoBtn) {
        redoBtn.addEventListener('click', () => {
            editor.chain().focus().redo().run()
        })
    }

    // 画像アップロード
    const imageBtn = toolbar.querySelector('[data-action="image"]')
    if (imageBtn) {
        imageBtn.addEventListener('click', () => {
            const input = document.createElement('input')
            input.type = 'file'
            input.accept = 'image/*'
            input.onchange = async (e) => {
                const file = e.target.files[0]
                if (file) {
                    await uploadImage(editor, file)
                }
            }
            input.click()
        })
    }
}

// 画像アップロード処理
async function uploadImage(editor, file) {
    const formData = new FormData()
    formData.append('image', file)

    // CSRFトークンを取得
    const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')

    try {
        const response = await fetch('/api/upload-image', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': token,
            },
            body: formData,
        })

        const data = await response.json()

        if (data.success && data.url) {
            // 画像をエディターに挿入
            editor.chain().focus().setImage({ src: data.url }).run()
        } else {
            alert('画像のアップロードに失敗しました')
        }
    } catch (error) {
        console.error('Upload error:', error)
        alert('画像のアップロードに失敗しました')
    }
}
