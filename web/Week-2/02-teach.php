<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>02 Teach: Team Activity</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="02-script.js"></script>
</head>
<body class="bg-light">
    <main>
        <h1 class="bg-secondary p-3 display-5 text-light m-0 shadow-lg">02 Teach: Team Activity</h1>
        <div class="container">
            <div class="row d-md-flex">
                <div id="box-1" class="shadow-lg rounded box p-2 mt-4 offset-2 col-8 offset-md-0 col-md d-flex flex-column">
                    <p>Div 1</p>
                    <p class="reg-font">Enter a custom color: </p>
                    <input type="text" class="form-control" id="hexColor">
                    <button id="changeColor" type="button" class="btn btn-primary mt-2" onclick="changeBackground()">Change color</button>
                </div>
                <div id="box-2" class="shadow-lg rounded box p-2 mt-4 offset-2 col-8 offset-md-1 col-md">
                    <p>Div 2</p>
                </div>
                <div id="box-3" class="shadow-lg rounded box p-2 mt-4 offset-2 col-8 offset-md-1 col-md">
                    <p>Div 3</p>
                </div>
            </div> 
            <div class="row col-6 offset-3 col-md-8 offset-md-2">
                <button type="button" class="col-md btn btn-lg bg-primary mt-5 text-light shadow-lg" onclick="clickedAlert()">Click me</button>
                <button id="visibility" type="button" class="col-md offset-md-1 btn btn-lg bg-primary mt-5 text-light shadow-lg">Toggle Div 3</button>
            </div> 
        </div>
    </main>