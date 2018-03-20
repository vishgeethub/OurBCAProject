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
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.view.ViewGroup;
import android.widget.AdapterView;
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

import bean.UserActivity;

public class List_Charity extends AppCompatActivity {

    ProgressDialog pd;
    ArrayList<bean.Charity> cc;
    SharedPreferences sp;
    String uid;
    ListView lv;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_list__charity);
        sp= getSharedPreferences("mypref", 0);
        uid=sp.getString("id","").toString();
        lv=(ListView)findViewById(R.id.charity_list);
        new LoadCharity().execute();

        lv.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
                bean.Charity ch=cc.get(position);
                Intent i=new Intent(List_Charity.this,Receipt_Charity.class);
                i.putExtra("charityid",ch.getCharityid());
                i.putExtra("ngoname",ch.getNgoname());
                i.putExtra("website",ch.getWebsite());
                i.putExtra("phone",ch.getContact());
                i.putExtra("purpose",ch.getPrupose());
                i.putExtra("date",ch.getCharitydate());
                i.putExtra("uname",ch.getUname());
                i.putExtra("amount",ch.getAmount());
                startActivity(i);
            }
        });
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        getMenuInflater().inflate(R.menu.menu_charity,menu);

        return super.onCreateOptionsMenu(menu);

    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        if(R.id.action_search==item.getItemId())
        {
            Intent i=new Intent(List_Charity.this,NGO.class);
            startActivity(i);
        }
        return super.onOptionsItemSelected(item);
    }

    class LoadCharity extends AsyncTask<Void,Void,Void>
    {
        String result;
        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            pd=new ProgressDialog(List_Charity.this);
            pd.setTitle("Charity");
            pd.setMessage("Wait...");
            pd.show();
            cc=new ArrayList<bean.Charity>();

        }

        @Override
        protected Void doInBackground(Void... params) {
            UserFunctions obj=new UserFunctions();
            result=obj.getcharity(uid);
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
                    bean.Charity ch=new bean.Charity();
                    ch.setCharityid(json.optString("charityid"));
                    ch.setUname(json.optString("uname"));
                    ch.setNgoname(json.optString("NGOname"));
                    ch.setWebsite(json.optString("website"));
                    ch.setContact(json.optString("phone"));
                    ch.setAmount(json.optString("amount"));
                    ch.setPrupose(json.optString("purpose"));
                    ch.setCharitydate(json.optString("charitydate"));
                    cc.add(ch);
                }

                lv.setAdapter(new mybase());

            }catch (JSONException e) {
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
                return cc.size();
            }

            class ViewHolder
            {
                TextView t1,t2,t3;
            }

            @Override
            public View getView(int position, View convertView, ViewGroup parent) {
                ViewHolder h=null;
                if(convertView==null)
                {
                    convertView = (View) inflater.inflate(R.layout.charitylist_row, null);
                    h=new ViewHolder();
                    h.t1=(TextView)convertView.findViewById(R.id.charity_amount);
                    h.t2=(TextView)convertView.findViewById(R.id.charity_ngo);
                    h.t3=(TextView)convertView.findViewById(R.id.charity_date);
                    convertView.setTag(h);
                }
                else {
                    h=(ViewHolder)convertView.getTag();
                }

                bean.Charity cat=cc.get(position);
               // h.t1.setText(cat.getEventname());
                h.t1.setText(cat.getAmount()+" Rs.");
                h.t2.setText("'"+cat.getNgoname()+"'");
                StringTokenizer st=new StringTokenizer(cat.getCharitydate(),"-");
                String y=st.nextToken();
                String m=st.nextToken();
                String dt=st.nextToken();
                h.t3.setText(dt+"-"+m+"-"+y);

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
