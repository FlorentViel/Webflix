<?php require_once(__DIR__.'/partials/header.php'); ?>

<?php

// Récupérer la liste des films
$query = $db->query('SELECT * FROM movie');
$movies = $query->fetchall();

$title = 'titre';



//$price = '13.00';
//$first = substr($price, 0, -2); // 13
//$cents = substr($price, -2); // 00
//echo $first.',<span style ="font-size: 12px">' . $cents . '</span>';
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
    <?php 
	// On affiche les films
	foreach ($movies as $movie){?>
      <div class="col-md-4">
        <div class="card mb-4 shadow-sm">
        <video controls class="card-img-top" src="<?php echo $movie['video_link']; ?>"><?php echo $movie['title']; ?></video>
          <div class="card-body">
            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
            <div class="d-flex justify-content-between align-items-center">
              <div class="btn-group">
                <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
              </div>
              <small class="text-muted">9 mins</small>
            </div>
          </div>
        </div>
      </div>
  <?php } ?>
    </div>
  </div>
</div>

</main>

<?php require_once(__DIR__.'/partials/footer.php'); ?>
