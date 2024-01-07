<?php
    

    if (isset($_POST['btna'])) {
        $txt = $_POST['text'];
        if ($txt = 'a') {
            echo '<script>
                document.getElementById("btna").addEventListener("click", function() {
                    document.getElementById("a").style.display = "none";
                    document.getElementById("b").style.display = "block";
                }
                </script>';
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Đếm ngược thời gian</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js">
        document.getElementById("hideButton").addEventListener("click", function() {
            document.getElementById("hideButton").style.display = "none";
            document.getElementById("showButton").style.display = "block";
        });
    </script>
</head>
<body>
    <form id="myForm" id="a" method="post">
        <h1 id="a" >form a</h1>
        <h1 id="b" style="display: none;">form b</h1>
        <input type="text" name="text">
        <input type="submit" value="Submit" name="btna" id="btna">
    </form>
</body>
</html>