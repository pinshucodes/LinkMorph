<?php
/**
 * @var \App\View\AppView $this
 */
?>
<?=
$this->Form->create(null, [
    'url'   => ['controller' => 'Links', 'action' => 'shorten', 'prefix' => false],
    'id'    => 'shorten',
    'class' => 'form-inline',
]);
?>

<?php
$this->Form->setTemplates([
    'inputContainer'      => '{{content}}',
    'error'               => '{{content}}',
    'inputContainerError' => '{{content}}',
]);

$ad_type = get_option('anonymous_default_advert', 1);
if (null !== $this->request->getSession()->read('Auth.User.id')) {
    $ad_type = get_option('member_default_advert', 1);
}
if (!array_key_exists($ad_type, get_allowed_ads())) {
    $ad_type = array_key_first(get_allowed_ads());
}

$is_logged_in = null !== $this->request->getSession()->read('Auth.User.id');
?>

<!-- URL input row -->
<div class="form-group">
    <?=
    $this->Form->control('url', [
        'label'       => false,
        'type'        => 'text',
        'placeholder' => __('Paste your long URL here…'),
        'required'    => 'required',
        'class'       => 'form-control input-lg',
    ]);
    ?>

    <?= $this->Form->hidden('ad_type', ['value' => $ad_type]); ?>

    <?= $this->Form->button(__('Shorten') . ' →', [
        'class' => 'btn-captcha btn-primary',
        'id'    => 'invisibleCaptchaShort',
    ]); ?>
</div>

<!-- Custom alias row — only shown to logged-in users whose plan allows it -->
<?php if ($is_logged_in) : ?>
<div class="advanced-options-toggle">
    <a id="lm-alias-toggle"><i class="fa fa-tag"></i> <?= __('+ Add custom alias (optional)') ?></a>
</div>
<div class="advanced-options-panel" id="lm-alias-wrap" style="display:none; max-width: 500px; margin: 15px auto 0;">
    <label for="lm-alias-input" style="display:block; margin-bottom: 5px;"><?= __('Custom Alias') ?></label>
    <div style="display: flex; align-items: center; border: 1px solid var(--color-border); border-radius: var(--radius-md); background: #fff; overflow: hidden;">
        <span style="padding: 10px 12px; background: var(--color-bg-light); color: var(--color-text-muted); border-right: 1px solid var(--color-border); font-size: 14px;">
            <?= rtrim(build_main_domain_url('/'), '/') ?>/
        </span>
        <?=
        $this->Form->control('alias', [
            'label'       => false,
            'type'        => 'text',
            'placeholder' => __('my-brand-name'),
            'class'       => 'form-control',
            'id'          => 'lm-alias-input',
            'pattern'     => '[A-Za-z0-9_-]+',
            'title'       => __('Letters, numbers, hyphens and underscores only'),
            'maxlength'   => '50',
            'style'       => 'border: none; border-radius: 0; box-shadow: none; flex: 1;'
        ]);
        ?>
    </div>
    <div style="font-size: 12px; color: var(--color-text-muted); margin-top: 5px;">
        <?= __('Leave blank to auto-generate. Letters, numbers, hyphens only.') ?>
    </div>
</div>
<?php endif; ?>

<?php if (!$is_logged_in && (bool)get_option('enable_captcha_shortlink_anonymous', false) && isset_captcha()) : ?>
    <div class="form-group captcha" style="display: none">
        <div id="captchaShort" style="display: inline-block;"></div>
    </div>
    <?php
    $this->Form->unlockField('g-recaptcha-response');
    $this->Form->unlockField('h-captcha-response');
    $this->Form->unlockField('adcopy_challenge');
    $this->Form->unlockField('adcopy_response');
    ?>
<?php endif; ?>

<?= $this->Form->end(); ?>

<div class="shorten add-link-result"></div>

<?php $this->start('scriptBottom'); ?>
<script>
(function () {
    'use strict';
    var toggle = document.getElementById('lm-alias-toggle');
    var wrap   = document.getElementById('lm-alias-wrap');
    var input  = document.getElementById('lm-alias-input');
    if (!toggle || !wrap) return;

    toggle.addEventListener('click', function () {
        var open = wrap.style.display !== 'none';
        wrap.style.display = open ? 'none' : 'block';
        toggle.innerHTML   = open
            ? '<i class="fa fa-tag"></i> <?= __('+ Add custom alias (optional)') ?>'
            : '<i class="fa fa-times"></i> <?= __('Remove custom alias') ?>';
        if (!open && input) input.focus();
    });

    /* Sanitise alias input as user types */
    if (input) {
        input.addEventListener('input', function () {
            this.value = this.value.replace(/[^A-Za-z0-9_-]/g, '');
        });
    }
}());
</script>
<?php $this->end(); ?>
