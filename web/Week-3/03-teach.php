<!-- Head -->
<?php include 'common/head.php'; ?>

    <title>03 Teach: Team Activity</title>

<!-- Nav -->
<?php include 'common/nav.php'; ?>

<!-- Header -->
<?php include 'common/header.php'; ?>

              <h1 class="offset-1 col-10 offset-md-0 col-md-12">03 Teach: Team Activity</h1>
          </div>
      </div>
    </header>
    
    <main class="mb-5">
      <div class="container">
            <div class="row d-md-flex">

            <form action="welcome.php" method="post">
                Name: <input type="text" name="name"><br>
                E-mail: <input type="text" name="email"><br>
                Major:
                <input type="radio" name="major" value="Computer Science">Computer Science
                <input type="radio" name="major" value="Web Design & Development">Web Design & Development
                <input type="radio" name="major" value="Computer Information Technology">Computer Information Technology
                <input type="radio" name="major" value="Computer Engineering">Computer Engineering
                Comments:
                <textarea name="comment" rows=5 cols="40"></textarea>
                <input type="submit">
            </form>

            </div>
        </div>
    </main>

<!-- Footer -->
<?php include 'common/footer.php'; ?>