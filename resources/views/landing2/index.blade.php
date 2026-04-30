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

        html, body {
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

        /* ===== Header ===== */
        .site-header {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 50;
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(226, 232, 240, 0.5);
        }

        .site-nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1280px;
            margin: 0 auto;
            padding: 0.75rem 1.25rem;
        }

        /* Hamburger: visible on mobile, hidden on md+ */
        .nav-hamburger {
            display: flex;
            align-items: center;
            cursor: pointer;
            color: #0F172A;
            font-size: 1.75rem;
            user-select: none;
        }

        @media (min-width: 768px) {
            .nav-hamburger {
                display: none;
            }
        }

        .nav-logo {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .nav-logo-icon {
            width: 2.5rem;
            height: 2.5rem;
            background: linear-gradient(135deg, #15AC82, #0D8D6B);
            border-radius: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .nav-logo-icon .material-symbols-outlined {
            color: #fff;
        }

        .nav-logo-text {
            font-size: 1.5rem;
            font-weight: 900;
            background: linear-gradient(135deg, #15AC82, #0D8D6B);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .nav-links {
            display: flex;
            gap: 2rem;
            align-items: center;
        }

        .nav-links a {
            font-weight: 700;
            color: #475569;
            text-decoration: none;
            transition: color 0.2s;
        }

        .nav-links a:hover,
        .nav-links a.active {
            color: #15AC82;
        }

        .nav-links a.active {
            border-bottom: 2px solid #15AC82;
            padding-bottom: 2px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #15AC82, #0D8D6B);
            color: #fff;
            padding: 0.55rem 1.5rem;
            border-radius: 9999px;
            font-weight: 700;
            font-family: 'Cairo', sans-serif;
            border: none;
            cursor: pointer;
            transition: opacity 0.2s, transform 0.2s;
            box-shadow: 0 4px 15px rgba(21, 172, 130, 0.3);
        }

        .btn-primary:hover {
            opacity: 0.9;
            transform: translateY(-1px);
        }

        .btn-primary:active {
            transform: scale(0.97);
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
            background: #e2e7ff;
            border-radius: 1.5rem 1.5rem 0 0;
        }

        .footer-inner {
            max-width: 1280px;
            margin: 0 auto;
            padding: 4rem 2rem 3rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 2rem;
        }

        @media (min-width: 768px) {
            .footer-inner {
                flex-direction: row-reverse;
                justify-content: space-between;
            }
        }

        .footer-brand-name {
            font-size: 1.05rem;
            font-weight: 700;
            color: #272e42;
            margin-bottom: 0.35rem;
        }

        .footer-brand-desc {
            font-size: 0.85rem;
            color: rgba(39, 46, 66, 0.6);
        }

        .footer-links {
            display: flex;
            gap: 1.5rem;
            flex-wrap: wrap;
            justify-content: center;
        }

        .footer-links a {
            font-weight: 700;
            color: #4a40e0;
            text-decoration: none;
            font-size: 0.9rem;
            transition: text-decoration 0.2s;
        }

        .footer-links a:not(.footer-links a:first-child) {
            color: rgba(39, 46, 66, 0.6);
        }

        .footer-links a:hover {
            text-decoration: underline;
        }

        .footer-copy {
            font-size: 0.78rem;
            color: rgba(39, 46, 66, 0.5);
            text-align: center;
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
            <link rel="manifest" href='data:application/manifest+json,{"name": "{{ helper::appdata($admin_id)->app_name }}","short_name": "{{ helper::appdata($admin_id)->app_name }}","icons": [{"src": "{{ helper::image_path(helper::appdata($admin_id)->app_logo) }}", "sizes": "512x512", "type": "image/png"}, {"src": "{{ helper::image_path(helper::appdata($admin_id)->app_logo) }}", "sizes": "1024x1024", "type": "image/png"}], "start_url": "{{ request()->url() }}","display": "standalone","prefer_related_applications":"false" }'>
        @endif
    {{-- @endif --}}
</head>

<body>

    {{-- ===== Header ===== --}}
    <header class="site-header">
        <nav class="site-nav">
            <div class="nav-logo">
                <a href="{{ url('/') }}">
                <img style="width:100px;height:100px;" src="{{ asset('public/images/matjarhub.png') }}"></img>
                </a>
            </div>

            <div class="nav-links hidden md:flex">
                <a href="#" class="active">{{ @$translations['nav']['home'] ?? 'الرئيسية' }}</a>
                <a href="#who-we-are">{{ @$translations['nav']['who_we_are'] ?? 'من نحن' }}</a>
                <a href="#why-us">{{ @$translations['nav']['why_us'] ?? 'لماذا نحن' }}</a>
                <a href="#faq">{{ @$translations['nav']['faq'] ?? 'الأسئلة' }}</a>
                <a href="#contact">{{ @$translations['nav']['contact'] ?? 'اتصل بنا' }}</a>
            </div>

            <div style="display:flex;align-items:center;gap:1rem;">
                {{-- Language Switcher --}}
                <div class="lang-switcher" style="position:relative;">
                    <button type="button" class="lang-btn" onclick="toggleLangMenu()" style="
                        background: rgba(21, 172, 130, 0.1);
                        border: 1px solid rgba(21, 172, 130, 0.3);
                        border-radius: 9999px;
                        padding: 0.5rem 1rem;
                        font-weight: 700;
                        color: #15AC82;
                        cursor: pointer;
                        display: flex;
                        align-items: center;
                        gap: 0.5rem;
                        font-family: 'Cairo', sans-serif;
                    ">
                        <span class="material-symbols-outlined" style="font-size: 1.2rem;">language</span>
                        <span>{{ $lang == 'ar' ? 'العربية' : 'English' }}</span>
                        <span class="material-symbols-outlined" style="font-size: 1rem;">expand_more</span>
                    </button>
                    <div id="langMenu" class="lang-menu" style="
                        display: none;
                        position: absolute;
                        top: 100%;
                        {{ $lang == 'ar' ? 'left: 0;' : 'right: 0;' }}
                        margin-top: 0.5rem;
                        background: white;
                        border-radius: 1rem;
                        box-shadow: 0 8px 32px rgba(0,0,0,0.12);
                        min-width: 140px;
                        overflow: hidden;
                        z-index: 100;
                    ">
                        <a href="?lang=ar" class="lang-option {{ $lang == 'ar' ? 'active' : '' }}">🇸🇦 العربية</a>
                        <a href="?lang=en" class="lang-option {{ $lang == 'en' ? 'active' : '' }}">🇬🇧 English</a>
                    </div>
                </div>
                
                <button onclick="window.location.href = '{{ url('admin/register') }}'" class="btn-primary hidden md:block">{{ @$translations['nav']['start_now'] ?? 'ابدأ الآن' }}</button>
                <span class="material-symbols-outlined nav-hamburger" onclick="toggleMobileMenu()">menu</span>
            </div>
        </nav>
        
        {{-- Mobile Menu --}}
        <div id="mobileMenu" class="mobile-menu" style="
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            width: 100vw;
            height: 100vh;
            min-height: 100vh;
            background: #ffffff !important;
            backdrop-filter: none !important;
            -webkit-backdrop-filter: none !important;
            z-index: 9999;
            padding: 6rem 2rem 2rem;
            box-sizing: border-box;
        ">
            <div style="display:flex;flex-direction:column;gap:2rem;align-items:center;">
                <a href="#" onclick="closeMobileMenu()" style="font-size:1.25rem;font-weight:700;color:#0F172A;text-decoration:none;">{{ @$translations['nav']['home'] ?? 'الرئيسية' }}</a>
                <a href="#who-we-are" onclick="closeMobileMenu()" style="font-size:1.25rem;font-weight:700;color:#0F172A;text-decoration:none;">{{ @$translations['nav']['who_we_are'] ?? 'من نحن' }}</a>
                <a href="#why-us" onclick="closeMobileMenu()" style="font-size:1.25rem;font-weight:700;color:#0F172A;text-decoration:none;">{{ @$translations['nav']['why_us'] ?? 'لماذا نحن' }}</a>
                <a href="#faq" onclick="closeMobileMenu()" style="font-size:1.25rem;font-weight:700;color:#0F172A;text-decoration:none;">{{ @$translations['nav']['faq'] ?? 'الأسئلة' }}</a>
                <a href="#contact" onclick="closeMobileMenu()" style="font-size:1.25rem;font-weight:700;color:#0F172A;text-decoration:none;">{{ @$translations['nav']['contact'] ?? 'اتصل بنا' }}</a>
            </div>
            <button onclick="closeMobileMenu()" style="
                position: absolute;
                top: 1.5rem;
                {{ $lang == 'ar' ? 'left' : 'right' }}: 1.5rem;
                background: none;
                border: none;
                cursor: pointer;
                padding: 0.5rem;
            ">
                <span class="material-symbols-outlined" style="font-size: 2rem;color:#0F172A;">close</span>
            </button>
        </div>
    </header>

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
                <span class="gradient-text">{{ @$translations['hero']['title_highlight'] ?? 'في ثوانٍ معدودة' }}</span>
            </h1>

            <p class="hero-desc" data-aos="fade-up" data-aos-duration="700" data-aos-delay="200">
                {{ @$translations['hero']['description'] ?? 'منصة متكاملة تمنحك كل ما تحتاجه لإطلاق تجارتك الإلكترونية، من التصميم الاحترافي إلى إدارة المدفوعات والشحن، دون الحاجة لخبرة برمجية.' }}
            </p>

            <div class="hero-actions" data-aos="fade-up" data-aos-duration="700" data-aos-delay="300">
                <button class="btn-hero-primary" onclick="window.location.href = '{{ url('admin/register') }}'">{{ @$translations['hero']['btn_primary'] ?? 'ابدأ مجاناً الآن' }}</button>
                {{-- <button class="btn-hero-secondary">{{ @$translations['hero']['btn_secondary'] ?? 'شاهد العرض التجريبي' }}</button> --}}
            </div>
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
                <h2>{{ @$translations['who_we_are']['title_line1'] ?? 'نحن فريق شغوف بـ' }}<br /><span class="gradient-text">{{ @$translations['who_we_are']['title_highlight'] ?? 'تمكين التجارة الرقمية' }}</span></h2>
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
                <img src="{{ asset('public/images/about.jpeg') }}" alt="{{ $lang == 'ar' ? 'فريق Matjar Hub' : 'Matjar Hub Team' }}" />
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
                <h2>{{ @$translations['why_us']['title'] ?? 'لماذا تختار' }} <span class="gradient-text">{{ @$translations['why_us']['title_highlight'] ?? 'Matjar Hub؟' }}</span></h2>
                <p>{{ @$translations['why_us']['subtitle'] ?? 'نحن نوفر لك كل الأدوات التي تحتاجها للنجاح في عالم التجارة الإلكترونية، مع التركيز على البساطة والقوة في وقت واحد.' }}</p>
            </div>

            <div class="why-us-grid">
                <div class="why-card" data-aos="fade-up" data-aos-duration="600" data-aos-delay="0">
                    <div class="why-card-icon" style="background:rgba(21,172,130,0.1);color:#15AC82;">
                        <span class="material-symbols-outlined">speed</span>
                    </div>
                    <h3>{{ @$translations['why_us']['card1_title'] ?? 'سرعة خارقة' }}</h3>
                    <p>{{ @$translations['why_us']['card1_desc'] ?? 'متاجرك تعمل على أحدث التقنيات السحابية لضمان سرعة تحميل لا تضاهى عالمياً.' }}</p>
                </div>

                <div class="why-card" data-aos="fade-up" data-aos-duration="600" data-aos-delay="100">
                    <div class="why-card-icon" style="background:rgba(13,141,107,0.1);color:#0D8D6B;">
                        <span class="material-symbols-outlined">support_agent</span>
                    </div>
                    <h3>{{ @$translations['why_us']['card2_title'] ?? 'دعم فني 24/7' }}</h3>
                    <p>{{ @$translations['why_us']['card2_desc'] ?? 'فريقنا متواجد دائماً لمساعدتك في كل خطوة، عبر الواتساب، الهاتف، أو البريد.' }}</p>
                </div>

                <div class="why-card" data-aos="fade-up" data-aos-duration="600" data-aos-delay="200">
                    <div class="why-card-icon" style="background:rgba(250,204,21,0.12);color:#ca8a04;">
                        <span class="material-symbols-outlined">integration_instructions</span>
                    </div>
                    <h3>{{ @$translations['why_us']['card3_title'] ?? 'تكامل شامل' }}</h3>
                    <p>{{ @$translations['why_us']['card3_desc'] ?? 'اربط متجرك مع كافة خدمات الشحن والدفع والتسويق بضغطة زر واحدة.' }}</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ===== value Section ===== --}}
    <section class="about-section" id="about">
        <div class="about-inner">
            <div class="about-content" data-aos="fade-left" data-aos-duration="700">
                <div class="about-badge">{{ @$translations['value']['badge'] ?? 'رسالتنا وقيمنا' }}</div>
                <h2>{{ @$translations['value']['title_line1'] ?? 'نمكّن التجار في' }} <br /><span class="gradient-text">{{ @$translations['value']['title_highlight'] ?? 'العالم العربي' }}</span> {{ @$translations['value']['title_line2'] ?? 'للوصول للعالمية' }}</h2>
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
                <h2 class="contact-info-title">{{ @$translations['contact']['title_line1'] ?? 'دعنا نساعدك في' }} <br /><span class="gradient-text">{{ @$translations['contact']['title_highlight'] ?? 'تحويل فكرتك إلى واقع' }}</span></h2>
                <p class="contact-info-desc">{{ @$translations['contact']['description'] ?? 'فريق الخبراء لدينا جاهز للرد على استفساراتك ومساعدتك في اختيار الخطة الأنسب لمشروعك.' }}</p>

                <div class="contact-items">
                    <div class="contact-item">
                        <div class="contact-item-icon" style="color:#15AC82;">
                            <span class="material-symbols-outlined"
                                style="font-variation-settings:'FILL' 1;">call</span>
                        </div>
                        <div>
                            <div class="contact-item-label">{{ @$translations['contact']['phone_label'] ?? 'الهاتف الموحد' }}</div>
                            <div class="contact-item-value">{{ @$translations['contact']['phone_value'] ?? '+966 800 123 4567' }}</div>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-item-icon" style="color:#25D366;">
                            <span class="material-symbols-outlined"
                                style="font-variation-settings:'FILL' 1;">chat</span>
                        </div>
                        <div>
                            <div class="contact-item-label">{{ @$translations['contact']['whatsapp_label'] ?? 'واتساب مباشر' }}</div>
                            <div class="contact-item-value">{{ @$translations['contact']['whatsapp_value'] ?? '+966 50 123 4567' }}</div>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-item-icon" style="color:#0D8D6B;">
                            <span class="material-symbols-outlined"
                                style="font-variation-settings:'FILL' 1;">mail</span>
                        </div>
                        <div>
                            <div class="contact-item-label">{{ @$translations['contact']['email_label'] ?? 'البريد الإلكتروني' }}</div>
                            <div class="contact-item-value">{{ @$translations['contact']['email_value'] ?? 'hello@smartstore.sa' }}</div>
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
                            <input type="text" name="name" required placeholder="{{ @$translations['contact']['form_name_placeholder'] ?? 'أدخل اسمك' }}" />
                        </div>
                        <div class="form-group" style="margin-bottom:0;">
                            <label>{{ @$translations['contact']['form_email'] ?? 'البريد الإلكتروني' }}</label>
                            <input type="email" name="email" required placeholder="example@mail.com" dir="ltr" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label>{{ @$translations['contact']['form_inquiry_type'] ?? 'نوع الاستفسار' }}</label>
                        <select name="inquiry_type" required>
                            <option value="دعم فني">{{ @$translations['contact']['form_inquiry_support'] ?? 'دعم فني' }}</option>
                            <option value="استفسار مبيعات">{{ @$translations['contact']['form_inquiry_sales'] ?? 'استفسار مبيعات' }}</option>
                            <option value="شراكات">{{ @$translations['contact']['form_inquiry_partners'] ?? 'شراكات' }}</option>
                            <option value="أخرى">{{ @$translations['contact']['form_inquiry_other'] ?? 'أخرى' }}</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>{{ @$translations['contact']['form_message'] ?? 'الرسالة' }}</label>
                        <textarea name="message" rows="4" required placeholder="{{ @$translations['contact']['form_message_placeholder'] ?? 'كيف يمكننا مساعدتك؟' }}"></textarea>
                    </div>

                    <button type="submit" class="btn-submit">{{ @$translations['contact']['form_submit'] ?? 'إرسال الرسالة' }}</button>
                </form>
            </div>
        </div>
    </section>

    {{-- ===== Footer ===== --}}
    <footer class="site-footer">
        <div class="footer-inner">
            <div style="text-align:center;">
                <div class="footer-brand-name">Matjar Hub</div>
                <div class="footer-brand-desc">{{ @$translations['footer']['brand_desc'] ?? 'المنصة الرائدة في تمكين التجار في العالم العربي' }}</div>
            </div>

            <!-- <div class="footer-links">
                <a href="#">{{ @$translations['nav']['home'] ?? 'الرئيسية' }}</a>
            </div> -->

            <div class="footer-copy">{{ @$translations['footer']['copyright'] ?? '© 2026 Matjar Hub. جميع الحقوق محفوظة.' }}</div>
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

        // Mobile menu toggle
        function toggleMobileMenu() {
            const menu = document.getElementById('mobileMenu');
            if (menu.style.display === 'none' || menu.style.display === '') {
                menu.style.display = 'block';
                document.body.style.overflow = 'hidden';
            } else {
                menu.style.display = 'none';
                document.body.style.overflow = '';
            }
        }

        function closeMobileMenu() {
            const menu = document.getElementById('mobileMenu');
            menu.style.display = 'none';
            document.body.style.overflow = '';
        }

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
    @if(session('contact_success'))
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

    @if(session('contact_error'))
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
                <div class="pwa d-flex gap-2" style="position:fixed;bottom:0;left:0;right:0;background:#fff;z-index:9999;padding:15px;box-shadow:0 -2px 10px rgba(0,0,0,0.1);display:flex;justify-content:space-between;align-items:center;">
                    <div class="d-flex align-items-center gap-2" style="display:flex;align-items:center;gap:10px;">
                        <img src="{{ helper::image_path(helper::appdata($admin_id)->app_logo) }}" class="pwa-image" alt="" height="40px" style="border-radius:10px;">
                        <div class="pwa-content">
                            <h5 class="mb-1 line-1 fs-7" style="margin:0;font-size:14px;font-weight:700;">{{ helper::appdata($admin_id)->app_title }}</h5>
                            <p class="m-0 fs-8 line-1 text-dark" style="margin:0;font-size:12px;color:#475569;">{{ trans('labels.pwa_message') ?? 'Add to Home Screen' }}</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-2" style="display:flex;align-items:center;gap:10px;">
                        <a class="btn mobile-install-btn" id="mobile-install-app" style="background:#15AC82;color:#fff;padding:5px 10px;border-radius:5px;font-size:12px;cursor:pointer;">{{ trans('labels.install') ?? 'Install' }}</a>
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
                window.addEventListener('beforeinstallprompt', (e) => {
                    e.preventDefault();
                    deferredPrompt = e;
                });
                
                document.getElementById('mobile-install-app')?.addEventListener('click', async () => {
                    if (deferredPrompt) {
                        deferredPrompt.prompt();
                        const { outcome } = await deferredPrompt.userChoice;
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

</body>

</html>
