</head>
<body class="bg-dark h-100 m-0 text-light">
        <nav class="navbar navbar-expand-md bg-info navbar-dark border-bottom box-shadow mb-3">
            <div class="container">
                <a class="navbar-brand" href="index.php">My Books</a>
                <form class="d-flex w-auto" method="post" action="index.php">
                    <input class="rounded border-none m-1" type="text" name="username" placeholder="username">
                    <input class="rounded border-none m-1" type='text' name="password" placeholder="password">
                    <input type="submit" class="btn btn-custom bg-info m-1">
                </form>
                <a href="index.php?action=login" class="btn bg-orange">Log In</a>
                <button class="navbar-toggler" type="button">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-collapse d-md-inline-flex flex-md-row-reverse">
                    <ul id="link-nav" class="navbar-nav flex-grow-1 d-md-inline-flex">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?action=catalog">Catalog</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?action=wish">Wishes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?action=authors">Authors</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?action=loans">Loans</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?action=reviews">Reviews</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

    