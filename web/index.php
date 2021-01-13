<!-- Header -->
<?php include 'common/nav.php'; ?>

  <header>
  <div class="container">
        <div class="row">
            <h1>Breanna Hansen</h1>
        </div>
    </div>
  </header>
  
  <main>
      <div class="container">
          <div class="row d-md-flex">
              <div id="box-1" class="hidden-content shadow-lg rounded box p-2 mt-4 offset-2 col-8 offset-md-0 col-md d-flex flex-column">
              </div>
              <div id="box-2" class="hidden-content shadow-lg rounded box p-2 mt-4 offset-2 col-8 offset-md-1 col-md">
              </div>
              <div id="box-3" class="hidden-content shadow-lg rounded box p-2 mt-4 offset-2 col-8 offset-md-1 col-md">
              </div>
          </div> 
          <div class="row col-6 offset-3 col-md-8 offset-md-2">
              <button type="button" class="col-md btn btn-lg bg-primary mt-5 text-light shadow-lg" onclick="clickedAlert()">Click me</button>
              <button id="visibility" type="button" class="col-md offset-md-1 btn btn-lg bg-primary mt-5 text-light shadow-lg" onclick="changeBackground()">Toggle Div 3</button>
          </div> 
      </div>
  </main>

<!-- Footer -->
<?php include 'common/footer.php'; ?>