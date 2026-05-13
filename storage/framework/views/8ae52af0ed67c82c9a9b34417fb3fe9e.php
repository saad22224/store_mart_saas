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
                <?php for($s = 1; $s <= 4; $s++): ?>
                    <div class="text-center">
                        <div class="ob-dot <?php echo e($s == 1 ? 'on' : ''); ?>" id="d<?php echo e($s); ?>"><?php echo e($s); ?></div>
                        <div class="ob-lbl <?php echo e($s == 1 ? 'on' : ''); ?>" id="l<?php echo e($s); ?>">
                            <?php if($s == 1): ?>
                                الأقسام
                            <?php elseif($s == 2): ?>
                                منتج
                            <?php elseif($s == 3): ?>
                                إعدادات
                            <?php else: ?>
                                انطلق
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php if($s < 4): ?>
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
                            $defaultCats = [
                                ['name' => 'ملابس رجالية', 'img' => 'https://img.icons8.com/color/144/t-shirt.png'],

                                // تم التعديل
                                [
                                    'name' => 'ملابس نسائية',
                                    'img' => 'https://img.icons8.com/color/144/womens-shirt.png',
                                ],

                                // // تم التعديل
                                // ['name' => 'أحذية', 'img' => 'https://img.icons8.com/color/144/running-shoe.png'],

                                // تم التعديل
                                // [
                                //     'name' => 'حقائب اكسسوارات',
                                //     'img' => 'https://img.icons8.com/color/144/womans-handbag.png',
                                // ],

                                ['name' => 'ساعات', 'img' => 'https://img.icons8.com/color/144/clock.png'],
                                ['name' => 'مجوهرات', 'img' => 'https://img.icons8.com/color/144/diamond.png'],
                                ['name' => 'إلكترونيات', 'img' => 'https://img.icons8.com/color/144/electronics.png'],
                                ['name' => 'هواتف', 'img' => 'https://img.icons8.com/color/144/smartphone.png'],
                                ['name' => 'لابتوب', 'img' => 'https://img.icons8.com/color/144/laptop.png'],
                                ['name' => 'عطور', 'img' => 'https://img.icons8.com/color/144/perfume-bottle.png'],

                                // تم التعديل
                                ['name' => 'مستحضرات تجميل', 'img' => 'https://img.icons8.com/color/144/lipstick.png'],

                                [
                                    'name' => 'طعام ومشروبات',
                                    'img' => 'https://img.icons8.com/color/144/food-and-wine.png',
                                ],

                                ['name' => 'أدوات منزلية', 'img' => 'https://img.icons8.com/color/144/home.png'],
                                ['name' => 'أثاث', 'img' => 'https://img.icons8.com/color/144/sofa.png'],
                                ['name' => 'ألعاب أطفال', 'img' => 'https://img.icons8.com/color/144/teddy-bear.png'],
                                ['name' => 'نظارات', 'img' => 'https://img.icons8.com/color/144/glasses.png'],

                                // تم التعديل
                                [
                                    'name' => 'مستلزمات حيوانات',
                                    'img' => 'https://img.icons8.com/color/144/dog.png',
                                ],

                                ['name' => 'رياضة', 'img' => 'https://img.icons8.com/color/144/basketball.png'],
                                ['name' => 'كتب', 'img' => 'https://img.icons8.com/color/144/book.png'],
                                ['name' => 'سيارات', 'img' => 'https://img.icons8.com/color/144/car.png'],
                            ];
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
                    <div class="ob-ico ob-ico-3"><i class="fa-solid fa-gear"></i></div>
                    <h3 class="ob-h">إعدادات الاتصال</h3>
                    <p class="ob-sub">أضف تفاصيل التواصل الخاصة بمتجرك عشان العملاء يوصلولك بسهولة.</p>

                    <div class="row">
                        <div class="col-md-6 set-row">
                            <label>البريد الإلكتروني *</label>
                            <input type="email" id="setEmail" value="<?php echo e(@$settings->email ?? ''); ?>"
                                placeholder="store@example.com">
                        </div>
                        <div class="col-md-6 set-row">
                            <label>رقم الهاتف *</label>
                            <div style="display: flex; gap: 0.5rem;">
                                <select id="setMobileCode" style="width: 100px; flex-shrink: 0;" dir="ltr">
                                    <option value="+963" selected>+963 🇸🇾</option>
                                    <option value="+966">+966 🇸🇦</option>
                                    <option value="+971">+971 🇦🇪</option>
                                    <option value="+965">+965 🇰🇼</option>
                                    <option value="+974">+974 🇶🇦</option>
                                    <option value="+973">+973 🇧🇭</option>
                                    <option value="+968">+968 🇴🇲</option>
                                    <option value="+20">+20 🇪🇬</option>
                                    <option value="+962">+962 🇯🇴</option>
                                    <option value="+961">+961 🇱🇧</option>
                                    <option value="+212">+212 🇲🇦</option>
                                    <option value="+213">+213 🇩🇿</option>
                                    <option value="+216">+216 🇹🇳</option>
                                    <option value="+970">+970 🇵🇸</option>
                                    <option value="+964">+964 🇮🇶</option>
                                    <option value="+249">+249 🇸🇩</option>
                                </select>
                                <input type="text" id="setMobile" value="<?php echo e(@$settings->mobile ?? ''); ?>"
                                    placeholder="0123456789" style="flex: 1;" dir="ltr">
                            </div>
                        </div>
                        <div class="col-md-6 set-row">
                            <label>رقم الواتساب</label>
                            <div style="display: flex; gap: 0.5rem;">
                                <select id="setWhatsappCode" style="width: 100px; flex-shrink: 0;" dir="ltr">
                                    <option value="+963" selected>+963 🇸🇾</option>
                                    <option value="+966">+966 🇸🇦</option>
                                    <option value="+971">+971 🇦🇪</option>
                                    <option value="+965">+965 🇰🇼</option>
                                    <option value="+974">+974 🇶🇦</option>
                                    <option value="+973">+973 🇧🇭</option>
                                    <option value="+968">+968 🇴🇲</option>
                                    <option value="+20">+20 🇪🇬</option>
                                    <option value="+962">+962 🇯🇴</option>
                                    <option value="+961">+961 🇱🇧</option>
                                    <option value="+212">+212 🇲🇦</option>
                                    <option value="+213">+213 🇩🇿</option>
                                    <option value="+216">+216 🇹🇳</option>
                                    <option value="+970">+970 🇵🇸</option>
                                    <option value="+964">+964 🇮🇶</option>
                                    <option value="+249">+249 🇸🇩</option>
                                </select>
                                <input type="text" id="setWhatsapp" value="<?php echo e(@Auth::user()->whatsapp ?? ''); ?>"
                                    placeholder="0123456789" style="flex: 1;" dir="ltr">
                            </div>
                        </div>
                        <div class="col-md-6 set-row">
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
                        <button class="ob-btn ob-btn-bk" onclick="goStep(2)"><i
                                class="fa-solid fa-arrow-right me-1"></i>السابق</button>
                        <button class="ob-btn ob-btn-go" onclick="saveAndNext(3)">حفظ والتالي <i
                                class="fa-solid fa-arrow-left ms-1"></i></button>
                    </div>
                </div>

                
                <div class="ob-p" id="p4">
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
                            <button class="ob-btn ob-btn-bk" onclick="goStep(3)" style="padding:.8rem 1.5rem"><i
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
        const total = 4;

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
            } else if (currentStep == 3) {
                let email = document.getElementById('setEmail').value;
                let mobileVal = document.getElementById('setMobile').value.trim();
                let whatsappVal = document.getElementById('setWhatsapp').value.trim();
                let mobile = mobileVal ? (document.getElementById('setMobileCode').value + mobileVal) : '';
                let whatsapp = whatsappVal ? (document.getElementById('setWhatsappCode').value + whatsappVal) : '';
                let address = document.getElementById('setAddress').value;
                let currency = document.getElementById('setCurrency').value;
                let logo = document.getElementById('setLogo').files[0];

                if (!email || !mobile || !address) {
                    toastr.warning('يرجى ملء الحقول المطلوبة');
                    return;
                }

                setBtnLoading();
                let formData = new FormData();
                formData.append('email', email);
                formData.append('mobile', mobile);
                formData.append('address', address);
                formData.append('whatsapp', whatsapp);
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
                            goStep(4);
                        }, 600);
                    } else {
                        toastr.error('حدث خطأ');
                    }
                }).catch(() => { toastr.error('حدث خطأ'); resetBtn(); });
            }
        }

        function skipAll() {
            if (confirm('هل تريد تخطي الإعداد؟')) document.querySelector('#p4 form').submit();
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.auth_default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\Storemart_SaaS\resources\views/admin/onboarding/index.blade.php ENDPATH**/ ?>