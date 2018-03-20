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

public class Change_Password extends AppCompatActivity {

    ProgressDialog pd;
    SharedPreferences sp;
    EditText op,np,rp;
    String loginid,oldpd,newpd;
    Button submit;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_change__password);
        op=(EditText)findViewById(R.id.editText);
        np=(EditText)findViewById(R.id.editText1);
        rp=(EditText)findViewById(R.id.editText2);
        submit=(Button) findViewById(R.id.button);


        sp = getSharedPreferences("mypref", 0);
        loginid = sp.getString("loginid","").toString();
        submit.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                String newpsd=np.getText().toString();
                String rpsd=rp.getText().toString();
                if(newpsd.equals(rpsd))
                {
                    new ChangePassword().execute();

                }
                else
                {
                    rp.setError("Password Not Matched");
                }

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
            Intent i=new Intent(Change_Password.this,Welcome.class);
            startActivity(i);
            finish();
        }
        return super.onOptionsItemSelected(item);
    }
    class ChangePassword extends AsyncTask<Void,Void,Void>
    {
        String result;
        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            oldpd=op.getText().toString();
            newpd=np.getText().toString();
            pd=new ProgressDialog(Change_Password.this);
            pd.setTitle("Profile Details");
            pd.setMessage("Fetching Data...");
            pd.show();
        }

        @Override
        protected Void doInBackground(Void... params) {
            UserFunctions obj=new UserFunctions();
            result = obj.changepassword(loginid,oldpd,newpd);
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
                if(msg.equals("0"))
                {
                    Toast.makeText(Change_Password.this, "Password Not Changed", Toast.LENGTH_SHORT).show();
                }
                else
                {
                    Toast.makeText(Change_Password.this, "Password Changed Successfully!!", Toast.LENGTH_LONG).show();
                    Intent i=new Intent(Change_Password.this,Welcome.class);
                    startActivity(i);
                    finish();
                }

            }catch (JSONException e) {
                e.printStackTrace();
            }
        }
    }
}
