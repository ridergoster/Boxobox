package com.vincent.boxobox;

import android.os.AsyncTask;
import android.support.v4.app.Fragment;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.view.View.OnClickListener;
import java.io.BufferedReader;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.URL;
import java.io.IOException;
import android.widget.TextView;

/**
 * Created by Vincentk on 29/09/15
 * edit on 30/09/15
 */

public class utilitaire_fragment extends Fragment implements OnClickListener {

    View rootview;
    Button buttontemp;
    TextView temptext;
    String data;

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        rootview = inflater.inflate(R.layout.utilitaire_layout, container, false);
        buttontemp = (Button) rootview.findViewById(R.id.buttontemp);
        temptext = (TextView) rootview.findViewById(R.id.texttemp);
        buttontemp.setOnClickListener(this);
        return rootview;
    }


    // Mise en place des bouttons d'action avec listener + switch pour différencier les actions
    @Override
    public void onClick(View v) {

        switch (v.getId()) {
            case R.id.buttontemp:
                data = "°C";
                new HttpDownloadAsync().execute("http://boxobox.ddns.net/android.php/?hi=t");
                temptext.setText("Loading...");
                break;
            default:
                break;
        }
    }



    public String downloadData(String url, int timeout) throws IOException {
        URL obj = new URL(url);
        HttpURLConnection con = (HttpURLConnection) obj.openConnection();

        BufferedReader in = new BufferedReader(
                new InputStreamReader(con.getInputStream()));

        String inputLine;
        StringBuffer response = new StringBuffer();

        while ((inputLine = in.readLine()) != null) {
            response.append(inputLine);
        }
        in.close();

        return response.toString();

    }

    private class HttpDownloadAsync extends AsyncTask<String, Void, String> {


        @Override
        protected String doInBackground(String... params) {
            String result;
            try {
                result = downloadData(params[0],2000);
            } catch (IOException e) {
                e.printStackTrace();
                result = "false";
            }
            return result;
        }

        // onPostExecute displays the results of the AsyncTask.
        @Override
        protected void onPostExecute(String result) {
            temptext.setText(result+data);
        }
    }

}