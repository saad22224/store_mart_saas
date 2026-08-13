<!DOCTYPE html>
<html class="scroll-smooth" dir="<?php echo e($lang == 'ar' ? 'rtl' : 'ltr'); ?>" lang="<?php echo e($lang); ?>">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>مركز الدعم والمساعد الذكي - MatjarHub</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>

    
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css" />
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;900&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#15AC82",
                        "secondary": "#0D8D6B",
                        "accent": "#FACC15",
                        "background": "#F8FAFC",
                        "surface": "#ffffff",
                    },
                    fontFamily: {
                        "headline": ["Cairo"],
                        "body": ["Cairo"],
                    },
                },
            },
        }
    </script>

    <style>
        body {
            font-family: 'Cairo', sans-serif;
            background-color: #F8FAFC;
            color: #0F172A;
        }

        .gradient-text {
            background: linear-gradient(135deg, #15AC82 0%, #0D8D6B 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .gradient-bg {
            background: linear-gradient(135deg, #15AC82 0%, #0D8D6B 100%);
        }

        /* PrimeTech Developed By Badge */
        .primetech-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.55rem 1.4rem;
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            color: #f8fafc;
            text-decoration: none !important;
            border-radius: 9999px;
            font-size: 0.85rem;
            font-weight: 500;
            letter-spacing: 0.3px;
            box-shadow: 0 4px 15px rgba(15, 23, 42, 0.15), 0 0 0 1px rgba(255, 255, 255, 0.1) inset;
            transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            cursor: pointer;
        }

        .primetech-badge::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.75s ease;
        }

        .primetech-badge:hover::before {
            left: 100%;
        }

        .primetech-badge:hover {
            transform: translateY(-2px) scale(1.04);
            background: linear-gradient(135deg, #111827 0%, #064e3b 100%);
            box-shadow: 0 8px 25px rgba(37, 211, 102, 0.35), 0 0 0 1px rgba(37, 211, 102, 0.4) inset;
            color: #ffffff;
        }

        .primetech-text {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            direction: ltr;
        }

        .primetech-name {
            font-weight: 800;
            background: linear-gradient(135deg, #25D366 0%, #34d399 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-size: 0.95rem;
            letter-spacing: 0.5px;
        }

        .site-header {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 50;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(226, 232, 240, 0.6);
        }

        .chat-bubble-user {
            background: linear-gradient(135deg, #15AC82 0%, #0D8D6B 100%);
            color: white;
            border-radius: 1.25rem 1.25rem 0.25rem 1.25rem;
        }

        .chat-bubble-ai {
            background: #FFFFFF;
            color: #0F172A;
            border: 1px solid #E2E8F0;
            border-radius: 1.25rem 1.25rem 1.25rem 0.25rem;
            box-shadow: 0 4px 14px rgba(15, 23, 42, 0.04);
        }

        .typing-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background-color: #15AC82;
            animation: typingBounce 1.4s infinite ease-in-out both;
        }

        .typing-dot:nth-child(1) { animation-delay: -0.32s; }
        .typing-dot:nth-child(2) { animation-delay: -0.16s; }

        @keyframes typingBounce {
            0%, 80%, 100% { transform: scale(0); }
            40% { transform: scale(1); }
        }
    </style>
</head>

<body class="bg-slate-50 antialiased min-h-screen flex flex-col justify-between">

    
    <header class="site-header">
        <div class="max-w-7xl mx-auto px-6 py-3 flex items-center justify-between">
            <a href="<?php echo e(url('/')); ?>" class="flex items-center gap-3">
                <img style="width:75px;height:75px;" src="<?php echo e(asset('public/images/matjarhub.png')); ?>" alt="MatjarHub">
            </a>

            <div class="hidden md:flex items-center gap-8 font-bold text-slate-600">
                <a href="<?php echo e(url('/')); ?>" class="hover:text-emerald-600 transition">الرئيسية</a>
                <a href="<?php echo e(url('/#pricing')); ?>" class="hover:text-emerald-600 transition">الباقات</a>
                <a href="#tutorials" class="hover:text-emerald-600 transition">الشروحات</a>
                <a href="#ai-assistant" class="text-emerald-600 font-black border-b-2 border-emerald-600 pb-1">المساعد الذكي</a>
            </div>

            <div class="flex items-center gap-3">
                <a href="<?php echo e(url('admin')); ?>" class="px-5 py-2.5 rounded-full text-emerald-600 font-bold bg-emerald-50 hover:bg-emerald-100 transition border border-emerald-200">
                    تسجيل الدخول
                </a>
                <a href="<?php echo e(url('admin/register')); ?>" class="px-5 py-2.5 rounded-full text-white font-bold gradient-bg shadow-md shadow-emerald-500/20 hover:opacity-95 transition">
                    أنشئ متجرك مجاناً
                </a>
            </div>
        </div>
    </header>

    <main class="pt-28 pb-20 flex-1">
        
        <section class="max-w-7xl mx-auto px-6 py-12 text-center">
            <div data-aos="fade-down" class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-emerald-50 text-emerald-600 text-sm font-extrabold mb-4 shadow-sm">
                <span class="material-symbols-outlined text-base">support_agent</span>
                <span>مركز الدعم الفني والتعليمات</span>
            </div>
            <h1 data-aos="fade-up" class="text-3xl md:text-5xl font-black text-slate-900 leading-tight mb-4">
                كيف يمكننا <span class="gradient-text">مساعدتك اليوم؟</span>
            </h1>
            <p data-aos="fade-up" data-aos-delay="100" class="text-slate-600 text-lg max-w-2xl mx-auto">
                شاهد الفيديوهات التوضيحية الخطوة بخطوة، أو اسأل المساعد الذكي المدعوم بالذكاء الاصطناعي للإجابة عن أي سؤال يخص إعداد متجرك.
            </p>
        </section>

        
        <section id="tutorials" class="max-w-7xl mx-auto px-6 py-10">
            <div class="flex items-center justify-between mb-8 border-b border-slate-200 pb-4">
                <div>
                    <h2 class="text-2xl font-black text-slate-900 flex items-center gap-2">
                        <span class="material-symbols-outlined text-emerald-600 text-3xl">play_circle</span>
                        الفيديوهات التعليمية الشاملة
                    </h2>
                    <p class="text-slate-500 text-sm mt-1">شروحات ميسرة تغطي كل تفاصيل بناء متجرك الإلكتروني</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                
                <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm hover:shadow-lg transition-all group" data-aos="fade-up">
                    <div class="relative bg-slate-900 aspect-video flex items-center justify-center cursor-pointer" onclick="playVideo('<?php echo e(asset('public/videos/category.mp4')); ?>', 'إضافة فئة')">
                        <video class="w-full h-full object-cover opacity-70 group-hover:scale-105 transition duration-500" preload="metadata">
                            <source src="<?php echo e(asset('public/videos/category.mp4')); ?>#t=0.1" type="video/mp4">
                        </video>
                        <div class="absolute w-14 h-14 rounded-full bg-emerald-500 text-white flex items-center justify-center shadow-lg group-hover:scale-110 transition">
                            <span class="material-symbols-outlined text-3xl">play_arrow</span>
                        </div>
                    </div>
                    <div class="p-5">
                        <span class="inline-block px-2.5 py-0.5 rounded-md bg-emerald-50 text-emerald-600 text-xs font-bold mb-2">الأقسام</span>
                        <h3 class="font-bold text-slate-900 text-lg mb-2">كيف تضيف فئة / قسم جديد؟</h3>
                        <p class="text-slate-500 text-sm leading-relaxed">شرح توضيحي لكيفية إضافة فئات وأقسام لترتيب منتجات متجرك.</p>
                    </div>
                </div>

                
                <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm hover:shadow-lg transition-all group" data-aos="fade-up" data-aos-delay="100">
                    <div class="relative bg-slate-900 aspect-video flex items-center justify-center cursor-pointer" onclick="playVideo('<?php echo e(asset('public/videos/instgram.mp4')); ?>', 'إستيراد المنتجات من إنستجرام')">
                        <video class="w-full h-full object-cover opacity-70 group-hover:scale-105 transition duration-500" preload="metadata">
                            <source src="<?php echo e(asset('public/videos/instgram.mp4')); ?>#t=0.1" type="video/mp4">
                        </video>
                        <div class="absolute w-14 h-14 rounded-full bg-emerald-500 text-white flex items-center justify-center shadow-lg group-hover:scale-110 transition">
                            <span class="material-symbols-outlined text-3xl">play_arrow</span>
                        </div>
                    </div>
                    <div class="p-5">
                        <span class="inline-block px-2.5 py-0.5 rounded-md bg-blue-50 text-blue-600 text-xs font-bold mb-2">الربط والاستيراد</span>
                        <h3 class="font-bold text-slate-900 text-lg mb-2">طريقة إستيراد المنتجات من إنستجرام</h3>
                        <p class="text-slate-500 text-sm leading-relaxed">تعلم كيفية جلب منتجاتك وصورك مباشرة من حسابك على إنستجرام.</p>
                    </div>
                </div>

                
                <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm hover:shadow-lg transition-all group" data-aos="fade-up" data-aos-delay="200">
                    <div class="relative bg-slate-900 aspect-video flex items-center justify-center cursor-pointer" onclick="playVideo('<?php echo e(asset('public/videos/logo.mp4')); ?>', 'تغيير اللوجو')">
                        <video class="w-full h-full object-cover opacity-70 group-hover:scale-105 transition duration-500" preload="metadata">
                            <source src="<?php echo e(asset('public/videos/logo.mp4')); ?>#t=0.1" type="video/mp4">
                        </video>
                        <div class="absolute w-14 h-14 rounded-full bg-emerald-500 text-white flex items-center justify-center shadow-lg group-hover:scale-110 transition">
                            <span class="material-symbols-outlined text-3xl">play_arrow</span>
                        </div>
                    </div>
                    <div class="p-5">
                        <span class="inline-block px-2.5 py-0.5 rounded-md bg-purple-50 text-purple-600 text-xs font-bold mb-2">التصميم والمظهر</span>
                        <h3 class="font-bold text-slate-900 text-lg mb-2">كيف تغير شعار (اللوجو) الخاص بمتجرك؟</h3>
                        <p class="text-slate-500 text-sm leading-relaxed">خطوات بسيطة لرفع شعارك الجديد وتحديث هوية متجرك البصرية.</p>
                    </div>
                </div>

                
                <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm hover:shadow-lg transition-all group" data-aos="fade-up" data-aos-delay="300">
                    <div class="relative bg-slate-900 aspect-video flex items-center justify-center cursor-pointer" onclick="playVideo('<?php echo e(asset('public/videos/product.mp4')); ?>', 'إضافة منتج')">
                        <video class="w-full h-full object-cover opacity-70 group-hover:scale-105 transition duration-500" preload="metadata">
                            <source src="<?php echo e(asset('public/videos/product.mp4')); ?>#t=0.1" type="video/mp4">
                        </video>
                        <div class="absolute w-14 h-14 rounded-full bg-emerald-500 text-white flex items-center justify-center shadow-lg group-hover:scale-110 transition">
                            <span class="material-symbols-outlined text-3xl">play_arrow</span>
                        </div>
                    </div>
                    <div class="p-5">
                        <span class="inline-block px-2.5 py-0.5 rounded-md bg-emerald-50 text-emerald-600 text-xs font-bold mb-2">المنتجات</span>
                        <h3 class="font-bold text-slate-900 text-lg mb-2">طريقة إضافة منتج جديد</h3>
                        <p class="text-slate-500 text-sm leading-relaxed">تعرف على كيفية رفع المنتجات وتحديد أسعارها وتفاصيلها.</p>
                    </div>
                </div>
            </div>
        </section>

        
        <section id="ai-assistant" class="max-w-4xl mx-auto px-6 py-12">
            <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xl overflow-hidden" data-aos="zoom-in">
                <div class="gradient-bg p-6 text-white flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-2xl bg-white/20 backdrop-blur-md flex items-center justify-center text-white font-bold shadow-inner">
                            <span class="material-symbols-outlined text-2xl">auto_awesome</span>
                        </div>
                        <div>
                            <h3 class="font-black text-xl">المساعد الذكي لـ MatjarHub</h3>
                            <p class="text-emerald-100 text-xs mt-0.5">اسأل أي سؤال عن طريقة استخدام وإدارة متجرك وسيتم الإجابة فوراً</p>
                        </div>
                    </div>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/20 text-xs font-bold text-white border border-white/30">
                        <span class="w-2 h-2 rounded-full bg-emerald-300 animate-ping"></span>
                        متصل وجاهز للرد
                    </span>
                </div>

                
                <div class="p-4 bg-slate-50 border-b border-slate-100 flex items-center gap-2 overflow-x-auto scrollbar-none">
                    <span class="text-xs font-bold text-slate-500 whitespace-nowrap shrink-0">أسئلة سريعة:</span>
                    <button type="button" onclick="askPreset('كيف أضيف منتج جديد في المتجر؟')" class="px-3.5 py-1.5 rounded-full bg-white text-xs font-bold text-slate-700 border border-slate-200 hover:border-emerald-500 hover:text-emerald-600 transition whitespace-nowrap shadow-2xs">
                        ازاي اضيف منتج جديد؟
                    </button>
                    <button type="button" onclick="askPreset('كيف أضيف قسم جديد لتصنيف المنتجات؟')" class="px-3.5 py-1.5 rounded-full bg-white text-xs font-bold text-slate-700 border border-slate-200 hover:border-emerald-500 hover:text-emerald-600 transition whitespace-nowrap shadow-2xs">
                        ازاي اضيف قسم؟
                    </button>
                    <button type="button" onclick="askPreset('كيف أغير شعار المتجر وألوان الواجهة؟')" class="px-3.5 py-1.5 rounded-full bg-white text-xs font-bold text-slate-700 border border-slate-200 hover:border-emerald-500 hover:text-emerald-600 transition whitespace-nowrap shadow-2xs">
                        طريقة تغيير إعدادات وشعار المتجر
                    </button>
                    <button type="button" onclick="askPreset('كيف أغير صورة البروفايل وبيانات الحساب؟')" class="px-3.5 py-1.5 rounded-full bg-white text-xs font-bold text-slate-700 border border-slate-200 hover:border-emerald-500 hover:text-emerald-600 transition whitespace-nowrap shadow-2xs">
                        ازاي اغير صورة البروفايل؟
                    </button>
                    <button type="button" onclick="askPreset('كيف أربط الدومين الخاص بي بالمتجر؟')" class="px-3.5 py-1.5 rounded-full bg-white text-xs font-bold text-slate-700 border border-slate-200 hover:border-emerald-500 hover:text-emerald-600 transition whitespace-nowrap shadow-2xs">
                        طريقة ربط الدومين الخاص
                    </button>
                </div>

                
                <div id="chatHistory" class="p-6 space-y-4 max-h-[460px] overflow-y-auto min-h-[280px]">
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-full gradient-bg flex items-center justify-center text-white shrink-0 mt-1 shadow-sm">
                            <span class="material-symbols-outlined text-sm">smart_toy</span>
                        </div>
                        <div class="chat-bubble-ai p-4 text-sm leading-relaxed max-w-[85%]">
                            أهلاً بك! 👋 أنا المساعد الذكي لمنصة <strong>MatjarHub</strong>. <br>
                            كيف يمكنني مساعدتك في ضبط وإدارة متجرك الإلكتروني اليوم؟ تفضل بطرح سؤالك مباشرة.
                        </div>
                    </div>
                </div>

                
                <div id="typingIndicator" class="px-6 py-2 hidden">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full gradient-bg flex items-center justify-center text-white shrink-0 shadow-sm">
                            <span class="material-symbols-outlined text-sm">smart_toy</span>
                        </div>
                        <div class="chat-bubble-ai px-4 py-3 flex items-center gap-1.5">
                            <div class="typing-dot"></div>
                            <div class="typing-dot"></div>
                            <div class="typing-dot"></div>
                        </div>
                    </div>
                </div>

                
                <form id="aiForm" class="p-4 border-t border-slate-100 flex items-center gap-3 bg-slate-50/50">
                    <input type="text" id="userQuestionInput" placeholder="اكتب سؤالك هنا... (مثلاً: ازاي اضيف قسم جديد أو اغير الدومين)"
                        class="flex-1 bg-white border border-slate-200 rounded-2xl px-4 py-3 text-sm focus:outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 text-slate-800" required>
                    <button type="submit" id="sendBtn" class="px-6 py-3 rounded-2xl gradient-bg text-white font-bold text-sm shadow-md hover:opacity-95 transition flex items-center gap-2 shrink-0">
                        <span>إرسال</span>
                        <span class="material-symbols-outlined text-base">send</span>
                    </button>
                </form>
            </div>
        </section>
    </main>

    
    <footer class="bg-slate-900 text-slate-400 text-sm py-8 border-t border-slate-800">
        <div class="max-w-7xl mx-auto px-6 flex flex-col items-center justify-center gap-3 text-center">
            <a href="https://wa.me/201099615358" target="_blank" rel="noopener noreferrer" class="primetech-badge">
                <span class="primetech-text">Developed by <strong class="primetech-name">PrimeTech</strong></span>
            </a>
            <p>© <?php echo e(date('Y')); ?> MatjarHub. جميع الحقوق محفوظة.</p>
        </div>
    </footer>

    
    <div id="videoModal" class="fixed inset-0 z-50 hidden bg-black/80 backdrop-blur-sm items-center justify-center p-4">
        <div class="bg-white rounded-3xl max-w-3xl w-full overflow-hidden shadow-2xl relative">
            <div class="p-4 border-b border-slate-100 flex items-center justify-between">
                <h4 id="videoTitle" class="font-bold text-slate-900 text-base">عنوان الشرح</h4>
                <button type="button" onclick="closeVideoModal()" class="w-8 h-8 rounded-full bg-slate-100 hover:bg-slate-200 flex items-center justify-center text-slate-600">
                    <span class="material-symbols-outlined text-lg">close</span>
                </button>
            </div>
            <div class="aspect-video bg-black">
                <video id="videoPlayer" class="w-full h-full" controls>
                    <source src="" type="video/mp4">
                </video>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init({ once: true, duration: 700 });

        function playVideo(url, title) {
            document.getElementById('videoTitle').innerText = title;
            const videoPlayer = document.getElementById('videoPlayer');
            videoPlayer.src = url;
            videoPlayer.play();
            document.getElementById('videoModal').classList.remove('hidden');
            document.getElementById('videoModal').classList.add('flex');
        }

        function closeVideoModal() {
            const videoPlayer = document.getElementById('videoPlayer');
            videoPlayer.pause();
            videoPlayer.src = '';
            document.getElementById('videoModal').classList.add('hidden');
            document.getElementById('videoModal').classList.remove('flex');
        }

        function askPreset(text) {
            document.getElementById('userQuestionInput').value = text;
            document.getElementById('aiForm').dispatchEvent(new Event('submit'));
        }

        document.getElementById('aiForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const input = document.getElementById('userQuestionInput');
            const question = input.value.trim();
            if (!question) return;

            const chatHistory = document.getElementById('chatHistory');
            const typingIndicator = document.getElementById('typingIndicator');

            // Append User Message
            const userMsgHtml = `
                <div class="flex items-start justify-end gap-3">
                    <div class="chat-bubble-user p-4 text-sm leading-relaxed max-w-[85%]">
                        ${escapeHtml(question)}
                    </div>
                </div>
            `;
            chatHistory.insertAdjacentHTML('beforeend', userMsgHtml);
            input.value = '';
            chatHistory.scrollTop = chatHistory.scrollHeight;

            // Show typing indicator
            typingIndicator.classList.remove('hidden');
            chatHistory.scrollTop = chatHistory.scrollHeight;

            try {
                const response = await fetch("<?php echo e(route('landing2.ai.ask')); ?>", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ question: question })
                });

                const data = await response.json();
                typingIndicator.classList.add('hidden');

                let aiAnswer = '';
                if (data.status && data.answer) {
                    aiAnswer = formatMarkdown(data.answer);
                } else {
                    aiAnswer = data.message || 'عذراً، حدث خطأ أثناء الاتصال بالمساعد الذكي. حاول مرة أخرى.';
                }

                const aiMsgHtml = `
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-full gradient-bg flex items-center justify-center text-white shrink-0 mt-1 shadow-sm">
                            <span class="material-symbols-outlined text-sm">smart_toy</span>
                        </div>
                        <div class="chat-bubble-ai p-4 text-sm leading-relaxed max-w-[85%] space-y-2">
                            ${aiAnswer}
                        </div>
                    </div>
                `;
                chatHistory.insertAdjacentHTML('beforeend', aiMsgHtml);
                chatHistory.scrollTop = chatHistory.scrollHeight;

            } catch (err) {
                typingIndicator.classList.add('hidden');
                const errorHtml = `
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-full bg-red-500 flex items-center justify-center text-white shrink-0 mt-1 shadow-sm">
                            <span class="material-symbols-outlined text-sm">error</span>
                        </div>
                        <div class="chat-bubble-ai p-4 text-sm leading-relaxed max-w-[85%] text-red-600">
                            تعذر الوصول للسيرفر، يرجى التأكد من الاتصال وإعادة المحاولة.
                        </div>
                    </div>
                `;
                chatHistory.insertAdjacentHTML('beforeend', errorHtml);
                chatHistory.scrollTop = chatHistory.scrollHeight;
            }
        });

        function escapeHtml(text) {
            return text.replace(/[&<>"']/g, function(m) {
                return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#039;' }[m];
            });
        }

        function formatMarkdown(text) {
            let formatted = escapeHtml(text);
            formatted = formatted.replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>');
            formatted = formatted.replace(/\*(.*?)\*/g, '<em>$1</em>');
            formatted = formatted.replace(/\n\n/g, '<br><br>');
            formatted = formatted.replace(/\n/g, '<br>');
            return formatted;
        }
    </script>
</body>

</html>
<?php /**PATH C:\laragon\www\matjarhub\resources\views/landing2/help.blade.php ENDPATH**/ ?>