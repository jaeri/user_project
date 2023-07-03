<?php

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.css" rel="stylesheet" />
</head>

<body>
    <header>
        <!-- Navbar -->
        <?php require_once 'nav.html'; ?>
        <!-- Navbar -->

        <!-- Jumbotron -->
        <div class="p-5 text-center bg-light jumbotron" style="margin-top: 58px;">
            <h1 class="mb-3">Blog</h1>
            <h4 class="mb-3">Enjoy its and give your comment</h4>
        </div>
        <!-- Jumbotron -->
    </header>

    <div class="container">
        <div class="row">
            <div class="col-sm-5 col-md-8">
                <!-- <h3 class="blog-title">h3. MDB heading</h3> -->
                <img src="" class="img-fluid blog-image" alt="" width="100%" />
                <div class="blog-content"></div>
            </div>


            <div class="col-sm-5 col-md-4">
            <div class="col">
    <div class="card">
      <img src="https://mdbcdn.b-cdn.net/img/new/standard/city/041.webp" class="card-img-top" alt="Hollywood Sign on The Hill"/>
      <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">
          This is a longer card with supporting text below as a natural lead-in to
          additional content. This content is a little bit longer.
        </p>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card">
      <img src="https://mdbcdn.b-cdn.net/img/new/standard/city/042.webp" class="card-img-top" alt="Palm Springs Road"/>
      <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">
          This is a longer card with supporting text below as a natural lead-in to
          additional content. This content is a little bit longer.
        </p>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card">
      <img src="https://mdbcdn.b-cdn.net/img/new/standard/city/043.webp" class="card-img-top" alt="Los Angeles Skyscrapers"/>
      <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content.</p>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card">
      <img src="https://mdbcdn.b-cdn.net/img/new/standard/city/044.webp" class="card-img-top" alt="Skyscrapers"/>
      <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">
          This is a longer card with supporting text below as a natural lead-in to
          additional content. This content is a little bit longer.
        </p>
      </div>
    </div>
  </div>
            </div>
        </div>
    </div>

    <script>
        const queryString = window.location.search;
        console.log(queryString);
        const urlParams = new URLSearchParams(queryString);
        const id_user = urlParams.get('id');
        console.log(id_user);

        // go to detail page      
        fetch('blog_queries.php?action=detail&id=' + id_user)
            .then(resp => resp.json())
            .then(blog => {
                //console.log(blog.title);
                document.querySelector('.jumbotron h4').innerText = blog.title;
                /*document.querySelector('.jumbotron').style.backgroundImage = "url('images/" + blog.image + "')";
                document.querySelector('.jumbotron').style.backgroundSize = "Cover";*/

                document.querySelector('.blog-image').src = "images/" + blog.image;
                //document.querySelector('.blog-title').innerText = blog.title;
                document.querySelector('.blog-content').innerHTML = blog.content;



            });


    </script>

    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.js"></script>
</body>

</html>