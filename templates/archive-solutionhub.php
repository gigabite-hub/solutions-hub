<?php get_header(); ?>
<script type="text/javascript" src="/wp-content/plugins/solutions-hub/assets/filterizr.min.js"></script>
<style>
    .dropdown {
        transition: 0.2s all;
        z-index: 2;
    }

    .solution-wrapper {
        overflow: hidden;
    }

    .solution-wrapper .content {
        max-height: 0;
    }

    .filter-wrapper {
        max-height: 300px;
        overflow-y: scroll;
    }


    .solution-wrapper .expand-icon {
        padding-right: 10px;
    }

    .solution-wrapper .expand-icon svg {
        transition: 0.2s all;
    }

    .solution-wrapper.triggered .expand-icon svg {
        transform: rotate(-180deg);
    }

    .solution-wrapper.triggered {
        border-top: 2px solid rgb(0, 40, 205);
        --tw-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        -webkit-box-shadow: 0 0 transparent, 0 0 transparent, var(--tw-shadow);
        box-shadow: 0 0 transparent, 0 0 transparent, var(--tw-shadow);
    }

    .solution-wrapper.triggered .content {
        max-height: 100%;
    }

    .solution-wrapper.triggered {
        z-index: 19;
    }

    .dropdown.toggled .toggle {
        background-color: white;
        border-bottom-color: white;
        z-index: 20;
    }

    .dropdown .toggle:hover {
        background-color: white;
        transition: 0.2s all;
    }

    .dropdown svg {
        transition: 0.2s all;
        margin-left: 5px;
    }

    .toggled {
        background-color: white;
        z-index: 30;
    }

    .toggled p {
        color: rgb(0, 40, 205) !important;
    }

    .cut-text {
        text-overflow: ellipsis;
        overflow: hidden;
        white-space: nowrap;
    }

    .toggled [data-target] {
        background-color: white;
        box-shadow: 0 0 20px #00000026;
    }

    .toggled [data-target] span:hover {
        background-color: rgba(0, 0, 0, 0.05);
    }

    .toggled [data-target] .active {
        color: rgb(0, 40, 205) !important;
        background-color: rgba(0, 0, 0, 0.05);
    }

    .row-one {
        width: 20%;
    }

    .row-two {
        width: 80%;
    }

    .toggled [data-target] span::after {
        content: "";
        position: absolute;
        right: 10px;
        width: 20px;
        height: 20px;
        margin-top: 3px;
        border-radius: 3px;
        border: 1px solid rgba(0, 0, 0, 0.5);
    }

    .toggled [data-target] .active::after {
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='13.036' height='9.721' viewBox='0 0 13.036 9.721'%3E%3Cpath id='Icon_awesome-check' data-name='Icon awesome-check' d='M4.428,14.108.191,9.871a.652.652,0,0,1,0-.922l.922-.922a.652.652,0,0,1,.922,0l2.854,2.854L11,4.768a.652.652,0,0,1,.922,0l.922.922a.652.652,0,0,1,0,.922l-7.5,7.5A.652.652,0,0,1,4.428,14.108Z' transform='translate(0 -4.577)' fill='%23ff6200'/%3E%3C/svg%3E%0A");
        background-position: center;
        background-size: auto;
        background-repeat: no-repeat;
    }

    .toggled svg {
        transform: rotate(-180deg);

    }
</style>
<?php
$image_url = "https://industrialdigitaltwin.org/wp-content/uploads/2021/09/2021-09-21_IDTA_Content-Hub-Header_01.jpg";


global $post;
$args = array(
    'post_type'           => 'solutions-hub',
    'posts_per_page'      => 9999999,
    'post_status'         => 'publish',
    'no_found_rows'       => true,
);

$query        = new WP_Query;
$all_solutions = $query->query($args);

$solution_type_filter = get_terms(array(
    'taxonomy'   => 'solution-type',
    'hide_empty' => false,
));
$solution_type_filter_string = wp_list_pluck($solution_type_filter, 'term_id');
$solution_type_filter_name = wp_list_pluck($solution_type_filter, 'name');

$aas_standards_filter = get_terms(array(
    'taxonomy'   => 'aas-standards',
    'hide_empty' => false,
));
$aas_standards_filter_string = wp_list_pluck($aas_standards_filter, 'term_id');
$aas_standards_filter_name = wp_list_pluck($aas_standards_filter, 'name');

$target_market_filter = get_terms(array(
    'taxonomy'   => 'target-market',
    'hide_empty' => false,
));
$target_market_filter_string = wp_list_pluck($target_market_filter, 'term_id');
$target_market_filter_name = wp_list_pluck($target_market_filter, 'name');

$lifecycle_filter = get_terms(array(
    'taxonomy'   => 'relevant-lifecycle',
    'hide_empty' => false,
));
$lifecycle_filter_string = wp_list_pluck($lifecycle_filter, 'term_id');
$lifecycle_filter_name = wp_list_pluck($lifecycle_filter, 'name');

$submodel_filter = get_terms(array(
    'taxonomy'   => 'used-submodels',
    'hide_empty' => false,
));
$submodel_filter_string = wp_list_pluck($submodel_filter, 'term_id');
$submodel_filter_name = wp_list_pluck($submodel_filter, 'name');

$solution_applications_filter = get_terms(array(
    'taxonomy'   => 'solution-applications',
    'hide_empty' => false,
));
$solution_applications_filter_string = wp_list_pluck($solution_applications_filter, 'term_id');
$solution_applications_filter_name = wp_list_pluck($solution_applications_filter, 'name');


