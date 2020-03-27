<div class="col">
            
    <div class="card">
        <div class="card-header bg-primary text-white">
            <i class="fa fa-table"></i> <?php echo $title;?> <a href="/admin/products" class="float-right"><button class="btn btn-primary text-right"><span data-feather="arrow-left-circle"></span> Go Back</button></a>
        </div>
        <div class="card-body">
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name" class="control-label">Product Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Product Name" required>
                </div>
                <div class="form-group">
                    <label for="price" class="control-label">Product Price</label>
                    <input type="text" class="form-control" id="price" name="price" placeholder="Product Price">
                </div>
                <div class="form-group">
                    <label for="category" class="control-label">Product Category</label>
                    <select class="form-control" id="category" name="category_id">
                            <?php if (is_array($categories)) : ?>
                            <?php foreach ($categories as $category): ?>
                            <option value="<?php echo $category->id; ?>">
                                <?php echo $category->name; ?>
                            </option>
                            <?php endforeach; ?>
                            <?php endif; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="brand" class="control-label">Product Brand</label>
                    <select class="form-control" id="brand" name="brand_id">
                            <?php if (is_array($brands)) : ?>
                            <?php foreach ($brands as $brand): ?>
                            <option value="<?php echo $brand->id; ?>">
                                <?php echo $brand->name; ?>
                            </option>
                            <?php endforeach; ?>
                            <?php endif; ?>
                    </select>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="is_new" name="is_new" checked>
                    <label for="is_new" class="form-check-label">Is New</label>
                    
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="status" name="status" checked>
                    <label for="status" class="form-check-label">Active</label>
                    
                </div>

                <div class="form-group row" id="drop-area">
                    <div class="container-fluid">
                        <div class="card border-success text-center mb-3">
                            <div class="card-header bg-transparent border-success">
                                <label for="title">Add Image To Post:</label>
                            </div>
                            <div class="card-body text-success">
                                <div class="row">
                                    <div class="col-md-8">
                                        <input type="file" id="fileElem" multiple accept="image/*"
                                            name="images[]">
                                    </div>
                                    <div class="col-md-4">
                                        <p>Drop Picture Here</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer bg-transparent border-success">Footer</div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label" for="description">Product Description</label>
                    <input type="text" class="form-control" id="description" name="description" placeholder="Product Description">
                </div>
 
                <div class="mx-auto">
                    <button type="submit" class="btn btn-primary text-right">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
