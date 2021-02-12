<?php
$page_number = $_GET["page_number"];
$food_type = $_GET["food_type"];

if (is_null($page_number)) {
    $page_number = 1;
}

if (is_null($food_type)) {
    $food_type = "all";
}

$table_food = getTableArray("foodday", "food_list");
$table_filter = getTableArray("foodday", "filter_list");

if ($food_type == "new") {
    $table_food = getTableArrayByAttribute("foodday", "food_list", "_new", 1);
} elseif ($food_type != "all") {
    $table_food = getTableArrayByAttribute("foodday", "food_list", "_type", $food_type);
}

$max_items = 6;
$page_items = ceil(count($table_food) / $max_items);
?>

<div>

    <div id="indexCarousel" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#indexCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#indexCarousel" data-slide-to="1"></li>
            <li data-target="#indexCarousel" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img style="background-image: url('images/carousel_images/img_1.jpg');" class="d-block carousel-img">
            </div>
            <div class="carousel-item">
                <img style="background-image: url('images/carousel_images/img_2.jpg');" class="d-block carousel-img">

            </div>
            <div class="carousel-item">
                <img style="background-image: url('images/carousel_images/img_3.jpg');" class="d-block carousel-img">
            </div>
        </div>
        <a class="carousel-control-prev" href="#indexCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#indexCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>



    <div class=" navbar-light">
        <!--------------------------------------------------------------------->

        <button id="sort-botton" class="btn btn-block p-2 btn-sort mt-3" type="button" data-toggle="collapse"
            data-target="#typeFood" aria-controls="navbarSupportedContent" aria-expanded="true"
            aria-label="Toggle navigation">
            <span>Сортировать</span> <span><i class="fas fa-search"></i></span>
        </button>

        <div class="collapse navbar-collapse show" id="typeFood">

            <div class="food-filter-container">

                <?php
                for ($i = 0; $i < count($table_filter); $i++):
                    $f_name = $table_filter[$i]["_name"];
                    $f_img = $table_filter[$i]["_img"];
                    $f_type = $table_filter[$i]["_type"];
                    $f_href = "index.php?page_number=1&food_type=" . $f_type;
                    $f_active = $food_type == $f_type ? "active" : "";
                ?>
                <div class="food-filter-container__card">
                    <a href="<?echo $f_href; ?>" class="food-filter-container__body <?echo $f_active; ?>">
                        <span class="food-filter-container__content"
                            style="background-image: url('images/food_icons/<?echo $f_img; ?>');"></span>
                        <?echo $f_name; ?>
                    </a>
                </div>
                <?endfor;?>

            </div>

        </div>

    </div>
    <!--------------------------------------------------------------------->

    <hr>

    <div class="">
        <!--------------------------------------------------------------------->

        <div id="food-list" class="food-list-container">

            <?php
            for ($i = ($page_number - 1) * $max_items; $i < ($page_number * $max_items); $i++):
                if (!is_null($table_food[$i])):
                $row = $table_food[$i];
                $name = $row["_name"];
                $image = $row["_img"];
                $rating = $row["_rating"];
                $time = $row["_time"];
                $cost = $row["_cost"];
                $text = $row["_text"];
                $new = $row["_new"];
                $promo = $row["_promo"];

                $new_cost;
                $promotion;

                if ($promo > 0) $promotion = true; else $promotion = false;

                if ($promotion) {
                    $new_cost_promo = ($cost / 100) * $promo;
                    $new_cost = ceil($cost - $new_cost_promo);
                } else $new_cost = $cost;
            
            ?>

            <div id="food_list_card_<?php echo $row['id']; ?>" class="food-list-container__card">
                <div class="food-list-container__body">
                    <div class="food-list-container__image"
                        style="background-image: url('images/food_list_img/<?echo $image; ?>');">
                        <?if ($promo > 0): ?>
                        <span class="food-list-container__promo">
                            <?echo $promo; ?>%
                        </span>
                        <?endif;?>
                    </div>
                    <div class="food-list-container__content">
                        <h4 class="food-list-container__title">
                            <?echo $name; ?>
                        </h4>
                        <div class="food-list-container__badge-list">
                            <div div class="food-list-container__badge">
                                <?echo $time; ?>мин
                            </div>
                            <div class="food-list-container__badge <? if ($promotion) echo 'promo'; ?>">
                                <span>
                                    <? if ($promotion) {echo $cost;} ?>
                                </span>
                                <span>
                                    <?echo $new_cost; ?>руб
                                </span>
                            </div>
                            <div class="food-list-container__badge rate">
                                <i class="far fa-star"></i>
                                <?echo $rating; ?>
                            </div>
                            <?if ($new): ?>
                            <div class="food-list-container__badge new">NEW</div>
                            <?endif;?>
                        </div>

                        <div class="food-list-container__text">
                            <?echo $text; ?>%
                        </div>

                        <button class="order-button" onclick="addToBasket(<?echo $row['id']; ?>)">
                            <span class="order-button__icon">
                                <i class="fas fa-plus"></i>
                            </span>
                            Заказать
                        </button>

                    </div>
                </div>
            </div>

            <?php endif;endfor;?>

            <?php if (count($table_food) == 0): ?>
            <h5 class="h5 text-uppercase text-center w-100">
                Ничего не найдено!
            </h5>
            <?endif;?>

        </div>

        <?php if ($page_items > 1): ?>
        <nav aria-label="Page navigation example" class="mt-3">
            <ul class="pagination justify-content-end">
                <li class="page-item<?if ($page_number == 1) {
    echo " disabled";}?>">
                    <a class="page-link" href="index.php?page_number=1">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <?php
                for ($i = 0; $i < $page_items; $i++):
                    $cur_page = $i + 1;
                ?>
                <li class="page-item<?if ($page_number == $cur_page) {
        echo " active";}?>"><a class="page-link" href="index.php?page_number=<?echo $cur_page ?>">
                        <?echo $cur_page ?>
                    </a></li>

                <?endfor;?>
                <li class="page-item<?if ($page_number == $page_items) {
    echo " disabled";}?>">
                    <a class="page-link" href="index.php?page_number=<?echo $page_items; ?>">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
        <?endif;?>

        <hr>

    </div>
    <!--------------------------------------------------------------------->



    <div class="">
        <div class="container-title">
            Товар по акции
        </div>
    </div>

    <div class="">
        <!--------------------------------------------------------------------->

        <div class="food-list-container">

            <?php
            $table_promo = getTableArrayByAttribute("foodday", "food_list", "_promo", 0, ">");
            
            foreach ($table_promo as $i => $row):
                $name = $row["_name"];
                $image = $row["_img"];
                $rating = $row["_rating"];
                $time = $row["_time"];
                $cost = $row["_cost"];
                $new = $row["_new"];
                $promo = $row["_promo"];
                
                $new_cost;
                $promotion;

                if ($promo > 0) $promotion = true; else $promotion = false;

                if ($promotion) {
                    $new_cost_promo = ($cost / 100) * $promo;
                    console_log($new_cost_promo);
                    $new_cost = ceil($cost - $new_cost_promo);
                } else $new_cost = $cost;

            ?>

            <div id="food_list_card_<?php echo $row['id']; ?>" class="food-list-container__card">
                <div class="food-list-container__body">
                    <div class="food-list-container__image"
                        style="background-image: url('images/food_list_img/<?echo $image; ?>');">
                        <?if ($promo > 0): ?>
                        <span class="food-list-container__promo">
                            <?echo $promo; ?>%
                        </span>
                        <?endif;?>
                    </div>
                    <div class="food-list-container__content">
                        <h4 class="food-list-container__title">
                            <?echo $name; ?>
                        </h4>
                        <div class="food-list-container__badge-list">
                            <div div class="food-list-container__badge">
                                <?echo $time; ?>мин
                            </div>

                            <div class="food-list-container__badge <? if ($promotion) echo 'promo'; ?>">
                                <span>
                                    <? if ($promotion) {echo $cost;} ?>
                                </span>
                                <span>
                                    <?echo $new_cost; ?>руб
                                </span>
                            </div>

                            <div class="food-list-container__badge rate">
                                <i class="far fa-star"></i>
                                <?echo $rating; ?>
                            </div>
                            <?if ($new): ?>
                            <div class="food-list-container__badge new">NEW</div>
                            <?endif;?>
                        </div>

                        <div class="food-list-container__text">
                            <?echo $text; ?>%
                        </div>

                        <button class="order-button" onclick="addToBasket(<?echo $row['id']; ?>)">
                            <span class="order-button__icon">
                                <i class="fas fa-plus"></i>
                            </span>
                            Заказать
                        </button>


                    </div>
                </div>

                <?php endforeach;?>

            </div>

        </div>
        <!--------------------------------------------------------------------->

    </div>