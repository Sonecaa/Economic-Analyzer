<?php
	$this->assign('title','economic-analyzer | Home');
	$this->assign('nav','home');

	//$this->display('_Header.tpl.php');
?>

    <style>
        /*.Iframado{
            overflow:hidden; !important;
            height:100%;width:100%
*/
        }
    </style>
<?php include(__DIR__ .'/../system/dashboard.php'); ?>
<!-- <iframe width="100%" height="250%" CLASS="Iframado" frameborder="0" src="http://localhost/EconomiC-Analyzer/system/dashboard.php/"></iframe>
-->

<?php
	//$this->display('_Footer.tpl.php');
?>