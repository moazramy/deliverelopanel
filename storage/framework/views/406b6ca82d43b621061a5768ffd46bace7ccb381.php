<!DOCTYPE html>
<?php
    $site_direction = session()->get('site_direction');
    // if (env('APP_MODE') == 'demo') {
    //     $site_direction = session()->get('site_direction');
    // }else{
    //     $site_direction = \App\Models\BusinessSetting::where('key', 'site_direction')->first();
    //     $site_direction = $site_direction->value ?? 'ltr';
    // }

?>
<html dir="<?php echo e($site_direction); ?>" lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" class="<?php echo e($site_direction === 'rtl'?'active':''); ?>">
<head>
    <!-- Required Meta Tags Always Come First -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Title -->
    <title><?php echo e(translate('messages.admin')); ?> | <?php echo e(translate('messages.login')); ?></title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?php echo e(asset('public/favicon.ico')); ?>">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <!-- CSS Implementing Plugins -->
    <link rel="stylesheet" href="<?php echo e(asset('public/assets/admin')); ?>/css/vendor.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('public/assets/admin')); ?>/vendor/icon-set/style.css">
    <!-- CSS Front Template -->
    <link rel="stylesheet" href="<?php echo e(asset('public/assets/admin/css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('public/assets/admin/css/theme.minc619.css?v=1.0')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('public/assets/admin/css/style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('public/assets/admin')); ?>/css/toastr.css">
</head>

<body>
<!-- ========== MAIN CONTENT ========== -->
<main id="content" role="main" class="main">
    <div class="auth-wrapper">
        <div class="auth-wrapper-left">
            <div class="auth-left-cont">
                <?php ($store_logo = \App\Models\BusinessSetting::where(['key' => 'logo'])->first()->value); ?>
                <img onerror="this.src='<?php echo e(asset('/public/assets/admin/img/favicon.png')); ?>'" src="<?php echo e(asset('storage/app/public/business/' . $store_logo)); ?>" alt="public/img">
                <h2 class="title"><?php echo e(translate('Your')); ?> <span class="d-block"><?php echo e(translate('All Service')); ?></span> <strong class="text--039D55"><?php echo e(translate('in one field')); ?>....</strong></h2>
            </div>
        </div>
        <div class="auth-wrapper-right">
            <label class="badge badge-soft-success __login-badge">
                <?php echo e(translate('messages.software_version')); ?> : <?php echo e(env('SOFTWARE_VERSION')); ?>

            </label>
            <!-- Card -->
            <div class="auth-wrapper-form">
                <!-- Form -->
                <form class="" action="<?php echo e(route('admin.auth.login')); ?>" method="post" id="form-id">
                    <?php echo csrf_field(); ?>
                    <div class="auth-header">
                        <div class="mb-5">
                            <h2 class="title"><?php echo e(translate('messages.signin')); ?></h2>
                            <div><?php echo e(translate('messages.welcome_back')); ?></div>
                            <p class="mb-0"><?php echo e(translate('messages.want')); ?> <?php echo e(translate('messages.to')); ?> <?php echo e(translate('messages.login')); ?> <?php echo e(translate('messages.your')); ?> <?php echo e(translate('messages.stores')); ?>?
                                <a href="<?php echo e(route('vendor.auth.login')); ?>">
                                    <?php echo e(translate('messages.store')); ?> <?php echo e(translate('messages.login')); ?>

                                </a>
                            </p>
                            <span class="badge badge-soft-info">( <?php echo e(translate('messages.admin_or_employee_signin')); ?> )</span>
                        </div>
                    </div>

                    <!-- Form Group -->
                    <div class="js-form-message form-group">
                        <label class="input-label text-capitalize" for="signinSrEmail"><?php echo e(translate('messages.your')); ?> <?php echo e(translate('messages.email')); ?></label>

                        <input type="email" class="form-control form-control-lg" name="email" id="signinSrEmail"
                                tabindex="1" placeholder="email@address.com" aria-label="email@address.com"
                                required data-msg="Please enter a valid email address.">
                    </div>
                    <!-- End Form Group -->

                    <!-- Form Group -->
                    <div class="js-form-message form-group mb-2">
                        <label class="input-label" for="signupSrPassword" tabindex="0">
                            <span class="d-flex justify-content-between align-items-center">
                                <?php echo e(translate('messages.password')); ?>

                            </span>
                        </label>

                        <div class="input-group input-group-merge">
                            <input type="password" class="js-toggle-password form-control form-control-lg"
                                    name="password" id="signupSrPassword" placeholder="<?php echo e(translate('messages.password_length_placeholder',['length'=>'6+'])); ?>"
                                    aria-label="<?php echo e(translate('messages.password_length_placeholder',['length'=>'6+'])); ?>" required
                                    data-msg="<?php echo e(translate('messages.invalid_password_warning')); ?>"
                                    data-hs-toggle-password-options='{
                                                "target": "#changePassTarget",
                                    "defaultClass": "tio-hidden-outlined",
                                    "showClass": "tio-visible-outlined",
                                    "classChangeTarget": "#changePassIcon"
                                    }'>
                            <div id="changePassTarget" class="input-group-append">
                                <a class="input-group-text" href="javascript:">
                                    <i id="changePassIcon" class="tio-visible-outlined"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- End Form Group -->

                    <!-- Checkbox -->
                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="termsCheckbox"
                                    name="remember">
                            <label class="custom-control-label text-muted" for="termsCheckbox">
                                <?php echo e(translate('messages.remember_me')); ?>

                            </label>
                        </div>
                    </div>
                    <!-- End Checkbox -->

                    
                    <?php ($recaptcha = \App\CentralLogics\Helpers::get_business_settings('recaptcha')); ?>
                    <?php if(isset($recaptcha) && $recaptcha['status'] == 1): ?>
                        <div id="recaptcha_element" class="w-100" data-type="image"></div>
                        <br/>
                    <?php else: ?>
                        <div class="row p-2">
                            <div class="col-6 pr-0">
                                <input type="text" class="form-control form-control-lg border-0" name="custome_recaptcha"
                                        id="custome_recaptcha" required placeholder="<?php echo e(\translate('Enter recaptcha value')); ?>" autocomplete="off" value="<?php echo e(env('APP_MODE')=='dev'? session('six_captcha'):''); ?>">
                            </div>
                            <div class="col-6 bg-white rounded">
                                <img src="<?php echo $custome_recaptcha->inline(); ?>" class="rounded w-100" />
                            </div>
                        </div>
                    <?php endif; ?>

                    <button type="submit" class="btn btn-lg btn-block btn--primary mt-xxl-3"><?php echo e(translate('messages.login')); ?></button>
                </form>
                <!-- End Form -->
                <?php if(env('APP_MODE') == 'demo'): ?>
                <div class="auto-fill-data-copy">
                    <div class="d-flex flex-wrap align-items-center justify-content-between">
                        <div>
                            <span class="d-block"><strong>Email</strong> : admin@admin.com</span>
                            <span class="d-block"><strong>Password</strong> : 12345678</span>
                        </div>
                        <div>
                            <button class="btn action-btn btn--primary m-0" onclick="copy_cred()"><i class="tio-copy"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
            <!-- End Card -->
                
        </div>
    </div>
