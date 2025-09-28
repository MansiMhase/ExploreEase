<!DOCTYPE html>
<html>
<head>
   <title>Reviews</title>
   <style>
      body {
        font-family: 'Nunito', sans-serif;
         margin: 0;
         padding: 0;
         background-color: #f7f7f7;
         position: relative;
        
      }
      body::before {
         content: "";
         position: fixed;
         top: 0;
         left: 0;
         width: 100%;
         height: 100%;
         
         background: linear-gradient(rgba(15, 23, 43, .6), rgba(15, 23, 43, .6)), url(../img/tajmahal.jpeg);
         background-position: center center;
         background-repeat: no-repeat;
         background-size: cover;
         z-index: -1;
      }
      h1 {
        
         box-shadow: 0px 0px 0px 2px rgba(255, 255, 255, 1);
         color: #fff;
         padding: 10px;
         margin: 0;
         border-radius: 5px;
         transition: .5s;

      }
      .container {
         max-width: 1200px;
         margin: 0 auto;
         padding: 20px;
      }
      .image-container {
         display: flex;
         flex-wrap: wrap;
         margin: 0 -10px;

      }
      .image-container .image {
         width: calc(33.333% - 20px);
         margin: 0 10px 20px;
         box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
         transition: transform .3s ease-in-out;
         box-shadow: 0px 0px 0px 1px rgba(255, 255, 255, 0.3);
         border-radius: 5px;
      }
      .image-container .image:hover {
         transform: translateY(-5px);
         box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
         box-shadow: 0px 0px 0px 2px rgba(255, 255, 255, 1);
      }
      .image-container .image img {
         width: 100%;
         height: 70%;
         border-radius: 5px;

      }
       .image-container .image h2 {
         margin: 10px 0;
         text-align: center;
         color: #fff;
      }
      .image-container .image p {
         margin: 0;
         text-align: center;
         line-height: 1.5;
         color: #fff;
      }
      .gif-container {
         display: flex;
         justify-content: center;
         align-items: center;
         height: 300px;
      }
      .gif-image {
         width: 30%;
         height: auto;
         /*border-radius: 5px;*/
         align-items: center;
         justify-content: center;
      }
      
   </style> 

</head>
<body>
   <div class="container">
      <center><h1>Reviews</h1></center><br>
      <?php
         // check if the search form was submitted
         if(isset($_POST['submit']))
         {
            // get the spot from the search form
            $spot = $_POST['spot'];

            // connect to the database
            $pdo = new PDO('mysql:host=localhost;dbname=reviews', 'root', '');

            // retrieve all images for the specified spot from the database
            $stmt = $pdo->prepare("SELECT * FROM images WHERE spot = ?");
            $stmt->execute([$spot]);
            $images = $stmt->fetchAll();

            // display the images in an HTML structure
            if (count($images) > 0) {
               echo '<div class="image-container">';
               foreach($images as $image) 
               {
                  echo '<div class="image">';
                  echo '<img src="' . htmlspecialchars($image['path']) . '" alt="' . htmlspecialchars($image['name']) . '">';
                  echo '<h2>' . htmlspecialchars($image['name']) . '</h2>';
                  //echo '<p>' . htmlspecialchars($image['email']) . '</p>';
                  echo '<p>' . nl2br(htmlspecialchars($image['review'])) . '</p>';
                  echo '</div>';
               }
               echo '</div>';
            } else {
               echo '
               <div class="container">
                  <div class="gif-container">
                    <img class="gif-image" src="IdksjZvzUK (2).gif" height= "260px"alt="No Data Available">
                  </div>
               </div>
               ';
            }
         }
         else 
         {
            echo '
            <div class="container">
               <div class="gif-container">
                  <img class="gif-image" src="IdksjZvzUK (2).gif" height= "260px"alt="No Data Available">
               </div>
            </div>
            ';
         }
      ?>

      <script>
         // Add GIF image using script tag
         var container = document.createElement("div");
         container.className = "gif-container";
         var gifImage = document.createElement("img");
         gifImage.className = "gif-image";
         container.appendChild(gifImage);
         document.body.appendChild(container);
      </script>

   </div>
</body>
</html>