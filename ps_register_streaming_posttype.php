<?php

function add_streaming_custom_type() {
  $supports = [ 'title' ];
  if(function_exists("register_field_group"))
  {
    register_field_group( [
      'id' => 'acf_directos',
      'title' => 'directos',
      'fields' => [
        [ 'key' => 'youtube_url', 'label' => 'URL de YouTube', 'name' => 'youtube_url', 'type' => 'text' ],
        [ 'key' => 'streaming_starts_at', 'label' => 'Fecha y hora de inicio', 'name' => 'streaming_starts_at', 'type' => 'date_time_picker' ], 
        [ 'key' => 'streaming_ends_at', 'label' => 'Fecha y hora de fin', 'name' => 'streaming_ends_at', 'type' => 'date_time_picker' ],
        [ 'key' => 'duration_min', 'label' => 'Duración (minutos)	', 'name' => 'duration_min', 'type' => 'number' ],
	[ 'key' => 'duration_sec', 'label' => 'Duración (segundos)	', 'name' => 'duration_sec', 'type' => 'number' ]
      ],
      'location' => [[[ 'param' => 'post_type', 'operator' => '==', 'value' => 'streaming', 'order_no' => 0, 'group_no' => 0 ]]],
      'options' => [ 'position' => 'normal', 'layout' => 'no_box', 'hide_on_screen' => []],
      'menu_order' => 0,
    ]);
  } else {
    $supports []= "custom-fields";
  }
  
  register_post_type('streaming', [
    'labels' => [
        'name' => __('Directos', 'podemos-streamings'),
        'singular_name' => __('Directo', 'podemos-streamings'),
        'add_new' => __('Añadir nuevo', 'podemos-streamings'),
        'add_new_item' => __('Añadir nuevo directo', 'podemos-streamings'),
        'edit' => __('Editar', 'podemos-streamings'),
        'edit_item' => __('Editar directo', 'podemos-streamings'),
        'new_item' => __('Nuevo directo', 'podemos-streamings'),
        'view' => __('Ver', 'podemos-streamings'),
        'view_item' => __('Ver directo', 'podemos-streamings'),
        'search_items' => __('Buscar directo', 'podemos-streamings'),
        'not_found' => __('No se han encontrado directos', 'podemos-streamings'),
        'not_found_in_trash' => __('No se han encontrado directos en la papelera', 'podemos-streamings')
    ],
    'public' => true,
    'hierarchical' => false,
    'has_archive' => true,
    'supports' => $supports,
    'can_export' => true,
    'taxonomies' => [  ],
    'rewrite' => [ 'slug' => 'directo', 'with_front' => false ],
    'menu_icon' => 'dashicons-video-alt',
    'menu_position' => 20
  ]);
}

add_action( 'init' , 'add_streaming_custom_type' );













