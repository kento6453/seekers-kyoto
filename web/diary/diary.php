<?php

    // GET�ѥ�᡼��"d"����ɽ���оݤ����դ����
    $date = htmlentities($_GET['d']);

    $url = "diary_src/" . $date.".html";

    $date_y = substr($date ,0,4);
    $date_m = substr($date ,4,2);
    $date_d = substr($date ,6,2);
    $date_disp = $date_y . 'ǯ' . $date_m . '��' . $date_d . '��';

    //�ǥ��쥯�ȥ���Υե�����̾�򣱤Ĥ��Ĥ������������˳�Ǽ
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

    // ���ս�˥ե�����򥽡���
    sort($file_arr);

    $this_index = array_search($date,$file_arr);
    $prev_date = $file_arr[$this_index-1];
    $next_date = $file_arr[$this_index+1];

    // ���ս�˥ե������߽祽���ȡʥХå��ʥ�С��ѡ�
    rsort($file_arr);


?><!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="euc-jp" />
<title>����������� | <?php echo($date_disp); ?> - ���ɤ������������������Բϸ�Į���</title>

<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="description" content="<?php echo($date_disp); ?>�Υ���������ŹĹ��������������������������ϵ��ԡ��ϸ�Į���ˤ��롢���ɤ����ʻҶ����ˤΥ��쥯�ȥ���åפǤ���" />
<meta name="keywords" content="�֥�,�Ҷ���,���ɤ���,�ϸ�Į,����,���,����������,SEEKERS,�������˥å�,����ݡ���,KP" />

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
            <h1><a href="../index.html" title="���ԡ��ϸ�Į���ˤ��롢���ɤ����ʻҶ����ˤΥ��쥯�ȥ���å� �����������Υȥåץڡ�����"><img src="../image/menu_mark.gif" width="60" height="83" alt="���ԡ��ϸ�Į���ˤ��롢���ɤ����ʻҶ����ˤΥ��쥯�ȥ���å� ����������" /></a></h1>
        </div><!-- header-logo -->
        <div id="header-navigation">
            <ul class="clearfix" id="diary">
                <li class="cell1"><a href="../message.html"><span>��å�����</span></a></li>
                <li class="cell2"><a href="../brand.html"><span>��갷���֥���</span></a></li>
                <li class="cell3"><a href="../cordinate.html"><span>�������ᥳ���ǥ��͡���</span></a></li>
                <li class="cell4"><a href="../shopinfo.html"><span>Ź�޾��󡦸��̥�������</span></a></li>
                <li class="cell5"><a href="top.php"><span>�����������(�֥�)</span></a></li>
                <li class="cell6"><a href="../sanpomap.html"><span>��򤫤��襤������ޥå�</span></a></li>
                <li class="cell7"><a href="../coupon.html"><span>�����ӥ������ݥ�</span></a></li>
                <li class="cell8"><a href="../link.html"><span>���</span></a></li>
            </ul>
        </div><!-- header-navigation -->
    </div><!-- header-inner -->
</div><!-- header -->

<div id="contents">
    <div class="content-default">
        <h2 class="page-title"><img src="../image/tytle_diary.gif" width="407" height="28" alt="������������������˽񤤤Ƥ��ޤ������Ԥ��餷���������줳�졣" /></h2>

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
                <li class="previous"><a href="diary.php?d=<?php echo $prev_date ?>">���������򸫤�</a></li>
            <?php endif; ?>
            <?php if ($next_date) : ?>
                <li><a href="top.php">�ǿ�</a></li>
                <li class="next"><a href="diary.php?d=<?php echo $next_date ?>">���������򸫤�</a></li>
            <?php endif; ?>
        </ul>

        <hr />

        <p class="second"><strong>���������Хå��ʥ�С�</strong></p>
        <ul>
    <?php
        foreach($file_arr as $date){
            $date_y = substr($date ,0,4);
            $date_m = substr($date ,4,2);
            $date_d = substr($date ,6,2);
            $date_disp = $date_y . 'ǯ' . $date_m . '��' . $date_d . '��';

            echo('<li><a href="diary.php?d=' . $date .'">' . $date_disp . '������</a></li>');
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