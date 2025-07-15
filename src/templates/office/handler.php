<?php

namespace templates;

$SITE_NAME = "Noddy by Elizabeth";
$SITE_LINK = "https://noddybyelizabeth.ac.th";

?>

<!DOCTYPE html>
<html lang="en" class="dark">

<?php include(__DIR__."/../shared/header.php"); ?>

<body class="flex h-screen bg-gray-100 text-gray-900">

<?php include(__DIR__."/main.php"); ?>
<?php //include(__DIR__."/sign-in.php"); ?>

</body>
</html>