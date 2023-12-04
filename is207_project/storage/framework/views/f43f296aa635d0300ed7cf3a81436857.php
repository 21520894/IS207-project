<?php
    $action = isset($_GET['action']) ? $_GET['action'] : '';
    $query = isset($_GET['query']) ? $_GET['query'] : '';
?>
<?php if($action == 'userManager' && $query == 'edit'): ?>
    <?php echo $__env->make('admin.user.edit', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>


















<?php /**PATH D:\subject_learning\is207\wamp64\www\IS207_project_git\is207_project\resources\views/admin/components/main.blade.php ENDPATH**/ ?>