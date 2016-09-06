<!DOCTYPE html>
<html lang="ru-RU">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <?php endif; ?>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div class="container">
		<div class="page-header">
            <div class="row ep-links">
            <div class="row servicelinks">
                <ul>
                    <li><a onclick="dayornight()" href="#">День/Ночь</a></li>
                    <li><a id="hideponysp" onclick="fr_hideconfig_set()" href="#">Спрятать пони</a></li>
                </ul>
            </div>
            <nav class="navbar-ep-main">
                <div class="row ep-menu">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">EveryPony.ru</a>
                        <button type="button" class="navbar-toggle offcanvas-toggle pull-right" data-toggle="offcanvas" data-target="#ep-links" style="float:left;">
                            <span class="sr-only">Toggle navigation</span>
                            <span>
                          <span class="icon-bar"></span>
                          <span class="icon-bar"></span>
                          <span class="icon-bar"></span>
                        </span>
                        </button>
                    </div>
                    <div class="navbar-offcanvas navbar-offcanvas-touch" id="ep-links">
                        <ul class="nav navbar-nav">
                            <li><a href="//forum.everypony.ru">Форум</a></li>
                            <li><a href="//stories.everypony.ru">Рассказы</a></li>
                            <li><a href="//wiki.everypony.ru">Вики</a></li>
                            <li><a href="//tabun.everypony.ru">Табун</a></li>
                            <li><a href="//minecraft.everypony.ru">Майнкрафт</a></li>
                            <li><a href="//radio.everypony.ru">Радио</a></li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right hidden-sm">
                            <li><a href="https://twitter.com/everypony_ru" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i>
                                </a></li>
                            <li><a href="<?php echo esc_url( home_url( '/feed' ) ); ?>" target="_blank"><i class="fa fa-rss" aria-hidden="true"></i>
                                </a></li>
                        </ul>
                    </div>
                </div>
            </nav>
            </div> <!--  ep-links-->
            <div class="gallery">
                <div class="col-lg-3">
<!--                    <form method="get" class="searchform" action="//everypony.ru/" >-->
<!--                       <input type="text" value="" placeholder="Поиск по блогу" name="s" id="s" />-->
<!--                    </form>-->
                    <form method="get" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <input type="text" name="s" id="s" placeholder="<?php echo "Поиск по блогу"; ?>" />
                    </form>


                     <div class="pony-time hidden-xs" id="time-header">
                     </div>
                 </div>
                <div class="col-lg-3 col-lg-offset-6">
                <a class="sourcelink" href="" target="_blank">Автор рисунка</a>
                <div class="luna-quote hidden-xs"><span class="header-pony"></span></div>
                </div>
                <div class="row art">
                    <img class="artwork img-responsive" src="" alt=""/>
                </div>
            </div>

        <div class="menu-ep-topics">
            <nav class="navbar navbar-ep-topics">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a class="navbar-brand ep-topics-brand">Рубрики:</a>
                        <button type="button" class="navbar-toggle offcanvas-toggle pull-right" data-toggle="offcanvas" data-target="#ep-topics" style="float:left;">
                            <span class="sr-only">Toggle navigation</span>
                         <span>
                          <span class="icon-bar"></span>
                          <span class="icon-bar"></span>
                          <span class="icon-bar"></span>
                        </span>
                        </button>
                    </div>
                    <div class="navbar-offcanvas navbar-offcanvas-touch" id="ep-topics">
                        <ul class="nav navbar-nav navbar-ep-topics">
                            <li><a href="//everypony.ru/category/news">Новости</a></li>
                            <li><a href="//everypony.ru/category/video">Видео</a></li>
                            <li><a href="//everypony.ru/category/stories">Рассказы</a></li>
                            <li><a href="//everypony.ru/category/images">Рисунки</a></li>
                            <li><a href="//everypony.ru/category/comics">Комиксы</a></li>
                            <li><a href="//everypony.ru/category/music">Музыка</a></li>
                            <li><a href="//everypony.ru/category/games">Игры</a></li>
                            <li><a href="//everypony.ru/category/crafts">Рукоделие</a></li>
                            <li><a href="//everypony.ru/category/overviews">Обзоры</a></li>
                            <li><a href="//everypony.ru/category/events">События</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
	</div>
        <!-- .site-header -->
<div id="content" class="row ep-content">

