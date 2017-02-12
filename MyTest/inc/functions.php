<?php
function LoginCheck($username, $passwd, $pdo) {
    $param = array(
        ':email'=>$username,
        ':passwd'=>$passwd);
    //$sth = $pdo->prepare('COUNT(*) from Leerlingen,Docenten WHERE Leerlingen.username = :email AND Leerlingen.Password OR Docenten.email = :email AND Docenten.Password');
    $sth = $pdo->prepare('SELECT COUNT(*),UserId,voornaam,Instelling,Level from Leerlingen WHERE username = :email AND Password = :passwd');
    $sth2 = $pdo->prepare('SELECT COUNT(*),* from Docenten WHERE Docenten.email = :email AND Password = :passwd');
    $sth->execute($param);
    $sth2->execute($param);
    $row = $sth->fetch(PDO::FETCH_ASSOC);
    $row2 = $sth2->fetch(PDO::FETCH_ASSOC);
    if($row['COUNT(*)'] > 0) {
        $RetArr['LoggedIn'] = true;
        $RetArr['Docent'] = false;
        $RetArr['UserID'] = $row['UserId'];
        $RetArr['name'] = $row['voornaam'];
        $RetArr['instelling'] = $row['Instelling'];
        $RetArr['level'] = $row['Level'];
    } elseif($row2 > 1) {
        $RetArr['LoggedIn'] = true;
        $RetArr['Docent'] = true;
        $RetArr['UserID'] = $row['UserId'];
        $RetArr['name'] = $row['voornaam'];
        $RetArr['instelling'] = $row['Instelling'];
        $RetArr['level'] = $row['Level'];
    } else {
        $RetArr['LoggedIn'] = false;
    }

    return $RetArr;
}

function IsLoggedInCheck($LeSession) {
    if(isset($LeSession['LoggedIn'])) {
        if($LeSession['LoggedIn'] = true) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function GetAvailableToetsen($pdo, $cat) {
    $outString = " ";
    $outArr = array();

    $param = array(
        ':cat'=>$cat);
    //$sth = $pdo->prepare('SELECT * from Toetsen WHERE Toetscategorie = :cat');
    $sth = $pdo->prepare('SELECT * from Toetsen');
    $sth->execute($param);
    $row = $sth->fetchAll(PDO::FETCH_NUM);
    //return $row;
    for($i=0;$i<count($row);$i++) {
        $outString = $outString.'<a href="./toetsen.php?toetsID='.$row[$i][0].'">'.$row[$i][1].'</a><br />';
    }
    //return $outArr;
    return $outString;
}

function GetToetsVragen($pdo, $ToetsId) {
    $out = array();
    $param = array(':ToetsId'=>$ToetsId);
    $sth = $pdo->prepare('SELECT * from Vragen WHERE ToetsId = :ToetsId');
    $sth->execute($param);
    $row = $sth->fetchAll(PDO::FETCH_NUM);
    for($i=0;$i<count($row);$i++) {
        $_SESSION['AantalVragen'] = count($row);
        $param = array(':VraagId'=>intval($row[$i][0]));
        $kekout = $row[$i][0];
        $sth = $pdo->prepare('SELECT * FROM antwoorden WHERE VraagId = :VraagId');
        $sth->execute($param);
        $row2 = $sth->fetchAll(PDO::FETCH_NUM);
        $out[$i]['vraag'] = $row[$i][1];
        $out[$i]['vraagID'] = $row[$i][0];
        $out[$i]['antwoorden'] = $row2;
        /*for($j=0;$j<3;$j++) {
            $out[$i]['antwoorden'][$j] = $row2[$j];
        }*/

        //array_merge($out[$i]['antwoorden'], $row2);

        //$out[$i]['antwoorden'] = array("antwoord"=>$row2[1], "IsGoed"=>$row2[2]);
    }

    //return $row;

    /*
    for($i=0;$i<count($row);$i++) {
        $out = $out.'<a href="./toetsen.php?toetsID='.$row[$i][0].'">'.$row[$i][1].'</a><br />';
    }
    return $out;
    */
    return $out;
}
?>