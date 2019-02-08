<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="css/product-information.css">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <title>product-information</title>
</head>
<body>
    <?php
    include "hamburger-menu.php";
?>  
    <!--NAVBAR-->
             <!--NAVBAR-->
    <div class="landingspage-navbar-container navbar-fixed">
    <div class="navbar-logo animated bounceInUp">
        <img src="images/logo-foodsavers.png" alt="logo">
    </div>
    <div class="navbar-hamburger-menu animated bounceInUp">
        <span onclick="openNav()">&#9776;</span>
    </div>
</div>

    <div class=product-information-container>
        <?php
        include "db-connection.php";

            $product_id = $_GET["product_id"];
            // $sql = "SELECT * FROM product WHERE product_id = '$product_id'";
            $sql = "SELECT * FROM product INNER JOIN users on product.user_id = users.user_id
            WHERE product_id='$product_id'";

            $data = $conn->query($sql);

            foreach($data as $row)
            {
                    $_SESSION['product_id'] = $row['product_id'];
            
                if(isset($_SESSION["lat"])){
                    $afstand = distance($row['lat'], $row['lon'], $_SESSION['lat'], $_SESSION['lon'], 6371000);
                    } else{
                        $afstand = 10000;
                    }
                $htmlOutput  = "";
                $htmlOutput  = '<div class="product-information-card">';
                $htmlOutput .= '<img src="uploads/' . $row['imagelist'] . '" style="width:75%">';
                $htmlOutput .= '<h1>'. '<div class="products-information-title">' . $row['title'] . '</h1>';
                $htmlOutput .= '<b>'. '<div class="products-information-expire-date">' . 'houdsbaarheids datum&nbsp;'. '</b>' . '<div class=date-color>' . $row['expire_date'] . '</div>';
                $htmlOutput .= '<br>';
                if(isset($_SESSION["lat"])){
                            $htmlOutput .= '<b>'. '<div class"products-information-distance">' . 'afstand&nbsp;' . '</b>' . '<div class=distance-color>' . round($afstand / 1000) . 'KM' . '</div>';
                } else{
                    $htmlOutput .= '<b>'. '<div class"products-information-distance">' . 'afstand&nbsp;' . '</b>' . '<div class=distance-color> deel locatie om afstand te berekenen.</div>';
                }
                $htmlOutput .= '<br>';
                $htmlOutput .= '<div class="products-information-info">' . $row['description'];
                $htmlOutput .= '</div>'; 
                $htmlOutput .= '<div class="product-information-button">';
                if(isset($_SESSION["user_id"])){
                $htmlOutput .= '<p>'. '<a href="message.php?screenname=' . $row['screenname'] . '"><button>'. '<img src="images/chat.png" height="40" width="40">' . '</button>' .  '</a>' . '</p>';
                if ($row['accept_phone'] === "true"){
                    $htmlOutput .= '<p>'. '<a href="tel:' . $row['phone_number'] . '"><button>'. '<img src="images/smartphone.png" height="40" width="40">' . '</button>' . '</a>' . '</p>';
                    }
                    if ($row['accept_email'] === "true"){
                    $htmlOutput .= '<p>'. '<a href="mailto:' . $row['email'] . '"><button>' . '<img src="images/email.png" height="40" width="40">' . '</button>' . '</p>';
                    }}
                // $htmlOutput .= '<p>'. '<button>'. '<img src="images/handshake.png" height="50" width="35">' . '</button>' . '</a>' . '</p>';
                $htmlOutput .= '</div>';
echo $htmlOutput;

}
function distance(
  $latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000)
{
  // convert from degrees to radians
  $latFrom = deg2rad($latitudeFrom);
  $lonFrom = deg2rad($longitudeFrom);
  $latTo = deg2rad($latitudeTo);
  $lonTo = deg2rad($longitudeTo);

  $latDelta = $latTo - $latFrom;
  $lonDelta = $lonTo - $lonFrom;

  $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
    cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
  return $angle * $earthRadius;
};
?>

    </div>
</body>
</html>