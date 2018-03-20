package com.example.vishal.project1;

import android.app.ProgressDialog;
import android.content.Context;
import android.content.Intent;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.os.AsyncTask;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.AdapterView;
import android.widget.BaseAdapter;
import android.widget.Gallery;
import android.widget.ImageView;
import android.widget.TextView;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.InputStream;
import java.net.HttpURLConnection;
import java.net.URL;
import java.util.ArrayList;

import bean.Pics;

public class Show_Pic extends AppCompatActivity {
    ProgressDialog pd;
    String aid,gid,description,photo;
    ImageView iv;
    TextView tv;
    ArrayList<Pics> pic;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_show__pic);

        iv = (ImageView)findViewById(R.id.image);
        tv = (TextView)findViewById(R.id.title);

        Intent i=getIntent();
        Bundle b=i.getExtras();
        aid=b.getString("aid");
        gid=b.getString("gid");
        description=b.getString("description");
        photo=b.getString("photo");

        tv.setText(description);
        String path = GlobalVariables.SERVER_IP + GlobalVariables.API_FOLDER + photo.trim();
        path = path.replace('\\', '/');
        path = path.replace(" ", "%20");
        path = path.trim();
        URL url;
        Log.i("photo", path);
        try {
            url = new URL(path);
            HttpURLConnection connection = (HttpURLConnection) url.openConnection();
            connection.setDoInput(true);
            connection.connect();
            InputStream input = connection.getInputStream();
            Bitmap myBitmap = BitmapFactory.decodeStream(input);
                    /*myBitmap = Bitmap.createScaledBitmap(myBitmap,
                            100,100, true);
                 */
            iv.setImageBitmap(myBitmap);
        } catch (Exception e) {
            Log.i("Error", e.toString());

        }

    }
}
