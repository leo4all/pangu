<?php
echo $html->dateTimeOptionTag('Member/bday', 'YMD' ,'NONE', mktime(date("G")+1, 0, 0, date("m"), date("d")+1, date("Y")), array());
?>

创建ACL表
php acl.php initdb

定义组
php acl.php create aro 0 0 Members //定义Members组

php acl.php create aro 0 null Admins
php acl.php create aro 0 null Members
php acl.php create aro 0 null Merchants
php acl.php create aro 0 null Workstations

php acl.php create aro 1 0 admin
php acl.php setParent aro admin Members

$this->Workstation->getLastInsertID(); //得到刚才保存到数据库的主键值


/coupons/audit/1/ABC audit后面跟两个参数

取值方式:
> function audit($p1 = null,$p2 = null){
> > echo $p1; //打印值 1
> > > echo $p2; //打印值 ABC

> > }



> function getGroupByStatus(){
> > $sql = "select distinct Coupon.coupon\_group,Coupon.custom\_num,Coupon.status
> > > from coupons as Coupon
> > > > where Coupon.status = 0 order by Coupon.coupon\_group,Coupon.created";

> > return $this->query($sql);

> }