<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
global $cont; ?>
<!DOCTYPE html>
<html lang="<?=LANGUAGE_ID?>">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <?$APPLICATION->ShowHead();?>
    <meta name="viewport" content="width=max-width, initial-scale=1.0, maximum-scale=2.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="HandheldFriendly" content="true">
    <meta http-equiv="cleartype" content="on">
    <meta http-equiv="msthemecompatible" content="no">
    <meta name="format-detection" content="telephone=no">

    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
    <title>Lifestyle Education</title>
    <?use \Bitrix\Main\Page\Asset;
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH."/public/vendors/malihu-scrollbar/jquery.mCustomScrollbar.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH."/public/vendors/slick/slick.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH."/public/vendors/slick/slick-theme.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH."/public/assets/css/app.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH."/public/assets/css/affetta.css");

    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH."/public/vendors/jquery/dist/jquery.min.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH."/public/vendors/malihu-scrollbar/jquery.mCustomScrollbar.concat.min.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH."/public/vendors/slick/slick.min.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH."/public/vendors/parallax/js/simpleParallax.min.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH."/public/assets/js/app.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH."/public/assets/js/affetta.js");
    ?>
    <script>var SITE_DIR = "<?=SITE_DIR?>";</script>
</head>
<body>
<?$APPLICATION->ShowPanel();?>
<aside><a class="logo" <?=(!CSite::InDir('/index.php'))?'href="/"':'';?>><img src="<?=SITE_TEMPLATE_PATH?>/public/assets/images/logo.png"></a><img src="<?=SITE_TEMPLATE_PATH?>/public/assets/images/edu.svg"></aside>
<main <?if(CSite::InDir("/auth/")):?>class="login"<?endif;?>>
    <?if(!CSite::InDir("/auth/")):?>
        <header>
                <div class="progress">
                    <div class="container"><span class="progress__text">Ваш прогресс</span>
                        <div class="progress__bar">
                            <div class="progress__bar--title"><strong>28.6% материала изучено</strong>
                                <p>2 из 8 уроков пройдено</p>
                            </div>
                            <div class="progress__meter">
                                <div class="progress__meter--bar" style="width: calc((100% / 7) * 2)"></div><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span>
                            </div>
                        </div>
                    </div>
                </div>
            <div class="login"><a class="login__user" href="#">
                    <div class="login__user--avatar">КА</div>
                    <p>Константин Арсеньев</p></a>
                <div class="login__btn"><a href="#"></a></div>
            </div>
        </header>
    <?else:?>
        <div class="login__image">
            <div class="login__image--image">
                <div class="sphere sphere--big">
                </div>
                <div class="sphere sphere--small">
                </div>
                <img src="/local/templates/lifestyle/public/assets/images/auth.svg" class="move">
            </div>
            Lifestyle Education
            <h1>Добро пожаловать на&nbsp;обучающую платформу LifeStyle Education</h1>
            <p>
                Зарегистрируйстесь в личном кабинете, чтобы начать обучение
            </p>
        </div>
    <?endif;?>



