<?php 
    /**
     * Plugin Name:       Notificação Venda
     * Plugin URI:        https://example.com/plugins/the-basics/
     * Description:       Plugin para incentivo de compra por efeito manada
     * Version:           1.0.0
     * Requires at least: 5.2
     * Requires PHP:      7.2
     * Author:            Unishop Brasil
     * License:           GPL v2 or later
     * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
     * Update URI:        https://example.com/my-plugin/
     * Text Domain:       notificacao-venda
     * Domain Path:       /languages
    */

    if ( !defined( 'ABSPATH' ) ) exit;

    add_shortcode('notificacao_venda_unishop','notificacao_content');

    function notificacao_content(){        

        $html = <<< HTML
                        <head>
                            <style>
                                .col{
                                    display:flex;
                                    align-items:center;
                                }
                                .container-notificacao{
                                    width:50%;
                                    background-color:#fff;
                                    box-shadow:0 0 1em black;
                                    bottom:10px;
                                    left:10px;
                                    position:fixed;
                                    padding:10px;
                                }
                            </style>
                        </head>
                        <body>
                            <div class="container-notificacao col">
                                <div>
                                    <img alt="Imagem do produto" id="img-product-not">
                                </div>
                                <div>
                                    <span id="title-product-not"></span>
                                    <p id="text-sell-not"></p>
                                </div>
                            </div>
                            <script>

                            $.ajax({
                                    url: "wp-content/plugins/notificacao-vendas/functions.php",
                                    type: "POST",
                                    data: {'start' : ""},
                                    dataType: 'json',
                                    success: data => {

                                        console.log(data);

                                    },error : function(XML, textStatus, errorThrown){
                                        console.log(XML, textStatus);
                                    }
                                });

                            </script>
                        </body>
                    HTML;
        echo $html;

    }