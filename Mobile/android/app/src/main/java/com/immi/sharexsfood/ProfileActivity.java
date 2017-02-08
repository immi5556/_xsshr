package com.immi.sharexsfood;

import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;

public class ProfileActivity extends AppCompatActivity {
    Button btnsave;
    Button btncancel;
    EditText name;
    EditText mob;
    ProfileActivity self = this;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_profile);
        btnsave = (Button)findViewById(R.id.btn_login);
        btncancel = (Button)findViewById(R.id.btn_back);
        name = (EditText)findViewById(R.id.input_name);
        mob = (EditText)findViewById(R.id.input_mob);
        mob.setText(SharedStorage.getMobile());
        name.setText(SharedStorage.getName());
        btnsave.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                SharedStorage.setMobile(mob.getText().toString());
                SharedStorage.setName(name.getText().toString());
                self.finish();
            }
        });
        btncancel.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                self.finish();
            }
        });
    }
}
