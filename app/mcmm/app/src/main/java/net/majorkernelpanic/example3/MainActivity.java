package net.majorkernelpanic.example3;

import android.annotation.TargetApi;
import android.app.Activity;
import android.app.AlertDialog;
import android.app.ProgressDialog;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.SharedPreferences;
import android.content.SharedPreferences.Editor;
import android.graphics.Color;
import android.graphics.PorterDuff;
import android.graphics.Typeface;
import android.hardware.Camera;
import android.hardware.Camera.CameraInfo;
import android.location.Location;
import android.location.LocationListener;
import android.location.LocationManager;
import android.os.Build;
import android.os.Bundle;
import android.preference.PreferenceManager;
import android.provider.Settings;
import android.util.Log;
import android.view.MotionEvent;
import android.view.SurfaceHolder;
import android.view.View;
import android.view.View.OnClickListener;
import android.view.Window;
import android.view.WindowManager;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.EditText;
import android.widget.FrameLayout;
import android.widget.ImageButton;
import android.widget.ListView;
import android.widget.ProgressBar;
import android.widget.RadioGroup;
import android.widget.RadioGroup.OnCheckedChangeListener;
import android.widget.Spinner;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.VolleyLog;
import com.android.volley.toolbox.JsonArrayRequest;
import com.android.volley.toolbox.StringRequest;
import com.daimajia.androidanimations.library.Techniques;
import com.daimajia.androidanimations.library.YoYo;

import net.majorkernelpanic.example3.activity.Profile;
import net.majorkernelpanic.example3.adater.CustomListAdapter;
import net.majorkernelpanic.example3.app.AppConfig;
import net.majorkernelpanic.example3.app.AppController;
import net.majorkernelpanic.example3.helper.SQLiteHandler;
import net.majorkernelpanic.example3.helper.SessionManager;
import net.majorkernelpanic.example3.model.Movie;
import net.majorkernelpanic.streaming.Session;
import net.majorkernelpanic.streaming.SessionBuilder;
import net.majorkernelpanic.streaming.audio.AudioQuality;
import net.majorkernelpanic.streaming.gl.SurfaceView;
import net.majorkernelpanic.streaming.rtsp.RtspClient;
import net.majorkernelpanic.streaming.video.VideoQuality;
import net.majorkernelpanic.streaming.video.VideoStream;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;
import java.util.regex.Matcher;
import java.util.regex.Pattern;

