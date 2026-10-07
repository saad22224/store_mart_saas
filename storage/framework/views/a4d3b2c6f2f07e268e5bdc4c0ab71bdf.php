<style>
    :root {
        --mp-ink: #111111;
        --mp-ink-soft: #2a2a2a;
        --mp-sand: #f0eee9;
        --mp-sand-deep: #e8e4dc;
        --mp-coral: #e53935;
        --mp-coral-dark: #c62828;
        --mp-muted: #8a8a8a;
        --mp-line: #e2ddd4;
        --mp-white: #ffffff;
        --mp-radius: 14px;
        --mp-shadow: 0 2px 14px rgba(0,0,0,0.06);
        --mp-font: 'Cairo', 'Segoe UI', Tahoma, sans-serif;
        --mp-footer: #1a1a1a;
    }

    .mp-body, .mp-header, .mp-home, .mp-category, .mp-detail,
    .mp-cart-page, .mp-search-page, .mp-cms-page, .mp-footer {
        font-family: var(--mp-font);
    }
    .mp-home, .mp-category, .mp-detail, .mp-cart-page, .mp-search-page, .mp-cms-page {
        background: var(--mp-sand); color: var(--mp-ink); direction: rtl; min-height: 55vh;
    }
    .mp-wrap { max-width: 1200px; margin: 0 auto; padding: 0 20px; }

    /* ===== Header (reference) ===== */
    .mp-header {
        background: #fff; border-bottom: 1px solid #eee;
        position: sticky; top: 0; z-index: 1000;
    }
    .mp-header-inner {
        max-width: 1200px; margin: 0 auto; padding: 16px 20px;
        display: grid; grid-template-columns: 1fr auto 1fr;
        align-items: center; gap: 16px; direction: rtl;
    }
    .mp-logo { justify-self: start; text-decoration: none; }
    .mp-logo img { max-height: 42px; max-width: 140px; object-fit: contain; }
    .mp-logo-text { font-weight: 800; font-size: 1.1rem; color: var(--mp-ink); }
    .mp-nav-policies {
        display: flex; align-items: center; justify-content: center; gap: 28px; flex-wrap: wrap;
    }
    .mp-nav-policies a {
        color: #555; text-decoration: none; font-size: 0.88rem; font-weight: 500;
        white-space: nowrap;
    }
    .mp-nav-policies a:hover { color: var(--mp-ink); }
    .mp-actions {
        display: flex; align-items: center; gap: 14px;
        justify-self: end; direction: ltr;
    }
    .mp-icon-plain {
        width: 36px; height: 36px; border: 0; background: transparent;
        color: var(--mp-ink); font-size: 1.15rem; cursor: pointer;
        display: inline-flex; align-items: center; justify-content: center;
        position: relative; padding: 0;
    }
    .mp-icon-plain:hover { opacity: .7; }
    .mp-cart-count, #cartcnt.mp-cart-count {
        position: absolute; top: -2px; left: -4px;
        min-width: 16px; height: 16px; border-radius: 99px;
        background: var(--mp-coral); color: #fff; font-size: 9px; font-weight: 700;
        display: flex; align-items: center; justify-content: center; padding: 0 3px;
    }
    .mp-menu-btn { display: none; }
    .mp-mobile-nav {
        display: none; border-top: 1px solid #eee; background: #fff;
        padding: 10px 20px 14px; direction: rtl;
    }
    .mp-mobile-nav.is-open { display: block; }
    .mp-mobile-nav a {
        display: block; padding: 10px 0; color: var(--mp-ink);
        text-decoration: none; font-weight: 600; border-bottom: 1px solid #f0f0f0;
        font-size: 0.92rem;
    }

    /* ===== Section header + product rail ===== */
    .mp-home { overflow-x: clip; }
    /*
     * CRITICAL: .mp-wrap already sets horizontal padding.
     * Do NOT reset padding to "28px 0" or cards stick to the viewport edge.
     */
    .mp-wrap.mp-home-sections,
    .mp-home-sections {
        padding: 28px 20px 48px;
        width: 100%;
        max-width: 1200px;
        margin-left: auto;
        margin-right: auto;
        box-sizing: border-box;
    }
    .mp-product-sec {
        margin-bottom: 36px;
        width: 100%;
        max-width: 100%;
        box-sizing: border-box;
        overflow: hidden;
    }
    .mp-sec-bar {
        display: flex; align-items: center; justify-content: space-between;
        gap: 12px 16px; margin-bottom: 16px; direction: rtl;
        width: 100%; flex-wrap: nowrap;
        box-sizing: border-box;
    }
    .mp-sec-title {
        margin: 0; font-size: clamp(1.05rem, 2vw, 1.35rem); font-weight: 800;
        color: var(--mp-ink); text-transform: uppercase; letter-spacing: .02em;
        border-bottom: 3px solid var(--mp-ink); padding-bottom: 5px;
        display: inline-block; flex: 0 1 auto; min-width: 0;
        line-height: 1.3;
    }
    .mp-sec-controls {
        display: flex; align-items: center; gap: 8px;
        flex: 0 0 auto; margin-inline-start: auto;
    }
    .mp-view-all {
        display: inline-flex; align-items: center; justify-content: center;
        padding: 6px 14px; border: 1px solid #bbb; border-radius: 999px;
        color: var(--mp-ink); text-decoration: none; font-weight: 700; font-size: 0.82rem;
        background: transparent; white-space: nowrap;
    }
    .mp-view-all:hover { border-color: var(--mp-ink); color: var(--mp-ink); }
    .mp-scroll-btn {
        width: 34px; height: 34px; border-radius: 50%; border: 1px solid #bbb;
        background: #fff; color: var(--mp-ink); cursor: pointer;
        display: inline-flex; align-items: center; justify-content: center;
        flex-shrink: 0;
    }
    .mp-scroll-btn:hover { border-color: var(--mp-ink); }

    /* Fixed compact card width — never 33vw / giant cards */
    .mp-product-rail {
        --mp-card-w: 220px;
        display: flex;
        gap: 12px;
        overflow-x: auto;
        overflow-y: hidden;
        scroll-snap-type: x mandatory;
        padding: 0 0 8px;
        margin: 0;
        -webkit-overflow-scrolling: touch;
        scrollbar-width: none;
        direction: rtl;
        justify-content: flex-start;
        align-items: stretch;
        width: 100%;
        max-width: 100%;
        box-sizing: border-box;
    }
    .mp-product-rail::-webkit-scrollbar { display: none; }
    .mp-product-rail .mp-card,
    .mp-product-rail.is-grid .mp-card {
        flex: 0 0 var(--mp-card-w);
        width: var(--mp-card-w);
        max-width: var(--mp-card-w);
        min-width: var(--mp-card-w);
        scroll-snap-align: start;
        box-sizing: border-box;
    }
    /* Keep same compact size even for 1–3 products (no stretching) */
    .mp-product-rail.is-grid {
        display: flex;
        overflow-x: auto;
        grid-template-columns: unset;
        max-width: 100%;
    }
    .mp-product-rail.is-grid[data-count="1"],
    .mp-product-rail.is-grid[data-count="2"] {
        grid-template-columns: unset;
        max-width: 100%;
        justify-content: flex-start;
    }
    .mp-section-image-only { padding: 0; }
    .mp-image-only-wrap {
        max-width: 1120px; margin: 0 auto; padding: 0 0 8px;
    }
    .mp-image-only-wrap img {
        width: 100%; height: auto; display: block; border-radius: 0;
        vertical-align: middle;
    }

    /* ===== Product card (compact) ===== */
    .mp-card {
        background: #fff; border-radius: 12px; overflow: hidden;
        display: flex; flex-direction: column;
        box-shadow: 0 1px 8px rgba(0,0,0,.06);
    }
    .mp-card-media {
        position: relative; aspect-ratio: 3 / 4; background: #f5f2ec;
        width: 100%; overflow: hidden; flex-shrink: 0;
    }
    .mp-card-img { width: 100%; height: 100%; object-fit: cover; display: block; }
    .mp-card-img-link { display: block; width: 100%; height: 100%; }
    .mp-badge {
        position: absolute; top: 8px; left: 8px; right: auto; z-index: 2;
        padding: 3px 8px; border-radius: 999px; font-size: 0.7rem; font-weight: 800; color: #fff;
    }
    .mp-badge-sale { background: var(--mp-coral); }
    .mp-card-quick {
        position: absolute; bottom: 8px; right: 8px; left: auto;
        width: 34px; height: 34px; border-radius: 50%; border: 0;
        background: #111; color: #fff;
        display: inline-flex; align-items: center; justify-content: center;
        box-shadow: 0 2px 10px rgba(0,0,0,.12); text-decoration: none; z-index: 2;
        cursor: pointer; padding: 0; font-size: 0.8rem;
    }
    .mp-card-quick:hover { background: #000; color: #fff; }
    .mp-card-body { padding: 10px 10px 12px; text-align: center; }
    .mp-card-title {
        margin: 0 0 6px; font-size: 0.86rem; font-weight: 700; line-height: 1.4;
        display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;
    }
    .mp-card-title a { color: var(--mp-ink); text-decoration: none; }
    .mp-card-price {
        display: flex; align-items: baseline; justify-content: center;
        gap: 10px; flex-wrap: wrap;
    }
    .mp-price-was { color: var(--mp-muted); text-decoration: line-through; font-size: 0.88rem; }
    .mp-price-now { color: var(--mp-coral); font-weight: 800; font-size: 1.05rem; }

    .mp-grid {
        display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px;
    }
    .mp-banner-row { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; margin: 20px 0; }
    .mp-banner-row img { width: 100%; border-radius: var(--mp-radius); display: block; }

    /* Hero */
    .mp-hero { position: relative; overflow: hidden; background: #111; margin-bottom: 28px; }
    .mp-hero-slide { display: none; position: relative; }
    .mp-hero-slide.is-active { display: block; }
    .mp-hero-slide img { width: 100%; height: 420px; object-fit: cover; opacity: .9; }
    .mp-hero-caption {
        position: absolute; inset: auto 0 0 0; padding: 28px 24px;
        background: linear-gradient(transparent, rgba(0,0,0,.75)); color: #fff; text-align: right;
    }
    .mp-hero-caption h2 { margin: 0; font-weight: 800; font-size: clamp(1.3rem, 3vw, 2rem); }

    /* Detail sections retained */
    .mp-section { padding: 28px 0; }
    .mp-section-inner { max-width: 920px; margin: 0 auto; padding: 0 16px; }
    .mp-section-heading { font-size: 1.4rem; font-weight: 800; margin: 0 0 16px; text-align: right; }
    .mp-benefits-list { list-style: none; padding: 0; margin: 0; display: grid; gap: 10px; }
    .mp-benefits-list li {
        background: #fff; border-radius: 12px; padding: 12px 14px;
        display: flex; gap: 10px; align-items: center; font-weight: 600;
    }
    .mp-benefits-list i { color: var(--mp-coral); }
    .mp-features-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 12px; }
    .mp-feature-card { background: #fff; border-radius: 14px; padding: 16px; text-align: right; }
    .mp-feature-icon {
        width: 40px; height: 40px; border-radius: 12px; background: var(--mp-sand-deep);
        display: flex; align-items: center; justify-content: center; color: var(--mp-coral); margin-bottom: 10px;
    }
    .mp-feature-card h3 { font-size: 1rem; font-weight: 800; margin: 0 0 6px; }
    .mp-feature-card p { margin: 0; color: var(--mp-muted); font-size: 0.9rem; }
    .mp-specs { margin: 0; }
    .mp-spec-row {
        display: grid; grid-template-columns: 1fr 1.4fr; gap: 10px;
        padding: 12px 0; border-bottom: 1px solid var(--mp-line);
    }
    .mp-spec-row dt { font-weight: 700; color: var(--mp-muted); }
    .mp-spec-row dd { margin: 0; font-weight: 600; }
    .mp-faq-item {
        background: #fff; border: 2px solid var(--mp-ink); border-radius: 12px;
        margin-bottom: 12px; box-shadow: 4px 4px 0 var(--mp-ink); padding: 0 14px;
    }
    .mp-faq-item summary {
        cursor: pointer; list-style: none; padding: 14px 0; font-weight: 800; text-align: right;
    }
    .mp-faq-item summary::-webkit-details-marker { display: none; }
    .mp-faq-body { padding: 0 0 14px; color: var(--mp-muted); line-height: 1.7; text-align: right; }
    .mp-trust-banner {
        background: var(--mp-ink); color: #fff; border-radius: 16px; padding: 18px;
        display: grid; grid-template-columns: repeat(auto-fit, minmax(160px, 1fr)); gap: 12px;
    }
    .mp-trust-item { display: flex; align-items: center; gap: 8px; font-weight: 600; font-size: 0.9rem; }
    .mp-trust-item i { color: var(--mp-coral); }
    .mp-video-wrap { position: relative; padding-top: 56.25%; border-radius: 16px; overflow: hidden; background: #000; }
    .mp-video-wrap iframe, .mp-video-wrap video { position: absolute; inset: 0; width: 100%; height: 100%; border: 0; }
    .mp-image-text { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; align-items: center; }
    .mp-image-text.mp-image-end { direction: ltr; }
    .mp-image-text.mp-image-end .mp-image-text-copy { direction: rtl; }
    .mp-image-text-media img { width: 100%; border-radius: 16px; display: block; }
    .mp-cta-box {
        background: #111; color: #fff; border-radius: 20px; padding: 28px; text-align: center;
    }
    .mp-cta-box .mp-section-heading { color: #fff; text-align: center; }
    .mp-cta-text { color: #ccc; margin-bottom: 16px; }
    .mp-rich-body { line-height: 1.8; text-align: right; color: var(--mp-ink-soft); }

    .mp-btn-primary {
        display: inline-flex; align-items: center; justify-content: center;
        background: #111; color: #fff; border: 1px solid #111; border-radius: 10px;
        height: 42px; padding: 0 20px; font-weight: 700; font-size: 0.9rem;
        text-decoration: none; cursor: pointer;
    }
    .mp-btn-primary:hover { background: #000; color: #fff; }
    .mp-btn-outline {
        display: inline-flex; align-items: center; justify-content: center;
        background: transparent; color: #111; border: 1px solid #111;
        border-radius: 10px; height: 42px; padding: 0 20px; font-weight: 700; font-size: 0.9rem;
        cursor: pointer; text-decoration: none;
    }
    .w-100 { width: 100%; }

    /* ===== Underline search (reference) ===== */
    .mp-search-wrap {
        min-height: 42vh; display: flex; flex-direction: column;
        align-items: center; padding-top: 12vh; padding-bottom: 48px;
    }
    .mp-underline-search {
        width: min(640px, 92%); margin: 0 auto; direction: rtl;
    }
    .mp-underline-label {
        display: block; text-align: right; font-size: 0.95rem; font-weight: 600;
        color: #666; margin-bottom: 6px;
    }
    .mp-underline-row {
        display: flex; align-items: center; gap: 12px;
        border-bottom: 1.5px solid #222; padding-bottom: 8px;
        flex-direction: row-reverse;
    }
    .mp-underline-row input {
        flex: 1; border: 0; background: transparent; outline: none;
        font-family: inherit; font-size: 1.05rem; font-weight: 600;
        color: var(--mp-ink); text-align: right; padding: 4px 0;
    }
    .mp-underline-icon {
        border: 0; background: transparent; color: #222; font-size: 1.1rem;
        cursor: pointer; padding: 0; line-height: 1;
    }
    .mp-search-empty {
        margin-top: 64px; text-align: center; color: #c5c5c5;
    }
    .mp-search-empty i { font-size: 5.5rem; display: block; margin-bottom: 18px; font-weight: 300; }
    .mp-search-empty p { margin: 0; font-size: 1.15rem; font-weight: 600; color: #b0b0b0; }

    .mp-results-meta {
        width: 100%; max-width: 1200px; margin: 28px auto 16px;
        color: var(--mp-muted); font-size: 0.92rem; text-align: right;
    }
    .mp-pagination { display: flex; justify-content: center; margin-top: 28px; width: 100%; }
    .mp-pagination .page-link {
        border-radius: 10px !important; border-color: var(--mp-line) !important;
        color: var(--mp-ink) !important; font-weight: 700;
    }
    .mp-pagination .page-item.active .page-link {
        background: var(--mp-ink) !important; border-color: var(--mp-ink) !important; color: #fff !important;
    }

    /* ===== Search overlay ===== */
    html.mp-drawer-lock, html.mp-drawer-lock body { overflow: hidden; }
    .mp-search-overlay {
        position: fixed; inset: 0; z-index: 1200; background: rgba(240,238,233,.97);
        display: flex; align-items: flex-start; justify-content: center; padding: 18vh 16px 24px;
        opacity: 0; pointer-events: none; transition: opacity .25s;
    }
    .mp-search-overlay.is-open { opacity: 1; pointer-events: auto; }
    .mp-search-panel {
        width: min(640px, 100%); position: relative;
    }
    .mp-search-close {
        position: absolute; top: -48px; left: 0; width: 40px; height: 40px;
        border: 0; background: transparent; font-size: 1.3rem; cursor: pointer; color: #222;
    }

    /* ===== Cart drawer (LEFT like reference) ===== */
    .mp-drawer-backdrop {
        position: fixed; inset: 0; background: rgba(0,0,0,.35); z-index: 1100;
        opacity: 0; transition: opacity .25s; pointer-events: none;
    }
    .mp-drawer-backdrop.is-open { opacity: 1; pointer-events: auto; }
    .mp-cart-drawer {
        position: fixed; top: 0; bottom: 0; left: 0; right: auto;
        width: min(400px, 100vw); background: #f7f3f0; z-index: 1101;
        display: flex; flex-direction: column;
        transform: translateX(-105%); transition: transform .28s ease;
        box-shadow: 12px 0 40px rgba(0,0,0,.1); direction: rtl; font-family: var(--mp-font);
    }
    .mp-cart-drawer.is-open { transform: translateX(0); }
    .mp-drawer-head {
        display: flex; align-items: center; justify-content: center;
        padding: 18px 16px; border-bottom: 1px solid #e5e0d8; position: relative;
    }
    .mp-drawer-head h2 { margin: 0; font-size: 1.15rem; font-weight: 800; text-align: center; }
    .mp-drawer-close {
        position: absolute; left: 14px; top: 50%; transform: translateY(-50%);
        width: 36px; height: 36px; border: 0; background: transparent;
        font-size: 1.2rem; cursor: pointer; color: #222;
    }
    .mp-drawer-body { flex: 1; overflow-y: auto; padding: 16px; }
    .mp-drawer-empty {
        min-height: 50%; display: flex; flex-direction: column;
        align-items: center; justify-content: center; text-align: center; padding: 40px 16px;
    }
    .mp-drawer-empty-title { margin: 0 0 8px; font-size: 1.15rem; font-weight: 800; color: #111; }
    .mp-drawer-empty-sub { margin: 0; font-size: 0.92rem; color: #888; }
    .mp-drawer-foot {
        padding: 16px; border-top: 1px solid #e5e0d8; display: grid; gap: 10px; background: #f7f3f0;
    }

    /* SweetAlert must sit ABOVE the cart drawer (drawer = 1101) */
    body:has(.mp-cart-drawer) .swal2-container {
        z-index: 12050 !important;
    }

    /* Cart page */
    .mp-breadcrumb {
        display: flex; align-items: center; gap: 8px; flex-wrap: wrap;
        font-size: 0.85rem; color: var(--mp-muted); margin-bottom: 18px;
    }
    .mp-breadcrumb a { color: var(--mp-ink-soft); text-decoration: none; font-weight: 600; }
    .mp-page-head { margin-bottom: 22px; text-align: right; }
    .mp-page-head h1 { margin: 0 0 8px; font-size: clamp(1.4rem, 3vw, 1.85rem); font-weight: 800; }
    .mp-cart-layout {
        display: grid; grid-template-columns: 1.5fr 0.9fr; gap: 20px; align-items: start;
    }
    .mp-cart-list { background: #fff; border-radius: 18px; padding: 8px 16px; }
    .mp-cart-item {
        display: grid; grid-template-columns: 88px 1fr; gap: 14px;
        padding: 16px 0; border-bottom: 1px solid var(--mp-line);
    }
    .mp-cart-item:last-child { border-bottom: 0; }
    .mp-cart-item-img {
        width: 88px; height: 88px; border-radius: 14px; overflow: hidden; background: var(--mp-sand); display: block;
    }
    .mp-cart-item-img img { width: 100%; height: 100%; object-fit: cover; }
    .mp-cart-item-top { display: flex; justify-content: space-between; gap: 10px; }
    .mp-cart-item-name { font-weight: 800; color: var(--mp-ink); text-decoration: none; font-size: 0.98rem; }
    .mp-cart-remove { border: 0; background: transparent; color: var(--mp-coral); cursor: pointer; }
    .mp-cart-item-meta { display: flex; flex-wrap: wrap; gap: 8px; margin: 6px 0 10px; color: var(--mp-muted); font-size: 0.8rem; }
    .mp-cart-item-bottom { display: flex; justify-content: space-between; align-items: center; gap: 12px; flex-wrap: wrap; }
    .mp-qty {
        display: inline-flex; align-items: center; border: 1px solid var(--mp-line);
        border-radius: 999px; overflow: hidden; background: var(--mp-sand);
    }
    .mp-qty-btn { width: 36px; height: 36px; border: 0; background: transparent; cursor: pointer; }
    .mp-qty input {
        width: 40px; border: 0; background: transparent; text-align: center;
        font-weight: 800; font-family: inherit;
    }
    .mp-cart-summary {
        background: #fff; border-radius: 18px; padding: 20px;
        position: sticky; top: 88px; box-shadow: var(--mp-shadow);
    }
    .mp-cart-summary h3 { font-size: 1.1rem; font-weight: 800; margin: 0 0 16px; }
    .mp-summary-row { display: flex; justify-content: space-between; gap: 12px; padding: 10px 0; }
    .mp-summary-note { color: var(--mp-muted); font-size: 0.8rem; border: 0; padding-top: 0; }
    .mp-summary-total { border-top: 1px solid var(--mp-line); margin-top: 8px; padding-top: 14px; font-weight: 800; }
    .mp-summary-actions { display: grid; gap: 10px; margin-top: 18px; }

    .mp-empty-state {
        text-align: center; padding: 56px 20px; background: #fff;
        border-radius: 20px; max-width: 520px; margin: 24px auto;
    }
    .mp-empty-icon {
        width: 72px; height: 72px; margin: 0 auto 18px; border-radius: 50%;
        background: var(--mp-sand); color: var(--mp-coral);
        display: flex; align-items: center; justify-content: center; font-size: 1.6rem;
    }
    .mp-empty-state h3 { font-weight: 800; margin: 0 0 8px; }
    .mp-empty-state p { color: var(--mp-muted); margin: 0 0 20px; line-height: 1.7; }

    .mp-cat-scroll {
        display: flex; gap: 8px; overflow-x: auto; padding-bottom: 12px; margin-bottom: 18px;
    }
    .mp-cat-chip {
        flex: 0 0 auto; padding: 8px 16px; border-radius: 999px;
        border: 1px solid var(--mp-line); background: #fff; color: var(--mp-ink);
        text-decoration: none; font-weight: 700; font-size: 0.88rem;
    }
    .mp-cat-chip.is-active, .mp-cat-chip:hover {
        background: var(--mp-ink); color: #fff; border-color: var(--mp-ink);
    }

    /* CMS / contact */
    .mp-cms-card { background: #fff; border-radius: 18px; padding: 24px; line-height: 1.8; }
    .mp-contact-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 18px; }
    .mp-contact-info a {
        display: flex; gap: 12px; align-items: center; text-decoration: none; color: var(--mp-ink);
        background: #fff; border-radius: 14px; padding: 14px; margin-bottom: 12px;
    }
    .mp-contact-info i {
        width: 42px; height: 42px; border-radius: 12px; background: var(--mp-sand);
        display: inline-flex; align-items: center; justify-content: center; color: var(--mp-coral);
    }
    .mp-form-label { display: block; font-weight: 700; margin-bottom: 6px; font-size: 0.9rem; }
    .mp-input, .mp-textarea {
        width: 100%; border: 1px solid var(--mp-line); border-radius: 12px;
        padding: 12px 14px; font-family: inherit; background: #fff;
    }
    .mp-textarea { min-height: 110px; resize: vertical; }
    .mp-form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }
    .mp-form-group { margin-bottom: 14px; }

    /* Footer (reference) */
    .mp-footer {
        background: var(--mp-footer); color: #fff; padding: 48px 20px 24px; margin-top: 0;
        direction: rtl;
    }
    .mp-footer-grid {
        max-width: 1100px; margin: 0 auto;
        display: grid; grid-template-columns: 1.4fr 1fr; gap: 48px;
    }
    .mp-footer h5 { color: #fff; font-weight: 700; margin: 0 0 18px; font-size: 1.05rem; }
    .mp-footer-pages ul { list-style: none; padding: 0; margin: 0; }
    .mp-footer-pages li { margin-bottom: 12px; }
    .mp-footer-pages a { color: #fff; text-decoration: none; font-size: 0.95rem; font-weight: 500; }
    .mp-footer-pages a:hover { opacity: .75; }
    .mp-news-form {
        display: flex; align-items: center; background: #fff; border-radius: 999px;
        padding: 6px 6px 6px 14px; max-width: 420px; direction: ltr;
    }
    .mp-news-form input {
        flex: 1; border: 0; outline: none; background: transparent;
        padding: 10px 8px; font-family: inherit; text-align: right; direction: rtl;
    }
    .mp-news-form button {
        width: 42px; height: 42px; border-radius: 50%; border: 0;
        background: #111; color: #fff; cursor: pointer;
        display: inline-flex; align-items: center; justify-content: center;
    }
    .mp-footer-bottom {
        max-width: 1100px; margin: 36px auto 0; padding-top: 18px;
        border-top: 1px solid rgba(255,255,255,.1); text-align: center;
        color: #888; font-size: 0.85rem;
    }

    body:has(.mp-header) .btn-store {
        background: var(--mp-ink) !important; border-color: var(--mp-ink) !important;
        border-radius: 999px !important; font-family: var(--mp-font); font-weight: 800;
    }

    @media (max-width: 992px) {
        .mp-grid { grid-template-columns: repeat(3, 1fr); }
        .mp-features-grid { grid-template-columns: 1fr 1fr; }
        .mp-image-text { grid-template-columns: 1fr; }
        .mp-cart-layout { grid-template-columns: 1fr; }
        .mp-cart-summary { position: static; }
        .mp-contact-grid { grid-template-columns: 1fr; }
        .mp-footer-grid { grid-template-columns: 1fr; gap: 32px; }
        .mp-nav-policies { display: none; }
        .mp-menu-btn { display: inline-flex; }
        .mp-header-inner { grid-template-columns: auto 1fr auto; }
        .mp-logo { justify-self: center; }
        .mp-actions { justify-self: start; }
    }
    @media (min-width: 1200px) {
        .mp-product-rail { --mp-card-w: 240px; gap: 14px; }
    }
    @media (max-width: 992px) and (min-width: 577px) {
        .mp-product-rail { --mp-card-w: 200px; gap: 12px; }
        .mp-sec-bar { gap: 10px; }
    }
    @media (max-width: 576px) {
        .mp-grid { grid-template-columns: repeat(2, 1fr); gap: 10px; }
        .mp-banner-row { grid-template-columns: 1fr; }
        .mp-features-grid { grid-template-columns: 1fr; }
        .mp-hero-slide img { height: 240px; }
        .mp-form-row { grid-template-columns: 1fr; }
        .mp-wrap.mp-home-sections,
        .mp-home-sections { padding: 18px 14px 32px; }
        .mp-product-sec { margin-bottom: 24px; overflow: hidden; }
        .mp-sec-bar {
            flex-wrap: wrap; row-gap: 10px; margin-bottom: 12px;
        }
        .mp-sec-title { font-size: 1rem; }
        .mp-sec-controls { width: auto; justify-content: flex-start; }
        .mp-product-rail {
            --mp-card-w: 156px;
            gap: 10px;
            margin: 0;
            padding: 0 0 6px;
        }
        .mp-scroll-btn { width: 32px; height: 32px; }
        .mp-view-all { padding: 5px 10px; font-size: 0.78rem; }
        .mp-image-only-wrap { padding: 0; }
        .mp-card-body { padding: 8px 8px 10px; }
        .mp-card-title { font-size: 0.8rem; }
        .mp-card-quick { width: 30px; height: 30px; bottom: 8px; right: 8px; font-size: 0.72rem; }
        .mp-price-now { font-size: 0.92rem; }
    }
</style>
<?php /**PATH C:\laragon\www\matjarhub\resources\views/front/template-22/partials/theme_styles.blade.php ENDPATH**/ ?>