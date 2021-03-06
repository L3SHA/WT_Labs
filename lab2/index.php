<!Doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Yandex Drive</title>
        <link rel="stylesheet" type="text/css" href="/css/main.css">
        <link rel="stylesheet" type="text/css" href="/css/albums.css">
        <link rel="stylesheet" type="text/css" href="/css/history.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
        <?style_ref_change()?>
    </head>

    <body>
        <div class="grid-container">
            <?php include("blocks/header.php");?>
            <?php include("blocks/sidebar.php");?>
            <article class="grid content">
                <?php get_content_page();?>
            </article>
        </div>
    </body>
</html>

<?php
    function get_content_page(){
      if(isset($_GET["page_name"])){
          $page = "blocks/content/" . $_GET["page_name"] . ".php";
          return include($page);
      }else {
          return include("blocks/content/files.php");
      }
    }

    function style_ref_change(){
        if(isset($_GET["page_name"])){
            $style = "<style> #" . $_GET["page_name"] . "{background: #4a423f; }</style>";
        }
        else {
            $style = "<style>#files {background: #4a423f}</style>";
        }
        echo $style;
    }

    function mb_ucfirst($str){
        return mb_strtoupper(mb_substr($str, 0 ,1)) . mb_substr($str, 1, NULL);
    }

    function get_handled_string(){
        if((isset($_POST["search"])) && ($_POST["search"] !== "")){
            $str = $_POST["search"];
            $delimiter = ", ";
            $temp_arr = explode($delimiter, $str);
            $temp_arr = array_reverse($temp_arr);
            foreach ($temp_arr as $key => $value) {
                $temp_arr[$key] = mb_strtolower($value, "utf8");
            }
            $temp_arr[0] = mb_ucfirst($temp_arr[0]);
            $temp_arr[0] = str_replace(".", "", $temp_arr[0]);
            $str = implode($delimiter, $temp_arr) . ".";
        }
        echo "<p>" . $str . "<p>";
    }
?>
