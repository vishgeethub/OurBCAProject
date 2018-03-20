package com.example.vishal.project1;

import android.annotation.SuppressLint;
import android.content.Context;
import android.content.Intent;
import android.net.http.SslError;
import android.os.AsyncTask;
import android.os.Bundle;
import android.os.Handler;
import android.support.design.widget.FloatingActionButton;
import android.support.design.widget.Snackbar;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.Toolbar;
import android.util.Log;
import android.view.View;
import android.view.Window;
import android.webkit.SslErrorHandler;
import android.webkit.WebView;
import android.webkit.WebViewClient;
import android.widget.ProgressBar;
import android.widget.Toast;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.security.MessageDigest;
import java.security.NoSuchAlgorithmException;
import java.util.ArrayList;
import java.util.Collection;
import java.util.HashMap;
import java.util.Map;
import java.util.Random;

import java.util.logging.LogRecord;

@SuppressLint("SetJavaScriptEnabled")
public class PayUMoneyActivity extends AppCompatActivity {


   /*String merchant_key = "OygoFs";
    String salt = "BV1QBwCv";*/

    String merchant_key = "Yn1ZjwUG";
    String salt = "yoy4aYoHB4";


    String action1 = "";
    String base_url = "https://secure.payu.in";
    //String base_url = "https://test.payu.in";

    // int error = 0;
    // String hashString = "";
    // Map<String, String> params;
    String txnid = "";
    //Project1 application;
    //PatanjaliApplication application;
    //PatanjaliDatabase patanjaliDatabase;
    Double amount;
    String productInfo = "";
    String firstName = "";
    String emailId = "";

    private String SUCCESS_URL = "https://dl.dropboxusercontent.com/s/dtnvwz5p4uymjvg/success.html"; // Add the surl;
    private String FAILED_URL = "https://dl.dropboxusercontent.com/s/z69y7fupciqzr7x/furlWithParams.html";
    private String phone = "";
    private String serviceProvider = "payu_paisa";
    private String hash = "";

    Handler mHandler = new Handler();

    WebView webView;

    String urlpaymenttypewebservice = "";


    public static final String TAG_LOG_NAME = "ResponseOrder";
    public static final String TAG_CUSTOMER_ID = "customerid";
    public static final String TAG_TOTAL_AMOUNT = "totalamount";
    public static final String TAG_PAYMENT_MODE = "paymentmode";
    public static final String TAG_SHIP_ADD = "shipadd";
    public static final String TAG_CITY_ID = "cityid";
    public static final String TAG_AREA_ID = "areaid";
    public static final String TAG_MOB = "mob";
    public static final String TAG_ZIP_CODE = "pincode";
    public static final String TAG_ORDERDETAILS = "orderdetails";
    public static final String TAG_PRODUCT_ID = "productid";
    public static final String TAG_QTY = "qty";

    public static final String TAG_MESSAGE = "message";
    public static final String TAG_ORDERID = "orderid";
    public static final String TAG_STATUS = "status";
    ProgressBar progressBar;

    @SuppressLint("JavascriptInterface")
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        getWindow().requestFeature(Window.FEATURE_PROGRESS);
        super.onCreate(savedInstanceState);
        //setContentView(R.layout.activity_pay_umoney);
       /* Toolbar toolbar = (Toolbar) findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);

        FloatingActionButton fab = (FloatingActionButton) findViewById(R.id.fab);
        fab.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Snackbar.make(view, "Replace with your own action", Snackbar.LENGTH_LONG)
                        .setAction("Action", null).show();
            }
        });

*/

        progressBar = new ProgressBar(PayUMoneyActivity.this);
        progressBar.setVisibility(View.VISIBLE);
       // urlpaymenttypewebservice = GlobalLink.get_webservice_add_order();
        // patanjaliDatabase = new PatanjaliDatabase(this);
        //application = (PatanjaliApplication) getApplicationContext();
        //amount = application.getPayablePrice();
          amount=500d;
        //phone = getSharedPreferences(ActivityMain.PATANJALIPREF, MODE_PRIVATE).getString(ActivityMain.TAG_MOB, "");
        //firstName = getSharedPreferences(ActivityMain.PATANJALIPREF, MODE_PRIVATE).getString(ActivityMain.TAG_NAME, "");
        //emailId = getSharedPreferences(ActivityMain.PATANJALIPREF, MODE_PRIVATE).getString(ActivityMain.TAG_EMAIL, "");
        txnid = String.valueOf(System.currentTimeMillis());

