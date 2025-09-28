<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://cdn.jsdelivr.net/npm/remixicon@4.1.0/fonts/remixicon.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="styles.css" />
    <title>Reviews</title>
  </head>
  <body>
    <header class="header" id="home">
      <nav>
          <div class="nav__menu__btn" id="menu-btn">
            <i class="ri-menu-line"></i>
          </div>
        </div>
      </nav>
      <div class="section__container header__container">
        <div class="header__content">
          <h3 class="section__subheader">Reviews</h3>
          <h1 class="section__header">
            See Your Favourite Places Here!
          </h1>
          <div class="scroll__btn">
            <a href="#about">
              Scroll down
              <span><i class="ri-arrow-down-line"></i></span>
            </a>
          </div>
        </div>
      </div>
    </header>
    <section class="about">
      <div class="section__container about__container">
        <div class="about__image about__image-1" id="about">
          <img src="assets/about-1.jpg" alt="about" />
        </div>
        <div class="about__content about__content-1">
          <h3 class="section__subheader">GET STARTED</h3>
          <h2 class="section__header">What level of hiker are you?</h2>
          <p>
            Whether you're a novice seeking scenic strolls or an experienced
            trekker craving challenging ascents, we've curated a diverse range
            of trails to cater to every adventurer. Uncover your hiking
            identity, explore tailored recommendations, and embrace the great
            outdoors with a newfound understanding of your capabilities.
          </p>
          <div class="about__btn">
            <a href="#">
              Read more
              <span><i class="ri-arrow-right-line"></i></span>
            </a>
          </div>
        </div>
        <div class="about__image about__image-2" id="equipment">
          <img src="assets/about-2.jpg" alt="about" />
        </div>
        <div class="about__content about__content-2">
          <h3 class="section__subheader">HIKING ESSENTIALS</h3>
          <h2 class="section__header">Picking the right hiking gear!</h2>
          <p>
            From durable footwear that conquers rugged trails to lightweight
            backpacks that carry your essentials with ease, we navigate the
            intricacies of gear selection to ensure you're geared up for success
            on every hike. Lace up your boots and let the journey begin with
            confidence, knowing you've chosen the right gear for the trail
            ahead!
          </p>
          <div class="about__btn">
            <a href="#">
              Read more
              <span><i class="ri-arrow-right-line"></i></span>
            </a>
          </div>
        </div>
        <div class="about__image about__image-3" id="blog">
          <img src="assets/about-3.jpg" alt="about" />
        </div>
        <div class="about__content about__content-3">
          <h3 class="section__subheader">WHERE YOU GO IS THE KEY</h3>
          <h2 class="section__header">Understanding your map & timing</h2>
          <p>
            Knowing when to start and anticipating the changing conditions
            ensures a safe and enjoyable journey. So, dive into the details,
            grasp the contours, and synchronize your steps with the rhythm of
            nature. It's not just a hike; it's a journey orchestrated by your
            map and timed to perfection.
          </p>
          <div class="about__btn">
            <a href="#">
              Read more
              <span><i class="ri-arrow-right-line"></i></span>
            </a>
          </div>
        </div>
      </div>
    </section>

    <body>
   <div class="container">
      <form method="post" action="">
         <label for="spot">Spot:</label>
         <input type="text" id="spot" name="spot" required>
         <button type="submit" name="submit">Search</button>
      </form>
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
                     <center><img class="gif-image" src="IdksjZvzUK.gif" height= "300px"alt="No Data Available"></center>
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
                  <center><img class="gif-image" src="IdksjZvzUK.gif" height= "300px"alt="No Data Available"></center>
               </div>
            </div>
            ';
         }
      ?>
   </div>
</body>

    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="main.js"></script>
  </body>
</html>
