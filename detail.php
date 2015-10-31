<?php
if ($_GET) {
    if (!empty($_GET["id"])) $id = (string)$_GET["id"];
}

if (!empty($id)) {
    $baseurl = "http://123.57.42.13:3366/";
//    $baseurl = "http://api.meizhanggui.cc:3366/";
    $url = $baseurl . "feeds/?_method=GET&feed_id=" . $id;
    $json = json_decode(file_get_contents($url), true);

    $tags = explode('#', $json["data"]["tag"], 999);
    $imgUrl = $json["data"]["image_urls"];
    $content = $json["data"]["content"];
    $likecount = $json["data"]["like_count"];
}
?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title><?php
        if(!empty($content)){
            echo $content . '_纹身大咖图案大全';
        }else{
            echo '纹身大咖图案大全';
        }
        ?></title>
    <meta name="keywords" content="<?php
    echo '纹身,刺青,纹身师,纹身图片,纹身图案,';
    if(!empty($tags)){
        for ($i = 0; $i < count($tags); $i++) {
            echo $tags[$i] . ',';
        }
    }
    ?>"/>
    <meta name="description" content="<?php
    if(!empty($content))echo $content;
    ?>"/>
    <link href="static/css/style.css?321" rel="stylesheet">
    <script src="vender/dev.min.js"></script>
    <script src="main.js"></script>
</head>
<body>

<nav>
    <div class="flu-main">
        <a href="index.php"><img src="static/img/logo.png" alt="纹身大咖图库"></a>

        <div id="selector">
            <div id="selectParts">部位</div>
            <div id="selectStyle">风格</div>
            <div id="selectElement">元素</div>
        </div>
    </div>
</nav>

<div id="main">

    <div id="details" class="flu-main">
        <?php
        echo '<img src="' . $imgUrl[0] . '" style="display: none">';
        ?>
        <div id="imageBox">
            <div class="flu-main arrowArea flu-v16-9">
                <div class="arrow arrow-left hide"></div>
                <div class="arrow arrow-right"></div>
            </div>
            <div id="slider">
                <?php
                for ($i = 0; $i < count($imgUrl); $i++) {
                    echo '<div class="flu-main flu-v16-9 image" ';
                    echo 'style="background-image:url(' . $imgUrl[$i] . '?imageView2/2/w/1400/h/787/format/jpg/q/90)"></div>';
                }
                ?>
            </div>
        </div>
        <?php
        if (!empty($content)) echo '<h1>' . $content . '</h1>'
        ?>

        <?php
        if (!empty($tags)) {
            echo '<div id="tag">';
            for ($i = 0; $i < count($tags); $i++) {
                echo '<span>' . $tags[$i] . '</span>';
            }
            echo '</div">';
        }
        ?>
    </div>

    <div class="likeRule flu-main">
        <div>
            <svg version="1.1" id="like" xmlns="http://www.w3.org/2000/svg"
                 xmlns:xlink="http://www.w3.org/1999/xlink"
                 x="0px" y="0px" viewBox="0 0 96 96" enable-background="new 0 0 96 96" xml:space="preserve">
                    <path fill-rule="evenodd" clip-rule="evenodd" fill="#FF1A1A"
                          d="M48,25.4C35.6-3.8,0.2,3,0,36.8c-0.1,18.6,16.8,25.5,28.1,32.9,C39,77,46.8,86.8,48.1,91c1-4.1,9.7-14.2,19.8-21.4C79,61.7,96.1,55.2,96,36.6C95.8,2.7,59.8-2.6,48,25.4z"></path>
                </svg>
        </div>
    </div>
    <div class="likebox">
        <?php
        $likeUser = $json["data"]["like_users"];
        if (!empty($likeUser)) {
            for ($i = 0; $i < count($likeUser); $i++) {
                echo '<a class="avatar" title="' . $likeUser[$i]['nickname'] . '" data-id="' . $likeUser[$i]['userId'] . '"';
                if (empty($likeUser[$i]['avatar'])) {
                    echo 'style="background-image: url(static/img/def_avatar.jpg)"></a>';
                } else {
                    echo 'style="background-image: url(' . $likeUser[$i]['avatar'] . '?imageView2/1/w/30/h/30/format/jpg/q/70)"></a>';
                }
            }
        }
        ?>

    </div>

</div>


