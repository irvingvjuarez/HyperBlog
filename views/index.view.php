<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php require "templates/header.php"; ?>

    <main class="main-index">
        <?php if( !empty($errors) ): ?>
            <?php echo $errors; ?>
        <?php else: ?>
            <?php while($article = $result->fetch_assoc()): ?>
                <section class="index_card">
                    <article class="index_card-content">
                        <a href="post.php?title=<?php echo $article["title"]; ?>">
                            <div class="card-content_img-container">
                                <img src="<?php echo $article["img"]; ?>" alt="<?php echo $article["title"]; ?>">
                            </div>
                        </a>
                        <div class="card-content_text">
                            <h3><a href="post.php?title=<?php echo $article["title"]; ?>"><?php echo $article["title"]; ?></a></h3>
                            <p>
                                <?php echo nl2br($article['content']); ?>
                            </p>
    
                            <span class="text-info"><a href="author.php">Irving Juárez</a>, <i><?php echo dateFormat($article["date"]); ?></i></span>
                        </div>
                    </article>
    
                    <article class="index_card-status">
                        <form action="<?php echo htmlspecialchars( $_SERVER['PHP_SELF'] ); ?>" method="POST">
                            <button type="submit" class="resetButton" name="like">
                                <?php
                                    if($article['likes'] == 0){
                                        echo "<i class='far fa-heart fa-lg'></i>";
                                    }else{
                                        echo "<i style='color:#a39090;' class='fas fa-heart fa-lg'></i>";
                                    }
                                ?>
                            </button>
                            <p><?php echo $article['likes']; ?></p>
                            <input type="hidden" name="currentLikes" value="<?php echo $article['likes'] ?>">
                            <input type="hidden" name="title" value="<?php echo $article['title']; ?>">
                        </form>
    
                        <a href="post.php?title=<?php echo $article["title"]; ?>" class="status_anchor">See the post<i class="fa fa-arrow-right"></i></a>
                    </article>
                </section>
            <?php endwhile; ?>
        <?php endif; ?>
    </main>

    <?php require "templates/footer.php"; ?>
    <script src="js/ajax.js"></script>
</body>
</html>