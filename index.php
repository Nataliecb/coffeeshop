<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Coffee Shop</title>
    <link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
    <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
    <link href="css/media.css" rel="stylesheet" type="text/css" media="all" />
    <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css'>
    <link href="css/slider.css" rel="stylesheet" type="text/css" media="all" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="js/jquery.min.js"></script>
    <script src="js/slider.js"></script>
    <script type="text/javascript" src="js/jquery.mixitup.min.js"></script>
    <script type="text/javascript" src="js/easing.js"></script>
    <script type="text/javascript">
        $(function () {
            var filterList = {
                init: function () {
                    $('#itemlist').mixitup({
                        targetSelector: '.item',
                        filterSelector: '.filter',
                        duration: 400,
                        effects: 'fade',
                        easing: 'ease' 
                    });
                }
            };
            filterList.init();
        });
    </script>
    <script type="text/javascript" src="js/move-top.js"></script>
</head>
<body>  	
   <?php include 'connection.php'; ?>
    <div class="header" id="home">
        <div class="container">
            <div class="header-top">
                <div class="top-menu">
                    <span class="menu"> </span>
                    <ul>
                        <li><a class="active scroll" href="#home">Главная</a></li>
                        <li><a class="scroll" href="#shop">Кофе</a></li>
                        <li><a class="scroll" href="#about">О нас</a></li>
                        <li><a class="scroll" href="#contact">Контакты</a></li>
                    </ul>
                </div>
                <script>
                    $("span.menu").click(function () {
                        $(".top-menu ul").slideToggle("slow", function () {});
                    });
                </script>
                <div class="clearfix"></div>
            </div>
            <div class="header-info text-center">
                <header>
                    <a href="index.php" rel="home">
                        <img src="../images/logo.png" alt="">
                    </a>
                </header>
                <a class="scroll" href="#shop"><img src="images/go_down.png" alt="" /></a>
            </div>
        </div>
    </div>
    <div class="main-part">
        <section class="shop-section" id="shop">
            <div class="container" id="item">
                <div class="shop-head text-center">
                    <h3>Кофе</h3>
                </div>
                <ul id="filters" class="clearfix">
                    <li><span class="filter active" data-filter="afrika asia central_america south_america"><p>Все</p></span></li>
                    <li><span class="filter" data-filter="afrika"><p>Африка</p></span></li>
                    <li><span class="filter" data-filter="asia"><p>Азия</p></span></li>
                    <li><span class="filter" data-filter="central_america"><p>Северная Америка</p></span></li>
                    <li><span class="filter" data-filter="south_america"><p>Южная Америка</p></span></li>
                </ul>
                <div class="shop-grids" id="itemlist">
                    <?php
                        $query = 'SELECT s.id_item id_coffee, c.name name, c.type type, c.description description,'
                        .' c.image image, s.price price FROM coffee c LEFT JOIN shop_items s'
                        .' ON s.id_coffee=c.id_coffee';
                        $result = mysql_query($query);
                        while ($row = mysql_fetch_assoc($result)) {
                            foreach($row as $key => $value) {
                                $id = $row['id_coffee'];
                                $name = $row['name'];
                                $type = $row['type'];
                                $description = $row['description'];
                                $image = $row['image'];
                                $price = $row['price'];
                            }
                            echo '<div class="item item_box col-md-3 '.$type.' shop-grid text-center data-wow-delay="0.4s" data-cat='.$type.' style="display: inline-block; opacity: 1;"">
                            <div class="pic">
                                <img src="images/shop/'.$image.'" class="pic-image" id="pic-image" alt="" />
                                <span class="pic-caption effect">
                                    <p>'.$description.'</p>
                                </span>
                            </div>
                            <div class="cof-info">
                            <h5 class="item_title">'.$name.'</h5>';
                               $query = 'SELECT * FROM weight';
                               $result_select = mysql_query($query);
                               echo "<select id='weight' name='coffee_weight' class='item_weight' >";
                               while($object = mysql_fetch_object($result_select)) {
                                    echo "<option value='$object->id_weight' class='attached enabled'>$object->value </option>";
                               }
                               echo "</select>";
                               $query = 'SELECT * FROM grists';
                               $result_select = mysql_query($query);
                               echo "<select id='grist' name='coffee_grist' class='item_grist' >";
                               while($object = mysql_fetch_object($result_select)) {
                                    echo "<option value='$object->id_grist' class='attached enabled'>$object->value </option>";
                               }
                               echo '</select>
                            <p><span class="item_price">'.$price.' грн</span></p>
                            <!--<a class="buyitem" href="?view=addtocart&amp;goods_id='.$id.'">Buy</a>
                            <input type="hidden" name="id_cof" value="'.$id.'"/>-->

                        </div><button type="submit" class="add_item button" data-pr="'.$id.'" data-id="'.$id.'"><i class="fa fa-plus"></i>Добавить</button>
                    </div>';
                        }
                        ?> 
                    <div class="clearfix"></div>
                </div>
            </div>
        </section>
        <div id="cart-button">
            <a class="icon-buttton icon-view" id="checkout" href="#cart"><div id="total_count"></div><p>Просмотреть корзину</p></a>
            <a class="icon-buttton icon-del" id="clear_cart" ><p>Очистить корзину</p></a>
        </div>
        <section id="cart">
            <div class="cart container-fluid">
                <div class="shop-head text-center" id="shop-head">
                    <h3>Корзина</h3>
                </div>
                <div id="cart_content"></div>
                <div class="total container-fluid" id="total">
                    <div class="row">
                        <div class="col-md-8">
                            <h4>Сумма заказа: <span id="total_price"></span></h4>
                        </div>
                        <div class="continue col-md-4" id="continue">
                            <a class="submit" id="submit_order" onclick="openNav()">Оформить заказ</a>
                        </div>   
                    </div>
                </div>
                <a href="#shop" class="empty-cart col-md-6" id="empty-cart">
                    <h5 id="empty-cart-text">Корзина пуста</h5>
                </a>
            </div>
        </section>
        <div id="mySidenav" class="sidenav">
            <h3>О заказе</h3>
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <div id="results"></div> 
            <form method="POST" id="order_form" action="javascript:void(null);" onsubmit="call()" name="order_form">
            <?php 
            echo "
                <input type=\"text\" class=\"order-input\" name=\"fio\" id=\"fio\" placeholder=\"ФИО\" value=\"".((!empty($_POST['fio']))?($_POST['fio']):(null))."\" required/>
                <input type=\"tel\" class=\"order-input\" name=\"phone\" placeholder=\"Телефон\" value=\"".((!empty($_POST['phone']))?($_POST['phone']):(null))."\" required/>
                <input type=\"text\" class=\"order-input\" name=\"address\" placeholder=\"Адрес\" value=\"".((!empty($_POST['address']))?($_POST['address']):(null))."\" required/>
                <input type=\"email\" class=\"order-input\" name=\"email\" placeholder=\"E-mail\" value=\"".((!empty($_POST['email']))?($_POST['email']):(null))."\" />
                <textarea rows=\"3\" cols=\"45\" class=\"order-input\" name=\"suggestions\" placeholder=\"Пожелания к заказу\">".((!empty($_POST['suggestions']))?($_POST['suggestions']):(""))."</textarea>";
            ?>
           <span>
                <select name="date" size="1" id="date" class="order-input">';
                    <?php 
                    for($i=0;$i<6;$i++){
                        $cdate = date('d-m-y', time()+$i*24*60*60);
                        echo "<option value=".$cdate."".((!empty($_POST['date'])&& $_POST['date']==$cdate)?(" selected"):("")).">".$cdate."</option>";
                    }?>
                </select>
            </span>
            <input type="submit" class="order-input" id="submit-order" name="submit" value="Подтвердить заказ"/>     
            </form>
        </div>
        <div id="parallax-1">
            <div class="inner">
            </div>
        </div>
        <section class="about-section" id="about">
            <div class="about-section-head text-center">
                <h3>О нас</h3>
            </div>
            <div class="cd-slider-wrapper">
                <ul class="cd-slider">
                    <li class="is-visible">
                        <div class="cd-half-block image"></div>
                        <div class="cd-half-block content">
                            <div>
                                <h2>Немного о Кофе</h2>
                                <p>
                                    Кофе – это поистине необыкновенный напиток, который готовится из обжаренных семян плодов тропических кофейных деревьев. Способен наполнить нас бодростью, подарить хорошее настроение и зарядить позитивной энергией.
                                </p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="cd-half-block image"></div>
                        <div class="cd-half-block content light-bg">
                            <div>
                                <h2>Немного о Кофе</h2>
                                <p>
                                    Кто-то любит и покупает молотый, кто-то сублимированный, а кому-то предпочтительней купить кофе в зернах: как говорится: «О вкусах не спорят!»
                                </p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="cd-half-block image"></div>
                        <div class="cd-half-block content">
                            <div>
                                <h2>И немного о Нас</h2>
                                <p>
                                    До недавнего времени, хороший кофе можно было отведать только в кафе и ресторанах. В связи с ростом популярности интернет-магазинов мы создали прямой канал поставщиков идеальных какао-бобов. Это позволит каждому наслаждаться качеством кофе в рамках своего собственного дома.
                                </p>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </section>
        <div id="parallax-2">
            <div class="inner">
            </div>
        </div>
        <section class="contact-section" id="contact">
            <div class="contact-section-head text-center">
                <h3>Контакты</h3>
            </div>
            <div id="cd-google-map">
                <div id="google-container"></div>
                <div id="cd-zoom-in"></div>
                <div id="cd-zoom-out"></div>
                <address><a href="https://goo.gl/beLGor">Харьков, ул. Данилевского, 3</a></address>
            </div>
            <script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyBxtNz0BZ5QZq5vuIyFNls30fVsIF3Bk-c"></script>
            <script src="js/map.js"></script>
        </section>
    </div>
    <div class="footer">
        <div class="container">
           <div class="col-md-4 col-lg-4 footer-grid">
                <ul class="fa-ul">
                    <li> <i class="fa-li fa fa-map-marker"></i><a href="https://goo.gl/beLGor">Харьков, ул. Данилевского, 3</a></li>
                    <li> <i class="fa-li fa fa-clock-o"></i>ПН - ПТ 09:00 - 18:00</li>
                    <li> <i class="fa-li fa fa-phone"></i>+38 (066) 636-20-77</li>
                </ul>
                <ul class="footer-social list-inline">
                    <li>
                        <a href="https://www.facebook.com" target="_blank" class="tooltip-on" title="Facebook">
                            <div class="icon-wrapper icon-border-round fa-2x"><i class="fa fa-facebook"></i></div>
                        </a>
                    </li>
                    <li>
                        <a href="https://plus.google.com" target="_blank" class="tooltip-on" title="Google-plus">
                            <div class="icon-wrapper icon-border-round fa-2x"><i class="fa fa-google-plus"></i></div>
                        </a>
                    </li>
                    <li>
                        <a href="http://vk.com" target="_blank" class="tooltip-on" title="Vk">
                            <div class="icon-wrapper icon-border-round fa-2x"><i class="fa fa-vk"></i></div>
                        </a>
                    </li>
                    <li>
                        <a href="https://twitter.com" target="_blank" class="tooltip-on" title="Twitter">
                            <div class="icon-wrapper icon-border-round fa-2x"><i class="fa fa-twitter"></i></div>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-md-4 col-lg-4 footer-grid">
                <a href="index.php" title="Coffee Beans Delivered" rel="home">
                    <img src="../images/logo.png" alt="">
                </a>
            </div>
            <div class="col-md-4 col-lg-4 footer-grid">
                <form action=''>
                    <input type="text" name="fio" id="fio" class="input-text" placeholder="Введите ваше имя" />
                    <input type="email" name="email" id="email" class="input-text" placeholder="Введите ваш e-mail" />
                    <input type="submit" id="subscription" value="ПОДПИСАТЬСЯ" />
                </form>
            </div>    
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function () {
            /*
            var defaults = {
                containerID: 'toTop', // fading element id
                containerHoverID: 'toTopHover', // fading element hover id
                scrollSpeed: 1200,
                easingType: 'linear' 
            };
            */
            $().UItoTop({
                easingType: 'easeOutQuart'
            });
        });
    </script>
    <a href="#" id="toTop" style="display: block;"><span id="toTopHover" style="opacity: 1;"></span></a>
    <script src="js/main.js"></script>
</body>
</html>