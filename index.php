<?php include "config.php"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Arkadaşlık sistemi</title>
    <style>
        body {
            background: #eee;
        }
        .uyeler {
            width: 500px;
            margin: 20px;
            border: 1px solid #ccc;
            background: #fff;
            padding: 10px
        }
        .uyeler .title {
            width: 100%;
            background: #ededed;
            font-family: Verdana;
            font-size: 12px;
            padding: 10px;
            box-sizing: border-box;
        }
        .uyeler .icerik ul {
            margin: 0;
            padding: 0;
        }
        .uyeler .icerik ul li {
            list-style: none;
            margin-top: 10px;
            width: 100%;
            background: #efefef;
            box-sizing: border-box;
            padding: 5px
        }
        .uyeler .icerik ul li a {
            color: #484848;
            text-decoration: none;
        }
        .uyeler .icerik ul li a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<?php

if ($_SESSION["login"])
{
?>
    <?php
        $query2 = $db->select("istekler","WHERE","gonderilen_id = ".$_SESSION['id']." AND durum = 0");
        $row2 = $query2->fetch(PDO::FETCH_ASSOC);
    ?>
    <a href='cikis.php'>Çıkış yap</a> | hoşgeldin, <a href="my.php?id=<?php echo $_SESSION["id"]; ?>"><?php echo $_SESSION["name"]; ?></a> | <a href="istekler.php?id=<?php echo $_SESSION["id"]; ?>">İstekler</a> : <?php if ($row2["gonderilen_id"] == $_SESSION["id"] && $row2["durum"] == 0 && $row2["tur"] == "istek"){ echo $query2->rowCount(); }else { echo "0"; } ?>
    <div class="uyeler">
        <div class="title">
            Sitedeki üyeler
        </div>
        <div class="icerik">
            <ul>
                <?php
                $query = $db->select("users","WHERE","id != ".$_SESSION["id"]." ORDER BY rand()");
                foreach ($query as $row)
                {
                    echo "<li><a href='friend.php?id=".$row["id"]."'>".$row['name']."</a></li>";
                }
                ?>
            </ul>
        </div>
    </div>
<?php
}
else
{
    if ($_POST)
    {
        $email = $_POST["email"];
        $password = $_POST["password"];
        if (!$email)
        {
            echo "<font color='red'>Email alanı boş bırakılamaz.</font>";
        }
        else if (!$password)
        {
            echo "<font color='red'>Şifre alanı boş bırakılamaz.</font>";
        }
        else
        {
            $query = $db->select("users","WHERE","email = '$email' && password = '$password'");

            if (!$query->rowCount())
            {
                echo "<font color='red'>Böyle bir üye yok.</font>";
            }
            else
            {
                $row = $query->fetch(PDO::FETCH_ASSOC);
                $_SESSION["login"] = true;
                $_SESSION["email"] = $email;
                $_SESSION["password"] = $password;
                $_SESSION["name"] = $row["name"];
                $_SESSION["id"] = $row["id"];
                header("Location: index.php");
            }
        }
    }
?>
    <form action="" method="post">
        <span><input type="text" name="email" placeholder="Email adresi"></span>
        <span><input type="password" name="password" placeholder="Şifre"></span>
        <span><input type="submit" value="Giriş yap"></span>
    </form>
<?php
}

?>

</body>
</html>