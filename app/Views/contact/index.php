<div class="py-5 bg-light">
    <div class="container">
        <h1><?php echo $title; ?></h1>
        <div class="row">

            <div class="col">
                <?php if (isset($error)):?>
                    <div class="alert alert-danger" role="alert">
                        Ошибка <?= $error;?> Please try again!
                    </div>
                <?php endif;?>

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
                                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
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
                if (isset($comments) and count($comments)>0):
                    printf("<h2>There Are %d Comments In Guest Book</h2>", count($comments));       
                    foreach ($comments as $value) {
                        echo("<div class='top'><b>User ".$value['username']." </b> <a href='mailto:".$value['email']."'>".$value['email']."</a>  Added this: </div><div class='comment'>".strip_tags($value['message'])."</div>"."<p>At ".strip_tags($value['created_at'])."</p><hr>");
                    }
                else:
                    printf("<h2 style='color: #%x%x%x'>No Comments Yet...</h2>", 165, 27, 45);

                endif;
                ?>
                </div>
            </div>
        </div>
    </div>
</div>