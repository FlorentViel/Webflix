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



    <div class="container contact-form">
            <div class="contact-image">
                <img src="assets/image/clap.png" alt="clap de film"/>
            </div>
            <form method="POST" enctype= "multipart/form-data">
                <h3><?php echo $currentPageTitle ;?></h3>
               <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" name="title" class="form-control" placeholder="Nom du film*" value="" />
                        </div>
                        <div class="form-group">
                            <input type="file" name="txtPhone" class="form-control" placeholder="Your Phone Number *" value="" />
                        </div>
                        <div class="form-group">
                            <select name="category" class="form-control"/>
                            <option value="">Choisir la catégorie</option>
                            <option value ="Action">Action</option>
                            <option value ="Horreur">Horreur</option>
                            <option value ="Aventure">Aventure</option>
                            <option value ="Animation">Animation</option>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="btnSubmit" class="btnContact" value="Send Message" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <textarea name="txtMsg" class="form-control" placeholder="Your Message *" style="width: 100%; height: 150px;"></textarea>
                        </div>
                    </div>
                </div>
            </form>
</div>

<div class ="separator"></div>


<?php
// Le fichier footer.php est inclus sur la page
require_once(__DIR__.'/partials/footer.php'); ?>