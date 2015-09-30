package com.vincent.boxobox;

import android.support.v4.app.Fragment;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.view.View.OnClickListener;
import android.widget.TextView;

/**
 * Created by Vincentk on 29/09/15.
 */

public class utilitaire_fragment extends Fragment implements OnClickListener {

    View rootview;

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        rootview = inflater.inflate(R.layout.utilitaire_layout,container,false);
        Button buttontemp;
        buttontemp = (Button) rootview.findViewById(R.id.buttontemp);
        buttontemp.setOnClickListener(this);
        return rootview;
    }


    // Mise en place des bouttons d'action avec listener + switch pour différencier les actions
    @Override
    public void onClick(View v) {
        switch (v.getId()){
            case R.id.buttontemp :
                TextView texttemp  =(TextView)this.rootview.findViewById(R.id.texttemp);
                texttemp.setText("TEMP");
                break;
            default:
                break;
        }
    }
}
