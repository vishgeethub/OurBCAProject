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
import android.widget.GridView;
import android.widget.ImageView;
import android.widget.TextView;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.InputStream;
import java.net.HttpURLConnection;
import java.net.URL;
import java.util.ArrayList;

import bean.Album;
import bean.Pics;

public class Album_Pic extends AppCompatActivity {
    String aid;
    ProgressDialog pd;
    ArrayList<Pics> pic;
    GridView gv;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_album__pic);

        gv=(GridView)findViewById(R.id.grid_pic);

        Intent i=getIntent();
        Bundle b=i.getExtras();
        aid=b.getString("aid");

        new LoadPictures().execute();

        gv.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
                bean.Pics picc=pic.get(position);
                Intent i=new Intent(Album_Pic.this,Show_Pic.class);
                i.putExtra("description",picc.getDescription());
                i.putExtra("photo",picc.getPhoto());
                i.putExtra("gid",picc.getGid());
                i.putExtra("aid",aid);
                startActivity(i);
            }
        });
    }

    class LoadPictures extends AsyncTask<Void,Void,Void>
    {
        String result;
        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            pd = new ProgressDialog(Album_Pic.this);
            pd.setTitle("Pictures");
            pd.setMessage("Wait...");
            pd.show();
            pic = new ArrayList<Pics>();

        }

        @Override
        protected Void doInBackground(Void... params) {
            UserFunctions obj=new UserFunctions();
            result=obj.getpictures(aid);
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
                    bean.Pics al = new bean.Pics();
                    al.setGid(json.optString("gid"));
                    al.setDescription(json.optString("description"));
                    al.setPhoto(json.optString("photo"));
                    pic.add(al);
                }

                gv.setAdapter(new mybase());

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
                return pic.size();
            }

            class ViewHolder {
                ImageView iv;
            }

            @Override
            public View getView(int position, View convertView, ViewGroup parent) {
                ViewHolder h = null;
                if (convertView == null) {
                    convertView = (View) inflater.inflate(R.layout.pictures_row, null);
                    h = new ViewHolder();
                    h.iv = (ImageView) convertView.findViewById(R.id.picture);
                    convertView.setTag(h);
                } else {
                    h = (ViewHolder) convertView.getTag();
                }

                bean.Pics cat = pic.get(position);

                String path = GlobalVariables.SERVER_IP + GlobalVariables.API_FOLDER + cat.getPhoto().trim();
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
                    h.iv.setImageBitmap(myBitmap);
                } catch (Exception e) {
                    Log.i("Error", e.toString());

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
