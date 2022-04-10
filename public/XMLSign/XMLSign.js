//
//
// class XMLSign {
//     #canAsync;
//     #dataToSign;
//     #async_code_enabled;
//     #async_Promise;
//     #async_resolve;
//
//     //Параметры плагина:
//     #CurrentPluginVersion;
//     #CSPVersion;
//     #CSPName;
//     #PluginCorrect;
//     #isActual;
//
//     #oStore;
//     #AllCerts;
//
//     constructor(data) {
//         this.#AllCerts=[]
//         this.Promises={}
//         this.#PluginCorrect = false;
//
//         this.#dataToSign = data;
//         var canPromise = !!window.Promise;
//         if (this.isEdge()) {
//             this.ShowEdgeNotSupported();
//         } else {
//             if (canPromise) {
//                 cadesplugin.then(()=>{
//                         this.Promises['CheckPlugin']=this.Common_CheckForPlugIn()
//                         this.Promises['Load_oStore']=this.Load_oStore()
//                         this.GetAllCertsFromMachine()
//                     },
//                     function (error) {
//                         console.log(error)
//                     });
//             } else {
//
//             }
//         }
//     }
//
//     //===================COMMON_FUNCTIONS================//
//     isEdge() {
//         var retVal = navigator.userAgent.match(/Edge\/./i);
//         return retVal;
//     }
//
//     ShowEdgeNotSupported() {
//         //Надо добавить
//         console.log('Браузер не поддерживается')
//     }
//
//     MakeVersionString() {
//         if (typeof (this.#CurrentPluginVersion) == "string")
//             return this.#CurrentPluginVersion;
//         else
//             return this.#CurrentPluginVersion.MajorVersion + "." + this.#CurrentPluginVersion.MinorVersion + "." + this.#CurrentPluginVersion.BuildVersion;
//     }
//
//     Common_CheckForPlugIn() {
//         this.#canAsync = !!cadesplugin.CreateObjectAsync;
//         if (this.#canAsync) {
//             //АСИНХРОННАЯ РАБОТА
//             return this.CheckForPlugin_Async().then(function(self){
//                 console.log('Плагин загружен');
//                 console.log('Версия плагина: ' + self.get_CurrentPluginVersion())
//                 console.log('Криптопровайдер: ' + self.get_CSPName())
//                 console.log('Версия криптопровайдера: ' + self.get_CSPVersion())
//
//             },function(e){
//                 console.log('Плагин работает неправильно или не установлен. Ошибка: '+e)
//             });
//         } else {
//             //СИНХРОННАЯ РАБОТА
//             return this.CheckForPlugIn_NPAPI();
//         }
//     }
//
//     //////////////////////////////////////Methods/////////////////////////////////////
//     set_oStore(store){
//         this.#oStore=store;
//     }
//     GetAllCertsFromMachine(){
//         var self=this
//         var promises=[this.Promises['Load_oStore'], this.Promises['CheckPlugin']]
//         this.Promises['GetAllCertsFromMachine']=Promise.all(promises).then(data=>
//             cadesplugin.async_spawn(function *(){
//                 yield self.#oStore.Open();
//                 if (typeof (self.#oStore) == 'undefined'){
//                     //Вывод ошибки
//                     return;
//                 }
//                 try{
//
//                     var certs = yield self.#oStore.Certificates;
//                     var certCnt = yield certs.Count;
//                 }
//                 catch (err){
//                     //Ошибка при получении сертификатов
//                     return;
//                 }
//                 for (var i=1; i<=certCnt; i++){
//                     var cert;
//                     try{
//                         cert=yield certs.Item(i);
//                     }
//                     catch (ex){
//                         //Ошибка пот перечислении сертификатов
//                         return;
//                     }
//                     try{
//                         var ValidFromDate=new Date((yield cert.ValidFromDate));
//                         self.add_Cert({'name' : yield cert.SubjectName, 'date' : ValidFromDate})
//                     }
//                     catch (ex){
//                         //Ошибка при получении имени
//                     }
//                 }
//                 self.#oStore.Close();
//             }))
//         console.log(this.Promises)
//
//
//
//     }
//     add_Cert(cert){
//         this.#AllCerts.push(cert);
//     }
//     get_Certs(){
//         return this.#AllCerts;
//     }
//     set_isActual(actual){
//         this.#isActual=actual;
//     }
//     get_isActual(){
//         return this.#isActual;
//     }
//     set_PluginCorrect(correct) {
//         this.#PluginCorrect = correct;
//     }
//     get_PluginCorrect() {
//         return this.#PluginCorrect;
//     }
//     set_CurrentPluginVersion(ver) {
//         this.#CurrentPluginVersion = ver;
//     }
//     get_CurrentPluginVersion() {
//         return this.#CurrentPluginVersion;
//     }
//     set_CSPVersion(ver) {
//         this.#CSPVersion = ver;
//     }
//     get_CSPVersion() {
//         return this.#CSPVersion;
//     }
//     set_CSPName(name) {
//         this.#CSPName = name;
//     }
//     get_CSPName() {
//         return this.#CSPName;
//     }
//
//     Load_oStore(){
//         if (this.#canAsync) {
//             //АСИНХРОННАЯ РАБОТА
//             return this.GetCertList_Async().then((store)=>{
//                 this.set_oStore(store)
//             }, function(e){
//                 console.log('Ошибка: ',e)
//             });
//         } else {
//             //СИНХРОННАЯ РАБОТА
//             return this.GetCertList_NPAPI();
//         }
//     }
//
//
//
//
//
//
//     //!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!NPAPI_CODE!!!!!!!!!!!!!!!!!!!!!!!!!!!//
//     //================ПРОВРЕКА ПЛАГИНА=================//
//     CheckForPlugIn_NPAPI() {
//         try {
//             var oAbout = cadesplugin.CreateObject("CAdESCOM.About");
//             var isPluginWorked = true;
//
//             // Это значение будет проверяться сервером при загрузке страницы
//             if (typeof (oAbout.PluginVersion) == 'undefined') {
//                 this.set_CurrentPluginVersion(oAbout.Version);
//             } else {
//                 this.set_CurrentPluginVersion(oAbout.PluginVersion);
//             }
//
//             this.set_CSPVersion(oAbout.CSPVersion("", 80));
//             this.set_CSPName(oAbout.CSPName(80));
//             this.CheckGorLatestVersion_NPAPI(isPluginWorked);
//
//             if (this.get_PluginCorrect()) {
//                 console.log('Плагин загружен');
//                 console.log('Версия плагина: ' + this.get_CurrentPluginVersion())
//                 console.log('Криптопровайдер: ' + this.get_CSPName())
//                 console.log('Версия криптопровайдера: ' + this.get_CSPVersion())
//             }
//         } catch (err) {
//             console.log('При проверке плагина произошла ошибка: ' + err);
//             self.message_if_plugin_not_correct()
//         }
//
//     }
//
//     VersionCompare_NPAPI(StringVersion, ObjectVersion) {
//         if (typeof (ObjectVersion) == "string")
//             return -1;
//         var arr = StringVersion.split('.');
//
//         if (ObjectVersion.MajorVersion == parseInt(arr[0])) {
//             if (ObjectVersion.MinorVersion == parseInt(arr[1])) {
//                 if (ObjectVersion.BuildVersion == parseInt(arr[2])) {
//                     return 0;
//                 } else if (ObjectVersion.BuildVersion < parseInt(arr[2])) {
//                     return -1;
//                 }
//             } else if (ObjectVersion.MinorVersion < parseInt(arr[1])) {
//                 return -1;
//             }
//         } else if (ObjectVersion.MajorVersion < parseInt(arr[0])) {
//             return -1;
//         }
//
//         return 1;
//     }
//
//     CheckGorLatestVersion_NPAPI(isPluginWorked) {
//         var self = this;
//         var xmlhttp = new XMLHttpRequest();
//         xmlhttp.open("GET", 'https://www.cryptopro.ru/sites/default/files/products/cades/latest_2_0.txt', true)
//         xmlhttp.onload = function () {
//             var PluginBaseVersion;
//             if (xmlhttp.readyState == 4) {
//                 if (xmlhttp.status == 200) {
//                     PluginBaseVersion = xmlhttp.responseText;
//                     if (isPluginWorked) {
//                         if (self.VersionCompare_NPAPI(PluginBaseVersion, self.get_CurrentPluginVersion()) < 0) {
//                             self.set_isActual(false);
//                             self.set_PluginCorrect(false);
//                         } else {
//                             self.set_isActual(true);
//                             self.set_PluginCorrect(true);
//                         }
//                     }
//                 }
//             }
//         }
//         xmlhttp.send(null)
//     }
//
//     //==============================ПОЛУЧИТЬ OSTORE=========================//
//     GetCertList_NPAPI(){
//         try {
//             this.#oStore = cadesplugin.CreateObject("CAdESCOM.Store");
//         }
//         catch (ex) {
//             console.log('Не удалось получить oStore')
//         }
//     }
//
//
//
//
//
//
//
//
//     //!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!ASYNC_CODE!!!!!!!!!!!!!!!!!!!!!!!!!!!//
//     enable_async_code() {
//         if (this.#async_code_enabled) {
//             return this.#async_Promise
//         }
//         var self = this;
//         this.#async_Promise = new Promise(function (resolve, reject) {
//             self.#async_resolve = resolve;
//         });
//         this.#async_code_enabled = true;
//         return this.#async_Promise;
//     }
//
//     //==============================ПРОВЕРКА ПЛАГИНА========================//
//     CheckForPlugin_Async() {
//         var self=this;
//         return new Promise(function (resolve, reject){
//             try{
//                 cadesplugin.async_spawn(function *(){
//                     var oAbout = yield cadesplugin.CreateObjectAsync("CAdESCOM.About");
//                     var currentplver = yield oAbout.PluginVersion;
//                     self.set_CurrentPluginVersion(yield currentplver.toString());
//
//                     var ver = yield oAbout.CSPVersion("", 80);
//                     var ret = (yield ver.MajorVersion) + "." + (yield ver.MinorVersion) + "." + (yield ver.BuildVersion);
//                     self.set_CSPVersion(ret);
//
//                     self.set_CSPName(yield oAbout.CSPName(80));
//
//                     var xmlhttp = new XMLHttpRequest();
//                     xmlhttp.open("GET", 'https://www.cryptopro.ru/sites/default/files/products/cades/latest_2_0.txt', false)
//                     xmlhttp.onload = function () {
//                         if (xmlhttp.readyState == 4) {
//                             if(xmlhttp.status == 200) {
//                                 var StringVersion;
//                                 StringVersion = xmlhttp.responseText;
//                             }
//                             else{
//                                 reject('Не удалось получить актуальную версию')
//                             }
//
//                         }
//                         else{
//                             reject(Error(
//                                 'Произошла ошибка. Код ошибки:' + xmlhttp.statusText))
//                         }
//                         var arr = StringVersion.split('.');
//                         var isActualVersion = true;
//
//                         if((currentplver.MajorVersion) == parseInt(arr[0]))
//                         {
//                             if((currentplver.MinorVersion) == parseInt(arr[1]))
//                             {
//                                 if((currentplver.BuildVersion) == parseInt(arr[2]))
//                                 {
//                                     isActualVersion = true;
//                                 }
//                                 else if((currentplver.BuildVersion) < parseInt(arr[2]))
//                                 {
//                                     isActualVersion = true;
//                                 }
//                             }else if((currentplver.MinorVersion) < parseInt(arr[1]))
//                             {
//                                 isActualVersion = true;
//                             }
//                         }
//                         else if((currentplver.MajorVersion) < parseInt(arr[0]))
//                         {
//                             isActualVersion = true;
//
//                         }
//                         self.set_PluginCorrect(isActualVersion);
//                     }
//
//                     xmlhttp.send(null);
//
//                     if (self.get_PluginCorrect()){
//                         resolve(self);
//                     }
//                     else{
//                         reject('')
//                     }
//
//                 });
//
//             }
//             catch (e){
//                 reject(e);
//             }
//
//         })
//     }
//
//     VersionCompare_Async(ObjectVersion){
//         var self=this;
//         var xmlhttp = new XMLHttpRequest();
//         xmlhttp.open("GET", 'https://www.cryptopro.ru/sites/default/files/products/cades/latest_2_0.txt', true)
//
//         xmlhttp.onreadystatechange = function () {
//             var StringVersion;
//             if (xmlhttp.readyState == 4) {
//                 if(xmlhttp.status == 200) {
//                     StringVersion = xmlhttp.responseText;
//                     if(typeof(ObjectVersion) == "string")
//                         return -1;
//                     var arr = StringVersion.split('.');
//                     self.set_isActual(true);
//                         if((ObjectVersion.MajorVersion) == parseInt(arr[0])){
//                             if((ObjectVersion.MinorVersion) == parseInt(arr[1]))
//                             {
//                                 if((ObjectVersion.BuildVersion) == parseInt(arr[2]))
//                                 {
//                                     self.set_isActual(true);
//                                 }
//                                 else if((ObjectVersion.BuildVersion) < parseInt(arr[2]))
//                                 {
//                                     self.set_isActual(false);
//                                 }
//                             }else if((ObjectVersion.MinorVersion) < parseInt(arr[1]))
//                             {
//                                 self.set_isActual(false);
//                             }
//                         }
//                         else if((ObjectVersion.MajorVersion) < parseInt(arr[0]))
//                         {
//                             self.set_isActual(false);
//                         }
//
//
//                 }
//             }
//         }
//         return xmlhttp;
//     }
//
//     //==============================ПОЛУЧИТЬ OSTORE=========================//
//     GetCertList_Async(){
//         return new Promise(function (resolve, reject)
//         {
//             cadesplugin.async_spawn(function *(){
//                 try{
//                     var oStore=yield cadesplugin.CreateObjectAsync('CAdESCOM.Store');
//                     if (!oStore){
//                         reject('Create Store failed')
//                         return;
//                     }
//                     resolve(oStore);
//                 }
//                 catch (ex){
//                     reject(ex)
//                 }
//             })
//         })
//     }
// }
//
//
