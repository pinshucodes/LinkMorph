<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Link $link
 */
$this->assign('title', __('Password Protected — {0}', h(get_option('site_name'))));
$this->assign('description', '');
?>

<style>
/* ── Password Gate ─────────────────────────────────────────── */
.lm-pw-gate-wrap {
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: calc(100vh - 160px);
    padding: 40px 20px;
}
.lm-pw-gate-card {
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 20px;
    padding: 48px 44px;
    max-width: 440px;
    width: 100%;
    box-shadow: 0 20px 60px rgba(0,0,0,.10);
    text-align: center;
}
.lm-pw-gate-icon {
    width: 68px; height: 68px;
    background: linear-gradient(135deg, #0f172a, #1e1b4b);
    border-radius: 18px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 24px;
    box-shadow: 0 8px 24px rgba(15,23,42,.25);
}
.lm-pw-gate-icon .fa {
    color: #22c55e;
    font-size: 28px;
}
.lm-pw-gate-card h2 {
    font-size: 22px;
    font-weight: 800;
    color: #0f172a;
    margin: 0 0 10px;
    font-family: 'Inter', sans-serif;
}
.lm-pw-gate-card p {
    font-size: 14px;
    color: #64748b;
    margin: 0 0 28px;
    line-height: 1.65;
}
.lm-pw-gate-input-wrap {
    position: relative;
    margin-bottom: 18px;
}
.lm-pw-gate-input {
    width: 100%;
    border: 1.5px solid #e2e8f0;
    border-radius: 12px;
    padding: 14px 50px 14px 18px;
    font-size: 16px;
    font-family: 'Inter', sans-serif;
    color: #1e293b;
    background: #f8fafc;
    transition: border-color .2s, box-shadow .2s, background .2s;
    box-sizing: border-box;
}
.lm-pw-gate-input:focus {
    outline: none;
    border-color: #22c55e;
    background: #fff;
    box-shadow: 0 0 0 3px rgba(34,197,94,.12);
}
.lm-pw-eye {
    position: absolute;
    right: 16px; top: 50%;
    transform: translateY(-50%);
    background: none; border: none;
    color: #94a3b8; cursor: pointer;
    font-size: 17px; padding: 4px;
}
.lm-pw-eye:hover { color: #22c55e; }
.lm-pw-gate-btn {
    width: 100%;
    background: linear-gradient(135deg, #22c55e, #16a34a);
    color: #fff;
    border: none;
    border-radius: 12px;
    padding: 15px;
    font-size: 16px;
    font-weight: 700;
    font-family: 'Inter', sans-serif;
    cursor: pointer;
    box-shadow: 0 4px 16px rgba(34,197,94,.35);
    transition: transform .15s, box-shadow .2s;
    letter-spacing: -0.01em;
}
.lm-pw-gate-btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 6px 22px rgba(34,197,94,.45);
}
.lm-pw-error {
    background: #fef2f2;
    border: 1px solid #fecaca;
    border-radius: 8px;
    padding: 10px 14px;
    font-size: 13px;
    color: #dc2626;
    margin-bottom: 18px;
    text-align: left;
    display: flex;
    gap: 8px;
    align-items: center;
}
.lm-pw-branding {
    margin-top: 28px;
    font-size: 12px;
    color: #94a3b8;
    font-family: 'Inter', sans-serif;
}
.lm-pw-branding a { color: #22c55e; text-decoration: none; font-weight: 600; }
</style>

<div class="lm-pw-gate-wrap">
    <div class="lm-pw-gate-card">
        <div class="lm-pw-gate-icon">
            <i class="fa fa-lock"></i>
        </div>
        <h2><?= __('Password Protected Link') ?></h2>
        <p>
            <?= __('The owner of this link has protected it with a password. Please enter the password below to proceed.') ?>
        </p>

        <?= $this->Flash->render() ?>

        <?= $this->Form->create(null, [
            'url'    => $this->request->getRequestTarget(),
            'method' => 'post',
        ]) ?>

        <?= $this->Form->unlockField('lm_link_password') ?>

        <div class="lm-pw-gate-input-wrap">
            <input
                type="password"
                name="lm_link_password"
                id="lm-gate-pw"
                class="lm-pw-gate-input"
                placeholder="<?= __('Enter password…') ?>"
                required
                autofocus
            >
            <button type="button" class="lm-pw-eye" id="lm-pw-eye-btn">
                <i class="fa fa-eye" id="lm-pw-eye-ico"></i>
            </button>
        </div>

        <button type="submit" class="lm-pw-gate-btn">
            <i class="fa fa-unlock" style="margin-right:8px;"></i>
            <?= __('Unlock Link') ?>
        </button>

        <?= $this->Form->end() ?>

        <p class="lm-pw-branding">
            <?= __('Protected by') ?> <a href="<?= build_main_domain_url('/') ?>"><?= h(get_option('site_name')) ?></a>
        </p>
    </div>
</div>

<?php $this->start('scriptBottom'); ?>
<script>
(function () {
    'use strict';
    var input = document.getElementById('lm-gate-pw');
    var btn   = document.getElementById('lm-pw-eye-btn');
    var ico   = document.getElementById('lm-pw-eye-ico');
    if (!input || !btn) return;
    btn.addEventListener('click', function () {
        var isText = input.type === 'text';
        input.type = isText ? 'password' : 'text';
        ico.className = isText ? 'fa fa-eye' : 'fa fa-eye-slash';
    });
}());
</script>
<?php $this->end(); ?>
