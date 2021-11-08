<?php
require_once('./common.php');
require_once('./generate_profile_img.php');

$result = mysqli_query($db,"SELECT id FROM users") or die (mysqli_error($db));

while($user = mysqli_fetch_assoc($result)) {
    if (isset($user['id'])) {
        echo "<p>".$user['id']."</p>";
        generate_profile_img($user['id'], $db);
    }
}
?>

<p>SUCCESS!!</p>