<div id="sideBar">
    <img src="static/img/windowClose.png">

    <div id="element">
        <a href="index.php?page=1&tag=贴纸">贴纸</a>
        <a href="index.php?page=1&tag=几何">几何</a>
        <a href="index.php?page=1&tag=字符">字符</a>
        <a href="index.php?page=1&tag=动物">动物</a>
        <a href="index.php?page=1&tag=人物">人物</a>
        <a href="index.php?page=1&tag=植物">植物</a>
        <a href="index.php?page=1&tag=静物">静物</a>
        <a href="index.php?page=1&tag=鬼神">鬼神</a>
        <a href="index.php?page=1&tag=图腾">图腾</a>
        <a href="index.php?page=1&tag=宗教">宗教</a>
        <a href="index.php?page=1&tag=情侣">情侣</a>
        <a href="index.php?page=1&tag=原创">原创</a>
    </div>
    <div id="parts">
        <a href="index.php?page=1&tag=颈部">颈部</a>
        <a href="index.php?page=1&tag=肩部">肩部</a>
        <a href="index.php?page=1&tag=胸部">胸部</a>
        <a href="index.php?page=1&tag=腹部">腹部</a>
        <a href="index.php?page=1&tag=腰部">腰部</a>
        <a href="index.php?page=1&tag=背部">背部</a>
        <a href="index.php?page=1&tag=臀部">臀部</a>
        <a href="index.php?page=1&tag=手臂">手臂</a>
        <a href="index.php?page=1&tag=腿部">腿部</a>
        <a href="index.php?page=1&tag=手部">手部</a>
        <a href="index.php?page=1&tag=脚部">脚部</a>
    </div>
    <div id="style">
        <a href="index.php?page=1&tag=欧美">欧美</a>
        <a href="index.php?page=1&tag=传统">传统</a>
        <a href="index.php?page=1&tag=习俗">习俗</a>
        <a href="index.php?page=1&tag=肖像">肖像</a>
        <a href="index.php?page=1&tag=清新">清新</a>
        <a href="index.php?page=1&tag=写实">写实</a>
        <a href="index.php?page=1&tag=国画">国画</a>
        <a href="index.php?page=1&tag=手稿">手稿</a>
        <a href="index.php?page=1&tag=男">男</a>
        <a href="index.php?page=1&tag=女">女</a>
    </div>
</div>

<script src="vender/dev.min.js"></script>
<script>
    var baseUrl = 'http://123.57.42.13';
    //    var baseUrl = 'http://api.meizhanggui.cc';

    var sideBar = {
        expend: function (selector) {
            $('#main').addClass('expend');
            $('#sideBar').addClass('expend');
            $('nav').addClass('expend');
            $('#sideBar>div').removeClass('active');
            $(selector).addClass('active');
        },
        close: function () {
            $('#main').removeClass('expend');
            $('#sideBar').removeClass('expend');
            $('nav').removeClass('expend');
            $('#sideBar>div').removeClass('active');
        }
    };

    var imageBox = {
        $s: $('#imageBox #slider'),
        max:
        <?php
            echo count($imgUrl);
        ?>,
        index: 0,
        pre: function () {
            if (imageBox.index <= 0)return;
            imageBox.index--;
            imageBox.$s.css('left', -imageBox.index * 100 + '%');
            $('.arrow-right').removeClass('hide');
            if (imageBox.index == 0)$('.arrow-left').addClass('hide');
        },
        next: function () {
            if (imageBox.index >= (imageBox.max - 1))return;
            imageBox.index++;
            imageBox.$s.css('left', -imageBox.index * 100 + '%');
            $('.arrow-left').removeClass('hide');
            if (imageBox.index == (imageBox.max - 1))$('.arrow-right').addClass('hide');
        }
    };

    $('#selectParts').click(function () {
        sideBar.expend('#parts');
    });
    $('#selectStyle').click(function () {
        sideBar.expend('#style');
    });
    $('#selectElement').click(function () {
        sideBar.expend('#element');
    });
    $('#sideBar>img').click(sideBar.close);
    if (imageBox.max > 1) {
        $('.arrow-right').click(imageBox.next);
        $('.arrow-left').click(imageBox.pre);
    } else {
        $('.arrow-right').addClass('hide');
    }

    ex.jsonp({
        debug: true,
        url: baseUrl + '/WenShen/V3.0.0/User/login?_method=GET',
        success: function (obj) {
            if (obj.code == 0) {
                var id = obj.data.userInfo.userId;
                $('.avatar').each(function () {
                    if ($(this).attr('data-id') == id) {
                        $(this).addClass('active');
                        $('#like path').addClass('active');
                    }
                })
            }
        }
    });

    $('.likeRule>div').click(function () {
        location.href = 'http://www.wenshendaka.com';
    })


</script>

</body>
</html>