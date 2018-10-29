<?php

$currentPageTitle = 'Nos films';

require_once(__DIR__.'/partials/header.php');

// Récupérer la liste des films
$query = $db->query('SELECT * FROM movie');
$movies = $query->fetchall();


//$price = '13.00';
//$first = substr($price, 0, -2); // 13
//$cents = substr($price, -2); // 00
//echo $first.',<span style ="font-size: 12px">' . $cents . '</span>';
?>




<div class="album py-5 bg-light">

  <div class="container">

    <div class="row">
    <?php 
	// On affiche les films
	foreach ($movies as $movie){?>            
      <div class="col-md-4">
      <strong class ="card-text"><?php echo $movie['title']; ?></strong>
        <div class="card mb-4 shadow-sm">
        <iframe width="348" height="120" src="<?php echo $movie['video_link']; ?>" class="card-img-top" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
          <div class="card-body">
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
  <?php } ?>
    </div>
  </div>
</div>

</main>

<?php require_once(__DIR__.'/partials/footer.php'); ?>
