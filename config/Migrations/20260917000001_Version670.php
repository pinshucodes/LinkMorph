<?php

use Migrations\AbstractMigration;

/**
 * Version670 — LinkMorph custom features
 * Adds:
 *   links.link_password   VARCHAR(255) NULL  — bcrypt hash of password
 *   links.pixel_code      TEXT         NULL  — retargeting pixel HTML/JS snippet
 */
class Version670 extends AbstractMigration
{
    public $autoId = false;

    public function up()
    {
        $this->execute("SET SESSION sql_mode = ''");

        $linksTable = $this->table('links');

        // Password protection — store as bcrypt hash, NULL = no password
        if (!$linksTable->hasColumn('link_password')) {
            $linksTable
                ->addColumn('link_password', 'string', [
                    'limit'   => 255,
                    'null'    => true,
                    'default' => null,
                    'after'   => 'description',
                    'comment' => 'bcrypt hash of link password; NULL = no password',
                ])
                ->update();
        }

        // Retargeting pixel — raw HTML/JS inserted on the interstitial/banner page
        if (!$linksTable->hasColumn('pixel_code')) {
            $linksTable
                ->addColumn('pixel_code', 'text', [
                    'null'    => true,
                    'default' => null,
                    'after'   => 'link_password',
                    'comment' => 'HTML/JS retargeting pixel code fired on link view',
                ])
                ->update();
        }
    }

    public function down()
    {
        $linksTable = $this->table('links');

        if ($linksTable->hasColumn('pixel_code')) {
            $linksTable->removeColumn('pixel_code')->update();
        }

        if ($linksTable->hasColumn('link_password')) {
            $linksTable->removeColumn('link_password')->update();
        }
    }
}
