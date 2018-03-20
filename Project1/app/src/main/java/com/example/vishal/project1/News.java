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
import android.view.Menu;
import android.view.MenuItem;
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

public class News extends AppCompatActivity {

    ArrayList<bean.Newsc>nn;
    ProgressDialog pd;
    ListView lv;
    String nid,sd;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_news);
        lv=(ListView)findViewById(R.id.listView2) ;
        new LoadNewsc().execute();
        lv.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
                bean.Newsc newsdata=nn.get(position);
                // Toast.makeText(News.this,newsdata.getNewsid(),Toast.LENGTH_LONG).show();
                Intent i=new Intent(News.this,Show_News.class);
                i.putExtra("newsid",newsdata.getNewsid());
                i.putExtra("d_description",newsdata.getDescript());

                startActivity(i);
            }
        });
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
            Intent i=new Intent(News.this,Welcome.class);
            startActivity(i);
            finish();
        }
        return super.onOptionsItemSelected(item);
    }

    class LoadNewsc extends AsyncTask<Void,Void,Void>
    {
        String result;
        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            pd=new ProgressDialog(News.this);
            pd.setTitle("News");
            pd.setMessage("Wait...");
            pd.show();
            nn=new ArrayList<Newsc>();
        }

        @Override
        protected Void doInBackground(Void... params) {
            UserFunctions obj=new UserFunctions();
            result=obj.getnews();
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
                    bean.Newsc news=new bean.Newsc();
                    news.setNewsid(json.optString("newsid"));
                    news.setDescript(json.optString("description"));
                    news.setShrtdescrpt(json.optString("short_desc"));
                    news.setNgoid(json.optString("ngoid"));
                    news.setPhoto(json.optString("photo"));
                    news.setNewsdate(json.optString("newsdate"));
                    news.setNgoname(json.optString("ngoname"));
                    nn.add(news);
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
                return nn.size();
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
                    convertView = (View) inflater.inflate(R.layout.news_row, null);
                    h=new ViewHolder();
                    h.iv=(ImageView)convertView.findViewById(R.id.iv_news);
                    h.t1=(TextView)convertView.findViewById(R.id.txtnews_news);
                    h.t2=(TextView)convertView.findViewById(R.id.txtdate_news);
                    convertView.setTag(h);
                }
                else {
                    h=(ViewHolder)convertView.getTag();
                }

                bean.Newsc cat=nn.get(position);
                h.t1.setText(cat.getShrtdescrpt());
                StringTokenizer st=new StringTokenizer(cat.getNewsdate(),"-");
                String y=st.nextToken();
                String m=st.nextToken();
                String dt=st.nextToken();
                h.t2.setText(dt+"-"+m+"-"+y);


                String path = GlobalVariables.SERVER_IP + GlobalVariables.API_FOLDER+cat.getPhoto().trim();
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
