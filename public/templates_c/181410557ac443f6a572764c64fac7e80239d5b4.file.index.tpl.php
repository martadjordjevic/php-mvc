<?php /* Smarty version Smarty-3.1-DEV, created on 2014-02-10 22:50:54
         compiled from "C:\xampp\htdocs\projects\php-mvc\app\modules\App\view\index\index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:865552f91fc8e0e019-60687202%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '181410557ac443f6a572764c64fac7e80239d5b4' => 
    array (
      0 => 'C:\\xampp\\htdocs\\projects\\php-mvc\\app\\modules\\App\\view\\index\\index.tpl',
      1 => 1392069052,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '865552f91fc8e0e019-60687202',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1-DEV',
  'unifunc' => 'content_52f91fc8e768b5_14168197',
  'variables' => 
  array (
    'arr' => 0,
    'test' => 0,
    'param' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52f91fc8e768b5_14168197')) {function content_52f91fc8e768b5_14168197($_smarty_tpl) {?><h2>Hello from smarty template engine</h2>
<pre><b>Dump $arr:</b><br /><?php echo var_dump($_smarty_tpl->tpl_vars['arr']->value);?>
</pre>

<b>
    <pre> <?php echo $_smarty_tpl->tpl_vars['test']->value;?>
 <br /> <?php echo $_smarty_tpl->tpl_vars['param']->value;?>
</pre>
</b><?php }} ?>
