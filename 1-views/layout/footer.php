
</body>
<?php
$cookie = "Cookie: " . date("d")."/".date("m")."/".date("y");
$_SESSION["name"] = $cookie;
?>
<footer style="background-color:#41444b; text-align:center; color: #fff" id="footer" class="footer mt-auto py-1">
    <div class="wrapper">
        <p>© Copyright 2020 Telekom Technik GmbH</p>
        <br>
        <h6><?php if (isset($_SESSION["name"])) {print $_SESSION["name"];} ?></h6>
    </div>
</footer>
</html>
<?php
ob_end_flush();
?>
