<div class="py-5 bg-light">
    <div class="container">
        <h1><?php echo $title; ?></h1>
        <div class="row">

            <div class="col">
            
                <?php
                // if(isset($_POST["name"])){
                //     echo "<p>Hi, " . $_POST["name"] . "</p>";
                // }
                ?>

                <!-- <form method="POST" action="/contact">
                    <label for="inputName">Name:</label>
                    <input type="text" name="name" id="inputName">
                    <input type="submit" value="Submit">
                </form> -->


                <div class="card">
                    <div class="card-header bg-primary text-white"><i class="fa fa-envelope"></i> Leave Your Message.
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="username"
                                    aria-describedby="emailHelp" placeholder="Enter name" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email address</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    aria-describedby="emailHelp" placeholder="Enter email" required>
                                <small id="emailHelp" class="form-text text-muted">We'll never share your email with
                                    anyone else.</small>
                            </div>
                            <div class="form-group">
                                <label for="message">Message</label>
                                <textarea class="form-control" id="message" name="message" rows="6" required></textarea>
                            </div>
                            <div class="mx-auto">
                                <button type="submit" class="btn btn-primary text-right">Submit</button></div>
                        </form>
                    </div>
                </div>

            </div>
            <div class="col-12 col-sm-4">
                <div class="card bg-light mb-3">
                    <div class="card-header bg-success text-white text-uppercase"><i class="fa fa-home"></i> Address
                    </div>
                    <div class="card-body">

                        <?php 
                        if (isset($address)):                        
                            foreach ($address as $addr):?>
                                <p><?php echo $addr['street'];?></p>
                                <p><?php echo $addr['city'];?></p>
                                <p><?php echo $addr['country'];?></p>
                                <p>Email : <?php echo $addr['email'];?></p>
                                <p>Tel.: <?php echo $addr['mobile'];?></p>
                            <?php endforeach;?>
                        <?php endif;?>
                    </div>
                </div>
            </div>

        </div>
        <div class="col">
            <div class="card">
                <div class="card-header bg-primary text-white"><i class="fa fa-envelope"></i> Comments
                </div>
                <div class="card-body">
                <?php
                // if (isset($comments)):
                //     printf("<h2>There Are %d Comments In Guest Book</h2>", count($comments));       
                //     foreach ($comments as $key => $value) {
                //         echo("<div class='top'><b>User ".$value[0]." </b> <a href='mailto:".$value[1]."'>".$value[1]."</a>  Added this: </div><div class='comment'>".strip_tags($value[2])."</div>"."<p>At ".strip_tags($value[3])."</p><hr>");
                //     }
                // else:
                //     printf("<h2 style='color: #%x%x%x'>No Comments Yet...</h2>", 165, 27, 45);

                // endif;
                ?>
                </div>
            </div>
        </div>
    </div>
</div>