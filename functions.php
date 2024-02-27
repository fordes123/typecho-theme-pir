<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

function themeConfig($form)
{
    $form->addInput(new Typecho_Widget_Helper_Form_Element_Text('icp', NULL, NULL, _t('ICP备案号'), _t('有就写没有就不写不可以乱写༼ つ ◕_◕ ༽つ')));
    $form->addInput(new Typecho_Widget_Helper_Form_Element_Radio('mode', array(false => '相册模式', true => '图集模式'), false, '显示模式', '相册模式: 不显示博文，一篇文章代表一张图片<br>图集模式: 显示博文，可在博文中插入更多文字和图片'));
}

function themeFields($layout)
{
    $layout->addItem(new Typecho_Widget_Helper_Form_Element_Text('original', NULL, NULL, _t('原图地址（图集模式下表现为封面）'), _t('用CDN啊，再不济上个图床~')));
}


/*文章阅读次数统计*/
function get_post_view($archive)
{
    $cid = $archive->cid;
    $db = Typecho_Db::get();
    $prefix = $db->getPrefix();
    if (!array_key_exists('views', $db->fetchRow($db->select()->from('table.contents')))) {
        $db->query('ALTER TABLE `' . $prefix . 'contents` ADD `views` INT(10) DEFAULT 0;');
        echo 0;
        return;
    }
    $row = $db->fetchRow($db->select('views')->from('table.contents')->where('cid = ?', $cid));
    if ($archive->is('single')) {
        $views = Typecho_Cookie::get('extend_contents_views');
        if (empty($views)) {
            $views = array();
        } else {
            $views = explode(',', $views);
        }
        if (!in_array($cid, $views)) {
            $db->query($db->update('table.contents')->rows(array('views' => (int)$row['views'] + 1))->where('cid = ?', $cid));
            array_push($views, $cid);
            $views = implode(',', $views);
            Typecho_Cookie::set('extend_contents_views', $views); //记录查看cookie

        }
    }
    echo $row['views'];
}


/*Typecho 24小时发布文章数量*/
function get_recent_posts_number($days = 1, $display = true)
{
    $db = Typecho_Db::get();
    $today = time() + 3600 * 8;
    $daysago = $today - ($days * 24 * 60 * 60);
    $total_posts = $db->fetchObject($db->select(array('COUNT(cid)' => 'num'))
        ->from('table.contents')
        ->orWhere('created < ? AND created > ?', $today, $daysago)
        ->where('type = ? AND status = ? AND password IS NULL', 'post', 'publish'))->num;
    if ($display) {
        echo $total_posts;
    } else {
        return $total_posts;
    }
}

//热门文章（评论最多）
function rmcp($days = 30, $num = 5)
{
    $defaults = array(
        'before' => '',
        'after' => '',
        'xformat' => '<a class="list-group-item visible-lg" title="{title}" href="{permalink}" rel="bookmark"><i class="fa  fa-book"></i> {title}</a> 
	<a class="list-group-item visible-md" title="{title}" href="{permalink}" rel="bookmark"><i class="fa  fa-book"></i> {title}</a>'
    );
    $time = time() - (24 * 60 * 60 * $days);
    $db = Typecho_Db::get();
    $sql = $db->select()->from('table.contents')
        ->where('created >= ?', $time)
        ->where('type = ?', 'post')
        ->limit($num)
        ->order('commentsNum', Typecho_Db::SORT_DESC);
    $result = $db->fetchAll($sql);
    echo $defaults['before'];
    foreach ($result as $val) {
        $val = Typecho_Widget::widget('Widget_Abstract_Contents')->filter($val);
        echo str_replace(array('{permalink}', '{title}', '{commentsNum}'), array($val['permalink'], $val['title'], $val['commentsNum']), $defaults['xformat']);
    }
    echo $defaults['after'];
}

//随机文章
function theme_random_posts()
{
    $defaults = array(
        'number' => 6,
        'before' => '',
        'after' => '',
        'xformat' => '<a class="list-group-item visible-lg" title="{title}" href="{permalink}" rel="bookmark"><i class="fa  fa-book"></i> {title}</a> 
	<a class="list-group-item visible-md" title="{title}" href="{permalink}" rel="bookmark"><i class="fa  fa-book"></i> {title}</a>'
    );
    $db = Typecho_Db::get();

    $sql = $db->select()->from('table.contents')
        ->where('status = ?', 'publish')
        ->where('type = ?', 'post')
        ->where('created <= unix_timestamp(now())', 'post') //添加这一句避免未达到时间的文章提前曝光
        ->limit($defaults['number'])
        ->order('RAND()');

    $result = $db->fetchAll($sql);
    echo $defaults['before'];
    foreach ($result as $val) {
        $val = Typecho_Widget::widget('Widget_Abstract_Contents')->filter($val);
        echo str_replace(array('{permalink}', '{title}'), array($val['permalink'], $val['title']), $defaults['xformat']);
    }
    echo $defaults['after'];
}

//缩略图调用
function showThumb($obj, $link = false)
{
    preg_match_all("/<[img|IMG].*?src=[\'|\"](.*?)[\'|\"].*?[\/]?>/", $obj->content, $matches);
    $thumb = '';
    $options = Typecho_Widget::widget('Widget_Options');
    $attach = $obj->attachments(1)->attachment;
    if (isset($attach->isImage) && $attach->isImage == 1) {
        $thumb = $attach->url;   //附件是图片 输出附件
    } elseif (isset($matches[1][0])) {
        $thumb = $matches[1][0];  //文章内容中抓到了图片 输出链接
    }


    //空的话输出默认随机图
    $thumb = empty($thumb) ? $options->themeUrl . '/img/' . rand(1, 14) . '.jpg' : $thumb;


    if ($link) {
        return $thumb;
    } else {
        $thumb = '<img src="' . $thumb . '">';
        return $thumb;
    }
}

function getPostImg($archive)
{
    $img = array();
    //  匹配 img 的 src 的正则表达式
    preg_match_all("/<[img|IMG].*?src=[\'|\"](.*?)[\'|\"].*?[\/]?>/", $archive->content, $img);
    //  判断是否匹配到图片
    if (count($img) > 0 && count($img[0]) > 0) {
        //  返回图片
        return $img[1];
    } else {
        //  如果没有匹配到就返回 none
        return 'none';
    }
}
