</div>

<footer class="bg-info mt-3 p-3 border-top">
    <div class="container">
        <div class="row">
            <p class="mb-0">&copy;&nbsp; <?php echo date("Y") ;?> - Breanna Hansen</p>
        </div>
        <div>
            <form method='post' action="index.php#logout">
                <input type='hidden' id="logout" name="logout"><br>
                <input type="submit" class="rs-size btn btn-custom bg-orange m-1" value="Log Out">
            </form>
        </div>
    </div>
</footer>
</body>
</html>