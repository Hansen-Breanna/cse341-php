</div>

<footer class="bg-info mt-3 pb-3 border-top">
    <div class="container d-flex justify-content-between align-items-center">
        <div class="row d-flex justify-content-between align-items-bottom">
            <p class="pt-3 pl-3">&copy;&nbsp; <?php echo date("Y") ;?> - Breanna Hansen</p>
        </div>
        <div>
            <form method='post' action="index.php">
                <input type='hidden' id="logout" name="logout" value="logout"><br>
                <input id="logout-button" type="submit" class="btn bg-orange p-2 shadow" value="Log Out">
            </form>
        </div>
    </div>
</footer>
</body>
</html>