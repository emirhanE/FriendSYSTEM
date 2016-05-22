<?php
include "config.php";
$id = $_GET["id"];
$query = $db->select("istekler","INNER JOIN","users ON users.id = istekler.gonderen_id WHERE durum = 0");
if ($id != $_SESSION["id"])
{
    echo "Başkasının istek tablosuna maalesef giremiyoruz :) Bunu denemek daha faydalı <a href='istekler.php?id=".$_SESSION['id']."'>Benim profilim</a>";
}
else
{
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>İstek listesi - Arkadaşlık sistemi</title>
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
            padding: 5px;
            font-family: Verdana;
            font-size: 12px
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
<div class="uyeler">
    <div class="title">
        İstek listesi
    </div>
    <div class="icerik">
        <ul>
            <?php
            while($row = $query->fetch(PDO::FETCH_ASSOC))
            {
                if ($row["gonderilen_id"] == $_SESSION["id"])
                {
                    ?>
                    <li>
                        <b><?php if ($row["gonderen_id"] == $row["id"]){ echo "".$row["name"].""; } ?></b> sizi arkadaş listesine eklemek istiyor. <span style="float: right;"><a href="istekekle.php?id=<?php echo $row["iid"]; ?>">Ekle</a></span><span style="float: right; margin-right: 15px"><a href="yoksay.php?id=<?php echo $row["iid"]; ?>">Yok Say</a></span>
                    </li>
                    <?php
                }
            }
            ?>
        </ul>
    </div>
</div>
</body>
</html>
<?php } ?>