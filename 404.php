<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

<!--page title start-->
<section class="page-title">
    <div class="container">
        <h4 class="text-uppercase">PAGE NOT FOUND</h4>
    </div>
</section>
<!--page title end-->

<!--body content start-->
<section class="body-content ">

    <!--error-->
    <div class="page-content">
        <div class="container">
            <div class="row page-content">
                <div class="col-md-5 text-center">
                    <div class="error-avatar">
                        <img src="<?php $this->options->themeUrl('img/error-avatar.png'); ?>" alt="" />
                    </div>
                </div>

                <div class="col-md-7">
                    <div class="error-info">
                        <div class="error404">
                            404
                        </div>
                        <div class="error-txt">
                            好吧...
                            <br />页面被管理员吃了
                        </div>
                        <a href="<?php $this->options->siteUrl(); ?>" class="btn btn-medium  btn-theme-color "> 带我回家</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--error-->


</section>
<!--body content end-->


<?php $this->need('footer.php'); ?>