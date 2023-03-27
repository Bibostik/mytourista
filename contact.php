<!DOCTYPE html>
<html lang="en">
<?php include 'includes/navbar.php';?> 
 
 
 <!-- Contact Form -->
    <section class="contact-section py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-8 mx-auto">
                    <h2 class="text-center mb-4">Contact Us</h2>
                    <form method="POST" action="contactserver.php" class="bg-white p-4 shadow-sm">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" id="name" name="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea name="message" id="message" cols="30" rows="5" class="form-control" required></textarea>
                        </div>
                        <div class="text-center">
                            <button type="submit" name="submit" class="btn btn-primary px-4 mt-3">Send Message</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>


    <!-- footer -->
    <?php include 'includes/footer.php';?>