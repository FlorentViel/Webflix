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

   <main role="main">

<section class="jumbotron text-center">
  <div class="container">
    <h1 class="jumbotron-heading">Acceuil</h1>
    <p class="lead text-muted">Something short and leading about the collection below—its contents, the creator, etc. Make it short and sweet, but not too short so folks don't simply skip over it entirely.</p>
    <p>
      <a href="#" class="btn btn-primary my-2">Main call to action</a>
      <a href="#" class="btn btn-secondary my-2">Secondary action</a>
    </p>
  </div>
</section>

<div class="album py-5 bg-light">
  <div class="container">

    <div class="row">

      <div class="col-md-4">
        <div class="card mb-4 shadow-sm">
        <video controls class="card-img-top" src="<?php echo $movie['video_link']; ?>"><?php echo $movie['title']; ?></video>
          <div class="card-body">
          <h1 class ="card-text"><?php echo $movie['title']; ?></h1>
            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
            <div class="d-flex justify-content-between align-items-center">
              <div class="btn-group">
                <button type="button" class="btn btn-sm btn-outline-secondary">
                <?php echo '<a href="movie_single.php?id='.$movie['id'].'">Regardez le film</a>' ?>
                </button>
                <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
              </div>
              <small class="text-muted">9 mins</small>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

</main>




<?php include(__DIR__.'/partials/footer.php'); ?>
