<?php

/**
 * The template for displaying all single posts and attachments
 *
 * @package Vtrois
 * @version 2.3
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>
    <!-- single -->
    <!--page title start-->
    <section class="page-title">
        <div class="container">
            <h4 class="text-uppercase"></h4>
            <ol class="breadcrumb">
                <li><a href="<?php $this->options->siteUrl(); ?>">HOME</a></li>
                <?php if ($this->is('index')) : ?>
                    <!-- 页面为首页时 -->
                <?php elseif ($this->is('post')) : ?>
                    <!-- 页面为文章单页时 -->
                    <li><?php $this->category(); ?></li>
                    <li><?php $this->title() ?></li>
                <?php else : ?>
                    <!-- 页面为其他页时 -->
                    <li><?php $this->archiveTitle('', '', ''); ?></li>
                <?php endif; ?>
            </ol>

        </div>
    </section>
    <!--page title end-->

    <!--body content start-->
    <section class="body-content ">
        <div class="page-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <!--classic image post-->
                        <div class="blog-classic">
                            <div class="blog-post">
                                <div class="full-width" style="display:none;">

                                </div>
                                <h4 class="text-uppercase"><a itemtype="url"
                                                              href="<?php $this->permalink() ?>"><?php $this->title(); ?></a>
                                </h4>
                                <ul class="post-meta">
                                    <li><i class="fa fa-user"></i>posted by <a itemprop="name"
                                                                               href="<?php $this->author->permalink(); ?>"
                                                                               rel="author"><?php $this->author(); ?></a>
                                    </li>
                                    <li><i class="fa fa-folder-open"></i> <?php $this->category(','); ?>
                                    </li>
                                    <li><i class="fa fa-comments"></i> <a
                                                href="#form"><?php $this->commentsNum('0', '1', '%d'); ?> comments</a>
                                    </li>
                                </ul>

                                <?php $this->content(); ?>
                                <div class="inline-block">
                                    <div class="widget-tags">
                                        <h6 class="text-uppercase">标签 </h6>
                                        <?php $this->tags(' ', true, '<a>没有标签</a>'); ?>
                                    </div>
                                </div>
                                <div class="clearfix inline-block">
                                    <?php //这是一个广告位
                                    ?>
                                </div>
                                <div class="pagination-row">
                                    <div class="pagination-post">
                                        <div class="prev-post">
                                            <?php $this->thePrev(' %s ', '<a><div class="arrow"><i class="fa fa-angle-double-left"></i></div><div class="pagination-txt"><span>First Post</span></div></a>', array('title' => '<div class="arrow"><i class="fa fa-angle-double-left"></i></div><div class="pagination-txt"><span>Previous Post</span></div>')); ?>
                                        </div>
                                        <div class="post-list-link">
                                            <a href="<?php $this->options->siteUrl(); ?>">
                                                <i class="fa fa-home"></i>
                                            </a>
                                        </div>
                                        <div class="next-post">
                                            <?php $this->theNext(' %s ', '<a><div class="arrow"><i class="fa fa-angle-double-right"></i></div><div class="pagination-txt"><span>Last Post</span></div></a>', array('title' => '<div class="arrow"><i class="fa fa-angle-double-right"></i></div><div class="pagination-txt"><span>Next Post</span></div>')); ?>
                                        </div>
                                    </div>
                                </div>
                                <?php $this->need('comments.php'); ?>
                            </div>
                        </div>
                        <!--classic image post-->

                    </div>


                </div>
            </div>
        </div>


    </section>
    <!--body content end-->

<?php $this->need('footer.php'); ?>