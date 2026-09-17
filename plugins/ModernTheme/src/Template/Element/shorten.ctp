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

<div class="form-group">
    <?= $this->Form->control('url', [
        'label'       => false,
        'type'        => 'text',
        'placeholder' => __('Paste your long URL here…'),
        'required'    => 'required',
        'class'       => 'form-control',
        'autocomplete'=> 'off',
    ]); ?>
    <?= $this->Form->hidden('ad_type', ['value' => $ad_type]); ?>
    <?= $this->Form->button(__('Shorten →'), [
        'class' => 'btn-captcha',
        'id'    => 'invisibleCaptchaShort',
    ]); ?>
</div>

<?= $this->Form->end(); ?>

<!-- Custom Alias — logged-in users only -->
<?php if ($is_logged_in) : ?>
<div class="hero-alias-area">
    <button type="button" class="alias-toggle-btn" id="lm-alias-toggle">
        <i class="fa fa-tag"></i> <?= __('+ Custom alias (optional)') ?>
    </button>
    <div class="alias-panel" id="lm-alias-wrap" style="display:none;">
        <label><?= __('Custom Alias') ?></label>
        <div class="alias-input-row">
            <span class="alias-prefix"><?= rtrim(build_main_domain_url('/'), '/') ?>/</span>
            <?= $this->Form->control('alias_display', [
                'label'     => false,
                'type'      => 'text',
                'name'      => 'alias',
                'placeholder' => __('my-brand-name'),
                'class'     => 'form-control alias-field',
                'id'        => 'lm-alias-input',
                'pattern'   => '[A-Za-z0-9_-]+',
                'maxlength' => '50',
            ]); ?>
        </div>
        <div class="alias-hint"><?= __('Letters, numbers, hyphens only. Leave blank to auto-generate.') ?></div>
    </div>
</div>
<?php endif; ?>

<?php if (!$is_logged_in && (bool)get_option('enable_captcha_shortlink_anonymous', false) && isset_captcha()) : ?>
    <div class="form-group captcha" style="display:none;">
        <div id="captchaShort" style="display:inline-block;"></div>
    </div>
    <?php
    $this->Form->unlockField('g-recaptcha-response');
    $this->Form->unlockField('h-captcha-response');
    $this->Form->unlockField('adcopy_challenge');
    $this->Form->unlockField('adcopy_response');
    ?>
<?php endif; ?>

<div class="shorten add-link-result"></div>

<?php $this->start('scriptBottom'); ?>
<script>
(function () {
    var toggle = document.getElementById('lm-alias-toggle');
    var wrap   = document.getElementById('lm-alias-wrap');
    var input  = document.getElementById('lm-alias-input');
    if (!toggle || !wrap) return;
    toggle.addEventListener('click', function () {
        var open = wrap.style.display !== 'none';
        wrap.style.display = open ? 'none' : 'block';
        toggle.innerHTML = open
            ? '<i class="fa fa-tag"></i> <?= __('+ Custom alias (optional)') ?>'
            : '<i class="fa fa-times"></i> <?= __('Remove alias') ?>';
        if (!open && input) input.focus();
    });
    if (input) {
        input.addEventListener('input', function () {
            this.value = this.value.replace(/[^A-Za-z0-9_-]/g, '');
        });
    }
}());
</script>
<?php $this->end(); ?>
