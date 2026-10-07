<table class="table">
    <thead>
        <tr class="text-capitalize fw-500 fs-15">
            <td><?php echo e(trans('labels.requested_domain')); ?></td>
            <td><?php echo e(trans('labels.current_domain')); ?></td>
            <td><?php echo e(trans('labels.status')); ?></td>
        </tr>
    </thead>
    <tbody>
        <tr class="border">
            <td><?php echo e(empty(@$domain->requested_domain) ? '-' : @$domain->requested_domain); ?></td>
            <td><?php echo e(empty(@$domain->current_domain) ? '-' : @$domain->current_domain); ?></td>
            <td class="<?php echo e(@$domain->status == 1 ? 'text-warning' : 'text-success'); ?>">
                <?php if(@$domain->status == 1): ?>
                    <?php echo e(trans('labels.pending')); ?>

                <?php elseif(@$domain->status == 2): ?>
                    <?php echo e(trans('labels.connected')); ?>

                <?php else: ?>
                    -
                <?php endif; ?>
            </td>
        </tr>
    </tbody>
</table>
<?php /**PATH C:\laragon\www\matjarhub\resources\views/admin/customdomain/customdomain_table.blade.php ENDPATH**/ ?>