        webView = new WebView(this);
        setContentView(webView);

        JSONObject productInfoObj = new JSONObject();
       JSONArray productPartsArr = new JSONArray();
        JSONObject productPartsObj1 = new JSONObject();
        JSONObject paymentIdenfierParent = new JSONObject();
        JSONArray paymentIdentifiersArr = new JSONArray();
        JSONObject paymentPartsObj1 = new JSONObject();
        JSONObject paymentPartsObj2 = new JSONObject();
        try {
            // Payment Parts

//            int id[] = patanjaliDatabase.getAllProductToCart();
//            for (int i = 0; i < id.length; i++) {
//                SpecialProductData dt = application.getModelSpecialProductDataProductName(id[i]);
//                JSONObject productPartsObj1 = new JSONObject();
//                productPartsObj1.put("name", dt.ProductName);
//                productPartsObj1.put("description","");
//                productPartsObj1.put("value", dt.OfferPrice);
//                productPartsObj1.put("isRequired", "true");
//                productPartsObj1.put("settlementEvent", "EmailConfirmation");
//
//
//
//                productPartsArr.put(productPartsObj1);
//            }

//            ArrayList<MyCartViewData> data = application.getModelMyCartViewDataList();
  //          for (int i = 0; i < data.size(); i++) {
    //            SpecialProductData dt = application.getModelSpecialProductDataProductName(data.get(i).productid);
      //          JSONObject productPartsObj1 = new JSONObject();
        //        productPartsObj1.put("name", dt.ProductName);
          //      productPartsObj1.put("description", "");
            //    productPartsObj1.put("value", dt.OfferPrice);
             //   productPartsObj1.put("isRequired", "true");
               // productPartsObj1.put("settlementEvent", "EmailConfirmation");


               // productPartsArr.put(productPartsObj1);
           // }

            productPartsObj1.put("name", "abc");
            productPartsObj1.put("description", "abcd");
            productPartsObj1.put("value", "1000");
            productPartsObj1.put("isRequired", "true");
            productPartsObj1.put("settlementEvent", "EmailConfirmation");



            productPartsArr.put(productPartsObj1);


           // productInfoObj.put("paymentParts", productPartsArr);

            // Payment Identifiers
            paymentPartsObj1.put("field", "CompletionDate");
            paymentPartsObj1.put("value", "31/10/2012");
            paymentIdentifiersArr.put(paymentPartsObj1);

            paymentPartsObj2.put("field", "TxnId");
            paymentPartsObj2.put("value", txnid);
            paymentIdentifiersArr.put(paymentPartsObj2);

            paymentIdenfierParent.put("paymentIdentifiers",
                    paymentIdentifiersArr);
            productInfoObj.put("", paymentIdenfierParent);
        } catch (JSONException e) {
            // TODO Auto-generated catch block
            e.printStackTrace();
        }

        productInfo = productInfoObj.toString();

        //Log.e("TAG", productInfoObj.toString());

        Random rand = new Random();
        String rndm = Integer.toString(rand.nextInt())
                + (System.currentTimeMillis() / 1000L);
        txnid = hashCal("SHA-256", rndm).substring(0, 20);

        hash = hashCal("SHA-512", merchant_key + "|" + txnid + "|" + amount
                + "|" + productInfo + "|" + firstName + "|" + emailId
                + "|||||||||||" + salt);

        action1 = base_url.concat("/_payment");

        webView.setWebViewClient(new WebViewClient() {

            @Override
            public void onReceivedError(WebView view, int errorCode,
                                        String description, String failingUrl) {
                // TODO Auto-generated method stub
            /*    Toast.makeText(PayUMoneyActivity.this, "Oh no! " + description,
                        Toast.LENGTH_SHORT).show();*/
            }

            @Override
            public void onReceivedSslError(WebView view,
                                           SslErrorHandler handler, SslError error) {
                // TODO Auto-generated method stub
               /* Toast.makeText(PayUMoneyActivity.this, "SslError! " + error,
                        Toast.LENGTH_SHORT).show();*/
                handler.proceed();
            }

            @Override
            public boolean shouldOverrideUrlLoading(WebView view, String url) {
                /*Toast.makeText(PayUMoneyActivity.this, "Page Started! " + url,
                        Toast.LENGTH_SHORT).show();*/
                if (url.equals(SUCCESS_URL)) {
    //                callPaymentTypeWebservice = new CallPaymentTypeWebservice();
      //              callPaymentTypeWebservice.execute();

                } else {

                   /* Toast.makeText(PayUMoneyActivity.this, "Failure! " + url,
                            Toast.LENGTH_SHORT).show();*/
                }
                return super.shouldOverrideUrlLoading(view, url);
            }
            //
            // @Override
            // public void onPageFinished(WebView view, String url) {
            // super.onPageFinished(view, url);
            //
            // Toast.makeText(PayMentGateWay.this, "" + url,
            // Toast.LENGTH_SHORT).show();
            // }
        });

