<?php

use Migrations\AbstractMigration;

/**
 * Version671 — Seeds legal pages for LinkMorph India launch
 * Creates:
 *   - Terms of Service (/terms-of-service)
 *   - Privacy Policy (/privacy-policy) — DPDP Act 2023 compliant
 *   - Report Abuse (/report-abuse)
 *
 * If any page with the same slug already exists, it is skipped (idempotent).
 */
class Version671 extends AbstractMigration
{
    public $autoId = false;

    public function up()
    {
        $this->execute("SET SESSION sql_mode = ''");

        $now = date('Y-m-d H:i:s');

        $pages = [

            /* ── Terms of Service ──────────────────────────────── */
            [
                'title'            => 'Terms of Service',
                'slug'             => 'terms-of-service',
                'published'        => 1,
                'meta_title'       => 'Terms of Service',
                'meta_description' => 'Read our Terms of Service for using LinkMorph URL shortening services.',
                'created'          => $now,
                'modified'         => $now,
                'content'          => '<div class="lm-legal">
<h2>Terms of Service</h2>
<p><em>Last updated: ' . date('F j, Y') . '</em></p>

<p>Welcome to <strong>LinkMorph</strong>. By accessing or using our website and services (&ldquo;Service&rdquo;), you agree to be bound by these Terms of Service (&ldquo;Terms&rdquo;). Please read them carefully.</p>

<h3>1. Eligibility</h3>
<p>You must be at least 13 years of age to use this Service. By using LinkMorph, you represent that you meet this requirement. If you are under 18, you should use the Service only with the involvement of a parent or guardian.</p>

<h3>2. Acceptable Use</h3>
<p>You agree not to use LinkMorph to shorten URLs that point to:</p>
<ul>
<li>Illegal content under the laws of India or any applicable jurisdiction</li>
<li>Malware, phishing pages, or fraudulent websites</li>
<li>Pornographic or adult content without appropriate age-gating</li>
<li>Content that promotes violence, terrorism, or hatred</li>
<li>Spam or unsolicited bulk communications</li>
<li>Any content that infringes on intellectual property rights</li>
</ul>
<p>LinkMorph reserves the right to immediately deactivate links that violate this policy.</p>

<h3>3. Publisher Earnings &amp; CPM</h3>
<p>LinkMorph operates a CPM (Cost Per Mille) model. Earnings are calculated based on valid, unique views of your short links. We reserve the right to withhold earnings generated through fraudulent traffic, bots, paid-to-click schemes, or self-clicking. Final determination of traffic validity rests solely with LinkMorph.</p>

<h3>4. Withdrawals</h3>
<p>Withdrawals are processed within 7&ndash;14 business days after a request is approved. Minimum withdrawal thresholds apply as displayed in your account. LinkMorph reserves the right to request identity verification (KYC) before processing any withdrawal.</p>

<h3>5. Account Suspension &amp; Termination</h3>
<p>We may suspend or terminate your account at our sole discretion if we believe you have violated these Terms. Upon termination, any pending earnings from fraudulent traffic will be forfeited.</p>

<h3>6. Limitation of Liability</h3>
<p>LinkMorph is provided &ldquo;as is&rdquo; without any warranties. We shall not be liable for any indirect, incidental, or consequential damages arising from your use of the Service. Our total liability to you shall not exceed the earnings credited to your account in the 30 days preceding the claim.</p>

<h3>7. Changes to Terms</h3>
<p>We may update these Terms at any time. Continued use of the Service after changes constitutes your acceptance of the new Terms.</p>

<h3>8. Governing Law</h3>
<p>These Terms are governed by the laws of India. Any disputes shall be subject to the exclusive jurisdiction of the courts in India.</p>

<h3>9. Contact</h3>
<p>For any questions regarding these Terms, please use the <a href="/contact">Contact</a> page.</p>
</div>',
            ],

            /* ── Privacy Policy ────────────────────────────────── */
            [
                'title'            => 'Privacy Policy',
                'slug'             => 'privacy-policy',
                'published'        => 1,
                'meta_title'       => 'Privacy Policy',
                'meta_description' => 'Learn how LinkMorph collects, uses, and protects your data. DPDP Act 2023 compliant.',
                'created'          => $now,
                'modified'         => $now,
                'content'          => '<div class="lm-legal">
<h2>Privacy Policy</h2>
<p><em>Last updated: ' . date('F j, Y') . '</em></p>

<p>LinkMorph (&ldquo;we&rdquo;, &ldquo;us&rdquo;, or &ldquo;our&rdquo;) is committed to protecting your privacy in accordance with the <strong>Digital Personal Data Protection (DPDP) Act, 2023</strong> of India and applicable data protection principles.</p>

<h3>1. Data We Collect</h3>
<ul>
<li><strong>Account data:</strong> Name, email address, username when you register.</li>
<li><strong>Payment data:</strong> Bank account / UPI details for withdrawals (stored encrypted).</li>
<li><strong>Usage data:</strong> IP addresses, browser user-agent, pages visited, links clicked &mdash; for analytics, fraud prevention, and CPM calculation.</li>
<li><strong>Cookies:</strong> Session cookies for login and preference cookies for UI settings. We do not use third-party advertising cookies on our own pages.</li>
</ul>

<h3>2. How We Use Your Data</h3>
<ul>
<li>To provide and maintain the Service</li>
<li>To calculate and disburse publisher earnings</li>
<li>To prevent fraud and abuse</li>
<li>To send transactional emails (e.g., withdrawal notifications)</li>
<li>To comply with legal obligations under Indian law</li>
</ul>

<h3>3. Legal Basis (DPDP Act 2023)</h3>
<p>Under the DPDP Act 2023, we process your personal data under the following bases:</p>
<ul>
<li><strong>Consent:</strong> When you register and agree to these policies.</li>
<li><strong>Legitimate use:</strong> For fraud prevention and service security.</li>
<li><strong>Legal obligation:</strong> When required by Indian courts or regulatory authorities (e.g., under IT Act 2000).</li>
</ul>

<h3>4. Data Sharing</h3>
<p>We do not sell your personal data. We share data only with:</p>
<ul>
<li><strong>Payment processors</strong> (Razorpay) for withdrawal processing</li>
<li><strong>Advertising networks</strong> (PropellerAds, Adsterra) which may set their own cookies on ad pages visited by your link visitors &mdash; their own privacy policies apply</li>
<li><strong>Government / law enforcement</strong> when legally required</li>
</ul>

<h3>5. Data Retention</h3>
<p>Account data is retained as long as your account is active. Click/statistics data is retained for 24 months for analytics purposes. On account deletion, personal data is purged within 30 days, except where retention is required by law.</p>

<h3>6. Your Rights (DPDP Act 2023)</h3>
<p>As a Data Principal under the DPDP Act 2023, you have the right to:</p>
<ul>
<li>Access the personal data we hold about you</li>
<li>Correct inaccurate personal data</li>
<li>Request erasure of your personal data</li>
<li>Withdraw consent at any time (this may result in account closure)</li>
<li>Nominate a person to exercise data rights on your behalf in case of death or incapacity</li>
</ul>
<p>To exercise these rights, contact us via the <a href="/contact">Contact</a> page.</p>

<h3>7. Data Security</h3>
<p>We implement industry-standard security measures including HTTPS/TLS encryption, bcrypt password hashing, and HTTP-Only, Secure cookies. Despite these measures, no system is 100% secure; use the Service at your own risk.</p>

<h3>8. Cookies</h3>
<p>We use strictly necessary cookies for session management and a first-party analytics cookie to measure aggregate site usage. You can disable cookies in your browser, but this may affect Service functionality.</p>

<h3>9. Children\'s Privacy</h3>
<p>Our Service is not intended for children under 13. We do not knowingly collect personal data from children. If you believe a child has provided us data, contact us immediately.</p>

<h3>10. Changes to This Policy</h3>
<p>We may update this policy periodically. Material changes will be communicated via email to registered users.</p>

<h3>11. Contact / Grievance Officer</h3>
<p>For privacy-related queries or to exercise your DPDP rights, contact us via our <a href="/contact">Contact</a> page. We will respond within 30 days as required by the DPDP Act 2023.</p>
</div>',
            ],

            /* ── Report Abuse ──────────────────────────────────── */
            [
                'title'            => 'Report Abuse',
                'slug'             => 'report-abuse',
                'published'        => 1,
                'meta_title'       => 'Report Abuse',
                'meta_description' => 'Report abusive, illegal, or harmful short links on LinkMorph.',
                'created'          => $now,
                'modified'         => $now,
                'content'          => '<div class="lm-legal">
<h2>Report Abuse</h2>
<p>LinkMorph has a zero-tolerance policy for abusive, illegal, or harmful content. If you have come across a LinkMorph short link that you believe is being used for harmful purposes, please report it to us immediately.</p>

<h3>What to Report</h3>
<ul>
<li>Phishing or fraudulent websites</li>
<li>Malware or virus distribution</li>
<li>Child Sexual Abuse Material (CSAM) &mdash; <em>reported directly to CyberCrime.gov.in and NCMEC</em></li>
<li>Spam &amp; unsolicited commercial messages</li>
<li>Content that violates Indian law (IT Act 2000, IPC)</li>
<li>Copyright or trademark infringement</li>
</ul>

<h3>How to Report</h3>
<p>Use our <strong><a href="/contact">Contact</a></strong> page and select <em>&ldquo;Report Abuse&rdquo;</em> as the subject. Please include:</p>
<ul>
<li>The full LinkMorph short URL (e.g., <code>yourdomain.com/abc123</code>)</li>
<li>The destination URL if you can safely identify it</li>
<li>A brief description of the abusive content</li>
<li>Any screenshots or evidence (optional)</li>
</ul>

<h3>Response Time</h3>
<p>We review all abuse reports within <strong>24&ndash;48 hours</strong>. Links that are confirmed to violate our policies are disabled immediately. For CSAM reports, we act within 1 hour and report to the appropriate authorities.</p>

<h3>Government &amp; Law Enforcement</h3>
<p>Law enforcement agencies requiring information about specific links for active investigations may contact us via our official Contact page. We cooperate fully with lawful requests under the IT Act 2000 and applicable orders from Indian courts.</p>

<h3>DMCA / Copyright Takedowns</h3>
<p>If you believe a short link redirects to content that infringes your copyright, please send a takedown notice via our <a href="/contact">Contact</a> page. Include: description of the copyrighted work, the infringing URL, your contact information, and a statement that the notice is accurate.</p>
</div>',
            ],

        ];

        foreach ($pages as $page) {
            // Skip if a page with this slug already exists
            $exists = $this->fetchRow("SELECT id FROM `pages` WHERE `slug` = '" . $page['slug'] . "' LIMIT 1");
            if ($exists) {
                continue;
            }
            $this->table('pages')->insert($page)->saveData();
        }
    }

    public function down()
    {
        $slugs = ['terms-of-service', 'privacy-policy', 'report-abuse'];
        foreach ($slugs as $slug) {
            $this->execute("DELETE FROM `pages` WHERE `slug` = '" . $slug . "'");
        }
    }
}
