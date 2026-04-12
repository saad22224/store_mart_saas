<?php
    if (Auth::user()->type == 4) {
        $vendor_id = Auth::user()->vendor_id;
    } else {
        $vendor_id = Auth::user()->id;
    }
    $user = App\Models\User::where('id', $vendor_id)->first();
?>
<?php $__env->startSection('content'); ?>
    <h5 class="text-capitalize fw-600 text-dark fs-4">
        <?php echo e(trans('labels.basic_settings')); ?></h5>
    <div class="row settings mt-3">
        <div class="col-xl-3 mb-3">
            <div class="card-sticky-top border-0">
                <ul class="list-group list-options">
                    <a href="#theme_settings" data-tab="theme_settings"
                        class="list-group-item basicinfo p-3 list-item-secondary d-flex justify-content-between align-items-center active"
                        aria-current="true"><?php echo e(trans('labels.theme_settings')); ?>

                        <i class="fa-regular fa-angle-<?php echo e(session()->get('direction') == '2' ? 'left' : 'right'); ?>"></i>
                    </a>

                    <a href="#contact_settings" data-tab="contact_settings"
                        class="list-group-item basicinfo p-3 list-item-secondary d-flex justify-content-between align-items-center"
                        aria-current="true"><?php echo e(trans('labels.contact_settings')); ?>

                        <i class="fa-regular fa-angle-<?php echo e(session()->get('direction') == '2' ? 'left' : 'right'); ?>"></i>
                    </a>
                    <a href="#seo" data-tab="seo"
                        class="list-group-item basicinfo p-3 list-item-secondary d-flex justify-content-between align-items-center"
                        aria-current="true"><?php echo e(trans('labels.seo')); ?>

                        <i class="fa-regular fa-angle-<?php echo e(session()->get('direction') == '2' ? 'left' : 'right'); ?>"></i>
                    </a>
                    <?php if(Auth::user()->type == 1 || (Auth::user()->type == 4 && Auth::user()->vendor_id == 1)): ?>
                        <?php if(@helper::checkaddons('vendor_app')): ?>
                            <a href="#app_section" data-tab="app_section"
                                class="list-group-item basicinfo p-3 list-item-secondary d-flex justify-content-between align-items-center"
                                aria-current="true"><?php echo e(trans('labels.app_section')); ?>

                                <div class="d-flex align-items-center gap-1 justify-content-between">
                                    <?php if(env('Environment') == 'sendbox'): ?>
                                        <span class="badge badge bg-danger"><?php echo e(trans('labels.addon')); ?></span>
                                    <?php endif; ?>
                                    <i
                                        class="fa-regular fa-angle-<?php echo e(session()->get('direction') == '2' ? 'left' : 'right'); ?>"></i>
                                </div>
                            </a>
                        <?php endif; ?>
                        <a href="#fun_fact" data-tab="fun_fact"
                            class="list-group-item basicinfo p-3 list-item-secondary d-flex justify-content-between align-items-center"
                            aria-current="true"><?php echo e(trans('labels.fun_fact')); ?>

                            <i class="fa-regular fa-angle-<?php echo e(session()->get('direction') == '2' ? 'left' : 'right'); ?>"></i>
                        </a>
                    <?php endif; ?>
                    <?php if(Auth::user()->type == 2 || (Auth::user()->type == 4 && Auth::user()->vendor_id != 1)): ?>
                        <?php if(@helper::checkaddons('subscription')): ?>
                            <?php if(@helper::checkaddons('user_app')): ?>
                                <?php
                                    $checkplan = App\Models\Transaction::where('vendor_id', $vendor_id)
                                        ->orderByDesc('id')
                                        ->first();

                                    if (@$user->allow_without_subscription == 1) {
                                        $user_app = 1;
                                    } else {
                                        $user_app = @$checkplan->customer_app;
                                    }
                                ?>
                                <?php if($user_app == 1): ?>
                                    <a href="#app_section" data-tab="app_section"
                                        class="list-group-item basicinfo p-3 list-item-secondary d-flex justify-content-between align-items-center"
                                        aria-current="true"><?php echo e(trans('labels.app_section')); ?>

                                        <div class="d-flex align-items-center gap-1 justify-content-between">
                                            <?php if(env('Environment') == 'sendbox'): ?>
                                                <span class="badge badge bg-danger"><?php echo e(trans('labels.addon')); ?></span>
                                            <?php endif; ?>
                                            <i
                                                class="fa-regular fa-angle-<?php echo e(session()->get('direction') == '2' ? 'left' : 'right'); ?>"></i>
                                        </div>
                                    </a>
                                <?php endif; ?>
                            <?php endif; ?>
                        <?php else: ?>
                            <?php if(@helper::checkaddons('user_app')): ?>
                                <a href="#app_section" data-tab="app_section"
                                    class="list-group-item basicinfo p-3 list-item-secondary d-flex justify-content-between align-items-center"
                                    aria-current="true"><?php echo e(trans('labels.app_section')); ?>

                                    <div class="d-flex align-items-center gap-1 justify-content-between">
                                        <?php if(env('Environment') == 'sendbox'): ?>
                                            <span class="badge badge bg-danger"><?php echo e(trans('labels.addon')); ?></span>
                                        <?php endif; ?>
                                        <i
                                            class="fa-regular fa-angle-<?php echo e(session()->get('direction') == '2' ? 'left' : 'right'); ?>"></i>
                                    </div>
                                </a>
                            <?php endif; ?>
                        <?php endif; ?>
                        <a href="#footer_features" data-tab="footer_features"
                            class="list-group-item basicinfo p-3 list-item-secondary d-flex justify-content-between align-items-center"
                            aria-current="true"><?php echo e(trans('labels.footer_features')); ?>

                            <i
                                class="fa-regular fa-angle-<?php echo e(session()->get('direction') == '2' ? 'left' : 'right'); ?>"></i></a>

                        <?php if(@helper::checkaddons('subscription')): ?>
                            <?php if(@helper::checkaddons('pwa')): ?>
                                <?php
                                    $checkplan = App\Models\Transaction::where('vendor_id', $vendor_id)
                                        ->orderByDesc('id')
                                        ->first();

                                    if (@$user->allow_without_subscription == 1) {
                                        $pwa = 1;
                                    } else {
                                        $pwa = @$checkplan->pwa;
                                    }
                                ?>
                                <?php if($pwa == 1): ?>
                                    <a href="#pwa" data-tab="pwa"
                                        class="list-group-item basicinfo p-3 list-item-secondary d-flex justify-content-between align-items-center"
                                        aria-current="true"><?php echo e(trans('labels.pwa')); ?>

                                        <div class="d-flex align-items-center gap-1 justify-content-between">
                                            <?php if(env('Environment') == 'sendbox'): ?>
                                                <span class="badge badge bg-danger"><?php echo e(trans('labels.addon')); ?></span>
                                            <?php endif; ?>
                                            <i
                                                class="fa-regular fa-angle-<?php echo e(session()->get('direction') == '2' ? 'left' : 'right'); ?>"></i>
                                        </div>
                                    </a>
                                <?php endif; ?>
                            <?php endif; ?>
                        <?php else: ?>
                            <?php if(@helper::checkaddons('pwa')): ?>
                                <a href="#pwa" data-tab="pwa"
                                    class="list-group-item basicinfo p-3 list-item-secondary d-flex justify-content-between align-items-center"
                                    aria-current="true"><?php echo e(trans('labels.pwa')); ?>

                                    <div class="d-flex align-items-center gap-1 justify-content-between">
                                        <?php if(env('Environment') == 'sendbox'): ?>
                                            <span class="badge badge bg-danger"><?php echo e(trans('labels.addon')); ?></span>
                                        <?php endif; ?>
                                        <i
                                            class="fa-regular fa-angle-<?php echo e(session()->get('direction') == '2' ? 'left' : 'right'); ?>"></i>
                                    </div>
                                </a>
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php if(@helper::checkaddons('age_verification')): ?>
                            <a href="#age_verification" data-tab="age_verification"
                                class="list-group-item basicinfo p-3 list-item-secondary d-flex justify-content-between align-items-center"
                                aria-current="true"><?php echo e(trans('labels.age_verification')); ?>

                                <div class="d-flex align-items-center gap-1 justify-content-between">
                                    <?php if(env('Environment') == 'sendbox'): ?>
                                        <span class="badge badge bg-danger"><?php echo e(trans('labels.addon')); ?></span>
                                    <?php endif; ?>
                                    <i
                                        class="fa-regular fa-angle-<?php echo e(session()->get('direction') == '2' ? 'left' : 'right'); ?>"></i>
                                </div>
                            </a>
                        <?php endif; ?>
                        <?php if(@helper::checkaddons('vendor_tip')): ?>
                            <a href="#tips_settings" data-tab="tips_settings"
                                class="list-group-item basicinfo p-3 list-item-secondary d-flex justify-content-between align-items-center"
                                aria-current="true"><?php echo e(trans('labels.tips_settings')); ?>

                                <div class="d-flex align-items-center gap-1 justify-content-between">
                                    <?php if(env('Environment') == 'sendbox'): ?>
                                        <span class="badge badge bg-danger"><?php echo e(trans('labels.addon')); ?></span>
                                    <?php endif; ?>
                                    <i
                                        class="fa-regular fa-angle-<?php echo e(session()->get('direction') == '2' ? 'left' : 'right'); ?>"></i>
                                </div>
                            </a>
                        <?php endif; ?>
                    <?php endif; ?>
                    <a href="#social_links" data-tab="social_links"
                        class="list-group-item basicinfo p-3 list-item-secondary d-flex justify-content-between align-items-center"
                        aria-current="true"><?php echo e(trans('labels.social_links')); ?> <i
                            class="fa-regular fa-angle-<?php echo e(session()->get('direction') == '2' ? 'left' : 'right'); ?>"></i></a>
                    <a href="#other" data-tab="other"
                        class="list-group-item basicinfo p-3 list-item-secondary d-flex justify-content-between align-items-center"
                        aria-current="true"><?php echo e(trans('labels.other')); ?>

                        <i class="fa-regular fa-angle-<?php echo e(session()->get('direction') == '2' ? 'left' : 'right'); ?>"></i>
                    </a>
                </ul>
            </div>
        </div>
        <div class="col-xl-9">
            <div id="settingmenuContent">
                <div id="theme_settings">
                    <div class="row mb-5">
                        <div class="col-12">
                            <div class="card border-0 box-shadow">
                                <div class="card-header p-3 bg-secondary">
                                    <h5 class="text-capitalize fw-600 settings-color">
                                        <?php echo e(trans('labels.theme_settings')); ?>

                                    </h5>
                                </div>
                                <div class="card-body pb-0">
                                    <form action="<?php echo e(URL::to('admin/theme_settings/update')); ?>" method="POST"
                                        enctype="multipart/form-data">
                                        <?php echo csrf_field(); ?>
                                        <div class="row">
                                            <div class="form-group">
                                                <label class="form-label"><?php echo e(trans('labels.website_title')); ?><span
                                                        class="text-danger"> * </span></label>
                                                <input type="text" class="form-control" name="website_title"
                                                    value="<?php echo e(@$settingdata->website_title); ?>"
                                                    placeholder="<?php echo e(trans('labels.website_title')); ?>">
                                                <?php $__errorArgs = ['website_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <small class="text-danger"><?php echo e($message); ?></small>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                            <?php if(Auth::user()->type == 1 || (Auth::user()->type == 4 && Auth::user()->vendor_id == 1)): ?>
                                                <div class="form-group col-sm-6">
                                                    <label class="form-label"><?php echo e(trans('labels.primary_color')); ?></label>
                                                    <input type="color"
                                                        class="form-control form-control-color w-100 border-0"
                                                        name="landing_primary_color"
                                                        value="<?php echo e($landingdata->primary_color); ?>">
                                                </div>
                                                <div class="form-group col-sm-6">
                                                    <label
                                                        class="form-label"><?php echo e(trans('labels.secondary_color')); ?></label>
                                                    <input type="color"
                                                        class="form-control form-control-color w-100 border-0"
                                                        name="landing_secondary_color"
                                                        value="<?php echo e($landingdata->secondary_color); ?>">
                                                </div>
                                            <?php else: ?>
                                                <div class="form-group col-sm-6">
                                                    <label class="form-label"><?php echo e(trans('labels.primary_color')); ?></label>
                                                    <input type="color"
                                                        class="form-control form-control-color w-100 border-0"
                                                        name="landing_primary_color"
                                                        value="<?php echo e($settingdata->primary_color); ?>">
                                                </div>
                                                <div class="form-group col-sm-6">
                                                    <label
                                                        class="form-label"><?php echo e(trans('labels.secondary_color')); ?></label>
                                                    <input type="color"
                                                        class="form-control form-control-color w-100 border-0"
                                                        name="landing_secondary_color"
                                                        value="<?php echo e($settingdata->secondary_color); ?>">
                                                </div>
                                            <?php endif; ?>

                                            <div class="form-group">
                                                <label class="form-label"><?php echo e(trans('labels.copyright')); ?><span
                                                        class="text-danger"> * </span></label>
                                                <input type="text" class="form-control" name="copyright"
                                                    value="<?php echo e(@$settingdata->copyright); ?>"
                                                    placeholder="<?php echo e(trans('labels.copyright')); ?>">
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label class="form-label"><?php echo e(trans('labels.logo')); ?></label>
                                                <input type="file" class="form-control" name="logo">
                                                <img class="img-fluid rounded hw-70 mt-1 object-fit-contain"
                                                    src="<?php echo e(helper::image_path(@$settingdata->logo)); ?>" alt="">
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label class="form-label"><?php echo e(trans('labels.darklogo')); ?></label>
                                                <input type="file" class="form-control" name="darklogo">
                                                <img class="img-fluid rounded hw-70 mt-1 object-fit-contain"
                                                    src="<?php echo e(helper::image_path(@$settingdata->darklogo)); ?>" alt="">
                                            </div>
                                            
                                            <div class="form-group col-sm-6">
                                                <label class="form-label"><?php echo e(trans('labels.favicon')); ?></label>
                                                <input type="file" class="form-control" name="favicon">

                                                <img class="img-fluid rounded hw-70 mt-1 object-fit-contain"
                                                    src="<?php echo e(helper::image_path(@$settingdata->favicon)); ?>"
                                                    alt="">
                                            </div>
                                            <?php if(Auth::user()->type == 1 || (Auth::user()->type == 4 && Auth::user()->vendor_id == 1)): ?>
                                                <div class="form-group col-sm-6">
                                                    <label class="form-label"
                                                        for=""><?php echo e(trans('labels.landing_page')); ?>

                                                    </label>
                                                    <input id="landing-switch" type="checkbox" class="checkbox-switch"
                                                        name="landing" value="1"
                                                        <?php echo e($settingdata->landing_page == 1 ? 'checked' : ''); ?>>
                                                    <label for="landing-switch" class="switch">
                                                        <span
                                                            class="<?php echo e(session()->get('direction') == 2 ? 'switch__circle-rtl' : 'switch__circle'); ?>"><span
                                                                class="switch__circle-inner"></span></span>
                                                        <span
                                                            class="switch__left <?php echo e(session()->get('direction') == 2 ? 'pe-2' : 'ps-2'); ?>"><?php echo e(trans('labels.off')); ?></span>
                                                        <span
                                                            class="switch__right <?php echo e(session()->get('direction') == 2 ? 'ps-2' : 'pe-2'); ?>"><?php echo e(trans('labels.on')); ?></span>
                                                    </label>
                                                </div>
                                            <?php endif; ?>
                                            <?php if(Auth::user()->type == 2 || (Auth::user()->type == 4 && Auth::user()->vendor_id != 1)): ?>
                                                <?php
                                                    $checktheme = @helper::checkthemeaddons('theme_');
                                                    $themes = [];
                                                    if ($user->allow_without_subscription == 1) {
                                                        foreach ($checktheme as $ttlthemes) {
                                                            array_push(
                                                                $themes,
                                                                str_replace(
                                                                    'theme_',
                                                                    '',
                                                                    $ttlthemes->unique_identifier,
                                                                ),
                                                            );
                                                        }
                                                    } else {
                                                        if (@helper::checkaddons('subscription')) {
                                                            if (empty($theme)) {
                                                                $themes = [$settingdata->template];
                                                            } else {
                                                                $themes = explode('|', @$theme->themes_id);
                                                            }
                                                        } else {
                                                            foreach ($checktheme as $ttlthemes) {
                                                                array_push(
                                                                    $themes,
                                                                    str_replace(
                                                                        'theme_',
                                                                        '',
                                                                        $ttlthemes->unique_identifier,
                                                                    ),
                                                                );
                                                            }
                                                        }
                                                    }
                                                ?>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="form-label"><?php echo e(trans('labels.theme')); ?>

                                                            <span class="text-danger"> * </span> </label>
                                                        <?php if(env('Environment') == 'sendbox'): ?>
                                                            <span
                                                                class="badge badge bg-danger ms-2"><?php echo e(trans('labels.addon')); ?></span>
                                                        <?php endif; ?>
                                                        <ul
                                                            class="theme-selection g-3 row row-cols-xl-6 row-cols-lg-4 row-cols-md-4 row-cols-sm-3 row-cols-2">
                                                            <?php $__currentLoopData = $themes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <li class="col">
                                                                    <input type="radio" name="template"
                                                                        id="template<?php echo e($item); ?>"
                                                                        value="<?php echo e($item); ?>"
                                                                        <?php echo e(@$settingdata->template == $item ? 'checked' : ''); ?>>
                                                                    <label for="template<?php echo e($item); ?>"
                                                                        class="p-0">
                                                                        <img
                                                                            src="<?php echo e(helper::image_path('theme-' . $item . '.png')); ?>">
                                                                    </label>
                                                                </li>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </ul>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div
                                            class="form-group <?php echo e(session()->get('direction') == '2' ? 'text-start' : 'text-end'); ?>">
                                            <button
                                                class="btn btn-primary px-sm-4 <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_basic_settings', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : ''); ?>"
                                                <?php if(env('Environment') == 'sendbox'): ?> type="button" onclick="myFunction()" <?php else: ?> type="submit" <?php endif; ?>><?php echo e(trans('labels.save')); ?></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="contact_settings">
                    <div class="row mb-5">
                        <div class="col-12">
                            <div class="card border-0 box-shadow">
                                <div class="card-header p-3 bg-secondary">
                                    <h5 class="text-capitalize fw-600 settings-color">
                                        <?php echo e(trans('labels.contact_settings')); ?>

                                    </h5>
                                </div>
                                <div class="card-body pb-0">
                                    <form action="<?php echo e(URL::to('admin/contact_settings/update')); ?>" method="POST"
                                        enctype="multipart/form-data">
                                        <?php echo csrf_field(); ?>
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label class="form-label"><?php echo e(trans('labels.email')); ?><span
                                                        class="text-danger"> * </span></label>
                                                <input type="email" class="form-control" name="landing_email"
                                                    value="<?php echo e(@$settingdata->email); ?>"
                                                    placeholder="<?php echo e(trans('labels.email')); ?>" required>
                                                <?php $__errorArgs = ['landing_email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <small class="text-danger"><?php echo e($message); ?></small>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-label"><?php echo e(trans('labels.mobile')); ?><span
                                                        class="text-danger"> * </span></label>
                                                <input type="text" class="form-control mobile-number"
                                                    name="landing_mobile" value="<?php echo e(@$settingdata->contact); ?>"
                                                    placeholder="<?php echo e(trans('labels.mobile')); ?>" required>
                                                <?php $__errorArgs = ['contact_mobile'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <small class="text-danger"><?php echo e($message); ?></small>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label"><?php echo e(trans('labels.address')); ?><span
                                                        class="text-danger"> * </span></label>
                                                <textarea class="form-control" name="landing_address" rows="3" placeholder="<?php echo e(trans('labels.address')); ?>"><?php echo e(@$settingdata->address); ?></textarea>
                                                <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <small class="text-danger"><?php echo e($message); ?></small>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>
                                        <div
                                            class="form-group <?php echo e(session()->get('direction') == '2' ? 'text-start' : 'text-end'); ?>">
                                            <button
                                                class="btn btn-primary px-sm-4 <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_basic_settings', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : ''); ?>"
                                                <?php if(env('Environment') == 'sendbox'): ?> type="button" onclick="myFunction()" <?php else: ?> type="submit" <?php endif; ?>><?php echo e(trans('labels.save')); ?></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="seo">
                    <div class="row mb-5">
                        <div class="col-12">
                            <div class="card border-0 box-shadow">
                                <div class="card-header p-3 bg-secondary">
                                    <h5 class="text-capitalize fw-600 settings-color">
                                        <?php echo e(trans('labels.seo')); ?>

                                    </h5>
                                </div>
                                <div class="card-body pb-0">
                                    <form action="<?php echo e(URL::to('admin/seo/update')); ?>" method="POST"
                                        enctype="multipart/form-data">
                                        <?php echo csrf_field(); ?>
                                        <div class="row">
                                            <div class="form-group">
                                                <label class="form-label"><?php echo e(trans('labels.meta_title')); ?><span
                                                        class="text-danger"> * </span></label>
                                                <input type="text" class="form-control" name="meta_title"
                                                    value="<?php echo e(@$settingdata->meta_title); ?>"
                                                    placeholder="<?php echo e(trans('labels.meta_title')); ?>" required>
                                                <?php $__errorArgs = ['meta_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <span class="text-danger"><?php echo e($message); ?></span>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label"><?php echo e(trans('labels.meta_description')); ?><span
                                                        class="text-danger"> * </span></label>
                                                <textarea class="form-control" name="meta_description" rows="3"
                                                    placeholder="<?php echo e(trans('labels.meta_description')); ?>" required><?php echo e(@$settingdata->meta_description); ?></textarea>
                                                <?php $__errorArgs = ['meta_description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <span class="text-danger"><?php echo e($message); ?></span>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label"><?php echo e(trans('labels.og_image')); ?> </label>
                                                <input type="file" class="form-control" name="og_image">

                                                <img class="img-fluid rounded hw-70 mt-1 object-fit-cover"
                                                    src="<?php echo e(helper::image_Path(@$settingdata->og_image)); ?>"
                                                    alt="">
                                            </div>
                                            <div
                                                class="form-group <?php echo e(session()->get('direction') == '2' ? 'text-start' : 'text-end'); ?>">
                                                <button
                                                    class="btn btn-primary px-sm-4  <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_basic_settings', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : ''); ?>"
                                                    <?php if(env('Environment') == 'sendbox'): ?> type="button" onclick="myFunction()" <?php else: ?> type="submit" <?php endif; ?>><?php echo e(trans('labels.save')); ?></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if(Auth::user()->type == 1 || (Auth::user()->type == 4 && Auth::user()->vendor_id == 1)): ?>
                    <?php if(@helper::checkaddons('vendor_app')): ?>
                        <?php echo $__env->make('admin.mobile_app.app_section', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endif; ?>
                    <div id="fun_fact">
                        <div class="row mb-5">
                            <div class="col-12">
                                <div class="col-12">
                                    <div class="card border-0 box-shadow">
                                        <div class="card-header p-3 bg-secondary">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <h5 class="text-capitalize fw-600 settings-color">
                                                    <?php echo e(trans('labels.fun_fact')); ?> <span class=""
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="Ex. <i class='fa-solid fa-truck-fast'></i> Visit https://fontawesome.com/ for more info">
                                                        <i class="fa-solid fa-circle-info"></i> </span></h5>
                                                <button class="btn btn-primary hov" type="button"
                                                    tooltip="<?php echo e(trans('labels.add')); ?>"
                                                    onclick="add_funfact('<?php echo e(trans('labels.icon')); ?>','<?php echo e(trans('labels.title')); ?>','<?php echo e(trans('labels.sub_title')); ?>')">
                                                    <i class="fa-sharp fa-solid fa-plus"></i> </button>
                                            </div>
                                        </div>
                                        <div class="card-body pb-0">
                                            <form action="<?php echo e(URL::to('admin/fun_fact/update')); ?>" method="POST"
                                                enctype="multipart/form-data">
                                                <?php echo csrf_field(); ?>
                                                <div class="row">
                                                    <?php $__currentLoopData = $funfacts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $facts): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <input type="hidden" name="edit_icon_key[]"
                                                            value="<?php echo e($facts->id); ?>">
                                                        <div class="col-md-4 form-group">
                                                            <div class="input-group">
                                                                <input type="text"
                                                                    class="form-control feature_required  <?php echo e(session()->get('direction') == 2 ? 'input-group-rtl' : ''); ?>"
                                                                    onkeyup="show_funfact_icon(this)"
                                                                    name="edi_funfact_icon[<?php echo e($facts->id); ?>]"
                                                                    placeholder="<?php echo e(trans('labels.icon')); ?>"
                                                                    value="<?php echo e($facts->icon); ?>" required>
                                                                <p
                                                                    class="input-group-text <?php echo e(session()->get('direction') == 2 ? 'input-group-icon-rtl' : ''); ?>">
                                                                    <?php echo $facts->icon; ?>

                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 form-group">
                                                            <input type="text" class="form-control"
                                                                name="edi_funfact_title[<?php echo e($facts->id); ?>]"
                                                                placeholder="<?php echo e(trans('labels.title')); ?>"
                                                                value="<?php echo e($facts->title); ?>" required>
                                                        </div>
                                                        <div class="col-md-4 form-group d-flex gap-2 gap-sm-4">
                                                            <input type="text" class="form-control"
                                                                name="edi_funfact_subtitle[<?php echo e($facts->id); ?>]"
                                                                placeholder="<?php echo e(trans('labels.sub_title')); ?>"
                                                                value="<?php echo e($facts->description); ?>" required>
                                                            <div class="col-auto form-group m-0">
                                                                <button class="btn btn-danger" type="button"
                                                                    tooltip="<?php echo e(trans('labels.delete')); ?>"
                                                                    <?php if(env('Environment') == 'sendbox'): ?> onclick="myFunction()" <?php else: ?>
                                                                    onclick="statusupdate('<?php echo e(URL::to('admin/fun_fact/delete-' . $facts->id)); ?>')" <?php endif; ?>>
                                                                    <i class="fa fa-trash"></i> </button>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <span class="extra_footer_features"></span>
                                                    <div
                                                        class="form-group <?php echo e(session()->get('direction') == '2' ? 'text-start' : 'text-end'); ?>">
                                                        <button
                                                            class="btn btn-primary px-sm-4 <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_basic_settings', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : ''); ?>"
                                                            <?php if(env('Environment') == 'sendbox'): ?> type="button" onclick="myFunction()" <?php else: ?> type="submit" <?php endif; ?>><?php echo e(trans('labels.save')); ?></button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if(Auth::user()->type == 2 || (Auth::user()->type == 4 && Auth::user()->vendor_id != 1)): ?>
                    <?php if(@helper::checkaddons('subscription')): ?>
                        <?php if(@helper::checkaddons('user_app')): ?>
                            <?php
                                $checkplan = App\Models\Transaction::where('vendor_id', $vendor_id)
                                    ->orderByDesc('id')
                                    ->first();

                                if (@$user->allow_without_subscription == 1) {
                                    $user_app = 1;
                                } else {
                                    $user_app = @$checkplan->customer_app;
                                }
                            ?>
                            <?php if($user_app == 1): ?>
                                <?php echo $__env->make('admin.mobile_app.app_section', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php else: ?>
                        <?php if(@helper::checkaddons('user_app')): ?>
                            <?php echo $__env->make('admin.mobile_app.app_section', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endif; ?>
                    <?php endif; ?>
                    <div id="footer_features">
                        <div class="row mb-5">
                            <div class="col-12">
                                <div class="col-12">
                                    <div class="card border-0 box-shadow">
                                        <div class="card-header p-3 bg-secondary">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <h5 class="text-capitalize fw-600 settings-color">
                                                    <?php echo e(trans('labels.footer_features')); ?><span class=""
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="Ex. <i class='fa-solid fa-truck-fast'></i> Visit https://fontawesome.com/ for more info">
                                                        <i class="fa-solid fa-circle-info"></i> </span></h5>
                                                <button class="btn btn-primary hov" type="button"
                                                    tooltip="<?php echo e(trans('labels.add')); ?>"
                                                    onclick="add_features('<?php echo e(trans('labels.icon')); ?>','<?php echo e(trans('labels.title')); ?>','<?php echo e(trans('labels.description')); ?>')">
                                                    <i class="fa-sharp fa-solid fa-plus"></i> </button>
                                            </div>
                                        </div>
                                        <div class="card-body  pb-0">
                                            <form action="<?php echo e(URL::to('admin/footer_features/update')); ?>" method="POST"
                                                enctype="multipart/form-data">
                                                <?php echo csrf_field(); ?>
                                                <div class="row">
                                                    <?php $__currentLoopData = $getfooterfeatures; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $features): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <input type="hidden" name="edit_icon_key[]"
                                                            value="<?php echo e($features->id); ?>">
                                                        <div class="col-md-4 form-group">
                                                            <div class="input-group">
                                                                <input type="text"
                                                                    class="form-control feature_required  <?php echo e(session()->get('direction') == 2 ? 'input-group-rtl' : ''); ?>"
                                                                    onkeyup="show_feature_icon(this)"
                                                                    name="edi_feature_icon[<?php echo e($features->id); ?>]"
                                                                    placeholder="<?php echo e(trans('labels.icon')); ?>"
                                                                    value="<?php echo e($features->icon); ?>" required>
                                                                <p
                                                                    class="input-group-text <?php echo e(session()->get('direction') == 2 ? 'input-group-icon-rtl' : ''); ?>">
                                                                    <?php echo $features->icon; ?>

                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 form-group">
                                                            <input type="text" class="form-control"
                                                                name="edi_feature_title[<?php echo e($features->id); ?>]"
                                                                placeholder="<?php echo e(trans('labels.title')); ?>"
                                                                value="<?php echo e($features->title); ?>" required>
                                                        </div>
                                                        <div class="col-md-4 gap-2 gap-sm-4 d-flex form-group">
                                                            <input type="text" class="form-control"
                                                                name="edi_feature_description[<?php echo e($features->id); ?>]"
                                                                placeholder="<?php echo e(trans('labels.description')); ?>"
                                                                value="<?php echo e($features->description); ?>" required>
                                                            <button class="btn btn-danger" type="button"
                                                                tooltip="<?php echo e(trans('labels.delete')); ?>"
                                                                onclick="statusupdate('<?php echo e(URL::to('admin/settings/delete-feature-' . $features->id)); ?>')">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </div>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <span class="extra_footer_features"></span>
                                                    <div
                                                        class="form-group <?php echo e(session()->get('direction') == '2' ? 'text-start' : 'text-end'); ?>">
                                                        <button
                                                            class="btn btn-primary px-sm-4 <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_basic_settings', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : ''); ?>"
                                                            <?php if(env('Environment') == 'sendbox'): ?> type="button" onclick="myFunction()" <?php else: ?> type="submit" <?php endif; ?>><?php echo e(trans('labels.save')); ?></button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php if(@helper::checkaddons('subscription')): ?>
                        <?php if(@helper::checkaddons('pwa')): ?>
                            <?php
                                $checkplan = App\Models\Transaction::where('vendor_id', $vendor_id)
                                    ->orderByDesc('id')
                                    ->first();

                                if (@$user->allow_without_subscription == 1) {
                                    $pwa = 1;
                                } else {
                                    $pwa = @$checkplan->pwa;
                                }
                            ?>
                            <?php if($pwa == 1): ?>
                                <?php echo $__env->make('admin.pwa.pwa_settings', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php else: ?>
                        <?php if(@helper::checkaddons('pwa')): ?>
                            <?php echo $__env->make('admin.pwa.pwa_settings', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endif; ?>
                    <?php endif; ?>

                    <?php if(@helper::checkaddons('age_verification')): ?>
                        <?php echo $__env->make('admin.age_verification.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endif; ?>

                    <?php if(@helper::checkaddons('vendor_tip')): ?>
                        <?php echo $__env->make('admin.tips_settings.tips_settings', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endif; ?>
                <?php endif; ?>
                <div id="social_links">
                    <div class="row mb-5">
                        <div class="col-12">
                            <div class="col-12">
                                <div class="card border-0 box-shadow">
                                    <div class="card-header p-3 bg-secondary">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <h5 class="text-capitalize fw-600 settings-color">
                                                <?php echo e(trans('labels.social_links')); ?> <span class=""
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="Ex. <i class='fa-solid fa-truck-fast'></i> Visit https://fontawesome.com/ for more info">
                                                    <i class="fa-solid fa-circle-info"></i> </span></h5>
                                            <button class="btn btn-primary hov" type="button"
                                                tooltip="<?php echo e(trans('labels.add')); ?>"
                                                onclick="add_social_links('<?php echo e(trans('labels.icon')); ?>','<?php echo e(trans('labels.link')); ?>')">
                                                <i class="fa-sharp fa-solid fa-plus"></i> </button>
                                        </div>
                                    </div>
                                    <div class="card-body  pb-0">
                                        <form action="<?php echo e(URL::to('admin/social_links/update')); ?>" method="POST"
                                            enctype="multipart/form-data">
                                            <?php echo csrf_field(); ?>
                                            <div class="row">

                                                <?php $__currentLoopData = $getsociallinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $links): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <input type="hidden" name="edit_icon_key[]"
                                                        value="<?php echo e($links->id); ?>">
                                                    <div class="col-md-6 form-group">
                                                        <div class="input-group">
                                                            <select class="form-select soaciallink_required <?php echo e(session()->get('direction') == 2 ? 'input-group-rtl' : ''); ?>" name="edi_sociallink_icon[<?php echo e($links->id); ?>]" required>
                                                                <option value='<i class="fa-brands fa-facebook"></i>' <?php echo e($links->icon == '<i class="fa-brands fa-facebook"></i>' ? 'selected' : ''); ?>>Facebook</option>
                                                                <option value='<i class="fa-brands fa-instagram"></i>' <?php echo e($links->icon == '<i class="fa-brands fa-instagram"></i>' ? 'selected' : ''); ?>>Instagram</option>
                                                                <option value='<i class="fa-brands fa-twitter"></i>' <?php echo e($links->icon == '<i class="fa-brands fa-twitter"></i>' ? 'selected' : ''); ?>>Twitter</option>
                                                                <option value='<i class="fa-brands fa-youtube"></i>' <?php echo e($links->icon == '<i class="fa-brands fa-youtube"></i>' ? 'selected' : ''); ?>>YouTube</option>
                                                                <option value='<i class="fa-brands fa-tiktok"></i>' <?php echo e($links->icon == '<i class="fa-brands fa-tiktok"></i>' ? 'selected' : ''); ?>>TikTok</option>
                                                                <option value='<i class="fa-brands fa-whatsapp"></i>' <?php echo e($links->icon == '<i class="fa-brands fa-whatsapp"></i>' ? 'selected' : ''); ?>>WhatsApp</option>
                                                                <option value='<i class="fa-brands fa-snapchat"></i>' <?php echo e($links->icon == '<i class="fa-brands fa-snapchat"></i>' ? 'selected' : ''); ?>>Snapchat</option>
                                                                <option value='<i class="fa-brands fa-linkedin"></i>' <?php echo e($links->icon == '<i class="fa-brands fa-linkedin"></i>' ? 'selected' : ''); ?>>LinkedIn</option>
                                                            </select>
                                                            <p
                                                                class="input-group-text <?php echo e(session()->get('direction') == 2 ? 'input-group-icon-rtl' : ''); ?>" style="width: 45px; justify-content: center;">
                                                                <?php echo $links->icon; ?>

                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="col-md-6 gap-2 gap-sm-4 d-flex align-items-center form-group">
                                                        <input type="text" class="form-control"
                                                            name="edi_sociallink_link[<?php echo e($links->id); ?>]"
                                                            placeholder="<?php echo e(trans('labels.link')); ?>"
                                                            value="<?php echo e($links->link); ?>" required>
                                                        <button class="btn btn-danger" type="button"
                                                            tooltip="<?php echo e(trans('labels.delete')); ?>"
                                                            <?php if(env('Environment') == 'sendbox'): ?> onclick="myFunction()" <?php else: ?>
                                                            onclick="statusupdate('<?php echo e(URL::to('admin/settings/delete-sociallinks-' . $links->id)); ?>')" <?php endif; ?>>
                                                            <i class="fa fa-trash"></i> </button>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                <span class="extra_social_links"></span>
                                                <div
                                                    class="form-group <?php echo e(session()->get('direction') == '2' ? 'text-start' : 'text-end'); ?>">
                                                    <button
                                                        class="btn btn-primary px-sm-4 <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_basic_settings', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : ''); ?>"
                                                        <?php if(env('Environment') == 'sendbox'): ?> type="button" onclick="myFunction()" <?php else: ?> type="submit" <?php endif; ?>><?php echo e(trans('labels.save')); ?></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="other">
                    <div class="row mb-5">
                        <div class="col-12">
                            <div class="col-12">
                                <div class="card border-0 box-shadow">
                                    <div class="card-header p-3 bg-secondary">
                                        <h5 class="text-capitalize fw-600 settings-color"><?php echo e(trans('labels.other')); ?>

                                        </h5>
                                    </div>
                                    <div class="card-body pb-0">
                                        <form action="<?php echo e(URL::to('admin/other/update')); ?>" method="POST"
                                            enctype="multipart/form-data">
                                            <?php echo csrf_field(); ?>
                                            <div class="row">
                                                <?php if(Auth::user()->type == 2 || (Auth::user()->type == 4 && Auth::user()->vendor_id != 1)): ?>
                                                    <div class="form-group col-sm-4">
                                                        <label
                                                            class="form-label"><?php echo e(trans('labels.google_review_url')); ?></label>
                                                        <input type="text" class="form-control"
                                                            placeholder="<?php echo e(trans('labels.google_review_url')); ?>"
                                                            name="google_review_url"
                                                            value="<?php echo e($settingdata->google_review); ?>">
                                                    </div>
                                                    <div class="form-group col-sm-4">
                                                        <label
                                                            class="form-label"><?php echo e(trans('labels.product_section_display')); ?></label>
                                                        <select name="product_section_display" class="form-select">
                                                            <option value=""><?php echo e(trans('labels.select_section')); ?>

                                                            </option>
                                                            <option value="1"
                                                                <?php echo e($settingdata->product_section_display == 1 ? 'selected' : ''); ?>>
                                                                <?php echo e(trans('labels.selling_product')); ?></option>
                                                            <option value="2"
                                                                <?php echo e($settingdata->product_section_display == 2 ? 'selected' : ''); ?>>
                                                                <?php echo e(trans('labels.top_rated_product')); ?></option>
                                                            <option value="3"
                                                                <?php echo e($settingdata->product_section_display == 3 ? 'selected' : ''); ?>>
                                                                <?php echo e(trans('labels.both')); ?></option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-sm-4">
                                                        <label
                                                            class="form-label"><?php echo e(trans('labels.product_display_limit')); ?></label>
                                                        <input type="number" class="form-control"
                                                            placeholder="<?php echo e(trans('labels.product_display_limit')); ?>"
                                                            name="product_display_limit"
                                                            value="<?php echo e($settingdata->product_display_limit); ?>">
                                                    </div>
                                                    <?php if(@helper::checkaddons('product_reviews')): ?>
                                                        <div class="col-md-3 form-group">
                                                            <label class="form-label"
                                                                for=""><?php echo e(trans('labels.product_ratting_switch')); ?>

                                                            </label>
                                                            <div class="text-center">
                                                                <input id="product_ratting_switch" type="checkbox"
                                                                    class="checkbox-switch" name="product_ratting_switch"
                                                                    value="1"
                                                                    <?php echo e($settingdata->product_ratting_switch == 1 ? 'checked' : ''); ?>>
                                                                <label for="product_ratting_switch" class="switch">
                                                                    <span
                                                                        class="<?php echo e(session()->get('direction') == 2 ? 'switch__circle-rtl' : 'switch__circle'); ?>"><span
                                                                            class="switch__circle-inner"></span></span>
                                                                    <span
                                                                        class="switch__left <?php echo e(session()->get('direction') == 2 ? 'pe-2' : 'ps-2'); ?>"><?php echo e(trans('labels.off')); ?></span>
                                                                    <span
                                                                        class="switch__right <?php echo e(session()->get('direction') == 2 ? 'ps-2' : 'pe-2'); ?>"><?php echo e(trans('labels.on')); ?></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                    <div class="col-md-3 form-group">
                                                        <label class="form-label"
                                                            for=""><?php echo e(trans('labels.online_order')); ?>

                                                        </label>
                                                        <div class="text-center">
                                                            <input id="online_order_switch" type="checkbox"
                                                                class="checkbox-switch" name="online_order_switch"
                                                                value="1"
                                                                <?php echo e($settingdata->online_order == 1 ? 'checked' : ''); ?>>
                                                            <label for="online_order_switch" class="switch">
                                                                <span
                                                                    class="<?php echo e(session()->get('direction') == 2 ? 'switch__circle-rtl' : 'switch__circle'); ?>"><span
                                                                        class="switch__circle-inner"></span></span>
                                                                <span
                                                                    class="switch__left <?php echo e(session()->get('direction') == 2 ? 'pe-2' : 'ps-2'); ?>"><?php echo e(trans('labels.off')); ?></span>
                                                                <span
                                                                    class="switch__right <?php echo e(session()->get('direction') == 2 ? 'ps-2' : 'pe-2'); ?>"><?php echo e(trans('labels.on')); ?></span>
                                                            </label>
                                                        </div>

                                                    </div>
                                                    <div class="form-group col-sm-6">
                                                        <label
                                                            class="form-label"><?php echo e(trans('labels.landing_page_cover_image')); ?>

                                                        </label>
                                                        <input type="file" class="form-control"
                                                            name="landin_page_cover_image">

                                                        <img class="img-fluid rounded hw-70 mt-1 object-fit-cover"
                                                            src="<?php echo e(helper::image_path($settingdata->cover_image)); ?>"
                                                            alt="">
                                                    </div>
                                                    <div class="form-group col-sm-6">
                                                        <label
                                                            class="form-label"><?php echo e(trans('labels.subscribe_image')); ?></label>
                                                        <input type="file" class="form-control"
                                                            name="subscribe_image">


                                                        <img class="img-fluid rounded hw-70 mt-1 object-fit-cover"
                                                            src="<?php echo e(helper::image_path(@$settingdata->subscribe_image)); ?>"
                                                            alt="">
                                                    </div>
                                                    <div class="form-group col-sm-6">
                                                        <label
                                                            class="form-label"><?php echo e(trans('labels.order_detail_image')); ?></label>
                                                        <input type="file" class="form-control"
                                                            name="order_detail_image">

                                                        <img class="img-fluid rounded hw-70 mt-1 object-fit-cover"
                                                            src="<?php echo e(helper::image_path(@$settingdata->order_detail_image)); ?>"
                                                            alt="">
                                                    </div>
                                                    <div class="form-group col-sm-6">
                                                        <label
                                                            class="form-label"><?php echo e(trans('labels.order_success_image')); ?></label>
                                                        <input type="file" class="form-control"
                                                            name="order_success_image">

                                                        <img class="img-fluid rounded hw-70 mt-1 object-fit-cover"
                                                            src="<?php echo e(helper::image_path(@$settingdata->order_success_image)); ?>"
                                                            alt="">
                                                    </div>
                                                    <div class="form-group col-sm-6">
                                                        <label
                                                            class="form-label"><?php echo e(trans('labels.no_data_image')); ?></label>
                                                        <input type="file" class="form-control" name="no_data_image">

                                                        <img class="img-fluid rounded hw-70 mt-1 object-fit-cover"
                                                            src="<?php echo e(helper::image_path(@$settingdata->no_data_image)); ?>"
                                                            alt="">
                                                    </div>
                                                <?php endif; ?>
                                                <?php if(Auth::user()->type == 1 || (Auth::user()->type == 4 && Auth::user()->vendor_id == 1)): ?>
                                                    <div class="form-group col-sm-6">
                                                        <label
                                                            class="form-label"><?php echo e(trans('labels.landing_home_banner')); ?></label>
                                                        <input type="file" class="form-control"
                                                            name="landing_home_banner">
                                                        <img class="img-fluid rounded hw-70 mt-1 object-fit-cover"
                                                            src="<?php echo e(helper::image_path(@$landingdata->landing_home_banner)); ?>"
                                                            alt="">
                                                    </div>
                                                    <div class="form-group col-sm-6">
                                                        <label
                                                            class="form-label"><?php echo e(trans('labels.subscribe_image')); ?></label>
                                                        <input type="file" class="form-control"
                                                            name="subscribe_image">
                                                        <img class="img-fluid rounded hw-70 mt-1 object-fit-cover"
                                                            src="<?php echo e(helper::image_path(@$landingdata->subscribe_image)); ?>"
                                                            alt="">
                                                    </div>
                                                    <div class="form-group col-sm-6">
                                                        <label class="form-label"><?php echo e(trans('labels.faq_image')); ?></label>
                                                        <input type="file" class="form-control" name="faq_image">
                                                        <img class="img-fluid rounded hw-70 mt-1 object-fit-cover"
                                                            src="<?php echo e(helper::image_path(@$landingdata->faq_image)); ?>"
                                                            alt="">
                                                    </div>
                                                    <div class="form-group col-sm-6">
                                                        <label
                                                            class="form-label"><?php echo e(trans('labels.maintenance_image')); ?></label>
                                                        <input type="file" class="form-control"
                                                            name="maintenance_image">
                                                        <img class="img-fluid rounded hw-70 mt-1 object-fit-cover"
                                                            src="<?php echo e(helper::image_path(@$settingdata->maintenance_image)); ?>"
                                                            alt="">
                                                    </div>
                                                    <div class="form-group col-sm-6">
                                                        <label
                                                            class="form-label"><?php echo e(trans('labels.store_unavailable_image')); ?></label>
                                                        <input type="file" class="form-control"
                                                            name="store_unavailable_image">
                                                        <img class="img-fluid rounded hw-70 mt-1 object-fit-cover"
                                                            src="<?php echo e(helper::image_path(@$settingdata->store_unavailable_image)); ?>"
                                                            alt="">
                                                    </div>
                                                    <div class="form-group col-sm-6">
                                                        <label
                                                            class="form-label"><?php echo e(trans('labels.admin_auth_pages_bg_image')); ?></label>
                                                        <input type="file" class="form-control"
                                                            name="admin_auth_pages_bg_image">
                                                        <img class="img-fluid rounded hw-70 mt-1 object-fit-cover"
                                                            src="<?php echo e(helper::image_path(@$settingdata->admin_auth_pages_bg_image)); ?>"
                                                            alt="">
                                                    </div>
                                                <?php endif; ?>
                                                <div
                                                    class="form-group <?php echo e(session()->get('direction') == '2' ? 'text-start' : 'text-end'); ?>">
                                                    <button
                                                        class="btn btn-primary px-sm-4  <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_basic_settings', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : ''); ?>"
                                                        <?php if(env('Environment') == 'sendbox'): ?> type="button" onclick="myFunction()" <?php else: ?> type="submit" <?php endif; ?>><?php echo e(trans('labels.save')); ?></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(url('storage/app/public/admin-assets/js/user.js')); ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.12.1/ckeditor.js"></script>
    <script src="<?php echo e(url(env('ASSETPATHURL') . 'admin-assets/js/funfact.js')); ?>"></script>
    <script src="<?php echo e(url(env('ASSETPATHURL') . 'admin-assets/js/settings.js')); ?>?v=<?php echo e(time()); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\Storemart_SaaS\resources\views/admin/landing/index.blade.php ENDPATH**/ ?>