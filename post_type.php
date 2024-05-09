<?php

require("vendor/autoload.php");

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

function solutions_hub()
{
    $labels = array(
        'name'                  => _x('Solutions Hub', 'Post Type General Name', 'idta'),
        'singular_name'         => _x('Solution', 'Post Type Singular Name', 'idta'),
        'menu_name'             => __('Solutions Hub', 'idta'),
        'name_admin_bar'        => __('Solution', 'idta'),
        'archives'              => __('Solution Archive', 'idta'),
        'attributes'            => __('Solution Attribute', 'idta'),
        'parent_item_colon'     => __('Solution', 'idta'),
        'all_items'             => __('Alle Solution', 'idta'),
        'add_new_item'          => __('Neue Solution', 'idta'),
        'add_new'               => __('Neue Solution hinzufügen', 'idta'),
        'new_item'              => __('Neue Solution hinzufügen', 'idta'),
        'edit_item'             => __('Solution bearbeiten', 'idta'),
        'update_item'           => __('Solution aktualisieren', 'idta'),
        'view_item'             => __('Solution ansehen', 'idta'),
        'view_items'            => __('Solution ansehen', 'idta'),
        'search_items'          => __('Solution suchen', 'idta'),
        'not_found'             => __('Nicht gefunden', 'idta'),
        'not_found_in_trash'    => __('Nicht gefunden', 'idta'),
        'featured_image'        => __('Icon/Bild', 'idta'),
        'set_featured_image'    => __('Icon/Bild hinzufügen', 'idta'),
        'remove_featured_image' => __('Icon/Bild entfernen', 'idta'),
        'use_featured_image'    => __('Als Icon/Bild nutzen', 'idta'),
        'insert_into_item'      => __('Zum Hub hinzufügen', 'idta'),
        'uploaded_to_this_item' => __('Hinzugefügt zu', 'idta'),
        'items_list'            => __('Liste', 'idta'),
        'items_list_navigation' => __('Listen Navigation', 'idta'),
        'filter_items_list'     => __('Liste filtern', 'idta'),
    );
    $args = array(
        'label'                 => __('Solutions Hub', 'idta'),
        'description'           => __('Solutions Hub Integration', 'idta'),
        'labels'                => $labels,
        'supports'              => ['title', 'thumbnail'],
        'taxonomies'            => [''],
        'hierarchical'          => true,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-text-page',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => true,
        'publicly_queryable'    => true,
        'show_in_rest'          => true,
        'rewrite'               => [
            'slug' => "solutions-hub",
            'with_front' => false
        ]
    );
    register_post_type('solutions-hub', $args);

    add_filter('enter_title_here', function ($input) {
        if ('solutions-hub' === get_post_type()) {
            return __('Solution Name eingeben', 'publik');
        } else {
            return $input;
        }
    });

    // aas-standards
    register_taxonomy(
        'aas-standards',
        'solutions-hub',
        [
            'labels' => [
                'name'                       => __('AAS Standards', 'publik'),
                'singular_name'              => __('AAS Standard', 'publik'),
                'all_items'                  => __('Alle AAS Standards', 'publik'),
                'parent_item'                => null,
                'parent_item_colon'          => null,
                'edit_item'                  => __('Standard bearbeiten', 'publik'),
                'update_item'                => __('Standard aktualisieren', 'publik'),
                'add_new_item'               => __('Standard hinzufügen', 'publik'),
                'new_item_name'              => __('Neuer Standard Name', 'publik'),
                'add_or_remove_items'        => __('Standard hinzufügen/entfernen', 'publik'),
                'not_found'                  => __('Kein Tag gefunden.', 'publik'),
                'menu_name'                  => __('AAS Standards', 'publik'),
            ],
            'show_in_menu' => true,
            'show_in_rest' => true,
            'has_archive' => false,
            'hierarchical' => false
        ]
    );

    //solution-type
    register_taxonomy(
        'solution-type',
        'solutions-hub',
        [
            'labels' => [
                'name'                       => __('Solution Types', 'publik'),
                'singular_name'              => __('Solution Type', 'publik'),
                'all_items'                  => __('Alle Solution Types', 'publik'),
                'parent_item'                => null,
                'parent_item_colon'          => null,
                'edit_item'                  => __('Solution Type bearbeiten', 'publik'),
                'update_item'                => __('Solution Type aktualisieren', 'publik'),
                'add_new_item'               => __('Solution Type hinzufügen', 'publik'),
                'new_item_name'              => __('Neuer Solution Type Name', 'publik'),
                'add_or_remove_items'        => __('Solution Type hinzufügen/entfernen', 'publik'),
                'not_found'                  => __('Kein Solution Type gefunden.', 'publik'),
                'menu_name'                  => __('Solution Types', 'publik'),
            ],
            'show_in_rest' => true,
            'has_archive' => false,
            'show_in_menu' => true,
            'hierarchical' => false
        ]
    );

    //used-aas-oss
    register_taxonomy(
        'used-aas-oss',
        'solutions-hub',
        [
            'labels' => [
                'name'                       => __('Used AAS OSS', 'publik'),
                'singular_name'              => __('Used AAS OSS', 'publik'),
                'all_items'                  => __('Alle Used AAS OSS', 'publik'),
                'parent_item'                => null,
                'parent_item_colon'          => null,
                'edit_item'                  => __('Used AAS OSS bearbeiten', 'publik'),
                'update_item'                => __('Used AAS OSS aktualisieren', 'publik'),
                'add_new_item'               => __('Used AAS OSS hinzufügen', 'publik'),
                'new_item_name'              => __('Neuer Used AAS OSS Name', 'publik'),
                'add_or_remove_items'        => __('Used AAS OSS hinzufügen/entfernen', 'publik'),
                'not_found'                  => __('Kein Used AAS OSS gefunden.', 'publik'),
                'menu_name'                  => __('Used AAS OSS', 'publik'),
            ],
            'show_in_rest' => true,
            'has_archive' => false,
            'show_in_menu' => true,
            'hierarchical' => false
        ]
    );

    //target-market
    register_taxonomy(
        'target-market',
        'solutions-hub',
        [
            'labels' => [
                'name'                       => __('Target Market', 'publik'),
                'singular_name'              => __('Target Market', 'publik'),
                'all_items'                  => __('Alle Target Markets', 'publik'),
                'parent_item'                => null,
                'parent_item_colon'          => null,
                'edit_item'                  => __('Target Market bearbeiten', 'publik'),
                'update_item'                => __('Target Market aktualisieren', 'publik'),
                'add_new_item'               => __('Target Market hinzufügen', 'publik'),
                'new_item_name'              => __('Neuer Target Market Name', 'publik'),
                'add_or_remove_items'        => __('Target Market hinzufügen/entfernen', 'publik'),
                'not_found'                  => __('Kein Target Market gefunden.', 'publik'),
                'menu_name'                  => __('Target Market', 'publik'),
            ],
            'show_in_rest' => true,
            'has_archive' => false,
            'show_in_menu' => true,
            'hierarchical' => false
        ]
    );

    //solution-applications
    register_taxonomy(
        'solution-applications',
        'solutions-hub',
        [
            'labels' => [
                'name'                       => __('Applications', 'publik'),
                'singular_name'              => __('Application', 'publik'),
            ],
            'show_in_rest' => true,
            'has_archive' => false,
            'show_in_menu' => true,
            'hierarchical' => false
        ]
    );

    //relevant-lifecycle
    register_taxonomy(
        'relevant-lifecycle',
        'solutions-hub',
        [
            'labels' => [
                'name'                       => __('Lifecycle', 'publik'),
                'singular_name'              => __('Lifecycle', 'publik'),
            ],
            'show_in_rest' => true,
            'has_archive' => false,
            'show_in_menu' => true,
            'hierarchical' => false
        ]
    );

    //used_submodels
    register_taxonomy(
        'used-submodels',
        'solutions-hub',
        [
            'labels' => [
                'name'                       => __('Submodels', 'publik'),
                'singular_name'              => __('Submodel', 'publik'),
            ],
            'show_in_rest' => true,
            'has_archive' => false,
            'show_in_menu' => true,
            'hierarchical' => false
        ]
    );

    add_submenu_page(
        'edit.php?post_type=solutions-hub',
        "Import Excel",
        "Importer",
        'manage_options',
        'solutions-hub-importer',
        'importer_cb',
        -1
    );

    add_filter('single_template', 'solutionhub_single_template');
    add_filter('archive_template', 'solutionhub_archive_template');
}
add_action('init', 'solutions_hub', 0);
function importer_cb()
{
?>
    <div class="wrap rwmb-settings-no-boxes rwmb-settings-tabs-default">
        <h1>Solutions Hub Excel Importer</h1>
    </div>

    <?php
    if (isset($_FILES["excel_file"])) {
        $path = $_FILES["excel_file"]["tmp_name"];
        file_put_contents(wp_upload_dir()["basedir"] . "/" . $_FILES["excel_file"]["name"], file_get_contents($path));
        $path = wp_upload_dir()["basedir"] . "/" . $_FILES["excel_file"]["name"];

        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $reader->setReadDataOnly(true);
        $spreadsheet = $reader->load($path);
        $worksheet = $spreadsheet->getActiveSheet();
        $rows = $worksheet->toArray();

        echo '<p>Mapping data for import...</p>';
        foreach ($rows as $i => $column) {
            if ($i == 0) continue;
            $vendor_name = $column[8];
            $vendor_address = $column[9];
            $solution_url = $column[10];
            $solution_name = $column[11];
            $solution_version = $column[12];
            $solution_description = $column[13];
            $solution_benefits = $column[14];
            $solution_type = $column[15];
            $solution_target_market = $column[16];
            $solution_application = $column[17];
            $solution_aop = $column[18];
            $solution_maturity_level = $column[19];
            $solution_references = $column[20];
            $solution_used_aas_standards = $column[21];
            $solution_used_aas_oos = $column[22];
            $solution_submodels = $column[23];
            $solution_relevant_lifecycle = $column[24];
            $solution_custom_post = [
                'post_type'     => 'solutions-hub',
                'post_title'    => $solution_name,
                'post_status'   => 'publish',
                'post_author'   => 1,
                'tax_input' => [
                    "solution-type" => str_replace(",", "&#44;", $solution_type),
                    "used-aas-oss" => implode(",", explode(";", str_replace(",", "&#44;", $solution_used_aas_oos))),
                    "aas-standards" => implode(",", explode(";", str_replace(",", "&#44;", $solution_used_aas_standards))),
                    "target-market" => implode(",", explode(";", str_replace(",", "&#44;", $solution_target_market))),
                    "solution-applications" => implode(",", explode(";", str_replace(",", "&#44;", $solution_application))),
                    "relevant-lifecycle" => implode(",", explode(";", str_replace(",", "&#44;", $solution_relevant_lifecycle))),
                    "used-submodels" => implode(",", explode(";", str_replace(",", "&#44;", $solution_submodels)))
                ],
                'meta_input'    => [
                    "vendor_title" => $vendor_name,
                    "description" => $solution_description,
                    "version" => $solution_version,
                    "solution_url" => $solution_url,
                    "adress" => $vendor_address,
                    "references" => $solution_references,
                    "benefits" => $solution_benefits,
                    "maturity_level" => substr($solution_maturity_level, 0, 1),
                    "operation" => $solution_aop
                ],
            ];
            if (!post_exists($solution_name)) {
                $response = wp_insert_post($solution_custom_post);
                echo "<p>($response) <b>$solution_name</b> von $vendor_name wurde hinzugefügt </p>";
            } else {
                echo "<p><b>$solution_name</b> von $vendor_name wurde nicht hinzugefügt, da bereits existiert </p>";
            }
        }
        unlink($path);
    } else {
    ?>
        <p>Bitte Datei Hochladen</p>
        <form method="post" enctype="multipart/form-data">
            <p>
                <input type="file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" name="excel_file" />
            </p>
            <p>
                Maximum Upload Size: <?= (getMaximumFileUploadSize() / 1048576) . "MB" ?>
            </p>
            <p>
                <input class="button button-primary" type="submit" value="Starte Import" />
            </p>
        </form>
    <?php
    }
    ?>
<?php
}
function solutionhub_single_template($single)
{
    global $post;
    /* Checks for single template by post type */
    if ($post->post_type == 'solutions-hub') {
        if (file_exists(__DIR__ . "/templates/single-solutionhub.php")) {
            return __DIR__ . "/templates/single-solutionhub.php";
        }
    }
    return $single;
}
function solutionhub_archive_template($archive)
{
    global $post;
    /* Checks for single template by post type */
    if ($post->post_type == 'solutions-hub') {
        if (file_exists(__DIR__ . "/templates/archive-solutionhub.php")) {
            return __DIR__ . "/templates/archive-solutionhub.php";
        }
    }
    return $archive;
}



