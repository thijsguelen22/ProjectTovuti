<?php
session_start();
if(empty($_SESSION)) {
    $_SESSION['ToetsResultaten']['fout'] = $_SESSION['ToetsResultaten']['goed'] = 0;
}
$ToetsArr = $_SESSION['ToetsArr'];
if(!isset($_SESSION['VraagNummer'])) {
    $_SESSION['VraagNummer'] = 1 ;
}
$i = $_SESSION['VraagNummer'];
echo '<div id="login">';
    echo "<h2>".$ToetsArr[$i]['vraag']."</h2>";
    echo "<table>";
    $j = 0;
    if(isset($_POST['next'])) {
        if($_POST['answer'] == $_SESSION['JuisteAntwoord']) {
            $_SESSION['ToetsResultaten']['goed'] = $_SESSION['ToetsResultaten']['goed'] + 1;
            $_SESSION['JuisteAntwoord'] = NULL;
        } else {
            $_SESSION['ToetsResultaten']['fout'] = $_SESSION['ToetsResultaten']['fout'] + 1;
            $_SESSION['JuisteAntwoord'] = NULL;
        }
         $_SESSION['VraagNummer'] = $_SESSION['VraagNummer'] + 1;
    } else {
        $_SESSION['VraagNummer'] = 0;
    }
    if($_SESSION['VraagNummer'] != $_SESSION['AantalVragen'] + 1) {
        echo '<form method="POST">';
        for($j=0;$j<4;$j++) {
            if($ToetsArr[$i]['antwoorden'][$j][2] == 1) {
                $_SESSION['JuisteAntwoord'] = $j;
            }
            echo '<input type="radio" name="answer" value="'.$j.'" /><span class="ToetsVraag">'.$ToetsArr[$i]['antwoorden'][$j][1]."</span><br />";
            //echo '<tr><td><input type="radio" value="'.$j.'" />'.$ToetsArr[$i]['antwoorden'][$j][1].'</td><td><input type="radio" value="'.($j + 1).'" />'.$ToetsArr[$i]['antwoorden'][($j + 1)][1]."</td></tr>";
        }
    } else {
        echo "De toets is afgerond.<br />";
        $punt = (($_SESSION['ToetsResultaten']['goed'] / ($_SESSION['ToetsResultaten']['goed'] + $_SESSION['ToetsResultaten']['fout'])) * 10);
        echo $punt;
        echo "resultaat: ".$punt;
        InsertTestResult($pdo, $punt, $_SESSION['GemaakteToetsID'], $_SESSION['UserId']);
        $_SESSION['GemaakteToetsID'] = $_SESSION['ToetsArr'] = $_SESSION['JuisteAntwoord'] = $_SESSION['VraagNummer'] = $_SESSION['ToetsResultaten'] = null;
    }
        //echo "<tr><td>".$ToetsArr[$i]['antwoorden'][$j][1]."</td><td>".$ToetsArr[$i]['antwoorden'][($j + 1)][1]."</td></tr>";
        //$j++;
        echo '<input type="submit" value="next" name="next" /></form>';
        echo '</div>';

?>