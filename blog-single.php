<!DOCTYPE html>
<html lang="en">


<?php
$servername = "localhost"; // Replace with your server name
$username = 'Xhaka'; // Replace with your MySQL username
$password = '123456'; // Replace with your MySQL password
$dbname = 'wheelsnation'; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

function fetchCommentsForBlog($blogId, $conn) {
    $sql = "SELECT * FROM comment WHERE post_id = $blogId";
    $result = $conn->query($sql);
  
    $comments = [];
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $comments[] = $row;
      }
    }
  
    return $comments;
  }

// Check if 'id' parameter is set in the URL
if (isset($_GET['id'])) {
    $blogId = $_GET['id'];

    // Fetch the car details from the database
    $sql = "SELECT * FROM blog WHERE id = $blogId";
    $result = $conn->query($sql);

    // Display the car details if found
    if ($result->num_rows > 0) {
        $blog = $result->fetch_assoc();

         // Fetch the comments for the blog.
        $comments = fetchCommentsForBlog($blog['id'], $conn);
?>

        <head>
            <title>Carbook - Free Bootstrap 4 Template by Colorlib</title>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

            <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">

            <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
            <link rel="stylesheet" href="css/animate.css">

            <link rel="stylesheet" href="css/owl.carousel.min.css">
            <link rel="stylesheet" href="css/owl.theme.default.min.css">
            <link rel="stylesheet" href="css/magnific-popup.css">

            <link rel="stylesheet" href="css/aos.css">

            <link rel="stylesheet" href="css/ionicons.min.css">

            <link rel="stylesheet" href="css/bootstrap-datepicker.css">
            <link rel="stylesheet" href="css/jquery.timepicker.css">


            <link rel="stylesheet" href="css/flaticon.css">
            <link rel="stylesheet" href="css/icomoon.css">
            <link rel="stylesheet" href="css/style.css">
        </head>

        <body>

            <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
                <div class="container">
                    <a class="navbar-brand" href="index.html">Wheels<span>Nation</span></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="oi oi-menu"></span> Menu
                    </button>

                    <div class="collapse navbar-collapse" id="ftco-nav">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item active"><a href="index.html" class="nav-link">Home</a></li>
                            <li class="nav-item"><a href="about.html" class="nav-link">About</a></li>
                            <li class="nav-item">
                                <a href="events.html" class="nav-link">Events</a>
                            </li>
                            <!-- <li class="nav-item"><a href="pricing.html" class="nav-link">Pricing</a></li> -->
                            <li class="nav-item"><a href="car.php" class="nav-link">Cars</a></li>
                            <li class="nav-item"><a href="blog.php" class="nav-link">Blog</a></li>
                            <li class="nav-item"><a href="contact.html" class="nav-link">Contact</a></li>
                            <li class="nav-item"><a href="logout.php" class="nav-link">LOG OUT</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- END nav -->

            <section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('images/bg_3.jpg');" data-stellar-background-ratio="0.5">
                <div class="overlay"></div>
                <div class="container">
                    <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
                        <div class="col-md-9 ftco-animate pb-5">
                            <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home <i class="ion-ios-arrow-forward"></i></a></span> <span class="mr-2"><a href="blog.html">Blog <i class="ion-ios-arrow-forward"></i></a></span> <span><?php echo $blog['title']; ?> <i class="ion-ios-arrow-forward"></i></span></p>
                            <h1 class="mb-3 bread"><?php echo $blog['title']; ?></h1>
                        </div>
                    </div>
                </div>
            </section>

            <section class="ftco-section ftco-degree-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 ftco-animate">
                            <h2 class="mb-3"><?php echo $blog['subtitle']; ?></h2>
                            <p><?php echo $blog['blog']; ?></p>
                           

                         

                           <!-- COMMENTS -->

                                <div class="pt-5 mt-5">
                                    <h3 class="mb-5">Comments</h3>
                                    <ul class="comment-list">
                                    <?php foreach ($comments as $comment): ?>
                                        <li class="comment">
                                            
                                            <div class="comment-body">
                                                <h3><?php echo $comment['name']; ?></h3>
                                                <div class="meta"> <?php echo $comment['created_at']; ?></div>
                                                <p>
                                                <?php echo $comment['comment']; ?>
                                                </p>
                                                <!-- <p><a href="#" class="reply">Reply</a></p> -->
                                            </div>
                                        </li>
                                        <?php endforeach; ?>
                                    </ul>
   
                                <!-- END comment-list -->





                                <div class="comment-form-wrap pt-5">
                                    <h3 class="mb-5">Leave a comment</h3>
                                    <form action="comment.php" class="p-5 bg-light" method="POST">
                                        <div class="form-group">
                                            <label for="name">Name *</label>
                                            <input type="text" class="form-control" id="name" name="name">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email *</label>
                                            <input type="email" class="form-control" id="email" name="email">
                                        </div>
                                        <div class="form-group">
                                            <label for="message">Comment</label>
                                            <textarea name="comment" id="comment" cols="30" rows="10" class="form-control"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <input type="hidden" name="post_id" value="1"> <!-- Replace with the actual post ID -->
                                            <input type="submit" value="Post Comment" class="btn py-3 px-4 btn-primary">
                                        </div>
                                    </form>

                                </div>
                            </div>

                        </div>
                        <!-- .col-md-8 -->
                        <!-- <div class="col-md-4 sidebar ftco-animate">
                            <div class="sidebar-box">
                                <form action="#" class="search-form">
                                    <div class="form-group">
                                        <span class="icon icon-search"></span>
                                        <input type="text" class="form-control" placeholder="Type a keyword and hit enter">
                                    </div>
                                </form>
                            </div>
                            <div class="sidebar-box ftco-animate">
                                <div class="categories">
                                    <h3>Categories</h3>
                                    <li><a href="#">Ferrari <span>(12)</span></a></li>
                                    <li><a href="#">Cheverolet <span>(22)</span></a></li>
                                    <li><a href="#">Ford <span>(37)</span></a></li>
                                    <li><a href="#">Subaru <span>(42)</span></a></li>
                                    <li><a href="#">Toyota <span>(14)</span></a></li>
                                    <li><a href="#">Mistsubishi <span>(140)</span></a></li>
                                </div>
                            </div> -->


                            <?php
                                // Fetch records from the "cars" table
                                $sql = "SELECT * FROM blog WHERE id != $blogId ";
                                $result = $conn->query($sql);

                            ?>
                            <div class="sidebar-box ftco-animate">
                                <h3>Recent Blog</h3>
                                <?php foreach ($result as $item) : ?>
                                <div class="block-21 mb-4 d-flex">
                                    <a class="blog-img mr-4" style="background-image: url('./database/blog-images/<?php echo $item['image'];?>');"></a>
                                    <div class="text">
                                        <h3 class="heading"><a href="blog-single.php?id=<?php echo $item['id'];?>"><?php echo $item['subtitle'];?></a></h3>
                                        <div class="meta">
                                            <div><a href="#"><span class="icon-calendar"></span>Oct. 29, 2019</a></div>
                                            <div><a href="#"><span class="icon-person"></span> Admin</a></div>
                                            <div><a href="#"><span class="icon-chat"></span> 19</a></div>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>

                           
                        </div>

                    </div>
                </div>
            </section>
            <!-- .section -->

            <footer class="ftco-footer ftco-bg-dark ftco-section">
                <div class="container">
                    <div class="row mb-5">
                        <div class="col-md">
                            <div class="ftco-footer-widget mb-4">
                                <h2 class="ftco-heading-2"><a href="#" class="logo">Car<span>book</span></a></h2>
                                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                                <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
                                    <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
                                    <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
                                    <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="ftco-footer-widget mb-4 ml-md-5">
                                <h2 class="ftco-heading-2">Information</h2>
                                <ul class="list-unstyled">
                                    <li><a href="#" class="py-2 d-block">About</a></li>
                                    <li><a href="#" class="py-2 d-block">Services</a></li>
                                    <li><a href="#" class="py-2 d-block">Term and Conditions</a></li>
                                    <li><a href="#" class="py-2 d-block">Best Price Guarantee</a></li>
                                    <li><a href="#" class="py-2 d-block">Privacy &amp; Cookies Policy</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="ftco-footer-widget mb-4">
                                <h2 class="ftco-heading-2">Customer Support</h2>
                                <ul class="list-unstyled">
                                    <li><a href="#" class="py-2 d-block">FAQ</a></li>
                                    <li><a href="#" class="py-2 d-block">Payment Option</a></li>
                                    <li><a href="#" class="py-2 d-block">Booking Tips</a></li>
                                    <li><a href="#" class="py-2 d-block">How it works</a></li>
                                    <li><a href="#" class="py-2 d-block">Contact Us</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="ftco-footer-widget mb-4">
                                <h2 class="ftco-heading-2">Have a Questions?</h2>
                                <div class="block-23 mb-3">
                                    <ul>
                                        <li><span class="icon icon-map-marker"></span><span class="text">203 Fake St. Mountain View, San Francisco, California, USA</span></li>
                                        <li><a href="#"><span class="icon icon-phone"></span><span class="text">+2 392 3929 210</span></a></li>
                                        <li><a href="#"><span class="icon icon-envelope"></span><span class="text">info@yourdomain.com</span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center">

                            <p>
                                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                Copyright &copy;
                                <script>
                                    document.write(new Date().getFullYear());
                                </script> All rights reserved | This template is made with <i class="icon-heart color-danger" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            </p>
                        </div>
                    </div>
                </div>
            </footer>



            <!-- loader -->
            <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
                    <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
                    <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00" />
                </svg></div>


            <script src="js/jquery.min.js"></script>
            <script src="js/jquery-migrate-3.0.1.min.js"></script>
            <script src="js/popper.min.js"></script>
            <script src="js/bootstrap.min.js"></script>
            <script src="js/jquery.easing.1.3.js"></script>
            <script src="js/jquery.waypoints.min.js"></script>
            <script src="js/jquery.stellar.min.js"></script>
            <script src="js/owl.carousel.min.js"></script>
            <script src="js/jquery.magnific-popup.min.js"></script>
            <script src="js/aos.js"></script>
            <script src="js/jquery.animateNumber.min.js"></script>
            <script src="js/bootstrap-datepicker.js"></script>
            <script src="js/jquery.timepicker.min.js"></script>
            <script src="js/scrollax.min.js"></script>
            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
            <script src="js/google-map.js"></script>
            <script src="js/main.js"></script>

        </body>

</html>

<?php
    } else {
        echo "Blog not found.";
    }
} else {
    echo "Blog ID not provided.";
}

// Close the database connection
$conn->close();
?>