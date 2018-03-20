package com.example.vishal.project1;

import android.Manifest;
import android.content.Intent;
import android.content.pm.PackageManager;
import android.graphics.pdf.PdfDocument;
import android.os.Environment;
import android.support.v4.app.ActivityCompat;
import android.support.v4.content.ContextCompat;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.LinearLayout;
import android.widget.TextView;
import android.widget.Toast;

import java.io.File;
import java.io.FileOutputStream;
import java.io.OutputStream;
import java.util.StringTokenizer;

public class Receipt_Charity extends AppCompatActivity {

    LinearLayout ll;
    TextView uname,desc_ngoname,transaction_id,receipt,date,purpose,amount,contact,website,ngoname;
    private static final int REQUEST_WRITE_STORAGE = 112;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_receipt__charity);
        ll=(LinearLayout)findViewById(R.id.ll);
        uname=(TextView)findViewById(R.id.uname);
        desc_ngoname=(TextView)findViewById(R.id.desc_ngo_name);
        ngoname=(TextView)findViewById(R.id.ngo);
        date=(TextView)findViewById(R.id.date);
        purpose=(TextView)findViewById(R.id.purpose);
        amount=(TextView)findViewById(R.id.amount);
        website=(TextView)findViewById(R.id.website);
        transaction_id=(TextView)findViewById(R.id.transaction_id);
        receipt=(TextView)findViewById(R.id.receipt);
        contact=(TextView)findViewById(R.id.contact);

        Intent i=getIntent();
        Bundle b=i.getExtras();
        uname.setText(b.getString("uname"));
        desc_ngoname.setText("On behalf of '"+ b.getString("ngoname")+"',we would like to thank you for your generous donation.");
        ngoname.setText(b.getString("ngoname"));
        StringTokenizer st=new StringTokenizer(b.getString("date"),"-");
        String y=st.nextToken();
        String m=st.nextToken();
        String dt=st.nextToken();
        date.setText(dt+"-"+m+"-"+y);
        purpose.setText(b.getString("purpose"));
        amount.setText(b.getString("amount")+" Rs.");
        website.setText(b.getString("website"));
        transaction_id.setText(m+y+dt+b.getString("charityid"));
        receipt.setText("00000"+b.getString("charityid"));
        contact.setText(b.getString("phone"));


    }
    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        getMenuInflater().inflate(R.menu.menu_download,menu);
        return super.onCreateOptionsMenu(menu);
    }
    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        if(R.id.action_search==item.getItemId())
        {
            boolean hasPermission = (ContextCompat.checkSelfPermission(Receipt_Charity.this,
                    Manifest.permission.WRITE_EXTERNAL_STORAGE) == PackageManager.PERMISSION_GRANTED);
            if (!hasPermission) {
                ActivityCompat.requestPermissions(Receipt_Charity.this,
                        new String[]{Manifest.permission.WRITE_EXTERNAL_STORAGE},REQUEST_WRITE_STORAGE);
            }else {
                savePdf();
            }
        }
        return super.onOptionsItemSelected(item);
    }
    @Override
    public void onRequestPermissionsResult(int requestCode, String[] permissions, int[] grantResults) {
        super.onRequestPermissionsResult(requestCode, permissions, grantResults);
        switch (requestCode)
        {
            case REQUEST_WRITE_STORAGE: {
                if (grantResults.length > 0 && grantResults[0] == PackageManager.PERMISSION_GRANTED)
                {
                    savePdf();
                } else
                {
                    Toast.makeText(Receipt_Charity.this, "The app was not allowed to write to your storage. Hence, it cannot function properly. Please consider granting it this permission", Toast.LENGTH_LONG).show();
                }
            }
        }

    }

    private void savePdf(){
        // create a new document
        PdfDocument document = new PdfDocument();

        // crate a page description
        PdfDocument.PageInfo pageInfo = new PdfDocument.PageInfo.Builder(ll.getWidth(),ll.getHeight(),2).create();

        // start a page
        PdfDocument.Page page = document.startPage(pageInfo);

        // draw something on the page
        View content = ll;
        content.draw(page.getCanvas());

        // finish the page
        document.finishPage(page);

        // write the document content
//                document.writeTo(getOutputStream());
        File file = new File(Environment.getExternalStorageDirectory()+File.separator+"sample.pdf");
        try{
            if(!file.exists()){
                file.createNewFile();
            }
            OutputStream outputStream = new FileOutputStream(file);
            document.writeTo(outputStream);
            Toast.makeText(Receipt_Charity.this, "File saved..", Toast.LENGTH_SHORT).show();
        }catch (Exception e){
            Toast.makeText(Receipt_Charity.this, e.getMessage(), Toast.LENGTH_SHORT).show();
        }

        // close the document
        document.close();
    }

}
