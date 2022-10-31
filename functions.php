<?php

    require_once( '../../../wp-load.php' );

    if(isset($_POST['start'])){
        start();
    }

    function start(){

        $args = array(
            'status' => 'publish'
        );
        $teste = 0;

        $products =  wc_get_products($args);

        echo json_encode($products);

    }

?>