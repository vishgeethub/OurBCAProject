package com.example.vishal.project1;

import android.app.Activity;
import android.app.ProgressDialog;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.AsyncTask;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

import org.json.JSONException;
import org.json.JSONObject;

public class Login extends AppCompatActivity {


    ProgressDialog pd;
    EditText edt_l,edt_p;
    TextView sup;
    TextView for1;
    Button b1;
     SharedPreferences sp;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        setContentView(R.layout.activity_login);
        super.onCreate(savedInstanceState);
        edt_l=(EditText)findViewById(R.id.editText);
        edt_p=(EditText)findViewById(R.id.editText1);
        for1=(TextView)findViewById(R.id.textView2);
        sup=(TextView)findViewById(R.id.textView3);

       b1=(Button)findViewById(R.id.button);
        sp=getSharedPreferences("mypref",0);


        for1.setOnClickListener(new View.OnClickListener() {
           @Override
            public void onClick(View v) {
                Intent i=new Intent(Login.this,Forgot_Password.class);
                startActivity(i);
            }
        });
        sup.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent i=new Intent(Login.this,Registration.class);
                startActivity(i);
            }
        });
        b1.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                int flag=0;
                String msg="";
                if(edt_l.getText().toString().equals(""))
                {
                    flag=1;
                    //msg=msg+"Enter Loginid\n";
                    edt_l.setError("Enter LoginID");
                }

                if(edt_p.getText().toString().equals(""))
                {
                    flag=1;
                    //msg=msg+"Enter Password";
                    edt_p.setError("Enter Password");
                }


                if(flag==1)
                {
                    Toast.makeText(Login.this, msg, Toast.LENGTH_SHORT).show();
                }
                else
                {
                  new ValidateLogin().execute();
                }
            }
        });


    }

    class ValidateLogin extends AsyncTask<Void,Void,Void>
    {
        String result;
        String l,p;
        @Override
        protected void onPreExecute() {
            super.onPreExecute();
             l=edt_l.getText().toString();
            p=edt_p.getText().toString();

            pd=new ProgressDialog(Login.this);
            pd.setTitle("Loging in");
            pd.setMessage("Wait...");

            pd.show();
        }

        @Override
        protected Void doInBackground(Void... params) {

            UserFunctions obj=new UserFunctions();

            result=obj.checklogin(l,p);
            return null;
        }

        @Override
        protected void onPostExecute(Void aVoid) {
            super.onPostExecute(aVoid);
            String uid,name,profilepic;
            JSONObject jobj= null;
            pd.dismiss();

            try {
                jobj = new JSONObject(result);
                uid=jobj.optString("messages").toString();
                name=jobj.optString("name").toString();
                profilepic=jobj.optString("profilepic").toString();

                if(uid.equals("0")) {
                 Toast.makeText(Login.this,"Invalid Loginid & Password",Toast.LENGTH_LONG).show();
                }
                else
                {
                    SharedPreferences.Editor ed = sp.edit();
                    ed.putString("id", uid);
                    ed.putString("name", name);
                    ed.putString("profilepic", profilepic);
                    ed.putString("loginid", l);

                    ed.commit();
                    Intent i=new Intent(Login.this,Welcome.class);
                    startActivity(i);
                    finish();
                }
            } catch (JSONException e) {
                e.printStackTrace();
            }

        }
    }
}
