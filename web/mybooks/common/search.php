<div>
    <form method="post" action="index.php?action=catalog">
        <div class="p-2">
            <label>Search by Author:</label><br>
            <div class="d-flex flex-wrap">
                <input class="rounded p-1 ml-1" type="text" name="first-name" id="first-name" placeholder="First Name">
                <input class="rounded p-1 ml-1" type="text" name="last-name" id="last-name" placeholder="Last Name">
                <input type='hidden' id='session' name='session' value=''>
            </div>
        </div>
    </form>
    <form method="post" action="index.php?action=catalog">
        <div class="p-2">
            <label>Search by Title:</label><br>
            <div class="d-flex flex-wrap">
                <input class="rounded p-1 ml-1" type="text" name="title" id="title" placeholder="Title">
                <input type='hidden' id='session' name='session' value=''>
                <input type="submit" class="btn btn-custom bg-info ml-1">
            </div>
        </div>
    </form>
</div>