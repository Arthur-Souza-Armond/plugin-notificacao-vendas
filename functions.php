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
            $products[$index]['imagem_produto'] = get_post_meta(get_post_meta($r->ID,'_thumbnail_id')[0],'_wc_attachment_source')[0];
            $index++;
        }

        echo json_encode($products);

    }

?>