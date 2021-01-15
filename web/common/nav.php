</head>
<body class="bg-dark h-100 m-0">
    <header>

        <!-- Nav code altered from https://www.w3schools.com/howto/tryit.asp?filename=tryhow_js_topnav -->
        <nav class="topnav bg-info navbar-dark text-dark border-bottom box-shadow mb-3" id="nav">
            <a href="index.php" class="navbar-brand text-dark">CSE 341 Software Engineering I</a>
            <a href="index.php">Home</a>
            <a href="assignments.php">Assignments</a>
            <a href="javascript:void(0);" class="icon" onclick="navToggle()">
                <span class="navbar-toggler-icon"></span>
            </a>
        </nav>

        <nav class="navbar navbar-expand-sm bg-info navbar-toggleable-sm navbar-dark text-dark border-bottom box-shadow mb-3">
            <div class="container">
                <a class="navbar-brand text-dark">CSE 341 Software Engineering I</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".navbar-collapse" onclick="navToggle()">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div id="nav" class="topnav d-sm-inline-flex flex-sm-row-reverse">
                    <ul class="navbar-nav flex-grow-1">
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="assignments.php">Assignments</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>