<?php
    $primaryColor = helper::appdata($storeinfo->id)->primary_color ?? '#9d4300';
    $t16Rtl = session()->get('direction') == 2;
?>
<style>
:root {
    --t16-primary: <?php echo e($primaryColor); ?>;
    --t16-primary-soft: color-mix(in srgb, <?php echo e($primaryColor); ?> 12%, #fff);
    --t16-ink: #1a1714;
    --t16-muted: #6b5f56;
    --t16-line: rgba(26,23,20,.08);
    --t16-card: #fff;
    --t16-bg: #f6f2ee;
    --t16-radius: 18px;
    --t16-shadow: 0 10px 30px rgba(26,23,20,.07);
}
body { background: var(--t16-bg) !important; color: var(--t16-ink); }
/*
 * The shared layout wraps ONLY the header in <main id="main-content">, so the
 * sticky header had no room to stick (its containing block was as tall as
 * itself). `display: contents` removes that box so the header sticks against
 * the body scroll like a normal page header. Scoped to Theme 16 only.
 */
#main-content:has(> .t16-header) { display: contents; }
.t16-header.sticky-top {
    position: -webkit-sticky;
    position: sticky !important;
    top: 0 !important;
    z-index: 1040 !important;
    background: #fff !important;
    display: flex;
    flex-direction: column;
    margin: 0 !important;
}
.t16-header .t16-header-container,
.t16-header .t16-header-search-mobile,
.t16-header .t16-sticky-chips {
    position: relative !important;
    top: auto !important;
    flex-shrink: 0;
}
.t16-shell { max-width: 1200px; margin: 0 auto; padding: 0 16px 48px; }
.t16-hero,
.t16-menu-home,
.t16-menu-section,
.t16-card {
    position: relative;
    z-index: 0;
}

.t16-hero {
    margin: 16px auto 0; max-width: 1200px; padding: 0 16px;
}
.t16-slider-wrap {
    position: relative; overflow: hidden; border-radius: calc(var(--t16-radius) + 4px);
    background: #ebe4dc; box-shadow: var(--t16-shadow);
}
.t16-slider-wrap img.t16-slide-img {
    width: 100%; height: min(42vw, 340px); object-fit: cover; display: block;
}
@media (max-width: 576px) {
    .t16-slider-wrap img.t16-slide-img { height: 200px; }
}

.t16-section-head {
    display: flex; align-items: end; justify-content: space-between;
    gap: 12px; margin: 28px 0 14px;
}
.t16-section-title {
    margin: 0; font-size: clamp(1.25rem, 2.4vw, 1.6rem);
    font-weight: 800; letter-spacing: -.03em; color: var(--t16-ink);
}
.t16-section-sub { margin: 4px 0 0; color: var(--t16-muted); font-size: .92rem; }

.t16-cat-chips {
    display: flex; gap: 10px; overflow-x: auto; padding: 4px 0 8px;
    scroll-snap-type: x mandatory; -webkit-overflow-scrolling: touch;
}
.t16-cat-chips::-webkit-scrollbar { display: none; }
.t16-cat-chip {
    flex: 0 0 auto; scroll-snap-align: start;
    display: inline-flex; align-items: center; gap: 10px;
    text-decoration: none; color: var(--t16-ink);
    background: var(--t16-card); border: 1px solid var(--t16-line);
    border-radius: 999px; padding: 8px 14px 8px 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,.03);
    transition: transform .2s, border-color .2s, box-shadow .2s;
}
.t16-cat-chip:hover {
    transform: translateY(-2px); border-color: color-mix(in srgb, var(--t16-primary) 40%, #ddd);
    box-shadow: var(--t16-shadow); color: var(--t16-ink); text-decoration: none;
}
.t16-cat-chip.is-active {
    background: var(--t16-primary); color: #fff; border-color: var(--t16-primary);
}
.t16-cat-chip-img {
    width: 36px; height: 36px; border-radius: 50%; overflow: hidden;
    background: var(--t16-primary-soft); display: flex; align-items: center; justify-content: center;
}
.t16-cat-chip-img img { width: 100%; height: 100%; object-fit: cover; }
.t16-cat-chip-img i { color: var(--t16-primary); font-size: .85rem; }
.t16-cat-chip.is-active .t16-cat-chip-img i { color: #fff; }
.t16-cat-chip-name { font-weight: 700; font-size: .92rem; white-space: nowrap; }

.t16-menu-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 14px;
}
@media (min-width: 768px) {
    .t16-menu-grid { grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 18px; }
}
@media (min-width: 1100px) {
    .t16-menu-grid { grid-template-columns: repeat(4, minmax(0, 1fr)); }
}

.t16-card {
    background: var(--t16-card); border-radius: var(--t16-radius);
    border: 1px solid var(--t16-line); overflow: hidden;
    display: flex; flex-direction: column;
    box-shadow: 0 4px 16px rgba(26,23,20,.04);
    transition: box-shadow .25s ease;
    animation: t16CardIn .45s ease both;
}
.t16-card:hover { box-shadow: var(--t16-shadow); }
@keyframes t16CardIn {
    from { opacity: 0; }
    to { opacity: 1; }
}
.t16-card-media {
    position: relative; display: block; aspect-ratio: 1.15 / 1;
    background: #efe8e1; overflow: hidden;
}
.t16-card-media img {
    width: 100%; height: 100%; object-fit: cover; display: block;
    transition: transform .4s ease;
}
.t16-card:hover .t16-card-media img { transform: scale(1.04); }
.t16-card-off {
    position: absolute; top: 10px; <?php echo e($t16Rtl ? 'left: 10px;' : 'right: 10px;'); ?>

    background: #c0392b; color: #fff; font-size: .72rem; font-weight: 800;
    border-radius: 999px; padding: 3px 8px;
}
.t16-card-body {
    padding: 14px 14px 12px; display: flex; flex-direction: column; gap: 6px; flex: 1;
}
.t16-card-name {
    font-size: 1rem; font-weight: 800; color: var(--t16-ink);
    text-decoration: none; line-height: 1.35;
    display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;
}
.t16-card-name:hover { color: var(--t16-primary); }
.t16-card-desc {
    margin: 0; color: var(--t16-muted); font-size: .84rem; line-height: 1.45;
    display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;
}
.t16-card-footer {
    margin-top: auto; padding-top: 10px;
    display: flex; align-items: center; justify-content: space-between; gap: 8px;
    flex-wrap: nowrap; min-width: 0;
}
.t16-card-price-wrap {
    min-width: 0; flex: 1 1 auto;
    display: flex; flex-wrap: wrap; align-items: baseline; gap: 4px;
}
.t16-price {
    font-size: .95rem; font-weight: 800; color: var(--t16-primary);
    white-space: nowrap;
}
.t16-old-price { font-size: .78rem; color: #9a9088; text-decoration: line-through; }
.t16-add-btn {
    display: inline-flex; align-items: center; justify-content: center; gap: 4px;
    height: 34px; padding: 0 10px; border: 0; border-radius: 999px;
    background: var(--t16-primary); color: #fff; font-size: .78rem; font-weight: 700;
    text-decoration: none; cursor: pointer; white-space: nowrap; flex: 0 0 auto;
    transition: filter .2s, transform .2s;
}
.t16-add-btn:hover { filter: brightness(.95); color: #fff; text-decoration: none; transform: translateY(-1px); }
.t16-qty {
    display: none; align-items: center; gap: 0;
    height: 36px; border-radius: 999px; overflow: hidden;
    background: var(--t16-primary-soft); border: 1px solid color-mix(in srgb, var(--t16-primary) 25%, transparent);
}
.t16-qty-btn {
    width: 34px; height: 36px; border: 0; background: transparent;
    color: var(--t16-primary); font-size: 1.1rem; font-weight: 700; cursor: pointer;
}
.t16-qty-num { min-width: 28px; text-align: center; font-weight: 800; color: var(--t16-ink); }
.t16-out-badge {
    font-size: .75rem; font-weight: 700; color: #9a9088;
    background: #f0ebe6; border-radius: 999px; padding: 6px 10px;
}

.t16-empty {
    text-align: center; padding: 48px 16px; color: var(--t16-muted);
    background: var(--t16-card); border-radius: var(--t16-radius); border: 1px dashed var(--t16-line);
}
.t16-empty i { font-size: 2rem; margin-bottom: 10px; opacity: .45; display: block; }

.t16-search-local {
    position: relative; margin: 8px 0 18px;
}
.t16-search-local input {
    width: 100%; height: 48px; border-radius: 999px; border: 1px solid var(--t16-line);
    background: #fff; outline: none; font-size: .98rem;
    <?php echo e($t16Rtl ? 'padding: 0 46px 0 16px;' : 'padding: 0 16px 0 46px;'); ?>

}
.t16-search-local input:focus {
    border-color: color-mix(in srgb, var(--t16-primary) 50%, #ccc);
    box-shadow: 0 0 0 3px color-mix(in srgb, var(--t16-primary) 16%, transparent);
}
.t16-search-local i {
    position: absolute; top: 50%; transform: translateY(-50%);
    <?php echo e($t16Rtl ? 'right: 16px;' : 'left: 16px;'); ?>

    color: #9a8f86;
}
.t16-back-link {
    display: inline-flex; align-items: center; gap: 8px;
    color: var(--t16-muted); text-decoration: none; font-weight: 700; font-size: .92rem;
    margin-bottom: 6px;
}
.t16-back-link:hover { color: var(--t16-primary); }
.t16-pagination { margin-top: 24px; display: flex; justify-content: center; }
.copy-right-sec.t16-hidden-copy,
.t16-footer,
.t16-footer-features { display: none !important; }

/* Category chips live inside .t16-header (moved by JS) */
.t16-sticky-chips {
    position: relative !important;
    top: auto !important;
    z-index: 1;
    background: #fff;
    padding: 0 0 10px;
    margin: 0;
    border-bottom: 0;
    box-shadow: none;
}
.t16-header .t16-sticky-chips {
    width: 100%;
    padding: 8px 0 10px;
    border-top: 1px solid rgba(0,0,0,.06);
    background: #fff;
}
.t16-header .t16-sticky-chips .t16-cat-chips {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 16px;
}
.t16-menu-section {
    scroll-margin-top: calc(var(--t16-header-offset, 120px) + 16px);
    padding-top: 18px;
}
.t16-menu-section + .t16-menu-section { margin-top: 8px; }
.t16-section-more {
    font-weight: 700; font-size: .88rem; color: var(--t16-primary);
    text-decoration: none; white-space: nowrap;
}
.t16-section-more:hover { text-decoration: underline; color: var(--t16-primary); }

/* Cart drawer */
.t16-drawer-backdrop {
    position: fixed; inset: 0; background: rgba(26,23,20,.32); z-index: 1100;
    opacity: 0; transition: opacity .25s; pointer-events: none;
    backdrop-filter: blur(1px);
}
.t16-drawer-backdrop.is-open { opacity: 1; pointer-events: auto; }
.t16-cart-drawer {
    position: fixed; top: 0; bottom: 0; z-index: 10040;
    width: min(400px, 100vw); background: #fff;
    display: flex; flex-direction: column;
    transition: transform .28s ease, visibility .28s;
    box-shadow: 0 0 40px rgba(26,23,20,.12);
    visibility: hidden; pointer-events: none;
}
.t16-cart-drawer.is-ltr {
    right: 0; left: auto;
    transform: translateX(110%);
}
.t16-cart-drawer.is-rtl {
    left: 0; right: auto;
    transform: translateX(-110%);
}
.t16-cart-drawer.is-open {
    transform: translateX(0);
    visibility: visible;
    pointer-events: auto;
}
.t16-drawer-backdrop { z-index: 10030 !important; }
html.t16-drawer-lock { overflow: hidden; }
.t16-drawer-head {
    display: flex; align-items: center; justify-content: space-between;
    padding: 16px 18px; border-bottom: 1px solid var(--t16-line);
}
.t16-drawer-head h2 { margin: 0; font-size: 1.1rem; font-weight: 800; }
.t16-drawer-close {
    width: 36px; height: 36px; border: 0; border-radius: 50%;
    background: var(--t16-bg); color: var(--t16-ink); cursor: pointer;
    display: inline-flex; align-items: center; justify-content: center;
}
.t16-drawer-body {
    flex: 1; overflow-y: auto; padding: 14px; background: var(--t16-bg);
}
.t16-drawer-empty {
    min-height: 48%; display: flex; flex-direction: column;
    align-items: center; justify-content: center; text-align: center; padding: 40px 16px;
    color: var(--t16-muted);
}
.t16-drawer-empty i { font-size: 2rem; margin-bottom: 12px; opacity: .45; }
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
.t16-drawer-btn.solid:hover { filter: brightness(.95); color: #fff; }

.t16-cart-item {
    display: grid; grid-template-columns: 76px 1fr; gap: 12px;
    padding: 12px; margin-bottom: 10px;
    background: #fff; border: 1px solid var(--t16-line); border-radius: 14px;
    box-shadow: 0 2px 10px rgba(26,23,20,.03);
}
.t16-cart-item-img {
    width: 76px; height: 76px; border-radius: 12px; overflow: hidden;
    background: #efe8e1; display: block;
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
    border: 0; background: transparent; color: #b0a59c; cursor: pointer;
    width: 28px; height: 28px; border-radius: 8px; flex-shrink: 0;
    display: inline-flex; align-items: center; justify-content: center;
}
.t16-cart-remove:hover { color: #c0392b; background: #fff1f0; }
.t16-cart-item-meta {
    display: flex; flex-wrap: wrap; gap: 6px; color: #9a9088; font-size: .75rem;
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
    .t16-menu-section { scroll-margin-top: calc(var(--t16-header-offset, 140px) + 12px); }
}
@media (max-width: 576px) {
    .t16-menu-grid { gap: 10px; }
    .t16-card-body { padding: 12px 10px 10px; }
    .t16-card-footer { gap: 6px; align-items: center; }
    .t16-card-price-wrap { flex: 1 1 auto; min-width: 0; }
    .t16-price { font-size: .82rem; }
    .t16-add-btn {
        width: 34px; height: 34px; padding: 0; border-radius: 50%;
        flex: 0 0 34px;
    }
    .t16-add-btn span { display: none; }
    .t16-add-btn i { margin: 0; font-size: .95rem; }
    .t16-qty { height: 34px; flex: 0 0 auto; }
    .t16-qty-btn { width: 30px; height: 34px; }
}
</style>
<?php /**PATH C:\laragon\www\matjarhub\resources\views/front/template-16/_theme_styles.blade.php ENDPATH**/ ?>