package com.example.vishal.project1;

import android.app.ProgressDialog;
import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.os.AsyncTask;
import android.os.Bundle;
import android.support.design.widget.NavigationView;
import android.support.v4.view.GravityCompat;
import android.support.v4.view.PagerAdapter;
import android.support.v4.view.ViewPager;
import android.support.v4.widget.DrawerLayout;
import android.support.v7.app.ActionBarDrawerToggle;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.Toolbar;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.ImageView;
import android.widget.LinearLayout;
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
import java.util.Timer;
import java.util.TimerTask;

import bean.Allevent;
import me.relex.circleindicator.CircleIndicator;

public class Welcome extends AppCompatActivity implements NavigationView.OnNavigationItemSelectedListener {

    ListView lv;
    SharedPreferences sp;
    //TextView tv;
    ViewPager viewPagerSlider;
    CircleIndicator indicator;
    ViewPagerAdapter viewPagerAdapter;
    ProgressDialog pd;
    ArrayList<bean.Allevent> aa;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_welcome);
        lv = (ListView) findViewById(R.id.listView);
        //tv=(TextView)findViewById(R.id.textView);
        sp = getSharedPreferences("mypref", 0);

        Toolbar toolbar = (Toolbar) findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);

        DrawerLayout drawer = (DrawerLayout) findViewById(R.id.drawer_layout);
        ActionBarDrawerToggle toggle = new ActionBarDrawerToggle(
                this, drawer, toolbar, R.string.navigation_drawer_open, R.string.navigation_drawer_close);
        drawer.setDrawerListener(toggle);
        toggle.syncState();

        NavigationView navigationView = (NavigationView) findViewById(R.id.nav_view);
        navigationView.setNavigationItemSelectedListener(this);

        ImageView iv1 =(ImageView)navigationView.getHeaderView(0).findViewById(R.id.imageview123);
        TextView uname=(TextView)navigationView.getHeaderView(0).findViewById(R.id.name);
        TextView userid=(TextView)navigationView.getHeaderView(0).findViewById(R.id.userid);
        uname.setText(sp.getString("name","").toString());
        userid.setText(sp.getString("loginid","").toString());
        String path = GlobalVariables.SERVER_IP + GlobalVariables.API_FOLDER+sp.getString("profilepic","").toString().trim();
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
                 */   iv1.setImageBitmap(myBitmap);
        }
        catch(Exception e)
        {
            Log.i("Error",e.toString());

        }


        //tv.setText("Welcome"+sp.getString("name","").toString());
        new LoadAllevent().execute();

        /*lv.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {

                Intent i=new Intent(Welcome.this,Event.class);
                   i.putExtra("catid",aa.get(position).getCatid());
                startActivity(i);

            }
        });*/

        viewPagerSlider = (ViewPager) findViewById(R.id.activity_category_viewpager);
        indicator = (CircleIndicator) findViewById(R.id.indicator);
        viewPagerAdapter = new ViewPagerAdapter();

        viewPagerSlider.setAdapter(viewPagerAdapter);
        indicator.setViewPager(viewPagerSlider);

        timer = new Timer();
        timer.schedule(new TimerTask() {
            @Override
            public void run() {
                runOnUiThread(new Runnable() {
                    @Override
                    public void run() {
                        if (viewPagerSlider.getCurrentItem() + 1 == viewPagerSlider.getAdapter().getCount()) {
                            viewPagerSlider.setCurrentItem(0);
                        } else {
                            viewPagerSlider.setCurrentItem(viewPagerSlider.getCurrentItem() + 1);
                        }
                    }
                });
            }
        }, 3000, 2000);
    }

    Timer timer;

    class ViewPagerAdapter extends PagerAdapter {

        int images[] = {R.mipmap.ad1, R.mipmap.ad2, R.mipmap.ad3, R.mipmap.ad4};

        LayoutInflater layoutInflater;

        @Override
        public int getCount() {
            return images.length;
        }

        @Override
        public boolean isViewFromObject(View view, Object object) {
            return (view == (LinearLayout) object);
        }

        @Override
        public Object instantiateItem(ViewGroup container, int position) {
            layoutInflater = (LayoutInflater) getSystemService(LAYOUT_INFLATER_SERVICE);
            View itemView = layoutInflater.inflate(R.layout.list_activity_category_slider, container, false);
            ImageView imageView = (ImageView) itemView.findViewById(R.id.list_activity_category_slider_iv);
            imageView.setImageResource(images[position]);
            container.addView(itemView);
            return itemView;
        }

        @Override
        public void destroyItem(ViewGroup container, int position, Object object) {
            container.removeView((LinearLayout) object);
        }

    }

    class LoadAllevent extends AsyncTask<Void, Void, Void> {
        String result;

        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            pd = new ProgressDialog(Welcome.this);
            pd.setTitle("Events");
            pd.setMessage("Wait...");
            pd.show();
            aa = new ArrayList<Allevent>();
        }

        @Override
        protected Void doInBackground(Void... params) {
            UserFunctions obj = new UserFunctions();
            result = obj.getevent();
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
                    event.setEventdate(json.optString("eventdate"));
                    aa.add(event);
                }
                lv.setAdapter(new mybase());
            } catch (JSONException e) {
                e.printStackTrace();
            }
        }
    }

    class mybase extends BaseAdapter {
        LayoutInflater inflater;

        mybase() {
            inflater = (LayoutInflater) getSystemService(Context.LAYOUT_INFLATER_SERVICE);
        }

        @Override
        public int getCount() {
            return aa.size();
        }

        class ViewHolder {
            ImageView iv;
            TextView t1, t2;
        }

        @Override
        public View getView(int position, View convertView, ViewGroup parent) {
            ViewHolder h = null;
            if (convertView == null) {
                convertView = (View) inflater.inflate(R.layout.event_row, null);
                h = new ViewHolder();
                h.iv = (ImageView) convertView.findViewById(R.id.iv_event);
                h.t1 = (TextView) convertView.findViewById(R.id.txtevent_name);
                h.t2 = (TextView) convertView.findViewById(R.id.txtevent_date);
                convertView.setTag(h);
            } else {
                h = (ViewHolder) convertView.getTag();
            }

            bean.Allevent event = aa.get(position);
            h.t1.setText(event.getEventname());
            StringTokenizer st=new StringTokenizer(event.getEventdate(),"-");
            String y=st.nextToken();
            String m=st.nextToken();
            String dt=st.nextToken();
            h.t2.setText(dt+"-"+m+"-"+y);

            String path = GlobalVariables.SERVER_IP + GlobalVariables.API_FOLDER + event.getEventphoto().trim();
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

    @Override
    public void onBackPressed() {
        DrawerLayout drawer = (DrawerLayout) findViewById(R.id.drawer_layout);
        if (drawer.isDrawerOpen(GravityCompat.START)) {
            drawer.closeDrawer(GravityCompat.START);
        } else {
            super.onBackPressed();
        }
    }

//
//    @Override
//    public boolean onCreateOptionsMenu(Menu menu) {
//        // Inflate the menu; this adds items to the action bar if it is present.
//        getMenuInflater().inflate(R.menu.main, menu);
//        return true;
//    }
//
//    @Override
//    public boolean onOptionsItemSelected(MenuItem item) {
//        // Handle action bar item clicks here. The action bar will
//        // automatically handle clicks on the Home/Up button, so long
//        // as you specify a parent activity in AndroidManifest.xml.
//        int id = item.getItemId();
//
//        //noinspection SimplifiableIfStatement
//        if (id == R.id.action_settings) {
//            return true;
//        }
//
//        return super.onOptionsItemSelected(item);
//    }




    @SuppressWarnings("StatementWithEmptyBody")
    @Override
    public boolean onNavigationItemSelected(MenuItem item) {
        // Handle navigation view item clicks here.
        int id = item.getItemId();

        if (id == R.id.news) {
            // Handle the camera action
            Intent i = new Intent(Welcome.this, News.class);
            startActivity(i);
        } else if (id == R.id.nav_gallery) {
            Intent o = new Intent(Welcome.this, Login.class);
            startActivity(o);
        } else if (id == R.id.profile) {
            Intent o = new Intent(Welcome.this, Profile.class);
            startActivity(o);
        } else if (id == R.id.nav_share) {
            Intent o = new Intent(Welcome.this, About_Us.class);
            startActivity(o);
        } else if (id == R.id.ngo) {
            Intent o = new Intent(Welcome.this, NGO.class);
            startActivity(o);

        } else if (id == R.id.event) {
            Intent o = new Intent(Welcome.this, Event.class);
            startActivity(o);
        } else if (id == R.id.change_password) {
            Intent o = new Intent(Welcome.this, Change_Password.class);
            startActivity(o);
        } else if (id == R.id.activities) {
            Intent o = new Intent(Welcome.this, My_Activity.class);
            startActivity(o);
        } else if (id == R.id.charity) {
            Intent o = new Intent(Welcome.this, List_Charity.class);
            startActivity(o);
        }else if (id == R.id.feedback) {
            Intent o = new Intent(Welcome.this, Feedback.class);
            startActivity(o);
        } else if (id == R.id.Logout) {
            SharedPreferences.Editor ed = sp.edit();
            ed.putString("id", "");
            ed.putString("name", "");
            ed.commit();
            Intent o = new Intent(Welcome.this, Login.class);
            startActivity(o);
            finish();

        }

        DrawerLayout drawer = (DrawerLayout) findViewById(R.id.drawer_layout);
        drawer.closeDrawer(GravityCompat.START);
        return true;
    }


}

