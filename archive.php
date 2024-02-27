<?php

/**
 * The main template file
 * 
 * @package massive
 * @author massive
 * @version 1.0
 * @link https://www.xingkb.com
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php'); ?>

<!--page title start-->
<section class="page-title">
    <div class="container">
        <h4 class="text-uppercase"><?php $this->archiveTitle(array(
                                        'category'  =>  _t('Category : %s'),
                                        'search'    =>  _t('Search : %s'),
                                        'tag'       =>  _t('Tag : %s'),
                                        'author'    =>  _t('Author : %s'),
                                        'date'      =>  _t('Date : %s')
                                    ), '', ''); ?></h4>
    </div>
</section>
<!--page title end-->

<!--body content start-->
<section class="body-content">
    <div class="container">
        <div class="row ">
            <div class="portfolio portfolio-with-title portfolio-masonry blog-m col-4 gutter ">
                <?php if ($this->have()) : ?>
                    <?php while ($this->next()) : ?>
                        <div class="portfolio-item">
                            <div class="thumb">
                                <img class="img-item lazyload" data-fancybox="gallery" data-src="<?php echo $this->fields->original ?>" src="<?php $this->options->themeUrl('./img/loading.gif'); ?>" alt=""></img>
                                <div class="widget-tags">
                                    <?php if ($this->options->mode) : ?>
                                        <a href="<?php $this->permalink(); ?>">
                                            <!--<i class="fa fa-send"></i> -->
                                            <?php $this->title(); ?>
                                        </a>
                                    <?php else : ?>
                                    <?php if (count($this->tags) == 0) {
                                            $this->category(' ', true, '');
                                        } else {
                                            $this->tags(' ', true, '');
                                        }
                                    endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>

        </div>
    </div>

    <div class="col-md-12">
        <div class="text-center">
            <div class="page-load-status">
                <div class="loader-ellips tb-preloader-wave infinite-scroll-request"></div>
                <p class="infinite-scroll-last">到底啦～</p>
                <p class="infinite-scroll-error">加载错误</p>
            </div>
        </div>
    </div>
    <div class="ajaxloadpost" style="display:none">
        <?php $this->pageLink('下一页', 'next'); ?>
    </div>
</section>
<!--body content end-->

<?php $this->need('footer.php'); ?>