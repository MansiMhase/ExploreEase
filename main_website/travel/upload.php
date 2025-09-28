<!DOCTYPE html>
<html>
<head>
  <style>
    .container {
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      text-align: center;
    }
    .gif-image {
      display: inline-block;
      margin: 0 auto;
      max-width: 100%;
      height: auto;
      animation: fadeIn 2s ease-out;
    }
    @keyframes fadeIn {
      0% { opacity: 0; }
      100% { opacity: 1; }
    }
  </style>
</head>
<body>
  <!-- your form code here -->

  <?php
    // check if the form was submitted
    if(isset($_POST['submit'])) {
      // extract the form data
      $name = $_POST['name'];
      $email = $_POST['email'];
      $spot = $_POST['spot'];
      $review = $_POST['review'];
      // check if an image file was uploaded
      if(isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
         $name1 = $_FILES['image']['name'];
         $type = $_FILES['image']['type'];
         $tmp_name = $_FILES['image']['tmp_name'];
         // move the uploaded file to a specific directory on the server
         $upload_dir = "uploads/";
         $upload_path = $upload_dir . basename($name1);
         if(move_uploaded_file($tmp_name, $upload_path)) {
            // connect to the database
            $pdo = new PDO('mysql:host=localhost;dbname=reviews', 'root', '');
            // insert the form data and image file path into the database
            $stmt = $pdo->prepare("INSERT INTO images (name, email, spot, review, path) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$name, $email, $spot, $review, $upload_path]);
            echo '
            <div class="container">
              <img class="gif-image" src="Animation - 1708197117804.gif" alt="Submission Success">
            </div>
            ';
         } else {
            echo '
            <div class="container">
              <img class="gif-image" src="Vv4n71RQrK.gif" alt="Error Uploading Image">
            </div>
            ';
         }
      } else {
         echo '
         <div class="container">
           <img class="gif-image" src="Vv4n71RQrK.gif" alt="Error Uploading Image">
         </div>
         ';
      }
    } else {
       ;
    }
  ?>

  <script>
    // Add GIF image using script tag
    var container = document.createElement("div");
    container.className = "container";
    var gifImage = document.createElement("img");
    gifImage.className = "gif-image";
    gifImage.src = "Animation - 1708197117804.gif";
    gifImage.alt = "Submission Success";
    container.appendChild(gifImage);
    document.body.appendChild(container);

    // Fade in GIF image using CSS animation
    setTimeout(function() {
      container.classList.add("gif-image-visible");
    }, 0);

    // Add error GIF image using script tag
    var errorContainer = document.createElement("div");
    errorContainer.className = "container";
    errorImage = document.createElement("img");
    errorImage.className = "gif-image";
    errorImage.src = "Vv4n71RQrK.gif";
    errorImage.alt = "Error Uploading Image";
    errorContainer.appendChild(errorImage);
    document.body.appendChild(errorContainer);

    // Fade in error GIF image