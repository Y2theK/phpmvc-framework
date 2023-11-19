<?php
/**@var $this \Y2thek\PhpMvcframeworkCore\View */

$this->title = 'Profile' 

?>
<div>
<h1 class="text-3xl font-bold text-center mt-10 ">
    Profile
</h1>
<h5 class="font-bold text-center mt-8">
    Name - <?= $user->name ?>
</h5>
<h5 class="font-bold text-center mt-2">
Email - <?= $user->email ?>
</h5>
<h5 class="font-bold text-center mt-2">
    status - <?= $user->getDisplayStatus() ?>
</h5>

</div>