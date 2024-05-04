<?php
include('config.php');



if (isset($_GET['idPiece'])) {
    $idPiece = $_GET['idPiece'];

    // Récupérer les données existantes
    $readSql = "SELECT idPiece, nomPiece, marquePiece, refPiece, quantite, marqueVoiture, modeleVoiture, prix, description, codeCategorie
                FROM piece
                WHERE idPiece = :idPiece";
    $stmt = $conn->prepare($readSql);
    $stmt->bindParam(':idPiece', $idPiece, PDO::PARAM_INT);
    $stmt->execute();

    $res = $stmt->fetch(PDO::FETCH_ASSOC);

    // Fetch available categories from the database
    $categoriesQuery = "SELECT codeCategorie, nomCategorie FROM categorie";
    $categoriesStmt = $conn->prepare($categoriesQuery);
    $categoriesStmt->execute();
    $categories = $categoriesStmt->fetchAll(PDO::FETCH_ASSOC);

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['idPiece'])) {
        // Mise à jour des données dans la base de données
        $nomPiece = $_POST['nomPiece'];
        $marquePiece = $_POST['marquePiece'];
        $refPiece = $_POST['refPiece'];
        $quantite = $_POST['quantite'];
        $marqueVoiture = $_POST['marque'];
        $prix = $_POST['prix'];
        $description = $_POST['description'];
        $codeCategorie = $_POST['codeCategorie'];


        // Continue with your update logic
        $updateSql = "UPDATE piece SET nomPiece=:nomPiece, marquePiece=:marquePiece, refPiece=:refPiece, quantite=:quantite,
                          marqueVoiture=:marqueVoiture, modeleVoiture=:modeleVoiture, prix=:prix, description=:description, codeCategorie=:codeCategorie
                  WHERE idPiece=:idPiece";

        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bindParam(':nomPiece', $nomPiece);
        $updateStmt->bindParam(':marquePiece', $marquePiece);
        $updateStmt->bindParam(':refPiece', $refPiece);
        $updateStmt->bindParam(':quantite', $quantite);
        $updateStmt->bindParam(':marqueVoiture', $marqueVoiture);
        $updateStmt->bindParam(':modeleVoiture', $res['modeleVoiture']); // Use the existing value
        $updateStmt->bindParam(':prix', $prix);
        $updateStmt->bindParam(':description', $description);
        $updateStmt->bindParam(':codeCategorie', $codeCategorie);
        $updateStmt->bindParam(':idPiece', $idPiece, PDO::PARAM_INT);

        $res = $updateStmt->execute();

        if ($res) {
            // Rediriger vers la liste des produits après la mise à jour
            header("Location: listeProduit.php");
            exit();
        } else {
            $erreur = "La mise à jour a échoué.";
        }
    }
} else {
    // Gérer le cas où idPiece n'est pas défini
    echo "L'identifiant de la pièce (idPiece) n'est pas défini.";
    exit();
}
?>


