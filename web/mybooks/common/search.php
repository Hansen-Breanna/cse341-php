<div>
    <form method="post" action="index.php?action=catalog"> 
        <div class="d-flex flex-wrap">
            <label>Search by Author:</label><br>
            <input class="rounded p-1" type="text" name="first-name" id="first-name" placeholder="First Name">
            <input class="rounded p-1" type="text" name="last-name" id="last-name" placeholder="Last Name">
            <input type='hidden' id='session' name='session' value=''>
        </div>
    </form>
    <form method="post" action="index.php?action=catalog"> 
        <div class="mt-1 d-flex">
            <label>Search by Title:</label><br>
            <div class="d-flex align-items-end">
            <input class="rounded p-1" type="text" name="title" id="title" placeholder="Title">
            <input type='hidden' id='session' name='session' value=''>
            <input type="submit" class="btn btn-custom bg-info ml-1">
            </div>
        </div>
    </form>
</div>