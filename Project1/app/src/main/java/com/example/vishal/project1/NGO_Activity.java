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
import android.widget.BaseAdapter;
import android.widget.ImageView;
import android.widget.ListView;
import android.widget.TextView;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.InputStream;
import java.net.HttpURLConnection;
import java.net.URL;
import java.util.ArrayList;
import java.util.StringTokenizer;

import bean.Allevent;
import bean.Newsc;

public class NGO_Activity extends AppCompatActivity {
    ListView lv;
    String nid;
    ArrayList<Allevent> nevent;
    ProgressDialog pd;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_ngo_);

        lv=(ListView)findViewById(R.id.ngo_activity);

        Intent i=getIntent();
        Bundle b=i.getExtras();
        nid=b.getString("nid");

        new LoadEvents().execute();

    }

    class LoadEvents extends AsyncTask<Void,Void,Void>
    {
        String result;
        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            pd=new ProgressDialog(NGO_Activity.this);
            pd.setTitle("News");
            pd.setMessage("Wait...");
            pd.show();
            nevent=new ArrayList<Allevent>();
        }

        @Override
        protected Void doInBackground(Void... params) {
            UserFunctions obj=new UserFunctions();
            result=obj.getngoevent(nid);
            return null;
        }

        @Override
        protected void onPostExecute(Void aVoid) {
            super.onPostExecute(aVoid);
            pd.dismiss();
            JSONObject jobj = null;
            try {
                jobj = new JSONObject(result);
                JSONArray jarr = jobj.getJSONArray("messages");
                for (int i = 0; i < jarr.length(); i++) {
                    JSONObject json = (JSONObject) jarr.get(i);
                    bean.Allevent event = new bean.Allevent();
                    event.setEventname(json.optString("eventname"));
                    event.setEventphoto(json.optString("eventphoto"));
                    event.setEventid(json.optString("eventid"));
                    nevent.add(event);
                }
                lv.setAdapter(new mybase());
            } catch (JSONException e) {
                e.printStackTrace();
            }

        }
        class mybase extends BaseAdapter
        {
            LayoutInflater inflater;
            mybase()
            {
                inflater = (LayoutInflater)getSystemService(Context.LAYOUT_INFLATER_SERVICE);
            }

            @Override
            public int getCount() {
                return nevent.size();
            }

            class ViewHolder
            {
                ImageView iv;
                TextView t1,t2;
            }

            @Override
            public View getView(int position, View convertView, ViewGroup parent) {
                ViewHolder h=null;
                if(convertView==null)
                {
                    convertView = (View) inflater.inflate(R.layout.ngo_row, null);
                    h=new ViewHolder();
                    h.iv=(ImageView)convertView.findViewById(R.id.ngologo);
                    h.t1=(TextView)convertView.findViewById(R.id.ngoname);
                    //h.t2=(TextView)convertView.findViewById(R.id.txtdate_news);
                    convertView.setTag(h);
                }
                else {
                    h=(ViewHolder)convertView.getTag();
                }

                bean.Allevent cat=nevent.get(position);
                h.t1.setText(cat.getEventname());



                String path = GlobalVariables.SERVER_IP + GlobalVariables.API_FOLDER+cat.getEventphoto().trim();
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
                 */   h.iv.setImageBitmap(myBitmap);
                }
                catch(Exception e)
                {
                    Log.i("Error",e.toString());

                }
                return convertView;
            }

            @Override
            public long getItemId(int position) {
                return 0;
            }

            @Override
            public Object getItem(int position) {
                return null;
            }
        }
    }
}
