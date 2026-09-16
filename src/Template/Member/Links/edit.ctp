<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Link $link
 * @var \App\Model\Entity\Plan $logged_user_plan
 */
$this->assign('title', __('Edit Link: {0}', $link->alias));
$this->assign('description', '');
$this->assign('content_title', __('Edit Link: {0}', $link->alias));
?>

<div class="box box-primary">
    <div class="box-body">

        <?= $this->Form->create($link); ?>

        <?= $this->Form->hidden('id'); ?>

        <?=
        $this->Form->control('url', [
            'label' => __('Long URL'),
            'class' => 'form-control',
            'type' => 'url',
            'disabled' => ((bool)$logged_user_plan->edit_long_url) ? false : true,
        ]);
        ?>

        <?=
        $this->Form->control('title', [
            'label' => __('Title'),
            'class' => 'form-control',
            'type' => 'text',
        ]);
        ?>

        <?=
        $this->Form->control('description', [
            'label' => __('Description'),
            'class' => 'form-control',
            'type' => 'textarea',
        ]);
        ?>

<?php if ((bool)$logged_user_plan->link_expiration) : ?>
            <div class="form-group">
                <label><?= __('Expiration Date & Time') ?></label>
                <div class="input-group">
                    <input type="text"
                           id="expiration-picker"
                           name="expiration"
                           class="form-control"
                           placeholder="<?= __('Pick a date & time (leave blank = never expires)') ?>"
                           value="<?= $link->expiration ? h($link->expiration->format('Y-m-d H:i')) : '' ?>"
                           autocomplete="off">
                    <span class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </span>
                </div>
                <p class="help-block">
                    <label>
                        <input type="checkbox" id="clear-expiration">
                        <?= __('Clear expiration (link never expires)') ?>
                    </label>
                </p>
            </div>
        <?php endif; ?>

        <?php
        $ads_options = get_allowed_ads();

        if (count($ads_options) > 1) {
            echo $this->Form->control('ad_type', [
                'label' => __('Advertising Type'),
                'options' => $ads_options,
                'default' => get_option('member_default_advert', 1),
                //'empty'   => __( 'Choose' ),
                'class' => 'form-control input-sm',
            ]);
        } else {
            echo $this->Form->hidden('type', ['value' => get_option('member_default_redirect', 1)]);
        }
        ?>

        <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary']); ?>

        <?= $this->Form->end(); ?>
    </div>
</div>

<?php $this->start('scriptBottom'); ?>
<!-- Flatpickr — lightweight, dependency-free date & time picker -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.css"
      integrity="sha512-MQXduO8IQnJVq1qmySpN87SQEiNOAfGVy3yEBnvqMKMTaGmXPYhAZEzxkRKGdeMWrW/dXMcQiMcebHAKHtEA=="
      crossorigin="anonymous" referrerpolicy="no-referrer"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.js"
        integrity="sha512-K/oyQtMXpxI4+K0W7H25UopjM8pzq0yrVdFsZOU9HqKFxjGkB6ROpFo2uqPD58+iMEUFBYBEACtZmQky2eu=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
(function () {
    'use strict';

    var picker = flatpickr('#expiration-picker', {
        enableTime:  true,
        dateFormat:  'Y-m-d H:i',
        minDate:     'today',
        time_24hr:   true,
        allowInput:  true,
    });

    document.getElementById('clear-expiration').addEventListener('change', function () {
        if (this.checked) {
            picker.clear();
            document.getElementById('expiration-picker').value = '';
            document.getElementById('expiration-picker').disabled = true;
        } else {
            document.getElementById('expiration-picker').disabled = false;
        }
    });
}());
</script>
<?php $this->end(); ?>
