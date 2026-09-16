<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $logged_user
 * @var \App\Model\Entity\Plan $logged_user_plan
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $referrals
 */
$this->assign('title', __('Referral Program'));
$this->assign('description', '');
$this->assign('content_title', __('Referral Program'));

$refLink = rtrim($this->Url->build('/', true), '/') . '/ref/' . $logged_user->username;
?>

<style>
/* ── Referrals Modern UI ──────────────────────────────────── */
.lm-ref-hero {
    background: linear-gradient(135deg, #0f172a, #1e1b4b);
    border-radius: 20px;
    padding: 36px 40px;
    margin-bottom: 28px;
    display: flex;
    align-items: center;
    gap: 28px;
    box-shadow: 0 10px 40px rgba(15,23,42,.2);
    flex-wrap: wrap;
}
.lm-ref-hero-icon {
    width: 70px; height: 70px;
    background: rgba(34,197,94,.15);
    border: 2px solid rgba(34,197,94,.3);
    border-radius: 18px;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
}
.lm-ref-hero-icon .fa { font-size: 30px; color: #22c55e; }
.lm-ref-hero-text h2 {
    font-size: 22px; font-weight: 800; color: #fff;
    margin: 0 0 8px; font-family: 'Inter', sans-serif;
}
.lm-ref-hero-text p {
    font-size: 14px; color: rgba(255,255,255,.65);
    margin: 0; line-height: 1.7; font-family: 'Inter', sans-serif;
}
.lm-ref-pct {
    font-size: 42px; font-weight: 900; color: #22c55e;
    font-family: 'Inter', sans-serif; line-height: 1;
    margin-left: auto;
    flex-shrink: 0;
    text-align: center;
}
.lm-ref-pct span { display: block; font-size: 12px; color: rgba(255,255,255,.5); font-weight: 500; letter-spacing: 0.06em; text-transform: uppercase; margin-top: 4px; }

/* Stat cards */
.lm-ref-stats { display: flex; gap: 16px; margin-bottom: 24px; flex-wrap: wrap; }
.lm-ref-stat-card {
    flex: 1; min-width: 160px;
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 14px;
    padding: 20px 22px;
    box-shadow: 0 1px 3px rgba(0,0,0,.05);
    text-align: center;
}
.lm-ref-stat-card .stat-num {
    font-size: 28px; font-weight: 800; color: #0f172a;
    font-family: 'Inter', sans-serif; margin-bottom: 4px;
}
.lm-ref-stat-card .stat-label {
    font-size: 12px; color: #64748b;
    text-transform: uppercase; letter-spacing: 0.08em; font-weight: 600;
    font-family: 'Inter', sans-serif;
}

/* Link box */
.lm-ref-link-card {
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 16px;
    padding: 24px 28px;
    margin-bottom: 24px;
    box-shadow: 0 1px 3px rgba(0,0,0,.05);
}
.lm-ref-link-card h4 {
    font-size: 15px; font-weight: 700; color: #0f172a;
    font-family: 'Inter', sans-serif; margin: 0 0 16px;
    display: flex; align-items: center; gap: 8px;
}
.lm-ref-link-card h4 .fa { color: #22c55e; }
.lm-ref-link-row {
    display: flex; gap: 10px; align-items: center; flex-wrap: wrap;
}
.lm-ref-link-input {
    flex: 1; border: 1.5px solid #e2e8f0; border-radius: 10px;
    padding: 12px 16px; font-size: 14px; color: #22c55e;
    font-family: 'Courier New', monospace; background: #f8fafc;
    min-width: 0;
}
.lm-ref-link-input:focus { outline: none; border-color: #22c55e; box-shadow: 0 0 0 3px rgba(34,197,94,.12); }
.lm-ref-copy-btn {
    background: #22c55e; color: #fff;
    border: none; border-radius: 10px;
    padding: 12px 22px; font-size: 14px; font-weight: 600;
    cursor: pointer; white-space: nowrap;
    font-family: 'Inter', sans-serif;
    box-shadow: 0 2px 8px rgba(34,197,94,.3);
    transition: background .2s, transform .15s;
}
.lm-ref-copy-btn:hover { background: #16a34a; transform: translateY(-1px); }

/* How it works */
.lm-how-it-works {
    display: flex; gap: 16px; margin-bottom: 24px; flex-wrap: wrap;
}
.lm-hiw-step {
    flex: 1; min-width: 200px;
    background: #fff; border: 1px solid #e2e8f0;
    border-radius: 14px; padding: 22px;
    box-shadow: 0 1px 3px rgba(0,0,0,.05); text-align: center;
    position: relative;
}
.lm-hiw-step-num {
    width: 36px; height: 36px; background: #f0fdf4; color: #16a34a;
    border-radius: 50%; display: flex; align-items: center; justify-content: center;
    font-size: 16px; font-weight: 800; font-family: 'Inter', sans-serif;
    margin: 0 auto 14px;
}
.lm-hiw-step h5 {
    font-size: 14px; font-weight: 700; color: #0f172a;
    font-family: 'Inter', sans-serif; margin: 0 0 6px;
}
.lm-hiw-step p {
    font-size: 13px; color: #64748b;
    margin: 0; line-height: 1.6; font-family: 'Inter', sans-serif;
}

/* Referrals table */
.lm-ref-table-card {
    background: #fff; border: 1px solid #e2e8f0;
    border-radius: 16px; overflow: hidden;
    box-shadow: 0 1px 3px rgba(0,0,0,.05);
    margin-bottom: 20px;
}
.lm-ref-table-header {
    padding: 16px 24px; border-bottom: 1px solid #e2e8f0;
    display: flex; align-items: center; gap: 10px;
    font-size: 15px; font-weight: 700; color: #0f172a;
    font-family: 'Inter', sans-serif; background: #f8fafc;
}
.lm-ref-table-header .fa { color: #22c55e; }
.lm-ref-table { width: 100%; border-collapse: collapse; font-family: 'Inter', sans-serif; }
.lm-ref-table thead th {
    font-size: 11px; text-transform: uppercase; letter-spacing: 0.08em;
    color: #64748b; font-weight: 700; padding: 14px 20px;
    border-bottom: 1px solid #e2e8f0; background: #f8fafc; text-align: left;
}
.lm-ref-table tbody td {
    padding: 14px 20px; border-bottom: 1px solid #f1f5f9;
    font-size: 14px; color: #1e293b;
}
.lm-ref-table tbody tr:last-child td { border-bottom: none; }
.lm-ref-table tbody tr:hover td { background: #f8fafc; }
.lm-ref-empty { text-align: center; padding: 40px; color: #94a3b8; font-family: 'Inter', sans-serif; }
.lm-ref-empty .fa { font-size: 36px; margin-bottom: 12px; display: block; }
</style>

<!-- ── Hero ──────────────────────────────────────────────────── -->
<div class="lm-ref-hero">
    <div class="lm-ref-hero-icon">
        <i class="fa fa-users"></i>
    </div>
    <div class="lm-ref-hero-text">
        <h2><?= __('Earn Money by Referring Friends') ?></h2>
        <p><?= __(
            'Share your referral link. For every friend who signs up and earns, '
            . 'you get {0}% of their earnings — for life!',
            '<strong style="color:#22c55e;">' . h($logged_user_plan->referral_percentage) . '</strong>'
        ) ?></p>
    </div>
    <?php if ($logged_user_plan->referral_percentage > 0) : ?>
    <div class="lm-ref-pct">
        <?= h($logged_user_plan->referral_percentage) ?>%
        <span><?= __('Lifetime Commission') ?></span>
    </div>
    <?php endif; ?>
</div>

<!-- ── Stats ─────────────────────────────────────────────────── -->
<div class="lm-ref-stats">
    <div class="lm-ref-stat-card">
        <div class="stat-num"><?= $referrals->count() ?></div>
        <div class="stat-label"><?= __('Total Referrals') ?></div>
    </div>
    <div class="lm-ref-stat-card">
        <div class="stat-num" style="color:#22c55e;"><?= display_price_currency($logged_user->referral_earnings) ?></div>
        <div class="stat-label"><?= __('Total Referral Earnings') ?></div>
    </div>
    <div class="lm-ref-stat-card">
        <div class="stat-num" style="color:#7c3aed;"><?= h($logged_user_plan->referral_percentage) ?>%</div>
        <div class="stat-label"><?= __('Your Commission Rate') ?></div>
    </div>
</div>

<!-- ── How it works ──────────────────────────────────────────── -->
<div class="lm-how-it-works">
    <div class="lm-hiw-step">
        <div class="lm-hiw-step-num">1</div>
        <h5><?= __('Share Your Link') ?></h5>
        <p><?= __('Copy your unique referral link and share it with friends, on social media, or in your content.') ?></p>
    </div>
    <div class="lm-hiw-step">
        <div class="lm-hiw-step-num">2</div>
        <h5><?= __('They Sign Up') ?></h5>
        <p><?= __('When someone clicks your link and creates an account, they are linked to you permanently.') ?></p>
    </div>
    <div class="lm-hiw-step">
        <div class="lm-hiw-step-num">3</div>
        <h5><?= __('You Earn Forever') ?></h5>
        <p><?= __(
            'Every time your referral earns from their short links, you automatically receive {0}% of their earnings.',
            h($logged_user_plan->referral_percentage)
        ) ?></p>
    </div>
</div>

<!-- ── Referral Link ──────────────────────────────────────────── -->
<div class="lm-ref-link-card">
    <h4><i class="fa fa-share-alt"></i> <?= __('Your Referral Link') ?></h4>
    <div class="lm-ref-link-row">
        <input type="text" class="lm-ref-link-input" id="lm-ref-link-val"
               value="<?= h($refLink) ?>" readonly onclick="this.select()">
        <button class="lm-ref-copy-btn" id="lm-ref-copy-btn" onclick="copyRefLink()">
            <i class="fa fa-copy"></i> <?= __('Copy Link') ?>
        </button>
    </div>

    <?php if (!empty(get_option('referral_banners_code'))) : ?>
        <div style="margin-top:20px;">
            <?= str_replace('[referral_link]', $refLink, get_option('referral_banners_code')) ?>
        </div>
    <?php endif; ?>
</div>

<!-- ── Referrals Table ────────────────────────────────────────── -->
<div class="lm-ref-table-card">
    <div class="lm-ref-table-header">
        <i class="fa fa-list"></i>
        <?= __('My Referrals') ?>
        <span style="margin-left:auto;font-size:13px;color:#64748b;font-weight:500;">
            <?= $referrals->count() ?> <?= __('total') ?>
        </span>
    </div>
    <?php if ($referrals->count() > 0) : ?>
        <table class="lm-ref-table">
            <thead>
                <tr>
                    <th><?= __('Username') ?></th>
                    <th><?= __('Joined') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($referrals as $referral) : ?>
                    <tr>
                        <td>
                            <i class="fa fa-user-circle" style="color:#22c55e;margin-right:8px;"></i>
                            <?= h($referral->username) ?>
                        </td>
                        <td><?= display_date_timezone($referral->created) ?></td>
                    </tr>
                <?php endforeach; ?>
                <?php unset($referral); ?>
            </tbody>
        </table>
    <?php else : ?>
        <div class="lm-ref-empty">
            <i class="fa fa-user-plus"></i>
            <p><?= __('No referrals yet. Share your link to get started!') ?></p>
        </div>
    <?php endif; ?>
</div>

<!-- Pagination -->
<ul class="pagination" style="font-family:'Inter',sans-serif;">
    <?php
    $this->Paginator->setTemplates(['ellipsis' => '<li><a href="javascript:void(0)">…</a></li>']);
    if ($this->Paginator->hasPrev()) echo $this->Paginator->prev('«');
    echo $this->Paginator->numbers(['modulus' => 4, 'first' => 2, 'last' => 2]);
    if ($this->Paginator->hasNext()) echo $this->Paginator->next('»');
    ?>
</ul>

<?php $this->start('scriptBottom'); ?>
<script>
function copyRefLink() {
    var link = document.getElementById('lm-ref-link-val').value;
    navigator.clipboard.writeText(link).then(function () {
        var btn = document.getElementById('lm-ref-copy-btn');
        btn.innerHTML = '<i class="fa fa-check"></i> Copied!';
        setTimeout(function () { btn.innerHTML = '<i class="fa fa-copy"></i> Copy Link'; }, 2000);
    });
}
</script>
<?php $this->end(); ?>
