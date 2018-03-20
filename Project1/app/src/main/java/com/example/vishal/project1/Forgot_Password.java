package com.example.vishal.project1;

import android.Manifest;
import android.app.ProgressDialog;
import android.content.pm.PackageManager;
import android.os.AsyncTask;
import android.os.Build;
import android.support.v4.app.ActivityCompat;
import android.support.v4.content.ContextCompat;
import android.support.v7.app.AlertDialog;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.telephony.SmsManager;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import org.json.JSONException;
import org.json.JSONObject;

public class Forgot_Password extends AppCompatActivity {

    Button b1;
    EditText t1;
    String l;
    ProgressDialog pd;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_forgot__password);

        b1=(Button)findViewById(R.id.button);
        t1=(EditText)findViewById(R.id.editText);



        b1.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                new Forgotpassword().execute();

                        }
        });


    }
    class Forgotpassword extends AsyncTask<Void,Void,Void>
    {
        final public static int SEND_SMS = 101;

        String result;
        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            l=t1.getText().toString();
            pd=new ProgressDialog(Forgot_Password.this);
            pd.setTitle("Loading");
            pd.setMessage("Wait...");
            pd.show();
        }

        @Override
        protected Void doInBackground(Void... params) {
            UserFunctions obj=new UserFunctions();
            result = obj.forgotpassword(l);
            return null;
        }

        @Override
        protected void onPostExecute(Void aVoid) {
            super.onPostExecute(aVoid);
            String uid,name,ph,password,loginid;
            JSONObject jobj= null;
            pd.dismiss();
            try{
                jobj = new JSONObject(result);

                uid=jobj.optString("messages").toString();
                name=jobj.optString("name").toString();
                ph=jobj.optString("phone").toString();
                password=jobj.optString("password").toString();
                loginid=jobj.optString("loginid").toString();

                if(uid.equals("Invalid LoginID")) {
                    Toast.makeText(Forgot_Password.this, "Invalid Loginid", Toast.LENGTH_LONG).show();
                }
                else
                {
                    if (Build.VERSION.SDK_INT >= 23) {
                        int checkCallPhonePermission = ContextCompat.checkSelfPermission(Forgot_Password.this, Manifest.permission.SEND_SMS);
                        if(checkCallPhonePermission != PackageManager.PERMISSION_GRANTED){
                            ActivityCompat.requestPermissions(Forgot_Password.this,new String[]{Manifest.permission.SEND_SMS},SEND_SMS);
                            return;
                        }else{
                            SmsManager smsManager = SmsManager.getDefault();
                            smsManager.sendTextMessage(ph, null, "Dear "+name+"\nYour Login ID: "+loginid+" and password is "+password, null, null);
                            Toast.makeText(Forgot_Password.this, "Your Password Send to Your register Number.", Toast.LENGTH_SHORT).show();
                            finish();
                        }
                    } else {
                        SmsManager smsManager = SmsManager.getDefault();
                        smsManager.sendTextMessage(ph, null, "Dear "+name+"\nYour Login ID: "+loginid+" and password is "+password, null, null);
                        Toast.makeText(Forgot_Password.this, "Your Password Send to Your register Number.", Toast.LENGTH_SHORT).show();
                        finish();
                    }

                }


            }catch (JSONException e) {
                e.printStackTrace();
            }

        }
    }
}
