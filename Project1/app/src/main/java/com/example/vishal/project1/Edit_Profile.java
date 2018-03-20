package com.example.vishal.project1;

import android.app.ProgressDialog;
import android.content.Intent;
import android.content.SharedPreferences;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.net.Uri;
import android.os.AsyncTask;
import android.provider.MediaStore;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.Toast;

import org.apache.http.entity.mime.MultipartEntity;
import org.apache.http.entity.mime.content.ByteArrayBody;
import org.apache.http.entity.mime.content.StringBody;

import java.io.ByteArrayOutputStream;
import java.io.IOException;
import java.io.InputStream;
import java.io.UnsupportedEncodingException;
import java.net.HttpURLConnection;
import java.net.URL;

public class Edit_Profile extends AppCompatActivity {
     int flag=0;
    SharedPreferences shp;
    EditText add,phno;
    String adds,phone,pic;
    ImageView iv;
    Button submitbtn,profilepicbtn;
    SharedPreferences sp;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_edit__profile);
        Intent i=getIntent();
        Bundle b=i.getExtras();
        adds=b.getString("add");
        phone=b.getString("phno");
        pic=b.getString("image");
        add=(EditText)findViewById(R.id.editText);
        phno=(EditText)findViewById(R.id.editText1);
        iv=(ImageView)findViewById(R.id.imageView);
          submitbtn=(Button)findViewById(R.id.button);
        profilepicbtn=(Button)findViewById(R.id.button1);
        shp=getSharedPreferences("mypref",0);

        submitbtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                sendDataToServer();
            }
        });

        profilepicbtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                final int PICK_IMAGE_REQUEST = 1234;

                Intent intent = new Intent();
                intent.setType("image/*");
                intent.setAction(Intent.ACTION_GET_CONTENT);
                startActivityForResult(Intent.createChooser(intent, "Select Picture"), PICK_IMAGE_REQUEST);

            }
        });


        add.setText(adds);
        phno.setText(phone);

        String path = GlobalVariables.SERVER_IP + GlobalVariables.API_FOLDER+pic.trim();
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
                 */   iv.setImageBitmap(myBitmap);
        }
        catch(Exception e)
        {
            Log.i("Error",e.toString());

        }

    }

    Bitmap bitmap=null;
    protected void onActivityResult(int requestCode, int resultCode, Intent data) {
        super.onActivityResult(requestCode, resultCode, data);

        if (requestCode == 1234 && resultCode == RESULT_OK && data != null && data.getData() != null) {

            Uri uri = data.getData();

            try {
                bitmap = MediaStore.Images.Media.getBitmap(getContentResolver(), uri);
                iv.setImageBitmap(bitmap);
            } catch (IOException e) {
                e.printStackTrace();
            }
        }
    }


    String url=GlobalVariables.SERVER_IP + GlobalVariables.API_FOLDER
            + "w_updateprofile.php";

    @SuppressWarnings("deprecation")
    private void sendDataToServer() {
        MultipartEntity multipartEntity = new MultipartEntity();
        try {
            multipartEntity.addPart("rid", new StringBody(shp.getString("id","")));

            multipartEntity.addPart("address", new StringBody(add.getText().toString()));
            multipartEntity.addPart("phone", new StringBody(phno.getText().toString()));



            if (bitmap != null) {
                ByteArrayOutputStream bos = new ByteArrayOutputStream();
                bitmap.compress(Bitmap.CompressFormat.JPEG, 100, bos);
                byte[] data = bos.toByteArray();
                ByteArrayBody bab = new ByteArrayBody(data,
                        System.currentTimeMillis() + "_profile.jpg");
                multipartEntity.addPart("photo", bab);
            }
            else
            {

            }
            /*else if (file != null && file.exists()) {
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
                pDialog = new ProgressDialog(Edit_Profile.this);
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
        showToast("Profile Updated Successfully!");
        Intent i=new Intent(Edit_Profile.this,Profile.class);
        startActivity(i);
        finish();
    }


    private void showToast(String message) {
        Toast.makeText(getApplicationContext(), message, Toast.LENGTH_SHORT)
                .show();
    }


}
