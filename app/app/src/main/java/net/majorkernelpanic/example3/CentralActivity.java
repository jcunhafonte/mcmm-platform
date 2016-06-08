package net.majorkernelpanic.example3;

import android.content.Intent;
import android.graphics.Color;
import android.os.Build;
import android.os.Bundle;
import android.support.design.widget.TabLayout;
import android.support.v4.view.GravityCompat;
import android.support.v4.view.ViewPager;
import android.support.v4.widget.DrawerLayout;
import android.support.v7.app.ActionBarDrawerToggle;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.Toolbar;
import android.util.Log;
import android.view.Menu;
import android.view.MenuInflater;
import android.view.MenuItem;
import android.view.View;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.gordonwong.materialsheetfab.MaterialSheetFab;
import com.gordonwong.materialsheetfab.MaterialSheetFabEventListener;

import net.majorkernelpanic.example3.activity.Profile;
import net.majorkernelpanic.example3.adapters.MainPagerAdapter;
import net.majorkernelpanic.example3.app.AppConfig;
import net.majorkernelpanic.example3.app.AppController;
import net.majorkernelpanic.example3.helper.SQLiteHandler;
import net.majorkernelpanic.example3.helper.SessionManager;

import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;
import java.util.Map;

/**
 * Created by Gordon Wong on 7/17/2015.
 * <p/>
 * Main activity for material sheet fab sample.
 */
public class CentralActivity extends AppCompatActivity implements View.OnClickListener {

    private ActionBarDrawerToggle drawerToggle;
    private DrawerLayout drawerLayout;
    private MaterialSheetFab materialSheetFab;
    private int statusBarColor;
    private static final String TAG = MainActivity.class.getSimpleName();
    public SQLiteHandler db;
    public SessionManager session;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setTitle(R.string.notes);
        setContentView(R.layout.central_main);
        setupActionBar();
        setupDrawer();
        setupFab();
        setupTabs();

        // SQLite database handler
        db = new SQLiteHandler(getApplicationContext());
        // Session manager
        session = new SessionManager(getApplicationContext());

