package com.example.vishal.project1;

import android.app.Activity;
import android.app.DatePickerDialog;
import android.app.ProgressDialog;
import android.content.Intent;
import android.graphics.Bitmap;
import android.net.Uri;
import android.os.AsyncTask;
import android.provider.MediaStore;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.text.Editable;
import android.text.TextWatcher;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.DatePicker;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.RadioButton;
import android.widget.Spinner;
import android.widget.Toast;

import org.apache.http.entity.mime.MultipartEntity;

import org.apache.http.entity.mime.content.ByteArrayBody;
import org.apache.http.entity.mime.content.FileBody;
import org.apache.http.entity.mime.content.StringBody;
import org.json.JSONArray;
import org.json.JSONObject;

import java.io.ByteArrayOutputStream;
import java.io.File;
import java.io.IOException;
import java.io.UnsupportedEncodingException;
import java.util.ArrayList;
import java.util.Calendar;

public class Registration extends AppCompatActivity {


    Button btndob,browsebtn,submit;
    ImageView image1;
   int y,m,d;
    String selectedstateid,selectedcityid;

  Spinner spcity,sparea,spstate;
ArrayList<String> aastatename,aastateid;
ArrayList<String> aacityname,aacityid;
    ArrayList<String> aaareaid,aaareaname;
    ProgressDialog pd;

