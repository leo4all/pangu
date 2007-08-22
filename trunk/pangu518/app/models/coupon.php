<?php
class Coupon extends AppModel {

	var $name = 'Coupon';

	var $hasMany = array(
			'MemberCoupon' =>
				array('className' => 'MemberCoupon',
						'foreignKey' => 'coupon_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'dependent' => '',
						'exclusive' => '',
						'finderQuery' => '',
						'counterQuery' => ''
				),

			'MerchantCoupon' =>
				array('className' => 'MerchantCoupon',
						'foreignKey' => 'coupon_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'dependent' => '',
						'exclusive' => '',
						'finderQuery' => '',
						'counterQuery' => ''
				),

			'WorkstationCoupon' =>
				array('className' => 'WorkstationCoupon',
						'foreignKey' => 'coupon_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'dependent' => '',
						'exclusive' => '',
						'finderQuery' => '',
						'counterQuery' => ''
				),

	);

	function getGroupByStatus(){
		$sql = "select distinct Coupon.coupon_group,Coupon.custom_num,Coupon.status
		  from coupons as Coupon 
		    where Coupon.status = 0 order by Coupon.coupon_group,Coupon.created";
		return $this->query($sql);
	}
	
	/**
	 * 更新代金券状态
	 *
	 * @param unknown_type $coupon_group
	 * @return unknown
	 */
	function updateStatusByGroup($coupon_group=null,$custom_num=null){
		if($coupon_group!=null && $custom_num != null){
			$sql = "update coupons as Coupon set Coupon.status = 113
			  where Coupon.coupon_group = '$coupon_group'
			    and Coupon.custom_num = $custom_num
			     and Coupon.status = 0";
			return $this->query($sql);
		}
	}
	
	/**
	 * 密码生成算法
	 *
	 * @param int $custom_num
	 * @param int $random_num
	 * @return int
	 */
	function getPassword($custom_num = 0,$random_num = 0){
		$pwd = (int)$custom_num ^ (int)$random_num; //用户输入6位数字和6位随机数异或产生密码
		$pwd = substr($pwd, 0, 6); //只保留6位数
		$pwd = sprintf('%06s', $pwd);
		return $pwd;
	}
	
	/**
	 * 检查代金券有效性
	 *
	 * @param int $coupon_no
	 * @param int $coupon_pwd
	 * @return unknown
	 */
	function verify($coupon_no = null,$coupon_pwd = null){
		if($Coupon = $this->findByCouponNoAndCouponPwd($coupon_no,$coupon_pwd)){
			$pwd = $this->getPassword($Coupon['Coupon']['custom_num'],$Coupon['Coupon']['random_num']);
			//密码和代金券状态都正确才能录入
			if($coupon_pwd==$pwd && $Coupon['Coupon']['status'] == 341){
				return $Coupon['Coupon']['id'];
			}else{
				return 0;
			}
		}else{
			return 0;
		}
	}	

}
?>