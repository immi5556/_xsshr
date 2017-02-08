package com.immi.sharexsfood;

import android.content.Context;
import android.content.SharedPreferences;
import android.os.Build;

import java.util.UUID;

/**
 * Created by Immanuel Raj on 2/5/2017.
 */
public class SharedStorage {
    public static SharedPreferences sharedPfrs = null;
    public static Context appContext;
    public static String file_name = "XsFood";
    static SharedPreferences getSahredPrefs() {
        if (sharedPfrs == null) {
            sharedPfrs = appContext.getSharedPreferences(file_name,Context.MODE_PRIVATE);
        }
        return  sharedPfrs;
    }

    static void saveValues(String key, String value) {
        sharedPfrs = getSahredPrefs();
        SharedPreferences.Editor editor = sharedPfrs.edit();
        editor.putString(key, value);
        editor.commit();
    }
    static String getValue(String key) {
        sharedPfrs = getSahredPrefs();
        if (!sharedPfrs.contains(key)){
            return null;
        }
        return sharedPfrs.getString(key, "");
    }
    public static String getUniqueId() {
        String uid = getValue("XsUniqueId");
        if (uid == null){
            String suu = UUID.randomUUID().toString();
            suu = suu.replaceAll("-", "");
            saveValues("XsUniqueId", suu);
            uid = getValue("XsUniqueId");
        }
        return uid;
    }

    public static void setMobile(String val) {
        saveValues("XsMobileNo", val);
    }

    public static String getMobile() {
        String uid = getValue("XsMobileNo");
        if (uid == null){
            uid = "";
        }
        return uid;
    }

    public static void setName(String val) {
        saveValues("XsUserName", val);
    }

    public static String getName() {
        String uid = getValue("XsUserName");
        if (uid == null){
            uid = "";
        }
        return uid;
    }

    public static String getAndroidVersion() {
        String release = Build.VERSION.RELEASE;
        int sdkVersion = Build.VERSION.SDK_INT;
        return sdkVersion+"("+ release +")";
    }
}
