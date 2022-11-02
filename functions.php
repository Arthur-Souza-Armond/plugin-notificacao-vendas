<?php

    require_once( '../../../wp-load.php' );

    if(isset($_POST['start'])){
        start();
    }

    function start(){

        global $wpdb;

        $result = $wpdb->get_results("SELECT * FROM wp_posts WHERE post_type = 'product' AND post_status='publish' LIMIT 5");
        $index = 0;
        foreach($result as $r){
            $products[$index]['nome_product'] = $r->post_title;
            $products[$index]['imagem_produto'] = wp_get_attachment_image_src( get_post_thumbnail_id( $r->ID ), 'single-post-thumbnail' );
            $index++;
        }

        echo json_encode($products);

    }

?>