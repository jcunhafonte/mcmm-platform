package net.majorkernelpanic.example3.utils;

import android.annotation.SuppressLint;
import android.view.MotionEvent;
import android.view.View;
import android.view.View.OnTouchListener;

public class TouchEffect implements OnTouchListener {
    @SuppressLint({"ClickableViewAccessibility"})
    public boolean onTouch(View v, MotionEvent event) {
        if (event.getAction() == 0) {
            v.setAlpha(0.7f);
        } else if (event.getAction() == 1 || event.getAction() == 3) {
            v.setAlpha(1.0f);
        }
        return false;
    }
}
