<?php $__env->startSection('content'); ?>
    <style>
        .ob-wrap {
            min-height: 100vh;
            background: linear-gradient(135deg, #0f172a, #1e293b, #0f172a);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            position: relative;
            overflow: hidden
        }

        .ob-wrap::before {
            content: '';
            position: absolute;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(99, 102, 241, .12), transparent 70%);
            top: -100px;
            right: -100px;
            border-radius: 50%
        }

        .ob-wrap::after {
            content: '';
            position: absolute;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(168, 85, 247, .08), transparent 70%);
            bottom: -50px;
            left: -50px;
            border-radius: 50%
        }

        .ob-box {
            width: 100%;
            max-width: 780px;
            position: relative;
            z-index: 2
        }

        .ob-dots {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0;
            margin-bottom: 2rem
        }

        .ob-dot {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 1rem;
            background: rgba(255, 255, 255, .06);
            color: #64748b;
            border: 2px solid rgba(255, 255, 255, .08);
            transition: all .4s
        }

        .ob-dot.on {
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            color: #fff;
            border-color: #6366f1;
            box-shadow: 0 0 20px rgba(99, 102, 241, .4);
            transform: scale(1.1)
        }

        .ob-dot.ok {
            background: linear-gradient(135deg, #10b981, #059669);
            color: #fff;
            border-color: #10b981
        }

        .ob-line {
            width: 50px;
            height: 3px;
            background: rgba(255, 255, 255, .06);
            margin: 0 .4rem;
            border-radius: 2px;
            overflow: hidden;
            margin-bottom: 20px
        }

        .ob-line .f {
            height: 100%;
            width: 0;
            background: linear-gradient(90deg, #10b981, #6366f1);
            transition: width .4s
        }

        .ob-line.filled .f {
            width: 100%
        }

        .ob-lbl {
            color: #64748b;
            font-size: .65rem;
            text-align: center;
            margin-top: .3rem;
            font-weight: 600
        }

        .ob-lbl.on {
            color: #e2e8f0
        }

        .ob-card {
            background: rgba(255, 255, 255, .03);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, .06);
            border-radius: 24px;
            padding: 2.5rem 2rem
        }

        .ob-p {
            display: none;
            animation: obIn .35s ease
        }

        .ob-p.on {
            display: block
        }

        @keyframes obIn {
            from {
                opacity: 0;
                transform: translateY(15px)
            }

            to {
                opacity: 1;
                transform: translateY(0)
            }
        }

        .ob-h {
            font-size: 1.4rem;
            font-weight: 800;
            color: #f1f5f9;
            margin-bottom: .3rem
        }

        .ob-sub {
            color: #94a3b8;
            font-size: .82rem;
            margin-bottom: 1.5rem
        }

        .ob-ico {
            width: 56px;
            height: 56px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: .75rem
        }

        .ob-ico-1 {
            background: rgba(99, 102, 241, .15);
            color: #a78bfa
        }

        .ob-ico-2 {
            background: rgba(236, 72, 153, .15);
            color: #f472b6
        }

        .ob-ico-3 {
            background: rgba(245, 158, 11, .15);
            color: #fbbf24
        }

        /* Category Grid */
        .cat-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(110px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem
        }

        .cat-chip {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: .75rem;
            cursor: pointer;
            transition: all .3s;
            padding: 10px;
            border-radius: 16px
        }

        .cat-img-box {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .05);
            border: 2.5px solid rgba(255, 255, 255, .1);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            transition: all .3s;
            position: relative
        }

        .cat-img-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: all .4s
        }

        .cat-chip:hover .cat-img-box {
            border-color: rgba(99, 102, 241, .5);
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(99, 102, 241, .2)
        }

        .cat-chip.picked .cat-img-box {
            border-color: #6366f1;
            background: rgba(99, 102, 241, .15);
            box-shadow: 0 0 20px rgba(99, 102, 241, .4)
        }

        .cat-chip.picked .cat-img-box::after {
            content: '✓';
            position: absolute;
            top: 0;
            right: 0;
            width: 24px;
            height: 24px;
            background: #6366f1;
            color: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 900;
            border: 2px solid #1e293b
        }

        .cat-name-lbl {
            color: #cbd5e1;
            font-size: .85rem;
            font-weight: 700;
            text-align: center;
            transition: all .3s
        }

        .cat-chip.picked .cat-name-lbl {
            color: #fff
        }

        /* Instagram Post Card */
        .ig-post-card {
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 12px;
            overflow: hidden;
            background: rgba(255, 255, 255, 0.02);
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            display: flex;
            flex-direction: column;
        }

        .ig-post-card:hover {
            border-color: rgba(99, 102, 241, 0.5);
            transform: translateY(-3px);
            background: rgba(255, 255, 255, 0.04);
        }

        .ig-post-card.picked {
            border-color: #6366f1;
            background: rgba(99, 102, 241, 0.1);
            box-shadow: 0 0 15px rgba(99, 102, 241, 0.3);
        }

        .ig-post-card.picked::after {
            content: '\f00c';
            font-family: "Font Awesome 6 Free", sans-serif;
            font-weight: 900;
            position: absolute;
            top: 10px;
            right: 10px;
            width: 24px;
            height: 24px;
            background: #6366f1;
            color: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            z-index: 2;
            box-shadow: 0 2px 5px rgba(0,0,0,0.3);
        }

        .ig-post-img {
            width: 100%;
            height: 140px;
            object-fit: cover;
        }

        .ig-post-body {
            padding: 10px;
            flex: 1;
        }

        .ig-post-caption {
            font-size: 0.75rem;
            color: #cbd5e1;
            line-height: 1.5;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
        }

        /* Instagram Selected Items Form */
        .ig-selected-list {
            display: flex;
            flex-direction: column;
            gap: 15px;
            margin-top: 10px;
        }

        .ig-selected-item {
            display: flex;
            gap: 15px;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 12px;
            padding: 15px;
            align-items: flex-start;
        }

        .ig-selected-img {
            width: 80px;
            height: 80px;
            border-radius: 8px;
            object-fit: cover;
            flex-shrink: 0;
            border: 1px solid rgba(255,255,255,0.1);
        }

        .ig-selected-fields {
            flex: 1;
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 10px;
        }

        .ig-selected-fields .set-row {
            margin-bottom: 0;
        }

        @media (max-width: 768px) {
            .ig-selected-item {
                flex-direction: column;
            }
            .ig-selected-fields {
                grid-template-columns: 1fr;
                width: 100%;
            }
        }

        .cat-custom-wrap {
            background: rgba(255, 255, 255, .03);
            border: 1px dashed rgba(255, 255, 255, .15);
            border-radius: 20px;
            padding: 1.5rem;
            margin-bottom: 1.5rem
        }

        .cat-custom {
            display: flex;
            gap: .75rem;
            align-items: center
        }

        .cat-custom-img-up {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .05);
            border: 1.5px dashed rgba(255, 255, 255, .2);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: #94a3b8;
            transition: all .2s;
            overflow: hidden;
            flex-shrink: 0
        }

        .cat-custom-img-up:hover {
            border-color: #6366f1;
            color: #6366f1;
            background: rgba(99, 102, 241, .1)
        }

        .cat-custom-img-up img {
            width: 100%;
            height: 100%;
            object-fit: cover
        }

        .cat-custom input {
            flex: 1;
            padding: .75rem 1.25rem;
            border-radius: 12px;
            border: 1.5px solid rgba(255, 255, 255, .1);
            background: rgba(255, 255, 255, .04);
            color: #e2e8f0;
            font-size: .9rem
        }

        .cat-custom input:focus {
            border-color: #6366f1;
            outline: none
        }

        .cat-custom button {
            padding: .75rem 1.5rem;
            border-radius: 12px;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            border: none;
            color: #fff;
            font-weight: 700;
            font-size: .9rem;
            cursor: pointer;
            transition: all .3s
        }

        .cat-custom button:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(99, 102, 241, .3)
        }

        /* Settings rows */
        .set-row {
            margin-bottom: 1.2rem
        }

        .set-row label {
            display: block;
            color: #cbd5e1;
            font-size: .8rem;
            font-weight: 600;
            margin-bottom: .35rem
        }

        .set-row input,
        .set-row select {
            width: 100%;
            padding: .65rem 1.2rem;
            border-radius: 12px;
            border: 1.5px solid rgba(255, 255, 255, .1);
            background: rgba(255, 255, 255, .04);
            color: #e2e8f0;
            font-size: .85rem;
            transition: all .3s
        }

        .set-row input:focus {
            border-color: #6366f1;
            outline: none;
            background: rgba(255, 255, 255, .07)
        }

        .set-row select option {
            background: #1e293b;
            color: #e2e8f0
        }

        .set-row input[type=file] {
            padding: .5rem 1.2rem
        }

        .ob-btn {
            padding: .7rem 2rem;
            border-radius: 14px;
            font-weight: 700;
            border: none;
            transition: all .3s;
            font-size: .9rem;
            cursor: pointer
        }

        .ob-btn-go {
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            color: #fff
        }

        .ob-btn-go:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(99, 102, 241, .35);
            color: #fff
        }

        .ob-btn-fin {
            background: linear-gradient(135deg, #10b981, #059669);
            color: #fff;
            padding: .8rem 3rem;
            font-size: 1.1rem;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(16, 185, 129, .3)
        }

        .ob-btn-fin:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(16, 185, 129, .4);
            color: #fff
        }

        .ob-btn-bk {
            background: rgba(255, 255, 255, .06);
            color: #94a3b8;
            border: 1px solid rgba(255, 255, 255, .08)
        }

        .ob-btn-bk:hover {
            background: rgba(255, 255, 255, .1);
            color: #e2e8f0
        }

        .ob-skip {
            color: #64748b;
            font-size: .82rem;
            text-decoration: none;
            cursor: pointer
        }

        .ob-skip:hover {
            color: #e2e8f0
        }

        .ob-saved {
            display: inline-flex;
            align-items: center;
            gap: .3rem;
            padding: .25rem .7rem;
            border-radius: 8px;
            background: rgba(16, 185, 129, .15);
            color: #34d399;
            font-size: .75rem;
            font-weight: 600
        }

        /* Icon Fix - Broadest Possible */
        i,
        .fa,
        .fas,
        .far,
        .fal,
        .fa-solid,
        .fa-regular,
        .fa-light,
        [class^="fa-"]:not(.fa-brands):not(.fab),
        [class*=" fa-"]:not(.fa-brands):not(.fab) {
            font-family: "Font Awesome 6 Pro", "Font Awesome 6 Free", sans-serif !important;
        }

        .fa-brands,
        .fab {
            font-family: "Font Awesome 6 Brands" !important;
        }

        @media(max-width:640px) {
            .ob-card {
                padding: 1.5rem
            }

            .ob-h {
                font-size: 1.1rem
            }

            .ob-line {
                width: 20px
            }

            .cat-grid {
                gap: .4rem
            }

            .cat-chip {
                padding: .45rem .8rem;
                font-size: .78rem
            }

            .ob-btn {
                padding: .6rem 1rem;
                font-size: .85rem;
                width: 100%;
                margin-top: .5rem;
                text-align: center;
                display: block;
            }

            .ob-btn-fin {
                padding: .7rem 1.5rem;
                font-size: 1rem;
                width: 100%;
                margin-top: .5rem;
                display: block;
            }

            .ob-p .d-flex.justify-content-between {
                flex-direction: column-reverse;
                gap: 1rem;
            }

            .ob-btn-bk {
                margin-top: 0;
            }
            
            .ob-p .d-flex.gap-3 {
                flex-direction: column-reverse;
                width: 100%;
                gap: 0.5rem !important;
            }

            .cat-custom {
                flex-direction: column;
                align-items: stretch;
            }

            .cat-custom-img-up {
                align-self: center;
                margin-bottom: .5rem;
            }

            .cat-custom button {
                width: 100%;
            }

            .ob-p form {
                width: 100%;
                margin: 0;
            }
        }
    </style>

    <div class="ob-wrap">
        <div class="ob-box">
            <div class="ob-dots">
                <?php for($s = 1; $s <= 5; $s++): ?>
                    <div class="text-center">
                        <div class="ob-dot <?php echo e($s == 1 ? 'on' : ''); ?>" id="d<?php echo e($s); ?>"><?php echo e($s); ?></div>
                        <div class="ob-lbl <?php echo e($s == 1 ? 'on' : ''); ?>" id="l<?php echo e($s); ?>">
                            <?php if($s == 1): ?>
                                الأقسام
                            <?php elseif($s == 2): ?>
                                منتج
                            <?php elseif($s == 3): ?>
                                انستاجرام
                            <?php elseif($s == 4): ?>
                                إعدادات
                            <?php else: ?>
                                انطلق
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php if($s < 5): ?>
                        <div class="ob-line" id="ln<?php echo e($s); ?>">
                            <div class="f"></div>
                        </div>
                    <?php endif; ?>
                <?php endfor; ?>
            </div>

            <div class="ob-card">
                
                <div class="ob-p on" id="p1">
                    <div class="ob-ico ob-ico-1"><i class="fa-solid fa-layer-group"></i></div>
                    <h3 class="ob-h">اختر أقسام متجرك</h3>
                    <p class="ob-sub">اختر الأقسام اللي تناسب متجرك، أو أضف أقسام مخصصة. اضغط على القسم لاختياره.</p>

                    <div class="cat-grid" id="catGrid">
                        <?php
                            $isRestaurant = helper::is_restaurant_store(Auth::user()->id);

                            if ($isRestaurant) {
                                $defaultCats = [
                                    ['name' => 'وجبات رئيسية', 'img' => 'https://img.icons8.com/color/144/cutlery.png'],
                                    ['name' => 'مشروبات وعصائر', 'img' => 'https://img.icons8.com/color/144/coffee-to-go.png'],
                                    ['name' => 'مقبلات', 'img' => 'https://img.icons8.com/color/144/nachos.png'],
                                    ['name' => 'حلويات', 'img' => 'https://img.icons8.com/color/144/cupcake.png'],
                                    ['name' => 'وجبات سريعة', 'img' => 'https://img.icons8.com/color/144/hamburger.png'],
                                    ['name' => 'بيتزا', 'img' => 'https://img.icons8.com/color/144/pizza.png'],
                                    ['name' => 'مشاوي', 'img' => 'https://img.icons8.com/color/144/kebab.png'],
                                    ['name' => 'مأكولات بحرية', 'img' => 'https://img.icons8.com/color/144/crab.png'],
                                    ['name' => 'سلطات', 'img' => 'https://img.icons8.com/color/144/salad.png'],
                                    ['name' => 'شاورما', 'img' => 'https://img.icons8.com/color/144/wrap.png'],
                                    // ['name' => 'فطور', 'img' => 'https://img.icons8.com/color/144/pancakes.png'],
                                    ['name' => 'معجنات', 'img' => 'https://img.icons8.com/color/144/croissant.png'],
                                ];
                            } else {
                                $defaultCats = [
                                    ['name' => 'ملابس رجالية', 'img' => 'https://img.icons8.com/color/144/t-shirt.png'],
                                    ['name' => 'ملابس نسائية', 'img' => 'https://img.icons8.com/color/144/womens-shirt.png'],
                                    ['name' => 'ساعات', 'img' => 'https://img.icons8.com/color/144/clock.png'],
                                    ['name' => 'مجوهرات', 'img' => 'https://img.icons8.com/color/144/diamond.png'],
                                    ['name' => 'إلكترونيات', 'img' => 'https://img.icons8.com/color/144/electronics.png'],
                                    ['name' => 'هواتف', 'img' => 'https://img.icons8.com/color/144/smartphone.png'],
                                    ['name' => 'لابتوب', 'img' => 'https://img.icons8.com/color/144/laptop.png'],
                                    ['name' => 'عطور', 'img' => 'https://img.icons8.com/color/144/perfume-bottle.png'],
                                    ['name' => 'مستحضرات تجميل', 'img' => 'https://img.icons8.com/color/144/lipstick.png'],
                                    ['name' => 'طعام ومشروبات', 'img' => 'https://img.icons8.com/color/144/food-and-wine.png'],
                                    ['name' => 'أدوات منزلية', 'img' => 'https://img.icons8.com/color/144/home.png'],
                                    ['name' => 'أثاث', 'img' => 'https://img.icons8.com/color/144/sofa.png'],
                                    // ['name' => 'ألعاب أطفال', 'img' => 'https://img.icons8.com/color/144/teddy-bear.png'],
                                    // ['name' => 'نظارات', 'img' => 'https://img.icons8.com/color/144/glasses.png'],
                                    // ['name' => 'مستلزمات حيوانات', 'img' => 'https://img.icons8.com/color/144/dog.png'],
                                    // ['name' => 'رياضة', 'img' => 'https://img.icons8.com/color/144/basketball.png'],
                                    // ['name' => 'كتب', 'img' => 'https://img.icons8.com/color/144/book.png'],
                                    // ['name' => 'سيارات', 'img' => 'https://img.icons8.com/color/144/car.png'],
                                ];
                            }
                        ?>
                        <?php $__currentLoopData = $defaultCats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="cat-chip" onclick="toggleCat(this)" data-name="<?php echo e($c['name']); ?>"
                                data-img="<?php echo e($c['img']); ?>">
                                <div class="cat-img-box">
                                    <img src="<?php echo e($c['img']); ?>" alt="<?php echo e($c['name']); ?>">
                                </div>
                                <div class="cat-name-lbl"><?php echo e($c['name']); ?></div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                    <div class="cat-custom-wrap">
                        <div class="cat-custom">
                            <div class="cat-custom-img-up" onclick="document.getElementById('customCatImg').click()"
                                title="ارفع صورة للقسم">
                                <i class="fa-solid fa-camera" id="customCatIcon"></i>
                                <img id="customCatPreview" style="display:none">
                            </div>
                            <input type="file" id="customCatImg" style="display:none" accept="image/*"
                                onchange="previewCustomCat(this)">
                            <input type="text" id="customCat" placeholder="أضف قسم مخصص..."
                                onkeypress="if(event.key==='Enter'){event.preventDefault();addCustom()}">
                            <button type="button" onclick="addCustom()"><i class="fa-solid fa-plus me-1"></i>أضف</button>
                        </div>
                    </div>

                    <span id="catSaved" class="ob-saved" style="display:none"><i class="fa-solid fa-check"></i> تم
                        الحفظ</span>

                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <a class="ob-skip" onclick="skipAll()">تخطي الإعداد</a>
                        <button class="ob-btn ob-btn-go" onclick="saveAndNext(1)">حفظ والتالي <i
                                class="fa-solid fa-arrow-left ms-1"></i></button>
                    </div>
                </div>

                
                <div class="ob-p" id="p2">
                    <div class="ob-ico ob-ico-2"><i class="fa-solid fa-box"></i></div>
                    <h3 class="ob-h">أضف منتجك الأول</h3>
                    <p class="ob-sub">عشان متجرك يكون جاهز، خلينا نضيف منتج واحد على الأقل كبداية.</p>

                    <div class="row">
                        <div class="col-md-6 set-row">
                            <label>اسم المنتج *</label>
                            <input type="text" id="prodName" placeholder="مثال: حذاء رياضي">
                        </div>
                        <div class="col-md-6 set-row">
                            <label>السعر *</label>
                            <input type="number" id="prodPrice" placeholder="مثال: 150">
                        </div>
                        <div class="col-md-6 set-row">
                            <label>القسم *</label>
                            <select id="prodCategory">
                                <option value="">اختر القسم</option>
                            </select>
                        </div>
                        <div class="col-md-6 set-row">
                            <label>صورة المنتج</label>
                            <input type="file" id="prodImage" accept="image/*">
                        </div>
                    </div>

                    <span id="prodSaved" class="ob-saved" style="display:none"><i class="fa-solid fa-check"></i> تم
                        الحفظ</span>

                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <button class="ob-btn ob-btn-bk" onclick="goStep(1)"><i
                                class="fa-solid fa-arrow-right me-1"></i>السابق</button>
                        <div class="d-flex gap-3 align-items-center">
                            <a class="ob-skip" onclick="goStep(3)">تخطي</a>
                            <button class="ob-btn ob-btn-go" onclick="saveAndNext(2)">حفظ والتالي <i
                                    class="fa-solid fa-arrow-left ms-1"></i></button>
                        </div>
                    </div>
                </div>

                
                <div class="ob-p" id="p3">
                    <div class="ob-ico ob-ico-2" style="background: rgba(225, 48, 108, .15); color: #e1306c;"><i class="fa-brands fa-instagram"></i></div>
                    <h3 class="ob-h">جلب منتجات انستاجرام</h3>
                    <p class="ob-sub">اربط حساب انستاجرام الخاص بمتجرك لاستيراد منتجاتك مباشرة بضغطة زر. (اختياري)</p>

                    <div class="row">
                        <div class="col-md-12 set-row">
                            <label>اسم المستخدم في انستاجرام (بدون @)</label>
                            <div class="d-flex gap-2">
                                <input type="text" id="igUsername" placeholder="مثال: storemart">
                                <button class="ob-btn ob-btn-go" onclick="fetchInstagram()" id="igFetchBtn" style="white-space: nowrap;">جلب <i class="fa-solid fa-search"></i></button>
                            </div>
                        </div>
                    </div>

                    <div id="igStatusMessage" style="color: #cbd5e1; font-size: 0.85rem; margin-bottom: 1rem;"></div>
                    
                    <div class="cat-grid" id="igPostsContainer" style="gap: 1rem; max-height: 350px; overflow-y: auto; padding-right: 5px;">
                        <!-- Posts will be loaded here -->
                    </div>

                    <div id="igLoadMoreWrap" style="text-align: center; margin-bottom: 1rem; display: none;">
                        <button class="ob-btn ob-btn-bk" onclick="loadMoreInstagram()" id="igLoadMoreBtn" style="padding: .5rem 1rem; font-size: 0.8rem;">عرض المزيد</button>
                    </div>

                    <div id="igImportWrap" style="background: rgba(255,255,255,0.03); padding: 1.5rem; border-radius: 16px; margin-bottom: 1rem; display: none;">
                        <h4 style="color: #f1f5f9; font-size: 1.1rem; margin-bottom: 1rem;">تفاصيل الاستيراد للمنتجات المحددة</h4>
                        
                        <div id="igSelectedItemsContainer" class="ig-selected-list" style="margin-bottom: 1.5rem;">
                            <!-- Selected items will render here dynamically -->
                        </div>

                        <div class="text-end">
                            <button class="ob-btn" style="background: linear-gradient(135deg, #e1306c, #c13584); color: #fff; padding: 1rem 2.5rem; font-size: 1rem;" onclick="importSelectedInstagram()" id="igImportBtn">استيراد المنتجات المحددة</button>
                        </div>
                    </div>

                    <span id="igSaved" class="ob-saved" style="display:none"><i class="fa-solid fa-check"></i> تم الاستيراد بنجاح</span>

                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <button class="ob-btn ob-btn-bk" onclick="goStep(2)"><i class="fa-solid fa-arrow-right me-1"></i>السابق</button>
                        <div class="d-flex gap-3 align-items-center">
                            <a class="ob-skip" onclick="goStep(4)">تخطي</a>
                            <button class="ob-btn ob-btn-go" onclick="goStep(4)">التالي <i class="fa-solid fa-arrow-left ms-1"></i></button>
                        </div>
                    </div>
                </div>

                
                <div class="ob-p" id="p4">
                    <div class="ob-ico ob-ico-3"><i class="fa-solid fa-gear"></i></div>
                    <h3 class="ob-h">إعدادات الاتصال</h3>
                    <p class="ob-sub">أضف تفاصيل التواصل الخاصة بمتجرك عشان العملاء يوصلولك بسهولة.</p>

                    <div class="row">
                        <div class="col-md-12 set-row">
                            <label>العنوان *</label>
                            <input type="text" id="setAddress" value="<?php echo e(@$settings->address ?? ''); ?>"
                                placeholder="المدينة، الشارع">
                        </div>
                        <div class="col-md-12 set-row">
                            <label>العملة *</label>
                            <select id="setCurrency">
                                <option value="ls" <?php echo e(@$settings->default_currency == 'ls' ? 'selected' : ''); ?>>ليرة سورية (ل.س)</option>
                                <option value="usd" <?php echo e(@$settings->default_currency == 'usd' ? 'selected' : ''); ?>>دولار أمريكي ($)</option>
                            </select>
                        </div>
                        <div class="col-md-12 set-row">
                            <label>شعار المتجر (Logo)</label>
                            <input type="file" id="setLogo" accept="image/*">
                        </div>
                    </div>

                    <span id="setSaved" class="ob-saved" style="display:none"><i class="fa-solid fa-check"></i> تم
                        الحفظ</span>

                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <button class="ob-btn ob-btn-bk" onclick="goStep(3)"><i
                                class="fa-solid fa-arrow-right me-1"></i>السابق</button>
                        <button class="ob-btn ob-btn-go" onclick="saveAndNext(4)">حفظ والتالي <i
                                class="fa-solid fa-arrow-left ms-1"></i></button>
                    </div>
                </div>

                
                <div class="ob-p" id="p5">
                    <div style="text-align:center;padding:1.5rem 0">
                        <div
                            style="width:100px;height:100px;border-radius:50%;background:linear-gradient(135deg,#10b981,#059669);display:inline-flex;align-items:center;justify-content:center;font-size:2.5rem;color:#fff;margin-bottom:1.5rem;box-shadow:0 0 40px rgba(16,185,129,.4)">
                            <i class="fa-solid fa-rocket"></i>
                        </div>
                        <h3 class="ob-h" style="text-align:center;font-size:1.8rem">متجرك جاهز للعمل! 🎉</h3>
                        <p class="ob-sub" style="text-align:center;max-width:450px;margin:0 auto 2rem;font-size:.9rem">
                            لقد قمت بإعداد الأقسام، المنتجات، وتفاصيل الاتصال. أنت الآن جاهز لاستقبال العملاء.
                            ستجد جولة تعريفية سريعة في لوحة التحكم.
                        </p>
                        <div class="d-flex justify-content-center gap-3">
                            <button class="ob-btn ob-btn-bk" onclick="goStep(4)" style="padding:.8rem 1.5rem"><i
                                    class="fa-solid fa-arrow-right me-1"></i>رجوع</button>
                            <form action="<?php echo e(URL::to('admin/onboarding/complete')); ?>" method="POST" class="d-inline">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="ob-btn ob-btn-fin">ابدأ وإدارة متجرك <i
                                        class="fa-solid fa-arrow-left ms-2"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleCat(el) {
            el.classList.toggle('picked');
        }

        function previewCustomCat(input) {
            if (input.files && input.files[0]) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('customCatPreview').src = e.target.result;
                    document.getElementById('customCatPreview').style.display = 'block';
                    document.getElementById('customCatIcon').style.display = 'none';
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        function addCustom() {
            let inp = document.getElementById('customCat');
            let v = inp.value.trim();
            if (!v) {
                toastr.warning('يرجى إدخال اسم القسم');
                return;
            }

            let imgInp = document.getElementById('customCatImg');
            if (!imgInp.files || !imgInp.files[0]) {
                toastr.warning('يرجى رفع صورة للقسم المخصص');
                return;
            }
            
            let imgSrc = document.getElementById('customCatPreview').src;

            let grid = document.getElementById('catGrid');
            let chip = document.createElement('div');
            chip.className = 'cat-chip picked';
            chip.dataset.name = v;
            chip.dataset.img = imgSrc;
            if (imgInp.files && imgInp.files[0]) {
                chip._file = imgInp.files[0];
            }
            chip.onclick = function() {
                toggleCat(this);
            };

            chip.innerHTML = `
            <div class="cat-img-box">
                <img src="${imgSrc}" alt="${v}">
            </div>
            <div class="cat-name-lbl">${v}</div>
        `;

            grid.appendChild(chip);
            inp.value = '';
            document.getElementById('customCatPreview').style.display = 'none';
            document.getElementById('customCatPreview').src = '';
            document.getElementById('customCatIcon').style.display = 'block';
            imgInp.value = '';
            toastr.success('تمت إضافة القسم');
        }
    </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script>
        let step = 1;
        const total = 5;

        function goStep(s) {
            step = s;
            for (let i = 1; i <= total; i++) {
                document.getElementById('p' + i).classList.remove('on');
                let dot = document.getElementById('d' + i),
                    lbl = document.getElementById('l' + i);
                dot.classList.remove('on', 'ok');
                lbl.classList.remove('on');
                if (i < step) {
                    dot.classList.add('ok');
                    dot.innerHTML = '<i class="fa-solid fa-check"></i>';
                } else if (i == step) {
                    dot.classList.add('on');
                    lbl.classList.add('on');
                    dot.textContent = i;
                } else {
                    dot.textContent = i;
                }
            }
            document.getElementById('p' + step).classList.add('on');
            for (let i = 1; i < total; i++) {
                let ln = document.getElementById('ln' + i);
                if (i < step) ln.classList.add('filled');
                else ln.classList.remove('filled');
            }
        }

        let isSaving = false;
        function saveAndNext(currentStep) {
            if (isSaving) return;

            let btn = document.querySelector(`#p${currentStep} .ob-btn-go`);
            let originalText = btn.innerHTML;
            
            let setBtnLoading = () => {
                btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> جاري الحفظ...';
                btn.disabled = true;
                isSaving = true;
            };

            let resetBtn = () => {
                btn.innerHTML = originalText;
                btn.disabled = false;
                isSaving = false;
            };

            if (currentStep == 1) {
                let picked = document.querySelectorAll('#catGrid .cat-chip.picked');
                if (picked.length == 0) {
                    toastr.warning('اختر قسم واحد على الأقل');
                    return;
                }

                setBtnLoading();
                let formData = new FormData();
                picked.forEach((c, index) => {
                    formData.append('categories[' + index + '][name]', c.dataset.name);
                    formData.append('categories[' + index + '][img_url]', c.dataset.img || '');
                    if (c._file) {
                        formData.append('categories[' + index + '][image]', c._file);
                    }
                });
                formData.append('_token', '<?php echo e(csrf_token()); ?>');

                fetch("<?php echo e(URL::to('admin/onboarding/save-categories')); ?>", {
                    method: 'POST',
                    body: formData
                }).then(r => r.json()).then(d => {
                    resetBtn();
                    if (d.status == 1) {
                        let select = document.getElementById('prodCategory');
                        select.innerHTML = '<option value="">اختر القسم</option>';
                        if (d.categories && d.categories.length > 0) {
                            d.categories.forEach(cat => {
                                select.innerHTML += '<option value="' + cat.id + '">' + cat.name +
                                    '</option>';
                            });
                        }
                        let s = document.getElementById('catSaved');
                        s.style.display = 'inline-flex';
                        setTimeout(() => {
                            s.style.display = 'none';
                            goStep(2);
                        }, 600);
                    } else {
                        toastr.error('حدث خطأ');
                    }
                }).catch(() => { toastr.error('حدث خطأ'); resetBtn(); });
            } else if (currentStep == 2) {
                let name = document.getElementById('prodName').value;
                let price = document.getElementById('prodPrice').value;
                let cat = document.getElementById('prodCategory').value;
                let img = document.getElementById('prodImage').files[0];

                if (!name || !price) {
                    toastr.warning('يرجى إدخال اسم وسعر المنتج');
                    return;
                }
                
                if (!img) {
                    toastr.warning('يرجى رفع صورة المنتج');
                    return;
                }

                setBtnLoading();
                let formData = new FormData();
                formData.append('item_name', name);
                formData.append('item_price', price);
                if (cat) formData.append('cat_id', cat);
                if (img) formData.append('product_image', img);
                formData.append('_token', '<?php echo e(csrf_token()); ?>');

                fetch("<?php echo e(URL::to('admin/onboarding/save-product')); ?>", {
                    method: 'POST',
                    body: formData
                }).then(r => r.json()).then(d => {
                    resetBtn();
                    if (d.status == 1) {
                        let s = document.getElementById('prodSaved');
                        s.style.display = 'inline-flex';
                        setTimeout(() => {
                            s.style.display = 'none';
                            goStep(3);
                        }, 600);
                    } else {
                        toastr.error('حدث خطأ');
                    }
                }).catch(() => { toastr.error('حدث خطأ'); resetBtn(); });
            } else if (currentStep == 4) {
                let address = document.getElementById('setAddress').value;
                let currency = document.getElementById('setCurrency').value;
                let logo = document.getElementById('setLogo').files[0];

                if (!address) {
                    toastr.warning('يرجى ملء الحقول المطلوبة');
                    return;
                }

                setBtnLoading();
                let formData = new FormData();
                formData.append('address', address);
                formData.append('currency', currency);
                if (logo) formData.append('logo', logo);
                formData.append('_token', '<?php echo e(csrf_token()); ?>');

                fetch("<?php echo e(URL::to('admin/onboarding/save-settings')); ?>", {
                    method: 'POST',
                    body: formData
                }).then(r => r.json()).then(d => {
                    resetBtn();
                    if (d.status == 1) {
                        let s = document.getElementById('setSaved');
                        s.style.display = 'inline-flex';
                        setTimeout(() => {
                            s.style.display = 'none';
                            goStep(5);
                        }, 600);
                    } else {
                        toastr.error('حدث خطأ');
                    }
                }).catch(() => { toastr.error('حدث خطأ'); resetBtn(); });
            }
        }

        function skipAll() {
            if (confirm('هل تريد تخطي الإعداد؟')) document.querySelector('#p5 form').submit();
        }

        // Instagram Features
        let igMaxId = '';
        let igCurrentUsername = '';
        let igLoadedPosts = [];
        let igSelectedPosts = new Set();

        function getGlobalCategoriesHtml() {
            let catSelect = document.getElementById('prodCategory');
            return catSelect.innerHTML;
        }

        function renderSelectedItems() {
            const container = document.getElementById('igSelectedItemsContainer');
            container.innerHTML = '';
            
            if (igSelectedPosts.size === 0) {
                document.getElementById('igImportWrap').style.display = 'none';
                return;
            }

            document.getElementById('igImportWrap').style.display = 'block';
            let categoriesHtml = getGlobalCategoriesHtml();

            igLoadedPosts.forEach(post => {
                if (igSelectedPosts.has(post.id)) {
                    let defaultName = 'منتج انستاجرام';
                    if (post.caption) {
                        defaultName = post.caption.split('\n')[0].trim().substring(0, 50);
                    }
                    if (defaultName.length < 2) defaultName = 'منتج انستاجرام';

                    const itemDiv = document.createElement('div');
                    itemDiv.className = 'ig-selected-item';
                    itemDiv.innerHTML = `
                        <img src="${post.mediaUrl}" class="ig-selected-img" alt="Selected">
                        <div class="ig-selected-fields">
                            <div class="set-row">
                                <label>اسم المنتج *</label>
                                <input type="text" id="ig_name_${post.id}" value="${defaultName}" placeholder="اسم المنتج">
                            </div>
                            <div class="set-row">
                                <label>السعر *</label>
                                <input type="number" id="ig_price_${post.id}" placeholder="0">
                            </div>
                            <div class="set-row">
                                <label>القسم *</label>
                                <select id="ig_cat_${post.id}">
                                    ${categoriesHtml}
                                </select>
                            </div>
                        </div>
                    `;
                    container.appendChild(itemDiv);
                }
            });
        }

        async function fetchInstagram(isLoadMore = false) {
            const usernameInput = document.getElementById('igUsername').value.trim();
            if (!usernameInput) {
                toastr.warning('الرجاء إدخال يوزر انستاجرام');
                return;
            }

            const fetchBtn = document.getElementById('igFetchBtn');
            const loadMoreBtn = document.getElementById('igLoadMoreBtn');
            const statusMessage = document.getElementById('igStatusMessage');
            const postsContainer = document.getElementById('igPostsContainer');
            const loadMoreWrap = document.getElementById('igLoadMoreWrap');
            const importWrap = document.getElementById('igImportWrap');

            if (!isLoadMore) {
                igCurrentUsername = usernameInput;
                igMaxId = '';
                igLoadedPosts = [];
                igSelectedPosts.clear();
                postsContainer.innerHTML = '';
                fetchBtn.disabled = true;
                fetchBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i>';
                importWrap.style.display = 'none';
            } else {
                loadMoreBtn.disabled = true;
                loadMoreBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i>';
            }
            
            statusMessage.innerHTML = '<div class="loading">جاري جلب البيانات من انستاجرام...</div>';

            let formData = new FormData();
            formData.append('username', igCurrentUsername);
            formData.append('maxId', igMaxId);
            formData.append('_token', '<?php echo e(csrf_token()); ?>');

            try {
                const response = await fetch("<?php echo e(URL::to('admin/instagram/fetch')); ?>", {
                    method: 'POST',
                    body: formData
                });
                
                const data = await response.json();
                
                statusMessage.innerHTML = '';

                if (data.status === 1 && data.data && data.data.result && data.data.result.edges) {
                    const posts = data.data.result.edges;

                    if (posts.length === 0 && !isLoadMore) {
                        statusMessage.innerHTML = '<div class="text-warning">لا توجد منشورات صالحة لهذا الحساب.</div>';
                        loadMoreWrap.style.display = 'none';
                        return;
                    }

                    posts.forEach(post => {
                        const node = post.node;
                        let mediaUrl = null;
                        const captionText = node.caption && node.caption.text ? node.caption.text : '';

                        if (node.is_video || node.media_type === 2 || node.product_type === 'clips') {
                            return;
                        }

                        if (node.carousel_media && node.carousel_media.length > 0) {
                            for (let i = 0; i < node.carousel_media.length; i++) {
                                const mediaItem = node.carousel_media[i];
                                if (!mediaItem.video_versions || mediaItem.video_versions.length === 0) {
                                    if (mediaItem.image_versions2 && mediaItem.image_versions2.candidates && mediaItem.image_versions2.candidates.length > 0) {
                                        mediaUrl = mediaItem.image_versions2.candidates[0].url;
                                        break;
                                    }
                                }
                            }
                        } else if (node.image_versions2 && node.image_versions2.candidates && node.image_versions2.candidates.length > 0) {
                            mediaUrl = node.image_versions2.candidates[0].url;
                        }

                        if (!mediaUrl) return;

                        const postId = node.id;
                        igLoadedPosts.push({
                            id: postId,
                            mediaUrl: mediaUrl,
                            caption: captionText
                        });

                        const postCard = document.createElement('div');
                        postCard.className = 'ig-post-card';
                        
                        if (igSelectedPosts.has(postId)) {
                            postCard.classList.add('picked');
                        }

                        postCard.onclick = function() {
                            this.classList.toggle('picked');
                            if (this.classList.contains('picked')) {
                                igSelectedPosts.add(postId);
                            } else {
                                igSelectedPosts.delete(postId);
                            }
                            renderSelectedItems();
                        };

                        postCard.innerHTML = `
                            <img src="${mediaUrl}" class="ig-post-img" alt="Post">
                            <div class="ig-post-body">
                                <div class="ig-post-caption">${captionText || 'بدون وصف'}</div>
                            </div>
                        `;
                        postsContainer.appendChild(postCard);
                    });

                    const pageInfo = data.data.result.page_info || data.data.page_info;
                    if (pageInfo && pageInfo.has_next_page) {
                        igMaxId = pageInfo.end_cursor;
                        loadMoreWrap.style.display = 'block';
                    } else {
                        igMaxId = '';
                        loadMoreWrap.style.display = 'none';
                    }

                } else {
                    throw new Error(data.msg || 'تنسيق البيانات غير صحيح أو الحساب غير موجود');
                }

            } catch (error) {
                console.error(error);
                statusMessage.innerHTML = `<div class="text-danger">حدث خطأ أثناء جلب البيانات. ${error.message || ''}</div>`;
            } finally {
                fetchBtn.disabled = false;
                fetchBtn.innerHTML = 'جلب <i class="fa-solid fa-search"></i>';
                loadMoreBtn.disabled = false;
                loadMoreBtn.innerHTML = 'عرض المزيد';
            }
        }

        function loadMoreInstagram() {
            fetchInstagram(true);
        }

        async function importSelectedInstagram() {
            if (igSelectedPosts.size === 0) {
                toastr.warning('الرجاء تحديد منشور واحد على الأقل');
                return;
            }

            let selectedPostsData = [];
            let validationError = false;

            igLoadedPosts.forEach(post => {
                if (igSelectedPosts.has(post.id)) {
                    let nameInput = document.getElementById('ig_name_' + post.id);
                    let priceInput = document.getElementById('ig_price_' + post.id);
                    let catInput = document.getElementById('ig_cat_' + post.id);

                    if (!nameInput || !priceInput || !catInput) return;

                    let name = nameInput.value.trim();
                    let price = priceInput.value.trim();
                    let catId = catInput.value;

                    if (!name || !price || !catId) {
                        validationError = true;
                    }
                    
                    selectedPostsData.push({
                        instagram_post_id: post.id,
                        item_name: name,
                        item_price: price || 0,
                        cat_id: catId,
                        username: igCurrentUsername,
                        media_url: post.mediaUrl,
                        caption: post.caption,
                        description: post.caption
                    });
                }
            });

            if (validationError) {
                toastr.warning('الرجاء تعبئة جميع الحقول المطلوبة (الاسم، السعر، القسم) لجميع المنتجات المحددة');
                return;
            }

            const importBtn = document.getElementById('igImportBtn');
            importBtn.disabled = true;
            importBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> جاري الاستيراد...';

            let formData = new FormData();
            selectedPostsData.forEach((post, index) => {
                Object.keys(post).forEach(key => {
                    formData.append(`selected_posts[${index}][${key}]`, post[key]);
                });
            });
            formData.append('_token', '<?php echo e(csrf_token()); ?>');

            try {
                const response = await fetch("<?php echo e(URL::to('admin/instagram/import')); ?>", {
                    method: 'POST',
                    body: formData
                });
                
                const data = await response.json();
                
                if (data.status === 1) {
                    let s = document.getElementById('igSaved');
                    s.style.display = 'inline-flex';
                    setTimeout(() => {
                        s.style.display = 'none';
                        goStep(4);
                    }, 1000);
                } else {
                    toastr.error(data.msg || 'حدث خطأ أثناء الاستيراد');
                }
            } catch (error) {
                toastr.error('حدث خطأ أثناء الاتصال بالخادم');
            } finally {
                importBtn.disabled = false;
                importBtn.innerHTML = 'استيراد المنتجات المحددة';
            }
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.auth_default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\Storemart_SaaS\resources\views/admin/onboarding/index.blade.php ENDPATH**/ ?>