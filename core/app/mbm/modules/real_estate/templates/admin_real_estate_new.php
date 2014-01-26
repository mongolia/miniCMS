<?php if (has_flash()): ?>
    <?php $flash_type = get_flash_type(); ?>
    <div class="col-lg-12">
        <?php echo render_flash(); ?>
    </div>
<?php endif; ?>
<div class="row">

    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                <?php echo __('Create object'); ?>
            </header>
            <div class="panel-body">

                <div class="row">
                    <div class="col-md-12">
                        <form action="<?php echo get_url('admin_photo_save') ?>" class="dropzone" id="my-awesome-dropzone">
                            <input type="hidden" name="module" value="real_estate">
                            <input type="hidden" name="photo_type" value="slider">
                        </form>
                    </div>
                </div>

                <? /* Render whole form */ ?>
                <?php
                if ($flash_type != 'success') {
                    echo $form->render();
                }
                ?>

                <script type="text/javascript">
                    $('#use_photo').removeAttr('checked');
                    $('#element_photo').hide();
                    $('#categories').multiSelect({
                        selectableOptgroup: true
                    });
                </script>
            </div>
        </section>
    </div>