<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">

	<title>Forms / Layouts - NiceAdmin Bootstrap Template</title>
	<meta content="" name="description">
	<meta content="" name="keywords">

	<!-- Favicons -->
	<link href="assets/img/favicon.png" rel="icon">
	<link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

	<!-- Google Fonts -->
	<link href="https://fonts.gstatic.com" rel="preconnect">
	<link
		href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
		rel="stylesheet">

	<!-- Vendor CSS Files -->
	<link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
	<link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
	<link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
	<link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
	<link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
	<link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

	<!-- Template Main CSS File -->
	<link href="assets/css/style.css" rel="stylesheet">

	<!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Jan 09 2024 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
	<!-- ======= Header ======= -->
	<header id="header" class="header fixed-top d-flex align-items-center">

		<div class="d-flex align-items-center justify-content-between">
			<a href="index.html" class="logo d-flex align-items-center">
				<img src="assets/img/logo.png" alt="">
				<span class="d-none d-lg-block">AutoShopAdmin</span>
			</a>
			<i class="bi bi-list toggle-sidebar-btn"></i>
		</div><!-- End Logo -->

		<div class="search-bar">
			<form class="search-form d-flex align-items-center" method="POST" action="#">
				<input type="text" name="query" placeholder="Search" title="Enter search keyword">
				<button type="submit" title="Search"><i class="bi bi-search"></i></button>
			</form>
		</div><!-- End Search Bar -->

		<nav class="header-nav ms-auto">
			<ul class="d-flex align-items-center">

				<li class="nav-item d-block d-lg-none">
					<a class="nav-link nav-icon search-bar-toggle " href="#">
						<i class="bi bi-search"></i>
					</a>
				</li><!-- End Search Icon-->

				<li class="nav-item dropdown">

					<a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
						<i class="bi bi-chat-left-text"></i>
						<span class="badge bg-success badge-number"></span>
					</a><!-- End Messages Icon -->

					<ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
						<li class="dropdown-header">
							You have new messages
							<a href="listecontact.php"><span class="badge rounded-pill bg-primary p-2 ms-2">View
									all</span></a>
						</li>

					</ul><!-- End Messages Dropdown Items -->

				</li>

				<li class="nav-item dropdown pe-3">

					<a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
						<img src="assets/img/photo profile.jpg" alt="Profile" class="rounded-circle">
						<span class="d-none d-md-block dropdown-toggle ps-2">Ranim Jrad</span>
					</a><!-- End Profile Iamge Icon -->

					<ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
						<li class="dropdown-header">
							<h6>Ranim Jrad</h6>
						</li>
						<li>
							<hr class="dropdown-divider">
						</li>


						<li>
							<a class="dropdown-item d-flex align-items-center" href="users-profile.html">
								<i class="bi bi-gear"></i>
								<span>Paramètres de compte</span>
							</a>
						</li>
						<li>
							<hr class="dropdown-divider">
						</li>

						<li>
							<hr class="dropdown-divider">
						</li>

					</ul><!-- End Profile Dropdown Items -->
				</li><!-- End Profile Nav -->

			</ul>
		</nav><!-- End Icons Navigation -->

	</header><!-- End Header -->

	<!-- ======= Sidebar ======= -->
	<aside id="sidebar" class="sidebar">

		<ul class="sidebar-nav" id="sidebar-nav">

			<li class="nav-item">
				<a class="nav-link " href="index.html">
					<i class="bi bi-grid"></i>
					<span>Tableau de bord</span>
				</a>
			</li><!-- End Dashboard Nav -->

			<li class="nav-item">
				<a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
					<i class="bi bi-menu-button-wide"></i><span>Produit</span><i class="bi bi-chevron-down ms-auto"></i>
				</a>
				<ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
					<li>
						<a href="ajouterProduit.html">
							<i class="bi bi-circle"></i><span>Ajouter produit</span>
						</a>
					</li>
					<li>
						<a href="listeProduit.php">
							<i class="bi bi-circle"></i><span>Liste des produits</span>
						</a>
					</li>
				</ul>
			</li><!-- End Components Nav -->

			<li class="nav-item">
				<a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
					<i class="bi bi-journal-text"></i><span>Administrateur</span><i
						class="bi bi-chevron-down ms-auto"></i>
				</a>
				<ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
					<li>
						<a href="ajouterAdmin.html">
							<i class="bi bi-circle"></i><span>Ajouter un admin</span>
						</a>
					</li>
					<li>
						<a href="listeAdmin.php">
							<i class="bi bi-circle"></i><span>Liste des Admins</span>
						</a>
					</li>
				</ul>
			</li><!-- End Forms Nav -->
			<li class="nav-item">
        <a class="nav-link collapsed" href="listeCommande.php">
          <i class="bi bi-person"></i>
          <span>Commandes</span>
        </a>
      </li>

			<li class="nav-heading">Paramètres</li>

			<li class="nav-item">
				<a class="nav-link collapsed" href="users-profile.html">
					<i class="bi bi-person"></i>
					<span>Profile</span>
				</a>
			</li><!-- End Profile Page Nav -->

			<li class="nav-item">
				<a class="nav-link collapsed" href="pages-login.html">
					<i class="bi bi-person"></i>
					<span>Déconnexion</span>
				</a>
			</li>


		</ul>

	</aside><!-- End Sidebar-->

	<main id="main" class="main">

		<div class="pagetitle">
			<h1>Ajouter Produit</h1>
			<nav>
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="index.html">Acceuil</a></li>
					<li class="breadcrumb-item active">Ajouter Produit</li>
				</ol>
			</nav>
		</div><!-- End Page Title -->
		<section class="section">
			<div class="row">

				<div class="col-lg-12">
					<div class="card ">
						<div class="card-body ">
							<h5 class="card-title">Pièce</h5>

							<!-- No Labels Form -->
							<form class="row g-3" method="post" action="">
								<div>
									<input type="hidden" name="idPiece" value="<?= $res['idPiece'] ?>">
								</div>
								<div class="col-md-12">
									<input type="text" name="nomPiece" class="form-control"
										value="<?= $res['nomPiece'] ?>">
								</div>
								<div class="col-md-12">
									<input type="text" name="marquePiece" class="form-control"
										value="<?= $res['marquePiece'] ?>">
								</div>
								<div class="col-md-6">
									<input type="text" name="refPiece" class="form-control"
										value="<?= $res['refPiece'] ?>">
								</div>
								<div class="col-md-6">
									<div class="form-outline">
										<input type="text" name="quantite" class="form-control"
											value="<?= $res['quantite'] ?>">
									</div>
								</div>
								<div class="col-md-12">
									<select name="codeCategorie" class="form-select">
										<option value="" selected>Select Categorie</option>
										<?php
										foreach ($categories as $category) {
											$selected = ($category['codeCategorie'] == $res['codeCategorie']) ? 'selected' : '';
											echo "<option value='{$category['codeCategorie']}' {$selected}>{$category['nomCategorie']}</option>";
										}
										?>
									</select>
								</div>

								<div class="col-md-6">
									<select id="marque" name="marque" class="form-select" onchange="afficherModeles()"
										value="<?php echo $res['marqueVoiture'] ?>">
										<option selected>Marque de Voiture</option>
										<option value="Audi" <?= ($res['marqueVoiture'] == 'Audi') ? 'selected' : '' ?>>
											Audi</option><!-- /.option-->
										<option value="BMW" <?= ($res['marqueVoiture'] == 'BMW') ? 'selected' : '' ?>>BMW
										</option><!-- /.option-->
										<option value="Citroen" <?= ($res['marqueVoiture'] == 'Citroen') ? 'selected' : '' ?>>Citroen</option><!-- /.option-->
										<option value="Dacia" <?= ($res['marqueVoiture'] == 'Dacia') ? 'selected' : '' ?>>
											Dacia</option><!-- /.option-->
										<option value="Fiat" <?= ($res['marqueVoiture'] == 'Fiat') ? 'selected' : '' ?>>
											Fiat</option><!-- /.option-->
										<option value="Ford" <?= ($res['marqueVoiture'] == 'Ford') ? 'selected' : '' ?>>
											Ford</option><!-- /.option-->
										<option value="Honda" <?= ($res['marqueVoiture'] == 'Honda') ? 'selected' : '' ?>>
											Honda</option><!-- /.option-->
										<option value="Mercedes" <?= ($res['marqueVoiture'] == 'Mercedes') ? 'selected' : '' ?>>Mercedes</option><!-- /.option-->
										<option value="Peugeot" <?= ($res['marqueVoiture'] == 'Peugeot') ? 'selected' : '' ?>>Peugeot</option><!-- /.option-->
										<option value="Renault" <?= ($res['marqueVoiture'] == 'Renault') ? 'selected' : '' ?>>Renault</option><!-- /.option-->
										<option value="Volkswagen" <?= ($res['marqueVoiture'] == 'Volkswagen') ? 'selected' : '' ?>>Volkswagen</option>
									</select>
								</div>
								<div class="col-md-6">
									<select id="modele" name="modele" class="form-select">
										<option disabled selected>Select a model</option>
										<?php foreach ($models as $model): ?>
											<option value="<?php echo $model['modeleVoiture']; ?>" <?php echo ($res['modeleVoiture'] == $model['modeleVoiture']) ? 'selected' : ''; ?>>
												<?php echo $model['modeleVoiture']; ?>
											</option>
										<?php endforeach; ?>
									</select>
								</div>

								<div class="col-12">
									<input type="text" name="prix" class="form-control"
										value="<?php echo $res['prix'] ?>">
								</div>
								<div class="col-md-12">
									<textarea class="form-control" name="description"
										value="<?php echo $res['description'] ?>"></textarea>
								</div>

								<div class="card-body text-center">
									<h5 class="card-title">Image de Pièce</h5>
									<div>
										<div class="mb-4 d-flex justify-content-center">
											<img id="selectedImage" src="../Admin/assets/img/add.jpg" alt=""
												style="width: 300px;" />
										</div>
										<div class="d-flex justify-content-center">
											<div class="btn btn-primary btn-rounded">
												<label class="form-label text-white m-1" for="customFile1">Choisir une
													image</label>
												<input type="file" class="form-control d-none" id="customFile1"
													onchange="displaySelectedImage(event, 'selectedImage')" />
											</div>
										</div>
									</div>

								</div>

								<div class="text-center">
									<button type="submit" class="btn btn-primary">Envoyer</button>
								</div>
							</form>

						</div>
					</div>
				</div>
			</div>
		</section>

	</main><!-- End #main -->

	<!-- ======= Footer ======= -->
	<footer id="footer" class="footer">
		<div class="copyright">
			&copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
		</div>
		<div class="credits">
			<!-- All the links in the footer should remain intact. -->
			<!-- You can delete the links only if you purchased the pro version. -->
			<!-- Licensing information: https://bootstrapmade.com/license/ -->
			<!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
			Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
		</div>
	</footer><!-- End Footer -->

	<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
			class="bi bi-arrow-up-short"></i></a>

	<!-- Vendor JS Files -->
	<script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
	<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="assets/vendor/chart.js/chart.umd.js"></script>
	<script src="assets/vendor/echarts/echarts.min.js"></script>
	<script src="assets/vendor/quill/quill.min.js"></script>
	<script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
	<script src="assets/vendor/tinymce/tinymce.min.js"></script>
	<script src="assets/vendor/php-email-form/validate.js"></script>

	<!-- Template Main JS File -->
	<script src="assets/js/main.js"></script>
	<script>
		function displaySelectedImage(event, elementId) {
			const selectedImage = document.getElementById(elementId);
			const fileInput = event.target;

			if (fileInput.files && fileInput.files[0]) {
				const reader = new FileReader();

				reader.onload = function (e) {
					selectedImage.src = e.target.result;
				};

				reader.readAsDataURL(fileInput.files[0]);
			}
		}
	</script>
	<script>
		var modelesParMarque = {
			Audi: ["A1", "A2", "A3", "A4", "A5", "A6", "A7", "A8", "Q2", "Q3", "Q4", "Q5", "Q7", "Q8", "QUATTRO", "R8", "TT", "V8"],
			BMW: ["SERIE 1", "SERIE 3", "SERIE 5", "X3", "X5"],
			Citroen: ["C5","DS","DS3","JUMPER","JUMPY","MEHARI","XM"],
			Dacia: ["LOGAN","LODGY","NOVA","PICK","SANDERO","SOLENZA","SPRING","DUSTER"],
			Fiat:["500","600","850","ARGO","BRAVA","BARCHETTA","BRAVO"],
			Ford:["B-MAX","BELINA","C-MAX","CORCEL","CORTINA","EVREST","FIESTA","FOCUS","GRANADA","PUMA"],
			Honda:["ACCORD","ACTY","ADV","BEAT","CAPA","CITY","CR","DOMANI","FORZA"],
			Mercedes: ["CLASSE C", "CLASSE E", "GLC","AMG","CLA","CLASSE A","CLASSE G","CLASSE S","GLS","CLASSE B"],
			Peugeot:["206","205","301","304","308","405","406","505","605","806"],
			Renault:["CLIO","DUSTER","ESPACE","KANGOO","KAPTEUR","LOGAN","MASTER","MEGANE","R25","R4"],
			Volkswagen: ["412","AMAROK","ATLAS","CADDY","CC","COCCINELLE","CORRADO","FOX","GOLF","LOAD","PASSAT","POLO"]
		};

		function afficherModeles() {
			var marqueSelect = document.getElementById("marque");
			var modeleSelect = document.getElementById("modele");
			var selectedMarque = marqueSelect.value;

			modeleSelect.innerHTML = "";

			modelesParMarque[selectedMarque].forEach(function (modele) {
				var option = document.createElement("option");
				option.value = modele;
				option.text = modele;
				modeleSelect.appendChild(option);
			});
		}

		afficherModeles();
	</script>
</body>

</html>