@php
    $primaryColor = helper::appdata($storeinfo->id)->primary_color ?? '#FF8A65';
    $t16Rtl = session()->get('direction') == 2;
@endphp
<style>
:root {
    --t16-primary: {{ $primaryColor }};
    --t16-primary-soft: color-mix(in srgb, {{ $primaryColor }} 14%, #fff);
    --t16-ink: #1a1a1a;
    --t16-muted: #8a8a8a;
    --t16-line: rgba(0,0,0,.06);
    --t16-card: #fff;
    --t16-bg: #ffffff;
    --t16-radius: 22px;
    --t16-radius-sm: 16px;
    --t16-shadow: 0 8px 28px rgba(0,0,0,.06);
}
body { background: var(--t16-bg) !important; color: var(--t16-ink); }
/* Prevent horizontal overflow from drawer/forms on all T16 pages (incl. checkout) */
html:has(.t16-header),
body:has(.t16-header) {
    overflow-x: clip;
    max-width: 100%;
}

/* Sticky header: main only wraps the header — display:contents fixes sticky */
#main-content:has(> .t16-header) { display: contents; }
.t16-header.sticky-top {
    position: -webkit-sticky;
    position: sticky !important;
    top: 0 !important;
    z-index: 1040 !important;
    background: rgba(255,255,255,.92) !important;
    display: flex;
    flex-direction: column;
    margin: 0 !important;
}
.t16-header .t16-header-container,
.t16-header .t16-header-search-mobile {
    position: relative !important;
    top: auto !important;
    flex-shrink: 0;
}

/* ===== OddMenu page shell ===== */
.t16-page { max-width: 560px; margin: 0 auto; padding-bottom: 48px; }
.t16-shell { max-width: 560px; margin: 0 auto; padding: 0 16px 48px; }
@media (min-width: 900px) {
    .t16-page, .t16-shell { max-width: 640px; }
}

/* Home cover + banner slider */
.t16-cover {
    position: relative;
    width: 100%;
    height: min(42vw, 260px);
    min-height: 180px;
    max-height: 300px;
    overflow: hidden;
    background: #e8e4df;
}
.t16-cover-slider {
    position: relative;
    width: 100%;
    height: 100%;
}
.t16-cover-slide {
    position: absolute;
    inset: 0;
    opacity: 0;
    visibility: hidden;
    transition: opacity .55s ease, visibility .55s ease;
    z-index: 0;
}
.t16-cover-slide.is-active {
    opacity: 1;
    visibility: visible;
    z-index: 1;
}
.t16-cover-slide-link {
    display: block;
    width: 100%;
    height: 100%;
}
.t16-cover img,
.t16-cover-slide img {
    width: 100%; height: 100%; object-fit: cover; display: block;
}
.t16-cover-fallback {
    width: 100%; height: 100%;
    background: linear-gradient(160deg, #ece7e1 0%, #d9d2c9 100%);
}
.t16-cover-dots {
    position: absolute;
    left: 50%;
    bottom: 36px;
    transform: translateX(-50%);
    z-index: 3;
    display: flex;
    gap: 7px;
    align-items: center;
}
.t16-cover-dot {
    width: 7px;
    height: 7px;
    border-radius: 50%;
    border: 0;
    padding: 0;
    background: rgba(255,255,255,.55);
    cursor: pointer;
    transition: transform .2s, background .2s;
}
.t16-cover-dot.is-active {
    background: #fff;
    transform: scale(1.25);
}
.t16-sheet {
    position: relative;
    margin-top: -28px;
    background: #fff;
    border-radius: 28px 28px 0 0;
    padding: 28px 20px 8px;
    z-index: 1;
}
.t16-store-title {
    margin: 0 0 14px;
    font-size: clamp(1.55rem, 4.5vw, 1.9rem);
    font-weight: 800;
    letter-spacing: -.03em;
    line-height: 1.2;
    color: var(--t16-ink);
}
.t16-meta {
    display: flex;
    flex-direction: column;
    gap: 8px;
    margin-bottom: 14px;
}
.t16-meta-row {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    color: var(--t16-muted);
    font-size: .92rem;
    line-height: 1.4;
    text-decoration: none;
}
.t16-meta-row:hover { color: var(--t16-primary); text-decoration: none; }
.t16-meta-row i {
    width: 18px;
    flex-shrink: 0;
    margin-top: 2px;
    font-size: .95rem;
    color: #b0b0b0;
}
.t16-store-desc {
    margin: 0 0 18px;
    color: var(--t16-muted);
    font-size: .9rem;
    line-height: 1.65;
}

/* Pill search (OddMenu) */
.t16-search-pill {
    position: relative;
    margin: 0 0 20px;
}
.t16-search-pill input,
.t16-search-local input {
    width: 100%;
    height: 50px;
    border: 0;
    border-radius: 999px;
    background: #f3f3f3;
    outline: none;
    font-size: .98rem;
    color: var(--t16-ink);
    {{ $t16Rtl ? 'padding: 0 48px 0 18px;' : 'padding: 0 18px 0 48px;' }}
}
.t16-search-pill input::placeholder,
.t16-search-local input::placeholder { color: #b0b0b0; }
.t16-search-pill input:focus,
.t16-search-local input:focus {
    background: #eee;
    box-shadow: 0 0 0 3px color-mix(in srgb, var(--t16-primary) 18%, transparent);
}
.t16-search-pill i,
.t16-search-local i {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    {{ $t16Rtl ? 'right: 18px;' : 'left: 18px;' }}
    color: #b0b0b0;
    font-size: 1rem;
    pointer-events: none;
}
.t16-search-local { position: relative; margin: 8px 0 18px; }

/* Category cover cards */
.t16-cat-covers {
    display: flex;
    flex-direction: column;
    gap: 14px;
    padding: 4px 0 24px;
}
.t16-cat-cover {
    position: relative;
    display: block;
    height: min(38vw, 180px);
    min-height: 140px;
    border-radius: var(--t16-radius);
    overflow: hidden;
    text-decoration: none;
    background: #2a2a2a;
    box-shadow: var(--t16-shadow);
}
.t16-cat-cover img {
    width: 100%; height: 100%; object-fit: cover; display: block;
    transition: transform .45s ease;
}
.t16-cat-cover:hover img { transform: scale(1.04); }
.t16-cat-cover-overlay {
    position: absolute; inset: 0;
    background: linear-gradient(180deg, rgba(0,0,0,.15) 0%, rgba(0,0,0,.55) 100%);
    display: flex; align-items: center; justify-content: center;
    padding: 16px;
}
.t16-cat-cover-name {
    margin: 0;
    color: #fff;
    font-size: clamp(1.15rem, 3.2vw, 1.45rem);
    font-weight: 800;
    letter-spacing: .04em;
    text-align: center;
    text-transform: uppercase;
    text-shadow: 0 2px 12px rgba(0,0,0,.35);
}
.t16-cat-cover-ph {
    width: 100%; height: 100%;
    background: linear-gradient(145deg, #4a4a4a, #2c2c2c);
}

/* Category page top meta */
.t16-cat-topmeta {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 12px;
    padding: 10px 0 6px;
    font-size: .78rem;
    color: var(--t16-muted);
}
.t16-cat-topmeta a {
    color: var(--t16-muted);
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    min-width: 0;
}
.t16-cat-topmeta a:hover { color: var(--t16-primary); }
.t16-cat-topmeta span {
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    max-width: 48vw;
}

.t16-back-circle {
    width: 42px; height: 42px;
    border-radius: 50%;
    background: #fff;
    border: 1px solid var(--t16-line);
    box-shadow: 0 4px 14px rgba(0,0,0,.06);
    display: inline-flex;
    align-items: center;
    justify-content: center;
    color: var(--t16-ink);
    text-decoration: none;
    margin: 8px 0 12px;
}
.t16-back-circle:hover { color: var(--t16-primary); background: #fafafa; }
.t16-back-link {
    display: inline-flex; align-items: center; gap: 8px;
    color: var(--t16-muted); text-decoration: none; font-weight: 700; font-size: .92rem;
    margin-bottom: 6px;
}
.t16-back-link:hover { color: var(--t16-primary); }

.t16-section-title {
    margin: 0 0 6px;
    font-size: clamp(1.35rem, 3vw, 1.7rem);
    font-weight: 800;
    letter-spacing: .02em;
    text-transform: uppercase;
    color: var(--t16-ink);
}
.t16-section-sub { margin: 0 0 16px; color: var(--t16-muted); font-size: .9rem; }
.t16-section-head {
    display: flex; align-items: end; justify-content: space-between;
    gap: 12px; margin: 8px 0 14px;
}

/* Chips as OddMenu pills */
.t16-cat-chips {
    display: flex; gap: 10px; overflow-x: auto; padding: 4px 0 14px;
    scroll-snap-type: x mandatory; -webkit-overflow-scrolling: touch;
}
.t16-cat-chips::-webkit-scrollbar { display: none; }
.t16-cat-chip {
    flex: 0 0 auto; scroll-snap-align: start;
    display: inline-flex; align-items: center; gap: 8px;
    text-decoration: none; color: var(--t16-primary);
    background: #fff; border: 1.5px solid var(--t16-primary);
    border-radius: 999px; padding: 8px 16px;
    font-weight: 700; font-size: .9rem;
    transition: background .2s, color .2s;
}
.t16-cat-chip:hover { background: var(--t16-primary-soft); color: var(--t16-primary); text-decoration: none; }
.t16-cat-chip.is-active {
    background: var(--t16-primary); color: #fff; border-color: var(--t16-primary);
}
.t16-cat-chip-img {
    width: 28px; height: 28px; border-radius: 50%; overflow: hidden;
    background: var(--t16-primary-soft); display: flex; align-items: center; justify-content: center;
}
.t16-cat-chip-img img { width: 100%; height: 100%; object-fit: cover; }
.t16-cat-chip-img i { color: var(--t16-primary); font-size: .75rem; }
.t16-cat-chip.is-active .t16-cat-chip-img i { color: #fff; }
.t16-cat-chip-name { white-space: nowrap; }

/* Product list (OddMenu vertical cards) */
.t16-menu-list {
    display: flex;
    flex-direction: column;
    gap: 28px;
}
.t16-menu-grid {
    display: flex;
    flex-direction: column;
    gap: 28px;
}

.t16-card {
    background: transparent;
    border: 0;
    border-radius: 0;
    box-shadow: none;
    display: flex;
    flex-direction: column;
    overflow: visible;
    animation: t16CardIn .4s ease both;
}
@keyframes t16CardIn {
    from { opacity: 0; transform: translateY(6px); }
    to { opacity: 1; transform: none; }
}
.t16-card-media {
    position: relative;
    display: block;
    width: 100%;
    aspect-ratio: 16 / 10;
    border-radius: var(--t16-radius);
    overflow: hidden;
    background: #ece7e1;
}
.t16-card-media img {
    width: 100%; height: 100%; object-fit: cover; display: block;
}
.t16-card-off {
    position: absolute; top: 12px; {{ $t16Rtl ? 'left: 12px;' : 'right: 12px;' }}
    background: var(--t16-primary); color: #fff; font-size: .72rem; font-weight: 800;
    border-radius: 999px; padding: 4px 9px;
}
.t16-card-body {
    padding: 12px 2px 0;
    display: flex;
    flex-direction: column;
    gap: 6px;
}
.t16-card-title-row {
    display: flex;
    align-items: baseline;
    justify-content: space-between;
    gap: 12px;
}
.t16-card-name {
    font-size: 1.05rem;
    font-weight: 800;
    color: var(--t16-ink);
    text-decoration: none;
    line-height: 1.3;
    flex: 1;
    min-width: 0;
}
.t16-card-name:hover { color: var(--t16-primary); }
.t16-card-desc {
    margin: 0;
    color: var(--t16-muted);
    font-size: .88rem;
    line-height: 1.45;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
.t16-card-footer {
    margin-top: 6px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
}
.t16-card-price-wrap {
    display: flex;
    flex-wrap: wrap;
    align-items: baseline;
    gap: 6px;
    min-width: 0;
}
.t16-price {
    font-size: 1.25rem;
    font-weight: 800;
    color: var(--t16-primary);
    white-space: nowrap;
}
.t16-old-price {
    font-size: .85rem;
    color: #b0b0b0;
    text-decoration: line-through;
}
.t16-add-btn {
    width: 48px;
    height: 48px;
    padding: 0;
    border: 0;
    border-radius: 50%;
    background: var(--t16-primary);
    color: #fff;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 1.15rem;
    text-decoration: none;
    cursor: pointer;
    flex-shrink: 0;
    transition: filter .2s, transform .15s;
}
.t16-add-btn span { display: none; }
.t16-add-btn:hover {
    filter: brightness(.96);
    color: #fff;
    text-decoration: none;
    transform: scale(1.04);
}
.t16-qty {
    display: none;
    align-items: center;
    gap: 0;
    height: 48px;
    border-radius: 999px;
    overflow: hidden;
    background: var(--t16-primary-soft);
    border: 1px solid color-mix(in srgb, var(--t16-primary) 30%, transparent);
}
.t16-qty-btn {
    width: 42px; height: 48px; border: 0; background: transparent;
    color: var(--t16-primary); font-size: 1.2rem; font-weight: 700; cursor: pointer;
}
.t16-qty-num {
    min-width: 28px; text-align: center; font-weight: 800; color: var(--t16-ink);
}
.t16-out-badge {
    font-size: .78rem; font-weight: 700; color: #9a9a9a;
    background: #f3f3f3; border-radius: 999px; padding: 8px 12px;
}

.t16-empty {
    text-align: center; padding: 48px 16px; color: var(--t16-muted);
    background: #fafafa; border-radius: var(--t16-radius); border: 1px dashed var(--t16-line);
}
.t16-empty i { font-size: 2rem; margin-bottom: 10px; opacity: .4; display: block; }
.t16-pagination { margin-top: 24px; display: flex; justify-content: center; }

.copy-right-sec.t16-hidden-copy,
.t16-footer,
.t16-footer-features { display: none !important; }

/* Cart drawer (keep behavior) */
.t16-drawer-backdrop {
    position: fixed; inset: 0; background: rgba(0,0,0,.32); z-index: 10030;
    opacity: 0; transition: opacity .25s; pointer-events: none;
    backdrop-filter: blur(2px);
}
.t16-drawer-backdrop.is-open { opacity: 1; pointer-events: auto; }
.t16-cart-drawer {
    position: fixed; top: 0; bottom: 0; z-index: 10040;
    width: min(400px, 100vw); background: #fff;
    display: flex; flex-direction: column;
    transition: transform .28s ease, visibility .28s;
    box-shadow: 0 0 40px rgba(0,0,0,.12);
    visibility: hidden; pointer-events: none;
}
.t16-cart-drawer.is-ltr { right: 0; left: auto; transform: translateX(110%); }
.t16-cart-drawer.is-rtl { left: 0; right: auto; transform: translateX(-110%); }
.t16-cart-drawer.is-open {
    transform: translateX(0);
    visibility: visible;
    pointer-events: auto;
}
html.t16-drawer-lock { overflow: hidden; }
.t16-drawer-head {
    display: flex; align-items: center; justify-content: space-between;
    padding: 16px 18px; border-bottom: 1px solid var(--t16-line);
}
.t16-drawer-head h2 { margin: 0; font-size: 1.1rem; font-weight: 800; }
.t16-drawer-close {
    width: 36px; height: 36px; border: 0; border-radius: 50%;
    background: #f3f3f3; color: var(--t16-ink); cursor: pointer;
    display: inline-flex; align-items: center; justify-content: center;
}
.t16-drawer-body {
    flex: 1; overflow-y: auto; padding: 14px; background: #fafafa;
}
.t16-drawer-empty {
    min-height: 48%; display: flex; flex-direction: column;
    align-items: center; justify-content: center; text-align: center; padding: 40px 16px;
    color: var(--t16-muted);
}
.t16-drawer-empty i { font-size: 2rem; margin-bottom: 12px; opacity: .4; }
.t16-drawer-empty-title { margin: 0 0 6px; font-size: 1.05rem; font-weight: 800; color: var(--t16-ink); }
.t16-drawer-empty-sub { margin: 0; font-size: .9rem; }
.t16-drawer-foot {
    padding: 14px 16px 18px; border-top: 1px solid var(--t16-line);
    display: grid; gap: 12px; background: #fff;
}
.t16-drawer-subtotal {
    display: flex; align-items: center; justify-content: space-between; gap: 12px;
}
.t16-drawer-subtotal span { font-weight: 600; color: var(--t16-muted); }
.t16-drawer-subtotal strong { font-size: 1.15rem; font-weight: 800; color: var(--t16-ink); }
.t16-drawer-actions { display: grid; gap: 8px; }
.t16-drawer-btn {
    display: inline-flex; align-items: center; justify-content: center;
    width: 100%; height: 44px; border-radius: 999px;
    font-size: .92rem; font-weight: 800; text-decoration: none; border: 1px solid transparent;
    cursor: pointer; transition: filter .15s, transform .1s;
}
.t16-drawer-btn:active { transform: scale(.985); }
.t16-drawer-btn.ghost {
    background: #fff; color: var(--t16-ink); border-color: var(--t16-line);
}
.t16-drawer-btn.ghost:hover { border-color: var(--t16-primary); color: var(--t16-primary); }
.t16-drawer-btn.solid {
    background: var(--t16-primary); color: #fff; border-color: var(--t16-primary);
}
.t16-drawer-btn.solid:hover { filter: brightness(.96); color: #fff; }

.t16-cart-item {
    display: grid; grid-template-columns: 76px 1fr; gap: 12px;
    padding: 12px; margin-bottom: 10px;
    background: #fff; border: 1px solid var(--t16-line); border-radius: 14px;
}
.t16-cart-item-img {
    width: 76px; height: 76px; border-radius: 12px; overflow: hidden;
    background: #ece7e1; display: block;
}
.t16-cart-item-img img { width: 100%; height: 100%; object-fit: cover; }
.t16-cart-item-body { min-width: 0; display: flex; flex-direction: column; gap: 6px; }
.t16-cart-item-top {
    display: flex; justify-content: space-between; align-items: flex-start; gap: 8px;
}
.t16-cart-item-name {
    font-weight: 800; color: var(--t16-ink); text-decoration: none; font-size: .92rem;
    line-height: 1.35; flex: 1; min-width: 0;
    display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;
}
.t16-cart-item-name:hover { color: var(--t16-primary); }
.t16-cart-remove {
    border: 0; background: transparent; color: #b0b0b0; cursor: pointer;
    width: 28px; height: 28px; border-radius: 8px; flex-shrink: 0;
    display: inline-flex; align-items: center; justify-content: center;
}
.t16-cart-remove:hover { color: #c0392b; background: #fff1f0; }
.t16-cart-item-meta {
    display: flex; flex-wrap: wrap; gap: 6px; color: #9a9a9a; font-size: .75rem;
}
.t16-cart-item-price { font-size: .95rem; font-weight: 800; color: var(--t16-primary); }
.t16-cart-item-qty {
    display: inline-flex; align-items: center; height: 32px;
    border: 1px solid var(--t16-line); border-radius: 999px; overflow: hidden; background: #fff;
    width: fit-content;
}
.t16-cart-qty-btn {
    width: 32px; height: 32px; border: 0; background: transparent;
    color: var(--t16-primary); cursor: pointer;
    display: inline-flex; align-items: center; justify-content: center;
}
.t16-cart-item-qty input {
    width: 28px; border: 0; text-align: center; font-weight: 800;
    background: transparent; font-size: .85rem; padding: 0;
}

.t16-cart-layout {
    display: grid; grid-template-columns: 1.45fr .9fr; gap: 20px; align-items: start;
}
.t16-cart-list { display: grid; gap: 0; }
.t16-cart-summary {
    background: #fff; border: 1px solid var(--t16-line); border-radius: var(--t16-radius);
    padding: 18px; box-shadow: var(--t16-shadow); position: sticky; top: 96px;
    display: grid; gap: 12px;
}
.t16-cart-summary-row {
    display: flex; justify-content: space-between; align-items: center; gap: 12px;
    font-weight: 700;
}
body:has(.t16-cart-drawer) .swal2-container { z-index: 12050 !important; }

@media (max-width: 900px) {
    .t16-cart-layout { grid-template-columns: 1fr; }
    .t16-cart-summary { position: static; }
}
@media (max-width: 576px) {
    .t16-sheet { padding: 24px 16px 8px; border-radius: 24px 24px 0 0; }
    .t16-cat-cover { min-height: 130px; }
    .t16-card-media { aspect-ratio: 4 / 3; }
}

/* Checkout (shared view) — keep forms inside the viewport on Theme 16 */
body:has(.t16-header) .cart-sec,
body:has(.t16-header) .cart-sec .container,
body:has(.t16-header) .cart-sec .row,
body:has(.t16-header) .cart-sec [class*="col-"],
body:has(.t16-header) .cart-sec .card,
body:has(.t16-header) .cart-sec .card-body {
    max-width: 100%;
    min-width: 0;
}
body:has(.t16-header) .cart-sec .d-flex.gap-2 {
    flex-wrap: nowrap;
    min-width: 0;
    width: 100%;
}
body:has(.t16-header) .cart-sec #country_code {
    width: 118px !important;
    max-width: 38%;
    flex: 0 0 auto;
    padding-left: 0.6rem !important;
    padding-right: 0.6rem !important;
}
body:has(.t16-header) .cart-sec #customer_mobile {
    flex: 1 1 auto;
    min-width: 0;
    width: auto !important;
}
body:has(.t16-header) .cart-sec .form-control,
body:has(.t16-header) .cart-sec .form-select {
    max-width: 100%;
}
body:has(.t16-header) .breadcrumb-sec .container {
    max-width: 100%;
    overflow-x: clip;
}
</style>
