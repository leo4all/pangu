package com.bitbee.android.missedcall2sms;

import java.util.regex.Matcher;
import java.util.regex.Pattern;

import android.app.Activity;
import android.app.AlertDialog;
import android.app.Dialog;
import android.app.Notification;
import android.app.NotificationManager;
import android.app.PendingIntent;
import android.content.Intent;
import android.content.SharedPreferences;
import android.graphics.Color;
import android.os.Bundle;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

public class Main extends Activity {
	

	protected final int DIALOG_ABOUT = 0;
	
	private static int MISSEDCALL2SMS_NOTFICATION_ID;
	
	private static NotificationManager mNotificationManager;
	
	public static final String PREF = "MC2S_PREF";
	public static final String PREF_PHONE_NUMBER = "MC2S_PHONE_NUMBER";
	public static final String PREF_SERVICE_STATUS = "MC2S_SERVICE_STATUS";
	
	/** Called when the activity is first created. */
	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.main);
		findViews();
		restorePrefs();
		setListeners();
	}
	
		
	@Override
	protected void onPause() {
		super.onPause();
		SharedPreferences settings = getSharedPreferences(PREF, 0);
		settings.edit().putString(PREF_PHONE_NUMBER, field_phone_number.getText().toString()).commit();
		settings.edit().putString(PREF_SERVICE_STATUS, button_main.getText().toString()).commit();
	}
	
	
	@Override
	protected void onDestroy() {
		super.onDestroy();
	}

	private Button button_main;
	private EditText field_phone_number;

	//界面视图载入
	private void findViews(){
		button_main = (Button)findViewById(R.id.button_main);
		field_phone_number = (EditText)findViewById(R.id.phone_number);
	}
	
	//事件监听
	private void setListeners(){
		button_main.setOnClickListener(mainListener);
	}
	
	//Restore Preferences
	private void restorePrefs(){
		SharedPreferences settings = getSharedPreferences(PREF, 0);
		String pref_phone_number = settings.getString(PREF_PHONE_NUMBER, "");
		if(!"".equals(pref_phone_number)){
			field_phone_number.setText(pref_phone_number);
		}
		
		button_main.setText(settings.getString(PREF_SERVICE_STATUS, getText(R.string.button_start).toString()));
		if(button_main.getText().toString().equals(getText(R.string.button_stop))){
			button_main.setTextColor(Color.RED);
		}else{
			button_main.setTextColor(Color.BLACK);
		}
	}
	
	//开始监听按钮事件
	private Button.OnClickListener mainListener = new Button.OnClickListener(){
		public void onClick(View v) {
			doMissedCall2Sms();
		}
	};
	
	//开始漏电监听
	private void doMissedCall2Sms(){
		if("".equals(field_phone_number.getText().toString()) || !checkMobile(field_phone_number.getText().toString())){
			Toast.makeText(this, "接收短信号码不能为空，或者号码不正确", Toast.LENGTH_LONG).show();
		}else if(button_main.getText().toString().equals(getText(R.string.button_start))){
			_startService();
			button_main.setText(getText(R.string.button_stop));
			button_main.setTextColor(Color.RED);
		}else{
			_stopService();
			button_main.setText(getText(R.string.button_start));
			button_main.setTextColor(Color.BLACK);
		}
	}	
	
	
	//开始漏电监听
	private void _startService() {
		Intent intent = new Intent(this, MissedCall2SmsService.class);
		Bundle bundle = new Bundle();
		bundle.putString("PHONE_NUMBER", field_phone_number.getText().toString());
		intent.putExtras(bundle);
		this.startService(intent);

		startNotification();
		
	}
	
	//结束漏电监听
	private void _stopService(){
		Intent intent = new Intent(this, MissedCall2SmsService.class);
		if(this.stopService(intent)){
			mNotificationManager.cancel(MISSEDCALL2SMS_NOTFICATION_ID);
			Toast.makeText(this, getText(R.string.info_end), Toast.LENGTH_LONG).show();
		}else{
			Toast.makeText(this, getText(R.string.info_not_run), Toast.LENGTH_LONG).show();
		}
	}
	
    protected Dialog onCreateDialog( int id ){
    	switch(id){
    		case DIALOG_ABOUT:
    			return new AlertDialog.Builder(this)
    					.setIcon(android.R.drawable.ic_dialog_info)
    					.setTitle(getText(R.string.describe))
    					.setMessage(getText(R.string.copyright))
    					.setPositiveButton(getText(R.string.ok), null)
    					.create();
    		default:
    			return null;
    	}
    }
    
	//设置状态栏信息提示
	private void startNotification(){
        mNotificationManager = (NotificationManager)getSystemService(NOTIFICATION_SERVICE);
		final Notification notifyDetails = new Notification(R.drawable.dog,getText(R.string.info_running),System.currentTimeMillis());
		
	
		CharSequence contentTitle = getText(R.string.app_name);
		CharSequence contentText = getText(R.string.info_running);
		
		
		PendingIntent contextIntent = 
			PendingIntent.getActivity(this, 0, 
					new Intent(this, Main.class), PendingIntent.FLAG_CANCEL_CURRENT);
		
		notifyDetails.setLatestEventInfo(Main.this, contentTitle, contentText, contextIntent);
		
		mNotificationManager.notify(MISSEDCALL2SMS_NOTFICATION_ID, notifyDetails);
	}    

	@Override
	public boolean onCreateOptionsMenu(Menu menu) {
		super.onCreateOptionsMenu(menu);
		menu.add(0, Menu.FIRST + 3, 3, R.string.about).setIcon(android.R.drawable.ic_menu_help);
		menu.add(0, Menu.FIRST + 4, 4, R.string.exit).setIcon(android.R.drawable.ic_menu_close_clear_cancel);
		return true;
	}

	@Override
	public boolean onOptionsItemSelected(MenuItem item) {
		super.onOptionsItemSelected(item);
		switch (item.getItemId()) {
		case Menu.FIRST + 3:
			showDialog(DIALOG_ABOUT);
			break;
		case Menu.FIRST +4:
			this.finish();
			break;
		}
		return true;
	}
	
	 public boolean checkMobile(String mobile){ 
		 String regex  =  "^1(3[0-9]|5[012356789]|8[0789])\\d{8}$";
		 Pattern   p   =  Pattern.compile(regex);   
		 Matcher   m   =  p.matcher(mobile);   
		 return m.find(); 
	 }   
}