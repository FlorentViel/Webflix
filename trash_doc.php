
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

<?php

        $query = $db->prepare('
        INSERT INTO `movie` (`title`, `description`, `video_link`, `cover`, `category_idcategory`) VALUES (:title, :description, :video_link, :cover , :category_idcategory)
        ');

        $query = $db->prepare('
        SELECT * FROM `movie` ORDER BY `movie`.`category_idcategory` ASC
        ');

        $query3 = $db->query('SELECT * FROM `movie` WHERE category_idcategory = '.$id);
        $category_idcategory = $query3->fetch();
        $query3 = $db->query('SELECT * FROM `movie` ORDER BY `movie`.`category_idcategory` ASC' );
        $category_idcategory = $query3->fetch();

        $query = $db->prepare('UPDATE `movie` SET `title` = '5020', `description` = '757507542074572725072075275752727520702572074272575757575702', `video_link` = 'https://www.youtube.com/embed/StZcUAPRRac?list=RDW3q8Od5qJio', `cover` = 'assets/image/movie/test.png', `category_idcategory` = '2' WHERE `movie`.`id` = 70;');
        

    
?>

        <?php if (isset($success) && $success) { ?>
            <div class="alert alert-success alert-dismissible fade show">
                Le film <strong><?php echo $title; ?></strong> a bien été ajouté avec l'id <strong><?php echo $db->lastInsertId(); ?></strong> !
                <button type="button" class="close" data-dismiss="alert">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php } ?>