    EditText t1,t2,t3,t4,t5,t6,t7;
    RadioButton r1,r2;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_registration);
       btndob=(Button)findViewById(R.id.btndob);
        browsebtn=(Button)findViewById(R.id.button1);
        image1=(ImageView)findViewById(R.id.imageView2);
           spstate=(Spinner)findViewById(R.id.spinner);
        spcity=(Spinner)findViewById(R.id.spinner1);
        sparea=(Spinner)findViewById(R.id.spinner2);

        t1=(EditText)findViewById(R.id.editText);
        t2=(EditText)findViewById(R.id.editText4);
        t3=(EditText)findViewById(R.id.editText1);
        t4=(EditText)findViewById(R.id.editText3);
        t5=(EditText)findViewById(R.id.editText5);
        t6=(EditText)findViewById(R.id.editText6);
        t7=(EditText)findViewById(R.id.editText7);


        r1=(RadioButton)findViewById(R.id.radioButton);
        r2=(RadioButton)findViewById(R.id.radioButton1);
        submit=(Button)findViewById(R.id.button);



        Calendar c=Calendar.getInstance();
        y=c.get(Calendar.YEAR);
        m=c.get(Calendar.MONTH);
        d=c.get(Calendar.DAY_OF_MONTH);

        btndob.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                DatePickerDialog  dt=new DatePickerDialog(Registration.this, new DatePickerDialog.OnDateSetListener() {
                    @Override
                    public void onDateSet(DatePicker view, int year, int monthOfYear, int dayOfMonth) {
                         btndob.setText(year+"-"+(monthOfYear+1)+"-"+dayOfMonth);
                    }
                },y,m,d);
                dt.show();
            }
        });
        browsebtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                //image1.setImageResource(R.mipmap.ngo);

                final int PICK_IMAGE_REQUEST = 1234;

                Intent intent = new Intent();
                intent.setType("image/*");
                intent.setAction(Intent.ACTION_GET_CONTENT);
                startActivityForResult(Intent.createChooser(intent, "Select Picture"), PICK_IMAGE_REQUEST);
            }
        });


        new LoadState().execute();


        spstate.setOnItemSelectedListener(new AdapterView.OnItemSelectedListener() {
            @Override
            public void onItemSelected(AdapterView<?> parent, View view, int position, long id) {

              selectedstateid=aastateid.get(position);
              new LoadCity().execute();
            }

            @Override
            public void onNothingSelected(AdapterView<?> parent) {

            }
        });


        spcity.setOnItemSelectedListener(new AdapterView.OnItemSelectedListener() {
            @Override
            public void onItemSelected(AdapterView<?> parent, View view, int position, long id) {
             selectedcityid=aacityid.get(position);
              new LoadArea().execute();
            }

            @Override
            public void onNothingSelected(AdapterView<?> parent) {

            }
        });

          submit.setOnClickListener(new View.OnClickListener() {
              @Override
              public void onClick(View v) {

                  boolean flag=true;
                  if(t1.length()==0 )
                  {
                      flag=false;
                      t1.setError("Enter User name");
                  }
                  if(t2.length()==0)
                  {
                      flag=false;
                      t2.setError("Enter Email ID");
                  }
                  if(t3.length()==0)
                  {
                      flag=false;
                      t3.setError("Enter Adress");
                  }
                  if(t4.length()==0)
                  {
                      flag=false;
                      t4.setError("Enter Mobile No.");
                  }
                  if(t5.length()==0)
                  {
                      flag=false;
                      t5.setError("Enter Login ID");
                  }

                  if(t6.length()==0)
                  {
                      flag=false;
                      t6.setError("Enter Password");
                  }
                 // if(t7.getText().toString()==t6.getText().toString())
                  //{
                    //  flag=true;
                      //t7.setError("Password Matched");
                  //}
                  //else
                  //{
                    //  flag=false;
                      //t7.setError("Password NOT Matched");
                  //}
                  if(flag==true)
                  {
                      sendDataToServer();
                  }
              }
          });

    }


    Bitmap bitmap=null;
    protected void onActivityResult(int requestCode, int resultCode, Intent data) {
        super.onActivityResult(requestCode, resultCode, data);

        if (requestCode == 1234 && resultCode == RESULT_OK && data != null && data.getData() != null) {

            Uri uri = data.getData();

            try {
                bitmap = MediaStore.Images.Media.getBitmap(getContentResolver(), uri);
                image1.setImageBitmap(bitmap);
            } catch (IOException e) {
                e.printStackTrace();
            }
        }
    }

    class LoadState extends AsyncTask<Void,Void,Void>
    {
       String result;
        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            pd=new ProgressDialog(Registration.this);
            pd.setTitle("Loging in");
            pd.setMessage("Wait...");

            pd.show();

            aastatename=new ArrayList<String>();
            aastateid=new ArrayList<String>();
        }

        @Override
        protected Void doInBackground(Void... params) {
           UserFunctions obj=new UserFunctions();
            result=obj.getstate();

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
                    aastateid.add(json.optString("stateid"));
                    aastatename.add(json.optString("name"));

                }
            } catch (Exception ex) {
                ex.printStackTrace();
            }

            ArrayAdapter<String> adp=new ArrayAdapter<String>(Registration.this,android.R.layout.simple_list_item_1,aastatename);
            spstate.setAdapter(adp);

        }
    }


    class LoadCity extends AsyncTask<Void,Void,Void>
    {
        String result;

        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            pd=new ProgressDialog(Registration.this);
            pd.setTitle("Loging in");
            pd.setMessage("Wait...");

            pd.show();
           aacityid=new ArrayList<String>();
            aacityname=new ArrayList<String>();
        }

        @Override
        protected Void doInBackground(Void... params) {
            UserFunctions obj=new UserFunctions();
            result=obj.getcity(selectedstateid);

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
                    aacityid.add(json.optString("cityid"));
                    aacityname.add(json.optString("name"));

                }
            } catch (Exception ex) {
                ex.printStackTrace();
            }

            ArrayAdapter<String> adp=new ArrayAdapter<String>(Registration.this,android.R.layout.simple_list_item_1,aacityname);
            spcity.setAdapter(adp);

        }
    }

    class LoadArea extends AsyncTask<Void,Void,Void>
    {
        String result;

        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            pd=new ProgressDialog(Registration.this);
            pd.setTitle("Loging in");
            pd.setMessage("Wait...");

            pd.show();
            aaareaid=new ArrayList<String>();
            aaareaname=new ArrayList<String>();

        }

        @Override
        protected Void doInBackground(Void... params) {
            UserFunctions obj=new UserFunctions();
            result=obj.getarea(selectedcityid);

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
                    aaareaid.add(json.optString("areaid"));
                    aaareaname.add(json.optString("name"));

                }
            } catch (Exception ex) {
                ex.printStackTrace();
            }

            ArrayAdapter<String> adp=new ArrayAdapter<String>(Registration.this,android.R.layout.simple_list_item_1,aaareaname);
            sparea.setAdapter(adp);

        }
    }


    String url=GlobalVariables.SERVER_IP + GlobalVariables.API_FOLDER
            + "w_registration.php";

    @SuppressWarnings("deprecation")
    private void sendDataToServer() {
        MultipartEntity multipartEntity = new MultipartEntity();
        try {


            multipartEntity.addPart("name", new StringBody(t1.getText().toString()));
            multipartEntity.addPart("emailid", new StringBody(t2.getText().toString()));
            multipartEntity.addPart("address", new StringBody(t3.getText().toString()));
            multipartEntity.addPart("phone", new StringBody(t4.getText().toString()));
            multipartEntity.addPart("loginid", new StringBody(t5.getText().toString()));
            multipartEntity.addPart("password", new StringBody(t6.getText().toString()));
            multipartEntity.addPart("areaid", new StringBody(aaareaid.get(aaareaname.indexOf(sparea.getSelectedItem().toString()))));
            multipartEntity.addPart("dob", new StringBody(btndob.getText().toString()));

            if(r1.isChecked()) {

                multipartEntity.addPart("gender", new StringBody(r1.getText().toString()));
            }
            else {
                multipartEntity.addPart("gender", new StringBody(r2.getText().toString()));

            }



            if (bitmap != null) {
                ByteArrayOutputStream bos = new ByteArrayOutputStream();
                bitmap.compress(Bitmap.CompressFormat.JPEG, 100, bos);
                byte[] data = bos.toByteArray();
                ByteArrayBody bab = new ByteArrayBody(data,
                        System.currentTimeMillis() + "_profile.jpg");
                multipartEntity.addPart("photo", bab);
            } /*else if (file != null && file.exists()) {
                // or Using path
                multipartEntity.addPart("photo", new FileBody(file));
            }*/



        } catch (UnsupportedEncodingException e) {
            e.printStackTrace();
        }

        // Call Api
        callApi(url, multipartEntity);
    }




    private ProgressDialog pDialog;


    private void callApi(final String url, final MultipartEntity entity) {

        AsyncTask<Void, Void, String> task = new AsyncTask<Void, Void, String>() {

            @Override
            protected void onPreExecute() {
                super.onPreExecute();
                pDialog = new ProgressDialog(Registration.this);
                pDialog.setMessage("Please wait...");
                pDialog.setIndeterminate(false);
                pDialog.setCancelable(false);
                pDialog.show();
            }

            @Override
            protected String doInBackground(Void... params) {
                return new JSONParser().makeImageUploadHttpRequest(url, entity);
            }

            @Override
            protected void onPostExecute(String result) {
                super.onPostExecute(result);
                pDialog.dismiss();
                if (result != null && result.length() > 0) {
                    doAfterImageUpload(result);
                } else {
                    showToast("Photo is not uploaded!");
                }
            }

        };

        task.execute();
    }

    private void doAfterImageUpload(String response) {
        System.out.println("Image upload result : " + response);
        showToast("Registrartion Successfully!");
        Intent i=new Intent(Registration.this,Login.class);
        startActivity(i);
        finish();
    }


    private void showToast(String message) {
        Toast.makeText(getApplicationContext(), message, Toast.LENGTH_SHORT)
                .show();
    }


}






