<?php 
$id = isset($_GET['id']) ? $_GET['id'] : 0;
// Inclus la base de données
require_once(__DIR__.'/config/database.php');
$query = $db->prepare('SELECT * FROM movie WHERE id = :id'); // :id est un paramètre
$query->bindValue(':id', $id , PDO::PARAM_INT); // On assure que 'lid est bien un entier
$query->execute(); // Excute la requête
$movie = $query->fetch();
// Renvoyer une 404 si la pizza n'existe pas
if ($movie === false || $id == 0){
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
$currentPageTitle = $movie['title'] ;
// Le fichier header.php est inbclus sur la page
require_once(__DIR__.'/partials/header.php');
?>