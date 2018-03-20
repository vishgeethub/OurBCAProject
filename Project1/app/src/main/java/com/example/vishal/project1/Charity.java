package com.example.vishal.project1;

import android.Manifest;
import android.app.ProgressDialog;
import android.content.Intent;
import android.content.SharedPreferences;
import android.content.pm.PackageManager;
import android.graphics.pdf.PdfDocument;
import android.os.AsyncTask;
import android.os.Bundle;
import android.os.Environment;
import android.support.v4.app.ActivityCompat;
import android.support.v4.content.ContextCompat;
import android.support.v7.app.AppCompatActivity;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.LinearLayout;
import android.widget.ListView;
import android.widget.Toast;

import org.json.JSONException;
import org.json.JSONObject;

import java.io.File;
import java.io.FileOutputStream;
import java.io.OutputStream;
import java.util.ArrayList;


public class Charity extends AppCompatActivity {
    ListView lv;
    SharedPreferences sp;
    String uid, nid,purpos,amnt,adh,ot;
    Button otpp, submit;
    LinearLayout ll;
    EditText purpose,amount,adhar,otp;
    ProgressDialog pd;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_charity);
        Intent i = getIntent();
        Bundle b = i.getExtras();
        nid = b.getString("nid");
        sp = getSharedPreferences("mypref", 0);
        uid = sp.getString("id", "").toString();

        purpose=(EditText)findViewById(R.id.purpose);
        adhar=(EditText)findViewById(R.id.adhar);
        otp=(EditText)findViewById(R.id.otp);
        amount=(EditText)findViewById(R.id.amount);
        ll = (LinearLayout) findViewById(R.id.ll);
        submit = (Button) findViewById(R.id.submit);
        otpp = (Button) findViewById(R.id.otpp);
        otpp.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                new LoadCharity().execute();
            }
        });

        submit.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent i=new Intent(Charity.this,PayUMoneyActivity.class);
                startActivity(i);

            }
        });
    }
    class LoadCharity extends AsyncTask<Void,Void,Void>
    {
        String result;
        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            pd=new ProgressDialog(Charity.this);
            pd.setTitle("Charity");
            pd.setMessage("Wait...");
            pd.show();
            purpos=purpose.getText().toString();
            amnt=amount.getText().toString();
            adh=adhar.getText().toString();
            ot=otp.getText().toString();
        }

        @Override
        protected Void doInBackground(Void... params) {
            UserFunctions obj=new UserFunctions();
            result=obj.charity(nid,uid,amnt,adh,purpos);
            return null;
        }

        @Override
        protected void onPostExecute(Void aVoid) {
            super.onPostExecute(aVoid);
            String msg;
            JSONObject jobj= null;
            pd.dismiss();
            try {
                jobj = new JSONObject(result);
                msg = jobj.optString("messages").toString();
                if(msg.equals("Charity Successfull"))
                {
                    Toast.makeText(Charity.this,"Data Saved", Toast.LENGTH_SHORT).show();
                }
                else
                {
                    Toast.makeText(Charity.this, "Something Missing!!", Toast.LENGTH_LONG).show();
                }

            }catch (JSONException e) {
                e.printStackTrace();
            }
        }
    }
    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        getMenuInflater().inflate(R.menu.menu_home,menu);

        return super.onCreateOptionsMenu(menu);

    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        if(R.id.home==item.getItemId())
        {
            Intent i=new Intent(Charity.this,Welcome.class);
            startActivity(i);
            finish();
        }
        return super.onOptionsItemSelected(item);
    }
}