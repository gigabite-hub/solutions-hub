<?php
/*
Plugin Name: Solutions Hub Addon
Description: Für die IDTA Webseite entwickelt
Author: Publik. Agentur für Kommunikation GmbH
Version: 1.0.0
Author URI: https://agentur-publik.de/
*/


include __DIR__ . "/post_type.php";

add_action('admin_head', 'adminCSS');

function get_site_lang_string()
{
    if (defined("ICL_LANGUAGE_CODE")) {
        return strtoupper(constant("ICL_LANGUAGE_CODE"));
    } else {
        $locale = get_locale();

        switch ($locale) {
            case 'de_DE_formal':
            case 'de_DE':
                return "DE";
            default:
                return "EN";
        }
    }
}

function adminCSS()
{
?>
    <style type='text/css'>
        .post-type-solutions-hub #side-sortables .inside p.hide-if-no-js {
            display: none;
        }

        .post-type-solutions-hub #side-sortables #postimagediv .inside p.hide-if-no-js {
            display: block;
        }


        .post-type-solutions-hub #side-sortables .inside #new-tag-solution-type-desc,
        .post-type-solutions-hub #side-sortables .inside #new-tag-aas-standards-desc {
            display: none;
        }

        .post-type-solutions-hub #side-sortables .inside {
            padding-bottom: 0;
        }
    </style> <?php
            }

            // https://github.com/Mass1milian0/Excel-Importer-for-wordpress/blob/main/importer.php
            // TODO: Excel Importer
