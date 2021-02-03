<form method="post" action="index.php?action=catalog">
    <div class="p-2">
        <label class="ml-1">Search by Title:</label><br>
        <div class="d-flex flex-wrap mb-2">
            <input class="rounded p-1 m-1" type="text" name="title" id="title" placeholder="Title">
            <input type='hidden' id='session' name='session' value=''>
            <input type="submit" class="btn btn-custom bg-info m-1">
        </div>
    </div>
</form>