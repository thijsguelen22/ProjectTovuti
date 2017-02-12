
<style>
    #breadcrumbs {
        background-color: hsla(0, 0%, 100%, 0.6);
        height: 25px;
        margin-top: -16px;
        width: 100%;
    }
    .BreadCrumbPage {
        color: #FF6A00;
        font-weight: bold;
    }
    .BCEnd {
        color: black !important;
    }
    #top {
        margin: -8px;
        margin-top: -25px;
        padding: 0;
        position: fixed;
        width: 100%;
    }
    ul {
        font-family: Calibri, Candara, Segoe, "Segoe UI", Optima, Arial, sans-serif;
        list-style-type: none;
        padding: 0;
        overflow: hidden;
        background-color: #575556;
    }

    li {
        float: left;
    }

        li a {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

            /* Change the link color to #111 (black) on hover */
            li a:hover {
                background-color: #FF6A00;
            }
</style>
<?php
session_start();
echo '<div id="top"><ul class="menu-list"><li class="menu-item"><a href="./index.php">Home</a></li>';
if($_SESSION['level'] == 1 || $_SESSION['level'] == 2) {
	echo '<li class="menu-item"><a href="./toetsen.php">Toetsen</a></li><li style="float:right" class="menu-item"><a href="./account.php">Account</a></li>';
}
echo '<li class="menu-item"><a href="./contact.php">Contact</a></li></ul>';
$path = substr($_SERVER['PHP_SELF'], 1);

$BCArr = explode("/",substr($path, 0, strpos($path, ".")));
$BCArrC = count($BCArr);
$BCLink = array();
echo '<div id="breadcrumbs"><a href="http://'.$_SERVER['HTTP_HOST'].'" class="BreadCrumbPage">Home</a> > ';
for($i=0;$i<$BCArrC-1;$i++) {
    if($i != ($BCArrC - 2)) {
        for($j=0;$j<$i+1;$j++) {
            //$BCLink = $BCLink.$BCArr[$j];
            $BCLink[$j] = $BCLink[$i].$BCArr[$j];
        }
        echo '<a href="./'.$BCLink[$i].'" class="BreadCrumbPage">'.$BCArr[$i]."</a> > ";
    } else {
        echo '<span class="BreadCrumbPage BCEnd">'.$BCArr[$i]."</span>";
    }

}
echo '</div</div>';
//$actual_path = substr($path, 0, strpos($path, "."));
echo '<br /><br /><br />';


?>