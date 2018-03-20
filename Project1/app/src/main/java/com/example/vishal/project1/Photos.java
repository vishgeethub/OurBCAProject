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
import android.widget.Toast;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.InputStream;
import java.net.HttpURLConnection;
import java.net.URL;
import java.util.ArrayList;

import bean.Album;
import bean.Newsc;

public class Photos extends AppCompatActivity {

    String eid;
    GridView gv;
    ArrayList<Album> album;
    ProgressDialog pd;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_photos);

        gv=(GridView)findViewById(R.id.gv);

        Intent i=getIntent();
        Bundle b=i.getExtras();
        eid=b.getString("eid");
        //Toast.makeText(Photos.this,nid, Toast.LENGTH_SHORT).show();
        new LoadAlbum().execute();
        gv.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
                bean.Album alb=album.get(position);
                Intent i=new Intent(Photos.this,Album_Pic.class);
                i.putExtra("aid",alb.getAlbumid());
                startActivity(i);
            }
        });
    }
    class LoadAlbum extends AsyncTask<Void,Void,Void> {
        String result;

        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            pd = new ProgressDialog(Photos.this);
            pd.setTitle("Photos");
            pd.setMessage("Wait...");
            pd.show();
            album = new ArrayList<Album>();
        }

        @Override
        protected Void doInBackground(Void... params) {
            UserFunctions obj = new UserFunctions();
            result = obj.getalbum(eid);
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
                    bean.Album al = new bean.Album();
                    al.setAlbumid(json.optString("aid"));
                    al.setAlbumname(json.optString("album_name"));
                    al.setAlbumpic(json.optString("album_pic"));
                    album.add(al);
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
                return album.size();
            }

            class ViewHolder {
                ImageView iv;
                TextView t1;
            }

            @Override
            public View getView(int position, View convertView, ViewGroup parent) {
                ViewHolder h = null;
                if (convertView == null) {
                    convertView = (View) inflater.inflate(R.layout.album_row, null);
                    h = new ViewHolder();
                    h.iv = (ImageView) convertView.findViewById(R.id.albumpic);
                    h.t1 = (TextView) convertView.findViewById(R.id.albumname);
                    convertView.setTag(h);
                } else {
                    h = (ViewHolder) convertView.getTag();
                }

                bean.Album cat = album.get(position);
                h.t1.setText(cat.getAlbumname());


                String path = GlobalVariables.SERVER_IP + GlobalVariables.API_FOLDER + cat.getAlbumpic().trim();
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
