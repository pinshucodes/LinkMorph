<?php
$this->assign('title', get_option('site_name'));
$this->assign('description', get_option('description'));
$this->assign('og_title', $link->title);
$this->assign('og_description', $link->description);
$this->assign('og_image', $link->image);
?>

<?php $this->start('scriptTop'); ?>
<script>if (window.self !== window.top) { window.top.location.href = window.location.href; }</script>
<?php $this->end(); ?>

<div class="lm-captcha-page">

    <!-- Ad above -->
    <?php if (!empty($ad_captcha_above)) : ?>
        <div style="margin-bottom: 28px; text-align: center; width: 100%;">
            <?= $ad_captcha_above ?>
        </div>
    <?php endif; ?>

    <!-- Main card -->
    <div class="lm-captcha-card">

        <!-- Site name -->
        <div class="site-name">
            <span></span>
            <?= h(get_option('site_name')) ?>
        </div>

        <!-- Link preview (if enabled and has metadata) -->
        <?php if (
            get_option('short_link_content', 'no') === 'yes' &&
            (!empty($link->title) || !empty($link->description) || !empty($link->image))
        ) : ?>
        <div class="lm-link-preview">
            <?php if (!empty($link->image)) : ?>
                <img class="lm-thumb" src="<?= h($link->image) ?>" alt="">
            <?php endif; ?>
            <?php if (!empty($link->title)) : ?>
                <h4><?= h($link->title) ?></h4>
            <?php endif; ?>
            <?php if (!empty($link->description)) : ?>
                <p><?= h($link->description) ?></p>
            <?php endif; ?>
        </div>
        <?php endif; ?>

        <!-- Form -->
        <?= $this->Flash->render() ?>
        <?= $this->Form->create(null, ['id' => 'link-view']); ?>
        <?= $this->Form->hidden('action', ['value' => 'captcha']); ?>
        <?= $this->Form->hidden('f_n', ['value' => 'slc']); ?>

        <p style="font-size: 14px; color: var(--text-muted); margin-bottom: 24px;">
            <?= __('Verify you are human to continue to the destination.') ?>
        </p>

        <!-- Captcha widget -->
        <?php if (isset_captcha()) : ?>
        <div class="form-group" style="margin-bottom: 20px;">
            <div id="captchaShortlink" style="display:inline-block;"></div>
        </div>
        <?php endif; ?>

        <?= $this->Form->button(__('Continue to destination →'), [
            'class' => 'lm-proceed-btn',
            'id'    => 'invisibleCaptchaShortlink',
        ]); ?>

        <?= $this->Form->end() ?>

        <!-- Blog post teaser -->
        <?php if ($post) : ?>
        <div style="margin-top: 28px; padding-top: 20px; border-top: 1px solid var(--border-subtle); text-align: left;">
            <div style="font-size: 11px; color: var(--text-subtle); text-transform: uppercase; letter-spacing: .08em; font-weight: 600; margin-bottom: 8px;">
                <a href="<?= build_main_domain_url('/blog') ?>" style="color: var(--accent);"><?= __('From Our Blog') ?></a>
            </div>
            <h4 style="font-size: 14px; color: var(--text); margin: 0 0 6px;"><?= h($post->title) ?></h4>
            <div style="font-size: 13px; color: var(--text-muted);"><?= $post->description ?></div>
        </div>
        <?php endif; ?>

        <p class="lm-captcha-disclaimer">
            <?= __('By proceeding, you agree to our') ?>
            <a href="<?= build_main_domain_url('/page/terms-of-service') ?>"><?= __('Terms') ?></a>
            &amp;
            <a href="<?= build_main_domain_url('/page/privacy-policy') ?>"><?= __('Privacy Policy') ?></a>.
        </p>
    </div>

    <!-- Ad below -->
    <?php if (!empty($ad_captcha_below)) : ?>
        <div style="margin-top: 28px; text-align: center; width: 100%;">
            <?= $ad_captcha_below ?>
        </div>
    <?php endif; ?>

</div>

<?php $this->start('scriptBottom'); ?>
<?php if (!empty($link->pixel_code)) : ?>
<!-- Retargeting pixel — injected by link owner -->
<?= $link->pixel_code ?>
<?php endif; ?>
<?php $this->end(); ?>
