@extends('admin.layout.auth_default')
@section('content')
<style>
    .ob-wrap{min-height:100vh;background:linear-gradient(135deg,#0f172a,#1e293b,#0f172a);display:flex;align-items:center;justify-content:center;padding:2rem;position:relative;overflow:hidden}
    .ob-wrap::before{content:'';position:absolute;width:500px;height:500px;background:radial-gradient(circle,rgba(99,102,241,.12),transparent 70%);top:-100px;right:-100px;border-radius:50%}
    .ob-wrap::after{content:'';position:absolute;width:400px;height:400px;background:radial-gradient(circle,rgba(168,85,247,.08),transparent 70%);bottom:-50px;left:-50px;border-radius:50%}
    .ob-box{width:100%;max-width:780px;position:relative;z-index:2}
    .ob-dots{display:flex;align-items:center;justify-content:center;gap:0;margin-bottom:2rem}
    .ob-dot{width:42px;height:42px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:1rem;background:rgba(255,255,255,.06);color:#64748b;border:2px solid rgba(255,255,255,.08);transition:all .4s}
    .ob-dot.on{background:linear-gradient(135deg,#6366f1,#8b5cf6);color:#fff;border-color:#6366f1;box-shadow:0 0 20px rgba(99,102,241,.4);transform:scale(1.1)}
    .ob-dot.ok{background:linear-gradient(135deg,#10b981,#059669);color:#fff;border-color:#10b981}
    .ob-line{width:50px;height:3px;background:rgba(255,255,255,.06);margin:0 .4rem;border-radius:2px;overflow:hidden;margin-bottom:20px}
    .ob-line .f{height:100%;width:0;background:linear-gradient(90deg,#10b981,#6366f1);transition:width .4s}
    .ob-line.filled .f{width:100%}
    .ob-lbl{color:#64748b;font-size:.65rem;text-align:center;margin-top:.3rem;font-weight:600}
    .ob-lbl.on{color:#e2e8f0}
    .ob-card{background:rgba(255,255,255,.03);backdrop-filter:blur(20px);border:1px solid rgba(255,255,255,.06);border-radius:24px;padding:2.5rem 2rem}
    .ob-p{display:none;animation:obIn .35s ease}.ob-p.on{display:block}
    @keyframes obIn{from{opacity:0;transform:translateY(15px)}to{opacity:1;transform:translateY(0)}}
    .ob-h{font-size:1.4rem;font-weight:800;color:#f1f5f9;margin-bottom:.3rem}
    .ob-sub{color:#94a3b8;font-size:.82rem;margin-bottom:1.5rem}
    .ob-ico{width:56px;height:56px;border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:1.5rem;margin-bottom:.75rem}
    .ob-ico-1{background:rgba(99,102,241,.15);color:#a78bfa}
    .ob-ico-2{background:rgba(236,72,153,.15);color:#f472b6}
    .ob-ico-3{background:rgba(245,158,11,.15);color:#fbbf24}

    /* Category chips */
    .cat-grid{display:flex;flex-wrap:wrap;gap:.6rem;margin-bottom:1.5rem}
    .cat-chip{padding:.6rem 1.2rem;border-radius:12px;background:rgba(255,255,255,.04);border:1.5px solid rgba(255,255,255,.08);color:#cbd5e1;font-size:.85rem;font-weight:600;cursor:pointer;transition:all .25s;user-select:none}
    .cat-chip:hover{border-color:rgba(99,102,241,.4);background:rgba(99,102,241,.08)}
    .cat-chip.picked{background:linear-gradient(135deg,rgba(99,102,241,.2),rgba(168,85,247,.15));border-color:#6366f1;color:#fff;box-shadow:0 0 12px rgba(99,102,241,.2)}
    .cat-chip.picked::before{content:'✓ ';font-weight:800}
    .cat-custom{display:flex;gap:.5rem;margin-bottom:1rem}
    .cat-custom input{flex:1;padding:.6rem 1.2rem;border-radius:12px;border:1.5px solid rgba(255,255,255,.1);background:rgba(255,255,255,.04);color:#e2e8f0;font-size:.85rem}
    .cat-custom input::placeholder{color:#64748b}
    .cat-custom button{padding:.6rem 1.2rem;border-radius:12px;background:rgba(99,102,241,.2);border:1.5px solid rgba(99,102,241,.3);color:#a78bfa;font-weight:700;font-size:.85rem;cursor:pointer;transition:all .2s}
    .cat-custom button:hover{background:rgba(99,102,241,.3)}

    /* Settings rows */
    .set-row{margin-bottom:1.2rem}
    .set-row label{display:block;color:#cbd5e1;font-size:.8rem;font-weight:600;margin-bottom:.35rem}
    .set-row input,.set-row select{width:100%;padding:.65rem 1.2rem;border-radius:12px;border:1.5px solid rgba(255,255,255,.1);background:rgba(255,255,255,.04);color:#e2e8f0;font-size:.85rem;transition:all .3s}
    .set-row input:focus{border-color:#6366f1;outline:none;background:rgba(255,255,255,.07)}
    .set-row select option{background:#1e293b;color:#e2e8f0}
    .set-row input[type=file]{padding:.5rem 1.2rem}

    .ob-btn{padding:.7rem 2rem;border-radius:14px;font-weight:700;border:none;transition:all .3s;font-size:.9rem;cursor:pointer}
    .ob-btn-go{background:linear-gradient(135deg,#6366f1,#8b5cf6);color:#fff}
    .ob-btn-go:hover{transform:translateY(-2px);box-shadow:0 8px 25px rgba(99,102,241,.35);color:#fff}
    .ob-btn-fin{background:linear-gradient(135deg,#10b981,#059669);color:#fff;padding:.8rem 3rem;font-size:1.1rem;border-radius:16px;box-shadow:0 10px 30px rgba(16,185,129,.3)}
    .ob-btn-fin:hover{transform:translateY(-3px);box-shadow:0 15px 40px rgba(16,185,129,.4);color:#fff}
    .ob-btn-bk{background:rgba(255,255,255,.06);color:#94a3b8;border:1px solid rgba(255,255,255,.08)}
    .ob-btn-bk:hover{background:rgba(255,255,255,.1);color:#e2e8f0}
    .ob-skip{color:#64748b;font-size:.82rem;text-decoration:none;cursor:pointer}
    .ob-skip:hover{color:#e2e8f0}
    .ob-saved{display:inline-flex;align-items:center;gap:.3rem;padding:.25rem .7rem;border-radius:8px;background:rgba(16,185,129,.15);color:#34d399;font-size:.75rem;font-weight:600}
    @media(max-width:640px){.ob-card{padding:1.5rem}.ob-h{font-size:1.1rem}.ob-line{width:20px}.cat-grid{gap:.4rem}.cat-chip{padding:.45rem .8rem;font-size:.78rem}}
</style>

<div class="ob-wrap">
<div class="ob-box">
    <div class="ob-dots">
        @for($s=1;$s<=4;$s++)
        <div class="text-center">
            <div class="ob-dot {{ $s==1?'on':'' }}" id="d{{$s}}">{{$s}}</div>
            <div class="ob-lbl {{ $s==1?'on':'' }}" id="l{{$s}}">
                @if($s==1) الأقسام @elseif($s==2) منتج @elseif($s==3) إعدادات @else انطلق @endif
            </div>
        </div>
        @if($s<4)<div class="ob-line" id="ln{{$s}}"><div class="f"></div></div>@endif
        @endfor
    </div>

    <div class="ob-card">
        {{-- STEP 1: Categories --}}
        <div class="ob-p on" id="p1">
            <div class="ob-ico ob-ico-1"><i class="fa-solid fa-layer-group"></i></div>
            <h3 class="ob-h">اختر أقسام متجرك</h3>
            <p class="ob-sub">اختر الأقسام اللي تناسب متجرك، أو أضف أقسام مخصصة. اضغط على القسم لاختياره.</p>

            <div class="cat-grid" id="catGrid">
                @php
                $defaultCats = ['ملابس رجالية','ملابس نسائية','أحذية','حقائب','إكسسوارات','إلكترونيات','هواتف','أجهزة منزلية','عطور','مستحضرات تجميل','ألعاب أطفال','أدوات مكتبية','رياضة','طعام ومشروبات','كتب'];
                @endphp
                @foreach($defaultCats as $c)
                <div class="cat-chip" onclick="toggleCat(this)" data-name="{{$c}}">{{$c}}</div>
                @endforeach
            </div>

            <div class="cat-custom">
                <input type="text" id="customCat" placeholder="أضف قسم مخصص..." onkeypress="if(event.key==='Enter'){event.preventDefault();addCustom()}">
                <button type="button" onclick="addCustom()"><i class="fa-solid fa-plus me-1"></i>أضف</button>
            </div>

            <span id="catSaved" class="ob-saved" style="display:none"><i class="fa-solid fa-check"></i> تم الحفظ</span>

            <div class="d-flex justify-content-between align-items-center mt-3">
                <a class="ob-skip" onclick="skipAll()">تخطي الإعداد</a>
                <button class="ob-btn ob-btn-go" onclick="saveAndNext(1)">حفظ والتالي <i class="fa-solid fa-arrow-left ms-1"></i></button>
            </div>
        </div>

        {{-- STEP 2: Add Product --}}
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

            <span id="prodSaved" class="ob-saved" style="display:none"><i class="fa-solid fa-check"></i> تم الحفظ</span>

            <div class="d-flex justify-content-between align-items-center mt-3">
                <button class="ob-btn ob-btn-bk" onclick="goStep(1)"><i class="fa-solid fa-arrow-right me-1"></i>السابق</button>
                <div class="d-flex gap-3 align-items-center">
                    <a class="ob-skip" onclick="goStep(3)">تخطي</a>
                    <button class="ob-btn ob-btn-go" onclick="saveAndNext(2)">حفظ والتالي <i class="fa-solid fa-arrow-left ms-1"></i></button>
                </div>
            </div>
        </div>

        {{-- STEP 3: Store Settings --}}
        <div class="ob-p" id="p3">
            <div class="ob-ico ob-ico-3"><i class="fa-solid fa-gear"></i></div>
            <h3 class="ob-h">إعدادات الاتصال</h3>
            <p class="ob-sub">أضف تفاصيل التواصل الخاصة بمتجرك عشان العملاء يوصلولك بسهولة.</p>

            <div class="row">
                <div class="col-md-6 set-row">
                    <label>البريد الإلكتروني *</label>
                    <input type="email" id="setEmail" value="{{ @$settings->email }}" placeholder="store@example.com">
                </div>
                <div class="col-md-6 set-row">
                    <label>رقم الهاتف *</label>
                    <input type="text" id="setMobile" value="{{ @$settings->mobile }}" placeholder="0123456789">
                </div>
                <div class="col-md-6 set-row">
                    <label>رقم الواتساب</label>
                    <input type="text" id="setWhatsapp" value="{{ @Auth::user()->whatsapp }}" placeholder="0123456789">
                </div>
                <div class="col-md-6 set-row">
                    <label>العنوان *</label>
                    <input type="text" id="setAddress" value="{{ @$settings->address }}" placeholder="المدينة، الشارع">
                </div>
                <div class="col-md-12 set-row">
                    <label>شعار المتجر (Logo)</label>
                    <input type="file" id="setLogo" accept="image/*">
                </div>
            </div>

            <span id="setSaved" class="ob-saved" style="display:none"><i class="fa-solid fa-check"></i> تم الحفظ</span>

            <div class="d-flex justify-content-between align-items-center mt-3">
                <button class="ob-btn ob-btn-bk" onclick="goStep(2)"><i class="fa-solid fa-arrow-right me-1"></i>السابق</button>
                <button class="ob-btn ob-btn-go" onclick="saveAndNext(3)">حفظ والتالي <i class="fa-solid fa-arrow-left ms-1"></i></button>
            </div>
        </div>

        {{-- STEP 4: Ready --}}
        <div class="ob-p" id="p4">
            <div style="text-align:center;padding:1.5rem 0">
                <div style="width:100px;height:100px;border-radius:50%;background:linear-gradient(135deg,#10b981,#059669);display:inline-flex;align-items:center;justify-content:center;font-size:2.5rem;color:#fff;margin-bottom:1.5rem;box-shadow:0 0 40px rgba(16,185,129,.4)">
                    <i class="fa-solid fa-rocket"></i>
                </div>
                <h3 class="ob-h" style="text-align:center;font-size:1.8rem">متجرك جاهز للعمل! 🎉</h3>
                <p class="ob-sub" style="text-align:center;max-width:450px;margin:0 auto 2rem;font-size:.9rem">
                    لقد قمت بإعداد الأقسام، المنتجات، وتفاصيل الاتصال. أنت الآن جاهز لاستقبال العملاء. 
                    ستجد جولة تعريفية سريعة في لوحة التحكم.
                </p>
                <div class="d-flex justify-content-center gap-3">
                    <button class="ob-btn ob-btn-bk" onclick="goStep(3)" style="padding:.8rem 1.5rem"><i class="fa-solid fa-arrow-right me-1"></i>رجوع</button>
                    <form action="{{ URL::to('admin/onboarding/complete') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="ob-btn ob-btn-fin">ابدأ وإدارة متجرك <i class="fa-solid fa-arrow-left ms-2"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection

@section('scripts')
<script>
let step = 1;
const total = 4;

function goStep(s) {
    step = s;
    for(let i=1;i<=total;i++){
        document.getElementById('p'+i).classList.remove('on');
        let dot=document.getElementById('d'+i), lbl=document.getElementById('l'+i);
        dot.classList.remove('on','ok'); lbl.classList.remove('on');
        if(i<step){dot.classList.add('ok');dot.innerHTML='<i class="fa-solid fa-check"></i>';}
        else if(i==step){dot.classList.add('on');lbl.classList.add('on');dot.textContent=i;}
        else{dot.textContent=i;}
    }
    document.getElementById('p'+step).classList.add('on');
    for(let i=1;i<total;i++){
        let ln=document.getElementById('ln'+i);
        if(i<step) ln.classList.add('filled'); else ln.classList.remove('filled');
    }
}

function toggleCat(el){el.classList.toggle('picked');}

function addCustom(){
    let inp=document.getElementById('customCat');
    let v=inp.value.trim();
    if(!v)return;
    let chip=document.createElement('div');
    chip.className='cat-chip picked';
    chip.setAttribute('data-name',v);
    chip.textContent=v;
    chip.setAttribute('onclick','toggleCat(this)');
    document.getElementById('catGrid').appendChild(chip);
    inp.value='';
}

function saveAndNext(currentStep){
    if(currentStep==1){
        let picked=document.querySelectorAll('#catGrid .cat-chip.picked');
        let cats=[];
        picked.forEach(c=>cats.push(c.dataset.name));
        if(cats.length==0){toastr.warning('اختر قسم واحد على الأقل');return;}
        fetch("{{ URL::to('admin/onboarding/save-categories') }}",{
            method:'POST',
            headers:{'Content-Type':'application/json','X-CSRF-TOKEN':'{{ csrf_token() }}'},
            body:JSON.stringify({categories:cats})
        }).then(r=>r.json()).then(d=>{
            if(d.status==1){
                let select = document.getElementById('prodCategory');
                select.innerHTML = '<option value="">اختر القسم</option>';
                if(d.categories && d.categories.length > 0){
                    d.categories.forEach(cat => {
                        select.innerHTML += '<option value="'+cat.id+'">'+cat.name+'</option>';
                    });
                }
                let s=document.getElementById('catSaved');s.style.display='inline-flex';
                setTimeout(()=>{s.style.display='none';goStep(2);},600);
            }
        }).catch(()=>toastr.error('حدث خطأ'));
    } else if(currentStep==2){
        let name = document.getElementById('prodName').value;
        let price = document.getElementById('prodPrice').value;
        let cat = document.getElementById('prodCategory').value;
        let img = document.getElementById('prodImage').files[0];

        if(!name || !price){ toastr.warning('يرجى إدخال اسم وسعر المنتج'); return; }
        
        let formData = new FormData();
        formData.append('item_name', name);
        formData.append('item_price', price);
        if(cat) formData.append('cat_id', cat);
        if(img) formData.append('product_image', img);
        formData.append('_token', '{{ csrf_token() }}');

        fetch("{{ URL::to('admin/onboarding/save-product') }}",{
            method:'POST',
            body:formData
        }).then(r=>r.json()).then(d=>{
            if(d.status==1){
                let s=document.getElementById('prodSaved');s.style.display='inline-flex';
                setTimeout(()=>{s.style.display='none';goStep(3);},600);
            }
        }).catch(()=>toastr.error('حدث خطأ'));
    } else if(currentStep==3){
        let email = document.getElementById('setEmail').value;
        let mobile = document.getElementById('setMobile').value;
        let address = document.getElementById('setAddress').value;
        let whatsapp = document.getElementById('setWhatsapp').value;
        let logo = document.getElementById('setLogo').files[0];
        
        if(!email || !mobile || !address) { toastr.warning('يرجى ملء الحقول المطلوبة'); return; }

        let formData = new FormData();
        formData.append('email', email);
        formData.append('mobile', mobile);
        formData.append('address', address);
        formData.append('whatsapp', whatsapp);
        if(logo) formData.append('logo', logo);
        formData.append('_token', '{{ csrf_token() }}');

        fetch("{{ URL::to('admin/onboarding/save-settings') }}",{
            method:'POST',
            body:formData
        }).then(r=>r.json()).then(d=>{
            if(d.status==1){
                let s=document.getElementById('setSaved');s.style.display='inline-flex';
                setTimeout(()=>{s.style.display='none';goStep(4);},600);
            }
        }).catch(()=>toastr.error('حدث خطأ'));
    }
}

function skipAll(){
    if(confirm('هل تريد تخطي الإعداد؟')) document.querySelector('#p4 form').submit();
}
</script>
@endsection
