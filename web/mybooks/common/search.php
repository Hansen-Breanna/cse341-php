<div>
    <form method="post" action="index.php?action=catalog">
        <div class="p-2">
            <label class="ml-1">Search by Author:</label><br>
            <div class="d-flex flex-wrap">
                <input class="rounded p-1 m-1" type="text" name="first-name" id="first-name" placeholder="First Name">
                <input class="rounded p-1 m-1" type="text" name="last-name" id="last-name" placeholder="Last Name">
                <input type='hidden' id='session' name='session' value=''>
            </div>
        </div>
        <div class="p-2">
            <label class="ml-1">Search by Title:</label><br>
            <div class="d-flex flex-wrap mb-2">
                <input class="rounded p-1 m-1" type="text" name="title" id="title" placeholder="Title">
                <input type='hidden' id='session' name='session' value=''>
                <input type="submit" class="btn btn-custom bg-info m-1">
            </div>
        </div>
    </form>
</div>

<div class="my-3 py-2 border-secondary border-top border-bottom">
    <a href="index.php?action=add-book" class="btn btn-custom bg-orange text-dark my-2">Add Title</a>
    <a href="index.php?action=remove-book" class="btn btn-custom bg-orange text-dark my-2">Remove Title</a>
</div>