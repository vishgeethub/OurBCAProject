package com.example.vishal.project1;

import android.app.ProgressDialog;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.AsyncTask;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import org.json.JSONException;
import org.json.JSONObject;

public class Feedback extends AppCompatActivity {

    SharedPreferences sp;
    ProgressDialog pd;
    String feedback,uid;
    Button fback;
    EditText txt_feedback;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_feedback);

        txt_feedback = (EditText) findViewById(R.id.feedback_txtbox);
        fback = (Button) findViewById(R.id.button_feedback);

        sp = getSharedPreferences("mypref", 0);
        uid = sp.getString("id", "").toString();

        fback.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

            }
        });
    }
    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        getMenuInflater().inflate(R.menu.menu_home,menu);

        return super.onCreateOptionsMenu(menu);

    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        if(R.id.home==item.getItemId())
        {
            Intent i=new Intent(Feedback.this,Welcome.class);
            startActivity(i);
            finish();
        }
        return super.onOptionsItemSelected(item);
    }
    class FeedbackClass extends AsyncTask<Void,Void,Void>
    {
        String result;
        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            pd=new ProgressDialog(Feedback.this);
            pd.setTitle("Charity");
            pd.setMessage("Wait...");
            pd.show();
            feedback=txt_feedback.getText().toString();
        }

        @Override
        protected Void doInBackground(Void... params) {
            UserFunctions obj=new UserFunctions();
            result=obj.feedback(uid,feedback);
            return null;
        }

        @Override
        protected void onPostExecute(Void aVoid) {
            super.onPostExecute(aVoid);
            String msg;
            JSONObject jobj= null;
            pd.dismiss();
            try {
                jobj = new JSONObject(result);
                msg = jobj.optString("messages").toString();
                if(msg.equals("Feedback Successfull"))
                {
                    Toast.makeText(Feedback.this,"Feedback Submitted", Toast.LENGTH_SHORT).show();
                    Intent i=new Intent(Feedback.this,Welcome.class);
                    startActivity(i);
                    finish();
                }
                else
                {
                    Toast.makeText(Feedback.this, "Error Occured!!Retry", Toast.LENGTH_LONG).show();
                }

            }catch (JSONException e) {
                e.printStackTrace();
            }
        }
    }
}
