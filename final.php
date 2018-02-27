<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">


    <title>Hello, world!</title>
  </head>
  <body>
    <?php 
        include("style.php");
        include("tesseract_out.php");
    ?>
    <header class="container-fluid">
            <div class="center-adj"><i class="material-icons">search</i><h1>OPTICAL CHARACTER RECOGNITION</h1></div>
    </header>

    <section class="container top-margin">
    <form action="final.php" type="GET">
        <label>CHOOSE YOUR IMAGE : </label><br>
        <form action="/action_page.php">
            <div class="form-group">
                <input type="file" name="image" class="form-control" id="email" accept="image/*">
            </div>
            <button type="submit" class="btn btn-primary" id="sub">Submit</button>
    </form>
    <button class="btn btn-primary" id="def">Default</button>
    </section>
    <?php 
        function is_empty($check) {
            if ($check == "") {
                return true;
            }else return false;
        }
    ?>
    <section class="container top-margin" id="sec-normal">
        <div class="row">
            <div class="col">
                INPUT IMAGE:
                <div class="box border border-warning" id="img-show">
                    <?php 
                        try{
                            $image="";  
                            if(!empty($_GET["image"])){
                                $image = $_GET["image"];
                                echo '<img class="center-adj"src="'.$image.'">';
                            }else {
                                throw new Exception("Import the image please!");
                            }
                        }catch(Exception $e){
                            echo $e->getMessage();
                        }
                    ?>
                </div>
            </div> 
            <div class="col">
                OUTPUT TEXT: 
                <div class="box border border-warning container" id="txt-show">
                        <?php
                        $txt = imagetotext($image);
                        try { 
                            if (!empty($_GET["image"])){
                                echo '<h4 class="text-out"><pre>'.$txt.'</pre></h4>';
                            } else {
                                throw new Exception("Sorry");
                            }
                        } catch(Exception $e) {
                            echo "";
                        }
                        ?>
                </div>
            </div>       
        <div>
    </section>

    <section class="container">
    <div class="center-adj">
    FORMATTED FILE SAVED AS NEWFILE.txt
        <a class="btn" href="<?php 
            $myfile = fopen("newfile.txt", "w");
            fwrite($myfile, $txt);
            echo $myFile;
            fclose($myfile);
            ?>"><i class="material-icons">file_download</i></a>
        </div>
    </section>

    <footer class="container-fluid foot">
        <h3 class="center-adj"> &copy; SUBMITTED BY ZAIN</h3>
    </footer>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
    <script src="final.js"></script>
  </body>
</html>