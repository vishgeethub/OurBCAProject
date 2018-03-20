package com.example.vishal.project1;

import android.app.ProgressDialog;
import android.app.SearchManager;
import android.content.ClipData;
import android.content.Context;
import android.content.Intent;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.os.AsyncTask;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.SearchView;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.view.ViewGroup;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.BaseAdapter;
import android.widget.Filter;
import android.widget.ImageView;
import android.widget.ListView;
import android.widget.Spinner;
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

import bean.Allevent;

public class Event extends AppCompatActivity implements SearchView.OnQueryTextListener, SearchView.OnCloseListener {
    ArrayList<bean.Category> ee;
    ArrayList<String> aa_cat, aa_catid;
    ArrayList<Allevent> aaAllEvent;
    Spinner spn;
    ProgressDialog pd;
    ListView lv;
    mybase mybaseadapter;
    String selectedcatid;

    ArrayAdapter<String> adapter;
  int selectedspinnerindex=0;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_event);
        lv = (ListView) findViewById(R.id.listView);
        spn = (Spinner) findViewById(R.id.spinner);
        aaAllEvent = new ArrayList<>();
        mybaseadapter = new mybase();
        lv.setAdapter(mybaseadapter);
        new LoadCategory().execute();
        spn.setOnItemSelectedListener(new AdapterView.OnItemSelectedListener() {
            @Override
            public void onItemSelected(AdapterView<?> parent, View view, int position, long id) {

                selectedcatid = aa_catid.get(aa_cat.indexOf(spn.getSelectedItem().toString()));
                //Toast.makeText(Event.this, "Hello " + selectedcatid, Toast.LENGTH_LONG).show();
               selectedspinnerindex=position;

                new Loadevent().execute();
                mybaseadapter.notifyDataSetChanged();

            }

            @Override
            public void onNothingSelected(AdapterView<?> parent) {
                Toast.makeText(Event.this, "nothing", Toast.LENGTH_SHORT).show();
            }
        });


        adapter = new ArrayAdapter<String>(getApplicationContext(),android.R.layout.simple_spinner_item, aa_cat);
        adapter.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);
        spn.setAdapter(adapter);
         spn.setSelection(selectedspinnerindex);

        lv.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
                bean.Allevent eventdata=aaAllEvent.get(position);
                Intent i=new Intent(Event.this,Event_Details.class);
                i.putExtra("eventid",eventdata.getEventid());
                i.putExtra("ngoname",eventdata.getNgoname());
                i.putExtra("eventname",eventdata.getEventname());
                i.putExtra("eventdate",eventdata.getEventdate());
                i.putExtra("eventphoto",eventdata.getEventphoto());
                i.putExtra("areaname",eventdata.getAreaname());
                i.putExtra("cityname",eventdata.getCityname());
                i.putExtra("statename",eventdata.getStatename());
                i.putExtra("contact",eventdata.getContact());
                i.putExtra("catname",eventdata.getCatname());
                i.putExtra("description",eventdata.getDescription());
                i.putExtra("eventtime",eventdata.getTime());
                i.putExtra("eventvenue",eventdata.getVenue());
                startActivity(i);
            }
        });
        //Intent i=getIntent();
        //Bundle b=i.getExtras();
        //catid=b.getString("catid");
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        getMenuInflater().inflate(R.menu.menu_event,menu);
        SearchManager searchManager = (SearchManager) getSystemService(Context.SEARCH_SERVICE);
        searchView = (SearchView) menu.findItem(R.id.action_search).getActionView();

        searchView.setSearchableInfo(searchManager.getSearchableInfo(getComponentName()));
        searchView.setIconifiedByDefault(true);
        searchView.setOnQueryTextListener(this);
        searchView.setOnCloseListener(this);
        return true;
    }
    SearchView searchView;

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        return super.onOptionsItemSelected(item);
    }

    @Override
    public boolean onQueryTextSubmit(String query) {
        return false;
    }

    @Override
    public boolean onQueryTextChange(String newText) {
        mybaseadapter.getFilter().filter(newText);
        return true;
    }

    @Override
    public boolean onClose() {
        mybaseadapter.getFilter().filter("");
        return true;
    }

    @Override
    public void onBackPressed() {
        if (!searchView.isIconified()) {
            searchView.setIconified(true);
            searchView.onActionViewCollapsed();
            onClose();
        } else {
            super.onBackPressed();
        }
    }

    class LoadCategory extends AsyncTask<Void, Void, Void> {
        String result;

        @Override
        protected void onPreExecute() {
            super.onPreExecute();

            pd = new ProgressDialog(Event.this);
            pd.setTitle("Category");
            pd.setMessage("Wait...");
            pd.show();
            ee = new ArrayList<bean.Category>();
            aa_cat = new ArrayList<>();
            aa_catid = new ArrayList<>();
        }

        @Override
        protected Void doInBackground(Void... params) {
            UserFunctions obj = new UserFunctions();
            result = obj.getcategory();
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
                    bean.Category cat = new bean.Category();
                    cat.setCatid(json.optString("catid"));
                    cat.setCatname(json.optString("catname"));
                    aa_cat.add(json.optString("catname"));
                    aa_catid.add(json.optString("catid"));

                    ee.add(cat);
                }
                Toast.makeText(Event.this,result, Toast.LENGTH_LONG).show();
                adapter.notifyDataSetChanged();

//                new LoadAllevent().execute();

            } catch (JSONException e) {
                e.printStackTrace();
            }
        }
    }

