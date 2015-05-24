<?php


add_theme_support( 'post-thumbnails' ); //Adds support for featured images
add_image_size( 'tool-tip', 0, 100, false ); //Adds the size of featured images usked in tooltips


// Replace category checkboxes with radio buttons so you can only choose one
if(
    strstr($_SERVER['REQUEST_URI'], 'wp-admin/post-new.php') ||
    strstr($_SERVER['REQUEST_URI'], 'wp-admin/post.php') ) {

    ob_start('one_category_only');
}

function one_category_only($content) {
    $content = str_replace('type="checkbox" ', 'type="radio" ', $content);
    return $content;
}


//Change names in dashboards
function change_post_menu_label() {
    global $menu;
    global $submenu;
    $menu[5][0] = 'Indlæg';
    $submenu['edit.php'][5][0] = 'Alle indlæg';
    $submenu['edit.php'][10][0] = 'Opret Indlæg';
    $submenu['edit.php'][15][0] = 'Emner'; // Change name for categories
    $submenu['edit.php'][16][0] = 'Tilføj tags?'; // Change name for tags
    echo '';
}

function change_post_object_label() {
    global $wp_post_types;
    $labels = &$wp_post_types['post']->labels;
    $labels->name = 'Indlæg';
    $labels->singular_name = 'Indlæg';
    $labels->add_new = 'Tilføj Indlæg';
    $labels->add_new_item = 'Tilføj nyt indlæg';
    $labels->edit_item = 'Rediger Indlæg';
    $labels->new_item = 'Indlæg';
    $labels->view_item = 'VIs Indlæg';
    $labels->search_items = 'Søg i indlæg';
    $labels->not_found = 'Ingen Indlæg fundet';
    $labels->not_found_in_trash = 'Ingen indlæg fundet i skraldespanden';
}
add_action( 'init', 'change_post_object_label' );
add_action( 'admin_menu', 'change_post_menu_label' );


//Custom usergroups


$teacher_capabilities = array(
    'read' => true,
    'delete_others_pages' => true,
    'delete_others_posts' => true,
    'delete_pages' => true,
    'delete_posts' => true,
    'delete_private_pages' => true,
    'delete_private_posts' => true,
    'delete_published_pages' => true,
    'delete_published_posts' => true,
    'edit_others_pages' => true,
    'edit_others_posts' => true,
    'edit_pages' => true,
    'edit_posts' => true,
    'edit_private_pages' => true,
    'edit_private_posts' => true,
    'edit_published_pages' => true,
    'edit_published_posts' => true,
    'manage_categories' => true,
    'manage_links' => true,
    'moderate_comments' => true,
    'publish_pages' => true,
    'publish_posts' => true,
    'read' => true,
    'read_private_pages' => true,
    'read_private_posts' => true,
    'unfiltered_html' => true,
    'upload_files' => true
);

$student_capabilities = array(
    'read' => true,
    'delete_posts' => true,
    'delete_private_posts' => true,
    'delete_published_posts' => true,
    'edit_others_posts' => true,
    'edit_posts' => true,
    'edit_private_posts' => true,
    'edit_published_posts' => true,
    'publish_posts' => true,
    'read' => true,
    'read_private_posts' => true,
    'upload_files' => true

);


$teacher_res = add_role("teacher", "Lærer", $teacher_capabilities);
$student_res =  add_role("student", "Elev", $student_capabilities);
?>