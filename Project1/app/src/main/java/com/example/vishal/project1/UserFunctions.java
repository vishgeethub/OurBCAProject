package com.example.vishal.project1;

import java.util.ArrayList;
import java.util.List;
import java.util.jar.Attributes.Name;

import org.apache.http.NameValuePair;
import org.apache.http.message.BasicNameValuePair;

import android.content.SharedPreferences;
import android.util.Log;
import android.widget.Toast;

public class UserFunctions {

	JSONParser jsonParser;
	
	String checklogin=GlobalVariables.SERVER_IP + GlobalVariables.API_FOLDER
			+ "w_checklogin.php";

	String getcategory=GlobalVariables.SERVER_IP + GlobalVariables.API_FOLDER
			+ "w_getcategory.php";

	String getnews=GlobalVariables.SERVER_IP + GlobalVariables.API_FOLDER
			+ "w_getnews.php";

	String getstate=GlobalVariables.SERVER_IP + GlobalVariables.API_FOLDER
			+ "w_getstate.php";

	String getcity=GlobalVariables.SERVER_IP + GlobalVariables.API_FOLDER
			+ "w_getcity.php";

	String getarea=GlobalVariables.SERVER_IP + GlobalVariables.API_FOLDER
			+ "w_getarea.php";

	String getevent=GlobalVariables.SERVER_IP + GlobalVariables.API_FOLDER
			+ "w_getallevent.php";

	String getnewevent=GlobalVariables.SERVER_IP + GlobalVariables.API_FOLDER
			+ "w_getevent.php";

	String getuserdetails=GlobalVariables.SERVER_IP + GlobalVariables.API_FOLDER
			+ "w_getuserdetails.php";

	String getnewsdetails=GlobalVariables.SERVER_IP + GlobalVariables.API_FOLDER
			+ "w_getnewsdetails.php";

	String forgotpassword=GlobalVariables.SERVER_IP + GlobalVariables.API_FOLDER
			+ "w_forgotpassword.php";

	String changepassword=GlobalVariables.SERVER_IP + GlobalVariables.API_FOLDER
			+ "w_changepassword.php";

	String getngodetails=GlobalVariables.SERVER_IP + GlobalVariables.API_FOLDER
			+ "w_getngo.php";

	String regvolunteer=GlobalVariables.SERVER_IP + GlobalVariables.API_FOLDER
			+ "w_regvolunteer.php";

	String getvolunteerdetails=GlobalVariables.SERVER_IP + GlobalVariables.API_FOLDER
			+ "w_getvolunteerdetails.php";

	String getalbum=GlobalVariables.SERVER_IP + GlobalVariables.API_FOLDER
			+ "w_getalbum.php";

	String getcharity=GlobalVariables.SERVER_IP + GlobalVariables.API_FOLDER
			+ "w_getcharity.php";

	String geteventdetails=GlobalVariables.SERVER_IP + GlobalVariables.API_FOLDER
			+ "w_geteventdetails.php";

	String deletevolunteer=GlobalVariables.SERVER_IP + GlobalVariables.API_FOLDER
			+ "w_deletevolunteer.php";

	String getngoevent=GlobalVariables.SERVER_IP + GlobalVariables.API_FOLDER
			+ "w_getngoevent.php";

	String charity=GlobalVariables.SERVER_IP + GlobalVariables.API_FOLDER
			+ "w_charity.php";

	String getpictures=GlobalVariables.SERVER_IP + GlobalVariables.API_FOLDER
			+ "w_getpictures.php";

	String feedback=GlobalVariables.SERVER_IP + GlobalVariables.API_FOLDER
			+ "w_feedback.php";

	public UserFunctions() {
		jsonParser = new JSONParser();
	}


	public String checklogin(String l,String p)
	{
		List<NameValuePair> params=new ArrayList<NameValuePair>();
		params.add(new BasicNameValuePair("l", l));
		params.add(new BasicNameValuePair("p", p));
		String json=jsonParser.makeHttpRequest(checklogin, "POST", params);
		return json;
	}

	public String forgotpassword(String l)
	{
		List<NameValuePair> params=new ArrayList<NameValuePair>();
		params.add(new BasicNameValuePair("l", l));
		String json=jsonParser.makeHttpRequest(forgotpassword, "POST", params);
		return json;
	}

	public String getcharity(String uid)
	{
		List<NameValuePair> params=new ArrayList<NameValuePair>();
		params.add(new BasicNameValuePair("uid", uid));
		String json=jsonParser.makeHttpRequest(getcharity, "POST", params);
		return json;
	}

	public String charity(String nid,String uid,String amount,String adhar,String purpose)
	{
		List<NameValuePair> params=new ArrayList<NameValuePair>();
		params.add(new BasicNameValuePair("nid", nid));
		params.add(new BasicNameValuePair("uid", uid));
		params.add(new BasicNameValuePair("amount", amount));
		params.add(new BasicNameValuePair("adhar", adhar));
		params.add(new BasicNameValuePair("purpose", purpose));
		String json=jsonParser.makeHttpRequest(charity, "POST", params);
		return json;
	}

