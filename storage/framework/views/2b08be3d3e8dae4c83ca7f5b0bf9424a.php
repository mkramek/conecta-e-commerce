<div name="wireui.select.option">
    <span name="wireui.select.option.data">
        <?php echo e(WireUi::toJs($toArray())); ?>

    </span>

    <!--[if BLOCK]><![endif]--><?php if(app()->runningUnitTests()): ?>
        <div dusk="select.option">
            <?php echo json_encode($toArray()); ?>

        </div>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

    <!--[if BLOCK]><![endif]--><?php if($slot->isNotEmpty()): ?>
        <span name="wireui.select.slot"><?php echo e($slot); ?></span>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
</div>
<?php /**PATH /var/app/ecommerce/vendor/wireui/wireui/src/Components/Select/views/option.blade.php ENDPATH**/ ?>