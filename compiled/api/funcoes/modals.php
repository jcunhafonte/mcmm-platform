<?php

//TWITTER
require_once('api/twitter/oauth/twitteroauth.php');
require_once('api/twitter/twitter_class.php');

if (isset($_GET['connect']) && $_GET['connect'] == 'twitter') {

    $objTwitterApi = new TwitterLoginAPI;
    $return = $objTwitterApi->login_twitter($_GET['connect']);

    if ($return['error']) {
        echo $return['error'];
    } else {
        header('location:' . $return['url']);
        exit;
    }
}

//FACEBOOK
include_once("api/facebook/config.php");

if (!$fbuser) {
    $fbuser = null;
    $loginUrl = $facebook->getLoginUrl(array('redirect_uri' => $homeurl, 'scope' => $fbPermissions));
} else {
    $loginUrl = '';
}


    if (!isset($_SESSION['idUtilizador'])) {
        echo "
<div class=\"container\">
    <div class=\"modal fade login\" id=\"loginModal\">
        <button type=\"button\" class=\"out-close close hidden-xs\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>
        <div class=\"modal-dialog vertical-align-center login animated\">
            <div class=\"modal-content\">
                <div class=\"modal-header\">
                    <button type=\"button\" class=\"close hidden-sm hidden-md hidden-lg\" data-dismiss=\"modal\"
                            aria-hidden=\"true\">&times;</button>
                    <h4 class=\"modal-title text-center\">Entrar</h4>
                </div>
                <div class=\"modal-body\">
                    <div class=\"box\">
                        <div class=\"content\">
                            <div class=\"social\">
                                <a class=\"circle twitter\" href='?connect=twitter' target='_parent'>
                                    <svg class=\"twitter\" x=\"0px\" y=\"0px\" viewBox=\"0 0 52.851 52.851\" xml:space=\"preserve\" width=\"21\" height=\"21\">
                                    <g>
                                        <path fill=\"#fff\" d=\"M52.412,9.656c-0.354-0.24-0.823-0.227-1.165,0.031c-0.449,0.34-1.179,0.61-1.965,0.818   c2.047-2.294,2.091-3.826,2.069-4.178c-0.023-0.364-0.242-0.687-0.572-0.842c-0.331-0.156-0.719-0.118-1.014,0.096   c-2.303,1.674-4.597,2.027-5.961,2.063c-2.094-2.004-4.813-3.102-7.707-3.102c-6.196,0-11.236,5.108-11.236,11.386   c0,0.54,0.038,1.079,0.113,1.613C14.236,17.42,5.516,7.131,5.426,7.024c-0.21-0.25-0.528-0.384-0.854-0.355   c-0.326,0.028-0.617,0.213-0.78,0.497C0.702,12.526,2.77,17.234,4.66,19.93c-0.334-0.178-0.605-0.354-0.767-0.473   c-0.3-0.224-0.701-0.261-1.039-0.095c-0.337,0.166-0.552,0.506-0.559,0.881c-0.083,5.108,2.375,8.034,4.687,9.652   c-0.308-0.029-0.621,0.085-0.835,0.318c-0.24,0.261-0.325,0.63-0.221,0.969c1.597,5.227,5.518,7.003,8.013,7.606   c-5.13,3.994-12.68,2.708-12.763,2.694c-0.456-0.081-0.906,0.159-1.092,0.582c-0.185,0.422-0.059,0.917,0.309,1.197   c5.415,4.133,11.892,5.048,16.57,5.048c3.539,0,6.05-0.524,6.29-0.577c23.698-5.616,24.365-27.323,24.31-30.88   c4.449-4.137,5.144-5.713,5.251-6.103C52.929,10.336,52.767,9.896,52.412,9.656z M45.874,15.691c-0.223,0.205-0.34,0.5-0.32,0.803   c0.063,0.96,1.275,23.597-22.742,29.288c-0.109,0.023-9.656,2.015-17.932-2.085c3.497-0.097,8.511-1.013,12.004-4.935   c0.264-0.295,0.328-0.719,0.164-1.079c-0.162-0.357-0.519-0.586-0.91-0.586c-0.003,0-0.007,0-0.01,0   c-0.05,0.032-5.301-0.006-7.705-5.001c0.968,0.055,2.162-0.005,3.113-0.443c0.392-0.181,0.623-0.592,0.575-1.021   c-0.048-0.428-0.366-0.777-0.788-0.866c-0.269-0.057-6.115-1.364-6.933-7.741c0.887,0.388,2.022,0.705,3.144,0.534   c0.386-0.058,0.702-0.335,0.811-0.71s-0.01-0.779-0.305-1.035c-0.25-0.218-5.74-5.097-3.137-11.39   c2.826,2.965,11.196,10.67,21.337,10.088c0.297-0.017,0.572-0.167,0.749-0.407c0.176-0.24,0.236-0.546,0.164-0.835   c-0.192-0.765-0.29-1.553-0.29-2.341c0-5.176,4.144-9.386,9.237-9.386c2.491,0,4.828,0.994,6.579,2.8   c0.184,0.19,0.437,0.299,0.701,0.304c1.06,0.015,2.802-0.11,4.77-0.899c-0.568,0.707-1.402,1.554-2.629,2.518   c-0.347,0.273-0.474,0.74-0.313,1.151c0.161,0.412,0.577,0.671,1.011,0.632c0.233-0.019,1.421-0.123,2.764-0.414   C48.249,13.423,47.246,14.429,45.874,15.691z\"/>
                                    </g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g>
                                </svg>
                                </a>
                                <a id=\"facebook_login\" class=\"circle facebook\"
                                   href=\"" . $loginUrl . " \">
                                    <svg class=\"facebook\" x=\"0px\" y=\"0px\" viewBox=\"0 0 288.861 288.861\" xml:space=\"preserve\" width=\"21\" height=\"21\">
                                        <g>
                                            <path fill=\"#fff\" d=\"M167.172,288.861h-62.16V159.347H70.769v-59.48h34.242v-33.4C105.011,35.804,124.195,0,178.284,0   c19.068,0,33.066,1.787,33.651,1.864l5.739,0.746l-1.382,55.663l-6.324-0.058c-0.013,0-14.223-0.135-29.724-0.135   c-11.536,0-13.066,2.847-13.066,14.171v27.629h50.913l-2.821,59.48h-48.086v129.501H167.172z M117.858,276.007h36.453V146.5h48.677   l1.607-33.779h-50.284V72.238c0-13.368,3.078-27.025,25.919-27.025c9.178,0,17.899,0.045,23.509,0.09l0.778-31.292   c-5.675-0.508-15.116-1.157-26.247-1.157c-44.544,0-60.419,27.693-60.419,53.613v46.254H83.61V146.5h34.242v129.507H117.858z\"/>
                                        </g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g>
                                    </svg>
                                </a>
                                <a id=\"google_login\" class=\"circle google\" target='_blank'
                                   href=\"http://www.mcmm.tech/api/google/account.php\">
                                    <svg width=\"22\" height=\"22\" viewBox=\"0 0 511.18 376.89\">
                                        <defs>
                                            <style>.cls-1 {
                                                fill: #fff;
                                            }</style>
                                        </defs>
                                        <path class=\"cls-1\"
                                              d=\"M497.51,143.42H462.93V108.86a13.66,13.66,0,1,0-27.33,0v34.57H401a13.67,13.67,0,0,0,0,27.34H435.6v34.57a13.66,13.66,0,1,0,27.33,0V170.76h34.58a13.67,13.67,0,0,0,0-27.34h0Z\"
                                              transform=\"translate(0.01 -2.11)\"/>
                                        <path class=\"cls-1\"
                                              d=\"M348,143.42q-77.6.11-155.18,0h-0.09c-5.75,0-10.42,1.74-13.85,5.19-5.18,5.18-5.14,11.78-5.12,14.26,0.14,13.53.1,27,.09,40.6l0,16.32c0,13.92,6.42,20.43,20.22,20.43h20.41c16.41,0,32.85,0,49.37,0-0.15.3-.3,0.62-0.46,0.93-4.66,9.76-12,18.42-22.4,26.46-13.09,7.9-26.2,12.45-40.09,13.88-31.83,3.22-57.73-6.62-79.19-30.32-7.26-8-13.17-18.23-18.23-31-6.24-20.85-6.14-40.31.17-59.1a95.92,95.92,0,0,1,25.21-38.53c32.91-30.64,83.49-31.9,115.14-2.91,6.3,5.77,16.37,7.68,24.82-1.34l10.58-10.59c10.86-10.9,21.7-21.76,32.74-32.58,4.22-4.18,6.26-8.84,6.07-13.88-0.3-7.55-5.58-12-7.22-13.42C267,10,215.24-4.45,156.78,4.85,116.36,11.3,81,30.21,51.66,61,38.82,74.39,29.07,88.07,21.91,102.62c-1.79,3.38-4,7.62-4.49,8.74A186.7,186.7,0,0,0,1.64,215.27c2.82,22,9.13,42.13,18.38,59.34a176.64,176.64,0,0,0,50.14,62.5C105.5,365,144.86,379,187.66,379A221.55,221.55,0,0,0,242,371.93c27.43-6.94,51.51-20.12,71-38.62,11.34-9.67,21.14-21.52,29.89-36.27,23.81-40.14,31.75-85.18,24.27-137.7-0.5-3.74-3.42-15.9-19.18-15.9h0Zm-29.63,139c-7.14,12-14.93,21.5-24.42,29.61A131,131,0,0,1,235,344.25c-56,14.15-104.06,4.47-147.18-29.55a148.71,148.71,0,0,1-42.39-53c-8-14.9-13.09-31.26-15.5-50a158.62,158.62,0,0,1,13.36-88.25c0.23-.47.69-1.4,1.27-2.55A14.17,14.17,0,0,0,46,118.38c0.49-1,1-2.06,1.46-3.1,0.83-1.56,1.51-2.86,1.81-3.41a12,12,0,0,0,.54-1.12A143.57,143.57,0,0,1,72.3,80.68c24.94-26.17,54.89-42.2,89-47.66C207.92,25.55,248.11,35.21,284,62.7Q271.55,75,259.16,87.51L255,91.72c-42.65-31.82-104.58-28.26-145.57,9.9a126.35,126.35,0,0,0-32.72,50c-8.25,24.58-8.43,50.41-.17,77.86,6.74,17.17,14.37,30.12,24,40.8,27.65,30.52,62.52,43.81,103.3,39.55,18.17-1.87,35.9-8,52.67-18.31a10,10,0,0,0,1.2-.82c14.4-11,24.66-23.17,31.41-37.26a124.16,124.16,0,0,0,6.71-18.28c0.75-2.5,3-10-2.1-16.85-3.43-4.58-8.42-6.5-15.62-6.78-21.2.17-42.42,0.14-63.62,0.14l-12.1,0v-8.16c0-10.46,0-20.94,0-31.53Q271,172.12,340,172c4.51,42.14-2.58,78.35-21.66,110.5h0Z\"
                                              transform=\"translate(0.01 -2.11)\"/>
                                    </svg>
                                </a>
                            </div>

                            <div class=\"division\">
                                <div class=\"line l\"></div>
                                <span>ou</span>
                                <div class=\"line r\"></div>
                            </div>

                            <div class=\"error\"></div>

                            <div class=\"form loginBox\">

                                <form accept-charset=\"UTF-8\" id=\"loginForm\">
                                                                       
                                    <div class=\"form-group\">
                                        <div class=\"col-xs-12\">
                                            <input id=\"login_email\" class=\"form-control\" type=\"text\"
                                                   placeholder=\"Email\" name=\"email_login\">
                                        </div>
                                    </div>

                                    <div class=\"form-group\">
                                        <div class=\"col-xs-12\">
                                            <input id=\"login_password\" class=\"form-control\" type=\"password\"
                                                   placeholder=\"Palavra-passe\" name=\"password_login\">
                                        </div>
                                    </div>

                                    <div class=\"form-group\">
                                        <div class=\"col-xs-6\">
                                            <label class=\"checkbox\" for=\"keep_connected\">
                                                <input type=\"checkbox\" value=\"\" id=\"keep_connected\"
                                                       data-toggle=\"checkbox\"> Ficar ligado
                                            </label>
                                        </div>

                                        <div class=\"col-xs-6\">
                                            <a class=\"recover-password\" href=\"/recover\">
                                                Recuperar palavra-passe
                                            </a>
                                        </div>
                                    </div>
                                    <div class=\"form-group\">
                                        <div class=\"col-xs-12\">
                                            <input class=\"btn btn-default btn-login\"
                                                   type=\"submit\" value=\"Entrar\">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class=\"box\">
                        <div class=\"content registerBox\" style=\"display:none;\">
                            <div class=\"form\">
                                <form accept-charset=\"UTF-8\" id=\"signupForm\">
                                    <div class=\"form-group\">
                                        <div class=\"col-xs-12\">
                                            <input id=\"email_signup\" class=\"form-control\" type=\"text\"
                                                   placeholder=\"Email\" name=\"email_signup\">
                                        </div>
                                    </div>
                                    <div class=\"form-group\">
                                        <div class=\"col-xs-12\">
                                            <input class=\"btn btn-default btn-register\" type=\"submit\"
                                                   value=\"Próximo\">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class=\"box\">
                        <div class=\"content registerBox-2\" style=\"display:none;\">
                            <div class=\"form\">
                                <form method=\"post\" accept-charset=\"UTF-8\" id=\"signupFormEnd\">
                                    <div class=\"form-group\">
                                        <div class=\"col-xs-12\">
                                            <input disabled id=\"email_signupEnd\" class=\"form-control\"
                                                   type=\"text\" placeholder=\"Email\" name=\"email\">
                                        </div>
                                    </div>
                                    <div class=\"form-group\">
                                        <div class=\"col-xs-12\">
                                            <input id=\"password\" class=\"form-control\" type=\"password\"
                                                   placeholder=\"Palavra-passe\" name=\"password\">
                                            <div class=\"progress password-progress\">
                                                <div id=\"strengthBar\" class=\"progress-bar\" role=\"progressbar\"
                                                     style=\"width: 0;\"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class=\"form-group\">
                                        <div class=\"col-xs-12\">
                                            <input id=\"confirmPassword\" class=\"form-control\" type=\"password\"
                                                   placeholder=\"Confirmar palavra-passe\" name=\"confirmPassword\">
                                        </div>
                                    </div>

                                    <div class=\"divisionEnd\">
                                        <div class=\"lineEnd\"></div>
                                    </div>

                                    <div class=\"form-group\">
                                        <div class=\"col-xs-12 nome_signupEnd\">
                                            <input id=\"nome_signupEnd\" class=\"form-control\"
                                                   type=\"text\" placeholder=\"Nome completo\" name=\"nome_signupEnd\">
                                        </div>
                                    </div>

                                    <label>Nome de utilizador</label>
                                    <div class=\"form-group\">
                                        <div class=\"col-xs-12\">

                                            <div class=\"input-group input-append date\" id=\"endDatePicker\">
                                                <span class=\"input-group-addon add-on\">
                                                    <span>
                                                        http://mcmm.tech/@
                                                    </span>
                                                </span>
                                                <input id=\"utilizador_signupEnd\" class=\"form-control\"
                                                       type=\"text\" name=\"utilizador_signupEnd\">
                                            </div>
                                        </div>
                                    </div>

                                    <div class=\"form-group\">
                                        <div class=\"col-xs-12 agree-box\">
                                            <label class=\"checkbox\" for=\"agree\" id=\"click-agree\">
                                                <input type=\"checkbox\" value=\"no\" id=\"agree\"
                                                       name=\"agree\" class=\"agree\" data-toggle=\"checkbox\"/>
                                                Concordo com os termos e condições
                                            </label>
                                        </div>
                                    </div>

                                    <div class=\"form-group\">
                                        <div class=\"col-xs-12\">
                                            <input class=\"btn btn-default btn-register\" type=\"submit\"
                                                   value=\"Registar\" name=\"commit\">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class=\"modal-footer\">
                    <div class=\"col-lg-12 forgot login-footer\">
                        <span>Não tens conta?
                            <a href=\"javascript: showRegisterForm();\">Regista-te</a>
                        </span>
                    </div>
                    <div class=\"col-lg-12 forgot register-footer\" style=\"display:none\">
                        <span>Já tens conta?</span>
                        <a href=\"javascript: showLoginForm();\">Entra</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
";
    } else {

        echo "
  <div id=\"modal-socials\">
        <div class=\"modal fade modal-settings\" id=\"edit-settings\">
            <button type=\"button\" class=\"out-close close hidden-xs\" data-dismiss=\"modal\"
                    aria-hidden=\"true\">&times;</button>
            <div class=\"modal-dialog vertical-align-center animated\">
                <div class=\"modal-content\">

                    <form method=\"post\" accept-charset=\"UTF-8\" id=\"edit_settings\" enctype=\"multipart/form-data\">
                        <div class=\"modal-header\">
                            <button type=\"button\" class=\"close hidden-sm hidden-md hidden-lg\" data-dismiss=\"modal\"
                                    aria-hidden=\"true\">&times;</button>
                            <h4 class=\"modal-title text-center\">Definições</h4>
                        </div>

                        <div class=\"modal-body\">
                            <div class=\"content\">
                                <div class=\"form\">

                                    <div class=\"form-group\">
                                        <div class=\"col-xs-12\">
                                            <input id=\"atual_password\" class=\"form-control\"
                                                   type=\"password\" placeholder=\"Palavra-passe atual\"
                                                   name=\"atual_password\">
                                        </div>
                                    </div>

                                    <div class=\"form-group\">
                                        <div class=\"col-xs-12\">
                                            <input id=\"new_password\" class=\"form-control\" type=\"password\"
                                                   placeholder=\"Nova palavra-passe\" name=\"new_password\">
                                            <div class=\"progress password-progress\">
                                                <div id=\"strengthBar\" class=\"progress-bar\" role=\"progressbar\"
                                                     style=\"width: 0;\"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class=\"form-group\">
                                        <div class=\"col-xs-12\">
                                            <input id=\"confirm_new_password\" class=\"form-control\"
                                                   type=\"password\" placeholder=\"Confirmação da nova palavra-passe\"
                                                   name=\"confirm_new_password\">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class=\"modal-footer\">
                            <button type=\"button\" class=\"btn btn-default btn-simple btn-cancel\" data-dismiss=\"modal\">
                                Cancelar
                            </button>
                            <button type=\"submit\" class=\"btn btn-info btn-simple btn-save\">Guardar</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>";
}