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
                                @import url('https://fonts.googleapis.com/css2?family=Montserrat&family=Poppins&display=swap');
                                .col{
                                    display:flex;
                                    align-items:center;
                                }
                                .container-notificacao{
                                    width:40%;
                                    background-color:#fff;
                                    box-shadow:0 0 1em black;
                                    bottom:10px;
                                    left:10px;
                                    position:fixed;
                                    padding:10px;
                                    display:flex;
                                    align-items:center;
                                    border-radius:12px;
                                }
                                #img-product-not{
                                    width:100%;
                                }
                                #title-product-not{
                                    font-weight:800;
                                    font-family:'Montserrat';
                                    font-size:18px;
                                }
                                #text-sell-not{
                                    font-family:'Poppins';
                                    font-size:15px;
                                }
                                @keyframes fade {
                                    0%{
                                        opacity: 0;
                                    }
                                    5%{
                                        opacity: 1;
                                    }
                                    100%{
                                        opacity:1;
                                    }
                                }
                                .teste{
                                    opacity: 0;
                                    animation: fade 3s linear;
                                }
                            </style>
                        </head>
                        <body>
                            <div class="container-notificacao col" id="notification">
                                <div style="width:15%">
                                    <img alt="Imagem do produto" id="img-product-not">
                                </div>
                                <div style="width:60%;padding-left:10px;">
                                    <span id="title-product-not"></span>
                                    <p id="text-sell-not"></p>
                                </div>
                            </div>
                            <script>
                            
                            document.getElementById("notification").style.display = "none";

                            $.ajax({
                                    url: "wp-content/plugins/plugin-notificacao-vendas/functions.php",
                                    type: "POST",
                                    data: {'start' : ""},
                                    dataType: 'json',
                                    success: data => {                
                                        mostrar_notification(data);
                                    },error : function(XML, textStatus, errorThrown){
                                        console.log(XML, textStatus);
                                    }
                                });

                                function mostrar_notification(data){

                                    var title = document.getElementById("title-product-not");
                                    var text = document.getElementById("text-sell-not");
                                    var imgProduct = document.getElementById("img-product-not");

                                    setInterval(() => {

                                        var index = Math.floor(Math.random() * data.length);
                                        
                                        title.innerHTML = data[index]['nome_product'];
                                        text.innerHTML =  "Um novo produto foi vendido para outro usuário!";
                                        imgProduct.src = data[index]['imagem_produto'];
                                        document.getElementById("notification").classList.add("teste");
                                        display_notification();                                        
                                    }, 5000);

                                }

                                function display_notification(){
                                    document.getElementById("notification").style.display = "flex";
                                    setTimeout(() => {
                                        document.getElementById("notification").style.display = "none";                                     
                                    }, 3000);
                                }

                            </script>
                        </body>
                    HTML;
        echo $html;

    }