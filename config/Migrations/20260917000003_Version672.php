<?php
use Migrations\AbstractMigration;

class Version672 extends AbstractMigration
{
    /**
     * Seed competitive Indian-focused payout rates.
     * Rates are in the site's configured currency (₹ for India).
     * Format: [country_code => [name, desktop_adv, desktop_pub, mobile_adv, mobile_pub]]
     *  OR simple mode: [country_code => [name, x, desktop_pub, mobile_pub]]
     *
     * We write to BOTH payout_rates_interstitial and payout_rates_banner
     * so the site is ready regardless of which ad type the admin enables.
     */
    public function up(): void
    {
        $db = $this->getAdapter()->getConnection();

        // ── Simple mode rates (most common setup) ──────────────────
        // Format stored: [code => [0=>country_name, 1=>null, 2=>desktop_pub, 3=>mobile_pub]]
        $rates = [
            'in' => ['India',               null, 2.50,  2.50],  // ₹2.50 — beats ShortX ₹1–₹2
            'us' => ['United States',       null, 5.00,  4.00],
            'gb' => ['United Kingdom',      null, 3.50,  3.00],
            'ca' => ['Canada',              null, 3.00,  2.50],
            'au' => ['Australia',           null, 3.00,  2.50],
            'de' => ['Germany',             null, 2.50,  2.00],
            'fr' => ['France',              null, 2.00,  1.80],
            'nl' => ['Netherlands',         null, 2.00,  1.80],
            'sg' => ['Singapore',           null, 2.00,  1.80],
            'ae' => ['United Arab Emirates',null, 3.00,  2.80],
            'sa' => ['Saudi Arabia',        null, 2.50,  2.20],
            'nz' => ['New Zealand',         null, 2.50,  2.20],
            'ie' => ['Ireland',             null, 2.50,  2.00],
            'ch' => ['Switzerland',         null, 2.50,  2.00],
            'se' => ['Sweden',              null, 2.00,  1.80],
            'no' => ['Norway',              null, 2.00,  1.80],
            'dk' => ['Denmark',             null, 2.00,  1.80],
            'it' => ['Italy',               null, 1.80,  1.50],
            'es' => ['Spain',               null, 1.80,  1.50],
            'jp' => ['Japan',               null, 2.00,  1.80],
            'kr' => ['South Korea',         null, 1.80,  1.50],
            'br' => ['Brazil',              null, 1.00,  0.90],
            'mx' => ['Mexico',              null, 1.20,  1.00],
            'pk' => ['Pakistan',            null, 0.80,  0.70],
            'bd' => ['Bangladesh',          null, 0.70,  0.60],
            'ng' => ['Nigeria',             null, 0.80,  0.70],
            'za' => ['South Africa',        null, 1.00,  0.90],
            'ph' => ['Philippines',         null, 0.80,  0.70],
            'id' => ['Indonesia',           null, 0.80,  0.70],
            'th' => ['Thailand',            null, 0.90,  0.80],
            'my' => ['Malaysia',            null, 1.00,  0.90],
            'all'=> ['Worldwide',           null, 0.80,  0.80], // Global fallback
        ];

        $serialized = serialize($rates);

        // Helper: upsert an option row
        $upsert = function (string $name, string $value) use ($db) {
            $stmt = $db->prepare('SELECT id FROM options WHERE name = ?');
            $stmt->execute([$name]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                $u = $db->prepare('UPDATE options SET value = ? WHERE name = ?');
                $u->execute([$value, $name]);
            } else {
                $i = $db->prepare('INSERT INTO options (name, value) VALUES (?, ?)');
                $i->execute([$name, $value]);
            }
        };

        // Write payout rates for all ad types
        $upsert('payout_rates_interstitial', $serialized);
        $upsert('payout_rates_banner',       $serialized);
        $upsert('payout_rates_popup',        $serialized);

        // Set earning mode to "simple" if not already configured
        $stmt = $db->prepare('SELECT value FROM options WHERE name = ?');
        $stmt->execute(['earning_mode']);
        $existing = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$existing || empty($existing['value'])) {
            $upsert('earning_mode', 'simple');
        }

        // Set minimum withdrawal amount (₹200)
        $stmt2 = $db->prepare('SELECT value FROM options WHERE name = ?');
        $stmt2->execute(['minimum_withdrawal_amount']);
        $existingMin = $stmt2->fetch(PDO::FETCH_ASSOC);
        if (!$existingMin || empty($existingMin['value'])) {
            $upsert('minimum_withdrawal_amount', '200');
        }

        // Set currency to INR if not set
        $stmt3 = $db->prepare('SELECT value FROM options WHERE name = ?');
        $stmt3->execute(['currency']);
        $existingCur = $stmt3->fetch(PDO::FETCH_ASSOC);
        if (!$existingCur || empty($existingCur['value'])) {
            $upsert('currency', 'INR');
            $upsert('currency_symbol', '₹');
            $upsert('currency_symbol_position', 'before');
        }
    }

    public function down(): void
    {
        // Rates are data — do not remove on rollback, just leave them
    }
}
