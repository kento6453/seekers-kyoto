<?php

    // GETパラメータ"d"から表示対象の日付を取得
    $date = htmlentities($_GET['d']);

    $url = "diary_src/" . $date.".html";

    $date_y = substr($date ,0,4);
    $date_m = substr($date ,4,2);
    $date_d = substr($date ,6,2);
    $date_disp = $date_y . '年' . $date_m . '月' . $date_d . '日';

    //ディレクトリ内のファイル名を１つずつを取得して配列に格納
    $file_arr = array();
    if ($dir = opendir("./diary_src/")) {
        while (($file = readdir($dir)) !== false) {
            if ($file != "." && $file != "..") {
                $file_name = str_replace('.html', '', $file);
                array_push($file_arr, $file_name);
            }
        }
        closedir($dir);
    }

    // 日付順にファイルをソート
    sort($file_arr);

    $this_index = array_search($date,$file_arr);
    $prev_date = $file_arr[$this_index-1];
    $next_date = $file_arr[$this_index+1];

    // 日付順にファイルを降順ソート（バックナンバー用）
    rsort($file_arr);


?><!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="euc-jp" />
<title>二条徒然日記 | <?php echo($date_disp); ?> - こども服シーカーズ＠京都河原町二条</title>

<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="description" content="<?php echo($date_disp); ?>のシーカーズ店長の二条徒然日記。シーカーズは京都、河原町二条にある、こども服（子供服）のセレクトショップです。" />
<meta name="keywords" content="ブログ,子供服,こども服,河原町,京都,二条,シーカーズ,SEEKERS,オーガニック,インポート,KP" />

<!-- CSS -->
<link href="../assets/css/bootstrap.css" rel="stylesheet" />
<link href="../assets/css/application.css" rel="stylesheet" />

<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<!-- Javascript -->
<script src="../assets/js/bootstrap.min.js"></script>
<script src="../assets/js/application.js"></script>

<!-- Facebook -->
<meta property="fb:admins" content="1456249781" />

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-29547806-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</head>

<body>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/ja_JP/all.js#xfbml=1&appId=317553584997809";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div id="header">
    <div id="header-inner">
        <div id="header-logo">
            <h1><a href="../index.html" title="京都、河原町二条にある、こども服（子供服）のセレクトショップ シーカーズのトップページへ"><img src="../image/menu_mark.gif" width="60" height="83" alt="京都、河原町二条にある、こども服（子供服）のセレクトショップ シーカーズ" /></a></h1>
        </div><!-- header-logo -->
        <div id="header-navigation">
            <ul class="clearfix" id="diary">
                <li class="cell1"><a href="../message.html"><span>メッセージ</span></a></li>
                <li class="cell2"><a href="../brand.html"><span>取り扱いブランド</span></a></li>
                <li class="cell3"><a href="../cordinate.html"><span>おすすめコーディネート</span></a></li>
                <li class="cell4"><a href="../shopinfo.html"><span>店舗情報・交通アクセス</span></a></li>
                <li class="cell5"><a href="top.php"><span>二条徒然日記(ブログ)</span></a></li>
                <li class="cell6"><a href="../sanpomap.html"><span>二条かいわいお散歩マップ</span></a></li>
                <li class="cell7"><a href="../coupon.html"><span>サービスクーポン</span></a></li>
                <li class="cell8"><a href="../link.html"><span>リンク</span></a></li>
            </ul>
        </div><!-- header-navigation -->
    </div><!-- header-inner -->
</div><!-- header -->

<div id="contents">
    <div class="content-default">
        <h2 class="page-title"><img src="../image/tytle_diary.gif" width="407" height="28" alt="二条徒然日記　スローに書いています。京都ぐらしの日々あれこれ。" /></h2>

        <div class="page-header">
            <p class="text-seekers-color"><strong><?php echo($date_disp);?></strong></p>
        </div>

<?php

    $html = mb_convert_encoding(file_get_contents(htmlentities($url)), 'euc-jp', 'auto');
    if($html){
        echo($html);
    }
?>

<?php 
    $self_url = "http://" . $_SERVER["SERVER_NAME"] . $_SERVER["SCRIPT_NAME"] . "?" . $_SERVER["QUERY_STRING"];
?>

<div class="fb-like" data-href="<?php echo($self_url) ?>" data-send="true" data-width="450" data-show-faces="true"></div>
        <hr />

        <ul class="pager">
            <?php if ($prev_date) : ?>
                <li class="previous"><a href="diary.php?d=<?php echo $prev_date ?>">前の日記を見る</a></li>
            <?php endif; ?>
            <?php if ($next_date) : ?>
                <li><a href="top.php">最新</a></li>
                <li class="next"><a href="diary.php?d=<?php echo $next_date ?>">次の日記を見る</a></li>
            <?php endif; ?>
        </ul>

        <hr />

        <p class="second"><strong>徒然日記バックナンバー</strong></p>
        <ul>
    <?php
        foreach($file_arr as $date){
            $date_y = substr($date ,0,4);
            $date_m = substr($date ,4,2);
            $date_d = substr($date ,6,2);
            $date_disp = $date_y . '年' . $date_m . '月' . $date_d . '日';

            echo('<li><a href="diary.php?d=' . $date .'">' . $date_disp . 'の日記</a></li>');
        }
    ?>
        </ul>

    </div><!-- content-default -->
</div><!-- contents -->

<div id="footer">
    <p id="copyright">&copy;2005 SEEKERS,KYOTO All Rights Reserved.</p>
</div><!-- footer -->
</body>
</html>