function maturity_level_render($level)
{
    $classes = "";
    $icon = "";
    $name = "";
    $style = "";

    switch ($level) {
        case 1:
            $name = "Concept phase";
            $style = "color:#8B8B8B;";
            break;
        case 2:
            $name = "PoC / Demo";
            $style = "color:#537CA1;";
            break;
        case 3:
            $name = "Prototype";
            $style = "color:#FFD258;";
            break;
        case 4:
            $name = "Industry ready";
            $style = "color:#6BC732;";
            break;
    }

    return '
    <p class="text-sm font-bold' . $classes . '" style="' . $style . '">
    ' . $name . '
    </p>
    ';
}
?>
<style>
    .select-none {
        user-select: none;
        -webkit-user-select: none;
    }
</style>

<div class="bg-white w-full">
    <main class="w-full wysiwyg">
        <section class="w-full bg-gray-300 pb-16 wp-stage">
            <div class="w-full h-stage relative z-0">
                <div id="canvas-background" class="canvas-background"></div>
                <canvas id="stage-canvas"></canvas>
                <div class="w-full h-stage bg-center bg-cover bg-no-repeat" style="background-image: url(<?= $image_url; ?>)"></div>
            </div>
            <div class="w-full max-w-contentMd mx-auto relative -mt-32 bg-white p-8 md:p-16 shadow-xl z-10 overflow-hidden">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-8 relative z-10">
                    <div class="">
                        <div class="w-full mb-8">
                            <?php
                            if (function_exists('yoast_breadcrumb')) {
                                echo yoast_breadcrumb('<p class="text-xs breadcrumbs" id="breadcrumbs">', '</p>');
                            }; ?>
                        </div>
                        <h1 class="font-regular text-blue-500 leading-tight">
                            <?= (get_site_lang_string() == "DE") ? "AAS Solutions Hub" : "AAS Solutions Hub" ?>
                        </h1>
                    </div>
                    <div class="md:pt-6 md:pl-4 text-gray-700">
                        <?=
                        (get_site_lang_string() == "DE")
                            ? "Spezifikationen definieren Softwarestruktur, Schnittstelle und die Semantik der Verwaltungsschale und bilden damit die Grundlage für den standardisierten Digitalen Zwilling. Alle Spezifikationen für das Informationsmodell der Verwaltungsschale sind hier zu finden. "
                            : "Specifications define the software structure, interface and semantics of the Asset Administration Shell and thus create the basis for the standardized Digital Twin. All specifications for the Asset Administration Shell information model can be found here."
                        ?>
                    </div>
                </div>
            </div>
        </section>
        <div class="w-full bg-gray-300 pt-8 pb-16">
            <div class="w-full max-w-contentMd mx-auto relative">
                <div class="px-4">
                    <h3 class="text-gray-800">Filter</h3>
                    <div id="filter" class="flex gap-2">
                        <div id="solution-type-filter" class="relative w-auto dropdown">
                            <p id="toggle_solution-type" class="relative toggle p-2 border text-sm text-gray-700 border-gray-700 flex items-center" style="border-width:1px;cursor:pointer;position:relative;">

                                <span class="sorted-text text-xs p-2 absolute hidden" style="top: -10px;left: 0;background-color: #ff500f;border-radius: 100%;color: white;font-weight: bold;height:20px;width:20px;justify-content:center;align-items:center;">0</span>
                                Solution Type
                                <span style="padding-left:4px;padding-top:3px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="15.335" height="7.599" viewBox="0 0 15.335 7.599">
                                        <g id="Gruppe_5153" data-name="Gruppe 5153" transform="translate(648.501 1639.085) rotate(180)">
                                            <path id="Pfad_1" data-name="Pfad 1" d="M634.574,1637.677l6.259-5.19,6.259,5.19" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                                        </g>
                                    </svg>
                                </span>
                            </p>
                            <div data-target="toggle_solution-type" class="filter-wrapper absolute hidden flex flex-col bg-gray-300 border border-gray-700 z-10" style="border-width: 1px;top:calc(100% - 2px);width: max-content;">
                                <?php
                                foreach ($solution_type_filter_string as $key => $term_id) :
                                ?>
                                    <span class="text-sm pr-12 p-2 control" data-multifilter="<?= $term_id ?>" style="cursor:pointer;">
                                        <?= $solution_type_filter_name[$key] ?>
                                    </span>
                                <?php
                                endforeach;
                                ?>
                            </div>
                        </div>
                        <div id="maturity-level-filter" class="relative w-auto dropdown">

                            <p id="toggle_maturity-level" class="relative toggle p-2 border text-sm text-gray-700 border-gray-700 flex items-center" style="border-width:1px;cursor:pointer;position:relative;">

                                <span class="sorted-text text-xs p-2 absolute hidden" style="top: -10px;left: 0;background-color: #ff500f;border-radius: 100%;color: white;font-weight: bold;height:20px;width:20px;justify-content:center;align-items:center;">0</span>
                                Maturity Level
                                <span style="padding-left:4px;padding-top:3px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="15.335" height="7.599" viewBox="0 0 15.335 7.599">
                                        <g id="Gruppe_5153" data-name="Gruppe 5153" transform="translate(648.501 1639.085) rotate(180)">
                                            <path id="Pfad_1" data-name="Pfad 1" d="M634.574,1637.677l6.259-5.19,6.259,5.19" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                                        </g>
                                    </svg>
                                </span>
                            </p>
                            <div data-target="toggle_maturity-level" class="filter-wrapper absolute hidden flex flex-col bg-gray-300 border border-gray-700 z-10" style="border-width: 1px;top:calc(100% - 2px);width: max-content;">
                                <span class="text-sm pr-12 p-2 control" data-multifilter="ml_1" style="cursor:pointer;">
                                    Concept phase
                                </span>
                                <span class="text-sm pr-12 p-2 control" data-multifilter="ml_2" style="cursor:pointer;">
                                    Proof of concept
                                </span>
                                <span class="text-sm pr-12 p-2 control" data-multifilter="ml_3" style="cursor:pointer;">
                                    Prototype
                                </span>
                                <span class="text-sm pr-12 p-2 control" data-multifilter="ml_4" style="cursor:pointer;">
                                    Industry ready
                                </span>
                            </div>
                        </div>
                        <div id="target-market-filter" class="relative w-auto dropdown">
                            <p id="toggle_target-market" class="relative toggle p-2 border text-sm text-gray-700 border-gray-700 flex items-center" style="border-width:1px;cursor:pointer;position:relative;">

                                <span class="sorted-text text-xs p-2 absolute hidden" style="top: -10px;left: 0;background-color: #ff500f;border-radius: 100%;color: white;font-weight: bold;height:20px;width:20px;justify-content:center;align-items:center;">0</span>
                                Target market
                                <span style="padding-left:4px;padding-top:3px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="15.335" height="7.599" viewBox="0 0 15.335 7.599">
                                        <g id="Gruppe_5153" data-name="Gruppe 5153" transform="translate(648.501 1639.085) rotate(180)">
                                            <path id="Pfad_1" data-name="Pfad 1" d="M634.574,1637.677l6.259-5.19,6.259,5.19" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                                        </g>
                                    </svg>
                                </span>
                            </p>
                            <div data-target="toggle_target-market" class="filter-wrapper absolute hidden flex flex-col bg-gray-300 border border-gray-700 z-10" style="border-width: 1px;top:calc(100% - 2px);width: max-content;">
                                <?php
                                foreach ($target_market_filter_string as $key => $term_id) :
                                ?>
                                    <span class="text-sm pr-12 p-2 control" data-multifilter="<?= $term_id ?>" style="cursor:pointer;">
                                        <?= $target_market_filter_name[$key] ?>
                                    </span>
                                <?php
                                endforeach;
                                ?>
                            </div>
                        </div>
                        <div id="aas-standards-filter" class="relative w-auto dropdown">
                            <p id="toggle_aas-standards" class="relative toggle p-2 border text-sm text-gray-700 border-gray-700 flex items-center" style="border-width:1px;cursor:pointer;position:relative;">
                                <span class="sorted-text text-xs p-2 absolute hidden" style="top: -10px;left: 0;background-color: #ff500f;border-radius: 100%;color: white;font-weight: bold;height:20px;width:20px;justify-content:center;align-items:center;">0</span>
                                AAS Standards
                                <span style="padding-left:4px;padding-top:3px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="15.335" height="7.599" viewBox="0 0 15.335 7.599">
                                        <g id="Gruppe_5153" data-name="Gruppe 5153" transform="translate(648.501 1639.085) rotate(180)">
                                            <path id="Pfad_1" data-name="Pfad 1" d="M634.574,1637.677l6.259-5.19,6.259,5.19" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                                        </g>
                                    </svg>
                                </span>
                            </p>
                            <div data-target="toggle_aas-standards" class="filter-wrapper absolute hidden flex flex-col bg-gray-300 border border-gray-700 z-10" style="border-width: 1px;top:calc(100% - 2px);width: max-content;">
                                <?php
                                foreach ($aas_standards_filter_string as $key => $term_id) :
                                ?>
                                    <span class="text-sm pr-12 p-2 control" data-multifilter="<?= $term_id ?>" style="cursor:pointer;">
                                        <?= $aas_standards_filter_name[$key] ?>
                                    </span>
                                <?php
                                endforeach;
                                ?>
                            </div>
                        </div>
                        <div id="lifecycle-filter" class="relative w-auto dropdown">
                            <p id="toggle_lifecycle" class="relative toggle p-2 border text-sm text-gray-700 border-gray-700 flex items-center" style="border-width:1px;cursor:pointer;position:relative;">

                                <span class="sorted-text text-xs p-2 absolute hidden" style="top: -10px;left: 0;background-color: #ff500f;border-radius: 100%;color: white;font-weight: bold;height:20px;width:20px;justify-content:center;align-items:center;">0</span>
                                Lifecyclephases
                                <span style="padding-left:4px;padding-top:3px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="15.335" height="7.599" viewBox="0 0 15.335 7.599">
                                        <g id="Gruppe_5153" data-name="Gruppe 5153" transform="translate(648.501 1639.085) rotate(180)">
                                            <path id="Pfad_1" data-name="Pfad 1" d="M634.574,1637.677l6.259-5.19,6.259,5.19" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                                        </g>
                                    </svg>
                                </span>
                            </p>
                            <div data-target="toggle_lifecycle" class="filter-wrapper absolute hidden flex flex-col bg-gray-300 border border-gray-700 z-10" style="border-width: 1px;top:calc(100% - 2px);width: max-content;">
                                <?php
                                foreach ($lifecycle_filter_string as $key => $term_id) :
                                ?>
                                    <span class="text-sm pr-12 p-2 control" data-multifilter="<?= $term_id ?>" style="cursor:pointer;">
                                        <?= $lifecycle_filter_name[$key] ?>
                                    </span>
                                <?php
                                endforeach;
                                ?>
                            </div>
                        </div>
                        <div id="submodels-filter" class="relative w-auto dropdown">
                            <p id="toggle_submodels" class="relative toggle p-2 border text-sm text-gray-700 border-gray-700 flex items-center" style="border-width:1px;cursor:pointer;position:relative;">

                                <span class="sorted-text text-xs p-2 absolute hidden" style="top: -10px;left: 0;background-color: #ff500f;border-radius: 100%;color: white;font-weight: bold;height:20px;width:20px;justify-content:center;align-items:center;">0</span>
                                Submodels
                                <span style="padding-left:4px;padding-top:3px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="15.335" height="7.599" viewBox="0 0 15.335 7.599">
                                        <g id="Gruppe_5153" data-name="Gruppe 5153" transform="translate(648.501 1639.085) rotate(180)">
                                            <path id="Pfad_1" data-name="Pfad 1" d="M634.574,1637.677l6.259-5.19,6.259,5.19" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                                        </g>
                                    </svg>
                                </span>
                            </p>
                            <div data-target="toggle_submodels" class="filter-wrapper absolute hidden flex flex-col bg-gray-300 border border-gray-700 z-10" style="border-width: 1px;top:calc(100% - 2px);width: max-content;">
                                <?php
                                foreach ($submodel_filter_string as $key => $term_id) :
                                ?>
                                    <span class="text-sm pr-12 p-2 control" data-multifilter="<?= $term_id ?>" style="cursor:pointer;">
                                        <?= $submodel_filter_name[$key] ?>
                                    </span>
                                <?php
                                endforeach;
                                ?>
                            </div>
                        </div>
                        <div id="applications-filter" class="relative w-auto dropdown">
                            <p id="toggle_applications" class="relative toggle p-2 border text-sm text-gray-700 border-gray-700 flex items-center" style="border-width:1px;cursor:pointer;position:relative;">

                                <span class="sorted-text text-xs p-2 absolute hidden" style="top: -10px;left: 0;background-color: #ff500f;border-radius: 100%;color: white;font-weight: bold;height:20px;width:20px;justify-content:center;align-items:center;">0</span>
                                Applications
                                <span style="padding-left:4px;padding-top:3px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="15.335" height="7.599" viewBox="0 0 15.335 7.599">
                                        <g id="Gruppe_5153" data-name="Gruppe 5153" transform="translate(648.501 1639.085) rotate(180)">
                                            <path id="Pfad_1" data-name="Pfad 1" d="M634.574,1637.677l6.259-5.19,6.259,5.19" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                                        </g>
                                    </svg>
                                </span>
                            </p>
                            <div data-target="toggle_applications" class="filter-wrapper absolute hidden flex flex-col bg-gray-300 border border-gray-700 z-10" style="border-width: 1px;top:calc(100% - 2px);width: max-content;">
                                <?php
                                foreach ($solution_applications_filter_string as $key => $term_id) :
                                ?>
                                    <span class="text-sm pr-12 p-2 control" data-multifilter="<?= $term_id ?>" style="cursor:pointer;">
                                        <?= $solution_applications_filter_name[$key] ?>
                                    </span>
                                <?php
                                endforeach;
                                ?>
                            </div>
                        </div>
                        <div class="flex items-center border border-gray-700 gap-2" style="border-bottom-width: 1px !important;margin-left:auto;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="23.809" height="23.815" viewBox="0 0 23.809 23.815">
                                <path id="Icon_ionic-ios-search" data-name="Icon ionic-ios-search" d="M28.029,26.584,21.408,19.9a9.437,9.437,0,1,0-1.432,1.451l6.578,6.64a1.019,1.019,0,0,0,1.438.037A1.026,1.026,0,0,0,28.029,26.584ZM13.992,21.432a7.451,7.451,0,1,1,5.27-2.182A7.405,7.405,0,0,1,13.992,21.432Z" transform="translate(-4.5 -4.493)" fill="#8b8b8b" />
                            </svg>
                            <input class="text-gray-700 control" style="background:none;" type="text" name="search" placeholder="Search..." class="" data-search />
                        </div>
                    </div>
                </div>
                <!-- New Design -->
                <main class="solution-container idt-solution">
                    <?php foreach ($all_solutions as $post) : ?>
                        <?php
                        $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');

                        $solution_type_list = get_the_terms($post->ID, 'solution-type');
                        $solution_type_string = join(', ', wp_list_pluck($solution_type_list, 'name'));

                        $ass_standard_list = get_the_terms($post->ID, 'aas-standards');
                        $ass_standard_string = join(', ', wp_list_pluck($ass_standard_list, 'name'));

                        $target_market_list = get_the_terms($post->ID, 'target-market');
                        $target_market_string = join(', ', wp_list_pluck($target_market_list, 'name'));

                        $used_oss_list = get_the_terms($post->ID, 'used-aas-oss');
                        $used_oss_string = join(', ', wp_list_pluck($used_oss_list, 'name'));

                        $lifecycle_list = get_the_terms($post->ID, 'relevant-lifecycle');
                        $lifecycle_string = join(', ', wp_list_pluck($lifecycle_list, 'name'));

                        $submodel_list = get_the_terms($post->ID, 'used-submodels');
                        $submodel_string = join(', ', wp_list_pluck($submodel_list, 'name'));

                        $application_list = get_the_terms($post->ID, 'solution-applications');
                        $application_string = join(', ', wp_list_pluck($application_list, 'name'));

                        $merged_filter_list = array_merge(
                            wp_list_pluck($ass_standard_list, 'term_id'),
                            wp_list_pluck($solution_type_list, 'term_id'),
                            wp_list_pluck($target_market_list, 'term_id'),
                            wp_list_pluck($used_oss_list, 'term_id'),
                            wp_list_pluck($lifecycle_list, 'term_id'),
                            wp_list_pluck($submodel_list, 'term_id'),
                            wp_list_pluck($application_list, 'term_id'),
                            ["ml_" . get_post_meta($post->ID, 'maturity_level', true)],
                        );

                        ?>
                        <div data-category="<?= join(',', $merged_filter_list) ?>" class="solution-wrapper custom-solution-wrapper bg-white hover-shadow transition">
                            <div class="header custom-header" style="cursor:pointer;">
                                <div class="select-none custom-image-container" style="width:250px;max-height:82px;  padding: 5px;text-align: center;">
                                    <img class="h-full" src="<?= $image[0] ?? "https://aharvey.com/wp-content/uploads/2018/03/bg-placeholder.jpg" ?>" <?= (!isset($img[0])) ? "style=\"object-fit: cover;width: 100%;\"" : "" ?> />
                                </div>
                                <div class="custom-vendor-container" style="width:210px;">
                                    <p class="idt-label">Vendor Name</p>
                                    <p class="text-sm cut-text"><?= get_post_meta($post->ID, 'vendor_title', true) ?></p>
                                </div>
                                <div class="custom-solution-name-container" style="width:225px;">
                                    <p class="idt-label">Solution Name</p>
                                    <p class="text-sm font-bold cut-text"><?= the_title() ?></p>
                                </div>
                                <div class="custom-solution-type-container" style="width:150px;">
                                    <p class="idt-label">Solution Type</p>
                                    <p class="text-sm font-bold cut-text"><?= $solution_type_string ?></p>
                                </div>
                                <div class="">
                                    <p class="idt-label">Maturity Level</p>
                                    <?= maturity_level_render(get_post_meta($post->ID, 'maturity_level', true)) ?>
                                </div>
                                <div class="custom-icons-container" style="margin-left: auto; gap:15px;">
                                    <?php if (get_post_meta($post->ID, 'certified', true) == "on") : ?>
                                        <div class="custom-certified-icon">
                                            <svg id="Gruppe_5274" data-name="Gruppe 5274" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="45.434" height="45.43" viewBox="0 0 45.434 45.43">
                                                <defs>
                                                    <clipPath id="clip-path">
                                                        <rect id="Rechteck_210" data-name="Rechteck 210" width="45.434" height="45.43" fill="none" />
                                                    </clipPath>
                                                </defs>
                                                <path id="Pfad_3" data-name="Pfad 3" d="M45.431,22.725l0,0v-.008ZM22.728,0,18.715,2.538l-4.679-.814L11.3,5.6,6.664,6.648,5.617,11.281,1.736,14.017l.8,4.679L0,22.705l2.538,4.013L1.724,31.4,5.6,34.138,6.648,38.77l4.632,1.047L14.017,43.7l4.679-.8,4.013,2.534,4.013-2.538,4.679.813,2.74-3.877,4.632-1.047,1.047-4.632,3.88-2.736-.8-4.679,2.532-4.009L42.9,18.715l.814-4.679L39.832,11.3,38.785,6.664,34.153,5.617,31.417,1.736l-4.679.8Z" fill="#0028cd" />
                                                <g id="Gruppe_5267" data-name="Gruppe 5267" transform="translate(0 0)">
                                                    <g id="Gruppe_5266" data-name="Gruppe 5266" clip-path="url(#clip-path)">
                                                        <path id="Pfad_4" data-name="Pfad 4" d="M53.411,54.422a.791.791,0,0,1-.779.8H52.15a.789.789,0,0,1-.779-.8V53.391a.791.791,0,0,0-.234-.568l-.611-.619a.765.765,0,0,0-.549-.23H39.39a.771.771,0,0,0-.572.257l-.533.6a.815.815,0,0,0-.206.541v1.055a.791.791,0,0,1-.778.8h-.522a.789.789,0,0,1-.779-.8V46.415a.818.818,0,0,1,.206-.545l1.257-1.394a.771.771,0,0,1,.572-.257h13.34a.771.771,0,0,1,.572.257L53.2,45.87a.818.818,0,0,1,.206.545Z" transform="translate(-21.987 -27.007)" fill="#fff" />
                                                        <path id="Pfad_5" data-name="Pfad 5" d="M33.426,49.318A15.891,15.891,0,1,1,49.318,33.426,15.91,15.91,0,0,1,33.426,49.318m0-30.144A14.252,14.252,0,1,0,47.679,33.426,14.269,14.269,0,0,0,33.426,19.174" transform="translate(-10.709 -10.709)" fill="#fff" />
                                                        <path id="Pfad_6" data-name="Pfad 6" d="M77.843,68.4l-9.459,9.844L64.06,74.005,73.7,64.27Z" transform="translate(-39.124 -39.253)" fill="#0028cd" />
                                                        <path id="Pfad_7" data-name="Pfad 7" d="M70.812,81.318l-3.4-3.3,1.211-1.245,2.162,2.1,5.961-6.046,1.236,1.219Z" transform="translate(-41.173 -44.478)" fill="#ff500f" />
                                                    </g>
                                                </g>
                                            </svg>
                                        </div>
                                    <?php endif; ?>
                                    <?php
                                    $url = get_post_meta($post->ID, 'solution_url', true);
                                    if ($url != null && $url  != "") {
                                    ?>
                                        <a target="_blank" href="<?= $url ?>" class="custom-external-link">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16.938" height="16.938" viewBox="0 0 16.938 16.938">
                                                <path id="Icon_open-external-link" data-name="Icon open-external-link" d="M0,0V16.938H16.938V12.7H14.82V14.82H2.117V2.117H4.234V0ZM8.469,0l3.176,3.176L6.352,8.469l2.117,2.117,5.293-5.293,3.176,3.176V0Z" fill="#0729b2" />
                                            </svg>
                                        </a>
                                    <?php } ?>
                                    <div class="custom-expand-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="19.422" height="10.711" viewBox="0 0 19.422 10.711">
                                            <g id="Gruppe_1" data-name="Gruppe 1" transform="translate(652.582 1642.198) rotate(180)">
                                                <path id="Pfad_1" data-name="Pfad 1" d="M634.574,1640.783l8.3-8.3,8.3,8.3" fill="none" stroke="#0729b2" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                                            </g>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="content custom-content">
                                <div class="custom-row-one">
                                    <div>
                                        <p class="idt-content-label">Solution Name</p>
                                        <p class="idt-dynmic-value"><?= the_title() ?></p>
                                    </div>
                                    <div>
                                        <p class="idt-content-label">Address</p>
                                        <p class="idt-dynmic-value"><?= nl2br(get_post_meta($post->ID, 'adress', true)) ?></p>
                                    </div>
                                    <div>
                                        <p class="idt-content-label">Version of Solution</p>
                                        <p class="idt-dynmic-value"><?= get_post_meta($post->ID, 'version', true) ?></p>
                                    </div>
                                    <div>
                                        <p class="idt-content-label">Used AAS Standards</p>
                                        <p class="idt-dynmic-value"><?= $ass_standard_string ?></p>
                                    </div>
                                </div>
                                <div class="custom-row-two">
                                    <div>
                                        <p class="idt-content-label">Description</p>
                                        <p class="idt-dynmic-value"><?= nl2br(get_post_meta($post->ID, 'description', true)) ?></p>
                                        <hr class="idta-divider" />
                                    </div>
                                    <div>
                                        <p class="idt-content-label">Customer Benefits</p>
                                        <p class="idt-dynamic-value"><?= nl2br(get_post_meta($post->ID, 'benefits', true)) ?></p>
                                        <hr class="idta-divider" />
                                    </div>
                                    <div>
                                        <p class="idt-content-label">Target market</p>
                                        <p class="idt-dynamic-value"><?= $target_market_string ?></p>
                                        <hr class="idta-divider" />
                                    </div>
                                    <div>
                                        <p class="idt-content-label">Submodels</p>
                                        <p class="idt-dynamic-value"><?= $submodel_string ?></p>
                                        <hr class="idta-divider" />
                                    </div>
                                    <div>
                                        <p class="idt-content-label">Area of Operation</p>
                                        <p class="idt-dynamic-value"><?= get_post_meta($post->ID, 'operation', true) ?></p>
                                        <hr class="idta-divider" />
                                    </div>
                                    <div>
                                        <p class="idt-content-label">Applications</p>
                                        <p class="idt-dynamic-value"><?= $application_string ?></p>
                                        <hr class="idta-divider" />
                                    </div>
                                    <div>
                                        <p class="idt-content-label">Lifecycles</p>
                                        <p class="idt-dynamic-value"><?= $lifecycle_string ?></p>
                                        <hr class="idta-divider" />
                                    </div>
                                    <div>
                                        <p class="idt-content-label">Used AAS open source software</p>
                                        <p class="idt-dynamic-value"><?= $used_oss_string ?></p>
                                        <hr class="idta-divider" />
                                    </div>
                                    <div>
                                        <p class="idt-content-label">References</p>
                                        <p class="idt-dynamic-value"><?= get_post_meta($post->ID, 'references', true) ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </main>
          
                <!-- New Design -->

                <main class="flex flex-col gap-2 solution-container">
                    <?php
                    foreach ($all_solutions as $post) :  ?>
                        <?php
                        $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');

                        $solution_type_list = get_the_terms($post->ID, 'solution-type');
                        $solution_type_string = join(', ', wp_list_pluck($solution_type_list, 'name'));

                        $ass_standard_list = get_the_terms($post->ID, 'aas-standards');
                        $ass_standard_string = join(', ', wp_list_pluck($ass_standard_list, 'name'));

                        $target_market_list = get_the_terms($post->ID, 'target-market');
                        $target_market_string = join(', ', wp_list_pluck($target_market_list, 'name'));

                        $used_oss_list = get_the_terms($post->ID, 'used-aas-oss');
                        $used_oss_string = join(', ', wp_list_pluck($used_oss_list, 'name'));

                        $lifecycle_list = get_the_terms($post->ID, 'relevant-lifecycle');
                        $lifecycle_string = join(', ', wp_list_pluck($lifecycle_list, 'name'));

                        $submodel_list = get_the_terms($post->ID, 'used-submodels');
                        $submodel_string = join(', ', wp_list_pluck($submodel_list, 'name'));

                        $application_list = get_the_terms($post->ID, 'solution-applications');
                        $application_string = join(', ', wp_list_pluck($application_list, 'name'));

                        $merged_filter_list = array_merge(
                            wp_list_pluck($ass_standard_list, 'term_id'),
                            wp_list_pluck($solution_type_list, 'term_id'),
                            wp_list_pluck($target_market_list, 'term_id'),
                            wp_list_pluck($used_oss_list, 'term_id'),
                            wp_list_pluck($lifecycle_list, 'term_id'),
                            wp_list_pluck($submodel_list, 'term_id'),
                            wp_list_pluck($application_list, 'term_id'),
                            ["ml_" . get_post_meta($post->ID, 'maturity_level', true)],
                        );

                        ?>
                        <div data-category="<?= join(',', $merged_filter_list) ?>" class="solution-wrapper w-full bg-white hover:shadow-xl transition">
                            <div class="header p-4 flex text-gray-800 gap-8" style="cursor:pointer;">
                                <div class="h-auto flex justify-center select-none" style="width:250px;max-height:82px;  padding: 5px;text-align: center;">
                                    <img class="h-full" src="<?= $image[0] ?? "https://aharvey.com/wp-content/uploads/2018/03/bg-placeholder.jpg" ?>" <?= (!isset($img[0])) ? "style=\"object-fit: cover;width: 100%;\"" : "" ?> />
                                </div>
                                <div class="flex flex-col justify-between pt-4 pb-4" style="width:210px;">
                                    <p class="text-blue-500 text-sm">Vendor Name</p>
                                    <p class="text-sm cut-text"><?= get_post_meta($post->ID, 'vendor_title', true) ?></p>
                                </div>
                                <div class="flex flex-col justify-between pt-4 pb-4" style="width:225px;">
                                    <p class="text-blue-500 text-sm">Solution Name</p>
                                    <p class="text-sm font-bold cut-text"><?= the_title() ?></p>
                                </div>
                                <div class="flex flex-col justify-between pt-4 pb-4" style="width:150px;">
                                    <p class="text-blue-500 text-sm">Solution Type</p>
                                    <p class="text-sm font-bold cut-text"><?= $solution_type_string ?></p>
                                </div>
                                <div class="flex flex-col justify-between pt-4 pb-4">
                                    <p class="text-blue-500 text-sm">Maturity Level</p>
                                    <?= maturity_level_render(get_post_meta($post->ID, 'maturity_level', true)) ?>
                                </div>
                                <div class="flex items-center" style="margin-left: auto; gap:15px;">
                                    <?php if (get_post_meta($post->ID, 'certified', true) == "on") : ?>
                                        <div class="">
                                            <svg id="Gruppe_5274" data-name="Gruppe 5274" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="45.434" height="45.43" viewBox="0 0 45.434 45.43">
                                                <defs>
                                                    <clipPath id="clip-path">
                                                        <rect id="Rechteck_210" data-name="Rechteck 210" width="45.434" height="45.43" fill="none" />
                                                    </clipPath>
                                                </defs>
                                                <path id="Pfad_3" data-name="Pfad 3" d="M45.431,22.725l0,0v-.008ZM22.728,0,18.715,2.538l-4.679-.814L11.3,5.6,6.664,6.648,5.617,11.281,1.736,14.017l.8,4.679L0,22.705l2.538,4.013L1.724,31.4,5.6,34.138,6.648,38.77l4.632,1.047L14.017,43.7l4.679-.8,4.013,2.534,4.013-2.538,4.679.813,2.74-3.877,4.632-1.047,1.047-4.632,3.88-2.736-.8-4.679,2.532-4.009L42.9,18.715l.814-4.679L39.832,11.3,38.785,6.664,34.153,5.617,31.417,1.736l-4.679.8Z" fill="#0028cd" />
                                                <g id="Gruppe_5267" data-name="Gruppe 5267" transform="translate(0 0)">
                                                    <g id="Gruppe_5266" data-name="Gruppe 5266" clip-path="url(#clip-path)">
                                                        <path id="Pfad_4" data-name="Pfad 4" d="M53.411,54.422a.791.791,0,0,1-.779.8H52.15a.789.789,0,0,1-.779-.8V53.391a.791.791,0,0,0-.234-.568l-.611-.619a.765.765,0,0,0-.549-.23H39.39a.771.771,0,0,0-.572.257l-.533.6a.815.815,0,0,0-.206.541v1.055a.791.791,0,0,1-.778.8h-.522a.789.789,0,0,1-.779-.8V46.415a.818.818,0,0,1,.206-.545l1.257-1.394a.771.771,0,0,1,.572-.257h13.34a.771.771,0,0,1,.572.257L53.2,45.87a.818.818,0,0,1,.206.545Z" transform="translate(-21.987 -27.007)" fill="#fff" />
                                                        <path id="Pfad_5" data-name="Pfad 5" d="M33.426,49.318A15.891,15.891,0,1,1,49.318,33.426,15.91,15.91,0,0,1,33.426,49.318m0-30.144A14.252,14.252,0,1,0,47.679,33.426,14.269,14.269,0,0,0,33.426,19.174" transform="translate(-10.709 -10.709)" fill="#fff" />
                                                        <path id="Pfad_6" data-name="Pfad 6" d="M77.843,68.4l-9.459,9.844L64.06,74.005,73.7,64.27Z" transform="translate(-39.124 -39.253)" fill="#0028cd" />
                                                        <path id="Pfad_7" data-name="Pfad 7" d="M70.812,81.318l-3.4-3.3,1.211-1.245,2.162,2.1,5.961-6.046,1.236,1.219Z" transform="translate(-41.173 -44.478)" fill="#ff500f" />
                                                    </g>
                                                </g>
                                            </svg>
                                        </div>
                                    <?php
                                    endif;
                                    $url = get_post_meta($post->ID, 'solution_url', true);
                                    if ($url != null && $url  != "") {
                                    ?>
                                        <a target="_blank" href="<?= $url ?>">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16.938" height="16.938" viewBox="0 0 16.938 16.938">
                                                <path id="Icon_open-external-link" data-name="Icon open-external-link" d="M0,0V16.938H16.938V12.7H14.82V14.82H2.117V2.117H4.234V0ZM8.469,0l3.176,3.176L6.352,8.469l2.117,2.117,5.293-5.293,3.176,3.176V0Z" fill="#0729b2" />
                                            </svg>
                                        </a>
                                    <?php
                                    }
                                    ?>
                                    <div class="expand-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="19.422" height="10.711" viewBox="0 0 19.422 10.711">
                                            <g id="Gruppe_1" data-name="Gruppe 1" transform="translate(652.582 1642.198) rotate(180)">
                                                <path id="Pfad_1" data-name="Pfad 1" d="M634.574,1640.783l8.3-8.3,8.3,8.3" fill="none" stroke="#0729b2" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                                            </g>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="content">
                                <div class="pl-8 pr-8 pb-10 w-full max-w-content mx-auto flex gap-8">
                                    <div class="row-one flex flex-col gap-4">
                                        <div>
                                            <p class="text-blue-500 text-sm mb-1">Solution Name</p>
                                            <p class="text-sm"><?= the_title() ?></p>
                                        </div>
                                        <div>
                                            <p class="text-blue-500 text-sm mb-1">Address</p>
                                            <p class="text-sm"><?= nl2br(get_post_meta($post->ID, 'adress', true)) ?></p>
                                        </div>
                                        <div>
                                            <p class="text-blue-500 text-sm mb-1">Version of Solution</p>
                                            <p class="text-sm"><?= get_post_meta($post->ID, 'version', true) ?></p>
                                        </div>
                                        <div>
                                            <p class="text-blue-500 text-sm mb-1">Used AAS Standards</p>
                                            <p class="text-sm font-bold"><?= $ass_standard_string ?></p>
                                        </div>
                                    </div>
                                    <div class="row-two">
                                        <div>
                                            <p class="text-blue-500 text-sm mb-1">Description</p>
                                            <p class="text-sm"><?= nl2br(get_post_meta($post->ID, 'description', true)) ?></p>
                                            <hr class="mt-4 mb-4 opacity-25" />
                                        </div>
                                        <div>
                                            <p class="text-blue-500 text-sm mb-1">Customer Benefits</p>
                                            <p class="text-sm"><?= nl2br(get_post_meta($post->ID, 'benefits', true)) ?></p>
                                            <hr class="mt-4 mb-4 opacity-25" />
                                        </div>
                                        <div>
                                            <p class="text-blue-500 text-sm mb-1">Target market</p>
                                            <p class="text-sm font-bold"><?= $target_market_string ?></p>
                                            <hr class="mt-4 mb-4 opacity-25" />
                                        </div>
                                        <div>
                                            <p class="text-blue-500 text-sm mb-1">Submodels</p>
                                            <p class="text-sm font-bold"><?= $submodel_string ?></p>
                                            <hr class="mt-4 mb-4 opacity-25" />
                                        </div>
                                        <div>
                                            <p class="text-blue-500 text-sm mb-1">Area of Operation</p>
                                            <p class="text-sm"><?= get_post_meta($post->ID, 'operation', true) ?></p>
                                            <hr class="mt-4 mb-4 opacity-25" />
                                        </div>
                                        <div>
                                            <p class="text-blue-500 text-sm mb-1">Applications</p>
                                            <p class="text-sm"><?= $application_string ?></p>
                                            <hr class="mt-4 mb-4 opacity-25" />
                                        </div>
                                        <div>
                                            <p class="text-blue-500 text-sm mb-1">Lifecylcephases</p>
                                            <p class="text-sm font-bold"><?= $lifecycle_string ?></p>
                                            <hr class="mt-4 mb-4 opacity-25" />
                                        </div>
                                        <div>
                                            <p class="text-blue-500 text-sm mb-1">Used AAS open source software</p>
                                            <p class="text-sm font-bold"><?= $used_oss_string ?></p>
                                            <hr class="mt-4 mb-4 opacity-25" />
                                        </div>
                                        <div>
                                            <p class="text-blue-500 text-sm mb-1">References</p>
                                            <p class="text-sm"><?= get_post_meta($post->ID, 'references', true) ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </main>
            </div>
        </div>
    </main>
