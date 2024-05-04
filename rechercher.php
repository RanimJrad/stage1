<?php
session_start();

include('config.php');

$marque = $_POST['marque'];
$modele = $_POST['modele'];
$categorie = $_POST['categorie'];

$categorie_query = "SELECT codeCategorie, nomCategorie FROM categorie WHERE nomCategorie = :categorie";
$result = $conn->prepare($categorie_query);
$result->bindParam(':categorie', $categorie);
$result->execute();

if ($result->rowCount() > 0) {
    $row = $result->fetch(PDO::FETCH_ASSOC);
    $codeCategorie = $row['codeCategorie'];
    $nomCategorie = $row['nomCategorie'];

    $query = "SELECT * FROM piece WHERE marqueVoiture= :marque AND modeleVoiture= :modele AND  codeCategorie= :codeCategorie";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':marque', $marque, PDO::PARAM_STR);
    $stmt->bindParam(':modele', $modele, PDO::PARAM_STR);
    $stmt->bindParam(':codeCategorie', $codeCategorie, PDO::PARAM_STR);
    $stmt->execute();
    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>



<!doctype html>
<html class="no-js" lang="en">

<head>
    <!-- meta data -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!--font-family-->
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
                        <li><a href="index.html" style="margin-top: -15px;">Catégories</a></li>
                        <li class="scroll"><a href="panier.php" style="margin-top: -15px;">Panier</a></li>
                        <li><a href="login.html" style="margin-top: -15px;">Mon compte</a></li>
                        <li><a href="contact.html" style="margin-top: -15px;">contact</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>

    <section  style="margin-top: 100px;">
        <div class="container vw-100 mb-4">
            <div style="margin-bottom: 30px; display: flex; justify-content: center;">
                <div style="width: 70%;">
                    <div class="input-group" style="width: 900px">
                        <input type="search" id="searchInput" onkeyup="filterProducts()" class="form-control"
                            placeholder="Rechercher" />
                    </div>
                </div>
            </div>
            <div>
                <p style="font-size: 40px;">
                    <?php echo $nomCategorie; ?>
                </p>
            </div>


            <?php foreach ($res as $r) { ?>
                <div class="card col-md-4" style="height: 450px; margin-right: 15px; margin-bottom: 15px;">
                    <img src="autoshop/ecommerce/images/<?php echo $r['image']; ?>" class="card-img-top" alt="">
                    <div class="card-body">
                        <h5 class="card-title">
                            <?php echo $r['nomPiece'] . ' ' . $r['marquePiece']; ?>
                        </h5>
                        <p class="card-text">
                            <?php echo 'Ref : ' . $r['refPiece']; ?>
                        </p>
                        <p class="card-text">
                            <?php echo $r['prix'] . ' DNT' ?>
                        </p>
                        <p class="card-text ">
                            <?php echo $r['description']; ?>
                        </p>
                    </div>
                    <div class="card-body">
                        <form action="ajouterPanier.php" method="post">
                            <input type="hidden" name="idOiece" value="<?php echo $r['idPiece']; ?>">
                            <input type="hidden" name="nomPiece" value="<?php echo $r['nomPiece']; ?>">
                            <input type="hidden" name="refPiece" value="<?php echo $r['refPiece']; ?>">
                            <input type="hidden" name="prix" value="<?php echo $r['prix']; ?>">
                            <input type="number" name="quantite" class="form-control col-lg-3 col-md-4 col-sm-6"
                                placeholder="Quantité" step="1">
                            <button type="submit" class="btn btn-primary">Ajouter au panier</button>
                        </form>
                    </div>
                </div>
            <?php } ?>
        </div>
    </section>

    <footer>
        <footer id="contact" class="contact">
            <div class="container">
                <div class="footer-top">
                    <div class="row">
                        <div class="col-md-3 col-sm-6">
                            <div class="single-footer-widget">
                                <div class="footer-logo">
                                    <a href="index.html">AutoShop</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-6">
                            <div class="single-footer-widget">
                                <h2>Ranimjrad0@gmail.com</h2>
                            </div>
                        </div>
                        <div class="col-md-3 col-xs-12">
                            <div class="single-footer-widget">
                                <h2>53 132 382</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer-copyright">
                    <div class="row">
                        <div class="col-sm-6">
                            <p>
                                &copy; copyright.designed and developed by <a
                                    href="https://www.themesine.com/">themesine</a>.
                            </p><!--/p-->
                        </div>
                        <div class="col-sm-6">
                            <div class="footer-social">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                                <a href="#"><i class="fa fa-linkedin"></i></a>
                                <a href="#"><i class="fa fa-pinterest-p"></i></a>
                                <a href="#"><i class="fa fa-behance"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="scroll-Top">
                <div class="return-to-top">
                    <i class="fa fa-angle-up " id="scroll-top" data-toggle="tooltip" data-placement="top" title=""
                        data-original-title="Back to Top" aria-hidden="true"></i>
                </div>

            </div>

        </footer>




        <!-- Include all js compiled plugins (below), or include individual files as needed -->

        <script src="assets/js/jquery.js"></script>

        <!--modernizr.min.js-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>

        <!--bootstrap.min.js-->
        <script src="assets/js/bootstrap.min.js"></script>

        <!-- bootsnav js -->
        <script src="assets/js/bootsnav.js"></script>

        <!--owl.carousel.js-->
        <script src="assets/js/owl.carousel.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>

        <!--Custom JS-->
        <script src="assets/js/custom.js"></script>
        <script>
            function filterProducts() {
                // Récupérer la valeur saisie dans le champ de recherche
                var input, filter, cards, card, title, i;
                input = document.getElementById("searchInput");
                filter = input.value.toUpperCase();
                cards = document.getElementsByClassName("card");

                // Parcourir tous les produits et masquer ceux qui ne correspondent pas à la recherche
                for (i = 0; i < cards.length; i++) {
                    card = cards[i];
                    title = card.querySelector(".card-title");
                    if (title.innerText.toUpperCase().indexOf(filter) > -1) {
                        card.style.display = "";
                    } else {
                        card.style.display = "none";
                    }
                }
            }
        </script>

</body>

</html>