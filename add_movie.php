<?php

$currentPageTitle = "Ajoutez un film" ;


// Le fichier header.php est inclus sur la page
require_once(__DIR__.'/partials/header.php');

$title = $description = $video_link = $cover = null;
$category = null;

// le formulaire est soumis

if (!empty($_POST)) {
    $title = $_POST['title'];
    $video_link = $_FILES['video_link'];

    // Définir un tableau d'erreur vide qui va se remplir après chaque erreur
     $errors = [];
    // Vérifier le titre
    if (empty($title)) {
        $errors['title'] = 'Le nom n\'est pas valide';
    }
    // Vérifier le description
    if (empty($description)) {
        $errors['description'] = 'La description n\'est pas valide';
    }
    // Vérifier la vidéo
    if ($video_link['error'] === 4) {
        $errors['video_link'] = 'L\'image n\'est pas valide';
    }
    // Vérifier la catégorie
    //if (empty($category) || !in_array($category, ['Action', 'Horreur', 'Aventure', 'Animation'])) {
        //$errors['category_id'] = 'La catégorie n\'est pas valide';
    //}


    // S'il n'y a pas d'erreurs dans le formulaire
    if (empty($errors)) {
        $query = $db->prepare('
            INSERT INTO movie (`title`, `description`, `video_link` `category_id` ) VALUES (:title, :description, :video_link, :category_id),
        ');

        
        $query->bindValue(':title', $title, PDO::PARAM_STR);
        $query->bindValue(':description', $description, PDO::PARAM_STR);
        $query->bindValue(':video_link', $video_link, PDO::PARAM_STR);
        $query->bindValue(':name', $category, PDO::PARAM_STR);
        if ($query->execute()) { // On insère la pizza dans la BDD
            $success = true;
            // Envoyer un mail ?
            // Logger la création de la pizza
        }
    }

}

?>

<h1><?php echo $currentPageTitle ;?> </h1>

    <form method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="title">Nom du film :</label>
                    <input type="text" name="title" id="title" class="form-control <?php echo isset($errors['title']) ? 'is-invalid' : null; ?>" value="<?php echo $title; ?>">
                    <?php if (isset($errors['title'])) {
                        echo '<div class="invalid-feedback">';
                            echo $errors['title'];
                        echo '</div>';
                    } ?>
                </div>
             <div class="form-group">
                    <label for="description">Description :</label>
                    <textarea name="description" id="description" rows="5" class="form-control <?php echo isset($errors['description']) ? 'is-invalid' : null; ?>"><?php echo $description; ?></textarea>
                    <?php if (isset($errors['description'])) {
                        echo '<div class="invalid-feedback">';
                            echo $errors['description'];
                        echo '</div>';
                    } ?>
                </div>
            </div>
                <div class="form-group">
                    <label for="video_link">Lien du film :</label>
                    <input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
                    <input type="text" name="video_link" id="video_link" class="form-control <?php echo isset($errors['vdieo_link']) ? 'is-invalid' : null; ?>">
                    <?php if (isset($errors['video_link'])) {
                        echo '<div class="invalid-feedback">';
                            echo $errors['video_link'];
                        echo '</div>';
                    } ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">Catégorie :</label>
                    <select name="name" id="name" class="form-control <?php echo isset($errors['name']) ? 'is-invalid' : null; ?>">
                        <option value="">Choisir la catégorie</option>
                        <option <?php echo ($category === 'Action') ? 'selected' : ''; ?> value="Action">Action</option>
                        <option <?php echo ($category === 'Horreur') ? 'selected' : ''; ?> value="Horreur">Horreur</option>
                        <option <?php echo ($category === 'Aventure') ? 'selected' : ''; ?> value="Aventure">Aventure</option>
                        <option <?php echo ($category === 'Animation') ? 'selected' : ''; ?> value="Animation">Animation</option>
                    </select>
                    <?php if (isset($errors['name'])) {
                        echo '<div class="invalid-feedback">';
                            echo $errors['name'];
                        echo '</div>';
                    } ?>
                </div>
            </div>
        </div>
        <div class="text-center">
            <button class="btn btn-lg btn-block btn-dark text-uppercase font-weight-bold">Ajouter</button>
        </div>
    </form>
</main>

<?php
// Le fichier footer.php est inclus sur la page
require_once(__DIR__.'/partials/footer.php'); ?>