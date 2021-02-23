<?php
include_once("./includes/function.php");
if (!isset($_SESSION["h_id"])) {
    $_SESSION["message"] = "You need Sign In first";
    redirect("login.php");
}
include_once("./includes/header.php");
echo message();
require_once("./includes/db.php");
$h_id = $_SESSION["h_id"];
$q = "SELECT * FROM freelancer where h_id = '$h_id'";
$result = mysqli_query($connection, $q);
$num = mysqli_num_rows($result);
if ($num) {
    $user = mysqli_fetch_assoc($result);
    if ($user["hired"] != 0) {
        $hirer_id = $user["hired"];
        $q_management = "SELECT * FROM client WHERE `m_id`=$hirer_id";
        $result_manage = mysqli_query($connection, $q_management);
        $num_manage = mysqli_num_rows($result_manage);
        if ($num_manage) {
            $manager = mysqli_fetch_assoc($result_manage);
            $hirer = $manager["name"];
            $_SESSION["message2"] = "You are Hired by $hirer";
        }
    }
?><img src="./images/2.png" alt=".." class="zindeximg" width="60%">
    <?php echo message2(); ?>
    <div class="careProfile">
        <form action="updateRate.php" method="post">
            <h1>Rate</h1>
            <?php if ($user["rate"] == 0) {
                echo "Please Provide Your Hourly Rate";
            } ?>
            <div class="inputDiv">
                <label for="rate">Current Rate</label>
                <input type="number" name="rate" required value="<?php echo $user["rate"]; ?>" />RM/Hour
            </div>
            <div class="text-center mb-2 mt-3">
                <input type="submit" value="Submit" name="submit" />
            </div>
        </form>
        <form action="updateBio.php" method="post">
            <h1>Bio</h1>
            <?php if ($user["bio"] == null) {
                echo "Please Provide a Bio for your profile";
            } ?>
            <div class="inputDiv">
                <label for="bio">Bio</label>
                <input type="text" name="bio" required value="<?php echo $user["bio"]; ?>" />
            </div>
            <div class="text-center mb-2 mt-3">
                <input type="submit" value="Submit" name="submit" />
            </div>
        </form>
    </div>
    <div class="careProfile">
        <form action="update.php?table=1" method="post">
            <h1>Update</h1>
            <?php echo message(); ?>
            <div class="inputDiv">
                <label for="username">Name</label>
                <input type="text" name="username" value="<?php echo $user["name"]; ?>" required />
            </div>
            <div class="inputDiv">
                <label for="email">Email</label>
                <input type="email" name="email" value="<?php echo $user["email"]; ?>" required />
            </div>
            <div class="inputDiv">
                <label for="password1">Current Password</label>
                <input type="password" name="password1" required />
            </div>
            <div class="inputDiv">
                <label for="password2">New Password</label>
                <input type="password" name="password2" required />
            </div>
            <div class="inputDiv">
                <label for="password3">Confirm Password</label>
                <input type="password" name="password3" required />
            </div>
            <div class="text-center mb-2 mt-3">
                <input type="submit" value="Submit" name="submit" />
            </div>
        </form>
        <form action="delete.php?table=1" method="post">
            <h1>Delete</h1>
            <div class="inputDiv">
                <label for="password1">Current Password</label>
                <input type="password" name="password" required />
            </div>
            <div class="text-center mb-2 mt-3">
                <input type="submit" value="Submit" name="submit" />
            </div>
        </form>
    </div>
<?php
}
?>