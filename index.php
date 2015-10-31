<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>大咖图库</title>
    <meta name="keywords" content=""/>
    <meta name="description" content=""/>
    <link href="static/css/style.css?321" rel="stylesheet">
<!--    <script>-->
<!--        //是否移动端判断-->
<!--        g$isMobile = navigator.userAgent.match(/mobile/i) != null;-->
<!---->
<!--        //移动端显示设置-->
<!--        if (g$isMobile) {-->
<!--            var m = document.createElement("META");-->
<!--            m.setAttribute("name", "viewport");-->
<!--            m.setAttribute("content", "width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no");-->
<!--            document.head.appendChild(m);-->
<!--        }-->
<!--    </script>-->
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


    <div id="waterfall" class="flu-main">
        <?php
        if ($_GET) {
            if (!empty($_GET["page"])) $page = (int)$_GET["page"];
            if (!empty($_GET["tag"])) $tag = (string)$_GET["tag"];
        }
        if (empty($page)) $page = 1;

        $baseurl = "http://123.57.42.13:3366/";
//        $baseurl = "http://api.meizhanggui.cc:3366/";
        $url = $baseurl . "feeds/recommendWithCount?_method=GET&limit=30&sector=30&count=true&index=" . ($page * 30 - 30);
        if (!empty($tag)) $url = $url . "&tag=" . $tag;
        $json = json_decode(file_get_contents($url), true);

        $config = array(
            "width" => 250
        );

        $list = $json["data"]["list"];
        $count =  $json["data"]['count'];
        if (count($list) > 0) {
            for ($i = 0; $i < count($list); $i++) {

                $w = $config["width"];
                $href = 'detail.php?id=' . $list[$i]['_id'];
                $imgUrl = $list[$i]["image_urls"][0];
                if (strpos($imgUrl, "_W_")) {
                    $rw = explode("X", explode("_W_", $imgUrl, 2)[1], 2)[0];
                    $rh = explode("X", explode("_W_", $imgUrl, 2)[1], 2)[1];
                } else {
                    $imageInfo = json_decode(file_get_contents($imgUrl . '?imageInfo'), true);
                    $rw = $imageInfo['width'];
                    $rh = $imageInfo['height'];
//                    $imgUrl = $imgUrl . '?imageView2/1/w/250/h/250/format/jpg/q/75';
                }
                $h = $rh / $rw * $config["width"];
                $imgUrl = $imgUrl . '?imageView2/2/w/250/format/jpg/q/75';
                $content = $list[$i]["content"];
                $tags = $list[$i]["tag"];

                echo "<div class='node'>";
                echo "    <a style='width:" . $w . "px;height:" . $h . "px' class='cover' href='" . $href . "'>";
                echo "        <h4>" . $content . "</h4>";
                echo "        <p>" . str_ireplace('#',' ',$tags) . "</p>";
                echo "    </a>";
                echo "    <img src='" . $imgUrl . "' style='width:" . $w . "px;height:" . $h . "px'>";
                echo "</div>";

            }
        } else {
            echo "";
        }
        ?>

    </div>

    <?php
        $max = ceil($count/30);
//        echo '<script>alert("'.$count.'")</script>';
    ?>
    <div id="page">
        <div  class="flu-main">
            <?php
            if($page<5){
                $start = 1;
                $end = $max<9?$max:9;
            }else{
                $start = $page - 4;
                $end = $max<($page+4)?$max:($page+4);
            }
            if(empty($tag)){
                $href = 'index.php?page=';
            }else{
                $href = 'index.php?tag='.$tag.'&page=';
            }
            for($i=$start;$i<=$end;$i++){
                if($i==$page){
                    echo '<p class="active">'.$page.'</p>';
                }else{
                    echo '<a href="'.$href.$i.'">'.$i.'</a>';
                }
            }
            ?>
        </div>

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
    var waterfall = {
        o: null,
        Set: function () {
            if (waterfall.o) {
                delete waterfall.o;
                waterfall.o = null;
            }
            waterfall.o = $('#waterfall .node').wookmark({
                container: $('#waterfall'),
                offset: 30,
                outerOffset: 30,
                itemWidth: 250,
                flexibleWidth: 250,
                fillEmptySpace: true,
                align: 'left'
            });

            var imgLoad = imagesLoaded('#waterfall');
            imgLoad.on('progress', function (instance, image) {
                $(image.img).css('opacity', 1);
            });
        },
        Refresh: function () {
            waterfall.Set();
        }
    };

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

    var tags = {
        element: '贴纸#几何#字符#动物#人物#植物#静物#鬼神#图腾#宗教#情侣#原创',
        parts: '颈部#肩部#胸部#腹部#腰部#背部#臀部#手臂#腿部#手部#脚部',
        style: '欧美#传统#习俗#肖像#清新#写实#国画#手稿#男#女'
    };

//    $(document).ready(function () {
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
        waterfall.Set();
        var tag = location.search.match(/tag=([^\b&]*)/);
        if (tag) {
            tag = decodeURIComponent(tag[1]);

            $('#element a').each(function () {
                if (tag == $(this).text()) {
                    $(this).addClass('active');
                }
            });

            if (tags.element.indexOf(tag) != -1)$('#selectElement').addClass('active').text(tag);
            if (tags.style.indexOf(tag) != -1)$('#selectStyle').addClass('active').text(tag);
            if (tags.parts.indexOf(tag) != -1)$('#selectParts').addClass('active').text(tag);
        }
//    });

    $(window).resize(function () {
        waterfall.Refresh();
    });

</script>

</body>
</html>