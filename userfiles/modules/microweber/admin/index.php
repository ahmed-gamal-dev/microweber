<?php if(has_access() == false): ?>
<?php error(_e("You don't have admin rights.", true)); ?>
<?php endif; ?>
<?php include('dashboard.php'); ?>
