function onCertificateSelected(event){
    cadesplugin.async_spawn(function* (args){
        var selectedCertId=args[0][args[0].selectedIndex].value;
        var certificate=globa
    })
}

function FillCertList_Async(lstID){
    cadesplugin.async_spawn(function* (){
        var MyStoreExists = true;
        try{
            var oStore=yield cadesplugin.CreateObjectAsync('CAdESCOM.Store')
            if (!oStore){
                console.log('Ошибка создания oStore')
                return;
            }
            yield oStore.Open();
        }
        catch (err){
            MyStoreExists = false;
        }

        var lst
    })
}


function CheckPlugIn_Async(){
    function VersionCompare_Async(StringVersion, ObjectVersion)
    {
        if(typeof(ObjectVersion) == "string")
            return -1;
        var arr = StringVersion.split('.');
        var isActualVersion = true;

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
                console.log("Плагин загружен, но есть более свежая версия.")
            }
            console.log("Версия плагина: " + (yield CurrentPluginVersion.toString()))
            var oAbout = yield cadesplugin.CreateObjectAsync("CAdESCOM.About");
            var ver = yield oAbout.CSPVersion("", 80);
            var ret = (yield ver.MajorVersion) + "." + (yield ver.MinorVersion) + "." + (yield ver.BuildVersion);
            console.log("Версия криптопровайдера: " + ret);

            try
            {
                var sCSPName = yield oAbout.CSPName(80);
                console.log("Криптопровайдер: " + sCSPName);
            }
            catch(err){}
            return;
        });
    }


    function GetLatestVersion_Async(CurrentPluginVersion) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET", "https://www.cryptopro.ru/sites/default/files/products/cades/latest_2_0.txt", true);
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


    var CurrentPluginVersion;
    cadesplugin.async_spawn(function *() {
        var oAbout = yield cadesplugin.CreateObjectAsync("CAdESCOM.About");
        CurrentPluginVersion = yield oAbout.PluginVersion;
        GetLatestVersion_Async(CurrentPluginVersion);
        //ВЫВОД СЕРТИФИКАТОВ
    }); //cadesplugin.async_spawn
}
