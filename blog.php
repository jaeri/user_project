<?php
include 'connection.php';

if ($conn) {
    $querytableUser = "CREATE TABLE IF NOT EXISTS `blogs` (
        `blog_id` int(11) unsigned NOT NULL auto_increment,
        `content` varchar(2500) NOT NULL,
        `date` varchar(155) NOT NULL,
        `image` varchar(255) NOT NULL,
        `title` varchar(1000),
        PRIMARY KEY (`blog_id`)
    )";

    mysqli_query($conn, $querytableUser);

}
mysqli_close($conn);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog List</title>

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
        <div class="p-5 text-center bg-light" style="margin-top: 58px;">
            <h1 class="mb-3">All Blogs</h1>
            <h4 class="mb-3">Enjoy its and give your comment</h4>
        </div>
        <!-- Jumbotron -->
    </header>

    <div class="container mt-5">
        <div class="row row-cols-1 row-cols-md-2 g-4 blogs-container">
            <div class="col blog-item">
                <div class="card">
                    <a href="#" class="blog-detail"><img src="" class="card-img-top" alt="" /></a>
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

    <script>
        function allBlogs() {
            fetch('blog_queries.php?action=list')
                .then(res => res.json())
                .then(blogs => {

                    const template = document.querySelector('.blog-item');
                    for (const blog of blogs) {
                        console.log(blog.title);
                        const clone = template.cloneNode(true);
                        document.querySelector('.blogs-container').append(clone);
                        clone.querySelector('.card-title').innerText = blog.title;
                        clone.querySelector('img').src = "images/" + blog.image;
                        clone.querySelector('.card-text').innerHTML = blog.content.substring(1, 150) + " ...";
                        clone.querySelector('.blog-detail').href = 'blog_detail.php?id=' + blog.blog_id;

                        // go to detail page
                        /* clone.querySelector('.blog-detail').addEventListener('click', function (e) {
                             e.preventDefault();
                             fetch('blog_detail.php?id='+blog.blog_id)
                                 .then(resp => resp.json())
                                 .then(data )
                         });*/
                    }
                    template.remove();

                });
        }

        allBlogs();
    </script>

    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.js"></script>
</body>

</html>