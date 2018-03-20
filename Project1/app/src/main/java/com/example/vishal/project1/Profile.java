package com.example.vishal.project1;

import android.app.ProgressDialog;
import android.content.Intent;
import android.content.SharedPreferences;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.os.AsyncTask;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.text.format.DateFormat;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.TextView;

import org.json.JSONException;
import org.json.JSONObject;

import java.io.InputStream;
import java.net.HttpURLConnection;
import java.net.URL;
import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.Date;
import java.util.StringTokenizer;

public class Profile extends AppCompatActivity {

    SharedPreferences sp;
    String uid,adds,phone,pic;
    ProgressDialog pd;
    ImageView roundedimageview;
    Button button;
    TextView username,emailid,phno,gender,address,dob;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_profile);
        username=(TextView)findViewById(R.id.username);
        emailid=(TextView)findViewById(R.id.email);
        phno=(TextView)findViewById(R.id.phno);
        gender=(TextView)findViewById(R.id.gender);
        address=(TextView)findViewById(R.id.address);
        dob=(TextView)findViewById(R.id.dob);
        roundedimageview=(ImageView)findViewById(R.id.roundedimageview);
        button=(Button)findViewById(R.id.button1);


        sp = getSharedPreferences("mypref", 0);
        uid = sp.getString("id","").toString();
        new LoadUser().execute();

        button.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent i= new Intent(Profile.this,Edit_Profile.class);
                i.putExtra("add",adds);
                i.putExtra("phno",phone);
                i.putExtra("image",pic);
                startActivity(i);
                finish();
            }
        });
    }

    class LoadUser extends AsyncTask<Void,Void,Void>
    {
        String result;
        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            pd=new ProgressDialog(Profile.this);
            pd.setTitle("Profile Details");
            pd.setMessage("Fetching Data...");
            pd.show();

        }

        @Override
        protected Void doInBackground(Void... params) {
            UserFunctions obj=new UserFunctions();
            result=obj.getuserdetails(uid);
            return null;
        }

        @Override
        protected void onPostExecute(Void aVoid) {
            super.onPostExecute(aVoid);
            String id;
            JSONObject jobj= null;
            pd.dismiss();
            try
            {
                jobj = new JSONObject(result);
                if(jobj.optString("gender").toString()!= "M")
                {
                    gender.setText("Male");
                }
                else
                {
                    gender.setText("Female");
                }
                username.setText(jobj.optString("uname").toString());
                phone=jobj.optString("phone").toString();
                phno.setText(phone);
                emailid.setText(jobj.optString("emailid").toString());
                adds=jobj.optString("address").toString()+", "+jobj.optString("areaname").toString()+", "+jobj.optString("cityname").toString()+", "+jobj.optString("statename").toString();
                address.setText(adds);
                StringTokenizer st=new StringTokenizer(jobj.optString("dob").toString(),"-");
                String y=st.nextToken();
                String m=st.nextToken();
                String dt=st.nextToken();

                dob.setText(dt+"-"+m+"-"+y);

                //Date cDate = new Date();

                //String fDate = new SimpleDateFormat("yyyy-MM-dd").format(jobj.optString("dob").toString());

                pic=jobj.optString("profilepic").toString();
                String path = GlobalVariables.SERVER_IP + GlobalVariables.API_FOLDER+jobj.optString("profilepic").toString().trim();
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
                 */   roundedimageview.setImageBitmap(myBitmap);
                }
                catch(Exception e)
                {
                    Log.i("Error",e.toString());
                }
            }
            catch (JSONException e) {
                e.printStackTrace();
            }

        }
    }
}
