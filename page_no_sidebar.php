<?php
/**
 * 宽版页面
 *
 * @package custom
 */
 if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

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
                                    <h4 class="text-uppercase"><a itemtype="url" href="<?php $this->permalink() ?>"><?php $this->title(); ?></a></h4>
                                    <ul class="post-meta">
                                        <li><i class="fa fa-user"></i>posted by <a itemprop="name" href="<?php $this->author->permalink(); ?>" rel="author"><?php $this->author(); ?></a>
                                        </li>
                                        <li><i class="fa fa-comments"></i>  <a href="#form"><?php $this->commentsNum('0', '1', '%d'); ?> comments</a>
                                        </li>
                                    </ul>

                                    <?php $this->content(); ?>

                                    <div class="inline-block">
                                        <div class="widget-tags">
                                            <h6 class="text-uppercase">Tags </h6>
                                            <?php $this->tags(' ', true, '<a>没有标签</a>'); ?>
                                        </div>
                                    </div>


                                    <div class="clearfix inline-block">
                                        <?php //这是一个广告位 ?>
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