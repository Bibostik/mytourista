<section>
    <div class="container my-4">
        <div class="row">
            <div class="col">
                <div class="d-flex justify-content-between mx-3">
                    <h1>Latest story</h1>
                    <a class="btn btn-primary btn p-2 mb-3 fs-6" href="storylist.php">More stories >></a>
                </div>
            </div>
        </div>
    </div>
    
   <div class="container">
    <div class="row">
        <?php foreach ($stories as $story): ?>
        <div class="col-12 col-md-6 col-lg-3 mb-4">
            <div class="card h-100">
                <?php if ($story['thumbnail']): ?>
                <a href="singlestory.php?id=<?php echo $story['id']; ?>"><img src="<?php echo $story['thumbnail']; ?>" alt="<?php echo $story['title']; ?>" class="card-img-top"></a>
                <?php endif; ?>
                <div class="card-body">
                    <h5 class="card-title"><a class="text-decoration-none" href="singlestory.php?id=<?php echo $story['id']; ?>"><?php echo $story['title']; ?></a></h5>
                    <p class="card-text">by <?php echo $story['author']; ?></p>
                    <p class="card-text"><?php echo $story['location']; ?></p>
                    <p class="card-text"><?php echo $story['category']; ?></p>
                    <p class="card-text"><?php echo $story['excerpt']; ?>...</p>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="btn-group">
                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode('http://mytourista.smatstores.com/singlestory.php?id=' . $story['id']); ?>" class="btn btn-sm btn-facebook" target="_blank"><i class="fab fa-facebook"></i> Share</a>
                            <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode('http://mytourista.smatstores.com/singlestory.php?id=' . $story['id']); ?>&text=<?php echo urlencode($story['title']); ?>" class="btn btn-sm btn-twitter" target="_blank"><i class="fab fa-twitter"></i> Tweet</a>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

    </div>
    
     
</section>

<section class="prefooter">
    <div class="container-fluid">
        <div class="row bottom-banner">
            <div class="col bottom-banner text-center d-grid align-content-center justify-content-center">
                <a class="btn btn-primary btn-sm p-2 mb-3 fs-6" type="button"  data-bs-toggle="modal" data-bs-target="#exampleModal">Learn More</a>

            </div>
        </div>
    </div>
</section>