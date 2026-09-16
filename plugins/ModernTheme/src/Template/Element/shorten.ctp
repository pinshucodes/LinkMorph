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
        'class' => 'btn-captcha',
        'id'    => 'invisibleCaptchaShort',
    ]); ?>
</div>

<!-- Custom alias row — only shown to logged-in users whose plan allows it -->
<?php if ($is_logged_in) : ?>
<div class="hero-alias-row" id="lm-alias-row">
    <button type="button" class="alias-toggle-btn" id="lm-alias-toggle">
        <i class="fa fa-tag"></i> <?= __('+ Add custom alias (optional)') ?>
    </button>
    <div class="alias-input-wrap" id="lm-alias-wrap" style="display:none;">
        <div class="alias-input-inner">
            <span class="alias-prefix"><?= rtrim(build_main_domain_url('/'), '/') ?>/</span>
            <?=
            $this->Form->control('alias', [
                'label'       => false,
                'type'        => 'text',
                'placeholder' => __('my-brand-name'),
                'class'       => 'form-control alias-field',
                'id'          => 'lm-alias-input',
                'pattern'     => '[A-Za-z0-9_-]+',
                'title'       => __('Letters, numbers, hyphens and underscores only'),
                'maxlength'   => '50',
            ]);
            ?>
        </div>
        <p class="alias-hint"><?= __('Leave blank to auto-generate. Letters, numbers, hyphens only.') ?></p>
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
<style>
/* ── Custom Alias UI ──────────────────────────────────────── */
.hero-alias-row {
    text-align: center;
    margin-top: 14px;
}
.alias-toggle-btn {
    background: none;
    border: none;
    color: rgba(255,255,255,.55);
    font-size: 13px;
    font-weight: 500;
    cursor: pointer;
    padding: 6px 0;
    font-family: 'Inter', sans-serif;
    transition: color .2s;
    display: inline-flex;
    align-items: center;
    gap: 6px;
}
.alias-toggle-btn:hover { color: #22c55e; }
.alias-input-wrap {
    margin-top: 12px;
    animation: lm-fade-in .25s ease;
}
@keyframes lm-fade-in {
    from { opacity: 0; transform: translateY(-6px); }
    to   { opacity: 1; transform: translateY(0); }
}
.alias-input-inner {
    display: inline-flex;
    align-items: center;
    background: rgba(255,255,255,.07);
    border: 1px solid rgba(255,255,255,.18);
    border-radius: 10px;
    overflow: hidden;
    max-width: 420px;
    width: 100%;
    backdrop-filter: blur(8px);
    transition: border-color .2s, box-shadow .2s;
}
.alias-input-inner:focus-within {
    border-color: rgba(34,197,94,.5);
    box-shadow: 0 0 0 3px rgba(34,197,94,.15);
}
.alias-prefix {
    padding: 12px 12px 12px 16px;
    color: rgba(255,255,255,.4);
    font-size: 13px;
    white-space: nowrap;
    font-family: 'Inter', sans-serif;
    border-right: 1px solid rgba(255,255,255,.1);
}
.alias-field {
    background: transparent !important;
    border: none !important;
    box-shadow: none !important;
    color: #fff !important;
    font-size: 15px;
    padding: 12px 14px !important;
    flex: 1;
    font-family: 'Inter', sans-serif;
    height: auto !important;
}
.alias-field::placeholder { color: rgba(255,255,255,.3); }
.alias-field:focus { outline: none; box-shadow: none; }
.alias-hint {
    margin-top: 8px;
    font-size: 12px;
    color: rgba(255,255,255,.35);
    font-family: 'Inter', sans-serif;
}
</style>
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
