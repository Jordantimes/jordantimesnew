<?php include 'database.php';
include 'server.php';
?>

<head>
  <!-- Required meta tags always come first -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/styles.css">
  <link rel="stylesheet" href="css/dashboards.css">
  <title>JordanTimes</title>

  <!--Fontawesome CSS-->
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <!--Socialicons CSS-->
  <link rel="stylesheet" href="../node_modules/bootstrap-social/bootstrap-social.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<body>
  <nav class="navbar navbar-dark navbar-expand-md  fixed-top">
    <div class="container">
      <button class="navbar-toggler" type="button" data-toggle="collapsed" data-target="#Navbar">
        class="navbar-toggler-icon">
      </button>
      <a class="navbar-brand mr-auto" href="./index.html">JordanTimes</a>
      <ul class="navbar-nav mr-md">
        <li class="nav-item active"> <a class="nav-link" href="./index.html">
            <spsn>Home
          </a></li>
        <!--Navbar MENU-->
        <li class="nav-item"> <a class="nav-link" href="./aboutus.html">
            <spsn>About
          </a></li>
        <li class="nav-item"> <a class="nav-link" href="#">
            <spsn>Contact
          </a></li>
        <li class="nav-item"> <a class="nav-link" name="logout">
            <spsn>Logout
          </a></li>

        <select class="nav-item">
          <option selected>English</option>
          <option selected>العربية</option>
        </select>
        <select id="currency" class="nav-item">
          <option value="USD" selected>USD Dollar</option>
          <option value="JOD">JD</option>
        </select>
      </ul>
    </div>
  </nav>

  </head>
  <html>

  <body>




    <div>
      <img id="background_img" style="width:1273px;" src="images/petraBackground.png">
    </div>


    <!--Dashboard Block-->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <div>
      <div class="container-fluid flex-container">
        <h2> <?php echo $_SESSION['username'] ?></h2>
        <ul class="nav nav-tabs flex-column flex-child">

          <li><a class="w-25 p-3 text-danger" data-toggle="tab" href="#dashboard">My Dashboard</a></li>
          <li><a class="w-25 p-3 text-danger" data-toggle="tab" href="#history">History</a></li>
          <li><a class="w-25 p-3 text-danger" data-toggle="tab" href="#notifications">Notifications </a></li>
        </ul>


        <div id="myTabContent" class="tab-content">

          <div class="tab-pane fade " id="dashboard">
            <?php
            $sql2 = "select num, title, descriptions, images,price,locations, statuses from trips";
            $retval = mysqli_query($conn, $sql2);


            while ($row = mysqli_fetch_array($retval, MYSQLI_NUM)) {






              // created post  
              $element = "



  <div id=\"createdCard\" class=\"col-md-6 col-sm-6 my-6 my-md-0 \" >
              <form action=\"home\"  method=\"post\">
                  <div class=\"card shadow\">
                      <div>
                          <img src=\" $row[3]\" alt=\"Image1\" class=\"img-fluid card-img-top\">
                      </div>
                      <div class=\"card-body\">
                          <h2 class=\"card-title\">$row[1]</h2>
                          
                          <p class=\"card-text\">
                             $row[2]
                          </p>
                          <h4>
                              <small><s class=\"text-secondary\"> </s></small>
                              <span class=\"price\">$row[4]</span>
                          </h4>

                          <a  clicked onclick=\"Delete()\" class=\"card-link\">Delete</a>
                        <a data-toggle=\"modal\" data-target=\"#myModalEdit\" class=\"card-link\">Edit</a>
                          
                          
                      </div>
                  </div>
              </form>
          </div>
  ";
              echo $element;
            }

            ?>
          </div>
          <div class="tab-pane fade" id="history">
            <p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone skateboard locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork.</p>
          </div>
          <div class="tab-pane fade" id="notifications">
            <p>Trust fund seitan letterpress, keytar raw denim keffiyeh etsy art party before they sold out master cleanse gluten-free squid scenester freegan cosby sweater. Fanny pack portland seitan DIY, art party locavore wolf cliche high life echo park Austin. Cred vinyl keffiyeh DIY salvia PBR, banh mi before they sold out farm-to-table VHS viral locavore cosby sweater.</p>
          </div>
        </div>


        <!-- Edit Modal -->
        <div id="myModalEdit" class="modal fade" role="dialog">
          <div class="modal-dialog">

            <!-- Edit Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>

              </div>
              <form action="company_page.php" method="POST">
                <label for="exampleInputText" class="form-label mt-4">Campagin-ID</label>
                <input type="text" name="editNo" class="form-control" id="exampleInputText" aria-describedby="textHelp" placeholder="Enter Campagin Title">

                <label for="exampleInputText" class="form-label mt-4">Campagin-Title</label>
                <input type="text" name="editTitle" class="form-control" id="exampleInputText" aria-describedby="textHelp" placeholder="Enter Campagin Title">
                <label for="exampleTextarea" class="form-label mt-4">Description</label>
                <textarea name="editTextarea" class="form-control" id="exampleTextarea" rows="3"></textarea>




                <div class="form-group">
                  <label for="formFile" class="form-label mt-4">Upload your images</label>
                  <input name="editImg_file" class="form-control" type="file" id="formFile">
                </div>


                <div>

                  <label for="exampleInputText" class="form-label mt-4">price</label>
                  <input type="text" name="editPrice" class="form-control" id="exampleInputText" aria-describedby="textHelp" placeholder="0.00" onchange="setTwoNumberDecimal">
                </div>
                <div class="modal-footer">
                  <button type="submit" data-dismiss="modal" name="editChanges" class="btn btn-primary">Edit</button>

                </div>
              </form>

            </div>
          </div>

        </div>
      </div>






      <!--Float Button-->




      <div class="container">

        <!-- Trigger the modal with a button -->
        <a data-toggle="modal" data-target="#myModal" class="float">
          <i id="myBtn" class="fa fa-plus my-float"></i>
        </a>

        <!-- Modal -->
        <div class="modal fade" id="myModal" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>

              </div>
              <div class="modal-body">
                <form action="company_page.php" method="POST">
                  <label for="exampleInputText" class="form-label mt-4">Campagin-ID</label>
                  <input type="text" name="no" class="form-control" id="exampleInputText" aria-describedby="textHelp" placeholder="Enter Campagin ID">

                  <label for="exampleInputText" class="form-label mt-4">Campagin-Title</label>
                  <input type="text" name="title" class="form-control" id="exampleInputText" aria-describedby="textHelp" placeholder="Enter Campagin Title">
                  <label for="exampleTextarea" class="form-label mt-4">Description</label>
                  <textarea name="textarea" class="form-control" id="exampleTextarea" rows="3"></textarea>

                  <label for="exampleInputText" class="form-label mt-4">Location</label>
                  <input type="text" name="location" class="form-control" id="exampleInputText" aria-describedby="textHelp" placeholder="Enter Location ">




                  <div class="form-group">
                    <label for="formFile" class="form-label mt-4">Upload your images</label>
                    <input name="img_file" class="form-control" type="file" id="formFile">
                  </div>


                  <div>

                    <label for="exampleInputText" class="form-label mt-4">price</label>
                    <input type="text" name="price" class="form-control" id="exampleInputText" aria-describedby="textHelp" placeholder="0.00" onchange="setTwoNumberDecimal">
                  </div>
                  <div class="modal-footer">
                    <button type="submit" name="saveChanges" class="btn btn-primary">Save changes</button>

                  </div>
                </form>
              </div>

            </div>
          </div>

        </div>

  </body>

  </html>














  <script>
    //Modal Plugin
    var modal = document.getElementById("myModal");
    var btn = document.getElementById("myBtn");
    var span = document.getElementsByClassName("close")[0];
    var save = document.getElementById("saveChanges");

    btn.onclick = function() {
      modal.style.display = "block";
    }


    span.onclick = function() {
      modal.style.display = "none";
    }

    save.onclick = function() {
      modal.style.display = "none"
    }




    function Delete() {
      var card = document.getElementById("createdCard");
      card.style.display = "none";
    }
  </script>





  <!-- jQuery first, then Popper.js, then Bootstrap JS. -->
  <script src="node_modules/jquery/dist/jquery.slim.min.js"></script>
  <script src="node_modules/popper.js/dist/umd/popper.min.js"></script>
  <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
</body>

</html>


<?php



// Add Post

if (isset($_POST['saveChanges'])) {
  $campNo = $_POST['no'];
  $title = $_POST['title'];
  $description = $_POST['textarea'];
  $image_file = $_POST['img_file'];
  $price = $_POST['price'];
  $location = $_POST['location'];


  $sql = "INSERT INTO `trips` ( id, num, title, descriptions, images, price, locations, statuses) VALUES
 (null, '$title','$campNo','$description', '$image_file', '$price', '$location', '0' )";

  if (!mysqli_query($conn, $sql)) {

    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
}

// Edit Post

if (isset($_POST['editChanges'])) {
  $no = $_POST['editNo'];
  $title = $_POST['editTitle'];
  $description = $_POST['editTextarea'];
  $image_file = $_POST['editImg_file'];
  $price = $_POST['editPrice'];



  $sql3 = "Update `trips` set  title = '$title', descriptions='$description', images='$image_file', price='$price'
  where num = '$no'";

  if (!mysqli_query($conn, $sql3)) {

    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
}




if (isset($_GET['logout'])) {
  session_destroy();
  unset($_SESSION['username']);
  header("location: login.php");
}



?>