function add_meta_boxes()
{
    add_meta_box(
        'website-id',
        'Solution Infos',
        'metaboxes_cb',
        'solutions-hub',
        'normal',
        'high',
        array(
            '__back_compat_meta_box' => true,
        )
    );
}
add_action('add_meta_boxes', 'add_meta_boxes');

function metaboxes_cb($post)
{
    wp_nonce_field(plugin_basename(__FILE__), 'meta_box_content_nonce');

    echo '<table class="form-table">
		<tbody>
			<tr>
				<th><label for="vendor_name">Vendor Name</label></th>
				<td><input type="text" id="vendor_name" name="vendor_title" value="' . get_post_meta($post->ID, 'vendor_title', true)  . '" class="regular-text"></td>
			</tr>
			<tr>
				<th><label for="description">Description</label></th>
				<td><textarea id="description" name="description" class="regular-text">' . get_post_meta($post->ID, 'description', true)  . '</textarea></td>
			</tr>
			<tr>
				<th><label for="maturity_level">Maturity Level</label></th>
				<td>
                    <select id="maturity_level" name="maturity_level">
                        <option ' . ((get_post_meta($post->ID, 'maturity_level', true) == 1) ? "selected" : "") . ' value="1">Concept phase</option>
                        <option ' . ((get_post_meta($post->ID, 'maturity_level', true) == 2) ? "selected" : "") . ' value="2">Proof of concept</option>
                        <option ' . ((get_post_meta($post->ID, 'maturity_level', true) == 3) ? "selected" : "") . ' value="3">Prototype</option>
                        <option ' . ((get_post_meta($post->ID, 'maturity_level', true) == 4) ? "selected" : "") . ' value="4">Industry ready</option>
                    </select>
                </td>
			</tr>
			<tr>
				<th><label for="version">Version</label></th>
				<td><input type="text" id="version" name="version" value="' . get_post_meta($post->ID, 'version', true)  . '" class="regular-text"></td>
			</tr>
			<tr>
				<th><label for="solution_url">Solution URL</label></th>
				<td><input type="text" id="solution_url" name="solution_url" value="' . get_post_meta($post->ID, 'solution_url', true)  . '" class="regular-text"></td>
			</tr>
			<tr>
				<th><label for="operation">Area of Operation</label></th>
				<td><textarea id="operation" name="operation" class="regular-text">' . get_post_meta($post->ID, 'operation', true)  . '</textarea></td>
			</tr>
			<tr>
				<th><label for="adress">Address</label></th>
				<td><textarea id="adress" name="adress" class="regular-text">' . get_post_meta($post->ID, 'adress', true)  . '</textarea></td>
			</tr>
			<tr>
				<th><label for="references">References</label></th>
				<td><textarea id="references" name="references" class="regular-text">' . get_post_meta($post->ID, 'references', true)  . '</textarea></td>
			</tr>
			<tr>
				<th><label for="benefits">Customer Benefits</label></th>
				<td><textarea id="benefits" name="benefits" class="regular-text">' . get_post_meta($post->ID, 'benefits', true)  . '</textarea></td>
			</tr>
			<tr>
				<th><label for="certified">Is AAS Certified?</label></th>
				<td><input type="checkbox" id="certified" name="certified" ' . (get_post_meta($post->ID, 'certified', true) == "on" ? "checked" : "")  . ' class="regular-text"></td>
			</tr>
		</tbody>
	</table>';
}

