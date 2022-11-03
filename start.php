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
                                .div-1-not{
                                    width:15%;
                                }
                                .div-2-not{
                                    width:85%;padding-left:10px;
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
                                    margin:0px;
                                    z-index:100;
                                }
                                #img-product-not{
                                    width:100%;
                                }
                                #title-product-not{
                                    font-weight:bold;
                                    font-family:'Montserrat';
                                    font-size:18px;
                                }
                                #text-sell-not{
                                    font-family:'Poppins';
                                    font-size:15px;
                                    color:grey;
                                    line-height:1.2em;
                                    margin-top:-2px;
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
                                    animation: fade 4s linear;
                                }
                                @media only screen and (max-width: 768px) {
                                    .container-notificacao{
                                        width:90%;
                                    }
                                    #text-sell-not{
                                        font-size:13px;
                                    }
                                    #title-product-not{
                                        font-size:18px;
                                        font-weight:600;
                                    }
                                    .div-1-not{
                                        width:25%;
                                    }
                                    .div-2-not{
                                        width:75%;
                                    }
                                }
                            </style>
                        </head>
                        <body>
                            <div class="container-notificacao col" id="notification">
                                <div class="div-1-not">
                                    <img alt="Imagem do produto" id="img-product-not">
                                </div>
                                <div class="div-2-not">
                                    <span id="title-product-not" style='text-color:#000;'></span>
                                    <p id="text-sell-not"></p>
                                </div>
                            </div>
                            <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
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
                                        imgProduct.src = data[index]['imagem_produto'][0];
                                        document.getElementById("notification").classList.add("teste");
                                        display_notification();                                        
                                    }, 8000);

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

    add_shortcode('notification_venda_carrinho','notificacao_cart');

    function notificacao_cart(){

        $html = <<< HTML
                        <head>
                            <style>
                                @keyframes fade-in {
                                    0%{
                                        opacity: 0;
                                    }
                                    70%{
                                        opacity:0;
                                    }
                                    100%{
                                        opacity:1;
                                    }
                                }
                                .container-cart-notification{
                                    width:40%;
                                    padding:10px;
                                    background-color:#fff;
                                    border-radius:10px;
                                    position:fixed;
                                    bottom:10px;
                                    left:15px;
                                    animation: fade-in 4s linear;
                                    box-shadow:0 0 0.5em black;
                                    z-index:100;
                                }
                                .text-title{
                                    font-weight:700;
                                    font-size:20px;
                                    color:red;
                                }
                                .text-paragraph{
                                    margin:0px;
                                    margin-top:8px;
                                    color:#252525;
                                    line-height:1.2em;
                                    font-size:18px;
                                    font-weight:500;                                    
                                }
                                #timer{
                                    color:red;
                                    font-weight:600;
                                }
                                .divider{
                                    height:2px;
                                    background-color:#d7d7d7;
                                    width:20%;
                                }
                                @media only screen and (max-width: 768px){
                                    .container-cart-notification{
                                        width:90%;
                                    }
                                    .divider{
                                        width:30%;
                                    }
                                    .text-paragraph{
                                        font-size:15px;
                                    }
                                    .text-title{
                                        font-weight:600;
                                        font-size:18px;
                                    }
                                }

                            </style>
                        </head>
                        <body>
                            <div class="container-cart-notification">
                                <span class="text-title">
                                    Atenção!
                                </span>
                                <div class='divider'></div>
                                <p class="text-paragraph">
                                    Você possui apenas <a id="timer"></a> minutos para finalizar sua compra. <br><a style='color:grey;font-size:13px;'>Após isso, seu carrinho será resetado.</a>
                                </p>
                            </div>
                            <script>
                                function startTimer(duration, display) {
                                    var timer = duration, minutes, seconds;
                                    setInterval(function () {
                                        minutes = parseInt(timer / 60, 10);
                                        seconds = parseInt(timer % 60, 10);
                                        minutes = minutes < 10 ? "0" + minutes : minutes;
                                        seconds = seconds < 10 ? "0" + seconds : seconds;
                                        display.textContent = minutes + ":" + seconds;
                                        if (--timer < 0) {
                                            timer = duration;
                                        }
                                    }, 1000);
                                }
                                window.onload = function () {
                                    var duration = 60 * 10; // Converter para segundos
                                        display = document.querySelector('#timer'); // selecionando o timer
                                    startTimer(duration, display); // iniciando o timer
                                };
                            </script>
                        </body>
                    HTML;
        
        echo $html;
    }

    add_shortcode('notification-venda-produto','notificacao_product');

    function notificacao_product(){

        $html = <<< HTML
                        <head>
                            <style>
                                @keyframes fade-in {
                                    0%{
                                        opacity: 0;
                                    }
                                    70%{
                                        opacity:0;
                                    }
                                    100%{
                                        opacity:1;
                                    }
                                }
                                .container-product-notification{
                                    padding:10px;
                                    bottom:10px;
                                    left:15px;
                                    background-color:#fff;
                                    position:fixed;
                                    width:40%;
                                    border-radius:10px;
                                    animation: fade-in 4s linear;
                                    z-index:100;
                                    box-shadow:0 0 0.5em black
                                }
                                .title-notification-product{
                                    color:orange;
                                    font-size:20px;
                                    font-weight:600;
                                }
                                #people-count{
                                    color:orange;
                                }
                                .text-notification-product{
                                    margin:0px;
                                    font-size:16px;
                                    color:#252525;
                                    font-weight:500;
                                    margin-top:5px;
                                }
                                .divider{
                                    height:1.5px;
                                    background-color:grey;
                                    width:25%;
                                }
                                @media only screen and (max-width: 768px){
                                    .container-product-notification{
                                        width:90%;
                                    }
                                    .divider{
                                        width:40%
                                    }
                                    .text-notification-product{
                                        font-size:15px;
                                    }
                                    .title-notification-product{
                                        font-size:18px;
                                        font-weight:600;
                                    }
                                }
                            </style>
                        </head>
                        <body>
                            <div class="container-product-notification">
                                <span class="title-notification-product">
                                    Produto quente!
                                </span>
                                <div class="divider"></div>
                                <p class="text-notification-product">
                                    Outras <span id="people-count"></span> estão vendo este produto agora. <span style='font-size:15px;'>Reserve já o seu!.</span>
                                </p>
                            </div>  
                            <script>
                                var peopleCount = Math.floor(Math.random() * 31);
                                document.getElementById("people-count").innerHTML = peopleCount+" pessoas";
                            </script>
                        </body>
                    HTML;
        echo $html;
    }