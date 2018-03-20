package com.example.vishal.project1;

import android.content.Intent;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.ImageView;
import android.widget.TextView;

import java.io.InputStream;
import java.net.HttpURLConnection;
import java.net.URL;

public class show_ngo extends AppCompatActivity {
    ImageView logo;
    String nid;
    TextView name,website,phone,desciption,email,address,charity,events;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_show_ngo);
        logo=(ImageView)findViewById(R.id.ngologo);
        name=(TextView)findViewById(R.id.ngoname);
        website=(TextView)findViewById(R.id.website);
        phone=(TextView)findViewById(R.id.contact);
        desciption=(TextView)findViewById(R.id.description);
        email=(TextView)findViewById(R.id.email);
        address=(TextView)findViewById(R.id.address);
        charity=(TextView)findViewById(R.id.charity);
        events=(TextView)findViewById(R.id.ngo_events);


        Intent i=getIntent();
        Bundle b=i.getExtras();

        name.setText(b.getString("name"));
        website.setText(b.getString("website"));
        phone.setText(b.getString("phone"));
        desciption.setText(b.getString("description"));
        email.setText(b.getString("email"));
        address.setText(b.getString("address")+", "+b.getString("areaname")+", "+b.getString("cityname")+", "+b.getString("statename"));
        nid=b.getString("nid");
        String path = GlobalVariables.SERVER_IP + GlobalVariables.API_FOLDER+b.getString("logo").trim();
        path=path.replace('\\', '/');
        path=path.replace(" ", "%20");
        path=path.trim();
        URL url;
        Log.i("photo",path);
        try
        {
            url = new URL(path);
            HttpURLConnection connection = (HttpURLConnection) url.openConnection();
            connection.setDoInput(true);
            connection.connect();
            InputStream input = connection.getInputStream();
            Bitmap myBitmap = BitmapFactory.decodeStream(input);
                    /*myBitmap = Bitmap.createScaledBitmap(myBitmap,
                            100,100, true);
                 */  logo.setImageBitmap(myBitmap);
        }
        catch(Exception e)
        {
            Log.i("Error",e.toString());

        }

        charity.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent i=new Intent(show_ngo.this,Charity.class);
                i.putExtra("nid",nid);
                startActivity(i);
            }
        });

        events.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent i=new Intent(show_ngo.this,NGO_Activity.class);
                i.putExtra("nid",nid);
                startActivity(i);
            }
        });
    }
}
