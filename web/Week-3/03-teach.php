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

            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <div class="name">
                    <label for="name">Name:</label> 
                    <input type="text" name="name"><br>
                </div>
                <div class="email">
                    <label for="email">Email:</label>
                    <input type="text" name="email"><br>
                </div>
                <div class="major">
                    <label for="major">Major:</label>
                    <input type="radio" name="major" value="Computer Science">Computer Science
                    <input type="radio" name="major" value="Web Design & Development">Web Design & Development
                    <input type="radio" name="major" value="Computer Information Technology">Computer Information Technology
                    <input type="radio" name="major" value="Computer Engineering">Computer Engineering
                </div>
                <div class="comments">
                    <label for="comments">Comments:</label>
                    <textarea name="comment" rows=5 cols="40"></textarea>
                </div>
                <div class="submit">
                    <input type="submit">
                </div>
            </form>

            </div>
        </div>
    </main>

<!-- Footer -->
<?php include 'common/footer.php'; ?>