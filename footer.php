<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
?>


<footer id="footer" class="gray text-center footer-1">
    <div class="container">
        <p class="footer-logo">
            <img class="retina" src="<?php $this->options->themeUrl('img/logo.png'); ?>" alt=""/>
        </p>
        <div class="sub-title"><?php $this->options->description() ?></div>
        <div class="copyright">
            &copy; <?php echo date("Y"); ?> <a
                    href="<?php $this->options->siteUrl(); ?>"><?php $this->options->title(); ?></a>. <a
                    href="https://beian.miit.gov.cn/"><?php $this->options->icp(); ?></a>
        </div>
        <div class="copyright-sub-title text-uppercase">
            <span>Powered by <a href="http://www.typecho.org/" rel="nofollow" target="_blank">Typecho</a> | Theme by <a
                        href="https://github.com/fordes123/typecho-theme-pic-r" target="_blank">Pir</a> </span>
        </div>
    </div>
</footer>
</div>

<style>
    .page-load-status {
        display: none;
        text-align: center;
    }

    .loader-ellips {
        font-size: 20px;
        width: auto;
        position: initial;
    }
</style>

<!-- inject:js -->
<script src="//lf6-cdn-tos.bytecdntp.com/cdn/expire-1-M/jquery/2.2.3/jquery.min.js"
        type="application/javascript"></script>
<script src="//lf6-cdn-tos.bytecdntp.com/cdn/expire-1-M/twitter-bootstrap/3.4.0/js/bootstrap.min.js"
        type="application/javascript"></script>
<script src="//lf6-cdn-tos.bytecdntp.com/cdn/expire-1-M/fancybox/3.5.7/jquery.fancybox.min.js"
        type="application/javascript"></script>
<script src="//lf6-cdn-tos.bytecdntp.com/cdn/expire-1-M/masonry/4.2.2/masonry.pkgd.min.js"
        type="application/javascript"></script>
<script src="//lf3-cdn-tos.bytecdntp.com/cdn/expire-1-M/jquery.imagesloaded/5.0.0/imagesloaded.pkgd.min.js"
        type="application/javascript"></script>
<?php if (!($this->is('post') || $this->is('page'))) : ?>
    <script src="//lf26-cdn-tos.bytecdntp.com/cdn/expire-1-M/jquery-infinitescroll/4.0.1/infinite-scroll.pkgd.min.js"></script>
<?php endif; ?>
<script src="<?php $this->options->themeUrl('./js/menuzord.js'); ?>"></script>
<script src="<?php $this->options->themeUrl('./js/scripts.js'); ?>"></script>
<script src="<?php $this->options->themeUrl('./js/lazyload.js'); ?>"></script>
</body>
</html>