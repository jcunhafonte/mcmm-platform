package net.majorkernelpanic.example3.activity;

import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.ImageView;

import com.daimajia.androidanimations.library.Techniques;
import com.daimajia.androidanimations.library.YoYo;

import net.majorkernelpanic.example3.R;


public class SplashScreen extends Activity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_splash);

        final ImageView logo = (ImageView) findViewById(R.id.logoSplash);
        logo.setVisibility(View.GONE);

        new android.os.Handler().postDelayed(
                new Runnable() {
                    public void run() {
                        logo.setVisibility(View.VISIBLE);
                        YoYo.with(Techniques.StandUp)
                                .duration(1500)
                                .playOn(findViewById(R.id.logoSplash));
                    }
                }, 200);

        new android.os.Handler().postDelayed(
                new Runnable() {
                    public void run() {
                        startActivity(new Intent(SplashScreen.this, LoginActivity.class));
                        overridePendingTransition(R.anim.abc_fade_in, R.anim.abc_fade_out);
                        finish();
                    }
                }, 2400);

//        //thread for splash screen running
//        Thread logoTimer = new Thread() {
//            public void run() {
//                try {
//                    sleep(1500);
//                } catch (InterruptedException e) {
//                    Log.d("Exception", "Exception" + e);
//                } finally {
//                    startActivity(new Intent(SplashScreen.this, LoginActivity.class));
//                    overridePendingTransition(R.anim.abc_fade_in, R.anim.abc_fade_out);
//                }
//                finish();
//            }
//        };
//        logoTimer.start();
    }

}
