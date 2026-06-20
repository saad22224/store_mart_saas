@extends('admin.layout.default')
@php
    if (Auth::user()->type == 4) {
        $vendor_id = Auth::user()->vendor_id;
    } else {
        $vendor_id = Auth::user()->id;
    }
@endphp
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="text-capitalize fw-600 text-dark color-changer fs-4">{{ trans('labels.products') }}</h5>
        <div class="d-flex">
            <div class="d-flex align-items-center" style="gap: 10px;">
                <!-- Bulk Delete Button -->
                @if (@helper::checkaddons('bulk_delete'))
                    <button id="bulkDeleteBtn"
                        @if (env('Environment')=='sendbox' ) onclick="myFunction()" @else onclick="deleteSelected('{{ URL::to('admin/products/bulk_delete') }}')" @endif class="btn btn-danger hov btn-sm d-none d-flex" tooltip="{{ trans('labels.delete') }}">
                        <i class="fa-regular fa-trash"></i>
                    </button>
                @endif
                <a href="{{ URL::to('admin/products/add') }}"
                    class="btn btn-secondary px-sm-4 d-flex {{ Auth::user()->type == 4 ? (helper::check_access('role_products', Auth::user()->role_id, $vendor_id, 'add') == 1 ? '' : 'd-none') : '' }}">
                    <i class="fa-regular fa-plus mx-1"></i>{{ trans('labels.add') }}
                </a>
            </div>
            @if (@helper::checkaddons('product_import'))
                @if ($getproductslist->count() > 0)
                    <a href="{{ URL::to('/admin/exportproduct') }}"
                        class="btn btn-secondary px-sm-4 d-flex {{ Auth::user()->type == 4 ? (helper::check_access('role_products', Auth::user()->role_id, $vendor_id, 'add') == 1 ? '' : 'd-none') : '' }} mx-2">{{ trans('labels.export') }}</a>
                @endif
            @endif
            
            <button type="button" class="btn btn-secondary px-sm-4 d-flex mx-2 {{ Auth::user()->type == 4 ? (helper::check_access('role_products', Auth::user()->role_id, $vendor_id, 'add') == 1 ? '' : 'd-none') : '' }}" style="background: linear-gradient(135deg, #e1306c, #c13584); border: none; color: white;" data-bs-toggle="modal" data-bs-target="#instagramImportModal">
                <i class="fa-brands fa-instagram mx-1" style="margin-top: 2px;"></i> {{ trans('labels.import_from_instagram') }}
            </button>


        </div>

    </div>
    <div class="row">

        <div class="col-12">
            <div class="card border-0 my-3 box-shadow">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered py-3 zero-configuration w-100">
                            <thead>
                                <tr class="text-capitalize fw-500 fs-15">
                                    <td></td>
                                    @if (@helper::checkaddons('bulk_delete'))
                                        @if($getproductslist->count() > 0)
                                            <td> <input type="checkbox" id="selectAll" class="form-check-input checkbox-style"></td>
                                        @endif
                                    @endif
                                    <td>{{ trans('labels.srno') }}</td>
                                    <td>{{ trans('labels.image') }}</td>
                                    <td>{{ trans('labels.name') }}</td>
                                    <td>{{ trans('labels.price') }}</td>
                                    <td>{{ trans('labels.stock') }}</td>
                                    <td>{{ trans('labels.status') }}</td>
                                    <td>{{ trans('labels.created_date') }}</td>
                                    <td>{{ trans('labels.updated_date') }}</td>
                                    <td>{{ trans('labels.action') }}</td>
                                </tr>
                            </thead>
                            <tbody id="tabledetails" data-url="{{ url('admin/products/reorder_category') }}">
                                @php $i = 1; @endphp
                                @foreach ($getproductslist as $product)
                                    <tr class="fs-7 row1 align-middle" id="dataid{{ $product->id }}"
                                        data-id="{{ $product->id }}">
                                        <td><a tooltip="{{ trans('labels.move') }}"><i
                                                    class="fa-light fa-up-down-left-right mx-2"></i></a></td>
                                        @if (@helper::checkaddons('bulk_delete'))
                                            <td><input type="checkbox" class="row-checkbox form-check-input checkbox-style" value="{{ $product->id }}"></td>
                                        @endif
                                        <td>@php echo $i++; @endphp</td>
                                        <td><img src="{{ @helper::image_path($product['product_image']->image) }}"
                                                class="img-fluid rounded hw-50 object-fit-cover" alt=""> </td>

                                        <td>{{ $product->item_name }} <br>
                                            @if ($product->view_count > 0)
                                                <span class="badge bg-success"><i class="fa-solid fa-eye"></i>
                                                    {{ $product->view_count }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($product->has_variants == 1)
                                                <span class="badge bg-info">{{ trans('labels.in_variants') }}</span><br>
                                            @else
                                                {{ helper::currency_formate($product->item_price, $vendor_id) }}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($product->has_variants == 1)
                                                <span class="badge bg-info">{{ trans('labels.in_variants') }}</span><br>
                                                @if (helper::checklowqty($product->id, $product->vendor_id) == 1)
                                                    <span class="badge bg-warning">{{ trans('labels.low_qty') }}</span>
                                                @endif
                                            @else
                                                @if ($product->stock_management == 1)
                                                    @if (helper::checklowqty($product->id, $product->vendor_id) == 1)
                                                        <span
                                                            class="badge bg-success">{{ trans('labels.in_stock') }}</span><br>
                                                        <span class="badge bg-warning">{{ trans('labels.low_qty') }}</span>
                                                    @elseif(helper::checklowqty($product->id, $product->vendor_id) == 2)
                                                        <span
                                                            class="badge bg-danger">{{ trans('labels.out_of_stock') }}</span>
                                                    @elseif(helper::checklowqty($product->id, $product->vendor_id) == 3)
                                                        -
                                                    @else
                                                        <span
                                                            class="badge bg-success">{{ trans('labels.in_stock') }}</span>
                                                    @endif
                                                @else
                                                    -
                                                @endif
                                            @endif

                                        </td>
                                        <td>
                                            @if ($product->is_available == '1')
                                                <a tooltip="{{ trans('labels.active') }}"
                                                    @if (env('Environment') == 'sendbox') onclick="myFunction()" @else onclick="statusupdate('{{ URL::to('admin/products/status-' . $product->slug . '/2') }}')" @endif
                                                    class="btn btn-sm btn-outline-success {{ Auth::user()->type == 4 ? (helper::check_access('role_products', Auth::user()->role_id, $vendor_id, 'edit') == 1 ? '' : 'd-none') : '' }}"><i
                                                        class="fas fa-check"></i></a>
                                            @else
                                                <a tooltip="{{ trans('labels.inactive') }}"
                                                    @if (env('Environment') == 'sendbox') onclick="myFunction()" @else onclick="statusupdate('{{ URL::to('admin/products/status-' . $product->slug . '/1') }}')" @endif
                                                    class="btn btn-sm btn-outline-danger {{ Auth::user()->type == 4 ? (helper::check_access('role_products', Auth::user()->role_id, $vendor_id, 'edit') == 1 ? '' : 'd-none') : '' }}"><i
                                                        class="fas fa-close"></i></a>
                                            @endif
                                        </td>
                                        <td>{{ helper::date_format($product->created_at, $vendor_id) }}<br>
                                            {{ helper::time_format($product->created_at, $vendor_id) }}
                                        </td>
                                        <td>{{ helper::date_format($product->updated_at, $vendor_id) }}<br>
                                            {{ helper::time_format($product->updated_at, $vendor_id) }}
                                        </td>
                                        <td>
                                            <div class="d-flex gap-1 flex-wrap">
                                                <a tooltip="{{ trans('labels.edit') }}"
                                                    class="btn btn-info hov btn-sm {{ Auth::user()->type == 4 ? (helper::check_access('role_products', Auth::user()->role_id, $vendor_id, 'edit') == 1 ? '' : 'd-none') : '' }}"
                                                    href="{{ URL::to('admin/products/edit-' . $product->slug) }}">
                                                    <i class="fa-regular fa-pen-to-square"></i></a>
                                                <a tooltip="{{ trans('labels.delete') }}"
                                                    class="btn btn-danger hov btn-sm {{ Auth::user()->type == 4 ? (helper::check_access('role_products', Auth::user()->role_id, $vendor_id, 'delete') == 1 ? '' : 'd-none') : '' }}"
                                                    @if (env('Environment') == 'sendbox') onclick="myFunction()" @else onclick="statusupdate('{{ URL::to('admin/products/delete-' . $product->slug) }}')" @endif>
                                                    <i class="fa-regular fa-trash"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Instagram Import Modal -->
    <div class="modal fade" id="instagramImportModal" tabindex="-1" aria-labelledby="instagramImportModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content" style="background: #1e293b; color: #f1f5f9; border: 1px solid rgba(255,255,255,0.1); border-radius: 24px;">
                <div class="modal-header" style="border-bottom: 1px solid rgba(255,255,255,0.08);">
                    <h5 class="modal-title" id="instagramImportModalLabel">
                        <i class="fa-brands fa-instagram" style="color: #e1306c;"></i> جلب منتجات انستاجرام
                    </h5>
                    <button type="button" style="position: absolute; left:15px"
                    class="btn-close btn-close-white"
                     data-bs-dismiss="modal"
                      aria-label="Close"></button>
                </div>
                <div class="modal-body" style="padding: 2rem;">
                    <style>
                        .ig-post-card { border: 1px solid rgba(255, 255, 255, 0.08); border-radius: 12px; overflow: hidden; background: rgba(255, 255, 255, 0.02); cursor: pointer; transition: all 0.3s ease; position: relative; display: flex; flex-direction: column; }
                        .ig-post-card:hover { border-color: rgba(99, 102, 241, 0.5); transform: translateY(-3px); background: rgba(255, 255, 255, 0.04); }
                        .ig-post-card.picked { border-color: #6366f1; background: rgba(99, 102, 241, 0.1); box-shadow: 0 0 15px rgba(99, 102, 241, 0.3); }
                        .ig-post-card.picked::after { content: '\f00c'; font-family: "Font Awesome 6 Free", sans-serif; font-weight: 900; position: absolute; top: 10px; right: 10px; width: 24px; height: 24px; background: #6366f1; color: #fff; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 12px; z-index: 2; box-shadow: 0 2px 5px rgba(0,0,0,0.3); }
                        .ig-post-img { width: 100%; height: 140px; object-fit: cover; }
                        .ig-post-body { padding: 10px; flex: 1; }
                        .ig-post-caption { font-size: 0.75rem; color: #cbd5e1; line-height: 1.5; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; }
                        .ig-selected-list { display: flex; flex-direction: column; gap: 15px; margin-top: 10px; }
                        .ig-selected-item { display: flex; gap: 15px; background: rgba(255, 255, 255, 0.03); border: 1px solid rgba(255, 255, 255, 0.08); border-radius: 12px; padding: 15px; align-items: flex-start; }
                        .ig-selected-img { width: 80px; height: 80px; border-radius: 8px; object-fit: cover; flex-shrink: 0; border: 1px solid rgba(255,255,255,0.1); }
                        .ig-selected-fields { flex: 1; display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 10px; }
                        .ig-selected-fields .set-row { margin-bottom: 0; }
                        .ig-selected-fields label { display: block; color: #cbd5e1; font-size: .8rem; font-weight: 600; margin-bottom: .35rem }
                        .ig-selected-fields input, .ig-selected-fields select { width: 100%; padding: .65rem 1.2rem; border-radius: 12px; border: 1.5px solid rgba(255, 255, 255, .1); background: rgba(255, 255, 255, .04); color: #e2e8f0; font-size: .85rem; transition: all .3s }
                        .ig-selected-fields input:focus { border-color: #6366f1; outline: none; background: rgba(255, 255, 255, .07) }
                        .ig-selected-fields select option { background: #1e293b; color: #e2e8f0 }
                        .ig-cat-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(130px, 1fr)); gap: 1rem; margin-bottom: 2rem }
                        .ob-btn { padding: .7rem 2rem; border-radius: 14px; font-weight: 700; border: none; transition: all .3s; font-size: .9rem; cursor: pointer }
                        .ob-btn-go { background: linear-gradient(135deg, #6366f1, #8b5cf6); color: #fff }
                        .ob-btn-go:hover { transform: translateY(-2px); box-shadow: 0 8px 25px rgba(99, 102, 241, .35); color: #fff }
                        .ob-btn-bk { background: rgba(255, 255, 255, .06); color: #94a3b8; border: 1px solid rgba(255, 255, 255, .08) }
                        .ob-btn-bk:hover { background: rgba(255, 255, 255, .1); color: #e2e8f0 }
                        .ob-saved { display: inline-flex; align-items: center; gap: .3rem; padding: .25rem .7rem; border-radius: 8px; background: rgba(16, 185, 129, .15); color: #34d399; font-size: .75rem; font-weight: 600 }
                        @media (max-width: 768px) { .ig-selected-item { flex-direction: column; } .ig-selected-fields { grid-template-columns: 1fr; width: 100%; } }
                        .modal-content input#igUsername { width: 100%; padding: .65rem 1.2rem; border-radius: 12px; border: 1.5px solid rgba(255, 255, 255, .1); background: rgba(255, 255, 255, .04); color: #e2e8f0; font-size: .85rem; transition: all .3s; }
                        .modal-content input#igUsername:focus { border-color: #6366f1; outline: none; background: rgba(255, 255, 255, .07) }
                        .modal-content label { color: #cbd5e1; font-size: .8rem; font-weight: 600; margin-bottom: .35rem; display: block; }
                    </style>

                    <p style="color: #94a3b8; font-size: .82rem; margin-bottom: 1.5rem">اربط حساب انستاجرام الخاص بمتجرك لاستيراد منتجاتك مباشرة بضغطة زر.</p>

                    <div class="row" style="margin-bottom: 1.2rem;">
                        <div class="col-md-12">
                            <label>اسم المستخدم في انستاجرام (بدون @)</label>
                            <div class="d-flex gap-2">
                                <input type="text" id="igUsername" placeholder="مثال: matjarhub">
                                <button class="ob-btn ob-btn-go" onclick="fetchInstagram()" id="igFetchBtn" style="white-space: nowrap;">جلب <i class="fa-solid fa-search"></i></button>
                            </div>
                        </div>
                    </div>

                    <div id="igStatusMessage" style="color: #cbd5e1; font-size: 0.85rem; margin-bottom: 1rem;"></div>
                    
                    <div class="ig-cat-grid" id="igPostsContainer" style="gap: 1rem; max-height: 350px; overflow-y: auto; padding-right: 5px;">
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

                </div>
            </div>
        </div>
    </div>

    <select id="prodCategoryTemplate" style="display:none;">
        <option value="">اختر القسم</option>
        @foreach($getcategorylist as $cat)
            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
        @endforeach
    </select>
@endsection

@section('scripts')
<script>
    let igMaxId = '';
    let igCurrentUsername = '';
    let igLoadedPosts = [];
    let igSelectedPosts = new Set();

    function getGlobalCategoriesHtml() {
        let catSelect = document.getElementById('prodCategoryTemplate');
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
        formData.append('_token', '{{ csrf_token() }}');

        try {
            const response = await fetch("{{ URL::to('admin/instagram/fetch') }}", {
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
        formData.append('_token', '{{ csrf_token() }}');

        try {
            const response = await fetch("{{ URL::to('admin/instagram/import') }}", {
                method: 'POST',
                body: formData
            });
            
            const data = await response.json();
            
            if (data.status === 1) {
                let s = document.getElementById('igSaved');
                s.style.display = 'inline-flex';
                setTimeout(() => {
                    s.style.display = 'none';
                    // Reload the page to show imported products
                    window.location.reload();
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
@endsection
