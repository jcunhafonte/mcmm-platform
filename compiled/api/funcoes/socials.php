<?php

function conclusionTwitter($id, $image, $name, $id_user)
{
    echo "
<div class=\"modal fade login\" id=\"conclusion-twitter\" tabindex=\"-1\"
     role=\"dialog\" aria-hidden=\"true\" data-backdrop=\"static\">
           <div class=\"modal-dialog vertical-align-center login animated\">
            <div class=\"modal-content\">
                <div class=\"modal-header\">
                    <button type=\"button\" class=\"close hidden-sm hidden-md hidden-lg\" data-dismiss=\"modal\"
                            aria-hidden=\"true\">&times;</button>
                    <h4 class=\"modal-title text-center\">ENTRAR</h4>
                </div>
                <div class=\"modal-body\">
                    <div class=\"box\">
                        <div class=\"content registerBox-2\" style=\"display:block;\">
                            <div class=\"form\">
                                <form method=\"post\" accept-charset=\"UTF-8\" id=\"signup_twitter\">
                                
                                    <input type='hidden' value='$id' id='id_twitter' name='id_twitter'>
                                    <input type='hidden' value='$image' id='image' name='image'>                                    

                                    <div class=\"form-group\">
                                        <div class=\"col-xs-12\">
                                            <input id=\"email\" class=\"form-control\"
                                                   type=\"text\" placeholder=\"Email\" name=\"email_signup\">
                                        </div>
                                    </div>
                                  
                                    <div class=\"divisionEnd\">
                                        <div class=\"lineEnd\"></div>
                                    </div>

                                    <div class=\"form-group\">
                                        <div class=\"col-xs-12 nome_signupEnd\">
                                            <input id=\"nome\" class=\"form-control\" value='$name'
                                                   type=\"text\" placeholder=\"Nome completo\" name=\"nome\">
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
                                                <input id=\"utilizador_signupEnd\" class=\"form-control user_id\" value=\"$id_user\"
                                                       type=\"text\" name=\"utilizador_signupEnd\">
                                            </div>
                                        </div>
                                    </div>

                                    <div class=\"form-group\">
                                        <div class=\"col-xs-12 agree-box\">
                                            <label class=\"checkbox\" for=\"agree\" id=\"click-agree-1\">
                                                <input type=\"checkbox\" value=\"no\" id=\"agree-1\"
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
                   
                </div>
            </div>
        </div>
</div>";
}

function conclusionFacebook($id, $image, $first_name, $last_name, $email)
{
    echo "
<div class=\"modal fade login\" id=\"conclusion-facebook\" tabindex=\"-1\"
     role=\"dialog\" aria-hidden=\"true\" data-backdrop=\"static\">
           <div class=\"modal-dialog vertical-align-center login animated\">
            <div class=\"modal-content\">
                <div class=\"modal-header\">
                    <button type=\"button\" class=\"close hidden-sm hidden-md hidden-lg\" data-dismiss=\"modal\"
                            aria-hidden=\"true\">&times;</button>
                    <h4 class=\"modal-title text-center\">ENTRAR</h4>
                </div>
                <div class=\"modal-body\">
                    <div class=\"box\">
                        <div class=\"content registerBox-2\" style=\"display:block;\">
                            <div class=\"form\">
                                <form method=\"post\" accept-charset=\"UTF-8\" id=\"signup_facebook\">
                                
                                    <input type='hidden' value='$id' id='id_facebook' name='id_facebook'>
                                    <input type='hidden' value='$image' id='image' name='image'>                                    

                                    <div class=\"form-group\">
                                        <div class=\"col-xs-12\">
                                            <input id=\"email\" class=\"form-control\" disabled value='$email'
                                                   type=\"text\" placeholder=\"Email\" name=\"email_signup email_fb\">
                                        </div>
                                    </div>
                                  
                                    <div class=\"divisionEnd\">
                                        <div class=\"lineEnd\"></div>
                                    </div>

                                    <div class=\"form-group\">
                                        <div class=\"col-xs-12 nome_signupEnd\">
                                            <input id=\"nome\" class=\"form-control\" value='$first_name $last_name'
                                                   type=\"text\" placeholder=\"Nome completo\" name=\"nome\">
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
                                                <input id=\"utilizador_signupEnd\" class=\"form-control user_id\"
                                                       type=\"text\" name=\"utilizador_signupEnd\">
                                            </div>
                                        </div>
                                    </div>

                                    <div class=\"form-group\">
                                        <div class=\"col-xs-12 agree-box\">
                                            <label class=\"checkbox\" for=\"agree\" id=\"click-agree-1\">
                                                <input type=\"checkbox\" value=\"no\" id=\"agree-1\"
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
                   
                </div>
            </div>
        </div>
</div>";
}