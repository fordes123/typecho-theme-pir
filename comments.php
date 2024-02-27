<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php function threadedComments($comments, $options)
{
?>
    <<?php echo $comments->levels > 0 ? 'div' : 'li'; ?> id="<?php $comments->theId(); ?>" class="media">
        <?php
        $host = '//secure.gravatar.com';
        $url = '/avatar/';
        $size = '50';
        $rating = Helper::options()->commentsAvatarRating;
        $hash = md5(strtolower($comments->mail));
        $avatar = $host . $url . $hash . '?s=' . $size . '&r=' . $rating . '&d=';
        ?>
        <a class="pull-left" href="#">
            <img class="media-object comment-avatar lazyload" src="<?php Helper::options()->themeUrl('./img/avatar.png'); ?>" onerror="javascript:this.src='<?php Helper::options()->themeUrl('./img/avatar.png'); ?>';" data-src="<?php echo $avatar ?>" alt="<?php echo $comments->author; ?>" width="50" height="50">
        </a>
        <div class="media-body">

            <div class="comment-info">
                <div class="comment-author">
                    <a><?php echo $comments->author; ?></a>
                </div>
                <?php $comments->date('Y/m/d H:m'); ?>
                <?php $comments->reply($word = '<i class="fa fa-comment-o"></i>回复'); ?>
            </div>

            <?php $comments->content(); ?>
            <?php if ($comments->children) { ?>
                <?php $comments->threadedComments($options); ?>
            <?php } ?>

        </div>

    </<?php echo $comments->levels > 0 ? 'div' : 'li'; ?>>
<?php } ?>

<!--comments discussion section start-->

<div id="form" class="heading-title-alt text-left heading-border-bottom">
    <h4 class="text-uppercase"><?php $this->commentsNum('0', '1', '%d'); ?> 条评论</h4>
</div>
<?php $this->comments()->to($comments); ?>
<?php if ($comments->have()) : ?>
    <ul class="media-list comments-list m-bot-50 clearlist">
        <!-- Comment Item start-->
        <?php $comments->listComments(array('before' =>  '', 'after'  =>  '')); ?>
        <!-- Comment Item end-->
    </ul>
<?php endif; ?>
<!--comments discussion section end-->

<!--comments  section start-->
<?php if ($this->allow('comment')) : ?>
    <div id="<?php $this->respondId(); ?>" class="heading-title-alt text-left heading-border-bottom">
        <h4 class="text-uppercase">发表感言</h4>
    </div>
    <div class="cancel-comment-reply btn btn-small btn-white-solid"> <?php $comments->cancelReply($word = '<i class="fa fa-rotate-left"></i> 取消回复'); ?> </div>
    <form action="<?php $this->commentUrl() ?>" method="post" id="commentform" role="form" class="blog-comments">

        <div class="row">
            <?php if (!$this->user->hasLogin()) : ?>
                <div class="col-md-6 form-group">
                    <!-- Name -->
                    <input type="text" name="author" id="name" class=" form-control" placeholder="Name *" maxlength="100" value="<?php $this->remember('author'); ?>" required="">
                </div>

                <div class="col-md-6 form-group">
                    <!-- Email -->
                    <input type="email" name="mail" id="mail" class=" form-control" placeholder="Email *" maxlength="100" value="<?php $this->remember('mail'); ?>" required="">
                </div>

                <!-- Website -->
                <div class="form-group col-md-12">
                    <input type="text" name="url" id="website" class=" form-control" placeholder="Website" maxlength="100" value="<?php $this->remember('url'); ?>">
                </div>
            <?php else : ?>
                <!-- User -->
                <div class="form-group col-md-12">
                    <h5 class="text-uppercase"><span class="active"><?php $this->user->screenName(); ?></span> Welcome back.</h5>
                </div>
            <?php endif; ?>
            <!-- Comment -->
            <div class="form-group col-md-12">
                <textarea name="text" id="text" class=" form-control" rows="6" placeholder="您的支持是我们的动力！" maxlength="400"></textarea>
            </div>

            <!-- Send Button -->
            <div class="form-group col-md-12">
                <button type="submit" class="btn btn-small btn-default">
                    发射
                </button>
            </div>

            <!-- Security -->
            <?php $security = $this->widget('Widget_Security'); ?>
            <input type="hidden" name="_" value="<?php echo $security->getToken($this->request->getReferer()) ?>"></p>


        </div>

    </form>
    <script data-no-instant>
        (function() {
            window.TypechoComment = {
                dom: function(id) {
                    return document.getElementById(id);
                },
                create: function(tag, attr) {
                    var el = document.createElement(tag);
                    for (var key in attr) {
                        el.setAttribute(key, attr[key]);
                    }
                    return el;
                },
                reply: function(cid, coid) {
                    var comment = this.dom(cid),
                        parent = comment.parentNode,
                        response = this.dom('respond-post-1'),
                        input = this.dom('comment-parent'),
                        form = 'form' == response.tagName ? response : response.getElementsByTagName('form')[0],
                        textarea = response.getElementsByTagName('textarea')[0];
                    if (null == input) {
                        input = this.create('input', {
                            'type': 'hidden',
                            'name': 'parent',
                            'id': 'comment-parent'
                        });
                        form.appendChild(input);
                    }
                    input.setAttribute('value', coid);
                    if (null == this.dom('comment-form-place-holder')) {
                        var holder = this.create('div', {
                            'id': 'comment-form-place-holder'
                        });
                        response.parentNode.insertBefore(holder, response);
                    }
                    comment.appendChild(response);
                    this.dom('cancel-comment-reply-link').style.display = '';
                    if (null != textarea && 'text' == textarea.name) {
                        textarea.focus();
                    }
                    return false;
                },
                cancelReply: function() {
                    var response = this.dom('respond-post-1'),
                        holder = this.dom('comment-form-place-holder'),
                        input = this.dom('comment-parent');
                    if (null != input) {
                        input.parentNode.removeChild(input);
                    }
                    if (null == holder) {
                        return true;
                    }
                    this.dom('cancel-comment-reply-link').style.display = 'none';
                    holder.parentNode.insertBefore(response, holder);
                    return false;
                }
            };
        })();
    </script>
<?php else : ?>
    <div id="<?php $this->respondId(); ?>" class="heading-title-alt text-left heading-border-bottom">
        <h4 class="text-uppercase">Comment Closed</h4>
    </div>
<?php endif; ?>
<!--comments  section end-->