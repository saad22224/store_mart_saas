<?php
    $platformHost = env('WEBSITE_HOST', request()->getHost());
    $serverIp = trim((string) (
        @$setting->server_ip
        ?: (@helper::appdata(1)->server_ip ?? null)
        ?: env('SERVER_IP')
        ?: ''
    ));
?>
<div class="card border-0 box-shadow mb-4">
    <div class="card-header bg-transparent border-bottom">
        <h6 class="mb-0 fw-600 color-changer"><?php echo e(trans('labels.custom_domain_guide_title')); ?></h6>
    </div>
    <div class="card-body color-changer fs-7">
        <div class="mb-3">
            <strong class="d-block mb-1"><?php echo e(trans('labels.custom_domain_what_is')); ?></strong>
            <p class="mb-0"><?php echo e(trans('labels.custom_domain_what_is_text', ['host' => $platformHost])); ?></p>
        </div>

        <div class="alert <?php echo e($serverIp !== '' ? 'alert-warning' : 'alert-danger'); ?> border mb-4">
            <strong class="d-block mb-2"><?php echo e(trans('labels.custom_domain_server_ip_box_title')); ?></strong>
            <?php if($serverIp !== ''): ?>
                <p class="mb-2"><?php echo e(trans('labels.custom_domain_server_ip_box_text')); ?></p>
                <div class="d-flex flex-wrap align-items-center gap-2 mb-2">
                    <code id="custom-domain-server-ip" class="fs-5 fw-bold px-3 py-2 bg-white border rounded text-dark"><?php echo e($serverIp); ?></code>
                    <button type="button" class="btn btn-sm btn-dark" id="copy-server-ip-btn"
                        data-copied="<?php echo e(trans('labels.custom_domain_copied')); ?>">
                        <?php echo e(trans('labels.custom_domain_copy_ip')); ?>

                    </button>
                </div>
                <p class="mb-0 small"><?php echo e(trans('labels.custom_domain_server_ip_www_text', ['host' => $platformHost])); ?></p>
            <?php else: ?>
                <p class="mb-0"><?php echo e(trans('labels.custom_domain_server_ip_missing')); ?></p>
            <?php endif; ?>
        </div>

        <strong class="d-block mb-2"><?php echo e(trans('labels.custom_domain_steps_title')); ?></strong>
        <ol class="ps-3 mb-3">
            <li class="mb-2">
                <strong><?php echo e(trans('labels.custom_domain_step_1_title')); ?></strong>
                <div><?php echo e(trans('labels.custom_domain_step_1_text')); ?></div>
            </li>
            <li class="mb-2">
                <strong><?php echo e(trans('labels.custom_domain_step_2_title')); ?></strong>
                <div><?php echo e(trans('labels.custom_domain_step_2_text')); ?></div>
            </li>
            <li class="mb-2">
                <strong><?php echo e(trans('labels.custom_domain_step_3_title')); ?></strong>
                <div><?php echo e(trans('labels.custom_domain_step_3_text')); ?></div>
            </li>
            <li class="mb-2">
                <strong><?php echo e(trans('labels.custom_domain_step_4_title')); ?></strong>
                <div><?php echo e(trans('labels.custom_domain_step_4_text')); ?></div>
            </li>
            <li class="mb-0">
                <strong><?php echo e(trans('labels.custom_domain_step_5_title')); ?></strong>
                <div><?php echo e(trans('labels.custom_domain_step_5_text')); ?></div>
            </li>
        </ol>

        <strong class="d-block mb-2"><?php echo e(trans('labels.custom_domain_notes_title')); ?></strong>
        <ul class="mb-0 ps-3">
            <li class="mb-1"><?php echo e(trans('labels.custom_domain_note_1')); ?></li>
            <li class="mb-1"><?php echo e(trans('labels.custom_domain_note_2')); ?></li>
            <li class="mb-1"><?php echo e(trans('labels.custom_domain_note_3')); ?></li>
            <li class="mb-0"><?php echo e(trans('labels.custom_domain_note_4', ['host' => $platformHost])); ?></li>
        </ul>
    </div>
</div>

<?php if($serverIp !== ''): ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var btn = document.getElementById('copy-server-ip-btn');
        var ipEl = document.getElementById('custom-domain-server-ip');
        if (!btn || !ipEl) return;
        btn.addEventListener('click', function() {
            var ip = ipEl.textContent.trim();
            var original = btn.textContent;
            var done = btn.getAttribute('data-copied') || 'Copied';
            if (navigator.clipboard && navigator.clipboard.writeText) {
                navigator.clipboard.writeText(ip).then(function() {
                    btn.textContent = done;
                    setTimeout(function() { btn.textContent = original; }, 1500);
                });
            } else {
                var temp = document.createElement('textarea');
                temp.value = ip;
                document.body.appendChild(temp);
                temp.select();
                document.execCommand('copy');
                document.body.removeChild(temp);
                btn.textContent = done;
                setTimeout(function() { btn.textContent = original; }, 1500);
            }
        });
    });
</script>
<?php endif; ?>
<?php /**PATH C:\laragon\www\matjarhub\resources\views/admin/customdomain/partials/guide.blade.php ENDPATH**/ ?>