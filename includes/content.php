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
    
    <div class="container stories">
        <div class="row m-auto card-deck">  
            <?php foreach ($stories as $story): ?>
               <div class="col-12 col-md-6  col-lg-3  mb-5">
                    <div class="card h-100" >
                        <?php if ($story['thumbnail']): ?>
                            <a href="story.php?id=<?php echo $story['id']; ?>"><img src="<?php echo $story['thumbnail']; ?>" alt="<?php echo $story['title']; ?>" class="card-img-top" ></a>
                        <?php endif; ?>
                        <div class="card-title m-2"><h5><a class="text-decoration-none" href="story.php?id=<?php echo $story['id']; ?>"><?php echo $story['title']; ?></a></h5></div>
                        <div class="card-body">
                            <p>by <?php echo $story['author']; ?></p>
                            <p><?php echo $story['excerpt']; ?>...</p>
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
                <a class="btn btn-primary btn-sm p-2 mb-3 fs-6">Learn More</a>

            </div>
        </div>
    </div>
</section>