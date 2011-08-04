package com.bitbee.android.missedcall2sms;

import java.text.SimpleDateFormat;

import android.content.Context;
import android.database.ContentObserver;
import android.database.Cursor;
import android.os.Handler;
import android.provider.CallLog.Calls;
import android.telephony.SmsManager;
import android.util.Log;

public class MissedCallContentObserver extends ContentObserver {
	
	private Context ctx;
	
	private String _phoneNumber;
	
	private static Long lastTime = new Long(System.currentTimeMillis());

	private static final String TAG = "MissedCallContentObserver";

	public MissedCallContentObserver(Context context, Handler handler , String phone_number) {
		super(handler);
		ctx = context;
		_phoneNumber = phone_number;
	}

	@Override
	public void onChange(boolean selfChange) {

		Cursor csr = ctx.getContentResolver().query(Calls.CONTENT_URI,
				new String[] { Calls.NUMBER, Calls.TYPE, Calls.NEW, Calls.DATE, Calls.CACHED_NAME }, null,
				null, Calls.DEFAULT_SORT_ORDER);

		if (csr != null) {
			if (csr.moveToFirst()) {
				int type = csr.getInt(csr.getColumnIndex(Calls.TYPE));
				switch (type) {
				case Calls.MISSED_TYPE:
					if(lastTime < csr.getLong(csr.getColumnIndex(Calls.DATE))){
						Log.v(TAG, "missed type");
						SimpleDateFormat df = new SimpleDateFormat("yyyy.MM.dd HH:mm:ss");
						String strMsg = "";
						String _number = csr.getString(csr.getColumnIndex(Calls.NUMBER));
						String _name = csr.getString(csr.getColumnIndex(Calls.CACHED_NAME));
						
						if(_name == null){
							strMsg = _number + "于" + df.format(csr.getLong(csr.getColumnIndex(Calls.DATE))) + "给你打过电话。";
						}else{
							strMsg = _number + "(" + _name  + ")于" +  df.format(csr.getLong(csr.getColumnIndex(Calls.DATE))) + "给你打过电话。";
						}
						SmsManager smsMgr = SmsManager.getDefault();
						
						smsMgr.sendTextMessage(_phoneNumber, null,strMsg, null, null);
						lastTime = csr.getLong(csr.getColumnIndex(Calls.DATE));						
					}
					break;
				case Calls.INCOMING_TYPE:
					Log.v(TAG, "incoming type");
					break;
				case Calls.OUTGOING_TYPE:
					Log.v(TAG, "outgoing type");
					break;
				}
			}
			csr.close();
		}
	}

	@Override
	public boolean deliverSelfNotifications() {
		return super.deliverSelfNotifications();
	}
}