public class MainActivity extends Activity implements
        OnClickListener,
        RtspClient.Callback,
        Session.Callback,
        SurfaceHolder.Callback,
        OnCheckedChangeListener,
        LocationListener {

    private static final String TAG = MainActivity.class.getSimpleName();

    private float mDist;

    private Button mButtonSave;
    private Button mButtonVideo;
    private ImageButton mButtonStart;
    private ImageButton mButtonFlash;
    private ImageButton mButtonCamera;
    private ImageButton mButtonSettings;
    private ImageButton mExitApp;
    private RadioGroup mRadioGroup;
    private FrameLayout mLayoutVideoSettings;
    private FrameLayout mLayoutServerSettings;
    private SurfaceView mSurfaceView;
    private TextView mTextBitrate;
    private EditText mEditTextURI;
    private EditText mEditTextPassword;
    private EditText mEditTextUsername;
    private EditText mTextoEditado;
    private TextView mBrincadeira;
    private EditText mTextoInseridoChat;
    private ProgressBar mProgressBar;
    private Session mSession;
    private RtspClient mClient;
    public static Typeface font_awesome;
    private TextView envMsg;
    public TextView pubVer;
    private TextView numeroPub;

    public int transmissaoON = 0;

    public SQLiteHandler db;
    public SessionManager session;

    private LocationManager locationManager;

    public Double latitudeObtiDA;
    public Double longitudeObtida;

    public String stringLatitudeObtida;
    public String stringLongitudeObtida;

    public boolean estadoTransmissao = false;

    // Movies json url
    private static String url = "http://wesee.diogosantos.pt/android_login_api/chatAPP.php";
    private ProgressDialog pDialog;
    private List<Movie> movieList = new ArrayList<Movie>();
    private ListView listView;
    private CustomListAdapter adapter;

    @TargetApi(Build.VERSION_CODES.LOLLIPOP)
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        getWindow().addFlags(WindowManager.LayoutParams.FLAG_KEEP_SCREEN_ON);
        requestWindowFeature(Window.FEATURE_NO_TITLE);
        this.requestWindowFeature(Window.FEATURE_NO_TITLE);

        setContentView(R.layout.main);

        getWindow().setStatusBarColor(Color.BLACK);

        locationManager = (LocationManager) getSystemService(Context.LOCATION_SERVICE);
        locationManager.requestLocationUpdates(LocationManager.NETWORK_PROVIDER, 200, 1, this);

        listView = (ListView) findViewById(R.id.list);
        adapter = new CustomListAdapter(this, movieList);
        listView.setAdapter(adapter);

        mButtonVideo = (Button) findViewById(R.id.video);
        mButtonSave = (Button) findViewById(R.id.save);
        mExitApp = (ImageButton) findViewById(R.id.exitapp);
        mButtonStart = (ImageButton) findViewById(R.id.start);
        mButtonFlash = (ImageButton) findViewById(R.id.flash);
        mButtonCamera = (ImageButton) findViewById(R.id.camera);
        mButtonSettings = (ImageButton) findViewById(R.id.settings);
        mSurfaceView = (SurfaceView) findViewById(R.id.surface);
        mEditTextURI = (EditText) findViewById(R.id.uri);
        mEditTextUsername = (EditText) findViewById(R.id.username);
        mEditTextPassword = (EditText) findViewById(R.id.password);
        mTextBitrate = (TextView) findViewById(R.id.bitrate);
        mBrincadeira = (TextView) findViewById(R.id.brincadeira);
        mTextoEditado = (EditText) findViewById(R.id.titTransmissao);
        mLayoutVideoSettings = (FrameLayout) findViewById(R.id.video_layout);
        mLayoutServerSettings = (FrameLayout) findViewById(R.id.server_layout);
        mRadioGroup = (RadioGroup) findViewById(R.id.radio);
        mProgressBar = (ProgressBar) findViewById(R.id.progress_bar);
        mTextoInseridoChat = (EditText) findViewById(R.id.chatTransmissao);

        font_awesome = Typeface.createFromAsset(getAssets(), "fontawesome-webfont.ttf");

        envMsg = (TextView) findViewById(R.id.iconeEnviaMsg);
        envMsg.setTypeface(font_awesome);

        pubVer = (TextView) findViewById(R.id.iconePublico);
        pubVer.setTypeface(font_awesome);

        numeroPub = (TextView) findViewById(R.id.numeroPub);

        envMsg.setOnClickListener(this);
        mRadioGroup.setOnCheckedChangeListener(this);
        mRadioGroup.setOnClickListener(this);

        mButtonStart.setOnClickListener(this);
        mButtonSave.setOnClickListener(this);
        mButtonFlash.setOnClickListener(this);
        mButtonCamera.setOnClickListener(this);
        mButtonVideo.setOnClickListener(this);
        mButtonSettings.setOnClickListener(this);
        mButtonFlash.setTag("off");

        // SqLite database handler
        db = new SQLiteHandler(getApplicationContext());

        // session manager
        session = new SessionManager(getApplicationContext());

        SharedPreferences mPrefs = PreferenceManager.getDefaultSharedPreferences(MainActivity.this);
        if (mPrefs.getString("uri", null) != null) mLayoutServerSettings.setVisibility(View.GONE);

        mEditTextURI.setText(mPrefs.getString("uri", getString(R.string.default_stream)));
        mEditTextPassword.setText(mPrefs.getString("password", ""));
        mEditTextUsername.setText(mPrefs.getString("username", ""));

        // Configures the SessionBuilder
        mSession = SessionBuilder.getInstance()
                .setContext(getApplicationContext())
                .setAudioEncoder(SessionBuilder.AUDIO_AAC)
                .setAudioQuality(new AudioQuality(8000, 16000))
                .setVideoEncoder(SessionBuilder.VIDEO_H264)
                .setSurfaceView(mSurfaceView)
                .setPreviewOrientation(0)
                .setCallback(this)
                .build();

        // Configures the RTSP client
        mClient = new RtspClient();
        mClient.setSession(mSession);
        mClient.setCallback(this);

        // Use this to force streaming with the MediaRecorder API
//		mSession.getVideoTrack().setStreamingMethod(MediaStream.MODE_MEDIARECORDER_API);

        // Use this to stream over TCP, EXPERIMENTAL!
        mClient.setTransportMode(RtspClient.TRANSPORT_TCP);

        // Use this if you want the aspect ratio of the surface view to
        // respect the aspect ratio of the camera preview
//		mSurfaceView.setAspectRatioMode(SurfaceView.ASPECT_RATIO_PREVIEW);

        mSurfaceView.getHolder().addCallback(this);

        selectQuality(AppConfig.widthPerfil,AppConfig.heightPerfil, AppConfig.frameratePerfil,AppConfig.bitratePerfil);

        mExitApp.setOnClickListener(new OnClickListener() {
            @Override
            public void onClick(View v) {
                exitApp();
            }
        });

        mTextoEditado.getBackground().setColorFilter(getResources().getColor(R.color.white), PorterDuff.Mode.SRC_ATOP);
        mTextoInseridoChat.getBackground().setColorFilter(getResources().getColor(R.color.white), PorterDuff.Mode.SRC_ATOP);

        final Spinner staticSpinner = (Spinner) findViewById(R.id.static_spinner);

        // Create an ArrayAdapter using the string array and a default spinner
        ArrayAdapter<CharSequence> staticAdapter = ArrayAdapter
                .createFromResource(this, R.array.brew_array, R.layout.estilospin);

        // Specify the layout to use when the list of choices appears
        staticAdapter
                .setDropDownViewResource(R.layout.spinner_row);

        // Apply the adapter to the spinner
        staticSpinner.setAdapter(staticAdapter);

        staticSpinner.setOnItemSelectedListener(new AdapterView.OnItemSelectedListener() {
            @Override
            public void onItemSelected(AdapterView<?> parent, View view,
                                       int position, long id) {
//                Log.v("item", (String) parent.getItemAtPosition(position));
                if (position > 0) {
                    AppConfig.categoriaSelecionada = staticSpinner.getSelectedItem().toString();
                    mBrincadeira.setTextColor(Color.parseColor("#FFFFFF"));
                } else {
                    AppConfig.categoriaSelecionada = "";
                    mBrincadeira.setTextColor(Color.parseColor("#888888"));
                }
            }

            @Override
            public void onNothingSelected(AdapterView<?> parent) {
                // TODO Auto-generated method stub
            }
        });

        // Fetching user details from SQLite
        HashMap<String, String> user = db.getUserDetails();
        String email = user.get("email");

        YoYo.with(Techniques.SlideInDown)
                .duration(1000)
                .playOn(mTextoEditado);

        YoYo.with(Techniques.SlideInDown)
                .duration(1300)
                .playOn(findViewById(R.id.static_spinner));

        obterIdUtilizador(email);
        estadoTransmissao = false;
        preparaChat();

        mTextoInseridoChat.setVisibility(View.GONE);
        envMsg.setVisibility(View.GONE);
        pubVer.setVisibility(View.GONE);
        numeroPub.setVisibility(View.GONE);
    }

    @Override
    public void onCheckedChanged(RadioGroup group, int checkedId) {
        mLayoutVideoSettings.setVisibility(View.GONE);
        mLayoutServerSettings.setVisibility(View.VISIBLE);
        selectQuality(AppConfig.widthPerfil,AppConfig.heightPerfil, AppConfig.frameratePerfil,AppConfig.bitratePerfil);
    }

    @Override
    public void onBackPressed() {
        exitApp();
    }

    @Override
    public void onClick(View v) {
        switch (v.getId()) {
            case R.id.iconeEnviaMsg:
                verificaMsg();
                break;
            case R.id.start:
                mLayoutServerSettings.setVisibility(View.GONE);
                toggleStream();
                break;
            case R.id.flash:
                if (mButtonFlash.getTag().equals("on")) {
                    mButtonFlash.setTag("off");
                    mButtonFlash.setImageResource(R.drawable.ic_flash_on_holo_light);
                } else {
                    mButtonFlash.setImageResource(R.drawable.ic_flash_off_holo_light);
                    mButtonFlash.setTag("on");
                }
                mSession.toggleFlash();
                break;
            case R.id.camera:
                mSession.switchCamera();
                break;
            case R.id.settings:

                Intent intent = new Intent(MainActivity.this, CentralActivity.class);
                startActivity(intent);

                finish();

//                if (mLayoutVideoSettings.getVisibility() == View.GONE) {
//                    mLayoutVideoSettings.setVisibility(View.VISIBLE);
//                } else {
////                    mLayoutServerSettings.setVisibility(View.GONE);
//                    mLayoutVideoSettings.setVisibility(View.GONE);
//                }
                break;
            case R.id.video:
                mRadioGroup.clearCheck();
                mLayoutServerSettings.setVisibility(View.GONE);
                mLayoutVideoSettings.setVisibility(View.VISIBLE);
                break;
            case R.id.save:
                mLayoutServerSettings.setVisibility(View.GONE);
                break;
        }
    }

    @Override
    public void onDestroy() {
        super.onDestroy();
        mClient.release();
        mSession.release();
        mSurfaceView.getHolder().removeCallback(this);
        metodoPararStream(AppConfig.novoIdVideo);
    }

    public void selectQuality(int width, int height, int framerate, int bitrate) {

        if (width == 0) {return;}

        mSession.setVideoQuality(
                new VideoQuality(
                AppConfig.widthPerfil,
                AppConfig.heightPerfil,
                AppConfig.frameratePerfil,
                AppConfig.bitratePerfil));

        Toast.makeText(this, AppConfig.widthPerfil + "x" +  AppConfig.heightPerfil + " " +
                AppConfig.frameratePerfil +" FPS" + " " + AppConfig.bitratePerfil + " KPBS",
                Toast.LENGTH_SHORT).show();

    }

    private void enableUI() {
        mButtonStart.setEnabled(true);
        mButtonCamera.setEnabled(true);
    }

    public void verificaMsg() {

        String finalTextChat = mTextoInseridoChat.getText().toString().trim();

        if (finalTextChat.isEmpty()) {
            AlertDialog.Builder builder = new AlertDialog.Builder(this, R.style.MyAlertDialogStyle);
            builder
                    .setTitle("Insere uma mensagem")
                    .setMessage("Necessitas de escrever uma mensagem no chat para a poderes enviar.")
                    .setPositiveButton("OK", new DialogInterface.OnClickListener() {
                        @Override
                        public void onClick(DialogInterface dialog, int which) {
                        }

                    })
                    .show();
        } else {
            enviarMsg(AppConfig.idUtilizador, finalTextChat);
        }
    }

    // Connects/disconnects to the RTSP server and starts/stops the stream
    public void toggleStream() {

        mProgressBar.setVisibility(View.VISIBLE);

        if (!mClient.isStreaming()) {

            if (latitudeObtiDA == null && longitudeObtida == null) {
                AlertDialog.Builder builder = new AlertDialog.Builder(this, R.style.MyAlertDialogStyle);
                builder
                        .setTitle("Localização Desconhecida")
                        .setMessage("Por algum motivo ainda não foi possível obter a tua localização."
                                + "\n" +
                                "Verifica se a tua ligação à Internet se encontra ativa, bem como a tua localização.")
                        .setPositiveButton("OK", new DialogInterface.OnClickListener() {
                            @Override
                            public void onClick(DialogInterface dialog, int which) {
                                Intent intent = new Intent(Settings.ACTION_LOCATION_SOURCE_SETTINGS);
                                startActivity(intent);
                            }

                        })
                        .show();
                mClient.stopStream();

                metodoPararStream(AppConfig.novoIdVideo);

                mTextoEditado.setEnabled(true);

                YoYo.with(Techniques.SlideInDown)
                        .duration(1000)
                        .playOn(mTextoEditado);

                YoYo.with(Techniques.SlideInDown)
                        .duration(1300)
                        .playOn(findViewById(R.id.static_spinner));

                mLayoutServerSettings.setVisibility(View.GONE);
                mProgressBar.setVisibility(View.GONE);

                HashMap<String, String> user = db.getUserDetails();
                String email = user.get("email");
                obterIdUtilizador(email);

            } else {

                String finalTextoTransmissao = mTextoEditado.getText().toString().trim();

                if (finalTextoTransmissao.isEmpty()) {

                    AlertDialog.Builder builder = new AlertDialog.Builder(this, R.style.MyAlertDialogStyle);

                    builder
                            .setTitle("Informações Insuficientes")
                            .setMessage("Necessitas de introduzir um título para a tua transmissão.")
                            .setPositiveButton("OK", new DialogInterface.OnClickListener() {
                                @Override
                                public void onClick(DialogInterface dialog, int which) {
                                }

                            })
                            .show();
                    mClient.stopStream();

                    metodoPararStream(AppConfig.novoIdVideo);

                    mTextoEditado.setEnabled(true);

                    mLayoutServerSettings.setVisibility(View.GONE);
                    mProgressBar.setVisibility(View.GONE);
                    HashMap<String, String> user = db.getUserDetails();
                    String email = user.get("email");
                    obterIdUtilizador(email);
                    estadoTransmissao = false;

                } else {

                    String finalCatTransmissao = AppConfig.categoriaSelecionada.trim();
                    if (finalCatTransmissao.isEmpty()) {

                        AlertDialog.Builder builder = new AlertDialog.Builder(this, R.style.MyAlertDialogStyle);
                        builder
                                .setTitle("Informações Insuficientes")
                                .setMessage("Necessitas de introduzir uma categoria para a tua tranmissão.")
                                .setPositiveButton("OK", new DialogInterface.OnClickListener() {
                                    @Override
                                    public void onClick(DialogInterface dialog, int which) {
                                    }
                                })
                                .show();
                        mClient.stopStream();

                        metodoPararStream(AppConfig.novoIdVideo);

                        mTextoEditado.setEnabled(true);

                        mLayoutServerSettings.setVisibility(View.GONE);
                        mProgressBar.setVisibility(View.GONE);
                        HashMap<String, String> user = db.getUserDetails();
                        String email = user.get("email");
                        obterIdUtilizador(email);
                        estadoTransmissao = false;

                    } else {

                        // Fetching user details from SQLite
                        HashMap<String, String> user = db.getUserDetails();
                        String email = user.get("email");

                        String ip, port, path;

                        // We save the content user inputs in Shared Preferences
                        SharedPreferences mPrefs = PreferenceManager.getDefaultSharedPreferences(MainActivity.this);
                        Editor editor = mPrefs.edit();
                        editor.putString("uri", mEditTextURI.getText().toString());
                        editor.putString("password", mEditTextPassword.getText().toString());
                        editor.putString("username", mEditTextUsername.getText().toString());
                        editor.commit();

                        // We parse the URI written in the Editext
                        Pattern uri = Pattern.compile("rtsp://(.+):(\\d*)/(.+)");
                        Matcher m = uri.matcher(mEditTextURI.getText());
                        m.find();
                        ip = m.group(1);
                        port = m.group(2);
                        path = m.group(3);

                        String testeTexto = AppConfig.novoIdVideo;
                        stringLongitudeObtida = Double.toString(longitudeObtida);
                        stringLatitudeObtida = Double.toString(latitudeObtiDA);
                        String finalRefId = AppConfig.idUtilizador;

                        introduzirStreamDB(finalRefId, finalTextoTransmissao, finalCatTransmissao,
                                stringLatitudeObtida, stringLongitudeObtida, testeTexto);

                        mClient.setCredentials(mEditTextUsername.getText().toString(), mEditTextPassword.getText().toString());
                        mClient.setServerAddress(ip, Integer.parseInt(port));
                        mClient.setStreamPath("/live/" + email + "_" + testeTexto);
                        mClient.startStream();

                        mTextoEditado.setEnabled(false);

                        estadoTransmissao = true;

                        YoYo.with(Techniques.SlideOutUp)
                                .duration(1000)
                                .playOn(mTextoEditado);

                        YoYo.with(Techniques.SlideOutUp)
                                .duration(1300)
                                .playOn(findViewById(R.id.static_spinner));

                        animaTransmissaoON();
                    }
                }
            }
        } else {
            // Stops the stream and disconnects from the RTSP server
            mClient.stopStream();
            HashMap<String, String> user = db.getUserDetails();
            String email = user.get("email");
            obterIdUtilizador(email);

            metodoPararStream(AppConfig.novoIdVideo);

            mTextoEditado.setEnabled(true);
            estadoTransmissao = false;

            YoYo.with(Techniques.SlideInDown)
                    .duration(1000)
                    .playOn(mTextoEditado);

            YoYo.with(Techniques.SlideInDown)
                    .duration(1300)
                    .playOn(findViewById(R.id.static_spinner));

            animaTransmissaoOFF();
        }
    }

    private void logError(final String msg) {
        final String error = (msg == null) ? "Erro desconhecido." : msg;

        // Displays a popup to report the error to the user
        AlertDialog.Builder builder = new AlertDialog.Builder(this, R.style.MyAlertDialogStyle);
        builder.setMessage(msg).setPositiveButton("OK", new DialogInterface.OnClickListener() {
            public void onClick(DialogInterface dialog, int id) {
            }
        });
        AlertDialog dialog = builder.create();
        dialog.show();
    }

    @Override
    public void onBitrateUpdate(long bitrate) {
        mTextBitrate.setText("" + bitrate / 1000 + " kbps");
    }

    @Override
    public void onPreviewStarted() {
        if (mSession.getCamera() == CameraInfo.CAMERA_FACING_FRONT) {
            mButtonFlash.setEnabled(false);
            mButtonFlash.setTag("off");
            mButtonFlash.setImageResource(R.drawable.ic_flash_on_holo_light);
        } else {
            mButtonFlash.setEnabled(true);
        }
    }

    @Override
    public void onSessionConfigured() {
    }

    @Override
    public void onSessionStarted() {
        enableUI();
        mButtonStart.setImageResource(R.drawable.ic_switch_video_active);
        mProgressBar.setVisibility(View.GONE);
        transmissaoON = 1;
    }

    @Override
    public void onSessionStopped() {
        enableUI();
        mButtonStart.setImageResource(R.drawable.ic_switch_video);
        mProgressBar.setVisibility(View.GONE);
        transmissaoON = 0;
        HashMap<String, String> user = db.getUserDetails();
        String email = user.get("email");
        obterIdUtilizador(email);
        metodoPararStream(AppConfig.novoIdVideo);
        estadoTransmissao = false;
    }

    @Override
    public void onSessionError(int reason, int streamType, Exception e) {
        mProgressBar.setVisibility(View.GONE);
        switch (reason) {
            case Session.ERROR_CAMERA_ALREADY_IN_USE:
                break;
            case Session.ERROR_CAMERA_HAS_NO_FLASH:
                mButtonFlash.setImageResource(R.drawable.ic_flash_on_holo_light);
                mButtonFlash.setTag("off");
                break;
            case Session.ERROR_INVALID_SURFACE:
                break;
            case Session.ERROR_STORAGE_NOT_READY:
                break;
            case Session.ERROR_CONFIGURATION_NOT_SUPPORTED:
                VideoQuality quality = mSession.getVideoTrack().getVideoQuality();
                logError("The following settings are not supported on this phone: " +
                        quality.toString() + " " +
                        "(" + e.getMessage() + ")");
                e.printStackTrace();
                return;
            case Session.ERROR_OTHER:
                break;
        }

        if (e != null) {
            logError(e.getMessage());
            e.printStackTrace();
        }
    }

    @Override
    public void onRtspUpdate(int message, Exception e) {
        switch (message) {
            case RtspClient.ERROR_CONNECTION_FAILED:
            case RtspClient.ERROR_WRONG_CREDENTIALS:
                mProgressBar.setVisibility(View.GONE);
                enableUI();
                logError(e.getMessage());
                e.printStackTrace();
                break;
        }
    }

    @Override
    public void surfaceChanged(SurfaceHolder holder, int format, int width, int height) {
    }

    @Override
    public void surfaceCreated(SurfaceHolder holder) {
        mSession.startPreview();
    }

    @Override
    public void surfaceDestroyed(SurfaceHolder holder) {
        mClient.stopStream();
        metodoPararStream(AppConfig.novoIdVideo);

        mTextoEditado.setEnabled(true);

        YoYo.with(Techniques.SlideInDown)
                .duration(1000)
                .playOn(mTextoEditado);

        YoYo.with(Techniques.SlideInDown)
                .duration(1300)
                .playOn(findViewById(R.id.static_spinner));
        estadoTransmissao = false;
        animaTransmissaoOFF();
    }

    public void exitApp() {

        AlertDialog.Builder builder = new AlertDialog.Builder(this, R.style.MyAlertDialogStyle);

        if (transmissaoON == 1) {
            builder
                    .setTitle("Terminar Sessão")
                    .setMessage("Tens a certeza que pretendes abandonar esta sessão?"
                            + "\n" +
                            "Nota: A atual tranmissão será parada.")
                    .setPositiveButton("Sim", new DialogInterface.OnClickListener() {
                        @Override
                        public void onClick(DialogInterface dialog, int which) {
                            logoutUser();
                        }

                    })
                    .setNegativeButton("Não", null)
                    .show();
        } else {
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
    }

    private void logoutUser() {
        session.setLogin(false);
        db.deleteUsers();
        finish();
    }

    @Override
    public boolean onTouchEvent(MotionEvent event) {
        // Get the pointer ID

        Camera.Parameters params = VideoStream.mCamera.getParameters();
        int action = event.getAction();

        if (event.getPointerCount() > 1) {
            // handle multi-touch events
            if (action == MotionEvent.ACTION_POINTER_DOWN) {
                mDist = getFingerSpacing(event);
            } else if (action == MotionEvent.ACTION_MOVE && params.isZoomSupported()) {
                VideoStream.mCamera.cancelAutoFocus();
                handleZoom(event, params);
            }
        } else {
            // handle single touch events
            if (action == MotionEvent.ACTION_UP) {
                handleFocus(event, params);
            }
        }
        return true;
    }

    private void handleZoom(MotionEvent event, Camera.Parameters params) {
        int maxZoom = params.getMaxZoom();
        int zoom = params.getZoom();
        float newDist = getFingerSpacing(event);
        if (newDist > mDist) {
            //zoom in
            if (zoom < maxZoom)
                zoom++;
        } else if (newDist < mDist) {
            //zoom out
            if (zoom > 0)
                zoom--;
        }
        mDist = newDist;
        params.setZoom(zoom);
        VideoStream.mCamera.setParameters(params);
    }

    public void handleFocus(MotionEvent event, Camera.Parameters params) {
        int pointerId = event.getPointerId(0);
        int pointerIndex = event.findPointerIndex(pointerId);
        // Get the pointer's current position
        float x = event.getX(pointerIndex);
        float y = event.getY(pointerIndex);

        List<String> supportedFocusModes = params.getSupportedFocusModes();
        if (supportedFocusModes != null && supportedFocusModes.contains(Camera.Parameters.FOCUS_MODE_AUTO)) {
            VideoStream.mCamera.autoFocus(new Camera.AutoFocusCallback() {
                @Override
                public void onAutoFocus(boolean b, Camera camera) {
                    // currently set to auto-focus on single touch
                }
            });
        }
    }

    private float getFingerSpacing(MotionEvent event) {
        // ...
        float x = event.getX(0) - event.getX(1);
        float y = event.getY(0) - event.getY(1);
        return (float)Math.sqrt(x * x + y * y);
    }

    int msgN = 0;

    @Override
    public void onLocationChanged(Location location) {
        if (msgN == 0) {
            String msg = "Conseguimos encontrar a sua localização!";
            msgN = msgN + 1;
            Toast.makeText(getBaseContext(), msg, Toast.LENGTH_LONG).show();
        } else {
//            String msg = "Nova localização!";
//            Toast.makeText(getBaseContext(), msg, Toast.LENGTH_LONG).show();
        }
        descricaoLocalizacao(location.getLatitude(), location.getLongitude());
    }

    void descricaoLocalizacao(double latitude, double longitude) {
        latitudeObtiDA = latitude;
        longitudeObtida = longitude;
    }

    @Override
    public void onProviderDisabled(String provider) {

        AlertDialog.Builder builder = new AlertDialog.Builder(this, R.style.MyAlertDialogStyle);
        builder
                .setTitle("Ativar Localização")
                .setMessage("Para poderes transmitir necessitas de indicar a tua localização:\n" +
                        "Ativar o GPS.")
                .setNegativeButton("Não, obrigado",
                        new DialogInterface.OnClickListener() {
                            public void onClick(DialogInterface dialog, int whichButton) {
                                dialog.dismiss();
                            }
                        }
                )
                .setPositiveButton("Ir para as configurações", new DialogInterface.OnClickListener() {
                    @Override
                    public void onClick(DialogInterface dialog, int which) {
                        Intent intent = new Intent(Settings.ACTION_LOCATION_SOURCE_SETTINGS);
                        startActivity(intent);
                    }
                })
                .show();
    }

    @Override
    public void onProviderEnabled(String provider) {

        Toast.makeText(getBaseContext(), "A tua localização encontra-se ativa!",
                Toast.LENGTH_SHORT).show();
    }

    @Override
    public void onStatusChanged(String provider, int status, Bundle extras) {
        // TODO Auto-generated method stub
    }

    public void introduzirStreamDB(final String refIdUt, final String nomeTranmissao,
                                   final String temaTransmissao, final String latParam,
                                   final String lonParam, final String idVideo) {
        // Tag used to cancel the request
        String tag_string_req = "req_register";

        StringRequest strReq = new StringRequest(Request.Method.POST,
                AppConfig.URL_INTRODUZIR_STREAM, new Response.Listener<String>() {

            @Override
            public void onResponse(String response) {
                Log.d(TAG, "Register Response: " + response.toString());

                try {
                    JSONObject jObj = new JSONObject(response);
                    boolean error = jObj.getBoolean("error");
                    if (!error) {
                        // User successfully stored in MySQL
                    } else {
                        // Error occurred in registration. Get the error
                        // message
                        String errorMsg = jObj.getString("error_msg");
                        Toast.makeText(getApplicationContext(),
                                errorMsg, Toast.LENGTH_LONG).show();
                    }
                } catch (JSONException e) {
                    e.printStackTrace();
                }

            }
        }, new Response.ErrorListener() {

            @Override
            public void onErrorResponse(VolleyError error) {
            }
        }) {

            @Override
            protected Map<String, String> getParams() {
                // Posting params to register url
                Map<String, String> params = new HashMap<String, String>();
                params.put("ref_id_utilizador", refIdUt);
                params.put("nome", nomeTranmissao);
                params.put("tema", temaTransmissao);
                params.put("latitude", latParam);
                params.put("longitude", lonParam);
                params.put("numeroVideo", idVideo);

                return params;
            }
        };
        // Adding request to request queue
        AppController.getInstance().addToRequestQueue(strReq, tag_string_req);
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

    public void metodoPararStream(final String idVideo) {
        // Tag used to cancel the request
        String tag_string_req = "req_login";

        StringRequest strReq = new StringRequest(
                Request.Method.POST,
                AppConfig.URL_PARAR_STREAM, new Response.Listener<String>() {

            @Override
            public void onResponse(String response) {
                Log.d(TAG, "Login Response: " + response.toString());
                try {
                    JSONObject jObj = new JSONObject(response);
                    boolean error = jObj.getBoolean("error");

                    // Check for error node in json
                    if (!error) {
                        // user successfully logged in
                    } else {
                        // Error in login. Get the error message
                        String errorMsg = jObj.getString("error_msg");
                    }
                } catch (JSONException e) {
                    // JSON error
                    e.printStackTrace();
                }

            }
        }, new Response.ErrorListener() {

            @Override
            public void onErrorResponse(VolleyError error) {
                Toast.makeText(getApplicationContext(),
                        error.getMessage(), Toast.LENGTH_LONG).show();
            }
        }) {

            @Override
            protected Map<String, String> getParams() {
                // Posting parameters to login url
                Map<String, String> params = new HashMap<String, String>();
                params.put("numeroTransmissao", idVideo);
                params.put("idUT", AppConfig.idUtilizador);
                return params;
            }
        };
        // Adding request to request queue
        AppController.getInstance().addToRequestQueue(strReq, tag_string_req);
    }

    public void carregarChat() {

        String utVideoAtivo = AppConfig.idUtilizador;
        int utVideoAt = Integer.parseInt(utVideoAtivo);
        url = "http://178.62.86.141/android_login_api/chatAPP.php?transmissaoAtiva=" + utVideoAt;

//        url = "http://wesee.diogosantos.pt/android_login_api/chatAPP.php?transmissaoAtiva=1";

        // Creating volley request obj
        JsonArrayRequest movieReq = new JsonArrayRequest(url,
                new Response.Listener<JSONArray>() {
                    @Override
                    public void onResponse(JSONArray response) {
                        Log.d(TAG, response.toString());
                        // Parsing json

                        movieList.clear();

                        for (int i = 0; i < response.length(); i++) {
                            try {
                                JSONObject obj = response.getJSONObject(i);
                                Movie movie = new Movie();

                                movie.setTitle(obj.getString("title"));
                                movie.setThumbnailUrl(obj.getString("image"));
                                movie.setRating(obj.getString("rating"));
                                movie.setYear(obj.getString("releaseYear"));

                                // Genre is json array
                                JSONArray genreArry = obj.getJSONArray("genre");
                                ArrayList<String> genre = new ArrayList<String>();
                                for (int j = 0; j < genreArry.length(); j++) {
                                    genre.add((String) genreArry.get(j));
                                }
                                movie.setGenre(genre);

                                // adding movie to movies array
                                movieList.add(movie);

                            } catch (JSONException e) {
                                e.printStackTrace();
                            }

                        }

                        // notifying list adapter about data changes
                        // so that it renders the list view with updated data
                        adapter.notifyDataSetChanged();
                    }
                }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                VolleyLog.d(TAG, "Error: " + error.getMessage());
            }
        });

        // Adding request to request queue
        AppController.getInstance().addToRequestQueue(movieReq);
    }

    public void carregarPublico() {
        // Tag used to cancel the request
        String tag_string_req = "req_pub";

        String utVideoAtivo2 = AppConfig.idUtilizador;
        int utVideoAt2 = Integer.parseInt(utVideoAtivo2);

        String urlPub = "http://178.62.86.141//android_login_api/chatPublico.php?transmissaoAtiva=" + utVideoAt2;

        StringRequest strReq = new StringRequest(Request.Method.POST, urlPub, new Response.Listener<String>() {
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
                        numeroPub.setText(user.getString("publico"));
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
    }

    public void preparaChat() {
        new android.os.Handler().postDelayed(
                new Runnable() {
                    public void run() {
                        if (estadoTransmissao) {
                            Log.i("tag", "This'll run 3000 milliseconds later");
                            carregarChat();
                            carregarPublico();
                            preparaChat();
                        } else {
                            preparaChat();
                        }
                    }
                }, 3000);
    }

    public void enviarMsg(final String refIdUt, final String mensagemInserida) {
        // Tag used to cancel the request
        String tag_string_req = "req_chat";

        StringRequest strReq = new StringRequest(Request.Method.POST,
                AppConfig.URL_ENVIAR_MSG, new Response.Listener<String>() {

            @Override
            public void onResponse(String response) {
                Log.d(TAG, "Register Response: " + response.toString());

                mTextoInseridoChat.setEnabled(false);
                mTextoInseridoChat.setEnabled(true);
                mTextoInseridoChat.setText(null);
            }
        }, new Response.ErrorListener() {

            @Override
            public void onErrorResponse(VolleyError error) {
            }
        }) {
            @Override
            protected Map<String, String> getParams() {
                // Posting params to register url
                Map<String, String> params = new HashMap<String, String>();
                params.put("ref_id_utilizador", refIdUt);
                params.put("textoInserido", mensagemInserida);

                return params;
            }
        };
        // Adding request to request queue
        AppController.getInstance().addToRequestQueue(strReq, tag_string_req);
    }

    public void animaTransmissaoON() {

        movieList.clear();
        mTextoInseridoChat.setVisibility(View.VISIBLE);
        envMsg.setVisibility(View.VISIBLE);

        numeroPub.setText(R.string.publicoInicial);
        numeroPub.setVisibility(View.VISIBLE);
        pubVer.setVisibility(View.VISIBLE);

        YoYo.with(Techniques.SlideOutDown)
                .duration(1500)
                .playOn(mButtonSettings);

        YoYo.with(Techniques.SlideInUp)
                .duration(1500)
                .playOn(findViewById(R.id.iconeEnviaMsg));

        YoYo.with(Techniques.SlideInUp)
                .duration(1500)
                .playOn(findViewById(R.id.chatTransmissao));

        YoYo.with(Techniques.SlideInUp)
                .duration(2000)
                .playOn(listView);

        YoYo.with(Techniques.SlideInUp)
                .duration(2000)
                .playOn(numeroPub);

        YoYo.with(Techniques.SlideInUp)
                .duration(2000)
                .playOn(pubVer);
    }

    public void animaTransmissaoOFF() {

        YoYo.with(Techniques.SlideInUp)
                .duration(1500)
                .playOn(mButtonSettings);

        YoYo.with(Techniques.SlideOutDown)
                .duration(1500)
                .playOn(findViewById(R.id.iconeEnviaMsg));

        YoYo.with(Techniques.SlideOutDown)
                .duration(1500)
                .playOn(findViewById(R.id.chatTransmissao));

        YoYo.with(Techniques.SlideOutDown)
                .duration(2000)
                .playOn(listView);

        YoYo.with(Techniques.SlideOutDown)
                .duration(2000)
                .playOn(numeroPub);

        YoYo.with(Techniques.SlideOutDown)
                .duration(2000)
                .playOn(pubVer);
    }

}