</div>

<script>
    var simulateClick = function(elem) {
        // Create our event (with options)
        var evt = new MouseEvent("click", {
            bubbles: true,
            cancelable: true,
            view: window,
        });
        // If cancelled, don't dispatch our event
        var canceled = !elem.dispatchEvent(evt);
    };

    let filterSpan = document.querySelectorAll(".toggle");
    filterSpan.forEach((val, i) => {
        val.addEventListener("click", (e) => {
            if (e.target.id == null | e.target.id == "")
                return;
            let filterDropDown = document.querySelector("[data-target=" + e.target.id + "]")
            if (filterDropDown == null)
                return;
            document.querySelectorAll(".toggle").forEach((el) => {
                if (el != val) {
                    el.parentElement.classList.remove("toggled")
                    el.parentElement.querySelector("[data-target]").classList.add("hidden")
                }
            });
            val.parentElement.classList.toggle("toggled")
            filterDropDown.classList.toggle("hidden");
        })
    })

    let solutions = document.querySelectorAll(".solution-wrapper");
    solutions.forEach((val, i) => {
        val.querySelector(".header").addEventListener("click", (e) => {
            let afterMe = false;
            let clientHeight = 0;
            let containerHeight = 0;
            document.querySelectorAll(".solution-wrapper").forEach((_v) => {
                _v.style.top = "14px";
                if (_v == val) {
                    afterMe = true;
                    val.classList.toggle("triggered");
                    if (val.classList.contains("triggered")) {
                        clientHeight = val.querySelector(".content").clientHeight;
                    } else {
                        clientHeight = 0;
                    }
                    return;
                }
                if (afterMe) {
                    _v.style.top = (clientHeight + 13) + "px";
                }
                _v.classList.remove("triggered");
                containerHeight += _v.clientHeight + 20;
            })
            document.querySelector(".solution-container").style.height = (containerHeight + clientHeight) + "px";
            console.log(containerHeight);
        })
    });
    const options = {
        gridItemsSelector: ".solution-wrapper",
        filter: "all", // Initial filter
        layout: "sameSize", // See layouts
        multifilterLogicalOperator: "and",
        gutterPixels: 15,
        controlsSelector: "#filter .control", // Selector for custom controls,
        filterOutCss: {
            // Filtering out animation
            opacity: 0,
            transform: "scale(1)",
        },
        filterInCss: {
            // Filtering in animation
            opacity: 1,
            transform: "scale(1)",
        },
        setupControls: true,
        animationDuration: 0.2, // in seconds
    };

    const filterizr = new Filterizr(".solution-container", options);

    let filters = document.querySelectorAll("[data-multifilter]");
    filters.forEach((el, key) => {
        el.addEventListener("click", () => {
            let _el = el;
            if (el.parentElement.getAttribute("data-target") == "toggle_maturity-level") {
                el.parentElement.querySelectorAll("[data-multifilter]").forEach((el, i) => {
                    if (el != _el) {
                        if (el.classList.contains("active")) {
                            simulateClick(el);
                        }
                    }
                });
            }
            el.classList.toggle("active");
            var count_text = el.parentElement.parentElement.querySelector(".sorted-text");
            count_text.innerHTML = el.parentElement.querySelectorAll(".active").length;
            if (el.parentElement.querySelectorAll(".active").length <= 0) {
                count_text.classList.remove("flex");
                count_text.classList.add("hidden");
            } else {
                count_text.classList.add("flex");
                count_text.classList.remove("hidden");
            }
        });
    });

    window.onclick = function(event) {
        if (!event.target.matches('.toggle') && !event.target.matches('.control')) {
            let toggled = document.querySelectorAll(".toggled");
            toggled.forEach((v) => {
                var id = v.querySelector("p").id;
                document.querySelector("[data-target=" + id + "]").classList.toggle("hidden")
                v.classList.toggle("toggled");
            })
        }
    }
</script>
<?php get_footer();