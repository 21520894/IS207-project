<?php $__env->startSection('content'); ?>

    <div class="row">
        <div class="col-lg-12">
            <div class="pull-left">
                <h2>Laravel 8 CRUD Example</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="<?php echo e(route('products.create')); ?>"> Create New Product</a>
            </div>
        </div>
    </div>

    <?php if($message = Session::get('success')): ?>
        <div class="alert alert-success">
            <p><?php echo e($message); ?></p>
        </div>
    <?php endif; ?>

    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Group</th>
            <th>Price</th>
            <th>Status</th>
            <th>Describe</th>
            <th width="280px">Action</th>
        </tr>
        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($product->ProductID); ?></td>
            <td><?php echo e($product->Name); ?></td>
            <td><?php echo e($product->category->Title); ?></td>
            <td><?php echo e($product->Price); ?></td>
            <td><?php echo e($product->ProductStatus); ?></td>
            <td><?php echo e($product->Description); ?></td>
            <td>
                <form action="<?php echo e(route('products.destroy',$product->ProductID)); ?>" method="POST">
                    <a class="btn btn-info" href="<?php echo e(route('products.show',$product->ProductID)); ?>">Show</a>
                    <a class="btn btn-primary" href="<?php echo e(route('products.edit',$product->ProductID)); ?>">Edit</a>
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </table>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('clients.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\subject_learning\is207\wamp64\www\IS207_project_git\is207_project\resources\views//clients/products/index.blade.php ENDPATH**/ ?>