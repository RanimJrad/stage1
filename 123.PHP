<?php
session_start();
include('config.php');

if (isset($_POST["add"])) {
    if (isset($_SESSION["cart"])) {
        $item_array_id = array_column($_SESSION["cart"], "idPiece");
        if (!in_array($_GET["idPiece"], $item_array_id)) {
            $count = count($_SESSION["cart"]);
            $item_array = array(
                'idPiece' => $_GET["idPiece"],
                'nomPiece' => $_POST["nomPiece"],
                'prix' => $_POST["prix"],
                'quantite' => $_POST["quantite"],
            );
            $_SESSION["cart"][$count] = $item_array;
            echo '<script>window.location="123.php"</script>';
        } else {
            echo '<script>alert("la piece est ajouter au panier")</script>';
            echo '<script>window.location="123.php"</script>';
        }
    } else {
        $item_array = array(
            'idPiece' => $_GET["idPiece"],
            'nomPiece' => $_POST["nomPiece"],
            'prix' => $_POST["prix"],
            'quantite' => $_POST["quantite"],
        );
        $_SESSION["cart"][0] = $item_array;
    }
}

if (isset($_GET["action"])) {
    if ($_GET["action"] == "delete") {
        foreach ($_SESSION["cart"] as $keys => $value) {
            if ($value["idPiece"] == $_GET["idPiece"]) {
                unset($_SESSION["cart"][$keys]);
                echo '<script>alert("Piece est supprimer!")</script>';
                echo '<script>window.location="123.php"</script>';
            }
        }
    }
}
?>

<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shopping Cart</title>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <link
        href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Rufina:400,700" rel="stylesheet">

    <!-- title of site -->
    <title>AutoShop</title>

    <!-- For favicon png -->
    <link rel="shortcut icon" type="image/icon" href="assets/logo/favicon.png" />

    <!--font-awesome.min.css-->
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">

    <!--linear icon css-->
    <link rel="stylesheet" href="assets/css/linearicons.css">

    <!--flaticon.css-->
    <link rel="stylesheet" href="assets/css/flaticon.css">

    <!--animate.css-->
    <link rel="stylesheet" href="assets/css/animate.css">

    <!--owl.carousel.css-->
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/owl.theme.default.min.css">

    <!--bootstrap.min.css-->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <!-- bootsnav -->
    <link rel="stylesheet" href="assets/css/bootsnav.css">

    <!--style.css-->
    <link rel="stylesheet" href="assets/css/style copy.css">
    <link rel="stylesheet" href="assets/css/style.css">


    <!--responsive.css-->
    <link rel="stylesheet" href="assets/css/responsive.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

    <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

    <style>
        @import url('https://fonts.googleapis.com/css?family=Titillium+Web');

        * {
            font-family: 'Titillium Web', sans-serif;
        }


        table, th, tr {
            text-align: center;
        }

        .title2 {
            text-align: center;
            color: #66afe9;
            background-color: #efefef;
            padding: 2%;
        }

        h2 {
            text-align: center;
            color: #66afe9;
            background-color: #efefef;
            padding: 2%;
        }

        table th {
            background-color: #efefef;
        }
    </style>
</head>
<body>
<div class="header-area">
        <nav class="navbar navbar-default bootsnav  navbar-scrollspy" data-minus-value-desktop="70"
            data-minus-value-mobile="55" data-speed="1000" style="background-color: #1d027dc1; height: 80px; ">
            <div class="container">
                <div class="navbar-header" style="margin-top: -15px;">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                        <i class="fa fa-bars"></i>
                    </button>
                    <a class="navbar-brand" href="index.html"><span>AutoShop</span></a>
                </div>
                <div class="collapse navbar-collapse menu-ui-design" id="navbar-menu">
                    <ul class="nav navbar-nav navbar-right" data-in="fadeInDown" data-out="fadeOutUp">
                        <li class="scroll active" style="margin-top: -15px;"><a href="#home">Acceuil</a></li>
                        <li class="scroll active"><a href="#Produits" style="margin-top: -15px;">Produits</a></li>
                        <li class="scroll"><a href="panier.php" style="margin-top: -15px;">Panier</a></li>
                        <li><a href="login.html" style="margin-top: -15px;">Mon compte</a></li>
                        <li><a href="contact.html" style="margin-top: -15px;">contact</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
<section>
<div class="container" style="margin-top: 100px;">
    
    <div >
    <p style="font-size: 40px;">Panier </p>
    </div>
    
    <div class="">
        <table class="table table-bordered">
            <tr>
                <th width="30%">Nom Piece </th>
                <th width="10%">Qantité</th>
                <th width="20%">Prix</th>
                <th width="10%">Totale</th>
                <th width="20%">Supprimer Piece </th>
            </tr>

            <?php
            if (!empty($_SESSION["cart"])) {
                $total = 0;
                foreach ($_SESSION["cart"] as $key => $value) {
                    ?>
                    <tr>
                        <td><?php echo $value["nomPiece"]; ?></td>
                        <td><?php echo $value["quantite"]; ?></td>
                        <td>$ <?php echo $value["prix"]; ?></td>
                        <td>$ <?php echo number_format($value["quantite"] * $value["prix"], 2); ?></td>
                        <td><a href="123.php?action=delete&idPiece=<?php echo $value["idPiece"]; ?>"><span
                                    class="text-danger">Supprimer Piece</span></a></td>
                    </tr>
                    <?php
                    $total = $total + ($value["quantite"] * $value["prix"]);
                }
                ?>
                <tr>
                    <td colspan="3" align="right">Totale</td>
                    <th align="right">$ <?php echo number_format($total, 2); ?></th>
                    <td></td>
                </tr>
                <?php
            }
            ?>
        </table>
    </div>
</div>
</section>
</body>
</html>
