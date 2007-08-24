create or replace procedure export_coupon(out flag int,in _id int)
begin 
	declare _filename  varchar(50);

	-- coupon list data
	select id,coupon_group,coupon_start,coupon_end
	  into @id,@coupon_group,@coupon_start,@coupon_end
	    from coupon_lists 
	      where id = _id;			 

	select concat(coupon_no,concat(',',coupon_pwd)) 
	   from coupons 
	     where list_id = _id
	       into outfile 'd:/pg_export_files/export.csv';


	-- ������ϣ�����list״̬
	update coupon_lists set status = 3 where id = @id;

       commit;
end