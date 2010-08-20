package com.bitbee.android.missedcall2sms;

import android.app.Service;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.os.Handler;
import android.os.IBinder;
import android.provider.CallLog;
import android.widget.Toast;

public class MissedCall2SmsService extends Service {
	
	//private int MISSEDCALL2SMS_NOTFICATION_ID;
	
	private static MissedCallContentObserver mcco;
	
	public static final String PREF = "MC2S_PREF";
	public static final String PREF_SERVICE_STATUS = "MC2S_SERVICE_STATUS";

	
	@Override
	public void onCreate() {
		// TODO Auto-generated method stub
		super.onCreate();
		//Toast.makeText(this, "Service Created!", Toast.LENGTH_SHORT).show();
	}

	@Override
	public void onDestroy() {
		// TODO Auto-generated method stub
		getContentResolver().unregisterContentObserver(mcco);
		mcco = null;
		super.onDestroy();
		SharedPreferences settings = getSharedPreferences(PREF, 0);
		settings.edit().putString(PREF_SERVICE_STATUS, getText(R.string.button_start).toString()).commit();
	}

	@Override
	public void onStart(Intent intent, int startId) {
		// TODO Auto-generated method stub
		super.onStart(intent, startId);
		
		Bundle b = intent.getExtras();
		
		SharedPreferences settings = getSharedPreferences(PREF, 0);
		settings.edit().putString(PREF_SERVICE_STATUS, getText(R.string.button_stop).toString()).commit();
		
		//Toast.makeText(this, "Service Started...", Toast.LENGTH_LONG).show();
		//getContentResolver().registerContentObserver(CallLog.Calls.CONTENT_URI, false, mcco);
		
		if(mcco == null){
			mcco = new MissedCallContentObserver(this,new Handler(),b.getString("PHONE_NUMBER"));
			getContentResolver().registerContentObserver(CallLog.Calls.CONTENT_URI, false, mcco);
			Toast.makeText(this, getText(R.string.info_running), Toast.LENGTH_LONG).show();
		}else{
			Toast.makeText(this, getText(R.string.info_already_run), Toast.LENGTH_LONG).show();
		}		
	}

	@Override
	public boolean onUnbind(Intent intent) {
		// TODO Auto-generated method stub
		Toast.makeText(this, "Service unBind!", Toast.LENGTH_LONG).show();
		return super.onUnbind(intent);
	}

	@Override
	public IBinder onBind(Intent arg0) {
		// TODO Auto-generated method stub
		Toast.makeText(this, "Service Bound!", Toast.LENGTH_LONG).show();
		return null;
	}
	
	

}
