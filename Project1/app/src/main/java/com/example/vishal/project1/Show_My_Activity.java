package com.example.vishal.project1;

import android.app.ProgressDialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.AsyncTask;
import android.support.v7.app.AlertDialog;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.ImageButton;
import android.widget.TextView;
import android.widget.Toast;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.StringTokenizer;

public class Show_My_Activity extends AppCompatActivity {
    String eventid,eventname,venue,areaname,cityname,statename,date,time,uid;
    TextView ename,address,datetime;
    ImageButton rem_volunteer;
    ProgressDialog pd;
    SharedPreferences sp;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_show__my_);
        ename=(TextView)findViewById(R.id.event_name);
        address=(TextView)findViewById(R.id.address7);
        datetime=(TextView)findViewById(R.id.datetime);
        rem_volunteer=(ImageButton)findViewById(R.id.remove);
        Intent i=getIntent();
        Bundle b=i.getExtras();
        eventid=b.getString("eventid");

        sp = getSharedPreferences("mypref", 0);
        uid = sp.getString("id","").toString();
        rem_volunteer.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                showConfirmDialog();
            }
        });

        new LoadEventDetails().execute();

    }

    private void showConfirmDialog(){
        final AlertDialog.Builder builder = new AlertDialog.Builder(this);
        builder.setTitle("Delete Event!!");
        builder.setMessage("Are you sure, You want to delete activity?");
        builder.setPositiveButton("Yes", new DialogInterface.OnClickListener() {
            @Override
            public void onClick(DialogInterface dialog, int which) {
                new RemoveVolunteer().execute();

            }
        });
        builder.setNegativeButton("No", new DialogInterface.OnClickListener() {
            @Override
            public void onClick(DialogInterface dialog, int which) {

            }
        });
        builder.show();
    }
    class RemoveVolunteer extends AsyncTask<Void,Void,Void>
    {
        String result;
        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            super.onPreExecute();
            pd=new ProgressDialog(Show_My_Activity.this);
            pd.setTitle("Sending Data");
            pd.setMessage("Wait...");
            pd.show();
        }

        @Override
        protected Void doInBackground(Void... params) {
            UserFunctions obj=new UserFunctions();
            result=obj.deletevolunteer(eventid,uid);
            return null;
        }

        @Override
        protected void onPostExecute(Void aVoid) {
            super.onPostExecute(aVoid);
            pd.dismiss();
            JSONObject jobj = null;
            try
            {
                jobj = new JSONObject(result);
                String msg=jobj.optString("messages").toString();
                if(msg.equals("Delete Successfully")) {
                    Toast.makeText(Show_My_Activity.this,"You Successfully removed yourself from '"+eventname+"' event.",Toast.LENGTH_LONG).show();
                    Intent i=new Intent(Show_My_Activity.this,My_Activity.class);
                    startActivity(i);
                    finish();

                }else
                {
                    Toast.makeText(Show_My_Activity.this, "Try again", Toast.LENGTH_SHORT).show();
                }


            }catch (Exception ex) {
                ex.printStackTrace();
            }

        }
    }

    class LoadEventDetails extends AsyncTask<Void,Void,Void>
    {
        String result;

        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            pd=new ProgressDialog(Show_My_Activity.this);
            pd.setTitle("Event Details");
            pd.setMessage("Wait...");
            pd.show();
        }

        @Override
        protected Void doInBackground(Void... params) {
            UserFunctions obj=new UserFunctions();
            result=obj.geteventdetails(eventid);
            return null;
        }

        @Override
        protected void onPostExecute(Void aVoid) {
            super.onPostExecute(aVoid);
            JSONObject jobj= null;
            pd.dismiss();
            try
            {
                jobj = new JSONObject(result);
                eventname=jobj.optString("eventname");
                venue=jobj.optString("venue");
                cityname=jobj.optString("cityname");
                areaname=jobj.optString("areaname");
                statename=jobj.optString("statename");
                StringTokenizer st=new StringTokenizer(jobj.optString("eventdate"),"-");
                String y=st.nextToken();
                String m=st.nextToken();
                String dt=st.nextToken();
                date=dt+"-"+m+"-"+y;
                time=jobj.optString("eventtime");
                ename.setText(eventname);
                address.setText(venue+","+areaname+","+cityname+","+statename);
                datetime.setText(date+", "+time);

            }catch (JSONException e) {
                e.printStackTrace();
            }

        }
    }
}
