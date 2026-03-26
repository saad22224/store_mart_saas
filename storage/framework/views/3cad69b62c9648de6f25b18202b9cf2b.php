<!DOCTYPE html>

<html class="scroll-smooth" dir="rtl" lang="ar">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Matjar Hub - منصة التجارة الإلكترونية المتكاملة</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>

    
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css" />

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

        /* ===== AOS overrides for performance ===== */
        [data-aos] {
            will-change: transform, opacity;
        }
    </style>
</head>

<body>

    
    <header class="site-header">
        <nav class="site-nav">
            <div class="nav-logo">
                <a href="<?php echo e(url('/')); ?>">
                <img style="width:100px;height:100px;" src="<?php echo e(asset('public/images/matjarhub.jpeg')); ?>"></img>
                </a>
            </div>

            <div class="nav-links hidden md:flex">
                <a href="#" class="active">الرئيسية</a>
                <a href="#who-we-are">من نحن</a>
                <a href="#why-us">لماذا نحن</a>
                <a href="#faq">الأسئلة</a>
                <a href="#contact">اتصل بنا</a>
            </div>

            <div style="display:flex;align-items:center;gap:1rem;">
                <button class="btn-primary">ابدأ الآن</button>
                <span class="material-symbols-outlined nav-hamburger">menu</span>
            </div>
        </nav>
    </header>

    
    <section class="hero-section">
        <div class="hero-blob hero-blob-1"></div>
        <div class="hero-blob hero-blob-2"></div>

        <div class="hero-inner">
            <div class="hero-badge" data-aos="fade-down" data-aos-duration="600">
                <span class="hero-badge-dot"></span>
                أكثر من 50,000 تاجر يثقون بنا
            </div>

            <h1 class="hero-title" data-aos="fade-up" data-aos-duration="700" data-aos-delay="100">
                أنشئ متجر أحلامك <br />
                <span class="gradient-text">في ثوانٍ معدودة</span>
            </h1>

            <p class="hero-desc" data-aos="fade-up" data-aos-duration="700" data-aos-delay="200">
                منصة متكاملة تمنحك كل ما تحتاجه لإطلاق تجارتك الإلكترونية، من التصميم الاحترافي إلى إدارة المدفوعات
                والشحن، دون الحاجة لخبرة برمجية.
            </p>

            <div class="hero-actions" data-aos="fade-up" data-aos-duration="700" data-aos-delay="300">
                <button class="btn-hero-primary">ابدأ مجاناً الآن</button>
                <button class="btn-hero-secondary">شاهد العرض التجريبي</button>
            </div>
        </div>
    </section>

    
    <section class="stats-section">
        <div class="stats-inner">
            <div class="stat-item" data-aos="fade-up" data-aos-duration="600">
                <div class="stat-number">99.9%</div>
                <div class="stat-label">استمرارية الخدمة</div>
            </div>
            <div class="stat-item" data-aos="fade-up" data-aos-duration="600" data-aos-delay="80">
                <div class="stat-number">50k+</div>
                <div class="stat-label">متجر نشط</div>
            </div>
            <div class="stat-item" data-aos="fade-up" data-aos-duration="600" data-aos-delay="160">
                <div class="stat-number">120M+</div>
                <div class="stat-label">مبيعات سنوية</div>
            </div>
            <div class="stat-item" data-aos="fade-up" data-aos-duration="600" data-aos-delay="240">
                <div class="stat-number">24/7</div>
                <div class="stat-label">دعم فني مباشر</div>
            </div>
        </div>
    </section>

    
    <section class="who-section" id="who-we-are">
        <div class="who-deco who-deco-1"></div>
        <div class="who-deco who-deco-2"></div>
        <div class="who-inner">

            
            <div class="who-content" data-aos="fade-left" data-aos-duration="700">
                <div class="section-tag">
                    <span class="material-symbols-outlined" style="font-size:1rem;">groups</span>
                    تعرّف علينا
                </div>
                <h2>نحن فريق شغوف بـ<br /><span class="gradient-text">تمكين التجارة الرقمية</span></h2>
                <p>
                    Matjar Hub منصة سعودية نشأت من رحم التحديات التي يواجهها التجار العرب يومياً.
                    هدفنا الأول هو إزالة العقبات التقنية وتسليم التاجر مفاتيح متجره الاحترافي في أقل من دقيقة.
                </p>
                <p>
                    نُؤمن بأن كل فكرة تستحق أن تُبنى، وكل تاجر يستحق أدوات عالمية المستوى بسعر في متناول الجميع.
                    لذلك بنينا Matjar Hub على ثلاثة مبادئ: السرعة، البساطة، والموثوقية.
                </p>

                <div class="who-stats">
                    <div class="who-stat-box" data-aos="zoom-in" data-aos-duration="500" data-aos-delay="100">
                        <div class="num">2019</div>
                        <div class="lbl">سنة التأسيس</div>
                    </div>
                    <div class="who-stat-box" data-aos="zoom-in" data-aos-duration="500" data-aos-delay="200">
                        <div class="num">+50</div>
                        <div class="lbl">موظف متخصص</div>
                    </div>
                    <div class="who-stat-box" data-aos="zoom-in" data-aos-duration="500" data-aos-delay="300">
                        <div class="num">15+</div>
                        <div class="lbl">دولة عربية</div>
                    </div>
                </div>
            </div>

            
            <div class="who-image-wrap" data-aos="fade-right" data-aos-duration="700" data-aos-delay="150">
                <img src="<?php echo e(asset('public/images/about.jpeg')); ?>" alt="فريق Matjar Hub" />
                <div class="who-badge-float">
                    <div class="icon-wrap">
                        <span class="material-symbols-outlined"
                            style="font-size:1.3rem;font-variation-settings:'FILL' 1;">verified</span>
                    </div>
                    <div class="badge-text">
                        <strong>موثّق ومعتمد</strong>
                        <span>شريك تقني معتمد في المنطقة</span>
                    </div>
                </div>
            </div>

        </div>
    </section>

    
    <section class="why-us-section" id="why-us">
        <div class="why-us-inner">
            <div class="section-header" data-aos="fade-up" data-aos-duration="700">
                <h2>لماذا تختار <span class="gradient-text">Matjar Hub؟</span></h2>
                <p>نحن نوفر لك كل الأدوات التي تحتاجها للنجاح في عالم التجارة الإلكترونية، مع التركيز على البساطة والقوة
                    في وقت واحد.</p>
            </div>

            <div class="why-us-grid">
                <div class="why-card" data-aos="fade-up" data-aos-duration="600" data-aos-delay="0">
                    <div class="why-card-icon" style="background:rgba(21,172,130,0.1);color:#15AC82;">
                        <span class="material-symbols-outlined">speed</span>
                    </div>
                    <h3>سرعة خارقة</h3>
                    <p>متاجرك تعمل على أحدث التقنيات السحابية لضمان سرعة تحميل لا تضاهى عالمياً.</p>
                </div>

                <div class="why-card" data-aos="fade-up" data-aos-duration="600" data-aos-delay="100">
                    <div class="why-card-icon" style="background:rgba(13,141,107,0.1);color:#0D8D6B;">
                        <span class="material-symbols-outlined">support_agent</span>
                    </div>
                    <h3>دعم فني 24/7</h3>
                    <p>فريقنا متواجد دائماً لمساعدتك في كل خطوة، عبر الواتساب، الهاتف، أو البريد.</p>
                </div>

                <div class="why-card" data-aos="fade-up" data-aos-duration="600" data-aos-delay="200">
                    <div class="why-card-icon" style="background:rgba(250,204,21,0.12);color:#ca8a04;">
                        <span class="material-symbols-outlined">integration_instructions</span>
                    </div>
                    <h3>تكامل شامل</h3>
                    <p>اربط متجرك مع كافة خدمات الشحن والدفع والتسويق بضغطة زر واحدة.</p>
                </div>
            </div>
        </div>
    </section>

    
    <section class="about-section" id="about">
        <div class="about-inner">
            <div class="about-content" data-aos="fade-left" data-aos-duration="700">
                <div class="about-badge">رسالتنا وقيمنا</div>
                <h2>نمكّن التجار في <br /><span class="gradient-text">العالم العربي</span> للوصول للعالمية</h2>
                <p>
                    انطلقت منصة Matjar Hub لتكون الشريك الأول لكل طموح يريد البدء في تجارته الخاصة. نحن نؤمن أن
                    التكنولوجيا لا يجب أن تكون عائقاً أمام الإبداع، لذلك عملنا على تبسيط كل العمليات المعقدة.
                </p>
                <div class="about-checkmarks">
                    <div class="about-check">
                        <span class="material-symbols-outlined"
                            style="font-variation-settings:'FILL' 1;">check_circle</span>
                        <span>سهولة الاستخدام</span>
                    </div>
                    <div class="about-check">
                        <span class="material-symbols-outlined"
                            style="font-variation-settings:'FILL' 1;">check_circle</span>
                        <span>أمان عالي</span>
                    </div>
                    <div class="about-check">
                        <span class="material-symbols-outlined"
                            style="font-variation-settings:'FILL' 1;">check_circle</span>
                        <span>تطوير مستمر</span>
                    </div>
                    <div class="about-check">
                        <span class="material-symbols-outlined"
                            style="font-variation-settings:'FILL' 1;">check_circle</span>
                        <span>شفافية تامة</span>
                    </div>
                </div>
            </div>

            <div class="about-visual" data-aos="fade-right" data-aos-duration="700" data-aos-delay="150">
                <div class="about-deco-1"></div>
                <div class="about-deco-2"></div>
                

                <img src="<?php echo e(asset('public/images/value.jpeg')); ?>"> </img>
            </div>
        </div>
    </section>

    
    <section class="faq-section" id="faq">
        <div class="faq-inner">
            <div class="section-header" data-aos="fade-up" data-aos-duration="700">
                <h2>الأسئلة الشائعة</h2>
                <p>كل ما تود معرفته عن المنصة وكيفية البدء</p>
            </div>

            <div class="faq-list">
                <details class="faq-item" data-aos="fade-up" data-aos-duration="500" open>
                    <summary>
                        <span>هل أحتاج لخبرة في البرمجة لإنشاء متجري على Matjar Hub؟</span>
                        <span class="material-symbols-outlined">expand_more</span>
                    </summary>
                    <div class="faq-body">
                        بالتأكيد لا! لقد صممنا المنصة لتكون سهلة الاستخدام للجميع. يمكنك اختيار قالب جاهز وتخصيصه بسهولة
                        باستخدام واجهة السحب والإفلات البسيطة.
                    </div>
                </details>

                <details class="faq-item" data-aos="fade-up" data-aos-duration="500" data-aos-delay="80">
                    <summary>
                        <span>ما هي تكلفة البدء مع Matjar Hub؟</span>
                        <span class="material-symbols-outlined">expand_more</span>
                    </summary>
                    <div class="faq-body">
                        نوفر خطة مجانية للبدء، مع خطط مدفوعة مرنة تبدأ من أسعار مناسبة للمشاريع الصغيرة وحتى الاحترافية
                        الكبيرة. يمكنك الاطلاع على صفحة الأسعار للمزيد.
                    </div>
                </details>

                <details class="faq-item" data-aos="fade-up" data-aos-duration="500" data-aos-delay="160">
                    <summary>
                        <span>هل يمكنني استخدام نطاق (Domain) خاص بي؟</span>
                        <span class="material-symbols-outlined">expand_more</span>
                    </summary>
                    <div class="faq-body">
                        نعم، يمكنك ربط نطاقك الخاص بمتجرك بسهولة تامة في الخطط المدفوعة، أو استخدام نطاق فرعي مجاني
                        نقدمه لك عند البدء.
                    </div>
                </details>
            </div>
        </div>
    </section>

    
    <section class="contact-section" id="contact">
        <div class="contact-inner">
            
            <div data-aos="fade-left" data-aos-duration="700">
                <h2 class="contact-info-title">دعنا نساعدك في <br /><span class="gradient-text">تحويل فكرتك إلى
                        واقع</span></h2>
                <p class="contact-info-desc">فريق الخبراء لدينا جاهز للرد على استفساراتك ومساعدتك في اختيار الخطة
                    الأنسب لمشروعك.</p>

                <div class="contact-items">
                    <div class="contact-item">
                        <div class="contact-item-icon" style="color:#15AC82;">
                            <span class="material-symbols-outlined"
                                style="font-variation-settings:'FILL' 1;">call</span>
                        </div>
                        <div>
                            <div class="contact-item-label">الهاتف الموحد</div>
                            <div class="contact-item-value">+966 800 123 4567</div>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-item-icon" style="color:#25D366;">
                            <span class="material-symbols-outlined"
                                style="font-variation-settings:'FILL' 1;">chat</span>
                        </div>
                        <div>
                            <div class="contact-item-label">واتساب مباشر</div>
                            <div class="contact-item-value">+966 50 123 4567</div>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-item-icon" style="color:#0D8D6B;">
                            <span class="material-symbols-outlined"
                                style="font-variation-settings:'FILL' 1;">mail</span>
                        </div>
                        <div>
                            <div class="contact-item-label">البريد الإلكتروني</div>
                            <div class="contact-item-value">hello@smartstore.sa</div>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="contact-form-box" data-aos="fade-right" data-aos-duration="700" data-aos-delay="150">
                <form>
                    <div class="form-row">
                        <div class="form-group" style="margin-bottom:0;">
                            <label>الاسم الكامل</label>
                            <input type="text" placeholder="أدخل اسمك" />
                        </div>
                        <div class="form-group" style="margin-bottom:0;">
                            <label>البريد الإلكتروني</label>
                            <input type="email" placeholder="example@mail.com" dir="ltr" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label>نوع الاستفسار</label>
                        <select>
                            <option>دعم فني</option>
                            <option>استفسار مبيعات</option>
                            <option>شراكات</option>
                            <option>أخرى</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>الرسالة</label>
                        <textarea rows="4" placeholder="كيف يمكننا مساعدتك؟"></textarea>
                    </div>

                    <button type="submit" class="btn-submit">إرسال الرسالة</button>
                </form>
            </div>
        </div>
    </section>

    
    <footer class="site-footer">
        <div class="footer-inner">
            <div style="text-align:center;">
                <div class="footer-brand-name">Matjar Hub</div>
                <div class="footer-brand-desc">المنصة الرائدة في تمكين التجار في العالم العربي</div>
            </div>

            <div class="footer-links">
                <a href="#">الرئيسية</a>
            </div>

            <div class="footer-copy">© 2026 Matjar Hub. جميع الحقوق محفوظة.</div>
        </div>
    </footer>

    
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init({
            once: true, // تشغيل الأنيميشن مرة واحدة فقط
            offset: 80, // المسافة قبل التفعيل
            easing: 'ease-out-quad',
        });
    </script>

</body>

</html>
<?php /**PATH C:\laragon\www\Storemart_SaaS\resources\views/landing2/index.blade.php ENDPATH**/ ?>