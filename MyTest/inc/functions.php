<?php
function LoginCheck($username, $passwd, $pdo) {
    $param = array(
        ':email'=>$username,
        ':passwd'=>$passwd);
    //$sth = $pdo->prepare('COUNT(*) from Leerlingen,Docenten WHERE Leerlingen.username = :email AND Leerlingen.Password OR Docenten.email = :email AND Docenten.Password');
    $sth = $pdo->prepare('SELECT COUNT(*),UserId,voornaam,Instelling,Level from Leerlingen WHERE username = :email AND Password = :passwd');
    $sth2 = $pdo->prepare('SELECT COUNT(*),DocentId,DocentNaam,Level from Docenten WHERE email = :email AND Password = :passwd');
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
    } elseif($row2['COUNT(*)'] > 0) {
        $RetArr['LoggedIn'] = true;
        $RetArr['Docent'] = true;
        $RetArr['UserID'] = $row2['DocentId'];
        $RetArr['name'] = $row2['DocentNaam'];
        //$RetArr['instelling'] = $row['Instelling'];
        $RetArr['level'] = $row2['Level'];
    } else {
        $RetArr['LoggedIn'] = false;
    }

    return $RetArr;
    //return $row2;
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

function IsTeacherCheck($LeSession) {
    if(isset($LeSession['Docent'])) {
        if($LeSession['Docent'] == true) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function GetAvailableToetsen($pdo, $ToetsId) {
    $outString = " ";
    $outArr = array();

    $param = array(
        ':id'=>$ToetsId);
    $sth = $pdo->prepare('SELECT * from Toetsen WHERE ToetsId = :id');
    //$sth = $pdo->prepare('SELECT * from Toetsen');
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

function GetOpenToetsen($pdo, $UserId) {
    $out = array();
    $param = array(':UserId'=>$UserId);
    $sth = $pdo->prepare('SELECT ToetsId from LeerlingToetsen WHERE UserId = :UserId AND IsGemaakt = 0');
    $sth->execute($param);
    $row = $sth->fetchAll(PDO::FETCH_NUM);
    //return $row;
    for($i=0;$i<count($row);$i++) {
        $out[$i] = $row[$i][0];
    }
    return $out;
}

function EnableTest($pdo, $TeacherId) {
    $param = array(':id'=>$TeacherId);
    $sth = $pdo->prepare('SELECT * FROM toetsen,docentcategorieen WHERE docentcategorieen.DocentId = :id AND toetsen.ToetsCategorie = docentcategorieen.ToetsCategorie');
    $sth2 = $pdo->prepare('SELECT * FROM leerlingen,docentleerlingen WHERE docentleerlingen.DocentId = :id AND leerlingen.UserId = docentleerlingen.UserId');
    $sth->execute($param);
    $sth2->execute($param);
    $row = $sth->fetchAll(PDO::FETCH_NUM);
    $row2 = $sth2->fetchAll(PDO::FETCH_NUM);
    $ToetsPerLeerling = "";
    $AlleToetsen = '<select name="toets">';
    $AlleLeerlingen = '<select name="student>"';
    for($i=0;$i<count($row);$i++){
        $AlleToetsen = $AlleToetsen.'<option value="'.$row[$i][0].'">'.$row[$i][1].'</option>';
    }
    $AlleToetsen = $AlleToetsen."</select>";
    for($j=-1;$j<count($row2);$j++){
          $AlleLeerlingen = $AlleLeerlingen.'<option value="'.$row2[$j][0].'">'.$row2[$j][3].'</option>';
        //$AlleLeerlingen = $AlleLeerlingen.'<option value="'.$row2[$j][0].'">'.$row2[$j][3]."</option>";
        //$ToetsPerLeerling = $ToetsPerLeerling.'<input type="checkbox" name="leerling'.$j.'" value="'.$row2[$j][0].'">'.$row2[$j][3]."<br />";
    }
    $AlleLeerlingen = $AlleLeerlingen."</select>";
    $out = array($AlleLeerlingen, $AlleToetsen);
    return $out;
}

function UpdateEnableTest($pdo, $toetsId, $LeerlingId) {
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = <<<_SQL
INSERT INTO `leerlingtoetsen` (ToetsId, UserId, IsGemaakt)
VALUES (:ToetsId, :LeerlingId, :IsGemaakt)
_SQL;
            $sth = $pdo->prepare($sql);
            $sth->execute(array( // PHP 5.4 short array syntax, use array(...) if not available
    ':ToetsId'        => trim($toetsId),
    ':LeerlingId' => trim($LeerlingId),
    ':IsGemaakt'    => trim(0)
));
    return "toetsid: ".$toetsId." leerling id: ".$LeerlingId;
}

function InsertTestResult($pdo, $result, $ToetsId, $UserId) {
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = <<<_SQL
UPDATE `leerlingtoetsen` SET `Resultaat`=:Result, `IsGemaakt`=:IsGemaakt WHERE `ToetsId`=:ToetsId AND `UserId`=:UserId
_SQL;
//$sql = "UPDATE leerlingtoetsen SET Resultaat=:Result, IsGemaakt=:IsGemaakt WHERE ToetsId=:ToetsId AND UserId=:UserId";
            $sth = $pdo->prepare($sql);
            $sth->execute(array( // PHP 5.4 short array syntax, use array(...) if not available
    ':ToetsId'        => trim($ToetsId),
    ':LeerlingId'    => trim($UserId),
    ':Result'          => trim($result),
    ':IsGemaakt'    => trim(1)
));
}
?>