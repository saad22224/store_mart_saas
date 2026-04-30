<?php if(helper::appdata($storeinfo->id)->cart_checkout_progressbar == 1): ?>
    <?php if(helper::appdata($storeinfo->id)->min_order_amount_for_free_shipping > 0): ?>
        <div class="py-3 my-3">
            <?php
                $percentage = round(
                    ($subtotal / helper::appdata($storeinfo->id)->min_order_amount_for_free_shipping) * 100,
                );
            ?>

            <div class="progress" role="progressbar" aria-label="Animated striped example" aria-valuenow="25"
                aria-valuemin="0" aria-valuemax="100">
                <div class="progress-bar progress-bar-striped progress-bar-animated"
                    style="width: <?php echo e($percentage); ?>%; background-color: <?php if($percentage <= 33): ?> var(--bs-danger) <?php elseif($percentage > 33 && $percentage <= 66): ?> var(--bs-warning) <?php else: ?> var(--bs-success) <?php endif; ?>">
                    <div class="w-100 d-flex justify-content-end">
                        <i
                            class="fa-solid fa-truck-fast col-auto fs-5 text-light <?php echo e(session()->get('direction') == 2 ? 'glyphicon' : ''); ?>"></i>
                    </div>
                </div>
            </div>

            <?php
                $updatedprice = helper::appdata($storeinfo->id)->min_order_amount_for_free_shipping - $subtotal;
                $pvar = ['{price}'];
                $pnewvar = [helper::currency_formate($updatedprice, @$storeinfo->id)];

                $progress_message = str_replace($pvar, $pnewvar, helper::appdata($storeinfo->id)->progress_message);
            ?>

            <?php if($updatedprice <= 0): ?>
                <p class="fs-7 mt-3 fw-bold text-success text-capitalize">
                    <?php echo e(helper::appdata($storeinfo->id)->progress_message_end); ?></p>
            <?php else: ?>
                <p class="fs-7 mt-3 fw-bold color-changer text-capitalize"><?php echo e($progress_message); ?></p>
            <?php endif; ?>
        </div>
    <?php endif; ?>
<?php endif; ?>
<?php /**PATH C:\laragon\www\Storemart_SaaS\resources\views/front/cart_checkout_progressbar.blade.php ENDPATH**/ ?>