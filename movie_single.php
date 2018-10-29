<?php 

$id = isset($_GET['id']) ? $_GET['id'] : 0;

// Inclus la base de données

require_once(__DIR__.'/config/database.php');
$query = $db->prepare('SELECT * FROM movie WHERE id = :id'); // :id est un paramètre
$query->bindValue(':id', $id , PDO::PARAM_INT); // On assure que 'lid est bien un entier
$query->execute(); // Excute la requête
$movie = $query->fetch();

// Renvoyer une 404 si la pizza n'existe pas
if ($movie === false){
http_response_code(404);
	// On pourrait aussi rediriger l'utilisateur vers la liste des pizzas
	// deader ('Location : pizza_list.php');
	require_once(__DIR__.'/partials/header.php'); ?>
	<br/>
	<h1>404. Redirection dans 5 secondes</h1>
	<script>
		setTimeout(function() {
			window.location = 'index.php';
		}, 5000);
	</script>
<?php	require_once(__DIR__.'/partials/footer.php');
	die();
}


// Le fichier header.php est inbclus sur la page
require_once(__DIR__.'/partials/header.php');

?>

<br/>

<main class="container">
	<div class ="row">
		<div class="col-md-6">
			<figure class ="figure">
				<img class="img-fluid card-img-top-px" src="<?php echo $movie['video_link']; ?>" alt=" <?php echo $movie['title']; ?>"/>
				<figcaption class ="card-price"><?php echo formatPrice($movie['price']); ?> </figcaption>
			   </figure>
		</div>
		<div class="col-md-6">
			<h1><?php echo $movie['title']; ?></h1>
		</div>
	</div>
</main>







<?php include(__DIR__.'/partials/footer.php'); ?>
