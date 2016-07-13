<?php 

echo "
<div class=\"wdt-emoji-popup\">
    <a href=\"#\" class=\"wdt-emoji-popup-mobile-closer\"> &times; </a>
	<div class=\"wdt-emoji-menu-content\">
		<div id=\"wdt-emoji-menu-header\">
            <a class=\"wdt-emoji-tab\" data-group-name=\"Recent\" style='display: none'></a>
            <a class=\"wdt-emoji-tab active\" data-group-name=\"Pessoas\"></a>
            <a class=\"wdt-emoji-tab\" data-group-name=\"Natureza\"></a>
            <a class=\"wdt-emoji-tab\" data-group-name=\"Comida\"></a>
            <a class=\"wdt-emoji-tab\" data-group-name=\"Atividades\"></a>
            <a class=\"wdt-emoji-tab\" data-group-name=\"Espaços\"></a>
            <a class=\"wdt-emoji-tab\" data-group-name=\"Objetos\"></a>
            <a class=\"wdt-emoji-tab\" data-group-name=\"Símbolos\"></a>
            <a class=\"wdt-emoji-tab\" data-group-name=\"Bandeiras\"></a>
            <a class=\"wdt-emoji-tab\" data-group-name=\"Custom\" style='display: none'></a>
        </div>
		<div class=\"wdt-emoji-scroll-wrapper\">
            <div id=\"wdt-emoji-menu-items\">
                <input id=\"wdt-emoji-search\" type=\"text\" placeholder=\"Procurar\">
                <h3 id=\"wdt-emoji-search-result-title\">Procurar</h3>
                <div class=\"wdt-emoji-sections\"></div>
                <div id=\"wdt-emoji-no-result\">Não foram encontrados emojis</div>
            </div>
        </div>
		<div id=\"wdt-emoji-footer\">
            <div id=\"wdt-emoji-preview\">
                <span id=\"wdt-emoji-preview-img\"></span>
                <div id=\"wdt-emoji-preview-text\">
                    <span id=\"wdt-emoji-preview-name\"></span><br>
                    <span id=\"wdt-emoji-preview-aliases\"></span>
                </div>
            </div>

            <div id=\"wdt-emoji-preview-bundle\">
                <span>Emojis</span>
            </div>
		</div>
	</div>
</div>

";

?>