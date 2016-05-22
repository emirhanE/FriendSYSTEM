<?php
include "config.php";
$id = $_GET["id"];
$query = $db->select("users","WHERE","id = $id");
$row = $query->fetch(PDO::FETCH_ASSOC);
if ($row["id"] != $id)
{
?>
    <style>
        .div {
            width: 500px;
            padding: 10px;
            background: #3498ee;
            border: 1px solid #3498ee;
            color: #fff
        }
    </style>
    <div class="div">Maalesef böyle bir kullanıcı yok.</div>
<?php
}
else
{
?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <title><?php echo $row["name"]; ?> - Arkadaşlık sistemi</title>
        <style>
            body {
                background: #eee;
            }
            .profil {
                width: 650px;
                border: 1px solid #ccc;
                background: #fff;
                position: relative;
            }
            .profil .img {
                width: 150px;
                height: 150px;
            }
            .profil .img img {
                width: 100%;
                height: 100%;
                margin: 0px
            }
            .profil .name {
                position: absolute;
                margin-left: 175px;
                top: 70px;
                font-size: 13px;
                font-family: verdana
            }
            .right {
                right: 10px;
                top: 62px;
                position: absolute;
            }
            .right button {
                background: #e9e9e9;
                text-decoration: none;
                padding: 10px;
                color: #484848;
                border: 0;
                cursor: pointer;
            }
            .right button:hover {
                background: #dadada;
            }
        </style>
    </head>
    <body>
        <div class="profil">
            <div class="img">
                <img src="<?php echo $row["image"]; ?>" alt="">
            </div>
            <div class="name">
                <?php echo $row["name"]; ?>
            </div>
            <div class="right">
                <?php
                if ($_POST)
                {
                    $set = "gonderen_id = '".$_SESSION["id"]."', gonderilen_id = '$id', tur = 'istek'";
                    $query = $db->insert("istekler",$set);
                    if ($query)
                    {
                        echo "<script>alert('Arkadaşlık isteğiniz başarılı bir şekilde gönderilmiştir!')</script>";
                    }
                    else
                    {
                        echo "<script>alert('Bir sorun oluştu!')</script>";
                    }
                }
                ?>
                <?php
                $query = $db->select("istekler","WHERE","gonderen_id = ".$_SESSION['id']." and gonderilen_id = $id"." or gonderen_id= ".$id." and gonderilen_id=".$_SESSION['id']);
                $gelenVeri = $query->fetch(PDO::FETCH_ASSOC);
                if($gelenVeri["durum"]=="")
                {
                ?>
                    <form action="" method="post">
                        <button name="ekle" type="submit">Arkadaşı ekle</button>
                    </form>
                <?php
                }
                else if($gelenVeri["durum"]==1)
                {
                ?>
                    <button>Zaten arkadaşsınız!</button>
                <?php
                }
                else
                {
                ?>
                    <button>Zaten arkadaşlık isteği göndermişsin!</button>
                <?php
                }
                ?>
            </div>
        </div>
    </body>
    </html>
<?php
}
?>
