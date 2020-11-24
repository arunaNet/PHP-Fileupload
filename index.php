<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>arunaNet - PHP Fileupload</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="assets/css/libs/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
    <div class="container">
		<form action="" method="post" enctype="multipart/form-data">
            <h2 class="display-4 pb-5 pt-5 text-center">Dateiupload mit PHP</h2>
            <div class="form-group text-center">
                <input name="files" type="file" class="form-control-file" id="fileupload">
            </div>
            <div class="form-group text-center">
                <button type="submit" name="uploadform" class="btn btn-dark">Absenden</button>
            </div>

            <?php

                error_reporting(0);
                if ( isset( $_POST['uploadform']) ) :

                    $file_name = pathinfo($_FILES['files']['name'], PATHINFO_FILENAME);
                    $file_extension = strtolower(pathinfo($_FILES['files']['name'], PATHINFO_EXTENSION));
                    $allowed_file_extension = array('zip', 'gzip');
                    $max_file_size = 1000*1024; // 1MB
                    $upload_folder = 'uploads/';
                    $update_path = $upload_folder.$file_name.'.'.$file_extension;

                    // Abfragen ob erlaubte Endung
                    if ( !in_array($file_extension, $allowed_file_extension ) ) :
                        die('
                            <div class="alert alert-danger" role="alert">
                                Ungültige Dateiendung!
                            </div>
                        ');
                    endif;

                    // Abfragen ob Datei zu groß
                    if ( $_FILES['files']['size'] > $max_file_size ) :
                        die('
                            <div class="alert alert-danger" role="alert">
                                Datei ist zu groß.
                            </div>
                        ');
                    endif;

                    // Abfragen ob Datei schon vorhanden, wenn ja aktuelles Datum anhängen
                    if ( file_exists($update_path) ) :
                        $new_name = date('Y-m-d-H-i-s');
                        do {
                            $update_path = $upload_folder.$file_name.'_'.$new_name.'.'.$file_extension;
                        }
                        while(file_exists($update_path));
                    endif;

                    // Wenn alles passt, dann hochladen
                    if ( move_uploaded_file($_FILES['files']['tmp_name'], $update_path) ) :
                        echo '
                            <div class="alert alert-success" role="alert">
                                Upload erfolgreich!
                            </div>
                        ';
                    else :
                        echo '
                            <div class="alert alert-danger" role="alert">
                                Fehler beim Upload!
                            </div>
                        ';
                    endif;

                endif;

            ?>

		</form>
	</div>
</body>
</html>