<?php
$login = 0;
$invalid = 0;
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    include "connection.php";
    $username = $_POST['UserName'];
    $password = $_POST['Password'];
 
    $sql = "select* from `user` where username = '$username' and password = '$password'";
    $q = "SELECT `Role` FROM `user` WHERE username = '$username'";
    $res = mysqli_query($con,$q);
    $rol = mysqli_fetch_assoc($res);
    $role = $rol['Role'];
 
    $result = mysqli_query($con, $sql);
    if (mysqli_num_rows(($result)) > 0) {
        $login = 1;
        session_start();
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $role;
        if( $_SESSION['role'] == 'Operator')
        {
            echo $_SESSION['role'];
            header('location:display_Operator.php');
        }
        else
        {
            echo $_SESSION['role'];
            header('location:display_Planner.php');
        }
    } else {
        $invalid = 1;
    }
}
?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>login_page</title>
</head>

<body>
    <h1 class="text-center">Log In</h1>
    <div class="container mt-5">
        <form action="login.php" method="POST">
            <div class="form-group">
                <label for="UserName">User Name</label>
                <input type="text" class="form-control" id="UserName" name="UserName">
            </div>
            <div class="form-group">
                <label for="Password">Password</label>
                <input type="text" class="form-control" id="Password" name="Password">
            </div> 
           <div>


            <button type="submit" class="btn btn-primary w-100">Log In</button>
        </form>
    </div>
</body>

<?php
if ($login) {
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Great</strong> Welcome
  </div>';
}
if ($invalid) {
    echo '<div class="alert alert-danger alert-dismissible fade show role="alert">
    <strong>Sorry</strong> Wrong credentials
  </div>';
}


?>

</html>