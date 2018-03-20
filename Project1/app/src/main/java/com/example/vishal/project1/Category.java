package com.example.vishal.project1;

import android.app.ProgressDialog;
import android.content.Context;
import android.os.AsyncTask;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.support.v7.widget.RecyclerView;
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

import java.util.ArrayList;

import bean.Newsc;

public class Category extends AppCompatActivity {

    ArrayList<bean.Category> cc;
    ProgressDialog pd;
    ListView lv;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_category);
        lv=(ListView)findViewById(R.id.listView3);
    }

    class LoadCategory extends AsyncTask<Void,Void,Void>
    {
        String result;

        @Override
        protected void onPreExecute() {
            super.onPreExecute();

            pd=new ProgressDialog(Category.this);
            pd.setTitle("Category");
            pd.setMessage("Wait...");
            pd.show();
            cc=new ArrayList<bean.Category>();
        }

        @Override
        protected Void doInBackground(Void... params) {
            UserFunctions obj=new UserFunctions();
            result=obj.getcategory();
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
                    bean.Category cat=new bean.Category();
                    cat.setCatid(json.optString("catid"));
                    cat.setCatname(json.optString("catname"));
                    cc.add(cat);
                }

                lv.setAdapter(new mybase());

            } catch (JSONException e) {
                e.printStackTrace();
            }
        }
        class mybase extends BaseAdapter {
            LayoutInflater inflater;

            mybase() {
                inflater = (LayoutInflater) getSystemService(Context.LAYOUT_INFLATER_SERVICE);
            }

            @Override
            public int getCount() {
                return cc.size();
            }

            class ViewHolder {
                TextView t1;
            }

            public View getView(int position, View convertView, ViewGroup parent) {
                ViewHolder h = null;
                if (convertView == null) {
                    convertView = (View) inflater.inflate(R.layout.category_row, null);
                    h = new ViewHolder();
                    h.t1 = (TextView) convertView.findViewById(R.id.textView);
                    convertView.setTag(h);
                } else {
                    h = (ViewHolder) convertView.getTag();
                }

                bean.Category cat = cc.get(position);
                h.t1.setText(cat.getCatname());

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
