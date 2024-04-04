<?php
$email = $_REQUEST['email'];
$token = $_REQUEST['token'];

// echo $em;
// echo $token;

include_once("./backend/database.php");

$q = "select * from register where u_email='$email' and token='$token'";
$result = mysqli_query($con, $q);
$count = mysqli_num_rows($result);

if ($count == 1) {
    while ($row = mysqli_fetch_array($result)) {
        $status = $row[7];
        if ($status == "Active") {

            $_SESSION['success'] = "Account is already activated";
        } else {
            $updt = "update register set `status`='Active' where u_email='$email' and token='$token'";
            if (mysqli_query($con, $updt)) {
                setcookie('success', "Activation activated successfully", time() + 2, "/");
            } else {
                setcookie('error', "Error in activating Account. Please try again later.", time() + 2, "/");
            }
        }
?>
        <script>
            window.location.href = "login.php";
        </script>
    <?php
    }
} else {
    setcookie('error', "Either Email is not registered or token is incorrect.", time() + 2, "/");
    ?>
    <script>
        window.location.href = "register.php";
    </script>
<?php
}
