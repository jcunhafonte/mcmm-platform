package net.majorkernelpanic.example3.activity;

import android.app.Activity;
import android.app.AlertDialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.Spinner;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.squareup.picasso.Picasso;

import net.majorkernelpanic.example3.R;
import net.majorkernelpanic.example3.app.AppConfig;
import net.majorkernelpanic.example3.app.AppController;
import net.majorkernelpanic.example3.helper.SQLiteHandler;
import net.majorkernelpanic.example3.helper.SessionManager;

import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;
import java.util.Map;
import java.util.regex.Matcher;
import java.util.regex.Pattern;

import de.hdodenhof.circleimageview.CircleImageView;

public class Profile extends Activity {

    private static final String TAG = Profile.class.getSimpleName();

    TextView nomeHeader;
    TextView emailHeader;

    TextView editarEmail;
    TextView editarNome;
    TextView editarRegisto;
    TextView editarVisita;
    TextView editarTransmissoes;
    TextView editarRecomendacoes;
    TextView editarVisualizacoes;

    Button sair;

    public SQLiteHandler db;
    public SessionManager session;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_profile);

        final Spinner staticSpinner = (Spinner) findViewById(R.id.static_spinner);
        ArrayAdapter<CharSequence> staticAdapter = ArrayAdapter
                .createFromResource(this, R.array.brew_array2, R.layout.estilospin2);
        // Specify the layout to use when the list of choices appears
        staticAdapter
                .setDropDownViewResource(R.layout.spinner_row2);

        // Apply the adapter to the spinner
        staticSpinner.setAdapter(staticAdapter);

        // SqLite database handler
        db = new SQLiteHandler(getApplicationContext());

        // session manager
        session = new SessionManager(getApplicationContext());

        final ImageView voltarSeta = (ImageView) findViewById(R.id.backRecord);
        voltarSeta.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(Profile.this, net.majorkernelpanic.example3.CentralActivity.class);
                startActivity(intent);
                finish();
            }
        });

        final AlertDialog.Builder builder = new AlertDialog.Builder(this, R.style.MyAlertDialogStyle);

        sair = (Button) findViewById(R.id.buttonSair);
        sair.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                builder
                        .setTitle("Terminar Sessão")
                        .setMessage("Tens a certeza que pretendes abandonar esta sessão?")
                        .setPositiveButton("Sim", new DialogInterface.OnClickListener() {
                            @Override
                            public void onClick(DialogInterface dialog, int which) {
                                logoutUser();
                            }

                        })
                        .setNegativeButton("Não", null)
                        .show();
            }
        });

        nomeHeader = (TextView) findViewById(R.id.nomeHeader);
        emailHeader = (TextView) findViewById(R.id.emailHeader);

        editarEmail = (TextView) findViewById(R.id.editarEmail);
        editarNome = (TextView) findViewById(R.id.editarNome);
        editarRegisto = (TextView) findViewById(R.id.editarRegisto);
        editarVisita = (TextView) findViewById(R.id.editarVisita);
        editarTransmissoes = (TextView) findViewById(R.id.editarTransmissoes);
        editarRecomendacoes = (TextView) findViewById(R.id.editarRecomendacoes);
        editarVisualizacoes = (TextView) findViewById(R.id.editarVisualizacoes);

        CircleImageView imageView = (CircleImageView) findViewById(R.id.image);

        String imageUrl = "http://wesee.diogosantos.pt/utilizadores/perfil/21.png";
        Picasso.with(getApplicationContext()).load(imageUrl)
                .placeholder(R.drawable.vinteecinco)
                .into(imageView);

        // Tag used to cancel the request
        String tag_string_req = "req_pub";

        String utVideoAtivo2 = AppConfig.idUtilizador;
        int utVideoAt2 = Integer.parseInt(utVideoAtivo2);
        String urlPub = "http://wesee.diogosantos.pt/android_login_api/perfil.php?utilizador=" + utVideoAt2;

        StringRequest strReq = new StringRequest(
                Request.Method.POST,
                urlPub, new Response.Listener<String>() {

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

                        nomeHeader.setText(user.getString("nome"));
                        emailHeader.setText(user.getString("email"));

                        editarNome.setText(user.getString("nome"));
                        editarEmail.setText(user.getString("email"));
                        editarRegisto.setText(user.getString("registo"));
                        editarVisita.setText(user.getString("ultima_visita"));
                        editarTransmissoes.setText(user.getString("transmissoes"));
                        editarRecomendacoes.setText(user.getString("recomendacoes"));
                        editarVisualizacoes.setText(user.getString("visualizacoes_perfil"));

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
                return params;
            }
        };
        // Adding request to request queue
        AppController.getInstance().addToRequestQueue(strReq, tag_string_req);

        staticSpinner.setOnItemSelectedListener(new AdapterView.OnItemSelectedListener() {
            @Override
            public void onItemSelected(AdapterView<?> parent, View view,
                                       int position, long id) {
//                Log.v("item", (String) parent.getItemAtPosition(position));
                if (position > 0) {
                    String text = staticSpinner.getSelectedItem().toString();

                    Pattern pattern = Pattern.compile("(\\d+)x(\\d+)\\D+(\\d+)\\D+(\\d+)");
                    Matcher matcher = pattern.matcher(text);

                    matcher.find();
                    int width = Integer.parseInt(matcher.group(1));
                    int height = Integer.parseInt(matcher.group(2));
                    int framerate = Integer.parseInt(matcher.group(3));
                    int bitrate = Integer.parseInt(matcher.group(4)) * 1000;

                    AppConfig.widthPerfil = width;
                    AppConfig.heightPerfil = height;
                    AppConfig.frameratePerfil = framerate;
                    AppConfig.bitratePerfil = bitrate;

                    Toast.makeText(Profile.this, AppConfig.widthPerfil + "x" + AppConfig.heightPerfil + " " +
                                    AppConfig.frameratePerfil + " FPS" + " " + AppConfig.bitratePerfil + " KPBS",
                            Toast.LENGTH_LONG).show();
                } else {
                    return;
                }
            }

            @Override
            public void onNothingSelected(AdapterView<?> parent) {
                // TODO Auto-generated method stub
            }
        });

    }

    private void logoutUser() {
        session.setLogin(false);
        db.deleteUsers();
        finish();
    }
}