	public String feedback(String uid,String feedback)
	{
		List<NameValuePair> params=new ArrayList<NameValuePair>();
		params.add(new BasicNameValuePair("uid", uid));
		params.add(new BasicNameValuePair("feedback", feedback));
		String json=jsonParser.makeHttpRequest(feedback, "POST", params);
		return json;
	}

	public String getpictures(String aid)
	{
		List<NameValuePair> params=new ArrayList<NameValuePair>();
		params.add(new BasicNameValuePair("aid", aid));
		String json=jsonParser.makeHttpRequest(getpictures, "POST", params);
		return json;
	}

	public String getalbum(String eid)
	{
		List<NameValuePair> params=new ArrayList<NameValuePair>();
		params.add(new BasicNameValuePair("eid", eid));
		String json=jsonParser.makeHttpRequest(getalbum, "POST", params);
		return json;
	}

	public String regvolunteer(String eid,String uid)
	{
		List<NameValuePair> params=new ArrayList<NameValuePair>();
		params.add(new BasicNameValuePair("eid", eid));
		params.add(new BasicNameValuePair("uid", uid));
		String json=jsonParser.makeHttpRequest(regvolunteer, "POST", params);
		return json;
	}

	public String deletevolunteer(String eid,String uid)
	{
		List<NameValuePair> params=new ArrayList<NameValuePair>();
		params.add(new BasicNameValuePair("eid", eid));
		params.add(new BasicNameValuePair("uid", uid));
		String json=jsonParser.makeHttpRequest(deletevolunteer, "POST", params);
		return json;
	}

	public String changepassword(String l,String op,String newpd)
	{
		List<NameValuePair> params=new ArrayList<NameValuePair>();
		params.add(new BasicNameValuePair("l", l));
		params.add(new BasicNameValuePair("op", op));
		params.add(new BasicNameValuePair("newpd", newpd));
		String json=jsonParser.makeHttpRequest(changepassword, "POST", params);
		return json;
	}

	public String getcategory()
	{
		List<NameValuePair> params=new ArrayList<NameValuePair>();
		String json=jsonParser.makeHttpRequest(getcategory, "POST", params);
		return json;
	}

	public String getngodetails()
	{
		List<NameValuePair> params=new ArrayList<NameValuePair>();
		String json=jsonParser.makeHttpRequest(getngodetails, "POST", params);
		return json;
	}

	public String getnews() {
		List<NameValuePair> params=new ArrayList<NameValuePair>();
		String json=jsonParser.makeHttpRequest(getnews, "POST", params);
		return json;
	}

	public String getstate()
	{
		List<NameValuePair> params=new ArrayList<NameValuePair>();
		String json=jsonParser.makeHttpRequest(getstate, "POST", params);
		return json;
	}

	public String getcity(String stateid)
	{
		List<NameValuePair> params=new ArrayList<NameValuePair>();
		params.add(new BasicNameValuePair("stateid", stateid));
		String json=jsonParser.makeHttpRequest(getcity, "POST", params);
		return json;
	}

	public String getnewevent(String catid)
	{
		List<NameValuePair> params=new ArrayList<NameValuePair>();
		params.add(new BasicNameValuePair("catid", catid));
		String json=jsonParser.makeHttpRequest(getnewevent, "POST", params);
		return json;
	}

	public String getuserdetails(String uid)
	{
		List<NameValuePair> params=new ArrayList<NameValuePair>();
		params.add(new BasicNameValuePair("uid", uid));
		String json=jsonParser.makeHttpRequest(getuserdetails, "POST", params);
		return json;
	}

	public String getvolunteerdetails(String uid)
	{
		List<NameValuePair> params=new ArrayList<NameValuePair>();
		params.add(new BasicNameValuePair("uid", uid));
		String json=jsonParser.makeHttpRequest(getvolunteerdetails, "POST", params);
		return json;
	}
	public String geteventdetails(String eventid)
	{
		List<NameValuePair> params=new ArrayList<NameValuePair>();
		params.add(new BasicNameValuePair("eventid", eventid));
		String json=jsonParser.makeHttpRequest(geteventdetails, "POST", params);
		return json;
	}

	public String getngoevent(String ngoid)
	{
		List<NameValuePair> params=new ArrayList<NameValuePair>();
		params.add(new BasicNameValuePair("ngoid", ngoid));
		String json=jsonParser.makeHttpRequest(getngoevent, "POST", params);
		return json;
	}

	public String getnewsdetails(String newsid)
	{
		List<NameValuePair> params=new ArrayList<NameValuePair>();
		params.add(new BasicNameValuePair("newsid", newsid));
		String json=jsonParser.makeHttpRequest(getnewsdetails, "POST", params);
		return json;
	}

	public String getarea(String cityid)
	{
		List<NameValuePair> params=new ArrayList<NameValuePair>();
		params.add(new BasicNameValuePair("cityid", cityid));
		String json=jsonParser.makeHttpRequest(getarea, "POST", params);
		return json;
	}

	public String getevent()
	{
		List<NameValuePair> params=new ArrayList<NameValuePair>();
		String json=jsonParser.makeHttpRequest(getevent, "POST", params);
		return json;
	}
}
