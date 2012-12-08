<?php /* Smarty version 2.6.26, created on 2010-04-07 18:41:35
         compiled from status_messages.tpl */ ?>
<?php $_from = $this->_tpl_vars['Status']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['Type'] => $this->_tpl_vars['Messages']):
?>
<div class="messages_<?php echo $this->_tpl_vars['type']; ?>
"><?php echo $this->_tpl_vars['Type']; ?>
:<br />
  <hr />
  <ul>
    <?php $_from = $this->_tpl_vars['Messages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['Message']):
?>
    <li><?php echo $this->_tpl_vars['Message']; ?>
</li>
    <?php endforeach; endif; unset($_from); ?>
  </ul>
</div>
<?php endforeach; endif; unset($_from); ?>