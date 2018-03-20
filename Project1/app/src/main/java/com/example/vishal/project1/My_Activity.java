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
import android.widget.AdapterView;
import android.widget.BaseAdapter;
import android.widget.ImageView;
import android.widget.ListView;
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

import bean.Newsc;
import bean.UserActivity;

public class My_Activity extends AppCompatActivity {
    ListView lv;
    ArrayList<UserActivity> act;
    ProgressDialog pd;
    String uid;
    SharedPreferences sp;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_my_);

        lv=(ListView)findViewById(R.id.listViewmy);

        sp= getSharedPreferences("mypref", 0);
        uid=sp.getString("id","").toString();

        new LoadActivity().execute();
        lv.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
                bean.UserActivity obj=act.get(position);
                Intent i=new Intent(My_Activity.this,Show_My_Activity.class);
                i.putExtra("eventid",obj.getEventid());
                startActivity(i);
                finish();
            }
        });
    }
    class LoadActivity extends AsyncTask<Void,Void, Void>
    {
        String result;
        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            pd=new ProgressDialog(My_Activity.this);
            pd.setTitle("Activities");
            pd.setMessage("Wait...");
            pd.show();
            act=new ArrayList<UserActivity>();
        }

        @Override
        protected Void doInBackground(Void... params) {
            UserFunctions obj=new UserFunctions();
            result=obj.getvolunteerdetails(uid);
            return null;
        }

        @Override
        protected void onPostExecute(Void aVoid) {
            super.onPostExecute(aVoid);
            pd.dismiss();
            JSONObject jobj=null;
            try {
                jobj = new JSONObject(result);
                JSONArray jarr= jobj.getJSONArray("messages");
                for(int i=0;i<jarr.length();i++)
                {
                    JSONObject json= (JSONObject) jarr.get(i);
                    bean.UserActivity news=new bean.UserActivity();
                    news.setEventid(json.optString("eventid"));
                    news.setVolunteerid(json.optString("volunteerid"));
                    news.setEventdate(json.optString("eventdate"));
                    news.setEventname(json.optString("eventname"));
                    news.setEventtime(json.optString("eventtime"));
                    news.setEventphoto(json.optString("eventphoto"));
                    act.add(news);
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
                return act.size();
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
                    convertView = (View) inflater.inflate(R.layout.activity_row, null);
                    h=new ViewHolder();
                    h.iv=(ImageView)convertView.findViewById(R.id.eventphoto);
                    h.t1=(TextView)convertView.findViewById(R.id.eventname);
                    h.t2=(TextView)convertView.findViewById(R.id.date);
                    convertView.setTag(h);
                }
                else {
                    h=(ViewHolder)convertView.getTag();
                }

                bean.UserActivity cat=act.get(position);
                h.t1.setText(cat.getEventname());
                StringTokenizer st=new StringTokenizer(cat.getEventdate(),"-");
                String y=st.nextToken();
                String m=st.nextToken();
                String dt=st.nextToken();
                String date;
                date = (dt+"-"+m+"-"+y);
                h.t2.setText(date+" ,"+cat.getEventtime());


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
