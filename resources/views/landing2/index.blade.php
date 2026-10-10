<!DOCTYPE html>

<html class="scroll-smooth" dir="{{ $lang == 'ar' ? 'rtl' : 'ltr' }}" lang="{{ $lang }}">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>{{ @$translations['meta']['page_title'] ?? 'Matjar Hub' }}</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>

    {{-- AOS - Animate On Scroll --}}
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css" />

    {{-- Toastify - Toast Notifications --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;900&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet" />

    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#15AC82",
                        "secondary": "#0D8D6B",
                        "accent": "#FACC15",
                        "on-primary": "#ffffff",
                        "background": "#F8FAFC",
                        "surface": "#ffffff",
                        "on-surface": "#0F172A",
                        "on-surface-variant": "#475569",
                        "outline-variant": "#E2E8F0",
                        "surface-container": "#F1F5F9",
                        "surface-container-low": "#F8FAFC",
                        "surface-container-lowest": "#ffffff",
                        "surface-container-high": "#E2E8F0",
                        "surface-container-highest": "#CBD5E1",
                    },
                    fontFamily: {
                        "headline": ["Cairo"],
                        "body": ["Cairo"],
                    },
                    borderRadius: {
                        "DEFAULT": "0.5rem",
                        "lg": "1rem",
                        "xl": "1.5rem",
                        "2xl": "2rem",
                        "full": "9999px"
                    },
                },
            },
        }
    </script>

    <style>
        /* ===== Base ===== */
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            max-width: 100%;
        }

        html,
        body {
            overflow-x: hidden;
            width: 100%;
        }

        body {
            font-family: 'Cairo', sans-serif;
            line-height: 1.6;
            min-height: 100dvh;
            background-color: #F8FAFC;
            color: #0F172A;
        }

        h1,
        h2,
        h3 {
            font-family: 'Cairo', sans-serif;
            line-height: 1.2;
            font-weight: 900;
        }

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        /* ===== Utility ===== */
        .gradient-text {
            background: linear-gradient(135deg, #15AC82 0%, #0D8D6B 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .gradient-bg {
            background: linear-gradient(135deg, #15AC82 0%, #0D8D6B 100%);
        }

        /* ===== Floating Header (EasyOrders Style) ===== */
        .site-header {
            position: fixed;
            top: 1rem;
            left: 50%;
            transform: translateX(-50%);
            width: calc(100% - 2rem);
            max-width: 1240px;
            z-index: 100;
            background: rgba(255, 255, 255, 0.88);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(226, 232, 240, 0.8);
            border-radius: 9999px;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.05);
            padding: 0.4rem 1.25rem;
            transition: all 0.3s ease;
        }

        .site-nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
            width: 100%;
            min-width: 0;
        }

        .nav-logo {
            flex-shrink: 0;
        }

        .nav-logo img {
            height: 38px;
            width: auto;
            object-fit: contain;
        }

        .nav-links {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1.1rem;
            flex: 1 1 auto;
            min-width: 0;
        }

        .nav-links a {
            font-size: 0.9rem;
            font-weight: 700;
            color: #334155;
            text-decoration: none;
            transition: color 0.2s ease, transform 0.2s ease;
            white-space: nowrap;
        }

        .nav-links a:hover,
        .nav-links a.active {
            color: #15AC82;
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-nav-login,
        .btn-nav-cta,
        .btn-primary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 2.35rem;
            padding: 0.45rem 1.15rem;
            border-radius: 9999px;
            font-weight: 700;
            font-size: 0.82rem;
            font-family: 'Cairo', sans-serif;
            cursor: pointer;
            white-space: nowrap;
            line-height: 1;
            transition: background 0.2s, color 0.2s, border-color 0.2s, transform 0.2s, box-shadow 0.2s;
        }

        .btn-nav-login {
            background: #fff;
            color: #0D8D6B;
            border: 1.5px solid #15AC82;
            box-shadow: none;
        }

        .btn-nav-login:hover {
            background: #ECFDF5;
            transform: translateY(-1px);
        }

        .btn-nav-cta,
        .btn-primary {
            background: linear-gradient(135deg, #15AC82, #0D8D6B);
            color: #fff;
            border: 1.5px solid transparent;
            box-shadow: 0 4px 14px rgba(21, 172, 130, 0.28);
        }

        .btn-nav-cta:hover,
        .btn-primary:hover {
            opacity: 0.95;
            transform: translateY(-1px);
        }

        .nav-hamburger {
            width: 2.5rem;
            height: 2.5rem;
            align-items: center;
            justify-content: center;
            border-radius: 9999px;
            transition: background 0.2s ease;
        }

        @media (max-width: 1279.98px) {
            .nav-hamburger { display: inline-flex; }
        }

        @media (min-width: 1280px) {
            .nav-hamburger { display: none !important; }
        }

        .nav-hamburger:hover {
            background: #F1F5F9;
        }

        /* ===== Side Drawer Menu ===== */
        .nav-drawer-backdrop {
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.45);
            backdrop-filter: blur(4px);
            -webkit-backdrop-filter: blur(4px);
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.35s ease, visibility 0.35s ease;
            z-index: 9998;
        }

        .nav-drawer {
            position: fixed;
            top: 0;
            bottom: 0;
            inset-inline-end: 0;
            width: min(360px, 88vw);
            max-width: 100%;
            background: #ffffff;
            display: flex;
            flex-direction: column;
            z-index: 9999;
            box-shadow: -24px 0 60px rgba(15, 23, 42, 0.18);
            transform: translateX(100%);
            visibility: hidden;
            transition: transform 0.42s cubic-bezier(0.22, 1, 0.36, 1), visibility 0.42s;
            will-change: transform;
            overscroll-behavior: contain;
        }

        [dir="rtl"] .nav-drawer {
            transform: translateX(-100%);
            box-shadow: 24px 0 60px rgba(15, 23, 42, 0.18);
        }

        .nav-drawer-open .nav-drawer-backdrop {
            opacity: 1;
            visibility: visible;
        }

        .nav-drawer-open .nav-drawer,
        [dir="rtl"] .nav-drawer-open .nav-drawer {
            transform: translateX(0);
            visibility: visible;
        }

        .nav-drawer-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1.1rem 1.25rem;
            border-bottom: 1px solid #F1F5F9;
        }

        .nav-drawer-logo img {
            height: 36px;
            width: auto;
            object-fit: contain;
        }

        .nav-drawer-close {
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 9999px;
            border: 1px solid #E2E8F0;
            background: #fff;
            color: #0F172A;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background 0.2s ease, transform 0.2s ease;
        }

        .nav-drawer-close:hover {
            background: #F1F5F9;
            transform: rotate(90deg);
        }

        .nav-drawer-links {
            flex: 1;
            overflow-y: auto;
            scrollbar-width: thin;
            scrollbar-color: #E2E8F0 transparent;
            padding: 0.9rem 0.85rem;
            display: flex;
            flex-direction: column;
            gap: 0.2rem;
        }

        .nav-drawer-links a {
            display: flex;
            align-items: center;
            gap: 0.85rem;
            padding: 0.8rem 0.95rem;
            border-radius: 0.9rem;
            font-size: 1rem;
            font-weight: 700;
            color: #1E293B;
            text-decoration: none;
            transition: background 0.2s ease, color 0.2s ease, transform 0.2s ease;
            opacity: 0;
            transform: translateX(14px);
        }

        [dir="rtl"] .nav-drawer-links a {
            transform: translateX(-14px);
        }

        .nav-drawer-open .nav-drawer-links a {
            opacity: 1;
            transform: translateX(0);
            transition: opacity 0.35s ease var(--d, 0s), transform 0.35s ease var(--d, 0s), background 0.2s ease, color 0.2s ease;
        }

        .nav-drawer-links a:nth-child(1) { --d: 0.08s; }
        .nav-drawer-links a:nth-child(2) { --d: 0.12s; }
        .nav-drawer-links a:nth-child(3) { --d: 0.16s; }
        .nav-drawer-links a:nth-child(4) { --d: 0.20s; }
        .nav-drawer-links a:nth-child(5) { --d: 0.24s; }
        .nav-drawer-links a:nth-child(6) { --d: 0.28s; }
        .nav-drawer-links a:nth-child(7) { --d: 0.32s; }
        .nav-drawer-links a:nth-child(8) { --d: 0.36s; }

        .nav-drawer-links a .material-symbols-outlined {
            font-size: 1.3rem;
            color: #64748B;
            transition: color 0.2s ease;
        }

        .nav-drawer-links a:hover,
        .nav-drawer-links a.active {
            background: #ECFDF5;
            color: #0D8D6B;
        }

        .nav-drawer-links a:hover .material-symbols-outlined,
        .nav-drawer-links a.active .material-symbols-outlined {
            color: #15AC82;
        }

        .nav-drawer-foot {
            padding: 1rem 1.25rem calc(1.25rem + env(safe-area-inset-bottom));
            border-top: 1px solid #F1F5F9;
            display: flex;
            flex-direction: column;
            gap: 0.6rem;
            background: #F8FAFC;
        }

        .nav-drawer-lang {
            display: flex;
            background: #E2E8F0;
            border-radius: 9999px;
            padding: 0.25rem;
            gap: 0.25rem;
            margin-bottom: 0.3rem;
        }

        .nav-drawer-lang a {
            flex: 1;
            text-align: center;
            padding: 0.5rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.85rem;
            font-weight: 700;
            color: #475569;
            text-decoration: none;
            transition: background 0.2s ease, color 0.2s ease;
        }

        .nav-drawer-lang a.is-active {
            background: #fff;
            color: #0D8D6B;
            box-shadow: 0 1px 4px rgba(15, 23, 42, 0.08);
        }

        .nav-drawer-btn {
            width: 100%;
            min-height: 2.75rem;
            font-size: 0.95rem;
            text-decoration: none;
        }

        body.nav-drawer-open {
            overflow: hidden;
        }

        @media (prefers-reduced-motion: reduce) {
            .nav-drawer,
            .nav-drawer-backdrop,
            .nav-drawer-links a {
                transition: none !important;
            }
        }

        /* ===== Infinite Marquee Ticker Bar ===== */
        .marquee-section {
            width: 100%;
            overflow: hidden;
            background: #ffffff;
            border-top: 1px solid #E2E8F0;
            border-bottom: 1px solid #E2E8F0;
            padding: 1.2rem 0;
            position: relative;
        }

        .marquee-track {
            display: flex;
            gap: 2rem;
            width: max-content;
            animation: marqueeScroll 35s linear infinite;
        }

        .marquee-track:hover {
            animation-play-state: paused;
        }

        @keyframes marqueeScroll {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }

        [dir="rtl"] .marquee-track {
            animation: marqueeScrollRtl 35s linear infinite;
        }

        @keyframes marqueeScrollRtl {
            0% { transform: translateX(0); }
            100% { transform: translateX(50%); }
        }

        .marquee-item {
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            padding: 0.5rem 1.25rem;
            background: #F8FAFC;
            border: 1px solid #E2E8F0;
            border-radius: 9999px;
            font-size: 0.9rem;
            font-weight: 700;
            color: #0F172A;
            white-space: nowrap;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.02);
        }

        /* ===== Hero Section ===== */
        .hero-section {
            padding-top: 9rem;
            padding-bottom: 5rem;
            position: relative;
            overflow: hidden;
        }

        .hero-inner {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 2rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            position: relative;
            z-index: 1;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.45rem 1.1rem;
            background: rgba(21, 172, 130, 0.07);
            border-radius: 9999px;
            color: #15AC82;
            font-weight: 700;
            font-size: 0.875rem;
            margin-bottom: 2rem;
        }

        .hero-badge-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #15AC82;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
                transform: scale(1);
            }

            50% {
                opacity: 0.5;
                transform: scale(1.2);
            }
        }

        .hero-title {
            font-size: clamp(2.4rem, 6vw, 4.5rem);
            font-weight: 900;
            color: #0F172A;
            margin-bottom: 1.75rem;
            letter-spacing: -0.02em;
            max-width: 52rem;
        }

        .hero-desc {
            font-size: 1.15rem;
            color: #475569;
            max-width: 40rem;
            margin-bottom: 2.5rem;
            line-height: 1.8;
        }

        .hero-actions {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
            justify-content: center;
        }

        .btn-hero-primary {
            background: linear-gradient(135deg, #15AC82, #0D8D6B);
            color: #fff;
            padding: 0.9rem 2.5rem;
            border-radius: 9999px;
            font-size: 1.05rem;
            font-weight: 700;
            font-family: 'Cairo', sans-serif;
            border: none;
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
            box-shadow: 0 8px 30px rgba(21, 172, 130, 0.35);
        }

        .btn-hero-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 35px rgba(21, 172, 130, 0.45);
        }

        .btn-hero-primary:active {
            transform: scale(0.97);
        }

        .btn-hero-secondary {
            background: #E2E8F0;
            color: #0F172A;
            padding: 0.9rem 2.5rem;
            border-radius: 9999px;
            font-size: 1.05rem;
            font-weight: 700;
            font-family: 'Cairo', sans-serif;
            border: none;
            cursor: pointer;
            transition: background 0.2s;
        }

        .btn-hero-secondary:hover {
            background: #CBD5E1;
        }

        /* Blobs */
        .hero-blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(100px);
            z-index: 0;
            pointer-events: none;
        }

        .hero-blob-1 {
            width: 500px;
            height: 500px;
            background: rgba(21, 172, 130, 0.15);
            top: -100px;
            right: -100px;
        }

        .hero-blob-2 {
            width: 350px;
            height: 350px;
            background: rgba(13, 141, 107, 0.1);
            bottom: -80px;
            left: -80px;
        }

        /* ===== Stats Section ===== */
        .stats-section {
            padding: 4rem 2rem;
            background: #F1F5F9;
        }

        .stats-inner {
            max-width: 1280px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 2rem;
        }

        @media (min-width: 768px) {
            .stats-inner {
                grid-template-columns: repeat(4, 1fr);
            }
        }

        .stat-item {
            text-align: center;
            padding: 1.5rem 1rem;
        }

        .stat-item:not(:last-child) {
            border-left: 1px solid rgba(226, 232, 240, 0.6);
        }

        .stat-number {
            font-size: 2.25rem;
            font-weight: 900;
            color: #15AC82;
            margin-bottom: 0.4rem;
            line-height: 1;
        }

        .stat-label {
            font-size: 0.95rem;
            color: #475569;
            font-weight: 600;
        }

        /* ===== Section Shared ===== */
        .section-header {
            text-align: center;
            margin-bottom: 3.5rem;
        }

        .section-header h2 {
            font-size: clamp(1.8rem, 3.5vw, 2.5rem);
            color: #0F172A;
            margin-bottom: 1rem;
        }

        .section-header p {
            font-size: 1.05rem;
            color: #475569;
            max-width: 36rem;
            margin: 0 auto;
            line-height: 1.8;
        }

        /* ===== Why Us Section ===== */
        .why-us-section {
            padding: 6rem 2rem;
            background: #F8FAFC;
        }

        .why-us-inner {
            max-width: 1280px;
            margin: 0 auto;
        }

        .why-us-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 2rem;
        }

        @media (min-width: 768px) {
            .why-us-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        .why-card {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            padding: 2.5rem 2rem;
            background: #fff;
            border-radius: 1.5rem;
            box-shadow: 0 4px 24px rgba(15, 23, 42, 0.06);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        /* ===== Themes showcase ===== */
        .themes-section {
            padding: 5.5rem 1.5rem;
            background: #ffffff;
        }
        .themes-inner {
            max-width: 1280px;
            margin: 0 auto;
        }
        .themes-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }
        @media (min-width: 640px) {
            .themes-grid { grid-template-columns: repeat(2, 1fr); }
        }
        @media (min-width: 1024px) {
            .themes-grid { grid-template-columns: repeat(3, 1fr); }
        }
        .theme-card {
            background: #fff;
            border: 1px solid #E2E8F0;
            border-radius: 1.25rem;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(15, 23, 42, 0.05);
            transition: transform 0.25s ease, box-shadow 0.25s ease;
            display: flex;
            flex-direction: column;
        }
        .theme-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 14px 32px rgba(15, 23, 42, 0.1);
        }
        .theme-card-media {
            aspect-ratio: 16 / 11;
            background: #F1F5F9;
            overflow: hidden;
        }
        .theme-card-media img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }
        .theme-card-body {
            padding: 1.15rem 1.25rem 1.35rem;
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
            flex: 1;
        }
        .theme-card-body h3 {
            font-size: 1.1rem;
            font-weight: 800;
            color: #0F172A;
            margin: 0;
        }
        .theme-card-body .theme-preview-btn {
            margin-top: auto;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.35rem;
            padding: 0.65rem 1rem;
            border-radius: 9999px;
            background: rgba(21, 172, 130, 0.1);
            color: #0D8D6B;
            font-weight: 700;
            font-size: 0.875rem;
            text-decoration: none;
            border: 1px solid rgba(21, 172, 130, 0.25);
        }
        .theme-card-body .theme-preview-btn:hover {
            background: #15AC82;
            color: #fff;
        }
        .themes-empty {
            text-align: center;
            padding: 2.5rem 1rem;
            color: #64748B;
            background: #F8FAFC;
            border-radius: 1rem;
            border: 1px dashed #CBD5E1;
        }

        /* ===== How it works ===== */
        .how-section {
            padding: 5.5rem 1.5rem;
            background: linear-gradient(180deg, #F8FAFC 0%, #ffffff 100%);
        }
        .how-inner {
            max-width: 1100px;
            margin: 0 auto;
        }
        .how-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.25rem;
        }
        @media (min-width: 768px) {
            .how-grid { grid-template-columns: repeat(3, 1fr); }
        }
        .how-step {
            background: #fff;
            border: 1px solid #E2E8F0;
            border-radius: 1.25rem;
            padding: 1.75rem 1.5rem;
            text-align: center;
            box-shadow: 0 4px 18px rgba(15, 23, 42, 0.04);
        }
        .how-step-num {
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 9999px;
            background: linear-gradient(135deg, #15AC82, #0D8D6B);
            color: #fff;
            font-weight: 900;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
        }
        .how-step h3 {
            font-size: 1.1rem;
            font-weight: 800;
            margin: 0 0 0.5rem;
            color: #0F172A;
        }
        .how-step p {
            margin: 0;
            color: #475569;
            font-size: 0.95rem;
            line-height: 1.7;
        }

        .why-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 40px rgba(21, 172, 130, 0.12);
        }

        .why-card-icon {
            width: 5rem;
            height: 5rem;
            border-radius: 1.25rem;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.75rem;
        }

        .why-card-icon .material-symbols-outlined {
            font-size: 2.5rem;
        }

        .why-card h3 {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 0.75rem;
            color: #0F172A;
        }

        .why-card p {
            font-size: 0.95rem;
            color: #475569;
            line-height: 1.75;
        }

        /* ===== About Section ===== */
        .about-section {
            padding: 6rem 2rem;
            background: #fff;
            position: relative;
            overflow: hidden;
        }

        .about-inner {
            max-width: 1280px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr;
            gap: 4rem;
            align-items: center;
        }

        @media (min-width: 1024px) {
            .about-inner {
                grid-template-columns: 1fr 1fr;
            }
        }

        .about-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.4rem 1rem;
            background: rgba(21, 172, 130, 0.07);
            border-radius: 9999px;
            color: #15AC82;
            font-weight: 700;
            font-size: 0.875rem;
            margin-bottom: 1.25rem;
        }

        .about-content h2 {
            font-size: clamp(1.8rem, 3vw, 2.75rem);
            color: #0F172A;
            margin-bottom: 1.25rem;
        }

        .about-content p {
            font-size: 1.05rem;
            color: #475569;
            line-height: 1.85;
            margin-bottom: 2rem;
        }

        .about-checkmarks {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0.85rem 1.5rem;
        }

        .about-check {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            font-weight: 700;
            font-size: 0.95rem;
        }

        .about-check .material-symbols-outlined {
            color: #15AC82;
            font-size: 1.25rem;
        }

        .about-visual {
            position: relative;
        }

        .about-visual-box {
            aspect-ratio: 1;
            background: linear-gradient(135deg, #15AC82, #0D8D6B);
            border-radius: 3rem;
            overflow: hidden;
            box-shadow: 0 24px 80px rgba(21, 172, 130, 0.25);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .about-visual-text {
            color: #fff;
            text-align: center;
        }

        .about-visual-text .big-number {
            font-size: 4rem;
            font-weight: 900;
            line-height: 1;
            margin-bottom: 0.5rem;
        }

        .about-visual-text .sub-text {
            font-size: 1.1rem;
        }

        .about-deco-1 {
            position: absolute;
            top: -2rem;
            right: -2rem;
            width: 8rem;
            height: 8rem;
            background: rgba(250, 204, 21, 0.2);
            border-radius: 50%;
            filter: blur(30px);
        }

        .about-deco-2 {
            position: absolute;
            bottom: -2rem;
            left: -2rem;
            width: 10rem;
            height: 10rem;
            background: rgba(21, 172, 130, 0.15);
            border-radius: 50%;
            filter: blur(40px);
        }

        /* ===== FAQ Section ===== */
        .faq-section {
            padding: 6rem 2rem;
            background: #F8FAFC;
        }

        .faq-inner {
            max-width: 52rem;
            margin: 0 auto;
        }

        .faq-list {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .faq-item {
            background: #fff;
            border-radius: 1.25rem;
            overflow: hidden;
            box-shadow: 0 2px 12px rgba(15, 23, 42, 0.05);
        }

        .faq-item summary {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.4rem 1.75rem;
            cursor: pointer;
            list-style: none;
            font-weight: 700;
            font-size: 1.05rem;
            transition: color 0.2s;
        }

        .faq-item summary:hover {
            color: #15AC82;
        }

        .faq-item summary .material-symbols-outlined {
            transition: transform 0.3s;
        }

        .faq-item[open] summary .material-symbols-outlined {
            transform: rotate(180deg);
        }

        .faq-body {
            padding: 0 1.75rem 1.4rem;
            color: #475569;
            line-height: 1.8;
            border-top: 1px solid rgba(226, 232, 240, 0.6);
            padding-top: 1rem;
        }

        /* ===== Contact Section ===== */
        .contact-section {
            padding: 6rem 2rem;
            background: #fff;
        }

        .contact-inner {
            max-width: 1280px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr;
            gap: 4rem;
            align-items: start;
        }

        @media (min-width: 1024px) {
            .contact-inner {
                grid-template-columns: 1fr 1fr;
            }
        }

        .contact-info-title {
            font-size: clamp(1.8rem, 3vw, 2.5rem);
            color: #0F172A;
            margin-bottom: 1rem;
        }

        .contact-info-desc {
            font-size: 1.05rem;
            color: #475569;
            margin-bottom: 2.5rem;
            line-height: 1.8;
        }

        .contact-items {
            display: flex;
            flex-direction: column;
            gap: 1.25rem;
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 1.25rem;
        }

        .contact-item-icon {
            width: 3.25rem;
            height: 3.25rem;
            border-radius: 0.875rem;
            background: #F1F5F9;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            transition: background 0.25s, color 0.25s;
        }

        .contact-item:hover .contact-item-icon {
            background: #15AC82;
            color: #fff;
        }

        .contact-item-label {
            font-size: 0.8rem;
            color: #475569;
            margin-bottom: 0.15rem;
        }

        .contact-item-value {
            font-size: 1.05rem;
            font-weight: 700;
        }

        /* Contact Form */
        .contact-form-box {
            background: #fff;
            padding: 2.5rem;
            border-radius: 2rem;
            box-shadow: 0 8px 40px rgba(15, 23, 42, 0.07);
            border: 1px solid rgba(226, 232, 240, 0.5);
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.25rem;
            margin-bottom: 1.25rem;
        }

        @media (min-width: 640px) {
            .form-row {
                grid-template-columns: 1fr 1fr;
            }
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 0.45rem;
            margin-bottom: 1.25rem;
        }

        .form-group label {
            font-size: 0.875rem;
            font-weight: 700;
            color: #0F172A;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            background: #F8FAFC;
            border: 1.5px solid #E2E8F0;
            border-radius: 0.875rem;
            padding: 0.875rem 1rem;
            font-family: 'Cairo', sans-serif;
            font-size: 0.95rem;
            color: #0F172A;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            border-color: #15AC82;
            background: #fff;
            box-shadow: 0 0 0 3px rgba(21, 172, 130, 0.12);
        }

        .form-group textarea {
            resize: vertical;
        }

        .btn-submit {
            width: 100%;
            background: linear-gradient(135deg, #15AC82, #0D8D6B);
            color: #fff;
            padding: 1rem;
            border-radius: 1rem;
            font-size: 1.05rem;
            font-weight: 700;
            font-family: 'Cairo', sans-serif;
            border: none;
            cursor: pointer;
            transition: opacity 0.2s, transform 0.2s;
            box-shadow: 0 6px 24px rgba(21, 172, 130, 0.3);
            margin-top: 0.5rem;
        }

        .btn-submit:hover {
            opacity: 0.92;
            transform: translateY(-1px);
        }

        .btn-submit:active {
            transform: scale(0.98);
        }

        /* ===== Footer ===== */
        .site-footer {
            background: linear-gradient(180deg, #0F172A 0%, #0B1220 100%);
            color: #CBD5E1;
        }

        .footer-inner {
            max-width: 1200px;
            margin: 0 auto;
            padding: 3.5rem 1.5rem 1.5rem;
        }

        .footer-top {
            display: grid;
            grid-template-columns: 1fr;
            gap: 2rem;
            padding-bottom: 2rem;
            border-bottom: 1px solid rgba(148, 163, 184, 0.18);
        }

        @media (min-width: 768px) {
            .footer-top {
                grid-template-columns: 1.5fr 1fr 1fr;
                align-items: start;
            }
        }

        .footer-brand-name {
            font-size: 1.35rem;
            font-weight: 900;
            color: #fff;
            margin-bottom: 0.5rem;
        }

        .footer-brand-desc {
            font-size: 0.95rem;
            color: #94A3B8;
            max-width: 28rem;
            line-height: 1.75;
            margin: 0;
        }

        .footer-col-title {
            color: #fff;
            font-weight: 800;
            font-size: 0.95rem;
            margin: 0 0 0.85rem;
        }

        .footer-links {
            display: flex;
            flex-direction: column;
            gap: 0.65rem;
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .footer-links a {
            font-weight: 600;
            color: #CBD5E1;
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.2s;
        }

        .footer-links a:hover {
            color: #34D399;
        }

        .footer-bottom {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
            justify-content: space-between;
            align-items: center;
            padding-top: 1.25rem;
        }

        .footer-copy {
            font-size: 0.82rem;
            color: #64748B;
            margin: 0;
        }

        .footer-cta {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            color: #34D399;
            font-weight: 700;
            font-size: 0.88rem;
            text-decoration: none;
        }

        .footer-cta:hover {
            color: #6EE7B7;
        }



        /* ===== Who We Are Section ===== */
        .who-section {
            padding: 6rem 2rem;
            background: #fff;
            position: relative;
            overflow: hidden;
        }

        .who-inner {
            max-width: 1280px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr;
            gap: 4rem;
            align-items: center;
        }

        @media (min-width: 1024px) {
            .who-inner {
                grid-template-columns: 1fr 1fr;
            }
        }

        .who-content .section-tag {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.4rem 1rem;
            background: rgba(21, 172, 130, 0.08);
            border-radius: 9999px;
            color: #15AC82;
            font-weight: 700;
            font-size: 0.875rem;
            margin-bottom: 1.25rem;
        }

        .who-content h2 {
            font-size: clamp(1.8rem, 3vw, 2.75rem);
            color: #0F172A;
            margin-bottom: 1.25rem;
            line-height: 1.25;
        }

        .who-content p {
            font-size: 1.05rem;
            color: #475569;
            line-height: 1.85;
            margin-bottom: 1.5rem;
        }

        .who-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.25rem;
            margin-top: 2rem;
        }

        .who-stat-box {
            background: #F8FAFC;
            border-radius: 1rem;
            padding: 1.25rem 1rem;
            text-align: center;
            border: 1px solid rgba(226, 232, 240, 0.8);
            transition: border-color 0.25s, box-shadow 0.25s;
        }

        .who-stat-box:hover {
            border-color: rgba(21, 172, 130, 0.4);
            box-shadow: 0 4px 16px rgba(21, 172, 130, 0.08);
        }

        .who-stat-box .num {
            font-size: 1.75rem;
            font-weight: 900;
            color: #15AC82;
            line-height: 1;
            margin-bottom: 0.3rem;
        }

        .who-stat-box .lbl {
            font-size: 0.8rem;
            color: #475569;
            font-weight: 600;
        }

        .who-image-wrap {
            position: relative;
        }

        .who-image-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 2rem;
            display: block;
            box-shadow: 0 24px 80px rgba(15, 23, 42, 0.12);
        }

        .who-badge-float {
            position: absolute;
            bottom: -1.25rem;
            right: 1.75rem;
            background: #fff;
            border-radius: 1rem;
            padding: 0.85rem 1.25rem;
            box-shadow: 0 8px 32px rgba(15, 23, 42, 0.1);
            display: flex;
            align-items: center;
            gap: 0.75rem;
            border: 1px solid rgba(226, 232, 240, 0.6);
        }

        .who-badge-float .icon-wrap {
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 0.625rem;
            background: rgba(21, 172, 130, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #15AC82;
        }

        .who-badge-float .badge-text strong {
            display: block;
            font-weight: 700;
            font-size: 0.95rem;
            color: #0F172A;
        }

        .who-badge-float .badge-text span {
            font-size: 0.78rem;
            color: #475569;
        }

        .who-deco {
            position: absolute;
            border-radius: 50%;
            filter: blur(60px);
            pointer-events: none;
        }

        .who-deco-1 {
            width: 280px;
            height: 280px;
            background: rgba(21, 172, 130, 0.08);
            top: -60px;
            left: -60px;
        }

        .who-deco-2 {
            width: 200px;
            height: 200px;
            background: rgba(250, 204, 21, 0.1);
            bottom: -40px;
            right: -40px;
        }

        .lang-option {
            display: block;
            padding: 0.75rem 1rem;
            text-decoration: none;
            color: #0F172A;
            font-weight: 600;
            transition: background 0.2s;
        }

        .lang-option:hover {
            background: #F1F5F9;
        }

        .lang-option.active {
            background: rgba(21, 172, 130, 0.1);
            color: #15AC82;
        }

        /* ===== AOS overrides for performance ===== */
        [data-aos] {
            will-change: transform, opacity;
        }
    </style>
    {{-- @if (@helper::checkaddons('pwa')) --}}
    @php
        $admin_id = 1;
        $admin_user = App\Models\User::where('id', $admin_id)->first();
        $pwa = 0;
        if ($admin_user) {
            $checkplan = App\Models\Transaction::where('vendor_id', $admin_id)->orderByDesc('id')->first();
            if (@$admin_user->allow_without_subscription == 1) {
                $pwa = 1;
            } else {
                $pwa = @$checkplan->pwa;
            }
        }
    @endphp
    @if (helper::appdata($admin_id)->pwa == 1)
        <meta name="theme-color" content="{{ helper::appdata($admin_id)->theme_color }}">
        <meta name="background-color" content="{{ helper::appdata($admin_id)->background_color }}">
        <link rel="apple-touch-icon" href="{{ helper::image_path(helper::appdata($admin_id)->app_logo) }}">
        <link rel="manifest"
            href='data:application/manifest+json,{"name": "{{ helper::appdata($admin_id)->app_name }}","short_name": "{{ helper::appdata($admin_id)->app_name }}","icons": [{"src": "{{ helper::image_path(helper::appdata($admin_id)->app_logo) }}", "sizes": "512x512", "type": "image/png"}, {"src": "{{ helper::image_path(helper::appdata($admin_id)->app_logo) }}", "sizes": "1024x1024", "type": "image/png"}], "start_url": "{{ request()->url() }}","display": "standalone","prefer_related_applications":"false" }'>
    @endif
    {{-- @endif --}}


    <!-- Meta Pixel Code -->
    <script>
        ! function(f, b, e, v, n, t, s) {
            if (f.fbq) return;
            n = f.fbq = function() {
                n.callMethod ?
                    n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n;
            n.push = n;
            n.loaded = !0;
            n.version = '2.0';
            n.queue = [];
            t = b.createElement(e);
            t.async = !0;
            t.src = v;
            s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window, document, 'script',
            'https://connect.facebook.net/en_US/fbevents.js');

        fbq('init', '3214801062033661');
        fbq('track', 'PageView');
    </script>
    <!-- End Meta Pixel Code -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-YKTXTSENXZ"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-YKTXTSENXZ');
    </script>
</head>

<body>
    <!-- PWA Install Prompt Button -->
    <div id="installBtn"
        style="display:none; opacity:0; transform: translateY(-150%); transition: all 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);"
        class="fixed top-4 left-0 right-0 mx-auto z-[200] flex items-center justify-between gap-2 md:gap-4 bg-white px-3 md:px-4 py-3 rounded-2xl shadow-[0_10px_40px_-10px_rgba(0,0,0,0.2)] border border-gray-100 w-[92%] max-w-sm">
        <div class="flex items-center gap-2 md:gap-3 overflow-hidden">
            <div class="flex-shrink-0">
                <img src="{{ helper::image_path(helper::appdata(1)->app_logo) }}"
                    class="w-10 h-10 rounded-xl shadow-sm border border-gray-50 object-cover" alt="App Icon">
            </div>
            <div class="flex-1 min-w-0">
                <h4 class="text-[13px] md:text-sm font-bold text-gray-900 leading-tight truncate"
                    data-i18n="install.title">{{ helper::appdata(1)->app_name }}</h4>
                <p class="text-[10px] md:text-xs text-gray-500 mt-0.5 truncate" data-i18n="install.desc">تثبيت التطبيق
                    على جهازك</p>
            </div>
        </div>
        <div class="flex items-center gap-1.5 md:gap-2 flex-shrink-0">
            <button onclick="installApp()"
                class="bg-green-600 text-white text-[11px] md:text-xs font-bold px-3 py-2 rounded-xl hover:bg-green-700 transition-colors shadow-md shadow-green-500/20 active:scale-95 whitespace-nowrap"
                data-i18n="install.btn">
                تثبيت
            </button>
            <button onclick="hideInstallBtn()"
                class="w-7 h-7 md:w-8 md:h-8 flex items-center justify-center rounded-full bg-gray-50 text-gray-400 hover:bg-gray-200 hover:text-gray-700 transition-colors active:scale-95 flex-shrink-0">
                <i class="fas fa-times text-xs md:text-sm"></i>
            </button>
        </div>
    </div>

    <script>
        let deferredPrompt;
        const isIos = () => {
            const userAgent = window.navigator.userAgent.toLowerCase();
            return /iphone|ipad|ipod/.test(userAgent);
        };
        const isInStandaloneMode = () => ('standalone' in window.navigator) && (window.navigator.standalone);

        if (isIos() && !isInStandaloneMode()) {
            const installBtn = document.getElementById('installBtn');
            if (installBtn) {
                installBtn.style.display = 'flex';
                setTimeout(() => {
                    installBtn.style.transform = 'translateY(0)';
                    installBtn.style.opacity = '1';
                }, 50);
                setTimeout(() => {
                    hideInstallBtn();
                }, 10000);
            }
        }

        window.addEventListener('beforeinstallprompt', (e) => {
            console.log('👍 PWA beforeinstallprompt event fired!');
            e.preventDefault();
            deferredPrompt = e;
            const installBtn = document.getElementById('installBtn');
            if (installBtn) {
                installBtn.style.display = 'flex';
                // Trigger reflow for animation
                setTimeout(() => {
                    installBtn.style.transform = 'translateY(0)';
                    installBtn.style.opacity = '1';
                }, 50);

                // Auto-hide after 10 seconds
                setTimeout(() => {
                    hideInstallBtn();
                }, 10000);
            }
        });

        async function installApp() {
            console.log('👍 Install button clicked');
            if (isIos()) {
                alert(
                    "لتثبيت التطبيق على جهاز iOS، اضغط على زر المشاركة (Share) في المتصفح ثم اختر 'إضافة إلى الشاشة الرئيسية' (Add to Home Screen).");
                hideInstallBtn();
                return;
            }
            if (!deferredPrompt) {
                console.log('❌ No deferredPrompt saved.');
                return;
            }
            deferredPrompt.prompt();
            const {
                outcome
            } = await deferredPrompt.userChoice;
            console.log(`👍 User choice outcome: ${outcome}`);
            deferredPrompt = null;
            hideInstallBtn();
        }

        function hideInstallBtn() {
            console.log('👍 Hiding install button');
            const installBtn = document.getElementById('installBtn');
            if (installBtn) {
                installBtn.style.transform = 'translateY(-150%)';
                installBtn.style.opacity = '0';
                setTimeout(() => {
                    installBtn.style.display = 'none';
                }, 600);
            }
        }
    </script>
    {{-- meta pixel --}}
    <noscript>
        <img height="1" width="1" style="display:none"
            src="https://www.facebook.com/tr?id=3214801062033661&ev=PageView&noscript=1" />
    </noscript>
    {{-- ===== Header ===== --}}
    <header class="site-header">
        <nav class="site-nav">
            <div class="nav-logo">
                <a href="{{ url('/') }}" class="flex items-center gap-2">
                    <img class="h-9 md:h-10 w-auto object-contain" src="{{ asset('public/images/matjarhub.png') }}" alt="MatjarHub">
                </a>
            </div>

            <div class="nav-links hidden xl:flex">
                <a href="#" class="active">{{ @$translations['nav']['home'] ?? 'الرئيسية' }}</a>
                <a href="#why-us">{{ @$translations['nav']['why_us'] ?? 'لماذا نحن' }}</a>
                <a href="#themes">{{ @$translations['nav']['themes'] ?? 'القوالب' }}</a>
                <a href="#how-it-works">{{ @$translations['nav']['how_it_works'] ?? ($lang == 'en' ? 'How it works' : 'كيف تبدأ') }}</a>
                <a href="#pricing">{{ @$translations['nav']['pricing'] ?? 'الباقات والتسعير' }}</a>
                <a href="{{ url('/help') }}">{{ @$translations['nav']['support'] ?? ($lang == 'en' ? 'Support Center' : 'مركز الدعم') }}</a>
                <a href="#faq">{{ @$translations['nav']['faq'] ?? 'الأسئلة' }}</a>
                <a href="#contact">{{ @$translations['nav']['contact'] ?? 'اتصل بنا' }}</a>
            </div>

            <div class="flex items-center gap-2.5 shrink-0">
                {{-- Language Switcher --}}
                <div class="lang-switcher hidden xl:block relative">
                    <button type="button" class="lang-btn px-3 py-1.5 rounded-full bg-slate-100 border border-slate-200 text-xs font-bold text-slate-700 hover:bg-slate-200 transition flex items-center gap-1.5" onclick="toggleLangMenu()">
                        <span class="material-symbols-outlined text-base">language</span>
                        <span>{{ $lang == 'ar' ? 'العربية' : 'English' }}</span>
                        <span class="material-symbols-outlined text-sm">expand_more</span>
                    </button>
                    <div id="langMenu" class="lang-menu hidden absolute top-full mt-2 bg-white rounded-2xl shadow-xl border border-slate-100 min-w-[130px] overflow-hidden z-50">
                        <a href="?lang=ar" class="lang-option block px-4 py-2 text-xs font-bold text-slate-800 hover:bg-emerald-50 hover:text-emerald-600 transition {{ $lang == 'ar' ? 'bg-emerald-50 text-emerald-600' : '' }}">🇸🇦 العربية</a>
                        <a href="?lang=en" class="lang-option block px-4 py-2 text-xs font-bold text-slate-800 hover:bg-emerald-50 hover:text-emerald-600 transition {{ $lang == 'en' ? 'bg-emerald-50 text-emerald-600' : '' }}">🇬🇧 English</a>
                    </div>
                </div>

                <div class="nav-actions hidden sm:flex">
                    <button type="button" onclick="window.location.href = '{{ url('admin') }}'" class="btn-nav-login">
                        {{ @$translations['nav']['login'] ?? ($lang == 'en' ? 'Login' : 'تسجيل دخول') }}
                    </button>
                    <button type="button" onclick="window.location.href = '{{ url('admin/register') }}'" class="btn-nav-cta">
                        {{ @$translations['nav']['create_account'] ?? ($lang == 'en' ? 'Create your store free' : 'أنشئ متجرك مجاناً') }}
                    </button>
                </div>

                <button type="button" class="nav-hamburger xl:hidden text-slate-800 cursor-pointer bg-transparent border-0 p-0" onclick="toggleMobileMenu()" aria-controls="mobileMenu" aria-expanded="false" aria-label="Menu">
                    <span class="material-symbols-outlined text-2xl">menu</span>
                </button>
            </div>
        </nav>
    </header>

    {{-- Side Drawer Menu (mobile + tablet + small desktop) — outside .site-header because the header is transformed, which would break position:fixed --}}
        <div id="navDrawerBackdrop" class="nav-drawer-backdrop" onclick="closeMobileMenu()" aria-hidden="true"></div>
        <aside id="mobileMenu" class="nav-drawer" role="dialog" aria-modal="true" aria-label="{{ $lang == 'en' ? 'Main menu' : 'القائمة الرئيسية' }}">
            <div class="nav-drawer-head">
                <a href="{{ url('/') }}" class="nav-drawer-logo" onclick="closeMobileMenu()">
                    <img src="{{ asset('public/images/matjarhub.png') }}" alt="MatjarHub">
                </a>
                <button type="button" class="nav-drawer-close" onclick="closeMobileMenu()" aria-label="{{ $lang == 'en' ? 'Close menu' : 'إغلاق القائمة' }}">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>

            <nav class="nav-drawer-links">
                <a href="#" onclick="closeMobileMenu()" class="active">
                    <span class="material-symbols-outlined">home</span>
                    <span>{{ @$translations['nav']['home'] ?? 'الرئيسية' }}</span>
                </a>
                <a href="#why-us" onclick="closeMobileMenu()">
                    <span class="material-symbols-outlined">verified</span>
                    <span>{{ @$translations['nav']['why_us'] ?? 'لماذا نحن' }}</span>
                </a>
                <a href="#themes" onclick="closeMobileMenu()">
                    <span class="material-symbols-outlined">palette</span>
                    <span>{{ @$translations['nav']['themes'] ?? 'القوالب' }}</span>
                </a>
                <a href="#how-it-works" onclick="closeMobileMenu()">
                    <span class="material-symbols-outlined">rocket_launch</span>
                    <span>{{ @$translations['nav']['how_it_works'] ?? ($lang == 'en' ? 'How it works' : 'كيف تبدأ') }}</span>
                </a>
                <a href="#pricing" onclick="closeMobileMenu()">
                    <span class="material-symbols-outlined">sell</span>
                    <span>{{ @$translations['nav']['pricing'] ?? 'الباقات والتسعير' }}</span>
                </a>
                <a href="{{ url('/help') }}" onclick="closeMobileMenu()">
                    <span class="material-symbols-outlined">support_agent</span>
                    <span>{{ @$translations['nav']['support'] ?? ($lang == 'en' ? 'Support Center' : 'مركز الدعم') }}</span>
                </a>
                <a href="#faq" onclick="closeMobileMenu()">
                    <span class="material-symbols-outlined">help</span>
                    <span>{{ @$translations['nav']['faq'] ?? 'الأسئلة' }}</span>
                </a>
                <a href="#contact" onclick="closeMobileMenu()">
                    <span class="material-symbols-outlined">mail</span>
                    <span>{{ @$translations['nav']['contact'] ?? 'اتصل بنا' }}</span>
                </a>
            </nav>

            <div class="nav-drawer-foot">
                <div class="nav-drawer-lang" role="group" aria-label="Language">
                    <a href="?lang=ar" class="{{ $lang == 'ar' ? 'is-active' : '' }}">🇸🇦 العربية</a>
                    <a href="?lang=en" class="{{ $lang == 'en' ? 'is-active' : '' }}">🇬🇧 English</a>
                </div>
                <a href="{{ url('admin') }}" class="btn-nav-login nav-drawer-btn">
                    {{ @$translations['nav']['login'] ?? ($lang == 'en' ? 'Login' : 'تسجيل دخول') }}
                </a>
                <a href="{{ url('admin/register') }}" class="btn-nav-cta nav-drawer-btn">
                    {{ @$translations['nav']['create_account'] ?? ($lang == 'en' ? 'Create your store free' : 'أنشئ متجرك مجاناً') }}
                </a>
            </div>
        </aside>

    {{-- ===== Hero Section ===== --}}
    <section class="hero-section">
        <div class="hero-blob hero-blob-1"></div>
        <div class="hero-blob hero-blob-2"></div>

        <div class="hero-inner">
            <div class="hero-badge" data-aos="fade-down" data-aos-duration="600">
                <span class="hero-badge-dot"></span>
                {{ @$translations['hero']['badge'] ?? 'أكثر من 50,000 تاجر يثقون بنا' }}
            </div>

            <h1 class="hero-title" data-aos="fade-up" data-aos-duration="700" data-aos-delay="100">
                {{ @$translations['hero']['title_line1'] ?? 'أنشئ متجر أحلامك' }} <br />
                <span
                    class="gradient-text">{{ @$translations['hero']['title_highlight'] ?? 'في ثوانٍ معدودة' }}</span>
            </h1>

            <p class="hero-desc" data-aos="fade-up" data-aos-duration="700" data-aos-delay="200">
                {{ @$translations['hero']['description'] ?? 'منصة متكاملة تمنحك كل ما تحتاجه لإطلاق تجارتك الإلكترونية، من التصميم الاحترافي إلى إدارة المدفوعات والشحن، دون الحاجة لخبرة برمجية.' }}
            </p>

            <div class="hero-actions" data-aos="fade-up" data-aos-duration="700" data-aos-delay="300">
                <button class="btn-hero-primary"
                    onclick="window.location.href = '{{ url('admin/register') }}'">{{ @$translations['hero']['btn_primary'] ?? 'ابدأ مجاناً الآن' }}</button>
                {{-- <button class="btn-hero-secondary">{{ @$translations['hero']['btn_secondary'] ?? 'شاهد العرض التجريبي' }}</button> --}}
            </div>
        </div>
    </section>

    {{-- ===== Infinite Marquee Ticker Bar ===== --}}
    @php
        $marqueeDefaults = [
            'item1' => ['icon' => 'bolt', 'ar' => 'صفحات هبوط فائقة السرعة', 'en' => 'Ultra-fast landing pages'],
            'item2' => ['icon' => 'inventory_2', 'ar' => 'إدارة وبيع المنتجات الرقمية والفيزيائية', 'en' => 'Sell digital and physical products'],
            'item3' => ['icon' => 'chat', 'ar' => 'استقبال الطلبات والإشعارات عبر الواتساب', 'en' => 'Orders and alerts via WhatsApp'],
            'item4' => ['icon' => 'local_shipping', 'ar' => 'الربط الفوري مع شركات الشحن', 'en' => 'Instant shipping integrations'],
            'item5' => ['icon' => 'ads_click', 'ar' => 'ربط فيسبوك وتيك توك بكسل', 'en' => 'Facebook & TikTok pixel tracking'],
            'item6' => ['icon' => 'trending_up', 'ar' => 'نظام الـ Downsell وزيادة المبيعات', 'en' => 'Downsell tools to boost sales'],
            'item7' => ['icon' => 'domain', 'ar' => 'ربط الدومين الخاص بضغطة زر', 'en' => 'Connect your custom domain easily'],
            'item8' => ['icon' => 'support_agent', 'ar' => 'دعم فني مباشر 24/7', 'en' => 'Live support 24/7'],
            'item9' => ['icon' => 'point_of_sale', 'ar' => 'نظام نقاط البيع والكاشير POS', 'en' => 'POS and cashier system'],
        ];
        $marqueeItems = [];
        foreach ($marqueeDefaults as $key => $meta) {
            $marqueeItems[] = [
                'icon' => $meta['icon'],
                'text' => @$translations['marquee'][$key] ?? ($lang == 'en' ? $meta['en'] : $meta['ar']),
            ];
        }
    @endphp
    <section class="marquee-section">
        <div class="marquee-track">
            @foreach ([1, 2] as $loopPass)
                @foreach ($marqueeItems as $item)
                    <div class="marquee-item">
                        <span class="material-symbols-outlined text-emerald-600 text-base">{{ $item['icon'] }}</span>
                        <span>{{ $item['text'] }}</span>
                    </div>
                @endforeach
            @endforeach
        </div>
    </section>

    {{-- ===== Stats Section ===== --}}
    <section class="stats-section">
        <div class="stats-inner">
            <div class="stat-item" data-aos="fade-up" data-aos-duration="600">
                <div class="stat-number">{{ @$translations['stats']['stat1_number'] ?? '99.9%' }}</div>
                <div class="stat-label">{{ @$translations['stats']['stat1_label'] ?? 'استمرارية الخدمة' }}</div>
            </div>
            <div class="stat-item" data-aos="fade-up" data-aos-duration="600" data-aos-delay="80">
                <div class="stat-number">{{ @$translations['stats']['stat2_number'] ?? '50k+' }}</div>
                <div class="stat-label">{{ @$translations['stats']['stat2_label'] ?? 'متجر نشط' }}</div>
            </div>
            <div class="stat-item" data-aos="fade-up" data-aos-duration="600" data-aos-delay="160">
                <div class="stat-number">{{ @$translations['stats']['stat3_number'] ?? '120M+' }}</div>
                <div class="stat-label">{{ @$translations['stats']['stat3_label'] ?? 'مبيعات سنوية' }}</div>
            </div>
            <div class="stat-item" data-aos="fade-up" data-aos-duration="600" data-aos-delay="240">
                <div class="stat-number">{{ @$translations['stats']['stat4_number'] ?? '24/7' }}</div>
                <div class="stat-label">{{ @$translations['stats']['stat4_label'] ?? 'دعم فني مباشر' }}</div>
            </div>
        </div>
    </section>

    {{-- ===== Who We Are Section ===== --}}
    <section class="who-section" id="who-we-are">
        <div class="who-deco who-deco-1"></div>
        <div class="who-deco who-deco-2"></div>
        <div class="who-inner">

            {{-- Right: Content --}}
            <div class="who-content" data-aos="fade-left" data-aos-duration="700">
                <div class="section-tag">
                    <span class="material-symbols-outlined" style="font-size:1rem;">groups</span>
                    {{ @$translations['who_we_are']['tag'] ?? 'تعرّف علينا' }}
                </div>
                <h2>{{ @$translations['who_we_are']['title_line1'] ?? 'نحن فريق شغوف بـ' }}<br /><span
                        class="gradient-text">{{ @$translations['who_we_are']['title_highlight'] ?? 'تمكين التجارة الرقمية' }}</span>
                </h2>
                <p>
                    {{ @$translations['who_we_are']['description1'] ?? 'Matjar Hub منصة سعودية نشأت من رحم التحديات التي يواجهها التجار العرب يومياً. هدفنا الأول هو إزالة العقبات التقنية وتسليم التاجر مفاتيح متجره الاحترافي في أقل من دقيقة.' }}
                </p>
                <p>
                    {{ @$translations['who_we_are']['description2'] ?? 'نُؤمن بأن كل فكرة تستحق أن تُبنى، وكل تاجر يستحق أدوات عالمية المستوى بسعر في متناول الجميع. لذلك بنينا Matjar Hub على ثلاثة مبادئ: السرعة، البساطة، والموثوقية.' }}
                </p>

                <div class="who-stats">
                    <div class="who-stat-box" data-aos="zoom-in" data-aos-duration="500" data-aos-delay="100">
                        <div class="num">{{ @$translations['who_we_are']['stat1_number'] ?? '2019' }}</div>
                        <div class="lbl">{{ @$translations['who_we_are']['stat1_label'] ?? 'سنة التأسيس' }}</div>
                    </div>
                    <div class="who-stat-box" data-aos="zoom-in" data-aos-duration="500" data-aos-delay="200">
                        <div class="num">{{ @$translations['who_we_are']['stat2_number'] ?? '+50' }}</div>
                        <div class="lbl">{{ @$translations['who_we_are']['stat2_label'] ?? 'موظف متخصص' }}</div>
                    </div>
                    <div class="who-stat-box" data-aos="zoom-in" data-aos-duration="500" data-aos-delay="300">
                        <div class="num">{{ @$translations['who_we_are']['stat3_number'] ?? '15+' }}</div>
                        <div class="lbl">{{ @$translations['who_we_are']['stat3_label'] ?? 'دولة عربية' }}</div>
                    </div>
                </div>
            </div>

            {{-- Left: Image --}}
            <div class="who-image-wrap" data-aos="fade-right" data-aos-duration="700" data-aos-delay="150">
                <img src="{{ asset('public/images/about.jpeg') }}"
                    alt="{{ $lang == 'ar' ? 'فريق Matjar Hub' : 'Matjar Hub Team' }}" />
                <div class="who-badge-float">
                    <div class="icon-wrap">
                        <span class="material-symbols-outlined"
                            style="font-size:1.3rem;font-variation-settings:'FILL' 1;">verified</span>
                    </div>
                    <div class="badge-text">
                        <strong>{{ @$translations['who_we_are']['float_badge_title'] ?? 'موثّق ومعتمد' }}</strong>
                        <span>{{ @$translations['who_we_are']['float_badge_subtitle'] ?? 'شريك تقني معتمد في المنطقة' }}</span>
                    </div>
                </div>
            </div>

        </div>
    </section>

    {{-- ===== Why Us Section ===== --}}
    <section class="why-us-section" id="why-us">
        <div class="why-us-inner">
            <div class="section-header" data-aos="fade-up" data-aos-duration="700">
                <h2>{{ @$translations['why_us']['title'] ?? 'لماذا تختار' }} <span
                        class="gradient-text">{{ @$translations['why_us']['title_highlight'] ?? 'Matjar Hub؟' }}</span>
                </h2>
                <p>{{ @$translations['why_us']['subtitle'] ?? 'نحن نوفر لك كل الأدوات التي تحتاجها للنجاح في عالم التجارة الإلكترونية، مع التركيز على البساطة والقوة في وقت واحد.' }}
                </p>
            </div>

            <div class="why-us-grid">
                <div class="why-card" data-aos="fade-up" data-aos-duration="600" data-aos-delay="0">
                    <div class="why-card-icon" style="background:rgba(21,172,130,0.1);color:#15AC82;">
                        <span class="material-symbols-outlined">speed</span>
                    </div>
                    <h3>{{ @$translations['why_us']['card1_title'] ?? 'سرعة خارقة' }}</h3>
                    <p>{{ @$translations['why_us']['card1_desc'] ?? 'متاجرك تعمل على أحدث التقنيات السحابية لضمان سرعة تحميل لا تضاهى عالمياً.' }}
                    </p>
                </div>

                <div class="why-card" data-aos="fade-up" data-aos-duration="600" data-aos-delay="100">
                    <div class="why-card-icon" style="background:rgba(13,141,107,0.1);color:#0D8D6B;">
                        <span class="material-symbols-outlined">support_agent</span>
                    </div>
                    <h3>{{ @$translations['why_us']['card2_title'] ?? 'دعم فني 24/7' }}</h3>
                    <p>{{ @$translations['why_us']['card2_desc'] ?? 'فريقنا متواجد دائماً لمساعدتك في كل خطوة، عبر الواتساب، الهاتف، أو البريد.' }}
                    </p>
                </div>

                <div class="why-card" data-aos="fade-up" data-aos-duration="600" data-aos-delay="200">
                    <div class="why-card-icon" style="background:rgba(250,204,21,0.12);color:#ca8a04;">
                        <span class="material-symbols-outlined">integration_instructions</span>
                    </div>
                    <h3>{{ @$translations['why_us']['card3_title'] ?? 'تكامل شامل' }}</h3>
                    <p>{{ @$translations['why_us']['card3_desc'] ?? 'اربط متجرك مع كافة خدمات الشحن والدفع والتسويق بضغطة زر واحدة.' }}
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- ===== Themes Showcase (from admin/themes → vendor_themes) ===== --}}
    <section class="themes-section" id="themes">
        <div class="themes-inner">
            <div class="section-header" data-aos="fade-up" data-aos-duration="700">
                <h2>{{ @$translations['themes']['title'] ?? ($lang == 'en' ? 'Ready-made store themes' : 'قوالب متاجر جاهزة') }}</h2>
                <p>{{ @$translations['themes']['subtitle'] ?? ($lang == 'en' ? 'Choose a professional theme for your store.' : 'اختر قالباً احترافياً لمتجرك وابدأ البيع فوراً.') }}</p>
            </div>

            @php $themes = $themes ?? collect(); @endphp
            @if ($themes->count() > 0)
                <div class="themes-grid">
                    @foreach ($themes as $index => $theme)
                        @php
                            $preview = trim((string) ($theme->preview_link ?? ''));
                            $img = helper::image_path($theme->image);
                        @endphp
                        <article class="theme-card" data-aos="fade-up" data-aos-duration="600" data-aos-delay="{{ min($index * 80, 240) }}">
                            <div class="theme-card-media">
                                <img src="{{ $img }}" alt="{{ $theme->name }}" loading="lazy">
                            </div>
                            <div class="theme-card-body">
                                <h3>{{ $theme->name }}</h3>
                                @if ($preview !== '' && $preview !== '#')
                                    <a class="theme-preview-btn" href="{{ $preview }}" target="_blank" rel="noopener noreferrer">
                                        <span class="material-symbols-outlined text-base">open_in_new</span>
                                        {{ @$translations['themes']['preview_btn'] ?? ($lang == 'en' ? 'Preview theme' : 'معاينة القالب') }}
                                    </a>
                                @endif
                            </div>
                        </article>
                    @endforeach
                </div>
            @else
                <div class="themes-empty" data-aos="fade-up">
                    {{ @$translations['themes']['empty'] ?? ($lang == 'en' ? 'No themes available right now.' : 'لا توجد قوالب متاحة حالياً.') }}
                </div>
            @endif
        </div>
    </section>

    {{-- ===== How it works ===== --}}
    <section class="how-section" id="how-it-works">
        <div class="how-inner">
            <div class="section-header" data-aos="fade-up" data-aos-duration="700">
                <h2>{{ @$translations['how_it_works']['title'] ?? ($lang == 'en' ? 'How to start in 3 steps' : 'كيف تبدأ في 3 خطوات') }}</h2>
                <p>{{ @$translations['how_it_works']['subtitle'] ?? ($lang == 'en' ? 'From signup to your first order.' : 'من التسجيل إلى أول طلب — بسرعة وبدون تعقيد') }}</p>
            </div>
            <div class="how-grid">
                <div class="how-step" data-aos="fade-up" data-aos-delay="0">
                    <div class="how-step-num">1</div>
                    <h3>{{ @$translations['how_it_works']['step1_title'] ?? ($lang == 'en' ? 'Create your account' : 'أنشئ حسابك') }}</h3>
                    <p>{{ @$translations['how_it_works']['step1_desc'] ?? '' }}</p>
                </div>
                <div class="how-step" data-aos="fade-up" data-aos-delay="80">
                    <div class="how-step-num">2</div>
                    <h3>{{ @$translations['how_it_works']['step2_title'] ?? ($lang == 'en' ? 'Pick a theme and add products' : 'اختر قالباً وأضف منتجاتك') }}</h3>
                    <p>{{ @$translations['how_it_works']['step2_desc'] ?? '' }}</p>
                </div>
                <div class="how-step" data-aos="fade-up" data-aos-delay="160">
                    <div class="how-step-num">3</div>
                    <h3>{{ @$translations['how_it_works']['step3_title'] ?? ($lang == 'en' ? 'Publish and start selling' : 'انشر وابدأ البيع') }}</h3>
                    <p>{{ @$translations['how_it_works']['step3_desc'] ?? '' }}</p>
                </div>
            </div>
            <div class="text-center mt-10" data-aos="fade-up">
                <a href="{{ url('admin/register') }}" class="btn-primary inline-flex items-center gap-2 px-6 py-3 rounded-full text-white font-bold gradient-bg">
                    {{ @$translations['nav']['start_now'] ?? ($lang == 'en' ? 'Start Now' : 'ابدأ الآن') }}
                </a>
            </div>
        </div>
    </section>

    {{-- ===== Pricing Plans Section ===== --}}
    <section class="pricing-section py-20 bg-slate-50 relative overflow-hidden" id="pricing">
        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <div class="text-center max-w-3xl mx-auto mb-16" data-aos="fade-up" data-aos-duration="700">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-emerald-50 text-emerald-600 text-sm font-bold mb-4 shadow-sm">
                    <span class="material-symbols-outlined text-base">payments</span>
                    <span>{{ @$translations['nav']['pricing'] ?? ($lang == 'en' ? 'Flexible pricing' : 'خطط وأسعار مرنة') }}</span>
                </div>
                <h2 class="text-3xl md:text-5xl font-black text-slate-900 leading-tight mb-4">
                    {{ $lang == 'en' ? 'Choose the right plan' : 'اختر الباقة المناسبة' }}
                    <span class="gradient-text">{{ $lang == 'en' ? 'to grow your business' : 'لتنمية تجارتك' }}</span>
                </h2>
                <p class="text-slate-600 text-lg">
                    {{ $lang == 'en' ? 'No commissions on your sales. Clear plans that let you scale with confidence.' : 'بدون عمولات على مبيعاتك! خطط واضحة وشفافة تمكّنك من التوسع والانطلاق بكل قوة وسهولة.' }}
                </p>
            </div>

            @if(isset($planlist) && count($planlist) > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 items-stretch">
                    @foreach($planlist as $key => $plan)
                        @php
                            $isPopular = ($key == 1 || $loop->iteration == 2);
                            $themesCount = 0;
                            if (!empty($plan->themes_id)) {
                                $themesCount = count(explode('|', $plan->themes_id));
                            }
                        @endphp

                        <div class="relative bg-white rounded-3xl p-8 border {{ $isPopular ? 'border-emerald-500 shadow-2xl shadow-emerald-500/10 ring-2 ring-emerald-500/20' : 'border-slate-200/80 shadow-lg shadow-slate-100' }} flex flex-col justify-between transition-all duration-300 hover:-translate-y-1 hover:shadow-xl"
                             data-aos="fade-up" data-aos-duration="600" data-aos-delay="{{ $key * 100 }}">
                            
                            @if($isPopular)
                                <div class="absolute -top-4 left-1/2 -translate-x-1/2 px-4 py-1 rounded-full gradient-bg text-white text-xs font-extrabold shadow-md flex items-center gap-1">
                                    <span class="material-symbols-outlined text-sm">star</span>
                                    <span>الأكثر طلباً واختياراً</span>
                                </div>
                            @endif

                            <div>
                                <div class="mb-6">
                                    <h3 class="text-2xl font-bold text-slate-900 mb-2">{{ $plan->name }}</h3>
                                    <p class="text-slate-500 text-sm leading-relaxed min-h-[42px]">{{ Str::limit($plan->description, 90) }}</p>
                                </div>

                                <div class="mb-8 pb-6 border-b border-slate-100 flex items-baseline gap-2">
                                    <span class="text-4xl font-black text-slate-900">{{ helper::currency_formate($plan->price, '') }}</span>
                                    <span class="text-slate-500 text-sm font-semibold">
                                        / 
                                        @if($plan->plan_type == 1)
                                            @if($plan->duration == 1) شهرياً
                                            @elseif($plan->duration == 2) كل 3 أشهر
                                            @elseif($plan->duration == 3) كل 6 أشهر
                                            @elseif($plan->duration == 4) سنوياً
                                            @elseif($plan->duration == 5) مدى الحياة
                                            @endif
                                        @else
                                            {{ $plan->days }} يوم
                                        @endif
                                    </span>
                                </div>

                                <ul class="space-y-3.5 mb-8 text-sm font-semibold text-slate-700">
                                    <li class="flex items-center gap-3">
                                        <span class="w-6 h-6 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                                            <span class="material-symbols-outlined text-sm">check</span>
                                        </span>
                                        <span>منتجات {{ $plan->order_limit == -1 ? 'غير محدودة' : $plan->order_limit }}</span>
                                    </li>
                                    <li class="flex items-center gap-3">
                                        <span class="w-6 h-6 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                                            <span class="material-symbols-outlined text-sm">check</span>
                                        </span>
                                        <span>طلبات {{ $plan->appointment_limit == -1 ? 'غير محدودة' : $plan->appointment_limit }}</span>
                                    </li>
                                    <li class="flex items-center gap-3">
                                        <span class="w-6 h-6 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                                            <span class="material-symbols-outlined text-sm">check</span>
                                        </span>
                                        <span>{{ $themesCount > 0 ? $themesCount . ' ثيمات متجر متطورة' : 'جميع الثيمات متاحة' }}</span>
                                    </li>
                                    @if($plan->custom_domain == 1)
                                        <li class="flex items-center gap-3">
                                            <span class="w-6 h-6 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                                                <span class="material-symbols-outlined text-sm">check</span>
                                            </span>
                                            <span>ربط الدومين الخاص (Custom Domain)</span>
                                        </li>
                                    @endif
                                    @if($plan->coupons == 1)
                                        <li class="flex items-center gap-3">
                                            <span class="w-6 h-6 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                                                <span class="material-symbols-outlined text-sm">check</span>
                                            </span>
                                            <span>إنشاء قسائم خصومات وكوبونات</span>
                                        </li>
                                    @endif
                                    @if($plan->google_analytics == 1)
                                        <li class="flex items-center gap-3">
                                            <span class="w-6 h-6 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                                                <span class="material-symbols-outlined text-sm">check</span>
                                            </span>
                                            <span>ربط تحليلات جوجل (Google Analytics)</span>
                                        </li>
                                    @endif
                                    @if($plan->pos == 1)
                                        <li class="flex items-center gap-3">
                                            <span class="w-6 h-6 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                                                <span class="material-symbols-outlined text-sm">check</span>
                                            </span>
                                            <span>نظام نقاط البيع (POS)</span>
                                        </li>
                                    @endif
                                </ul>
                            </div>

                            <a href="{{ url('admin/register') }}"
                               class="w-full py-3.5 px-6 rounded-2xl font-bold text-center transition-all duration-200 {{ $isPopular ? 'gradient-bg text-white shadow-lg shadow-emerald-500/25 hover:opacity-95' : 'bg-slate-100 text-slate-800 hover:bg-slate-200' }}">
                                اشترك الآن وابدأ مجاناً
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    {{-- ===== value Section ===== --}}
    <section class="about-section" id="about">
        <div class="about-inner">
            <div class="about-content" data-aos="fade-left" data-aos-duration="700">
                <div class="about-badge">{{ @$translations['value']['badge'] ?? 'رسالتنا وقيمنا' }}</div>
                <h2>{{ @$translations['value']['title_line1'] ?? 'نمكّن التجار في' }} <br /><span
                        class="gradient-text">{{ @$translations['value']['title_highlight'] ?? 'العالم العربي' }}</span>
                    {{ @$translations['value']['title_line2'] ?? 'للوصول للعالمية' }}</h2>
                <p>
                    {{ @$translations['value']['description'] ?? 'انطلقت منصة Matjar Hub لتكون الشريك الأول لكل طموح يريد البدء في تجارته الخاصة. نحن نؤمن أن التكنولوجيا لا يجب أن تكون عائقاً أمام الإبداع، لذلك عملنا على تبسيط كل العمليات المعقدة.' }}
                </p>
                <div class="about-checkmarks">
                    <div class="about-check">
                        <span class="material-symbols-outlined"
                            style="font-variation-settings:'FILL' 1;">check_circle</span>
                        <span>{{ @$translations['value']['check1'] ?? 'سهولة الاستخدام' }}</span>
                    </div>
                    <div class="about-check">
                        <span class="material-symbols-outlined"
                            style="font-variation-settings:'FILL' 1;">check_circle</span>
                        <span>{{ @$translations['value']['check2'] ?? 'أمان عالي' }}</span>
                    </div>
                    <div class="about-check">
                        <span class="material-symbols-outlined"
                            style="font-variation-settings:'FILL' 1;">check_circle</span>
                        <span>{{ @$translations['value']['check3'] ?? 'تطوير مستمر' }}</span>
                    </div>
                    <div class="about-check">
                        <span class="material-symbols-outlined"
                            style="font-variation-settings:'FILL' 1;">check_circle</span>
                        <span>{{ @$translations['value']['check4'] ?? 'شفافية تامة' }}</span>
                    </div>
                </div>
            </div>

            <div class="about-visual" data-aos="fade-right" data-aos-duration="700" data-aos-delay="150">
                <div class="about-deco-1"></div>
                <div class="about-deco-2"></div>
                {{-- <div class="about-visual-box">
                    <div class="about-visual-text">
                        <div class="big-number">+10K</div>
                        <div class="sub-text">قصة نجاح بدأت معنا</div>
                    </div>
                </div> --}}

                <img src="{{ asset('public/images/value.jpeg') }}"> </img>
            </div>
        </div>
    </section>

    {{-- ===== FAQ Section ===== --}}
    <section class="faq-section" id="faq">
        <div class="faq-inner">
            <div class="section-header" data-aos="fade-up" data-aos-duration="700">
                <h2>{{ @$translations['faq']['title'] ?? 'الأسئلة الشائعة' }}</h2>
                <p>{{ @$translations['faq']['subtitle'] ?? 'كل ما تود معرفته عن المنصة وكيفية البدء' }}</p>
            </div>

            <div class="faq-list">
                <details class="faq-item" data-aos="fade-up" data-aos-duration="500" open>
                    <summary>
                        <span>{{ @$translations['faq']['q1'] ?? 'هل أحتاج لخبرة في البرمجة لإنشاء متجري على Matjar Hub؟' }}</span>
                        <span class="material-symbols-outlined">expand_more</span>
                    </summary>
                    <div class="faq-body">
                        {{ @$translations['faq']['a1'] ?? 'بالتأكيد لا! لقد صممنا المنصة لتكون سهلة الاستخدام للجميع. يمكنك اختيار قالب جاهز وتخصيصه بسهولة باستخدام واجهة السحب والإفلات البسيطة.' }}
                    </div>
                </details>

                <details class="faq-item" data-aos="fade-up" data-aos-duration="500" data-aos-delay="80">
                    <summary>
                        <span>{{ @$translations['faq']['q2'] ?? 'ما هي تكلفة البدء مع Matjar Hub؟' }}</span>
                        <span class="material-symbols-outlined">expand_more</span>
                    </summary>
                    <div class="faq-body">
                        {{ @$translations['faq']['a2'] ?? 'نوفر خطة مجانية للبدء، مع خطط مدفوعة مرنة تبدأ من أسعار مناسبة للمشاريع الصغيرة وحتى الاحترافية الكبيرة. يمكنك الاطلاع على صفحة الأسعار للمزيد.' }}
                    </div>
                </details>

                <details class="faq-item" data-aos="fade-up" data-aos-duration="500" data-aos-delay="160">
                    <summary>
                        <span>{{ @$translations['faq']['q3'] ?? 'هل يمكنني استخدام نطاق (Domain) خاص بي؟' }}</span>
                        <span class="material-symbols-outlined">expand_more</span>
                    </summary>
                    <div class="faq-body">
                        {{ @$translations['faq']['a3'] ?? 'نعم، يمكنك ربط نطاقك الخاص بمتجرك بسهولة تامة في الخطط المدفوعة، أو استخدام نطاق فرعي مجاني نقدمه لك عند البدء.' }}
                    </div>
                </details>
            </div>
        </div>
    </section>

    {{-- ===== Contact Section ===== --}}
    <section class="contact-section" id="contact">
        <div class="contact-inner">
            {{-- Info --}}
            <div data-aos="fade-left" data-aos-duration="700">
                <h2 class="contact-info-title">{{ @$translations['contact']['title_line1'] ?? 'دعنا نساعدك في' }}
                    <br /><span
                        class="gradient-text">{{ @$translations['contact']['title_highlight'] ?? 'تحويل فكرتك إلى واقع' }}</span>
                </h2>
                <p class="contact-info-desc">
                    {{ @$translations['contact']['description'] ?? 'فريق الخبراء لدينا جاهز للرد على استفساراتك ومساعدتك في اختيار الخطة الأنسب لمشروعك.' }}
                </p>

                <div class="contact-items">
                    <div class="contact-item">
                        <div class="contact-item-icon" style="color:#15AC82;">
                            <span class="material-symbols-outlined"
                                style="font-variation-settings:'FILL' 1;">call</span>
                        </div>
                        <div>
                            <div class="contact-item-label">
                                {{ @$translations['contact']['phone_label'] ?? 'الهاتف الموحد' }}</div>
                            <div class="contact-item-value">
                                {{ @$translations['contact']['phone_value'] ?? '+966 800 123 4567' }}</div>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-item-icon" style="color:#25D366;">
                            <span class="material-symbols-outlined"
                                style="font-variation-settings:'FILL' 1;">chat</span>
                        </div>
                        <div>
                            <div class="contact-item-label">
                                {{ @$translations['contact']['whatsapp_label'] ?? 'واتساب مباشر' }}</div>
                            <div class="contact-item-value">
                                {{ @$translations['contact']['whatsapp_value'] ?? '+966 50 123 4567' }}</div>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-item-icon" style="color:#0D8D6B;">
                            <span class="material-symbols-outlined"
                                style="font-variation-settings:'FILL' 1;">mail</span>
                        </div>
                        <div>
                            <div class="contact-item-label">
                                {{ @$translations['contact']['email_label'] ?? 'البريد الإلكتروني' }}</div>
                            <div class="contact-item-value">
                                {{ @$translations['contact']['email_value'] ?? 'hello@smartstore.sa' }}</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Form --}}
            <div class="contact-form-box" data-aos="fade-right" data-aos-duration="700" data-aos-delay="150">
                <form action="{{ route('landing2.contact') }}" method="POST">
                    @csrf
                    <div class="form-row">
                        <div class="form-group" style="margin-bottom:0;">
                            <label>{{ @$translations['contact']['form_name'] ?? 'الاسم الكامل' }}</label>
                            <input type="text" name="name" required
                                placeholder="{{ @$translations['contact']['form_name_placeholder'] ?? 'أدخل اسمك' }}" />
                        </div>
                        <div class="form-group" style="margin-bottom:0;">
                            <label>{{ @$translations['contact']['form_email'] ?? 'البريد الإلكتروني' }}</label>
                            <input type="email" name="email" required placeholder="example@mail.com"
                                dir="ltr" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label>{{ @$translations['contact']['form_inquiry_type'] ?? 'نوع الاستفسار' }}</label>
                        <select name="inquiry_type" required>
                            <option value="دعم فني">
                                {{ @$translations['contact']['form_inquiry_support'] ?? 'دعم فني' }}</option>
                            <option value="استفسار مبيعات">
                                {{ @$translations['contact']['form_inquiry_sales'] ?? 'استفسار مبيعات' }}</option>
                            <option value="شراكات">
                                {{ @$translations['contact']['form_inquiry_partners'] ?? 'شراكات' }}</option>
                            <option value="أخرى">{{ @$translations['contact']['form_inquiry_other'] ?? 'أخرى' }}
                            </option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>{{ @$translations['contact']['form_message'] ?? 'الرسالة' }}</label>
                        <textarea name="message" rows="4" required
                            placeholder="{{ @$translations['contact']['form_message_placeholder'] ?? 'كيف يمكننا مساعدتك؟' }}"></textarea>
                    </div>

                    <button type="submit"
                        class="btn-submit">{{ @$translations['contact']['form_submit'] ?? 'إرسال الرسالة' }}</button>
                </form>
            </div>
        </div>
    </section>

    {{-- ===== Footer ===== --}}
    <footer class="site-footer">
        <div class="footer-inner">
            <div class="footer-top">
                <div>
                    <div class="footer-brand-name">Matjar Hub</div>
                    <p class="footer-brand-desc">
                        {{ @$translations['footer']['brand_desc'] ?? ($lang == 'en' ? 'The leading platform for empowering merchants in the Arab world' : 'المنصة الرائدة في تمكين التجار في العالم العربي') }}
                    </p>
                </div>
                <div>
                    <h4 class="footer-col-title">{{ @$translations['footer']['explore_title'] ?? ($lang == 'en' ? 'Explore' : 'استكشف') }}</h4>
                    <ul class="footer-links">
                        <li><a href="#why-us">{{ @$translations['nav']['why_us'] ?? ($lang == 'en' ? 'Why Us' : 'لماذا نحن') }}</a></li>
                        <li><a href="#themes">{{ @$translations['nav']['themes'] ?? ($lang == 'en' ? 'Themes' : 'القوالب') }}</a></li>
                        <li><a href="#pricing">{{ @$translations['nav']['pricing'] ?? ($lang == 'en' ? 'Pricing' : 'الباقات') }}</a></li>
                        <li><a href="#faq">{{ @$translations['nav']['faq'] ?? ($lang == 'en' ? 'FAQ' : 'الأسئلة') }}</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="footer-col-title">{{ @$translations['footer']['support_title'] ?? ($lang == 'en' ? 'Support' : 'الدعم') }}</h4>
                    <ul class="footer-links">
                        <li><a href="#contact">{{ @$translations['nav']['contact'] ?? ($lang == 'en' ? 'Contact' : 'اتصل بنا') }}</a></li>
                        <li><a href="{{ url('/help') }}">{{ @$translations['footer']['help_center'] ?? ($lang == 'en' ? 'Help Center' : 'مركز الدعم') }}</a></li>
                        <li><a href="{{ url('admin') }}">{{ @$translations['nav']['login'] ?? ($lang == 'en' ? 'Login' : 'تسجيل دخول') }}</a></li>
                        <li><a href="{{ url('admin/register') }}">{{ @$translations['nav']['create_account'] ?? ($lang == 'en' ? 'Create store' : 'أنشئ متجرك') }}</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p class="footer-copy">
                    {{ @$translations['footer']['copyright'] ?? ($lang == 'en' ? '© 2026 Matjar Hub. All rights reserved.' : '© 2026 Matjar Hub. جميع الحقوق محفوظة.') }}
                </p>
                <a class="footer-cta" href="{{ url('admin/register') }}">
                    {{ @$translations['nav']['start_now'] ?? ($lang == 'en' ? 'Start Now' : 'ابدأ الآن') }}
                    <span class="material-symbols-outlined text-base">arrow_forward</span>
                </a>
            </div>
        </div>
    </footer>

    {{-- ===== AOS Script ===== --}}
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init({
            once: true,
            offset: 80,
            easing: 'ease-out-quad',
        });

        // Language menu toggle
        function toggleLangMenu() {
            const menu = document.getElementById('langMenu');
            if (menu.style.display === 'none' || menu.style.display === '') {
                menu.style.display = 'block';
            } else {
                menu.style.display = 'none';
            }
        }

        // Side drawer menu
        function openMobileMenu() {
            document.body.classList.add('nav-drawer-open');
            const drawer = document.getElementById('mobileMenu');
            if (drawer) drawer.setAttribute('aria-hidden', 'false');
            const ham = document.querySelector('.nav-hamburger');
            if (ham) ham.setAttribute('aria-expanded', 'true');
        }

        function closeMobileMenu() {
            document.body.classList.remove('nav-drawer-open');
            const drawer = document.getElementById('mobileMenu');
            if (drawer) drawer.setAttribute('aria-hidden', 'true');
            const ham = document.querySelector('.nav-hamburger');
            if (ham) ham.setAttribute('aria-expanded', 'false');
        }

        function toggleMobileMenu() {
            if (document.body.classList.contains('nav-drawer-open')) {
                closeMobileMenu();
            } else {
                openMobileMenu();
            }
        }

        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') closeMobileMenu();
        });

        // Close the drawer automatically when the full desktop nav becomes visible
        window.matchMedia('(min-width: 1280px)').addEventListener('change', function(e) {
            if (e.matches) closeMobileMenu();
        });

        // Close language menu when clicking outside
        document.addEventListener('click', function(event) {
            const langSwitcher = document.querySelector('.lang-switcher');
            const menu = document.getElementById('langMenu');
            if (langSwitcher && !langSwitcher.contains(event.target)) {
                menu.style.display = 'none';
            }
        });
    </script>

    {{-- Toastify JS --}}
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

    {{-- Toastify Notifications --}}
    @if (session('contact_success'))
        <script>
            Toastify({
                text: "{{ session('contact_success') }}",
                duration: 5000,
                gravity: "top",
                position: "center",
                style: {
                    background: "linear-gradient(135deg, #15AC82 0%, #0D8D6B 100%)",
                    color: "#fff",
                    fontFamily: "'Cairo', sans-serif",
                    fontWeight: "700",
                    borderRadius: "12px",
                    boxShadow: "0 8px 30px rgba(21, 172, 130, 0.4)",
                    padding: "16px 24px"
                },
                close: true
            }).showToast();
        </script>
    @endif

    @if (session('contact_error'))
        <script>
            Toastify({
                text: "{{ session('contact_error') }}",
                duration: 5000,
                gravity: "top",
                position: "center",
                style: {
                    background: "linear-gradient(135deg, #dc3545 0%, #c82333 100%)",
                    color: "#fff",
                    fontFamily: "'Cairo', sans-serif",
                    fontWeight: "700",
                    borderRadius: "12px",
                    boxShadow: "0 8px 30px rgba(220, 53, 69, 0.4)",
                    padding: "16px 24px"
                },
                close: true
            }).showToast();
        </script>
    @endif

    @if (@helper::checkaddons('pwa'))
        @if ($pwa == 1 && helper::appdata($admin_id)->pwa == 1)
            <!--------------- PWA Section start ------------------>
            <div class="d-block d-sm-none" id="pwa-container">
                <div class="pwa d-flex gap-2"
                    style="position:fixed;bottom:0;left:0;right:0;background:#fff;z-index:9999;padding:15px;box-shadow:0 -2px 10px rgba(0,0,0,0.1);display:flex;justify-content:space-between;align-items:center;">
                    <div class="d-flex align-items-center gap-2" style="display:flex;align-items:center;gap:10px;">
                        <img src="{{ helper::image_path(helper::appdata($admin_id)->app_logo) }}" class="pwa-image"
                            alt="" height="40px" style="border-radius:10px;">
                        <div class="pwa-content">
                            <h5 class="mb-1 line-1 fs-7" style="margin:0;font-size:14px;font-weight:700;">
                                {{ helper::appdata($admin_id)->app_title }}</h5>
                            <p class="m-0 fs-8 line-1 text-dark" style="margin:0;font-size:12px;color:#475569;">
                                {{ trans('labels.pwa_message') ?? 'Add to Home Screen' }}</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-2" style="display:flex;align-items:center;gap:10px;">
                        <a class="btn mobile-install-btn" id="mobile-install-app"
                            style="background:#15AC82;color:#fff;padding:5px 10px;border-radius:5px;font-size:12px;cursor:pointer;">{{ trans('labels.install') ?? 'Install' }}</a>
                        <a class="close-btn" id="close-btn" style="cursor:pointer;">
                            <span class="material-symbols-outlined" style="font-size:16px;color:#dc3545;">close</span>
                        </a>
                    </div>
                </div>
            </div>
            <!--------------- PWA Section End ------------------>
            <script>
                if (!navigator.serviceWorker.controller) {
                    navigator.serviceWorker.register("{{ url('storage/app/public/sw.js') }}").then(function(reg) {
                        console.log("Service worker has been registered for scope: " + reg.scope);
                    });
                }

                let deferredPrompt;
                const isIosDevice = () => {
                    const userAgent = window.navigator.userAgent.toLowerCase();
                    return /iphone|ipad|ipod/.test(userAgent);
                };
                const inStandalone = () => ('standalone' in window.navigator) && (window.navigator.standalone);

                if (window.matchMedia('(display-mode: standalone)').matches || inStandalone()) {
                    document.getElementById('pwa-container').style.display = 'none';
                }

                window.addEventListener('beforeinstallprompt', (e) => {
                    e.preventDefault();
                    deferredPrompt = e;
                });

                document.getElementById('mobile-install-app')?.addEventListener('click', async () => {
                    if (isIosDevice()) {
                        alert(
                            "لتثبيت التطبيق على جهاز iOS، اضغط على زر المشاركة (Share) في المتصفح ثم اختر 'إضافة إلى الشاشة الرئيسية' (Add to Home Screen).");
                        document.getElementById('pwa-container').style.display = 'none';
                        return;
                    }
                    if (deferredPrompt) {
                        deferredPrompt.prompt();
                        const {
                            outcome
                        } = await deferredPrompt.userChoice;
                        if (outcome === 'accepted') {
                            deferredPrompt = null;
                        }
                    }
                });

                document.getElementById('close-btn')?.addEventListener('click', () => {
                    document.getElementById('pwa-container').style.display = 'none';
                });
            </script>
        @endif
    @endif

    <!-- WhatsApp Floating Button -->
    <a href="https://wa.me/+963986129664" target="_blank"
        style="position:fixed;bottom:20px;right:20px;background:#25D366;color:white;border-radius:50%;width:60px;height:60px;display:flex;align-items:center;justify-content:center;box-shadow:0 4px 10px rgba(0,0,0,0.3);z-index:1000;text-decoration:none;transition:transform 0.3s ease;"
        onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
        <i class="fab fa-whatsapp" style="font-size:30px;"></i>
    </a>
</body>

</html>
