<?php
session_start();

include('config.php');

$nomPiece = $_POST['nomPiece'];
$refPiece = $_POST['refPiece'];
$prix = $_POST['prix'];
$quantite = $_POST['quantite'];

$total = $prix * $quantite;

$insert_query = "INSERT INTO panier(nomPiece, refPiece, prix, quantite, total) VALUES  (:nomPiece, :refPiece, :prix, :quantite, :total)";

$stmt = $conn->prepare($insert_query);

$stmt->bindParam(':nomPiece', $nomPiece, PDO::PARAM_STR);
$stmt->bindParam(':refPiece', $refPiece, PDO::PARAM_STR);
$stmt->bindParam(':prix', $prix, PDO::PARAM_INT);
$stmt->bindParam(':quantite', $quantite, PDO::PARAM_INT);
$stmt->bindParam(':total', $total, PDO::PARAM_INT);

$stmt->execute();

$ReadSql = "SELECT * FROM panier";

$stmt = $conn->prepare($ReadSql);
$stmt->execute();
$res = $stmt->fetchAll(PDO::FETCH_ASSOC);

$totalSum = array_sum(array_column($res, 'total'));




?>

<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Panier</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-GLhlTQ8iK7l5lOpI5IBDIKS9PsfkDf2tcDh69/uF2JbIq1FkGJ2jz2IfQ+JwL4" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-tz0MWiL4AA8YJ+gFkM7nGOxVl4T7pDBrAVZuLzG/LaTdaq3Cq6tgRSTzOY3qcpce"
        crossorigin="anonymous"></script>




    <link
        href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Rufina:400,700" rel="stylesheet">

    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

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


        table,
        th,
        tr {
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
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                        <i class="fa fa-bars"></i>
                    </button>
                    <a href="index.html"> <img src="assets/images/brand/AUT__3_-removebg-preview.png" alt=""></a>
                </div>
                <div class="collapse navbar-collapse menu-ui-design" id="navbar-menu">
                    <ul class="nav navbar-nav navbar-right" data-in="fadeInDown" data-out="fadeOutUp">
                        <li class="scroll active" style="margin-top: -15px;"><a href="#home">Acceuil</a></li>
                        <li class="scroll active"><a href="#Produits" style="margin-top: -15px;">Produits</a></li>
                        <li><a href="ajouterPanier.php" style="margin-top: -15px;">Panier</a></li>
                        <li><a href="login.html" style="margin-top: -15px;">Mon compte</a></li>
                        <li><a href="contact.html" style="margin-top: -15px;">contact</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <section>
        <div class="container" style="margin-top: 100px;">

            <div>
                <p style="font-size: 40px;">Panier </p>
            </div>

            <div class="">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th width="30%">Nom Piece </th>
                            <th width="20%">Ref Piece </th>
                            <th width="10%">Qantité</th>
                            <th width="20%">Prix</th>
                            <th width="10%">Totale</th>
                            <th width="10%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($res as $r) { ?>
                            <tr>
                                <td>
                                    <?php echo $r['nomPiece']; ?>
                                </td>
                                <td>
                                    <?php echo $r['refPiece']; ?>
                                </td>
                                <td>
                                    <?php echo $r['quantite']; ?>
                                </td>
                                <td>
                                    <?php echo $r['prix']; ?> DNT
                                </td>
                                <td>
                                    <?php echo $r['total']; ?> DNT
                                </td>
                                <td>
                                    <form action="supprimerPanier.php" method="post">
                                        <input type="hidden" name="id" value="<?php echo $r['id']; ?>">
                                        <button type="submit" class="btn btn-danger">
                                            Supprimer
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php } ?>
                        <tr>
                            <td colspan="4" style="text-align:right; font-weight:bold;">Total:</td>
                            <td>
                                <?php echo $totalSum; ?> DNT
                            </td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <form action="commande.html" method="post">
                <button type="submit" class="btn btn-primary">Commander</button>
            </form>
        </div>
    </section>
</body>

</html>