<h2><?php echo __('Activate Your Account'); ?></h2>
<p><?php echo __('Please paste your activation code below:'); ?></p>
<?php
echo $this->Form->create();
echo $this->Form->input('activation_code');
echo $this->Form->end(__('Activate Account'));