        HashMap<String, String> user = db.getUserDetails();
        String email = user.get("email");
        obterIdUtilizador(email);

    }

    @Override
    protected void onPostCreate(Bundle savedInstanceState) {
        super.onPostCreate(savedInstanceState);
//		drawerToggle.syncState();
    }

    @Override
    public void onBackPressed() {
        if (materialSheetFab.isSheetVisible()) {
            materialSheetFab.hideSheet();
        } else {
            super.onBackPressed();
        }
    }

    /**
     * Sets up the action bar.
     */
    private void setupActionBar() {
        setSupportActionBar((Toolbar) findViewById(R.id.toolbar));
        getSupportActionBar().setDisplayHomeAsUpEnabled(false);
    }

    /**
     * Sets up the navigation drawer.
     */
    private void setupDrawer() {
        drawerLayout = (DrawerLayout) findViewById(R.id.drawer_layout);
//		drawerToggle = new ActionBarDrawerToggle(this, drawerLayout, R.string.opendrawer,
//				R.string.closedrawer);
//		drawerLayout.setDrawerListener(drawerToggle);
    }

    /**
     * Sets up the tabs.
     */
    private void setupTabs() {
        // Setup view pager
        ViewPager viewpager = (ViewPager) findViewById(R.id.viewpager);
        viewpager.setAdapter(new MainPagerAdapter(this, getSupportFragmentManager()));
        viewpager.setOffscreenPageLimit(MainPagerAdapter.NUM_ITEMS);
        updatePage(viewpager.getCurrentItem());

        // Setup tab layout
        TabLayout tabLayout = (TabLayout) findViewById(R.id.tabs);
        tabLayout.setupWithViewPager(viewpager);
        tabLayout.setSelectedTabIndicatorColor(Color.parseColor("#FFFFFF"));

        for (int i = 0; i < tabLayout.getTabCount(); i++) {
            switch (i) {
                case 0:
                    tabLayout.getTabAt(i).setIcon(R.drawable.ic_action_projetos);
                    break;
                case 1:
                    tabLayout.getTabAt(i).setIcon(R.drawable.ic_action_projetos);
                    break;
                case 2:
                    tabLayout.getTabAt(i).setIcon(R.drawable.ic_action_videos);
                    break;
            }
        }

        viewpager.addOnPageChangeListener(new ViewPager.OnPageChangeListener() {
            @Override
            public void onPageScrolled(int i, float v, int i1) {
            }

            @Override
            public void onPageSelected(int i) {
                updatePage(i);
            }

            @Override
            public void onPageScrollStateChanged(int i) {
            }
        });
    }

    /**
     * Sets up the Floating action button.
     */
    private void setupFab() {

        Fab fab = (Fab) findViewById(R.id.fab);
        View sheetView = findViewById(R.id.fab_sheet);
        View overlay = findViewById(R.id.overlay);
        int sheetColor = getResources().getColor(R.color.text_white_87);
        int fabColor = getResources().getColor(R.color.text_white_87);

        // Create material sheet FAB
        materialSheetFab = new MaterialSheetFab<>(fab, sheetView, overlay, sheetColor, fabColor);

        // Set material sheet event listener
        materialSheetFab.setEventListener(new MaterialSheetFabEventListener() {
            @Override
            public void onShowSheet() {
                // Save current status bar color
                statusBarColor = getStatusBarColor();
                // Set darker status bar color to match the dim overlay
                setStatusBarColor(getResources().getColor(R.color.theme_primary_dark2));
            }

            @Override
            public void onHideSheet() {
                // Restore status bar color
                setStatusBarColor(statusBarColor);
            }
        });

        // Set material sheet item click listeners
        findViewById(R.id.fab_sheet_item_recording).setOnClickListener(this);
        findViewById(R.id.fab_sheet_item_note).setOnClickListener(this);
    }

    /**
     * Called when the selected page changes.
     *
     * @param selectedPage selected page
     */
    private void updatePage(int selectedPage) {
        updateFab(selectedPage);
        updateSnackbar(selectedPage);
    }

    /**
     * Updates the FAB based on the selected page
     *
     * @param selectedPage selected page
     */
    private void updateFab(int selectedPage) {
        switch (selectedPage) {
            case MainPagerAdapter.ALL_POS:
                materialSheetFab.showFab();
                break;
            case MainPagerAdapter.SHARED_POS:
                materialSheetFab.showFab();
                break;
            case MainPagerAdapter.FAVORITES_POS:
            default:
                materialSheetFab.showFab();
                break;
        }
    }

    /**
     * Updates the snackbar based on the selected page
     *
     * @param selectedPage selected page
     */
    private void updateSnackbar(int selectedPage) {
        View snackbar = findViewById(R.id.snackbar);
        switch (selectedPage) {
            case MainPagerAdapter.SHARED_POS:
                snackbar.setVisibility(View.GONE);
                break;
            case MainPagerAdapter.ALL_POS:
                snackbar.setVisibility(View.GONE);

            case MainPagerAdapter.FAVORITES_POS:
            default:
                snackbar.setVisibility(View.GONE);
                break;
        }
    }

    /**
     * Toggles opening/closing the drawer.
     */
    private void toggleDrawer() {
        if (drawerLayout.isDrawerVisible(GravityCompat.START)) {
            drawerLayout.closeDrawer(GravityCompat.START);
        } else {
            drawerLayout.openDrawer(GravityCompat.START);
        }
    }

    @Override
    public void onClick(View v) {
        switch (v.getId()) {
            case R.id.fab_sheet_item_recording:

                break;
            case R.id.fab_sheet_item_note:
                Intent intent = new Intent(CentralActivity.this,
                        net.majorkernelpanic.example3.MainActivity.class);
                overridePendingTransition(R.anim.abc_fade_in, R.anim.abc_fade_out);
                startActivity(intent);
                finish();
                break;
            default:
                break;
        }

        materialSheetFab.hideSheet();
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        MenuInflater inflater = getMenuInflater();
        inflater.inflate(R.menu.menu_main, menu);
        return super.onCreateOptionsMenu(menu);
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        Toast.makeText(getApplicationContext(), "STRING MESSAGE", Toast.LENGTH_LONG).show();

        switch (item.getItemId()) {
            case android.R.id.home:
//			toggleDrawer();
                return true;
            case R.id.menu_main_search:
                Intent intent = new Intent(CentralActivity.this, Profile.class);
                startActivity(intent);
                finish();
            default:
                return super.onOptionsItemSelected(item);
        }
    }

    private int getStatusBarColor() {
        if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.LOLLIPOP) {
            return getWindow().getStatusBarColor();
        }
        return 0;
    }

    private void setStatusBarColor(int color) {
        if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.LOLLIPOP) {
            getWindow().setStatusBarColor(color);
        }
    }


    public void obterIdUtilizador(final String emailObterID) {
        // Tag used to cancel the request
        String tag_string_req = "req_login";

        StringRequest strReq = new StringRequest(
                Request.Method.POST,
                AppConfig.obterIdUtilizadorURL, new Response.Listener<String>() {

            @Override
            public void onResponse(String response) {
                Log.d(TAG, "Login Response: " + response.toString());
                try {
                    JSONObject jObj = new JSONObject(response);
                    boolean error = jObj.getBoolean("error");

                    // Check for error node in json
                    if (!error) {
                        // user successfully logged in
                        JSONObject user = jObj.getJSONObject("user");
                        AppConfig.idUtilizador = user.getString("idUtilizador");
                        AppConfig.novoIdVideo = user.getString("idTransmissaoStream");
                    } else {
                        // Error in login. Get the error message
                        String errorMsg = jObj.getString("error_msg");
                        Toast.makeText(getApplicationContext(),
                                errorMsg, Toast.LENGTH_LONG).show();
                    }
                } catch (JSONException e) {
                    // JSON error
                    e.printStackTrace();
                    Toast.makeText(getApplicationContext(), "Json error: " +
                            e.getMessage(), Toast.LENGTH_LONG).show();
                }

            }
        }, new Response.ErrorListener() {

            @Override
            public void onErrorResponse(VolleyError error) {
                Log.e(TAG, "Login Error: " + error.getMessage());
                Toast.makeText(getApplicationContext(),
                        error.getMessage(), Toast.LENGTH_LONG).show();
            }
        }) {

            @Override
            protected Map<String, String> getParams() {
                // Posting parameters to login url
                Map<String, String> params = new HashMap<String, String>();
                params.put("email", emailObterID);

                return params;
            }

        };
        // Adding request to request queue
        AppController.getInstance().addToRequestQueue(strReq, tag_string_req);
    }

}
