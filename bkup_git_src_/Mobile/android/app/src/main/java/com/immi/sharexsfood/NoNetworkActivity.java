package com.immi.sharexsfood;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;

public class NoNetworkActivity extends AppCompatActivity {
Button btnrfr;
    NoNetworkActivity self = this;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_no_network);
        btnrfr = (Button)findViewById(R.id.btnRfrsh);
        btnrfr.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent(self, MainActivity.class);
                startActivity(intent);
            }
        });
    }
}
