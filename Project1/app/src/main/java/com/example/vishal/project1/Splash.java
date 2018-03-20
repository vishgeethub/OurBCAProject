package com.example.vishal.project1;

import android.content.Intent;
import android.content.SharedPreferences;
import android.os.StrictMode;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;

public class Splash extends AppCompatActivity {

    SharedPreferences sp;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_splash);

        sp=getSharedPreferences("mypref",0);

        StrictMode.ThreadPolicy ply = new StrictMode.ThreadPolicy.Builder().permitAll().build();
        StrictMode.setThreadPolicy(ply);

        new Thread(new Runnable() {
            @Override
            public void run() {
                try {
                    Thread.sleep(2000);
                     if(sp.getString("id","").equals(""))
                     {
                         Intent i = new Intent(Splash.this, MainActivity.class);
                         startActivity(i);

                     }
                    else {
                         Intent i = new Intent(Splash.this, Welcome.class);
                         startActivity(i);

                     }
                    finish();
                } catch (InterruptedException e) {
                    e.printStackTrace();
                }
            }
        }).start();
    }
}
