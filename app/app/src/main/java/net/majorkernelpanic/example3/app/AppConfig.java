package net.majorkernelpanic.example3.app;

public class AppConfig {
    // Server user login url
    public static String URL_LOGIN = "http://178.62.86.141//android_login_api/entrar.php";

    // Server user register url
    public static String URL_REGISTER = "http://178.62.86.141//android_login_api/register.php";

    // Server pedido começa transmissão
    public static String URL_INTRODUZIR_STREAM = "http://178.62.86.141//android_login_api/iniciartransmissao.php";

    // Server pedido pausa transmissão
    public static String URL_PARAR_STREAM = "http://178.62.86.141//android_login_api/pausartransmissao.php";

    // Server pedido enviar msg
    public static String URL_ENVIAR_MSG = "http://178.62.86.141/android_login_api/enviarMSG.php";

    // Guardar var ID utilizador
    public static String obterIdUtilizadorURL = "http://178.62.86.141/android_login_api/perguntarID.php";

    // Guardar var ID utilizador
    public static String idUtilizador;

    // Posição Categoria Selecionada;
    public static String categoriaSelecionada;

    public static String novoIdVideo;

    public static int widthPerfil = 0;
    public static int heightPerfil = 0;
    public static int frameratePerfil = 0;
    public static int bitratePerfil = 0;

}