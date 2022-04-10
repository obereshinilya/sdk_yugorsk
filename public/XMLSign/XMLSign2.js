class XMLSign {
    #isPluginEnabled=false;
    #async_code_enabled=false;
    #async_Promise;
    #async_resolve;

    #canPromise;
    #canAsync;

    //АТРИБУТЫ ПЛАГИНА
    #CurrentPluginVersion;


    //
    #AllCerts;
    #XMLStrToSign;
    #urlToSend;
    #content_div;



    //КОНСТРУКТОР
    constructor(content, data_id, content_div) {
        this.#content_div=content_div;
        this.#canPromise=!!window.Promise;
        this.#AllCerts=[]
        this.#XMLStrToSign='<?xml version=\"1.0\" encoding=\"utf-8\"?>\n'+
        '<s:Envelope Id=\"main\" xmlns:s=\"http://schemas.xmlsoap.org/soap/envelope/\" xmlns:u=\"http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd\">\n'+
        '<s:Header>\n'+
        '<RequestHeader xmlns:xsd=\"http://www.w3.org/2001/XMLSchema\" '+
        'xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\">\n'+
        `<Date>${new Date().toISOString()}</Date>\n`+
        `<MessageGUID>${this.#create_guid()}</MessageGUID>\n`+
        '<orgPPAGUID></orgPPAGUID>\n'+
        '</RequestHeader>\n'+
        '</s:Header>\n'+
        '<s:Body xmlns:xsd=\"http://www.w3.org/2001/XMLSchema\" '+
        'xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\">\n'+
        `<exportNsiListRequest u:Id=\"${data_id}\">\n`+
        '<ds:Signature xmlns:ds=\"http://www.w3.org/2000/09/xmldsig#\">\n'+
        '<ds:SignedInfo>\n'+
        '<ds:CanonicalizationMethod Algorithm=\"http://www.w3.org/2001/10/xml-exc-c14n#\"/>\n'+
        '<ds:SignatureMethod Algorithm=\"urn:ietf:params:xml:ns:cpxmlsec:algorithms:gostr34102012-gostr34112012-256\"/>\n'+
        `<ds:Reference URI=\"#${data_id}\">\n`+
        '<ds:Transforms>\n'+
        '<ds:Transform Algorithm=\"http://www.w3.org/2000/09/xmldsig#enveloped-signature\"/>\n'+
        '<ds:Transform Algorithm=\"http://www.w3.org/2001/10/xml-exc-c14n#\"/>\n'+
        '</ds:Transforms>\n'+
        '<ds:DigestMethod Algorithm=\"urn:ietf:params:xml:ns:cpxmlsec:algorithms:gostr34112012-256\"/>\n'+
        '<ds:DigestValue></ds:DigestValue>\n'+
        '</ds:Reference>\n'+
        '</ds:SignedInfo>\n'+
        '<ds:SignatureValue></ds:SignatureValue>\n'+
        '<ds:KeyInfo>\n'+
        '<ds:X509Data>\n'+
        '<ds:X509Certificate></ds:X509Certificate>\n'+
        '</ds:X509Data>\n'+
        '</ds:KeyInfo>\n'+
        '</ds:Signature>\n'+
        '</exportNsiListRequest>\n'+
        '</s:Body>\n'+
        '</s:Envelope>';
        console.log(this.#XMLStrToSign)
        this.html_formed();
        // document.getElementById('certificates_list').addEventListener('change', ()=>{
        //     var select_cert_id=document.getElementById('certificates_list').selectedIndex;
        //     this.Show_Cert_Info(this.get_cert_by_id(select_cert_id))
        // })
        $('.XMLSign_dropdown').click(function(){
            $(this).attr('tabindex', 1).focus();
            $(this).toggleClass('active');
            $(this).find('.XMLSign-dropdown-menu').slideToggle(100);
        });
        $('.XMLSign_dropdown').focusout(function () {
            $(this).removeClass('active');
            $(this).find('.asdasd').slideUp(100);
        });
        if (this.#canPromise){
            cadesplugin.then(()=>{
                this.#Common_CheckPlugIn();
            })
        }
    }

    #create_guid() {
        return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
            var r = Math.random() * 16 | 0, v = c == 'x' ? r : (r & 0x3 | 0x8);
            return v.toString(16);
        });
    }

    //Формирование html
    html_formed(){
        var main_div=document.getElementById(this.#content_div)
        main_div.innerText='';

        var plugin_info_div=document.createElement('div')
        plugin_info_div.id='XMLSign_plugin_info_div'

        plugin_info_div.innerHTML='<span id="plugin_loaded_text" class="plugin_info"></span>' +
            '<br><span id="plugin_version_text" class="plugin_info"></span>' +
            '<span id="csp_version_text" class="plugin_info"></span>' +
            '<br><span id="csp_name_text" class="plugin_info"></span>' +
            '<hr class="line-on-div-bottom">'

        main_div.appendChild(plugin_info_div)

        var cert_list=document.createElement('div')
        cert_list.id='certs_lists_div'
        // cert_list.innerHTML='<span class="XMLSign_title_text">Выберите сертификат:</span>' +
        //     '<select id="certificates_list"></select>'
        cert_list.innerHTML='<span class="cert_list_header_text">Сертификат:</span>' +
            '<div class="XMLSign_dropdown"> ' +
            '   <div class="XMLSign_select">' +
            '      <span>Выберите сертификат...</span>' +
            '       <i class="fa fa-chevron-down"></i>' +
            '   </div>' +
            '   <input type="hidden" name="certificate_id" id="certificate_id_input" value="-1">' +
            '   <ol class="XMLSign-dropdown-menu" id="cert_list">' +
            '   </ol>' +
            '</div>' +
            '<hr class="line-on-div-bottom">'

        main_div.appendChild(cert_list)

        var cert_info_div=document.createElement('div')
        cert_info_div.id='XMLSign_cert_info'
        cert_info_div.innerHTML='<span id="cert_info_text_header" style="font-size: 20px"></span>' +
            '<div class="cert_info_div">' +
            '<p class="cert_info_text" id="cert_subject"></p>' +
            '<p class="cert_info_text" id="cert_issuer"></p>' +
            '<p class="cert_info_text" id="cert_from"></p>' +
            '<p class="cert_info_text" id="cert_till"></p>' +
            '<p class="cert_info_text" id="cert_provname"></p>' +
            '<p class="cert_info_text" id="cert_privateKeyLink"></p>' +
            '<p class="cert_info_text" id="cert_algorithm"></p>' +
            '<p class="cert_info_text" id="cert_status"></p>' +
            '<p class="cert_info_text" id="cert_location"></p>' +
            '</div>'

        main_div.appendChild(cert_info_div)


        var button_div=document.createElement('div')
        button_div.className='XMLSign_btn_div'

        var sign_button=document.createElement('button');
        sign_button.addEventListener('click', ()=>{this.#Common_SignXMLStr()});
        sign_button.innerText='Подписать'

        button_div.appendChild(sign_button);
        main_div.appendChild(button_div)
    }

    //МЕТОДЫ ДОСТУПА
    set_CurrentPluginVersion(ver){
        this.#CurrentPluginVersion=ver
    }
    get_CurrentPluginVersion(){
        return this.#CurrentPluginVersion
    }

    push_cert_to_AllCerts(certs){
        this.#AllCerts.push(certs)
    }
    get_all_certs(){
        return this.#AllCerts;
    }
    get_cert_by_id(id){
        return this.#AllCerts[id];
    }

    get_xml_to_str(){
        return this.#XMLStrToSign;
    }
    set_XMLStrToSign(xml){
        this.#XMLStrToSign=xml;
    }

    get_url_to_send(){
        return this.#urlToSend;
    }

    set_url_to_send(url){
        this.#urlToSend=url;
    }





    get_async_promise(){
        if (this.#async_code_enabled){
            return this.#async_Promise;
        }
        this.#async_Promise=new Promise((resolve, reject)=>{
            this.#async_resolve=resolve;
        });
        this.#async_code_enabled=true;
        this.#async_resolve();
        return this.#async_Promise;
    }

    #Common_CheckPlugIn(){
        this.get_async_promise().then(()=>{
            return this.#CheckForPlugIn_Async();
        });
    }

    #Common_SignXMLStr(){
        this.get_async_promise().then(()=>{
            return this.#SignXML_Async();
        });
    }


    //ФУНКЦИИ ВЫВОДА ИНФОРМАЦИИ О СЕРТИФИКАТЕ














    //++++ПРОВЕРКА ПЛАГИНА++++//
    #CheckForPlugIn_Async(){
        function VersionCompare_Async(StringVersion, ObjectVersion)
        {
            if(typeof(ObjectVersion) == "string")
                return -1;
            var arr = StringVersion.split('.');
            var isActualVersion = true;
            document.getElementById('plugin_loaded_text').innerText='Плагин загружен'
            cadesplugin.async_spawn(function *() {
                if((yield ObjectVersion.MajorVersion) == parseInt(arr[0]))
                {
                    if((yield ObjectVersion.MinorVersion) == parseInt(arr[1]))
                    {
                        if((yield ObjectVersion.BuildVersion) == parseInt(arr[2]))
                        {
                            isActualVersion = true;
                        }
                        else if((yield ObjectVersion.BuildVersion) < parseInt(arr[2]))
                        {
                            isActualVersion = false;
                        }
                    }else if((yield ObjectVersion.MinorVersion) < parseInt(arr[1]))
                    {
                        isActualVersion = false;
                    }
                }else if((yield ObjectVersion.MajorVersion) < parseInt(arr[0]))
                {
                    isActualVersion = false;
                }

                if(!isActualVersion)
                {
                    document.getElementById('plugin_loaded_text').innerText='Плагин загружен, но есть более свежая версия.'
                    console.log("Плагин загружен, но есть более свежая версия.");
                }
                document.getElementById('plugin_version_text').innerText="Версия плагина: " + (yield self.get_CurrentPluginVersion().toString())
                console.log("Версия плагина: " + (yield self.get_CurrentPluginVersion().toString()));

                var oAbout = yield cadesplugin.CreateObjectAsync("CAdESCOM.About");
                var ver = yield oAbout.CSPVersion("", 80);
                var ret = (yield ver.MajorVersion) + "." + (yield ver.MinorVersion) + "." + (yield ver.BuildVersion);
                document.getElementById('csp_version_text').innerText="Версия криптопровайдера: " + ret;
                console.log("Версия криптопровайдера: " + ret);

                try
                {
                    var sCSPName = yield oAbout.CSPName(80);
                    console.log("Криптопровайдер: " + sCSPName);
                    document.getElementById('csp_name_text').innerText="Криптопровайдер: " + sCSPName;
                }
                catch(err){}
                return;
            });
        }

        function GetLatestVersion_Async(CurrentPluginVersion) {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.open("GET", 'https://www.cryptopro.ru/sites/default/files/products/cades/latest_2_0.txt', true);
            xmlhttp.onreadystatechange = function() {
                var PluginBaseVersion;
                if (xmlhttp.readyState == 4) {
                    if(xmlhttp.status == 200) {
                        PluginBaseVersion = xmlhttp.responseText;
                        VersionCompare_Async(PluginBaseVersion, CurrentPluginVersion)
                    }
                }
            }
            xmlhttp.send(null);
        }

        var self=this
        cadesplugin.async_spawn(function *() {
            var oAbout = yield cadesplugin.CreateObjectAsync("CAdESCOM.About");
            self.set_CurrentPluginVersion(yield oAbout.PluginVersion);
            GetLatestVersion_Async(self.get_CurrentPluginVersion());
            self.load_certs();
        });
    }
    //++++Загрузка сертификатов++++//
    load_certs(){
        var self=this;
        cadesplugin.async_spawn(function *() {

            var MyStoreExists = true;
            try {
                var oStore = yield cadesplugin.CreateObjectAsync("CAdESCOM.Store");
                if (!oStore) {
                    alert("Create store failed");
                    return;
                }

                yield oStore.Open();
            }
            catch (ex) {
                MyStoreExists = false;
            }
            var certCnt;
            var certs;
            if (MyStoreExists) {
                var selected_index=0;
                var carts_list=document.getElementById('cert_list')
                try {
                    certs = yield oStore.Certificates;
                    certCnt = yield certs.Count;
                } catch (ex) {
                    alert("Ошибка при получении Certificates или Count: " + cadesplugin.getLastError(ex));
                    return;
                }
                for (var i = 1; i <= certCnt; i++) {
                    var cert;
                    try {
                        cert = yield certs.Item(i);
                    } catch (ex) {
                        alert("Ошибка при перечислении сертификатов: " + cadesplugin.getLastError(ex));
                        return;
                    }
                    var oOpt=document.createElement('li')
                    var dateObj=new Date();
                    try{
                        var ValidFromDate=new Date(yield cert.ValidFromDate);
                        oOpt.innerText=yield cert.SubjectName;
                        oOpt.value=selected_index;
                        $(oOpt).click(function (){
                            $(this).parents('.XMLSign_dropdown').find('span').text($(this).text());
                            $(this).parents('.XMLSign_dropdown').find('input').attr('value', $(this).attr('value'));
                            self.Show_Cert_Info(self.get_cert_by_id(parseInt($(this).attr('value'))))
                        });
                        selected_index++;
                        carts_list.appendChild(oOpt)
                        self.push_cert_to_AllCerts({'cert':cert, 'fromCont':false})
                    }
                    catch (ex){
                        console.log(ex)
                    }
                    // console.log(cert)
                }
                try{
                    oStore.Open(cadesplugin.CADESCOM_CONTAINER_STORE);
                    certCnt = oStore.Certificates.Count;
                    for (var i = 1; i <= certCnt; i++) {
                        var cert = oStore.Certificates.Item(i);
                        //Проверяем не добавляли ли мы такой сертификат уже?
                        var found = false;
                        for (var c of self.get_all_certs())
                        {
                            if (c['cert'].Thumbprint === cert.Thumbprint)
                            {
                                found = true;
                                break;
                            }
                        }
                        if(found)
                            continue;
                        var oOpt=document.createElement('option')
                        try{
                            var ValidFromDate=new Date(yield cert.ValidFromDate);
                            oOpt.text=yield cert.SubjectName;
                            oOpt.value=selected_index;
                            $(oOpt).click(function (){
                                $(this).parents('.XMLSign_dropdown').find('span').text($(this).text());
                                $(this).parents('.XMLSign_dropdown').find('input').attr('value', $(this).attr('value'));
                                self.Show_Cert_Info(self.get_cert_by_id(parseInt($(this).attr('value'))))
                            });
                            selected_index++;
                            carts_list.appendChild(oOpt)
                            self.push_cert_to_AllCerts({'cert':cert, 'fromCont':true})
                        }
                        catch (ex){
                            console.log(ex)
                        }

                    }
                }
                catch (ex){
                    console.log(ex);
                }
                yield oStore.Close();

            }

        })
    }

    //++++Подписать XML string++++//
    #SignXML_Async(){
        var self=this;
        cadesplugin.async_spawn(function *(args){
            var select_cert_id=parseInt(document.getElementById('certificate_id_input').value);
            if (select_cert_id==-1){
                alert('select cert');
                return;
            }
            var certificate=self.get_cert_by_id(select_cert_id)['cert']

            try{
                var errormes="";
                try{
                    var oSigner=yield cadesplugin.CreateObjectAsync('CAdESCOM.CPSigner')
                }
                catch (ex){
                    console.log(ex)
                    errormes="Failed to create CAdESCOM.CPSigner: " + err.number;
                    throw errormes;
                }

                if (oSigner) {
                    yield oSigner.propset_Certificate(certificate);
                    yield oSigner.propset_CheckCertificate(true);
                }
                else {
                    console.log("Failed to create CAdESCOM.CPSigner")
                    errormes = "Failed to create CAdESCOM.CPSigner";
                    throw errormes;
                }


                var oSignedXML = yield cadesplugin.CreateObjectAsync("CAdESCOM.SignedXML");

                var pubKey = yield certificate.PublicKey();
                var algo = yield pubKey.Algorithm;
                var algoOid = yield algo.Value;

                var signMethod;
                var digestMethod;

                if (algoOid == "1.2.643.7.1.1.1.1") {   // алгоритм подписи ГОСТ Р 34.10-2012 с ключом 256 бит
                    signMethod = "urn:ietf:params:xml:ns:cpxmlsec:algorithms:gostr34102012-gostr34112012-256";
                    digestMethod = "urn:ietf:params:xml:ns:cpxmlsec:algorithms:gostr34112012-256";
                }
                else if (algoOid == "1.2.643.7.1.1.1.2") {   // алгоритм подписи ГОСТ Р 34.10-2012 с ключом 512 бит
                    signMethod = "urn:ietf:params:xml:ns:cpxmlsec:algorithms:gostr34102012-gostr34112012-512";
                    digestMethod = "urn:ietf:params:xml:ns:cpxmlsec:algorithms:gostr34112012-512";
                }
                else if (algoOid == "1.2.643.2.2.19") {  // алгоритм ГОСТ Р 34.10-2001
                    signMethod = "urn:ietf:params:xml:ns:cpxmlsec:algorithms:gostr34102001-gostr3411";
                    digestMethod = "urn:ietf:params:xml:ns:cpxmlsec:algorithms:gostr3411";
                }
                else {
                    errormes = "Данная демо страница поддерживает XML подпись сертификатами с алгоритмом ГОСТ Р 34.10-2012, ГОСТ Р 34.10-2001";
                    throw errormes;
                }

                var CADESCOM_XML_SIGNATURE_TYPE_TEMPLATE = 2;
                var CADESCOM_XADES_BES = 0x00000020;
                console.log(self.get_xml_to_str())
                if (typeof (self.get_xml_to_str())!='undefined') {
                    yield oSignedXML.propset_Content(self.get_xml_to_str());
                    yield oSignedXML.propset_SignatureType(CADESCOM_XML_SIGNATURE_TYPE_TEMPLATE);
                    yield oSignedXML.propset_SignatureMethod(signMethod);
                    yield oSignedXML.propset_DigestMethod(digestMethod);

                    var Signature = "";
                    try {
                        Signature = yield oSignedXML.Sign(oSigner);
                    } catch (err) {
                        console.log(err)
                        errormes = "Не удалось создать подпись из-за ошибки: " + cadesplugin.getLastError(err);
                        throw errormes;
                    }

                    try {
                        var xmlhttp = new XMLHttpRequest();
                        xmlhttp.open("POST", self.get_url_to_send(), true);
                        xmlhttp.onreadystatechange = function () {
                            if (xmlhttp.readyState == 4) {
                                if (xmlhttp.status == 200) {
                                    //Надо прописать что будет при успешной отправке
                                }
                            }
                        }
                        xmlhttp.setRequestHeader("SOAPAction", "http://www.webserviceX.NET/GetQuote");
                        xmlhttp.setRequestHeader("Content-Type", "text/xml");
                        xmlhttp.send(Signature);
                    } catch (ex) {
                        errormes = "Не удалось отправить soap: " + ex;
                        console.log(errormes)
                        throw errormes;
                    }
                }
                else{
                    alert('Нет данных для подписи')
                    return;
                }



            }
            catch (ex){
                console.log(ex)
            }
        });
    }

    Show_Cert_Info(certificate){
        cadesplugin.async_spawn(function *(args){
            var ValidToDate=new Date(yield args[0].ValidToDate)
            var ValidFromDate = new Date((yield args[0].ValidFromDate));
            var Validator;
            var IsValid = false;
            //если попадется сертификат с неизвестным алгоритмом
            //тут будет исключение. В таком сертификате просто пропускаем такое поле
            try {
                Validator = yield args[0].IsValid();
                IsValid = yield Validator.Result;
            } catch(e) {

            }

            function checkQuotes(str){
                var result = 0, i = 0;
                for(i;i<str.length;i++)if(str[i]==='"')
                    result++;
                return !(result%2);
            }

            function extract(from, what){
                var result;
                var begin = from.indexOf(what);

                if(begin>=0)
                {
                    var end = from.indexOf(', ', begin);
                    while(end > 0) {
                        if (checkQuotes(from.substr(begin, end-begin)))
                            break;
                        end = from.indexOf(', ', end + 1);
                    }
                    result = (end < 0) ? from.substr(begin) : from.substr(begin, end - begin);
                }

                return result;
            }
            function Print2Digit(digit){
                return (digit<10) ? "0"+digit : digit;
            }
            function GetCertDate(paramDate){
                var certDate = new Date(paramDate);
                return Print2Digit(certDate.getUTCDate())+"."+Print2Digit(certDate.getUTCMonth()+1)+"."+certDate.getFullYear() + " " +
                    Print2Digit(certDate.getUTCHours()) + ":" + Print2Digit(certDate.getUTCMinutes()) + ":" + Print2Digit(certDate.getUTCSeconds());
            }

            var hasPrivateKey = yield args[0].HasPrivateKey();
            var Now = new Date();
            var cert_info_text_template='cert_';
            document.getElementById('cert_info_text_header').innerText="Информация о сертификате"
            document.getElementById(cert_info_text_template + "subject").innerHTML = "Владелец: <b>" + extract(yield args[0].SubjectName, 'CN=') + "<b>";
            document.getElementById(cert_info_text_template + "issuer").innerHTML = "Издатель: <b>" + extract(yield args[0].IssuerName, 'CN=') + "<b>";
            document.getElementById(cert_info_text_template + "from").innerHTML = "Выдан: <b>" + GetCertDate(ValidFromDate) + " UTC<b>";
            document.getElementById(cert_info_text_template + "till").innerHTML = "Действителен до: <b>" + GetCertDate(ValidToDate) + " UTC<b>";

            var pubKey = yield args[0].PublicKey();
            var algo = yield pubKey.Algorithm;
            var fAlgoName = yield algo.FriendlyName;

            document.getElementById(cert_info_text_template + "algorithm").innerHTML = "Алгоритм ключа: <b>" + fAlgoName + "<b>";
            if (hasPrivateKey) {
                var oPrivateKey = yield args[0].PrivateKey;
                var sProviderName = yield oPrivateKey.ProviderName;
                document.getElementById(cert_info_text_template + "provname").innerHTML = "Криптопровайдер: <b>" + sProviderName + "<b>";
                try {
                    var sPrivateKeyLink = yield oPrivateKey.UniqueContainerName;
                    document.getElementById(cert_info_text_template + "privateKeyLink").innerHTML = "Ссылка на закрытый ключ: <b>" + sPrivateKeyLink + "<b>";
                } catch (e) {
                    document.getElementById(cert_info_text_template + "privateKeyLink").innerHTML = "Ссылка на закрытый ключ: <b>" + e.message + "<b>";
                }
            } else {
                document.getElementById(cert_info_text_template + "provname").innerHTML = "Криптопровайдер:<b>";
                document.getElementById(cert_info_text_template + "privateKeyLink").innerHTML = "Ссылка на закрытый ключ:<b>";
            }

            if(Now < ValidFromDate) {
                document.getElementById(cert_info_text_template + "status").innerHTML = "Статус: <span style=\"color:red; font-weight:bold; font-size:16px\"><b>Срок действия не наступил</b></span>";
            } else if( Now > ValidToDate){
                document.getElementById(cert_info_text_template + "status").innerHTML = "Статус: <span style=\"color:red; font-weight:bold; font-size:16px\"><b>Срок действия истек</b></span>";
            } else if( !hasPrivateKey ){
                document.getElementById(cert_info_text_template + "status").innerHTML = "Статус: <span style=\"color:red; font-weight:bold; font-size:16px\"><b>Нет привязки к закрытому ключу</b></span>";
            } else if( !IsValid ){
                document.getElementById(cert_info_text_template + "status").innerHTML = "Статус: <span style=\"color:red; font-weight:bold; font-size:16px\"><b>Ошибка при проверке цепочки сертификатов. Возможно на компьютере не установлены сертификаты УЦ, выдавшего ваш сертификат</b></span>";
            } else {
                document.getElementById(cert_info_text_template + "status").innerHTML = "Статус: <b> Действителен<b>";
            }
            if(args[1])
            {
                document.getElementById(cert_info_text_template + "location").innerHTML = "Установлен в хранилище: <b>Нет</b>";
            } else {
                document.getElementById(cert_info_text_template + "location").innerHTML = "Установлен в хранилище: <b>Да</b>";
            }

        }, certificate['cert'], certificate['fromCont'])
    }
}
