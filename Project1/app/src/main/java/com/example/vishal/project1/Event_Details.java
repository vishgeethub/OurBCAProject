package com.example.vishal.project1;

import android.app.ProgressDialog;
import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.os.AsyncTask;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.Button;
import android.widget.GridView;
import android.widget.ImageButton;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.InputStream;
import java.net.HttpURLConnection;
import java.net.URL;
import java.util.ArrayList;
import java.util.StringTokenizer;

import bean.Album;
import bean.Newsc;

public class Event_Details extends AppCompatActivity {
    String eid,uid,eventname,eventdate,eventtime,eventvenue,cityname,areaname,statename,eventphoto,description,contact,catname,ngoname,eventid;
    TextView ename,edesc,edate,evenue,econtact,engo,photos;
    ImageView iv;
    ImageButton btn;
    ProgressDialog pd;
    SharedPreferences sp;

    GridView gridview;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_event__details);

        photos=(TextView)findViewById(R.id.ngo_photo);
        ename=(TextView)findViewById(R.id.eventname);
        edesc=(TextView)findViewById(R.id.eventdesc);
        econtact=(TextView)findViewById(R.id.eventcontact);
        edate=(TextView)findViewById(R.id.eventdate);
        engo=(TextView)findViewById(R.id.eventngo);
        evenue=(TextView)findViewById(R.id.eventvenue);
        iv=(ImageView)findViewById(R.id.eventphoto);
        btn=(ImageButton)findViewById(R.id.button);

        gridview = (GridView)findViewById(R.id.gv);


        Intent i=getIntent();
        Bundle b=i.getExtras();

        eid=b.getString("eventid");
        eventname=b.getString("eventname");
        eventdate=b.getString("eventdate");
        eventtime=b.getString("eventtime");
        eventvenue=b.getString("eventvenue");
        cityname=b.getString("cityname");
        areaname=b.getString("areaname");
        statename=b.getString("statename");
        eventphoto=b.getString("eventphoto");
        description=b.getString("description");
        contact=b.getString("contact");
        catname=b.getString("catname");
        ngoname=b.getString("ngoname");

        ename.setText(eventname);
        StringTokenizer st=new StringTokenizer(eventdate,"-");
        String y=st.nextToken();
        String m=st.nextToken();
        String dt=st.nextToken();
        edate.setText(dt+"-"+m+"-"+y+", "+eventtime);
        edesc.setText(description);
        engo.setText(ngoname);
        evenue.setText(eventvenue+", "+areaname+", "+cityname+", "+statename);
        econtact.setText(contact);

        String path = GlobalVariables.SERVER_IP + GlobalVariables.API_FOLDER+eventphoto.trim();
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

        sp = getSharedPreferences("mypref", 0);
        uid = sp.getString("id","").toString();

        btn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                new LoadVolunteer().execute();
            }
        });


        photos.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent i=new Intent(Event_Details.this,Photos.class);
                i.putExtra("eid",eid);
                startActivity(i);
            }
        });

    }

    class LoadVolunteer extends AsyncTask<Void,Void,Void>
    {

            String result;
            @Override
            protected void onPreExecute() {
                super.onPreExecute();
                pd=new ProgressDialog(Event_Details.this);
                pd.setTitle("News");
                pd.setMessage("Wait...");
                pd.show();
            }

        @Override
        protected Void doInBackground(Void... params) {
            UserFunctions obj= new UserFunctions();
            result=obj.regvolunteer(eid,uid);
            return null;
        }

        @Override
        protected void onPostExecute(Void aVoid) {
            super.onPostExecute(aVoid);
            pd.dismiss();
            JSONObject jobj = null;
            try
            {
                jobj = new JSONObject(result);
                String msg=jobj.optString("messages").toString();
                if(msg.equals("Register Successfully")) {
                    Toast.makeText(Event_Details.this,"You have registered Successfully as a Volunteer",Toast.LENGTH_LONG).show();
                    btn.setImageResource(R.drawable.donereg);
                }else
                {
                    Toast.makeText(Event_Details.this, "Try again", Toast.LENGTH_SHORT).show();
                }



            }catch (Exception ex) {
                ex.printStackTrace();
            }



        }

    }


}
