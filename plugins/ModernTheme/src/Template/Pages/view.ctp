<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Page $page
 */
$this->assign('title', ($page->meta_title) ?: $page->title);
$this->assign('description', $page->meta_description);
$this->assign('content_title', $page->title);
?>

<!-- Inner page hero -->
<section class="inner-hero">
    <div class="container">
        <h1><?= h($page->title) ?></h1>
    </div>
</section>

<!-- Page Content -->
<section class="inner-page-content">
    <div class="container">
        <div class="inner-content-card">
            <?= $page->content ?>
        </div>
    </div>
</section>

<?php $this->start('scriptBottom'); ?>
<style>
/* ── Legal / Static Pages ─────────────────────────────────── */
.inner-hero {
    background: linear-gradient(135deg, #0f172a, #1e1b4b);
    padding: 80px 0 60px;
    margin-top: 70px; /* navbar height */
}
.inner-hero h1 {
    color: #fff;
    font-size: 36px;
    font-weight: 800;
    font-family: 'Inter', sans-serif;
    margin: 0;
}
.inner-page-content {
    padding: 48px 0 80px;
    background: #f8fafc;
    min-height: calc(100vh - 300px);
}
.inner-content-card {
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 20px;
    padding: 48px 52px;
    box-shadow: 0 4px 20px rgba(0,0,0,.05);
    max-width: 860px;
    margin: 0 auto;
}
@media (max-width: 768px) {
    .inner-content-card { padding: 28px 20px; }
    .inner-hero h1 { font-size: 26px; }
}

/* Typography inside legal pages */
.lm-legal h2 {
    font-size: 26px; font-weight: 800; color: #0f172a;
    font-family: 'Inter', sans-serif; margin: 0 0 8px;
}
.lm-legal > p:first-of-type {
    color: #64748b; font-size: 14px; margin-bottom: 32px;
    border-bottom: 1px solid #e2e8f0; padding-bottom: 20px;
}
.lm-legal h3 {
    font-size: 17px; font-weight: 700; color: #0f172a;
    font-family: 'Inter', sans-serif;
    margin: 28px 0 10px;
    display: flex; align-items: center; gap: 8px;
}
.lm-legal h3::before {
    content: '';
    display: inline-block;
    width: 4px; height: 18px;
    background: #22c55e;
    border-radius: 2px;
    flex-shrink: 0;
}
.lm-legal p {
    font-size: 15px; color: #374151; line-height: 1.8;
    font-family: 'Inter', sans-serif; margin-bottom: 12px;
}
.lm-legal ul {
    padding-left: 0; margin-bottom: 12px;
    list-style: none;
}
.lm-legal ul li {
    font-size: 15px; color: #374151; line-height: 1.7;
    font-family: 'Inter', sans-serif;
    padding: 4px 0 4px 22px;
    position: relative;
}
.lm-legal ul li::before {
    content: '▸';
    color: #22c55e;
    font-size: 12px;
    position: absolute; left: 0; top: 6px;
}
.lm-legal a { color: #22c55e; text-decoration: none; font-weight: 500; }
.lm-legal a:hover { text-decoration: underline; }
.lm-legal strong { color: #0f172a; }
.lm-legal code {
    background: #f1f5f9; color: #7c3aed;
    padding: 2px 7px; border-radius: 5px;
    font-size: 13px;
}
</style>
<?php $this->end(); ?>