//    class LoadAllevent extends AsyncTask<Void, Void, Void> {
//        String result;
//
//        @Override
//        protected void onPreExecute() {
//            super.onPreExecute();
//            pd = new ProgressDialog(Event.this);
//            pd.setTitle("Events");
//            pd.setMessage("Wait...");
//            pd.show();
//            aa = new ArrayList<Allevent>();
//        }
//
//        @Override
//        protected Void doInBackground(Void... params) {
//            UserFunctions obj = new UserFunctions();
//            result = obj.getevent();
//            return null;
//        }
//
//        @Override
//        protected void onPostExecute(Void aVoid) {
//            super.onPostExecute(aVoid);
//            pd.dismiss();
//            JSONObject jobj = null;
//            try {
//                jobj = new JSONObject(result);
//                JSONArray jarr = jobj.getJSONArray("messages");
//                for (int i = 0; i < jarr.length(); i++) {
//                    JSONObject json = (JSONObject) jarr.get(i);
//                    bean.Allevent event = new bean.Allevent();
//                    event.setEventname(json.optString("eventname"));
//                    event.setEventphoto(json.optString("eventphoto"));
//                    event.setEventdate(json.optString("eventdate"));
//                    aa.add(event);
//                }
//                lv.setAdapter(new mybase());
//            } catch (JSONException e) {
//                e.printStackTrace();
//            }
//        }
//    }

    class Loadevent extends AsyncTask<Void, Void, Void> {
        String result;

        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            pd = new ProgressDialog(Event.this);
            pd.setTitle("Events");
            pd.setMessage("Wait...");
            pd.show();
            aaAllEvent.clear();
        }

        @Override
        protected Void doInBackground(Void... params) {
            UserFunctions obj = new UserFunctions();
            result = obj.getnewevent(selectedcatid);
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
                    event.setEventid(json.optString("eventid"));
                    event.setNgoname(json.optString("NGOname"));
                    event.setAreaname(json.optString("areaname"));
                    event.setCityname(json.optString("cityname"));
                    event.setStatename(json.optString("statename"));
                    event.setDescription(json.optString("description"));
                    event.setTime(json.optString("eventtime"));
                    event.setVenue(json.optString("venue"));
                    event.setContact(json.optString("contactno"));
                    event.setCatname(json.optString("catname"));
                    aaAllEvent.add(event);

                }
                spn.setSelection(selectedspinnerindex);

                Toast.makeText(Event.this,result, Toast.LENGTH_LONG).show();
                mybaseadapter.notifyDataSetChanged();
            } catch (JSONException e) {
                e.printStackTrace();
            }
        }

    }

    class mybase extends BaseAdapter {

        ArrayList<Allevent> allevents;
        LayoutInflater inflater;

        mybase() {
            allevents = new ArrayList<>();
            inflater = (LayoutInflater) getSystemService(Context.LAYOUT_INFLATER_SERVICE);
        }

        @Override
        public int getCount() {
            return allevents.size();
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

            bean.Allevent event = allevents.get(position);
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

        public Filter getFilter(){
            return new Filter() {
                @Override
                protected FilterResults performFiltering(CharSequence constraint) {
                    FilterResults filterResults = new FilterResults();

                    if(!constraint.equals("") && constraint!=null){
                        ArrayList<Allevent> allevent=new ArrayList<>();
                        for( int i = 0 ; i<aaAllEvent.size();i++){
                            if(aaAllEvent.get(i).getEventname().toLowerCase().contains(constraint)){
                                allevent.add(aaAllEvent.get(i));
                            }
                        }

                        filterResults.values = allevent;
                        filterResults.count =allevent.size();
                    }else{
                        filterResults.values = aaAllEvent;
                        filterResults.count = aaAllEvent.size();
                    }
                    return filterResults;
                }

                @Override
                protected void publishResults(CharSequence constraint, FilterResults results) {
                    allevents = (ArrayList<Allevent>) results.values;

                    notifyDataSetChanged();
                }
            };
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