
<?php $status_arr = array('', 'Disconnect', 'Active', 'Inactive', 'Hold', 'Free'); ?>
<?php $ptype_arr = array('', 'Free', 'Prepaid', 'Postpaid'); ?>
<?php $ctype_arr = array('', 'Analog', 'Digital', 'D.T.S', 'Internet'); ?>
<?php $packages = $this->master->get_all('tbl_packages');
$package_arr = array();
foreach($packages as $k=>$v)
    $package_arr[$v->id] = $v->title;
?>