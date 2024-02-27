<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?> <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0"> <!--favicon icon-->
    <link rel="icon" type="image/png" href="<?php $this->options->themeUrl('./img/favicon.png'); ?>">
    <title><?php $this->archiveTitle(array('category' => _t(' %s '), 'search' => _t(' %s '), 'tag' => _t(' %s '), 'author' => _t(' %s ')), '', ' - '); ?><?php $this->options->title(); ?></title>
    <!-- inject:css -->
    <link rel="stylesheet" href="<?php $this->options->themeUrl('./css/style.min.css'); ?>">
    <link href="//lf26-cdn-tos.bytecdntp.com/cdn/expire-1-M/twitter-bootstrap/3.4.0/css/bootstrap.min.css"
          type="text/css" rel="stylesheet"/>
    <link href="//lf26-cdn-tos.bytecdntp.com/cdn/expire-1-M/font-awesome/6.0.0/css/all.min.css" type="text/css"
          rel="stylesheet"/>
    <link href="//lf9-cdn-tos.bytecdntp.com/cdn/expire-1-M/fancybox/3.5.7/jquery.fancybox.min.css" type="text/css"
          rel="stylesheet"/>
    <!-- end inject -->
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://cdn.bootcss.com/html5shiv/r29/html5.min.js"></script>
    <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"/>
</head>
<body>
<!--  preloader start -->
<div id="tb-preloader">
    <div id="loading" class="tb-preloader-wave"></div>
</div>
<!-- preloader end -->
<div class="wrapper">
    <!--header start-->
    <header class="l-header">
        <div class="l-navbar l-navbar_t-light l-navbar_expand js-navbar-sticky">
            <div class="container-fluid">
                <nav class="menuzord js-primary-navigation" role="navigation" aria-label="Primary Navigation">
                    <!--logo start-->
                    <a href="<?php $this->options->siteUrl(); ?>"
                       class="logo-brand"> <?php $this->options->title() ?> </a>
                    <!--logo end-->
                    <!--mega menu start-->
                    <ul class="menuzord-menu menuzord-right c-nav_s-standard">
                        <li><a href="<?php $this->options->siteUrl(); ?>"><span class="fa fa-home"> 首页</span></a></li>
                        <li><a href="javascript:void(0)"><span class="fa fa-th">分类</span></a>
                            <ul class="dropdown"> <?php $this->widget('Widget_Metas_Category_List')->to($cats); ?> <?php while ($cats->next()) : ?>
                                    <li><a href="<?php $cats->permalink() ?>"><?php $cats->name() ?></a>
                                    </li> <?php endwhile; ?> </ul>
                        </li>
                        <li><a href="javascript:void(0)"><span class="fa fa-file">页面</span></a>
                            <ul class="dropdown"> <?php $this->widget('Widget_Contents_Page_List')->to($pages); ?> <?php while ($pages->next()) : ?>
                                    <li><a href="<?php $pages->permalink(); ?>"><?php $pages->title(); ?></a>
                                    </li> <?php endwhile; ?> </ul>
                        </li>
                        <li><a href="javascript:void(0)"><i class="fa fa-search"></i> 搜索</a>
                            <div class="megamenu megamenu-quarter-width navbar-search">
                                <form id="search" method="post" action="./" role="searchform"><input type="text"
                                                                                                     name="s"
                                                                                                     class="form-control"
                                                                                                     placeholder="在这里输入">
                                </form>
                            </div>
                        </li>
                    </ul>
                    <!--mega menu end-->
                </nav>
            </div>
        </div>
    </header> <!--header end-->