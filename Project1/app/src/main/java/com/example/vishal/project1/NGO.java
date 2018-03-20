package com.example.vishal.project1;

import android.app.ProgressDialog;
import android.app.SearchManager;
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
import android.widget.BaseAdapter;
import android.widget.Filter;
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

import bean.Ngo_Details;

public class NGO extends AppCompatActivity implements SearchView.OnQueryTextListener, SearchView.OnCloseListener {

    ProgressDialog pd;
    ListView lv;
    ArrayList<bean.Ngo_Details> nn;
    mybase mybaseadapter;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_ngo);
        lv = (ListView) findViewById(R.id.listView);
        nn = new ArrayList<>();
        mybaseadapter = new mybase();
        lv.setAdapter(mybaseadapter);
        new LoadNgoDetails().execute();

        lv.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
                bean.Ngo_Details ngo=nn.get(position);
                Intent i=new Intent(NGO.this,show_ngo.class);
                i.putExtra("nid",ngo.getNgoid());
                i.putExtra("logo",ngo.getLogo());
                i.putExtra("name",ngo.getName());
                i.putExtra("website",ngo.getWebsite());
                i.putExtra("phone",ngo.getPhone());
                i.putExtra("description",ngo.getDescription());
                i.putExtra("email",ngo.getEmailid());
                i.putExtra("address",ngo.getAddress());
                i.putExtra("areaname",ngo.getAreaname());
                i.putExtra("cityname",ngo.getCityname());
                i.putExtra("statename",ngo.getStatename());
                startActivity(i);
            }
        });
    }

    public boolean onCreateOptionsMenu(Menu menu) {
        getMenuInflater().inflate(R.menu.menu_ngo, menu);
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

    class LoadNgoDetails extends AsyncTask<Void, Void, Void> {
        String result;

        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            super.onPreExecute();
            pd = new ProgressDialog(NGO.this);
            pd.setTitle("News");
            pd.setMessage("Wait...");
            pd.show();
            nn.clear();
        }

        @Override
        protected Void doInBackground(Void... params) {
            UserFunctions obj = new UserFunctions();
            result = obj.getngodetails();
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
                    bean.Ngo_Details ngo = new bean.Ngo_Details();
                    ngo.setNgoid(json.optString("ngoid"));
                    ngo.setName(json.optString("name"));
                    ngo.setDescription(json.optString("description"));
                    ngo.setEmailid(json.optString("emailid"));
                    ngo.setLogo(json.optString("logo"));
                    ngo.setAddress(json.optString("address"));
                    ngo.setPhone(json.optString("phone"));
                    ngo.setAreaname(json.optString("areaname"));
                    ngo.setAreaid(json.optString("areaid"));
                    ngo.setCityname(json.optString("cityname"));
                    ngo.setCityid(json.optString("cityid"));
                    ngo.setStatename(json.optString("statename"));
                    ngo.setStateid(json.optString("stateid"));
                    ngo.setWebsite(json.optString("website"));
                    nn.add(ngo);
                }

               mybaseadapter.notifyDataSetChanged();

            } catch (JSONException e) {
                e.printStackTrace();
            }
        }


    }
    class mybase extends BaseAdapter {
        ArrayList<Ngo_Details> allngo;
        LayoutInflater inflater;

        mybase() {
            allngo = new ArrayList<>();
            inflater = (LayoutInflater) getSystemService(Context.LAYOUT_INFLATER_SERVICE);
        }

        @Override
        public int getCount() {
            return allngo.size();
        }

        class ViewHolder {
            ImageView iv;
            TextView t1;
        }

        @Override
        public View getView(int position, View convertView, ViewGroup parent) {
            ViewHolder h = null;
            if (convertView == null) {
                convertView = (View) inflater.inflate(R.layout.ngo_row, null);
                h = new ViewHolder();
                h.iv = (ImageView) convertView.findViewById(R.id.ngologo);
                h.t1 = (TextView) convertView.findViewById(R.id.ngoname);

                convertView.setTag(h);
            } else {
                h = (ViewHolder) convertView.getTag();
            }

            bean.Ngo_Details cat = allngo.get(position);
            h.t1.setText(cat.getName());


            String path = GlobalVariables.SERVER_IP + GlobalVariables.API_FOLDER + cat.getLogo().trim();
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

        public Filter getFilter() {
            return new Filter() {
                @Override
                protected FilterResults performFiltering(CharSequence constraint) {
                    FilterResults filterResults = new FilterResults();
                    filterResults.values = nn;
                    filterResults.count = nn.size();
                    if (!constraint.equals("") && constraint != null) {
                        ArrayList<Ngo_Details> allngos = new ArrayList<>();
                        for (int i = 0; i < nn.size(); i++) {
                            if (nn.get(i).getName().toLowerCase().contains(constraint)) {
                                allngos.add(nn.get(i));
                            }
                        }

                        filterResults.values = allngos;
                        filterResults.count = allngos.size();
                    } else {
                        filterResults.values = nn;
                        filterResults.count = nn.size();
                    }
                    return filterResults;
                }

                @Override
                protected void publishResults(CharSequence constraint, FilterResults results) {
                    allngo = (ArrayList<Ngo_Details>) results.values;

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