</main>
<!-- ========== END MAIN CONTENT ========== -->


<!-- JS Implementing Plugins -->
<script src="<?php echo e(asset('public/assets/admin')); ?>/js/vendor.min.js"></script>

<!-- JS Front -->
<script src="<?php echo e(asset('public/assets/admin')); ?>/js/theme.min.js"></script>
<script src="<?php echo e(asset('public/assets/admin')); ?>/js/toastr.js"></script>
<?php echo Toastr::message(); ?>


<?php if($errors->any()): ?>
    <script>
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        toastr.error('<?php echo e($error); ?>', Error, {
            CloseButton: true,
            ProgressBar: true
        });
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </script>
<?php endif; ?>

<!-- JS Plugins Init. -->
<script>
    $(document).on('ready', function () {
        // INITIALIZATION OF SHOW PASSWORD
        // =======================================================
        $('.js-toggle-password').each(function () {
            new HSTogglePassword(this).init()
        });

        // INITIALIZATION OF FORM VALIDATION
        // =======================================================
        $('.js-validate').each(function () {
            $.HSCore.components.HSValidation.init($(this));
        });
    });
</script>


<?php if(isset($recaptcha) && $recaptcha['status'] == 1): ?>
    <script type="text/javascript">
        var onloadCallback = function () {
            grecaptcha.render('recaptcha_element', {
                'sitekey': '<?php echo e(\App\CentralLogics\Helpers::get_business_settings('recaptcha')['site_key']); ?>'
            });
        };
    </script>
    <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>
    <script>
        $("#form-id").on('submit',function(e) {
            var response = grecaptcha.getResponse();

            if (response.length === 0) {
                e.preventDefault();
                toastr.error("<?php echo e(translate('messages.Please check the recaptcha')); ?>");
            }
        });
    </script>
<?php endif; ?>




<?php if(env('APP_MODE')=='demo'): ?>
    <script>
        function copy_cred() {
            $('#signinSrEmail').val('admin@admin.com');
            $('#signupSrPassword').val('12345678');
            toastr.success('Copied successfully!', 'Success!', {
                CloseButton: true,
                ProgressBar: true
            });
        }
    </script>
<?php endif; ?>

<!-- IE Support -->
<script>
    if (/MSIE \d|Trident.*rv:/.test(navigator.userAgent)) document.write('<script src="<?php echo e(asset('public//assets/admin')); ?>/vendor/babel-polyfill/polyfill.min.js"><\/script>');
</script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\resources\views/admin-views/auth/login.blade.php ENDPATH**/ ?>