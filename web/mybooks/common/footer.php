</div>

<footer class="bg-info mt-3 p-3 border-top">
    <div class="container d-flex justify-content-between align-items-start">
        <div class="row d-flex justify-content-between align-items-center">
            <p class="mb-0 pt-4">&copy;&nbsp; <?php echo date("Y") ;?> - Breanna Hansen</p>
</div>
<div>
            <form method='post' action="index.php">
                <input type='hidden' id="logout" name="logout" value="logout"><br>
                <input id="logout-button" type="submit" class="btn bg-orange m-1 p-2 shadow" value="Log Out">
            </form>
        </div>
    </div>
</footer>
</body>
</html>