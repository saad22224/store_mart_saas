@php
    $shareItem = $getitem ?? ($item ?? null);
    $shareUrl = $shareUrl ?? url()->current();
    $shareTitle = $shareTitle ?? ($shareItem->item_name ?? '');
    $shareText = $shareText ?? trim($shareTitle . ' ' . $shareUrl);
    $shareId = 'productShare' . ($shareItem->id ?? uniqid());
@endphp
@once
    <style>
        .mp-product-share {
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px solid rgba(0, 0, 0, 0.08);
            width: 100%;
        }
        .mp-product-share-label {
            font-size: 0.9rem;
            font-weight: 700;
            margin: 0 0 0.65rem;
            color: inherit;
        }
        .mp-product-share-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            align-items: center;
        }
        .mp-product-share-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.4rem;
            min-height: 2.25rem;
            padding: 0 0.8rem;
            border-radius: 0.55rem;
            border: 1px solid rgba(0, 0, 0, 0.12);
            background: #fff;
            color: inherit;
            font-size: 0.8rem;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            font-family: inherit;
            transition: background .15s, border-color .15s, color .15s;
        }
        .mp-product-share-btn:hover {
            background: rgba(0, 0, 0, 0.03);
            border-color: rgba(0, 0, 0, 0.22);
            color: inherit;
            text-decoration: none;
        }
        .mp-product-share-btn.is-copied {
            border-color: #2e7d32;
            color: #2e7d32;
            background: #f1f8f2;
        }
        .mp-product-share-btn i {
            font-size: 0.95rem;
        }
        [data-theme="dark"] .mp-product-share-btn,
        .dark-mode .mp-product-share-btn {
            background: transparent;
        }
    </style>
@endonce

<div class="mp-product-share js-product-share" id="{{ $shareId }}"
    data-url="{{ $shareUrl }}"
    data-title="{{ e($shareTitle) }}"
    data-text="{{ e($shareText) }}"
    data-copy-label="{{ e(trans('labels.copy_link')) }}"
    data-copied-label="{{ e(trans('labels.link_copied')) }}"
    data-copied-toast="{{ e(trans('labels.product_link_copied')) }}">
    <p class="mp-product-share-label">{{ trans('labels.share_product') }}</p>
    <div class="mp-product-share-actions">
        <button type="button" class="mp-product-share-btn js-native-share" hidden>
            <i class="fa-light fa-share-nodes"></i> {{ trans('labels.share') }}
        </button>
        <a class="mp-product-share-btn" target="_blank" rel="noopener"
            href="https://wa.me/?text={{ rawurlencode($shareText) }}">
            <i class="fa-brands fa-whatsapp"></i> {{ trans('labels.whatsapp') }}
        </a>
        <a class="mp-product-share-btn" target="_blank" rel="noopener"
            href="https://www.facebook.com/sharer/sharer.php?u={{ rawurlencode($shareUrl) }}">
            <i class="fa-brands fa-facebook-f"></i> {{ trans('labels.facebook') }}
        </a>
        <a class="mp-product-share-btn" target="_blank" rel="noopener"
            href="https://twitter.com/intent/tweet?text={{ rawurlencode($shareTitle) }}&url={{ rawurlencode($shareUrl) }}">
            <i class="fa-brands fa-x-twitter"></i> {{ trans('labels.twitter') }}
        </a>
        <a class="mp-product-share-btn" target="_blank" rel="noopener"
            href="https://t.me/share/url?url={{ rawurlencode($shareUrl) }}&text={{ rawurlencode($shareTitle) }}">
            <i class="fa-brands fa-telegram"></i> {{ trans('labels.telegram') }}
        </a>
        <button type="button" class="mp-product-share-btn js-copy-link">
            <i class="fa-light fa-link"></i>
            <span class="js-copy-label">{{ trans('labels.copy_link') }}</span>
        </button>
    </div>
</div>