        webView.setVisibility(View.VISIBLE);
        webView.getSettings().setBuiltInZoomControls(true);
        webView.getSettings().setCacheMode(2);
        webView.getSettings().setDomStorageEnabled(true);
        webView.clearHistory();
        webView.clearCache(true);
        webView.getSettings().setJavaScriptEnabled(true);
        webView.getSettings().setSupportZoom(true);
        webView.getSettings().setUseWideViewPort(false);
        webView.getSettings().setLoadWithOverviewMode(false);

        webView.addJavascriptInterface(new PayUJavaScriptInterface(PayUMoneyActivity.this),
                "PayUMoney");
        Map<String, String> mapParams = new HashMap<String, String>();
        mapParams.put("key", merchant_key);
        mapParams.put("hash", hash);
        mapParams.put("txnid", txnid);
        mapParams.put("service_provider", "payu_paisa");
        mapParams.put("amount", String.valueOf(amount));
        mapParams.put("firstname", firstName);
        mapParams.put("email", emailId);
        mapParams.put("phone", phone);

        mapParams.put("productinfo", productInfo);
        mapParams.put("surl", SUCCESS_URL);
        mapParams.put("furl", FAILED_URL);
        mapParams.put("lastname", "");

        mapParams.put("address1", "");
        mapParams.put("address2", "");
        mapParams.put("city", "");
        mapParams.put("state", "");

        mapParams.put("country", "");
        mapParams.put("zipcode", "");
        mapParams.put("udf1", "");
        mapParams.put("udf2", "");

        mapParams.put("udf3", "");
        mapParams.put("udf4", "");
        mapParams.put("udf5", "");
        // mapParams.put("pg", (empty(PayMentGateWay.this.params.get("pg"))) ?
        // ""
        // : PayMentGateWay.this.params.get("pg"));
        webview_ClientPost(webView, action1, mapParams.entrySet());


    }


    public class PayUJavaScriptInterface {
        Context mContext;

        /**
         * Instantiate the interface and set the context
         */
        PayUJavaScriptInterface(Context c) {
            mContext = c;
        }

        public void success(long id, final String paymentId) {

            mHandler.post(new Runnable() {

                public void run() {
                    mHandler = null;

                 /*  Toast.makeText(PayUMoneyActivity.this, "Success",
                            Toast.LENGTH_SHORT).show();*/
                }
            });
        }
    }

    public void webview_ClientPost(WebView webView, String url,
                                   Collection<Map.Entry<String, String>> postData) {
        StringBuilder sb = new StringBuilder();

        sb.append("<html><head></head>");
        sb.append("<body onload='form1.submit()'>");
        sb.append(String.format("<form id='form1' action='%s' method='%s'>",
                url, "post"));
        for (Map.Entry<String, String> item : postData) {
            sb.append(String.format(
                    "<input name='%s' type='hidden' value='%s' />",
                    item.getKey(), item.getValue()));
        }
        sb.append("</form></body></html>");

        webView.loadData(sb.toString(), "text/html", "utf-8");
    }

    public boolean empty(String s) {
        if (s == null || s.trim().equals(""))
            return true;
        else
            return false;
    }

    public String hashCal(String type, String str) {
        byte[] hashseq = str.getBytes();
        StringBuffer hexString = new StringBuffer();
        try {
            MessageDigest algorithm = MessageDigest.getInstance(type);
            algorithm.reset();
            algorithm.update(hashseq);
            byte messageDigest[] = algorithm.digest();

            for (int i = 0; i < messageDigest.length; i++) {
                String hex = Integer.toHexString(0xFF & messageDigest[i]);
                if (hex.length() == 1)
                    hexString.append("0");
                hexString.append(hex);
            }
        } catch (NoSuchAlgorithmException nsae) {
        }
        return hexString.toString();

    }



}