add_action('save_post', 'meta_box_save');
function meta_box_save($post_id)
{
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return;

    if (isset($_POST["solutions-hub"])) {
        if ('page' == $_POST['solutions-hub']) {
            if (!current_user_can('edit_page', $post_id))
                return;
        } else {
            if (!current_user_can('edit_post', $post_id))
                return;
        }
    }

    $fields = [
        'vendor_title',
        'description',
        'version',
        'adress',
        'references',
        'benefits',
        'solution_url',
        'maturity_level',
        'certified',
        'operation'
    ];
    foreach ($fields as $field) {
        if (array_key_exists($field, $_POST)) {
            update_post_meta($post_id, $field, $_POST[$field]);
        }
    }
}


/**
 * This function returns the maximum files size that can be uploaded 
 * in PHP
 * @returns int File size in bytes
 **/
function getMaximumFileUploadSize()
{
    return min(convertPHPSizeToBytes(ini_get('post_max_size')), convertPHPSizeToBytes(ini_get('upload_max_filesize')));
}

/**
 * This function transforms the php.ini notation for numbers (like '2M') to an integer (2*1024*1024 in this case)
 * 
 * @param string $sSize
 * @return integer The value in bytes
 */
function convertPHPSizeToBytes($sSize)
{
    //
    $sSuffix = strtoupper(substr($sSize, -1));
    if (!in_array($sSuffix, array('P', 'T', 'G', 'M', 'K'))) {
        return (int)$sSize;
    }
    $iValue = substr($sSize, 0, -1);
    switch ($sSuffix) {
        case 'P':
            $iValue *= 1024;
            // Fallthrough intended
        case 'T':
            $iValue *= 1024;
            // Fallthrough intended
        case 'G':
            $iValue *= 1024;
            // Fallthrough intended
        case 'M':
            $iValue *= 1024;
            // Fallthrough intended
        case 'K':
            $iValue *= 1024;
            break;
    }
    return (int)$iValue;
}


/**
 * Get the upload URL/path in right way (works with SSL).
 *
 * @param $param string "basedir" or "baseurl"
 * @return string
 */
function fn_get_upload_dir_var($param, $subfolder = '')
{
    $upload_dir = wp_upload_dir();
    $url = $upload_dir[$param];

    if ($param === 'baseurl' && is_ssl()) {
        $url = str_replace('http://', 'https://', $url);
    }

    return $url . $subfolder;
}
