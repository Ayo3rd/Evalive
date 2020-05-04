<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
      @yield('title')
      @isset($course->name)
        {{$course->name}}
      @endisset
    </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/css/evalButton.css">
     <link rel="stylesheet" type="text/css" href="/css/evalListBlock.css">
     <link rel="stylesheet" type="text/css" href="/css/navBarBody.css">
</head>

<body>

 <div class="container">
        <!--NavBar  -->
        <nav class="navbar fixed-top navbar-expand-md navbar-dark">
            <div class = "container">
              <a class="navbar-brand" href="/about">
                <img src="https://image.flaticon.com/icons/png/512/2829/2829109.png">
              </a>
              <a class="remove-a" href="/about"><span class="brand-name">EvaLive</span></a>
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>

              <div class="collapse navbar-collapse" id="navbarsExample04">
                <ul class="navbar-nav nav justify-content-end">
                  <li class="nav-item">               
                    <a class="nav-link" href="/about">About<span class="sr-only">(current)</span></a>          
                  </li>
                  @if(Auth::check())
                      <li class="nav-item">
                        <a class="nav-link" href="/profile">Profile</a>
                      </li>
                       <li class="nav-item">
                        <a class="nav-link" href="/myEvaluations">My Evals</a>
                      </li>
                       <li class="nav-item">
                            <a href="/logout" class="nav-link">Logout</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                              @isset($user->email)
                                {{$user->email}}
                              @endisset
                            </a>
                        </li>
                  @else
                      <li class="nav-item">
                        <a class="nav-link" href="/signup">Sign Up</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="/login">Login</a>
                      </li>                      
                  @endif
                </ul>        
              </div>
            </div>
        </nav>
        <div id ="theApp" class ="container">
             @yield('content')
        </div>       
    </div>









    <!-- Footer -->
    <div class="row">
        <div class="col-12">
            <div class="footer">
                <hr>
                <p>Property of EvaLive, Inc.</p>            
            </div>
        </div>      
    </div>

</body>
</html>


<!-- Add Bootstrap Javascript -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
  
  $(function () {
     $(".like").on("click", function(event)
    {
        //Stop reloading onclick
        event.preventDefault();
        //Remove tr from html
        console.log ("clicked");

         var input = $(this).find('.qty1');
         input.val(parseInt(input.val())+ 1);
         let currentId = $(this).data("eval");
        //Send to backend to approve
        console.log("/profile/"+ currentId +"/like");
        ajaxGet("/profile/"+ currentId +"/like", function(results) 
        { 
          // This function gets run when backend.php returns something
          console.log(results);
        }); 
      });


     $(".dislike").on("click", function(event)
    {
        //Stop reloading onclick
        event.preventDefault();
        //Remove tr from html
        console.log ("clicked");

         var input = $(this).find('.qty2');
         input.val(parseInt(input.val())+ 1);
         let currentId = $(this).data("eval");
        //Send to backend to approve
        console.log("/profile/"+ currentId +"/dislike");
        ajaxGet("/profile/"+ currentId +"/dislike", function(results) 
        { 
          // This function gets run when backend.php returns something
          console.log(results);
        });
      });
  });

  //GET AJAX function
  function ajaxGet(endpointUrl, returnFunction){
      var xhr = new XMLHttpRequest();
      xhr.open('GET', endpointUrl, true);
      xhr.onreadystatechange = function(){
          if (xhr.readyState == XMLHttpRequest.DONE) {
              if (xhr.status == 200) {
                  returnFunction( xhr.responseText );
                  //console.log("It sent");
              } else {
                  alert('AJAX Error.');
                  console.log(xhr.status);
              }
          }
      }
      xhr.send();
  };
</script>