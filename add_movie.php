<?php

$currentPageTitle = "Ajoutez un film" ;


// Le fichier header.php est inclus sur la page
require_once(__DIR__.'/partials/header.php');

$title = $description = $video_link = null;
$cover = $fileName = null;
$category_idcategory = null;

// le formulaire est soumis

if (!empty($_POST)) {
    $title = $_POST['title'];
    $video_link = $_POST['video_link'];
    $description = $_POST['description'];
    $category_idcategory = $_POST['category_idcategory'];
    $cover = $_FILES['cover'];

    // Définir un tableau d'erreur vide qui va se remplir après chaque erreur
     $errors = [];
    // Vérifier le titre
    if (empty($title)) {
        $errors['title'] = 'Le titre du film n\'est pas valide';
    }
    if (empty($cover)) {
        $errors['cover'] = 'La couverture du film n\'est pas valide';
    }
    // Vérifier le description
    if (strlen($description) <= 15)  {
        $errors['description'] = 'Description invalide. 15 caractères minimum';
    }

    // Vérifier la vidéo
    if (empty($video_link)) {
        $errors['video_link'] = 'La video n\'est pas valide';
    }

    // Vérifier la catégorie
    if (empty($category_idcategory) || !in_array($category_idcategory, [ 1, 2, 3, 4])) {
        $errors['category_idcategory'] = 'La catégorie n\'est pas valide';
    }
    // Vérifier la catégorie
    //if (empty($category_idcategory) || !in_array($category_idcategory, ['Action', 'Horreur', 'Aventure', 'Animation'])) {
     //   $errors['$category_idcategory'] = 'La catégorie n\'est pas valide';
   // }

    $file = $cover['tmp_name']; // Emplacement du fichier temporaire
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mimeType = finfo_file($finfo, $file); 
    $allowedExtension = ['image/jpg', 'image/jpeg', 'image/gif', 'image/png'];
    $fileName = 'assets/image/movie/'.$cover['name'];
    if (!in_array($mimeType, $allowedExtension)){
        $errors['cover'] = 'Ce type de fichier n\'est pas autorisé';
    }


    // S'il n'y a pas d'erreurs dans le formulaire
    if (empty($errors)) {
        $query = $db->prepare('
        INSERT INTO `movie` (`title`, `description`, `video_link`, `cover`, `category_idcategory`) VALUES (:title, :description, :video_link, :cover , :category_idcategory)
        ');
        
        $query->bindValue(':title', $title, PDO::PARAM_STR);
        $query->bindValue(':description', $description, PDO::PARAM_STR);
        $query->bindValue(':video_link', $video_link, PDO::PARAM_STR);
        $query->bindValue(':cover', $fileName, PDO::PARAM_STR);
        $query->bindValue(':category_idcategory', $category_idcategory, PDO::PARAM_STR);

        if ($query->execute()) { // On insère le film dans la BDD
            $success = true;
            // Envoyer un mail ?
            // Logger la création du film
        }
    }

}

?>

    <?php if (isset($success) && $success) { ?>
        <div class="alert alert-success alert-dismissible fade show">
            La film <strong><?php echo $title; ?></strong> a bien été ajouté avec l'id <strong><?php echo $db->lastInsertId(); ?></strong> !
            <button type="button" class="close" data-dismiss="alert">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php } ?>

<div class="container contact-form">
    <div class="contact-image">
        <img src="assets/image/clap.png" alt="clap de film"/>
    </div>
    <form method="POST" enctype= "multipart/form-data">
        <h3><?php echo $currentPageTitle ;?></h3>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                <input type="text" name="title" id="title" class="form-control" placeholder="Nom de votre film*" <?php echo isset($errors['title']) ? 'invalid' : null; ?>" value="<?php echo $title; ?>">
                    <?php if (isset($errors['title'])) {
                    echo '<div class ="invalid">';
                    echo $errors['title'];
                    echo '</div>';
                    } ?>
                </div>
                <div class="form-group">
                    <input type="text" name="video_link" class="form-control" placeholder="URL de votre film*" <?php echo isset($errors['video_link']) ? 'invalid' : null; ?>" value="<?php echo $video_link; ?>"/>
                    <?php if (isset($errors['video_link'])) {
                    echo '<div class ="invalid">';
                    echo $errors['video_link'];
                    echo '</div>';
                    } ?>
                </div>
                <div class="form-group">
                    <input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
                    <input type="file" name="cover" class="form-control" placeholder="Cover*" <?php echo isset($errors['cover']) ? 'invalid' : null; ?>/>
                    <?php if (isset($errors['cover'])) {
                    echo '<div class ="invalid">';
                    echo $errors['cover'];
                    echo '</div>';
                    } ?>
                </div>
                <div class="form-group">
                    <select name="category_idcategory" class="form-control"/>
                    <option value="">Choisir la catégorie</option>
                    <option <?php echo ($category_idcategory === '1') ? 'selected' : ''; ?> value ="1">Action</option>
                    <option <?php echo ($category_idcategory === '2') ? 'selected' : ''; ?> value ="2">Horreur</option>
                    <option <?php echo ($category_idcategory === '3') ? 'selected' : ''; ?> value ="3">Aventure</option>
                    <option <?php echo ($category_idcategory === '4') ? 'selected' : ''; ?> value ="4">Animation</option>
                </select>
                <?php if (isset($errors['category_idcategory'])) {
                        echo '<div class="invalid">';
                            echo $errors['category_idcategory'];
                        echo '</div>';
                    } ?>
                </div>

                <div class="form-group">
                    <input type="submit" name="btnSubmit" class="btnContact" value="Ajouter" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <textarea name="description" class="form-control"  rows="5" placeholder="Description *" style="width: 100%; height: 202px;" <?php echo isset($errors['description']) ? 'invalid' : null; ?>></textarea>
                    <?php  
                    if(isset($errors['description'])){
                        echo '<div class="invalid">';
                        echo $errors['description'];
                        echo '</div>';
                    }
                     ?>
                </div>
            </div>
        </div>
    </form>
</div>

</main>

<?php
// Le fichier footer.php est inclus sur la page
require_once(__DIR__.'/partials/footer.php'); ?>