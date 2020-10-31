<?php
$servername = "localhost";
$username = "id15251966_requested_wishes";
$password = "WCThk2020-WCThk2020";
$dbname = "id15251966_wishes";

// Create connection
$conn =  mysqli_connect($servername, $username, $password, $dbname);

// CHECK DATABASE CONNECTION
if (mysqli_connect_errno()) {
  echo "Connection Failed" . mysqli_connect_error();
  exit;
}
$sql = "SELECT `Wish_id`,`Wish Name`,`Project type`,`Minority groups`,`Organization Name`,`District`, `Start date`, `End date` FROM `tbl_wishes` WHERE `isApproved` = 1";
$result = mysqli_query($conn, $sql);

?>

<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <style type="text/css">
    .field {
      display: flex;
      margin: auto;
      padding: 3%;
      border-bottom: black solid;
      border-bottom-width: thin;
    }

    .field h4 {
      margin: 0 auto;
      max-width: 40%;
      height: 100%;
    }

    .field h5 {
      margin: auto;
    }
  </style>
  <title>Wishes Come True | Volunteer</title>
</head>

<body>
  <div class="wishes">
    <?php
    if (mysqli_num_rows($result) > 0) {
      // output data of each row
      while ($row = mysqli_fetch_assoc($result)) { ?>
        <div class="wish">
          <div class="wish__contents">
            <h3 class="wish__name"><?php echo $row["Wish Name"] ?></h3>
            <p class="wish__filters">Filter | Filter | Filter</p>
          </div>
          <button id="<?php echo $row["Wish_id"] ?>" class="wish__more-info details_button">More Info</button>
          <div id="background-<?php echo $row["Wish_id"] ?>" class="modal-background">
            <div class="modal">
              <div class="modal-header">
                <div class="modal-cancel" id="close"></div>
                <h2>More info - <?php echo $row["Wish Name"] ?></h2>
              </div>
              <div class="modal-content">
                <div class="field">
                  <h4>Organization Name</h4>
                  <h5><?php echo $row["Organization Name"] ?></h5>
                </div>
                <div class="field">
                  <h4>District</h4>
                  <h5><?php echo $row["District"] ?></h5>
                </div>
                <div class="field">
                  <h4>Start date</h4>
                  <h5><?php echo $row["Start date"] ?></h5>
                </div>
              </div>
            </div>
          </div>
        </div>
    <?php }
    }
    ?>
  </div>

  <script type="text/javascript">
    var addButtons = document.getElementsByClassName('details_button');

    function getDetails() {
      console.log(event.srcElement.id);
      var id = event.srcElement.id;
      var select = "background-" + id;
      console.log(select);
      var modalBackground = document.getElementById(select);
      modalBackground.style.display = 'flex';
      modalBackground.style.left = 0;
    };

    for (i = 0; i < addButtons.length; i++) {
      addButtons[i].addEventListener("click", getDetails);
    }

    document.getElementById('close').addEventListener('click', function() {
      document.querySelector('.modal-background').style.display = 'none';
    });
  </script>

</body>

</html>

<?php
mysqli_close($conn);
?>