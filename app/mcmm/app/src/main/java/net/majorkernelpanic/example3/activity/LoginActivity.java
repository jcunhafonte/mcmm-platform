package net.majorkernelpanic.example3.activity;

import android.app.Activity;
import android.app.ProgressDialog;
import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.net.Uri;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.Toast;

import com.android.volley.Request.Method;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.dd.processbutton.iml.ActionProcessButton;

import net.majorkernelpanic.example3.R;
import net.majorkernelpanic.example3.app.AppConfig;
import net.majorkernelpanic.example3.app.AppController;
import net.majorkernelpanic.example3.helper.SQLiteHandler;
import net.majorkernelpanic.example3.helper.SessionManager;
import net.majorkernelpanic.example3.utils.ProgressGenerator;

import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;
import java.util.Map;

public class LoginActivity extends Activity implements ProgressGenerator.OnCompleteListener {

    public static final String MyPREFERENCES = "MyPrefs";
    public static final String Email = "emailKey";

    SharedPreferences sharedpreferences;

    private static final String TAG = RegisterActivity.class.getSimpleName();
    private Button btnLogin;
    private Button btnLinkToRegister;
    private EditText inputEmail;
    private EditText inputPassword;
    private ProgressDialog pDialog;
    private SessionManager session;
    private SQLiteHandler db;

    public static final String EXTRAS_ENDLESS_MODE = "EXTRAS_ENDLESS_MODE";

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);

        inputEmail = (EditText) findViewById(R.id.email);
        inputPassword = (EditText) findViewById(R.id.password);

        Button registarWesee = (Button) findViewById(R.id.botaoRegistar);
        Button esqueceuPP = (Button) findViewById(R.id.esqueceupalavrapasse);
        ImageView interrogacao = (ImageView) findViewById(R.id.duvidas);

        registarWesee.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                startActivity(new Intent(Intent.ACTION_VIEW).setData(Uri.parse("http://178.62.86.141/")));
            }
        });

        esqueceuPP.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                startActivity(new Intent(Intent.ACTION_VIEW).setData(Uri.parse("http://178.62.86.141/")));
            }
        });

        interrogacao.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                startActivity(new Intent(Intent.ACTION_VIEW).setData(Uri.parse("http://178.62.86.141/faq")));
            }
        });

        // Progress dialog
        pDialog = new ProgressDialog(this);
        pDialog.setCancelable(false);

        // SQLite database handler
        db = new SQLiteHandler(getApplicationContext());

        // Session manager
        session = new SessionManager(getApplicationContext());

        // Check if user is already logged in or not
        if (session.isLoggedIn()) {
            // User is already logged in. Take him to main activity
            Intent intent = new Intent(LoginActivity.this,
                    net.majorkernelpanic.example3.CentralActivity.class);
            startActivity(intent);
            finish();
        }

        final ProgressGenerator progressGenerator = new ProgressGenerator(this);
        final ActionProcessButton btnLogin = (ActionProcessButton) findViewById(R.id.btnSignIn);
        Bundle extras = getIntent().getExtras();

        if (extras != null && extras.getBoolean(EXTRAS_ENDLESS_MODE)) {
            btnLogin.setMode(ActionProcessButton.Mode.ENDLESS);
        } else {
            btnLogin.setMode(ActionProcessButton.Mode.ENDLESS);
        }

        sharedpreferences = getSharedPreferences(MyPREFERENCES, Context.MODE_PRIVATE);

        inputEmail.setText(sharedpreferences.getString(Email, ""));

        // Login button Click Event
        btnLogin.setOnClickListener(new View.OnClickListener() {

            public void onClick(View view) {

                String email = inputEmail.getText().toString().trim();
                String password = inputPassword.getText().toString().trim();

                SharedPreferences.Editor editor = sharedpreferences.edit();

                editor.putString(Email, email);
                editor.commit();

                // Check for empty data in the form
                if (!email.isEmpty() && !password.isEmpty()) {
                    // login user
                    checkLogin(email, password);
                } else {
                    // Prompt user to enter credentials
                    Toast.makeText(getApplicationContext(),
                            "Insira os dados solicitados.", Toast.LENGTH_LONG)
                            .show();
                }
            }

        });
    }


    @Override
    public void onBackPressed() {
    }

    /**
     * function to verify login details in mysql db
     */
    public void checkLogin(final String email, final String password) {
        // Tag used to cancel the request
        String tag_string_req = "req_login";

        final ActionProcessButton btnLogin = (ActionProcessButton) findViewById(R.id.btnSignIn);
        btnLogin.setMode(ActionProcessButton.Mode.ENDLESS);

        btnLogin.setProgress(1);
        btnLogin.setEnabled(false);
        inputEmail.setEnabled(false);
        inputPassword.setEnabled(false);

        StringRequest strReq = new StringRequest(
                Method.POST,
                AppConfig.URL_LOGIN, new Response.Listener<String>() {

            @Override
            public void onResponse(String response) {
                Log.d(TAG, "Login Response: " + response.toString());
                hideDialog();
                try {
                    JSONObject jObj = new JSONObject(response);
                    boolean error = jObj.getBoolean("error");

                    // Check for error node in json
                    if (!error) {
                        // user successfully logged in

                        // Create login session
                        session.setLogin(true);

                        // Now store the user in SQLite
                        String uid = jObj.getString("uid");

                        JSONObject user = jObj.getJSONObject("user");
                        String name = user.getString("name");
                        String email = user.getString("email");
                        String created_at = user.getString("created_at");

                        // Inserting row in users table
                        db.addUser(name, email, uid, created_at);

                        // Launch main activity
                        Intent intent = new Intent(LoginActivity.this,
                                net.majorkernelpanic.example3.CentralActivity.class);
                        startActivity(intent);
                        overridePendingTransition(R.anim.abc_fade_in, R.anim.abc_fade_out);
                        finish();
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
                params.put("email", email);
                params.put("password", password);

                return params;
            }

        };

        // Adding request to request queue
        AppController.getInstance().addToRequestQueue(strReq, tag_string_req);
    }

    private void showDialog() {
        if (!pDialog.isShowing())
            pDialog.show();
    }

    private void hideDialog() {

        final ActionProcessButton btnLogin = (ActionProcessButton) findViewById(R.id.btnSignIn);
        btnLogin.setMode(ActionProcessButton.Mode.ENDLESS);

        btnLogin.setProgress(0);
        btnLogin.setEnabled(true);
        inputEmail.setEnabled(true);
        inputPassword.setEnabled(true);

        if (pDialog.isShowing())
            pDialog.dismiss();
    }

    @Override
    public void onComplete() {

    }
}
