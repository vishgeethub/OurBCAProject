package com.example.vishal.project1;

import android.app.ProgressDialog;
import android.content.Intent;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.os.AsyncTask;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.InputStream;
import java.net.HttpURLConnection;
import java.net.URL;
import java.util.StringTokenizer;

public class Show_News extends AppCompatActivity {
    String newsid,photo,description;
    TextView title,date,ngoname,desc,back;
    ProgressDialog pd;
    ImageView iv;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_show__news);

        title=(TextView)findViewById(R.id.title);
        date=(TextView)findViewById(R.id.date);
        ngoname=(TextView)findViewById(R.id.ngoname);
        desc=(TextView)findViewById(R.id.desc);
        iv=(ImageView)findViewById(R.id.photo);
        back=(TextView)findViewById(R.id.back);

        back.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent i=new Intent(Show_News.this,News.class);
                finish();
                startActivity(i);
            }
        });

        Intent i=getIntent();
        Bundle b=i.getExtras();

        newsid=b.getString("newsid");
        description=b.getString("d_description");


        new LoadNews().execute();
        //Toast.makeText(Show_News.this,photo,Toast.LENGTH_LONG).show();
    }

    class LoadNews extends AsyncTask<Void,Void,Void>
    {
        String result;
        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            pd=new ProgressDialog(Show_News.this);
            pd.setTitle("News Details");
            pd.setMessage("Fetching Data...");
            pd.show();
        }

        @Override
        protected Void doInBackground(Void... params) {
            UserFunctions obj=new UserFunctions();
            result=obj.getnewsdetails(newsid);
            return null;
        }

        @Override
        protected void onPostExecute(Void aVoid) {
            super.onPostExecute(aVoid);
            JSONObject jobj= null;
            pd.dismiss();

            try {
                jobj = new JSONObject(result);
                JSONArray jar=jobj.getJSONArray("messages");
                JSONObject data=jar.getJSONObject(0);


                title.setText(data.optString("short_desc").toString());
                StringTokenizer st=new StringTokenizer(data.optString("newsdate").toString(),"-");
                String y=st.nextToken();
                String m=st.nextToken();
                String dt=st.nextToken();
                date.setText(dt+"-"+m+"-"+y);
                desc.setText(description);
                ngoname.setText(data.optString("ngoname").toString());

                photo=data.optString("photo").toString();
                String path = GlobalVariables.SERVER_IP + GlobalVariables.API_FOLDER+data.optString("photo").toString().trim();
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
                 */  iv.setImageBitmap(myBitmap);
                }
                catch(Exception e)
                {
                    Log.i("Error",e.toString());

                }
            }
            catch (JSONException e) {
                e.printStackTrace();
            }
        }
    }
}
