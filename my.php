<?php
include "config.php";
$id = $_GET["id"];
if ($id != $_SESSION["id"])
{
    echo "Başkasının arkadaş tablosuna maalesef giremiyoruz :) Bunu denemek daha faydalı <a href='my.php?id=".$_SESSION['id']."'>Benim profilim</a>";
}
else
{
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Arkadaş listem</title>
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

<div class="uyeler">
    <div class="title">
        Arkadaş listem
    </div>
    <div class="icerik">
        <ul>
            <?php
                if ($query = $db->select("friends","INNER JOIN","users ON users.id = friends.friend_id WHERE my_id = ".$_SESSION["id"]." || friend_id = ".$_SESSION["id"].""))
                {
                    foreach ($query as $row)
                    {
                    ?>
                        <li>
                            <a href="friend.php?id=<?php
                                if($_SESSION["id"]==$row["my_id"]){
                                    echo $row["friend_id"];
                                }else{
                                    echo $row["my_id"];
                                }

                            ?>">
                                <?php
                                if($row["friend_id"]==$_SESSION["id"])
                                {
                                    $query = $db->select("users","WHERE","id = ".$row["my_id"]);
                                    $row = $query->fetch(PDO::FETCH_ASSOC);
                                    echo $row["name"];
                                }
                                else if( $row["my_id"] == $_SESSION["id"] )
                                {
                                    $query = $db->select("users","WHERE","id=".$row["friend_id"]);
                                    $row = $query->fetch(PDO::FETCH_ASSOC);
                                    echo $row["name"];
                                }
                                ?>
                            </a>
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