</div>

<footer class="bg-info mt-3 pb-3 border-top">
    <div class="container d-flex justify-content-between align-items-center">
        <div class="row d-flex justify-content-between align-items-bottom">
            <p class="pt-4 pl-3">&copy;&nbsp; <?php echo date("Y") ;?> - Breanna Hansen</p>
        </div>
        <div class="d-flex align-items-end">
            <form method='get' action="index.php?action=home">
                <input type="submit" class="btn bg-orange p-2 shadow mr-3" value="Log In">
            </form>
            peanuts
            <form method='post' action="index.php?action=home">
                <input type='hidden' id="logout" name="logout" value="logout"><br>
                <input id="logout-button" type="submit" class="btn bg-orange p-2 shadow" value="Log Out">
            </form>
        </div>
    </div>
</footer>
</body>
</html>