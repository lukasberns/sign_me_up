<h2><?php echo __('Reset Your Password'); ?></h2>
<p><?php echo __('Please enter your email address below:'); ?></p>
<?php
echo $this->Form->create();
echo $this->Form->input('email');
echo $this->Form->end(__('Reset Password'));